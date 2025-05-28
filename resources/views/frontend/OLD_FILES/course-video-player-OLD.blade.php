@extends('frontend.master')
@section('content')


        <!-- Wrapper -->
        <div id="db-wrapper" class="course-video-player-page">
            <!-- Sidebar -->
        
            <nav class="navbar-vertical navbar">
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
                            <a class="d-flex align-items-center h4 mb-0" data-bs-toggle="collapse" href="#courseTwo" role="button" aria-expanded="false" aria-controls="courseTwo">
                                <div class="me-auto">Recruitment and Employee Selection</div>
                                <!-- Chevron -->
                                <span class="chevron-arrow ms-4">
                                    <i class="fe fe-chevron-down fs-4"></i>
                                </span>
                            </a>
                            <!-- Row -->
                            <!-- Collapse -->
                            <div class="collapse show" id="courseTwo" data-bs-parent="#courseAccordion">
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
                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit" id="course-assessment-tab" data-bs-toggle="pill" href="#course-assessment" role="tab" aria-controls="course-assessment" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green"><i class="bi bi-journal-text fs-6 color-dark-green"></i></span>
                                            <span class="color-dark-green">Assessment 1</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>2 Hours</span>
                                        </div>
                                    </a>
                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit" id="course-assessment-2-tab" data-bs-toggle="pill" href="#course-assessment-2" role="tab" aria-controls="course-assessment-2" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green"><i class="bi bi-journal-text fs-6 color-dark-green"></i></span>
                                            <span class="color-dark-green">Assessment 2</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>2 Hours</span>
                                        </div>
                                    </a>
                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit" id="e-portfolio-tab" data-bs-toggle="pill" href="#e-portfolio" role="tab" aria-controls="e-portfolio" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green"><i class="bi bi-journal-text fs-6 color-dark-green"></i></span>
                                            <span class="color-dark-green">E-portfolio</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>2 Hours</span>
                                        </div>
                                    </a>
                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit" id="assignment-tab" data-bs-toggle="pill" href="#assignment" role="tab" aria-controls="assignment" aria-selected="false">
                                        <div class="text-truncate">
                                            <span class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 bg-light"><i class="bi bi-journal-text fs-6"></i></span>
                                            <span class="">Assignment</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>2 Hours</span>
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
                                            <span class="">Resource</span>
                                        </div>
                                        <div class="text-truncate">
                                            <span>20 Min</span>
                                        </div>
                                    </a>
                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit" id="exam-tab" data-bs-toggle="pill" href="#exam" role="tab" aria-controls="exam" aria-selected="false">
                                        <div class="text-truncate">
                                        <div class="text-truncate">
                                            <span class="icon-shape text-primary icon-sm rounded-circle me-2 bg-light">
                                                <i class="fe fe-book nav-icon fs-6"></i></span>
                                            <span class="">Exam</span>
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
                                <h3 class="mb-0 text-truncate-line-2 color-blue">Masters of Arts in Human Resource Management</h3>
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
                                
                                <div class="tab-pane fade show active" id="course-intro" role="tabpanel" aria-labelledby="course-intro-tab">

                                    <!-- Video -->

                                    <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0" style="height: 600px;osition:relative;padding-top:56.25%;">
                                        <iframe src="https://iframe.mediadelivery.net/embed/243359/689a5433-af71-4cc1-b085-10ede00362b7?autoplay=true&loop=false&muted=true&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe>
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

                                <!-- Assessment 1 Tab pane -->
                                <div class="tab-pane fade" id="course-assessment" role="tabpanel" aria-labelledby="course-assessment-tab">
                                    
                                    {{-- Assessment 1 --}}
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <h2>Assessment 1: Recruitment and Employee Selection</h2>
                                        </div>
                                        <div class="col-md-12 mb-5">
                                                <label for="textarea-input" class="form-label">
                                                    <span class="color-blue"> Question 1: </span>
                                                    Explain the concept of talent management and its significance in modern organizations. How can HR professionals effectively manage and retain top talent?
                                                </label>
                                                <h6>Answer:</h6>
                                                <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                                        </div>
                                        <div class="col-md-12 mb-5">
                                                <label for="textarea-input" class="form-label">
                                                    <span class="color-blue"> Question 2: </span>
                                                    Analyze the role of diversity and inclusion in the workplace. What are the benefits and challenges associated with implementing diversity initiatives in an organization?
                                                </label>
                                                <h6>Answer:</h6>
                                                <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                                        </div>
                                        <div class="col-md-12 mb-5">
                                                <label for="textarea-input" class="form-label">
                                                    <span class="color-blue"> Question 3: </span>
                                                    Which of the following is NOT a function of human resource management?
                                                </label>
                                                <h6>Answer:</h6>
                                                <div class="list-group bg-white">
                                                    <div class="list-group-item list-group-item-action" aria-current="true">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault1">Recruitment and selection</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault2">Financial auditing</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault3">Training and development</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault4">Employee relations</label>
                                                        </div>
                                                    </div>
                                                    </div>
                                        </div>
                                        <div class="col-md-12 mb-5">
                                                <label for="textarea-input" class="form-label">
                                                    <span class="color-blue"> Question 4: </span>
                                                    Which of the following is NOT a function of human resource management?
                                                </label>
                                                <h6>Answer:</h6>
                                                <div class="list-group bg-white">
                                                    <div class="list-group-item list-group-item-action" aria-current="true">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault11">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault11">Recruitment and selection</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault22">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault22">Financial auditing</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault33">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault33">Training and development</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault44">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault44">Employee relations</label>
                                                        </div>
                                                    </div>
                                                    </div>
                                        </div>

                                        <div class="col-md-12 mb-5">
                                            <label for="textarea-input" class="form-label">
                                                <span class="color-blue"> Question 5: </span>
                                                Analyze the role of diversity and inclusion in the workplace. What are the benefits and challenges associated with implementing diversity initiatives in an organization?
                                            </label>
                                            <h6>Answer:</h6>
                                            <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                                    </div>


                                    <div class="col-12 mb-6 text-center">
                                        <a href="#" class="btn btn-primary">Submit Assessment</a>
                                    </div>

                                    </div>
                                </div>

                                <!-- Assessment 2 Tab pane -->
                                <div class="tab-pane fade" id="course-assessment-2" role="tabpanel" aria-labelledby="course-assessment-2-tab">
                                    
                                    {{-- Assessment 2 --}}
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <h2>Assessment 2: Recruitment and Employee Selection</h2>
                                        </div>
                                        <div class="col-md-12 mb-5">
                                                <label for="textarea-input" class="form-label">
                                                    <span class="color-blue"> Question 1: </span>
                                                    Explain the concept of talent management and its significance in modern organizations. How can HR professionals effectively manage and retain top talent?
                                                </label>
                                                <h6>Answer:</h6>
                                                <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                                        </div>
                                        <div class="col-md-12 mb-5">
                                                <label for="textarea-input" class="form-label">
                                                    <span class="color-blue"> Question 2: </span>
                                                    Analyze the role of diversity and inclusion in the workplace. What are the benefits and challenges associated with implementing diversity initiatives in an organization?
                                                </label>
                                                <h6>Answer:</h6>
                                                <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                                        </div>
                                        <div class="col-md-12 mb-5">
                                                <label for="textarea-input" class="form-label">
                                                    <span class="color-blue"> Question 3: </span>
                                                    Which of the following is NOT a function of human resource management?
                                                </label>
                                                <h6>Answer:</h6>
                                                <div class="list-group bg-white">
                                                    <div class="list-group-item list-group-item-action" aria-current="true">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault1">Recruitment and selection</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault2">Financial auditing</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault3">Training and development</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault4">Employee relations</label>
                                                        </div>
                                                    </div>
                                                    </div>
                                        </div>
                                        <div class="col-md-12 mb-5">
                                                <label for="textarea-input" class="form-label">
                                                    <span class="color-blue"> Question 4: </span>
                                                    Which of the following is NOT a function of human resource management?
                                                </label>
                                                <h6>Answer:</h6>
                                                <div class="list-group bg-white">
                                                    <div class="list-group-item list-group-item-action" aria-current="true">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault11">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault11">Recruitment and selection</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault22">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault22">Financial auditing</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault33">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault33">Training and development</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault44">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault44">Employee relations</label>
                                                        </div>
                                                    </div>
                                                    </div>
                                        </div>

                                        <div class="col-md-12 mb-5">
                                            <label for="textarea-input" class="form-label">
                                                <span class="color-blue"> Question 5: </span>
                                                Analyze the role of diversity and inclusion in the workplace. What are the benefits and challenges associated with implementing diversity initiatives in an organization?
                                            </label>
                                            <h6>Answer:</h6>
                                            <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                                    </div>


                                    <div class="col-12 mb-6 text-center">
                                        <a href="#" class="btn btn-primary">Submit Assessment</a>
                                    </div>

                                    </div>

                                </div>

                                <!-- E-portfolio Tab pane -->
                                <div class="tab-pane fade" id="e-portfolio" role="tabpanel" aria-labelledby="e-portfolio-tab">
                                    
                                    {{-- E-portfolio --}}
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <h2>E-Portfolio: Master of Arts in Human Resource Management</h2>
                                            <p>Showcase Your Expertise and Achievements in Human Resource Management</p>
                                        </div>
                                        <div class="col-md-12 mb-5">

                                                <textarea class="form-control" id="textarea-input" rows="20"> </textarea>
                                        </div>



                                    <div class="col-12 mb-6 text-center">
                                        <a href="#" class="btn btn-primary">Submit E-Portfolio</a>
                                    </div>

                                    </div>

                                </div>

                                <!-- Assignment Tab pane -->
                                <div class="tab-pane fade" id="assignment" role="tabpanel" aria-labelledby="assignment-tab">
                                    
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <h2>Assignment 1: Recruitment and Employee Selection</h2>
                                        </div>
                                        <div class="col-md-12 mb-5">
                                                <label for="textarea-input" class="form-label">
                                                    <span class="color-blue"> Question 1: </span>
                                                    Explain the concept of talent management and its significance in modern organizations. How can HR professionals effectively manage and retain top talent?
                                                </label>
                                                <h6>Answer:</h6>
                                                <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                                        </div>
                                        <div class="col-md-12 mb-5">
                                                <label for="textarea-input" class="form-label">
                                                    <span class="color-blue"> Question 2: </span>
                                                    Analyze the role of diversity and inclusion in the workplace. What are the benefits and challenges associated with implementing diversity initiatives in an organization?
                                                </label>
                                                <h6>Answer:</h6>
                                                <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                                        </div>
                                        <div class="col-md-12 mb-5">
                                                <label for="textarea-input" class="form-label">
                                                    <span class="color-blue"> Question 3: </span>
                                                    Which of the following is NOT a function of human resource management?
                                                </label>
                                                <h6>Answer:</h6>
                                                <div class="list-group bg-white">
                                                    <div class="list-group-item list-group-item-action" aria-current="true">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault1">Recruitment and selection</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault2">Financial auditing</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault3">Training and development</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault4">Employee relations</label>
                                                        </div>
                                                    </div>
                                                    </div>
                                        </div>
                                        <div class="col-md-12 mb-5">
                                                <label for="textarea-input" class="form-label">
                                                    <span class="color-blue"> Question 4: </span>
                                                    Which of the following is NOT a function of human resource management?
                                                </label>
                                                <h6>Answer:</h6>
                                                <div class="list-group bg-white">
                                                    <div class="list-group-item list-group-item-action" aria-current="true">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault11">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault11">Recruitment and selection</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault22">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault22">Financial auditing</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault33">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault33">Training and development</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <!-- form check -->
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault44">
                                                        <label class="form-check-label stretched-link" for="flexRadioDefault44">Employee relations</label>
                                                        </div>
                                                    </div>
                                                    </div>
                                        </div>

                                        <div class="col-md-12 mb-5">
                                            <label for="textarea-input" class="form-label">
                                                <span class="color-blue"> Question 5: </span>
                                                Analyze the role of diversity and inclusion in the workplace. What are the benefits and challenges associated with implementing diversity initiatives in an organization?
                                            </label>
                                            <h6>Answer:</h6>
                                            <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                                    </div>


                                    <div class="col-12 mb-6 text-center">
                                        <a href="#" class="btn btn-primary">Submit Assessment</a>
                                    </div>

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
                                            <iframe src="https://docs.google.com/viewer?url=http://www.pdf995.com/samples/pdf.pdf&embedded=true" frameborder="0" height="500px" width="100%" class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100"></iframe>
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
                                                    <a class="nav-link active" id="table-tab" data-bs-toggle="pill" href="#table" role="tab" aria-controls="table" aria-selected="true">Contents</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="overview-tab" data-bs-toggle="pill" href="#overview" role="tab" aria-controls="overview" aria-selected="false" tabindex="-1">
                                                        Overview
                                                    </a>
                                                </li>

                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="faq-tab" data-bs-toggle="pill" href="#faq" role="tab" aria-controls="faq" aria-selected="false" tabindex="-1">Notes</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="tab-content" id="tabContent">
                                            
                                            <div class="tab-pane fade show active" id="table" role="tabpanel" aria-labelledby="table-tab">
                                                <!-- Card -->
                                                <div class="accordion" id="courseAccordion2">
                                                    <div>
                                                        <!-- List group -->
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item px-0 pt-0">
                                                                <!-- Toggle -->
                                                                <a class="h4 mb-0 d-flex align-items-center active" data-bs-toggle="collapse" href="#courseTwo1" aria-expanded="true" aria-controls="courseTwo1">
                                                                    <div class="me-auto">Introduction to Human Resource Management
                                                                        <span class="mb-0 fs-6 mt-1 fw-normal">(6 ECTS) (300 Hours) </span>
                                                                                
                                                                    </div>
                                                                    
                                                                    <!-- Chevron -->
                                                                    <span class="chevron-arrow ms-4">
                                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                                    </span>
                                                                </a>
                                                                <!-- Row -->
                                                                <!-- Collapse -->
                                                                <div class="collapse show" id="courseTwo1" data-bs-parent="#courseAccordion2">
                                                                    <div class="pt-3 pb-2">
                                                                        <div class="mb-2">
                                                                            <div class="progress" style="height: 6px">
                                                                                <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 45%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <small>45% Completed</small>
                                                                        </div>
                                                                        <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-blue icon-sm rounded-circle me-2">
                                                                                    <i class="bi bi-check2 color-green fs-4 fw-bold"></i>
                                                                                </span>
                                                                                <span class="preview-course-heading">Introduction</span>
                                                                                
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 7s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-blue icon-sm rounded-circle me-2">
                                                                                    
                                                                                    <i class="bi bi-check2 color-green fs-4 fw-bold"></i>
                                                                                </span>
                                                                                <span class="preview-course-heading">Installing Development Software</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 11s</span>
                                                                            </div>
                                                                        </a>

                                                                        <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                    <i class="fe fe-play"></i>
                                                                                </span>
                                                                                <span>Our Sample Website</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 15s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="course-resume.html" class="d-flex justify-content-between align-items-center text-inherit">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                    <i class="fe fe-play"></i>
                                                                                </span>
                                                                                <span>Sample Website</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 15s</span>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <!-- List group item -->
                                                            <li class="list-group-item px-0">
                                                                <!-- Toggle -->
                                                                <a class="h4 mb-0 d-flex align-items-center" data-bs-toggle="collapse" href="#courseThree3" aria-expanded="false" aria-controls="courseThree3">
                                                                    <div class="me-auto">
                                                                        <!-- Title -->
                                                                        Human Resource Management Beginning
                                                                        <span class="mb-0 fs-6 mt-1 fw-normal">(6 ECTS) (300 Hours) </span>
                                                                    </div>
                                                                    <!-- Chevron -->
                                                                    <span class="chevron-arrow ms-4">
                                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                                    </span>
                                                                </a>
                                                                <!-- Row -->
                                                                <!-- Collapse -->
                                                                <div class="collapse" id="courseThree3" data-bs-parent="#courseAccordion2">
                                                                    <div class="pt-3 pb-2">
                                                                        <div class="mb-2">
                                                                            <div class="progress" style="height: 6px">
                                                                                <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <small>0% Completed</small>
                                                                        </div>
            
                                                                        <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                    <i class="fe fe-play"></i>
                                                                                </span>
                                                                                <span>Introduction</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 41s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                    <i class="fe fe-play"></i>
                                                                                </span>
                                                                                <span>Adding Human Resource Management Code to a Web
                                                                                    Page</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 39s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                    <i class="fe fe-play"></i>
                                                                                </span>
                                                                                <span>Working with Human Resource Management Files</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>6m 18s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                    <i class="fe fe-play"></i>
                                                                                </span>
                                                                                <span>Formatting Code</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 18s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                    <i class="fe fe-play"></i>
                                                                                </span>
                                                                                <span>Detecting and Fixing Errors</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 14s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                    <i class="fe fe-play"></i>
                                                                                </span>
                                                                                <span>Case Sensitivity</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 48s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                    <i class="fe fe-play"></i>
                                                                                </span>
                                                                                <span>Commenting Code</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 24s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="course-resume.html" class="mb-0 d-flex justify-content-between align-items-center text-inherit">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                    <i class="fe fe-play"></i>
                                                                                </span>
                                                                                <span>Summary</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 14s</span>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <!-- List group item -->
                                                            <li class="list-group-item px-0">
                                                                <!-- Toggle -->
                                                                <a class="h4 mb-0 d-flex align-items-center" data-bs-toggle="collapse" href="#courseFour4" aria-expanded="false" aria-controls="courseFour4">
                                                                    <div class="me-auto">
                                                                        <!-- Title -->
                                                                        Variables and Constants
                                                                    </div>
                                                                    <!-- Chevron -->
                                                                    <span class="chevron-arrow ms-4">
                                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                                    </span>
                                                                </a>
                                                                <!-- Row -->
                                                                <!-- Collapse -->
                                                                <div class="collapse" id="courseFour4" data-bs-parent="#courseAccordion2">
                                                                    <div class="pt-3 pb-2">
                                                                        <div class="mb-2">
                                                                            <div class="progress" style="height: 6px">
                                                                                <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <small>0% Completed</small>
                                                                        </div>
            
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Introduction</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 19s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>What Is a Variable?</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 11s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Declaring Variables</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 30s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Using let to Declare Variables</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 28s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Naming Variables</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 14s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Common Errors Using Variables</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 30s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Changing Variable Values</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 4s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Constants</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 15s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>The var Keyword</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 20s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-0 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Summary</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 49s</span>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <!-- List group item -->
                                                            <li class="list-group-item px-0">
                                                                <!-- Toggle -->
                                                                <a class="h4 mb-0 d-flex align-items-center" data-bs-toggle="collapse" href="#courseFive5" aria-expanded="false" aria-controls="courseFive5">
                                                                    <div class="me-auto">
                                                                        <!-- Title -->
                                                                        Types and Operators
                                                                        <span class="mb-0 fs-6 mt-1 fw-normal">(6 ECTS) (300 Hours) </span>
                                                                    </div>
                                                                    <!-- Chevron -->
                                                                    <span class="chevron-arrow ms-4">
                                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                                    </span>
                                                                </a>
                                                                <!-- Row -->
                                                                <!-- Collapse -->
                                                                <div class="collapse" id="courseFive5" data-bs-parent="#courseAccordion2">
                                                                    <div class="pt-3 pb-2">
                                                                        <div class="mb-2">
                                                                            <div class="progress" style="height: 6px">
                                                                                <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <small>0% Completed</small>
                                                                        </div>
            
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Introduction</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 55s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Numbers</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>6m 14s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Operator Precedence</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 58s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Number Precision</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 22s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Negative Numbers</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 35s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Strings</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>4m 7s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Manipulating Strings</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>5m 8s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Converting Strings and Numbers</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 55s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-0 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Boolean Variables</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 39s</span>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <!-- List group item -->
                                                            <li class="list-group-item px-0">
                                                                <!-- Toggle -->
                                                                <a class="h4 mb-0 d-flex align-items-center" data-bs-toggle="collapse" href="#courseSix6" aria-expanded="false" aria-controls="courseSix6">
                                                                    <div class="me-auto">
                                                                        <!-- Title -->
                                                                        Program Flow
                                                                        <span class="mb-0 fs-6 mt-1 fw-normal">(6 ECTS) (300 Hours) </span>
                                                                    </div>
                                                                    <!-- Chevron -->
                                                                    <span class="chevron-arrow ms-4">
                                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                                    </span>
                                                                </a>
                                                                <!-- Row -->
                                                                <!-- Collapse -->
                                                                <div class="collapse" id="courseSix6" data-bs-parent="#courseAccordion2">
                                                                    <div class="pt-3 pb-2">
                                                                        <div class="mb-2">
                                                                            <div class="progress" style="height: 6px">
                                                                                <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <small>0% Completed</small>
                                                                        </div>
            
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Introduction</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 52s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Clip Watched</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>4m 27s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Conditionals Using if()</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>4m 25s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Truthy and Falsy</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 30s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>if ... else</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 30s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Comparing === and ==</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 52s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>The Ternary Operator</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 47s</span>
                                                                            </div>
                                                                        </a>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <!-- List group item -->
                                                            <li class="list-group-item px-0">
                                                                <!-- Toggle -->
                                                                <a class="h4 mb-0 d-flex align-items-center" data-bs-toggle="collapse" href="#courseSeven7" aria-expanded="false" aria-controls="courseSeven7">
                                                                    <div class="me-auto">
                                                                        <!-- Title -->
                                                                        Functions
                                                                        <span class="mb-0 fs-6 mt-1 fw-normal">(6 ECTS) (300 Hours) </span>
                                                                    </div>
                                                                    <!-- Chevron -->
                                                                    <span class="chevron-arrow ms-4">
                                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                                    </span>
                                                                </a>
                                                                <!-- Row -->
                                                                <!-- Collapse -->
                                                                <div class="collapse" id="courseSeven7" data-bs-parent="#courseAccordion2">
                                                                    <div class="pt-3 pb-2">
                                                                        <div class="mb-2">
                                                                            <div class="progress" style="height: 6px">
                                                                                <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <small>0% Completed</small>
                                                                        </div>
            
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Introduction</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 52s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Function Basics</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 46s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Function Expressions</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 32s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Passing Information to Functions</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 19s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Function Return Values</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 13s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Function Scope</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>4m 20s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Using Functions to Modify Web Pages</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 42s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-0 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Summary</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 3s</span>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <!-- List group item -->
                                                            <li class="list-group-item px-0">
                                                                <!-- Toggle -->
                                                                <a class="h4 mb-0 d-flex align-items-center" data-bs-toggle="collapse" href="#courseEight8" aria-expanded="false" aria-controls="courseEight8">
                                                                    <div class="me-auto">
                                                                        <!-- Title -->
                                                                        Objects and the DOM
                                                                        <span class="mb-0 fs-6 mt-1 fw-normal">(6 ECTS) (300 Hours) </span>
                                                                    </div>
                                                                    <!-- Chevron -->
                                                                    <span class="chevron-arrow ms-4">
                                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                                    </span>
                                                                </a>
                                                                <!-- Row -->
                                                                <!-- Collapse -->
                                                                <div class="collapse" id="courseEight8" data-bs-parent="#courseAccordion2">
                                                                    <div class="pt-3 pb-2">
                                                                        <div class="mb-2">
                                                                            <div class="progress" style="height: 6px">
                                                                                <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <small>0% Completed</small>
                                                                        </div>
            
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Introduction</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 48s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Object Properties</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>4m 28s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Object Methods</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 3s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Passing Objects to Functions</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 27s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Standard Built-in Objects</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>6m 55s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>The Document Object Model (DOM)</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 29s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Styling DOM Elements</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 42s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Detecting Button Clicks</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 3s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Showing and Hiding DOM Elements</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>4m 37s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Summary</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 47s</span>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <!-- List group item -->
                                                            <li class="list-group-item px-0">
                                                                <!-- Toggle -->
                                                                <a class="h4 mb-0 d-flex align-items-center" data-bs-toggle="collapse" href="#courseNine9" aria-expanded="false" aria-controls="courseNine9">
                                                                    <div class="me-auto">
                                                                        <!-- Title -->
                                                                        Arrays
                                                                        <span class="mb-0 fs-6 mt-1 fw-normal">(6 ECTS) (300 Hours) </span>
                                                                    </div>
                                                                    <!-- Chevron -->
                                                                    <span class="chevron-arrow ms-4">
                                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                                    </span>
                                                                </a>
                                                                <!-- Row -->
                                                                <!-- Collapse -->
                                                                <div class="collapse" id="courseNine9" data-bs-parent="#courseAccordion2">
                                                                    <div class="pt-3 pb-2">
                                                                        <div class="mb-2">
                                                                            <div class="progress" style="height: 6px">
                                                                                <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <small>0% Completed</small>
                                                                        </div>
            
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Introduction</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 48s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Creating and Initializing Arrays</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>4m 7s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Accessing Array Items</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 4s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Manipulating Arrays</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>4m 3s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>slice() and splice()</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>5m 54s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Array Searching and Looping</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>7m 32s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Arrays in the DOM</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>4m 11s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Summary</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 28s</span>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <!-- List group item -->
                                                            <li class="list-group-item px-0">
                                                                <!-- Toggle -->
                                                                <a class="h4 mb-0 d-flex align-items-center" data-bs-toggle="collapse" href="#courseTen10" aria-expanded="false" aria-controls="courseTen10">
                                                                    <div class="me-auto">
                                                                        <!-- Title -->
                                                                        Scope and Hoisting
                                                                        <span class="mb-0 fs-6 mt-1 fw-normal">(6 ECTS) (300 Hours) </span>
                                                                    </div>
                                                                    <!-- Chevron -->
                                                                    <span class="chevron-arrow ms-4">
                                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                                    </span>
                                                                </a>
                                                                <!-- Row -->
                                                                <!-- Collapse -->
                                                                <div class="collapse" id="courseTen10" data-bs-parent="#courseAccordion2">
                                                                    <div class="pt-3 pb-2">
                                                                        <div class="mb-2">
                                                                            <div class="progress" style="height: 6px">
                                                                                <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated progress-bar-striped progress-bar-animated" role="progressbar" style="width: 40%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <small>0% Completed</small>
                                                                        </div>
            
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Introduction</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 20s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Global Scope</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>4m 7s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Clip Watched</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 14s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Function Scope</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>3m 45s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Var and Hoisting</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 21s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Undeclared Variables and Strict
                                                                                    Mode</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>2m 16s</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                            <div class="text-truncate">
                                                                                <span class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i class="fe fe-play"></i></span>
                                                                                <span>Summary</span>
                                                                            </div>
                                                                            <div class="text-truncate">
                                                                                <span>1m 33s</span>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <!-- List group item -->
                                                            <li class="list-group-item px-0 pb-0">
                                                                <!-- Toggle -->
                                                                <a class="h4 mb-0 d-flex align-items-center" data-bs-toggle="collapse" href="#courseEleven11" aria-expanded="false" aria-controls="courseEleven11">
                                                                    <div class="me-auto">
                                                                        <!-- Title -->
                                                                        Summary
                                                                    </div>
                                                                    <!-- Chevron -->
                                                                    <span class="chevron-arrow ms-4">
                                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                                    </span>
                                                                </a>
                                                                <!-- Row -->
                                                                <!-- Collapse -->
                                                                <div class="collapse" id="courseEleven11" data-bs-parent="#courseAccordion2">
                                                                    <div class="pt-3 pb-2">
                                                                        <p>
                                                                            Lorem ipsum dolor sit amet consectetur adipisicing
                                                                            elit. Repudiandae esse velit eos sunt ab inventore
                                                                            est tenetur blanditiis?
                                                                            Voluptas eius molestiae ad itaque tempora nobis
                                                                            minima eveniet aperiam molestias, maiores natus
                                                                            expedita dolores ea non possimus
                                                                            magnam corrupt i quas rem unde quo enim porro culpa!
                                                                            Quaerat veritatis veniam corrupti iusto.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
            
            
                                            <div class="tab-pane fade" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                                <!-- overview -->
                                                <div class="mb-4">
                                                    <h3 class="mb-2">Course overview</h3>
                                                    <p>
                                                        If you’re learning to program for the first time, or if you’re coming
                                                        from a different language, this course, Human Resource Management: Getting Started,
                                                        will give
                                                        you the basics for coding in Human Resource Management. First, you'll discover the
                                                        types of applications that can be built with Human Resource Management, and the
                                                        platforms
                                                        they’ll run on.
                                                    </p>
                                                    <p>
                                                        Next, you’ll explore the basics of the language, giving plenty of
                                                        examples. Lastly, you’ll put your Human Resource Management knowledge to work and
                                                        modify a
                                                        modern, responsive web page. When you’re finished with this course,
                                                        you’ll have the skills and knowledge in Human Resource Management to create simple
                                                        programs,
                                                        create simple web applications, and modify web pages.
                                                    </p>
                                                </div>
                                                <h4 class="mb-3">What you’ll learn</h4>
                                                <div class="row mb-3">
                                                    <div class="col-12 col-md-6">
                                                        <ul class="list-unstyled">
                                                            <li class="d-flex mb-2">
                                                                <span class="me-2">
                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
                                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"></path>
                                                                    </svg>
                                                                </span>
                                                                <span>Recognize the importance of understanding your objectives
                                                                    when addressing an audience.</span>
                                                            </li>
                                                            <li class="d-flex mb-2">
                                                                <span class="me-2">
                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
                                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"></path>
                                                                    </svg>
                                                                </span>
                                                                <span>Identify the fundaments of composing a successful
                                                                    close.</span>
                                                            </li>
                                                            <li class="d-flex mb-2">
                                                                <span class="me-2">
                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
                                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"></path>
                                                                    </svg>
                                                                </span>
                                                                <span>Explore how to connect with your audience through crafting
                                                                    compelling stories.</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <ul class="list-unstyled">
                                                            <li class="d-flex mb-2">
                                                                <span class="me-2">
                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
                                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"></path>
                                                                    </svg>
                                                                </span>
                                                                <span>Examine ways to connect with your audience by
                                                                    personalizing your content.</span>
                                                            </li>
                                                            <li class="d-flex mb-2">
                                                                <span class="me-2">
                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
                                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"></path>
                                                                    </svg>
                                                                </span>
                                                                <span>Break down the best ways to exude executive
                                                                    presence.</span>
                                                            </li>
                                                            <li class="d-flex mb-2">
                                                                <span class="me-2">
                                                                   <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
                                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"></path>
                                                                    </svg>
                                                                </span>
                                                                <span>Explore how to communicate the unknown in an impromptu
                                                                    communication.</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <p>Maecenas viverra condimentum nulla molestie condimentum. Nunc ex libero,
                                                    feugiat quis lectus vel, ornare euismod ligula. Aenean sit amet arcu nulla.
                                                </p>
                                                <p>
                                                    Duis facilisis ex a urna blandit ultricies. Nullam sagittis ligula non eros
                                                    semper, nec mattis odio ullamcorper. Phasellus feugiat sit amet leo eget
                                                    consectetur.
                                                </p>
                                            </div>

                                            <!-- Tab pane -->
                                            <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                                                <!-- FAQ -->
                                                <div>
                                                    <h3 class="mb-3">Course - Frequently Asked Questions</h3>
                                                    <div class="mb-4">
                                                        <h4>How this course help me to design layout?</h4>
                                                        <p>
                                                            My name is Jason Woo and I work as human duct tape at Gatsby, that
                                                            means that I do a lot of different things. Everything from dev roll
                                                            to
                                                            writing content to writing code. And I used to work as an architect
                                                            at IBM. I live in Portland, Oregon.
                                                        </p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <h4>What is important of this course?</h4>
                                                        <p>
                                                            We'll dive into GraphQL, the fundamentals of GraphQL. We're only
                                                            gonna use the pieces of it that we need to build in Gatsby. We're
                                                            not gonna be
                                                            doing a deep dive into what GraphQL is or the language specifics.
                                                            We're also gonna get into MDX. MDX is a way to write Human Resource Management
                                                            components in your
                                                            markdown.
                                                        </p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <h4>Why Take This Course?</h4>
                                                        <p>
                                                            We'll dive into GraphQL, the fundamentals of GraphQL. We're only
                                                            gonna use the pieces of it that we need to build in Gatsby. We're
                                                            not gonna be
                                                            doing a deep dive into what GraphQL is or the language specifics.
                                                            We're also gonna get into MDX. MDX is a way to write Human Resource Management
                                                            components in your
                                                            markdown.
                                                        </p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <h4>Is able to create application after this course?</h4>
                                                        <p>
                                                            We'll dive into GraphQL, the fundamentals of GraphQL. We're only
                                                            gonna use the pieces of it that we need to build in Gatsby. We're
                                                            not gonna be
                                                            doing a deep dive into what GraphQL is or the language specifics.
                                                            We're also gonna get into MDX. MDX is a way to write Human Resource Management
                                                            components in your
                                                            markdown.
                                                        </p>
                                                        <p>
                                                            We'll dive into GraphQL, the fundamentals of GraphQL. We're only
                                                            gonna use the pieces of it that we need to build in Gatsby. We're
                                                            not gonna be
                                                            doing a deep dive into what GraphQL is or the language specifics.
                                                            We're also gonna get into MDX. MDX is a way to write Human Resource Management
                                                            components in your
                                                            markdown.
                                                        </p>
                                                    </div>
                                                </div>
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