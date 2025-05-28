<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\{StudentDocument, AssignmentModule, PaymentModule, StudentProfile, CourseModule as CourseCollection, SectionModel as Section, CourseVideoModule as VideosData, JournalArticle as JournalArticle, CourseManagement as CourseManage, QuizSection as Quiz, EmentorProfile, AssignmentModule as Assignment, ExamManage, MockExam, MockExamQuestion, User, ExamRemarkMaster as ExamRemark, AssignmentAnswers, MockExamAnswers, VlogModule, VlogAnswers, PeerReviewModule, PeerReviewAnswers, DiscordModule, ReflectiveJournalModule, McqModule, McqAnswers, SurveyModule, SurveyAnswers, FinalThesisModule, ArtificialIntelligenceModule, ArtificialIntelligenceAnswer, InstituteProfile, SalesExecutiveProfile, MasterCourseManagement, SectionManagement as SectionManage, EmentorSubementorRelation, certificateModel as Certificate, StudentCourseModel as StudentMaster,CourseOtherDetail,CertificateIssue, DraftExam};
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $predictOptions;
    public $currentDate;
    public $time;
    public $date;
    public $user_id;
    public $userProfile;
    public $studentDocument;
    public $videosData;
    public $CourseModule;
    public $section;
    public $articleDocs;
    public $PaymentModule;
    public $AssignmentModule;
    public $CourseManage;
    public $Quiz;
    public $Ementor;
    public $EmentorProfile;
    public $assignment;
    public $examManage;
    public $mockExam;
    public $mockQuestions;
    public $user;
    public $ExamRemark;
    public $assignmentAnswers;
    public $mockAnswers;
    public $studentRemarkMaster;
    public $vlogModule;
    public $vlogAnswers;
    public $peerReviewModule;
    public $peerReviewAnswers;
    public $discordModule;
    public $reflectiveJournalModule;
    public $mcqModule;
    public $mcqAnswers;
    public $surveyModule;
    public $surveyAnswers;
    public $finalThesisModule;
    public $artificialIntelligenceModule;
    public $artificialIntelligenceAnswers;
    public $instituteProfile;
    public $salesExecutiveProfile;
    public $MasterCourseManage;
    public $sectionManage;
    public $ementorSubementorRelation;
    public $Certificate;
    public $StudentMaster;
    public $CourseOtherDetail;
    public $CertificateIssue;
    public $DraftExam;

    public function __construct()
    {
        $this->currentDate = Carbon::now('Europe/Malta');
        $this->time = $this->currentDate->format('Y-m-d H:i:s');
        $this->date = $this->currentDate->format('Y-m-d');
        $this->userProfile = new StudentProfile;
        $this->studentDocument = new StudentDocument;
        $this->CourseModule = new CourseCollection;
        $this->videosData = new VideosData;
        $this->section = new Section;
        $this->articleDocs = new JournalArticle;
        $this->AssignmentModule = new AssignmentModule;
        $this->PaymentModule = new PaymentModule;
        $this->CourseManage = new CourseManage;
        $this->Quiz = new Quiz;
        $this->EmentorProfile = new EmentorProfile;
        $this->assignment = new Assignment;
        $this->examManage = new ExamManage;
        $this->mockExam = new MockExam;
        $this->mockQuestions = new MockExamQuestion;
        $this->user = new User;
        $this->ExamRemark = new ExamRemark;
        $this->assignmentAnswers = new AssignmentAnswers;
        $this->mockAnswers = new MockExamAnswers;
        $this->vlogModule = new VlogModule;
        $this->vlogAnswers = new VlogAnswers;
        $this->peerReviewModule = new PeerReviewModule;
        $this->peerReviewAnswers = new PeerReviewAnswers;
        $this->discordModule = new DiscordModule;
        $this->reflectiveJournalModule = new ReflectiveJournalModule;
        $this->mcqModule = new McqModule;
        $this->mcqAnswers = new McqAnswers;
        $this->surveyModule = new SurveyModule;
        $this->surveyAnswers = new SurveyAnswers;
        $this->finalThesisModule = new FinalThesisModule;
        $this->artificialIntelligenceModule = new ArtificialIntelligenceModule;
        $this->artificialIntelligenceAnswers = new ArtificialIntelligenceAnswer;
        $this->instituteProfile = new InstituteProfile;
        $this->salesExecutiveProfile = new SalesExecutiveProfile;
        $this->MasterCourseManage = new MasterCourseManagement; 
        $this->sectionManage= new sectionManage;
        $this->ementorSubementorRelation= new EmentorSubementorRelation;
        $this->Certificate = new Certificate;
        $this->StudentMaster = new StudentMaster;
        $this->CourseOtherDetail= new CourseOtherDetail;
        $this->CertificateIssue = new CertificateIssue;
        $this->DraftExam = new DraftExam;
    }
}