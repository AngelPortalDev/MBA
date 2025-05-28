<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};
use App\Models\User;
use App\Models\CourseModule;
use App\Models\ExamAmount;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportAdmin;
use App\Imports\ImportAdmin;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Events\AdminDashboardUpdated;
use App\Exports\Reports\PaymentReportExport;
use App\Exports\Reports\StudentsExport;
use App\Exports\Reports\CourseDataExport;
use App\Exports\CourseExport;
use App\Exports\Reports\StudentsReportExport;
use App\Exports\Reports\CoursesReportExport;
use App\Exports\Reports\InstituteReportExport;
use App\Exports\Reports\TeacherReportExport;
use App\Models\InputConfiguration;
use Log;

class CommonAdminController extends Controller
{

    public $user;
    public function __construct(User $User, CourseModule $courseModule )
    {
        parent::__construct();
        $this->currentDate = Carbon::now('Europe/Malta');
        $this->time = $this->currentDate->format('Y-m-d H:i:s');
        $this->date = $this->currentDate->format('Y-m-d');
        $this->user = $User;
        $this->courseModule = $courseModule;
    }

    public function dashboard()
    {
        if (Auth::check()) {
            $currentYear = date('Y');
            $earnings = DB::table('payments')
                ->leftJoin('orders', 'payments.id', '=', 'orders.payment_id')
                ->leftJoin('users', 'users.id', '=', 'orders.user_id')
                ->where('payments.is_deleted', 'No')
                ->where('payments.status', "0")
                ->whereYear('payments.created_at', date('Y'))
                ->select(
                    DB::raw("CONCAT(ROUND(SUM(course_price - IFNULL(promo_code_discount, 0)) / 1, 2), ' €') as total"),
                    DB::raw("MONTH(payments.created_at) as month_number")
                )
                ->groupBy('month_number')
                ->orderBy('month_number', 'ASC')
                ->get();

                
            $allMonths = array_fill(1, 12, 0);

            // Fill with actual data
            foreach ($earnings as $earning) {
                $allMonths[$earning->month_number] = $earning->total;
            }
            
            $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            $totalSales =DB::table('payments')
                ->leftjoin('orders', 'payments.id', '=', 'orders.payment_id')
                ->leftjoin('users', 'users.id', '=', 'orders.user_id')
                ->where('payments.is_deleted', 'No')
                ->where('payments.status', "0")
                ->sum(DB::raw('course_price - IFNULL(promo_code_discount, 0)'));

            $currentMonthStart = Carbon::now()->startOfMonth();
            $currentMonthEnd = Carbon::now()->endOfMonth();
            $previousMonthStart = Carbon::now()->subMonth()->startOfMonth();
            $previousMonthEnd = Carbon::now()->subMonth()->endOfMonth();
            $currentMonthSales = DB::table('payments')
                ->where('is_deleted', 'No')
                ->where('status', '0')
                ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
                ->sum('total_amount');

            $previousMonthSales = DB::table('payments')
                ->where('is_deleted', 'No')
                ->where('status', '0')
                ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
                ->sum('total_amount');

            if ($previousMonthSales > 0) {
                $percentageChange = round((($currentMonthSales - $previousMonthSales) / $previousMonthSales) * 100, 2);
            } else {
                $percentageChange = $currentMonthSales > 0 ? 100 : 0;
            }
            
            $studentCounts = DB::table('users')
                ->selectRaw('
                    COUNT(*) as totalActiveStudentsCount,
                    SUM(CASE WHEN is_verified = "Verified" THEN 1 ELSE 0 END) as totalEnrolledStudentsCount
                ')
                ->where([
                    'is_deleted' => 'No',
                    'is_active' => 'Active',
                    'block_status' => '0',
                    'role' => 'user',
                ])
                ->first();

            $totalEnrolledStudentsCount =  is_enrolled();
            
            $totalCourseSales =DB::table('payments')
                ->leftjoin('orders', 'payments.id', '=', 'orders.payment_id')
                ->leftjoin('users', 'users.id', '=', 'orders.user_id')
                ->where('payments.is_deleted', 'No')
                ->where('payments.status', "0")
                ->count();

            $totalActiveStudentsCount = $studentCounts->totalActiveStudentsCount;

            $unverifiedStudentCount = DB::table('orders')
                ->join('student_doc_verification', 'student_doc_verification.student_id', '=', 'orders.user_id')
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->where([
                    'student_doc_verification.identity_is_approved' => 'Approved',
                    'student_doc_verification.edu_is_approved' => 'Approved',
                    'orders.status' => '0'
                ])
                ->whereNotNull('student_doc_verification.resume_file')
                ->where('student_doc_verification.english_score', '>=', '10')
                ->distinct('orders.user_id')
                ->count();
                
            $verifiedStudentsCount = DB::table('users')
                ->where([
                    'is_verified' => 'verified',
                    'is_active' => 'Active',
                    'is_deleted' => 'No'
                ])
                ->count();

            $latestCourse = DB::table('course_master')
                ->join('users', 'users.id', '=', 'course_master.ementor_id')
                ->select('course_master.id as course_id', 'course_title', DB::raw("CONCAT(users.name, ' ', users.last_name) as ementor_name"), 'course_thumbnail_file', 'users.photo', 'published_on')
                ->orderBy('published_on', 'desc')
                ->first();

            if ($latestCourse) {
                $publishedOnDate = Carbon::parse($latestCourse->published_on);
                $now = Carbon::now();

                $latestCourse->published_on_text = $publishedOnDate->diffForHumans($now, [
                    'parts' => 1,
                    'syntax' => Carbon::DIFF_RELATIVE_TO_NOW,
                ]);
            }

            $latestEnrolledStudent = DB::table('users')
                ->select('id', DB::raw("CONCAT(name, ' ', last_name) as name"), 'photo')
                ->orderBy('verified_on', 'desc')
                ->first();

            $ementorData = DB::table('users')
                ->join('course_master', 'users.id', '=', 'course_master.ementor_id')
                ->join('course_master as courseMaster', 'users.id', '=', 'course_master.ementor_id')
                ->leftJoin('orders', function ($join) {
                    $join->on('course_master.id', '=', 'orders.course_id')
                        ->where('orders.status', '=', '0');
                })
                ->leftJoin('users as studentUser', 'studentUser.id', '=', 'orders.user_id')
                ->select(
                    'users.id',
                    DB::raw("CONCAT(users.name, ' ', users.last_name) as name"),
                    'users.photo',
                    DB::raw('(SELECT COUNT(DISTINCT cm.id) FROM course_master cm WHERE cm.ementor_id = users.id) as assigned_course_count'), 
                    DB::raw('COUNT(DISTINCT orders.id) as total_enrollment_count'),
                )
                ->where('users.role', 'instructor')
                ->where('studentUser.is_active', 'Active')
                ->where('studentUser.is_verified', 'Verified')
                ->groupBy('users.id', 'users.name', 'users.last_name', 'users.photo')
                ->orderByDesc('assigned_course_count')
                ->first();

            $data = [
                'totalSales' => $totalSales,
                'percentageChange' => $percentageChange,
                'totalActiveStudentsCount' => $totalActiveStudentsCount,
                'totalCourseSales' => $totalCourseSales,
                'verifiedStudentsCount' => $verifiedStudentsCount,
                'latestCourse' => $latestCourse,
                'latestEnrolledStudent' => $latestEnrolledStudent,
                'ementorData' => $ementorData,
                'currentYear' => $currentYear,
                'chart_data' => [
                    'earnings' => array_values($allMonths),
                    'labels' => $monthNames
                ]
            ];

            // broadcast(new AdminDashboardUpdated($data));
            return view('admin/dashboard', compact('data'));
        }
        return redirect('/login');
    }

    public function deleteUser(Request $req)
    {
        if (isset($req->userId) && is_array($req->userId) && count($req->userId) > 0) {
            $i = 0;
            try {
                foreach ($req->userId as $id) {

                    $del_id = !empty($id) ? base64_decode($id) : 0;

                    $exists = is_exist('users', ['id' => $del_id, 'is_deleted' => 'No']);
                    if (!empty($exists) && $exists > 0) {
                        $this->user->where('id', $del_id)->update(['is_deleted' => 'Yes', 'deleted_by' => Auth::user()->id]);
                        $i++;
                    }
                }
                if ($i > 0) {
                    return response()->json(['code' => 200, 'title' => $i . ' Record Successfully Deleted', 'icon' => 'success']);
                } else {
                    return response()->json(['code' => 201, 'title' => 'Unable to Delete', "icon" => "error"]);
                }
            } catch (\Exception $e) {
                return response()->json(['code' => 201, 'title' => 'Something Went Wrong', "icon" => "error"]);
            }
        }else{
            
            return response()->json(['code' => 201, 'title' => 'Please checked At Least One Record', "icon" => "error"]);
        }
    }

    public function index()
    {
        return view('admin.admin.index');

        // Pass the data to the view
    }
    public function StudentList()
    {

        if (Auth::check()) {
            $studentData = $this->userProfile->getUserProfile();
            return $studentData;
        }

        return redirect('/login');
    }
    public function getAdminData($action)
    {
        $data = User::select("users.id", DB::raw("CONCAT(users.name,' ',users.last_name) as name"), "users.email", DB::raw("CONCAT(users.mob_code,' ',users.phone) as phone"), 'users.last_seen', 'users.is_active','users.photo')->where('role', 'admin')->where('is_deleted','No');
        if ($action == 'all') {
            $data = $data->orderBy('users.id','desc')->get();
        } else if ($action == 'active') {
            $data = $data->where('is_active', 'Active')->orderBy('users.id','desc')->get();
        } else if ($action == 'inactive') {
            $data = $data->where('is_active', 'Inactive')->orderBy('users.id','desc')->get();
        }
        return response()->json($data);
    }

    public function store(Request $request)
    {

        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $first_name = isset($request->first_name) ? htmlspecialchars_decode($request->input('first_name')) : '';
            $last_name = isset($request->last_name) ? htmlspecialchars_decode($request->input('last_name')) : '';
            $email = isset($request->email) ? htmlspecialchars($request->input('email')) : '';
            $mob_code = isset($request->mob_code) ? htmlspecialchars($request->input('mob_code')) : '';
            $mobile = isset($request->mobile) ? htmlspecialchars($request->input('mobile')) : '';
            // $tnc = isset($request->tnc) ? htmlspecialchars($request->input('tnc')) : '';

            // User Agent Details
            $userAgent = $request->header('User-Agent');
            $ipAddress = $request->ip();
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');

            $role = 'admin';
            if (isset($role) && !empty($role)) {
                $url = '';
                $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
                try {
                    $data = $request->validate([
                        'first_name' => ['required', 'string', 'min:3', 'max:255'],
                        'last_name' => ['required', 'string', 'min:3', 'max:255'],
                        'mob_code' => ['required', 'string', 'min:1'],
                        'mobile' => ['required', 'string', 'min:7', 'max:20'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class,'regex:' . $emailRegex],
                        'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
                        'confirm_password' => 'required|same:password',
                    ],
                    [
                        'password.regex'=>'Password must be at least 8 characters in the format Abc@1234.',
                        'mobile.unique' => 'This mobile number is already registered.',
                        'password.min'=>'Password must be at least 8 characters in the format Abc@1234.'
                    ]);

                    // Validation passed, continue processing the data...
                } catch (ValidationException $e) {
                    // Validation failed, return the validation errors
                    $errors = $e->validator->errors();
            
                    return json_encode(['code' => 202, 'title' => 'Required Fields are Missing.', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"),'data' => $errors]);
                    // return $errors;
                }
                // return $data;

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

                return json_encode(['code' => 200, 'title' => 'Successfully Created', "message" => "Admin created successfully", "icon" => generateIconPath("success")]);            // return redirect

            } else {
                return json_encode(['code' => 201, 'title' => 'Something Went Wrong', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => 'Something Went Wrong', 'message' => 'Please Check and Try Again', "icon" => generateIconPath("error")]);
        }
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $id = base64_decode($id);
            $exists = is_exist('users', ['id' => $id]);
            if ($exists > 0) {
                $admin = User::findOrFail($id);
                return view('admin.admin.edit', compact('admin'));
            } else {
                return redirect('admin.admin.index')->withErrors(['msg' => 'Student not found']);
            }
            }
        // return redirect('/login');
        // $admin = User::findOrFail($id);
        // return view('admin.admin.edit', compact('admin'));
    }
    public function update(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $first_name = isset($request->first_name) ? htmlspecialchars_decode($request->input('first_name')) : '';
            $last_name = isset($request->last_name) ? htmlspecialchars_decode($request->input('last_name')) : '';
            $email = isset($request->email) ? htmlspecialchars($request->input('email')) : '';
            $mob_code = isset($request->mob_code) ? htmlspecialchars($request->input('mob_code')) : '';
            $mobile = isset($request->mobile) ? htmlspecialchars($request->input('mobile')) : '';
            $address = isset($request->address) ? htmlspecialchars_decode($request->input('address')) : '';
            $status = isset($request->status) ? htmlspecialchars($request->input('status')) : '';
            if($status == 'on'){
                $status = 'Active';
            }else{
                $status = 'Inactive';
            }
            $role = isset($request->role) ? htmlspecialchars($request->input('role')) : '';

            // User Admin Details
            $userAgent = $request->header('User-Agent');
            $ipAddress = $request->ip();
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');
            if (isset($role) && !empty($role)) {

                $url = '';
                try {
                    $data = $request->validate([
                        'first_name' => ['required', 'string', 'min:3', 'max:255'],
                        'last_name' => ['required', 'string', 'min:3', 'max:255'],
                        'mob_code' => ['required', 'string', 'min:1'],
                        'email' => ['required', 'string', 'email', 'max:255'],
                        'mobile' => ['required', 'string', 'min:7', 'max:20'],
                    ]);

                    // Validation passed, continue processing the data...
                } catch (ValidationException $e) {

                    $errors = $e->validator->errors();
                    return json_encode(['code' => 202, 'title' => 'Required Fields are Missing.', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"),'data' => $errors]);
                }


                $data = [
                    'name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'mob_code' => $mob_code,
                    'phone' => $mobile,
                    'role' => $role,
                    'address' => $address,
                    // 'is_active'=>$status
                ];

                $user = User::where('id', $request->admin_id)->update($data);

                return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Admin details updated successfully", "icon" => generateIconPath("success")]);            // return redirect
            } else {
                return json_encode(['code' => 201, 'title' => 'Something Went Wrong', 'message' => 'Please provide required info', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 201, 'title' => 'Something Went Wrong', 'message' => 'Please Check and Try Again', "icon" => generateIconPath("error")]);
        } 
    }

    public function deleteall(Request $req)
    {  
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
                    $table = "users";
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
                                        $where = ['id' => $id, 'is_deleted' => 'No'];
                                        $is_exits = is_exist($table, $where);
                                        if (!empty($is_exits) && is_numeric($is_exits) && $is_exits > 0) {
                                            $updateUser = processData([$table, 'id'], ['is_deleted' => 'Yes', 'deleted_by' => Auth::user()->id], $where);
            
                                            if (isset($updateUser) && $updateUser !== FALSE) {
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

    public function exportAdmin(Request $request){
        return Excel::download(new ExportAdmin, 'users.xlsx');
    }

    public function importAdmin(Request $request){

        $customfile = isset($request->customfile) ? htmlspecialchars($request->input('customfile')) : '';
        try {
            $data = $request->validate([
                'customfile' => ['required', 'file']
            ]);
            if($request->hasFile('customfile')){
                 Excel::import(new ImportAdmin,request()->file('customfile'));
            }

            return json_encode(['code' => 200, 'title' => 'Successfully Data Uploaded', "message" =>  "Uploaded Successfully", "icon" => "success"]);     
            
        } catch (ValidationException $e) {

            $errors = $e->validator->errors();
            return json_encode(['code' => 202, 'title' => 'Required Fields are Missing.', 'message' => 'Please Provide Required Info', "icon" => "error",'data' => $errors]);
        }

    }
    public function deleteEntry(Request $req)
    {
        if ($req->isMethod('POST') && Auth::check() && $req->ajax()) {
            $type = isset($req->type) ? base64_decode($req->input('type')) : '';
            $delete_id = isset($req->id) ? base64_decode($req->input('id')) : 0;

            $where = [];
            $rules = [
                "type" => "required|string",
                "id" => "required|string",
            ];
            if (!empty($type) && is_numeric($delete_id) && $delete_id != 0) {

                if (!empty($type) && $type === 'article') {
                    $table = 'course_content_docs';
                    $where = ['id' => $delete_id, 'is_deleted' => 'No'];
                    $sectionAssginwhere = ['content_type_id' => 2, 'content_id' => $delete_id];
                }
                $validate = validator::make($req->all(), $rules);
                if (!$validate->fails()) {
                    $is_exits = is_exist($table, $where);
                    try {
                        DB::beginTransaction();
                        if (!empty($is_exits) && is_numeric($is_exits) && $is_exits > 0) {
                            $updateEntry = processData([$table, 'id'], ['is_deleted' => 'Yes', 'deleted_by' => Auth::user()->id], $where);
                            if (isset($updateEntry) && $updateEntry === FALSE) {
                                return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                            }
                            $updateSection = processData(['section_managment_master', 'id'], ['is_deleted' => 'Yes'], $sectionAssginwhere);
                            if (isset($updateSection) && $updateSection['status'] === TRUE) {
                                DB::commit();
                            }
                            return json_encode(['code' => 200, 'title' => 'Successfully Deleted', 'message' => '', "icon" => generateIconPath("success")]);
                        }
                        DB::rollback();
                        return json_encode(['code' => 404, 'title' => 'Already Deleted or Not Exists', 'message' => 'Please Check and Try Again', "icon" => generateIconPath("error")]);
                    } catch (\Throwable $th) {
                        DB::rollback();
                        return json_encode(['code' => 404, 'title' => 'Something Went Wrong', 'message' => 'Please Check and Try Again', "icon" => generateIconPath("error")]);
                    }
                } else {
                    return json_encode(['code' => 404, 'title' => 'Mandatory Fields Missing', 'message' => 'Please Check and Try Again', "icon" => generateIconPath("error")]);
                }
            } else {
                return json_encode(['code' => 404, 'title' => 'Something Went Wrong', 'message' => 'Please Check and Try Again', "icon" => generateIconPath("error")]);
            }
        } else {
            return json_encode(['code' => 404, 'title' => 'Something Went Wrong', 'message' => 'Please Check and Try Again', "icon" => generateIconPath("error")]);
        }
    }

    // Delete Multiple Entries
    public function deleteEntries(Request $req)
    {
        if (isset($req->id) && is_array($req->id) && count($req->id) > 0) {
            $type = isset($req->action) ? base64_decode($req->action) : 0;
            $i = 0;
            $where = [];
            $rules = [
                "action" => "required|string",
                "id" => "required|array",
            ];
            if (isset($req->id)  && !empty($type) && count($req->id) > 0) {

                if (!empty($type) && $type === 'article') {
                    $table = 'course_content_docs';
                }
                if (!empty($type) && $type === 'section') {
                    $table = 'course_section_masters';
                }
                $validate = validator::make($req->all(), $rules);
                if (!$validate->fails()) {
                    try {
                        foreach ($req->id as $id) {
                            $id = isset($id) ? base64_decode($id) : 0;
                            $where = ['id' => $id, 'is_deleted' => 'No'];
                            $is_exits = is_exist($table, $where);
                            if (!empty($is_exits) && is_numeric($is_exits) && $is_exits > 0) {
                                $updateEntry = processData([$table, 'id'], ['is_deleted' => 'Yes', 'deleted_by' => Auth::user()->id], $where);
                                if (isset($updateEntry) && $updateEntry !== FALSE) {
                                    $i++;
                                }
                            }
                        }
                        if ($i > 0) {
                            return response()->json(['code' => 200, 'title' => $i . ' Records Successfully Deleted', 'icon' => generateIconPath('success')]);
                        } else {
                            return response()->json(['code' => 201, 'title' => 'Unable to Delete', "icon" => generateIconPath("error")]);
                        }
                    } catch (\Exception $e) {
                        return response()->json(['code' => 201, 'title' => 'Something Went Wrong', "icon" => generateIconPath("error")]);
                    }
                } else {
                    return response()->json(['code' => 201, 'title' => 'Something Went Wrong', "icon" => generateIconPath("error")]);
                }
            } else {
                return response()->json(['code' => 201, 'title' => 'No Entry Selected', "icon" => generateIconPath("error")]);
            }
        } else {
            return response()->json(['code' => 201, 'title' => 'No Entry Selected', "icon" => generateIconPath("error")]);

        }
    }

    public  function adminImageUpload(Request $req)
    {

        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {

            $image_file = $req->hasFile('image_file') ? $req->file('image_file') : '';

            $old_img_name = !empty($req->input('old_img_name')) ? $req->input('old_img_name') : '';

            $user_id = !empty($req->input('user_id')) ? base64_decode($req->input('user_id')) : '';

            if ($req->hasFile('image_file')) {

                $rules = [

                    'image_file' => 'required|mimes:jpeg,png,jpg,svg|max:1024',

                ];
                $validate = Validator::make($req->only(['image_file']), $rules);

                if (!$validate->fails()) {

                    $docUpload = UploadFiles($image_file, 'adminDocs', $old_img_name);

                    if ($docUpload === FALSE) {

                        return json_encode(['code' => 203, 'message' => 'File is corrupt', 'title' => "", "icon" => generateIconPath("error"), 'old' => $old_img_name]);

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

    // public function deleteAdmin(Request $req)
    // {  
    //     if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
    //         $table = "ementor_profile_master";
    //         $admin_id = Auth::user()->id;
    //             $i=0;
    //             $rules = [
    //                 "id" => "required",
    //             ];
    //             $validate = validator::make($req->all(), $rules);
    //             if (!$validate->fails()) {
    //             try {    
    //                 // echo $status;
    //                     if (isset($req->id) && count($req->id) > 0) {
    //                         $Message = "Deleted";
    //                         foreach ($req->id as $id) {
    //                             $id =  isset($id) ? base64_decode($id) : '';
    //                             $where = ['ementor_id' => $id, 'is_deleted' => 'No'];
    //                             $is_exits = is_exist($table, $where);
    //                             if (!empty($is_exits) && is_numeric($is_exits) && $is_exits > 0) {
    //                                 $updateTeacher = processData([$table, 'ementor_profile_id'], ['is_deleted' => 'Yes', 'deleted_by' => Auth::user()->id], $where);

    //                                 User::where('id', $id)->update(['is_deleted' => 'Yes', 'deleted_by' => Auth::user()->id]);

    //                                 if (isset($updateTeacher) && $updateTeacher !== FALSE) {
    //                                     $i++;
    //                                 }
    //                             }
    //                         }

    //                     if ($i > 0) {
    //                         return response()->json(['code' => 200, 'title' => $i . ' Records Successfully Deleted', 'icon' => 'success']);
    //                     } else {
    //                         return response()->json(['code' => 201, 'title' => 'Unable to Delete', "icon" => "error"]);
    //                     }
    //                 }
             
    //             } catch (\Throwable $th) {
    //                 return $th;
    //                 return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => "error"]);
    //             }
    //         }else {
    //             return json_encode(['code' => 201, 'title' => "Something Went Wrong ", 'message' => 'Please try again', "icon" => "error"]);
    //         }
             
    //     } else {
    //         return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please try unique name', "icon" => "error"]);
    //     }

    // }  

    public function export(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        if($request->export == 'paymentData'){
            return Excel::download(new PaymentReportExport($request->category, $request->where), 'payment_report.xlsx');
        }elseif($request->export == 'studentData'){
            return Excel::download(new StudentsExport($this->user, $request->where), 'students.xlsx'); 
        }elseif($request->export == 'courseData'){
            return Excel::download(new CourseDataExport($request->where), 'courses.xlsx'); 
        }elseif($request->export == 'awardCourseData'){

            $where = [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ];
            return Excel::download(new CourseExport($request->category,$where), 'award_courses_list.xlsx'); 
        }elseif($request->export == 'studentReportData'){ 
            $where = [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ];
            return Excel::download(new StudentsReportExport($this->user, $where), 'students_report.xlsx'); 
        }elseif($request->export == 'courseReportData'){
            
            // $validate_rules = [
            //     'start_date' => 'required',
            //     'end_date' => 'required',
            // ];
            // $validate = Validator::make($request->all(), $validate_rules);
            // if ($validate->fails()) {
            //     return redirect()->back()->withErrors($validate)->withInput();
            // }

            $where = [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ];
            return Excel::download(new CoursesReportExport($this->courseModule, $where), 'courses_report.xlsx'); 
        }elseif($request->export == 'instituteReportData'){
            
            $where = [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'institutes' => $request->institutes,
            ];
            return Excel::download(new InstituteReportExport($where), 'institutes_report.xlsx'); 
        }elseif($request->export == 'teacherReportData'){
                
            $where = [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ];
            return Excel::download(new TeacherReportExport($where), 'teacher_report.xlsx'); 
        }
        
    }

    public function addInputFieldConfiguration(Request $request)
    {
        try {
            if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
                DB::beginTransaction();

                $admin_id = Auth::user()->id;
                $id = isset($request->id) ? base64_decode($request->input('id')) : 0;
                $exam_id = isset($request->exam_id) ? base64_decode($request->input('exam_id')) : 0;
                $exam_type = isset($request->exam_type) ? base64_decode($request->input('exam_type')) : 0;
                $question_id = isset($request->question_id) ? base64_decode($request->input('question_id')) : 0;
                $exam_table = isset($request->exam_table) ? base64_decode($request->input('exam_table')) : '';
                $mimes = isset($request->mimes) ? $request->input('mimes') : '';
                $mimesString = implode(',', $mimes);
                $max_size = isset($request->max_size) ? $request->input('max_size') : '';
                $label_name = isset($request->label_name) ? $request->input('label_name') : '';
                $is_required = isset($request->is_required) && $request->is_required == '1' ? 1 : 0;
                $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');
                
                $exists = is_exist($exam_table, ['id' => $exam_id, 'is_deleted' => 'No']);
                $inputConfigurationExist = is_exist('exam_input_configurations', ['id' => $id, 'exam_id' => $exam_id, 'exam_type' => $exam_type, 'question_id' => $question_id, 'is_deleted' => 'No']);

                $where = [];
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $select = [
                        'exam_id' => $exam_id, 
                        'exam_type' => $exam_type, 
                        'question_id' => $question_id,
                        'mimes' => $mimesString,
                        'max_size' => $max_size,
                        'label_name' => $label_name,
                        'is_required' => $is_required,
                        'is_deleted' => 'No',
                    ];
                    
                    if (isset($inputConfigurationExist) && is_numeric($inputConfigurationExist) && $inputConfigurationExist > 0) {
                        $where = ['id' => $id, 'exam_id' => $exam_id, 'exam_type' => $exam_type, 'question_id' => $question_id, 'is_deleted' => 'No'];
                        $select = array_merge($select, ['last_updated_by' => $admin_id]);
                        $title = "Successfully Updated";
                        $message = "Input field updated successfully";
                    } else {
                        $select = array_merge($select, ['created_by' => $admin_id, 'created_at' => $timestamp]);
                        $title = "Successfully Added";
                        $message = "Input field added successfully";
                    }
                    $updateUser = processData(['exam_input_configurations', 'id'], $select, $where);
                    if (isset($updateUser) && $updateUser['status'] === true) {
                        DB::commit();
                        return json_encode(['code' => 200, 'title' => $title, 'message' => $message, "icon" => generateIconPath("success"), "data" => $updateUser]);
                    }
                    return json_encode(['code' => 404, 'title' => "Unable to Add Input field ", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
                }
                return json_encode(['code' => 404, 'title' => "Survey Not Available", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
        } catch (Exception $e) {
            DB::rollBack();
    
            return response()->json([
                'code' => 500,
                'title' => "Error",
                'message' => 'Something went wrong.',
                'icon' => generateIconPath("error")
            ]);
        }
    }

    public function getInputFieldConfiguration(Request $request)
    {
        if($request->input('id')){
            $id = isset($request->id) ? base64_decode($request->input('id')) : 0;
            $examInputConfiguration = getData('exam_input_configurations', ['id', 'label_name', 'mimes', 'max_size', 'is_required', 'question_id', 'exam_type', 'exam_id'], [
                'id' => $id,
                'is_deleted' => 'No'
            ]);
        }else{
            $exam_id = isset($request->exam_id) ? base64_decode($request->input('exam_id')) : 0;
            $exam_type = isset($request->exam_type) ? base64_decode($request->input('exam_type')) : 0;
            $question_id = isset($request->question_id) ? base64_decode($request->input('question_id')) : 0;
    
            $examInputConfiguration = getData('exam_input_configurations', ['id', 'label_name', 'mimes', 'max_size', 'is_required'], [
                'exam_id' => $exam_id,
                'exam_type' => $exam_type,
                'question_id' => $question_id,
                'is_deleted' => 'No'
            ]);
    
        }

        if ($examInputConfiguration) {
            return response()->json([
                'code' => 200,
                'message' => 'Configurations fetched successfully.',
                'data' => $examInputConfiguration
            ]);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'No configurations found.',
                'data' => []
            ]);
        }
    }
    
    public function deleteInputFieldConfiguration(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;


            $table = "exam_input_configurations";
            $where = ['id' => $id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                try {
                    DB::beginTransaction();
                    
                    $result = deleteRecord(InputConfiguration::class, $where, true);

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
    
    
    public function getCourseExamList($courseId)
    {
        $courseId = base64_decode($courseId);
        $examManagementMasters = DB::table('exam_management_master')
            ->where('exam_management_master.course_id', $courseId)
            ->where('exam_management_master.is_deleted', 'No')
            ->get();
    
        $exams = [];
        foreach ($examManagementMasters as $examManagementMaster) {
            $examType = $examManagementMaster->exam_type;
            $examId = $examManagementMaster->exam_id;
            
            if ($examType) {

                $examTitle = getExamTitle($examType, $examId);

                $exams[] = [
                    'title' => $examTitle,
                    'exam_type' => $examType,
                    'exam_id' => $examId
                ];
            }
        }
    
        return response()->json(['exams' => $exams]);
    }
    
    public function addExamAmount(Request $req)
    {
        
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $course_id  = isset($req->course_id) ? base64_decode($req->input('course_id')) : 0;
            $exam_id  = isset($req->exam_id) ? base64_decode($req->input('exam_id')) : 0;
            $exam_type  = isset($req->exam_type) ? base64_decode($req->input('exam_type')) : 0;
            $amount  = isset($req->amount) ? $req->input('amount') : 0;
            
            try {
                $req->validate([
                    'course_id' => 'required',
                    'exam_id' => 'required',
                    'exam_type' => 'required',
                    'amount' => 'required'
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            
            if (is_exist('course_master', ['id' => $course_id]) > 0) {
                try {
                    $where = ['course_id' => $course_id, 'exam_id' => $exam_id, 'exam_type' => $exam_type, 'is_deleted' => 'No', 'deleted_at' => null];
                    $exists = is_exist('exam_amounts', $where);
                    if (isset($exists) && $exists > 0) {
                        return json_encode([
                            'code' => 404, 'title' => "Already added", 'message' => 'Exam Amount already added.', "icon" => generateIconPath("warning")
                        ]);
                    }else{
                        $select = [
                            'course_id' => $course_id,
                            'exam_id' => $exam_id,
                            'exam_type' => $exam_type,
                            'amount' => $amount,
                            'created_by' => $admin_id,
                            'is_deleted' => 'No',
                            'last_updated_by' => $admin_id,
                            'created_at' => $this->time,
                        ];

                        DB::beginTransaction();

                        $examAmountCreate = processData(['exam_amounts', 'id'], $select);
                        if (isset($examAmountCreate) && $examAmountCreate['status'] === true) {
                            DB::commit();
                            return json_encode(['code' => 200, 'title' => "Successfully Added", 'message' => 'Amount added successfully', "icon" => generateIconPath("success")]);
                        }
                        DB::rollBack();
                        return json_encode([
                            'code' => 404, 'title' => "Unable to Add Amount", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                        ]);
                    }
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return json_encode([
                        'code' => 404, 'title' => "Unable to Add Amount", 'message' => 'Something Went Wrong', "icon" => generateIconPath("error")
                    ]);
                }
            } else {
                return json_encode([
                    'code' => 404, 'title' => "Unable to Add Amount", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
                ]);
            }
        }
    }
    
    public function getExamAmount($id)
    {
        if (Auth::check()) {
            $id = isset($id) ? base64_decode($id) : 0;
            $exists = is_exist('exam_amounts', ['id' => $id, 'is_deleted' => 'No']);
            if (isset($exists) && is_numeric($exists) && $exists > 0) {
                $examAmount = getData('exam_amounts', ['id', 'course_id', 'exam_id', 'exam_type', 'amount'], ['id' => $id, 'is_deleted' => 'No']);
                return json_encode(['code' => 200, 'data' => $examAmount[0]]);
            }
            return json_encode(['code' => 404, 'title' => "Exam not Found", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            
        }
        return json_encode(['code' => 404, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
    }

    public function getExamAmountList()
    {
        if (Auth::check()) {
            $examAmounts = DB::table('exam_amounts')
                ->join('course_master', 'course_master.id', '=', 'exam_amounts.course_id')
                ->select('exam_amounts.id', 'course_master.course_title', 'exam_amounts.amount', 'exam_amounts.exam_id', 'exam_amounts.exam_type')
                ->where('exam_amounts.is_deleted', 'No')
                ->get();
                
            foreach ($examAmounts as $examAmount) {
                $examTitle = getExamTitle($examAmount->exam_type, $examAmount->exam_id);
                $examAmount->exam_title = $examTitle;
            }  
            return response()->json($examAmounts);
        }
    }
    
    public function editExamAmount(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id  = isset($req->id) ? base64_decode($req->input('id')) : 0;
            $amount  = isset($req->amount) ? $req->input('amount') : 0;
            
            try {
                $req->validate([
                    'amount' => 'required'
                ]);
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            
            $where = ['id' => $id, 'is_deleted' => 'No', 'deleted_at' => null];
            $select = [
                'amount' => $amount,
                'last_updated_by' => $admin_id,
                'updated_at' => $this->time,
            ];

            DB::beginTransaction();

            $examAmountUpdate = processData(['exam_amounts', 'id'], $select, $where);
            if (isset($examAmountUpdate) && $examAmountUpdate['status'] === true) {
                DB::commit();
                return json_encode(['code' => 200, 'title' => "Successfully Updated", 'message' => 'Amount updated successfully', "icon" => generateIconPath("success")]);
            }
            DB::rollBack();
            return json_encode([
                'code' => 404, 'title' => "Unable to Update Amount", 'message' => 'Please Try Again', "icon" => generateIconPath("error")
            ]);
        }
    }
    
    public function deleteExamAmount(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $id =  isset($req->id) ? base64_decode($req->input('id')) : 0;

            $table = "exam_amounts";
            $where = ['id' => $id, 'is_deleted' => 'No'];
            $exists = is_exist($table, $where);
            if (isset($exists) && $exists > 0) {
                try {
                    DB::beginTransaction();

                    $result = deleteRecord(ExamAmount::class, $where, true);

                    if (isset($result) && $result['status'] === true) {
                        DB::commit();
                        return json_encode(['code' => 200, 'title' => 'Successfully Deleted', "message" => "Successfully deleted", "icon" => generateIconPath("success")]);
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
    
    public function checkCertificate(Request $request)
    {
        $id = $request->student_course_master_id;

        $exists = DB::table('certitficate_issue')
            ->where('student_course_master_id', $id)
            ->whereNull('transferred_on')
            ->exists();

        return response()->json(['exists' => $exists]);
    }

    
    


}