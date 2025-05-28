<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseOtherVideo extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'course_other_videos';
    protected $guarded  = [];
}