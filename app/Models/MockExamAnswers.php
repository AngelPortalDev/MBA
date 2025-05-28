<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockExamAnswers extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'exam_mock_answers';
    protected $guarded  = [];
}