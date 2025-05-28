<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamManage extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    public $table = 'exam_management_master';
    protected $guarded  = [];
    protected $visible  = ['id', 'exam_type', 'course_id', 'is_deleted', 'assignmentExam', 'quizExam', 'mockExam', 'vlogExam', 'peerReviewExam', 'discord', 'reflectiveJournalExam', 'mcqExam', 'surveyExam', 'artificialIntelligenceExam'];

    public function assignmentExam()
    {
        return  $this->hasMany(AssignmentModule::class, 'id', 'exam_id');
    }
    public function mockExam()
    {
        return  $this->hasMany(MockExam::class, 'id', 'exam_id');
    }
    public function vlogExam()
    {
        return  $this->hasMany(VlogModule::class, 'id', 'exam_id');
    }
    public function peerReviewExam()
    {
        return  $this->hasMany(PeerReviewModule::class, 'id', 'exam_id');
    }
    public function discord()
    {
        return  $this->hasMany(DiscordModule::class, 'id', 'exam_id');
    }
    public function reflectiveJournalExam()
    {
        return  $this->hasMany(ReflectiveJournalModule::class, 'id', 'exam_id');
    }
    public function mcqExam()
    {
        return  $this->hasMany(McqModule::class, 'id', 'exam_id');
    }
    public function surveyExam()
    {
        return  $this->hasMany(SurveyModule::class, 'id', 'exam_id');
    }
    public function artificialIntelligenceExam()
    {
        return  $this->hasMany(ArtificialIntelligenceModule::class, 'id', 'exam_id');
    }
    public function quizExam()
    {
        return  $this->hasMany(QuizSection::class, 'id', 'exam_id');
    }
    public function getCouresExam($where = [], $select = [])
    {
        $query =  $this->with(['assignmentExam.AssigQuestion', 'mockExam.mockQuestion', 'vlogExam.vlogQuestion', 'peerReviewExam', 'discord', 'reflectiveJournalExam.reflectiveJournalQuestion', 'mcqExam.mcqQuestion', 'surveyExam.surveyQuestion.inputConfigurations', 'artificialIntelligenceExam.artificialIntelligenceQuestion']);
        $CourseData = [];
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $CourseData = $query->where($where)->get()->toArray();
        } else {
            $CourseData = $query->get()->toArray();
        }
        return $CourseData;
    }

    public function getAwardCourse($where = [], $select = [])
    {
        $awardCourseIds = getData('master_course_management', ['course_id'], ['award_id' => $where['course_id'], 'is_deleted' => 'No', 'optional_course_id' => null], '', 'placement_id', 'asc');
        $optionalCourseSelected = true;

        $studentCourseMaster = getData('student_course_master', ['preference_id', 'preference_status'], ['id' => $where['student_course_master_id']]);
        if($studentCourseMaster[0]->preference_status == '0'){
            if($studentCourseMaster[0]->preference_id != null){
                $preferenceIds = $studentCourseMaster[0]->preference_id;
                $preferenceIdsArray = explode(',', $preferenceIds);
                $preferenceIdsFormatted = collect($preferenceIdsArray)->map(function ($id) {
                    return (object) ['course_id' => (int) $id];
                });
                $awardCourseIds = $awardCourseIds->merge($preferenceIdsFormatted);
                $optionalCourseSelected = true;
            }else{
                $optionalCourseSelected = false;
            }
        }

        return $data = [
            'awardCourseIds' => $awardCourseIds,
            'optionalCourseSelected' => $optionalCourseSelected,
        ];
    }

}