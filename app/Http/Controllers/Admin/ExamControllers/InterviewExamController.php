<?php

namespace App\Http\Controllers\Admin\ExamControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,  Validator, Storage, DB};
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\MockExam;
use App\Models\MockExamQuestion;
use App\Models\ExamManage;

class InterviewExamController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function addMockInterview(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $award_id = isset($request->award_id) ? base64_decode($request->input('award_id')) : 0;
            $mockinterview_tittle = isset($request->mockinterview_tittle) ? htmlspecialchars_decode($request->input('mockinterview_tittle')) : '';

            try {
                $request->validate([
                    'award_id' => ['required', 'string'],
                    'mockinterview_tittle' => [
                        'required', 'min:3',
                        'max:255', 'string'
                    ],
                ],[
                    'mockinterview_tittle.min'=>'The mock interview title must be at least 3 characters.',
                    'mockinterview_tittle.max'=>'The mock interview title must be at least 255 characters.',
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            if (is_exist('course_master', ['id' => $award_id]) > 0) {
                try {
                    $where = ['award_id' => $award_id, 'is_deleted' => 'No', 'deleted_at' => null];
                    $exists = is_exist('exam_mock_interview', $where);
                    if (isset($exists) && $exists > 0) {
                        return json_encode([
                            'code' => 404, 'title' => "Already Added", 'message' => 'Course mock interview already added.', "icon" => generateIconPath("warning")
                        ]);
                    }else{
                        $select = [
                            'title' => $mockinterview_tittle,
                            'award_id' => $award_id,
                            'created_by' => $admin_id,
                            'is_deleted' => 'No',
                            'last_updated_by' => $admin_id,
                            'created_at' => $this->time,
                        ];
                        DB::beginTransaction();
                        $assignUpdate = processData(['exam_mock_interview', 'id'], $select);

                        if (isset($assignUpdate) && $assignUpdate['status'] === true) {
                            $select = [
                                'exam_id' => $assignUpdate['id'],
                                'course_id' => $award_id,
                                'exam_type' => 2,
                                'created_by' => $admin_id,
                                'created_at' => $this->time,
                            ];
                            $assginManagUpdate = processData(['exam_management_master', 'id'], $select);       

                            if (isset($assginManagUpdate) && $assginManagUpdate['status'] === true) {
                                DB::commit();
                                return json_encode(['code' => 200, 'title' => "Successfully Added", 'message' => 'Mock interview added successfully', "icon" => generateIconPath("success")]);
                            }
                        }
                        DB::rollBack();
                        return json_encode([
                            'code' => 404, 'title' => "Unable to Add Mock Interview", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                        ]);
                    }
                } catch (\Throwable $th) {
                    return $th;
                    DB::rollBack();
                    return json_encode([
                        'code' => 404, 'title' => "Unable to Add Mock Interview", 'message' => 'Something Went Wrong', "icon" => generateIconPath("error")
                    ]);
                }
            } else {
                return json_encode([
                    'code' => 404, 'title' => "Unable to Add Mock Interview", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                ]);
            }
        }
    }
    public function getMockData($action = '', $id = '')
    {
       
        if (Auth::check()) {
            $contentData = [];
            $id = isset($id) && !empty($id) ? base64_decode($id) : 0;
            $action = isset($action) && !empty($action) ? base64_decode($action) : 'All';

           
            $where = [];
            if (isset($action) && !empty($action) && $action != '' && $action != 'edit' && $action != 'All') {
                $where = [
                    'is_deleted' => $action
                ];
            }
       
            if (isset($id) && !empty($id)) {
                $whereId = [
                    'id' => $id
                ];
                $where = array_merge($where, $whereId);
            }
           
            if (isset($action) && !empty($action) && $action === 'edit') {
                $contentData = $this->mockExam->getMockQuestion($where);
                return view('admin/exam/edit-mock-interview', compact('contentData'));
            } else {
                $where = ['requires_word_count' => 0];
                $contentData = $this->mockExam->getMockDetails($where);
            }
            return response()->json($contentData);
        }
        return redirect('/login');
    }
    public function addMockQuestion(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {

            $admin_id = Auth::user()->id;
            $marks = isset($request->marks) ? htmlspecialchars($request->input('marks')) : '';
            $question = isset($request->question) ? htmlspecialchars_decode($request->input('question')) : '';
            $file_type = isset($request->file_type) && is_numeric($request->file_type) ? htmlspecialchars($request->input('file_type')) : '';
            $mock_id = isset($request->mock_id) ? base64_decode($request->input('mock_id')) : 0;
            $question_id = isset($request->question_id) ? base64_decode($request->input('question_id')) : 0;
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');
            $exists = is_exist('exam_mock_interview', ['id' => $mock_id, 'is_deleted' => 'No']);
            $Questionexists = is_exist('exam_mock_questions', ['id' => $question_id, 'is_deleted' => 'No']);
            $word_limit = isset($request->word_limit) ? htmlspecialchars($request->input('word_limit')) : '';

            try {
                $request->validate([
                    'question' => ['required', 'min:3', 'max:255'],
                    'marks' => ['required', 'numeric'],
                    'file_type' => ['required', 'numeric'],
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            $where = [];
            if (isset($exists) && is_numeric($exists) && $exists > 0) {
                $select = [
                    'mock_intr_id' =>  $mock_id,
                    'question' => $question,
                    'marks' => $marks,
                    'file_type' => $file_type,
                    'is_deleted' => 'No',
                ];
                if (!empty($word_limit)) {
                    $select['word_limit'] = $word_limit;
                }
                if (isset($Questionexists) && is_numeric($Questionexists) && $Questionexists > 0) {
                    $where = ['id' => $question_id, 'is_deleted' => 'No'];
                    $select = array_merge($select, ['last_updated_by' => $admin_id]);
                    $title = "Successfully Updated";
                    $message = "Question updated successfully";
                } else {
                    $select = array_merge($select, ['created_by' => $admin_id, 'created_at' => $timestamp]);
                    $title = "Successfully Added";
                    $message = "Question added successfully";
                }
                $updateUser = processData(['exam_mock_questions', 'id'], $select, $where);
                if (isset($updateUser) && $updateUser['status'] === true) {
                    return json_encode(['code' => 200, 'title' => $title, 'message' => $message, "icon" => generateIconPath("success"), "data" => $updateUser]);
                }
                return json_encode(['code' => 404, 'title' => "Unable to Add Question", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
            return json_encode(['code' => 404, 'title' => "Mock Interview Not Available", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
    
    public function editViewMockQeustion(Request $request)
    {
        if ($request->isMethod('POST') && Auth::check()) {
            $questionID = isset($request->question_id) ? base64_decode($request->input('question_id')) : 0;

            if (isset($questionID) && !empty($questionID)) {
                $exists = is_exist('exam_mock_questions', ['id' => $questionID, 'is_deleted' => 'No']);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $QuestionAssign = getData('exam_mock_questions', ['id', 'question', 'marks', 'mock_intr_id', 'file_type', 'word_limit'], ['id' => $questionID]);
                    return json_encode(['code' => 200, 'data' => $QuestionAssign[0]]);
                }
                return json_encode(['code' => 404, 'title' => "Question not Found", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            } else {
                return json_encode(['code' => 404, 'title' => "Mock Interview Not Available", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
        }
        return json_encode(['code' => 404, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
    }
    public function deleteMockQuestion(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;


            $table = "exam_mock_questions";
            $where = ['id' => $id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                $select = [
                    'is_deleted' => 'Yes',
                    'deleted_by' => $admin_id
                ];
                try {
                    DB::beginTransaction();
                    $updateSection = processData([$table, 'id'], $select, $where);
                    if (isset($updateSection) && $updateSection['status'] === true) {
                        DB::commit();
                        return json_encode(['code' => 200, 'title' => 'Successfully Deleted', "message" => "Question deleted successfully", "icon" => generateIconPath("success")]);
                    }
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                } catch (\Throwable $th) {
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please Try Unique Name', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
    public function editMockInterview(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $mock_id = isset($request->mock_id) ? base64_decode($request->input('mock_id')) : 0;
            $title = isset($request->title) ? htmlspecialchars_decode($request->input('title')) : '';
            $instruction = isset($request->instruction) ? htmlentities($request->input('instruction')) : '';
            $instruction_file = isset($request->instruction_file) && $request->hasFile('instruction_file') ? $request->file('instruction_file') : '';
            $old_instruction_file = isset($request->old_instruction_file) && !empty($request->old_instruction_file) ? htmlspecialchars($request->input('old_instruction_file')) : '';
            $percentage = isset($request->percentage) ? htmlspecialchars($request->input('percentage')) : 0;
            $Messages =[];
            try {
                $validate = [
                    'title' => ['required', 'min:3', 'max:255'],
                    'percentage' => ['required', 'numeric', 'max:100'],
                    'instruction' => ['required', 'min:3'],
                ];
                if ($request->hasFile('instruction_file')) {
                    $validate = array_merge($validate, ['instruction_file' => ['required', 'mimes:pdf', 'max:5120']]);
                    $Messages = [
                        'instruction_file.max' => 'The file should be less than 5MB.',
                        'instruction_file.mimes' => 'The file must be a PDF.',
                        'instruction_file.required' => 'The instruction file field is required.',
                    ];
                }
                $request->validate($validate,$Messages);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }

            $table = "exam_mock_interview";
            $where = ['id' => $mock_id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                $select = [
                    'title' => $title,
                    'percentage' => $percentage,
                    'instructions' => $instruction,
                    'last_updated_by' => $admin_id
                ];
                if ($request->hasFile('instruction_file')) {
                    $instruction_file_url =  UploadFiles($instruction_file, 'course/MockInterviewDocs', $old_instruction_file);
                    if ($instruction_file_url === FALSE) {
                        return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => generateIconPath("error")]);
                    }
                    if (isset($instruction_file_url['url']) && Storage::disk('local')->exists($instruction_file_url['url'])) {

                        $thumbnail_filename = $instruction_file->getClientOriginalName();
                        $select = array_merge(
                            [
                                'instrcution_file_url' => !empty($instruction_file_url['url']) ? $instruction_file_url['url'] : 'No File',
                                'instrcution_file_name' => $thumbnail_filename
                            ],
                            $select
                        );
                    } else {
                        return json_encode(['code' => 201, 'title' => "Unable to Upload Pdf", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                    }
                }
                try {
                    DB::beginTransaction();
                    $updateSection = processData([$table, 'id'], $select, $where);
                    if (isset($updateSection) && $updateSection['status'] === true) {
                        DB::commit();
                        return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => ucfirst($request->redirect) . " successfully updated", "icon" => generateIconPath("success")]);
                    }
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                } catch (\Throwable $th) {
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                }
            }
        }
    }
    public function deletePdfFile(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;

            $table = "exam_mock_interview";
            $where = ['id' => $id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                $getFileData = getData('exam_mock_interview', ['instrcution_file_url'], ['id' => $id, 'is_deleted' => 'No']);
                $getFilename = $getFileData[0]->instrcution_file_url;

                $delete = FALSE;
                if (!empty($getFilename) && Storage::disk('local')->exists($getFilename)) {
                    $delete =  Storage::disk('local')->delete($getFilename);
                } else {
                    return json_encode(['code' => 201, 'title' => "File Not Found", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
                if ($delete === TRUE) {
                    try {
                        $select = [
                            'instrcution_file_url' => NULL,
                            'instrcution_file_name' => NULL,
                            'last_updated_by' => $admin_id,
                        ];
                        DB::beginTransaction();
                        $updateSection = processData([$table, 'id'], $select, $where);
                        if (isset($updateSection) && $updateSection['status'] === true) {
                            DB::commit();
                            return json_encode(['code' => 200, 'title' => 'Successfully Deleted', "message" => "PDF deleted successfully", "icon" => generateIconPath("success")]);
                        }
                        DB::rollback();
                        return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                    } catch (\Throwable $th) {
                        DB::rollback();
                        return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                    }
                }
                return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please Try Unique Name', "icon" => generateIconPath("error")]);
            } else {
                return json_encode(['code' => 201, 'title' => "Mock Interview Not Available", 'message' => 'Please Try Unique Name', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
    public function deleteMockInterview(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;
            $course_id =  isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;

            $table = "exam_mock_interview";
            $where = ['id' => $id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                try {
                    DB::beginTransaction();
                    
                    $canDeleteExam = canDeleteExam($course_id);

                    if ($canDeleteExam['status'] === false) {
                        return json_encode(['code' => 403, 'title' => 'Deletion Failed', 'message' => $canDeleteExam['message'], "icon" => generateIconPath("error")]);
                    }

                    $result = deleteRecord(MockExam::class, $where, true);

                    if (isset($result) && $result['status'] === true) {
                        $questions = getData('exam_mock_questions', ['id'], ['mock_intr_id' => $result['id']]);
                        if(isset($questions) && !empty($questions[0])){
                            foreach($questions as $question){
                                $where = ['id' => $question->id];
                                deleteRecord(MockExamQuestion::class, $where, true);
                            }
                        }

                        $where = ['course_id' => $course_id, 'exam_type' => '2', 'exam_id' => $result['id']];
                        $examManageMaster = deleteRecord(ExamManage::class, $where, true);
                        if (isset($examManageMaster) && $examManageMaster['status'] === true) {
                            DB::commit();
                            return json_encode(['code' => 200, 'title' => 'Successfully Deleted', "message" => "Successfully deleted", "icon" => generateIconPath("success")]);
                        }
                    }
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                } catch (\Throwable $th) {
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please try unique name', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }

}