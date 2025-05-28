@extends('frontend.master')
@section('content')


        <!-- Wrapper -->
        <div id="db-wrapper" class="course-video-player-page">
            <!-- Sidebar -->
        
            <nav class="navbar-vertical navbar bg-white">
            <div class="" data-simplebar>
                <section class="card " id="courseAccordion">
                    <!-- List group -->

                    <ul class="list-group list-group-flush" style="height: 850px" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden;"><div class="simplebar-content" style="padding: 0px;">
                        <li class="list-group-item">
                            <h4 class="mb-0">Table of Content</h4>
                        </li>

                        <!-- List group item -->
                        <li class="list-group-item">
                            <!-- Toggle -->
                            <a class="d-flex align-items-center h4 mb-0" data-bs-toggle="collapse" href="#orientaion" role="button" aria-expanded="false" aria-controls="orientaion">
                                <div class="me-auto">Orientation</div>
                                <!-- Chevron -->
                                <span class="chevron-arrow ms-4">
                                    <i class="fe fe-chevron-down fs-4"></i>
                                </span>
                            </a>
                            <!-- Row -->
                            <!-- Collapse -->

                            <div class="collapse show" id="orientaion" data-bs-parent="#courseAccordion">
                                <div class="py-3 nav" id="course-orientaion" role="tablist" aria-orientation="vertical" style="display: inherit">

                                    <div class="mb-3">
                                        <div class="progress" style="height: 6px">
                                            <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 45%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>45% Completed</small>
                                    </div>

                                    <a class="mb-2 d-flex justify-content-between align-items-center" id="ori-1-tab" data-bs-toggle="pill" href="#ori-1" role="tab" aria-controls="ori-1" aria-selected="true">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 bg-blue"><i class="bi bi-check2 color-green fs-4 fw-bold"></i></span>
                                            <span class="preview-course-heading">Director’s Introduction</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>1m 7s</span>
                                        </div>
                                    </a>
                                    <a class="mb-2 d-flex justify-content-between align-items-center text-inherit" id="ori-2-tab" data-bs-toggle="pill" href="#ori-2" role="tab" aria-controls="ori-2" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-primary icon-sm rounded-circle me-2"><i class="fe fe-play fs-6"></i></span>
                                            <span>Orientation</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>5m 33s</span>
                                        </div>
                                    </a>
                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit" id="ori-3-tab" data-bs-toggle="pill" href="#ori-3" role="tab" aria-controls="ori-3" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-primary icon-sm rounded-circle me-2"><i class="fe fe-play fs-6"></i></span>
                                            <span>Understanding podcasts</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>4m 15s</span>
                                        </div>
                                    </a>
                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit" id="ori-4-tab" data-bs-toggle="pill" href="#ori-4" role="tab" aria-controls="ori-4" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-primary icon-sm rounded-circle me-2"><i class="fe fe-play fs-6"></i></span>
                                            <span>Understanding pre recorded lectures</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>2m 15s</span>
                                        </div>
                                    </a>

                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit" id="quiz-1-tab" data-bs-toggle="pill" href="#quiz-1" role="tab" aria-controls="quiz-1">
                                        <div class="text-truncate">
                                            <span class="icon-shape text-primary icon-sm rounded-circle me-2 color-light-cyan">
                                                <i class="fe fe-help-circle nav-icon fs-6 color-cyan"></i></span>
                                            <span class="color-cyan">Quiz 1</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>2m 15s</span>
                                        </div>
                                    </a>

                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit" id="resource-tab" data-bs-toggle="pill" href="#resource" role="tab" aria-controls="resource" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape text-primary icon-sm rounded-circle me-2 bg-light">
                                                <i class="fe fe-book nav-icon fs-6"></i></span>
                                            <span class="">Journal Article</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>20 Min</span>
                                        </div>
                                    </a>



                                </div>
                            </div>
                        </li>



                        
                        <!-- List group item -->
                        <li class="list-group-item">
                            <!-- Toggle -->
                            <a class="d-flex align-items-center h4 mb-0" data-bs-toggle="collapse" href="#courseTwo" role="button" aria-expanded="false" aria-controls="courseTwo">
                                <div class="me-auto">Recruitment and Employee Selection</div>
                                <!-- Chevron -->
                                <span class="chevron-arrow ms-4">
                                    <i class="fe fe-chevron-down fs-4"></i>
                                </span>
                            </a>
                            <!-- Row -->
                            <!-- Collapse -->

                            <div class="collapse" id="courseTwo" data-bs-parent="#courseAccordion">
                                <div class="py-3 nav" id="course-tabOne" role="tablist" aria-orientation="vertical" style="display: inherit">

                                    <div class="mb-3">
                                        <div class="progress" style="height: 6px">
                                            <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 45%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>45% Completed</small>
                                    </div>

                                    <a class="mb-2 d-flex justify-content-between align-items-center" id="course-intro-tab" data-bs-toggle="pill" href="#course-intro" role="tab" aria-controls="course-intro" aria-selected="true">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 bg-blue"><i class="bi bi-check2 color-green fs-4 fw-bold"></i></span>
                                            <span class="preview-course-heading">Introduction</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>1m 7s</span>
                                        </div>
                                    </a>
                                    <a class="mb-2 d-flex justify-content-between align-items-center text-inherit" id="course-development-tab" data-bs-toggle="pill" href="#course-development" role="tab" aria-controls="course-development" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 bg-blue"><i class="bi bi-check2 color-green fs-4 fw-bold"></i></span>
                                            <span class="preview-course-heading">Installing Development Software</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>3m 11s</span>
                                        </div>
                                    </a>
                                    <a class="mb-2 d-flex justify-content-between align-items-center text-inherit" id="course-project-tab" data-bs-toggle="pill" href="#course-project" role="tab" aria-controls="course-project" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-primary icon-sm rounded-circle me-2"><i class="fe fe-play fs-6"></i></span>
                                            <span>Hello World Project from GitHub</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>2m 33s</span>
                                        </div>
                                    </a>
                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit" id="course-website-tab" data-bs-toggle="pill" href="#course-website" role="tab" aria-controls="course-website" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-primary icon-sm rounded-circle me-2"><i class="fe fe-play fs-6"></i></span>
                                            <span>Our Sample Website</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>2m 15s</span>
                                        </div>
                                    </a>


                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit" id="quiz-1-tab" data-bs-toggle="pill" href="#quiz-1" role="tab" aria-controls="quiz-1" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape text-primary icon-sm rounded-circle me-2 color-light-cyan">
                                                <i class="fe fe-help-circle nav-icon fs-6 color-cyan"></i></span>
                                            <span class="color-cyan">Quiz 1</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>20 Min</span>
                                        </div>
                                    </a>
                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit" id="resource-tab" data-bs-toggle="pill" href="#resource" role="tab" aria-controls="resource" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape text-primary icon-sm rounded-circle me-2 bg-light">
                                                <i class="fe fe-book nav-icon fs-6"></i></span>
                                            <span class="">Journal Article</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>20 Min</span>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </li>


                        <!-- List group item -->
                        <li class="list-group-item">
                            <!-- Toggle -->
                            <a class="d-flex align-items-center h4 mb-0" data-bs-toggle="collapse" href="#courseThree" role="button" aria-expanded="false" aria-controls="courseThree">
                                <div class="me-auto">
                                    <!-- Title -->
                                    JavaScript Beginning
                                </div>
                                <!-- Chevron -->
                                <span class="chevron-arrow ms-4">
                                    <i class="fe fe-chevron-down fs-4"></i>
                                </span>
                            </a>
                            <!-- Row -->
                            <!-- Collapse -->
                            <div class="collapse" id="courseThree" data-bs-parent="#courseAccordion">
                                <div class="py-3 nav" id="course-tabTwo" role="tablist" aria-orientation="vertical" style="display: inherit">

                                    <div class="mb-3">
                                        <div class="progress" style="height: 6px">
                                            <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>0% Completed</small>
                                    </div>

                                    <a class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick" id="course-intro-tab2" data-bs-toggle="pill" href="#" role="tab" aria-controls="course-intro" aria-selected="true">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play fs-6"></i></span>
                                            <span>Introduction</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>1m 41s</span>
                                        </div>
                                    </a>
                                    <a class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick" id="course-development-tab2" data-bs-toggle="pill" href="#" role="tab" aria-controls="course-development" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play fs-6"></i></span>
                                            <span>Adding JavaScript Code to a Web Page</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>3m 39s</span>
                                        </div>
                                    </a>
                                    <a class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick" id="course-project-tab2" data-bs-toggle="pill" href="#" role="tab" aria-controls="course-project" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play fs-6"></i></span>
                                            <span>Working with JavaScript Files</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>6m 18s</span>
                                        </div>
                                    </a>
                                   
                                </div>
                            </div>
                        </li>

                    </div></div></div></div><div class="simplebar-placeholder" style="width: 380px; height: 691px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div></ul>
                </section>

            </div>
            </nav>

            <!-- Page Content -->
            <main id="page-content">
                <div class="header" >
                    <nav class="navbar-default navbar navbar-expand-lg" style="background-color: #f1f5f9;box-shadow: none;">
                        <a id="nav-toggle" href="#" class=" color-blue fs-4">
                            <button class="button is-text is-opened" id="menu-button" onclick="buttonToggle()">
                                <div class="button-inner-wrapper">
                                    <span class="icon menu-icon"></span>
                                </div>
                            </button>
                        </a>
                        <div class="d-flex align-items-center justify-content-between ps-3">
                            <div>
                                <h3 class="mb-0 text-truncate-line-2 color-blue">Award in Recruitment and Employee Selection</h3>
                            </div>

                        </div>

                    </nav>
                </div>

                <!-- Page Header -->
                
                
                <!-- Container fluid -->
                <section class="container-fluid p-4">
                    <div class="row">
                        <div class="col-12">
                            <!-- Tab content -->
                            <div class="tab-content content" id="course-tabContent">
                                
                                <div class="tab-pane fade show active" id="ori-1" role="tabpanel" aria-labelledby="ori-1-tab">

                                    <!-- Video -->

                                    <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0" style="height: 600px;position:relative;padding-top:56.25%;">
                                        <iframe
                                            class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100"
                                            width="560"
                                            height="315"
                                            src="https://www.youtube.com/embed/Nfzi7034Kbg?si=C2_CU7iIZJA5VWcS"
                                            title="E-Ascencia - Academy and LMS Template"
                                            frameborder="0"></iframe>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="ori-2" role="tabpanel" aria-labelledby="ori-2-tab">

                                    <!-- Video -->

                                    <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0" style="height: 600px;position:relative;padding-top:56.25%;">
                                        <iframe
                                            class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100"
                                            width="560"
                                            height="315"
                                            src="https://www.youtube.com/embed/Nfzi7034Kbg?si=C2_CU7iIZJA5VWcS"
                                            title="E-Ascencia - Academy and LMS Template"
                                            frameborder="0"></iframe>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="ori-3" role="tabpanel" aria-labelledby="ori-3-tab">

                                    <!-- Video -->

                                    <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0" style="height: 600px;position:relative;padding-top:56.25%;">
                                        <iframe
                                            class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100"
                                            width="560"
                                            height="315"
                                            src="{{ asset('frontend/images/pdf/Unit-4.pdf')}}"
                                            title="E-Ascencia - Academy and LMS Template"
                                            frameborder="0"></iframe>
                                            
                                            
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="course-intro" role="tabpanel" aria-labelledby="course-intro-tab">

                                    <!-- Video -->

                                    <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0" style="height: 600px;position:relative;padding-top:56.25%;">
                                        <iframe
                                            class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100"
                                            width="560"
                                            height="315"
                                            src="https://www.youtube.com/embed/Nfzi7034Kbg?si=C2_CU7iIZJA5VWcS"
                                            title="E-Ascencia - Academy and LMS Template"
                                            frameborder="0"></iframe>
                                    </div>
                                </div>


                                <!-- Tab pane -->
                                <div class="tab-pane fade " id="course-development" role="tabpanel" aria-labelledby="course-development-tab">

                                    <!-- Video -->
                                    <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0" style="height: 600px">
                                        <iframe src="https://iframe.mediadelivery.net/embed/243359/689a5433-af71-4cc1-b085-10ede00362b7?autoplay=true&loop=false&muted=true&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe>
                                    </div>
                                </div>


                                <!-- Tab pane -->
                                <div class="tab-pane fade" id="course-project" role="tabpanel" aria-labelledby="course-project-tab">
                                    
                                    <!-- Video -->
                                    <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0" style="height: 600px">
                                        <iframe class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100" width="560" height="315" src="https://iframe.mediadelivery.net/play/236384/a2f5e473-f440-4471-85d2-c56ebb9579c7" title="E-Ascencia - Academy and LMS Template" frameborder="0"></iframe>
                                    </div>
                                </div>

                                <!-- Tab pane -->
                                <div class="tab-pane fade" id="course-website" role="tabpanel" aria-labelledby="course-website-tab">
                                    
                                    <!-- Video -->
                                    <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0" style="height: 600px">
                                         <iframe src="https://iframe.mediadelivery.net/embed/243359/689a5433-af71-4cc1-b085-10ede00362b7?autoplay=true&loop=false&muted=true&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe>
                                    </div>
                                </div>


                                <!-- Quiz Tab pane -->
                                <div class="tab-pane fade" id="quiz-1" role="tabpanel" aria-labelledby="quiz-1-tab">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0">
                                                <div id="courseForm" class="bs-stepper">
                                                    <!-- Stepper Button -->
                                    
                                                    <!-- Stepper content -->
                                                    <div class="bs-stepper-content">
                                                    <div role="tablist">
                                                        <div class="step" data-target="#test-start">
                                                        <div class="step-trigger visually-hidden" role="tab" id="courseFormtrigger1" aria-controls="test-start"></div>
                                                        </div>
                                                        <div class="step" data-target="#test-l-1">
                                                        <div class="step-trigger visually-hidden" role="tab" id="courseFormtrigger1" aria-controls="test-l-1"></div>
                                                        </div>
                                    
                                                        <div class="step" data-target="#test-l-2">
                                                        <button type="button" class="step-trigger visually-hidden" role="tab" id="courseFormtrigger2" aria-controls="test-l-2"></button>
                                                        </div>
                                    
                                                        <div class="step" data-target="#test-l-3">
                                                        <button type="button" class="step-trigger visually-hidden" role="tab" id="courseFormtrigger3" aria-controls="test-l-3"></button>
                                                        </div>
                                    
                                                        <div class="step" data-target="#test-l-4">
                                                        <button type="button" class="step-trigger visually-hidden" role="tab" id="courseFormtrigger4" aria-controls="test-l-4"></button>
                                                        </div>
                                                        <div class="step" data-target="#test-l-5">
                                                        <button type="button" class="step-trigger visually-hidden" role="tab" id="courseFormtrigger5" aria-controls="test-l-5"></button>
                                                        </div>
                                                        <div class="step" data-target="#quiz-result">
                                                        <button type="button" class="step-trigger visually-hidden" role="tab" id="courseFormtrigger5" aria-controls="quiz-result"></button>
                                                        </div>
                                                    </div>
                                                    <form onSubmit="return false">

                                                        <!-- Content test-start -->
                                                        <div id="test-start" role="tabpanel" class="bs-stepper-pane fade">
                                                        <div class="card mb-4">
                                                        <!-- Card body -->
                                                            <div class="card-body p-10">
                                                                <div class="text-center">
                                                                <!-- img -->
                                                                <img src="{{ asset('frontend/images/student-quiz-01.png')}}" alt="survey" class="img-fluid" />
                                                                 
                                                                <!-- text -->
                                                                <div class="px-lg-8 mt-4">
                                                                    <h2 class="h1 color-blue">Welcome to Quiz</h2>
                                                                    <p class="mb-0">Engage live or asynchronously with quiz and poll questions that participants complete at their own pace.</p>
                                                                    <!-- <a href="student-quiz-start.html" class="btn btn-primary mt-4">Start Your Quiz</a> -->
                                                                    <button class="btn btn-primary mt-4 color-green" onclick="courseForm.next()">
                                                                        Start Your Quiz
                                                                        <i class="fe fe-arrow-right"></i>
                                                                        </button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Button -->
                                                        <div class="mt-3 d-flex justify-content-end">
                                                            
                                                        </div>
                                                        </div>
                                                        

                                                        <!-- Content one -->
                                                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane fade">
                                                        <div class="card mb-4">
                                                            <!-- Card body -->
                                                            <div class="card-body">
                                                            <!-- quiz -->
                                                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                                <div class="d-flex align-items-center">
                                                                <!-- quiz img -->
                                                                <a href="#"><img src="{{ asset('frontend/images/quiz-image.jpg')}}" alt="course" class="rounded img-4by3-lg" /></a>

                                                                

                                                                <!-- quiz content -->
                                                                <div class="ms-3">
                                                                    <h3 class="mb-0"><a href="#" class="text-inherit">Human Resource Management Basic Quiz</a></h3>
                                                                </div>
                                                                </div>

                                                            </div>
                                                            <div class="mt-3">
                                                                <!-- text -->
                                                                <div class="d-flex justify-content-between">
                                                                <span>Exam Progress:</span>
                                                                <span>Question 1 out of 5</span>
                                                                </div>
                                                                <!-- progress bar -->
                                                                <div class="mt-2">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <!-- text -->
                                                            <div class="mt-5">
                                                                <span>Question 1</span>
                                                                <h3 class="mb-3 color-blue  mt-1">Human Resource Management is mainly used for building ___.</h3>
                                                                <!-- list group -->
                                                                <div class="list-group">
                                                                <div class="list-group-item list-group-item-action" aria-current="true">
                                                                    <!-- form check -->
                                                                    <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
                                                                    <label class="form-check-label stretched-link" for="flexRadioDefault1">Database</label>
                                                                    </div>
                                                                </div>
                                                                <!-- list group -->
                                                                <div class="list-group-item list-group-item-action">
                                                                    <!-- form check -->
                                                                    <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                                                                    <label class="form-check-label stretched-link" for="flexRadioDefault2">Connectivity</label>
                                                                    </div>
                                                                </div>
                                                                <!-- list group -->
                                                                <div class="list-group-item list-group-item-action">
                                                                    <!-- form check -->
                                                                    <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" />
                                                                    <label class="form-check-label stretched-link" for="flexRadioDefault3">User interface</label>
                                                                    </div>
                                                                </div>
                                                                <!-- list group -->
                                                                <div class="list-group-item list-group-item-action">
                                                                    <!-- form check -->
                                                                    <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" />
                                                                    <label class="form-check-label stretched-link" for="flexRadioDefault4">Design Platform</label>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <!-- Button -->
                                                        <div class="mt-3 d-flex justify-content-end">
                                                            <button class="btn btn-primary color-green" onclick="courseForm.next()">
                                                            Next
                                                            <i class="fe fe-arrow-right"></i>
                                                            </button>
                                                        </div>
                                                        </div>

                                                        <!-- Content two -->
                                                        <div id="test-l-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger2">
                                                        <div class="card mb-4">
                                                            <!-- Card body -->
                                                            <div class="card-body">
                                                            <!-- quiz -->
                                                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                                <div class="d-flex align-items-center">
                                                                <!-- quiz img -->
                                                                <a href="#"><img src="{{ asset('frontend/images/quiz-image.jpg')}}" alt="course" class="rounded img-4by3-lg" /></a>
                                                                <!-- quiz content -->
                                                                <div class="ms-3">
                                                                    <h3 class="mb-0"><a href="#" class="text-inherit">Human Resource Management Basic Quiz</a></h3>
                                                                </div>
                                                                </div>

                                                            </div>
                                                            <div class="mt-3">
                                                                <!-- text -->
                                                                <div class="d-flex justify-content-between">
                                                                <span>Exam Progress:</span>
                                                                <span>Question 2 out of 5</span>
                                                                </div>
                                                                <!-- progress bar -->
                                                                <div class="mt-2">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <!-- text -->
                                                            <div class="mt-5">
                                                                <span>Question 2</span>
                                                                <h3 class="mb-3 color-blue  mt-1">The lifecycle methods are mainly used for ___.</h3>
                                                                <!-- list group -->
                                                                <div class="list-group">
                                                                <div class="list-group-item list-group-item-action" aria-current="true">
                                                                    <!-- form check -->
                                                                    <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault15" />
                                                                    <label class="form-check-label stretched-link" for="flexRadioDefault15">keeping track of event history</label>
                                                                    </div>
                                                                </div>
                                                                <!-- list group -->
                                                                <div class="list-group-item list-group-item-action">
                                                                    <!-- form check -->
                                                                    <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6" />
                                                                    <label class="form-check-label stretched-link" for="flexRadioDefault6">enhancing components</label>
                                                                    </div>
                                                                </div>
                                                                <!-- list group -->
                                                                <div class="list-group-item list-group-item-action">
                                                                    <!-- form check -->
                                                                    <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault7" />
                                                                    <label class="form-check-label stretched-link" for="flexRadioDefault7">freeing up resources</label>
                                                                    </div>
                                                                </div>
                                                                <!-- list group -->
                                                                <div class="list-group-item list-group-item-action">
                                                                    <!-- form check -->
                                                                    <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault8" />
                                                                    <label class="form-check-label stretched-link" for="flexRadioDefault8">none of the above</label>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <!-- Button -->
                                                        <div class="d-flex justify-content-between">
                                                            <button class="btn btn-secondary" onclick="courseForm.previous()">
                                                            <i class="fe fe-arrow-left"></i>
                                                            Previous
                                                            </button>
                                                            <button class="btn btn-primary color-green" onclick="courseForm.next()">
                                                            Next
                                                            <i class="fe fe-arrow-right"></i>
                                                            </button>
                                                        </div>
                                                        </div>
                                                        <!-- Content three -->
                                                        <div id="test-l-3" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger3">
                                                        <div class="card mb-4">
                                                            <!-- Card body -->
                                                            <div class="card-body">
                                                            <!-- quiz -->
                                                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                                <div class="d-flex align-items-center">
                                                                <!-- quiz img -->
                                                                <a href="#"><img src="{{ asset('frontend/images/quiz-image.jpg')}}" alt="course" class="rounded img-4by3-lg" /></a>
                                                                <!-- quiz content -->
                                                                <div class="ms-3">
                                                                    <h3 class="mb-0"><a href="#" class="text-inherit">Human Resource Management Basic Quiz</a></h3>
                                                                </div>
                                                                </div>

                                                            </div>
                                                            <div class="mt-3">
                                                                <!-- text -->
                                                                <div class="d-flex justify-content-between">
                                                                <span>Exam Progress:</span>
                                                                <span>Question 3 out of 5</span>
                                                                </div>
                                                                <!-- progress bar -->
                                                                <div class="mt-2">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <!-- text -->
                                                            <div class="mt-5">
                                                                <span>Question 3</span>
                                                                <h3 class="mb-3 color-blue ">___ can be done while multiple elements need to be returned from a component.</h3>
                                                                <!-- list group -->
                                                                <div class="list-group">
                                                                    <div class="list-group-item list-group-item-action" aria-current="true">
                                                                        <!-- form check -->
                                                                        <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault15" />
                                                                        <label class="form-check-label stretched-link" for="flexRadioDefault15">keeping track of event history</label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- list group -->
                                                                    <div class="list-group-item list-group-item-action">
                                                                        <!-- form check -->
                                                                        <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6" />
                                                                        <label class="form-check-label stretched-link" for="flexRadioDefault6">enhancing components</label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- list group -->
                                                                    <div class="list-group-item list-group-item-action">
                                                                        <!-- form check -->
                                                                        <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault7" />
                                                                        <label class="form-check-label stretched-link" for="flexRadioDefault7">freeing up resources</label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- list group -->
                                                                    <div class="list-group-item list-group-item-action">
                                                                        <!-- form check -->
                                                                        <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault8" />
                                                                        <label class="form-check-label stretched-link" for="flexRadioDefault8">none of the above</label>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <!-- Button -->
                                                        <div class="d-flex justify-content-between">
                                                            <button class="btn btn-secondary" onclick="courseForm.previous()">
                                                            <i class="fe fe-arrow-left"></i>
                                                            Previous
                                                            </button>
                                                            <button class="btn btn-primary color-green" onclick="courseForm.next()">
                                                            Next
                                                            <i class="fe fe-arrow-right"></i>
                                                            </button>
                                                        </div>
                                                        </div>
                                                        <!-- Content four -->
                                                        <div id="test-l-4" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger4">
                                                        <div class="card mb-4">
                                                            <!-- Card body -->
                                                            <div class="card-body">
                                                            <!-- quiz -->
                                                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                                <div class="d-flex align-items-center">
                                                                <!-- quiz img -->
                                                                <a href="#"><img src="{{ asset('frontend/images/quiz-image.jpg')}}" alt="course" class="rounded img-4by3-lg" /></a>
                                                                <!-- quiz content -->
                                                                <div class="ms-3">
                                                                    <h3 class="mb-0"><a href="#" class="text-inherit">Human Resource Management Basic Quiz</a></h3>
                                                                </div>
                                                                </div>

                                                            </div>
                                                            <!-- text -->
                                                            <div class="mt-3">
                                                                <div class="d-flex justify-content-between">
                                                                <span>Exam Progress:</span>
                                                                <span>Question 4 out of 5</span>
                                                                </div>
                                                                <!-- progress bar -->
                                                                <div class="mt-2">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <!-- text -->
                                                            <div class="mt-5">
                                                                <span>Question 4</span>
                                                                <h3 class="mb-3 color-blue ">What’s the difference between a 301 and a 302 redirect?</h3>
                                                                <!-- list group -->
                                                                <div class="list-group">
                                                                    <div class="list-group-item list-group-item-action" aria-current="true">
                                                                        <!-- form check -->
                                                                        <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault15" />
                                                                        <label class="form-check-label stretched-link" for="flexRadioDefault15">keeping track of event history</label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- list group -->
                                                                    <div class="list-group-item list-group-item-action">
                                                                        <!-- form check -->
                                                                        <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6" />
                                                                        <label class="form-check-label stretched-link" for="flexRadioDefault6">enhancing components</label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- list group -->
                                                                    <div class="list-group-item list-group-item-action">
                                                                        <!-- form check -->
                                                                        <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault7" />
                                                                        <label class="form-check-label stretched-link" for="flexRadioDefault7">freeing up resources</label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- list group -->
                                                                    <div class="list-group-item list-group-item-action">
                                                                        <!-- form check -->
                                                                        <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault8" />
                                                                        <label class="form-check-label stretched-link" for="flexRadioDefault8">none of the above</label>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <!-- Button -->
                                                        <div class="d-flex justify-content-between">
                                                            <button class="btn btn-secondary" onclick="courseForm.previous()">
                                                            <i class="fe fe-arrow-left"></i>
                                                            Previous
                                                            </button>
                                                            <button class="btn btn-primary color-green" onclick="courseForm.next()">
                                                            Next
                                                            <i class="fe fe-arrow-right"></i>
                                                            </button>
                                                        </div>
                                                        </div>

                                                        <div id="test-l-5" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger5">
                                                        <div class="card mb-4">
                                                            <!-- Card body -->
                                                            <div class="card-body">
                                                            <!-- quiz -->
                                                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                                <div class="d-flex align-items-center">
                                                                <!-- quiz img -->
                                                                <a href="#"><img src="{{ asset('frontend/images/quiz-image.jpg')}}" alt="course" class="rounded img-4by3-lg" /></a>
                                                                <!-- quiz content -->
                                                                <div class="ms-3">
                                                                    <h3 class="mb-0"><a href="#" class="text-inherit">Human Resource Management Basic Quiz</a></h3>
                                                                </div>
                                                                </div>

                                                            </div>
                                                            <div class="mt-3">
                                                                <div class="d-flex justify-content-between">
                                                                <span>Exam Progress:</span>
                                                                <span>Question 5 out of 5</span>
                                                                </div>
                                                                <!-- progress bar -->
                                                                <div class="mt-2">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-5">
                                                                <!-- text -->
                                                                <span>Question 5</span>
                                                                <h3 class="mb-3 color-blue ">Is Human Resource Management a programming language?</h3>
                                                                <!-- list group -->
                                                                <div class="list-group">
                                                                <div class="list-group-item list-group-item-action" aria-current="true">
                                                                    <!-- form check -->
                                                                    <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault9" />
                                                                    <label class="form-check-label stretched-link" for="flexRadioDefault9">Yes</label>
                                                                    </div>
                                                                </div>
                                                                <!-- list group -->
                                                                <div class="list-group-item list-group-item-action">
                                                                    <!-- form check -->
                                                                    <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault10" />
                                                                    <label class="form-check-label stretched-link" for="flexRadioDefault10">No</label>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                    
                                                        <!-- Button -->
                                                        <div class="d-flex justify-content-between">
                                                            <button class="btn btn-secondary" onclick="courseForm.previous()">
                                                            <i class="fe fe-arrow-left"></i>
                                                            Previous
                                                            </button>
                                                            <button type="submit" class="btn btn-primary color-green" onclick="courseForm.next()">Finish</button>
                                                        </div>
                                                        </div>


                                                        <div id="quiz-result" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger5">
                                                        <div class="card mb-4">
                                                        <!-- card body -->
                                                            <div class="card-body p-10 text-center">
                                                                <!-- text -->
                                                                <div class="mb-4">
                                                                <h2 class="color-blue">🎉 Congratulations. You passed!</h2>
                                                                <p class="mb-0 px-lg-8">You are successfully completed the quiz. Now you click on finish and back to your quiz page.</p>
                                                                </div>
                                                                <!-- chart -->
                                                                <div class="d-flex justify-content-center">
                                                                <div class="resultChart"></div>
                                                                </div>
                                                                <!-- text -->
                                                                <div class="mt-3">
                                                                <span>
                                                                    Your Score:
                                                                    <span class="text-dark">85.83% (85.83 points)</span>
                                                                </span>
                                                                <br />
                                                                <span class="mt-2 d-block">
                                                                    Passing Score:
                                                                    <span class="text-dark">80%</span>
                                                                </span>
                                                                </div>
                                                                <!-- btn -->
                                                                <div class="mt-5">
                                                                <!-- <a href="#" class="btn btn-primary color-green">Finish</a> -->
                                                                <a href="#" class="btn btn-outline-secondary ms-2">
                                                                    Share
                                                                    <i class="fe fe-external-link"></i>
                                                                </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>










                                            </div>
                                        </div>
                                    </div>

                                </div>

                                
                                <!-- Resource 1 Tab pane -->
                                <div class="tab-pane fade" id="resource" role="tabpanel" aria-labelledby="resource-tab">
                                    
                                    <!-- Video -->
                                    <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0" style="height: 600px">
                                        <div style="text-align:center">
                                            <h4>Pdf viewer testing</h4>
                                            <iframe
                                            class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100"
                                            width="560"
                                            height="315"
                                            src="{{ asset('frontend/images/pdf/Unit-4.pdf')}}"
                                            title="E-Ascencia - Academy and LMS Template"
                                            frameborder="0"></iframe>
                                              </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </section>


                

                <section class="pb-8">
                    <div class="container-fluid">
                        <div class="row">
            
                            <div class="col-lg-12 col-md-12 col-12 mb-4 mb-lg-0">
                                <!-- Card -->
                                <div class="card rounded-3">
                                    <!-- Card header -->
                                    <div class="card-header border-bottom-0 p-0">
                                        <div>
                                            <!-- Nav -->
                                            <ul class="nav nav-lb-tab" id="tab" role="tablist">


                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="faq-tab" data-bs-toggle="pill" href="#faq" role="tab" aria-controls="faq" aria-selected="false" tabindex="-1">Create Notes</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="tab-content" id="tabContent">


                                            <!-- Tab pane -->
                                            <div class="tab-pane fade show active" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                                                <!-- FAQ -->
                                                 <!-- Card -->

                                                    <!-- Card Body -->
                                                    <form>
   
                                                    <div class="mb-3 mb-4">
                                                        <label for="siteDescription" class="form-label">Add your notes here
                                                    </label>
                                                <textarea class="form-control" id="siteDescription" placeholder="Write Notes.... " required="" rows="4"></textarea>

                                                    </div>
                                                    
                                                <button type="submit" class="btn btn-primary">
                                                <a href="#" class="text-white" >Add Note +</a></button>
                                                
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            

                        </div>

                    
                        
                    </div>
                </section>
            </main>
        </div>


@endsection



<script>
let buttonToggle = () => {
    const button = document.getElementById("menu-button").classList,
    isopened = "is-opened";
    let isOpen = button.contains(isopened);
    if(isOpen) {
      button.remove(isopened);
      
    } 
    else {
      button.add(isopened);
      
    }
} 
</script>