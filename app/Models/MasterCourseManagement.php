<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, DB};
use App\Models\StudentCourseModel;


class MasterCourseManagement extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'master_course_management';
    protected $gaurded  = [];


    public function courseModules()
    {
        return $this->hasMany(CourseModule::class, 'id', 'course_id');
    }
    public function optionalCourseModules()
    {
        return $this->hasMany(CourseModule::class, 'id', 'optional_course_id');
    }
    public function courseManage()
    {
        return $this->hasMany(CourseManagement::class, 'course_master_id', 'course_id')->orderBy('placement_id', 'ASC')->where('is_deleted', 'No');
    }

    public function optionalCourseManage()
    {
        return $this->hasMany(CourseManagement::class, 'course_master_id', 'optional_course_id')->orderBy('placement_id', 'ASC')->where('is_deleted', 'No');
    }

    public function Courses()
    {
        return $this->hasOne(CourseModule::class, 'id', 'award_id');
    }
    public function getMasterCouresData($where = [], $select = [])
    {
        $preference_id = [];
        $preference_status = '1';

        if(Auth::check() && Auth()->user()->role == 'user'){
            $id = $where['award_id'];  // This will get the value 18
            $studentCourseMaster = StudentCourseModel::select('preference_status', 'preference_id')
            ->where('course_id', $id)
            ->where('preference_status', '0')
            ->where('user_id', Auth::user()->id)
            ->first();
            $preference_id = $studentCourseMaster ? $studentCourseMaster->preference_id : []; // Ensure it's an array 
            $preference_status =  $studentCourseMaster->preference_status ?? '1';
            if(!empty($preference_id)){
                $preference_id = explode(",", $preference_id);
            }
        }else if(Auth::check() && (Auth()->user()->role == 'admin' || Auth()->user()->role == 'superadmin' || Auth()->user()->role == 'sales')){
            $id = $where['award_id'];  // This will get the value 18
            $studentCourseMaster = MasterCourseManagement::where('award_id', $id)
                ->where('is_deleted', 'No')
                ->whereNotNull('optional_course_id')
                ->pluck('optional_course_id'); // Returns a collection
            
            $preference_id = $studentCourseMaster->implode(',');
            if (!empty($preference_id)) {
                $preference_id = explode(',', $preference_id);
            }
        }

        $query = $this->with([
            'coursemodules' => function ($query) {
                $query->select('id', 'course_title', 'ects', 'total_learning'); // Ensure 'total_learning' is the correct column name
            },
            'optionalcoursemodules' => function ($query) {
                $query->select('id', 'course_title', 'ects', 'total_learning'); // Ensure 'total_learning' is the correct column name
            },
            'CourseManage.sections.SectionManage.courseVideo',
            'CourseManage.sections.SectionManage.CourseArticle',
            'CourseManage.sections.SectionManage.CourseQuiz',
            'optionalCourseManage.sections.SectionManage.courseVideo',
            'optionalCourseManage.sections.SectionManage.CourseArticle',
            'optionalCourseManage.sections.SectionManage.CourseQuiz',
        ])->where('is_deleted', 'No')->orderBy('placement_id','ASC');
        $CourseData = [];
        if (!empty($where) && is_array($where)) {
            $CourseData = $query->where($where)->get()->map(function ($course) use ($preference_id, $preference_status) {
                if ($course->CourseManage->isEmpty() && $course->optionalCourseManage->isNotEmpty()) {
                    $course->setRelation('CourseManage', $course->optionalCourseManage);
                }
                // Replace coursemodules with optionalcoursemodules if coursemodules is empty
                if ($course->coursemodules->isEmpty() && $course->optionalcoursemodules->isNotEmpty()) {
                    $course->setRelation('coursemodules', $course->optionalcoursemodules);
                }
                unset($course->optionalcoursemodules);
                unset($course->optionalCourseManage);
                return $course; // If no `masterCourseManage`, return the course as-is
            });
               // Separate courses with `course_id` and `optional_course_id`
            $courseIdData = $CourseData->filter(function ($course) {
                return !empty($course->course_id); // Get all courses with `course_id`
            });
            $optionalCourseIdData = $CourseData->filter(function ($course) use ($preference_id) {
                return !empty($course->optional_course_id) && in_array($course->optional_course_id, $preference_id); // Filter by preference_id
            });
            // Combine the two datasets
            $CourseData = $courseIdData->merge($optionalCourseIdData);
            $CourseData = $CourseData->sortBy(function ($course) {
                $courseSort = !empty($course->course_id) ? 0 : 1; // Non-empty `course_id` gets priority (0)
                $placementSort = $course->placement_id;
                $optionalSort = !empty($course->optional_course_id) ? 0 : 1; // If no `optional_course_id`, push it to the end
                return [$courseSort, $placementSort, $optionalSort];
            });

            return $CourseData->values()->toArray(); // Reset array keys before returning
         
        } else {
            $CourseData = $query->get()->toArray();
        }
    }

    

}   