<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CourseNotEnrolled extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course:notenrolled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Course Not Enrolled.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $allStudentIds = DB::table('users')->pluck('id')->toArray();

        $cartStudentIds = DB::table('cart')->pluck('student_id')->toArray();

        $studentCourseMasterIds = DB::table('student_course_master')->pluck('user_id')->toArray();

        $excludedStudentIds = array_merge($cartStudentIds, $studentCourseMasterIds);

        $studentsNotInCartOrStudentCourseMaster = DB::table('users')
            ->whereNotIn('id', $excludedStudentIds)
            ->where(function ($query) {
                $query->whereNotNull('email_verified_at')
                    ->where('email_verified_at', '!=', '');
            })
            ->where('is_active', 'Active')
            ->get();

        foreach ($studentsNotInCartOrStudentCourseMaster as $student) {
            $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));
            mail_send(
                45,
                [
                    '#Name#',
                    '#unsubscribeRoute#'
                ],
                [
                    $student->name." ".$student->last_name,
                    $unsubscribeRoute
                ],
                $student->email
            );
            
            // mail_send(
            //     30,
            //     [
            //         '#[Portal Link].#',
            //         '#[Contact Email].#',
            //         '#unsubscribeRoute#'
            //     ],
            //     [
            //         '<a href="http://eascencia.mt/"><strong>https://eascencia.mt </strong></a>',
            //         '<a class="text-decoration-none text-dark" href="mailto:support@eascencia.mt">support@eascencia.mt.</a>',
            //         $unsubscribeRoute
            //     ],
            //     $student->email
            // );
        }
    }
}
