<?php

namespace App\Http\Controllers\Admin\StudentController;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentDocument;
use App\Models\StudentProfile;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash};
use PHPUnit\Util\Json;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use File;
use PDF;
use function Pest\Laravel\json;
use Illuminate\Support\Facades\Crypt;
use App\Services\StudentDocumentService;
use App\Models\StudentCourseModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Admin\DashboardController;

class StudentAdminController extends Controller
{
    public function __construct(StudentDocumentService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function StudentList(Request $request,$cat = '')
    {
        if (Auth::check()) {
            $studentData = [];
            $where =[];
            $studentsWithCourses = [];
            $limit = $request->input('length'); // Number of records per page
            $offset = $request->input('start'); // Start index for the current page
            $searchValue = $request->input('search.value', ''); // Get the search term

            if (isset($cat) && !empty($cat)) {
                if($cat == "Active"){
                    $studentData = DB::table('users')->select('users.id','name','last_name','users.created_at','users.is_verified','users.is_active', 'email', 'mob_code', 'phone', 'roll_no','photo')->where(['role'=>'user','block_status'=>'0','is_deleted'=>'No','is_active'=>$cat]);
                    
                    $startDate = $request->input('start_date');
                    $endDate = $request->input('end_date');
                    
                    if ($startDate && $endDate) {
                        $studentData->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"]);
                        $studentData->orderBy('created_at', 'ASC'); 
                    }
                }else if($cat == 'Inactive'){

                    $studentData = DB::table('users')->select('users.id','name','last_name','users.created_at','users.is_verified','users.is_active', 'email', 'mob_code', 'phone', 'roll_no','photo')->where(['role'=>'user','block_status'=>'0','is_deleted'=>'No','is_active'=>$cat]);
                    
                    $startDate = $request->input('start_date');
                    $endDate = $request->input('end_date');
                    
                    if ($startDate && $endDate) {
                        $studentData->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"]);
                        $studentData->orderBy('created_at', 'ASC'); 
                    }
                
                }elseif ($cat != 'all') {

                    $studentData = DB::table('users')->select('users.id','name','last_name','users.created_at','users.is_verified','users.is_active', 'email', 'mob_code', 'phone', 'roll_no','photo')->where(['role'=>'user','block_status'=>'0','is_deleted'=>'No','is_verified'=>$cat]);
                    
                    $startDate = $request->input('start_date');
                    $endDate = $request->input('end_date');
                    
                    if ($startDate && $endDate) {
                        $studentData->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"]);
                        $studentData->orderBy('created_at', 'ASC'); 
                    }
                    

                }else{

                    $studentData = DB::table('users')->select('users.id','name','last_name','users.created_at','users.is_verified','users.is_active', 'email', 'mob_code', 'phone', 'roll_no', 'is_active','photo')->where(['role'=>'user','block_status'=>'0','is_deleted'=>'No']);

                    $startDate = $request->input('start_date');
                    $endDate = $request->input('end_date');
                    
                    if ($startDate && $endDate) {
                        $studentData->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"]);
                        $studentData->orderBy('created_at', 'ASC'); 
                    }

                }
                // Get the filtered data
                if (!empty($searchValue)) {
                    $studentData->where(function ($q) use ($searchValue) {
                        $q->where('name', 'like', '%' . $searchValue . '%')
                            ->orWhere('last_name', 'like', '%' . $searchValue . '%');
                            
                    });
                }
                $orderIndex = $request->input('order.0.column'); 
                $orderDir = $request->input('order.0.dir'); 
                $columns = [
                    2 => 'name', 
                    3 => 'is_verified'
                ];
                if (isset($orderIndex) && array_key_exists($orderIndex, $columns)) {
                    $columnOrderable = $request->input("columns.$orderIndex.orderable") === 'true';
                
                    if ($columnOrderable) {
                        $orderColumn = $columns[$orderIndex];
                        $studentData->orderBy($orderColumn, $orderDir);
                    } 
                } else {
                    $studentData->orderBy('id', 'desc');
                }

                $totalRecords = $studentData->count();

                $studentData->offset($offset)->limit($limit);
                
                $studentData = $studentData->get();
                foreach ($studentData as $user) {
                    $where = ['user_id' => $user->id];
                    $user->paidCourses = getAllPaidCourse($where); // Fetch and assign paid courses
                    $examResults = []; // Initialize examResults array for the user
                    $statusInfo = [];
                    foreach ($user->paidCourses as $course) {

                        // Fetch latest exam records for the course
                        // $latestTwoRecords = DB::table('exam_management_master')
                        //     ->where(['course_id' => $course->course_id, 'is_deleted' => 'No'])
                        //     ->latest()
                        //     ->get();

                        // $courseExamCount = $latestTwoRecords->count();
                        
                        // $courseExamCount = getCourseExamCount(base64_encode($course->course_id));

                        // // Fetch exam remarks for the user
                        // $examRemarkMasters = DB::table('exam_remark_master')->where([
                        //     'course_id' => $course->course_id,
                        //     'user_id' => $user->id,
                        //     'is_active' => 1,
                        // ])->get();
                        
                        // // Get exam attempt remaining count for the user
                        // $studentCourseMaster = getData('student_course_master', ['exam_attempt_remain'], [
                        //     'course_id' => $course->course_id,
                        //     'user_id' => $user->id,
                        //     'id'=> $course->scmId
                        // ], '1', 'id', 'desc');
                  

                        // Initialize default exam result
                        // $ExamRemarkStatus = 'Not Attempt';
                        $user->examResults='';
                        // echo count($examRemarkMasters);
                        // if(!empty($studentCourseMaster[0])){
                        //     if (count($examRemarkMasters) === 0 && $studentCourseMaster[0]->exam_attempt_remain != 1) {
                        //         $ExamRemarkStatus = 'Not Attempt';
                        //     } else {
                        //         $completedExamCount = DB::table('exam_remark_master')->where([
                        //             'course_id' => $course->course_id,
                        //             'user_id' => $user->id,
                        //             'is_cheking_completed' => '2',
                        //         ])->count();

                        //         if (count($examRemarkMasters) === $courseExamCount) {
                        //             if ($completedExamCount == count($examRemarkMasters)) {
                        //                 // Get the latest student course master record
                       
                        //                 $studentCourseMaster = DB::table('student_course_master')
                        //                     ->where(['user_id' => $user->id, 'course_id' => $course->course_id])
                        //                     ->latest()
                        //                     ->first();

                        //                 if ($studentCourseMaster) {
                        //                     switch ($studentCourseMaster->exam_remark) {
                        //                         case '0':
                        //                             $examResult = 'Fail';
                        //                             $color = 'danger'; // Example color class
                        //                             break;
                        //                         case '1':
                        //                             $examResult = 'Pass';
                        //                             $color = 'success'; // Example color class
                        //                             $examPercent = '';
                        //                             break;
                        //                         default:
                        //                             $examResult = 'Pending1';
                        //                             $color = 'warning'; // Example color class
                        //                     }
                        //                 }
                        //             } else {
                        //                 $examResult = 'Checking';
                        //                 $color = 'primary'; // Example color class
                        //             }
                        //         } else {
                        //             $examResult = 'Pending7';
                        //             $color = 'warning'; // Example color class
                        //         }

                        //         // Store the result in the user's examResults array
                        //         $examResults[$course->course_id] = [
                        //             'result' => $examResult,
                        //             'color' => $color,
                        //             'percent' => $examPercent ?? ''
                        //         ];
                        //     }
                            
                        //     $ExamRemarkStatus = 'Not Attempt';
                        //     $user->examResults = $examResults;
                        // }

                        // if($studentCourseMaster[0]->exam_attempt_remain == 2){

                        //     $examResult ='Not Attempt';
                        //     $color='warning';
                        // }elseif(count($examRemarkMasters) == 1){
                        //     if(count($examRemarkMasters) == $courseExamCount){
                        //         $examResult = ''; 
                        //         $completedExamCount = DB::table('exam_remark_master')->where([
                        //             'course_id' => $course->course_id,
                        //             'user_id' => $user->id,
                        //             'is_cheking_completed' => '2',
                        //         ])
                        //         ->count();  

                        //         if($courseExamCount == $completedExamCount){
                        //             $studentCourseMaster = DB::table('student_course_master')->where(['user_id' => $user->id, 'course_id' => $course->course_id,'id'=>$course->scmId])->latest()->first();
                        //             if(!empty($studentCourseMaster)){
                        //                 if($studentCourseMaster->exam_remark == '0'){
                        //                     $examResult = 'Fail';
                        //                     $color = 'danger';
                        //                 }elseif($studentCourseMaster->exam_remark == '1'){
                        //                     $examResult = 'Pass';
                        //                     $color = 'success';
                        //                 }else{
                        //                     $examResult = 'Pending';
                        //                     $color = 'warning';
                        //                 }
                        //             }
                        //         }else{
                        //             $examResult = 'Checking';
                        //             $color = 'primary';
                        //         }
                        //     }else{
                        //         $studentCourseMaster = DB::table('student_course_master')->where(['user_id' => $user->id, 'course_id' => $course->course_id,'id'=>$course->scmId])->latest()->first();
                        //         if(!empty($studentCourseMaster)){
                        //             if($studentCourseMaster->exam_remark == '0'){
                        //                 $examResult = 'Fail';
                        //                 $color = 'danger';
                        //             }elseif($studentCourseMaster->exam_remark == '1'){
                        //                 $examResult = 'Pass';
                        //                 $color = 'success';
                        //             }else{
                        //                 $examResult = 'Pending';
                        //                 $color = 'warning';
                        //             }
                        //         }
                        //     }
                        // }elseif(count($examRemarkMasters) == 2){

                        //     if(count($examRemarkMasters) == $courseExamCount){
                        //         $examResult = ''; 
                        //         $completedExamCount = DB::table('exam_remark_master')->where([
                        //             'course_id' => $course->course_id,
                        //             'user_id' => $user->id,
                        //             'is_cheking_completed' => '2',
                        //         ])->count();
                        //         if($completedExamCount == count($examRemarkMasters)){
                        //             $studentCourseMaster = DB::table('student_course_master')->where(['user_id' => $user->id, 'course_id' => $course->course_id,'id'=>$course->scmId])->latest()->first();
                        //             if(!empty($studentCourseMaster)){
                        //                 if($studentCourseMaster->exam_remark == '0'){
                        //                     $examResult = 'Fail';
                        //                     $color = 'danger';
                        //                 }elseif($studentCourseMaster->exam_remark == '1'){
                        //                     $examResult = 'Pass';
                        //                     $color = 'success';
                        //                 }else{
                        //                     $examResult = 'Pending';
                        //                     $color = 'warning';
                        //                 }
                        //             }
                        //         }else{
                        //             $examResult = 'Checking';
                        //             $color = 'primary';
                        //         }
                        //     }else{
                        //         $studentCourseMaster = DB::table('student_course_master')->where(['user_id' => $user->id, 'course_id' => $course->course_id,'id'=>$course->scmId])->latest()->first();
                        //         if(!empty($studentCourseMaster)){
                        //             if($studentCourseMaster->exam_remark == '0'){
                        //                 $examResult = 'Fail';
                        //                 $color = 'danger';
                        //             }elseif($studentCourseMaster->exam_remark == '1'){
                        //                 $examResult = 'Pass';
                        //                 $color = 'success';
                        //             }else{
                        //                 $examResult = 'Pending';
                        //                 $color = 'warning';
                        //             }
                        //         }
                        //     }
                        // }else{

                        //     if(count($examRemarkMasters) == $courseExamCount){

                        //             $examResult = ''; 
                        //             $completedExamCount = DB::table('exam_remark_master')->where([
                        //                 'course_id' => $course->course_id,
                        //                 'user_id' =>    $user->id,
                        //                 'is_cheking_completed' => '2',
                        //             ])->count();

                        //             if($completedExamCount == count($examRemarkMasters)){
                        //                 $studentCourseMaster = DB::table('student_course_master')->where(['user_id' =>  $user->id, 'course_id' => $course->course_id, 'id'=> $course->scmId])->latest()->first();
                        //                 if(!empty($studentCourseMaster)){
                        //                     if($studentCourseMaster->exam_remark == '0'){
                        //                         $examResult = 'Fail';
                        //                         $color = 'danger';
                        //                     }elseif($studentCourseMaster->exam_remark == '1'){
                        //                         $examResult = 'Pass';
                        //                         $color = 'success';
                        //                     }else{
                        //                         $examResult = 'Pending';
                        //                         $color = 'warning';
                        //                     }
                        //                 }
                        //             }else{
                        //                 $examResult = 'Checking';
                        //                 $color = 'primary';
                        //             }

                        //     }else{
                        //         $studentCourseMaster = DB::table('student_course_master')->where(['user_id' => $user->id, 'course_id' => $course->course_id,'id'=>$course->scmId])->latest()->first();
                        //         if(!empty($studentCourseMaster)){
                        //             if($studentCourseMaster->exam_remark == '0'){
                        //                 $examResult = 'Fail';
                        //                 $color = 'danger';
                        //             }elseif($studentCourseMaster->exam_remark == '1'){
                        //                 $examResult = 'Pass';
                        //                 $color = 'success';
                        //             }else{
                        //                 $examResult = 'Pending';
                        //                 $color = 'warning';
                        //             }
                        //         }
                        //     }
                        // }
                        $courseExamCount = getCourseExamCount(base64_encode($course->course_id));
                        $examRemarkMasters = DB::table('exam_remark_master')->where([
                            // 'course_id' => $course->course_id,
                            // 'user_id' => $user->id,
                            'student_course_master_id' => $course->scmId,
                            'is_active' => 1,
                        ])->get();
        
                        $studentCourseMaster = getData('student_course_master', ['exam_attempt_remain'], [
                            // 'course_id' => $course->course_id,
                            // 'user_id' => $user->id,
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
        
                        // $examResults[$course->scmId] = $examResult;
                        // $statusInfo[$course->scmId] = getCourseStatus($course);
                    }
                    // $user->examResults = $examResults;
                    // $user->statusInfo = $statusInfo;

                }
            }
            // dd($studentData[1]);
            $response = [
                "draw" => intval($request->input('draw')), // Draw counter for DataTables
                "recordsTotal" => $totalRecords, // Total number of records
                "recordsFiltered" => $totalRecords, // Number of records after filtering (same as total if no filtering is applied)
                "data" => $studentData // The actual data to be displayed
            ];

            // Return the response as JSON
            return response()->json($response);
        }
        return redirect('/login');
    }
    public function getStudent($enc_id)
    {
        if (Auth::check()) {
            $id = base64_decode($enc_id);
            $aboutmeData = '';
            $exists = is_exist('student_profile_master', ['student_id' => $id]);
            if ($exists > 0) {
                $where = ['student_id' => $id];
                $studentData = $this->userProfile->getUserProfile($where);
                $studentDoc = $this->studentDocument->getUserDocInfo($where);
                $aboutmeData = DB::table('student_about_me')->where('student_id',$id)->get();
                $wishlistData = $this->userProfile->getStudentLearning($where);
                return view('admin.student.student-edit', compact('studentData', 'studentDoc','aboutmeData','wishlistData'));
            } else {
                return redirect('admin.students-get-data')->withErrors(['msg' => 'Student not found']);
            }
        }
        return redirect('/login');
    }
    public function DocVerify(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $name_person = isset($req->name_person) ? htmlspecialchars_decode($req->input('name_person')) : '';
            $user_id = isset($req->student_id) ? base64_decode($req->input('student_id')) : '';
            $birth_dob = isset($req->birth_dob) ? htmlspecialchars($req->input('birth_dob')) : '';
            $proof_name = isset($req->proof_name) ? htmlspecialchars($req->input('proof_name')) : '';
            $doc_id_no = isset($req->doc_id_no) ? htmlspecialchars($req->input('doc_id_no')) : '';
            $doc_auth = isset($req->doc_auth) ? htmlspecialchars($req->input('doc_auth')) : '';
            $issue_date = isset($req->issue_date) ? htmlspecialchars($req->input('issue_date')) : '0000-00-00';
            $expiry_date = isset($req->expiry_date) ? htmlspecialchars($req->input('expiry_date')) : '';
            $issue_country = isset($req->issue_country) ? htmlspecialchars($req->input('issue_country')) : '';
            $id_doc_status = $req->id_doc_status === "1" ? "Approved" : 'Rejected';
            $id_doc_status_text = $req->id_doc_status === "1" ? "approved" : 'rejected';

            $identity_doc_comments = isset($req->identity_doc_comments) ? htmlspecialchars($req->input('identity_doc_comments')) : '';
            $exists =   is_exist('users', ['id' => $user_id,  'is_deleted' => 'No']);


            if (isset($exists) && is_numeric($exists) && $exists === 0) {
                return json_encode(['code' => 201, 'title' => 'User Not Available', 'message' => 'User not Exist', 'icon' => generateIconPath('warning')]);
            }
            $validate_rules = [
                'name_person' => 'required|string|max:225|min:3',
                'proof_name' => 'required|string|max:225|min:3',
                'doc_id_no' => 'required|max:225|min:3',
                'doc_auth' => 'string|max:225|min:3',
                'birth_date' => 'before:today',
                // 'issue_date' => 'before:today',
                'issue_country' => 'required|string|min:3',
                'id_doc_status' => 'required|string|min:1',
            ];

            if (isset($id_doc_status) && $id_doc_status == 'Approved') {
                $validate_rules = array_merge($validate_rules, ['expiry_date' => 'required|date|after:today']);
            }
            
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {

                $where = ['student_id' => $user_id];
                $exists = is_exist('student_doc_verification', $where);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $action = 'update';
                } else {
                    $action = 'insert';
                }
                if ($id_doc_status === 'Approved') {
                    $select = [
                        'identity_doc_number' => $doc_id_no,
                        'identity_doc_country' => $issue_country,
                        'identity_doc_authority' => $doc_auth,
                        'identity_doc_issue_date' => $issue_date,
                        'identity_doc_expiry' => $expiry_date,
                        'identity_doc_type' => $proof_name,
                        'name_on_identity_card' => $name_person,
                        'dob_on_identity_card' => $birth_dob,
                        'identity_approved_by' => $admin_id,
                        'identity_is_approved' => $id_doc_status,
                        'identity_doc_comments' => $identity_doc_comments
                    ];
                    $select = array_merge($select, ['identity_approved_on' => $this->time]);
                } else {
                    $select = [
                        'identity_doc_number' => '',
                        'identity_doc_country' => '',
                        'identity_doc_authority' => '0',
                        'identity_doc_issue_date' => '',
                        'identity_doc_expiry' => '',
                        'identity_doc_type' => '',
                        'name_on_identity_card' => '',
                        'dob_on_identity_card' => '',
                        'identity_approved_by' => 0,
                        'identity_is_approved' => 'Reject',
                        'identity_doc_comments' => $identity_doc_comments,
                        'identity_doc_file'=> '',
                        'doc_file_name'=>''

                    ];
                    $select = array_merge($select, ['identity_approved_on' => $this->time]);

                   
                }
                $updateUserProfile = processData(['student_doc_verification', 'student_doc_id'], $select, $where, $action);
                
                $user = DB::table('users')
                    ->leftjoin('student_doc_verification','student_doc_verification.student_id','users.id','english_score')
                    ->where('id', $user_id)
                    ->select('name', 'last_name','email','identity_trail_attempt','edu_is_approved','resume_file_name')
                    ->first();

                
              
                    
                $unsubscribeRoute = url('/unsubscribe/'.base64_encode($user->email));
                if (isset($updateUserProfile) && !empty($updateUserProfile['id'])) {

                    if ($id_doc_status === 'Approved') {

                        $studentCourseMaster = DB::table('student_course_master')
                        ->where('user_id', $user_id)
                        ->orderBy('created_at', 'desc')
                        ->first(['course_id']);

                        if ($studentCourseMaster) {
                            $base64EncodedCourseId = base64_encode($studentCourseMaster->course_id);
                        } else {
                            $base64EncodedCourseId = null;
                        }
                        
                        mail_send(
                            27,
                            [
                                '#Name#',
                                '#documents#',
                                '#[Study material link].#',
                                '#unsubscribeRoute#'
                            ],
                            [
                                $user->name . ' ' . $user->last_name,
                                'Identity Document',
                                "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId,
                                $unsubscribeRoute
                            ],
                            $user->email
                        );
                        // if($id_doc_status === 'Approved' && $user->edu_is_approved == "Approved" && $user->resume_file_name != ''){

                        //     mail_send(
                        //         44,
                        //         [
                        //             '#Name#',
                        //             '#unsubscribeRoute#'
                        //         ],
                        //         [
                        //             $user->name . ' ' . $user->last_name,
                        //             $unsubscribeRoute
                        //         ],
                        //         $user->email
                        //     );
                        // }
                        // $this->service->verificationStatusUpdate($user_id);
                    }else{

                        $unsubscribeRoute = url('/unsubscribe/'.base64_encode($user->email));
                        mail_send(
                            25,
                            [
                                '#Name#',
                                '#rejected_reason#',
                                '#2attempt#',
                                '#unsubscribeRoute#'
                            ],
                            [
                                $user->name . ' ' . $user->last_name,
                                !empty($identity_doc_comments) ? $identity_doc_comments : 'Your submitted documents need to meet the specific criteria required for enrollment.',
                                $user->identity_trail_attempt,
                                $unsubscribeRoute
                            ],
                            $user->email
                        );
                    }
                    $this->user->verificationStatutsUpdate($user_id);
                    return json_encode(['code' => 200, 'title' => 'Successfully ' . $id_doc_status, "message" => "Student details $id_doc_status_text successfully", "icon" => generateIconPath("success")]);  
                } 
            }else{
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 202, 'title' => 'Something Went Wrong', 'message' => 'Something Went Wrong.', "icon" => generateIconPath("error")]);
        }
    }
    public function EduDocVerify(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $eduStudentName = isset($req->eduStudentName) ? htmlspecialchars_decode($req->input('eduStudentName')) : '';
            $user_id = isset($req->student_id) ? base64_decode($req->input('student_id')) : '';
            $institue_name = isset($req->institue_name) ? htmlspecialchars($req->input('institue_name')) : '';
            $is_id_verified = isset($req->institue_name) ? htmlspecialchars($req->input('institue_name')) : '';
            $passsingYear = isset($req->passsingYear) ? htmlspecialchars($req->input('passsingYear')) : '';
            $edu_level = isset($req->edu_level) ? htmlspecialchars($req->input('edu_level')) : '';
            $specilization = isset($req->specilization) ? htmlspecialchars($req->input('specilization')) : '';
            $eduDocName = isset($req->eduDocName) ? htmlspecialchars($req->input('eduDocName')) : '';
            $eduDocId = isset($req->eduDocId) ? htmlspecialchars($req->input('eduDocId')) : '';
            // $eduGrade = isset($req->eduGrade) ? htmlspecialchars($req->input('eduGrade')) : '';
            $eduRemark = isset($req->eduRemark) ? htmlspecialchars($req->input('eduRemark')) : '';
            $eduComments = isset($req->eduComments) ? htmlspecialchars($req->input('eduComments')) : '';
            $edu_doc_status = $req->edu_doc_status === "1" ? "Approved" : 'Rejected';
            $edu_doc_status_text = $req->edu_doc_status === "1" ? "approved" : 'rejected';
            $exists =   is_exist('users', ['id' => $user_id,  'is_deleted' => 'No']);


            if (isset($exists) && is_numeric($exists) && $exists === 0) {
                return json_encode(['code' => 201, 'title' => 'User Not Available', 'message' => 'User not Exist', 'icon' => generateIconPath('warning')]);
            }
            $validate_rules = [
                'edu_level' => 'required|string',
                'specilization' => 'required|string',
                'eduStudentName' => 'required|string|max:225|min:3',
                'institue_name' => 'required|string|max:225|min:3',
                'eduDocName' => 'required|string|max:225|min:3',
                'passsingYear' => 'required|before:today',
                'eduDocId' => 'required|string|max:225|min:3',
                // 'eduGrade' => 'required|string|max:225',
                'eduRemark' => 'required|string|max:225|min:3',
                'edu_doc_status' => 'required|string|min:1',
            ];

            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {

                $where = ['student_id' => $user_id];
                $exists = is_exist('student_doc_verification', $where);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $action = 'update';
                } else {
                    $action = 'insert';
                }
                if ($edu_doc_status === 'Approved') {
                    $select = [
                        'education_doc_number' => $eduDocId,
                        'edu_level' => $edu_level,
                        'edu_specialization' => $specilization,
                        'degree_course_name' => $eduDocName,
                        'name_on_education_doc' => $eduStudentName,
                        'remark_on_edu_doc' => $eduRemark,
                        // 'grade_on_edu_doc' => $eduGrade,
                        'university_name_on_edu_doc' => $institue_name,
                        'passing_year' => $passsingYear,
                        'edu_approved_by' => $admin_id,
                        'edu_is_approved' => $edu_doc_status,
                        'comments_on_edu_doc' => $eduComments
                    ];
                    $select = array_merge($select, ['edu_approved_on' => $this->time]);
                } else {
                    $select = [
                        'education_doc_number' => '',
                        'edu_level' => '0',
                        'education_level_num'=>'',
                        'edu_specialization' => '',
                        'degree_course_name' => '',
                        'name_on_education_doc' => '',
                        'remark_on_edu_doc' => '',
                        'grade_on_edu_doc' => '',
                        'university_name_on_edu_doc' => '',
                        'passing_year' => null,
                        'edu_approved_by' => $admin_id,
                        'edu_is_approved' => 'Reject',
                        'comments_on_edu_doc' => $eduComments,
                        'edu_doc_file'=> '',
                        'edu_doc_file_name'=>''

                    ];
                    $select = array_merge($select, ['edu_approved_on' => $this->time]);
                }
                $updateUserProfile = processData(['student_doc_verification', 'student_doc_id'], $select, $where, $action);

                $user = DB::table('users')
                    ->leftjoin('student_doc_verification','student_doc_verification.student_id','users.id','english_score')
                    ->where('id', $user_id)
                    ->select('name', 'last_name','email','edu_trail_attempt','identity_is_approved','resume_file_name' )
                    ->first();
                    
                      

                $unsubscribeRoute = url('/unsubscribe/'.base64_encode($user->email));

                if (isset($updateUserProfile) && !empty($updateUserProfile['id'])) {

                    if ($edu_doc_status === 'Approved') {

                        $studentCourseMaster = DB::table('student_course_master')
                        ->where('user_id', $user_id)
                        ->orderBy('created_at', 'desc')
                        ->first(['course_id']);

                        if ($studentCourseMaster) {
                            $base64EncodedCourseId = base64_encode($studentCourseMaster->course_id);
                        } else {
                            $base64EncodedCourseId = null;
                        }
                        
                        mail_send(
                            27,
                            [
                                '#Name#',
                                '#documents#',
                                '#[Study material link].#',
                                '#unsubscribeRoute#'
                            ],
                            [
                                $user->name . ' ' . $user->last_name,
                                'Educational Document',
                                "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId,
                                $unsubscribeRoute
                            ],
                            $user->email
                        );
                        // if($user->identity_is_approved === 'Approved' && $edu_doc_status == "Approved" && $user->resume_file_name != ''){

                        //     mail_send(
                        //         44,
                        //         [
                        //             '#Name#',
                        //             '#unsubscribeRoute#'
                        //         ],
                        //         [
                        //             $user->name . ' ' . $user->last_name,
                        //             $unsubscribeRoute
                        //         ],
                        //         $user->email
                        //     );
                        // }
                        // $this->service->verificationStatusUpdate($user_id);
                    }else{

                        mail_send(
                            26,
                            [
                                '#Name#',
                                '#rejected_reason#',
                                '#2attempt#',
                                '#unsubscribeRoute#'
                            ],
                            [
                                $user->name . ' ' . $user->last_name,
                                !empty($eduComments) ? $eduComments : 'Your submitted documents need to meet the specific criteria required for enrollment.',
                                $user->edu_trail_attempt,
                                $unsubscribeRoute
                            ],
                            $user->email
                        );
                    }
                } 
                $this->user->verificationStatutsUpdate($user_id);       
                
                // $student = DB::table('student_doc_verification')
                //     ->where('student_id', $user_id)
                //     ->where(function ($query) {
                //         $query->where('identity_is_approved', '!=', 'Approved')
                //             ->orWhere('edu_is_approved', '!=', 'Approved');
                //     })
                //     ->first();
                
                // $user = DB::table('users')
                //     ->where('id', $user_id)
                //     ->select('name', 'last_name')
                //     ->first();

                // if (isset($updateUserProfile) && $updateUserProfile === FALSE) {
                //     mail_send(
                //         26,
                //         [
                //             '#Name#',
                //             '#_________________________#'. 
                //             '#2attempt#'
                //         ],
                //         [
                //             $user->name . ' ' . $user->last_name,
                //             $eduComments,
                //             $student->edu_trail_attempt,
                //         ],
                //         $user->email
                //     );
                //     return json_encode(['code' => 201, 'title' => "Unable to " . $edu_doc_status, 'message' => 'Please try again', "icon" => "error"]);
                // }

                
                // $identityApproved = $student->identity_is_approved === 'Approved';
                // $eduApproved = $student->edu_is_approved === 'Approved';
                
                // if ($identityApproved && $eduApproved) {

                //     $studentCourseMaster = DB::table('student_course_master')
                //     ->where('user_id', $user_id)
                //     ->orderBy('created_at', 'desc')
                //     ->first(['course_id']);

                //     if ($studentCourseMaster) {
                //         $base64EncodedCourseId = base64_encode($studentCourseMaster->course_id);
                //     } else {
                //         $base64EncodedCourseId = null;
                //     }
    
                //     mail_send(
                //         27,
                //         [
                //             '#Name#',
                //             '#[Study material link].#'
                //         ],
                //         [
                //             $user->name . ' ' . $user->last_name,
                //             "https://www.eascencia.mt/student/student-award-course-panel/".$base64EncodedCourseId,
                //         ],
                //         $user->email
                //     );
                // }
                return json_encode(['code' => 200, 'title' => 'Successfully ' . $edu_doc_status, "message" => "Educational doc $edu_doc_status_text successfully", "icon" => generateIconPath("success")]);
            } else {


                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please provide required info', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
            }
        }
    }
    public function createStudent(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $name = isset($request->name) ? htmlspecialchars_decode($request->input('name')) : '';
            $last_name = isset($request->last_name) ? htmlspecialchars_decode($request->input('last_name')) : '';
            $email = isset($request->email) ? htmlspecialchars($request->input('email')) : '';
            $mob_code = isset($request->mob_code) ? htmlspecialchars($request->input('mob_code')) : '';
            $mobile = isset($request->mobile) ? htmlspecialchars($request->input('mobile')) : '';

            $userAgent = $request->header('User-Agent');
            $ipAddress = $request->ip();
            $timestamp = Carbon::now('Europe/Malta')->format('Y-m-d H:i:s');
           
            $exists = is_exist('users', ['mob_code' => $mob_code,'phone'=>$mobile]);
            if (isset($exists) && is_numeric($exists) && !empty($exists) && $exists > 0) {
                return response()->json([
                    'code' => 202,
                    'title' => 'Required Fields are Missing',
                    'icon' => 'error',
                    'data' => [
                        'mobile' => 'Mobile number already exists'// Specific input fields
                    ]
                ]);
            }

            try {
                $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
                $data = $request->validate([
                    'name' => ['required', 'string', 'min:3', 'max:255'],
                    // 'last_name' => ['required', 'string', 'min:3', 'max:255'],
                    'mob_code' => ['required', 'string', 'min:1'],
                    'mobile' => ['required', 'string', 'min:6', 'max:20'],
                    'email' => ['required', 'string', 'email', 'max:255', 'regex:' . $emailRegex, 'unique:' . User::class],
                    'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
                    'password_confirmation' => ['required', 'same:password'],
                    
                ], [
                   'mobile.min' => 'The mobile number must be at least 6 digits.',
                   'mobile.max' => 'The mobile number must not be greater than 20 digits.',
                   'password.regex'=>'Password must be at least 8 characters in the format Abc@1234.',
                   'password.min'=>'Password must be at least 8 characters in the format Abc@1234.'
                ]);

                // Validation passed, continue processing the data...
            } catch (ValidationException $e) {
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please provide required info', "icon" => generateIconPath("error"), 'data' => $e->errors()]);
            }
            
            $data = [
                'name' => $name,
                'last_name' => $last_name,
                'email' => $email,
                'mob_code' => $mob_code,
                'phone' => $mobile,
                'role' => 'user',
                'last_seen' => $timestamp,
                'last_session_ip' => $ipAddress,
                'user_agent' => $userAgent,
                'password' => Hash::make($request->password),
                'is_admin_create' => $admin_id,
            ];

            $user = User::create($data);

            if (isset($user->id)) {
                StudentDocument::create(['student_id' => $user->id]);
                StudentProfile::create(['student_id' => $user->id]);
                $message = ['message' => 'Enroll Successfully', 'type' => 'success'];
                return json_encode(['code' => 200, 'title' => "Successfully Created", 'message' => 'Student created succssfully', "icon" => generateIconPath("success")]);
            } else {
                return json_encode(['code' => 404, 'title' => "Unable to Create Student", 'message' => 'Please Try Again', "icon" => generateIconPath("error")]);
            }
        }
    }

    public  function profileImageUpload(Request $req)
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


                    if (isset($old_img_name) && !empty($old_img_name)) {

                        $folder_name = StudentDocument::where('student_id', $user_id)->first();

                        $folder = $folder_name['folder_name'];
                        
                    } else {

                        $folder = "Student_" . time() . "_" . $user_name;

                        $makeFolder = File::makeDirectory(public_path("storage/studentDocs/" . $folder), $mode = 0777, true, true);

                        if (!isset($makeFolder) && $makeFolder === 0 && is_numeric($makeFolder)) {

                            return false;
                        }
                    }
                    $docUpload = UploadFiles($image_file, 'studentDocs/' . $folder, $old_img_name);
                    if ($docUpload === FALSE) {
                        return json_encode(['code' => 201, 'message' => 'File is corrupt', 'title' => "File is corrupt", "icon" => generateIconPath("error")]);
                    }

                    $where = ['id' => $user_id];

                    $select = [

                        'photo' => $docUpload['url'],

                    ];
                    $updateUser = processData(['users', 'id'], $select, $where);

                    $where = ['student_id' => $user_id];

                    $select = [

                        'folder_name' => $folder,

                    ];
                    $updateUser = processData(['student_doc_verification', 'student_doc_id'], $select, $where);

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

    public function statusStudent(Request $req)
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
                    $where = ['id' => $id, 'is_deleted' => 'No'];
                    $exists = is_exist($table, $where);
                   
                    if (isset($exists) && $exists > 0) {
                        $where = ['id' => $id];
                        if($status == 'student_status_active'){
                            $selectData = [
                                'is_active' => 'Active',
                            ];
                            $Message = "Status Changed";
                            $Text_Message = "Status changed";

                            $updateStudent = processData([$table, 'id'], $selectData , $where);

                        }
                        if($status == 'student_status_inactive'){
                            $selectData = [
                                'is_active' => 'Inactive',
                            ];
                            $Message = "Status Changed";
                            $Text_Message = "Status changed";
                            $updateStudent = processData([$table, 'id'], $selectData , $where);

                        }
                        if (isset($updateStudent) && $updateStudent['status'] == TRUE) {
                            
                            $dashboardController = new DashboardController();
                            $dashboardData = $dashboardController->getDashboardData();
                            return json_encode(['code' => 200, 'title' => "Successfully $Message", "message" => " $Text_Message successfully", "icon" => generateIconPath("success")]);
                        }
                    }
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                    
                } catch (\Throwable $th) {
                    return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
                }
            }else {
                return json_encode(['code' => 201, 'title' => "Something Went Wrong ", 'message' => 'Please try again', "icon" => generateIconPath("error")]);
            }
             
        } else {
            return json_encode(['code' => 201, 'title' => "Already Deleted ", 'message' => 'Please try unique name', "icon" => generateIconPath("error")]);
        }
    }

    public function downloadInvoice($id,$action)
    {
        // Retrieve the invoice data from the database
        set_time_limit(300);
        ini_set('memory_limit', '512M');
        $id = base64_decode($id);
        $action =base64_decode($action);
        $where = [
            'payments.id' => $id
        ];
        $InvoiceData = $this->PaymentModule->getPaymentDetails($where,'');

        $formattedDate = Carbon::parse($InvoiceData[0]['created_at'])->format('F j, Y');
        $InvoiceDate = Carbon::parse($InvoiceData[0]['created_at'])->format('j M Y');
        $subtotal = isset($InvoiceData[0]['order_data'][0]['final_price']) ? $InvoiceData[0]['order_data'][0]['final_price'] : 0;
        $discount = isset($InvoiceData[0]['discount']) && !empty($InvoiceData[0]['discount']) ? $InvoiceData[0]['discount'] : 0;
        $scholarship = isset($InvoiceData[0]['scholarship']) ? $InvoiceData[0]['scholarship'] : 0;
        $grandTotal = $subtotal - $scholarship - $discount;
        $data = [
            'title' => 'frontend/images/brand/logo/logo.svg',
            'date' => $formattedDate,
            'invoiceNumber' => $InvoiceData[0]['uni_order_id'],
            'invoiceFrom' => [
                'name' => 'Ascencia Malta / E-Ascencia',
                'address' => '23, Vincenzo Dimech Street, Floriana, Valletta, Malta'
            ],
            'invoiceTo' => [
                'name' => $InvoiceData[0]['first_name'].' '.$InvoiceData[0]['last_name'],
                'address' => $InvoiceData[0]['address']
            ],
            'invoiceDate'=> $InvoiceDate,
            'paymentType' => $InvoiceData[0]['payment_type'],
            'items' => [], // Initialize an empty array to store items
            'subtotal' => $subtotal,
            'discount' => $discount,
            'grandTotal' => $grandTotal,
            'scholarship'=> $InvoiceData[0]['scholarship'],
        ];
        foreach ($InvoiceData[0]['order_data'] as $key => $value) {
            // Add each item to the 'items' array
            $OrderDate = Carbon::parse($value['created_at'])->format('j M Y');

            $data['items'][] = [
                'name' => $value['course_title'],
                'orderDate' => $OrderDate,
                'couponCode' => $value['promo_code_name'],
                'amount' => number_format($value['course_price'], 2, '.', ',')
            ];
        }

        if($action == 'invoice'){
        // Example data for the invoice
            // Load the view and pass data
            $pdf = PDF::loadView('frontend.payment.invoice', $data);

            // Download the PDF file
            return $pdf->download('invoice.pdf');
        }else if($action == 'pdfopen'){

            $pdf = PDF::loadView('frontend.payment.invoice', $data);

            return $pdf->stream('invoice.pdf');

        }else {

            return view('frontend.payment.receipt',$data);
        }
    }

    public function deleteStudent(Request $req){

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
                                $where = ['id' => $id, 'is_active' => 'Active'];
                                $exists = is_exist('users', $where);
                                if (isset($exists) && $exists > 0) {
                                    $selectData = [
                                        'is_active' => 'Inactive',
                                    ];
                                    $where = ['id' => $id];
                                    $updateUser = processData(['users', 'id'], $selectData , $where);
                                }
                                $deleteStudent = $this->user->deleteUserData($id);
                                $i++;
                            }
                           
                        }
                        if ($i > 0) {
                            return response()->json(['code' => 200, 'title' => $i . ' Records Successfully Deleted', 'icon' => generateIconPath('success')]);
                        } else {
                            return response()->json(['code' => 201, 'title' => 'Unable to Delete', "icon" => generateIconPath("error")]);
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
    
    public function studentReport()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $studentCounts = DB::table('users')
            ->selectRaw('
                COUNT(*) as totalStudentsCount,
                SUM(CASE WHEN is_verified = "Verified" THEN 1 ELSE 0 END) as totalEnrolledStudentsCount
            ')
            ->where([
                'is_deleted' => 'No',
                'is_active' => 'Active',
                'block_status' => '0',
                'role' => 'user',
            ])
            ->first();

        $totalStudentsCount = $studentCounts->totalStudentsCount;
        $totalEnrolledStudentsCount = $studentCounts->totalEnrolledStudentsCount;

        $data = [
            'totalStudentsCount' => $totalStudentsCount,
            'totalEnrolledStudentsCount' => $totalEnrolledStudentsCount,
        ];
        return view('admin/exam/student-report', compact('data'));
    }
    
    // public function StudentReportList()
    // {
    //     if (Auth::check()) {
    //         $studentData = [];
    //         $where =[];
    //         $studentsWithCourses = [];


            
    //         $studentData = $this->user->studentReportData($where);

    //         foreach ($studentData as $user) {
    //             $where = ['user_id' => $user->id];
    //             $user->allPaidCourses = getAllPaidCourse($where);
    //             $examResults = [];
                
    //             foreach ($user->allPaidCourses as $course) {
                    
    //                 $courseExamCount = getCourseExamCount(base64_encode($course_id));

    //                 // Fetch exam remarks for the user
    //                 $examRemarkMasters = DB::table('exam_remark_master')->where([
    //                     'course_id' => $course->course_id,
    //                     'user_id' => $user->id,
    //                     'is_active' => 1,
    //                 ])->get();
                    
    //                 // Get exam attempt remaining count for the user
    //                 $studentCourseMaster = getData('student_course_master', ['exam_attempt_remain'], [
    //                     'course_id' => $course->course_id,
    //                     'user_id' => $user->id,
    //                     'id'=> $course->scmId
    //                 ], '1', 'id', 'desc');
                    
    //                 $user->examResults = '';

    //                 if($studentCourseMaster[0]->exam_attempt_remain == 2){

    //                     $examResult ='Not Attempt';
    //                     $color='warning';
    //                 }elseif(count($examRemarkMasters) == 1){
    //                     if(count($examRemarkMasters) == $courseExamCount){
    //                         $examResult = ''; 
    //                         $completedExamCount = DB::table('exam_remark_master')->where([
    //                             'course_id' => $course->course_id,
    //                             'user_id' => $user->id,
    //                             'is_cheking_completed' => '2',
    //                         ])
    //                         ->count();  

    //                         if($courseExamCount == $completedExamCount){
    //                             $studentCourseMaster = DB::table('student_course_master')->where(['user_id' => $user->id, 'course_id' => $course->course_id,'id'=>$course->scmId])->latest()->first();
    //                             if(!empty($studentCourseMaster)){
    //                                 if($studentCourseMaster->exam_remark == '0'){
    //                                     $examResult = 'Fail';
    //                                     $color = 'danger';
    //                                 }elseif($studentCourseMaster->exam_remark == '1'){
    //                                     $examResult = 'Pass';
    //                                     $color = 'success';
    //                                 }else{
    //                                     $examResult = 'Pending';
    //                                     $color = 'warning';
    //                                 }
    //                             }
    //                         }else{
    //                             $examResult = 'Checking';
    //                             $color = 'primary';
    //                         }
    //                     }else{
    //                         $studentCourseMaster = DB::table('student_course_master')->where(['user_id' => $user->id, 'course_id' => $course->course_id,'id'=>$course->scmId])->latest()->first();
    //                         if(!empty($studentCourseMaster)){
    //                             if($studentCourseMaster->exam_remark == '0'){
    //                                 $examResult = 'Fail';
    //                                 $color = 'danger';
    //                             }elseif($studentCourseMaster->exam_remark == '1'){
    //                                 $examResult = 'Pass';
    //                                 $color = 'success';
    //                             }else{
    //                                 $examResult = 'Pending';
    //                                 $color = 'warning';
    //                             }
    //                         }
    //                         // $examResult = 'Pending';
    //                         // $color = 'warning';
    //                     }
    //                 }elseif(count($examRemarkMasters) == 2){

    //                     if(count($examRemarkMasters) == $courseExamCount){
    //                         $examResult = ''; 
    //                         $completedExamCount = DB::table('exam_remark_master')->where([
    //                             'course_id' => $course->course_id,
    //                             'user_id' => $user->id,
    //                             'is_cheking_completed' => '2',
    //                         ])->count();
    //                         if($completedExamCount == count($examRemarkMasters)){
    //                             $studentCourseMaster = DB::table('student_course_master')->where(['user_id' => $user->id, 'course_id' => $course->course_id,'id'=>$course->scmId])->latest()->first();
    //                             if(!empty($studentCourseMaster)){
    //                                 if($studentCourseMaster->exam_remark == '0'){
    //                                     $examResult = 'Fail';
    //                                     $color = 'danger';
    //                                 }elseif($studentCourseMaster->exam_remark == '1'){
    //                                     $examResult = 'Pass';
    //                                     $color = 'success';
    //                                 }else{
    //                                     $examResult = 'Pending';
    //                                     $color = 'warning';
    //                                 }
    //                             }
    //                         }else{
    //                             $examResult = 'Checking';
    //                             $color = 'primary';
    //                         }
    //                     }else{
    //                         // $examResult = 'Pending';
    //                         // $color = 'warning';
                            
    //                         $studentCourseMaster = DB::table('student_course_master')->where(['user_id' => $user->id, 'course_id' => $course->course_id,'id'=>$course->scmId])->latest()->first();
    //                         if(!empty($studentCourseMaster)){
    //                             if($studentCourseMaster->exam_remark == '0'){
    //                                 $examResult = 'Fail';
    //                                 $color = 'danger';
    //                             }elseif($studentCourseMaster->exam_remark == '1'){
    //                                 $examResult = 'Pass';
    //                                 $color = 'success';
    //                             }else{
    //                                 $examResult = 'Pending';
    //                                 $color = 'warning';
    //                             }
    //                         }
    //                     }
    //                 }else{

    //                     if(count($examRemarkMasters) == $courseExamCount){

    //                             $examResult = ''; 
    //                             $completedExamCount = DB::table('exam_remark_master')->where([
    //                                 'course_id' => $course->course_id,
    //                                 'user_id' =>    $user->id,
    //                                 'is_cheking_completed' => '2',
    //                             ])->count();

    //                             if($completedExamCount == count($examRemarkMasters)){
    //                                 $studentCourseMaster = DB::table('student_course_master')->where(['user_id' =>  $user->id, 'course_id' => $course->course_id, 'id'=> $course->scmId])->latest()->first();
    //                                 if(!empty($studentCourseMaster)){
    //                                     if($studentCourseMaster->exam_remark == '0'){
    //                                         $examResult = 'Fail';
    //                                         $color = 'danger';
    //                                     }elseif($studentCourseMaster->exam_remark == '1'){
    //                                         $examResult = 'Pass';
    //                                         $color = 'success';
    //                                     }else{
    //                                         $examResult = 'Pending';
    //                                         $color = 'warning';
    //                                     }
    //                                 }
    //                             }else{
    //                                 $examResult = 'Checking';
    //                                 $color = 'primary';
    //                             }

    //                     }else{
    //                         $studentCourseMaster = DB::table('student_course_master')->where(['user_id' => $user->id, 'course_id' => $course->course_id,'id'=>$course->scmId])->latest()->first();
    //                         if(!empty($studentCourseMaster)){
    //                             if($studentCourseMaster->exam_remark == '0'){
    //                                 $examResult = 'Fail';
    //                                 $color = 'danger';
    //                             }elseif($studentCourseMaster->exam_remark == '1'){
    //                                 $examResult = 'Pass';
    //                                 $color = 'success';
    //                             }else{
    //                                 $examResult = 'Pending';
    //                                 $color = 'warning';
    //                             }
    //                         }
    //                     }
    //                 }
    //                 $examResults[$course->scmId] = [
    //                     'result' => $examResult,
    //                     'color' => $color
    //                 ];
    //             }
    //             $user->examResults = $examResults;
    //         }
    //         return response()->json($studentData);
    //     }
    //     return redirect('/login');
    // }

    public function StudentReportList()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $studentData = $this->user->studentReportData([]);
        
        foreach ($studentData as $user) {
            $user->allPaidCourses = getAllPaidCourse(['user_id' => $user->id]);
            $examResults = [];

            foreach ($user->allPaidCourses as $course) {
                $courseExamCount = getCourseExamCount(base64_encode($course->course_id));
                $examRemarkMasters = DB::table('exam_remark_master')->where([
                    'student_course_master_id' => $course->scmId,
                    'is_active' => 1,
                ])->get();

                $studentCourseMaster = getData('student_course_master', ['exam_attempt_remain'], [
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


    public function ResearchDocVerify(Request $req)
    {
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $admin_id = Auth::user()->id;
            $user_id = isset($req->student_id) ? base64_decode($req->input('student_id')) : '';
            // $research_doc_status = $req->research_doc_status === "1" ? "Approved" : 'Rejected';
            // $research_doc_status_text = $req->research_doc_status === "1" ? "approved" : 'rejected';
            if ($req->research_doc_status === "1") {
                $research_doc_status = "Approved";
                $research_doc_status_text = "approved";
            } elseif ($req->research_doc_status === "0") {
                $research_doc_status = "Rejected";
                $research_doc_status_text = "rejected";
                $research_doc_update = "Reject";

            } elseif ($req->research_doc_status === "2") {
                $research_doc_status = "Reupload";
                $research_doc_status_text = "reupload";
                $research_doc_update = "Reupload";
            } 
            $exists =   is_exist('users', ['id' => $user_id,  'is_deleted' => 'No']);

            if (isset($exists) && is_numeric($exists) && $exists === 0) {
                return json_encode(['code' => 201, 'title' => 'User Not Available', 'message' => 'User not Exist', 'icon' => generateIconPath('warning')]);
            }
            $validate_rules = [
                'research_doc_status' => 'required|string|min:1',
            ];

            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {

                $where = ['student_id' => $user_id];
                $exists = is_exist('student_doc_verification', $where);
                if (isset($exists) && is_numeric($exists) && $exists > 0) {
                    $action = 'update';
                } else {
                    $action = 'insert';
                }
                if ($research_doc_status === 'Approved') {
                    $select = [
                        'proposal_approved_by' => $admin_id,
                        'proposal_is_approved' => $research_doc_status,
                    ];
                    $select = array_merge($select, ['proposal_approved_on' => $this->time]);
                } else {
                    $select = [
                        'proposal_approved_by' => 0,
                        'proposal_is_approved' => $research_doc_update,
                        'research_proposal_file'=> '',
                        'research_proposal_file_name'=>'',
                        'proposal_uploaded_at'=>''

                    ];
                    $select = array_merge($select, ['proposal_approved_on' => $this->time]);
                   
                }
                $updateUserProfile = processData(['student_doc_verification', 'student_doc_id'], $select, $where, $action);
                if (isset($updateUserProfile) && !empty($updateUserProfile['id'])) {
                    return json_encode(['code' => 200, 'title' => 'Successfully ' . $research_doc_status, "message" => "Student details $research_doc_status_text successfully", "icon" => generateIconPath("success")]);  
                }
            }else{
                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => generateIconPath("error"), 'data' => $validate->errors()]);
            }
        } else {
            return json_encode(['code' => 202, 'title' => 'Something Went Wrong', 'message' => 'Something Went Wrong.', "icon" => generateIconPath("error")]);
        }
    }


    public function StudentCoursePurchase(Request $req){

        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {
            $student_id = isset($req->student_id) ? base64_decode($req->student_id) : '';
            $course_id = isset($req->course_id) ? base64_decode($req->course_id) : '';
            $CoursesData = getData('course_master',['ementor_id','course_title','duration_month'],['id'=>$course_id]);

            $select = [
                'course_id' => $course_id,
                'user_id' => $student_id,
                'instructor_id' => $CoursesData[0]->ementor_id,
                'course_title' => $CoursesData[0]->course_title,
                'created_at' =>  $this->time,
                'created_by' =>  auth()->user()->id,
                'status'=>'0'
            ];
            $updateOrder = processData(['orders', 'id'], $select, []);
            if (isset($updateOrder) && !is_array($updateOrder) && $updateOrder === FALSE) {
                return json_encode(['code' => 201, 'title' => "Unable to Course Purchase", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error")]);
            }
            $User = getData('users',['name','last_name','email'],['id'=>$student_id]);
            $uniq_payment_id = rand();
            $uniq_order_id = rand();
            $select = [
                'user_id' => $student_id,
                'first_name' => $User[0]->name,
                'last_name' => $User[0]->last_name,
                'email' => $User[0]->email,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
                'created_at' => $this->time,
                'uni_payment_id' => $uniq_payment_id,
                'uni_order_id' => $uniq_order_id,
                'payment_status'=>'0',
                'status'=>'0'
            ];
            $paymentData = processData(['payments', 'id'], $select, []);
            if (isset($paymentData) && !is_array($paymentData) && $paymentData === FALSE) {
                return json_encode(['code' => 201, 'title' => "Unable to Course Purchase", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error")]);
            }
            $where = ['id' =>  $updateOrder['id']];
            $select = [
                'payment_id' => $paymentData['id'],
            ];
            $updateOrder = processData(['orders', 'id'], $select, $where);


            $select = [
                'user_id' => $student_id,
                'course_id' => $course_id,
                'payment_id'=>  $paymentData['id'],
                'purchased_on' => $this->time,
                'created_by' => auth()->user()->id,
                'created_at' => $this->time,
                'course_start_date' => now()->format('Y-m-d'),
                'course_expired_on' => Carbon::now()->addMonths($CoursesData[0]->duration_month)->format('Y-m-d')
            ];
            $courseMasterData = processData(['student_course_master', 'id'], $select, []);


            if (isset($courseMasterData) && $courseMasterData['status'] == 'TRUE') {

                return json_encode(['code' => 200, 'title' => "Course Assigned", 'message' => 'Course Assigned', "icon" => generateIconPath("success")]);

            }else{
                return json_encode(['code' => 201, 'title' => "Unable to Course Purchase", 'message' => 'Something Went Wrong. Please Try Again...', "icon" => generateIconPath("error")]);

            }
        } else {
            return json_encode(['code' => 202, 'title' => 'Something Went Wrong', 'message' => 'Something Went Wrong.', "icon" => generateIconPath("error")]);
        }
    }
    
}

