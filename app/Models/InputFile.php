<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputFile extends Model
{
    use HasFactory;
    public $table = 'exam_input_files';
    protected $guarded  = [];

    public function surveyQuestion()
    {
        return $this->belongsTo(SurveyQuestion::class, 'question_id', 'id')
                    ->where('exam_type', 8);
    }

    public function inputConfigurations()
    {
        return $this->hasOne(InputConfiguration::class, 'id', 'input_id');
    }
}
