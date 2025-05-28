<?php

namespace App\Http\Controllers\Admin\ExamControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,  Validator, Storage, DB};
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Models\PeerReviewModule;
use App\Models\ExamManage;

class PeerReviewAdminController extends Controller
{
    public $peer_review_collection;
    public function __construct()
    {
        parent::__construct();
        $this->peer_review_collection = env('EXAM_PEER_REVIEW_COLLECTION');
    }

    public function addPeerReview(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $award_id = isset($request->award_id) ? base64_decode($request->input('award_id')) : 0;
            $peer_review_title = isset($request->peer_review_title) ? htmlspecialchars_decode($request->input('peer_review_title')) : '';

            try {
                $request->validate([
                    'award_id' => ['required', 'string'],
                    'peer_review_title' => [
                        'required', 'min:3',
                        'max:255', 'string'
                    ],
                ],[
                    'peer_review_title.min'=>'The peer review title must be at least 3 characters.',
                    'peer_review_title.max'=>'The peer review title must be less than 255 characters.',
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            if (is_exist('course_master', ['id' => $award_id]) > 0) {
                try {
                    $where = ['award_id' => $award_id, 'is_deleted' => 'No', 'deleted_at' => null];
                    $exists = is_exist('exam_peer_review', $where);
                    if (isset($exists) && $exists > 0) {
                        return json_encode([
                            'code' => 404, 'title' => "Already added", 'message' => 'Course peer review already added.', "icon" => generateIconPath("warning")
                        ]);
                    }else{
                        $select = [
                            'title' => $peer_review_title,
                            'award_id' => $award_id,
                            'created_by' => $admin_id,
                            'is_deleted' => 'No',
                            'last_updated_by' => $admin_id,
                            'created_at' => $this->time,
                        ];
                        DB::beginTransaction();
                        $assignUpdate = processData(['exam_peer_review', 'id'], $select);

                        if (isset($assignUpdate) && $assignUpdate['status'] === true) {
                            $select = [
                                'exam_id' => $assignUpdate['id'],
                                'course_id' => $award_id,
                                'exam_type' => 4,
                                'created_by' => $admin_id,
                                'created_at' => $this->time,
                            ];
                            $assginManageUpdate = processData(['exam_management_master', 'id'], $select);       

                            if (isset($assginManageUpdate) && $assginManageUpdate['status'] === true) {
                                DB::commit();
                                return json_encode(['code' => 200, 'title' => "Successfully Added", 'message' => 'Peer review added successfully', "icon" => generateIconPath("success")]);
                            }
                        }
                        DB::rollBack();
                        return json_encode([
                            'code' => 404, 'title' => "Unable to Add Peer Review", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                        ]);
                    }
                } catch (\Throwable $th) {
                    return $th;
                    DB::rollBack();
                    return json_encode([
                        'code' => 404, 'title' => "Unable to Add Peer Review", 'message' => 'Something Went Wrong', "icon" => generateIconPath("error")
                    ]);
                }
            } else {
                return json_encode([
                    'code' => 404, 'title' => "Unable to Add Peer Review", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                ]);
            }
        }
    }
    public function getPeerReviewData($action = '', $id = '')
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
                $contentData = $this->peerReviewModule->getPeerReviewDetails($where);
                return view('admin/exam/edit-peer-review', compact('contentData'));
            } else {
                $contentData = $this->peerReviewModule->getPeerReviewDetails($where);
            }
            return response()->json($contentData);
        }
        return redirect('/login');
    }
    public function editPeerReviewData ($action = '', $id = '')
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
                $contentData = $this->peerReviewModule->getPeerReviewDetails($where);
                return view('admin/exam/edit-peer-review', compact('contentData'));
            } else {
                $contentData = $this->peerReviewModule->getPeerReviewDetails($where);
            }
            return response()->json($contentData);
        }
        return redirect('/login');
    }
    public function updatePeerReview(Request $request)
    {
        ini_set('memory_limit', '512M');
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $peer_review_id = isset($request->peer_review_id) ? base64_decode($request->input('peer_review_id')) : 0;
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
                    $validate = array_merge($validate, ['instruction_file' => ['required', 'mimes:mp4', 'max:512000']]);
                    $Messages = [
                        'instruction_file.max' => 'The file must not be greater than 500MB.',
                        'instruction_file.mimes' => 'The file must be a mp4.',
                        'instruction_file.required' => 'The instruction file field is required.',
                    ];
                }
                $request->validate($validate,$Messages);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }

            $table = "exam_peer_review";
            $where = ['id' => $peer_review_id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            $getexistData = getData(
                'exam_peer_review',
                ['instrcution_file_url', 'instrcution_file_name', 'title'],
                ['id' => $peer_review_id, 'is_deleted' => 'No']
            );

            $fileExist = isset($getexistData[0]->instrcution_file_url) && !empty($getexistData[0]->instrcution_file_url) ? $getexistData[0]->instrcution_file_url : '';
            
            if ($request->hasFile('instruction_file') && $instruction_file->getClientOriginalExtension() == 'mp4') {
                $fileUrl = '';
                $filename = $instruction_file->getClientOriginalName();
                $library  = 3;
                $collection_id = $this->peer_review_collection;
                $fullname = $filename;
                $videoContent = [$collection_id, $instruction_file, $fullname];
                
                if (isset($fileExist) && !empty($fileExist) && $fileExist != '') {
                    $vidoId = $this->CourseModule->videoAction($fileExist, $videoContent, 'REPLACE', $library);
                } else {
                    $vidoId = $this->CourseModule->getVideoId($collection_id, $instruction_file, $fullname, $library);
                }
                if (isset($vidoId) && is_array($vidoId) && $vidoId['status'] === TRUE && $vidoId['videoId'] != '') {
                    $fileUrl = $vidoId['videoId'];

                } else {
                    return json_encode(['code' => 201, 'title' => "Unable to Upload Video", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
            }else{
                $fileUrl = $getexistData[0]->instrcution_file_url; 
                $filename = $getexistData[0]->instrcution_file_name;
            }

            if (isset($exists) && $exists > 0) {
                $select = [
                    'title' => $title,
                    'percentage' => $percentage,
                    'instructions' => $instruction,
                    'instrcution_file_url' => $fileUrl,
                    'instrcution_file_name' => $filename,
                    'last_updated_by' => $admin_id
                ];
                try {
                    DB::beginTransaction();
                    $updateSection = processData([$table, 'id'], $select, $where);
                    if (isset($updateSection) && $updateSection['status'] === true) {
                        DB::commit();
                        return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Peer Review successfully updated", "icon" => generateIconPath("success")]);
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
    public function deletePeerReview(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;
            $course_id =  isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;

            $table = "exam_peer_review";
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

                    $result = deleteRecord(PeerReviewModule::class, $where, true);

                    if (isset($result) && $result['status'] === true) {
                        
                        $where = ['course_id' => $course_id, 'exam_type' => '4', 'exam_id' => $result['id']];
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
