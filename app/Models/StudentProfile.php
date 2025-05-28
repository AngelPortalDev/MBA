<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect};
use Illuminate\Database\Eloquent\SoftDeletes;


class StudentProfile extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = false;
    public $table = 'student_profile_master';
    protected $primaryKey = 'student_profile_id';
    protected $fillable = [
        'student_id',
        'address',
        'city_id',
        'state_id',
        'country_id',
        'zip',
        'occupation',
        'gender',
        'dob',
        'nationality',
        'facebook',
        'instagram',
        'linkedIn',
        'twitter',
        'alt_mob_code',
        'alt_mob_number',
        'alt_email_id',
        'last_profile_update_on',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function Wishlist()
    {
        return $this->hasMany(WishlistModel::class, 'student_id','student_id')->where('is_deleted', 'No')->where('status','Active');
    }
    public function Orderlist()
    {
        return $this->hasMany(OrderModel::class, 'user_id','student_id');
    }

    public function Paymentlist()
    {
        return $this->hasMany(PaymentModel::class, 'user_id','student_id');
    }
    

    
    public function getUserProfile($where = [], $select = [])
    {
        if (Auth::check()) {
            $query = StudentProfile::with('user')->with(['orderlist' => function ($query) {
                $query->where('status', '0')->orderBy('id','DESC');
            }])->with(['paymentlist' => function ($query) {
                $query->where('status', '0');
            }]);
            $studentData = [];
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $studentData = $query->where($where)->first();
            } else {
                $studentData = $query->orderBy('student_id','DESC')->get();
            }
            return $studentData;
        }
    }
    public function getCurrentUserProfile($select = [])
    {

        if (Auth::check()) {
            $studentId = isset(Auth::user()->id) ? Auth::user()->id : 0;
            $query = StudentProfile::with('user');
            // if (isset($select) && count($select) > 0 && is_array($select)) {
            //     $query->select($select);
            // }
            $studentData =  $query->where(['student_id' => $studentId])->first();
            return $studentData;
        }
    }




    public function getStudentLearning($where)
    {
        if (Auth::check()) {
            $studentId = isset(Auth::user()->id) ? Auth::user()->id : 0;
            $query = StudentProfile::with('wishlist')->with('orderlist');
            $CourseData = $query->where($where)->get()->toArray();
            return $CourseData;
        }
        return redirect('/login');
    }
}