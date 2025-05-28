<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseManagement extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'course_managment_master';
    protected $gaurded  = [];
    protected $visible  = ['Course', 'sections', 'OrientationVideo', 'is_deleted'];


    public function sections()
    {
        return $this->hasMany(SectionModel::class, 'id', 'section_id')->where('is_deleted', 'No');
    }
    public function Course()
    {
        return $this->hasMany(CourseModule::class, 'id', 'course_master_id');
    }

    public function masterCourseManage()
    {
        return $this->hasMany(MasterCourseManagement::class, 'course_id','course_master_id')->where('is_deleted', 'No')->orderBy('placement_id', 'ASC');
    }

    public function getCouresData($where = [], $select = [])
    {
        $query = $this->with(['Course' => function ($query) {
            $query->select('id', 'course_title');
        }])->with([
            'sections.SectionManage.courseVideo',
            'sections.SectionManage.CourseArticle',
            'sections.SectionManage.CourseQuiz'
        ])->where('is_deleted', 'No')->orderBy('placement_id', 'asc');
        $CourseData = [];
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $CourseData = $query->where($where)->get()->toArray();
        } else {
            $CourseData = $query->get()->toArray();
        }
        return $CourseData;
    }
}