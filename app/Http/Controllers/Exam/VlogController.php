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

class VlogController extends Controller
{
    public $vlog_collection;
    public function __construct()
    {
        parent::__construct();
        $this->vlog_collection = env('EXAM_VLOG_COLLECTION');
    }
    
    public function vlogSubmit(Request $req)
    {
        ini_set('memory_limit', '512M');
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $user_id = Auth::user()->id;
            $course_id  = isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;
            $exam_id  = isset($req->exam_id) ? base64_decode($req->input('exam_id')) : 0;
            $instruction_file = $req->hasFile('instruction_file') ? $req->file('instruction_file') : 0;
            $questions  = isset($req->question_id) && is_array($req->question_id) ? $req->input('question_id') : [];
            $student_course_master_id  = isset($req->student_course_master_id) ? base64_decode($req->input('student_course_master_id')) : 0;
            $type  = isset($req->type) ? $req->input('type') : '';
            $examTitle = getExamTitle(3, $exam_id);
            $has_accepted_exam_instructions = $req->has_accepted_exam_instructions == 'true' ? 1 : 0;

            try {
                $validate = [];
                $messages = [];
                if ($req->hasFile('instruction_file')) {
                    $validate = ['instruction_file' => ['required', 'mimes:mp4','max:512000']];
                    $messages = [
                        'instruction_file.max' => 'The file must not be greater than 500MB.',
                    ];
                }
                $req->validate($validate,$messages);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            $examExit = is_exist('exam_vlog', ['id' => $exam_id, 'is_deleted' => 'No']);
            $questionExists = is_exist('exam_vlog_answers', ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'is_active' => '1']);
            if (isset($examExit) && is_numeric($examExit) && $examExit > 0) {
                $course = getData('exam_vlog', ['award_id'], ['id' => $exam_id, 'is_deleted' => 'No']);
                $course_id = isset($course[0]->award_id) ? $course[0]->award_id : 0;
                $courseExpired = is_expired(['user_id' => $user_id, 'course_id' => isset($req->master_course_id) ? base64_decode($req->input('master_course_id')): $course_id]);
                if (isset($courseExpired) && is_numeric($courseExpired) && $courseExpired > 0) {
                    try {

                        $select = [
                            'student_course_master_id' => $student_course_master_id,
                            'type' => $type,
                            'user_id' => $user_id,
                            'course_id' => $course_id,
                            'last_updated_by' => $user_id, 
                            'question_id' => isset($questions[0]) ? base64_decode($questions[0]) : 0,
                        ];
                        $getexistData = getData(
                            'exam_vlog_answers',
                            ['answer_file_url'],
                            ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'is_active' => '1']
                        );

                        $fileExist = isset($getexistData[0]->answer_file_url) && !empty($getexistData[0]->answer_file_url) ? $getexistData[0]->answer_file_url : '';
                        
                        $fileUrl = '';
                        $filename = '';

                        if ($req->hasFile('instruction_file') && $instruction_file->getClientOriginalExtension() == 'mp4') {
                            $filename = $instruction_file->getClientOriginalName();
                            $library  = 3;
                            $collection_id = $this->vlog_collection;
                            $getuserData = getData(
                                'users',
                                ['name', 'last_name'],
                                ['id' => $user_id, 'is_deleted' => 'No']
                            );
                            $name = $getuserData[0]->name;
                            $last_name = $getuserData[0]->last_name;
                            $fullname =  $name . " " . $last_name;
                            $videoContent = [$collection_id, $instruction_file, $fullname];
                            
                            if (isset($fileExist) && !empty($fileExist) && $fileExist != '') {
                                $vidoId = $this->CourseModule->videoAction($fileExist, $videoContent, 'REPLACE', $library);
                            } else {
                                $vidoId = $this->CourseModule->getVideoId($collection_id, $instruction_file, $fullname, $library);
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
                                ],
                                $select
                            );
                            $where = [];
                            if (is_numeric($questionExists) && $questionExists === 0) {
                                $select =  array_merge($select, ['created_at' =>  $this->time, 'question_id' => isset($questions[0]) ? base64_decode($questions[0]) : 0]);
                            } else {
                                $where = ['user_id' => $user_id, 'course_id' => $course_id, 'is_active' => '1'];
                            }
                            DB::beginTransaction();

                            $oldData = DB::table('exam_vlog_answers')->where(['user_id' => $user_id, 'course_id' => $course_id, 'is_active' => '1'])->get();

                            if(count($oldData)>0){
                                foreach($oldData as $data){
                                    $updateData = [
                                        'is_active' => '0',
                                    ];
                                    
                                    DB::table('exam_vlog_answers')->where('id', $data->id)->update($updateData);
                                }
                            }

                            // $updateCourse = processData(['exam_vlog_answers', 'id'], $select, $where);
                            $updateCourse = saveData($this->vlogAnswers, $select, $where);
                            if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                DB::commit();
                                
                                $studentCourseMaster = getStudentCourseMaster(base64_encode($user_id), isset($req->master_course_id) ? $req->input('master_course_id'): base64_encode($course_id));

                                $select = ['user_id' => $user_id, 'course_id' => $course_id, 'student_course_master_id' => $studentCourseMaster->id, 'exam_id' => $exam_id, 'exam_type' => 3, 'submitted_on' => $this->time, 'created_at' => $this->time, 'has_accepted_exam_instructions' => $has_accepted_exam_instructions];
                                $where =  ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'exam_id' => $exam_id, 'exam_type' => 3, 'is_active' => '1'];
                                
                                // $updateCourse = processData(['exam_remark_master', 'id'], $select, $where);
                                $updateCourse = saveData($this->ExamRemark, $select, $where);
                                if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                    DB::commit();
                                     
                                    // $examManagementMaster = DB::table('exam_management_master')->where(['course_id' => $course_id, 'is_deleted' => 'No'])->where('exam_type' , '!=', '5')->count();
                                        
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
                                    //         (isset($examTitle) && $examTitle !== null ? $examTitle : 'Vlog'),
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
                                    //     '#Exam#' => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Vlog'),
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
                                    //     'exam_type' => '3',
                                    //     'exam_name' => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Vlog'),
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
                                    
                                    isset($req->master_course_id) ? session(['exam_type' => 'content3-'.$courseData[0]->id.'-'.$req->index]) : session(['exam_type' => 'content3-'.$req->index]);
                                    
                                    if (session()->has('lastAnswerSubmit')) {
                                        session()->forget('lastAnswerSubmit');
                                    }
                                    
                                    if (session()->has('reflectiveJournalExamCourseId')) {
                                        session()->forget('reflectiveJournalExamCourseId');
                                    }
                                            
                                    if (session()->has('eportfolio')) {
                                        session()->forget('eportfolio');
                                    }

                                    
                                    return json_encode(['code' => 200, 'title' => "Submitted Successfully", "message" => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Vlog') . " submitted successfully", "icon" => generateIconPath("success"), 'filename' => $filename]);
                                }
                            }
                            DB::rollback();
                        }
                        return json_encode(['code' => 201, 'title' => "Unable to Upload File", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error")]);
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
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
}
