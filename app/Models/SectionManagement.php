<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionManagement extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'section_managment_master';
    protected $guarded  = [];
    protected $visible  = ['section_id', 'content_id', 'content_type_id', 'placement_id', 'courseVideo', 'CourseArticle', 'CourseQuiz', 'course_video_count'];


    public function courseVideo()
    {
        return $this->hasMany(CourseVideoModule::class, 'id', 'content_id')->where('is_deleted', 'No');
    }
    public function CourseArticle()
    {
        return $this->hasMany(CourseDocs::class, 'id', 'content_id')->where('is_deleted', 'No');
    }
    public function CourseQuiz()
    {
        return $this->hasMany(QuizSection::class, 'id', 'content_id')->where('is_deleted', 'No');
    }


    public function getSectionContentVideo($where = [], $select = [])
    {
        $query = $this->with('courseVideo');
        $videosData = [];
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $videosData = $query->where($where)->OrderBy('placement_id','asc')->get()->toArray();
        } else {
            $videosData = $query->get()->toArray();
        }
        return $videosData;
    }
    

    

}