<?php

namespace App\Http\Controllers\Admin\ExamControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Models\DiscordModule;
use App\Models\ExamManage;

class DiscordAdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function addDiscord(Request $request)
    {

        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $award_id = isset($request->award_id) ? base64_decode($request->input('award_id')) : 0;
            $percentage = isset($request->percentage) ? htmlspecialchars($request->input('percentage')) : '';
            $marks = isset($request->marks) ? htmlspecialchars($request->input('marks')) : '';

            try {
                $request->validate([
                    'award_id' => ['required', 'string'],
                    'percentage' => ['required'],
                    'marks' => ['required'],
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            if (is_exist('course_master', ['id' => $award_id]) > 0) {
                try {
                    $where = ['award_id' => $award_id, 'is_deleted' => 'No', 'deleted_at' => null];
                    $exists = is_exist('exam_discord', $where);
                    if (isset($exists) && $exists > 0) {
                        return json_encode([
                            'code' => 404, 'title' => "Already added", 'message' => 'Course forum leadership already added.', "icon" => generateIconPath("warning")
                        ]);
                    }else{
                        $select = [
                            'award_id' => $award_id,
                            'percentage' => $percentage,
                            'marks' => $marks,
                            'created_by' => $admin_id,
                            'is_deleted' => 'No',
                            'last_updated_by' => $admin_id,
                            'created_at' => $this->time,
                        ];
                        DB::beginTransaction();
                        $discordUpdate = processData(['exam_discord', 'id'], $select);
                        if (isset($discordUpdate) && $discordUpdate['status'] === true) {
                            $select = [
                                'exam_id' => $discordUpdate['id'],
                                'course_id' => $award_id,
                                'exam_type' => 5,
                                'created_by' => $admin_id,
                                'created_at' => $this->time,
                            ];
                            $assginManagUpdate = processData(['exam_management_master', 'id'], $select);
                            if (isset($assginManagUpdate) && $assginManagUpdate['status'] === true) {
                                DB::commit();
                                return json_encode(['code' => 200, 'title' => "Successfully Added", 'message' => 'Forum leadership added successfully', "icon" => generateIconPath("success")]);
                            }
                        }
                        DB::rollBack();
                        return json_encode([
                            'code' => 404, 'title' => "Unable to Add Discord", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                        ]);
                    }
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return json_encode([
                        'code' => 404, 'title' => "Unable to Add Discord", 'message' => 'Something Went Wrong', "icon" => generateIconPath("error")
                    ]);
                }
            } else {
                return json_encode([
                    'code' => 404, 'title' => "Unable to Add Discord", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                ]);
            }
        }
    }
    public function getDiscordData($action = '', $id = '')
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
                $contentData = $this->discordModule->getDiscordDetails($where);
                return view('admin/exam/edit-discord', compact('contentData'));
            } else {
                $contentData = $this->discordModule->getDiscordDetails($where);
            }
            return response()->json($contentData);
        }
        return redirect('/login');
    }
    public function editDiscordData ($action = '', $id = '')
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
                $contentData = $this->discordModule->getDiscordDetails($where);
                return response()->json([
                    'code' => 200,
                    'data' => $contentData
                ]);
            }else {
                return response()->json([
                    'code' => 404,
                    'message' => 'Data not found'
                ]);
            }
            return response()->json([
                'code' => 404,
                'message' => 'Data not found'
            ]);
        }
        return redirect('/login');
    }
    public function updateDiscord(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $discord_id = isset($request->discord_id) ? base64_decode($request->input('discord_id')) : 0;
            $percentage = isset($request->percentage) ? htmlspecialchars($request->input('percentage')) : 0;
            $marks = isset($request->marks) ? htmlspecialchars($request->input('marks')) : '';
            $Messages =[];
            try {
                $validate = [
                    'percentage' => ['required', 'numeric', 'max:100'],
                    'marks' => ['required'],
                ];
                $request->validate($validate,$Messages);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }

            $table = "exam_discord";
            $where = ['id' => $discord_id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            $getexistData = getData(
                'exam_discord',
                ['percentage', 'marks'],
                ['id' => $discord_id, 'is_deleted' => 'No']
            );

            if (isset($exists) && $exists > 0) {
                $select = [
                    'percentage' => $percentage,
                    'marks' => $marks,
                    'last_updated_by' => $admin_id
                ];
                try {
                    DB::beginTransaction();
                    $updateSection = processData([$table, 'id'], $select, $where);
                    if (isset($updateSection) && $updateSection['status'] === true) {
                        DB::commit();
                        return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Forum leadership successfully updated", "icon" => generateIconPath("success")]);
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
    public function deleteDiscord(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;
            $course_id =  isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;

            $table = "exam_discord";
            $where = ['id' => $id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                try {
                    DB::beginTransaction();
                    
                    $canDeleteExam = canDeleteExam($course_id);

                    if ($canDeleteExam['status'] === false) {
                        return json_encode(['code' => 403, 'title' => 'Deletion Failed', 'message' => $canDeleteExam['message'], "icon" => generateIconPath("error")]);
                    }

                    $result = deleteRecord(DiscordModule::class, $where, true);

                    if (isset($result) && $result['status'] === true) {
                        $where = ['course_id' => $course_id, 'exam_type' => '5', 'exam_id' => $result['id']];
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
