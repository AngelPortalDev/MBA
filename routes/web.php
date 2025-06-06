<?php


use App\Http\Controllers\{
    ProfileController,
    UserController,
    AdminController,
    CartController,
    PaymentController,
    WebhookController,
    CourseController,
    CommonController,
    Exam\QuizController,
    Exam\AssignmentController as Assignment,
    Exam\MockInterviewController as MockInterview,
    Exam\VlogController as Vlog,
    Exam\PeerReviewController as PeerReview,
    Exam\DiscordController as Discord,
    Exam\ReflectiveJournalController as ReflectiveJournal,
    Exam\MCQController as MCQ,
    Exam\SurveyController as Survey,
    Exam\ArtificialIntelligenceController as ArtificialIntelligence,
    Blockchain\BlockchainController as EtherContract,
    EmentorController,
    SubEmentorController,
    InstituteController
};
use App\Http\Controllers\Admin\{
    CommonAdminController as AdminCommon,
    ExamControllers\QuizController as AdminQuiz,
    ExamControllers\AssignmentAdminController as AdminAssignment,
    ExamControllers\InterviewExamController as AdminMock,
    ExamControllers\VlogAdminController as AdminVlog,
    ExamControllers\PeerReviewAdminController as AdminPeerReview,
    ExamControllers\DiscordAdminController as AdminDiscord,
    ExamControllers\ReflectiveJournalAdminController as AdminReflectiveJournal,
    ExamControllers\MCQAdminController as AdminMCQ,
    ExamControllers\SurveyAdminController as AdminSurvey,
    ExamControllers\FinalThesisAdminController as AdminFinalThesis,
    ExamControllers\ArtificialIntelligenceAdminController as AdminArtificialIntelligence,
    CourseControllers\CourseAdminController as AdminCourse,
    StudentController\StudentAdminController,
    SectionControllers\CourseVideoController as SectionVideo,
    SectionControllers\JournalArticleAdminController as JounalArticleAdmin,
    PaymentsControllers\PaymentAdminController as AdminPayment,
    TeacherAdminController,
    EmentorAdminController,
    SubEmentorAdminController,
    SettingController as AdminSetting,
    InstituteAdminController as AdminInstitute,
    SalesExecutiveAdminController as AdminSalesExecutive,
    CertificateController as Certificate,
    TestimonialsAdminController as AdminTestimonials
};
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Auth;
use Spatie\Honeypot\ProtectAgainstSpam;






/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::middleware(ProtectAgainstSpam::class)->group(function () {
//     Auth::routes();
// });
Route::get('verfiy-mail/{id}', [UserController::class, 'verifyMail']);
Route::post('blockchain', [EtherContract::class, 'issueCertData'])->name('metaData');
Route::post('transfer-certificate', [EtherContract::class, 'transferNft'])->name('transferNft');
Route::get('thank-you-verification/{email}',  [UserController::class, 'thankYouVerification']);
Route::post('student-login', [UserController::class, 'StudentLogin']);
Route::post('student-email-verified', [UserController::class, 'StudentVerified']);
// Route::post('/redirect-to-login-for-checkout', [UserController::class, 'redirectToLoginForCheckout'])->name('redirectToLoginForCheckout');

Route::get('/', function () {
    // if (Auth::check() && (Auth::user()->role == 'instructor' || Auth::user()->role == 'sub-instructor')) {
    //     $previousUrl = url()->previous();
    //     if ($previousUrl == url('/not-found')) {
    //         return redirect()->route('e-mentor-profile'); // Redirect to e-mentor-profile
    //     }
    //     return redirect()->back();
    // }
    return view('frontend/login');
})->name('/');



// Try Route
Route::get('/try', function () {
    return Carbon::now()->toDateTimeString();
});
// Auth::routes(['verify'=>'true']);

Route::view('index', 'frontend/index')->name('index');
Route::view('about-us', 'frontend/about-us')->name('about-us');
Route::view('contact-us', 'frontend/contact-us')->name('contact-us');
Route::view('our-teachers', 'frontend/our-teachers')->name('our-teachers');
Route::view('partner-university', 'frontend/partner-university')->name('partner-university');
Route::view('not-found', 'frontend/not-found')->name('not-found');
Route::view('internal-server', 'frontend/internal-server')->name('internal-server');
Route::view('page-expired', 'frontend/page-expired')->name('page-expired');
Route::view('too-many-request', 'frontend/too-many-request')->name('too-many-request');
Route::get('/unsubscribe/{email}', [UserController::class, 'unsubscribe'])->name('unsubscribe');
Route::view('coming-soon', 'frontend/coming-soon')->name('coming-soon');


Route::view('survey-answersheet', 'frontend/survey-answersheet')->name('survey-answersheet');

Route::view('final-thesis-answersheet', 'frontend/final-thesis-answersheet')->name('final-thesis-answersheet');

Route::view('email-id-verification', 'frontend/email-id-verification')->name('email-id-verification');
// Route::view('mobile-number-verification', 'frontend/mobile-number-verification')->name('mobile-number-verification');

Route::get('/mobile-number-verification/{email}', [UserController::class, 'mobileNumberVerification'])->name('mobile-number-verification')->middleware([ProtectAgainstSpam::class, 'email_verification_access']);
Route::post('/resendOTP/{mobile}/{email}', [UserController::class, 'resendOTP'])->name('resendOTP')->middleware('throttle:3,15')->middleware(ProtectAgainstSpam::class);

Route::post('/verifyOTP', [UserController::class, 'verifyOTP'])->name('verifyOTP');
Route::view('thank-you-verification', 'frontend/thank-you-verification')->name('thank-you-verification');
Route::post('/change-mobile-number', [UserController::class, 'changeMobileNumber'])->name('changeMobileNumber');
Route::view('vlog-answersheet', 'frontend/vlog-answersheet')->name('vlog-answersheet.blade');
Route::view('peer-review-answersheet', 'frontend/peer-review-answersheet')->name('peer-review-answersheet.blade');
Route::view('forum-leadership-answersheet', 'frontend/forum-leadership-answersheet')->name('forum-leadership-answersheet');
Route::view('reflective-journals-answersheet', 'frontend/reflective-journals-answersheet')->name('reflective-journals-answersheet.blade');



Route::view('faq', 'frontend/faq')->name('faq');
Route::view('terms-and-conditions', 'frontend/terms-and-conditions')->name('terms-and-conditions');
Route::view('privacy-policy', 'frontend/privacy-policy')->name('privacy-policy');
Route::view('cookies', 'frontend/cookies')->name('cookies');

Route::view('shopping-cart', 'frontend/payment/shopping-cart')->name('shopping-cart');
Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout')->middleware('student.checkout');
Route::view('demo-shopping-cart', 'frontend/payment/demo-shopping-cart')->name('demo-shopping-cart');
Route::view('teacher-registration-success', 'frontend/teacher-registration-success')->name('teacher-registration-success');

Route::get('/institute/pending-approval', [InstituteController::class, 'pendingApproval'])->name('institute-pending-approval');


// Route::post('getcouponCode', [CartController::class, 'CouponCode']);
// // Route::post('getCheckout', [PaymentController::class,'getCheckout']);
// Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
// Route::get('/success', [PaymentController::class, 'success'])->name('success');
// Route::get('/cancel', [PaymentController::class, 'cancel'])->name('cancel');
// Route::post('/paymentProcess', [PaymentController::class, 'payment']);
Route::post('/stripe_webhook', [PaymentController::class, 'stripe_webhook']);

// // Route::view('receipt', 'frontend/payment/receipt')->name('receipt');
// // Route::view('invoice', 'frontend/payment/invoice')->name('invoice');

// Route::post('order-thank-you', [PaymentController::class, 'thankyoupage'])->name('order-thank-you');
// Route::view('payment-successful', 'frontend/payment/payment-successful')->name('payment-successful');
// Route::view('payment-unsuccessful', 'frontend/payment/payment-unsuccessful')->name('payment-unsuccessful');

Route::view('english-test-pass', 'frontend/email/english-test-pass')->name('english-test-pass');
Route::view('english-test-fail', 'frontend/email/english-test-fail')->name('english-test-fail');
Route::view('mail-registration', 'frontend/email/mail-registration')->name('mail-registration');
Route::view('email-verification', 'frontend/email/email-verification')->name('email-verification');
Route::view('email-verified', 'frontend/email/email-verified')->name('email-verified');
Route::view('documents-verified', 'frontend/email/documents-verified')->name('documents-verified');
Route::view('documents-unverified', 'frontend/email/documents-unverified')->name('documents-unverified');
Route::view('documents-sent-for-approval', 'frontend/email/documents-sent-for-approval')->name('documents-sent-for-approval');
Route::view('documents-rejected', 'frontend/email/documents-rejected')->name('documents-rejected');
Route::view('course-not-enrolled', 'frontend/email/course-not-enrolled')->name('course-not-enrolled');
Route::view('course-not-purchase', 'frontend/email/course-not-purchase')->name('course-not-purchase');
Route::view('terms-and-condition', 'frontend/email/terms-and-condition')->name('terms-and-condition');
Route::view('technical-assistance', 'frontend/email/technical-assistance')->name('technical-assistance');
Route::view('course-enrolled', 'frontend/email/course-enrolled')->name('course-enrolled');
Route::view('course-completion', 'frontend/email/course-completion')->name('course-completion');
Route::view('reset-password', 'frontend/email/reset-password')->name('reset-password');
Route::view('assessment-pass', 'frontend/email/assessment-pass')->name('assessment-pass');
Route::view('assessment-fail', 'frontend/email/assessment-fail')->name('assessment-fail');
Route::view('assessment-completed', 'frontend/email/assessment-completed')->name('assessment-completed');
Route::view('contact-mail', 'frontend/email/contact-mail')->name('contact-mail');
Route::view('assessment-alert-e-ementor', 'frontend/email/assessment-alert-e-ementor')->name('assessment-alert-e-ementor');
Route::view('payment-successful', 'frontend/email/payment-successful')->name('payment-successful');
Route::view('course-assign-e-mentor', 'frontend/email/course-assign-e-mentor')->name('course-assign-e-mentor');
Route::view('assessment-final-result', 'frontend/email/assessment-final-result')->name('assessment-final-result.blade');
Route::view('password-update', 'frontend/email/password-update')->name('password-update.blade');
Route::view('assignment-submitted', 'frontend/email/assignment-submitted')->name('assignment-submitted.blade');
Route::view('course-purchase-ementor-notification', 'frontend/email/course-purchase-ementor-notification')->name('course-purchase-ementor-notification.blade');
Route::view('course-reminder', 'frontend/email/course-reminder')->name('course-reminder.blade');
Route::view('document-verification', 'frontend/email/document-verification')->name('document-verification.blade');
Route::view('refund-process', 'frontend/email/refund-process')->name('refund-process.blade');
Route::view('access-granted', 'frontend/email/access-granted')->name('access-granted.blade');
Route::view('get-in-touch', 'frontend/email/get-in-touch')->name('get-in-touch.blade');
Route::view('course-expiring', 'frontend/email/course-expiring')->name('course-expiring.blade');
Route::view('ects-selection-reminder', 'frontend/email/ects-selection-reminder')->name('ects-selection-reminder.blade');
Route::view('verification-pending', 'frontend/email/verification-pending')->name('verification-pending.blade');
Route::view('institute-approved', 'frontend/email/institute-approved')->name('institute-approved.blade');
Route::view('institute-rejected', 'frontend/email/institute-rejected')->name('institute-rejected.blade');
Route::view('reverification-institute', 'frontend/email/reverification-institute')->name('reverification-institute.blade');
Route::view('reupload-doc-registration', 'frontend/email/reupload-doc-registration')->name('reupload-doc-registration.blade');
Route::view('master-exam-left-menu', 'frontend/exam/layout/master-exam-left-menu')->name('master-exam-left-menu');
Route::view('blockchain-certificate-ready', 'frontend/email/blockchain-certificate-ready')->name('blockchain-certificate-ready.blade');
Route::view('payment-failed', 'frontend/email/payment-failed')->name('payment-failed.blade');

// Route::view('institute-courses', 'frontend/institute/institute-courses')->name('institute-courses');
// Route::view('institute-dashboard', 'frontend/institute/institute-dashboard')->name('institute-dashboard');
// Route::view('institute-students', 'frontend/institute/institute-students')->name('institute-students');
// Route::view('institute-profiles', 'frontend/institute/institute-profiles')->name('institute-profiles');

Route::view('award-courses', 'frontend/award-courses')->name('award-courses');
Route::view('certificate-courses', 'frontend/certificate-courses')->name('certificate-courses');
Route::view('diploma-courses', 'frontend/diploma-courses')->name('diploma-courses');
Route::view('declaration-form', 'frontend/declaration-form')->name('declaration-form');
Route::view('masters-courses', 'frontend/masters-courses')->name('masters-courses');
Route::view('dba-courses', 'frontend/dba-courses')->name('dba-courses');
// Route::view('podcast-details', 'frontend/podcast-details')->name('podcast-details');
// Route::view('podcast-view', 'frontend/podcast-view')->name('podcast-view');
// Route::view('quiz-view/{section_id}', 'frontend/quiz-view')->name('quiz-view');
// Route::get('video-view/{section_id}', [CommonController::class, 'getEnglishCourseVideo'])->name('video-view');
// Route::get('podcast-view/{section_id}', [CommonController::class, 'getEnglishCoursePodcasts'])->name('podcast-view');
// Route::view('video-instructions/{section_id}', 'frontend/video-instructions')->name('video-instructions');
// Route::view('quiz-questions/{section_id}', 'frontend/quiz-questions')->name('quiz-questions');
Route::view('multiple-choice', 'admin/exam/multiple-choice')->name('multiple-choice');


Route::get('browse-course',[CourseController::class,'getBrowseCourseDetails'] )->name('browse-course');


Route::view('master-course-video-player', 'frontend/master-course-video-player')->name('demo-general-course-video-player');
Route::view('demo-teachers-sections', 'frontend/demo-teachers-sections')->name('demo-teachers-sections');
Route::view('english-course-program', 'frontend/english-course-program')->name('english-course-program');




// Route::view('e-mentor-dashboard', 'frontend/teacher/e-mentor-dashboard')->name('e-mentor-dashboard');
Route::view('e-mentor-courses', 'frontend/teacher/e-mentor-courses')->name('e-mentor-courses');
Route::view('e-mentor-students', 'frontend/teacher/e-mentor-students')->name('e-mentor-students');
// Route::view('e-mentor-profile', 'frontend/teacher/e-mentor-profile')->name('e-mentor-profile');
Route::view('e-mentor-about-me', 'frontend/teacher/e-mentor-about-me')->name('e-mentor-about-me');
Route::view('e-mentor-security', 'frontend/teacher/e-mentor-security')->name('e-mentor-security');
Route::view('e-mentor-social-profile', 'frontend/teacher/e-mentor-social-profile')->name('e-mentor-social-profile');
Route::view('student-details', 'frontend/teacher/student-details')->name('student-details');
Route::get('course-details/{course_id}', [CourseController::class, 'getCourseDetails'])->name('get-course-details');
Route::get('e-mentor-course-details/{course_id}',[EmentorController::class,'getEmentorCourseDetails'])->name('e-mentor-course-details');

Route::view('admin/e-mentors', 'admin/e-mentors/e-mentors')->name('admin.e-mentors.e-mentors');
Route::view('admin/e-mentors-edit', 'admin/e-mentors/e-mentors-edit')->name('admin.e-mentors.e-mentors-edit');
Route::view('admin/award-course-add', 'admin/course/award-course-add')->name('admin.course.award-course-add');
// Route::view('e-mentor-students-exam-details', 'frontend/teacher/e-mentor-students-exam-details')->name('e-mentor-students-exam-details');
Route::get('demo-course-details/{course_id}', [CourseController::class, 'getCourseDetails'])->name('demo-course-details');
// Route::view('admin/demo-e-mentors', 'admin/e-mentors/demo-e-mentors')->name('admin.e-mentors.e-mentors');

// Route::view('admin/certificate', 'admin/adminCertificate/admin-certificate')->name('admin.certificate');
Route::get('admin/certificate',  [Certificate::class,'getStudentCertData'])->name('admin.certificate');

Route::view('admin/sub-e-mentors', 'admin/sub-e-mentors/sub-e-mentors')->name('admin.sub-e-mentors.sub-e-mentors');
Route::view('admin/sub-e-mentors-edit', 'admin/sub-e-mentors/sub-e-mentors-edit')->name('admin.sub-e-mentors.sub-e-mentors-edit');

// Route::view('admin/all-certificate', 'admin/course/all-certificate')->name('admin.course.all-certificate');
Route::get('master-course-details/{course_id}', [CourseController::class, 'getMastersCourseDetails'])->name('get-master-course-details');
Route::view('dba-course-details/{course_id}', 'frontend.dba-course-details')->name('dba-course-details');
Route::post('upload-subementor-document', [SubEmentorController::class, 'uploadDocument'])->name('uploadDocument');

// Route::view('admin/all-diploma', 'admin/course/all-diploma')->name('admin.course.all-diploma');
// Route::view('admin/all-masters', 'admin/course/all-masters')->name('admin.course.all-masters');
Route::view('admin/add-course', 'admin/course/add-course')->name('admin.course.add-course');
Route::view('admin/all-course', 'admin/course/all-course')->name('admin.course.all-course');
// Route::view('certificates', 'admin/certificates/certificates')->name('admin.certificates.certificates');
Route::view('certificate-templates', 'admin/certificates/certificate-templates')->name('admin.certificates.certificate-templates');
Route::post('add-contact-form', [CommonController::class, 'contactForm']);
Route::post('course/addtocart', [CartController::class, 'addtocart'])->middleware('student.checkout');
Route::post('add-profile-image', [UserController::class, 'profilImageUpload']);
Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout')->middleware('student.checkout');
Route::post('/store-intended-wishlist', [CartController::class, 'storeIntendedWishlist'])->name('store-intended-wishlist');
Route::post('/store-intended-cart', [CartController::class, 'storeIntendedCart'])->name('store-intended-cart');
Route::post('/save-snapshot', [CommonController::class, 'saveSnapshot'])->name('save-snapshot');

Route::post('student/addwishlist', [CartController::class, 'addWishlist'])->name('addwishlist')->middleware('student.checkout');
Route::post('/process_callback/{uniq_callback_id}', [PaymentController::class, 'processCallback']);
Route::get('/payment_success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/get-optional_course_data/{course_id}', [CourseController::class, 'optionalCourseData']);
Route::post('/store-optional-course', [CourseController::class, 'StoreOptionalCourse']);
Route::post('/student/profile-update', [UserController::class, 'updateProfile'])->middleware('auth');
Route::view('student_admission', 'frontend/student_admission')->name('student_admission');
Route::view('adminssion_thank_you', 'frontend/adminssion_thank_you')->name('adminssion_thank_you');


Route::get('/search-suggestions', [CommonController::class, 'searchSuggestions'])->name('search-suggestions');



Route::group(['prefix' => 'student', 'middleware' => ['auth', 'roles:user', 'verified']], function () {
    Route::view('english-test', 'frontend/english-test')->name('english-test');
    Route::post('/verify-english-test-code', [CommonController::class, 'verifyEnglishTestCode'])->name('verify.english.test.code');
    Route::post('add-profile-image', [UserController::class, 'profilImageUpload']);
    // Route::view('student-invoice', 'frontend/student/student-invoice')->name('student-invoice');
    Route::get('/download-invoice/{id}/{action}', [UserController::class, 'downloadInvoice'])->name('downloadinvoice');

    Route::post('getcouponCode', [CartController::class, 'CouponCode']);
    // Route::post('getCheckout', [PaymentController::class,'getCheckout']);
    // Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout')->middleware('student.checkout');
    Route::get('/success/{session_id}', [PaymentController::class, 'success'])->name('success');
    Route::get('/cancel', [PaymentController::class, 'cancel'])->name('cancel');
    Route::post('/paymentProcess', [PaymentController::class, 'payment']);
    // Route::post('/stripe_webhook', [PaymentController::class, 'stripe_webhook']);

    Route::post('order-thank-you', [PaymentController::class, 'thankyoupage'])->name('order-thank-you');
    Route::view('payment-successful', 'frontend/payment/payment-successful')->name('frontend.payment.payment-successful');
    Route::view('payment-unsuccessful', 'frontend/payment/payment-unsuccessful')->name('frontend.payment.payment-unsuccessful');
    Route::view('payment-processing', 'frontend/payment/payment-processing')->name('frontend.payment.payment-processing');
    // Route::post('/addwishlist', [CartController::class, 'addWishlist']);
    Route::view('podcast-details', 'frontend/podcast-details')->name('podcast-details');
    Route::view('podcast-view', 'frontend/podcast-view')->name('podcast-view');
    Route::view('quiz-view/{section_id}', 'frontend/quiz-view')->name('quiz-view');
    Route::get('video-view/{section_id}', [CommonController::class, 'getEnglishCourseVideo'])->name('video-view');
    Route::get('podcast-view/{section_id}', [CommonController::class, 'getEnglishCoursePodcasts'])->name('podcast-view');
    Route::view('video-instructions/{section_id}', 'frontend/video-instructions')->name('video-instructions');
    Route::view('quiz-questions/{section_id}', 'frontend/quiz-questions')->name('quiz-questions');


    // Route::view('student-about-me', 'frontend/student/student-about-me')->name('student-about-me');
    Route::controller(UserController::class)->group(function () {
        Route::get('dashboard', 'UserProfile')->name('dashboard');
        // Route::post('/profile-update',  'updateProfile');
        Route::get('student-social-profile',  'UserSocialProfile')->name('student-social-profile');
        Route::get('student-deactivate-account', 'UserCloseAccount')->name('student-deactivate-account');
        Route::get('student-about-me',  'UserAboutMe')->name('student-about-me');
        Route::post('/student-closeaccount', 'closeAccount');
        Route::post('student-social-update',  'updateSocialProfile');
        Route::get('student-document-verification',  'UserVerificationView')->name('student-document-verification');
        Route::get('student-invoice',  'UserInvoice')->name('student-invoice');
        Route::get('receipt/{id}/{action}', 'downloadInvoice')->name('receipt');
        Route::get('student-account-security',  'UserSecurityProfile')->name('student-account-security');
        Route::post('student-change-password',  'updatePassword');
        Route::post('user-doc-verification',  'UserDocCheck');
        Route::delete('/profile',  'destroy')->name('profile.destroy');
        Route::post('/student-aboutme',  'aboutMe');
        Route::post('/student-watchprogess','watchProgress');
        Route::post('/student-watchprogess-check','watchProgressCheck');
        Route::post('/student-videoprogess', 'saveProgress');
        Route::post('/student-getprogess', 'getProgress');
        Route::get('student-my-learning', 'UserStudentLearing')->name('student-my-learning');
        Route::post('/student-englishvideoprogess', 'saveEnglishVideoProgress');

    });
    Route::controller(QuizController::class)->group(function () {
        Route::post('/quiz-submit',  'QuizSubmit');
        Route::post('/quiz-view',  'QuizView');
    });
    Route::controller(Assignment::class)->group(function () {
        Route::get('/assignment',  'assignmentData')->name('assignment');
        Route::post('/assignment-submit',  'assignSubmit');
        Route::get('/examEnvironment/{enc_id}/{student_course_master_id}/{exam_type}', 'examEnvironment')->name('examEnvironment');
    });
    Route::controller(MockInterview::class)->group(function () {
        Route::get('/mock-interview',  'mockData');
        Route::post('/mock-interview-submit',  'mockSubmit');
        Route::post('/mock-content-upload',  'mockContentUpload')->name('mockUpload');
    });
    Route::controller(Vlog::class)->group(function () {
        Route::post('/vlog-submit',  'vlogSubmit');
    });
    Route::controller(PeerReview::class)->group(function () {
        Route::post('/peer-review-submit',  'peerReviewSubmit');
    });
    Route::controller(Discord::class)->group(function () {
        Route::get('/discord/{user_id}/{course_id}/{exam_type}/{student_course_master_id}',  'discordJoin')->name('discordJoin');
    });
    Route::controller(ReflectiveJournal::class)->group(function () {
        Route::post('/submit-reflective-journal-answer',  'submitReflectiveJournalAnswer');
        Route::post('/reflective-journal-submit',  'reflectiveJournalSubmit');
    });
    Route::controller(MCQ::class)->group(function () {
        Route::post('/mcq-submit',  'mcqSubmit');
        Route::post('/mcq-view',  'mcqView');
    });
    Route::controller(ArtificialIntelligence::class)->group(function () {
        Route::post('/artificial-intelligence-submit',  'ArtificialIntelligenceSubmit');
    });

    Route::controller(Survey::class)->group(function () {
        Route::post('/survey-submit',  'surveySubmit');
    });
    Route::controller(CommonController::class)->group(function () {
        Route::get('/exam/{course_id}/{student_course_master_id}/{true?}',  'getExams')->name('exam')->middleware('check.enrollment');
        Route::post('/e-portfolio-submit',  'ePortfolioSubmit');
        Route::post('/english-test-submit',  'englishTestSubmit');
        Route::post('/english-course-quiz-view',  'englishCourseQuizData');
        Route::post('/english-course-quiz-submit',  'englishCourseQuizSubmit');


    });
    Route::get('e-portfolio', [CourseController::class, 'eportfolioData'])->name('e-portfolio');
    Route::get('student-award-course-panel/{course_id}', [CourseController::class, 'getAwardCourseData'])->name('start-course-panel')->middleware('check.enrollment');
    Route::view('mock-interview', 'frontend/exam/mock-interview')->name('mock-interview');
    Route::get('student-master-course-panel/{course_id}', [CourseController::class, 'getMasterCourseData'])->name('master-course-panel')->middleware(['check.enrollment', 'check.optional_course']);

    // Route::view('e-portfolio', 'frontend/exam/e-portfolio')->name('e-portfolio');
    // Route::view('exam', 'frontend/exam/exam')->name('exam');
    Route::view('e-portfolio-new', 'frontend/exam/e-portfolio-new')->name('e-portfolio-new');
});
// Route::view('e-mentor-dashboard', 'frontend/teacher/e-mentor-dashboard')->name('e-mentor-dashboard');

Route::group(['prefix' => 'ementor', 'middleware' => ['auth', 'roles:instructor', 'check_subementor_documentation']], function () {
    // Route::view('dashboard', 'frontend/teacher/dashboard');

    Route::controller(EmentorController::class)->group(function () {
        Route::get('e-mentor-dashboard', 'EmentorDashboard')->name('e-mentor-dashboard');
        Route::get('e-mentor-profile', 'EmentorProfile')->name('e-mentor-profile');
        Route::post('/ementor-profile-update',  'updateEmentorProfile');
        // Route::get('e-mentor-social-profile', 'EmentorSocialProfile')->name('e-mentor-social-profile');
        Route::post('/ementor-social-update',  'updateEmentorSocialProfile');
        // Route::get('e-mentor-about-me', 'EmentorAboutMe')->name('e-mentor-about-me');
        Route::post('/ementor-aboutme',  'updateAboutme');
        // Route::get('e-mentor-security',  'EmentorSecurityProfile')->name('e-mentor-security');
        Route::view('e-mentor-courses', 'frontend/teacher/e-mentor-courses')->name('e-mentor-courses');
        Route::view('e-mentor-students', 'frontend/teacher/e-mentor-students')->name('e-mentor-students');
        Route::get('e-mentor-courses-list', 'assignCoursesList');
        Route::get('get-e-mentor-students-exam/{status?}', 'ementorExamList');
        Route::get('get-students-list/{status?}/{course_id}', 'courseStudentList');
        Route::view('e-mentor-students-exam', 'frontend/teacher/e-mentor-students-exam')->name('e-mentor-students-exam');
        Route::get('e-mentor-students-exam-details/{id}/{course_id}/{student_course_master_id}', 'ementorStudentInfo')->name('e-mentor-students-exam-details');
        Route::get('e-portfolio-answersheet/{user_id}/{course_id}/{student_course_master_id}', 'ementorStudentPortfolioAnswersheet')->name('e-portfolio-answersheet');
        Route::get('answersheet/{examId}/{examType}/{userid}/{student_course_master_id}', 'studentAnswerSheet')->name('answersheet');
        Route::post('/check-submit',  'ementorCheckSubmit');
        Route::post('/without-question/check-submit',  'ementorCheckSubmitWithoutQuestion');
        Route::post('/eportfolio/check-submit',  'ementorEportfolioCheckSubmit');
        Route::get('get-all-students-list', 'ementorAllStudentList');
        Route::post('exam-submit', 'ementorExamSubmit')->name('ementorExamSubmit');
        Route::post('assign-sub-ementor', 'assignSubEmentor')->name('assignSubEmentor');
        // Route::view('e-mentor-profile', 'frontend/teacher/e-mentor-profile')->name('e-mentor-profile');
        // Route::view('e-mentor-about-me', 'frontend/teacher/e-mentor-about-me')->name('e-mentor-about-me');
        // Route::view('e-mentor-security', 'frontend/teacher/e-mentor-security')->name('e-mentor-security');
        Route::view('sub-ementors-list', 'frontend/teacher/sub-ementors-list')->name('sub-ementors-list');
        Route::get('sub-ementors-exam-list-details/{sub_ementor_id}', 'subEmentorsExams')->name('sub-ementors-exams');
        Route::get('get-subementor-list', 'getSubementorList');
        Route::get('subementor-checked-exams/{sub_ementor_id}', 'getCheckedExamsPendingForApproval')->name('subementor.checkedExams');
        Route::post('approve-exam', 'approveExam')->name('ementor.approveExam');
        Route::post('reject-exam', 'rejectExam')->name('ementor.rejectExam');
        Route::get('subementor-approved-exams/{sub_ementor_id}', 'getApprovedExams')->name('subementor.approvedExams');




        Route::get('get-notification', 'getNotification');
        Route::post('mark-notification-read', 'markAsRead');
        Route::post('/check-certificate-exists', 'checkCertificate')->name('ementor.check.certificate.exists');
    });
    Route::post('/generate-cert', [Certificate::class, 'generateCert']);
    // Route::get('e-mentor-certificate',  [Certificate::class,'getStudentCertData'])->name('e-mentor-certificate');

    Route::view('e-mentor-certificate', 'frontend/teacher/e-mentor-certificate')->name('e-mentor-certificate');
    Route::get('e-mentor-certificate-data', [Certificate::class,'getStudentCertData']);
    // Route::view('admin/e-mentors', 'admin/e-mentors/e-mentors')->name('admin.e-mentors.e-mentors');
    // Route::view('e-mentor-students-exam', 'frontend/teacher/e-mentor-students-exam')->name('e-mentor-students-exam');
    // Route::view('e-mentor-students-exam-details', 'frontend/teacher/e-mentor-students-exam-details')->name('e-mentor-students-exam-details');
    // Route::view('e-mentor-dashboard', 'frontend/teacher/e-mentor-dashboard')->name('e-mentor-dashboard');
    // Route::view('/dashboard', 'frontend/index');
    // Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profileUpdate', [UserController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'sub-ementor', 'middleware' => ['auth', 'roles:sub-instructor', 'check_subementor_documentation']], function () {

    Route::controller(SubEmentorController::class)->group(function () {
        Route::get('sub-e-mentor-dashboard', 'subEmentorDashboard')->name('sub-e-mentor-dashboard');
        Route::get('sub-e-mentor-profile', 'subEmentorProfile')->name('sub-e-mentor-profile');
        Route::post('/ementor-profile-update',  'updateEmentorProfile');
        Route::view('sub-e-mentor-students', 'frontend/teacher/e-mentor-students')->name('sub-e-mentor-students');
        Route::get('get-all-students-list', 'allStudentList');
        Route::get('sub-e-mentor-students-exam-details/{id}/{course_id}/{student_course_master_id}', 'ementorStudentInfo')->name('sub-e-mentor-students-exam-details');
        Route::view('documentation', 'frontend/subementor-documentation')->name('subementor-documentation');
    });
});


Route::group(['prefix' => 'institute', 'middleware' => ['auth', 'roles:institute', 'institute.approved']], function () {
    Route::view('institute-dashboard', 'frontend/institute/institute-dashboard')->name('institute-dashboard');
    Route::controller(InstituteController::class)->group(function () {
        Route::get('institute-profiles', 'InstituteProfile')->name('institute-profiles');
        Route::post('institute-profile-update', 'updateInstituteProfile')->name('institute-profile-update');
        Route::get('get-institute-students/{limit}', 'InstituteStudentList');
        Route::get('institute-students', 'InstituteStudentData')->name('institute-students');
        Route::get('institute-dashboard', 'InstituteDashboard')->name('institute-dashboard');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'roles:admin']], function () {
    // dd("test");


    Route::post('/temp-cert-upload', [Certificate::class, 'uploadCertTemplate']);
    Route::get('/get-temp-cert-data/{certid?}', [Certificate::class, 'getCertData']);
    Route::post('/delete-cert-template', [Certificate::class, 'deleteCert']);
    Route::get('/dashboard', [AdminCommon::class, 'dashboard'])->name('dashboard.admin')->middleware(['auth', 'roles:admin,superadmin,sales']);
    Route::resource('admin', AdminCommon::class)->middleware(['auth', 'roles:superadmin']);
    Route::post('/admin-create', [AdminCommon::class, 'store'])->middleware(['auth', 'roles:superadmin'])->name('admin.store');
    Route::get('/admin/{id}/edit', [AdminCommon::class, 'edit'])->middleware(['auth', 'roles:superadmin'])->name('admin.edit');

    Route::post('/admin-update', [AdminCommon::class, 'update'])->middleware(['auth', 'roles:superadmin'])->name('admin.update');
    Route::get('getadmindata/{action}', [AdminCommon::class, 'getAdminData'])->middleware(['auth', 'roles:superadmin'])->name('admin.getadmindata');
    Route::view('students', 'admin/student/students')->name('admin.students');
    Route::get('/admin-export', [AdminCommon::class, 'exportAdmin'])->name('admin.export');
    Route::post('/admin-import', [AdminCommon::class, 'importAdmin'])->name('admin.import');
    Route::post('/admin-deleteall', [AdminCommon::class, 'deleteall'])->name('admin.deleteall');
    Route::view('all-award', 'admin/course/all-award')->name('admin.course.all-award');

    Route::get('/get-course-exam-list/{course_id}', [AdminCommon::class, 'getCourseExamList'])->name('getCourseExamList');
    Route::post('/add-exam-amount', [AdminCommon::class, 'addExamAmount'])->name('addExamAmount');
    Route::get('/get-exam-amount-list', [AdminCommon::class, 'getExamAmountList'])->name('getExamAmountList');
    Route::get('/get-exam-amount/{id}', [AdminCommon::class, 'getExamAmount'])->name('getExamAmount');
    Route::post('/edit-exam-amount/{id}', [AdminCommon::class, 'editExamAmount'])->name('editExamAmount');
    Route::post('/delete-exam-amount', [AdminCommon::class, 'deleteExamAmount'])->name('deleteExamAmount');

    Route::view('student-edit', 'admin/student/student-edit')->name('admin.edit-student');
    Route::view('student-learning', 'admin/student/learning')->name('admin.learning');

    Route::view('vlog', 'admin/exam/vlog')->name('admin.exam.vlog');
    Route::view('add-vlog', 'admin/exam/add-vlog')->name('admin.exam.add-vlog');
    Route::view('edit-vlog', 'admin/exam/edit-vlog')->name('admin.exam.edit-vlog');
    Route::view('peer-review', 'admin/exam/peer-review')->name('admin.exam.peer-review');
    Route::view('edit-peer-review', 'admin/exam/edit-peer-review')->name('admin.exam.edit-peer-review');
    Route::view('edit-peer-review', 'admin/exam/edit-peer-review')->name('admin.exam.edit-peer-review');
    Route::view('forum-leadership', 'admin/exam/forum-leadership')->name('admin.exam.forum-leadership');
    Route::view('reflective-journals', 'admin/exam/reflective-journals')->name('admin.exam.reflective-journals');
    Route::view('edit-reflective-journals', 'admin/exam/edit-reflective-journals')->name('admin.exam.edit-reflective-journals');

    Route::view('multiple-choice', 'admin/exam/multiple-choice')->name('admin.exam.multiple-choice');
    Route::view('edit-multiple-choice', 'admin/exam/edit-multiple-choice')->name('admin.exam.edit-multiple-choice');

    Route::view('survey', 'admin/exam/survey')->name('admin.exam.survey');
    Route::view('edit-survey', 'admin/exam/edit-survey')->name('admin.exam.edit-survey');

    Route::view('final-thesis', 'admin/exam/final-thesis')->name('admin.exam.final-thesis');
    Route::view('edit-final-thesis', 'admin/exam/edit-final-thesis')->name('admin.exam.edit-final-thesis');

    Route::view('artificial-intelligence', 'admin/exam/artificial-intelligence')->name('admin.exam.artificial-intelligence');

    Route::view('orientation', 'admin/course/orientation')->name('admin.course.orientation');
    Route::view('edit-orientation', 'admin/course/edit-orientation')->name('admin.course.edit-orientation');


    Route::view('exams-amount', 'admin/course/exams-amount')->name('admin.coures.exams-amount');

    Route::view('add-e-portfolio', 'admin/exam/add-e-portfolio')->name('admin.exam.add-e-portfolio');
    Route::view('edit-e-portfolio', 'admin/exam/edit-e-portfolio')->name('admin.exam.edit-e-portfolio');
    Route::view('e-portfolio', 'admin/exam/e-portfolio')->name('admin.exam.e-portfolio');
    Route::view('edit-mock-interview', 'admin/exam/edit-mock-interview')->name('admin.exam.edit-mock-interview');
    Route::view('add-mock-interview', 'admin/exam/add-mock-interview')->name('admin.exam.add-mock-interview');
    Route::view('mock-interview', 'admin/exam/mock-interview')->name('admin.exam.mock-interview');
    Route::view('add-assessment', 'admin/exam/add-assessment')->name('admin.exam.add-assessment');
    Route::view('edit-assignment', 'admin/exam/edit-assignment')->name('admin.exam.edit-assignment');

    Route::view('assignment', 'admin/exam/assignment')->name('admin.exam.assignment');
    // Route::view('studentreports', 'admin/exam/student-report')->name('admin.exam.student-report');
    Route::view('course-reports', 'admin/exam/course-reports')->name('admin.exam.course-reports');

    Route::view('journal-articles', 'admin/course/journal-articles')->name('admin.course.journal-articles');
    Route::view('add-journal-articles', 'admin/course/add-journal-articles')->name('admin.course.add-journal-articles');
    Route::view('edit-journal-articles', 'admin/course/edit-journal-articles')->name('admin.course.edit-journal-articles');
    Route::view('learning', 'admin/student/learning');

    Route::get('/get-institute-students/{limit}', [InstituteController::class, 'InstituteStudentList']);

    Route::post('/generate-cert', [Certificate::class, 'generateCert']);

    // Assignment
    Route::controller(AdminAssignment::class)->group(function () {
        Route::post('add-assignment', 'addAssignment');
        Route::post('update-assignment', 'editAssignment');
        Route::get('assignment-data/{cat?}',  'getAssignData');
        Route::get('assignment-data-edit/{cat?}/{id?}', 'getAssignData');
        Route::post('add-assignment-question', 'addAssignQuestion');
        Route::post('edit-view-assignment-question', 'editViewAssignQeustion');
        Route::post('/delete-assignment-question', 'deleteAssingnQuestion');
        Route::post('/delete-assignment', 'deleteAssingnment');
    });

    // Mock
    Route::controller(AdminMock::class)->group(function () {
        Route::post('add-mock-interview', 'addMockInterview');
        Route::post('update-mock', 'editMockInterview');
        Route::get('list-data/{cat?}',  'getMockData');
        Route::get('mock-data-edit/{cat?}/{id?}', 'getMockData');
        Route::post('add-mock-question', 'addMockQuestion');
        Route::post('edit-view-mock-question', 'editViewMockQeustion');
        Route::post('/delete-mock-question', 'deleteMockQuestion');
        Route::post('/delete-pdf-file', 'deletePdfFile');
        Route::post('/delete-mock-interview', 'deleteMockInterview');
    });

    // Vlog
    Route::controller(AdminVlog::class)->group(function () {
        Route::post('add-vlog', 'addVlog');
        Route::post('update-vlog', 'updateVlog');
        Route::get('vlog-data/{cat?}',  'getVlogData');
        Route::get('vlog-data-edit/{cat?}/{id?}', 'editVlogData');
        Route::post('add-vlog-question', 'addVlogQuestion');
        Route::post('edit-view-vlog-question', 'editViewVlogQuestion');
        Route::post('/delete-vlog-question', 'deleteVlogQuestion');
        Route::post('/delete-vlog-pdf-file', 'deletePdfFile');
        Route::post('/delete-vlog', 'deleteVlog');
    });

    // peer review
    Route::controller(AdminPeerReview::class)->group(function () {
        Route::post('add-peer-review', 'addPeerReview');
        Route::post('update-peer-review', 'updatePeerReview');
        Route::get('peer-review-data/{cat?}',  'getPeerReviewData');
        Route::get('peer-review-data-edit/{cat?}/{id?}', 'editPeerReviewData');
        Route::post('/delete-peer-review', 'deletePeerReview');
    });

    // forum leadership
    Route::controller(AdminDiscord::class)->group(function () {
        Route::post('add-discord', 'addDiscord');
        Route::post('update-discord', 'updateDiscord');
        Route::get('discord-data/{cat?}',  'getDiscordData');
        Route::get('discord-data-edit/{cat?}/{id?}', 'editDiscordData');
        Route::post('/delete-discord', 'deleteDiscord');
    });

    // reflective Journal
    Route::controller(AdminReflectiveJournal::class)->group(function () {
        Route::post('add-reflective-journal', 'addReflectiveJournal');
        Route::post('update-reflective-journal', 'updateReflectiveJournal');
        Route::get('reflective-journal-data/{cat?}',  'getReflectiveJournalData');
        Route::get('reflective-journal-data-edit/{cat?}/{id?}', 'getReflectiveJournalData');
        Route::post('/delete-reflective-journal-pdf-file', 'deletePdfFile');
        Route::post('add-reflective-journal-question', 'addReflectiveJournalQuestion');
        Route::post('edit-view-reflective-journal-question', 'editViewReflectiveJournalQeustion');
        Route::post('/delete-reflective-journal-question', 'deleteReflectiveJournalQuestion');
        Route::post('/delete-reflective-journal', 'deleteReflectiveJournal');

    });

    // multiple choice
    Route::controller(AdminMCQ::class)->group(function () {
        Route::get('mcq-data/{cat?}',  'getMcqData');
        Route::post('/add-mcq', 'addMcq');
        Route::get('mcq-data-edit/{cat?}/{id?}', 'getMcqData');
        Route::post('update-mcq', 'updateMcq');
        Route::post('add-mcq-question', 'addMcqQuestion');
        Route::post('/edit-mcq-question', 'EditMcqQuestion');
        Route::post('/delete-mcq', 'deleteMcq');
        Route::post('/delete-mcq-question', 'deleteMcqQuestion');

    });

    // survey
    Route::controller(AdminSurvey::class)->group(function () {
        Route::get('survey-data/{cat?}',  'getSurveyData');
        Route::post('/add-survey', 'addSurvey');
        Route::get('survey-data-edit/{cat?}/{id?}', 'getSurveyData');
        Route::post('update-survey', 'updateSurvey');
        Route::post('add-survey-question', 'addSurveyQuestion');
        Route::post('edit-view-survey-question', 'editViewSurveyQuestion');
        Route::post('/delete-survey-pdf-file', 'deletePdfFile');
        Route::post('/delete-survey', 'deleteSurvey');
        Route::post('/delete-survey-question', 'deleteSurveyQuestion');

    });

    // final thesis
    Route::controller(AdminFinalThesis::class)->group(function () {
        Route::get('final-thesis-data/{cat?}',  'getFinalThesis');
        Route::post('/add-final-thesis', 'addFinalThesis');
        Route::get('final-thesis-data-edit/{cat?}/{id?}', 'getFinalThesis');
    });

    Route::controller(AdminArtificialIntelligence::class)->group(function () {
        Route::post('add-artificial-intelligence', 'addArtificialIntelligence');
        Route::post('update-artificial-intelligence', 'updateArtificialIntelligence');
        Route::get('artificial-intelligence-data/{cat?}',  'getArtificialIntelligenceData');
        Route::get('artificial-intelligence-data-edit/{cat?}/{id?}', 'getArtificialIntelligenceData');
        Route::post('/delete-artificial-intelligence-pdf-file', 'deletePdfFile');
        Route::post('add-artificial-intelligence-question', 'addArtificialIntelligenceQuestion');
        Route::post('edit-view-artificial-intelligence-question', 'editViewArtificialIntelligenceQeustion');
        Route::post('/delete-artificial-intelligence-question', 'deleteArtificialIntelligenceQuestion');
        Route::post('/delete-artificial-intelligence', 'deleteArtificialIntelligence');

    });

    Route::get('/get-input-field-configurations', [AdminCommon::class, 'getInputFieldConfiguration']);
    Route::post('/add-input-field-configuration', [AdminCommon::class, 'addInputFieldConfiguration']);
    Route::post('/delete-input-field-configuration', [AdminCommon::class, 'deleteInputFieldConfiguration']);



    Route::controller(AdminPayment::class)->group(function () {
        Route::view('promo-code', 'admin/payment/promo-code')->name('admin.payment.promo-code');
        Route::post('add-course-promo', 'addCoursePromo');
        Route::view('payment', 'admin/payment/payment')->name('admin.payment.payment');
        Route::get('payments-get-data/{cat}', 'PaymentsList')->name('admin.paymentlist');
        Route::get('promocode-get-data/{id}/{cat}', 'PromoCodeList')->name('admin.promocodelist');
        Route::post('/delete-course-promocode', 'deletePromocode');
        Route::post('/payment-refund', 'refundPayment');
        Route::post('/save-payment-method', 'savePaymentMethod');
        Route::get('/get-course-price/{id}','getCoursePrice');
        Route::post('/generate-payment-link', 'generatePaymentLink');
        Route::get('/payment-export', 'exportPayment')->name('payment-export');

    });



    Route::controller(StudentAdminController::class)->group(function () {
        // Route::get('students', 'StudentList')->name('admin.students');
        Route::get('/students-get-data/{cat}', 'StudentList')->name('admin.studentList');
        Route::get('/students-edit-view/{id}', 'getStudent');
        Route::post('/student-doc-verify', 'DocVerify');
        Route::post('/student-create', 'createStudent');
        Route::post('/student-edu-doc-verify', 'EduDocVerify');
        Route::post('/add-student-profile-image', 'profileImageUpload');
        Route::post('/status-student', 'statusStudent');
        Route::get('/download-invoice/{id}/{action}', 'downloadInvoice');
        Route::post('/delete-student', 'deleteStudent');
        Route::get('studentreports', 'studentReport')->name('admin.exam.student-report');
        Route::get('/students-report-data', 'StudentReportList')->name('admin.studentList');
        Route::post('/student-research-doc-verify', 'ResearchDocVerify');
        Route::post('/student-course-purchase', 'StudentCoursePurchase');
    });
    Route::controller(TeacherAdminController::class)->group(function () {
        Route::post('/teacher-create', 'createTeacher');
        Route::post('/teacher-profile-image', 'profileUpload');
        Route::view('teacher', 'admin/teacher/teacher')->name('admin.teacher.teacher');
        Route::view('create-teacher', 'admin/teacher/create-teacher')->name('admin.teacher.create-teacher');
        Route::get('edit-teacher/{id}', 'TeacherList');
        Route::get('/teacher-get-data/{cat}', 'TeacherList')->name('admin.teacherList');
        Route::post('/delete-teacher', 'deleteTeacher');
    });

    Route::controller(AdminCommon::class)->group(function () {
        Route::post('/student-delete', 'deleteUser');
        Route::post('/delete-entry', 'deleteEntry');
        Route::post('/delete-entires', 'deleteEntries');
        Route::post('/add-admin-profile-image', 'adminImageUpload');
        Route::post('/export', 'export')->name('export');
        Route::post('/check-certificate-exists', 'checkCertificate')->name('check.certificate.exists');

    });
    Route::controller(AdminCourse::class)->group(function () {
        Route::get('/course-get-data/{cat}/{action}', 'CourseList')->name('admin.courseList');
        Route::get('/course-get-data/{cat}', 'CourseList')->name('admin.courseList');
        Route::get('/award-course-get-data/{cat?}/{edit?}', 'AwardCourseList')->name('admin.awardcourseList');
        Route::get('/all-course-get-data/{cat?}/{edit?}', 'AllCourseList')->name('admin.allcourseList');
        Route::post('/add-course', 'courseUpdate');
        Route::post('/add-course-main', 'courseUpdateAdd');

        Route::post('/add-course-media-main', 'courseMediaUpdateAdd'); // Route Terminated
        Route::post('/add-course-others', 'courseUpdateOther');
        Route::post('/add-section-course', 'courseAssignSection');


        Route::post('/add-course-content', 'coursePodcastContent');
        Route::post('/add-course-module-main', 'courseModuleMaster');
        Route::post('/assign-course-section', 'assignSection');

        Route::get('/load-course-videos/{course_id}', 'loadCoursePreviewVideos');
        Route::get('/api-test', 'getCollectionIdBn');
        Route::get('/course-editview/{id}/{action}', 'CourseEdit');

        // Section part
        Route::view('section', 'admin/course/section')->name('admin.course.section');
        Route::post('/add-course-section', 'updateSection');
        Route::view('section-edit', 'admin/course/section-edit');
        Route::get('/section-course-get-data/{cat?}/{edit?}', 'sectionList')->name('admin.sectionList');
        Route::post('/section-search', 'searchSection');
        Route::post('/section-already-added', 'sectionAlreadyAdded');


        Route::get('section-orientation-get-data/', 'sectionList')->name('admin.sectionList');
        Route::get('/section-content-get/{cat?}/{edit?}', 'sectionListNew');
        Route::post('/status-course', 'statusCourse');

        Route::post('/delete-course', 'deleteCourse');
        Route::post('/expired-course', 'expiredCourse');
        Route::get('admin-course-panel/{course_id}', 'getCoursePanelData')->name('admin-course-panel');
        Route::get('admin-master-course-panel/{course_id}', 'getMasterCoursePanelData')->name('admin-master-course-panel');


        Route::post('/course-search', 'searchCourseList');
        Route::post('/course-already-added', 'CourseAlreadyAdded');



    });
    Route::controller(SectionVideo::class)->group(function () {
        Route::get('/get-section-videos', 'getSectionVideos')->name('admin.getCourseVideo');
        Route::view('videos', 'admin/course/videos')->name('admin.course.videos');
        Route::post('/delete-course-video', 'deleteVideo');
        Route::post('/add-course-video', 'courseVideoUpload')->name('admin.course.add-video');
        Route::post('/edit-course-video', 'courseEditVideoUpload');
        Route::post('/assign-content-section', 'assignContent');
        Route::post('/unassign-section-content', 'deleteSectionContent');
        Route::post('/edit-orientation', 'editOrientation');
        Route::post('/delete-course-section', 'deleteSection');
        Route::post('/check-video-id', 'checkVideoId')->name('check.video.id');
    });
    Route::controller(JounalArticleAdmin::class)->group(function () {
        Route::post('/add-journal-article', 'UpdateJournalArticle');
        Route::get('/get-journal-article/{cat?}/{edit?}', 'articleList')->name('admin.articleList');
        Route::get('/get-journal-article-edit/{cat?}/{edit?}', 'articleListedit');
    });

    Route::controller(EmentorAdminController::class)->group(function () {
        Route::post('/ementor-create', 'createEmentor');
        Route::get('/get-ementor-data/{cat}', 'getEmentorData')->name('admin.ementorList');
        Route::post('/status-ementor', 'statusEmentor');
        Route::get('/e-mentors-edit/{id}', 'getEmentorData')->name('e-mentors-edit');
        Route::post('/e-mentors-profile-edit', 'editProfile');
        Route::post('/add-ementor-profile-image', 'ementorProfileUpload');
        Route::post('/ementor-delete', 'deleteEmentor');
        Route::get('/e-mentor-course-list/{id}', 'assignCourseList');
        Route::get('/get-students-list/{status?}/{course_id}', 'courseStudentList');
        Route::get('e-mentor-students-exam-details/{id}/{course_id}/{student_course_master_id}', 'ementorStudentInfo')->name('admin-e-mentor-students-exam-details');
        Route::get('answersheet/{examId}/{examType}/{userid}/{student_course_master_id}', 'studentAnswerSheet')->name('answersheet');
        Route::get('e-portfolio-answersheet/{user_id}/{course_id}/{student_course_master_id}', 'ementorStudentPortfolioAnswersheet')->name('e-portfolio-answersheet');
        Route::get('get-e-mentor-students-exam/{status?}/{ementorId?}', 'ementorExamList');
        Route::get('get-all-students-list/{ementor_id}', 'ementorAllStudentList');

    });

    Route::controller(SubEmentorAdminController::class)->group(function () {
        Route::get('/get-sub-ementor-data/{cat}', 'getSubEmentorData')->name('admin.sub-ementorList');
        Route::get('/sub-e-mentors-edit/{id}', 'getSubEmentorData');
    });

    Route::controller(AdminQuiz::class)->group(function () {
        Route::view('/edit-quiz', 'admin/course/edit-quiz')->name('admin.course.edit-quiz');
        Route::view('/quiz', 'admin/course/quiz')->name('admin.course.quiz');
        Route::post('/addquiz', 'addQuiz');
        Route::post('/editquizquestion', 'editQuiz')->name('quiz.edit');
        Route::post('/addQuizQuestion', 'addQuizQuestion');
        Route::post('/editQuizQuestion', 'EditQuizQeustion');
        Route::get('/edit-quiz-get-data/{cat?}', 'quizEdit');
        Route::get('/section-quiz-get-data', 'quizListNew');
        Route::get('/get-quiz', 'getQuiz');
        Route::post('/delete-quiz-question', 'deleteQuizQuestion');
        Route::post('/delete-quiz', 'deleteQuiz');
        Route::post('/quiz-view',  'QuizView');
    });
    Route::controller(AdminSetting::class)->group(function () {
        Route::get('/get-blocklist', 'BlocksList')->name('admin.settings.blocklist');
        Route::get('/get-blocklist/{cat}', 'BlocksList');
        Route::post('/add-ipblock', 'addIPblock');
        Route::post('/unblock-ipadd', 'unblockIPadd');

        Route::view('payment-method', 'admin/settings/payment-method')->name('admin.settings.payment-method');

        Route::view('onboarding', 'admin/settings/onboarding')->name('admin.settings.onboarding');
        Route::post('/save-boarding-permisssion', 'BoardingPermission');
        Route::view('tickets', 'admin/settings/tickets')->name('admin.settings.tickets');
        Route::post('/add-ticket', 'addTickets');
        Route::get('/get-tickets/{cat}', 'TicketsList');
        Route::post('/status-ticket', 'statusTicket');
        // Route::view('blocklist', 'admin/settings/blocklist')->name('admin.settings.blocklist');

    });

    Route::controller(AdminInstitute::class)->group(function () {
        Route::post('/institute-create', 'createInstitute');
        Route::get('/get-institute-list/{cat}', 'getInstituteData');
        Route::get('/institute-edit/{id}', 'getInstituteData');
        Route::view('institute', 'admin/institute/institute')->name('admin.institute.institute');
        Route::post('/status-institute', 'statusInstitute');
        Route::post('/institute-delete', 'deleteInstitute');
        Route::get('institute-students/{institute_id}', 'getInstituteStudentData');
        Route::get('institute-teachers/{institute_id}', 'getInstituteTeacherData');
        Route::post('/add-institute-profile-image', 'instituteProfileUpload');

    });

    Route::controller(AdminSalesExecutive::class)->group(function () {
        Route::post('/sales-executive-create', 'createSalesExecutive');
        Route::get('/get-sales-executive-list/{cat}', 'getSalesExecutiveData');
        Route::get('/sales-executive-edit/{id}', 'getSalesExecutiveData');
        Route::view('sales-executive', 'admin/sales-executive/sales-executive')->name('admin.sales-executive');
        Route::post('/status-sales-executive', 'statusSalesExecutive');
        Route::post('/sales-executive-delete', 'deleteSalesExecutive');
        // Route::get('institute-students/{institute_id}', 'getInstituteStudentData');
        // Route::post('/add-institute-profile-image', 'instituteProfileUpload');

    });

    Route::controller(AdminTestimonials::class)->group(function () {
        Route::view('/testimonials', 'admin/testimonials/testimonials')->name('admin.testimonials.testimonials');
        Route::view('/create-testimonials', 'admin/testimonials/create-testimonials')->name('admin.testimonials.create-testimonials');
        Route::post('/testimonials-create', 'createTestimonials');
        Route::get('edit-testimonials/{id}', 'TestimonialList');
        Route::get('/testimonial-get-data/{cat}', 'TestimonialList');
        Route::post('/delete-testimonials', 'deleteTestimonials');

    });

    // Route::view('/testimonials', 'admin/testimonials/testimonials')->name('admin.testimonials.testimonials');
    // Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');ementor-edit
    // Route::patch('/profile', [UserController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy ');
});
Route::get('admin/uploadfile', [CourseController::class, 'uploadfile']);


Route::post('admin/upload', [CourseController::class, 'uploadFileupload']);
Route::get('/google/redirect/{role}', [UserController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [UserController::class, 'handleGoogleCallback'])->name('google.callback');

Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/login-view', [UserController::class, 'loginView'])->name('viewlogin');
    Route::get('student-enrollment', [UserController::class, 'userSignup'])->name('user.signup');
    Route::get('student-dba-enrollment', [UserController::class, 'userDbaSignup'])->name('user.dbasignup');
    Route::get('teacher-enrollment', [UserController::class, 'instructorSignup'])->name('instructor.signup');
    Route::get('institute-enrollment', [UserController::class, 'instituteSignup'])->name('institute.signup');
    Route::get('/forget-password', [UserController::class, 'forgetPassword'])->name('forgot-password');
});


require __DIR__ . '/auth.php';


Route::view('instructions', 'frontend/instructions')->name('instructions');



#Google-meet link

Route::get('/google/auth', [WebhookController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('/google/callback', [WebhookController::class, 'handleGoogleCallback'])->name('google.callback');
Route::post('/schedule-meeting', [WebhookController::class, 'scheduleMeeting'])->name('schedule.meeting');
Route::get('/debug-token', function () {
    $token = session('google_token');

    if ($token && isset($token['access_token'])) {
        DB::table('google_tokens')->updateOrInsert(
            ['id' => 1],
            [
                'token' => json_encode($token),
                'updated_at' => now(),
                'is_deleted' => 'No'
            ]
        );

        return 'Token saved to database.';
    }

    return 'No valid token found in session.';
});
