<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,  Validator, DB};
use App\Rules\WordCount;
use App\Models\ExamRemarkMaster;
use App\Models\User;
use File;
use App\Models\Notification;
use App\Notifications\SendNotification;

class PeerReviewController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function peerReviewSubmit(Request $req)
    {

        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $actionType = $req->input('actionType');
            $user_id = Auth::user()->id;
            $exam_id  = isset($req->exam_id) ? base64_decode($req->input('exam_id')) : 0;
            $exam_type  = isset($req->exam_type) ? base64_decode($req->input('exam_type')) : 0;
            $answer  = isset($req->answer) && !empty($req->answer) ? $req->input('answer') : '';
            $student_course_master_id  = isset($req->student_course_master_id) ? base64_decode($req->input('student_course_master_id')) : 0;
            $type  = isset($req->type) ? $req->input('type') : '';
            $examTitle = getExamTitle(4, $exam_id);
            $has_accepted_exam_instructions = $req->has_accepted_exam_instructions == 'true' ? 1 : 0;

            $validate_rules = [
                'answer' => 'nullable',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                $examExit = is_exist('exam_peer_review', ['id' => $exam_id, 'is_deleted' => 'No']);
                if (isset($examExit) && is_numeric($examExit) && $examExit > 0) {
                    $course = getData('exam_peer_review', ['award_id'], ['id' => $exam_id, 'is_deleted' => 'No']);
                    $course_id = isset($course[0]->award_id) ? $course[0]->award_id : 0;
                    $courseExpired = is_expired(['user_id' => $user_id, 'course_id' => isset($req->master_course_id) ? base64_decode($req->input('master_course_id')): $course_id]);
                    if (isset($courseExpired) && is_numeric($courseExpired) && $courseExpired > 0) {

                        try {
                            $rules = [];
                            $i = 0;
                        
                            $validator = Validator::make($req->all(), $rules);
                            if ($validator->fails()) {
                                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $validator->errors()]);

                            }

                            $select = [
                                'student_course_master_id' => $student_course_master_id,
                                'type' => $type,
                                'user_id' => $user_id,
                                'course_id' => $course_id,
                                'answer' => $answer,
                                'last_updated_by' => $user_id,
                                'created_at' =>  $this->time
                            ];

                            $where = [
                                'student_course_master_id' => $student_course_master_id,
                                'type' => $type,
                                'user_id' => $user_id,
                                'course_id' => $course_id,
                                'is_active' => '1',
                            ];


                            // $updateCourse = processData(['exam_peer_review_answers', 'id'], $select, $where);
                            $updateCourse = saveData($this->peerReviewAnswers, $select, $where);
                            if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                $i++;
                                if($actionType == 'draft'){
                                    isset($req->master_course_id) ? session(['exam_type' => 'content4-'.$course_id.'-'.$req->index]) : session(['exam_type' => 'content4-'.$req->index]);

                                    return json_encode(['code' => 200, 'title' => "Saved as Draft", "message" => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Peer Review') . " has been successfully saved as a draft.", "icon" => generateIconPath("success")]);
                                }
                            }

                            if ($i > 0) {

                                $select = ['user_id' => $user_id, 'course_id' => $course_id, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam_id, 'exam_type' => 4, 'submitted_on' => $this->time, 'created_at' => $this->time, 'has_accepted_exam_instructions' => $has_accepted_exam_instructions];
                                $where =  ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'exam_id' => $exam_id, 'exam_type' => 4, 'is_active' => '1'];
                                // $updateCourse = processData(['exam_remark_master', 'id'], $select, $where);
                                $updateCourse = saveData($this->ExamRemark, $select, $where);
                                if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                    DB::commit();
                                    
                                    // $examManagementMaster = DB::table('exam_management_master')->where(['course_id' => $course_id, 'is_deleted' => 'No'])->where('exam_type' , '!=', '5')->count();
                                    
                                    // $examRemarkMasters = ExamRemarkMaster::where([
                                    //     'course_id' => $course_id,
                                    //     'user_id' => $user_id,
                                    //     'is_active' => '1',
                                    // ])->latest()->count();
                                    
                                    // $eportfolio = DB::table('exam_eportfolio')->where([
                                    //     'exam_eportfolio.user_id' => $user_id,
                                    //     'exam_eportfolio.course_id' => $course_id,
                                    // ])->count();
                                    
                                    // $courseData = getData('course_master', ['ementor_id', 'course_title', 'id'], ['id' => $course_id]);
                                    // $unsubscribeRoute = url('/unsubscribe/'.base64_encode(Auth::user()->email));
                                    // mail_send(42, 
                                    //     [
                                    //         '#Name#',
                                    //         '#Exam#',
                                    //         '#Course Name#',
                                    //         '#unsubscribeRoute#',
                                    //     ], 
                                    //     [
                                    //         Auth::user()->name. " ".Auth::user()->last_name,
                                    //         (isset($examTitle) && $examTitle !== null ? $examTitle : 'Peer Review'),
                                    //         $courseData[0]->course_title,
                                    //         $unsubscribeRoute
                                    //     ], 
                                    //     Auth::user()->email
                                    // );
                                    
                                    // $subEmentorId = getAssignedSubMentor($user_id, $course_id, $student_course_master_id);
                                    // $ementorId = isset($courseData[0]->ementor_id) ? $courseData[0]->ementor_id : 0;
                                    // $ementorData = getData('users', ['name', 'last_name', 'email'], ['id' => $ementorId]);
                                    
                                    // $recipientEmail = $ementorData[0]->email;
                                    // $ccEmail = null;
                                    
                                    // if ($subEmentorId) {
                                    //     $subEmentorData = getData('users', ['name', 'last_name', 'email'], ['id' => $subEmentorId]);
                                    //     $recipientEmail = $subEmentorData[0]->email;
                                    //     $ccEmail = $ementorData[0]->email;
                                    // }
                                    
                                    // $mailData = [
                                    //     '#EmentorName#' => $subEmentorId ? $subEmentorData[0]->name . " " . $subEmentorData[0]->last_name : $ementorData[0]->name . " " . $ementorData[0]->last_name,
                                    //     '#StudentName#' => Auth::user()->name . " " . Auth::user()->last_name,
                                    //     '#Exam#' => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Peer Review'),
                                    //     '#Course Name#' => $courseData[0]->course_title,
                                    //     '#Submission Date#' => now()->format('Y-m-d'),
                                    //     '#unsubscribeRoute#' => $ementorData[0]->email
                                    // ];
                                    
                                    // mail_send(43, array_keys($mailData), array_values($mailData), $recipientEmail, $ccEmail);

                                    // $mentorIds = User::where('id', $ementorId)->pluck('id')->toArray();
                                    // $data = [
                                    //     'student_name' => Auth::user()->name. " ".Auth::user()->last_name,
                                    //     'student_id' => base64_encode(Auth::user()->id),
                                    //     'student_course_master_id' => base64_encode($student_course_master_id),
                                    //     'exam_type' => '4',
                                    //     'exam_name' => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Peer Review'),
                                    //     'course_name' => $courseData[0]->course_title,
                                    //     'exam_id' => base64_encode($updateCourse['id']),
                                    //     'read' => false,
                                    // ];

                                    // $mentorIds[] = $subEmentorId;
                                    // sendNotification($mentorIds, $data);
                                    
                                    // if (isset($examManagementMaster) && isset($examRemarkMasters) && $examManagementMaster == $examRemarkMasters && $eportfolio > 4) {
                                    
                                    //     $unsubscribeRoute = url('/unsubscribe/'.base64_encode(Auth::user()->email));
                                    //     mail_send(34, 
                                    //         [
                                    //             '#Name#',
                                    //             '#Course Name#',
                                    //             '#unsubscribeRoute#',
                                    //         ], 
                                    //         [
                                    //             Auth::user()->name. " ".Auth::user()->last_name,
                                    //             $courseData[0]->course_title,
                                    //             $unsubscribeRoute
                                    //         ], 
                                    //         Auth::user()->email
                                    //     );
                                    // }

                                    isset($req->master_course_id) ? session(['exam_type' => 'content4-'.$course_id.'-'.$req->index]) : session(['exam_type' => 'content4-'.$req->index]);
                                    
                                    if (session()->has('lastAnswerSubmit')) {
                                        session()->forget('lastAnswerSubmit');
                                    }
                                    
                                    if (session()->has('reflectiveJournalExamCourseId')) {
                                        session()->forget('reflectiveJournalExamCourseId');
                                    }
                                            
                                    if (session()->has('eportfolio')) {
                                        session()->forget('eportfolio');
                                    }


                                    return json_encode(['code' => 200, 'title' => "Submitted Successfully", "message" => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Peer Review') . " submitted successfully", "icon" => generateIconPath("success")]);
                                }
                            }
                            DB::rollback();
                            return json_encode(['code' => 201, 'title' => "Unable to submit exam", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error")]);
                        } catch (\Throwable $th) {
                            return $th;
                            DB::rollback();
                            return json_encode(['code' => 201, 'title' => "Unable to submit exam", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error")]);
                        }
                    } else {
                        return json_encode(['code' => 201, 'title' => 'Course not exist or expired', 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                    }
                } else {
                    return json_encode(['code' => 404, 'title' => 'Exam not Exist', 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                }
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
}
