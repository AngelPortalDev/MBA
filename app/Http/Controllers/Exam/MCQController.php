<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};
use App\Models\ExamRemarkMaster;
use App\Models\User;
use File;
use App\Models\Notification;
use App\Notifications\SendNotification;

class MCQController extends Controller
{
    
    public function mcqView(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $user_id = Auth::user()->id;
            $mcq_id  = isset($req->id) ? base64_decode($req->input('id')) : 0;
            $course_id  = isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;
            $validate_rules = [
                'id' => 'required|string',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (is_exist('exam_mcq', ['id' => $mcq_id, 'is_deleted' => 'No']) > 0) {
                $where = [
                    'id' => $mcq_id,
                    'is_deleted' => 'No',
                ];
                $examDetails = $this->mcqModule->getMcqDetails($where);
                if(count($examDetails)>0){
                    return json_encode(['code' => 200, 'data' => $examDetails]);
                }else {
                    return json_encode(['code' => 202, 'title' => 'Something Went Wrong', 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "MCQ not Exist", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error")]);
        }
    }
    
    public function mcqSubmit(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check() ) {
            $user_id = Auth::user()->id;
            $mcq_id  = isset($req->mcq_id) ? base64_decode($req->input('mcq_id')) : 0;
            $course_id  = isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;
            $question  = isset($req->question_id) && is_array($req->question_id) ? $req->input('question_id') : [];
            $student_course_master_id  = isset($req->student_course_master_id) ? base64_decode($req->input('student_course_master_id')) : 0;
            $type = isset($req->type) ? $req->type : '';
            $studentCourseMaster = getData('student_course_master', ['course_id'], ['id' => $student_course_master_id]);
            $examTitle = getExamTitle(7, $mcq_id);

            if(isset($studentCourseMaster[0]->course_id)){
                if($studentCourseMaster[0]->course_id != $course_id){
                    $master_course_id = $studentCourseMaster[0]->course_id;
                }
            }

            $validate_rules = [
                'question_id' => 'required',
                'mcq_id' => 'required|string',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                $mcqExist = is_exist('exam_mcq', ['id' => $mcq_id, 'is_deleted' => 'No']);
                if (isset($mcqExist) && is_numeric($mcqExist) && $mcqExist > 0) {
                    try {
                        if (count($question) > 0) {
                            $i = 0;
                            $ans = [];
                            $ques_id = [];
                            $CorrectCheck = 0;
                            $obtainMarks = 0;
                            $totalMarks = 0;
                            DB::beginTransaction();

                            foreach ($question as $key => $value) {
                                $n = $i + 1;
                                $answer =  $req->input("answer$n");
                                $ques_id = base64_decode($value);
                                $ansData = getData('exam_mcq_questions', ['question', 'answer', 'mark'], ['id' => $ques_id, 'is_deleted' => 'No']);
                                $correctAns = $ansData[0]->answer;
                                $ans = isset($answer[0]) && is_numeric($answer[0]) && !empty($answer[0]) ? (int) $answer[0] : 0;
                                $CorrectCheck += $ans === $correctAns ? 1 : 0;
                                $obtainMarks += $ans === $correctAns ? $ansData[0]->mark : 0;
                                $totalMarks += $ansData[0]->mark;
                                
                                $select = [
                                    'student_course_master_id' => $student_course_master_id,
                                    'type' => $type,
                                    'user_id' => $user_id,
                                    'course_id' => $course_id,
                                    'question_id' => $ques_id,
                                    'mark' => $ans === $correctAns ? $ansData[0]->mark : 0,
                                    'last_updated_by' => $user_id,
                                    'created_at' =>  $this->time,
                                ];
                                $where = [
                                    'student_course_master_id' => $student_course_master_id,
                                    'user_id' => $user_id,
                                    'course_id' => $course_id,
                                    'question_id' => $ques_id,
                                    'is_active' => '1',
                                ];
                                // $updateCourse = processData(['exam_mcq_answers', 'id'], $select, $where);
                                $updateCourse = saveData($this->mcqAnswers, $select, $where);
                                if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                    $i++;
                                }
                            }
                            
                            if ($i > 0) {

                                $mcqData = getData('exam_mcq', ['percentage'], ['id' => $mcq_id, 'is_deleted' => 'No']);
                                $obtainPercantage = ( $obtainMarks / $totalMarks) * $mcqData[0]->percentage;

                                $select = ['user_id' => $user_id, 'course_id' => $course_id, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $mcq_id, 'exam_type' => 7, 'submitted_on' => $this->time, 'created_at' => $this->time, 'is_cheking_completed' => '2', 'final_score_obtain' => $obtainMarks, 'final_obtain_percentage' => $obtainPercantage ];
                                $where =  ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'exam_id' => $mcq_id, 'exam_type' => 7, 'is_active' => '1'];

                                $exam_mcq = getData('exam_mcq', ['exam_duration'], ['id' => $mcq_id]);
                                if($exam_mcq[0]->exam_duration != null) {
                                    unset($select['created_at']);
                                }
                                $examRemarkMaster = getData('exam_remark_master', ['created_at', 'submitted_on'], ['user_id' => $user_id, 'course_id' => $course_id, 'exam_id' => $mcq_id, 'exam_type' => 7, 'is_active' => '1', 'student_course_master_id' => $student_course_master_id]);
                                if(isset($examRemarkMaster[0])){
                                    if($examRemarkMaster[0]->submitted_on > $examRemarkMaster[0]->created_at ){
                                        DB::rollback();
                                        return json_encode(['code' => 200, 'title' => "Already submitted", "message" => "Already submitted", "icon" => generateIconPath("error"), "redirect" => (isset($req->master_course_id) ? $req->input('master_course_id'): base64_encode($course_id)) . '/' . base64_encode($student_course_master_id)]);
                                    }
                                }

                                // $updateCourse = processData(['exam_remark_master', 'id'], $select, $where);
                                $updateCourse = saveData($this->ExamRemark, $select, $where);
                                if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                    DB::commit();
    
                                    // $examManagementMaster = getCourseExamCount(base64_encode($course_id));
                                    
                                    // $examRemarkMasters = ExamRemarkMaster::where([
                                    //     'course_id' => $course_id,
                                    //     'user_id' => $user_id,
                                    //     'is_active' => '1',
                                    // ])->count();
                                    
                                    // $eportfolio = DB::table('exam_eportfolio')->where([
                                    //     'exam_eportfolio.user_id' => $user_id,
                                    //     'exam_eportfolio.course_id' => $course_id,
                                    // ])->count();
                                    
                                    // $courseData = getData('course_master', ['ementor_id', 'course_title'], ['id' => $course_id]);
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
                                    //         (isset($examTitle) && $examTitle !== null ? $examTitle : 'MCQ'),
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
                                    //     '#Exam#' => (isset($examTitle) && $examTitle !== null ? $examTitle : 'MCQ'),
                                    //     '#Course Name#' => $courseData[0]->course_title,
                                    //     '#Submission Date#' => now()->format('Y-m-d'),
                                    //     '#unsubscribeRoute#' => $ementorData[0]->email
                                    // ];
                                    
                                    // mail_send(43, array_keys($mailData), array_values($mailData), $recipientEmail, $ccEmail);


                                    // mail_send(43, 
                                    //     [
                                    //         '#EmentorName#',
                                    //         '#StudentName#',
                                    //         '#Exam#',
                                    //         '#Course Name#',
                                    //         '#Submission Date#',
                                    //         '#unsubscribeRoute#',
                                    //     ], 
                                    //     [
                                    //         $ementorData[0]->name. " ".$ementorData[0]->last_name,
                                    //         Auth::user()->name. " ".Auth::user()->last_name,
                                    //         "MCQ's",
                                    //         $courseData[0]->course_title,
                                    //         now()->format('Y-m-d'),
                                    //         $ementorData[0]->email
                                    //     ], 
                                    //     $ementorData[0]->email
                                    // );
                                    
                                    // $mentorIds = User::where('id', $ementorId)->pluck('id')->toArray();
                                    // $data = [
                                    //     'student_name' => Auth::user()->name. " ".Auth::user()->last_name,
                                    //     'student_id' => base64_encode(Auth::user()->id),
                                    //     'student_course_master_id' => base64_encode($student_course_master_id), 
                                    //     'exam_type' => '7',
                                    //     'exam_name' => (isset($examTitle) && $examTitle !== null ? $examTitle : 'MCQ'),
                                    //     'course_name' => $courseData[0]->course_title,
                                    //     'exam_id' => base64_encode($updateCourse['id']),
                                    //     'read' => false,
                                    // ];

                                    // $mentorIds[] = $subEmentorId;
                                    // sendNotification($mentorIds, $data);
                                    
                                    // if (isset($examManagementMaster) && isset($examRemarkMasters) && $examManagementMaster == $examRemarkMasters && $eportfolio > 4) {
                                    
                                    //     $unsubscribeRoute = url('/unsubscribe/'.base64_encode(Auth::user()->email));
                                        // mail_send(34, 
                                        //     [
                                        //         '#Name#',
                                        //         '#Course Name#',
                                        //         '#unsubscribeRoute#',
                                        //     ], 
                                        //     [
                                        //         Auth::user()->name. " ".Auth::user()->last_name,
                                        //         $courseData[0]->course_title,
                                        //         $unsubscribeRoute
                                        //     ], 
                                        //     Auth::user()->email
                                        // );
                                    // }

                                    // isset($req->master_course_id) ? session(['exam_type' => 'content7-'.$course_id]) : session(['exam_type' => 'content7']);
                                    
                                    // isset($master_course_id) ? session(['exam_type' => 'content7-'.isset($master_course_id) ? $master_course_id : $course_id .'-'.$req->index]) : session(['exam_type' => 'content7-'.$req->index]);
                                    // isset($master_course_id) ? session(['exam_type' => 'content7-' . $course_id . '-' . $req->index]) : session(['exam_type' => 'content7-' . $req->index]);
                                    
                                    $studentCourseMaster = getData('student_course_master', ['course_id'], ['id' => $student_course_master_id]);

                                    $examType = ($studentCourseMaster[0]->course_id == $course_id)
                                            ? 'content7-' . $req->index
                                            : 'content7-' . $course_id . '-' . $req->index;
                                    

                                    session(['exam_type' => $examType]);
                                    
                                    if (session()->has('lastAnswerSubmit')) {
                                        session()->forget('lastAnswerSubmit');
                                    }
                                    
                                    if (session()->has('reflectiveJournalExamCourseId')) {
                                        session()->forget('reflectiveJournalExamCourseId');
                                    }
                                            
                                    if (session()->has('eportfolio')) {
                                        session()->forget('eportfolio');
                                    }

                                    
                                    return json_encode(['code' => 200, 'title' => "Submitted Successfully", "message" => (isset($examTitle) && $examTitle !== null ? $examTitle : 'MCQ') . " submitted successfully", "icon" => generateIconPath("success"), "redirect" => (isset($req->master_course_id) ? $req->input('master_course_id'): base64_encode($course_id)) . '/' . base64_encode($student_course_master_id)]);
                                }
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
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
}
