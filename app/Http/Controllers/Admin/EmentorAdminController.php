<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};
use App\Models\User;
use App\Models\EmentorProfile;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportAdmin;
use App\Imports\ImportAdmin;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use File;

class EmentorAdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }
  
    public function createEmentor(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $first_name = isset($request->first_name) ? htmlspecialchars_decode($request->input('first_name')) : '';
            $last_name = isset($request->last_name) ? htmlspecialchars_decode($request->input('last_name')) : '';
            $email = isset($request->email) ? htmlspecialchars($request->input('email')) : '';
            $mob_code = isset($request->mob_code) ? htmlspecialchars($request->input('mob_code')) : '';
            $mobile = isset($request->mobile) ? htmlspecialchars($request->input('mobile')) : '';
            $userAgent = $request->header('User-Agent');
            $ipAddress = $request->ip();
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');
            $mobile = isset($request->mobile) ? htmlspecialchars($request->input('mobile')) : '';
            $role = $request->has('role') ? $request->role : 'instructor';
            $url = '';
            $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
            try {
                $data = $request->validate([
                    'first_name' => ['required', 'string', 'min:3', 'max:255'],
                    'last_name' => ['required', 'string', 'min:3', 'max:255'],
                    'mob_code' => ['required', 'string', 'min:1'],
                    'mobile' => ['required', 'string', 'min:6', 'max:20','unique:users,phone'],
                    'email' => ['required', 'string', 'email', 'max:255', 'regex:' . $emailRegex, 'unique:' . User::class],
                    'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
                    'password_confirmation' => ['required', 'same:password'],
                ],[
                    'mobile.min'=>'The mobile number must be at least 6 characters.',
                    'password.regex' => 'Password must be at least 8 characters in the format Abc@1234.',
                    'mobile.unique' => 'This mobile number is already registered.',
                    'password.min'=>'Password must be at least 8 characters in the format Abc@1234.'
                ]);
            
            } catch (ValidationException $e) {
                // Validation failed, return the validation errors
                $errors = $e->validator->errors();
                return response()->json([
                    'code' => 202,
                    'title' => 'Required Fields are Missing.',
                    'message' => 'Please Provide Required Info',
                    'icon' => 'error',
                    'data' => $errors
                ]);
            }
            $data = [
                'name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'mob_code' => $mob_code,
                'phone' => $mobile,
                'role' => $role,
                'last_seen' => $timestamp,
                'last_session_ip' => $ipAddress,
                'user_agent' => $userAgent,
                'password' => Hash::make($request->password),
            ];

            $user = User::create($data);
            if (isset($user->id)) {
                EmentorProfile::create(['ementor_id' => $user->id]);
                return json_encode(['code' => 200, 'title' => "Successfully Created", 'message' => 'E-mentor created successfully', "icon" => generateIconPath("success")]);
            } else {
                return json_encode(['code' => 404, 'title' => "Unable to Create Ementor", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => 'Something Went Wrong', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error")]);
        }
    }

    public function getEmentorData($cat)
    {
        if (Auth::check()) {
            $ementorData = [];
            $where = [];
            $ementorDashboardData = [];
            if (isset($cat) && !empty($cat) && $cat != 'all'){

                if ($cat == 'Active') {
                    $where = ['status' => '0'];
                }
                if($cat == 'Inactive'){
                    $where = ['status' => '1'];
                }
                if ($cat == 'delete') {
                    $where = ['is_deleted' => 'Yes'];
                }
                if(base64_decode($cat) > 0){
                    $where = ['ementor_id' => base64_decode($cat)];
                }
            }
            if(base64_decode($cat) > 0 && $cat != 'all'){

                $ementorData = $this->EmentorProfile->getEmentorProfile($where);
                
                $ementorDashboardData = $this->CourseModule->getEmentorDashboardData($where);

                $ementorAboutmedata = DB::table('ementor_about_me')->where($where)->get();
                
                return view('admin.e-mentors.e-mentors-edit', compact('ementorData','ementorDashboardData','ementorAboutmedata'));

            }else{
                 $ementorData = $this->EmentorProfile->getEmentorProfile($where);
                 return response()->json($ementorData);

            }

        }
        return redirect('/login');
    }  
    public function statusEmentor(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $table = "users";
            $admin_id = Auth::user()->id;
            $status =  isset($req->status) ? base64_decode($req->input('status')) : '';
            $source = isset($req->source) ? ucfirst(strtolower($req->input('source'))) : '';

                $i=0;
                $rules = [
                    "status" => "required|string",
                    "id" => "required",
                ];
                $validate = validator::make($req->all(), $rules);
                if (!$validate->fails()) {
                  
                try {    
                    $id =  isset($req->id) ? base64_decode($req->input('id')) : '';
                    $where = ['id' => $id, 'is_deleted' => 'No'];
                    $exists = is_exist($table, $where);
                    if (isset($exists) && $exists > 0) {
                        $where = ['id' => $id];
                        if($status == 'ementor_status_active'){
                            $selectData = [
                                'is_active' => 'Active',
                            ];
                            $Message = "Status Changed";
                            $updateEmentors = processData([$table, 'id'], $selectData , $where);
                            $selectData = [
                                'status' => '0',
                            ];
                            $where = ['ementor_id' => $id];
                            $Message = "status changed";
                            $MessageTitle = "Status Changed";
                            $updateEmentor = processData(['ementor_profile_master', 'ementor_profile_id'], $selectData , $where);

                        }
                        if($status == 'ementor_status_inactive'){
                            $selectData = [
                                'is_active' => 'Inactive',
                            ];
                            $Message = "status changed";
                            $updateEmentors = processData([$table, 'id'], $selectData , $where);
                            $selectData = [
                                'status' => '1',
                            ];
                            $where = ['ementor_id' => $id];
                            $MessageTitle = "Status Changed";

                            $updateEmentor = processData(['ementor_profile_master', 'ementor_profile_id'], $selectData , $where);

                        }
                        if (isset($updateEmentor) && $updateEmentor['status'] == TRUE) {
                            return json_encode(['code' => 200, 'title' => "$MessageTitle Successfully.", "message" => "$source $Message successfully", "icon" => generateIconPath("success")]);
                        }
                    }
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                    
                } catch (\Throwable $th) {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
            }else {
                return json_encode(['code' => 201, 'title' => "Something Went Wrong ", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
             
        } else {
            return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please Try Unique Name', "icon" => generateIconPath("error")]);
        }
    }

    public function editProfile(Request $req)
    {

        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {

            if (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin') {
                $ementor_id = isset($req->ementor_id) ? base64_decode($req->input('ementor_id')) : '';
            } else {
                $ementor_id = Auth::user()->id;
            }
            $first_name = isset($req->first_name) ? htmlspecialchars_decode($req->input('first_name')) : '';
            $last_name = isset($req->last_name) ? htmlspecialchars_decode($req->input('last_name')) : '';
            $dob = isset($req->dob) ? htmlspecialchars($req->input('dob')) : '';
            $gender = isset($req->gender) ? htmlspecialchars($req->input('gender')) : 'Not Disclose';
            $country = isset($req->country_id) ? htmlspecialchars($req->input('country_id')) : 0;
            $nationality = isset($req->nationality) ? htmlspecialchars_decode($req->input('nationality')) : '';
            $address = isset($req->address) ? htmlspecialchars_decode($req->input('address')) : '';
            $highest_education = isset($req->highest_education) ? htmlspecialchars($req->input('highest_education')) : '';
            $specialization = isset($req->specialization) ? htmlspecialchars_decode($req->input('specialization')) : '';
            $institution_name = isset($req->institution_name) ? htmlspecialchars_decode($req->input('institution_name')) : '';
            $ementor_resume = $req->hasFile('ementor_resume') ? $req->file('ementor_resume') : '';
            $old_resume_file = isset($req->old_resume_file) ? htmlspecialchars($req->input('old_resume_file')) : '';
            $folder_name = isset($req->folder_name) ? htmlspecialchars($req->input('folder_name')) : '';
            $resume_file_name = isset($req->resume_file_name) ? htmlspecialchars($req->input('resume_file_name')) : '';
            $country = isset($req->country_id) ? htmlspecialchars($req->input('country_id')) : 0;
            $ementor = isset($req->ementor) ? htmlspecialchars($req->input('ementor')) : 0;

            $exists =   is_exist('users', ['id' => $ementor_id,  'is_deleted' => 'No']);
            if (isset($exists) && is_numeric($exists) && $exists === 0) {
                return json_encode(['code' => 201, 'title' => 'User Not Available', 'message' => 'User not Exist', 'remark' => 'warning', "icon" => generateIconPath("warning")]);
            }
            $validate_rules = [
                'first_name' => 'required|string|max:225|min:3',
                'last_name' => 'required|string|max:225|min:2',
                // 'dob' => 'required|date|before:today',
                // 'country_id' => 'required|numeric|min:1'
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                $select = [
                    'name' => $first_name,
                    'last_name' => $last_name
                ];

                $where = ['id' => $ementor_id,  'is_deleted' => 'No'];
                $updateUser = processData(['users', 'id'], $select, $where, 'update');

                $resume_file = $old_resume_file;
                $filename =  $resume_file_name;
                $folder = $folder_name;
                if($req->hasFile('ementor_resume')){
                    if (isset($folder_name) && !empty($folder_name)) {

                        $folder = $folder_name;

                    }else{
                        $folder = "Ementor_" . time() . "_" . $first_name;
                        $makeFolder = File::makeDirectory(public_path("storage/ementorDocs/" . $folder), $mode = 0777, true, true);
                        if (!isset($makeFolder) && $makeFolder === 0 && is_numeric($makeFolder)) {
                            return false;
                        }
                    }
                    
                    $filename = $ementor_resume->getClientOriginalName();
              
                    $docUpload = UploadFiles($ementor_resume, 'ementorDocs/'.$folder, $old_resume_file);

                    if ($docUpload === FALSE) {
                        return json_encode(['code' => 201, 'title' => 'File is corrupt', 'message' => 'File is corrupt', "icon" => generateIconPath("error")]);
                    }
               
                    $resume_file = $docUpload['url'];
                }
              
                if (isset($updateUser) && $updateUser['status'] === TRUE && $updateUser['id']  > 0) {
                    $select = [
                        'ementor_id' => $updateUser['id'],
                        'address' => $address,
                        'country_id' => $country,
                        'gender' => $gender,
                        'dob' => $dob,
                        'nationality' => $nationality,
                        'highest_education'=> $highest_education,
                        'specialization' => $specialization,
                        'institution_name'=>$institution_name,
                        'upload_resume'=> $resume_file,
                        'resume_file_name'=>$filename,
                        'folder_name'=>$folder,
                        'last_profile_update_on' =>  $this->time,
                    ];
                    $where = ['ementor_id' => $updateUser['id']];
                    $exists = is_exist('ementor_profile_master', $where);
                    if (isset($exists) && $exists > 0) {
                        $action = 'update';
                    } else {
                        $action = 'insert';
                    }

                    $updateUserProfile = processData(['ementor_profile_master', 'ementor_profile_id'], $select, $where, $action);
                    if ($ementor) {
                        $select = [
                            'sub_ementor_id' => $ementor_id,
                            'ementor_id' => $ementor,
                            'created_by' => Auth::user()->id,
                            'is_deleted' => 'No',
                        ];
                        $where = [
                            'sub_ementor_id' => $ementor_id,
                            'is_deleted' => 'No',
                        ];
                        $action = is_exist('ementor_submentor_relations', $where) ? 'update' : 'insert';
                        processData(['ementor_submentor_relations', 'id'], $select, $where, $action);
                    }

                    if (isset($updateUserProfile) && $updateUserProfile === FALSE) {
                        return json_encode(['code' => 201, 'title' => "Something Went Wrong1", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                    }
                    return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Ementor details updated successfully", "icon" => generateIconPath("success")]);
                }
            } else {


                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
            }
        }
    }

    public  function ementorProfileUpload(Request $req)
    {

        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {

            $image_file = $req->hasFile('image_file') ? $req->file('image_file') : '';

            $old_img_name = !empty($req->input('old_img_name')) ? $req->input('old_img_name') : '';

            $user_name = !empty($req->input('user_name')) ? base64_decode($req->input('user_name')) : '';

            $user_id = !empty($req->input('user_id')) ? base64_decode($req->input('user_id')) : '';

            if ($req->hasFile('image_file')) {

                $rules = [

                    'image_file' => 'required|mimes:jpeg,png,jpg,svg|max:1024',

                ];
                $validate = Validator::make($req->only(['image_file']), $rules);

                if (!$validate->fails()) {

                    $folder_name = EmentorProfile::where('ementor_id', $user_id)->first();

                    if (isset($old_img_name) && !empty($old_img_name)) {

                        $folder = $folder_name['folder_name'];

                    } else {

                        $folder = "Ementor_" . time() . "_" . $user_name;

                        $makeFolder = File::makeDirectory(public_path("storage/ementorDocs/" . $folder), $mode = 0777, true, true);

                        if (!isset($makeFolder) && $makeFolder === 0 && is_numeric($makeFolder)) {

                            return false;
                        }
                    }
                    $docUpload = UploadFiles($image_file, 'ementorDocs/' . $folder, $old_img_name); 
                    
                    if ($docUpload === FALSE) {
                        return json_encode(['code' => 203, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => generateIconPath("error"), 'old' => $old_img_name]);
                    }
                    $where = ['id' => $user_id];

                    $select = [

                        'photo' => $docUpload['url'],

                    ];
                    $updateUser = processData(['users', 'id'], $select, $where);

                    return json_encode(['code' => 200, 'message' => 'Successfully Uploaded', 'text' => "", "icon" => generateIconPath("success"), 'new' => $docUpload['url']]);

                } else {

                    echo json_encode(['code' => 203, 'message' => 'Invalid File', 'text' => "File Should be JPG, PNG & Less then 1MB", "icon" => generateIconPath("error"), 'old' => $old_img_name]);
                }
            } else {

                echo json_encode(['code' => 204, 'message' => 'No Image', 'text' => "", "icon" => generateIconPath("error"), 'old' => $old_img_name]);
            }
        } else {

            echo json_encode(['code' => 205, 'message' => 'Something Went Wrong', 'text' => "", "icon" => generateIconPath("error")]);
        }
    }

    public function assignCourseList($ementor_id){
        if (Auth::check()) {
            $ementorData = [];
            $where = ['ementor_id' => base64_decode($ementor_id)];
            $ementorData = $this->CourseModule->getEmentorCourseData($where);
            return response()->json($ementorData);        
        }
        return redirect('/login');
    }

    public function deleteEmentor(Request $req)
    {  
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $table = "ementor_profile_master";
            $admin_id = Auth::user()->id;
                $i=0;
                $rules = [
                    "id" => "required",
                ];
                $validate = validator::make($req->all(), $rules);
                if (!$validate->fails()) {
                try {    
                    // echo $status;
                        DB::beginTransaction();
                        if (isset($req->id) && count($req->id) > 0) {
                            $Message = "Deleted";
                            foreach ($req->id as $id) {
                                $id =  isset($id) ? base64_decode($id) : '';
                                $where = ['ementor_id' => $id, 'is_deleted' => 'No'];
                                $is_exits = is_exist($table, $where);
                                if (!empty($is_exits) && is_numeric($is_exits) && $is_exits > 0) {
                                    $updateTeacher = processData([$table, 'ementor_profile_id'], ['is_deleted' => 'Yes', 'deleted_by' => Auth::user()->id], $where);

                                    User::where('id', $id)->update(['is_deleted' => 'Yes', 'deleted_by' => Auth::user()->id, 'deleted_at' => now()]);

                                    if (isset($updateTeacher) && $updateTeacher !== FALSE) {
                                        $i++;
                                    }
                                }
                            }

                        if ($i > 0) {
                            DB::commit();
                            return response()->json(['code' => 200, 'title' => $i . ' Records Successfully Deleted', 'icon' => generateIconPath('success')]);
                        } else {
                            DB::rollBack();
                            return response()->json(['code' => 201, 'title' => 'Unable to Delete', "icon" => generateIconPath("error")]);
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
    
    public function courseStudentList($status = '', $courseId)
    {
        if (isset($courseId) && !empty($courseId)) {
            $course = DB::table('course_master')->where('id', base64_decode($courseId))->first();
            $ementorId = 0;
            if(!empty($course) && $course != null){
                $ementorId = $course->ementor_id != '' ? $course->ementor_id : 0;
            }
        }

        $status = isset($status) && !empty($status) ? base64_decode($status) : 4;
        if (Auth::check() && !empty($ementorId) && $ementorId != 0) {
            $where = [];
            $studentData = [];
            $ementor = ['ementor_id' => $ementorId, 'is_deleted' => 'No'];
            
            $studentData = $this->ExamRemark->studentList($ementorId, $courseId, $status);

            return response()->json($studentData);
        }

        return redirect('/login');
    }
    
    public function ementorStudentInfo($studentId, $course_id, $student_course_master_id )
    {
        if (Auth::check() && isset($studentId) && !empty($studentId) && isset($course_id) && !empty($course_id) && $course_id) {
            $course = DB::table('course_master')->where('id', base64_decode($course_id))->first();
            $ementorId = 0;
            if(!empty($course) && $course != null){
                $ementorId = $course->ementor_id != '' ? $course->ementor_id : 0;
            }
            $studentId = isset($studentId) && !empty($studentId) ? base64_decode($studentId) : 0;
            $course_id = isset($course_id) && !empty($course_id) ? base64_decode($course_id) : 0;
            $student_course_master_id = isset($student_course_master_id) && !empty($student_course_master_id) ? base64_decode($student_course_master_id) : 0;


            $where = ['user_id' => $studentId, 'course_id' => $course_id, 'ementor_id' => $ementorId, 'student_course_master_id' => $student_course_master_id];
            $ementorStudentData = $this->ExamRemark->getEmentorStudentsDetails($where);
            
            return view('frontend/teacher/e-mentor-students-exam-details', compact('ementorStudentData'));
            
        }
        return redirect('/login');
    }
    
    public function studentAnswerSheet($examId, $examType,$user_id, $student_course_master_id)
    {
        if (Auth::check() && isset($examId) && !empty($examId) && isset($examType) && !empty($examType)) {
            $examId = isset($examId) && !empty($examId) ? (int) base64_decode($examId) : 0;
            $examType = isset($examType) && !empty($examType) ? base64_decode($examType) : 0;
            $user_id = isset($user_id) && !empty($user_id) ? base64_decode($user_id) : 0;
            $student_course_master_id = isset($student_course_master_id) && !empty($student_course_master_id) ? base64_decode($student_course_master_id) : 0;

            $examData = [];
            if ($examType === '1') {
                // Assignment Exam
                $where = ['id' => $examId,'exam_type'=>'1','is_cheking_completed'=>'0'];
                $examData = $this->ExamRemark->getQuestionAnswer($where, 1,$user_id, $student_course_master_id);
                if (!empty($examData)) {
                    $course = getData('student_course_master', ['course_id'], ['id' => $examData[0]['student_course_master_id']]);
                    $courseId = 0;
                    if (isset($course) && !empty($course)) {
                        $courseId = $course[0]->course_id;
                    }
                    return view('frontend/exam/assignment-answersheet', compact('examData', 'courseId'));
                } else {
                    return redirect()->back()->with('exam', 'Checking Already Done');
                }
            } elseif ($examType === '2') {
                // Mock Inteview Exam
                $where = ['id' => $examId,'exam_type'=>'2','is_cheking_completed'=>'0'];
                $examData = $this->ExamRemark->getQuestionAnswer($where, 2,$user_id, $student_course_master_id);
                if (!empty($examData)) {
                    $course = getData('student_course_master', ['course_id'], ['id' => $examData[0]['student_course_master_id']]);
                    $courseId = 0;
                    if (isset($course) && !empty($course)) {
                        $courseId = $course[0]->course_id;
                    }
                    return view('frontend/exam/mock-interview-answersheet', compact('examData', 'courseId'));
                } else {
                    return redirect()->back()->with('exam', 'Checking Already Done');
                }
            } elseif ($examType === '3') {
                // Vlog Exam
                $where = ['id' => $examId,'exam_type'=>'3','is_cheking_completed'=>'0'];
                $examData = $this->ExamRemark->getQuestionAnswer($where, 3,$user_id, $student_course_master_id);
                if (!empty($examData)) {
                    $course = getData('student_course_master', ['course_id'], ['id' => $examData[0]['student_course_master_id']]);
                    $courseId = 0;
                    if (isset($course) && !empty($course)) {
                        $courseId = $course[0]->course_id;
                    }
                    return view('frontend/exam/vlog-answersheet', compact('examData', 'courseId'));
                } else {
                    return redirect()->back()->with('exam', 'Checking Already Done');
                }
            } elseif ($examType === '4') {
                // Peer Review Exam
                $where = ['id' => $examId,'exam_type'=>'4','is_cheking_completed'=>'0'];
                $examData = $this->ExamRemark->getQuestionAnswer($where, 4,$user_id, $student_course_master_id);
                if (!empty($examData)) {
                    $course = getData('student_course_master', ['course_id'], ['id' => $examData[0]['student_course_master_id']]);
                    $courseId = 0;
                    if (isset($course) && !empty($course)) {
                        $courseId = $course[0]->course_id;
                    }
                    return view('frontend/exam/peer-review-answersheet', compact('examData', 'courseId'));
                } else {
                    return redirect()->back()->with('exam', 'Checking Already Done');
                }
            } elseif ($examType === '5') {
                // Forum Leadership
                $where = ['id' => $examId,'exam_type'=>'5','is_cheking_completed'=>'0'];
                $examData = $this->ExamRemark->getQuestionAnswer($where, 5,$user_id, $student_course_master_id);
                if (!empty($examData)) {
                    $course = getData('student_course_master', ['course_id'], ['id' => $examData[0]['student_course_master_id']]);
                    $courseId = 0;
                    if (isset($course) && !empty($course)) {
                        $courseId = $course[0]->course_id;
                    }
                    return view('frontend/exam/forum-leadership-answersheet', compact('examData', 'courseId'));
                } else {
                    return redirect()->back()->with('exam', 'Checking Already Done');
                }
            } elseif ($examType === '6') {
                // Reflective Journal
                $where = ['id' => $examId,'exam_type'=>'6','is_cheking_completed'=>'0'];
                $examData = $this->ExamRemark->getQuestionAnswer($where, 6,$user_id, $student_course_master_id);
                if (!empty($examData)) {
                    $course = getData('student_course_master', ['course_id'], ['id' => $examData[0]['student_course_master_id']]);
                    $courseId = 0;
                    if (isset($course) && !empty($course)) {
                        $courseId = $course[0]->course_id;
                    }
                    return view('frontend/exam/reflective-journal-answersheet', compact('examData', 'courseId'));
                } else {
                    return redirect()->back()->with('exam', 'Checking Already Done');
                }
            } elseif ($examType === '8') {
                // Survey
                $where = ['id' => $examId,'exam_type'=>'8','is_cheking_completed'=>'0'];
                $examData = $this->ExamRemark->getQuestionAnswer($where, 8,$user_id, $student_course_master_id);
                if (!empty($examData)) {
                    $course = getData('student_course_master', ['course_id'], ['id' => $examData[0]['student_course_master_id']]);
                    $courseId = 0;
                    if (isset($course) && !empty($course)) {
                        $courseId = $course[0]->course_id;
                    }
                    return view('frontend/exam/survey-answersheet', compact('examData', 'courseId'));
                } else {
                    return redirect()->back()->with('exam', 'Checking Already Done');
                }
            } elseif ($examType === '9') {
                // Artificial Intelligence
                $where = ['id' => $examId,'exam_type'=>'9','is_cheking_completed'=>'0'];
                $examData = $this->ExamRemark->getQuestionAnswer($where, 9,$user_id, $student_course_master_id);
                if (!empty($examData)) {
                    $course = getData('student_course_master', ['course_id'], ['id' => $examData[0]['student_course_master_id']]);
                    $courseId = 0;
                    if (isset($course) && !empty($course)) {
                        $courseId = $course[0]->course_id;
                    }
                    return view('frontend/exam/artificial-intelligence-answersheet', compact('examData', 'courseId'));
                } else {
                    return redirect()->back()->with('exam', 'Checking Already Done');
                }
            } else {
                return redirect()->back()->with('exam', 'Checking Already Done');
            }
        }
        return redirect('/login');
    }
    
    public function ementorStudentPortfolioAnswersheet($studentId, $courseId, $studentCourseMasterId)
    {
        if (Auth::check() && isset($studentId) && !empty($studentId) && isset($courseId) && !empty($courseId)) {
            
            $studentId = isset($studentId) && !empty($studentId) ? $studentId : 0;
            $courseId = isset($courseId) && !empty($courseId) ? $courseId : 0;
            $studentCourseMasterId = isset($studentCourseMasterId) && !empty($studentCourseMasterId) ? $studentCourseMasterId : 0;

            $portfolioData = $this->ExamRemark->getportfolioQuestionAnswer($studentId, $courseId, $studentCourseMasterId);
            return view('frontend/exam/e-portfolio-answersheet', compact('portfolioData'));
        }
        return redirect('/login');
    }
    
    public function ementorExamList($status = '', $ementorId = '')
    {
        $ementorId = isset($ementorId) && !empty($ementorId) ? base64_decode($ementorId) : 0;
        $subEmentorId = null;
        $role = DB::table('users')->where('id', $ementorId)->pluck('role')->first();

        
        if ($role == 'sub-instructor') {
            $subEmentorId = isset($ementorId) && !empty($ementorId) ? $ementorId : 0;
            $ementorId = DB::table('ementor_submentor_relations')
            ->where('sub_ementor_id', $subEmentorId)
            ->pluck('ementor_id')
            ->first();

            $studentCourseMasterIds = DB::table('subementor_student_relations')
            ->where('sub_ementor_id', $subEmentorId)
            ->pluck('student_course_master_id');

        }

        $status = isset($status) && !empty($status) ? base64_decode($status) : 4;
        if (Auth::check() && !empty($ementorId) && $ementorId != 0) {
            $where = [];
            $ementorData = [];
            $students = [];
            $courseIds = [];
            $studentCourseMasters = [];
            $ementor = ['ementor_id' => $ementorId];
            if ($status === '0') {
                $where = ['is_cheking_completed' => "0"];
                
                $ementorData = DB::table('exam_remark_master')
                    ->join('course_master', 'course_master.id', 'exam_remark_master.course_id')
                    ->join('users', 'users.id', 'exam_remark_master.user_id')
                    ->when($role === 'sub-instructor' && isset($subEmentorId), function ($query) use ($subEmentorId) {
                        return $query->join('subementor_student_relations', 'subementor_student_relations.student_id', '=', 'exam_remark_master.user_id')
                                        ->where('subementor_student_relations.sub_ementor_id', $subEmentorId);
                    })
                    ->where('course_master.ementor_id', $ementorId)
                    ->where('exam_remark_master.is_active', '1')
                    ->where('users.is_active', 'Active')
                    ->where('exam_remark_master.is_cheking_completed', '0');
                    if($role === 'sub-instructor'){
                        $ementorData = $ementorData->whereIn('exam_remark_master.student_course_master_id', $studentCourseMasterIds);
                    }
                    $ementorData = $ementorData->select('course_master.course_title', 'users.name', 'users.last_name','users.photo','exam_remark_master.exam_type', 'exam_remark_master.user_id as user_id', 'course_master.id', DB::raw("DATE_FORMAT(exam_remark_master.created_at, '%Y-%m-%d') as created_at"), 'exam_remark_master.id as exam_id', 'exam_remark_master.exam_id as exam_table_id', 'exam_remark_master.student_course_master_id')
                    ->orderBy('exam_remark_master.created_at', 'desc')
                    ->get()
                    ->map(function ($record) {
                        $table = getExamTable($record->exam_type);
                        
                        if ($table === 'exam_discord') {
                            $record->exam_title = 'Forum Leadership';
                        } elseif ($table) {
                            $titleColumn = $table === 'exam_assignments' ? 'assignment_tittle' : 'title';
                            $titleRecord = DB::table($table)
                                ->where('id', $record->exam_table_id)
                                ->select($titleColumn)
                                ->first();
                            
                            $record->exam_title = $titleRecord ? html_entity_decode($titleRecord->$titleColumn) : 'No Title Found';
                        } else {
                            $record->exam_title = 'No Title Found';
                        }
                
                        return $record;
                    });
                    if($role === 'sub-instructor'){
                        $ementorData = collect($ementorData)->unique('id')->values()->all();
                    }
    

                return response()->json($ementorData);

            } elseif ($status === '1') {
                $where = ['is_cheking_completed' => "1"];
                if ($role == 'sub-instructor') {
                    $subEmentorId = isset($subEmentorId) && !empty($subEmentorId) ? $subEmentorId : 0;
                    $ementorData = $this->CourseModule->getEmentorCheckingStudents($subEmentorId);
                }else{
                    $ementorData = $this->CourseModule->getEmentorCheckingStudents($ementorId);
                }
                // return  $ementorData;
                return response()->json($ementorData);
            } elseif ($status === '2') {
                $ementorData = DB::table('student_course_master')->select( DB::raw("TO_BASE64(users.id) as userId"), 'users.photo', 'users.name', 'users.last_name', 'course_master.course_title', DB::raw("DATE_FORMAT(student_course_master.created_at, '%Y-%m-%d') as created_at"), 'student_course_master.exam_remark', DB::raw("TO_BASE64(course_master.id) as courseId"), 'student_course_master.exam_perc', 'student_course_master.course_start_date' )->join('users', 'users.id', 'student_course_master.user_id')->join('course_master', 'course_master.id', 'student_course_master.course_id')->where('exam_remark', '0')->where(['course_master.ementor_id' => $ementorId, 'student_course_master.is_deleted' => 'No', 'users.is_active' => 'Active'])->orderBy('student_course_master.remark_update_on', 'desc')->get();
                return response()->json($ementorData);
            } elseif ($status === '3') {
                $ementorData = DB::table('student_course_master')->select( DB::raw("TO_BASE64(users.id) as userId"), 'users.photo', 'users.name', 'users.last_name', 'course_master.course_title', DB::raw("DATE_FORMAT(student_course_master.created_at, '%Y-%m-%d') as created_at"), 'student_course_master.exam_remark', DB::raw("TO_BASE64(course_master.id) as courseId"), 'student_course_master.exam_perc', 'student_course_master.course_start_date' )->join('users', 'users.id', 'student_course_master.user_id')->join('course_master', 'course_master.id', 'student_course_master.course_id')->where('exam_remark', '1')->where(['course_master.ementor_id' => $ementorId, 'student_course_master.is_deleted' => 'No', 'users.is_active' => 'Active'])->orderBy('student_course_master.remark_update_on', 'desc')->get();
                return response()->json($ementorData);
            }

            $ementorData = $this->CourseModule->getEmentorStudents($where, $ementor);
            return  $ementorData;
            if (isset($status) && empty($status)) {
                return view('frontend.teacher.e-mentor-students-exam', compact('ementorData'));
            }

            return response()->json($ementorData);
        }

        return redirect('/login');
    }
    
    public function ementorAllStudentList($ementorId)
    {
        if (Auth::check() && !empty($ementorId) && $ementorId != 0) {
            $users = $this->user->studentReportData([]);

            $studentData = $users->filter(function($user) use ($ementorId) {
                $user->allPaidCourses = getAllPaidCourse(['user_id' => $user->id, 'ementor_id' => base64_decode($ementorId)]);
                
                return 
                    !empty($user->allPaidCourses) && 
                    $user->is_active === 'Active' && 
                    $user->is_verified === 'Verified';
            })->values();
            
            foreach ($studentData as $user) {
                $user->allPaidCourses = getAllPaidCourse(['user_id' => $user->id, 'ementor_id' => base64_decode($ementorId)]);
                $examResults = [];

                foreach ($user->allPaidCourses as $course) {
                    $courseExamCount = getCourseExamCount(base64_encode($course->course_id));
                    $examRemarkMasters = DB::table('exam_remark_master')->where([
                        'course_id' => $course->course_id,
                        'user_id' => $user->id,
                        'student_course_master_id' => $course->scmId,
                        'is_active' => 1,
                    ])->get();

                    $studentCourseMaster = getData('student_course_master', ['exam_attempt_remain'], [
                        'course_id' => $course->course_id,
                        'user_id' => $user->id,
                        'id' => $course->scmId
                    ]);

                    $examResult = determineExamResult(
                        $studentCourseMaster[0]->exam_attempt_remain ?? 0,
                        count($examRemarkMasters),
                        $courseExamCount,
                        $course->course_id,
                        $user->id,
                        $course->scmId
                    );

                    $examResults[$course->scmId] = $examResult;
                }

                $user->examResults = $examResults;
            }
            return response()->json($studentData);
            
        }

        return redirect('/login');
    }

 
}