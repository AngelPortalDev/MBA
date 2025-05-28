<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash, Http};
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtificialIntelligenceModule extends Model
{
    use HasFactory, SoftDeletes;
    
    public $table = 'exam_artificial_intelligence';
    protected $guarded  = [];
    protected $visible  = ['id', 'title', 'instructions', 'marks', 'instrcution_file_url', 'instrcution_file_name', 'award_id', 'is_active', 'percentage',  'AwardCourse',  'artificialIntelligenceQuestion'];
    

    public function AwardCourse()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id')->where('category_id', 1);
    }

    public function artificialIntelligenceQuestion()
    {
        return $this->hasMany(ArtificialIntelligenceQuestion::class,  'artificial_intelligence_id')->where('is_deleted', 'No');
    }
 
    public function artificialIntelligenceExam()
    {
        return $this->belongsTo(ExamManage::class, 'exam_id', 'id')->where('exam_type', '=', 9);
    }

    public function getArtificialIntelligenceDetails($where = [], $select = [])
    {
        if (Auth::check()) {
            $query = $this->with(['AwardCourse' => function ($query) {
                $query->select('id', 'course_title');
            }])->with(['artificialIntelligenceQuestion' => function ($query) {
                $query->select('id', 'question', 'marks', 'artificial_intelligence_id');
            }])->where('is_deleted', 'No')->orderByDesc('id');
            $artificialIntelligenceData = [];
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $artificialIntelligenceData = $query->where($where)->get()->toArray();
            } else {
                $artificialIntelligenceData = $query->get()->toArray();
            }
            return $artificialIntelligenceData;
        }
        return redirect('/login');
    }
    
    public function getArtificialIntelligenceQuestion($where = [])
    {
        $artificialIntelligenceData = [];
        if (Auth::check()) {
            $query = $this->with(['AwardCourse' => function ($query) {
                $query->select('id', 'course_title');
            }])->with(['artificialIntelligenceQuestion' => function ($query) {
                $query->select('id', 'question', 'marks', 'artificial_intelligence_id');
            }])->where('is_deleted', 'No')->orderByDesc('id');
           
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $artificialIntelligenceData = $query->where($where)->get()->toArray();
            } else {
                $artificialIntelligenceData = $query->get()->toArray();
            }
            return $artificialIntelligenceData;
        }
        return redirect('/login');
    }
}
