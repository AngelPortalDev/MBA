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

class FinalThesisAdminController extends Controller
{
    
    public function addFinalThesis(Request $request)
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
                ],[
                    'title.min'=>'The final thesis title must be at least 3 characters.',
                    'title.max'=>'The final thesis title should be less than 255 characters.',
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
                            'code' => 404, 'title' => "Already Added", 'message' => 'Exam final thesis already added.', "icon" => generateIconPath("warning")
                        ]);
                    }else{
                        $select = [
                            'title' => $title,
                            'award_id' => $award_id,
                            'created_by' => $admin_id,
                            'requires_word_count' => '1',
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
                                return json_encode(['code' => 200, 'title' => "Successfully Added", 'message' => 'Final thesis added successfully', "icon" => generateIconPath("success")]);
                            }
                        }
                        DB::rollBack();
                        return json_encode([
                            'code' => 404, 'title' => "Unable to Add final thesis", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                        ]);
                    }
                } catch (\Throwable $th) {
                    return $th;
                    DB::rollBack();
                    return json_encode([
                        'code' => 404, 'title' => "Unable to Add final thesis", 'message' => 'Something Went Wrong', "icon" => generateIconPath("error")
                    ]);
                }
            } else {
                return json_encode([
                    'code' => 404, 'title' => "Unable to Add final thesis", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                ]);
            }
        }
    }
    
    public function getFinalThesis($action = '', $id = '')
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
                return view('admin/exam/edit-final-thesis', compact('contentData'));
            } else {
                $where = ['requires_word_count' => 1];
                $contentData = $this->mockExam->getMockDetails($where);
            }
            return response()->json($contentData);
        }
        return redirect('/login');
    }
}
