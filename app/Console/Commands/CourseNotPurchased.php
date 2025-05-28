<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CourseNotPurchased extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course:notpurchase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Course Not Purchase';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        $studentIds = DB::table('cart')->join('users', 'users.id', 'cart.student_id')->where(['cart.status' => 'Inactive', 'users.is_active' => 'Active'])->pluck('student_id')->unique();
        
        foreach ($studentIds as $studentId) {
            $courses = DB::table('cart')
                ->where('student_id', $studentId)
                ->join('course_master', 'cart.course_id', '=', 'course_master.id')
                ->select('course_master.course_title')
                ->get();

            $student = DB::table('users')
                ->where('id', $studentId)
                ->where(function ($query) {
                    $query->whereNotNull('email_verified_at')
                          ->where('email_verified_at', '!=', '');
                })
                ->select('name', 'last_name', 'email')
                ->first();

            if ($student && $courses->isNotEmpty()) {
                $unsubscribeRoute = url('/unsubscribe/'.base64_encode($student->email));
                foreach ($courses as $course) {
                    mail_send(
                        29,
                        [
                            '#Name#',
                            '#[Course Name]#',
                            '#[Portal Link]#',
                            '#[Contact Email]#',
                            '#unsubscribeRoute#',
                        ],
                        [
                            $student->name . ' ' . $student->last_name,
                            $course->course_title,
                            '<a href="http://eascencia.mt/"><strong>https://eascencia.mt </strong></a>',
                            'support@eascencia.mt',
                            $unsubscribeRoute
                        ],
                        $student->email
                    );
                }
            }
        }
    }
}
