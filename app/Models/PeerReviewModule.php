<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash, Http};
use Illuminate\Database\Eloquent\SoftDeletes;

class PeerReviewModule extends Model
{
    use HasFactory, SoftDeletes;
    
    public $timestamps = false;
    public $table = 'exam_peer_review';
    protected $guarded  = [];
    protected $visible  = ['id', 'title', 'instructions', 'instrcution_file_url', 'instrcution_file_name', 'award_id', 'is_active',  'AwardCourse', 'percentage'];
    
    public function AwardCourse()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id')->where('category_id', 1);
    }

    // public function vlogExam()
    // {
    //     return $this->belongsTo(ExamManage::class, 'exam_id', 'id')->where('exam_type', '=', 3);
    // }
    
    public function getPeerReviewDetails($where = [], $select = [])
    {
        $peerReviewData = [];
        $query = $this->with(['AwardCourse' => function ($q) {
            $q->select('id', 'course_title');
        }])->where('is_deleted', 'No')->orderByDesc('id');
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $peerReviewData = $query->where($where)->get()->toArray();
        } else {
            $peerReviewData = $query->where('is_deleted', 'No')->get()->toArray();
        }
        return $peerReviewData;
    }

}
