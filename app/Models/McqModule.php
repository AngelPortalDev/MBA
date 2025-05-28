<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash, Http};
use Illuminate\Database\Eloquent\SoftDeletes;

class McqModule extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'exam_mcq';
    protected $guarded  = [];
    protected $visible  = ['id', 'title', 'award_id', 'exam_duration', 'is_active', 'percentage',  'AwardCourse',  'mcqQuestion'];
    
    public function AwardCourse()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id')->where('category_id', 1);
    }

    public function mcqQuestion()
    {
        return $this->hasMany(McqQuestion::class, 'mcq_id')->where('is_deleted', 'No');
    }
    
    public function getMcqDetails($where = [], $select = [])
    {

        if (Auth::check()) {
            $query = $this->with(['AwardCourse' => function ($query) {
                $query->select('id', 'course_title');
            }])->with(['mcqQuestion' => function ($query) {
                $query->select('id', 'question', 'answer', 'option1', 'option2', 'option3', 'option4', 'mark', 'mcq_id');
            }])->where('is_deleted', 'No')->orderByDesc('id');
            $mcqData = [];
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $mcqData = $query->where($where)->get()->toArray();
            } else {
                $mcqData = $query->get()->toArray();
            }
            return $mcqData;
        }
        return redirect('/login');
    }
}
