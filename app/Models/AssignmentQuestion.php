<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentQuestion extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    public $table = 'exam_assignment_questions';
    protected $guarded  = [];
    protected $visible  = ['id', 'assignments_id', 'question', 'assignment_mark', 'answer_limit',  'status', 'AssigAnwers'];
    public function AssigAnwers()
    {
        return $this->hasMany(AssignmentAnswers::class,  'question_id');
    }

}