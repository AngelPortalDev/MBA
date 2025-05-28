<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,  Validator, DB, Storage};
use App\Models\ExamRemarkMaster;
use App\Models\User;
use File;
use App\Models\Notification;
use App\Notifications\SendNotification;
use Smalot\PdfParser\Parser;

class ArtificialIntelligenceController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function ArtificialIntelligenceSubmit(Request $req)
    {
        // dd($req->all());
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $user_id = Auth::user()->id;
            $course_id  = isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;
            $exam_id  = isset($req->exam_id) ? base64_decode($req->input('exam_id')) : 0;
            $exam_type  = isset($req->exam_type) ? base64_decode($req->input('exam_type')) : 0;
            $question_id  = isset($req->question_id) ? base64_decode($req->input('question_id')) : 0;
            $link = isset($req->link) ? htmlspecialchars_decode($req->input('link')) : '';
            $pdf_file = $req->hasFile('pdf_file') ? $req->file('pdf_file') : 0;
            $requirement_file = $req->hasFile('requirement_file') ? $req->file('requirement_file') : 0;
            $student_course_master_id  = isset($req->student_course_master_id) ? base64_decode($req->input('student_course_master_id')) : 0;
            $type = isset($req->type) ? $req->type : '';
            $has_accepted_exam_instructions = $req->has_accepted_exam_instructions == 'true' ? 1 : 0;
            
            try {

                $messages = [];
                $validate = [];

                // Validate the PDF file if uploaded
                if ($req->hasFile('pdf_file')) {
                    $validate = array_merge($validate, [
                        'link' => ['required', 'url'],
                        'pdf_file' => ['required', 'mimes:pdf', 'max:5120']
                    ]);
                    $messages = [
                        'link.required' => 'The link field is required.',
                        'pdf_file.required' => 'The PDF file is required.',
                        'pdf_file.max' => 'The file must not be greater than 5MB.',
                        'pdf_file.mimes' => 'The docs file must be a valid PDF.',
                    ];
                }

                // Validate the requirement file if uploaded
                if ($req->hasFile('requirement_file')) {
                    $validate = array_merge($validate, ['requirement_file' => ['required', 'mimes:txt,zip', 'max:5120']]);
                    $messages = array_merge($messages, [
                        'requirement_file.max' => 'The requirement file must not be greater than 5MB.',
                        'requirement_file.mimes' => 'The requirement file must be a valid text or zip file.',
                    ]);
                }

                // Validate the request
                $validator = \Validator::make($req->all(), $validate, $messages);

                // Check if validation fails
                if ($validator->fails()) {
                    return json_encode([
                        'code' => 201,
                        'message' => 'File validation failed',
                        'errors' => $validator->errors(),
                        'icon' => generateIconPath("error")
                    ], 400);
                }
                if ($req->hasFile('pdf_file')) {
                    $pdfFile = $req->file('pdf_file');
        
                    try {
                        $parser = new Parser();
                        $pdf = $parser->parseFile($pdfFile->getPathname());
                        $pageCount = count($pdf->getPages());
        
                        if ($pageCount > 10) {
                            return response()->json([
                                'code' => 201,
                                'message' => 'File validation failed',
                                'errors' => ['pdf_file' => ['The PDF file must not be more than 10 page.']], // Correct format
                                'icon' => generateIconPath("error")
                            ]);
                        }
                    } catch (\Exception $e) {
                        return response()->json([
                            'code' => 201,
                            'message' => 'Error processing PDF file',
                            'errors' => ['pdf_file' => 'Unable to read the PDF file. Please try again.'],
                            'icon' => generateIconPath("error")
                        ], 400);
                    }
                }

            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            $examExit = is_exist('exam_artificial_intelligence', ['id' => $exam_id, 'is_deleted' => 'No']);
            $questionExists = is_exist('exam_artificial_intelligence_answers', ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'question_id' => $question_id, 'is_active' => 1]);
            if (isset($examExit) && is_numeric($examExit) && $examExit > 0) {
                $course = getData('exam_artificial_intelligence', ['award_id'], ['id' => $exam_id, 'is_deleted' => 'No']);
                $course_id = isset($course[0]->award_id) ? $course[0]->award_id : 0;
                $courseExpired = is_expired(['user_id' => $user_id, 'course_id' => isset($req->master_course_id) ? base64_decode($req->input('master_course_id')): $course_id]);
                if (isset($courseExpired) && is_numeric($courseExpired) && $courseExpired > 0) {
                    try {

                        $select = [
                            'student_course_master_id' => $student_course_master_id,
                            'type' => $type,
                            'user_id' => $user_id,
                            'course_id' => $course_id,
                            'question_id' => $question_id,
                            'link' => $link,
                            'last_updated_by' => $user_id,
                        ];
                        $getexistData = getData(
                            'exam_artificial_intelligence_answers',
                            ['pdf_file', 'requirement_file'],
                            ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'question_id' => $question_id]
                        );

                        $pdfFileExist = isset($getexistData[0]->pdf_file) && !empty($getexistData[0]->pdf_file) ? $getexistData[0]->pdf_file : '';
                        
                        $pdfFileUrl = '';
                        $pdfFilename = '';
                        

                        if ($req->hasFile('pdf_file') && $pdf_file->getClientOriginalExtension() == 'pdf') { 
                            $pdfFilename = $pdf_file->getClientOriginalName();
                            $pdfFile_url =  UploadFiles($pdf_file, 'course/ArtificialIntelligence/Pdf', $pdfFileExist);
                            if ($pdfFile_url === FALSE) {
                                return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => generateIconPath("error")]);
                            }
                            if (isset($pdfFile_url['url']) && Storage::disk('local')->exists($pdfFile_url['url'])) {
                                $pdfFileUrl = !empty($pdfFile_url['url']) ? $pdfFile_url['url'] : 'No File';
                            } else {
                                return json_encode(['code' => 201, 'title' => "Unable to Upload Pdf", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                            }
                        }
                        
                        $requirementFileExist = isset($getexistData[0]->requirement_file) && !empty($getexistData[0]->requirement_file) ? $getexistData[0]->requirement_file : '';
                        $requirementFile_url = '';
                        $requirementFilename = '';

                        if ($req->hasFile('requirement_file') && in_array($requirement_file->getClientOriginalExtension(), ['txt', 'zip'])) {
                            $requirementFilename = $requirement_file->getClientOriginalName();
                            $requirementFile_url = UploadFiles($requirement_file, 'course/ArtificialIntelligence/Requirements', $requirementFileExist);
                            // dd($requirementFile_url);
                            if ($requirementFile_url === FALSE) {
                                return json_encode(['code' => 201, 'message' => 'Requirement file is corrupt', 'title' => "File is corrupt", "icon" => generateIconPath("error")]);
                            }
                            if (isset($requirementFile_url['url']) && Storage::disk('local')->exists($requirementFile_url['url'])) {
                                $requirementFileUrl = !empty($requirementFile_url['url']) ? $requirementFile_url['url'] : 'No File';
                            } else {
                                return json_encode(['code' => 201, 'title' => "Unable to Upload Requirement File", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                            }
                        }

                        

                        if (isset($pdfFileUrl) && !empty($pdfFileUrl) && isset($requirementFileUrl) && !empty($requirementFileUrl)) {
                            $select = array_merge(
                                [
                                    'pdf_file' => $pdfFileUrl, // PDF file URL
                                    'pdf_file_name' => $pdfFilename, // PDF file Name
                                    'requirement_file' => $requirementFileUrl, // Requirement file URL
                                    'requirement_file_name' => $requirementFilename, // Requirement file Name
                                ],
                                $select
                            );
                            
                            $where = [];
                            if (is_numeric($questionExists) && $questionExists === 0) {
                                $select = array_merge($select, ['created_at' =>  $this->time]);
                            } else {
                                $where = ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'question_id' => $question_id, 'is_active' => 1];
                            }
                            
                            // Process the data
                            $updateCourse = saveData($this->artificialIntelligenceAnswers, $select, $where);
                            if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                                DB::commit();
                                
                                $studentCourseMaster = getStudentCourseMaster(base64_encode($user_id), isset($req->master_course_id) ? $req->input('master_course_id'): base64_encode($course_id));

                                $select = ['user_id' => $user_id, 'course_id' => $course_id, 'student_course_master_id' => $studentCourseMaster->id, 'exam_id' => $exam_id, 'exam_type' => 9, 'submitted_on' => $this->time, 'created_at' => $this->time, 'has_accepted_exam_instructions' => $has_accepted_exam_instructions];
                                $where =  ['student_course_master_id' => $student_course_master_id, 'user_id' => $user_id, 'course_id' => $course_id, 'exam_id' => $exam_id, 'exam_type' => 9, 'is_active' => '1'];
                                
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
                                    
                                    isset($req->master_course_id) ? session(['exam_type' => 'content9-'.$courseData[0]->id.'-'.$req->index]) : session(['exam_type' => 'content9-'.$req->index]);
                                    
                                    if (session()->has('lastAnswerSubmit')) {
                                        session()->forget('lastAnswerSubmit');
                                    }
                                    
                                    if (session()->has('reflectiveJournalExamCourseId')) {
                                        session()->forget('reflectiveJournalExamCourseId');
                                    }
                                            
                                    if (session()->has('eportfolio')) {
                                        session()->forget('eportfolio');
                                    }

                                    return json_encode(['code' => 200, 'title' => "Submitted Successfully", "message" => (isset($examTitle) && $examTitle !== null ? $examTitle : 'Artificial Intelligence') . " submitted successfully", "icon" => generateIconPath("success")]);
                                }
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
}
