<?php

namespace App\Observers;

use App\Models\StudentDocument;
use Carbon\Carbon;
class StudentDocumentObserver
{
    /**
     * Handle the StudentDocument "created" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function created(StudentDocument $studentDocument)
    {
        \Log::info('Observer created method called.');
        // Alternatively, use print_r if you're working in a non-production environment
    }

    /**
     * Handle the StudentDocument "updated" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function updated(StudentDocument $studentDocument)
    {
        \Log::info('Observer created method called test.');
        $this->verificationStatusUpdate($studentDocument->student_id);

    }
    protected function verificationStatusUpdate($id)
    {
        $data = StudentDocument::select('identity_is_approved', 'edu_is_approved','english_level','english_score')
                           ->where('student_id', $id)
                           ->first();
        $status = $data && $data->identity_is_approved === 'Approved' 
                      && $data->edu_is_approved === 'Approved' 
                      ? 'Verified' 
                      : 'Unverified';

        User::where('id', $id)->update(['is_verified' => $status]);

        // if($data->english_score >= 10 && $data->identity_is_approved == "Approved" && $data->edu_is_approved == "Approved" ){

        //     $courseData = DB::table('student_course_master')->select('course_id')->where('user_id',$id)->latest()->pluck();
        //     $courseMaster = DB::table('course_master')->where('id', $courseData->course_id)->first();

        //     DB::table('student_course_master')
        //     ->where('user_id', Auth::user()->id)
        //     ->update([
        //         'course_start_date' => now()->format('Y-m-d'),
        //         'course_expired_on' => Carbon::now()->addMonths($courseMaster->duration_month)->format('Y-m-d'),
        //     ]);

        //     $ementor = DB::table('users')->where('id', $courseData->ementor_id)->first();
        //     $student = DB::table('users')->where('id', $id)->first();
        //     if($ementor){
                
        //         $studentCourseMaster = DB::table('student_course_master')
        //         ->where('user_id', $id)
        //         ->orderBy('created_at', 'desc')
        //         ->first(['course_id']);

        //         if ($studentCourseMaster) {
        //             $base64EncodedCourseId = base64_encode($studentCourseMaster->course_id);
        //         } else {
        //             $base64EncodedCourseId = null;
        //         }

        //         // mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#'], [Auth::user()->name." ".Auth::user()->last_name, $course->course_title, $course->duration_month, $course->course_start_date, $ementor->name." ".$ementor->last_name], $course->email);
                

        //         $unsubscribeRoute = url('/unsubscribe/'.base64_encode($course->email));
        //         mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#', '#[Study material link].#', '#unsubscribeRoute#'], [$student->name." ".$student->last_name, $course->course_title, $course->duration_month, $course->course_start_date, $ementor->name." ".$ementor->last_name, "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId, $unsubscribeRoute], $course->email);
        //     }
        // }
    }

    /**
     * Handle the StudentDocument "deleted" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function deleted(StudentDocument $studentDocument)
    {
        //
    }

    /**
     * Handle the StudentDocument "restored" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function restored(StudentDocument $studentDocument)
    {
        //
    }

    /**
     * Handle the StudentDocument "force deleted" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function forceDeleted(StudentDocument $studentDocument)
    {
        //
    }
}
