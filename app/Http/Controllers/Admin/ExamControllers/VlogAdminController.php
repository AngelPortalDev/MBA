<?php

namespace App\Http\Controllers\Admin\ExamControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,  Validator, Storage, DB};
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Models\VlogModule;
use App\Models\VlogQuestion;
use App\Models\ExamManage;

class VlogAdminController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    public function addVlog(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $award_id = isset($request->award_id) ? base64_decode($request->input('award_id')) : 0;
            $vlog_title = isset($request->vlog_title) ? htmlspecialchars_decode($request->input('vlog_title')) : '';

            try {
                $request->validate([
                    'award_id' => ['required', 'string'],
                    'vlog_title' => [
                        'required', 'min:3',
                        'max:255', 'string'
                    ],
                ],[
                    'vlog_title.min'=>'The Vlog title must be at least 3 characters.',
                    'vlog_title.max'=>'The Vlog title must be at least 255 characters.',
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            if (is_exist('course_master', ['id' => $award_id]) > 0) {
                try {
                    $where = ['award_id' => $award_id, 'is_deleted' => 'No', 'deleted_at' => null];
                    $exists = is_exist('exam_vlog', $where);
                    if (isset($exists) && $exists > 0) {
                        return json_encode([
                            'code' => 404, 'title' => "Already Added", 'message' => 'Course vlog already added.', "icon" => generateIconPath("warning")
                        ]);
                    }else{
                        $select = [
                            'title' => $vlog_title,
                            'award_id' => $award_id,
                            'created_by' => $admin_id,
                            'is_deleted' => 'No',
                            'last_updated_by' => $admin_id,
                            'created_at' => $this->time,
                        ];
                        DB::beginTransaction();
                        $assignUpdate = processData(['exam_vlog', 'id'], $select);

                        if (isset($assignUpdate) && $assignUpdate['status'] === true) {
                            $select = [
                                'exam_id' => $assignUpdate['id'],
                                'course_id' => $award_id,
                                'exam_type' => 3,
                                'created_by' => $admin_id,
                                'created_at' => $this->time,
                            ];
                            $examManageUpdate = processData(['exam_management_master', 'id'], $select);       

                            if (isset($examManageUpdate) && $examManageUpdate['status'] === true) {
                                DB::commit();
                                return json_encode(['code' => 200, 'title' => "Successfully Added", 'message' => 'Vlog added successfully', "icon" => generateIconPath("success")]);
                            }
                        }
                        DB::rollBack();
                        return json_encode([
                            'code' => 404, 'title' => "Unable to Add Vlog", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                        ]);
                    }
                } catch (\Throwable $th) {
                    return $th;
                    DB::rollBack();
                    return json_encode([
                        'code' => 404, 'title' => "Unable to Add Vlog", 'message' => 'Something Went Wrong', "icon" => generateIconPath("error")
                    ]);
                }
            } else {
                return json_encode([
                    'code' => 404, 'title' => "Unable to Add Vlog", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                ]);
            }
        }
    }
    public function getVlogData($action = '', $id = '')
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
                $contentData = $this->vlogModule->getMockQuestion($where);
                return view('admin/exam/edit-vlog', compact('contentData'));
            } else {
                $contentData = $this->vlogModule->getVlogDetails($where);
            }
            return response()->json($contentData);
        }
        return redirect('/login');
    }
    public function addVlogQuestion(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {

            $admin_id = Auth::user()->id;
            $marks = isset($request->marks) ? htmlspecialchars($request->input('marks')) : '';
            $question = isset($request->question) ? htmlspecialchars_decode($request->input('question')) : '';
            $vlog_id = isset($request->vlog_id) ? base64_decode($request->input('vlog_id')) : 0;
            $question_id = isset($request->question_id) ? base64_decode($request->input('question_id')) : 0;
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');
            $exists = is_exist('exam_vlog', ['id' => $vlog_id, 'is_deleted' => 'No']);
            $Questionexists = is_exist('exam_vlog_questions', ['id' => $question_id, 'is_deleted' => 'No']);
            try {
                $request->validate([
                    'question' => ['required', 'min:3', 'max:255'],
                    'marks' => ['required', 'numeric'],
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            $where = [];
            if (isset($exists) && is_numeric($exists) && $exists > 0) {
                $select = [
                    'vlog_id' =>  $vlog_id,
                    'question' => $question,
                    'marks' => $marks,
                    'file_type' => '2',
                    'is_deleted' => 'No',
                ];
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
                $updateUser = processData(['exam_vlog_questions', 'id'], $select, $where);
                if (isset($updateUser) && $updateUser['status'] === true) {
                    return json_encode(['code' => 200, 'title' => $title, 'message' => $message, "icon" => generateIconPath("success"), "data" => $updateUser]);
                }
                return json_encode(['code' => 404, 'title' => "Unable to Add Question", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
            return json_encode(['code' => 404, 'title' => "Vlog Not Available", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
    public function deleteVlogQuestion(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;


            $table = "exam_vlog_questions";
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
    public function editViewVlogQuestion(Request $request)
    {
        if ($request->isMethod('POST') && Auth::check()) {
            $questionID = isset($request->question_id) ? base64_decode($request->input('question_id')) : 0;

            if (isset($questionID) && !empty($questionID)) {
                $exists = is_exist('exam_vlog_questions', ['id' => $questionID, 'is_deleted' => 'No']);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $QuestionAssign = getData('exam_vlog_questions', ['id', 'question', 'marks', 'vlog_id', 'file_type'], ['id' => $questionID]);
                    return json_encode(['code' => 200, 'data' => $QuestionAssign[0]]);
                }
                return json_encode(['code' => 404, 'title' => "Question not Found", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            } else {
                return json_encode(['code' => 404, 'title' => "Vlog Not Available", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
        }
        return json_encode(['code' => 404, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
    }
    public function editVlogData($action = '', $id = '')
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
                $contentData = $this->vlogModule->getVlogDetails($where);
                return view('admin/exam/edit-vlog', compact('contentData'));
            } else {
                $contentData = $this->vlogModule->getVlogDetails($where);
            }
            return response()->json($contentData);
        }
        return redirect('/login');
    }
    public function updateVlog(Request $request)
    {

        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $vlog_id = isset($request->vlog_id) ? base64_decode($request->input('vlog_id')) : 0;
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
                        'instruction_file.max' => 'The file must not be greater than 5MB.',
                        'instruction_file.mimes' => 'The file must be a PDF.',
                        'instruction_file.required' => 'The instruction file field is required.',
                    ];
                }
                $request->validate($validate,$Messages);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }

            $table = "exam_vlog";
            $where = ['id' => $vlog_id, 'is_deleted' => 'No'];
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
                        return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Vlog successfully updated", "icon" => generateIconPath("success")]);
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

            $table = "exam_vlog";
            $where = ['id' => $id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                $getFileData = getData('exam_vlog', ['instrcution_file_url'], ['id' => $id, 'is_deleted' => 'No']);
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
                return json_encode(['code' => 201, 'title' => "Vlog Not Available", 'message' => 'Please Try Unique Name', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
    public function deleteVlog(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;
            $course_id =  isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;

            $table = "exam_vlog";
            $where = ['id' => $id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                try {
                    DB::beginTransaction();
                    $canDeleteExam = canDeleteExam($course_id);

                    if ($canDeleteExam['status'] === false) {
                        return json_encode(['code' => 403, 'title' => 'Deletion Failed', 'message' => $canDeleteExam['message'], "icon" => generateIconPath("error")]);
                    }

                    $result = deleteRecord(VlogModule::class, $where, true);

                    if (isset($result) && $result['status'] === true) {
                        $questions = getData('exam_vlog_questions', ['id'], ['vlog_id' => $result['id']]);
                        if(isset($questions) && !empty($questions[0])){
                            foreach($questions as $question){
                                $where = ['id' => $question->id];
                                deleteRecord(VlogQuestion::class, $where, true);
                            }
                        }

                        $where = ['course_id' => $course_id, 'exam_type' => '3', 'exam_id' => $result['id']];
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
