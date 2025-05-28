<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputConfiguration extends Model
{
    use HasFactory;
    public $table = 'exam_input_configurations';
    protected $guarded  = [];

    public function surveyQuestion()
    {
        return $this->belongsTo(SurveyQuestion::class, 'question_id', 'id')
                    ->where('exam_type', 8);
    }
}
