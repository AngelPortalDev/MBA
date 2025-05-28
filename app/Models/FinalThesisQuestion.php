<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinalThesisQuestion extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    public $table = 'exam_final_thesis_questions';
    protected $guarded  = [];
    protected $visible  = ['id', 'final_thesis_id', 'question', 'marks', 'answer_limit',  'status', 'finalThesisAnswers'];

    public function finalThesisAnswers()
    {
        return $this->hasMany(FinalThesisAnswers::class,  'question_id');
    }
}
