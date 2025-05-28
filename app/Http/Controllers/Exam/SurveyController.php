<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,  Validator, DB, Storage};
use App\Rules\WordCount;
use App\Models\ExamRemarkMaster;
use App\Models\User;
use File;
use App\Models\Notification;
use App\Notifications\SendNotification;

class SurveyController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function surveySubmit(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check() && count($req->input('question_id')) > 0) {
            $user_id = Auth::user()->id;
            $exam_id  = isset($req->exam_id) ? base64_decode($req->input('exam_id')) : 0;
            $exam_type  = isset($req->exam_type) ? base64_decode($req->input('exam_type')) : 0;
            $question  = isset($req->question_id) && is_array($req->question_id) ? $req->input('question_id') : [];
            $answers  = isset($req->answers) && is_array($req->answers) ? $req->input('answers') : [];
            $answer_limit  = isset($req->answer_limit) && is_array($req->answer_limit) ? $req->input('answer_limit') : [];
            $files = $req->file('survey_file');
            $student_course_master_id  = isset($req->student_course_master_id) ? base64_decode($req->input('student_course_master_id')) : 0;
            $type = isset($req->type) ? $req->type : '';
            $examTitle = getExamTitle(8, $exam_id);
            $has_accepted_exam_instructions = $req->has_accepted_exam_instructions == 'true' ? 1 : 0;
            
            $inputConfiguration = getData('exam_input_configurations', ['id', 'mimes', 'max_size', 'is_required'], ['exam_id' => $exam_id, 'exam_type' => '8', 'question_id' => base64_decode($question[0]), 'is_deleted' => 'No']);

            try{
                foreach ($inputConfiguration as $config) {
                    $configId = $config->id;
                    if (isset($files[$config->id])) {
                        $fileKey = $files[$config->id];
                        if ($fileKey) {
                    
                            $mimes = $config->mimes;
                    
                            $rules = [];
                    
                            if ($mimes != '') {
                                $file = $fileKey;
                                $rules[] = 'mimes:' . $mimes;
        
                                if ($config->max_size != '') {
                                    $maxSize = $config->max_size;
                    
                                    if (preg_match('/(\d+)([KMG]{1})?/', $maxSize, $matches)) {
                                        $size = $matches[1];
                                        $size *= 1024;
                    
                                        $rules[] = 'max:' . $size; 
                                    }
                                }
                    
                                if ($config->is_required) {
                                    $rules[] = 'required';
                                }
                            }
        
                            $validationRules = [];
                            $validationRules = implode('|', $rules);
        
                            $rules = [
                                'survey_file' => $validationRules,
                            ];
        
                            $data = [
                                'survey_file' => $req->file('survey_file')[$config->id]
                            ];
                            $maxSizeInMB = $size / (1024);
                            $customMessages = [
                                'survey_file.required' => 'File is required.',
                                'survey_file.mimes' => 'File must be a PDF.',
                                'survey_file.max' => "File may not be greater than {$maxSizeInMB} MB.",
                            ];
        
                            $validator = Validator::make($data, $rules, $customMessages);
        
                            if ($validator->fails()) {
                                $formattedErrors = [];
                                foreach ($validator->errors()->messages() as $key => $messages) {
                                    $formattedErrors["survey_file[{$configId}]"] = $messages;
                                }
                            
                                return response()->json([
                                    'code' => 202,
                                    'message' => 'Validation errors occurred.',
                                    'errors' => $formattedErrors,
                                ], 202);
                            }
                        }
                    }
                }
            } catch (\Throwable $th) {
                return $th;
                DB::rollback();
                return json_encode(['code' => 201, 'title' => "Unable to submit exam content", 'message' => 'Something went wrong. Please try again...', "icon" => generateIconPath("error")]);
            }
            $validate_rules = [
                'question_id' => 'required|array',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                $examExit = is_exist('exam_survey', ['id' => $exam_id, 'is_deleted' => 'No']);
                if (isset($examExit) && is_numeric($examExit) && $examExit > 0) {
                    $course = getData('exam_survey', ['award_id'], ['id' => $exam_id, 'is_deleted' => 'No']);
                    $course_id = isset($course[0]->award_id) ? $course[0]->award_id : 0;
                    $courseExpired = is_expired(['user_id' => $user_id, 'course_id' => isset($req->master_course_id) ? base64_decode($req->input('master_course_id')): $course_id]);
                    if (isset($courseExpired) && is_numeric($courseExpired) && $courseExpired > 0) {

                        try {
                            if (count($question) > 0) {
                                $i = 0;
                                DB::beginTransaction();
                                $rules = [];
                                $j=0;
                                $k=0;
                                foreach ($question as $questions) {
                                    $answer_limits = base64_decode($answer_limit[$j]);
                                    $rules["answers.$j"] = [new WordCount($answer_limits)];                         
                                    $j++;

                                    // if (isset($files[$k])) {
                                    //     $file = $files[$k];
                                    //     $fileValidator = Validator::make(
                                    //         ['docFile' => $file],
                                    //         ['docFile' => ['required', 'mimes:pdf', 'max:5120']],
                                    //         ['docFile.max' => 'The document file must not be greater than 5MB.']
                                    //     );
                                    // }
                                }    
                            
                                $validator = Validator::make($req->all(), $rules);
                                if ($validator->fails()) {
                                    return json_encode(['code' => 202, 'title' => 'Word Count Exceeded', 'message' => 'Word count cannot exceed the allowed limit.', "icon" => generateIconPath("error"), 'data' => $validator->errors()]);

                                }

                                foreach ($question as $key => $questions) {
                                    $questions_id =  base64_decode($questions);
                                    $answer_value = $answers[$i] ?? null;
                                        
                                    $select = [
                                        'student_course_master_id' => $student_course_master_id,
                                        'type' => $type,
                                        'user_id' => $user_id,
                                        'course_id' => $course_id,
                                        'question_id' => $questions_id,
                                        'answer' => $answers[$key],
                                        // 'answer' => $answer_value,
                                        'last_updated_by' => $user_id,
                                        'created_at' =>  $this->time
                                    ];
                                    
                                    $where = [
                                        'student_course_master_id' => $student_course_master_id,
                                        'user_id' => $user_id,
                                        'course_id' => $course_id,
                                        'question_id' => $questions_id,
                                        'is_active' => '1',
                                    ];
                                    // $updateCourse = processData(['exam_survey_answers', 'id'], $select, $where);
                                    $updateCourse = saveData($this->surveyAnswers, $select, $where);
                                    
                                    if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                        // new code start (14-04-2025)
                                        $inputConfigs = getData(
                                            'exam_input_configurations',
                                            ['id'],
                                            ['exam_type' => 8, 'exam_id' => $exam_id, 'question_id' => $questions_id, 'is_deleted' => 'No']
                                        );
                                        
                                        foreach ($inputConfigs as $configIndex => $config) {
                                            $input_id = $config->id;

                                            if (!isset($files[$input_id])) continue; // skip if no file uploaded for this input_id

                                            $file = $files[$input_id];
                                            $fileType = $file->getClientMimeType();
                                            $fileTypeValue = ($fileType == 'application/pdf') ? 1 : (($fileType == 'video/mp4') ? 2 : 0);

                                            $existing = getData(
                                                'exam_input_files',
                                                ['file_url'],
                                                ['exam_type' => 8, 'question_id' => $questions_id, 'input_id' => $input_id, 'is_active' => 1]
                                            );

                                            $fileExist = !empty($existing[0]->file_url) ? $existing[0]->file_url : '';

                                            $filename = $file->getClientOriginalName();
                                            $docFile_url = UploadFiles($file, 'course/ExamInputDocs', $fileExist);

                                            if ($docFile_url === FALSE) {
                                                return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => generateIconPath("error")]);
                                            }

                                            $fileUrl = (!empty($docFile_url['url']) && Storage::disk('local')->exists($docFile_url['url'])) 
                                                ? $docFile_url['url'] 
                                                : '';

                                            if (empty($fileUrl)) {
                                                return json_encode(['code' => 201, 'title' => "Unable to Upload Pdf", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                                            }

                                            $fileInsert = [
                                                'exam_type' => 8,
                                                'user_id' => $user_id,
                                                'student_course_master_id' => $student_course_master_id,
                                                'exam_id' => $exam_id,
                                                'answer_id' => $updateCourse['id'],
                                                'question_id' => $questions_id,
                                                'input_id' => $input_id,
                                                'file_type' => $fileTypeValue,
                                                'file_url' => $fileUrl,
                                                'file_name' => $filename,
                                                'created_at' => $this->time
                                            ];

                                            $process = processData(['exam_input_files', 'id'], $fileInsert);
                                            if (isset($process) && is_array($process) && $process['status'] === TRUE) {
                                                $i++;
                                            }
                                        }
                                        // new code end (14-04-2025)

                                        // $i++;
                                        // foreach ($files as $index => $file) {
                                        //     $getexistData = getData(
                                        //         'exam_input_files',
                                        //         ['file_url'],
                                        //         ['exam_type' => 8, 'question_id' => $questions_id, 'input_id' => $index, 'is_active' => 1]
                                        //     );
    
                                        //     $fileExist = isset($getexistData[0]->file_url) && !empty($getexistData[0]->file_url) ? $getexistData[0]->file_url : '';
    
                                        //     $fileUrl = '';
                                        //     $filename = '';
                                        //     $fileType =  $file->getClientMimeType();
                                        //     if ($fileType == 'application/pdf') {
                                        //         $fileTypeValue = 1;
                                        //     } elseif ($fileType == 'video/mp4') {
                                        //         $fileTypeValue = 2;
                                        //     }
                                        //     if(isset($files[$index])){
                                        //         $file = $files[$index];
    
                                        //         $filename = $files[$index]->getClientOriginalName();

                                        //         $docFile_url =  UploadFiles($files[$index], 'course/ExamInputDocs', $fileExist);
                                        //         if ($docFile_url === FALSE) {
                                        //             return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => generateIconPath("error")]);
                                        //         }
                                        //         if (isset($docFile_url['url']) && Storage::disk('local')->exists($docFile_url['url'])) {
                                        //             $fileUrl = !empty($docFile_url['url']) ? $docFile_url['url'] : 'No File';
                                        //         } else {
                                        //             return json_encode(['code' => 201, 'title' => "Unable to Upload Pdf", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                                        //         }
                                                
                                        //         $select = [
                                        //             'exam_type' => 8,
                                        //             'user_id' => $user_id,
                                        //             'student_course_master_id' => $student_course_master_id,
                                        //             'exam_id' => $exam_id,
                                        //             'answer_id' => $updateCourse['id'],
                                        //             'question_id' => $questions_id,
                                        //             'input_id' => $index,
                                        //             'file_type' => $fileTypeValue,
                                        //             'file_url' => $fileUrl,
                                        //             'file_name' => $filename,
                                        //             'created_at' =>  $this->time
                                        //         ];
                                        //         $updateCourse = processData(['exam_input_files', 'id'], $select);
                                        //         if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                        //             $i++;
                                        //         }

                                        //     }
                                            
                                        // }
                                    }
                                }

                                if ($i > 0) {

                                    $select = ['user_id' => $user_id, 'course_id' => $course_id, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam_id, 'exam_type' => 8, 'submitted_on' => $this->time, 'created_at' => $this->time, 'has_accepted_exam_instructions' => $has_accepted_exam_instructions];
                                    $where =  ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'exam_id' => $exam_id, 'exam_type' => 8, 'is_active' => '1'];
                                    // $updateCourse = processData(['exam_remark_master', 'id'], $select, $where);
                                    $updateCourse = saveData($this->ExamRemark, $select, $where);
                                    if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                        DB::commit();
        
                                        // $examManagementMaster = getCourseExamCount(base64_encode($course_id));
                                        
                                        // $examRemarkMasters = ExamRemarkMaster::where([
                                        //     // 'student_course_master_id' => $student_course_master_id,
                                        //     'course_id' => $course_id,
                                        //     'user_id' => $user_id,
                                        //     'is_active' => '1',
                                        // ])->count();
                                        
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
                                        //         (isset($examTitle) && $examTitle !== null ? $examTitle : 'Survey'),
                                        //         $courseData[0]->course_title,
                                        //         $unsubscribeRoute
                                        //     ], 
                                        //     Auth::user()->email
                                        // );
                                        

                                        // $subEmentorId = getAssignedSubMentor($user_id, $course_id, $student_course_master_id);
                                        // $ementorId = isset($courseData[0]->ementor_id) ? $courseData[0]->ementor_id : 0;
                                        // $ementorData = getData('users', ['name', 'last_name', 'email'], ['id' => $ementorId]);
                                    
                                        // // Default values
                                        // $recipientEmail = $ementorData[0]->email;
                                        // $ccEmail = null;
                                        
                                        // if ($subEmentorId) {
                                        //     $subEmentorData = getData('users', ['name', 'last_name', 'email'], ['id' => $subEmentorId]);
                                        //     $recipientEmail = $subEmentorData[0]->email;
                                            
                                        //     $ccEmail = $ementorData[0]->email;  // Set e-mentor as CC if sub-mentor exists
                                        // }
                                        
                                        // // Prepare email data
                                        // $mailData = [
                                        //     '#EmentorName#' => $subEmentorId ? $subEmentorData[0]->name . " " . $subEmentorData[0]->last_name : $ementorData[0]->name . " " . $ementorData[0]->last_name,
                                        //     '#StudentName#' => Auth::user()->name . " " . Auth::user()->last_name,
                                        //     '#Exam#' => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Survey'),
                                        //     '#Course Name#' => $courseData[0]->course_title,
                                        //     '#Submission Date#' => now()->format('Y-m-d'),
                                        //     '#unsubscribeRoute#' => $ementorData[0]->email
                                        // ];
                                        
                                        // // Send the email
                                        // mail_send(43, array_keys($mailData), array_values($mailData), $recipientEmail, $ccEmail);

                                        // // mail_send(43, 
                                        // //     [
                                        // //         '#EmentorName#',
                                        // //         '#StudentName#',
                                        // //         '#Exam#',
                                        // //         '#Course Name#',
                                        // //         '#Submission Date#',
                                        // //         '#unsubscribeRoute#',
                                        // //     ], 
                                        // //     [
                                        // //         $ementorData[0]->name. " ".$ementorData[0]->last_name,
                                        // //         Auth::user()->name. " ".Auth::user()->last_name,
                                        // //         'Survey',
                                        // //         $courseData[0]->course_title,
                                        // //         now()->format('Y-m-d'),
                                        // //         $ementorData[0]->email
                                        // //     ], 
                                        // //     $ementorData[0]->email
                                        // // );
                                        
                                        // $mentorIds = User::where('id', $ementorId)->pluck('id')->toArray();
                                        // $data = [
                                        //     'student_name' => Auth::user()->name. " ".Auth::user()->last_name,
                                        //     'student_id' => base64_encode(Auth::user()->id),
                                        //     'student_course_master_id' => base64_encode($student_course_master_id),
                                        //     'exam_type' => '1',
                                        //     'exam_name' => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Survey'),
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
                                        
                                        // isset($req->master_course_id) ? session(['exam_type' => 'content8-'.$courseData[0]->id]) : session(['exam_type' => 'content8']);
                                        isset($req->master_course_id) ? session(['exam_type' => 'content8-'.$course_id.'-'.$req->index]) : session(['exam_type' => 'content8-'.$req->index]);

                                        if (session()->has('lastAnswerSubmit')) {
                                            session()->forget('lastAnswerSubmit');
                                        }
                                        
                                        if (session()->has('reflectiveJournalExamCourseId')) {
                                            session()->forget('reflectiveJournalExamCourseId');
                                        }
                                            
                                        if (session()->has('eportfolio')) {
                                            session()->forget('eportfolio');
                                        }


                                        return json_encode(['code' => 200, 'title' => "Submitted Successfully", "message" => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Survey') . " submitted successfully", "icon" => generateIconPath("success"), "redirect" => (isset($req->master_course_id) ? $req->input('master_course_id'): base64_encode($course_id)) . '/' . base64_encode($student_course_master_id)]);
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
}
