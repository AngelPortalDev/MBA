<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentDocument;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash,Mail};
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use App\Rules\WordCount;
use App\Services\StudentDocumentService;
use App\Models\ExamRemarkMaster;
use File;
use App\Models\User;
use App\Models\CourseModule;
class CommonController extends Controller
{
    public function __construct(StudentDocumentService $service)
    {
        parent::__construct();
        $this->service = $service;
    }
    public function contactForm(Request $request)
    {
        if ($request->isMethod('POST')) {
            $first_name = isset($request->first_name) ? htmlspecialchars($request->input('first_name')) : '';
            $last_name = isset($request->last_name) ? htmlspecialchars($request->input('last_name')) : '';
            $email = isset($request->email) ? htmlspecialchars($request->input('email')) : '';
            $mob_code = isset($request->mob_code) ? htmlspecialchars($request->input('mob_code')) : '';
            $phone = isset($request->phone) ? htmlspecialchars($request->input('phone')) : '';
            $contact_role = isset($request->contact_role) ? htmlspecialchars($request->input('contact_role')) : '';
            $messages = isset($request->message) ? $request->input('message') : '';

            try {
                $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

                $data = $request->validate([
                    'first_name' => ['required', 'string','max:20'],
                    'last_name' => ['required', 'string','max:20'],
                    'phone' => ['required','string', 'min:6', 'max:20'],
                    'email' => ['required','email'],
                    'contact_role' => ['required','string'],
                    'message' => ['required', 'string','max:1000'],
                    // 'image_file' => 'mimes:jpeg,png,jpg,svg|max:1024',
                ],[
                    'first_name.max' => 'First name should be less than 20 characters.',
                    'last_name.max' => 'Last name should be less than 20 characters.',
                    'phone.max' => 'Phone number should be less than 20 digits.',
                    'message.max'=>'Message should be less than 1000 characters.'
                ]
                );
              
                // Validation passed, continue processing the data...
            } catch (ValidationException $e) {

                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }

                $where = [];
                $data = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'mob_code'=>$mob_code,
                    'mobile_no' =>$phone,
                    'role' => $contact_role,
                    'message' => $messages,
                    'created_at' => now(),
                ];

            $updateContact = processData(['contact_form', 'id'], $data, $where);
                
            $unsubscribeRoute = url('/unsubscribe/'.base64_encode($email));
            
            mail_send(2, ['#First Name#', '#Last Name#', '#Email#', '#Mobile Number with Country Code#', '#Category#', '#Message#'], [$first_name, $last_name, $email, $mob_code. " ".$phone, $contact_role, $messages ], env('RECIPIENT_EMAIL'), '', $email);
            
            mail_send(49, ['#Visitor Name#', '#unsubscribeRoute#'], [$first_name." ".$last_name, $unsubscribeRoute], $email);
            
            return json_encode(['code' => 200, 'title' => 'Successfully Submitted', "message" => "Contact form submitted successfully", "icon" => generateIconPath("success")]);
        }else{
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
    public function getExams($enc_id, $student_course_master_id, $true = null)
    {
        if (Auth::check() && Auth::user()->role === 'user') {

            if ($true) {
                if (session()->has('exam_type')) {
                    session()->forget('exam_type');
                }
                
                if (session()->has('lastAnswerSubmit')) {
                    session()->forget('lastAnswerSubmit');
                }
                
                if (session()->has('reflectiveJournalExamCourseId')) {
                    session()->forget('reflectiveJournalExamCourseId');
                }

                if (session()->has('eportfolio')) {
                    session()->forget('eportfolio');
                }
            }

            if (isset($enc_id) && !empty($enc_id)) {
                $course_id = isset($enc_id) ? base64_decode($enc_id) : 0;
                $student_course_master_id = isset($student_course_master_id) ? base64_decode($student_course_master_id) : 0;
                $examDetails = [];
                if (!empty($course_id) && is_numeric($course_id)) {
                    $exists = is_exist('course_master', ['id' => $course_id,'status' => 3]);
                    if (isset($exists) && is_numeric($exists) && $exists > 0) {
                        $where = [
                            'course_id' => $course_id,
                            'is_deleted' => 'No'
                        ] ;

                        $courseMaster = getData('course_master', ['category_id', 'course_title'], ['id' => $course_id]);

                        if($courseMaster[0]->category_id == '1'){
                            $examDetails = $this->examManage->getCouresExam($where);
                            return view('frontend.exam.exam', compact('examDetails', 'course_id', 'student_course_master_id'));
                        }else{
                            $additionalConditions = [
                                'student_course_master_id' => $student_course_master_id
                            ];
                            $where = array_merge($where, $additionalConditions);
                            
                            $data = $this->examManage->getAwardCourse($where);
                            $awardCourses = $data['awardCourseIds'];
                            $optionalCourseSelected = $data['optionalCourseSelected'];

                            if ($optionalCourseSelected == false) {
                                return redirect()->back()->with('optional_course_error', 'Select your optional ects to access course.');
                            }

                            foreach ($awardCourses as $key => $awardCourse) {
                                $courseWhere = [
                                    'course_id' => $awardCourse->course_id,
                                    'is_deleted' => 'No'
                                ];
                                
                                $awardCourses[$key]->course_exam = $this->examManage->getCouresExam($courseWhere);
                            }

                            return view('frontend.exam.master-exam', compact('awardCourses', 'course_id', 'student_course_master_id', 'optionalCourseSelected'));
                        }
                    }
                }
            }
            return redirect()->back();
        }
        return redirect('/login');
    }
    public function ePortfolioSubmit(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check() && count($req->input('answer')) > 0) {
            $user_id = Auth::user()->id;

            $title  = isset($req->title) ? htmlspecialchars_decode($req->input('title')) : '';
            $course_id  = isset($req->course_id) && is_array($req->course_id) ? $req->input('course_id') : [];
            $master_course_id  = isset($req->master_course_id) ? $req->input('master_course_id') : 0;
            $student_course_master_id  = isset($req->student_course_master_id) ? $req->input('student_course_master_id') : 0;
            $answers  = isset($req->answer) && is_array($req->answer) ? $req->input('answer') : [];
            $courseExpired = is_expired(['user_id' => $user_id, 'course_id' => $master_course_id]);
            $eportExist = is_exist('exam_eportfolio', ['user_id' => $user_id, 'course_id' => $course_id]);
            $has_accepted_exam_instructions = $req->has_accepted_exam_instructions == 'true' ? 1 : 0;
            $validate_rules = [
                'course_id' => 'string|max:100|min:3',
                'answers' => 'string|max:1000',
            ];
            $validate_ruless = [];
            if (isset($title) && !empty($title)) {
                $validate_ruless['title'] = ['required', 'string', new WordCount(25)];
            }
            $validate = Validator::make($req->all(), $validate_ruless);

            if (!$validate->fails()) {
                if (isset($courseExpired) && is_numeric($courseExpired) && $courseExpired > 0) {
                    if (isset($eportExist) && is_numeric($eportExist) && $eportExist < 20) {
                        try {
                            if (count($answers) > 0) {
                                $i = 0;
                                DB::beginTransaction();
                                $rules = [];
                                $maxWordsLimit = '1000';
                                foreach ($answers as $index => $answer) {
                                    $rules["answer." . ($index)] = [new WordCount($maxWordsLimit)];
                                }

                                $validator = Validator::make($req->all(), $rules);

                                if ($validator->fails()) {

                                    return response()->json([
                                        'code' => 202,
                                        'title' => 'Required Fields are Missing',
                                        'message' => 'Please Provide Required Info',
                                        'icon' => generateIconPath('error'),
                                        'data' => $validator->errors(),
                                    ]);
                                };

                                $select = [
                                    'user_id' => $user_id,
                                    'course_id' => $course_id[0],
                                    'student_course_master_id' => $student_course_master_id,
                                    'title' => $title,
                                    'answer_count' => $i,
                                    'has_accepted_exam_instructions' => $has_accepted_exam_instructions,
                                    'created_at' =>  $this->time, 
                                ];
                                $updateCourse = processData(['exam_eportfolio', 'id'], $select);
                                
                                foreach ($answers as $key => $answer) {
                                    $questions_id =  1 + $key;
                                    $answers_decode =  htmlspecialchars($answer);
                                    $select = [
                                        'eportfolio_id' => $updateCourse['id'],
                                        'question_id' => $questions_id,
                                        'answer' => $answers_decode,
                                        'created_at' =>  $this->time
                                    ];
                                    $updatePortfolioAnswer = processData(['exam_eportfolio_answers', 'id'], $select);
                                }

                                if ((isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) && (isset($updatePortfolioAnswer) && is_array($updatePortfolioAnswer) && $updatePortfolioAnswer['status'] === TRUE)) {
                                    DB::commit();
                                    
                                    $course_id = DB::table('student_course_master')->where('id', $student_course_master_id)->value('course_id');
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

                                    // $examManagementMaster = getCourseExamCount(base64_encode($course_id));
                                    
                                    $examRemarkMasters = ExamRemarkMaster::where([
                                        'student_course_master_id' => $student_course_master_id,
                                        // 'course_id' => $course_id,
                                        'user_id' => $user_id,
                                        'is_active' => '1',
                                    ])->latest()->count();
                                    
                                    $eportfolio = DB::table('exam_eportfolio')->where([
                                        'student_course_master_id' => $student_course_master_id,
                                        'exam_eportfolio.user_id' => $user_id,
                                        'exam_eportfolio.course_id' => $course_id,
                                    ])->count();

                                    $subEmentorId = getAssignedSubMentor($student_course_master_id);
                                    $courseData = getData('course_master', ['ementor_id', 'course_title'], ['id' => $course_id]);
                                    $ementorId = isset($courseData[0]->ementor_id) ? $courseData[0]->ementor_id : 0;
                                    $ementorData = getData('users', ['name', 'last_name', 'email'], ['id' => $ementorId]);
                                    $unsubscribeRoute = url('/unsubscribe/'.base64_encode($ementorData[0]->email));
                                    
                                    $recipientEmail = $ementorData[0]->email;
                                    $ccEmail = null;
                                    
                                    if ($subEmentorId) {
                                        $subEmentorData = getData('users', ['name', 'last_name', 'email'], ['id' => $subEmentorId]);
                                        $recipientEmail = $subEmentorData[0]->email;
                                        $ccEmail = $ementorData[0]->email;
                                    }
                                    
                                    $mailData = [
                                        '#EmentorName#' => $subEmentorId ? $subEmentorData[0]->name . " " . $subEmentorData[0]->last_name : $ementorData[0]->name . " " . $ementorData[0]->last_name,
                                        '#StudentName#' => Auth::user()->name . " " . Auth::user()->last_name,
                                        '#Exam#' => 'E-portfolio',
                                        '#Course Name#' => $courseData[0]->course_title,
                                        '#Submission Date#' => now()->format('Y-m-d'),
                                        '#unsubscribeRoute#' => $ementorData[0]->email
                                    ];
                                    
                                    mail_send(43, array_keys($mailData), array_values($mailData), $recipientEmail, $ccEmail);

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
                                    //         $ementorData[0]->name. " ". $ementorData[0]->last_name,
                                    //         Auth::user()->name. " ".Auth::user()->last_name,
                                    //         'E-portfolio',
                                    //         $courseData[0]->course_title,
                                    //         now()->format('Y-m-d'),
                                    //         $ementorData[0]->email
                                    //     ], 
                                    //     $ementorData[0]->email
                                    // );
                                    
                                    if ($eportfolio == 5) {
                                        $mentorIds = User::where('id', $ementorId)->pluck('id')->toArray();
                                        $mentorIds[] = $subEmentorId;
                                        $data = [
                                            'student_name' => Auth::user()->name. " ".Auth::user()->last_name,
                                            'student_id' => base64_encode(Auth::user()->id),
                                            'student_course_master_id' => base64_encode($student_course_master_id),
                                            'course_id' => base64_encode($course_id),
                                            'exam_name' => 'E-Portfolio',
                                            'course_name' => $courseData[0]->course_title,
                                            'exam_id' => base64_encode($updateCourse['id']),
                                            'read' => false,
                                        ];
                                        sendNotification($mentorIds, $data);
                                    }

                                    // if (isset($examManagementMaster) && isset($examRemarkMasters) && $examManagementMaster == $examRemarkMasters && $eportfolio == 5) {
                                    
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
                                    
                                    if ($courseMaster[0]->category_id != 1) {

                                        $allEportfolioSubmitted = true;

                                        foreach ($courseIds as $courseId) {

                                            $eportfolioCount = DB::table('exam_eportfolio')
                                                ->where('student_course_master_id', $student_course_master_id)
                                                ->where('user_id', Auth::user()->id)
                                                ->where('course_id', $courseId)
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
                                                    Auth::user()->name. " ".Auth::user()->last_name,
                                                    $courseMaster[0]->course_title,
                                                    $unsubscribeRoute
                                                ],
                                                Auth::user()->email
                                            );
                                        }
                                    }else{
                            
                                        $eportfolio = DB::table('exam_eportfolio')->where([
                                            'user_id' => Auth::user()->id,
                                            'student_course_master_id' => $student_course_master_id,
                                        ])->count();
                                        
                                        if ($examManagementMaster == $examRemarkMasters && $eportfolio == 5) {
                                            mail_send(
                                                34,
                                                ['#Name#', '#Course Name#', '#unsubscribeRoute#'],
                                                [
                                                    Auth::user()->name. " ".Auth::user()->last_name,
                                                    $courseMaster[0]->course_title,
                                                    $unsubscribeRoute
                                                ],
                                                Auth::user()->email
                                            );
                                        }
                                    }

                                    $course_id  = isset($req->course_id) && is_array($req->course_id) ? $req->input('course_id') : [];
                                    session(['eportfolio' => 'content-'.$course_id[0]]);

                                    return json_encode(['code' => 200, 'title' => "E-Portfolio Submitted", "message" => "E-Portfolio submitted successfully", "icon" => generateIconPath("success")]);
                                }
                            }
                            DB::rollback();
                            return json_encode(['code' => 404, 'title' => "Unable to submit E-Portfolio", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error")]);
                        } catch (\Throwable $th) {
                            return $th;
                            DB::rollback();
                            return json_encode(['code' => 404, 'title' => "Unable to submit E-Portfolio", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error")]);
                        }
                    } else {
                        return json_encode(['code' => 404, 'title' => 'Maximum Limit Reached', 'message' => 'Maximum 20 E-Portfolio Allowed', "icon" => generateIconPath("error")]);
                    }
                } else {
                    return json_encode(['code' => 404, 'title' => 'Course not exist or expired', 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 404, 'title' => 'Something Went Wrong', 'message' => 'Something Went Wrong', "icon" => generateIconPath("error")]);
        }
    }
    public function englishTestSubmit(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check() && count($req->input('question_id')) > 0) {
            $user_id = Auth::user()->id;
            $question  = isset($req->question_id) && is_array($req->question_id) ? $req->input('question_id') : [];
            $validate_rules = [
                'question_id' => 'required|array',
                'question_id' => 'required|array',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                $i = 0;
                $ans = [];
                $CorrectCheck = 0;
                $ansData = [3, 1, 1, 2, 3, 2, 2, 3, 2, 2, 1, 1, 3, 3, 2, 2, 4, 2, 1, 2, 4, 3, 4, 1, 1, 3, 2, 1, 2, 3];
                if (count($question) > 0) {
                    foreach ($question as $value) {
                        $n = $i + 1;
                        $answer =  $req->input("answer$n");
                        $correctAns = $ansData[$i];
                        $ans = isset($answer[0]) && is_numeric($answer[0]) && !empty($answer[0]) ? (int) $answer[0] : 0;
                        $CorrectCheck += $ans === $correctAns ? 1 : 0;
                        $i++;
                    }
                }

                $score = $CorrectCheck;

                // $studentExist = is_exist('student_course_master', ['user_id' => $user_id]);
                // if(Auth::user()->apply_dba == 'Yes'){
                //     $studentExist = '1';
                // }
                // if (isset($studentExist) && is_numeric($studentExist) && $studentExist > 0) {
                    $attemptData = getData('student_doc_verification', ['english_test_attempt','english_level','english_score'], ['student_id' => $user_id]);
                    $select = [
                        'english_score' => $score,
                        'english_test_submitted_on' =>  $this->time,
                        'english_test_attempt'=> $attemptData[0]->english_test_attempt - 1
                    ];
                    
                    $attempt = is_exist('student_doc_verification', ['student_id' => $user_id, 'english_score' => '', 'english_level' => '', 'english_test_submitted_on' => '', 'english_level_view' => '']);
                    if (isset($attempt) && is_numeric($attempt) && $attempt > 0) {
                        return json_encode(['code' => 201, 'title' => "English test already submitted", 'message' => 'English test already submitted', "icon" => generateIconPath("error")]);
                    }

                    $updateCourse = processData(['student_doc_verification', 'student_doc_id'], $select, ['student_id' => $user_id]);

                    if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                        
                        $attemptData = getData('student_doc_verification', ['english_test_attempt','english_level', 'english_score'], ['student_id' => $user_id]);

                        if(isset($attemptData) && $attemptData[0]->english_test_attempt === 1 && $attemptData[0]->english_score < 10){
                            mail_send(40, ['#Name#', '#email'], [Auth::user()->name. " ".Auth::user()->last_name, Auth::user()->email], Auth::user()->email);
                        }else{
                            $unsubscribeRoute = url('/unsubscribe/'.base64_encode(Auth::user()->email));
                            if($score < 10){
                                mail_send(4, ['#Name#', '#Marks#', '#unsubscribeRoute#'], [Auth::user()->name. " ".Auth::user()->last_name , $score, $unsubscribeRoute], Auth::user()->email);
                            }else{
                                
                                // $student = DB::table('student_course_master')->where('user_id', Auth::user()->id)->first();
                                
                                // if ($student) {
                                    // $courseMaster = DB::table('course_master')->where('id', $student->course_id)->first();
                                    // if(!empty($courseMaster->duration_month)){
                                    //     DB::table('student_course_master')
                                    //         ->where('user_id', Auth::user()->id)
                                    //         ->update([
                                    //             'course_start_date' => now()->format('Y-m-d'),
                                    //             'course_expired_on' => Carbon::now()->addMonths($courseMaster->duration_month)->format('Y-m-d'),
                                    //         ]);
                                    // }
                                    $unsubscribeRoute = url('/unsubscribe/'.base64_encode(Auth::user()->email));
                                    mail_send(3, ['#Name#', '#Marks#', '#unsubscribeRoute#'], [Auth::user()->name. " ".Auth::user()->last_name , $score, $unsubscribeRoute], Auth::user()->email);
                                    
                                    // $this->service->verificationStatusUpdate($user_id);
    
                                // }
    
                            }
                        }

                        $attemptDatas = getData('student_doc_verification', ['english_test_attempt','english_level','english_score','english_level_view'], ['student_id' => $user_id]);
                        $english_score = $attemptDatas[0]->english_score;
                        $english_test_attempt = $attemptDatas[0]->english_test_attempt;
                        if($english_score >= 10){
                            $score_level_text = "Pass"; 
                        }else if($english_score < 10){
                            $score_level_text = "Fail";
                        }else{
                            $score_level_text = "Fail"; 
                        }
                        $data = [
                            "english_score" => $english_score,
                            "score_level_text"=>$score_level_text,
                            "english_test_attempt"=>$attemptDatas[0]->english_test_attempt,
                        ];
                        // echo $attemptDatas[0]->english_test_attempt;
                        // echo $attemptDatas[0]->english_level;
                        // die;
                        $this->user->verificationStatutsUpdate($user_id);
                         
                        $studentDocVerification = getData('student_doc_verification', ['student_id', 'identity_is_approved', 'edu_is_approved', 'english_score', 'english_test_attempt'], ['student_id' => auth()->user()->id]);
                        if($studentDocVerification[0]->identity_is_approved == 'Approved' && $studentDocVerification[0]->edu_is_approved == 'Approved' && $studentDocVerification[0]->english_score >= 10){
                            return json_encode(['code' => 200, 'title' => 'English test submitted successfully', "message" => "", "icon" => generateIconPath("success"),"data"=>$data, 'redirect' => 'student-my-learning']);
                        }elseif($studentDocVerification[0]->identity_is_approved == 'Approved' && $studentDocVerification[0]->edu_is_approved == 'Approved' && $studentDocVerification[0]->english_score < 10 && $studentDocVerification[0]->english_test_attempt == '1'){
                            return json_encode(['code' => 200, 'title' => 'English test submitted successfully', "message" => "", "icon" => generateIconPath("success"),"data"=>$data]);
                        }else{
                            return json_encode(['code' => 200, 'title' => 'English test submitted successfully', "message" => "", "icon" => generateIconPath("success"),"data"=>$data, 'redirect' => 'student-my-learning']);
                        }

                        return json_encode(['code' => 200, 'title' => 'English test submitted successfully', "message" => "", "icon" => generateIconPath("success"),"data"=>$data]);

                    }
                    return json_encode(['code' => 201, 'title' => "Unable to Submit Test", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error")]);
                // } else {
                //     return json_encode(['code' => 202, 'title' => 'Course Not Avaialble', 'message' => 'Please Provide Buy Course first', "icon" => generateIconPath("error")]);
                // }
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
    
    public function verifyEnglishTestCode(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $user_id = Auth::user()->id;
            $university_code = Auth::user()->university_code;
            $englist_test_pass_code  = isset($req->englist_test_pass_code) ? $req->input('englist_test_pass_code') : 0;
            $exists = is_exist('institute_profile_master', ['university_code' => $university_code, 'englist_test_pass_code' => $englist_test_pass_code]);
            if (isset($exists) && is_numeric($exists) && !empty($exists) && $exists > 0) {
                $select = [
                    'english_score' => 12,
                    'english_test_attempt' => 1,
                    'english_test_submitted_on' =>  $this->time,
                ];

                $updateCourse = processData(['student_doc_verification', 'student_doc_id'], $select, ['student_id' => $user_id]);

                User::where('id', $user_id)->update(['passed_via_english_code' => 1]);
                
                return response()->json([
                    'code' => 200,
                    'title' => "English Test Passed",
                    'message' => "Congratulations! You have successfully passed the English test.",
                    'icon' => generateIconPath("success")
                ]);
            }else{
                return response()->json(['code' => 201, 'title' => "Invalid Code", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
        } else {
            return response()->json(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }

    public function saveSnapshot(Request $req)
    {
        $snapshot = $req->input('snapshot');
        $courseId  = isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;
        $exam_type  = isset($req->exam_type) ? base64_decode($req->input('exam_type')) : 0;
        $user_id = Auth::user()->id;

        $examType = getExamType($exam_type);
        $courseMaster = getData('course_master', ['course_title'], ['id' => $courseId]);
        if(!empty($courseMaster[0])){
            $courseTitle = $courseMaster[0]->course_title;
            $examRemarkMasters = getData('exam_remark_master', ['id'], ['user_id' => $user_id, 'exam_type' => $exam_type, 'course_id' => $courseId], '1', 'id', 'desc');
            
            if(!empty($examRemarkMasters[0])){
    
                $directory = public_path("storage/uploads_exam_snap/". $courseTitle. '/'. $examType. '/'. $examRemarkMasters[0]->id. '/');
    
                if (!file_exists($directory)) {
                    File::makeDirectory($directory, 0777, true);
                }
    
                if (preg_match('/^data:image\/(\w+);base64,/', $snapshot, $type)) {
                    $data = substr($snapshot, strpos($snapshot, ',') + 1);
                    $type = strtolower($type[1]);
                    $data = base64_decode($data);
    
                    if ($data === false) {
                        return response()->json(['error' => 'Base64 decode failed.'], 500);
                    }
    
                    $imageName = 'snapshot_' . time() . '.' . $type;
                    $imagePath = $directory. '/'. $imageName;
                    if (file_put_contents($imagePath, $data) === false) {
                        return response()->json(['error' => 'Failed to save snapshot.'], 500);
                    }
    
                    return response()->json(['success' => 'Snapshot saved.', 'path' => $imagePath]);
                } else {
                    return response()->json(['error' => 'Invalid base64 data.'], 400);
                }
            }
        }

    }


    public function englishCourseQuizData(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $user_id = Auth::user()->id;
            $section_id  = isset($req->section_id) ? base64_decode($req->input('section_id')) : 0;

            $validate_rules = [
                'section_id' => 'required|string',
            ];
            $validate = Validator::make($req->all(), $validate_rules);

            $QuizDataId = getData('exam_quiz',['id'],['section_id'=>$section_id,'is_deleted'=>'No']);
            if (is_exist('exam_quiz', ['section_id' => $section_id, 'is_deleted' => 'No']) > 0) {
                $quizId = $QuizDataId[0]->id;
                if (is_exist('exam_quiz', ['id' => $quizId, 'is_deleted' => 'No']) > 0) {
                    $is_done = is_exist('english_course_quiz', ['user_id' => $user_id, 'quiz_id' => $quizId]);
                    if ($is_done === 0) {
                        if (!$validate->fails()) {
                            $where = ['section_id' => $section_id, 'is_deleted' => 'No'];
                            $QuizData = $this->Quiz->getQuizDetails($where);
                            $VideoData = $this->sectionManage->getSectionContentVideo($where);
                            $hasVideo = false;

                            foreach ($VideoData as $video) {
                                if (!empty($video['course_video'])) {
                                    $hasVideo = true;
                                    break;
                                }
                            }
                            if (!$hasVideo) {
                                return json_encode(['code' => 202, 'title' => "Quiz not Exist", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error"]);
                            }
                                                        
                            return json_encode(['code' => 200, 'data' => $QuizData]);
                        } else {
                            return json_encode(['code' => 202, 'title' => 'Something Went Wrong', 'message' => 'Please Try Again', "icon" => "error"]);
                        }
                    } else {
                        $getScore = getData('english_course_quiz', ['quiz_score'], ['user_id' => $user_id, 'quiz_id' => $quizId]);
                        $score = $getScore[0]->quiz_score;
                        return json_encode(['code' => 203, 'title' => "Quiz Already Submit", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error", "score" => $score]);
                    }
                } else {
                    return json_encode(['code' => 201, 'title' => "Quiz not Exist", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error"]);
                }
            }else {
                return json_encode(['code' => 202, 'title' => "Quiz not Exist", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error"]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error"]);
        }
    }

    

    public function englishCourseQuizSubmit(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check() ) {
            $user_id = Auth::user()->id;
            $quiz_id  = isset($req->quiz_id) ? base64_decode($req->input('quiz_id')) : 0;
            $question  = isset($req->question_id) && is_array($req->question_id) ? $req->input('question_id') : [];
            $section_id  = isset($req->section_id) ? base64_decode($req->input('section_id')) : 0;

            $validate_rules = [
                'question_id' => 'required',
                'quiz_id' => 'required|string',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                $i = 0;
                $ans = [];
                $ques_id = [];
                $CorrectCheck = 0;
                if (count($question) > 0) {
                    foreach ($question as $index => $value) {
                        $n = $i;
                        $answer =  $req->input("answer$n");
                        $ques_id = base64_decode($value);
                        $ansData = getData('exam_quiz_questions', ['question', 'answer'], ['id' => $ques_id, 'is_deleted' => 'No']);
                        $correctAns = $ansData[0]->answer;
                        $ans = isset($answer[0]) && is_numeric($answer[0]) && !empty($answer[0]) ? (int) $answer[0] : 0;
                        $CorrectCheck += $ans === $correctAns ? 1 : 0;
                        $i++;
                }
                }

                $score = ceil($CorrectCheck / $i * 100);

                $QuizExt = is_exist('exam_quiz', ['id' => $quiz_id, 'is_deleted' => 'No']);
                if (isset($QuizExt) && is_numeric($QuizExt) && $QuizExt > 0) {

                    $select = [
                        'user_id' => $user_id,
                        'quiz_id' => $quiz_id,
                        'section_id'=>$section_id,
                        'quiz_score' => $score,
                        'quiz_status' => 1,
                        'created_at' =>  $this->time
                    ];

                    $attempt = is_exist('english_course_quiz', ['user_id' => $user_id,'quiz_id' => $quiz_id, 'is_deleted' => 'No']);
                    if (isset($attempt) && is_numeric($attempt) && $attempt > 0) {
                        return json_encode(['code' => 201, 'title' => "Quiz Already Submitted", 'message' => 'Quiz already submitted', "icon" => "error"]);
                    }
                    $updateCourse = processData(['english_course_quiz', 'id'], $select);
                    if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                        return json_encode(['code' => 200, 'title' => 'Your Score is ' . $score . "%", "message" => "Quiz submitted successfully", "icon" => "success", 'score' => $score]);
                    }
                    return json_encode(['code' => 201, 'title' => "Unable to Create Course", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error"]);
                } else {
                    return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => "error", 'data' => $validate->errors()]);
                }
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => "error", 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
        }
    }

    public function getEnglishCourseVideo($section_id){
        if (Auth::check() && Auth::user()->role == 'user') {
            $doc_verified = getData('student_doc_verification',['identity_is_approved'],['student_id'=>Auth::user()->id]);
            if($doc_verified[0]->identity_is_approved == "Approved"){ 
                $section_id  = isset($section_id) ? base64_decode($section_id) : 0;
                $where = ['section_id' => $section_id, 'is_deleted' => 'No'];
                $VideoData = $this->sectionManage->getSectionContentVideo($where);
                if (empty($VideoData) || !is_array($VideoData)) {
                    return view('frontend.coming-soon');
                }
                
                $hasVideo = false;

                foreach ($VideoData as $video) {
                    if (!empty($video['course_video'])) {
                        $hasVideo = true;
                        break;
                    }
                }

                if (!$hasVideo) {
                    return view('frontend.coming-soon');
                }
                
                return view('frontend.video-view', compact('VideoData'));
            }else{
                return redirect()->route('not-found');
            }
        }else{
            return redirect()->route('not-found');
        }
    }
    public function getEnglishCoursePodcasts($section_id){
        if (Auth::check() && Auth::user()->role == 'user') {
            $doc_verified = getData('student_doc_verification',['identity_is_approved'],['student_id'=>Auth::user()->id]);
            if($doc_verified[0]->identity_is_approved == "Approved"){ 
                $section_id  = isset($section_id) ? base64_decode($section_id) : 0;
                $where = ['section_id' => $section_id, 'is_deleted' => 'No'];
                $VideoData = $this->sectionManage->getSectionContentVideo($where);
                if (empty($VideoData) || !is_array($VideoData)) {
                    return view('frontend.coming-soon');
                }
                
                $hasVideo = false;

                foreach ($VideoData as $video) {
                    if (!empty($video['course_video'])) {
                        $hasVideo = true;
                        break;
                    }
                }

                if (!$hasVideo) {
                    return view('frontend.coming-soon');
                }
                return view('frontend.podcast-view', compact('VideoData'));
            }else{
                return redirect()->route('not-found');
            }
        }else{
            return redirect()->route('not-found');
        }
    }

    public function searchSuggestions(Request $request)
    {
        $query = $request->get('keyword');

        // You can fetch from your actual model (like Course::where(...))
        $courses = CourseModule::select('id', 'course_title', 'category_id')
        ->where('course_title', 'like', "%{$query}%")
        ->limit(10)
        ->get();

        return response()->json($courses);
    }
    
}
?>