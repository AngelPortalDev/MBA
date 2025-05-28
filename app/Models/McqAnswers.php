<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqAnswers extends Model
{
    use HasFactory;
    public $table = 'exam_mcq_answers';
    protected $guarded  = [];

    public function AwardCourse()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id')->where('category_id', 1);
    }

    public function mcqQuestion()
    {
        return $this->hasMany(McqQuestion::class,  'id', 'question_id')->where('is_deleted', 'No');
    }
}
