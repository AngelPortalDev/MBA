<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseOtherDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'course_other_details';
    protected $guarded  = [];
    
    public function courseMaster()
    {
        return $this->belongsTo(CourseMaster::class, 'course_id', 'id');
    }

}
