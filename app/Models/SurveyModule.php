<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash, Http};
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyModule extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'exam_survey';
    protected $guarded  = [];
    protected $visible  = ['id', 'title', 'instructions', 'marks', 'instrcution_file_url', 'instrcution_file_name', 'award_id', 'is_active', 'percentage',  'AwardCourse',  'surveyQuestion'];
    
    public function AwardCourse()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id')->where('category_id', 1);
    }

    public function surveyQuestion()
    {
        return $this->hasMany(SurveyQuestion::class,  'survey_id')->where('is_deleted', 'No');
    }
 
    public function surveyExam()
    {
        return $this->belongsTo(ExamManage::class, 'exam_id', 'id')->where('exam_type', '=', 8);
    }

    public function getSurveyDetails($where = [], $select = [])
    {

        if (Auth::check()) {
            $query = $this->with(['AwardCourse' => function ($query) {
                $query->select('id', 'course_title');
            }])->with(['surveyQuestion' => function ($query) {
                $query->select('id', 'question', 'marks', 'survey_id');
            }])->where('is_deleted', 'No')->orderByDesc('id');
            $surveyData = [];
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $surveyData = $query->where($where)->get()->toArray();
            } else {
                $surveyData = $query->get()->toArray();
            }
            return $surveyData;
        }
        return redirect('/login');
    }
    public function getSurveyQuestion($where = [])
    {
        $surveyData = [];
        if (Auth::check()) {
            $query = $this->with(['AwardCourse' => function ($query) {
                $query->select('id', 'course_title');
            }])->with(['surveyQuestion' => function ($query) {
                $query->select('id', 'question', 'marks', 'survey_id');
            }])->where('is_deleted', 'No')->orderByDesc('id');
           
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $surveyData = $query->where($where)->get()->toArray();
            } else {
                $surveyData = $query->get()->toArray();
            }
            return $surveyData;
        }
        return redirect('/login');
    }
}
