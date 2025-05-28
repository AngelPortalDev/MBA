
<style>
    .score-container {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        display: inline-block;
        text-align: center;
        margin-top: 20px;
        box-shadow: 0px 3px 8px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
}

.score {
    font-size: 1.8rem; 
    margin-bottom: 0;
    font-weight: bold
}

.img-4by3-lg{
    width: 3.5rem;
}


</style>

<div class="tab-pane fade quizTab quizPane" id="quiz" role="tabpanel" aria-labelledby="quiz-1-tab">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0">
            <div id="courseForm" class="bs-stepper">
                <div class="bs-stepper-header rounded-0" id="quizHeader">
                    <!-- your step headers -->
                    <div class="step test-start" data-target="#test-start">
                        <button type="button" class="step-trigger" role="tab" aria-controls="test-start"
                            id="courseFormtrigger0">
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <form id="quizForm" onSubmit="return false">
                        <input type='text' id="course_id" name="course_id" hidden>
                        <!-- Content test-start -->
                        <div id="test-start" role="tabpanel" class="first-pane bs-stepper-pane" id="courseFormtrigger0">
                            <div class="card mb-4 rounded-0">
                                <!-- Card body -->
                                <div class="card-body p-10">
                                    <div class="text-center">
                                        <!-- img -->
                                        <img src="{{ asset('frontend/images/student-quiz-01.png') }}" alt="survey"
                                            class="img-fluid" />
                                        <!-- text -->
                                        <div class="px-lg-8 mt-4">
                                            <h2 class="h1 color-blue">Welcome
                                                to Quiz</h2>
                                            <p class="mb-0">Engage live or
                                                asynchronously with quiz and
                                                poll questions that
                                                participants complete at their
                                                own pace.</p>
                                            <button class="btn btn-primary mt-4 color-green" type="button"
                                                onclick="nextStep(1)">
                                                Start Your Quiz <i class="fe fe-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                 
                    </form>
                    <div id="test-last" role="tabpanel" class="bs-stepper-pane" id="courseFormtrigger_last">
                            <div class="card mb-4 rounded-0">
                                <!-- Card body -->
                                <div class="card-body p-10">
                                    <div class="text-center">
                                        <!-- img -->
                                        <img src="{{ asset('frontend/images/student_quiz_02.png') }}" alt="survey"
                                            class="img-fluid" />
                                        <!-- text -->
                                        <div class="px-lg-8 mt-4">
                                            <div class="score-container">
                                                <h2 class="h1 color-blue score"></h2>
                                            </div>
                                            <p class="mb-0">Engage live or
                                                asynchronously with quiz and
                                                poll questions that
                                                participants complete at their
                                                own pace.</p>
                                            {{-- <button class="btn btn-primary mt-4 color-green" type="button"
                                                onclick="nextStep(1)">
                                                Start Your Quiz <i class="fe fe-arrow-right"></i>
                                            </button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>