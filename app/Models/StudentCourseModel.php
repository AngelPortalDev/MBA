<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User, CourseModule};
use Illuminate\Support\Facades\{Auth, Redirect};

class StudentCourseModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'student_course_master';
    protected $primaryKey = 'id';
    protected $guarded  = [];

    
    
    public function studentCourseData()
    {
        return $this->hasOne(StudentDocument::class, 'course_id','course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function studentCertData()
    {
        return $this->hasOne(StudentDocument::class, 'student_id', 'user_id');
    }
    public function studentCourses()
    {
        return $this->hasOne(CourseModule::class, 'id', 'course_id');
    }
    public function studentUserData()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->where('is_active','Active');
    }
    public function studentCertificateIssue()
    {
        return $this->hasOne(CertificateIssue::class, 'student_course_master_id', ''); 
    }
    
    public function StudentCertificateData($where)
    {
        $data = null;
        if (isset($where) && !empty($where)) {
            $data = $this->select('user_id', 'course_id','id')->with(['studentCertData' => function ($query) {
                $query->select('student_id', 'name_on_education_doc');
            }])->with(['studentUserData' => function ($query) {
                    $query->select('id','roll_no');
            }])->with(['studentCourses' => function ($query) {
                $query->select('id', 'course_title', 'category_id', 'duration_month', 'ementor_id');
            }])->where($where)->get()->toArray();
        }
        return $data;
    }
    // public function studentCerficateGenerateData(){

    //     $ementorId = isset(Auth::user()->id) ? Auth::user()->id : 0;


    //     $query = $this->select('user_id', 'course_id','id','course_start_date','cert_file')
    //     ->with(['studentUserData' => function ($query) {
    //         $query->select('id','roll_no','is_active','name','last_name');
    //     }])->with(['studentCourses' => function ($query) {
    //         $query->select('id','course_title','category_id','duration_month','ementor_id');
    //     }])->with(['studentCertificateIssue' => function ($query) {
    //         $query->select('certificate_no', 'deployed_on_blockchain', 'student_course_master_id', 'cid', 'transferred_on', 'transactionHash', 'tokenId', 'smartContract');
    //     }])
    //     ->whereHas('studentUserData', function ($query) {
    //         $query->where('is_active', 'Active'); // Filter active users
    //     });
    //     // ->whereHas('studentCourses', function ($query) use ($ementorId) {
    //     //     $query->where('ementor_id',$ementorId);
    //     // })
    //     if (Auth::user()->role === 'instructor') {
    //         // If the user is an instructor, filter courses based on `ementor_id`
    //         $query->whereHas('studentCourses', function ($subQuery) use ($ementorId) {
    //             $subQuery->where('ementor_id', $ementorId);
    //         });
    //     } elseif (Auth::user()->role === 'user') {
    //         // If the user is a student, filter by their user ID
    //         if (!empty($ementorId)) {
    //             $query->where('user_id', $ementorId);
    //         }
    //     }
    
    //     $query->where('exam_remark', '1')
    //     ->where('is_deleted', 'No');

    //    return $query->get()->toArray();
    // }
    
    
    public function studentCerficateGenerateData()
    {
        $ementorId = Auth::user()->id ?? 0;
        $role = Auth::user()->role;

        $query = $this->select('user_id', 'course_id', 'id', 'course_start_date', 'cert_file')
            ->with([
                'studentUserData' => function ($query) {
                    $query->select('id', 'roll_no', 'is_active', 'name', 'last_name');
                },
                'studentCourses' => function ($query) {
                    $query->select('id', 'course_title', 'category_id', 'duration_month', 'ementor_id');
                },
                'studentCertificateIssue' => function ($query) {
                    $query->select(
                        'certificate_no',
                        'deployed_on_blockchain',
                        'student_course_master_id',
                        'cid',
                        'transferred_on',
                        'transactionHash',
                        'tokenId',
                        'smartContract'
                    );
                }
            ])
            ->whereHas('studentUserData', function ($query) {
                $query->where('is_active', 'Active');
            });

        if ($role === 'instructor') {
            $query->whereHas('studentCourses', function ($subQuery) use ($ementorId) {
                $subQuery->where('ementor_id', $ementorId);
            });
        } elseif ($role === 'user') {
            if (!empty($ementorId)) {
                $query->where('user_id', $ementorId);
            }
        }
        // if role is superadmin, skip both conditions

        $query->where('exam_remark', '1')
            ->where('is_deleted', 'No');

        return $query->get()->toArray();
    }


      

}