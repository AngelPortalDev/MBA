<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect, DB};

class EmentorProfile extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'ementor_profile_master';
    protected $primaryKey = 'ementor_profile_id';
    protected $fillable = [
        'ementor_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ementor_id', 'id');
    }
    public function CourseModule()
    {
        return $this->hasMany(CourseModule::class, 'ementor_id','ementor_id');
    }
    public function OrderModule()
    {
        return $this->hasMany(OrderModel::class, 'instructor_id','ementor_id');
    }


    public function getEmentorProfile($where = [], $select = [])
    {
        $ementorData = [];
        if (Auth::check()) {
            $query = EmentorProfile::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'instructor');
            })
            ->with(['CourseModule' => function ($query) {
                $query->with(['OrderModule' => function ($orderQuery) {
                    $orderQuery->where('status', '0')
                    ->whereHas('user.studentDocument', function ($studentDocQuery) {
                        $studentDocQuery->where('identity_is_approved', 'Approved')
                                        ->where('edu_is_approved', 'Approved')
                                        ->where('english_score','>=','10')
                                        ->whereNotNull('resume_file');
                    })
                    ->whereHas('user.userData', function ($userDataQuery) {
                        $userDataQuery->where('is_active', 'Active');
                    })->with([
                        'user' => function ($userQuery) {
                            $userQuery->with([
                                'userData:id,name,last_name,photo',
                                'studentDocument:student_id,identity_is_approved' // Assuming studentDocument has a user_id column
                            ]);
                        }
                    ]);
                }])->withCount(['OrderModule as order_count' => function ($orderQuery) {
                    $orderQuery->where('status', '0')
                    ->whereHas('user.studentDocument', function ($studentDocQuery) {
                        $studentDocQuery->where('identity_is_approved', 'Approved')
                                        ->where('edu_is_approved', 'Approved')
                                        ->where('english_score','>=','10')
                                        ->whereNotNull('resume_file');
                    })
                    ->whereHas('user.userData', function ($userDataQuery) {
                        $userDataQuery->where('is_active', 'Active');
                    })->with([
                        'user' => function ($userQuery) {
                            $userQuery->with([
                                'userData:id,name,last_name,photo',
                                'studentDocument:student_id,identity_is_approved' // Assuming studentDocument has a user_id column
                            ]);
                        }
                    ]);
                }]);
            }]);
            // ->with(['OrderModule' => function ($query) {
            //     $query->where('status', '0')
            //         ->whereHas('user.studentDocument', function ($studentDocQuery) {
            //             $studentDocQuery->where('identity_is_approved', 'Approved')
            //                             ->where('edu_is_approved', 'Approved')
            //                             ->where('english_score','>=','10')
            //                             ->whereNotNull('resume_file');
            //         })
            //         ->whereHas('user.userData', function ($userDataQuery) {
            //             $userDataQuery->where('is_active', 'Active');
            //         })->with([
            //             'user' => function ($userQuery) {
            //                 $userQuery->with([
            //                     'userData:id,name,last_name,photo',
            //                     'studentDocument:student_id,identity_is_approved' // Assuming studentDocument has a user_id column
            //                 ]);
            //             }
            //         ]);
            // }]);
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $ementorData = $query->where($where)->where('ementor_profile_master.is_deleted','No')->orderBy('ementor_profile_id','desc')->get();
            } else {
                $ementorData = $query->where('ementor_profile_master.is_deleted','No')->orderBy('ementor_profile_id','desc')->get();
                // foreach($ementorData as $ementor){
                //     $ementor->enrolledStudentCount =
                // }
            }
            return $ementorData;
        }
    }
    
    public function getSubEmentorProfile($where = [], $select = [])
    {
        $ementorData = [];
        if (Auth::check()) {
            $query = EmentorProfile::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'sub-instructor');
            })
            ->with('CourseModule')
            ->with(['OrderModule' => function ($query) {
                $query->where('status', '0')
                    ->whereHas('user.studentDocument', function ($studentDocQuery) {
                        $studentDocQuery->where('identity_is_approved', 'Approved')
                                        ->where('edu_is_approved', 'Approved')
                                        ->where('english_score','>=','10')
                                        ->whereNotNull('resume_file');
                    })
                    ->whereHas('user.userData', function ($userDataQuery) {
                        $userDataQuery->where('is_active', 'Active');
                    })->with([
                        'user' => function ($userQuery) {
                            $userQuery->with([
                                'userData:id,name,last_name,photo',
                                'studentDocument:student_id,identity_is_approved'
                            ]);
                        }
                    ]);
            }]);
            $query->leftJoin('ementor_submentor_relations as relation', 'ementor_profile_master.ementor_id', '=', 'relation.sub_ementor_id')
            ->leftJoin('users as ementor', 'relation.ementor_id', '=', 'ementor.id')
            ->addSelect('ementor_profile_master.*', DB::raw("CONCAT(ementor.name, ' ', ementor.last_name) as ementorName"));
      
      
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $ementorData = $query->where($where)->where('ementor_profile_master.is_deleted','No')->orderBy('ementor_profile_id','desc')->get();
            } else {
                $ementorData = $query->where('ementor_profile_master.is_deleted','No')->orderBy('ementor_profile_id','desc')->get();
            }
            return $ementorData;
        }
    }

    public function getCurrentEmentorDocInfo($select = [])
    {
        if (Auth::check()) {
            $ementorId = isset(Auth::user()->id) ? Auth::user()->id : 0;
            $query = $this->with('user');
            $studentData =  $query->where(['ementor_id' => $ementorId])->first();
            return $studentData;
        }
    }


    


}