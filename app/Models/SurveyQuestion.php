<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyQuestion extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    public $table = 'exam_survey_questions';
    protected $guarded  = [];
    protected $visible  = ['id', 'survey_id', 'question', 'marks', 'answer_limit',  'status', 'surveyAnswers', 'inputConfigurations', 'inputFiles'];

    public function surveyAnswers()
    {
        return $this->hasMany(SurveyAnswers::class,  'question_id');
    }

    public function inputConfigurations()
    {
        return $this->hasMany(InputConfiguration::class, 'question_id', 'id')
                    ->where(['exam_type' => 8, 'is_deleted' => 'No']);
    }
    
    public function inputFiles()
    {
        return $this->hasMany(InputFile::class, 'question_id', 'id')
                    ->where(['exam_type' => 8, 'is_active' => '1']);
    }
}
