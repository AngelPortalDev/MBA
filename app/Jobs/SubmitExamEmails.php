<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\ExamRemarkMaster;
use App\Models\User;
use Illuminate\Support\Facades\{Auth,  Validator, DB, Log};

class SubmitExamEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $examRemarkMaster;
    public $auth;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    
    public function __construct(ExamRemarkMaster $examRemarkMaster, $auth)
    {
        $this->examRemarkMaster = $examRemarkMaster;
        $this->auth = $auth;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $examRemarkMaster = $this->examRemarkMaster;
        $auth = $this->auth;

        DB::beginTransaction();
        \Log::info('Executing');
    
        try {
            // Get the exam title
            $examTitle = getExamTitle($examRemarkMaster->exam_type, $examRemarkMaster->exam_id);
    
            // Retrieve course data
            $courseData = getData('course_master', ['ementor_id', 'course_title', 'id'], ['id' => $examRemarkMaster->course_id]);
    
            // Email 1: Send to the student
            $unsubscribeRoute = url('/unsubscribe/' . base64_encode($auth->email));
            mail_send(
                42,
                ['#Name#', '#Exam#', '#Course Name#', '#unsubscribeRoute#'],
                [
                    $auth->name . " " . $auth->last_name,
                    $examTitle ?: 'Assignment',
                    $courseData[0]->course_title,
                    $unsubscribeRoute
                ],
                $auth->email
            );
    
            // Email 2: Send to eMentor or sub eMentor
            $subEmentorId = getAssignedSubMentor($examRemarkMaster->student_course_master_id);
            $ementorId = $courseData[0]->ementor_id ?? 0;
    
            $ementorData = getData('users', ['name', 'last_name', 'email'], ['id' => $ementorId]);
            $recipientEmail = $ementorData[0]->email;
            $ccEmail = null;
    
            if ($subEmentorId) {
                $subEmentorData = getData('users', ['name', 'last_name', 'email'], ['id' => $subEmentorId]);
                $recipientEmail = $subEmentorData[0]->email;
                $ccEmail = $ementorData[0]->email;
            }
    
            $mailData = [
                '#EmentorName#' => $subEmentorId
                    ? $subEmentorData[0]->name . " " . $subEmentorData[0]->last_name
                    : $ementorData[0]->name . " " . $ementorData[0]->last_name,
                '#StudentName#' => $auth->name . " " . $auth->last_name,
                '#Exam#' => $examTitle ?: 'Assignment',
                '#Course Name#' => $courseData[0]->course_title,
                '#Submission Date#' => now()->format('Y-m-d'),
                '#unsubscribeRoute#' => $ementorData[0]->email
            ];
    
            mail_send(43, array_keys($mailData), array_values($mailData), $recipientEmail, $ccEmail);
    
            // Notification to mentors
            $mentorIds = User::where('id', $ementorId)->pluck('id')->toArray();
            $data = [
                'student_name' => $auth->name . " " . $auth->last_name,
                'student_id' => base64_encode($auth->id),
                'student_course_master_id' => base64_encode($examRemarkMaster->student_course_master_id),
                'exam_type' => $examRemarkMaster->exam_type,
                'exam_name' => $examTitle ?: 'Assignment',
                'course_name' => $courseData[0]->course_title,
                'exam_id' => base64_encode($examRemarkMaster->id),
                'read' => false,
            ];
            $mentorIds[] = $subEmentorId;
            sendNotification($mentorIds, $data);
    
            // Email 3: Assessment Complete
            // $examManagementMaster = getCourseExamCount(base64_encode($examRemarkMaster->course_id));
            
            // $course_id  = isset($examRemarkMaster->course_id) ? $examRemarkMaster->course_id : 0;
            $course_id = DB::table('student_course_master')->where('id', $examRemarkMaster->student_course_master_id)->value('course_id');
            $courseMaster = getData('course_master', ['category_id', 'course_title'], ['id' => $course_id]);

            if ($courseMaster[0]->category_id != 1) {
                $courseIds = DB::table('master_course_management')
                            ->where('award_id', $course_id)
                            ->where('is_deleted', 'No')
                            ->pluck('course_id');

                $examManagementMaster = DB::table('exam_management_master')
                            ->whereIn('course_id', $courseIds)
                            ->where(['is_deleted' => 'No'])
                            ->where('exam_type', '!=', 5)
                            ->count();
            } else {
                $examManagementMaster = DB::table('exam_management_master')
                            ->where(['course_id' => $course_id, 'is_deleted' => 'No'])
                            ->where('exam_type', '!=', 5)
                            ->count();
            }
            
            $examRemarkMasters = ExamRemarkMaster::where([
                'student_course_master_id' => $examRemarkMaster->student_course_master_id,
                'user_id' => $examRemarkMaster->user_id,
                'is_active' => '1',
            ])->count();

            if ($courseMaster[0]->category_id != 1) {
                if ($examManagementMaster == $examRemarkMasters && $eportfolio > 4) {
                    

                    $allEportfolioSubmitted = true;

                    foreach ($courseIds as $course_id) {

                        $eportfolioCount = DB::table('exam_eportfolio')
                            ->where('student_course_master_id', $examRemarkMaster->student_course_master_id)
                            ->where('user_id', Auth::user()->id)
                            ->where('course_id', $course_id)
                            ->count();

                        if ($eportfolioCount < 5) {
                            $allEportfolioSubmitted = false;
                            break;
                        }
                    }

                    if ($examManagementMaster == $examRemarkMasters && $allEportfolioSubmitted) {
                        mail_send(
                            34,
                            ['#Name#', '#Course Name#', '#unsubscribeRoute#'],
                            [
                                $auth->name . " " . $auth->last_name,
                                $courseMaster[0]->course_title,
                                $unsubscribeRoute
                            ],
                            $auth->email
                        );
                    }
                }
            }else{
    
                $eportfolio = DB::table('exam_eportfolio')->where([
                    'user_id' => $examRemarkMaster->user_id,
                    'student_course_master_id' => $examRemarkMaster->student_course_master_id,
                ])->count();

                if ($examManagementMaster == $examRemarkMasters && $eportfolio > 4) {
                    mail_send(
                        34,
                        ['#Name#', '#Course Name#', '#unsubscribeRoute#'],
                        [
                            $auth->name . " " . $auth->last_name,
                            $courseMaster[0]->course_title,
                            $unsubscribeRoute
                        ],
                        $auth->email
                    );
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to handle created event for ExamRemarkMaster: ' . $e->getMessage() . ' on line ' . $e->getLine());
        }
    }
}