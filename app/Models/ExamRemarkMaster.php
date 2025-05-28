<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, Validator,  DB};

class ExamRemarkMaster extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'exam_remark_master';
    protected $guarded  = [];
    public function examStudent()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
    public function examCourse()
    {
        return $this->hasMany(CourseModule::class, 'id', 'course_id');
    }
    public function mockExam()
    {
        return $this->hasMany(MockExam::class, 'id', 'exam_id');
    }
    public function assginmentExam()
    {
        return $this->hasMany(AssignmentModule::class, 'id', 'exam_id');
    }
    public function vlogExam()
    {
        return $this->hasMany(VlogModule::class, 'id', 'exam_id');
    }
    public function vlogExamAnswers()
    {
        return $this->hasMany(VlogAnswers::class, 'user_id', 'user_id');
    }
    public function peerReviewExam()
    {
        return $this->hasMany(PeerReviewModule::class, 'id', 'exam_id');
    }
    public function peerReviewExamAnswers()
    {
        return $this->hasMany(PeerReviewAnswers::class, 'user_id', 'user_id');
    }
    public function discordExam()
    {
        return $this->hasMany(DiscordModule::class, 'id', 'exam_id');
    }
    public function discordExamAnswers()
    {
        return $this->hasMany(DiscordAnswers::class, 'user_id', 'user_id');
    }
    public function reflectiveJournalExam()
    {
        return $this->hasMany(ReflectiveJournalModule::class, 'id', 'exam_id');
    }
    public function mcqExam()
    {
        return $this->hasMany(McqModule::class, 'id', 'exam_id');
    }
    public function surveyExam()
    {
        return $this->hasMany(SurveyModule::class, 'id', 'exam_id');
    }
    public function artificialIntelligenceExam()
    {
        return $this->hasMany(ArtificialIntelligenceModule::class, 'id', 'exam_id');
    }

    public function draftExam()
    {
        return $this->hasOne(DraftExam::class, 'student_course_master_id', 'student_course_master_id');
    }

    // public function AssigQuestion()
    // {
    //     return $this->hasMany(AssignmentQuestion::class, 'assignments_id')->where('is_deleted', 'No');
    // }

    public function getEmentorStudentsDetails($where)
    {
        $studentData = [];
        $ementorId = 0;
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $query = $this->where('is_active', 1)->with(['examCourse' => function ($q) {
                    $q->select('id', 'course_title', 'category_id');
                }, 'examStudent' => function ($q) {
                    $q->select('id', 'name', 'last_name', 'mob_code', 'photo', 'email', 'phone', 'profile_background');
                },
                'examStudent.StudentProfile' => function ($q) {
                    $q->leftJoin('country_master', 'country_master.id', '=', 'student_profile_master.country_id')
                        ->select('student_profile_master.*', 'country_master.country_name');
                },'examStudent.StudentDocs', 
                // 'examCourse.mockExamStatus.mockExam', 'examCourse.assginmentStatus.assginmentExam', 'examCourse.vlogStatus.vlogExam', 'examCourse.peerReviewStatus.peerReviewExam', 'examCourse.discordStatus.discordExam', 'examCourse.reflectiveJournalStatus.reflectiveJournalExam', 'examCourse.mcqStatus.mcqExam', 'examCourse.surveyStatus.surveyExam'
        
                'examCourse.assginmentStatus' => function ($q) use ($where) {
                    $q->where(['student_course_master_id' => $where['student_course_master_id'], 'is_active' => 1])->with(['assginmentExam']);
                },
                'examCourse.mockExamStatus' => function ($q) use ($where) {
                    $q->where(['student_course_master_id' => $where['student_course_master_id'], 'is_active' => 1])->with(['mockExam']);
                },
                'examCourse.vlogStatus' => function ($q) use ($where) {
                    $q->where(['student_course_master_id' => $where['student_course_master_id'], 'is_active' => 1])->with(['vlogExam']);
                },
                'examCourse.peerReviewStatus' => function ($q) use ($where) {
                    $q->where(['student_course_master_id' => $where['student_course_master_id'], 'is_active' => 1])->with(['peerReviewExam']);
                },
                'examCourse.discordStatus' => function ($q) use ($where) {
                    $q->where(['student_course_master_id' => $where['student_course_master_id'], 'is_active' => 1])->with(['discordExam']);
                },
                'examCourse.reflectiveJournalStatus' => function ($q) use ($where) {
                    $q->where(['student_course_master_id' => $where['student_course_master_id'], 'is_active' => 1])->with(['reflectiveJournalExam']);
                },
                'examCourse.mcqStatus' => function ($q) use ($where) {
                    $q->where(['student_course_master_id' => $where['student_course_master_id'], 'is_active' => 1])->with(['mcqExam']);
                },
                'examCourse.surveyStatus' => function ($q) use ($where) {
                    $q->where(['student_course_master_id' => $where['student_course_master_id'], 'is_active' => 1])->with(['surveyExam']);
                },
                'examCourse.artificialIntelligenceStatus' => function ($q) use ($where) {
                    $q->where(['student_course_master_id' => $where['student_course_master_id'], 'is_active' => 1])->with(['artificialIntelligenceExam']);
                }
            ]);
            $studentData = $query->where(['user_id' => $where['user_id'], 'student_course_master_id' => $where['student_course_master_id']])->get()->toArray();
            $course = DB::table('course_master')->where('id', $where['course_id'])->first();
            if(!empty($course) && $course != null){
                $ementorId = isset($where['ementor_id']) ? $where['ementor_id'] : Auth::user()->id;
            }
        }
        $students = [];

        $ementorCourses = DB::table('course_master')->where('ementor_id', $ementorId)->get(['id']);
        if(count($ementorCourses)>0){
            
            $where = [
                'user_id' => $where['user_id'],
                'ementor_id' => $ementorId,
                'include_adjusted_expiry' => false
            ];
            $studentRecords = getPaidCourse($where);

            
            if (count($studentRecords)>0) {
                foreach ($studentRecords as $student) {
                    $students['purchasedCourse'][] = $student;
                }
            }
            
            $where = [
                'user_id' => $where['user_id'],
                'ementor_id' => $ementorId,
            ];
            
            $studentRecords = getStudentExpiredCourse($where);

            
            if (count($studentRecords)>0) {
                foreach ($studentRecords as $student) {
                    $students['expiredCourse'][] = $student;
                }
            }
        }
        $courseTitle = isset($course->course_title) ? $course->course_title : '';
        $courseId = isset($course->id) ? $course->id : '';
        $courseCategory = isset($course->category_id) ? $course->category_id : '';
        $data = [
            'studentData' => $studentData,
            'courseData' => $students,
            'courseTitle' => $courseTitle,
            'courseId' => $courseId,
            'courseCategory' => $courseCategory,
            'ementorId'=>$ementorId
        ];

        return $data;
    }
    public function getQuestionAnswer($where, $examType,$user_id, $student_course_master_id)
    {
 
        $AssignmentData = [];
        $query = $this->with(['examCourse' => function ($query) {
            $query->select('id', 'course_title');
        }]);

        // Data as per Exam Type
        if (isset($examType) && !empty($examType) && $examType === 1) {
            // Assignment Exam
            $query->with([
            'assginmentExam.AssigQuestion.AssigAnwers' => function ($q) use ($user_id, $student_course_master_id) {
                $q->where(['user_id' => $user_id, 'student_course_master_id' => $student_course_master_id])->where('is_active', 1);
            },
            'draftExam' => function ($q) use ($user_id, $student_course_master_id) {
                $q->where(['user_id' => $user_id, 'student_course_master_id' => $student_course_master_id])
                  ->where('is_active', 1)
                  ->where('draft', 1);
            },
            'examStudent' => function ($q) {
                $q->select('id', 'name', 'last_name');
            }]);
        } elseif (isset($examType) && !empty($examType) && $examType === 2) {
            // Mock Inteview Exam
            $query->with([
            'mockExam.mockQuestion.MockAnwers' => function ($q) use ($user_id, $student_course_master_id) {
                $q->where(['user_id' => $user_id, 'student_course_master_id' => $student_course_master_id])->where('is_active', 1);
            },
            'examStudent' => function ($q) {
                $q->select('id', 'name', 'last_name');
            }]);
        } elseif (isset($examType) && !empty($examType) && $examType === 3) {
            // Vlog Exam
            $query->with([
            'vlogExam.vlogQuestion.vlogAnwers' => function ($q) use ($user_id, $student_course_master_id) {
                $q->where(['user_id' => $user_id, 'student_course_master_id' => $student_course_master_id])->where('is_active', 1);
            },
            'examStudent' => function ($q) {
                $q->select('id', 'name', 'last_name');
            }]); 
        } elseif (isset($examType) && !empty($examType) && $examType === 4) {
            // Peer Review Exam
            $query->with([
            'peerReviewExam','peerReviewExamAnswers' => function ($q) use ($user_id, $student_course_master_id) {
                $q->where(['user_id' => $user_id, 'student_course_master_id' => $student_course_master_id])->where('is_active', 1);
            },
            'examStudent' => function ($q) {
                $q->select('id', 'name', 'last_name');
            }]); 
        } elseif (isset($examType) && !empty($examType) && $examType === 5) {
            // Forum Leadership
            $query->with([
            'discordExam','discordExamAnswers' => function ($q) use ($user_id, $student_course_master_id) {
                $q->where(['user_id' => $user_id, 'student_course_master_id' => $student_course_master_id])->where('is_active', 1);
            },
            'examStudent' => function ($q) {
                $q->select('id', 'name', 'last_name');
            }]); 
        }else if (isset($examType) && !empty($examType) && $examType === 6) {
            // Reflective Journal
            $query->with([
            'reflectiveJournalExam.reflectiveJournalQuestion.reflectiveJournalAnswers' => function ($q) use ($user_id, $student_course_master_id) {
                $q->where(['user_id' => $user_id, 'student_course_master_id' => $student_course_master_id])->where('is_active', 1);
            },
            'examStudent' => function ($q) {
                $q->select('id', 'name', 'last_name');
            }]); 
        }else if (isset($examType) && !empty($examType) && $examType === 8) {
            // Survey
            $query->with([
            // 'surveyExam.surveyQuestion.surveyAnswers' => function ($q) use ($user_id, $student_course_master_id) {
            //     $q->where(['user_id' => $user_id, 'student_course_master_id' => $student_course_master_id])->where('is_active', 1);
            // },
            'surveyExam.surveyQuestion' => function ($q) use ($user_id, $student_course_master_id) {
                $q->with([
                    'surveyAnswers' => function ($q) use ($user_id, $student_course_master_id) {
                        $q->where(['user_id' => $user_id, 'student_course_master_id' => $student_course_master_id])
                        ->where('is_active', 1);
                    },
                    'inputFiles' => function ($q) use ($student_course_master_id) {
                        $q->where('student_course_master_id', $student_course_master_id)
                          ->with('inputConfigurations');
                    },
                    // 'inputFiles.inputConfigurations',
                ]);
            },
            'examStudent' => function ($q) {
                $q->select('id', 'name', 'last_name');
            }]);
        }else if (isset($examType) && !empty($examType) && $examType === 9) {
            // Artificial Intelligence
            $query->with([
            'artificialIntelligenceExam.artificialIntelligenceQuestion.artificialIntelligenceAnswers' => function ($q) use ($user_id, $student_course_master_id) {
                $q->where(['user_id' => $user_id, 'student_course_master_id' => $student_course_master_id])->where('is_active', 1);
            },
            'examStudent' => function ($q) {
                $q->select('id', 'name', 'last_name');
            }]); 
        }
        if (isset($where) && count($where) > 0 && is_array($where)) {
            $AssignmentData = $query->where($where)->where('is_cheking_completed', '<', 2)->get()->toArray();
        }
        return $AssignmentData;
    }
    
    public function finalResult($studentId, $courseId, $student_course_master_id, $exam_id)
    {

        $courseExamCount = getCourseExamCount(base64_encode($courseId));

        $examRemarkMasters = ExamRemarkMaster::where([
            'student_course_master_id' => $student_course_master_id,
            'user_id' => $studentId,
            'course_id' => $courseId,
            'exam_id' => $exam_id,
            'is_cheking_completed' => '2',
            'is_active' => '1',
        ])->latest()->get();
        
        $completedExamCount = 0;
        $mockTotalMarks = 0;
        $mockTotalMarksObtain = 0;
        $mockObtainPercentage = 0;
        $assignmentTotalMarks = 0;
        $assignmentTotalMarksObtain = 0;
        $assignmentObtainPercentage = 0;
        $vlogTotalMarks = 0;
        $vlogTotalMarksObtain = 0;
        $vlogObtainPercentage = 0;
        $peerReviewTotalMarks = 0;
        $peerReviewTotalMarksObtain = 0;
        $peerReviewObtainPercentage = 0;
        $discordTotalMarks = 0;
        $discordTotalMarksObtain = 0;
        $discordObtainPercentage = 0;
        $reflectiveJournalTotalMarks = 0;
        $reflectiveJournalTotalMarksObtain = 0;
        $reflectiveJournalObtainPercentage = 0;
        $surveyTotalMarks = 0;
        $surveyTotalMarksObtain = 0;
        $surveyObtainPercentage = 0;
        $artificialIntelligenceTotalMarks = 0;
        $artificialIntelligenceTotalMarksObtain = 0;
        $artificialIntelligenceObtainPercentage = 0;
        
        foreach($examRemarkMasters as $examRemarkMaster) {
            $completedExamCount++;
        
            // assignment
            if ($examRemarkMaster->exam_type == '1') {
                $assignments = DB::table('exam_assignments')
                    ->where('exam_assignments.id', $examRemarkMaster->exam_id)
                    ->where('exam_assignments.is_deleted', "No")
                    ->leftJoin('exam_assignment_questions', 'exam_assignment_questions.assignments_id', '=', 'exam_assignments.id')
                    ->select('exam_assignments.id', 'exam_assignments.assignment_percentage', DB::raw('SUM(CASE WHEN exam_assignment_questions.is_deleted = "No" THEN exam_assignment_questions.assignment_mark ELSE 0 END) as total_marks'))
                    ->groupBy('exam_assignments.id', 'exam_assignments.assignment_percentage')
                    ->get();
                

                if (count($assignments)>0) {
                    foreach ($assignments as $assignment) {
                        $examAssignmentAnswers = DB::table('exam_assignment_answers')
                            ->where(['student_course_master_id' => $student_course_master_id, 'user_id' => $studentId, 'is_active' => '1'])
                            ->whereIn('question_id', function($query) use ($assignment) {
                                $query->select('id')
                                    ->from('exam_assignment_questions')
                                    ->where('assignments_id', $assignment->id);
                            })
                            ->get();

                            if($examAssignmentAnswers){

                                foreach ($examAssignmentAnswers as $examAssignmentAnswer) {
                                    if ($examAssignmentAnswer->marks_given != '') {
                                        $assignmentTotalMarksObtain += $examAssignmentAnswer->marks_given;
                                    }
                                }
                            }
        
                        $assignmentTotalMarks += $assignment->total_marks;
                    }
                    $assignmentObtainPercentage = $assignmentTotalMarksObtain * $assignments[0]->assignment_percentage/$assignments[0]->total_marks;

                    $assignmentObtainPercentage = round($assignmentObtainPercentage);
                    $examRemarkMaster->final_obtain_percentage = $assignmentObtainPercentage;
                    $examRemarkMaster->last_update_at = now();
                    $examRemarkMaster->save();
                }
            }

            // mock interview
            if ($examRemarkMaster->exam_type == '2') {
                $mockInterviews = DB::table('exam_mock_interview')
                    ->where('exam_mock_interview.id', $examRemarkMaster->exam_id)
                    ->leftJoin('exam_mock_questions', 'exam_mock_questions.mock_intr_id', '=', 'exam_mock_interview.id')
                    ->select('exam_mock_interview.id','exam_mock_interview.percentage',  DB::raw('SUM(CASE WHEN exam_mock_questions.is_deleted = "No" THEN exam_mock_questions.marks ELSE 0 END) as total_marks'))
                    ->groupBy('exam_mock_interview.id', 'exam_mock_interview.percentage')
                    ->get();
        
                if (count($mockInterviews)>0) {
                    foreach ($mockInterviews as $mockInterview) {
                        $examMockAnswers = DB::table('exam_mock_answers')
                            ->where(['student_course_master_id' => $student_course_master_id, 'user_id' => $studentId, 'is_active' => '1'])
                            ->whereIn('question_id', function($query) use ($mockInterview) {
                                $query->select('id')
                                    ->from('exam_mock_questions')
                                    ->where('mock_intr_id', $mockInterview->id);
                            })
                            ->get();

                        if(count($examMockAnswers)>0){
                            foreach ($examMockAnswers as $examMockAnswer) {
                                if ($examMockAnswer->marks_given != '') {
                                    $mockTotalMarksObtain += $examMockAnswer->marks_given;
                                }
                            }
                        }
        
                        $mockTotalMarks += $mockInterview->total_marks;
                    }
                    
                    $mockObtainPercentage = $mockTotalMarksObtain * $mockInterviews[0]->percentage/$mockInterviews[0]->total_marks;
                    $mockObtainPercentage = round($mockObtainPercentage);
                    $examRemarkMaster->final_obtain_percentage = $mockObtainPercentage;
                    $examRemarkMaster->last_update_at = now();
                    $examRemarkMaster->save();
                }
            }

            // vlog
            if ($examRemarkMaster->exam_type == '3') {
                $vlogs = DB::table('exam_vlog')
                    ->where('exam_vlog.id', $examRemarkMaster->exam_id)
                    ->leftJoin('exam_vlog_questions', 'exam_vlog_questions.vlog_id', '=', 'exam_vlog.id')
                    ->select('exam_vlog.id', 'exam_vlog.percentage',  DB::raw('SUM(CASE WHEN exam_vlog_questions.is_deleted = "No" THEN exam_vlog_questions.marks ELSE 0 END) as total_marks'))
                    ->groupBy('exam_vlog.id', 'exam_vlog.percentage')
                    ->get();
        
                if (count($vlogs)>0) {
                    foreach ($vlogs as $vlog) {
                        $examVlogAnswers = DB::table('exam_vlog_answers')
                            ->where(['student_course_master_id' => $student_course_master_id, 'user_id' => $studentId, 'is_active' => '1'])
                            ->whereIn('question_id', function($query) use ($vlog) {
                                $query->select('id')
                                    ->from('exam_vlog_questions')
                                    ->where('vlog_id', $vlog->id);
                            })
                            ->get();

                        if(count($examVlogAnswers)>0){
                            foreach ($examVlogAnswers as $examVlogAnswer) {
                                if ($examVlogAnswer->marks_given != '') {
                                    $vlogTotalMarksObtain += $examVlogAnswer->marks_given;
                                }
                            }
                        }
        
                        $vlogTotalMarks += $vlog->total_marks;
                    }
                    
                    $vlogObtainPercentage = $vlogTotalMarksObtain * $vlogs[0]->percentage/$vlogs[0]->total_marks;
                    $vlogObtainPercentage = round($vlogObtainPercentage);
                    $examRemarkMaster->final_obtain_percentage = $vlogObtainPercentage;
                    $examRemarkMaster->last_update_at = now();
                    $examRemarkMaster->save();
                }
            }

            // peer review
            if ($examRemarkMaster->exam_type == '4') {
                $peerReview = DB::table('exam_peer_review')
                    ->where('exam_peer_review.id', $examRemarkMaster->exam_id)
                    ->where('exam_peer_review.is_deleted', "No")
                    ->select('exam_peer_review.id', 'exam_peer_review.percentage')
                    ->first();
                

                if ($peerReview) {
                    $examPeerReviewAnswer = DB::table('exam_peer_review_answers')
                        ->where(['student_course_master_id' => $student_course_master_id, 'user_id' => $studentId, 'course_id' => $courseId, 'is_active' => '1'])
                        ->first();

                        if($examPeerReviewAnswer){
                            if ($examPeerReviewAnswer->marks_given != '') {
                                $peerReviewTotalMarksObtain += $examPeerReviewAnswer->marks_given;
                            }
                        }
    
                    $peerReviewTotalMarks += $peerReview->percentage;
                    $peerReviewObtainPercentage = $peerReviewTotalMarksObtain * $peerReview->percentage/$peerReview->percentage;

                    $peerReviewObtainPercentage = round($peerReviewObtainPercentage);
                    $examRemarkMaster->final_obtain_percentage = $peerReviewObtainPercentage;
                    $examRemarkMaster->last_update_at = now();
                    $examRemarkMaster->save();
                }
            }

            // forum leadership
            if ($examRemarkMaster->exam_type == '5') {
                $discord = DB::table('exam_discord')
                    ->where('exam_discord.id', $examRemarkMaster->exam_id)
                    ->where('exam_discord.is_deleted', "No")
                    ->select('exam_discord.id', 'exam_discord.percentage', 'exam_discord.marks' )
                    ->first();
                

                if ($discord) {
                    $examDiscordAnswer = DB::table('exam_discord_answers')
                        ->where(['student_course_master_id' => $student_course_master_id, 'user_id' => $studentId, 'course_id' => $courseId, 'is_active' => '1'])
                        ->first();

                        if($examDiscordAnswer){
                            if ($examDiscordAnswer->marks_given != '') {
                                $discordTotalMarksObtain += $examDiscordAnswer->marks_given;
                            }
                        }
    
                    $discordTotalMarks += $discord->marks;
                    $discordObtainPercentage = $discordTotalMarksObtain * $discord->percentage/$discord->marks;

                    $discordObtainPercentage = round($discordObtainPercentage);
                    $examRemarkMaster->final_obtain_percentage = $discordObtainPercentage;
                    $examRemarkMaster->last_update_at = now();
                    $examRemarkMaster->save();
                }
            }
            
            // reflective journal
            if ($examRemarkMaster->exam_type == '6') {
                $reflectiveJournals = DB::table('exam_reflective_journals')
                    ->where('exam_reflective_journals.id', $examRemarkMaster->exam_id)
                    ->where('exam_reflective_journals.is_deleted', "No")
                    ->leftJoin('exam_reflective_journal_questions', 'exam_reflective_journal_questions.reflective_journal_id', '=', 'exam_reflective_journals.id')
                    ->select('exam_reflective_journals.id', 'exam_reflective_journals.percentage', DB::raw('SUM(CASE WHEN exam_reflective_journal_questions.is_deleted = "No" THEN exam_reflective_journal_questions.marks ELSE 0 END) as total_marks'))
                    ->groupBy('exam_reflective_journals.id', 'exam_reflective_journals.percentage')
                    ->get();
                

                if (count($reflectiveJournals)>0) {
                    foreach ($reflectiveJournals as $reflectiveJournal) {
                        $reflectiveJournalAnswers = DB::table('exam_reflective_journal_answers')
                            ->where(['student_course_master_id' => $student_course_master_id, 'user_id' => $studentId, 'is_active' => '1'])
                            ->whereIn('question_id', function($query) use ($reflectiveJournal) {
                                $query->select('id')
                                    ->from('exam_reflective_journal_questions')
                                    ->where('reflective_journal_id', $reflectiveJournal->id);
                            })
                            ->get();

                            if($reflectiveJournalAnswers){

                                foreach ($reflectiveJournalAnswers as $examReflectiveJournalAnswer) {
                                    if ($examReflectiveJournalAnswer->marks_given != '') {
                                        $reflectiveJournalTotalMarksObtain += $examReflectiveJournalAnswer->marks_given;
                                    }
                                }
                            }
        
                        $reflectiveJournalTotalMarks += $reflectiveJournal->total_marks;
                    }
                    $reflectiveJournalObtainPercentage = $reflectiveJournalTotalMarksObtain * $reflectiveJournals[0]->percentage/$reflectiveJournals[0]->total_marks;

                    $reflectiveJournalObtainPercentage = round($reflectiveJournalObtainPercentage);
                    $examRemarkMaster->final_obtain_percentage = $reflectiveJournalObtainPercentage;
                    $examRemarkMaster->last_update_at = now();
                    $examRemarkMaster->save();
                }
            }
            
            // survey
            if ($examRemarkMaster->exam_type == '8') {
                $surveys = DB::table('exam_survey')
                    ->where('exam_survey.id', $examRemarkMaster->exam_id)
                    ->where('exam_survey.is_deleted', "No")
                    ->leftJoin('exam_survey_questions', 'exam_survey_questions.survey_id', '=', 'exam_survey.id')
                    ->select('exam_survey.id', 'exam_survey.percentage', DB::raw('SUM(CASE WHEN exam_survey_questions.is_deleted = "No" THEN exam_survey_questions.marks ELSE 0 END) as total_marks'))
                    ->groupBy('exam_survey.id', 'exam_survey.percentage')
                    ->get();
                

                if (count($surveys)>0) {
                    foreach ($surveys as $survey) {
                        $surveyAnswers = DB::table('exam_survey_answers')
                            ->where(['student_course_master_id' => $student_course_master_id, 'user_id' => $studentId, 'is_active' => '1'])
                            ->whereIn('question_id', function($query) use ($survey) {
                                $query->select('id')
                                    ->from('exam_survey_questions')
                                    ->where('survey_id', $survey->id);
                            })
                            ->get();

                            if($surveyAnswers){

                                foreach ($surveyAnswers as $surveyAnswer) {
                                    if ($surveyAnswer->marks_given != '') {
                                        $surveyTotalMarksObtain += $surveyAnswer->marks_given;
                                    }
                                }
                            }
        
                        $surveyTotalMarks += $survey->total_marks;
                    }
                    $surveyObtainPercentage = $surveyTotalMarksObtain * $surveys[0]->percentage/$surveys[0]->total_marks;

                    $surveyObtainPercentage = round($surveyObtainPercentage);
                    $examRemarkMaster->final_obtain_percentage = $surveyObtainPercentage;
                    $examRemarkMaster->last_update_at = now();
                    $examRemarkMaster->save();
                }
            }
            
            // artificial intelligence
            if ($examRemarkMaster->exam_type == '9') {
                $artificialIntelligences = DB::table('exam_artificial_intelligence')
                    ->where('exam_artificial_intelligence.id', $examRemarkMaster->exam_id)
                    ->where('exam_artificial_intelligence.is_deleted', "No")
                    ->leftJoin('exam_artificial_intelligence_questions', 'exam_artificial_intelligence_questions.artificial_intelligence_id', '=', 'exam_artificial_intelligence.id')
                    ->select('exam_artificial_intelligence.id', 'exam_artificial_intelligence.percentage', DB::raw('SUM(CASE WHEN exam_artificial_intelligence_questions.is_deleted = "No" THEN exam_artificial_intelligence_questions.marks ELSE 0 END) as total_marks'))
                    ->groupBy('exam_artificial_intelligence.id', 'exam_artificial_intelligence.percentage')
                    ->get();
                

                if (count($artificialIntelligences)>0) {
                    foreach ($artificialIntelligences as $artificialIntelligence) {
                        $artificialIntelligenceAnswers = DB::table('exam_artificial_intelligence_answers')
                            ->where(['student_course_master_id' => $student_course_master_id, 'user_id' => $studentId, 'is_active' => '1'])
                            ->whereIn('question_id', function($query) use ($artificialIntelligence) {
                                $query->select('id')
                                    ->from('exam_artificial_intelligence_questions')
                                    ->where('artificial_intelligence_id', $artificialIntelligence->id);
                            })
                            ->get();

                            if($artificialIntelligenceAnswers){

                                foreach ($artificialIntelligenceAnswers as $examArtificialIntelligenceAnswer) {
                                    if ($examArtificialIntelligenceAnswer->marks_given != '') {
                                        $artificialIntelligenceTotalMarksObtain += $examArtificialIntelligenceAnswer->marks_given;
                                    }
                                }
                            }
        
                        $artificialIntelligenceTotalMarks += $artificialIntelligence->total_marks;
                    }
                    $artificialIntelligenceObtainPercentage = $artificialIntelligenceTotalMarksObtain * $artificialIntelligences[0]->percentage/$artificialIntelligences[0]->total_marks;

                    $artificialIntelligenceObtainPercentage = round($artificialIntelligenceObtainPercentage);
                    $examRemarkMaster->final_obtain_percentage = $artificialIntelligenceObtainPercentage;
                    $examRemarkMaster->last_update_at = now();
                    $examRemarkMaster->save();
                }
            }
        }
        
        $eportfolio = DB::table('exam_eportfolio')->where([
            'exam_eportfolio.student_course_master_id' => $student_course_master_id,
            'exam_eportfolio.user_id' => $studentId,
            'exam_eportfolio.course_id' => $courseId,
        ])->where('remark', '!=', null)->count();

        if(isset($eportfolio) && $eportfolio > 0)
        {
            if ($courseExamCount == $completedExamCount) {
                $course = DB::table('course_master')->where('id', $courseId)->first();
                $minPercentage = 45;
                if (!is_null($course)) {
                    $minPercentage = $course->course_cuttoff_perc;
                }
                $percentage = number_format($assignmentObtainPercentage + $mockObtainPercentage + $vlogObtainPercentage, 0);
                $studentCourseMaster = DB::table('student_course_master')->where([
                    'course_id' => $courseId,
                    'user_id' => $studentId,
                ])->latest()->first();

                $eportfolioPass = DB::table('exam_eportfolio')->where([
                    'exam_eportfolio.student_course_master_id' => $student_course_master_id,
                    'exam_eportfolio.user_id' => $studentId,
                    'exam_eportfolio.course_id' => $courseId,
                    'exam_eportfolio.remark' => '1'
                ])->latest()->first();

                if(isset($eportfolioPass) && !empty($eportfolioPass)){
                    
                    $updateData = [
                        'exam_score' => $assignmentTotalMarksObtain + $mockTotalMarksObtain + $vlogTotalMarksObtain,
                        'remark_update_on' => now(),
                        'exam_perc' => $percentage,
                    ];
                }

                $eportfolioFail = DB::table('exam_eportfolio')->where([
                    'exam_eportfolio.student_course_master_id' => $student_course_master_id,
                    'exam_eportfolio.user_id' => $studentId,
                    'exam_eportfolio.course_id' => $courseId,
                    'exam_eportfolio.remark' => '0'
                ])->latest()->first();
                
                if(isset($eportfolioFail) && !empty($eportfolioFail)){
                    
                    $updateData = [
                        'exam_score' => $assignmentTotalMarksObtain + $mockTotalMarksObtain + $vlogTotalMarksObtain,
                        'remark_update_on' => now(),
                        'exam_perc' => $percentage,
                    ];
                }

                $student = DB::table('users')->where('id', $studentId)->first();
                $course = DB::table('course_master')->where('id', $courseId)->first();
            
                DB::table('student_course_master')->where('id', $student_course_master_id)->update($updateData);

            }
        }
    }

    public function courseDetail($id)
    {
        $course = DB::table('course_master')->where('id', base64_decode($id))->first(['course_title', 'course_subheading', 'ects', 'mqfeqf_level', 'course_final_price', 'course_old_price', DB::raw("TO_BASE64(id) as id"), 'ementor_id']);
        $enrolledStudents = 0;
        $activeStudents = 0;
        $passStudents = 0;
        $failStudents = 0;
        $pendingExamStudent = 0;
        $averageExamPerc = 0;
        if($course){
            if($course){
                $pendingExamStudent = DB::table('exam_remark_master')
                    ->join('users', 'users.id', 'exam_remark_master.user_id')
                    ->where(['course_id' => base64_decode($course->id), 'users.is_active' => 'Active'])
                    ->where('is_cheking_completed', '0')
                    ->count();

                $averageExamPerc = DB::table('exam_remark_master')
                    ->join('student_course_master', 'student_course_master.course_id', '=', 'exam_remark_master.course_id')
                    ->where([
                        'exam_remark_master.course_id' => base64_decode($course->id), 
                        'exam_remark_master.is_cheking_completed' => '2'
                    ])
                    ->whereNotNull('student_course_master.exam_perc')
                    ->selectRaw('ROUND(AVG(student_course_master.exam_perc)) as avg_exam_perc')
                    ->value('avg_exam_perc');
            }
            
            $studentCourseMasters = DB::table('student_course_master as scm1')
                ->join(DB::raw('(SELECT MAX(id) as max_id FROM student_course_master WHERE course_id = ' . base64_decode($course->id) . ' GROUP BY user_id) as scm2'), 'scm1.id', '=', 'scm2.max_id')
                ->select('scm1.*')
                ->orderBy('scm1.course_start_date', 'desc')
                ->get();

            if (count($studentCourseMasters) > 0) {
                $courseId = base64_decode($course->id);
                $enrolledStudentCourseMasters = DB::table('student_course_master')
                    ->where('course_id', $courseId)
                    ->where('is_deleted','No')
                    ->orderBy('course_start_date', 'desc')
                    ->get();

                $enrolledStudents = $this->getEnrolledStudent($enrolledStudentCourseMasters, $courseId)['count'];
                $activeStudents =  $this->getActiveStudent($studentCourseMasters, $courseId)['count'];
                $passStudents =  $this->getPassStudent($studentCourseMasters, $courseId)['count'];
                $failStudents =  $this->getFailStudent($studentCourseMasters, $courseId)['count'];
            }

        }

        $totalStudents = $passStudents+$failStudents;
        $passingStudentRatio = $totalStudents > 0 ? ($passStudents / $totalStudents) * 100 : 0;

        $passingStudentRatio = round($passingStudentRatio, 2);

      
        $data = [
            'course' => $course,
            'enrolledStudents' => $enrolledStudents,
            'activeStudents' => $activeStudents,
            'passStudents' => $passStudents,
            'failStudents' => $failStudents,
            'pendingExamStudent' => $pendingExamStudent,
            'averageExamPerc' => $passingStudentRatio,
        ];
        return $data;
    }

    function getEnrolledStudent($enrolledStudentCourseMasters, $courseId) {
        $students = [];
        $uniqueStudentIds = [];
        foreach ($enrolledStudentCourseMasters as $studentCourseMaster) {
            $order = DB::table('orders')->where(['user_id' => $studentCourseMaster->user_id, 'course_id' => $courseId, 'status' => '0'])->latest()->first(['user_id']);
            $course = getData('course_master', ['ementor_id'], ['id' => $courseId]);
            $ementorId = $course[0]->ementor_id ? $course[0]->ementor_id : 0;
            if ($order) {
                $student =  $this->fetchEnrolledStudentDetails($order->user_id, $courseId, $studentCourseMaster->course_start_date, $ementorId, $studentCourseMaster->id);
                if ($student) {
                    if (!in_array($student->scmId, $uniqueStudentIds)) {
                        $students[] = $student;
                        $uniqueStudentIds[] = $student->scmId;
                    }
                }
            }
        }

        return [
            'count' => count($students),
            'data' => $students,
        ];
    }

    function getActiveStudent($studentCourseMasters, $courseId) {
        $students = [];
        foreach ($studentCourseMasters as $studentCourseMaster) {
            $order = DB::table('orders')->where(['user_id' => $studentCourseMaster->user_id, 'course_id' => $courseId, 'status' => '0'])->latest()->first(['user_id']);
            $course = getData('course_master', ['ementor_id'], ['id' => $courseId]);
            $ementorId = $course[0]->ementor_id ? $course[0]->ementor_id : 0;
            if ($order) {
                $student =  $this->fetchActiveStudentDetails($order->user_id, $courseId, $studentCourseMaster->course_start_date, $ementorId);
                if ($student) {
                    $students[] = $student; 
                }
            }
        }
        return [
            'count' => count($students),
            'data' => $students,
        ];
    }

    function getPassStudent($studentCourseMasters, $courseId) {
        $students = [];
        foreach ($studentCourseMasters as $studentCourseMaster) {
            $order = DB::table('orders')->where(['user_id' => $studentCourseMaster->user_id, 'course_id' => $courseId, 'status' => '0'])->latest()->first(['user_id']);

            if ($order) {
                $studentDetails = $this->fetchPassStudentDetails($order->user_id, $courseId, $studentCourseMaster->course_start_date);
                if ($studentDetails) {
                    $students = array_merge($students, $studentDetails->toArray()); 
                }
            }
        }
        return [
            'count' => count($students),
            'data' => $students,
        ];
    }

    function getFailStudent($studentCourseMasters, $courseId) {
        $students = [];
        foreach ($studentCourseMasters as $studentCourseMaster) {
            $order = DB::table('orders')->where(['user_id' => $studentCourseMaster->user_id, 'course_id' => $courseId, 'status' => '0'])->latest()->first(['user_id']);
            if ($order) {
                $studentDetails = $this->fetchFailStudentDetails($order->user_id, $courseId, $studentCourseMaster->course_start_date);
                if ($studentDetails) {
                    $students = array_merge($students, $studentDetails->toArray()); 
                }
            }
        }
        return [
            'count' => count($students),
            'data' => $students,
        ];
    }

    function fetchEnrolledStudentDetails($userId, $courseId, $course_start_date, $ementorId, $scmId) {
        return DB::table('student_course_master')
            ->join('users', 'users.id', '=', 'student_course_master.user_id')
            ->join('student_doc_verification', 'student_doc_verification.student_id', '=', 'users.id')
            ->join('orders', 'orders.user_id', '=', 'users.id')
            ->join('course_master', 'course_master.id', '=', 'student_course_master.course_id')
            ->select(
                DB::raw("TO_BASE64(users.id) as userId"),
                'users.photo',
                'users.name',
                'users.last_name',
                'course_master.course_title',
                DB::raw("DATE_FORMAT(student_course_master.created_at, '%Y-%m-%d') as created_at"),
                'student_course_master.exam_remark',
                DB::raw("TO_BASE64(course_master.id) as courseId"),
                'student_course_master.exam_perc',
                'student_course_master.course_start_date',
                'student_course_master.id as scmId'
            )
            ->where([
                'student_course_master.id' => $scmId,
                'course_master.ementor_id' => $ementorId,
                'student_course_master.course_id' => $courseId,
                'student_course_master.course_start_date' => $course_start_date,
                'users.id' => $userId,
                'users.is_active' => 'Active',
                'orders.status' => '0',
                'student_doc_verification.identity_is_approved' => 'Approved',
                'student_doc_verification.edu_is_approved' => 'Approved'
            ])
            ->where('english_score', '>=', '10')
            ->whereNotNull('resume_file')
            ->first();
    }

    function fetchActiveStudentDetails($userId, $courseId, $course_start_date, $ementorId) {
        return DB::table('users')
            ->join('student_course_master', 'student_course_master.user_id', '=', 'users.id')
            ->join('orders', 'orders.user_id', '=', 'users.id')
            ->join('course_master', 'course_master.id', '=', 'student_course_master.course_id')
            ->select(
                DB::raw("TO_BASE64(users.id) as userId"),
                'users.name',
                'users.last_name',
                'users.email',
                'users.photo',
                'course_master.course_title',
                DB::raw("DATE_FORMAT(student_course_master.created_at, '%Y-%m-%d') as created_at"),
                'student_course_master.exam_perc',
                'student_course_master.exam_remark',
                'student_course_master.exam_attempt_remain',
                DB::raw("TO_BASE64(course_master.id) as courseId"),
                'student_course_master.course_start_date',
                'student_course_master.id as scmId'
            )
            ->where('course_master.ementor_id', $ementorId)
            ->where('student_course_master.course_id', $courseId)
            ->where('users.id', $userId)
            ->where('users.is_verified', 'Verified')
            ->where('student_course_master.course_expired_on', '>', now())
            ->where('users.is_active', 'Active')
            ->where(function ($query) {
                $query->whereRaw("IF(student_course_master.exam_attempt_remain = 1, DATE_ADD(student_course_master.course_expired_on, INTERVAL 15 DAY), student_course_master.course_expired_on) > NOW()")
                    ->where(function ($subquery) {
                        $subquery->where('student_course_master.exam_remark', '!=', '1')
                            ->orWhereNull('student_course_master.exam_remark');
                    })
                    ->where(function ($subquery) {
                        $subquery->where('student_course_master.exam_attempt_remain', '!=', 0)
                            ->orWhere('student_course_master.exam_attempt_remain', '>', 0);
                    });
            })
            ->whereIn('orders.id', function ($subquery) use ($userId) {
                $subquery->select(DB::raw('MAX(id)'))
                    ->from('orders')
                    ->where('user_id', $userId)
                    ->groupBy('course_id', 'user_id');
            })
            ->first();
    }

    function fetchPassStudentDetails($userId, $courseId, $course_start_date) {
        return DB::table('users')
            ->join('student_course_master', 'student_course_master.user_id', '=', 'users.id')
            ->join('student_doc_verification', 'student_doc_verification.student_id', 'student_course_master.user_id')
            ->join('course_master', 'course_master.id', '=', 'student_course_master.course_id')
            ->select(
                DB::raw("TO_BASE64(users.id) as userId"),
                'users.name',
                'users.last_name',
                'users.email',
                'users.photo',
                'course_master.course_title',
                DB::raw("DATE_FORMAT(student_course_master.created_at, '%Y-%m-%d') as created_at"),
                'student_course_master.exam_perc',
                'student_course_master.exam_remark',
                DB::raw("TO_BASE64(course_master.id) as courseId"),
                'student_course_master.course_start_date',
                'student_course_master.id as scmId'
            )
            ->where('student_doc_verification.identity_is_approved', 'Approved')
            ->where('student_doc_verification.edu_is_approved', 'Approved')
            ->whereNotNull('resume_file')
            ->where('student_course_master.course_id', $courseId)
            ->where('users.id', $userId)
            ->where('users.is_active', 'Active')
            ->where('student_course_master.exam_remark', '1')
            ->where('users.last_seen', '>=', now()->subMonths(6))
            ->orderBy('student_course_master.remark_update_on', 'desc')
            ->get();
    }
    
    function fetchFailStudentDetails($userId, $courseId, $course_start_date) {
        return DB::table('users')
            ->join('student_course_master', 'student_course_master.user_id', '=', 'users.id')
            ->join('student_doc_verification', 'student_doc_verification.student_id', '=', 'student_course_master.user_id')
            ->join('course_master', 'course_master.id', '=', 'student_course_master.course_id')
            ->select(
                DB::raw("TO_BASE64(users.id) as userId"),
                'users.name',
                'users.last_name',
                'users.email',
                'users.photo',
                'course_master.course_title',
                DB::raw("DATE_FORMAT(student_course_master.created_at, '%Y-%m-%d') as created_at"),
                'student_course_master.exam_perc',
                'student_course_master.exam_remark',
                DB::raw("TO_BASE64(course_master.id) as courseId"),
                'student_course_master.course_start_date',
                'student_course_master.id as scmId'
            )
            ->where([
                'student_doc_verification.identity_is_approved' => 'Approved',
                'student_doc_verification.edu_is_approved' => 'Approved',
                'student_course_master.course_id' => $courseId,
                'users.id' => $userId,
                'users.is_active' => 'Active',
                'student_course_master.exam_remark' => '0'
            ])
            ->whereNotNull('resume_file')
            ->orderBy('student_course_master.remark_update_on', 'desc')
            ->get();
    }
    
    
    public function getportfolioQuestionAnswer($studentId, $courseId, $studentCourseMasterId)
    {
        if (isset($studentId) && !empty($studentId) && isset($courseId) && !empty($courseId)) {
            $portfolioData = DB::table('exam_eportfolio')
                ->select(
                    'exam_eportfolio.id as eportfolioId',
                    'exam_eportfolio.title',
                    'exam_eportfolio.remark',
                    'users.id as userId',
                    'users.name',
                    'users.last_name',
                    'course_master.course_title',
                    'course_master.id as courseId',
                    'exam_eportfolio.student_course_master_id',
                )
                ->join('users', 'users.id', '=', 'exam_eportfolio.user_id')
                ->join('course_master', 'course_master.id', '=', 'exam_eportfolio.course_id')
                ->where([
                    'exam_eportfolio.user_id' => base64_decode($studentId),
                    'exam_eportfolio.course_id' => base64_decode($courseId),
                    'exam_eportfolio.student_course_master_id' => base64_decode($studentCourseMasterId),
                ])
                ->get();
            
            $formattedPortfolioData = [];
            
            foreach ($portfolioData as $portfolio) {
                $answers = DB::table('exam_eportfolio_answers')
                    ->select('answer')
                    ->where('eportfolio_id', $portfolio->eportfolioId)
                    ->get();
                    
                $course = getData('student_course_master', ['course_id'], ['id' => $portfolio->student_course_master_id]);
                    $actualCourseId = 0;
                if (isset($course) && !empty($course)) {
                    $actualCourseId = $course[0]->course_id;
                };
                
            
                $formattedPortfolioData[] = [
                    'eportfolioId' => $portfolio->eportfolioId,
                    'name' => $portfolio->name,
                    'userId' => base64_encode($portfolio->userId),
                    'title' => $portfolio->title,
                    'remark' => $portfolio->remark,
                    'last_name' => $portfolio->last_name,
                    'course_title' => $portfolio->course_title,
                    'courseId' => base64_encode($portfolio->courseId),
                    'student_course_master_id' => base64_encode($portfolio->student_course_master_id),
                    'actualCourseId' => base64_encode($actualCourseId),
                    'answers' => $answers
                ];
            }
            
            return $formattedPortfolioData;
        }
    }
    
    public function studentList($ementorId, $courseId, $status)
    {
        $courseId = base64_decode($courseId);
        $enrolledStudents = [];
        $activeStudents = [];
        $passStudents = [];
        $failStudents = [];
        
        $studentCourseMasters = DB::table('student_course_master as scm1')
            ->join(DB::raw('(SELECT MAX(id) as max_id FROM student_course_master WHERE course_id = ' . $courseId . ' GROUP BY user_id) as scm2'), 'scm1.id', '=', 'scm2.max_id')
            ->where('scm1.is_deleted', 'No')
            ->select('scm1.*')
            ->orderBy('scm1.course_start_date', 'desc')
            ->get();

        if (count($studentCourseMasters) > 0) {
            $enrolledStudentCourseMasters = DB::table('student_course_master')
                ->where(['course_id' => $courseId, 'is_deleted' => 'No'])
                ->orderBy('course_start_date', 'desc')
                ->get();

            $enrolledStudents = $this->getEnrolledStudent($enrolledStudentCourseMasters, $courseId)['data'];
            $activeStudents =  $this->getActiveStudent($studentCourseMasters, $courseId)['data'];
            $passStudents =  $this->getPassStudent($studentCourseMasters, $courseId)['data'];
            $failStudents =  $this->getFailStudent($studentCourseMasters, $courseId)['data'];
        }

        if ($status === '4') {
            $studentData = $failStudents;
            return $studentData;
        } elseif ($status === '5') {
            $studentData = $passStudents;
            return $studentData;
        } elseif ($status === '6') {
            $studentData = $activeStudents;
            return $studentData;
        } elseif ($status === '7') {
            $students = $enrolledStudents;
            return $students;
        }
    }

} 
// {
//     $AssignmentData = [];
//     $query = $this->with(['AwardCourse' => function ($query) {
//         $query->select('id', 'course_title');
//     }])->with(['AssigQuestion' => function ($query) {
//         $query->select('id', 'question', 'assignment_mark', 'assignments_id');
//     }])->with(['AssigQuestion.AssigAnwers' => function ($query) {
//         $query->where(['course_id' => 58, 'user_id' => 32]);
//     }])->orderByDesc('id');

//     $where = ['course_id' => 58, 'user_id' => 32, 'exam_id' => $examId];
//     if (isset($where) && count($where) > 0 && is_array($where)) {
//         $AssignmentData = $query->where($where)->get()->toArray();
//     } else {
//         $AssignmentData = $query->get()->toArray();
//     }
//     return $AssignmentData;
// }