<?php

namespace App\Observers;

use App\Models\CertificateIssue;
use App\Models\StudentCourseModel;

class CertificateIssueObserver
{
    /**
     * Handle the CertificateIssue "created" event.
     *
     * @param  \App\Models\CertificateIssue  $certificateIssue
     * @return void
     */
    public function created(CertificateIssue $certificateIssue)
    {
        //
    }

    /**
     * Handle the CertificateIssue "updated" event.
     *
     * @param  \App\Models\CertificateIssue  $certificateIssue
     * @return void
     */
    public function updated(CertificateIssue $certificateIssue)
    {
        if ($certificateIssue->isDirty('transferred_on') && !is_null($certificateIssue->transferred_on)) {
            \Log::info('Transferred On Updated: ' . $certificateIssue->transferred_on);

            $studentCourse = \DB::table('student_course_master')
                ->where('id', $certificateIssue->student_course_master_id)
                ->first();

            $data = [
                'certificate_issued_on' => now()
            ];

            $studentCourseMaster = saveData(new StudentCourseModel, $data, ['id' => $certificateIssue->student_course_master_id]);
            
            if ($studentCourse) {
                $user = \DB::table('users')->where('id', $studentCourse->user_id)->first();
                $course = \DB::table('course_master')->where('id', $studentCourse->course_id)->first();

                if ($user && $course) {
                    $studentName = $user->name . ' ' . $user->last_name;
                    $studentEmail = $user->email;
                    $courseTitle = $course->course_title;

                    \Log::info("Student: $studentName, Course: $courseTitle, Email: $studentEmail");

                    $videoUrl = "https://iframe.mediadelivery.net/play/364822/48d210d1-d6b2-4e1e-a2f7-7bf91d2174ed";

                    mail_send(
                        52,
                        [
                            '#Student Name#',
                            '#Video Link#',
                            '#Address#',
                            '#TokenId#',
                        ],
                        [
                            $studentName,
                            $videoUrl,
                            $certificateIssue->smartContract,
                            $certificateIssue->tokenId,
                        ],
                        $studentEmail
                    );

                    \Log::info('Email sent to ' . $studentEmail);
                } else {
                    \Log::warning('User or Course not found for CertificateIssue ID: ' . $certificateIssue->id);
                }
            } else {
                \Log::warning('StudentCourseMaster not found for CertificateIssue ID: ' . $certificateIssue->id);
            }
        }
    }


    /**
     * Handle the CertificateIssue "deleted" event.
     *
     * @param  \App\Models\CertificateIssue  $certificateIssue
     * @return void
     */
    public function deleted(CertificateIssue $certificateIssue)
    {
        //
    }

    /**
     * Handle the CertificateIssue "restored" event.
     *
     * @param  \App\Models\CertificateIssue  $certificateIssue
     * @return void
     */
    public function restored(CertificateIssue $certificateIssue)
    {
        //
    }

    /**
     * Handle the CertificateIssue "force deleted" event.
     *
     * @param  \App\Models\CertificateIssue  $certificateIssue
     * @return void
     */
    public function forceDeleted(CertificateIssue $certificateIssue)
    {
        //
    }
}
