<?php

namespace App\Http\Controllers\Admin\ExamControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getQuiz(Request $request)
    {
        if (Auth::check()) {
            $QuizData = [];

            // $quiz_id = 11;
            $quiz_id = isset($request->quiz_id) ? base64_decode($request->input('quiz_id')) : '';
            $where = ['id' => $quiz_id, 'is_deleted' => 'No'];
            $data = $this->Quiz->getQuizDetails($where);


            $QuizData = ['code' => 400];
            if (isset($data[0]['quiz_question']) && is_array($data[0]['quiz_question']) && count($data[0]['quiz_question']) > 0) {
                $QuizData = ['code' => 200, 'content' => $data[0]];
            }

            return response()->json($QuizData);
        }
        return redirect('/login');
    }


    public function addQuiz(Request $request)
    {

        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;

            $quiz_section_id = isset($request->section_id) ? base64_decode($request->input('section_id')) : '';
            $quiz_tittle = isset($request->quiz_tittle) ? htmlspecialchars_decode($request->input('quiz_tittle')) : '';
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');

            try {
                $request->validate([
                    'section_id' => ['required', 'string'],
                    'quiz_tittle' => [
                        'required', 'min:3',
                        'max:255', 'string'
                    ],
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            
            $exists = is_exist('exam_quiz', ['quiz_tittle' => $quiz_tittle,'section_id'=> $quiz_section_id,'is_deleted' => 'No']);
            if (isset($exists) && is_numeric($exists) && $exists > 0) {
                return json_encode(['code' => 201, 'title' => "Quiz already exist.", 'message' => 'Please Select Correct Quiz', "icon" => generateIconPath("error")]);
            }

            $select = [
                'quiz_tittle' => $quiz_tittle,
                'section_id' => $quiz_section_id,
                'created_by' => $admin_id,
                'is_deleted' => 'No',
                'last_updated_by' => $admin_id,
                'created_at' => $timestamp,
            ];
            try {

                DB::beginTransaction();
                $QuizCreate = processData(['exam_quiz', 'id'], $select);
                if (isset($QuizCreate) && $QuizCreate['status'] === true) {
                    $content_id = isset($QuizCreate['id']) ? $QuizCreate['id'] : 0;
                    $select = [
                        'section_id' => $quiz_section_id,
                        'content_id' => $content_id,
                        'content_type_id' => 3,
                        'placement_id' => 0,
                        'is_deleted' => 'No',
                        'last_update_by' => $admin_id,
                        'created_at' => $timestamp,
                    ];
                    $QuizSection = processData(['section_managment_master', 'id'], $select);
                    if (isset($QuizSection) && $QuizSection['status'] === true) {
                        DB::commit();
                        return json_encode(['code' => 200, 'title' => "Successfully Added", 'message' => 'Quiz added successfully', "icon" => generateIconPath("success")]);
                    }
                }
                return json_encode([
                    'code' => 404, 'title' => "Unable to Add Quiz", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                ]);
            } catch (\Throwable $th) {
                // return $th;
                DB::rollback();
                return json_encode([
                    'code' => 404, 'title' => "Unable to Add Quiz", 'message' => 'Something Went Wrong', "icon" => generateIconPath("error")
                ]);
            }
        }
    }

    public function editQuiz(Request $request)
    {
        if ($request->isMethod('POST') && Auth::check()) {
            $admin_id = Auth::user()->id;
            $quiz_tittle = isset($request->quiz_tittle) ? ($request->input('quiz_tittle')) : '';
            $quiz_section_id = isset($request->quiz_section_id) ? base64_decode($request->input('quiz_section_id')) : '';
            $quiz_id = isset($request->quiz_id) ? base64_decode($request->input('quiz_id')) : '';
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');
            $exists = is_exist('exam_quiz', ['id' => $quiz_id, 'is_deleted' => 'No']);

            $sectionData = getData('exam_quiz', ['id', 'section_id'], ['id' => $quiz_id, 'is_deleted' => 'No']);
            $sectionManagSecId = isset($sectionData[0]->section_id) ? $sectionData[0]->section_id : 0;
            $sectionManagData = getData('section_managment_master', ['id'], ['section_id' => $sectionManagSecId, 'content_id' => $quiz_id, 'content_type_id' => 3, 'is_deleted' => 'No']);
            $sectionManagId = isset($sectionManagData[0]->id) ? $sectionManagData[0]->id : 0;
            $whereSectionManage = [];
            if (is_numeric($sectionManagId) && $sectionManagId > 0) {
                $whereSectionManage = ['id' => $sectionManagId, 'is_deleted' => 'No'];
            }

            try {
                $request->validate([
                    'quiz_tittle' => ['required', 'min:3', 'max:255'],
                    'quiz_section_id' => ['required'],
                ],[
                    'quiz_tittle.required' =>'Please enter quiz title',
                    'quiz_tittle.min' =>'The quiz title must be at least 3 characters.',
                    'quiz_tittle.max' =>'The quiz title must be at most 255 characters',
                ]);
            } catch (ValidationException $e) {
                return redirect()->back()->withErrors($e->errors())->withInput();
            }
            if (isset($exists) && is_numeric($exists) && $exists > 0) {
                $where = ['is_deleted' => 'No', 'id' => $quiz_id];
                $select = [
                    'quiz_tittle' => $quiz_tittle,
                    'section_id' => $quiz_section_id,
                    'created_by' => $admin_id,
                    'last_updated_by' => $admin_id,
                    'created_at' => $timestamp,
                ];
                try {
                    DB::beginTransaction();
                    $QuizCreate = processData(['exam_quiz', 'id'], $select, $where);
                    if (isset($QuizCreate) && $QuizCreate['status'] === true) {

                        // if (is_numeric($sectionManagId) && $sectionManagId > 0) {

                        //     $select = [
                        //         'section_id' => $quiz_section_id,
                        //         'content_id' => $QuizCreate['id'],
                        //         'content_type_id' => 3,
                        //         'placement_id' => 0,
                        //         'is_deleted' => 'No',
                        //         'last_update_by' => $admin_id,
                        //         'created_at' => $timestamp,
                        //     ];

                        //     $QuizSection = processData(['section_managment_master', 'id'], $select);

                        //     if (isset($QuizSection) && !is_array($QuizSection) && $QuizSection === false) {
                        //         $msg = ['msg' => "Unable to Add Quiz", "icon" => "error"];
                        //         return redirect()->back()->with($msg);
                        //     }
                          
                        // }
                        $cols = [
                            'content_id' => $QuizCreate['id'],
                            'content_type_id' => 3,
                            'is_deleted' => 'No'
                        ];
                        $existsContent = is_exist('section_managment_master', $cols);

                        if (isset($sectionManagId) && is_numeric($sectionManagId) && $sectionManagId === 0) {
                            $select = [
                                'section_id' => $quiz_section_id,
                                'content_id' => $QuizCreate['id'],
                                'content_type_id' => 3,
                                'placement_id' => 0,
                                'is_deleted' => 'No',
                                'last_update_by' => $admin_id,
                                'created_at' => $timestamp,
                            ];

                            $QuizSection = processData(['section_managment_master', 'id'], $select);

                            if (isset($QuizSection) && !is_array($QuizSection) && $QuizSection === false) {
                                $msg = ['msg' => "Unable to Add Quiz", "icon" => "error"];
                                return redirect()->back()->with($msg);
                            }
                        } else {
                            $update =
                                [
                                    'section_id' => $quiz_section_id,
                                    'last_update_by' => $admin_id,
                                    'created_at' =>  $this->time
                                ];
                            $palcmentUpdate =  processData(['section_managment_master', 'id'], $update, $cols);
                            if (isset($palcmentUpdate) && $palcmentUpdate === FALSE) {
                                return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                            }
                        }
                        DB::commit();
                        $message = ['msg' => 'Quiz Updated Successfully', 'icon' => 'success'];
                        return redirect('admin/quiz ')->with($message);
                    }
                } catch (ValidationException $e) {
                    DB::rollBack();
                    $msg = ['msg ' => "Unable to Add Quiz", "icon" => "error"];
                    return redirect()->back()->with($msg);
                }
            }
            $msg = ['msg' => "Quiz Not Exists", "icon" => "error"];
            return redirect()->back()->with($msg);
        }
    }

    public function quizListNew()
    {

        if (Auth::check()) {
            $sectionData = [];
            $where = ['is_deleted' => 'No'];
            // $section_id = base64_decode($cat);

            // $data = getData('exam_quiz', ['id', 'quiz_tittle', 'section_id'], 
            // ['is_deleted' => 'No'], '', 'id', 'ASC');


            $data = $this->Quiz->getQuizDetails($where);

            return response()->json($data);
        }
        return redirect('/login');
    }

    public function quizEdit($cat = '')
    {
        if (Auth::check()) {
            $quiz_id = isset($cat) && !empty($cat) ? base64_decode($cat) : 0;
            if (isset($cat) && !empty($cat)) {
                $exists = is_exist('exam_quiz', ['id' => $quiz_id, 'is_deleted' => 'No']);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $where = ['is_deleted' => 'No', 'id' => $quiz_id];
                    $data = $this->Quiz->getQuizDetails($where);
                    $section_id = isset($data[0]['section_id']) ? $data[0]['section_id'] : 0;
                    $exists = is_exist('course_section_masters', ['id' => $section_id, 'is_deleted' => 'No']);

                    if (isset($exists) && is_numeric($exists) && $exists > 0) {
                        return view('admin/course/edit-quiz', compact('data'));
                    } else {
                        return redirect()->back()->withErrors(['msg' => 'Quiz Section has been Deleted', 'icon' => 'error']);
                    }
                }
            }
            return redirect()->back()->withErrors(['msg' => 'Quiz Not Exists', 'icon' => 'error']);
        }
        return redirect('/login');
    }

    public function EditQuizQeustion(Request $request)
    {
        if ($request->isMethod('POST') && Auth::check()) {
            $questionID = isset($request->question_id) ? base64_decode($request->input('question_id')) : 0;
            if (isset($questionID) && !empty($questionID)) {
                $exists = is_exist('exam_quiz_questions', ['id' => $questionID, 'is_deleted' => 'No']);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $QuestionQuiz = getData('exam_quiz_questions', ['id', 'question', 'option1', 'option2', 'option3', 'option4', 'answer', 'quiz_id'], ['id' => $questionID]);
                    return json_encode(['code' => 200, 'data' => $QuestionQuiz[0]]);
                }
                return json_encode(['code' => 404, 'title' => "Question not Found", 'message' => 'Please Try Again', "icon" => "error"]);
            } else {
                return json_encode(['code' => 404, 'title' => "Quiz Not Available", 'message' => 'Please Try Again', "icon" => "error"]);
            }
        }
        return json_encode(['code' => 404, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
    }

    public function addQuizQuestion(Request $request)
    {

        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $question = isset($request->question) ? htmlspecialchars($request->input('question')) : '';
            $option1 = isset($request->option1) ? htmlspecialchars($request->input('option1')) : '';
            $option2 = isset($request->option2) ? htmlspecialchars($request->input('option2')) : '';
            $option3 = isset($request->option3) ? htmlspecialchars($request->input('option3')) : '';
            $option4 = isset($request->option4) ? htmlspecialchars($request->input('option4')) : '';
            $answer = isset($request->answer) ? htmlspecialchars($request->input('answer')) : 0;
            $quiz_id = isset($request->quiz_id) ? base64_decode($request->input('quiz_id')) : 0;
            $question_id = isset($request->question_id) ? base64_decode($request->input('question_id')) : 0;
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');
            $exists = is_exist('exam_quiz', ['id' => $quiz_id, 'is_deleted' => 'No']);

            $Questionexists = is_exist('exam_quiz_questions', ['id' => $question_id, 'is_deleted' => 'No']);
            try {
                $request->validate([
                    'question' => ['required', 'min:3', 'max:350'],
                    'option1' => ['required', 'min:3', 'max:255'],
                    'option2' => ['required', 'min:3', 'max:255'],
                    'option3' => ['required', 'min:3', 'max:255'],
                    'option4' => ['required', 'min:3', 'max:255'],
                    'answer' => ['required'],
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => "error", 'data' => $e->errors()]);
            }
            $where = [];
            if (isset($exists) && is_numeric($exists) && $exists > 0) {
                if (isset($Questionexists) && is_numeric($Questionexists) && $Questionexists > 0) {
                    $where = ['id' => $question_id, 'is_deleted' => 'No'];
                }
                $select = [
                    'quiz_id' =>  $quiz_id,
                    'question' => $question,
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
                $updateUser = processData(['exam_quiz_questions', 'id'], $select, $where);
                if (isset($updateUser) && $updateUser['status'] === true) {
                    return json_encode(['code' => 200, 'title' => "Successfully Added", 'message' => 'Question added successfully', "icon" => "success", "data" => $updateUser]);
                } else {
                    return json_encode(['code' => 404, 'title' => "Unable to Add Question", 'message' => 'Please Try Again', "icon" => "error"]);
                }
            } else {
                return json_encode(['code' => 404, 'title' => "Quiz Not Available", 'message' => 'Please Try Again', "icon" => "error"]);
            }
        }
    }

    public function deleteQuizQuestion(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;
            $table = "exam_quiz_questions";
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
                        return json_encode(['code' => 200, 'title' => 'Successfully Deleted', "message" => "Question deleted successfully", "icon" => "success"]);
                    }
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                } catch (\Throwable $th) {

                    return $th;
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please Try Unique Name', "icon" => "error"]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
        }
    }

    public function deleteQuiz(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            // $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;
            $table = "exam_quiz";
            // $where = ['id' => $id, 'is_deleted' => 'No'];
            // $exists = is_exist($table, $where);
            // if (isset($exists) && $exists > 0) {
                // $select = [
                //     'is_deleted' => 'Yes',
                //     'deleted_by' => $admin_id
                // ];
            $i=0;
            $rules = [
                "id" => "required",
            ];
            $validate = validator::make($req->all(), $rules);
            if (!$validate->fails()) {
                try {
                    DB::beginTransaction();
                    // $updateSection = processData([$table, 'id'], $select, $where);
                    foreach ($req->id as $id) {
                        $id =  isset($id) ? base64_decode($id) : '';
                        $where = ['id' => $id, 'is_deleted' => 'No'];
                        $is_exits = is_exist($table, $where);
                        if (!empty($is_exits) && is_numeric($is_exits) && $is_exits > 0) {
                            $updateSection = processData([$table, 'id'], ['is_deleted' => 'Yes', 'deleted_by' => Auth::user()->id], $where);
                            if (isset($updateSection) && $updateSection !== FALSE) {
                                DB::commit();
                                $i++;
                            }
                        }
                    }
                    if ($i > 0) {
                        return response()->json(['code' => 200, 'title' => $i . ' Records Successfully Deleted', 'icon' => generateIconPath('success')]);
                    } else {
                        return response()->json(['code' => 201, 'title' => 'Unable to Delete', "icon" => generateIconPath("error")]);
                    }
                    // if (isset($updateSection) && $updateSection['status'] === true) {
                    //     DB::commit();
                    //     return json_encode(['code' => 200, 'title' => 'Successfully Deleted', "message" => "Successfully Deleted", "icon" => generateIconPath("success")]);
                    // }
                    // DB::rollback();
                    // return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                } catch (\Throwable $th) {
                    DB::rollback();
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }

    public function QuizView(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $quiz_id  = isset($req->id) ? base64_decode($req->input('id')) : 0;
            $course_id  = isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;
            $validate_rules = [
                'id' => 'required|string',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (is_exist('exam_quiz', ['id' => $quiz_id, 'is_deleted' => 'No']) > 0) {

                    if (!$validate->fails()) {
                        $where = ['id' => $quiz_id, 'is_deleted' => 'No'];
                        $examDetails = $this->Quiz->getQuizDetails($where);
                        return json_encode(['code' => 200, 'data' => $examDetails]);
                    } else {
                        return json_encode(['code' => 202, 'title' => 'Something Went Wrong', 'message' => 'Please Try Again', "icon" => "error"]);
                    }
                
            } else {
                return json_encode(['code' => 201, 'title' => "Quiz not Exist", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error"]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error"]);
        }
    }
    

}