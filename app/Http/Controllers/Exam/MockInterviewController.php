<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,  Validator, DB, Storage};
use Illuminate\Validation\ValidationException;
use App\Models\ExamRemarkMaster;
use App\Models\User;
use File;
use App\Models\Notification;
use App\Notifications\SendNotification;

class MockInterviewController extends Controller
{
    public $mock_collection;
    public function __construct()
    {
        parent::__construct();
        $this->mock_collection = env('EXAM_MOCK_COLLECTION');
    }

    public function mockContentUpload(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $user_id = Auth::user()->id;
            $course_id  = isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;
            $exam_id  = isset($req->exam_id) ? base64_decode($req->input('exam_id')) : 0;
            $formate  = isset($req->formate) ? base64_decode($req->input('formate')) : 0;
            $question  = isset($req->ques_id) && !empty($req->ques_id) ? base64_decode($req->input('ques_id')) : 0;
            $docFile = $req->hasFile('docFile') ? $req->file('docFile') : 0;
            $student_course_master_id  = isset($req->student_course_master_id) ? base64_decode($req->input('student_course_master_id')) : 0;
            $type = isset($req->type) ? $req->type : '';

            $wordCountNotExist = is_exist('exam_mock_interview', ['id' => $exam_id, 'is_deleted' => 'No', 'requires_word_count' => 0]);

            try {
                $messages = [];
                $validate = [
                    'formate' => ['required', 'string'],
                ];
                if ($req->hasFile('docFile') && $formate  === '1') { // 1 = PDF
                    $validate = array_merge($validate, ['docFile' => ['required', 'mimes:pdf', 'max:5120']]);
                    $messages = [
                        'docFile.max' => 'The docs file must not be greater than 5MB.',
                    ];
                } elseif ($req->hasFile('docFile') && $formate  === '2') {  // 2 = Video
                    $validate = array_merge($validate, ['docFile' => ['required', 'mimes:mp4','max:512000']]);
                    $messages = [
                        'docFile.max' => 'The docs file must not be greater than 500MB.',
                    ];
                }
                $req->validate($validate,$messages);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            $examExit = is_exist('exam_mock_interview', ['id' => $exam_id, 'is_deleted' => 'No']);
            $questionExists = is_exist('exam_mock_answers', ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'question_id' => $question, 'is_active' => 1]);
            if (isset($examExit) && is_numeric($examExit) && $examExit > 0) {
                $course = getData('exam_mock_interview', ['award_id'], ['id' => $exam_id, 'is_deleted' => 'No']);
                $course_id = isset($course[0]->award_id) ? $course[0]->award_id : 0;
                $courseExpired = is_expired(['user_id' => $user_id, 'course_id' => isset($req->master_course_id) ? base64_decode($req->input('master_course_id')): $course_id]);
                if (isset($courseExpired) && is_numeric($courseExpired) && $courseExpired > 0) {
                    try {

                        $select = [
                            'student_course_master_id' => $student_course_master_id,
                            'type' => $type,
                            'user_id' => $user_id,
                            'course_id' => $course_id,
                            'question_id' => $question,
                            'last_updated_by' => $user_id,
                        ];
                        $getexistData = getData(
                            'exam_mock_answers',
                            ['answer_file_url'],
                            ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'question_id' => $question]
                        );

                        $fileExist = isset($getexistData[0]->answer_file_url) && !empty($getexistData[0]->answer_file_url) ? $getexistData[0]->answer_file_url : '';
                        
                        $fileUrl = '';
                        $filename = '';

                        if ($req->hasFile('docFile') && $docFile->getClientOriginalExtension() == 'pdf' && $formate === '1') { 
                            if (isset($wordCountNotExist) && is_numeric($wordCountNotExist) && $wordCountNotExist == 0) {
                                $mockInterviewQuestion = getData('exam_mock_questions', ['word_limit'], ['id' => $question, 'is_deleted' => 'No']);
                                $result = getPdfWordCount($docFile);
                                $wordCount = $result['word_count'];
                                $isTextBased = $result['is_text_based'];

                                if (!$isTextBased) {
                                    return response()->json([
                                        'code' => 201,
                                        'title' => "Validation Error",
                                        'message' => 'The uploaded PDF appears to contain images only. Please upload a text-based PDF.',
                                        'icon' => generateIconPath('error')
                                    ]);
                                } elseif ($wordCount > $mockInterviewQuestion[0]->word_limit) {
                                    return response()->json([
                                        'code' => 201,
                                        'title' => "Validation Error",
                                        'message' => 'Word limit exceeded',
                                        'icon' => generateIconPath('error')
                                    ]);
                                }

                            }
                            $filename = $docFile->getClientOriginalName();
                        $docFile_url =  UploadFiles($docFile, 'course/MockInterviewDocs/studentAnswerDocs', $fileExist);
                        if ($docFile_url === FALSE) {
                            return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => generateIconPath("error")]);
                        }
                            if (isset($docFile_url['url']) && Storage::disk('local')->exists($docFile_url['url'])) {
                                $fileUrl = !empty($docFile_url['url']) ? $docFile_url['url'] : 'No File';
                            } else {
                                return json_encode(['code' => 201, 'title' => "Unable to Upload Pdf", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                            }
                        } elseif ($req->hasFile('docFile') && $docFile->getClientOriginalExtension() == 'mp4' && $formate === '2') {
                            $filename = $docFile->getClientOriginalName();
                            $library  = 3;
                            $collection_id = $this->mock_collection;
                            $getuserData = getData(
                                'users',
                                ['name', 'last_name'],
                                ['id' => $user_id, 'is_deleted' => 'No']
                            );
                            $name = $getuserData[0]->name;
                            $last_name = $getuserData[0]->last_name;
                            $fullname =  $name . " " . $last_name;
                            $videoContent = [$collection_id, $docFile, $fullname];
                            
                            if (isset($fileExist) && !empty($fileExist) && $fileExist != '') {
                                $vidoId = $this->CourseModule->videoAction($fileExist, $videoContent, 'REPLACE', $library);
                            } else {
                                $vidoId = $this->CourseModule->getVideoId($collection_id, $docFile, $fullname, $library);
                            }
                            if (isset($vidoId) && is_array($vidoId) && $vidoId['status'] === TRUE && $vidoId['videoId'] != '') {
                                $fileUrl = $vidoId['videoId'];
                            } else {
                                return json_encode(['code' => 201, 'title' => "Unable to Upload Video", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                            }
                        }

                        if (isset($fileUrl) && !empty($fileUrl)) {
                            $select = array_merge(
                                [
                                    'answer_file_url' => $fileUrl,
                                    'file_type' => $formate
                                ],
                                $select
                            );
                            $where = [];
                            if (is_numeric($questionExists) && $questionExists === 0) {
                                $select =  array_merge($select, ['created_at' =>  $this->time]);
                            } else {
                                $where = ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'question_id' => $question, 'is_active' => 1];
                            }
                            $updateCourse = processData(['exam_mock_answers', 'id'], $select, $where);
                            if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                $examTitle = getExamTitle(2, $exam_id);
                                return json_encode(['code' => 200, 'title' => $type." Content Submitted", "message" => (isset($examTitle) && $examTitle !== null ? $examTitle : $type)." content submitted successfully", "icon" => generateIconPath("success"), 'filename' => $filename]);
                            }
                            DB::rollback();
                        }
                        return json_encode(['code' => 201, 'title' => "Please Upload File", 'message' => '', "icon" => generateIconPath("warning")]);
                    } catch (\Throwable $th) {
                        return $th;
                        DB::rollback();
                        return json_encode(['code' => 201, 'title' => "Unable to submit exam content", 'message' => 'Something went wrong. Please try again...', "icon" => generateIconPath("error")]);
                    }
                } else {
                    return json_encode(['code' => 202, 'title' => 'Course not exist or expired', 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
            } else {
                return json_encode(['code' => 404, 'title' => 'Exam not Exist', 'message' => 'Please try again', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
    public function mockSubmit(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check() && count($req->input('question_id')) > 0) {
            $user_id = Auth::user()->id;
            $exam_id  = isset($req->exam_id) ? base64_decode($req->input('exam_id')) : 0;
            $course_id  = isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;
            $question  = isset($req->question_id) && is_array($req->question_id) ? $req->input('question_id') : [];
            $student_course_master_id  = isset($req->student_course_master_id) ? base64_decode($req->input('student_course_master_id')) : 0;
            $type = isset($req->type) ? $req->type : '';
            $examTitle = getExamTitle(2, $exam_id);
            $has_accepted_exam_instructions = $req->has_accepted_exam_instructions == 'true' ? 1 : 0;
          
            $validate_rules = [
                'question_id' => 'required|array',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
               
                $examExit = is_exist('exam_mock_interview', ['id' => $exam_id, 'is_deleted' => 'No']);
                if (isset($examExit) && is_numeric($examExit) && $examExit > 0) {
                    $course = getData('exam_mock_interview', ['award_id'], ['id' => $exam_id, 'is_deleted' => 'No']);
                    $course_id = isset($course[0]->award_id) ? $course[0]->award_id : 0;
                    $courseExpired = is_expired(['user_id' => $user_id, 'course_id' => isset($req->master_course_id) ? base64_decode($req->input('master_course_id')): $course_id]);
                    if (isset($courseExpired) && is_numeric($courseExpired) && $courseExpired >= 0) {

                        try {
                            if (count($question) > 0) {
                                $i = 0;
                                DB::beginTransaction();
                                foreach ($question as $questions) {
                                    $questions_id =  base64_decode($questions);
                                    $select = [
                                        'is_attempt' => '1',
                                        'last_updated_by' => $user_id,
                                    ];
                                    $where = ['user_id' => $user_id, 'course_id' => $course_id, 'question_id' => $questions_id];
                                    $isAttempt = is_exist('exam_mock_answers', $where);
                                }

                                $select = ['user_id' => $user_id, 'course_id' => $course_id, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam_id, 'exam_type' => 2, 'submitted_on' => $this->time, 'created_at' => $this->time, 'has_accepted_exam_instructions' => $has_accepted_exam_instructions];
                                $where =  ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'exam_id' => $exam_id, 'exam_type' => 2, 'is_active' => '1'];
                                
                                $updateCourse = saveData($this->ExamRemark, $select, $where);
                                if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                    DB::commit();
                                    
                                    // $examManagementMaster = getCourseExamCount(base64_encode($course_id));
                                    
                                    // $examRemarkMasters = ExamRemarkMaster::where([
                                    //     'course_id' => $course_id,
                                    //     'user_id' => $user_id,
                                    //     'is_active' => '1',
                                    // ])->latest()->count();
                                    
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
                                    //         (isset($examTitle) && $examTitle !== null ? $examTitle : $type),
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
                                    //     '#Exam#' => (isset($examTitle) && $examTitle !== null ? $examTitle : $type),
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
                                    //     'exam_type' => '2',
                                    //     'exam_name' => (isset($examTitle) && $examTitle !== null ? $examTitle : $type),
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
                                    
                                    isset($req->master_course_id) ? session(['exam_type' => 'content2-'.$courseData[0]->id.'-'.$req->index]) : session(['exam_type' => 'content2-'.$req->index]);

                                    if (session()->has('lastAnswerSubmit')) {
                                        session()->forget('lastAnswerSubmit');
                                    }
                                    
                                    if (session()->has('reflectiveJournalExamCourseId')) {
                                        session()->forget('reflectiveJournalExamCourseId');
                                    }
                                            
                                    if (session()->has('eportfolio')) {
                                        session()->forget('eportfolio');
                                    }

                                    
                                    return json_encode(['code' => 200, 'title' => "Submitted Successfully", "message" => (isset($examTitle) && $examTitle !== null ? $examTitle : $type) ." submitted successfully", "icon" => generateIconPath("success")]);
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
                        return json_encode(['code' => 202, 'title' => 'Course not exist or expired', 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
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