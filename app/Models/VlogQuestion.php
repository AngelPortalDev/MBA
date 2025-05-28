<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VlogQuestion extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    public $table = 'exam_vlog_questions';
    protected $guarded  = [];
    protected $visible  = ['id', 'vlog_id', 'question', 'marks', 'answer_file_url', 'file_type', 'status', 'marks_given', 'vlogAnwers'];
    
    public function vlogAnwers()
    {
        return $this->hasMany(VlogAnswers::class,  'question_id');
    }
}
