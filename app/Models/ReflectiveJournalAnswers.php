<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReflectiveJournalAnswers extends Model
{
    use HasFactory;
    public $table = 'exam_reflective_journal_answers';
    protected $guarded  = [];

    public function AwardCourse()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id')->where('category_id', 1);
    }

    public function reflectiveJournalQuestion()
    {
        return $this->hasMany(ReflectiveJournalQuestion::class,  'id', 'question_id')->where('is_deleted', 'No');
    }
}
