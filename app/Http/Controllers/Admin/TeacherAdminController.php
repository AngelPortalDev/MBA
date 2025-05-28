<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherProfile;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use File;
use App\Rules\WordCount;
class TeacherAdminController extends Controller
{

    public function TeacherList($cat)
    {   

        if (Auth::check()) {
            $teacherData = [];
            if (isset($cat) && !empty($cat)) {
                $query = TeacherProfile::where(['is_deleted' => 'No']);
                if ($cat == 'delete') {

                    $teacherData = TeacherProfile::where(['is_deleted' => 'Yes'])->orderByDesc('id')->get()->toArray();
                    return response()->json($teacherData);
                }else if($cat == 'active'){
                    
                    $where = ['status' => '0'];
                    $query->where($where);

                }else if($cat == 'inactive'){

                    $where = ['status' => '1'];
                    $query->where($where);

                }else{
                    $id = base64_decode($cat);
                    $exists = is_exist('lecturers_master', ['id' => $id]);
                    if ($exists > 0) {
                        $where = ['id' => $id];
                        $query->where($where);
                        $teacherData = $query->orderByDesc('id')->first();
                        return view('admin.teacher.edit-teacher', compact('teacherData'));
                    }
                }

                $teacherData = $query->orderByDesc('id')->get()->toArray();
            } 
            return response()->json($teacherData);
        }
        return redirect('/login');
    }
    
    public function createTeacher(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $name = isset($request->first_name) ? htmlspecialchars_decode($request->input('first_name')) : '';
            $last_name = isset($request->last_name) ? htmlspecialchars_decode($request->input('last_name')) : '';
            $email = isset($request->email) ? htmlspecialchars($request->input('email')) : '';
            $mob_code = isset($request->mob_code) ? htmlspecialchars($request->input('mob_code')) : '';
            $mobile = isset($request->mobile) ? htmlspecialchars($request->input('mobile')) : '';
            $designation = isset($request->designation) ? htmlspecialchars_decode($request->input('designation')) : '';
            $about_teacher = isset($request->about_teacher) ? htmlspecialchars_decode($request->input('about_teacher')) : '';
            $specialization = isset($request->specialization) ? htmlspecialchars_decode($request->input('specialization')) : '';
            $image_file = $request->hasFile('image_file') ? $request->file('image_file') : '';
            $teacher_id = isset($request->teacher_id) ? base64_decode($request->input('teacher_id')) : '';
            $old_img_name = isset($request->old_img_name) ? $request->input('old_img_name') : '';
            $catgeory_id = isset($request->category_id) ? $request->input('category_id') : '';
            $old_resume_name = isset($request->old_resume_name) ? $request->input('old_resume_name') : '';
            $resume_file = $request->hasFile('resume_file') ? $request->file('resume_file') : '';

            try {
                $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

                $data = $request->validate([
                    'first_name' => ['required', 'string', 'min:3', 'max:255'],
                    'last_name' => ['required', 'string', 'min:3', 'max:255'],
                    // 'mobile' => ['string', 'min:7', 'max:20'],
                    // 'email' => [ 'email', 'unique:' . TeacherProfile::class],
                    'designation' => ['required','string'],
                    // 'specialization' => ['string', new WordCount(50)],
                    'about_teacher' => ['required', 'string', new WordCount(50)],
                    'category_id'=> ['required']
                    // 'image_file' => 'mimes:jpeg,png,jpg,svg|max:1024',
                ],[
                    // 'specialization' => 'The specialization must not be greater than 50 words.',
                    'about_teacher.required' => 'The about teacher field is required.',
                    'about_teacher' => 'The about teacher must not be greater than 50 words.'
                ]
                );
                if($request->hasFile('image_file')){
                    $request->validate([
                        'image_file' => 'required|mimes:jpeg,png,jpg,svg|max:1024',
                    ], [
                        'image_file.mimes' => 'The image must be a file of type: jpeg, png, jpg, svg.',
                        'image_file.max' => 'The image must not exceed 1 MB.',
                    ]);
                }
                if($request->hasFile('resume_file')){
                    $request->validate([
                        'resume_file' => 'required|mimes:jpeg,png,jpg,pdf|max:1024',
                    ], [
                        'resume_file.mimes' => 'The image must be a file of type: jpeg, png, jpg, pdf',
                        'resume_file.max' => 'The image must not exceed 2 MB.',
                    ]);
                }
                if ($request->filled('specialization')) {
                    $request->validate([
                       'specialization' => ['string', new WordCount(50)],
                    ], [
                        'specialization' => 'The specialization must not be greater than 50 words.',
                    ]);
                }

                // Validation passed, continue processing the data...
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
                $Message = "created";
                // $Text_Message = "created";
                $where = ['id' => $teacher_id];
                $exists = is_exist('lecturers_master', $where);
                if (isset($exists) && $exists > 0) {
                    $where = ['id' => $teacher_id];
                    $Message = 'updated';
                }else{
                    if($email){
                        $where = ['email' => $email];
                        $exists = is_exist('lecturers_master', $where);
                        if (isset($exists) && $exists > 0) {
                            return json_encode(['code' => 201, 'title' => "Email is already taken.", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                        }
                    }

                }
                if ($request->hasFile('image_file')) {
                    $docUpload = UploadFiles($image_file, 'teacherDocs', '');
                    if ($docUpload === FALSE) {
                        return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => generateIconPath("error")]);
                    }

                }
                $folder = 'teacherDocs/resume';
                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder);
                }

                if ($request->hasFile('resume_file')) {
                    $docUploadResume = UploadFiles($resume_file, $folder, '');
                    if ($docUploadResume === FALSE) {
                        return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => generateIconPath("error")]);
                    }

                }

                
                $data = [
                    'lactrure_name' => $name.' '.$last_name,
                    'email' => $email,
                    'mobile' =>$mob_code.' '.$mobile,
                    'designation' => $designation,
                    'specialization' => $specialization,
                    'discription' => $about_teacher,
                    'created_at'=>$this->time,
                    'created_by'=>$admin_id,
                    'image' =>  !empty($docUpload['url']) ? $docUpload['url'] : $old_img_name,
                    'category_id'=>$catgeory_id,
                    'resume' => !empty($docUploadResume['url']) ? $docUploadResume['url'] : $old_resume_name,

                ];
    

                $updateTeacher = processData(['lecturers_master', 'id'], $data, $where);
                if (isset($updateTeacher) && $updateTeacher === FALSE) {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
                return json_encode(['code' => 200, 'title' => 'Successfully '.$Message.'', "message" => "Teacher $Message successfully", "icon" => generateIconPath("success")]);
        }else{
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }

    public function deleteTeacher(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $table = "lecturers_master";
            $admin_id = Auth::user()->id;
            $status =  isset($req->status) ? base64_decode($req->input('status')) : '';
                $i=0;
                $rules = [
                    "status" => "required|string",
                    "id" => "required",
                ];
                $validate = validator::make($req->all(), $rules);
                if (!$validate->fails()) {
                try {    
                    // echo $status;
                    if($status == 'delete'){  
                        if (isset($req->id) && count($req->id) > 0) {
                            $Message = "Deleted";
                            foreach ($req->id as $id) {
                                $id =  isset($id) ? base64_decode($id) : '';
                                $where = ['id' => $id, 'is_deleted' => 'No'];
                                $is_exits = is_exist($table, $where);
                                if (!empty($is_exits) && is_numeric($is_exits) && $is_exits > 0) {
                                    $updateTeacher = processData([$table, 'id'], ['is_deleted' => 'Yes', 'deleted_by' => Auth::user()->id], $where);
                                    if (isset($updateTeacher) && $updateTeacher !== FALSE) {
                                        $i++;
                                    }
                                }
                            }
                        }

                        if ($i > 0) {
                            return response()->json(['code' => 200, 'title' => $i . ' Records Successfully Deleted', 'icon' => generateIconPath('success')]);
                        } else {
                            return response()->json(['code' => 201, 'title' => 'Unable to Delete', "icon" => generateIconPath("error")]);
                        }
                    }
                    
                    if($status == 'teacher_status_active' || $status == 'teacher_status_inactive'){
                        $id =  isset($req->id) ? base64_decode($req->input('id')) : '';
                        $where = ['id' => $id, 'is_deleted' => 'No'];           
                        $exists = is_exist($table, $where);
                        if (isset($exists) && $exists > 0) {


                            $where = ['id' => $id];

                            if($status == 'teacher_status_active'){

                                $selectData = [
                                    'status' => '0',
                                    'updated_by' => $admin_id,
                                    'updated_at'=>$this->time
                                ];
                               
                            }else if($status == 'teacher_status_inactive'){

                                $selectData = [
                                    'status' => '1',
                                    'updated_by' => $admin_id,
                                    'updated_at'=> $this->time
                                ];
                            }   

                            $Message = "Status Changed";
                            $Message_Text = "status changed";
                            $updateTeacher = processData([$table, 'id'], $selectData , $where);
                            if (isset($updateTeacher)) {

                                return json_encode(['code' => 200, 'title' => "Successfully $Message", "message" => "Teacher $Message_Text successfully", "icon" => generateIconPath("success")]);
                            }
                        }
                    }
                    
                } catch (\Throwable $th) {
                    return $th;
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                }
            }else {
                return json_encode(['code' => 201, 'title' => "Something Went Wrong ", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
            }
             
        } else {
            return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please try unique name', "icon" => generateIconPath("error")]);
        }
    }

}
