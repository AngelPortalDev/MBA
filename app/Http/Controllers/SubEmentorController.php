<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Validator,  DB, Storage};
use File;
use App\Models\ExamRemarkMaster;
use App\Models\Notification;

class SubEmentorController extends Controller
{
   
    public function subEmentorDashboard()
    {
        $subEmentorId = isset(Auth::user()->id) ? Auth::user()->id : 0;
        if (!Auth::check() && empty($subEmentorId) && $subEmentorId == 0) {
            return redirect('/login');
        }
        
        $approvedAmounts = DB::table('exam_remark_master')
            ->where('remark_updated_by', $subEmentorId)
            ->where('is_cheking_completed', '2')
            ->where('approved_status', '1')
            ->sum('amount') ?? 0;

        $checkedExams = DB::table('exam_remark_master')
            ->where('remark_updated_by', $subEmentorId)
            ->where('is_cheking_completed', '2')
            ->whereNull('approved_by')
            ->select('exam_type', 'exam_id')
            ->get();

        $pendingAmounts = $checkedExams->sum(function ($checkedExam) {
            return DB::table('exam_amounts')
                ->where('exam_type', $checkedExam->exam_type)
                ->where('exam_id', $checkedExam->exam_id)
                ->sum('amount');
        });

        $totalAmounts = $approvedAmounts + $pendingAmounts;

        $data = [
            'totalAmounts' => $totalAmounts,
            'approvedAmounts' => $approvedAmounts,
            'pendingAmounts' => $pendingAmounts,
        ];

        return view('frontend.sub-ementor.sub-e-mentor-dashboard', compact('data'));

    }

    public function SubEmentorProfile()
    {
        $subEmentorId = isset(Auth::user()->id) ? Auth::user()->id : 0;
        if (Auth::check() && !empty($subEmentorId) && $subEmentorId != 0) {
            $where = ['ementor_id' => $subEmentorId];
            $ementorData = $this->EmentorProfile->getSubEmentorProfile($where);
            return view('frontend.teacher.e-mentor-profile', compact('ementorData'));
        }

        return redirect('/login');
    }
    
    public function updateEmentorProfile(Request $req){
        if ($req->isMethod('POST') && $req->ajax() && Auth::check()) {

            $ementor_id = Auth::user()->id;
            $first_name = isset($req->first_name) ? htmlspecialchars_decode($req->input('first_name')) : '';
            $last_name = isset($req->last_name) ? htmlspecialchars_decode($req->input('last_name')) : '';
            $dob = isset($req->dob) ? htmlspecialchars($req->input('dob')) : '';
            $gender = isset($req->gender) ? htmlspecialchars($req->input('gender')) : null;
            $country_id = isset($req->country_id) ? htmlspecialchars($req->input('country_id')) : 0;
            $nationality = isset($req->nationality) ? htmlspecialchars_decode($req->input('nationality')) : '';
            $address = isset($req->address) ? htmlspecialchars_decode($req->input('address')) : '';
            $highest_education = isset($req->highest_education) ? htmlspecialchars($req->input('highest_education')) : '';
            $specialization = isset($req->specialization) ? htmlspecialchars_decode($req->input('specialization')) : '';
            $institution_name = isset($req->institution_name) ? htmlspecialchars_decode($req->input('institution_name')) : '';
            $ementor_resume = $req->hasFile('ementor_resume') ? $req->file('ementor_resume') : '';
            $old_resume_file = isset($req->old_resume_file) ? htmlspecialchars($req->input('old_resume_file')) : '';

            $exists =   is_exist('users', ['id' => $ementor_id,  'is_deleted' => 'No']);
            if (isset($exists) && is_numeric($exists) && $exists === 0) {
                return json_encode(['code' => 201, 'title' => 'E-mentor Not Available', 'message' => 'E-mentor not Exist', 'remark' => 'warning']);
            }
            $validate_rules = [
                'first_name' => 'required|string|max:225|min:3',
                'last_name' => 'required|string|max:225|min:2',
                // 'dob' => 'required|date|before:today',
                // 'country_id' => 'required|numeric|min:1',
            ];
            $validate = Validator::make($req->all(), $validate_rules);
            if (!$validate->fails()) {
                $select = [
                    'name' => $first_name,
                    'last_name' => $last_name
                ];

                $where = ['id' => $ementor_id,  'is_deleted' => 'No'];
                $updateUser = processData(['users', 'id'], $select, $where, 'update');

                $resume_file ='';
                $filename ='';
                $getEmentorData = getData('ementor_profile_master', ['resume_file_name', 'folder_name', 'upload_resume'],['ementor_id' => $ementor_id]);
                if (isset($getEmentorData) && !empty($getEmentorData)) {
                    $resume_file = $getEmentorData[0]->upload_resume;
                    $filename= $getEmentorData[0]->resume_file_name;
                    $folder = $getEmentorData[0]->folder_name;

                }
                if($req->hasFile('ementor_resume')){
                    if (isset($getEmentorData[0]->folder_name) && !empty($getEmentorData[0]->folder_name)) {
                        $folder = $getEmentorData[0]->folder_name;
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
                        return json_encode(['code' => 201, 'title' => "File is corrupt", 'message' => 'File is corrupt', "icon" => generateIconPath("error")]);
                    }
                    $resume_file = $docUpload['url'];
              
                   
                }
                if (isset($updateUser) && $updateUser['status'] === TRUE && $updateUser['id']  > 0) {
                    $select = [
                        'ementor_id' => $updateUser['id'],
                        'address' => $address,
                        'country_id' => $country_id,
                        'gender' => $gender,
                        'dob' => $dob,
                        'nationality' => $nationality,
                        'highest_education'=> $highest_education,
                        'specialization' => $specialization,
                        'institution_name'=>$institution_name,
                        'upload_resume'=> $resume_file,
                        'resume_file_name'=>$filename,
                        'folder_name'=>$folder,
                        // 'occupation' => $occupation,
                        'last_profile_update_on' =>  $this->time,
                    ];
                    $where = ['ementor_id' => $updateUser['id']];
                    $exists = is_exist('ementor_profile_master', $where);

                    $updateEmentorProfile = processData(['ementor_profile_master','ementor_profile_id'], $select, $where);

                    if (isset($updateEmentorProfile) && $updateEmentorProfile === FALSE) {
                        return json_encode(['code' => 201, 'title' => "Something Went Wrong", 'message' => 'Please Try Again', "icon" => "error"]);
                    }
                    return json_encode(['code' => 200, 'title' => 'Successfully Updated', "message" => "Your profile has been updated successfully.", "icon" => "success"]);
                }
            } else {


                return json_encode(['code' => 202, 'title' => 'Required Fields are Missing', 'message' => 'Please Provide Required Info', "icon" => "error", 'data' => $validate->errors()]);
            }
        }
    }


    public function allStudentList()
    {
        $subEmentorId = isset(Auth::user()->id) ? Auth::user()->id : 0;
        $status = isset($status) && !empty($status) ? base64_decode($status) : 4;
        if (Auth::check() && !empty($subEmentorId) && $subEmentorId != 0) {
            $assignedStudents = Auth::user()->assignedStudents()
                ->select('subementor_student_relations.*', 'users.*', 'student_id', 'sub_ementor_id', 'course_id')
                ->orderBy('subementor_student_relations.created_at', 'desc')
                ->get()
                ->groupBy(function ($item) {
                    return $item->student_id . '-' . $item->sub_ementor_id;
                })
                ->map(function ($group) {
                    $first = $group->first();
                    return [
                        'student_id' => $first->student_id,
                        'sub_ementor_id' => $first->sub_ementor_id,
                        'course_ids' => $group->pluck('course_id')->unique()->toArray(),
                        'student_course_master_ids' => $group->pluck('student_course_master_id')->unique()->toArray(),
                        'user_data' => $first,
                    ];
                })
                ->values();

                $studentData = $assignedStudents->filter(function($user) {
                $courseIds = $user['course_ids']; 
                $studentCourseMasterIds = $user['student_course_master_ids'];
                $user = (object) $user['user_data'];
                $user->allPaidCourses = getAllPaidCourse(['user_id' => $user->student_id, 'course_id' => $courseIds, 'student_course_master_id' =>  $studentCourseMasterIds]);
                return 
                    !empty($user->allPaidCourses) ;
            })->values();
            
            foreach ($studentData as $user) {
                $courseIds = $user['course_ids'];
                $studentCourseMasterIds = $user['student_course_master_ids'];
                $user = (object) $user;
                $user->allPaidCourses = getAllPaidCourse(['user_id' => $user->student_id, 'course_id' => $courseIds, 'student_course_master_id' =>  $studentCourseMasterIds]);
            
                $examResults = [];
            
                foreach ($user->allPaidCourses as $course) {
                    $courseExamCount = getCourseExamCount(base64_encode($course->course_id));
                    $examRemarkMasters = DB::table('exam_remark_master')->where([
                        // 'course_id' => $course->course_id,
                        'student_course_master_id' => $course->scmId,
                        'is_active' => 1,
                    ])->get();
            
                    $studentCourseMaster = getData('student_course_master', ['exam_attempt_remain'], [
                        // 'course_id' => $course->course_id,
                        'id' => $course->scmId
                    ]);
            
                    $examResult = determineExamResult(
                        $studentCourseMaster[0]->exam_attempt_remain ?? 0,
                        count($examRemarkMasters),
                        $courseExamCount,
                        $course->course_id,
                        $user->student_id,
                        $course->scmId
                    );
            
                    $examResults[$course->scmId] = $examResult;
                }

                $user->examResults = $examResults;
            
                $studentsData[] = $user;
            }
            
            return response()->json([
                'studentData' => $studentsData,
            ]);
            
        }

        return redirect('/login');
    }

    public function ementorStudentInfo($studentId, $course_id, $student_course_master_id)
    {
        if (Auth::check() && isset($studentId) && !empty($studentId) && isset($course_id) && !empty($course_id) && $course_id) {
            $subEmentorId = isset(Auth::user()->id) ? Auth::user()->id : 0;
            $studentId = isset($studentId) && !empty($studentId) ? base64_decode($studentId) : 0;
            $course_id = isset($course_id) && !empty($course_id) ? base64_decode($course_id) : 0;
            $student_course_master_id = isset($student_course_master_id) && !empty($student_course_master_id) ? base64_decode($student_course_master_id) : 0;


            $where = ['user_id' => $studentId, 'course_id' => $course_id, 'student_course_master_id' => $student_course_master_id];
            $ementorStudentData = $this->ExamRemark->getEmentorStudentsDetails($where);
            return view('frontend/teacher/e-mentor-students-exam-details', compact('ementorStudentData'));
        }
        return redirect('/login');
    }

    public function uploadDocument1(Request $req)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
    
        $directory = public_path("storage/subEmentorDocs/{$user->id}/");
    
        if (file_exists($directory)) {
            File::deleteDirectory($directory);
        }
    
        File::makeDirectory($directory, 0777, true);
    
        $savedFiles = [];
        $maxFileSize = 2 * 1024 * 1024;
    
        foreach ($req->all() as $key => $fileData) {
            if (preg_match('/^data:image\/(\w+);base64,/', $fileData, $type)) {
                $data = substr($fileData, strpos($fileData, ',') + 1);
                $type = strtolower($type[1]);
                $data = base64_decode($data);
    
                if ($data === false) {
                    return response()->json(['error' => 'Base64 decode failed.'], 500);
                    return response()->json([
                        'code' => 500, 
                        'title' => "Error", 
                        "message" => "Something went wrong.", 
                        "icon" => "error"
                    ]);
                    
                }

                if (strlen($data) > $maxFileSize) {
                    return response()->json([
                        'error' => 'File size exceeds 2MB. Please upload a smaller file.'
                    ], 400);
                }
    
                $imageName = 'document_' . time() . '_' . uniqid() . '.' . $type;
                $imagePath = $directory . $imageName;
    
                if (file_put_contents($imagePath, $data) === false) {
                    return response()->json([
                        'code' => 500, 
                        'title' => "Error", 
                        "message" => "Something went wrong.", 
                        "icon" => "error"
                    ]);
                    
                }
    
                $savedFiles[] = $imagePath;
    
            }

            elseif (preg_match('/^data:application\/pdf;base64,/', $fileData)) {
                $data = substr($fileData, strpos($fileData, ',') + 1);
                $data = base64_decode($data);
    
                if ($data === false) {
                    return response()->json([
                        'code' => 500, 
                        'title' => "Error", 
                        "message" => "Something went wrong.", 
                        "icon" => "error"
                    ]);
                    
                }

                if (strlen($data) > $maxFileSize) {
                    return response()->json([
                        'code' => 400, 
                        'title' => "File size exceed", 
                        "message" => "File size exceeds 2MB. Please upload a smaller file.", 
                        "icon" => "error"
                    ]);
                }
    
                $pdfName = 'document_' . time() . '_' . uniqid() . '.pdf';
                $pdfPath = $directory . $pdfName;
    
                if (file_put_contents($pdfPath, $data) === false) {
                    return response()->json([
                        'code' => 500, 
                        'title' => "Error", 
                        "message" => "Something went wrong.", 
                        "icon" => "error"
                    ]);
                    
                }
    
                $savedFiles[] = $pdfPath;
            }
        }
        
        return response()->json(['code' => 200, 'title' => "Submitted Successfully", "message" => "Document submitted successfully", "icon" => "success", "redirect" => '/ementor/e-mentor-profile']);

    }
    
    public function uploadDocument(Request $req)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        $directory = public_path("storage/subEmentorDocs/{$user->id}/");

        if (file_exists($directory)) {
            File::deleteDirectory($directory);
        }

        File::makeDirectory($directory, 0777, true);

        $maxFileSize = 2 * 1024 * 1024;
        $savedFiles = [];
        $fileNames = [];

        DB::beginTransaction();

        try {
            foreach ($req->all() as $key => $fileData) {
                $fileType = null;

                if (preg_match('/^data:image\/(\w+);base64,/', $fileData, $type)) {
                    $data = substr($fileData, strpos($fileData, ',') + 1);
                    $fileType = strtolower($type[1]);
                    $data = base64_decode($data);
                    $filePrefix = 'document_';
                } elseif (preg_match('/^data:application\/pdf;base64,/', $fileData)) {
                    $data = substr($fileData, strpos($fileData, ',') + 1);
                    $data = base64_decode($data);
                    $fileType = 'pdf';
                    $filePrefix = 'document_';
                } else {
                    continue;
                }

                if ($data === false) {
                    throw new \Exception('Base64 decode failed.');
                }

                if (strlen($data) > $maxFileSize) {
                    return response()->json([
                        'code' => 400,
                        'title' => "File size exceed",
                        "message" => "File size exceeds 2MB. Please upload a smaller file.",
                        "icon" => "error"
                    ]);
                }

                $fileName = $filePrefix . time() . '_' . uniqid() . '.' . $fileType;
                $filePath = $directory . $fileName;

                if (file_put_contents($filePath, $data) === false) {
                    throw new \Exception("File save failed.");
                }

                // Store only the path after 'public/storage' for database storage
                $relativePath = 'storage/subEmentorDocs/' . $user->id . '/' . $fileName;
                $savedFiles[] = $relativePath;
                $fileNames[] = $fileName;
            }

            // Prepare data for saving in the database
            $recordData = [
                'sub_ementor_id' => $user->id,
                'file1' => $fileNames[0] ?? null,
                'file1_name' => 'Document 1',
                'file2' => $fileNames[1] ?? null,
                'file2_name' => 'Document 2',
                'file3' => $fileNames[2] ?? null,
                'file3_name' => 'Document 3',
                'file4' => $fileNames[3] ?? null,
                'file4_name' => 'Document 4',
                'file5' => $fileNames[4] ?? null,
                'file5_name' => 'Document 5',
                'status' => '1',
                'is_deleted' => 'No',
                'created_by' => $user->id,
            ];

            DB::table('subementor_documents')->insert($recordData);

            DB::commit();

            return response()->json(['code' => 200, 'title' => "Submitted Successfully", "message" => "Document submitted successfully", "icon" => "success", "redirect" => '/ementor/e-mentor-profile']);

        } catch (\Exception $e) {
            DB::rollBack();
            File::deleteDirectory($directory);

            return response()->json([
                'code' => 500,
                'title' => "Error",
                "message" => $e->getMessage(),
                "icon" => "error"
            ]);
        }
    }
    

    
}
