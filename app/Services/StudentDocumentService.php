<?php
namespace App\Services;

use App\Models\StudentDocument;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, Redirect, DB};

class StudentDocumentService
{
    public function verificationStatusUpdate($id)
    {
        $data = StudentDocument::select('identity_is_approved', 'edu_is_approved', 'english_level','english_score','identity_trail_attempt','edu_trail_attempt','english_test_attempt')
                               ->where('student_id', $id)
                               ->first();

        if (!$data) {
            \Log::warning("No student document found for student_id: $id");
            return;
        }

        $status = $data->identity_is_approved === 'Approved' 
                  && $data->edu_is_approved === 'Approved'
                  && $data->english_score >= 10
                  ? 'Verified'
                  : 'Unverified';

        if(($data->identity_trail_attempt == '3' && ($data->identity_is_approved == "Rejected")) || ( $data->edu_trail_attempt == '3'  || $data->edu_is_approved == "Rejected") || $data->english_test_attempt == '0' || $data->english_score < 10 ){

            $status = "Rejected";
        }

        User::where('id', $id)->update(['is_verified' => $status]);

        if ($data->english_score >= 10 && $data->identity_is_approved == "Approved" && $data->edu_is_approved == "Approved") {
            $courseData = DB::table('student_course_master')
                            ->select('course_id')
                            ->where('user_id', $id)
                            ->latest()
                            ->first();

            if ($courseData) {
                $courseMaster = DB::table('course_master')->where('id', $courseData->course_id)->first();
                if ($courseMaster) {
                    if($courseMaster->duration_month == ''){
                        $duration_month = 6;
                    }else{
                        $duration_month = $courseMaster->duration_month;
                    }
                    DB::table('student_course_master')
                      ->where('user_id', $id)
                      ->update([
                          'course_start_date' => now()->format('Y-m-d'),
                          'course_expired_on' => Carbon::now()->addMonths($duration_month)->format('Y-m-d'),
                      ]);

                    $ementor = DB::table('users')->where('id', $courseMaster->ementor_id)->first();
                    if ($ementor) {
                        // Example function `mail_send` used here
                        $course = DB::table('course_master')->where('id', $courseData->course_id)->first();
                        if ($course) {
                            // mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#'], 
                            //           [Auth::user()->name . " " . Auth::user()->last_name, $course->course_title, $duration_month, now()->format('Y-m-d'), $ementor->name . " " . $ementor->last_name], 
                            //           $ementor->email);
                        }
                    }
                }
            }
        }
    }
}

?>