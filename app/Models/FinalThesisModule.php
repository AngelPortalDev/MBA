<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash, Http};
use Illuminate\Database\Eloquent\SoftDeletes;

class FinalThesisModule extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'exam_final_thesis';
    protected $guarded  = [];
    protected $visible  = ['id', 'title', 'instructions', 'marks', 'instrcution_file_url', 'instrcution_file_name', 'award_id', 'is_active', 'percentage',  'AwardCourse',  'finalThesisQuestion'];
    
    public function AwardCourse()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id')->where('category_id', 1);
    }

    public function finalThesisQuestion()
    {
        return $this->hasMany(FinalThesisQuestion::class,  'final_thesis_id')->where('is_deleted', 'No');
    }
 
    public function finalThesisExam()
    {
        return $this->belongsTo(ExamManage::class, 'exam_id', 'id')->where('exam_type', '=', 9);
    }
    
    public function getFinalThesisDetails($where = [], $select = [])
    {

        if (Auth::check()) {
            $query = $this->with(['AwardCourse' => function ($query) {
                $query->select('id', 'course_title');
            }])->with(['finalThesisQuestion' => function ($query) {
                $query->select('id', 'question', 'marks', 'final_thesis_id');
            }])->where('is_deleted', 'No')->orderByDesc('id');
            $finalThesisData = [];
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $finalThesisData = $query->where($where)->get()->toArray();
            } else {
                $finalThesisData = $query->get()->toArray();
            }
            return $finalThesisData;
        }
        return redirect('/login');
    }
}
