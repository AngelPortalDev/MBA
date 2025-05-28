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

class AssignmentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function assignmentData()
    {

        if (Auth::check()) {
        $Data['AssignmentData'] = getData('exam_assignments', ['id',  'award_id'], ['award_id' => 2]);
            $Data['QuestionData'] = getData('exam_assignment_questions', ['id', 'question', 'assignment_mark'], ['assignments_id' => $Data['AssignmentData'][0]->id]);
            return view('frontend.exam.assignment', $Data);
        }
        return redirect()->route('login');
    }
    public function assignSubmit(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check() && count($req->input('question_id')) > 0) {
            $actionType = $req->input('actionType');
            $user_id = Auth::user()->id;
            $exam_id  = isset($req->exam_id) ? base64_decode($req->input('exam_id')) : 0;
            $exam_type  = isset($req->exam_type) ? base64_decode($req->input('exam_type')) : 0;
            $question  = isset($req->question_id) && is_array($req->question_id) ? $req->input('question_id') : [];
            $answers  = isset($req->answers) && is_array($req->answers) ? $req->input('answers') : [];
            $answer_limit  = isset($req->answer_limit) && is_array($req->answer_limit) ? $req->input('answer_limit') : [];
            $student_course_master_id  = isset($req->student_course_master_id) ? base64_decode($req->input('student_course_master_id')) : 0;
            $type = isset($req->type) ? $req->type : '';
            $examTitle = getExamTitle(1, $exam_id);
            $has_accepted_exam_instructions = $req->has_accepted_exam_instructions == 'true' ? 1 : 0;

            $validate_rules = [
                'question_id' => 'required|array',
                'answers' => 'required|array',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                $examExit = is_exist('exam_assignments', ['id' => $exam_id, 'is_deleted' => 'No']);
                if (isset($examExit) && is_numeric($examExit) && $examExit > 0) {
                    $course = getData('exam_assignments', ['award_id'], ['id' => $exam_id, 'is_deleted' => 'No']);
                    $course_id = isset($course[0]->award_id) ? $course[0]->award_id : 0;
        
                    $courseExpired = is_expired(['user_id' => $user_id, 'student_course_master.id' => $student_course_master_id]);
                    if (isset($courseExpired) && is_numeric($courseExpired) && $courseExpired > 0) {

                        try {
                            if (count($question) > 0) {
                                $i = 0;
                                DB::beginTransaction();
                                $rules = [];
                                $j=0;
                                foreach ($question as $questions) {
                                    $answer_limits = base64_decode($answer_limit[$j]);
                                    $rules["answers.$j"] = [new WordCount($answer_limits)];                            
                                    $j++;
                                }    
                            
                                $validator = Validator::make($req->all(), $rules);
                                if ($validator->fails()) {
                                    return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $validator->errors()]);

                                }

                                foreach ($question as $questions) {
                                    $questions_id =  base64_decode($questions);
                                    $select = [
                                        'student_course_master_id' => $student_course_master_id,
                                        'type' => $type,
                                        'user_id' => $user_id,
                                        'course_id' => $course_id,
                                        'question_id' => $questions_id,
                                        'answer' => $answers[$i],
                                        'last_updated_by' => $user_id,
                                        'created_at' =>  $this->time
                                    ];

                                    
                                    $examDurationExist = DB::table('exam_assignments')->where(['id' => $exam_id, 'is_deleted' => 'No'])->whereNotNull('exam_duration')->get();
                                    if ($examDurationExist) {
                                        $select['exam_end_time'] = now();
                                    }
                                    
                                    $where = [
                                        'student_course_master_id' => $student_course_master_id,
                                        'type' => $type,
                                        'user_id' => $user_id,
                                        'course_id' => $course_id,
                                        'question_id' => $questions_id,
                                        'is_active' => '1',
                                    ];
                                    // $updateCourse = processData(['exam_assignment_answers', 'id'], $select, $where);
                                    $updateCourse = saveData($this->assignmentAnswers, $select, $where);
                                    if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                        $i++;
                                        if($actionType == 'draft'){
                                            DB::commit();
                                            isset($req->master_course_id) ? session(['exam_type' => 'content1-'.$course_id.'-'.$req->index]) : session(['exam_type' => 'content1-'.$req->index]);
        
                                            return json_encode(['code' => 200, 'title' => "Saved as Draft", "message" => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Assignment') . " has been successfully saved as a draft.", "icon" => generateIconPath("success")]);
                                        }
                                    }
                                }

                                if ($i > 0) {
                                    $select = ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'exam_id' => $exam_id, 'exam_type' => 1, 'submitted_on' => $this->time, 'created_at' => $this->time, 'has_accepted_exam_instructions' => $has_accepted_exam_instructions];
                                    $where =  ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'exam_id' => $exam_id, 'exam_type' => 1, 'is_active' => '1'];
                                    $exam_assignments = getData('exam_assignments', ['exam_duration'], ['id' => $exam_id]);
                                    if($exam_assignments[0]->exam_duration != null) {
                                        unset($select['created_at']);
                                    }
                                    $examRemarkMaster = getData('exam_remark_master', ['created_at', 'submitted_on'], ['user_id' => $user_id, 'course_id' => $course_id, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam_id, 'exam_type' => 1, 'is_active' => '1']);
                                    if(isset($examRemarkMaster[0])){
                                        if($examRemarkMaster[0]->submitted_on > $examRemarkMaster[0]->created_at ){
                                            DB::rollback();
                                            return json_encode(['code' => 200, 'title' => "Already submitted", "message" => "Already submitted", "icon" => generateIconPath("error"), "redirect" => (isset($req->master_course_id) ? $req->input('master_course_id'): base64_encode($course_id)) . '/' . base64_encode($student_course_master_id)]);
                                        }
                                    }
                                    // $updateCourse = processData(['exam_remark_master', 'id'], $select, $where);
                                    $updateCourse = saveData($this->ExamRemark, $select, $where);
                                    if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                        
                                        $exam_assignments = getData('exam_assignments', ['enable_exam_feedback'], ['id' => $exam_id]);
                                        if($exam_assignments[0]->enable_exam_feedback == '1'){
                                            $select = [
                                                'student_course_master_id' => $student_course_master_id,
                                                'user_id' => $user_id,
                                                'course_id' => $course_id,
                                                'exam_type' => '1',
                                                'exam_id' => $exam_id,
                                                'last_updated_by' => $user_id,
                                                'created_at' =>  $this->time,
                                            ];

                                            
                                            $where = [
                                                'student_course_master_id' => $student_course_master_id,
                                                'user_id' => $user_id,
                                                'course_id' => $course_id,
                                                'exam_type' => '1',
                                                'exam_id' => $exam_id,
                                                'draft' => '1',
                                                'is_active' => '1',
                                            ];
                                                
                                            $existingRecord = DB::table('draft_exam')
                                            ->where($where)
                                            ->first();
    
                                            if($existingRecord){
                                                DB::commit();
                                                $updateCourseDraft = DB::table('draft_exam')->where('id', $existingRecord->id)->update(['draft' => 2, 'last_updated_by' => $user_id, 'updated_at' => $this->time]);
                                            }else{
                                                $updateCourseDraft = processData(['draft_exam', 'id'], $select);
                                                // $updateCourseDraft = saveData($this->DraftExam, $select);
                                            }
    
                                            if (isset($updateCourseDraft) && is_array($updateCourseDraft) && $updateCourseDraft['status'] === TRUE) {
                                                DB::commit();
                                                $i++;
                                            }
                                        }
                                        

                                        if ($i > 0) {
        
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
                                            
                                            $courseData = getData('course_master', ['ementor_id', 'course_title', 'id'], ['id' => $course_id]);
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
                                            //         (isset($examTitle) && $examTitle !== null ? $examTitle : 'Assignment'),
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
                                            //     '#Exam#' => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Assignment'),
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
                                            //     'exam_type' => '1',
                                            //     'exam_name' => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Assignmnt'),
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

                                            $studentCourseMaster = getData('student_course_master', ['course_id'], ['id' => $student_course_master_id]);

                                            $examType = ($studentCourseMaster[0]->course_id == $course_id)
                                                    ? 'content1-' . $req->index
                                                    : 'content1-' . $courseData[0]->id . '-' . $req->index;

                                            session(['exam_type' => $examType]);
                                            // dd(session('exam_type'));
                                            if (session()->has('lastAnswerSubmit')) {
                                                session()->forget('lastAnswerSubmit');
                                            }
                                            
                                            if (session()->has('reflectiveJournalExamCourseId')) {
                                                session()->forget('reflectiveJournalExamCourseId');
                                            }
                                            
                                            if (session()->has('eportfolio')) {
                                                session()->forget('eportfolio');
                                            }


                                            // isset($req->master_course_id) ? session(['exam_type' => 'content1-'.$courseData[0]->id.'-'.$req->index]) : session(['exam_type' => 'content1-'.$req->index]);
                                            
                                            return json_encode([
                                                'code' => 200,
                                                'title' => "Submitted Successfully",
                                                'message' => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Assignment') . " submitted successfully",
                                                'icon' => generateIconPath("success"),
                                                'redirect' => (isset($req->master_course_id) ? $req->input('master_course_id') : base64_encode($course_id)) . '/' . base64_encode($student_course_master_id)
                                            ]);
                                            
                                            // return json_encode(['code' => 200, 'title' => isset($examTitle) != null ? $examTitle : 'Assignment'." Submitted", "message" => "Assignment submitted successfully", "icon" => generateIconPath("success"), "redirect" => (isset($req->master_course_id) ? $req->input('master_course_id'): base64_encode($course_id)) . '/' . base64_encode($student_course_master_id)]);
                                        }
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
                    return json_encode(['code' => 404, 'title' => 'Exam not Exist', 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                }
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
    
    public function examEnvironment($enc_id, $student_course_master_id, $examType)
    {
        if (Auth::check() && Auth::user()->role === 'user') {
            if (isset($enc_id) && !empty($enc_id)) {
                $course_id = isset($enc_id) ? base64_decode($enc_id) : 0;
                $student_course_master_id = isset($student_course_master_id) ? base64_decode($student_course_master_id) : 0;
                
                $examDetails = [];
                if (!empty($course_id) && is_numeric($course_id)) {
                    $exists = is_exist('course_master', ['id' => $course_id, 'is_deleted' => 'No', 'status' => 3]);
                    if (isset($exists) && is_numeric($exists) && $exists > 0) {
                        $where = [
                            'course_id' => $course_id
                        ];

                        $examDetails = $this->examManage->getCouresExam($where);
                        $examType = base64_decode($examType);
                        if($examType == '1'){
                            
                            $index = null;

                            $getCourseExamIndex = getData('exam_management_master', ['exam_type'], ['course_id' => $course_id, 'is_deleted' => 'No'], '', 'id', 'asc');
                            
                            foreach ($getCourseExamIndex as $key => $value) {
                                if (isset($value->exam_type) && $value->exam_type == 1) {
                                    $index = $key;
                                    break;
                                }
                            }

                            $examData = $examDetails[$index]['assignment_exam'];
                        
                            $user_id = Auth::user()->id;
                            $exam_id  = isset($examData[0]['id']) ? $examData[0]['id'] : 0;
                            $exam_type  = isset($examDetails[0]['exam_type']) ? $examDetails[0]['exam_type'] : 0;
                            $questions = [];
                            $answers = [];
                            $answer_limit  = [];
    
                            foreach($examData[0]['assig_question'] as $question){
                                $questions[] = $question['id'];
                                $answer_limit[] = $question['answer_limit'];
                            };
                            // dd($examDetails);
                            
                            $examExit = is_exist('exam_assignments', ['id' => $exam_id, 'is_deleted' => 'No']);

                            if (isset($examExit) && is_numeric($examExit) && $examExit > 0) {
                                $course = getData('exam_assignments', ['award_id'], ['id' => $exam_id, 'is_deleted' => 'No']);
                                $course_id = isset($course[0]->award_id) ? $course[0]->award_id : 0;
                                $courseExpired = is_expired(['student_course_master.id' => $student_course_master_id, 'user_id' => $user_id]);
                                if (isset($courseExpired) && is_numeric($courseExpired) && $courseExpired > 0) {
    
                                    try {
                                        if (count($question) > 0) {
                                            foreach ($questions as $question) {
                                                $i = 0;
                                                $questions_id =  (int)$question;
    
                                                // list($hours, $minutes) = explode(':', $examData[0]['exam_duration']);

                                                if (!isset($examData[0]['exam_duration']) || strpos($examData[0]['exam_duration'], ':') === false) {
                                                    return redirect()->back()->with('duration_error', 'Something went wrong: Exam duration not found or invalid.');
                                                }
                                                
                                                list($hours, $minutes) = explode(':', $examData[0]['exam_duration']);
                                                
                                                $exam_start_time = now();
                                                $exam_end_time = $exam_start_time->copy()->addHours($hours)->addMinutes($minutes);
                                                $select = [
                                                    'student_course_master_id' => $student_course_master_id,
                                                    'type' => 'Assignment',
                                                    'user_id' => $user_id,
                                                    'course_id' => $course_id,
                                                    'question_id' => $questions_id,
                                                    'exam_duration' => $examData[0]['exam_duration'],
                                                    'exam_start_time' => $exam_start_time,
                                                    'exam_end_time' => $exam_end_time,
                                                    'last_updated_by' => $user_id,
                                                    'created_at' =>  $this->time
                                                ];
                                                $where =  ['user_id' => $user_id, 'course_id' => $course_id, 'is_active' => '1'];
    
                                                $updateCourse = processData(['exam_assignment_answers', 'id'], $select, $where);
                                                if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                                    $i++;
                                                }
                                            }

                                            if ($i > 0) {
                                                
                                                $select = ['user_id' => $user_id, 'course_id' => $course_id, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam_id, 'exam_type' => 1, 'submitted_on' => $this->time, 'created_at' => $this->time];
                                                $where =  ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'exam_id' => $exam_id, 'exam_type' => 1, 'is_active' => '1'];
                                                $exam_assignments = getData('exam_assignments', ['exam_duration'], ['id' => $exam_id]);

                                                $exist = is_exist('exam_remark_master', ['user_id' => $user_id, 'course_id' => $course_id, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam_id, 'exam_type' => 1, 'is_active' => '1']);

                                                if (isset($exist) && is_numeric($exist) && $exist > 0) {
                                                    if($exam_assignments[0]->exam_duration != null) {
                                                        unset($select['created_at']);
                                                        unset($select['submitted_on']);
                                                    }
                                                    $examRemarkMaster = getData('exam_remark_master', ['created_at', 'submitted_on'], ['user_id' => $user_id, 'course_id' => $course_id, 'exam_id' => $exam_id, 'exam_type' => 1, 'is_active' => '1']);
                                                    if($examRemarkMaster[0]->submitted_on > $examRemarkMaster[0]->created_at ){
                                                        return redirect()->back()->withErrors(['message' => 'Already submitted.']);
                                                    }
                                                }
                                                

                                                $updateCourse = processData(['exam_remark_master', 'id'], $select, $where);
                                                if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                                    DB::commit();
                                                    $getCourseExamIndex = getData('exam_management_master', ['exam_type'], ['course_id' => $course_id, 'is_deleted' => 'No'], '', 'id', 'asc'); 
                                                    // $index = null;

                                                    // foreach ($getCourseExamIndex as $key => $value) {
                                                    //     if (isset($value->exam_type) && $value->exam_type == 1) {
                                                    //         $index = $key;
                                                    //         break;
                                                    //     }
                                                    // }

                                                    $exists = is_exist('student_course_master', ['id' => $student_course_master_id, 'course_id' => $course_id]);
                                                    $examType = $exists > 0 
                                                        ? 'content1-' . $index 
                                                        : 'content1-' . $course_id . '-' . $index;
                                                    
                                                    session(['exam_type' => $examType]);

                                                    return view('frontend.exam.environment.environmentExam', compact('examDetails', 'student_course_master_id', 'index'));
                                                }
                                            }
                                        }
                                        DB::rollback();
                                        return redirect()->back()->withErrors(['message' => 'Something went wrong. Please try again.']);
                                    } catch (\Throwable $th) {
                                        return $th;
                                        DB::rollback();
                                        return redirect()->back()->withErrors(['message' => 'Something went wrong. Please try again.']);
                                    }
                                } else {
                                    return redirect()->back()->withErrors(['message' => 'Something went wrong. Please try again.']);
                                }
                            } else {
                                return redirect()->back()->withErrors(['message' => 'Something went wrong. Please try again.']);
    
                            }
    
                            return view('frontend.exam.environment.environmentExam', compact('examDetails', 'student_course_master_id'));
                        }elseif($examType == '7'){

                            $examData = null;
                            foreach ($examDetails as $detail) {
                                if (!empty($detail['mcq_exam'])) {
                                    $examData = $detail['mcq_exam'];
                                    break;
                                }
                            }
                        
                            $user_id = Auth::user()->id;
                            $exam_id  = isset($examData[0]['id']) ? $examData[0]['id'] : 0;
                            $questions = [];
                            $answers = [];
    
                            foreach($examData[0]['mcq_question'] as $question){
                                $questions[] = $question['id'];
                            };
                            
                            $examExit = is_exist('exam_mcq', ['id' => $exam_id, 'is_deleted' => 'No']);
                            if (isset($examExit) && is_numeric($examExit) && $examExit > 0) {
                                $course = getData('exam_mcq', ['award_id'], ['id' => $exam_id, 'is_deleted' => 'No']);
                                $course_id = isset($course[0]->award_id) ? $course[0]->award_id : 0;
                                // $courseExpired = is_expired(['student_course_master.id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id]);
                                $courseExpired = is_expired(['student_course_master.id' => $student_course_master_id, 'user_id' => $user_id]);
                                if (isset($courseExpired) && is_numeric($courseExpired) && $courseExpired > 0) {
    
                                    try {
                                        if (count($question) > 0) {
                                            foreach ($questions as $question) {
                                                $i = 0;
                                                $questions_id =  (int)$question;
    
                                                list($hours, $minutes) = explode(':', $examData[0]['exam_duration']);
                                                $exam_start_time = now();
                                                $exam_end_time = $exam_start_time->copy()->addHours($hours)->addMinutes($minutes);
                                                $select = [
                                                    'student_course_master_id' => $student_course_master_id,
                                                    'type' => 'MCQ',
                                                    'user_id' => $user_id,
                                                    'course_id' => $course_id,
                                                    'question_id' => $questions_id,
                                                    'exam_duration' => $examData[0]['exam_duration'],
                                                    'exam_start_time' => $exam_start_time,
                                                    'exam_end_time' => $exam_end_time,
                                                    'last_updated_by' => $user_id,
                                                    'created_at' =>  $this->time
                                                ];
    
                                                $where =  ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'question_id' => $questions_id, 'is_active' => '1'];
                                                $updateCourse = processData(['exam_mcq_answers', 'id'], $select, $where);
                                                if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                                    $i++;
                                                }
                                            }
                                            
                                            if ($i > 0) {

                                                $select = ['user_id' => $user_id, 'course_id' => $course_id, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam_id, 'exam_type' => $examType, 'submitted_on' => $this->time, 'created_at' => $this->time, 'is_cheking_completed' => '2'];

                                                $where =  ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'exam_id' => $exam_id, 'exam_type' => $examType, 'is_active' => '1'];
                                                $exam_mcq = getData('exam_mcq', ['exam_duration'], ['id' => $exam_id]);

                                                $exist = is_exist('exam_remark_master', ['user_id' => $user_id, 'course_id' => $course_id, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam_id, 'exam_type' => $examType, 'is_active' => '1']);

                                                if (isset($exist) && is_numeric($exist) && $exist > 0) {
                                                    if($exam_mcq[0]->exam_duration != null) {
                                                        unset($select['created_at']);
                                                        unset($select['submitted_on']);
                                                    }
                                                    $examRemarkMaster = getData('exam_remark_master', ['created_at', 'submitted_on'], ['user_id' => $user_id, 'course_id' => $course_id, 'exam_id' => $exam_id, 'exam_type' => $examType, 'is_active' => '1']);
                                                    if($examRemarkMaster[0]->submitted_on > $examRemarkMaster[0]->created_at ){
                                                        return redirect()->back()->withErrors(['message' => 'Already submitted.']);
                                                    }
                                                }
                                                $updateCourse = processData(['exam_remark_master', 'id'], $select, $where);
                                                if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                                    DB::commit();
                                                    $getCourseIndex = getData('master_course_management', ['placement_id'], ['award_id' => $student_course_master_id, 'course_id' => $course_id, 'is_deleted' => 'No']);

                                                    $key = isset($getCourseIndex[0]->placement_id) ? $getCourseIndex[0]->placement_id : null;

                                                    $getCourseExamIndex = getData('exam_management_master', ['exam_type'], ['course_id' => $course_id, 'is_deleted' => 'No'], '', 'id', 'asc'); 
                                                    $index = null;

                                                    foreach ($getCourseExamIndex as $key => $value) {
                                                        if (isset($value->exam_type) && $value->exam_type == 7) {
                                                            $index = $key;
                                                            break;
                                                        }
                                                    }

                                                    $exists = is_exist('student_course_master', ['id' => $student_course_master_id, 'course_id' => $course_id]);
                                                    $examType = $exists > 0 
                                                        ? 'content7-' . $index 
                                                        : 'content7-' . $course_id . '-' . $index;
                                                    
                                                    session(['exam_type' => $examType]);
                                                
                                                    return view('frontend.exam.environment.environmentExamMcq', compact('examDetails', 'student_course_master_id', 'index', 'key'));
                                                }
                                            }
                                        }
                                        DB::rollback();
                                        return redirect()->back()->withErrors(['message' => 'Something went wrong. Please try again.']);
                                    } catch (\Throwable $th) {
                                        return $th;
                                        DB::rollback();
                                        return redirect()->back()->withErrors(['message' => 'Something went wrong. Please try again.']);
                                    }
                                } else {
                                    return redirect()->back()->withErrors(['message' => 'Something went wrong. Please try again.']);
                                }
                            } else {
                                return redirect()->back()->withErrors(['message' => 'Something went wrong. Please try again.']);
    
                            }
                            return view('frontend.exam.environment.environmentExamMcq', compact('examDetails', 'student_course_master_id'));
                        }
                    }
                }
            }
        }
        return redirect()->route('login');
    }

}