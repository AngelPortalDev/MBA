<?php

namespace App\Http\Controllers\Admin\ExamControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Models\AssignmentModule;
use App\Models\AssignmentQuestion;
use App\Models\ExamManage;


class AssignmentAdminController extends Controller{

    public function __construct()
    {
        parent::__construct();

    }


    public function addAssignment(Request $request)
    {

        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $award_id = isset($request->award_id) ? base64_decode($request->input('award_id')) : 0;
            $assignment_tittle = isset($request->assignment_tittle) ? htmlspecialchars_decode($request->input('assignment_tittle')) : '';

            try {
                $request->validate([
                    'award_id' => ['required', 'string'],
                    'assignment_tittle' => [
                        'required', 'min:3',
                        'max:255', 'string'
                    ],
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            if (is_exist('course_master', ['id' => $award_id]) > 0) {
                try {

                    // commented because some courses have multiple assignment like (Award in International Organisational Management and Development)

                    // $where = ['award_id' => $award_id, 'is_deleted' => 'No', 'deleted_at' => null];
                    // $exists = is_exist('exam_assignments', $where);
                    // if (isset($exists) && $exists > 0) {
                    //     return json_encode([
                    //         'code' => 404, 'title' => "Already Added", 'message' => 'Course assignment already added.', "icon" => generateIconPath("warning")
                    //     ]);
                    // }else{
                        $select = [
                            'assignment_tittle' => $assignment_tittle,
                            'award_id' => $award_id,
                            'created_by' => $admin_id,
                            'is_deleted' => 'No',
                            'last_updated_by' => $admin_id,
                            'created_at' => $this->time,
                        ];
                        DB::beginTransaction();
                        $assignUpdate = processData(['exam_assignments', 'id'], $select);
                        if (isset($assignUpdate) && $assignUpdate['status'] === true) {
                            $select = [
                                'exam_id' => $assignUpdate['id'],
                                'course_id' => $award_id,
                                'exam_type' => 1,
                                'created_by' => $admin_id,
                                'created_at' => $this->time,
                            ];
                            $assginManagUpdate = processData(['exam_management_master', 'id'], $select);
                            if (isset($assginManagUpdate) && $assginManagUpdate['status'] === true) {
                                DB::commit();
                                return json_encode(['code' => 200, 'title' => "Successfully Added", 'message' => 'Assignment added successfully', "icon" => generateIconPath("success")]);
                            }
                        }
                        DB::rollBack();
                        return json_encode([
                            'code' => 404, 'title' => "Unable to Add Assignment", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                        ]);
                    // }
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return json_encode([
                        'code' => 404, 'title' => "Unable to Add Assignment", 'message' => 'Something Went Wrong', "icon" => generateIconPath("error")
                    ]);
                }
            } else {
                return json_encode([
                    'code' => 404, 'title' => "Unable to Add Assignment", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                ]);
            }
        }
    }
    public function editAssignment(Request $request)
    {
      
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $assign_id = isset($request->assign_id) ? base64_decode($request->input('assign_id')) : 0;
            $assignment_title = isset($request->assignment_title) ? htmlspecialchars_decode($request->input('assignment_title')) : '';
            $instruction = isset($request->instruction) ? htmlentities($request->input('instruction')) : '';
            $assignment_percentage = isset($request->assignment_percentage) ? htmlspecialchars($request->input('assignment_percentage')) : 0;
            $examDuration = null;
            $enable_exam_feedback = $request->has('enable_exam_feedback') ? $request->enable_exam_feedback : '0';
            $enable_draft_mode = $request->has('enable_draft_mode') ? $request->enable_draft_mode : '0';
            if (isset($request->exam_duration_hours) && isset($request->exam_duration_minutes)) {
                $exam_duration_hours = $request->exam_duration_hours ?? '0';
                $exam_duration_minutes = $request->exam_duration_minutes ?? '0';
                $formattedHours = str_pad($exam_duration_hours, 2, '0', STR_PAD_LEFT);
                $formattedMinutes = str_pad($exam_duration_minutes, 2, '0', STR_PAD_LEFT);
                $examDuration = $formattedHours . ':' . $formattedMinutes;
            }

            try {
                $request->validate([
                    'assignment_title' => ['required', 'min:3', 'max:255'],
                    'assignment_percentage' => ['required', 'numeric'],
                    'instruction' => ['required', 'min:3'],
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }

            $table = "exam_assignments";
            $where = ['id' => $assign_id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                $select = [
                    'assignment_tittle' => $assignment_title,
                    'assignment_percentage' => $assignment_percentage,
                    'exam_duration' => $examDuration,
                    'enable_exam_feedback' => $enable_exam_feedback,
                    'enable_draft_mode' => $enable_draft_mode,
                    'instructions' => $instruction,
                    'last_updated_by' => $admin_id
                ];
                try {
                    DB::beginTransaction();
                    $updateSection = processData([$table, 'id'], $select, $where);
                    if (isset($updateSection) && $updateSection['status'] === true) {
                        DB::commit();
                        return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Assignment successfully updated", "icon" => generateIconPath("success")]);
                    }
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                } catch (\Throwable $th) {
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
            }
        }
    }
    public function getAssignData($action = '', $id = '')
    {
        if (Auth::check()) {

            $assignmentData = [];

            $id = isset($id) && !empty($id) ? base64_decode($id) : 0;
            $action = isset($action) && !empty($action) ? base64_decode($action) : 'All';
            $where = [];
            if (isset($action) && !empty($action) && $action != '' && $action != 'edit' && $action != 'All') {
                $where = [
                    'is_active' => $action
                ];
            }
            if (
                isset($id) && !empty($id)
            ) {
                $whereId = [
                    'id' => $id
                ];
                $where = array_merge($where, $whereId);
            }

            if (isset($action) && !empty($action) && $action === 'edit') {
                $assignmentData = $this->assignment->getAssignmentQuestion($where);
                return view('admin/exam/edit-assignment', compact('assignmentData'));
            } else {
                $assignmentData = $this->assignment->getAssignmentDetails($where);
            }
            return response()->json($assignmentData);
        }
        return redirect('/login');
    }
    public function addAssignQuestion(Request $request)
    {

        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {

            $admin_id = Auth::user()->id;
            $assignment_mark = isset($request->assignment_mark) ? htmlspecialchars($request->input('assignment_mark')) : '';
            $question = isset($request->questionData) ? $request->input('questionData') : '';
            
            $answer_limit = isset($request->assignment_answer_limit) && is_numeric($request->assignment_answer_limit) ? htmlspecialchars($request->input('assignment_answer_limit')) : 100;
            $assign_id = isset($request->assign_id) ? base64_decode($request->input('assign_id')) : 0;
            $question_id = isset($request->question_id) ? base64_decode($request->input('question_id')) : 0;
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');
            $exists = is_exist('exam_assignments', ['id' => $assign_id, 'is_deleted' => 'No']);
            $Questionexists = is_exist('exam_assignment_questions', ['id' => $question_id, 'is_deleted' => 'No']);
            try {
                $request->validate([
                    'questionData' => ['required', 'min:3'],
                    'assignment_mark' => ['required', 'numeric'],
                    'assignment_answer_limit' => ['required', 'numeric'],
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            $where = [];
            if (isset($exists) && is_numeric($exists) && $exists > 0) {
                $select = [
                    'assignments_id' =>  $assign_id,
                    'question' => $question,
                    'assignment_mark' => $assignment_mark,
                    'answer_limit' => $answer_limit,
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
                $updateUser = processData(['exam_assignment_questions', 'id'], $select, $where);
                if (isset($updateUser) && $updateUser['status'] === true) {
                    return json_encode(['code' => 200, 'title' => $title, 'message' => $message, "icon" => generateIconPath("success"), "data" => $updateUser]);
                }
                return json_encode(['code' => 404, 'title' => "Unable to Add Question", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
            return json_encode(['code' => 404, 'title' => "Assignment Not Available", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }
    public function editViewAssignQeustion(Request $request)
    {
        if ($request->isMethod('POST') && Auth::check()) {
            $questionID = isset($request->question_id) ? base64_decode($request->input('question_id')) : 0;

            if (isset($questionID) && !empty($questionID)) {
                $exists = is_exist('exam_assignment_questions', ['id' => $questionID, 'is_deleted' => 'No']);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $QuestionAssign = getData('exam_assignment_questions', ['id', 'question', 'assignment_mark', 'assignments_id', 'answer_limit'], ['id' => $questionID]);
                    return json_encode(['code' => 200, 'data' => $QuestionAssign[0]]);
                }
                return json_encode(['code' => 404, 'title' => "Question not Found", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            } else {
                return json_encode(['code' => 404, 'title' => "Quiz Not Available", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
        }
        return json_encode(['code' => 404, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
    }
    public function deleteAssingnQuestion(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;


            $table = "exam_assignment_questions";
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
    public function deleteAssingnment(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;
            $course_id =  isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;

            $table = "exam_assignments";
            $where = ['id' => $id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                $select = [
                    'is_deleted' => 'Yes',
                    'deleted_by' => $admin_id
                ];
                try {
                    DB::beginTransaction();
                    
                    $canDeleteExam = canDeleteExam($course_id);

                    if ($canDeleteExam['status'] === false) {
                        return json_encode(['code' => 403, 'title' => 'Deletion Failed', 'message' => $canDeleteExam['message'], "icon" => generateIconPath("error")]);
                    }

                    $result = deleteRecord(AssignmentModule::class, $where, true);

                    if (isset($result) && $result['status'] === true) {
                        $questions = getData('exam_assignment_questions', ['id'], ['assignments_id' => $result['id']]);
                        if(isset($questions) && !empty($questions[0])){
                            foreach($questions as $question){
                                $where = ['id' => $question->id];
                                deleteRecord(AssignmentQuestion::class, $where, true);
                            }
                        }

                        $where = ['course_id' => $course_id, 'exam_type' => '1', 'exam_id' => $result['id']];
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


}