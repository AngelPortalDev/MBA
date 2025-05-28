<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\{Auth, Redirect, DB};
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentDocument extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    public $table = 'student_doc_verification';
    protected $primaryKey = 'student_doc_id';
    protected $guarded  = [];


    // protected static function boot()
    // {
    //     parent::boot();
    //     static::updated(function ($table) {
    //         $table->verificationStatutsPending();
    //     });
    // }
    public function verificationStatutsUpdate($id)
    {
        $data = $this->select('identity_is_approved', 'edu_is_approved','english_level','english_score')->where('student_id', $id)->first();

         $status = $data->identity_is_approved === 'Approved' && $data->edu_is_approved === 'Approved' &&  $data->english_score >= 10 ? 'Verified' : 'Unverified';

        User::where('id', $id)->update(['is_verified' => $status]);
    }

    public function verificationStatusUpdateObserver($id){
        $data = StudentDocument::select('identity_is_approved', 'edu_is_approved','english_level','english_score')
        ->where('student_id', $id)
        ->first();
        $status = $data && $data->identity_is_approved === 'Approved' 
        && $data->edu_is_approved === 'Approved' 
        ? 'Verified' 
        : 'Unverified';

        User::where('id', $id)->update(['is_verified' => $status]);

        if($data->english_score >= 10 && $data->identity_is_approved == "Approved" && $data->edu_is_approved == "Approved" ){

        $courseData = DB::table('student_course_master')->select('course_id')->where('user_id',$id)->latest()->pluck();
        $courseMaster = DB::table('course_master')->where('id', $courseData->course_id)->first();

        DB::table('student_course_master')
        ->where('user_id', Auth::user()->id)
        ->update([
        'course_start_date' => now()->format('Y-m-d'),
        'course_expired_on' => Carbon::now()->addMonths($courseMaster->duration_month)->format('Y-m-d'),
        ]);

        $ementor = DB::table('users')->where('id', $courseData->ementor_id)->first();
        if($ementor){
            
            $studentCourseMaster = DB::table('student_course_master')
            ->where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->first(['course_id']);

            if ($studentCourseMaster) {
                $base64EncodedCourseId = base64_encode($studentCourseMaster->course_id);
            } else {
                $base64EncodedCourseId = null;
            }

            $unsubscribeRoute = url('/unsubscribe/'.base64_encode($course->email));
            mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#', '#[Study material link].#', '#unsubscribeRoute#'], [Auth::user()->name." ".Auth::user()->last_name, $course->course_title, $course->duration_month, $course->course_start_date, $ementor->name." ".$ementor->last_name, 
            "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId, $unsubscribeRoute], $course->email);
        }
        }
    }
    public function verificationStatutsPending($id)
    {
        $data = $this->select('identity_is_approved', 'edu_is_approved')->where('student_id', $id)->first();
        $status = $data->identity_is_approved === 'Pending' || $data->edu_is_approved === 'Pending' ? 'Pending' : '';
        if ($status != '' && !empty($status)) {
            User::where('id', $id)->update(['is_verified' => $status]);
        }
        
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
    public function getUserDocInfo($where = [], $select = [])
    {
        if (Auth::check()) {    
            $select = count($select) > 0 ? $select : ['*'];
            $query = $this->with('user')->select($select);
            $studentData = [];
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $studentData = $query->where($where)->first();
            } else {
                $studentData = $query->get();
            }
            return $studentData;
        }
    }
    public function getCurrentUserDocInfo($select = [])
    {
        if (Auth::check()) {
            $studentId = isset(Auth::user()->id) ? Auth::user()->id : 0;
            $query = $this->with('user');
            $studentData =  $query->where(['student_id' => $studentId])->first();
            return $studentData;
        }
    }
    public function docAttemptRemain($user_id, $attempDoc)
    {
        if (Auth::check() && is_numeric($user_id) && !empty($user_id) && isset($user_id) && !empty($attempDoc) && isset($attempDoc)) {
            $studentId = isset($user_id) ? $user_id : 0;

            $query = $this->where(['student_id' => $studentId]);

            if ($attempDoc === 'ID') {
                $query->where('identity_trail_attempt', '>', 0);
            } elseif ($attempDoc === 'EDU') {
                $query->where('edu_trail_attempt', '>', 0);
            } else {
                return FALSE;
            }
            $attemp =  $query->count();
            return $attemp;
        }
    }
    
    public function courseEnrollmentEmail($id)
    {
        $data = $this->select('identity_is_approved', 'edu_is_approved', 'english_level','english_score')->where('student_id', $id)->first();
        $status = $data->identity_is_approved === 'Approved' && $data->edu_is_approved === 'Approved' && $data->english_score >= '10' ? 'Verified' : 'Unverified';
        if($status === 'Verified'){
            
            // $course = DB::table('student_course_master')->join('course_master', 'course_master.id', 'student_course_master.course_id')->join('users', 'users.id', 'student_course_master.user_id')->where('user_id', $id)->latest('student_course_master.created_at')->select('student_course_master.course_start_date', 'course_master.duration_month', 'course_master.course_title', 'course_master.ementor_id', 'users.email')->first();
            
            $course = DB::table('student_course_master')
            ->join('course_master', 'course_master.id', 'student_course_master.course_id')
            ->join('users', 'users.id', 'student_course_master.user_id')
            ->where('student_course_master.user_id', $id)
            ->latest('student_course_master.created_at')
            ->select(
                'student_course_master.course_start_date',
                'course_master.duration_month',
                'course_master.course_title',
                'course_master.ementor_id',
                'users.email'
            )
            ->first();

            if($course){
                // $ementor = DB::table('users')->where('id', $course->ementor_id)->first();
                // if($ementor){
                //     mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#'], [Auth::user()->name." ".Auth::user()->last_name, $course->course_title, $course->duration_month, $course->course_start_date, $ementor->name." ".$ementor->last_name], $course->email);
                // }
                
                $ementor = DB::table('users')->where('id', $courseData->ementor_id)->first();
                $student = DB::table('users')->where('id', $id)->first();
                if($ementor){
                    
                    $studentCourseMaster = DB::table('student_course_master')
                    ->where('user_id', $id)
                    ->orderBy('created_at', 'desc')
                    ->first(['course_id']);

                    if ($studentCourseMaster) {
                        $base64EncodedCourseId = base64_encode($studentCourseMaster->course_id);
                    } else {
                        $base64EncodedCourseId = null;
                    }

                    // mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#'], [Auth::user()->name." ".Auth::user()->last_name, $course->course_title, $course->duration_month, $course->course_start_date, $ementor->name." ".$ementor->last_name], $course->email);
                    

                    $unsubscribeRoute = url('/unsubscribe/'.base64_encode($course->email));
                    mail_send(28, ['#Name#', '#[Course Name].#', '#[Duration of the course].#', '#[Start date of the course].#', '#[E-mentors Name].#', '#[Study material link].#', '#unsubscribeRoute#'], [$student->name." ".$student->last_name, $course->course_title, $course->duration_month, $course->course_start_date, $ementor->name." ".$ementor->last_name, "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId, $unsubscribeRoute], $course->email);
                }
            }
    

            
        }
    }

}