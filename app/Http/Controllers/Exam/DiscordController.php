<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscordController extends Controller
{
    public function discordJoin($user_id, $course_id, $examType, $student_course_master_id)
    {
        $userId = isset($user_id) ? base64_decode($user_id) : 0;
        $courseId  = isset($course_id) ? base64_decode($course_id) : 0;
        $examType  = isset($examType) ? base64_decode($examType) : 0;
        $student_course_master_id  = isset($student_course_master_id) ? base64_decode($student_course_master_id) : 0;

        $courseData = getData('course_other_details', ['discord_joining_link', 'discord_channel_link'], ['course_id' => $courseId]);
        $examId  = 0;

        $exists = is_exist('discord_join', ['student_course_master_id' => $student_course_master_id, 'user_id' => $userId, 'course_id' => $courseId]);
        if (isset($exists) && is_numeric($exists) && $exists == 0) {
            $select = [
                'student_course_master_id' => $student_course_master_id,
                'user_id' => $userId,
                'course_id' => $courseId,
                'join' => '1',
                'created_at' => now(),
                'updated_at' =>  now(),
            ];
            $where = [];
            if(isset($courseData) && $courseData[0]->discord_joining_link != ''){
                $updateCourse = processData(['discord_join', 'id'], $select,$where);

                $select = [
                    'student_course_master_id' => $student_course_master_id,
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    'last_updated_by' => $userId,
                    'created_at' =>  $this->time
                ];

                $updateDiscordAnswer = processData(['exam_discord_answers', 'id'], $select);

                if($examType == 5){
                    $exam = getData('exam_discord', ['id'], ['award_id' => $courseId, 'is_deleted' => 'No']);
                }

                $studentCourseMaster = getStudentCourseMaster(base64_encode($userId), base64_encode($courseId));
                $select = ['user_id' => $userId, 'course_id' => $courseId, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam[0]->id, 'exam_type' => $examType, 'submitted_on' => $this->time, 'created_at' => $this->time];
                $where =  ['user_id' => $userId, 'course_id' => $courseId, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam[0]->id, 'exam_type' => $examType, 'is_active' => '1'];
                $updateCourse = processData(['exam_remark_master', 'id'], $select, $where);
                

                return redirect($courseData[0]->discord_joining_link);
            }else{
                return redirect()->back()->with('error', 'Joining Link not found');
            }
        }else{
            $studentCourseMaster = getData('student_course_master', ['exam_attempt_remain'], ['user_id' => $userId, 'course_id' => $courseId, 'exam_attempt_remain' => '1'],'','created_at','desc' );
            if (isset($studentCourseMaster[0]->exam_attempt_remain) && !empty($studentCourseMaster) && $studentCourseMaster[0]->exam_attempt_remain > 0) {
                $where =  ['student_course_master_id' => $student_course_master_id, 'user_id' => $userId, 'course_id' => $courseId, 'is_active' => '1'];
            
                $select = [
                    'student_course_master_id' => $student_course_master_id,
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    'last_updated_by' => $userId,
                    'created_at' =>  $this->time
                ];

                $updateDiscordAnswer = processData(['exam_discord_answers', 'id'], $select, $where);

                if($examType == 5){
                    $exam = getData('exam_discord', ['id'], ['award_id' => $courseId, 'is_deleted' => 'No']);
                }

                $studentCourseMaster = getStudentCourseMaster(base64_encode($userId), base64_encode($courseId));
                $select = ['user_id' => $userId, 'course_id' => $courseId, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam[0]->id, 'exam_type' => $examType, 'submitted_on' => $this->time, 'created_at' => $this->time];
                $where =  ['user_id' => $userId, 'course_id' => $courseId, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam[0]->id, 'exam_type' => $examType, 'is_active' => '1'];
                $updateCourse = processData(['exam_remark_master', 'id'], $select, $where);
            }else{
                
                $where =  ['student_course_master_id' => $student_course_master_id, 'user_id' => $userId, 'course_id' => $courseId, 'is_active' => '1'];
            
                $select = [
                    'student_course_master_id' => $student_course_master_id,
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    'last_updated_by' => $userId,
                    'created_at' =>  $this->time
                ];

                $updateDiscordAnswer = processData(['exam_discord_answers', 'id'], $select, $where);

                if($examType == 5){
                    $exam = getData('exam_discord', ['id'], ['award_id' => $courseId, 'is_deleted' => 'No']);
                }

                $studentCourseMaster = getStudentCourseMaster(base64_encode($userId), base64_encode($courseId));
                $select = ['user_id' => $userId, 'course_id' => $courseId, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam[0]->id, 'exam_type' => $examType, 'submitted_on' => $this->time, 'created_at' => $this->time];
                $where =  ['user_id' => $userId, 'course_id' => $courseId, 'student_course_master_id' => $student_course_master_id, 'exam_id' => $exam[0]->id, 'exam_type' => $examType, 'is_active' => '1'];
                $updateCourse = processData(['exam_remark_master', 'id'], $select, $where);
            }

            return redirect($courseData[0]->discord_joining_link);
        }

    }
}
