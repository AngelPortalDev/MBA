<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class VerifyDocument extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:document';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Please Upload Pending Documents.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    
    public function handle()
    {

        $userIds = DB::table('student_course_master')
            ->where('course_expired_on', '>' , now())
            ->pluck('user_id')
            ->unique()
            ->toArray();

        $students = [];

        foreach ($userIds as $userId) {
            $student = DB::table('student_doc_verification')
                ->where('student_id', $userId)
                ->where(function ($query) {
                    $query->where('identity_is_approved', '!=', 'Approved')
                        ->orWhere('edu_is_approved', '!=', 'Approved')
                        ->orWhere(function($query) {
                            $query->whereNull('resume_file')
                                  ->orWhere('resume_file', '=', '');
                        });
                        
                })
                ->select('student_id', 'identity_is_approved', 'edu_is_approved', 'resume_file', 'identity_trail_attempt', 'edu_trail_attempt')
                ->first();

            if ($student) {
                $students[] = $student;
                $user = DB::table('users')
                    ->where('id', $student->student_id)
                    ->where(function ($query) {
                        $query->whereNotNull('email_verified_at')
                              ->where('email_verified_at', '!=', '');
                    })
                    ->where('is_active', 'Active')
                    ->select('email', 'name', 'last_name')
                    ->first();

                if ($user) {
                    $unsubscribeRoute = url('/unsubscribe/'.base64_encode($user->email));
                    $verifyDocumentLink = url('/student/student-document-verification');
                    
                    $placeholders = [
                        '#Name#',
                        '#Link#',
                        '#unsubscribeRoute#'
                    ];
                    
                    $values = [
                        $user->name . ' ' . $user->last_name,
                        $verifyDocumentLink,
                        $unsubscribeRoute
                    ];
                    mail_send(24, $placeholders, $values, $user->email);
                }
            }
        }
    }
}
