<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect,DB};
use Illuminate\Database\Eloquent\SoftDeletes;
class InstituteProfile extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = false;
    public $table = 'institute_profile_master';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'institute_id', 'id');
    }

    public function getInstituteProfile($where = [], $select = [])
    {   
        $instituteData = [];
        if (Auth::check()) {
            $query = InstituteProfile::with('user');
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $instituteData = $query->where($where)->orderBy('id','desc')->get();
            } else {
                $instituteData = $query->orderBy('id','desc')->get();
                // foreach($instituteData as $ementor){
                //     $ementor->enrolledStudentCount =
                // }
            }
            return $instituteData;
        }
    }

    public function getInstituteStudentList($where = [], $select = [], $limit = ''){

        if (Auth::check()) {
            if($limit != "1"){
                $users = getData('users',['id','name','photo','last_name','verified_on', 'is_active'],$where,'','id','desc');
            }else{
                $users = getData('users',['id','name','photo','last_name','verified_on', 'is_active'],$where,'5','id','desc');
            }
            $studentData = [];

            foreach ($users as $user) {

                if($limit != "1"){
                    $user->allPaidCourses = getAllPaidCourse(['user_id' => $user->id]);
                }else{
                    $user->allPaidCourses = getAllPaidCourse(['user_id' => $user->id,'limit'=>'1']);
                }
                // if (!empty($user->allPaidCourses)) {
                    $examResults = [];

                    foreach ($user->allPaidCourses as $course) {
                        // Get course exam count
                        $courseExamCount = getCourseExamCount(base64_encode($course->course_id));

                        // Fetch exam remarks for this course and user
                        $examRemarkMasters = DB::table('exam_remark_master')->where([
                            'course_id' => $course->course_id,
                            'user_id' => $user->id,
                            'student_course_master_id' => $course->scmId,
                            'is_active' => 1,
                        ])->get();

                        // Retrieve student's course master data
                        $studentCourseMaster = getData('student_course_master', ['exam_attempt_remain'], [
                            'course_id' => $course->course_id,
                            'user_id' => $user->id,
                            'id' => $course->scmId,
                        ]);


                        // Determine the exam result
                        $examResult = determineExamResult(
                            $studentCourseMaster[0]->exam_attempt_remain ?? 0,
                            count($examRemarkMasters),
                            $courseExamCount,
                            $course->course_id,
                            $user->id,
                            $course->scmId
                        );

                        // Add the exam result for this course
                        $examResults[$course->scmId] = $examResult;
                    }

                    // Store exam results in the user object
                    $user->examResults = $examResults;

                    // Append user data to the student data array
                    $studentData[] = $user;
                // }
            }
            return $studentData;
        }
    }

    public function getInstituteTeacherList($where = [], $select = [], $limit = '')
    {
        if (Auth::check()) {
            $teachersData = getData('lecturers_master',['id', 'lactrure_name', 'email', 'image', 'designation'], $where, '', 'id', 'desc');
            return $teachersData;
        }
        return [];
    }
    
    
}