<?php

namespace App\Observers;

use App\Models\ExamRemarkMaster;
use App\Models\User;
use Illuminate\Support\Facades\{Auth,  Validator, DB, Log};

use App\Jobs\SubmitExamEmails;

class ExamRemarkMasterObserver
{
    /**
     * Handle the ExamRemarkMaster "created" event.
     *
     * @param  \App\Models\ExamRemarkMaster  $examRemarkMaster
     * @return void
     */
    public function created(ExamRemarkMaster $examRemarkMaster)
    {
        
        $auth = Auth::user();
        SubmitExamEmails::dispatch($examRemarkMaster, $auth);
        
        // exam Submission event
            // DB::beginTransaction(); // Start the transaction
        
            // try {
            //     // Get the exam title
            //     $examTitle = getExamTitle($examRemarkMaster->exam_type, $examRemarkMaster->exam_id);
        
            //     // Retrieve course data
            //     $courseData = getData('course_master', ['ementor_id', 'course_title', 'id'], ['id' => $examRemarkMaster->course_id]);
        
            //     // Email 1: Send to the student
            //     $unsubscribeRoute = url('/unsubscribe/' . base64_encode(Auth::user()->email));
            //     mail_send(
            //         42,
            //         ['#Name#', '#Exam#', '#Course Name#', '#unsubscribeRoute#'],
            //         [
            //             Auth::user()->name . " " . Auth::user()->last_name,
            //             $examTitle ?: 'Assignment',
            //             $courseData[0]->course_title,
            //             $unsubscribeRoute
            //         ],
            //         Auth::user()->email
            //     );
        
            //     // Email 2: Send to eMentor or sub eMentor
            //     $subEmentorId = getAssignedSubMentor($examRemarkMaster->user_id, $examRemarkMaster->course_id, $examRemarkMaster->student_course_master_id);
            //     $ementorId = $courseData[0]->ementor_id ?? 0;
        
            //     $ementorData = getData('users', ['name', 'last_name', 'email'], ['id' => $ementorId]);
            //     $recipientEmail = $ementorData[0]->email;
            //     $ccEmail = null;
        
            //     if ($subEmentorId) {
            //         $subEmentorData = getData('users', ['name', 'last_name', 'email'], ['id' => $subEmentorId]);
            //         $recipientEmail = $subEmentorData[0]->email;
            //         $ccEmail = $ementorData[0]->email;
            //     }
        
            //     $mailData = [
            //         '#EmentorName#' => $subEmentorId
            //             ? $subEmentorData[0]->name . " " . $subEmentorData[0]->last_name
            //             : $ementorData[0]->name . " " . $ementorData[0]->last_name,
            //         '#StudentName#' => Auth::user()->name . " " . Auth::user()->last_name,
            //         '#Exam#' => $examTitle ?: 'Assignment',
            //         '#Course Name#' => $courseData[0]->course_title,
            //         '#Submission Date#' => now()->format('Y-m-d'),
            //         '#unsubscribeRoute#' => $ementorData[0]->email
            //     ];
        
            //     mail_send(43, array_keys($mailData), array_values($mailData), $recipientEmail, $ccEmail);
        
            //     // Notification to mentors
            //     $mentorIds = User::where('id', $ementorId)->pluck('id')->toArray();
            //     $data = [
            //         'student_name' => Auth::user()->name . " " . Auth::user()->last_name,
            //         'student_id' => base64_encode(Auth::user()->id),
            //         'student_course_master_id' => base64_encode($examRemarkMaster->student_course_master_id),
            //         'exam_type' => $examRemarkMaster->exam_type,
            //         'exam_name' => $examTitle ?: 'Assignment',
            //         'course_name' => $courseData[0]->course_title,
            //         'exam_id' => base64_encode($examRemarkMaster->id),
            //         'read' => false,
            //     ];
            //     $mentorIds[] = $subEmentorId;
            //     sendNotification($mentorIds, $data);
        
            //     // Email 3: Assessment Complete
            //     $examManagementMaster = getCourseExamCount(base64_encode($examRemarkMaster->course_id));
            //     $examRemarkMasters = ExamRemarkMaster::where([
            //         'course_id' => $examRemarkMaster->course_id,
            //         'user_id' => $examRemarkMaster->user_id,
            //         'is_active' => '1',
            //     ])->count();
        
            //     $eportfolio = DB::table('exam_eportfolio')->where([
            //         'user_id' => $examRemarkMaster->user_id,
            //         'course_id' => $examRemarkMaster->course_id,
            //     ])->count();
        
            //     if ($examManagementMaster == $examRemarkMasters && $eportfolio > 4) {
            //         mail_send(
            //             34,
            //             ['#Name#', '#Course Name#', '#unsubscribeRoute#'],
            //             [
            //                 Auth::user()->name . " " . Auth::user()->last_name,
            //                 $courseData[0]->course_title,
            //                 $unsubscribeRoute
            //             ],
            //             Auth::user()->email
            //         );
            //     }
        
            //     DB::commit(); // Commit the transaction
            // } catch (\Exception $e) {
            //     DB::rollBack(); // Rollback the transaction in case of failure
            //     Log::error('Failed to handle created event for ExamRemarkMaster: ' . $e->getMessage());
            // }
    }

    /**
     * Handle the ExamRemarkMaster "updated" event.
     *
     * @param  \App\Models\ExamRemarkMaster  $examRemarkMaster
     * @return void
     */
    public function updated(ExamRemarkMaster $examRemarkMaster)
    {

        if ($examRemarkMaster->exam_type == 7) {
            if ($examRemarkMaster->wasChanged('submitted_on')) {
                $auth = Auth::user();
                SubmitExamEmails::dispatch($examRemarkMaster, $auth);
            }
        }

        // Exam Reject
        if ($examRemarkMaster->isDirty('approved_status') && $examRemarkMaster->approved_status == 2) {
            $subEmentor = $examRemarkMaster->remark_updated_by;
            \Log::info($subEmentor);
        }
        
    }

    /**
     * Handle the ExamRemarkMaster "deleted" event.
     *
     * @param  \App\Models\ExamRemarkMaster  $examRemarkMaster
     * @return void
     */
    public function deleted(ExamRemarkMaster $examRemarkMaster)
    {
        //
    }

    /**
     * Handle the ExamRemarkMaster "restored" event.
     *
     * @param  \App\Models\ExamRemarkMaster  $examRemarkMaster
     * @return void
     */
    public function restored(ExamRemarkMaster $examRemarkMaster)
    {
        //
    }

    /**
     * Handle the ExamRemarkMaster "force deleted" event.
     *
     * @param  \App\Models\ExamRemarkMaster  $examRemarkMaster
     * @return void
     */
    public function forceDeleted(ExamRemarkMaster $examRemarkMaster)
    {
        //
    }
}
