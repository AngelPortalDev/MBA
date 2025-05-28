<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use File;
use App\Models\InstituteProfile;
use App\Models\User;
use App\Rules\WordCount;
use Illuminate\Support\Str;

class InstituteAdminController extends Controller
{

    public function getInstituteData($cat)
    {
        if (Auth::check()) {
            $instituteData = [];
            $where = [];

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
                    $where = ['id' => base64_decode($cat)];
                }
            }
            if(base64_decode($cat) > 0 && $cat != 'all'){

                $instituteData = $this->instituteProfile->getInstituteProfile($where);
                
                $where = ['university_code' => $instituteData[0]->university_code, 'role' => 'user', 'users.is_deleted' => 'No', 'block_status' => '0' ];
                $users = getData('users',['id','name','photo','last_name'],$where);
                $purchasedCount = DB::table('student_course_master')->join('users','users.id','=','student_course_master.user_id')->where($where)->distinct()->count('student_course_master.user_id');
                $registeredStudentCount = count($users);

                $registeredTeacherCount = DB::table('lecturers_master')->where(['university_code' => $instituteData[0]->university_code, 'is_deleted' => 'No'])->count();
    
                $enrolledCount = is_enrolled('','',$where);

                $today = Carbon::today();
                $startOfWeek = Carbon::now()->startOfWeek();
                $startOfMonth = Carbon::now()->startOfMonth();
                
                
                $baseQuery = DB::table('payments')
                    ->leftJoin('orders', 'payments.id', '=', 'orders.payment_id')
                    ->leftJoin('users', 'users.id', '=', 'orders.user_id')
                    ->where('users.university_code', $instituteData[0]->university_code)
                    ->where('payments.is_deleted', 'No')
                    ->where('payments.status', "0");

                $todayCourseSales = (clone $baseQuery)
                    ->whereDate('payments.created_at', $today)
                    ->count();

                $thisWeekCourseSales = (clone $baseQuery)
                    ->where('payments.created_at', '>=', $startOfWeek)
                    ->count();

                $thisMonthCourseSales = (clone $baseQuery)
                    ->where('payments.created_at', '>=', $startOfMonth)
                    ->count();
                    
                $baseSalesQuery = DB::table('payments')
                    ->leftJoin('orders', 'payments.id', '=', 'orders.payment_id')
                    ->leftJoin('users', 'users.id', '=', 'orders.user_id')
                    ->where('users.university_code', $instituteData[0]->university_code)
                    ->where('payments.is_deleted', 'No')
                    ->where('payments.status', "0");

                $todaySales = (clone $baseSalesQuery)
                    ->whereDate('payments.created_at', $today)
                    ->sum(DB::raw('course_price - IFNULL(promo_code_discount, 0)'));

                $thisWeekSales = (clone $baseSalesQuery)
                    ->where('payments.created_at', '>=', $startOfWeek)
                    ->sum(DB::raw('course_price - IFNULL(promo_code_discount, 0)'));

                $thisMonthSales = (clone $baseSalesQuery)
                    ->where('payments.created_at', '>=', $startOfMonth)
                    ->sum(DB::raw('course_price - IFNULL(promo_code_discount, 0)'));
                    
                $coursesPassedCount = DB::table('student_course_master')
                    ->leftJoin('users', 'users.id', '=', 'student_course_master.user_id')
                    ->where('users.university_code', $instituteData[0]->university_code)
                    ->where('student_course_master.is_deleted', 'No')
                    ->where('student_course_master.exam_remark', '1')
                    ->distinct()
                    ->count('student_course_master.user_id'); 
                    
                $coursesFailedCount = DB::table('student_course_master')
                    ->leftJoin('users', 'users.id', '=', 'student_course_master.user_id')
                    ->where('users.university_code', $instituteData[0]->university_code)
                    ->where('student_course_master.is_deleted', 'No')
                    ->where('student_course_master.exam_remark', '0')
                    ->distinct('users.id')
                    ->count('student_course_master.user_id');
                
                return view('admin.institute.institute-edit', compact('instituteData', 'purchasedCount', 'registeredStudentCount', 'registeredTeacherCount', 'enrolledCount', 'todayCourseSales', 'thisWeekCourseSales', 'thisMonthCourseSales', 'todaySales', 'thisWeekSales', 'thisMonthSales', 'coursesPassedCount', 'coursesFailedCount'));

            }else{

                $instituteData = $this->instituteProfile->getInstituteProfile($where);
                
                return response()->json($instituteData);

            }

        }
        return redirect('/login');
    }
    
    public function createInstitute(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $university_name = isset($request->university_name) ? htmlspecialchars_decode($request->input('university_name')) : '';
            $email = isset($request->email) ? htmlspecialchars($request->input('email')) : '';
            $mob_code = isset($request->mob_code) ? htmlspecialchars($request->input('mob_code')) : '';
            $website = isset($request->website) ? htmlspecialchars_decode($request->input('website')) : '';
            $mobile = isset($request->mobile) ? htmlspecialchars($request->input('mobile')) : '';
            $address = isset($request->address) ? htmlspecialchars_decode($request->input('address')) : '';
            $billing_city = isset($request->billing_city) ? htmlspecialchars_decode($request->input('billing_city')) : '';
            $billing_state = isset($request->billing_state) ? htmlspecialchars_decode($request->input('billing_state')) : '';
            $billing_country = isset($request->billing_country) ? htmlspecialchars_decode($request->input('billing_country')) : '';
            $contact_person_name = isset($request->contact_person_name) ? htmlspecialchars_decode($request->input('contact_person_name')) : '';
            $contact_person_email = isset($request->contact_person_email) ? htmlspecialchars_decode($request->input('contact_person_email')) : '';
            $contact_person_mob_code = isset($request->contact_person_mob_code) ? htmlspecialchars_decode($request->input('contact_person_mob_code')) : '';
            $contact_person_mobile = isset($request->contact_person_mobile) ? htmlspecialchars_decode($request->input('contact_person_mobile')) : '';
            $contact_person_designation = isset($request->contact_person_designation) ? htmlspecialchars_decode($request->input('contact_person_designation')) : '';
            $institute_id = isset($request->institute_id) ? base64_decode($request->input('institute_id')) : '';
            $is_approved = isset($request->is_approved) ? $request->input('is_approved') : 0;
            $reject_reason = isset($request->reject_reason) ? htmlspecialchars_decode($request->input('reject_reason')) : '';
            if($is_approved == 1){
                $reject_reason = '';
                $approved_on = now();
            } else {
                $approved_on = null;
            }
            $userAgent = $request->header('User-Agent');
            $ipAddress = $request->ip();
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');

            try {
                $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
                if($institute_id == ''){
                    $data = $request->validate([
                        'university_name' => ['required', 'string', 'min:4', 'max:255'],
                        'mob_code' => ['required', 'string', 'min:1'],
                        'mobile' => ['required', 'string', 'min:6', 'max:20','unique:users,phone'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class,'regex:' . $emailRegex],
                        'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
                        'confirm_password' => ['required', 'same:password'],
                        // 'contact_person_name' => ['required', 'string', 'max:50'],
                        // 'contact_person_email' => ['required', 'string', 'email', 'max:255', 'regex:/(.+)@(.+)\.(.+)/i', 'unique:' . InstituteProfile::class],
                        // 'contact_person_mob_code' => ['required'],
                        // 'contact_person_mobile' => ['required', 'string', 'min:6', 'max:15'],
                        // 'contact_person_designation' => ['required'],
                        // 'logo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048', 'dimensions:width=302,height=272'],
                        // 'photo_id' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
                        // 'licence' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
                        // 'address' => ['required', 'string'],
                        // 'billing_city' => ['required', 'string'],
                        // 'billing_state' => ['required', 'string'],
                        // 'billing_country' => ['required', 'string'],
                    ],[
                        'university_name.min' => 'Institute name must be atleast 4 characters.',
                        'mobile.min'=>'The mobile number must be at least 6 digits.',
                        'password.regex' => 'Password format should be Like e.g Abc@1234.',
                        'mobile.unique' => 'This mobile number is already registered.',
                        // 'contact_person_name.required' => 'Please enter your contact person name.',
                        // 'contact_person_name.max'=>'Contact person name should be less than 50 characters.',
                        // 'contact_person_email.required'=> 'Please enter a valid email address.',
                        // 'contact_person_mobile.min' => 'The mobile must be at least 6 digits.',
                        // 'contact_person_mobile.max'=>'The mobile number should be less than 15 digits.',
                        // 'logo.required' => 'Logo image is required.',  
                        // 'logo.image' => 'Logo must be a valid JPG, JPEG, or PNG image (Width: 302px, Height: 272px, max 2MB).',
                        // 'logo.mimes' => 'Logo must be a valid JPG, JPEG, or PNG image (Width: 302px, Height: 272px, max 2MB).',  
                        // 'logo.max' => 'Logo must be a valid JPG, JPEG, or PNG image (Width: 302px, Height: 272px, max 2MB).',  
                        // 'logo.dimensions' => 'Logo must be a valid JPG, JPEG, or PNG image (Width: 302px, Height: 272px, max 2MB).',
                        // 'photo_id.required' => 'Photo ID image is required.',  
                        // 'photo_id.image' => 'Photo ID must be a valid JPG, JPEG, or PNG image (max 2MB).',
                        // 'photo_id.mimes' => 'Photo ID must be a valid JPG, JPEG, or PNG image (max 2MB).',  
                        // 'photo_id.max' => 'Photo ID must be a valid JPG, JPEG, or PNG image (max 2MB).',  
                        // 'licence.required' => 'License image is required.',  
                        // 'licence.image' => 'License must be a valid JPG, JPEG, or PNG image (max 2MB).',
                        // 'licence.mimes' => 'License must be a valid JPG, JPEG, or PNG image (max 2MB).',  
                        // 'licence.max' => 'License must be a valid JPG, JPEG, or PNG image (max 2MB).', 
                    ]);
                }
                // Validation passed, continue processing the data...
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
                $Message = "created";
                // $Text_Message = "created";
                $where = ['id' => $institute_id];
                $exists = is_exist('users', $where);
                if (isset($exists) && $exists > 0) {
                    $where = ['id' => $institute_id];
                    $Message = 'updated';   
                }else{
                    if($email){
                        $where = ['email' => $email];
                        $exists = is_exist('users', $where);
                        if (isset($exists) && $exists > 0) {
                            return json_encode(['code' => 201, 'title' => "Email is already taken.", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                        }
                    }

                }
                
                $where = ['id'=> $institute_id];
                $data = [
                    'name' => $university_name, 
                ];
                if($institute_id == ''){
                    $data = array_merge($data, ['email' => $email,
                    'mob_code' => $mob_code,
                    'phone' => $mobile,
                    'role' => 'institute',
                    'last_seen' => $timestamp,
                    'last_session_ip' => $ipAddress,
                    'user_agent' => $userAgent,
                    'password' => Hash::make($request->password)]);
                }
                $updateUser = processData(['users', 'id'], $data, $where);
                if (isset($updateUser)) {
                    // $university_name = preg_replace('/[ .,()\-]/', '', $university_name);

                    // if (strlen($university_name) > 4) {
                    //     $first_four_chars = substr($university_name, 0, 4); // Get the first 4 characters
                    //     $generated_code = '2';
                    //     $code = $first_four_chars . strtoupper(Str::random($generated_code)); // Generates a code like "UNI-AB12CD"
                    // } else {
                    //     $generated_code = '4';
                    //     $code = $university_name . strtoupper(Str::random($generated_code)); // Generates a code like "UNI-AB12CD"
                    // }
                    do {
                        $code = rand(100000, 999999);
                        $isUnique = !is_exist('institute_profile_master', ['university_code' => $code]);
                    } while (!$isUnique); // Keep generating until a unique code is found
                    
                    do {
                        $englistTestPassCode = rand(100000, 999999);
                        $isUnique = !is_exist('institute_profile_master', ['englist_test_pass_code' => $englistTestPassCode]);
                    } while (!$isUnique); 
                    
                    $where = ['institute_id'=>$institute_id];
                    
                    $instituteProfile = DB::table('institute_profile_master')->where('institute_id', $institute_id)->first();
                    $storagePath = 'instituteDocs/' . base64_encode($institute_id) ;

                    if ($request->hasFile('photo_id') && $institute_id) {
                        $directory = "instituteDocs/$institute_id";
                    
                        // Ensure directory exists
                        if (!Storage::exists($directory)) {
                            Storage::makeDirectory($directory);
                        }
                    
                        // Delete old file if exists
                        if ($instituteProfile->photo_id) {
                            Storage::delete($instituteProfile->photo_id);
                        }
                    
                        // Store new file
                        $originalFileName = $request->file('photo_id')->getClientOriginalName();
                        $photo_id = $request->file('photo_id')->storeAs($directory, $originalFileName);
                    } else {
                        $photo_id = $instituteProfile->photo_id ?? null;
                    }
                    
                    if ($request->hasFile('licence') && $institute_id) {
                        $directory = "instituteDocs/$institute_id";
                    
                        // Ensure directory exists
                        if (!Storage::exists($directory)) {
                            Storage::makeDirectory($directory);
                        }
                    
                        // Delete old file if exists
                        if ($instituteProfile->licence) {
                            Storage::delete($instituteProfile->licence);
                        }
                    
                        // Store new file
                        $originalFileName = $request->file('licence')->getClientOriginalName();
                        $licence = $request->file('licence')->storeAs($directory, $originalFileName);
                    } else {
                        $licence = $instituteProfile->licence ?? null;
                    }
                    
                    $select = [
                        'website'=>$website,
                        'address'=>$address, 
                        'billing_city'=>$billing_city, 
                        'billing_state'=>$billing_state, 
                        'billing_country'=>$billing_country, 
                        'contact_person_name'=>$contact_person_name, 
                        'contact_person_email'=>$contact_person_email, 
                        'contact_person_mob_code'=>$contact_person_mob_code, 
                        'contact_person_mobile'=>$contact_person_mobile, 
                        'contact_person_designation'=>$contact_person_designation, 
                        'is_approved' => $is_approved,
                        'approved_on' => $approved_on,
                        'reject_reason' => $reject_reason,
                        // 'photo_id' => $photoIdPath,
                        // 'licence' => $licencePath,
                        'photo_id' => isset($photo_id) ? $photo_id : null,
                        'licence' => isset($licence) ? $licence : null,
                        'updated_by'=>Auth::user()->id,
                        'updated_at' => $this->time,
                        'institute_id'=>$updateUser['id']
                    ];

                    if($institute_id == ''){
                        $select = array_merge($select, ['created_at' => $this->time,'created_by'=> Auth::user()->id,'university_code'=>$code, 'englist_test_pass_code' => $englistTestPassCode]);
                    }else{
                        $university = DB::table('institute_profile_master')
                            ->where('institute_id', $institute_id)
                            ->select('englist_test_pass_code', 'account_id')
                            ->first();
                            
                        if ((request()->getHost() === 'www.eascencia.mt')) {
                            $data = [
                                'name' => $university_name,
                                'email' => $email,
                                'mob_code' => $mob_code,
                                'phone' => $mobile,
                            
                                // Additional Institute Fields
                                'institute_id' => $institute_id,
                                'website' => $website,
                                'address' => $address,
                                'billing_city' => $billing_city,
                                'billing_state' => $billing_state,
                                'billing_country' => $billing_country,
                                'englist_test_pass_code' => $englistTestPassCode,
                                'contact_person_name' => $contact_person_name,
                                'contact_person_email' => $contact_person_email,
                                'contact_person_mob_code' => $contact_person_mob_code,
                                'contact_person_mobile' => $contact_person_mobile,
                                'contact_person_designation' => $contact_person_designation,
                                'photo_id' => $photo_id ?? null,
                                'licence' => $licence ?? null,
                            ];
                                
                            $institute = $this->user->syncInstituteWithZoho($data);
                        }

                    }
                    if (empty($university->englist_test_pass_code)) {
                        $select = array_merge($select, ['englist_test_pass_code' => $englistTestPassCode]);
                    }

                    $updateInstitute = processData(['institute_profile_master', 'id'], $select, $where);

                    $email = base64_decode($email);
                    $unsubscribeRoute = url('/unsubscribe/'.base64_encode($email));

                    if($is_approved == 2){
                        $reject_reason = !empty($reject_reason) ? $reject_reason : 'The documents provided do not meet the required criteria as per our guidelines';
                        mail_send(58, ['#instututeName#', '#rejectReason#', '#unsubscribeRoute#'], [$university_name, $reject_reason, $unsubscribeRoute], $email);
                    }

                    if($is_approved == 1){
                        mail_send(59, ['#instututeName#', '#unsubscribeRoute#'], [$university_name, $unsubscribeRoute], $email);
                    }

                    if($is_approved == 4){
                        // if ((request()->getHost() === 'www.eascencia.mt')) {
                        //     $email = 'claire@ascenciamalta.mt';
                        //     $ccEmail = 'info@eascencia.mt';
                        // }else{
                        //     $email = 'chetan@angel-portal.com';
                        //     $ccEmail = 'ankita@angel-portal.com';
                        // }
                        mail_send(61, ['#instututeName#', '#unsubscribeRoute#'], [$university_name, $unsubscribeRoute], $email);
                    };

                    return json_encode(['code' => 200, 'title' => 'Successfully '.$Message.'', "message" => "Institute $Message successfully", "icon" => generateIconPath("success")]);

                } else {
                    return json_encode(['code' => 404, 'title' => "Unable to Create Institute", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
                if (isset($updateInstitute) && $updateInstitute === FALSE) {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
        }else{
            return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
        }
    }

    public function deleteInstitute(Request $req)
    {  
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
                $i=0;
                $rules = [
                    "id" => "required",
                ];
                $validate = validator::make($req->all(), $rules);
                if (!$validate->fails()) {
                try {    
                    // echo $status;
                        if (isset($req->id) && count($req->id) > 0) {
                            $Message = "Deleted";
                            foreach ($req->id as $id) {
                                $id =  isset($id) ? base64_decode($id) : '';
                                $where = ['institute_id' => $id];
                                $is_exits = is_exist('institute_profile_master', $where);
                                if (!empty($is_exits) && is_numeric($is_exits) && $is_exits > 0) {
                                    $updateInstitute = InstituteProfile::where('institute_id',$id)->delete();

                                    User::where('id', $id)->delete();

                                    if (isset($updateInstitute) && $updateInstitute !== FALSE) {
                                        $i++;
                                    }
                                }
                            }

                        if ($i > 0) {
                            return response()->json(['code' => 200, 'title' => $i . ' Records Successfully Deleted', 'icon' => generateIconPath('success')]);
                        } else {
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

    public function statusInstitute(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $table = "users";
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
                    $id =  isset($req->id) ? base64_decode($req->input('id')) : '';
                    $where = ['id' => $id];
                    $exists = is_exist($table, $where);
                    if (isset($exists) && $exists > 0) {
                        $where = ['id' => $id];
                        if($status == 'institute_status_active'){
                            $selectData = [
                                'is_active' => 'Active',
                            ];
                            $Message = "Status changed";
                            $updateEmentors = processData([$table, 'id'], $selectData , $where);
                            $selectData = [
                                'status' => '0',
                            ];
                            $where = ['institute_id' => $id];
                            $Message = "status changed";
                            $MessageTitle = "Status changed";
                            $updateEmentor = processData(['institute_profile_master', 'id'], $selectData , $where);

                        }
                        if($status == 'institute_status_inactive'){
                            $selectData = [
                                'is_active' => 'Inactive',
                            ];
                            $Message = "status changed";
                            $updateEmentors = processData([$table, 'id'], $selectData , $where);
                            $selectData = [
                                'status' => '1',
                            ];
                            $where = ['institute_id' => $id];
                            $MessageTitle = "Status Changed";

                            $updateEmentor = processData(['institute_profile_master', 'id'], $selectData , $where);

                        }
                        if (isset($updateEmentor) && $updateEmentor['status'] == TRUE) {
                            return json_encode(['code' => 200, 'title' => "$MessageTitle Successfully", "message" => "Institute $Message successfully", "icon" => generateIconPath("success")]);
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

    public function getInstituteStudentData($institute_id){
        if (Auth::check()) {

            $institute_id = isset($institute_id) ? base64_decode($institute_id) : '';
            $instituteProfile = getData('institute_profile_master',['university_code'],['institute_id'=>$institute_id]);
            $where = ['university_code'=>$instituteProfile[0]->university_code,'role'=>'user'];
            $instituteStudentData = $this->instituteProfile->getInstituteStudentList($where);
            return response()->json($instituteStudentData);
        
        }
    }
    
    public function getInstituteTeacherData($institute_id){
        if (Auth::check()) {
            $institute_id = isset($institute_id) ? base64_decode($institute_id) : '';
            $instituteProfile = getData('institute_profile_master',['university_code'],['institute_id'=>$institute_id]);
            $where = ['university_code'=>$instituteProfile[0]->university_code];
            $instituteTeacherData = $this->instituteProfile->getInstituteTeacherList($where);
            return response()->json($instituteTeacherData);
        
        }
    }

    public  function instituteProfileUpload(Request $req)
    {

        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {

            $image_file = $req->hasFile('image_file') ? $req->file('image_file') : '';

            $old_img_name = !empty($req->input('old_img_name')) ? $req->input('old_img_name') : '';

            $user_name = !empty($req->input('user_name')) ? base64_decode($req->input('user_name')) : '';

            $user_id = !empty($req->input('user_id')) ? base64_decode($req->input('user_id')) : '';

            if ($req->hasFile('image_file')) {

                $rules = [

                    'image_file' => 'required|mimes:jpeg,png,jpg,svg|max:1024|dimensions:width=302,height=272',

                ];

                $messages = [
                    'image_file.required'   => 'The image file is required.',
                    'image_file.mimes'      => 'Invalid file type! Only JPG, PNG, and SVG files are allowed.',
                    'image_file.max'        => 'File size must be less than 1MB.',
                    'image_file.dimensions' => 'Image must be exactly 302x272 pixels (Width: 302px, Height: 272px).',
                ];
                
                // $validate = Validator::make($req->only(['image_file']), $rules);
                $validate = Validator::make($req->only(['image_file']), $rules, $messages);

                if (!$validate->fails()) {

                    $folder_name = InstituteProfile::where('institute_id', $user_id)->first();

                    if (isset($old_img_name) && !empty($old_img_name)) {

                        $folder = $folder_name['folder_name'];

                    } else {

                        // $folder = "Student_" . time() . "_" . $user_name;
                  
                        $folder = "Institute_" . time() . "_" . $user_name;

                        $makeFolder = File::makeDirectory(public_path("storage/instituteDocs/" . $folder), $mode = 0777, true, true);

                        if (!isset($makeFolder) && $makeFolder === 0 && is_numeric($makeFolder)) {

                            return false;
                        }
                    }
                    $docUpload = UploadFiles($image_file, 'instituteDocs/' . $folder, $old_img_name);
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

                    echo json_encode(['code' => 203, 'message' =>  $validate->errors()->first(), 'text' => "File Should be JPG, PNG & Less then 1MB", "icon" => generateIconPath("error"), 'old' => $old_img_name]);
                }
            } else {

                echo json_encode(['code' => 204, 'message' => 'No Image', 'text' => "", "icon" => generateIconPath("error"), 'old' => $old_img_name]);
            }
        } else {

            echo json_encode(['code' => 205, 'message' => 'Something Went Wrong', 'text' => "", "icon" => generateIconPath("error")]);
        }
    }

}
