<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\StudentCourseModel;

class CourseExpireReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:course';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Student Wise Course Reminder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $thresholdDate = Carbon::now()->addDays(15);
        $UserCourseExpiry = StudentCourseModel::select('course_master.course_title','users.name','users.last_name','users.email','student_doc_verification.edu_is_approved','student_doc_verification.identity_is_approved')->Join('users','users.id','student_course_master.user_id')->Join('course_master','course_master.id','student_course_master.course_id')->leftJoin('student_doc_verification','student_doc_verification.student_id','users.id')->where('course_expired_on','<',$thresholdDate)->where('student_course_master.is_deleted','No')->where(function ($UserCourseExpiry) {
            $UserCourseExpiry->where('student_course_master.exam_remark', '!=', '1')
                ->orWhereNull('student_course_master.exam_remark');
        })
        ->where(function ($UserCourseExpiry) {
            $UserCourseExpiry->where('student_course_master.exam_attempt_remain', '!=', 0)
                ->orWhere('student_course_master.exam_attempt_remain', '>', 0);
        })->get();

        foreach($UserCourseExpiry as $expiryCourse){
            $VerifyDocument = "";
            if($expiryCourse->identity_is_approved == 'Pending' || $expiryCourse->edu_is_approved == "Pending"){
                $VerifyDocument = "If your document verification is still pending, kindly verify your required documents. If your documents have already been verified, please ignore this part of the message.";
            }
            $unsubscribeRoute = url('/unsubscribe/'.base64_encode($expiryCourse->email));
            mail_send(
                50,
                [
                    '#Name#',
                    "#CourseName#",
                    "#VerifyDocument#",
                    '#unsubscribeRoute#'
                ],
                [
                    $expiryCourse->name." ".$expiryCourse->last_name,
                    $expiryCourse->course_title,
                    $VerifyDocument,
                    $unsubscribeRoute
                ],
                $expiryCourse->email
            );
        }
    }
}
