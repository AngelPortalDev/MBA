<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MockExam extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    public $table = 'exam_mock_interview';
    protected $guarded  = [];
    protected $visible  = ['id', 'title', 'instructions', 'award_id', 'instrcution_file_url', 'instrcution_file_name', 'is_active',  'AwardCourse', 'percentage', 'mockQuestion', 'requires_word_count'];


    public function AwardCourse()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id')->where('category_id', 1);
    }

    public function mockQuestion()
    {
        return $this->hasMany(MockExamQuestion::class,  'mock_intr_id')->where('is_deleted', 'No');
    }

 

    public function getMockDetails($where = [], $select = [])
    {
        $MockData = [];
        $query = $this->with(['AwardCourse' => function ($q) {
            $q->select('id', 'course_title');
        }])->orderByDesc('id');
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $MockData = $query->where($where)->get()->toArray();
        } else {
            $MockData = $query->where('is_deleted', 'No')->get()->toArray();
        }
        return $MockData;
    }
    public function getMockQuestion($where = [], $select = [])
    {

        $query = $this->with(['AwardCourse' => function ($query) {
            $query->select('id', 'course_title');
        }])->with(['mockQuestion' => function ($query) {
            $query->select('id', 'question', 'marks', 'mock_intr_id');
        }])->where('is_deleted', 'No')->orderByDesc('id');
        $MockData = [];
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $MockData = $query->where($where)->get()->toArray();
        } else {
            $MockData = $query->get()->toArray();
        }
        return $MockData;
    }
}