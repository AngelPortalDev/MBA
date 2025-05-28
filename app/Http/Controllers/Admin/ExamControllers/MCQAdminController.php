<?php

namespace App\Http\Controllers\Admin\ExamControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Models\McqQuestion;
use App\Models\McqModule;
use App\Models\ExamManage;

class MCQAdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getMcqData($action = '', $id = '')
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
                $contentData = $this->mcqModule->getMcqDetails($where);
                return view('admin/exam/edit-multiple-choice', compact('contentData'));
            } else {
                $contentData = $this->mcqModule->getMcqDetails($where);
            }
            return response()->json($contentData);
        }
        return redirect('/login');
    }

    public function addMcq(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $award_id = isset($request->award_id) ? base64_decode($request->input('award_id')) : 0;
            $title = isset($request->title) ? htmlspecialchars_decode($request->input('title')) : '';

            try {
                $request->validate([
                    'award_id' => ['required', 'string'],
                    'title' => [
                        'required', 'min:3',
                        'max:255', 'string'
                    ],
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }

            if (is_exist('course_master', ['id' => $award_id]) > 0) {
                try {
                    $where = ['award_id' => $award_id, 'is_deleted' => 'No', 'deleted_at' => null];
                    $exists = is_exist('exam_mcq', $where);
                    if (isset($exists) && $exists > 0) {
                        return json_encode([
                            'code' => 404, 'title' => "Already Added", 'message' => 'Course mcq already added.', "icon" => generateIconPath("warning")
                        ]);
                    }else{
                        $select = [
                            'title' => $title,
                            'award_id' => $award_id,
                            'created_by' => $admin_id,
                            'is_deleted' => 'No',
                            'last_updated_by' => $admin_id,
                            'created_at' => $this->time,
                        ];
                        DB::beginTransaction();
                        $assignUpdate = processData(['exam_mcq', 'id'], $select);
                        if (isset($assignUpdate) && $assignUpdate['status'] === true) {
                            $select = [
                                'exam_id' => $assignUpdate['id'],
                                'course_id' => $award_id,
                                'exam_type' => 7,
                                'created_by' => $admin_id,
                                'created_at' => $this->time,
                            ];
                            $assginManagUpdate = processData(['exam_management_master', 'id'], $select);
                            if (isset($assginManagUpdate) && $assginManagUpdate['status'] === true) {
                                DB::commit();
                                return json_encode(['code' => 200, 'title' => "Successfully Added", 'message' => 'Mcq added successfully', "icon" => generateIconPath("success")]);
                            }
                        }
                        DB::rollBack();
                        return json_encode([
                            'code' => 404, 'title' => "Unable to Add Mcq", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                        ]);
                    }
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return json_encode([
                        'code' => 404, 'title' => "Unable to Add Mcq", 'message' => 'Something Went Wrong', "icon" => generateIconPath("error")
                    ]);
                }
            } else {
                return json_encode([
                    'code' => 404, 'title' => "Unable to Add Mcq", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                ]);
            }
        }
    }
    
    public function updateMcq(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $mcq_id = isset($request->mcq_id) ? base64_decode($request->input('mcq_id')) : 0;
            $title = isset($request->title) ? htmlspecialchars_decode($request->input('title')) : '';
            $percentage = isset($request->percentage) ? htmlspecialchars($request->input('percentage')) : 0;
            $examDuration = null;
            if (isset($request->exam_duration_hours) && isset($request->exam_duration_minutes)) {
                $exam_duration_hours = $request->exam_duration_hours ?? '0';
                $exam_duration_minutes = $request->exam_duration_minutes ?? '0';
                $formattedHours = str_pad($exam_duration_hours, 2, '0', STR_PAD_LEFT);
                $formattedMinutes = str_pad($exam_duration_minutes, 2, '0', STR_PAD_LEFT);
                $examDuration = $formattedHours . ':' . $formattedMinutes;
            }


            $messages =[];
            try {
                $validate = [
                    'title' => ['required', 'min:3', 'max:255'],
                    'percentage' => ['required', 'numeric', 'max:100'],
                ];
                $request->validate($validate,$messages);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }

            $table = "exam_mcq";
            $where = ['id' => $mcq_id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                $select = [
                    'title' => $title,
                    'percentage' => $percentage,
                    'exam_duration' => $examDuration,
                    'last_updated_by' => $admin_id
                ];
                try {
                    DB::beginTransaction();
                    $updateSection = processData([$table, 'id'], $select, $where);
                    if (isset($updateSection) && $updateSection['status'] === true) {
                        DB::commit();
                        return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "MCQ successfully updated", "icon" => generateIconPath("success")]);
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

    public function addMcqQuestion(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {

            $admin_id = Auth::user()->id;
            $question = isset($request->question) ? htmlspecialchars_decode($request->input('question')) : '';
            $mark = isset($request->mark) ? htmlspecialchars($request->input('mark')) : 1;
            $option1 = isset($request->option1) ? htmlspecialchars_decode($request->input('option1')) : '';
            $option2 = isset($request->option2) ? htmlspecialchars_decode($request->input('option2')) : '';
            $option3 = isset($request->option3) ? htmlspecialchars_decode($request->input('option3')) : '';
            $option4 = isset($request->option4) ? htmlspecialchars_decode($request->input('option4')) : '';
            $answer = isset($request->answer) ? htmlspecialchars($request->input('answer')) : 0;
            $mcq_id = isset($request->mcq_id) ? base64_decode($request->input('mcq_id')) : 0;
            $question_id = isset($request->question_id) ? base64_decode($request->input('question_id')) : 0;
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');
            $exists = is_exist('exam_mcq', ['id' => $mcq_id, 'is_deleted' => 'No']);
            $message = 'added';

            $Questionexists = is_exist('exam_mcq_questions', ['id' => $question_id, 'is_deleted' => 'No']);
            try {
                $request->validate([
                    'question' => ['required', 'min:3', 'max:255'],
                    'mark' => ['required'],
                    'option1' => ['required', 'min:3', 'max:255'],
                    'option2' => ['required', 'min:3', 'max:255'],
                    'option3' => ['required', 'min:3', 'max:255'],
                    'option4' => ['required', 'min:3', 'max:255'],
                    'answer' => ['required'],
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            $where = [];
            if (isset($exists) && is_numeric($exists) && $exists > 0) {
                if (isset($Questionexists) && is_numeric($Questionexists) && $Questionexists > 0) {
                    $where = ['id' => $question_id, 'is_deleted' => 'No'];
                    
                    $message = 'updatded';
                }
                $select = [
                    'mcq_id' =>  $mcq_id,
                    'question' => $question,
                    'mark' => $mark,
                    'option1' => $option1,
                    'option2' => $option2,
                    'option3' => $option3,
                    'option4' => $option4,
                    'answer' => $answer,
                    'created_by' => $admin_id,
                    'created_at' => $timestamp,
                    'is_deleted' => 'No',
                    'last_updated_by' => $admin_id,
                ];
                $updateUser = processData(['exam_mcq_questions', 'id'], $select, $where);
                if (isset($updateUser) && $updateUser['status'] === true) {
                    return json_encode(['code' => 200, 'title' => "Successfully ".ucfirst($message), 'message' => 'Question '.$message.' successfully', "icon" => generateIconPath("success"), "data" => $updateUser]);
                } else {
                    return json_encode(['code' => 404, 'title' => "Unable to Add Question", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
            } else {
                return json_encode(['code' => 404, 'title' => "MCQ Not Available", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
        }
    }
    
    public function EditMcqQuestion(Request $request)
    {
        if ($request->isMethod('POST') && Auth::check()) {
            $questionID = isset($request->question_id) ? base64_decode($request->input('question_id')) : 0;
            if (isset($questionID) && !empty($questionID)) {
                $exists = is_exist('exam_mcq_questions', ['id' => $questionID, 'is_deleted' => 'No']);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $mcqData = getData('exam_mcq_questions', ['id', 'question', 'option1', 'option2', 'option3', 'option4', 'answer', 'mcq_id', 'mark'], ['id' => $questionID]);
                    return json_encode(['code' => 200, 'data' => $mcqData[0]]);
                }
                return json_encode(['code' => 404, 'title' => "Question not Found", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            } else {
                return json_encode(['code' => 404, 'title' => "MCQ Not Available", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
        }
        return json_encode(['code' => 404, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
    }
    
    public function deleteMcq(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;
            $course_id =  isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;

            $table = "exam_mcq";
            $where = ['id' => $id];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                try {
                    DB::beginTransaction();
                    $canDeleteExam = canDeleteExam($course_id);

                    if ($canDeleteExam['status'] === false) {
                        return json_encode(['code' => 403, 'title' => 'Deletion Failed', 'message' => $canDeleteExam['message'], "icon" => generateIconPath("error")]);
                    }


                    $result = deleteRecord(McqModule::class, $where, true);

                    if (isset($result) && $result['status'] === true) {
                        $questions = getData('exam_mcq_questions', ['id'], ['mcq_id' => $id]);
                        if(isset($questions) && !empty($questions[0])){
                            foreach($questions as $question){
                                $where = ['id' => $question->id];
                                deleteRecord(McqQuestion::class, $where, true);
                            }
                        }

                        $where = ['course_id' => $course_id, 'exam_type' => '7', 'exam_id' => $result['id']];
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
                return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please Try Unique Name', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
    
    public function deleteMcqQuestion(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;

            $table = "exam_mcq_questions";
            $where = ['id' => $id];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                try {
                    DB::beginTransaction();
                    
                    $result = deleteRecord(McqQuestion::class, $where, true);

                    if (isset($result) && $result['status'] === true) {
                        DB::commit();
                        return json_encode(['code' => 200, 'title' => 'Successfully Deleted', "message" => "", "icon" => generateIconPath("success")]);
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
}
