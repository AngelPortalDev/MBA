<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MockExamQuestion extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    public $table = 'exam_mock_questions';
    protected $guarded  = [];
    protected $visible  = ['id', 'mock_intr_id', 'question', 'marks', 'answer_file_url', 'file_type', 'status', 'marks_given', 'MockAnwers'];
    public function MockAnwers()
    {
        return $this->hasMany(MockExamAnswers::class,  'question_id');
    }
}