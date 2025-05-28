<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth};
use App\Models\{AssignmentModule};

class QuizModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'exam_quiz_questions';
    protected $guarded  = [];


    public function Quizquestion()
    {
        return $this->belongsTo(AssignmentModule::class, 'quiz_id', 'id');
    }

    

    


    
}