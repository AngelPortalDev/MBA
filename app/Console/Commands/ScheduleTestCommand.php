<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ScheduleTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedular:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userIds[] = 138;
        $students = [];

        foreach ($userIds as $userId) {
            $student = DB::table('student_doc_verification')
                ->where('student_id', $userId)
                ->where(function ($query) {
                    $query->where('identity_is_approved', '!=', 'Approved')
                        ->orWhere('edu_is_approved', '!=', 'Approved')
                        ->orWhere(function($query) {
                            $query->whereNotNull('resume_file')
                                  ->where('resume_file', '!=', '');
                        });
                })
                ->select('student_id', 'identity_is_approved', 'edu_is_approved', 'resume_file', 'identity_trail_attempt', 'edu_trail_attempt')
                ->first();

            if ($student) {
                $students[] = $student;
                $user = DB::table('users')
                    ->where('id', $student->student_id)
                    ->select('email', 'name', 'last_name')
                    ->first();

                if ($user) {
                    $identityApproved = $student->identity_is_approved === 'Approved';
                    $eduApproved = $student->edu_is_approved === 'Approved';
                    $resumeUpload = !empty($student->resume_file);

                    $unsubscribeRoute = url('/unsubscribe/'.base64_encode($user->email));
                    $placeholders = [
                        '#Identity : Please note that you have 3attempt attempts to upload this documents.#',
                        '#Edu : Please note that you have 2attempt attempts to upload this documents.#',
                        '3attempt',
                        '2attempt',
                        '#Name#',
                        '#Identity Proof: Not Submitted#',
                        '#Education Proof: Not Submitted#',
                        '#Resume: Not Uploaded#',
                        '#unsubscribeRoute#'
                    ];
                    
                    $values = [
                        !$identityApproved ? 'Please note that you have 3attempt attempts to upload this documents.' : '',
                        !$eduApproved ? 'Please note that you have 2attempt attempts to upload this documents.' : '',
                        $student->identity_trail_attempt,
                        $student->edu_trail_attempt,
                        $user->name . ' ' . $user->last_name,
                        !$identityApproved ? 'Identity Proof: Not Submitted' : 'Identity Proof: Submitted',
                        !$eduApproved ? 'Education Proof: Not Submitted' : 'Education Proof: Submitted',
                        !$resumeUpload ? 'Resume: Not Uploaded' : 'Resume: Uploaded',
                        $unsubscribeRoute
                    ];
                    
                    if (!$identityApproved || !$eduApproved || !$resumeUpload) {
                        mail_send(24, $placeholders, $values, $user->email);
                    }
                    
                }
            }
        }
        
        $studentsNotInCartOrCourseMaster = DB::table('users')
            ->where('id', 138)
            ->get();
            
        foreach ($studentsNotInCartOrCourseMaster as $student) {
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
        }
        
        $studentIds[] = 138;
        
        foreach ($studentIds as $studentId) {
            $courses = DB::table('cart')
                ->where('student_id', $studentId)
                ->join('course_master', 'cart.course_id', '=', 'course_master.id')
                ->select('course_master.course_title')
                ->get();

            $student = DB::table('users')
                ->where('id', $studentId)
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
                            '<a class="text-decoration-none text-dark" href="mailto:support@eascencia.mt">support@eascencia.mt.</a>',
                            $unsubscribeRoute
                        ],
                        $student->email
                    );
                }
            }
        }
    }
}
