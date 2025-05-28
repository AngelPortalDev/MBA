<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage};

class QuizController extends Controller
{
    public function __construct()
    {
        
        parent::__construct();
    }
    public function QuizSubmit(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check() ) {
            $user_id = Auth::user()->id;
            $quiz_id  = isset($req->quiz_id) ? base64_decode($req->input('quiz_id')) : 0;
            $course_id  = isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;
            $question  = isset($req->question_id) && is_array($req->question_id) ? $req->input('question_id') : [];
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
                    foreach ($question as $value) {
                        $n = $i + 1;
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
                        'course_id' => $course_id,
                        'quiz_id' => $quiz_id,
                        'quiz_score' => $score,
                        'quiz_status' => 1,
                        'created_at' =>  $this->time
                    ];

                    $attempt = is_exist('score_quiz', ['user_id' => $user_id, 'course_id'=>$course_id,'quiz_id' => $quiz_id, 'is_deleted' => 'No']);
                    if (isset($attempt) && is_numeric($attempt) && $attempt > 0) {
                        return json_encode(['code' => 201, 'title' => "Quiz Already Submitted", 'message' => 'Quiz already submitted', "icon" => generateIconPath("error")]);
                    }
                    $updateCourse = processData(['score_quiz', 'id'], $select);
                    if (isset($updateCourse) && is_array($updateCourse) && $updateCourse['status'] === TRUE) {
                        return json_encode(['code' => 200, 'title' => 'Your Score is ' . $score . "%", "message" => "Quiz submitted successfully", "icon" => generateIconPath("success"), 'score' => $score]);
                    }
                    return json_encode(['code' => 201, 'title' => "Unable to Create Course", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error")]);
                } else {
                    return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
                }
            } else {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }


    public function QuizView(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $user_id = Auth::user()->id;
            $quiz_id  = isset($req->id) ? base64_decode($req->input('id')) : 0;
            $course_id  = isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;
            $validate_rules = [
                'id' => 'required|string',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (is_exist('exam_quiz', ['id' => $quiz_id, 'is_deleted' => 'No']) > 0) {
                $is_done = is_exist('score_quiz', ['user_id' => $user_id, 'course_id' => $course_id, 'quiz_id' => $quiz_id]);
                if ($is_done === 0) {
                    if (!$validate->fails()) {
                        $where = ['id' => $quiz_id, 'is_deleted' => 'No'];
                        $examDetails = $this->Quiz->getQuizDetails($where);
                        return json_encode(['code' => 200, 'data' => $examDetails]);
                    } else {
                        return json_encode(['code' => 202, 'title' => 'Something Went Wrong', 'message' => 'Please Try Again', "icon" => "error"]);
                    }
                } else {
                    $getScore = getData('score_quiz', ['quiz_score'], ['user_id' => $user_id, 'course_id' => $course_id, 'quiz_id' => $quiz_id]);
                    $score = $getScore[0]->quiz_score;
                    return json_encode(['code' => 203, 'title' => "Quiz Already Submit", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error", "score" => $score]);
                }
            } else {
                return json_encode(['code' => 201, 'title' => "Quiz not Exist", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error"]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => "error"]);
        }
    }
        
}