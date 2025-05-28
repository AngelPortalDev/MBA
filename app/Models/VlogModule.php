<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash, Http};
use Illuminate\Database\Eloquent\SoftDeletes;

class VlogModule extends Model
{
    use HasFactory, SoftDeletes;
    
    public $timestamps = false;
    public $table = 'exam_vlog';
    protected $guarded  = [];
    protected $visible  = ['id', 'title', 'instructions', 'instrcution_file_url', 'instrcution_file_name', 'award_id', 'is_active',  'AwardCourse', 'percentage', 'vlogQuestion'];


    public function AwardCourse()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id')->where('category_id', 1);
    }

    public function vlogQuestion()
    {
        return $this->hasMany(VlogQuestion::class,  'vlog_id')->where('is_deleted', 'No');
    }

    public function vlogExam()
    {
        return $this->belongsTo(ExamManage::class, 'exam_id', 'id')->where('exam_type', '=', 3);
    }

    public function getVlogDetails($where = [], $select = [])
    {
        $vlogData = [];
        $query = $this->with(['AwardCourse' => function ($q) {
            $q->select('id', 'course_title');
        }])->with(['vlogQuestion' => function ($query) {
            $query->select('id', 'question', 'marks', 'vlog_id');
        }])->where('is_deleted', 'No')->orderByDesc('id');
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $vlogData = $query->where($where)->get()->toArray();
        } else {
            $vlogData = $query->where('is_deleted', 'No')->get()->toArray();
        }
        return $vlogData;
    }

    // public function getMockQuestion($where = [], $select = [])
    // {

    //     $query = $this->with(['AwardCourse' => function ($query) {
    //         $query->select('id', 'course_title');
    //     }])->with(['mockQuestion' => function ($query) {
    //         $query->select('id', 'question', 'marks', 'mock_intr_id');
    //     }])->where('is_deleted', 'No')->orderByDesc('id');
    //     $MockData = [];
    //     if (isset($where) && count($where) > 0 && is_array($where)) {
    //         $MockData = $query->where($where)->get()->toArray();
    //     } else {
    //         $MockData = $query->get()->toArray();
    //     }
    //     return $MockData;
    // }
}
