<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth};
use App\Models\{CourseVideoModule, CourseDocs, CourseManagement,AssignmentModule};

class SectionModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'course_section_masters';
    protected $guarded  = [];
    protected $visible  = ['section_name', 'section_category', 'bn_collection_id','is_active','SectionManage','id'];


    public function CourseVideo()
    {
        return $this->hasMany(CourseVideoModule::class, 'section_id', 'id')->where('is_deleted', 'No');
    }

    public function CourseDocs()
    {
        return $this->hasMany(CourseDocs::class, 'section_id', 'id')->where('is_deleted', 'No');
    }

    public function QuizSection()
    {
        return $this->hasMany(AssignmentModule::class, 'section_id')->where('is_deleted', 'No');
    }
    public function SectionManage()
    {
        return $this->hasMany(SectionManagement::class, 'section_id')->orderBy('placement_id', 'ASC')->withCount('courseVideo')->where('is_deleted', 'No');
    }
    

    public function getSectionDetails($where = [], $select = [])
    {
        if (Auth::check()) {
            $query = $this->with(['CourseVideo', 'CourseDocs'])->WhereNotNull('is_active')->orderByDesc('id');
            $sectionData = [];
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $sectionData = $query->where($where)->get()->toArray();
            } else {
                $sectionData = $query->get()->toArray();
            }
            return $sectionData;
        }
        return redirect('/login');
    }
    public function getSectionSearch($where = [], $select = [])
    {
        $query = $this->select($select)->limit(5)->where(['is_deleted' => 'No'])->WhereNotNull('is_active')->orderBy('section_name', 'ASC');
        $sectionData = [];
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $sectionData = $query->where('section_name', 'LIKE', "%{$where['section_name']}%")->get()->toArray();
        } else {
            $sectionData = $query->get()->toArray();
        }
        return $sectionData;
    }
}