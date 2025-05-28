<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentAnswers extends Model
{
    use HasFactory;
    public $table = 'exam_assignment_answers';
    protected $guarded  = [];

    public function AwardCourse()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id')->where('category_id', 1);
    }

    public function AssigQuestion()
    {
        return $this->hasMany(AssignmentQuestion::class,  'id', 'assign_question_id')->where('is_deleted', 'No');
    }
}
