<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VlogAnswers extends Model
{
    use HasFactory;
    public $table = 'exam_vlog_answers';
    protected $guarded  = [];
}
