<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash, Http};
use Illuminate\Database\Eloquent\SoftDeletes;


class AssignmentModule extends Model
{

    use HasFactory, SoftDeletes;
    public $timestamps = false;
    public $table = 'exam_assignments';
    protected $guarded  = [];
    protected $visible  = ['id', 'assignment_tittle', 'instructions', 'award_id', 'is_active',  'AwardCourse', 'assignment_percentage', 'exam_duration', 'enable_exam_feedback', 'enable_draft_mode', 'AssigQuestion'];

    public function AwardCourse()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id')->where('category_id', 1);
    }

    public function AssigQuestion()
    {
        return $this->hasMany(AssignmentQuestion::class,  'assignments_id')->where('is_deleted', 'No');
    }
 
    public function assignmentExam()
    {
        return $this->belongsTo(ExamManage::class, 'exam_id', 'id')->where('exam_type', '=', 1);
    }

    public function getAssignmentDetails($where = [], $select = [])
    {

        if (Auth::check()) {
            $query = $this->with(['AwardCourse' => function ($query) {
                $query->select('id', 'course_title');
            }])->where('is_deleted', 'No')->orderByDesc('id');
            $AssignmentData = [];
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $AssignmentData = $query->where($where)->get()->toArray();
            } else {
                $AssignmentData = $query->get()->toArray();
            }
            return $AssignmentData;
        }
        return redirect('/login');
    }
    public function getAssignmentQuestion($where = [])
    {
        $AssignmentData = [];
        if (Auth::check()) {
            $query = $this->with(['AwardCourse' => function ($query) {
                $query->select('id', 'course_title');
            }])->with(['AssigQuestion' => function ($query) {
                $query->select('id', 'question', 'assignment_mark', 'assignments_id');
            }])->where('is_deleted', 'No')->orderByDesc('id');
           
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $AssignmentData = $query->where($where)->get()->toArray();
            } else {
                $AssignmentData = $query->get()->toArray();
            }
            return $AssignmentData;
        }
        return redirect('/login');
    }
}