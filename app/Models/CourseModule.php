<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, DB};
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Stream;
use GuzzleHttp\Psr7\Utils;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StudentCourseModel;

class CourseModule extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = false;
    public $table = 'course_master';
    protected $guarded  = [];

    protected $client;
    protected $headers;
    public function __construct()
    {
        parent::__construct();
        $this->client = new Client([
            'timeout'  => 3000, // 10 minutes
            'max_connections' => 15,
            'connect_timeout' => 300,
        ]);
        $this->master_library_id = env('MASTER_LIBRARY_ID');
        $this->award_library_id = env('AWARD_LIBRARY_ID');
        $this->student_library_id = env('Student_LIBRARY_ID');
        $this->headers_master_lib = [
            'AccessKey' => env('MASTER_LIBRARY_KEY'),
            'Content-Type' => 'application/json'
        ];
        $this->headers_award_lib = [
            'AccessKey' => env('AWARD_LIBRARY_KEY'),
            'Content-Type' => 'application/json'
        ];
        $this->headers_student = [
            'AccessKey' => env('Student_LIBRARY_KEY'),
            'Content-Type' => 'application/json'
        ];
    }
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($course) {
            $course->deleteCourseData($course->id);
        });
    }

    public function deleteCourseData($course_id){
        $course =  CourseModule::where('id',$course_id)->first();
        if ($course) {
            // Soft delete the associated CourseData
            $course->CourseData()->delete();
        }
    }
    public function courseData()
    {
        return $this->hasOne(CourseModule::class, 'id');
    }

    public function examStatus()
    {
        return $this->hasMany(ExamRemarkMaster::class, 'course_id');
    }
    public function Ementor()
    {
        return $this->belongsTo(User::class, 'ementor_id', 'id');
    }
    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function CourseManage()
    {
        return $this->hasMany(CourseManagement::class, 'course_master_id')->orderBy('placement_id', 'ASC')->where('is_deleted', 'No');
    }

    public function OtherVideo()
    {
        return $this->hasMany(CourseOtherVideo::class, 'course_master_id');
    }
    public function assginmentStatus()
    {
        return $this->hasMany(ExamRemarkMaster::class, 'course_id')->where('exam_type', 1);
    }
    public function mockExamStatus()
    {
        return $this->hasMany(ExamRemarkMaster::class, 'course_id')->where('exam_type', 2);
    }
    
    public function vlogStatus()
    {
        return $this->hasMany(ExamRemarkMaster::class, 'course_id')->where('exam_type', 3);
    }
    public function peerReviewStatus()
    {
        return $this->hasMany(ExamRemarkMaster::class, 'course_id')->where('exam_type', 4);
    }
    public function discordStatus()
    {
        return $this->hasMany(ExamRemarkMaster::class, 'course_id')->where('exam_type', 5);
    }
    public function OrderModule()
    {
        return $this->hasMany(OrderModel::class, 'course_id','id');
    }
    public function otherDetail()
    {
        return $this->hasOne(CourseOtherDetail::class, 'course_id', 'id');
    }
    public function reflectiveJournalStatus()
    {
        return $this->hasMany(ExamRemarkMaster::class, 'course_id')->where('exam_type', 6);
    }
    public function mcqStatus()
    {
        return $this->hasMany(ExamRemarkMaster::class, 'course_id')->where('exam_type', 7);
    }
    public function surveyStatus()
    {
        return $this->hasMany(ExamRemarkMaster::class, 'course_id')->where('exam_type', 8);
    }
    public function artificialIntelligenceStatus()
    {
        return $this->hasMany(ExamRemarkMaster::class, 'course_id')->where('exam_type', 9);
    }

    public function masterCourseManage()
    {
        return $this->hasMany(MasterCourseManagement::class, 'award_id')->where('is_deleted', 'No');
    }
    public function getCouresDetailsExportList($where = [], $select = [])
    {
       
        $query = $this->select('id', 'category_id', 'course_title','status','published_on','ementor_id','created_at')->with(['Ementor' => function ($query) {
            $query->select('id', 'name', 'last_name');
        }]);



        if (isset($where['start_date']) && isset($where['end_date'])) {
            $query->whereBetween('created_at', [$where['start_date'][2], $where['end_date'][2]]);
        }

        $CourseData = $query->where('category_id','1')->get()->toArray();

        return $CourseData;
    }

    public function getCouresDetails($where = [], $select = [],$offset=[],$limit=[],$searchValue=[])
    {      

        $query = $this->select('id', 'category_id', 'course_title', 'course_subheading', 'course_specialization', 'mqfeqf_level', 'ects', 'total_modules', 'total_lectures', 'total_learning', 'duration_month', 'full_time_duration_month','certificate_id', 'course_final_price', 'scholarship', 'course_old_price', 'overview', 'programme_outcomes', 'assessment', 'entry_requirements', 'course_thumbnail_file', 'bn_course_trailer_url', 'course_podcast_name', 'about_module', 'description', 'ementor_id', 'lecturer_id', 'bn_module_name', 'status', 'created_at', 'thumbnail_file_name', 'course_trailer_file_name', 'trailer_thumbnail_file_name', 'trailer_thumbnail_file', 'podcast_thumbnail_file_name', 'podcast_thumbnail_file', 'course_cuttoff_perc', 'temp_count','progress_tab')->with(['Ementor' => function ($query) {
            $query->select('id', 'name', 'last_name','photo');
        }])->with('Category')->with(['CourseManage.sections' => function ($query) {
            $query->select('id', 'section_name');
        }])->with(['OtherVideo' => function ($query) {
            $query->select('course_master_id', 'video_title', 'video_type', 'bn_video_url_id','video_file_name');
        }])->with([
            'CourseManage.sections.SectionManage.courseVideo',
            'CourseManage.sections.SectionManage.CourseArticle',
            'CourseManage.sections.SectionManage.CourseQuiz'
        ])->with(['otherDetail' => function ($query) {
            $query->select('course_id', 'discord_joining_link', 'discord_channel_link');
        }]);
        $CourseData = [];
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orwhere('course_title', 'LIKE', "%$searchValue%")
                ->orWhereHas('Ementor', function ($q) use ($searchValue) {
                    $q->where('name', 'LIKE', "%$searchValue%");
                    $q->orwhere('last_name', 'LIKE', "%$searchValue%");
                })
                ->orWhereHas('Category', function ($q) use ($searchValue) {
                    $q->where('category_name', 'LIKE', "%$searchValue%");
                });
            });
        }
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $CourseData['count'] = $query->where($where)->count();
            if(!empty($limit)){
                $CourseData['data'] = $query->where($where)->skip($offset)->take($limit)->get();
            }else{
                $CourseData['data'] = $query->where($where)->get()->toArray();
            }
        } else {
            $CourseData['count'] = $query->count();
            if(!empty($limit)){
                $CourseData['data'] = $query->skip($offset)->take($limit)->get();
            }else{
                $CourseData['data'] = $query->get()->toArray();
            }
        }

        return $CourseData;
    } 
    public function getMasterCouresDetails($where = [], $select = [])
    {
        $preference_id = [];
        $preference_status = '1';
        if(Auth::check() && Auth()->user()->role == 'user'){
            $id = $where['id'];  // This will get the value 18
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
        }
       
        $query = $this->select(
            'id', 'category_id', 'course_title', 'course_subheading', 'course_specialization', 
            'mqfeqf_level', 'ects', 'total_modules', 'total_lectures', 'total_learning', 'duration_month',
            'certificate_id', 'course_final_price', 'scholarship', 'course_old_price', 'overview', 
            'programme_outcomes', 'assessment', 'entry_requirements', 'course_thumbnail_file', 
            'bn_course_trailer_url', 'course_podcast_name', 'about_module', 'description', 'ementor_id', 
            'lecturer_id', 'bn_module_name', 'status', 'created_at', 'thumbnail_file_name', 'course_trailer_file_name', 
            'trailer_thumbnail_file_name', 'trailer_thumbnail_file', 'podcast_thumbnail_file_name', 
            'podcast_thumbnail_file', 'course_cuttoff_perc', 'temp_count','progress_tab','full_time_duration_month'
        )
        ->with([
            'Ementor' => function ($query) {
                $query->select('id', 'name', 'last_name', 'photo');
            },
            'Category',
            'masterCourseManage' => function ($query) {
                $query->select('award_id', 'course_id', 'optional_course_id','placement_id')->orderBy('placement_id','ASC');
            },
            'masterCourseManage.courseModules' => function ($query) {
                $query->select('course_title', 'id', 'ects', 'total_learning');
            },
            'masterCourseManage.optionalCourseModules' => function ($query) {
                $query->select('course_title', 'id', 'ects', 'total_learning');
            },
            'masterCourseManage.CourseManage.sections' => function ($query) {
                $query->select('id', 'section_name');
            },
            'masterCourseManage.optionalCourseManage.sections' => function ($query) {
                $query->select('id', 'section_name');
            },
            'OtherVideo' => function ($query) {
                $query->select('course_master_id', 'video_title', 'video_type', 'bn_video_url_id', 'video_file_name');
            },
            'masterCourseManage.CourseManage.sections.SectionManage.courseVideo',
            'masterCourseManage.CourseManage.sections.SectionManage.CourseArticle',
            'masterCourseManage.CourseManage.sections.SectionManage.CourseQuiz',
            'otherDetail' => function ($query) {
                $query->select('course_id', 'discord_joining_link', 'discord_channel_link');
            }
        ]);
        // Applying the 'where' filter if provided
            $CourseData = [];
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $CourseData = $query->where($where)->get()->map(function ($course) use ($preference_id,$preference_status) {

                    $masterCourseManage = $course->masterCourseManage;
                    $course->preference_id_optional = !empty($preference_id) ? $preference_id : null;
                    $course->preference_status = $preference_status ?? 0;
                    $masterCourseManage = $course->relationLoaded('masterCourseManage')  ? $masterCourseManage : collect([]);
                    // Process the masterCourseManage and filter with preference_id
                    
                    if ($masterCourseManage && $masterCourseManage->isNotEmpty()) {

                        // Replace empty primary relations with filtered optional relations based on preference_id
                        $replaceIfEmpty = function ($item, $primaryRelation, $optionalRelation, $preference_id) {
                            if ($item->$primaryRelation && $item->$primaryRelation->isEmpty()) {
                                if(!empty($optionalRelation)){
                                    if (!$item->relationLoaded($optionalRelation)) {
                                        $item->load($optionalRelation);
                                    }
                                
                                    if ($item->$optionalRelation && $item->$optionalRelation->isNotEmpty()) {
                                        $optionalCourseFilter = $item->$optionalRelation;
                                        $filteredModules = $optionalCourseFilter->filter(function ($module) use ($preference_id,$optionalRelation) {
                                            if(!empty($preference_id) ){
                                                if ($optionalRelation == "optionalCourseModules") {
                                                    return in_array($module->id, $preference_id);
                                                } else {
                                                    return in_array($module->course_master_id, $preference_id);
                                                }
                                            }
                                        });
                
                                        if (!empty($preference_id)) {
                                            $item->setRelation($primaryRelation, $filteredModules);
                                        } else {
                                            $item->setRelation($primaryRelation, $item->$optionalRelation);
                                        }
                                    }
                                }

                            }
                            unset($item->$optionalRelation);
                        };
                        
                        $sortedMasterCourseManage = $masterCourseManage->sortBy(function ($item) use ($preference_id) {
                            $courseSort = !empty($item->course_id) ? 0 : 1; // Non-empty `course_id` gets priority (0)
                            $placementSort = $item->placement_id;
                            $optionalSort = !empty($item->optional_course_id) ? 0 : 1; // If no `optional_course_id`, push it to the end
                            return [$courseSort, $placementSort, $optionalSort];
                        });
                        // Apply the filtering logic for each sorted item
                        $masterCourseManage->each(function ($item) use ($replaceIfEmpty, $preference_id) {
                            if($preference_id == ''){
                                $replaceIfEmpty($item, 'courseModules', '','');
                                $replaceIfEmpty($item, 'CourseManage', '', $preference_id);
                            }else{
                                $replaceIfEmpty($item, 'courseModules', 'optionalCourseModules', $preference_id);
                                $replaceIfEmpty($item, 'CourseManage', 'optionalCourseManage', $preference_id);
                            }
                        });

                        $course->setRelation('masterCourseManage', $sortedMasterCourseManage);

                        $course->sortedMasterCourseManage = $sortedMasterCourseManage;

                    }
            
                    return $course; // If no `masterCourseManage`, return the course as-is
                });
            } else {
                $CourseData = $query->get();
            }
            // echo "<pre>";
            // print_r($CourseData);die;
            return $CourseData;
    }
    
    public function getEmentorStudents1($where = [], $ementor)
    {
        $CourseData = [];
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $query = $this->select('id', 'category_id', 'course_title', 'status', 'created_at')
            ->with(['examStatus'])->with(['examStatus.examStudent' => function ($query) {
                $query->select('id', 'name', 'last_name', 'email', 'photo', 'created_at');
            }])->where('is_deleted', 'No')->WhereNotNull('status');

            $CourseData = $query->where($ementor)->get();
        }
        return $CourseData;
    }

    
    public function getEmentorStudents($where = [], $ementor)
    {
        $CourseData = [];
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $query = $this->select(
                    'course_master.id', 
                    'course_master.category_id', 
                    'course_master.course_title', 
                    'course_master.status', 
                    DB::raw("DATE_FORMAT(course_master.created_at, '%Y-%m-%d') as created_at"),
                    'exam_remark_master.user_id', 
                    'student_course_master.course_start_date',
                    'exam_remark_master.is_cheking_completed', 
                    'exam_students.name', 
                    'exam_remark_master.exam_type', 
                    'exam_students.last_name', 
                    'exam_students.email', 
                    'exam_students.photo', 
                    'exam_remark_master.id as exam_id', 
                    DB::raw("DATE_FORMAT(exam_students.created_at, '%Y-%m-%d') as exam_student_created_at")
                )
                ->join('exam_remark_master', 'course_master.id', '=', 'exam_remark_master.course_id')
                ->join('users as exam_students', 'exam_remark_master.user_id', '=', 'exam_students.id')
                ->join('student_course_master', function($join) {
                    $join->on('student_course_master.user_id', '=', 'exam_remark_master.user_id')
                        ->on('student_course_master.course_id', '=', 'course_master.id');
                })
                ->where('course_master.is_deleted', 'No') 
                ->orderBy('exam_remark_master.last_update_at', 'desc')
                ->whereNotNull('course_master.status');
        
            if (isset($where['is_cheking_completed'])) {
                $query->where('exam_remark_master.is_cheking_completed', $where['is_cheking_completed']);
                unset($where['is_cheking_completed']);
            }
        
            $query->where($ementor);

            if (!empty($where)) {
                foreach ($where as $column => $value) {
                    if ($column == 'is_deleted') {
                        $query->where('course_master.is_deleted', $value);
                    } else {
                        $query->where("course_master.$column", $value);
                    }
                }
            }
        
            $CourseData = $query->get();
        }
        return $CourseData;
        

    }
    
    
    // public function getEmentorCheckingStudents1($ementorId)
    // {
    //     $students = [];
    //     $courseIds = [];
    //     $studentCourseMasters = [];
        
    //     // $ementorId = isset(Auth::user()->id) ? Auth::user()->id : 0;

    //     $where = ['is_cheking_completed' => "1"];
    //     $ementorCourses = DB::table('course_master')->where('ementor_id', $ementorId)->get();
    //     if(count($ementorCourses)>0){
            
    //         foreach($ementorCourses as $ementorCourse) {
    //             $studentRecords = DB::table('exam_remark_master')->join('users', 'users.id', 'exam_remark_master.user_id')->where(['course_id' => $ementorCourse->id, 'is_cheking_completed' => '2', 'users.is_active' => 'Active'])
    //             ->orderBy('last_update_at', 'desc')->get()
    //             ->map(function ($record) {
    //                 $table = getExamTable($record->exam_type);
                    
    //                 if ($table === 'exam_discord') {
    //                     $record->exam_title = 'Forum Leadership';
    //                 } elseif ($table) {
    //                     $titleColumn = $table === 'exam_assignments' ? 'assignment_tittle' : 'title';
    //                     $titleRecord = DB::table($table)
    //                         ->where('id', $record->exam_id)
    //                         ->select($titleColumn)
    //                         ->first();
                        
    //                     $record->exam_title = $titleRecord ? html_entity_decode($titleRecord->$titleColumn) : 'No Title Found';
    //                 } else {
    //                     $record->exam_title = 'No Title Found';
    //                 }
            
    //                 return $record;
    //             });
    //             if ($studentRecords->isNotEmpty()) {
    //                 foreach ($studentRecords as $student) {
    //                     $students[] = $student; 
    //                     $courseIds[] = $student->course_id;
    //                 }
    //             }
    //         }
    //     }

    //     $courseIds = array_unique($courseIds);
    //     if(count($courseIds)>0){
    //         foreach($courseIds as $courseId){
    //             $records = DB::table('student_course_master')
    //                 ->where(['course_id' => $courseId, 'is_deleted' => 'No'])
    //                 ->whereNotNull('exam_remark')
    //                 ->get(['user_id', 'course_id', 'id'])
    //                 ->toArray();

    //             $studentCourseMasters = array_merge($studentCourseMasters, $records);
    //         }

    //     }
        

    //     $courseMastersLookup = [];
    //     foreach ($studentCourseMasters as $record) {
    //         $courseMastersLookup[$record->user_id . '_' . $record->course_id] = true;
    //     }

    //     $students = array_filter($students, function($student) use ($courseMastersLookup) {
    //         $key = $student->user_id . '_' . $student->course_id;
    //         return !isset($courseMastersLookup[$key]);
    //     });

    //     $students = array_values($students);

    //     $userIds = array_unique(array_column($students, 'user_id'));
    //     $courseIds = array_unique(array_column($students, 'course_id'));

    //     $userDetails = DB::table('users')->whereIn('id', $userIds)->get(['id', 'name', 'last_name'])->keyBy('id');
    //     $courseDetails = DB::table('course_master')->whereIn('id', $courseIds)->get(['id', 'course_title'])->keyBy('id');

    //     $courseStartDates = DB::table('student_course_master')
    //         ->whereIn('user_id', array_unique(array_column($students, 'user_id')))
    //         ->whereIn('course_id', array_unique(array_column($students, 'course_id')))
    //         ->get(['user_id', 'course_id', 'course_start_date'])
    //         ->keyBy(function($item) {
    //             return $item->user_id . '_' . $item->course_id;
    //         });

    //     $courseStartDateLookup = [];
    //     foreach ($courseStartDates as $record) {
    //         $courseStartDateLookup[$record->user_id . '_' . $record->course_id] = $record->course_start_date;
    //     }

    //     $courseData = array_map(function($student) use ($userDetails, $courseDetails, $courseStartDateLookup) {
    //         $key = $student->user_id . '_' . $student->course_id;
    //         return [
    //             'user_id' => $student->user_id,
    //             'id' => $student->course_id,
    //             'student_course_master_id' => $student->student_course_master_id,
    //             'exam_id' => $student->id,
    //             'exam_type' => $student->exam_type,
    //             'submitted_on' => $student->submitted_on,
    //             'final_score_obtain' => $student->final_score_obtain,
    //             'attempt_remain' => $student->attempt_remain,
    //             'final_remark' => $student->final_remark,
    //             'remark_updated_by' => $student->remark_updated_by,
    //             'is_cheking_completed' => $student->is_cheking_completed,
    //             'last_update_at' => $student->last_update_at,
    //             'created_at' => \Carbon\Carbon::parse($student->created_at)->format('Y-m-d'),
    //             'name' => $userDetails[$student->user_id]->name ?? null,
    //             'last_name' => $userDetails[$student->user_id]->last_name ?? null,
    //             'course_title' => $courseDetails[$student->course_id]->course_title ?? null,
    //             'course_start_date' => $courseStartDateLookup[$key] ?? null, 
    //             'exam_title' => $student->exam_title ?? '',
    //         ];
    //     }, $students);

    //     return $courseData;
        

    // }

    public function getEmentorCheckingStudents($ementorId)
    {
        $students = [];
        $courseIds = [];
        $studentCourseMasters = [];

        $role = Auth::user()->role;
        if ($role == 'sub-instructor') {
            $subEmentorId = Auth::user()->id;
            $subEmentorStudentRelations = DB::table('subementor_student_relations')
                ->where('sub_ementor_id', $subEmentorId)
                ->get(['student_id', 'course_id']);

            $studentIds = $subEmentorStudentRelations->pluck('student_id')->toArray();
            $courseIds = $subEmentorStudentRelations->pluck('course_id')->toArray();

            $ementorCourses = DB::table('course_master')
                ->whereIn('id', $courseIds)
                ->get();
        } else {
            $ementorCourses = DB::table('course_master')
                ->where('ementor_id', $ementorId)
                ->get();

            $subMentorIds = DB::table('ementor_submentor_relations')
                ->where('ementor_id', $ementorId)
                ->pluck('sub_ementor_id');

            $subEmentorStudentRelations = DB::table('subementor_student_relations')
                ->whereIn('sub_ementor_id', $subMentorIds)
                ->get(['student_id', 'course_id']);
            $studentIds = $subEmentorStudentRelations->pluck('student_id')->toArray();
            $courseIds = $subEmentorStudentRelations->pluck('course_id')->toArray();
        }

        if ($ementorCourses->isNotEmpty()) {
            foreach ($ementorCourses as $ementorCourse) {
                $studentRecords = DB::table('exam_remark_master')
                    ->join('users', 'users.id', '=', 'exam_remark_master.user_id');
                    if ($role == 'sub-instructor') {
                        $studentRecords->whereIn('users.id', array_column($subEmentorStudentRelations->where('course_id', $ementorCourse->id)->toArray(), 'student_id'));
                    }
                    $studentRecords = $studentRecords->where([
                        'course_id' => $ementorCourse->id,
                        'is_cheking_completed' => '2',
                        'exam_remark_master.is_active' => '1',
                        'users.is_active' => 'Active'
                    ])
                    ->orderBy('last_update_at', 'desc')
                    ->get()
                    ->map(function ($record) {
                        $table = getExamTable($record->exam_type);
                        $titleColumn = $table === 'exam_assignments' ? 'assignment_tittle' : 'title';

                        if ($table === 'exam_discord') {
                            $record->exam_title = 'Forum Leadership';
                        } elseif ($table) {
                            $titleRecord = DB::table($table)
                                ->where('id', $record->exam_id)
                                ->select($titleColumn)
                                ->first();
                            $record->exam_title = $titleRecord ? html_entity_decode($titleRecord->$titleColumn) : 'No Title Found';
                        } else {
                            $record->exam_title = 'No Title Found';
                        }

                        return $record;
                    });

                foreach ($studentRecords as $student) {
                    $students[] = $student;
                    $courseIds[] = $student->course_id;
                }
            }
        }

        $courseIds = array_unique($courseIds);
        if (!empty($courseIds)) {
            $studentCourseMasters = DB::table('student_course_master')
                ->whereIn('course_id', $courseIds)
                ->where('is_deleted', 'No')
                ->whereNotNull('exam_remark')
                ->get(['user_id', 'course_id', 'id'])
                ->toArray();
        }

        $courseMastersLookup = [];
        foreach ($studentCourseMasters as $record) {
            $courseMastersLookup[$record->user_id . '_' . $record->course_id] = true;
        }

        $students = array_filter($students, function($student) use ($courseMastersLookup) {
            return !isset($courseMastersLookup[$student->user_id . '_' . $student->course_id]);
        });

        $userIds = array_unique(array_column($students, 'user_id'));
        $courseIds = array_unique(array_column($students, 'course_id'));

        $userDetails = DB::table('users')->whereIn('id', $userIds)->get(['id', 'name', 'last_name','photo'])->keyBy('id');
        $courseDetails = DB::table('course_master')->whereIn('id', $courseIds)->get(['id', 'course_title'])->keyBy('id');

        $courseStartDates = DB::table('student_course_master')
            ->whereIn('user_id', $userIds)
            ->whereIn('course_id', $courseIds)
            ->get(['user_id', 'course_id', 'course_start_date'])
            ->keyBy(function($item) {
                return $item->user_id . '_' . $item->course_id;
            });

        return array_values(array_map(function($student) use ($userDetails, $courseDetails, $courseStartDates) {
            $key = $student->user_id . '_' . $student->course_id;
            return [
                'user_id' => $student->user_id,
                'id' => $student->course_id,
                'student_course_master_id' => $student->student_course_master_id,
                'exam_id' => $student->id,
                'exam_type' => $student->exam_type,
                'submitted_on' => $student->submitted_on,
                'final_score_obtain' => $student->final_score_obtain,
                'attempt_remain' => $student->attempt_remain,
                'final_remark' => $student->final_remark,
                'remark_updated_by' => $student->remark_updated_by,
                'is_cheking_completed' => $student->is_cheking_completed,
                'last_update_at' => $student->last_update_at,
                'created_at' => \Carbon\Carbon::parse($student->created_at)->format('Y-m-d'),
                'name' => $userDetails[$student->user_id]->name ?? null,
                'last_name' => $userDetails[$student->user_id]->last_name ?? null,
                'course_title' => $courseDetails[$student->course_id]->course_title ?? null,
                'course_start_date' => $courseStartDates[$key]->course_start_date ?? null,
                'exam_title' => $student->exam_title ?? '',
                'photo' => $userDetails[$student->user_id]->photo ?? null,
            ];
        }, $students));
    }

    public function getCollectionIdBn($CollectionName, $selectedLibrary)
    {
        if (isset($CollectionName) && !empty($CollectionName) && isset($selectedLibrary) && !empty($selectedLibrary) && is_numeric($selectedLibrary) && Auth::check()) {
            try {
                $libraryId = '';
                $headers = [];
                $content = [];
                if ($selectedLibrary === 1) {
                    $libraryId = $this->master_library_id;
                    $headers =  $this->headers_master_lib;
                } elseif ($selectedLibrary === 2) {
                    $libraryId = $this->award_library_id;
                    $headers =  $this->headers_award_lib;
                } else {
                    return FALSE;
                }
                $content['body'] = [
                    "name" => $CollectionName
                ];
                $data = $this->BunnyStreamApiRequest('POST', 'COLLECTION', $content, $headers, $libraryId);

                return $data['guid'];
            } catch (\Throwable $th) {
                return FALSE;
                // return $th;
            }
        }
        return FALSE;
    }
    public function  getVideoId($collection_id, $trailor_file, $videoName, $selectedLibrary)
    {
       
        if (isset($collection_id) && !empty($collection_id) && isset($trailor_file) && !empty($trailor_file) && isset($videoName) && !empty($videoName) && isset($selectedLibrary) && !empty($selectedLibrary) && is_numeric($selectedLibrary) && Auth::check()) {
            $libraryId = '';
            $headers = [];
            $content = [];
            if ($selectedLibrary === 1) {
                $libraryId = $this->master_library_id;
                $headers =  $this->headers_master_lib;
            } elseif ($selectedLibrary === 2) {
                $libraryId = $this->award_library_id;
                $headers =  $this->headers_award_lib;
            } elseif ($selectedLibrary === 3) {
                $libraryId = $this->student_library_id;
                $headers =  $this->headers_student;
            } else {
                return FALSE;
            }
          
            try {
               
                $body = [
                    "title" => $videoName,
                    "collectionId" => $collection_id
                ];
                // $streamBody = Utils::streamFor(json_encode($body));
                // Now, set the content of the body in the request
                $content['body'] = $body;
                // $streamBody = Utils::streamFor(json_encode($body));

                // // Open a stream to the video file
                // $stream = fopen($trailor_file->getPathname(), 'r');
                // $guzzleStream = new Stream($stream);
    

                $libraryId = (int) $libraryId;

              
                $data = $this->BunnyStreamApiRequest('POST', 'CREATE', $content, $headers, $libraryId);
             
                if (isset($data['guid']) && !empty($data['guid'])) {
                    $headers['Content-Type'] = 'application/octet-stream';
                    // $content['body'] = file_get_contents($trailor_file);
                    $stream = fopen($trailor_file, 'r');
                    $content['body'] = new Stream($stream);
                    $content['video_id'] = $data['guid'];

                    $videoUploadData = $this->BunnyStreamApiRequest('PUT', 'DEFAULT', $content, $headers, $libraryId);
                    // print_r($videoUploadData);
                    // die;
                    if (isset($videoUploadData) && !empty($videoUploadData['success']) && $videoUploadData['success'] === true) {
                        // $content['video_id'] = $content['video_id'];
                        // $content['body'] = '';
                        // $getVideoLengthID = $this->BunnyStreamApiRequest('GET','DEFAULT',$content,$this->headers_master_lib,$libraryId);
                        return ['status' => TRUE, 'videoId' => $content['video_id']];
                    }
                }
                return ['status' => FALSE];
            } catch (\Throwable $th) {
                return ['status' => FALSE];
                // return $th;
            }
        }
        return FALSE;
    }
    public function  videoAction($bnvideoId, $videoContent = [], $action, $selectedLibrary)
    {

        if (isset($bnvideoId) && !empty($bnvideoId) && isset($videoContent) && is_array($videoContent) && isset($action) && !empty($action) && isset($action) && !empty($action) && isset($selectedLibrary) && !empty($selectedLibrary) && is_numeric($selectedLibrary) && Auth::check()) {
            $libraryId = '';
            $headers = [];
            if ($selectedLibrary === 1) {
                $libraryId = $this->master_library_id;
                $headers =  $this->headers_master_lib;
            } elseif ($selectedLibrary === 2) {
                $libraryId = $this->award_library_id;
                $headers =  $this->headers_award_lib;
            } elseif ($selectedLibrary === 3) {
                $libraryId = $this->student_library_id;
                $headers =  $this->headers_student;
            } else {
                return FALSE;
            }
         
            try {
                if ($action === 'DELETE' || $action === 'REPLACE') {
                    $res = $this->BunnyStreamApiRequest('DELETE', 'DEFAULT', ['video_id' => $bnvideoId], $headers, $libraryId);
                    if ($action === 'REPLACE') {
                        $getVideoID =   $this->getVideoId($videoContent[0], $videoContent[1], $videoContent[2], $selectedLibrary);
                        if (isset($getVideoID['status']) && $getVideoID['status'] === TRUE) {
                            return $getVideoID;
                        }
                    }

                    if (is_array($res['success']) && $res['success'] === TRUE) {
                        return TRUE;
                    }
                }
                return FALSE;
            } catch (\Throwable $th) {
                return FALSE;
            }
        }
        return FALSE;
    }


    public function setThumbnail($videoid,$thumbnail,$selectedLibrary){
        
        if (isset($videoid) && !empty($videoid) && isset($thumbnail) && !empty($thumbnail) && isset($selectedLibrary) && !empty($selectedLibrary) && is_numeric($selectedLibrary) && Auth::check()) {
            $libraryId = '';
            $headers = [];
            $content = [];
            if ($selectedLibrary === 1) {
                $libraryId = $this->master_library_id;
                $headers =  $this->headers_master_lib;
            } elseif ($selectedLibrary === 2) {
                $libraryId = $this->award_library_id;
                $headers =  $this->headers_award_lib;
            } else {
                return FALSE;
            }
          
            try {   
               
                $headers['Content-Type'] = 'application/octet-stream';
                $content['body'] = file_get_contents($thumbnail);
                $content['video_id'] = $videoid;
                $data = $this->BunnyStreamApiRequest('POST','THUMBNAIL',$content, $headers, $libraryId);
                if (isset($data) && !empty($data['success']) && $data['success'] === true) {
                    $videoData = $this->BunnyStreamApiRequest('GET','VIDEODETAILS', $content, $headers, $libraryId);
                    return ['status' => TRUE, 'thumbnailFileName'=> $videoData['thumbnailFileName']];

                }
                return ['status' => FALSE];
            } catch (\Throwable $th) {
                return ['status' => FALSE];

            }
        }
    }

    public function deleteCollection($collection_id,$selectedLibrary){
        
        if (isset($collection_id) && !empty($collection_id) && isset($selectedLibrary) && !empty($selectedLibrary) && is_numeric($selectedLibrary) && Auth::check()) {
            $libraryId = '';
            $headers = [];
            $content = [];
            if ($selectedLibrary === 1) {
                $libraryId = $this->master_library_id;
                $headers =  $this->headers_master_lib;
            } elseif ($selectedLibrary === 2) {
                $libraryId = $this->award_library_id;
                $headers =  $this->headers_award_lib;
            } else {
                return FALSE;
            }
          
            try {   
                $data = $this->BunnyStreamApiRequest('DELETE', 'COLLECTIONDELTE',['collection_id' => $collection_id], $headers, $libraryId);
                if (isset($data) && !empty($data['success']) && $data['success'] === true) {
                    return ['status' => TRUE];

                }
                return ['status' => FALSE];
            } catch (\Throwable $th) {
                return ['status' => FALSE];

            }
        }
    }
    public function deleteVideos($video_id,$selectedLibrary){
        
        if (isset($video_id) && !empty($video_id) && isset($selectedLibrary) && !empty($selectedLibrary) && is_numeric($selectedLibrary) && Auth::check()) {
            $libraryId = '';
            $headers = [];
            $content = [];
            if ($selectedLibrary === 1) {
                $libraryId = $this->master_library_id;
                $headers =  $this->headers_master_lib;
            } elseif ($selectedLibrary === 2) {
                $libraryId = $this->award_library_id;
                $headers =  $this->headers_award_lib;
            } else {
                return FALSE;
            }
          
            try {   
                $data = $this->BunnyStreamApiRequest('DELETE', 'DEFAULT', ['video_id' => $video_id], $headers, $libraryId);

                if (isset($data) && !empty($data['success']) && $data['success'] === true) {
                    return ['status' => TRUE];

                }
                return ['status' => FALSE];
            } catch (\Throwable $th) {
                return ['status' => FALSE];

            }
        }
    }
    
    
    protected function BunnyStreamApiRequest($method, $urltype, $content = [], $header, $library)
    {

        // return $header;
        if (isset($method) && !empty($method)  && is_array($content) && isset($urltype) && !empty($urltype) && isset($header) && is_array($header) && isset($library) && !empty($library) && Auth::check()) {
            try {
                $url = "https://video.bunnycdn.com/library/$library/";
                $body = isset($content['body']) ? json_encode($content['body']) : null;

                if ($urltype === 'DEFAULT') { // Other Common End point
                    $url .=  isset($content['video_id']) && !empty($content['video_id']) ? "videos/" . $content['video_id'] : '';
                    $body = isset($content['body']) ? $content['body'] : null;
                } elseif ($urltype === 'CREATE') { // Upload Video End point for video upload
                    $url .=  "videos";
                } elseif ($urltype === 'COLLECTION') { // Collection End Point  for Create Collection
                    $url .= "collections/";
                } else if($urltype === 'THUMBNAIL'){
                    $url .=  isset($content['video_id']) && !empty($content['video_id']) ? "videos/" . $content['video_id'].'/thumbnail' : '';
                    $body = isset($content['body']) ? $content['body'] : null;
                }else if($urltype === 'VIDEODETAILS'){
                    $url .=  isset($content['video_id']) && !empty($content['video_id']) ? "videos/" . $content['video_id'] : '';
                }else if($urltype == 'COLLECTIONDELTE'){
                    $url .=  isset($content['collection_id']) && !empty($content['collection_id']) ? "collections/" . $content['collection_id'] : '';
                }   
        
                $request = new Request($method, $url, $header, $body);
                // if($urltype === 'CREATE'){

                //     $res = $this->client->send($request);
                // }else{
                    $res = $this->client->sendAsync($request)->wait();
                // }
                // print_r($res);
                // die;
                $data =  $res->getBody()->getContents();
                $response = json_decode($data, true);
                // fclose($stream);
                return $response;


            } catch (\Throwable $th) {
                return $th;
            }
        }
        return FALSE;
    }
    

    public function getVideoLength($videoid, $libraryId)
    {
        $content = [];
        $content['video_id'] = $videoid;
        $content['body'] = '';
        $getVideoLengthID = $this->BunnyStreamApiRequest('GET', 'LENGTH', $content, $this->headers_master_lib, $libraryId);
        return ['status' => TRUE, 'videoId' => $videoid, 'length' => $getVideoLengthID['length']];
    }

    public function getEmentorProfile($where = [], $select = [])
    {   
        $ementorData = [];
        if (Auth::check()) {
            $query = $this->select('id', 'ementor_id','category_id','course_thumbnail_file','course_title','mqfeqf_level','ects')
            ->with(['Ementor' => function ($query) {
                 $query->select('id', 'name', 'last_name','photo');
            }])
            ->with(['OrderModule' => function ($query) {
                $query->where('status', '0') // Filter orders with status '0'
                    ->whereHas('user.studentDocument', function ($studentDocQuery) {
                        $studentDocQuery->where('identity_is_approved', 'Approved')
                                        ->where('edu_is_approved', 'Approved')
                                        ->where('english_score', '>=', '10');
                    })
                    ->whereHas('user.userData', function ($userDataQuery) {
                        $userDataQuery->where('is_active', 'Active');
                    })->with([
                        'user' => function ($userQuery) {
                            $userQuery->with([
                                'userData:id,name,last_name,photo',
                                'studentDocument:student_id,identity_is_approved' // Assuming studentDocument has a user_id column
                            ]);
                        }
                    ]);
            }]);
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $ementorData = $query->where($where)->where('is_deleted','Yes')->get();
            } else {
                $ementorData = $query->where('is_deleted','Yes')->get();
            }
            return $ementorData;
        }
    }

    public function getEmentorCourseData($where = [], $select = [])
    {
        $ementorData = [];
        if (Auth::check()) {
            $query = $this->select('id', 'ementor_id','category_id','course_thumbnail_file','course_title','mqfeqf_level','ects')
            ->with(['Ementor' => function ($query) {
                 $query->select('id', 'name', 'last_name','photo');
            }])
            ->with(['OrderModule' => function ($query) {
                $query->where('status', '0') // Filter orders with status '0'
                    ->whereHas('user.userData')->with([
                        'user' => function ($userQuery) {
                            $userQuery->with([
                                'userData:id,name,last_name,photo',
                                'studentDocument:student_id,identity_is_approved' // Assuming studentDocument has a user_id column
                            ]);
                        }
                    ]);
            }]);

            $courses = $query->where('ementor_id', $where['ementor_id'])->where('is_deleted', 'No')->get();
            $enrolledCourses = $courses->map(function ($course) {
                $enrolledCount = 0;

                if ($course->OrderModule->isNotEmpty()) {
                    foreach ($course->OrderModule as $orderModule) {
                        $userData = optional($orderModule->user->userData)->id;
                        if ($userData && is_enrolled($userData, $course->id)) {
                            $enrolledCount++;
                        }
                    }
                }
                $course->enrolledCount = $enrolledCount;
                return $enrolledCount >= 0 ? $course : null;
            })->filter();

            $ementorData = $enrolledCourses->values();
            return $ementorData;
        }
    }
    public function getEmentorDashboardData($where = [], $select = [])
    {   
        $ementorData = [];
        if (Auth::check()) {
            $query = $this->select('id', 'ementor_id','category_id','course_thumbnail_file','course_title','mqfeqf_level','ects')
            ->with(['Ementor' => function ($query) {
                 $query->select('id', 'name', 'last_name','photo');
            }])
            ->with(['OrderModule' => function ($query) {
                $query->where('status', '0') // Filter orders with status '0'
                    ->whereHas('user.studentDocument')
                    ->whereHas('user.userData')
                    ->with([
                        'user' => function ($userQuery) {
                            $userQuery->with([
                                'userData:id,name,last_name,photo',
                                'studentDocument:student_id,identity_is_approved,edu_is_approved,english_level', // Assuming studentDocument has a user_id column
                            ]);
                        }
                    ]);
            }]);
            if (isset($where) && count($where) > 0 && is_array($where)) {
                $ementorData = $query->where($where)->where('is_deleted','No')->get();
            } else {
                $ementorData = $query->where('is_deleted','No')->get();
            }
            return $ementorData;
        }
    }

    public function checkVideoIdOnBunnyStream($method, $libraryId, $videoId)
    {
        $client = new Client();
        $headers = [
            'AccessKey' => env('AWARD_LIBRARY_KEY'),
        ];
        $body = '';
        $request = new Request('GET', "https://video.bunnycdn.com/library/".$libraryId."/videos/".$videoId, $headers, $body);

        try {
            $res = $client->send($request);
            if ($res->getStatusCode() === 200) {
                $data = $res->getBody();
                $response = json_decode($data, true);
                
                return [
                    'code' => $res->getStatusCode(),
                    'data' => $response,
                ];
            } else {
                return [
                    'code' => $res->getStatusCode(),
                    'message' => 'Failed to retrieve data from the video library.'
                ];
            }
        } catch (ClientException $e) {
            $response = $e->getResponse();
            return [
                'code' => $response->getStatusCode(),
                'message' => 'An error occurred while retrieving the video'
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'message' => 'An error occurred'
            ];
        }
    }

    public function checkCollectionIdExist($libraryId, $collectionName)
    {
        
        $client = new Client();
        $headers = [
            'AccessKey' => env('AWARD_LIBRARY_KEY'),
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ];
        $body = '';
        $request = new Request('GET', "https://video.bunnycdn.com/library/{$libraryId}/collections", $headers, $body);
        try {
            $res = $client->send($request);
            
            if ($res->getStatusCode() === 200) {
                $data = $res->getBody();
                
                $response = json_decode($data, true);
                
                if (json_last_error() === JSON_ERROR_NONE) {
                    return [
                        'code' => $res->getStatusCode(),
                        'data' => $response,
                    ];
                } else {
                    return [
                        'code' => 500,
                        'message' => 'Invalid JSON response received.'
                    ];
                }
            } else {
                return [
                    'code' => $res->getStatusCode(),
                    'message' => 'Failed to retrieve data from the video library.'
                ];
            }
        } catch (ClientException $e) {
            $response = $e->getResponse();
            return [
                'code' => $response->getStatusCode(),
                'message' => 'An error occurred while retrieving the video: ' . $response->getReasonPhrase()
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'message' => 'An unexpected error occurred: ' . $e->getMessage()
            ];
        }
        
    }

    public function createCollectionIdOnBunnyStream($libraryId, $collectionName)
    {
        
        $client = new Client();
        $headers = [
            'AccessKey' => env('AWARD_LIBRARY_KEY'),
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ];
        $body = json_encode([
            'name' => $collectionName,
        ]);
        $request = new Request('POST', "https://video.bunnycdn.com/library/{$libraryId}/collections", $headers, $body);
        try {
            $res = $client->send($request);
            
            if ($res->getStatusCode() === 200) {
                $data = $res->getBody();
                
                $response = json_decode($data, true);
                
                if (json_last_error() === JSON_ERROR_NONE) {
                    return [
                        'code' => $res->getStatusCode(),
                        'data' => $response,
                    ];
                } else {
                    return [
                        'code' => 500,
                        'message' => 'Invalid JSON response received.'
                    ];
                }
            } else {
                return [
                    'code' => $res->getStatusCode(),
                    'message' => 'Failed to retrieve data from the video library.'
                ];
            }
        } catch (ClientException $e) {
            $response = $e->getResponse();
            return [
                'code' => $response->getStatusCode(),
                'message' => 'An error occurred while retrieving the video: ' . $response->getReasonPhrase()
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'message' => 'An unexpected error occurred: ' . $e->getMessage()
            ];
        }
        
    }
    
    public function updateCollection1($libraryId, $collectionId, $collectionName)
    {
        $client = new Client();
        $headers = [
            'AccessKey' => env('AWARD_LIBRARY_KEY'),
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ];
        $body = json_encode([
            'name' => $collectionName,
        ]);
        $request = new Request('POST', "https://video.bunnycdn.com/library/{$libraryId}/collections/{{$collectionId}}", $headers, $body);
        try {
            $res = $client->send($request);
            
            if ($res->getStatusCode() === 200) {
                $data = $res->getBody();
                
                $response = json_decode($data, true);
                
                if (json_last_error() === JSON_ERROR_NONE) {
                    return [
                        'code' => $res->getStatusCode(),
                        'data' => $response,
                    ];
                } else {
                    return [
                        'code' => 500,
                        'message' => 'Invalid JSON response received.'
                    ];
                }
            } else {
                return [
                    'code' => $res->getStatusCode(),
                    'message' => 'Failed to retrieve data from the video library.'
                ];
            }
        } catch (ClientException $e) {
            $response = $e->getResponse();
            return [
                'code' => $response->getStatusCode(),
                'message' => 'An error occurred while retrieving the video: ' . $response->getReasonPhrase()
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'message' => 'An unexpected error occurred: ' . $e->getMessage()
            ];
        }
        
    }


    public function updateCollection($libraryId, $collectionId, $collectionName)
    {
        $client = new Client();
        $headers = [
            'AccessKey' => env('AWARD_LIBRARY_KEY'),
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ];
        
        $body = json_encode([
            'name' => $collectionName,
        ]);
        
        $url = "https://video.bunnycdn.com/library/{$libraryId}/collections/{$collectionId}";
        
        $request = new Request('POST', $url, $headers, $body);
        
        try {
            $res = $client->send($request);
            
            if ($res->getStatusCode() === 200) {
                $data = $res->getBody();
                
                $response = json_decode($data, true);
                
                if (json_last_error() === JSON_ERROR_NONE) {
                    return [
                        'code' => $res->getStatusCode(),
                        'data' => $response,
                    ];
                } else {
                    return [
                        'code' => 500,
                        'message' => 'Invalid JSON response received.'
                    ];
                }
            } else {
                return [
                    'code' => $res->getStatusCode(),
                    'message' => 'Failed to retrieve data from the video library.'
                ];
            }
        } catch (ClientException $e) {
            $response = $e->getResponse();
            return [
                'code' => $response->getStatusCode(),
                'message' => 'An error occurred while retrieving the video: ' . $response->getReasonPhrase()
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'message' => 'An unexpected error occurred: ' . $e->getMessage()
            ];
        }
    }
    
    public function courseReportData($where)
    {
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $query = $this->with('Ementor')
            ->whereHas('OrderModule', function ($query) use ($where) {
                $query->where('status', '0');
            
                if (isset($where['start_date']) && isset($where['end_date'])) {
                    $query->whereBetween('created_at', [$where['start_date'][2], $where['end_date'][2]]);
                }
            });
        }else{
            $query = $this->with(['OrderModule' => function ($query) use ($where) {
                $query->where('status', '0');
            }])->with('Ementor');
        }
        // if (isset($where['start_date']) && isset($where['end_date'])) {
        //     $query->whereBetween('orders.reated_at', [$where['start_date'][2], $where['end_date'][2]]);
        // }
    
        $courseData = $query->get();
        return $courseData;
    }
 
    public function getCourseSearch($where = [], $select = [])
    {
        $query = $this->select($select)->limit(5)->where('status','3')->where('category_id','1')->where(['is_deleted' => 'No'])->orderBy('course_title', 'ASC');
        $courseData = [];
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $courseData = $query->where('course_title', 'LIKE', "%{$where['course_title']}%")->get()->toArray();
        } else {
            $courseData = $query->get()->toArray();
        }
        return $courseData;
    }

   
}