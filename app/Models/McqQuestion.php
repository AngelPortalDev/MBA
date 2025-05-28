<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class McqQuestion extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    public $table = 'exam_mcq_questions';
    protected $guarded  = [];
    protected $visible  = ['id', 'question', 'mcq_id', 'option1', 'option2', 'option3', 'option4', 'answer', 'mark', 'status', 'mcqAnswers'];

    public function mcqAnswers()
    {
        return $this->hasMany(McqAnswers::class,  'question_id');
    }
}
