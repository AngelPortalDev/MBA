<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReflectiveJournalQuestion extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    public $table = 'exam_reflective_journal_questions';
    protected $guarded  = [];
    protected $visible  = ['id', 'reflective_journal_id', 'question', 'marks', 'answer_limit',  'status', 'reflectiveJournalAnswers'];

    public function reflectiveJournalAnswers()
    {
        return $this->hasMany(ReflectiveJournalAnswers::class,  'question_id');
    }
}
