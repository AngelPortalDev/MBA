<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSection extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'exam_quiz';
    protected $guarded  = [];

    public function QuizQuestion()
    {
        return $this->hasMany(QuizModel::class, 'quiz_id')->where('is_deleted', 'No');
    }

    public function sections()
    {
        return $this->hasMany(SectionModel::class, 'id', 'section_id')->where('is_deleted', 'No');
    }

    public function getQuizDetails($where = [], $select = [])
    {
        $query = $this->with('QuizQuestion')->with('sections')->orderByDesc('id');
        $quizData = [];
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $quizData = $query->where($where)->get()->toArray();
        } else {
            $quizData = $query->get()->toArray();
        }
        return $quizData;
    }

}