<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Redirect, Validator, Storage, DB, Hash, Http};
use Illuminate\Database\Eloquent\SoftDeletes;

class ReflectiveJournalModule extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'exam_reflective_journals';
    protected $guarded  = [];
    protected $visible  = ['id', 'title', 'instructions', 'marks', 'instrcution_file_url', 'instrcution_file_name', 'award_id', 'is_active', 'percentage',  'AwardCourse',  'reflectiveJournalQuestion'];
    
    // protected $dates = ['deleted_at'];
    

    public function AwardCourse()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id')->where('category_id', 1);
    }

    public function reflectiveJournalQuestion()
    {
        return $this->hasMany(ReflectiveJournalQuestion::class,  'reflective_journal_id')->where('is_deleted', 'No');
    }
 
    public function reflectiveJournalExam()
    {
        return $this->belongsTo(ExamManage::class, 'exam_id', 'id')->where('exam_type', '=', 6);
    }

    public function getReflectiveJournalDetails($where = [], $select = [])
    {

        if (Auth::check()) {
            $query = $this->with(['AwardCourse' => function ($query) {
                $query->select('id', 'course_title');
            }])->with(['reflectiveJournalQuestion' => function ($query) {
                $query->select('id', 'question', 'marks', 'reflective_journal_id');
            }])->where('is_deleted', 'No')->orderByDesc('id');
            $reflectiveJournalData = [];
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $reflectiveJournalData = $query->where($where)->get()->toArray();
            } else {
                $reflectiveJournalData = $query->get()->toArray();
            }
            return $reflectiveJournalData;
        }
        return redirect('/login');
    }
    public function getReflectiveJournalQuestion($where = [])
    {
        $reflectiveJournalData = [];
        if (Auth::check()) {
            $query = $this->with(['AwardCourse' => function ($query) {
                $query->select('id', 'course_title');
            }])->with(['reflectiveJournalQuestion' => function ($query) {
                $query->select('id', 'question', 'marks', 'reflective_journal_id');
            }])->where('is_deleted', 'No')->orderByDesc('id');
           
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $reflectiveJournalData = $query->where($where)->get()->toArray();
            } else {
                $reflectiveJournalData = $query->get()->toArray();
            }
            return $reflectiveJournalData;
        }
        return redirect('/login');
    }
}
