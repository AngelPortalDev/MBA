@extends('frontend.master')
@section('content')

<main>
    <!-- Page header -->
    <section class="pt-lg-8 pt-5 pb-8 bg-primary">
        <div class="container pb-lg-6">
            <div class="row align-items-center">
                <div class="col-xl-8 col-lg-8 col-md-12">
                    <div>
                        <h1 class="text-white display-5 fw-bold color-green ">Masters of Arts in Human Resource Management</h1>
                        <p class="text-white mb-6 fs-5">
                            The Masters of Arts in Human Resource Management will equip students with advanced knowledge and skills in the field of human resource management, including recruitment, selection, training and development, compensation and benefits and employee relations.
                        </p>
                        <div class="d-flex align-items-center">
                            <span class="text-white">
                                <img src="{{ asset('frontend/images/icon/mqf-icon.svg')}}" alt="" width="15px">
                                MQF/EQF Level: 7
                            </span>

                            <span class="text-white ms-3">
                                <i class="bi bi-star-fill color-green  rating-star"></i>
                                ECTS: 90 Credits
                            </span>


                            <span class="text-white ms-3">
                                <i class="fe fe-user color-green"></i>
                                1200 Enrolled
                            </span>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page content -->
    <section class="pb-8">
        <div class="container">
            <div class="row">

                <div class="col-lg-9 col-md-12 col-12 mt-md-n8 mt-n5 mb-4 mb-lg-0">
                    <!-- Card -->
                    <div class="card rounded-3">
                        <!-- Card header -->
                        <div class="card-header border-bottom-0 p-0">
                            <div>
                                <!-- Nav -->
                                <ul class="nav nav-lb-tab" id="tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="progress-tab" data-bs-toggle="pill"
                                            href="#progress" role="tab" aria-controls="progress"
                                            aria-selected="true">Progress</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="overview-tab" data-bs-toggle="pill"
                                            href="#overview" role="tab" aria-controls="overview"
                                            aria-selected="false">
                                            Overview
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="entry-requirements-tab" data-bs-toggle="pill"
                                            href="#entry-requirements" role="tab" aria-controls="entry-requirements"
                                            aria-selected="false">
                                            Entry Requirements
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="course-content-tab" data-bs-toggle="pill"
                                            href="#course-content" role="tab" aria-controls="course-content"
                                            aria-selected="false">
                                            Course Content                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="assessment-tab" data-bs-toggle="pill" href="#assessment"
                                            role="tab" aria-controls="assessment" aria-selected="false">Assessment</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="tab-content" id="tabContent">
                                
                                <div class="tab-pane fade show active" id="progress" role="tabpanel"
                                    aria-labelledby="progress-tab">
                                    <!-- Card -->
                                    <div class="accordion" id="courseAccordion">
                                        <div>
                                            <!-- List group -->
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item px-0 pt-0">
                                                    <!-- Toggle -->
                                                    <a class="h4 mb-0 d-flex align-items-center active"
                                                        data-bs-toggle="collapse" href="#courseTwo"
                                                        aria-expanded="true" aria-controls="courseTwo">
                                                        <div class="me-auto">Recruitment and Employee Selection
                                                            <span class="mb-0 fs-6 mt-1 fw-normal">(6 ECTS) (150 Hours) </span>
                                                                    
                                                        </div>
                                                        
                                                        <!-- Chevron -->
                                                        <span class="chevron-arrow ms-4">
                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                        </span>
                                                    </a>
                                                    <!-- Row -->
                                                    <!-- Collapse -->
                                                    <div class="collapse show" id="courseTwo"
                                                        data-bs-parent="#courseAccordion">
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
                                                                        
                                                                        <i class="bi bi-play-fill color-green"></i>
                                                                    </span>
                                                                    <span class="preview-course-heading">Installing Development Software</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 11s</span>
                                                                </div>
                                                            </a>
                                                            <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                <div class="text-truncate">
                                                                    <span class="icon-shape bg-light icon-sm bg-blue rounded-circle me-2">
                                                                        <i class="bi bi-play-fill color-green"></i>
                                                                    </span>
                                                                    <span class="preview-course-heading">Hello World Project from GitHub</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 33s</span>
                                                                </div>
                                                            </a>
                                                            <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                <div class="text-truncate">
                                                                    <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                        <i class="fe fe-lock"></i>
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
                                                                        <i class="fe fe-lock"></i>
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
                                                    <a class="h4 mb-0 d-flex align-items-center"
                                                        data-bs-toggle="collapse" href="#courseThree"
                                                        aria-expanded="false" aria-controls="courseThree">
                                                        <div class="me-auto">
                                                            <!-- Title -->
                                                            Training and Development
                                                            <span class="mb-0 fs-6 mt-1 fw-normal">(10 ECTS) (250 Hours) </span>
                                                        </div>
                                                        <!-- Chevron -->
                                                        <span class="chevron-arrow ms-4">
                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                        </span>
                                                    </a>
                                                    <!-- Row -->
                                                    <!-- Collapse -->
                                                    <div class="collapse" id="courseThree"
                                                        data-bs-parent="#courseAccordion">
                                                        <div class="pt-3 pb-2">
                                                            <div class="mb-2">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <small>0% Completed</small>
                                                            </div>

                                                            <a href="course-resume.html"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                <div class="text-truncate">
                                                                    <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                        <i class="fe fe-lock"></i>
                                                                    </span>
                                                                    <span>Introduction</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 41s</span>
                                                                </div>
                                                            </a>
                                                            <a href="course-resume.html"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                <div class="text-truncate">
                                                                    <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                        <i class="fe fe-lock"></i>
                                                                    </span>
                                                                    <span>Adding Human Resource Management Code to a Web
                                                                        Page</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 39s</span>
                                                                </div>
                                                            </a>
                                                            <a href="course-resume.html"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                <div class="text-truncate">
                                                                    <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                        <i class="fe fe-lock"></i>
                                                                    </span>
                                                                    <span>Working with Human Resource Management Files</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>6m 18s</span>
                                                                </div>
                                                            </a>
                                                            <a href="course-resume.html"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                <div class="text-truncate">
                                                                    <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                        <i class="fe fe-lock"></i>
                                                                    </span>
                                                                    <span>Formatting Code</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 18s</span>
                                                                </div>
                                                            </a>
                                                            <a href="course-resume.html"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                <div class="text-truncate">
                                                                    <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                        <i class="fe fe-lock"></i>
                                                                    </span>
                                                                    <span>Detecting and Fixing Errors</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 14s</span>
                                                                </div>
                                                            </a>
                                                            <a href="course-resume.html"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                <div class="text-truncate">
                                                                    <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                        <i class="fe fe-lock"></i>
                                                                    </span>
                                                                    <span>Case Sensitivity</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 48s</span>
                                                                </div>
                                                            </a>
                                                            <a href="course-resume.html"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                <div class="text-truncate">
                                                                    <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                        <i class="fe fe-lock"></i>
                                                                    </span>
                                                                    <span>Commenting Code</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 24s</span>
                                                                </div>
                                                            </a>
                                                            <a href="course-resume.html"
                                                                class="mb-0 d-flex justify-content-between align-items-center text-inherit">
                                                                <div class="text-truncate">
                                                                    <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                        <i class="fe fe-lock"></i>
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
                                                    <a class="h4 mb-0 d-flex align-items-center"
                                                        data-bs-toggle="collapse" href="#courseFour"
                                                        aria-expanded="false" aria-controls="courseFour">
                                                        <div class="me-auto">
                                                            <!-- Title -->
                                                            Employee and Labour Relations
                                                            <span class="mb-0 fs-6 mt-1 fw-normal">(4 ECTS) (100 Hours) </span>
                                                        </div>
                                                        <!-- Chevron -->
                                                        <span class="chevron-arrow ms-4">
                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                        </span>
                                                    </a>
                                                    <!-- Row -->
                                                    <!-- Collapse -->
                                                    <div class="collapse" id="courseFour"
                                                        data-bs-parent="#courseAccordion">
                                                        <div class="pt-3 pb-2">
                                                            <div class="mb-2">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <small>0% Completed</small>
                                                            </div>

                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Introduction</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 19s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>What Is a Variable?</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 11s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Declaring Variables</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 30s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Using let to Declare Variables</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 28s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Naming Variables</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 14s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Common Errors Using Variables</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 30s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Changing Variable Values</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 4s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Constants</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 15s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>The var Keyword</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 20s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-0 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
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
                                                    <a class="h4 mb-0 d-flex align-items-center"
                                                        data-bs-toggle="collapse" href="#courseFive"
                                                        aria-expanded="false" aria-controls="courseFive">
                                                        <div class="me-auto">
                                                            <!-- Title -->
                                                            Global Business Strategy
                                                            <span class="mb-0 fs-6 mt-1 fw-normal">(10 ECTS) (250 Hours) </span>
                                                        </div>
                                                        <!-- Chevron -->
                                                        <span class="chevron-arrow ms-4">
                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                        </span>
                                                    </a>
                                                    <!-- Row -->
                                                    <!-- Collapse -->
                                                    <div class="collapse" id="courseFive"
                                                        data-bs-parent="#courseAccordion">
                                                        <div class="pt-3 pb-2">
                                                            <div class="mb-2">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <small>0% Completed</small>
                                                            </div>

                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Introduction</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 55s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Numbers</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>6m 14s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Operator Precedence</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 58s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Number Precision</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 22s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Negative Numbers</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 35s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Strings</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>4m 7s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Manipulating Strings</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>5m 8s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Converting Strings and Numbers</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 55s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-0 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
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
                                                    <a class="h4 mb-0 d-flex align-items-center"
                                                        data-bs-toggle="collapse" href="#courseSix"
                                                        aria-expanded="false" aria-controls="courseSix">
                                                        <div class="me-auto">
                                                            <!-- Title -->
                                                            Performance Management and Compensation
                                                            <span class="mb-0 fs-6 mt-1 fw-normal">(12 ECTS) (300 Hours) </span>
                                                        </div>
                                                        <!-- Chevron -->
                                                        <span class="chevron-arrow ms-4">
                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                        </span>
                                                    </a>
                                                    <!-- Row -->
                                                    <!-- Collapse -->
                                                    <div class="collapse" id="courseSix"
                                                        data-bs-parent="#courseAccordion">
                                                        <div class="pt-3 pb-2">
                                                            <div class="mb-2">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <small>0% Completed</small>
                                                            </div>

                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Introduction</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 52s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Clip Watched</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>4m 27s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Conditionals Using if()</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>4m 25s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Truthy and Falsy</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 30s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>if ... else</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 30s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Comparing === and ==</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 52s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
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
                                                    <a class="h4 mb-0 d-flex align-items-center"
                                                        data-bs-toggle="collapse" href="#courseSeven"
                                                        aria-expanded="false" aria-controls="courseSeven">
                                                        <div class="me-auto">
                                                            <!-- Title -->
                                                            Public Speaking and Presentation Skills
                                                            <span class="mb-0 fs-6 mt-1 fw-normal">(6 ECTS) (150 Hours) </span>
                                                        </div>
                                                        <!-- Chevron -->
                                                        <span class="chevron-arrow ms-4">
                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                        </span>
                                                    </a>
                                                    <!-- Row -->
                                                    <!-- Collapse -->
                                                    <div class="collapse" id="courseSeven"
                                                        data-bs-parent="#courseAccordion">
                                                        <div class="pt-3 pb-2">
                                                            <div class="mb-2">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <small>0% Completed</small>
                                                            </div>

                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Introduction</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 52s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Function Basics</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 46s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Function Expressions</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 32s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Passing Information to Functions</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 19s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Function Return Values</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 13s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Function Scope</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>4m 20s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Using Functions to Modify Web Pages</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 42s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-0 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
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
                                                    <a class="h4 mb-0 d-flex align-items-center"
                                                        data-bs-toggle="collapse" href="#courseEight"
                                                        aria-expanded="false" aria-controls="courseEight">
                                                        <div class="me-auto">
                                                            <!-- Title -->
                                                            International Organisational Management and Development
                                                            <span class="mb-0 fs-6 mt-1 fw-normal">(10 ECTS) (250 Hours) </span>
                                                        </div>
                                                        <!-- Chevron -->
                                                        <span class="chevron-arrow ms-4">
                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                        </span>
                                                    </a>
                                                    <!-- Row -->
                                                    <!-- Collapse -->
                                                    <div class="collapse" id="courseEight"
                                                        data-bs-parent="#courseAccordion">
                                                        <div class="pt-3 pb-2">
                                                            <div class="mb-2">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <small>0% Completed</small>
                                                            </div>

                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Introduction</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 48s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Object Properties</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>4m 28s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Object Methods</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 3s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Passing Objects to Functions</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 27s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Standard Built-in Objects</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>6m 55s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>The Document Object Model (DOM)</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 29s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Styling DOM Elements</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 42s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Detecting Button Clicks</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 3s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Showing and Hiding DOM Elements</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>4m 37s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
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
                                                    <a class="h4 mb-0 d-flex align-items-center"
                                                        data-bs-toggle="collapse" href="#courseNine"
                                                        aria-expanded="false" aria-controls="courseNine">
                                                        <div class="me-auto">
                                                            <!-- Title -->
                                                            Professional Development
                                                            <span class="mb-0 fs-6 mt-1 fw-normal">(12 ECTS) (300 Hours) </span>
                                                        </div>
                                                        <!-- Chevron -->
                                                        <span class="chevron-arrow ms-4">
                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                        </span>
                                                    </a>
                                                    <!-- Row -->
                                                    <!-- Collapse -->
                                                    <div class="collapse" id="courseNine"
                                                        data-bs-parent="#courseAccordion">
                                                        <div class="pt-3 pb-2">
                                                            <div class="mb-2">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <small>0% Completed</small>
                                                            </div>

                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Introduction</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 48s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Creating and Initializing Arrays</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>4m 7s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Accessing Array Items</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 4s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Manipulating Arrays</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>4m 3s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>slice() and splice()</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>5m 54s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Array Searching and Looping</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>7m 32s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Arrays in the DOM</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>4m 11s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
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
                                                    <a class="h4 mb-0 d-flex align-items-center"
                                                        data-bs-toggle="collapse" href="#courseTen"
                                                        aria-expanded="false" aria-controls="courseTen">
                                                        <div class="me-auto">
                                                            <!-- Title -->
                                                            Research in Projects and Organisations
                                                            <span class="mb-0 fs-6 mt-1 fw-normal">(20 ECTS) (500 Hours) </span>
                                                        </div>
                                                        <!-- Chevron -->
                                                        <span class="chevron-arrow ms-4">
                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                        </span>
                                                    </a>
                                                    <!-- Row -->
                                                    <!-- Collapse -->
                                                    <div class="collapse" id="courseTen"
                                                        data-bs-parent="#courseAccordion">
                                                        <div class="pt-3 pb-2">
                                                            <div class="mb-2">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated progress-bar-striped progress-bar-animated" role="progressbar" style="width: 40%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <small>0% Completed</small>
                                                            </div>

                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Introduction</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 20s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Global Scope</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>4m 7s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Clip Watched</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 14s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Function Scope</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 45s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Var and Hoisting</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 21s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Undeclared Variables and Strict
                                                                        Mode</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 16s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Summary</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 33s</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                                

                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="overview" role="tabpanel"
                                    aria-labelledby="overview-tab">
                                    <div class="mb-4">
                                        <p>
                                            This program has a strategic and international focus in order to equip students to manage the increasing complexity and challenges in the modern human resource function within organisations. Students will gain an increased understanding of current trends and best practices in human resource management which can be used to improve organisational performance and employee engagement. In addition, completing this program will provide students with the ability to advance in a career in human resources management, specifically in management and leadership related roles.
                                        </p>
                                    </div>
                                    <h4 class="mb-3">Programme Outcomes</h4>
                                    <div class="row mb-3">
                                        <div class="col-12 col-md-6">
                                            <ul class="list-unstyled">
                                                <li class="d-flex mb-2">
                                                    <span class="me-2">
                                                        <i class="bi bi-check-circle text-success"></i>
                                                    </span>
                                                    <span> Master comprehensive specialised knowledge and understanding of methods and tools for employee selection and recruitment including the role of data and analytics in recruitment and selection, including how to measure the effectiveness of recruitment and selection methods, and how to use data to improve recruitment and selection decisions</span>
                                                </li>
                                                <li class="d-flex mb-2">
                                                    <span class="me-2">
                                                        <i class="bi bi-check-circle text-success"></i>
                                                    </span>
                                                    <span>Master specialised knowledge and understanding of the importance of workplace learning and development</span>
                                                </li>
                                                <li class="d-flex mb-2">
                                                    <span class="me-2">
                                                        <i class="bi bi-check-circle text-success"></i>
                                                    </span>
                                                    <span>Master specialised knowledge of employment legislation in Europe and the latest trends, best practices and innovations in employee and labour relations</span>
                                                </li>

                                                <li class="d-flex mb-2">
                                                    <span class="me-2">
                                                        <i class="bi bi-check-circle text-success"></i>
                                                    </span>
                                                    <span>Master multidisciplinary knowledge of effective global business strategy, including market entry, globalisation and growth</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <ul class="list-unstyled">

                                                <li class="d-flex mb-2">
                                                    <span class="me-2">
                                                        <i class="bi bi-check-circle text-success"></i>
                                                    </span>
                                                    <span>Master theoretical and practical knowledge of global business strategy including the development, implementation and execution of business strategies for global operations</span>
                                                </li>
                                                <li class="d-flex mb-2">
                                                    <span class="me-2">
                                                        <i class="bi bi-check-circle text-success"></i>
                                                    </span>
                                                    <span>Master multi-disciplinary theoretical and practical knowledge of compliance with ethics and professional standards (including critically appraising industry trends and monitoring best practices) within their profession and industry / aspiring profession and industry</span>
                                                </li>
                                                <li class="d-flex mb-2">
                                                    <span class="me-2">
                                                        <i class="bi bi-check-circle text-success"></i>
                                                    </span>
                                                    <span>Master theoretical and practical knowledge of business research, the research process and the role of theory and empirical evidence in the creation of knowledge, the design and conduct of research projects in real-world settings</span>
                                                </li>
                                                <li class="d-flex mb-2">
                                                    <span class="me-2">
                                                        <i class="bi bi-check-circle text-success"></i>
                                                    </span>
                                                    <span>Master theoretical and practical knowledge of communication skills to articulate ideas, persuade and engage an audience and respond to questions and feedback</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                

                                <div class="tab-pane fade" id="entry-requirements" role="tabpanel"
                                    aria-labelledby="entry-requirements-tab">
                                    <div class="mb-4">
                                        <div class="course__overview">
                                            
                                            <ul >
                                                <li class="mb-2">MQF/EQF Level 6 qualification. However, students’ circumstances and experiences may also be considered during the application process—five years of relevant working experience in the industry of specialization. </li>
                                                <li class="mb-2">Proof of B2 level of English should be provided by the students upon application – IELTS level/grade 6 or the student’s country equivalent. </li>
                                                <li class="mb-2">A Bachelor’s degree or graduate degree in humanities, sciences, human resources, organisational behaviour, business, administration, management, communication, journalism, psychology, arts or a related field.</li>
                                                <li class="mb-2">Minimum 180 ECTS at MQF/EQF Level 6 previously acquired at a Higher Education institution.</li>
                                                <li class="mb-2">Outstanding written and oral communication skills.</li>
                                                <li class="mb-2">A minimum of one year of work experience in a business environment will be considered as an asset.</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                


                                <div class="tab-pane fade" id="course-content" role="tabpanel"
                                    aria-labelledby="course-content-tab">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-12 col-12">
                                                <div class="mb-3">
                                                    <h4>
                                                        Course Syllabus Podcast
                                                    </h4>
                                                    <p class="mb-0">
                                                        Gain a Comprehensive Understanding of the Course Syllabus with Our Informative Podcast
                                                    </p>
                                                </div>
                                                <!-- Card -->
                                                <div class="card mb-3 mb-4">

                                                    <div class="p-1">
                                                        <div class="d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover" 
                                                        style="background-image:url({{asset('frontend/images/course/masters-human-resource-management.png') }});height:210px;">
                                                            <a class="glightbox icon-shape rounded-circle btn-play icon-xl" href="https://www.youtube.com/watch?v=Nfzi7034Kbg">
                                                                <i class="fe fe-play"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>


                                        <div class="mb-4">
                                            <h4>
                                                1. Recruitment and Employee Selection – 6 ECTS
                                                <span class="text-primary ms-2 h4">[150 Hours]</span>
                                            </h4>
                                            <p class="mb-0">
                                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Expedita, quasi nostrum! Et nam corporis libero, porro tempora debitis laborum. Sequi qui rem, magnam, incidunt dignissimos sint, consectetur eligendi!
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <h4>
                                                2. Training and Development – 10 ECTS
                                                <span class="text-primary ms-2 h4">[150 Hours]</span>
                                            </h4>
                                            <p>
                                                We'll dive into GraphQL, the fundamentals of GraphQL. We're only
                                                gonna use the pieces of it that we need to build in Gatsby. We're
                                                not gonna be
                                                doing a deep dive into what GraphQL is or the language specifics.
                                                We're also gonna get into MDX. MDX is a way to write React
                                                components in your
                                                markdown.
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <h4>
                                                3. Employee and Labour Relations – 4 ECTS
                                                <span class="text-primary ms-2 h4">[100 Hours]</span>
                                            </h4>
                                            <p>
                                                We'll dive into GraphQL, the fundamentals of GraphQL. We're only
                                                gonna use the pieces of it that we need to build in Gatsby. We're
                                                not gonna be
                                                doing a deep dive into what GraphQL is or the language specifics.
                                                We're also gonna get into MDX. MDX is a way to write React
                                                components in your
                                                markdown.
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <h4>
                                                4. Global Business Strategy – 10 ECTS
                                                <span class="text-primary ms-2 h4">[250 Hours]</span>
                                            </h4>
                                            <p>
                                                We'll dive into GraphQL, the fundamentals of GraphQL. We're only
                                                gonna use the pieces of it that we need to build in Gatsby. We're
                                                not gonna be
                                                doing a deep dive into what GraphQL is or the language specifics.
                                                We're also gonna get into MDX. MDX is a way to write React
                                                components in your
                                                markdown.
                                            </p>
                                            <p>
                                                We'll dive into GraphQL, the fundamentals of GraphQL. We're only
                                                gonna use the pieces of it that we need to build in Gatsby. We're
                                                not gonna be
                                                doing a deep dive into what GraphQL is or the language specifics.
                                                We're also gonna get into MDX. MDX is a way to write React
                                                components in your
                                                markdown.
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <h4>
                                                5. Performance Management and Compensation – 12 ECTS
                                                <span class="text-primary ms-2 h4">[300 Hours]</span>
                                            </h4>
                                            <p>
                                                We'll dive into GraphQL, the fundamentals of GraphQL. We're only
                                                gonna use the pieces of it that we need to build in Gatsby. We're
                                                not gonna be
                                                doing a deep dive into what GraphQL is or the language specifics.
                                                We're also gonna get into MDX. MDX is a way to write React
                                                components in your
                                                markdown.
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <h4>
                                                6.Public Speaking and Presentation Skills – 6 ECTS
                                                <span class="text-primary ms-2 h4">[150 Hours]</span>
                                            </h4>
                                            <p>
                                                We'll dive into GraphQL, the fundamentals of GraphQL. We're only
                                                gonna use the pieces of it that we need to build in Gatsby. We're
                                                not gonna be
                                                doing a deep dive into what GraphQL is or the language specifics.
                                                We're also gonna get into MDX. MDX is a way to write React
                                                components in your
                                                markdown.
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <h4>
                                                7. International Organisational Management and Development – 10 ECTS
                                                <span class="text-primary ms-2 h4">[250 Hours]</span>
                                            </h4>
                                            <p>
                                                We'll dive into GraphQL, the fundamentals of GraphQL. We're only
                                                gonna use the pieces of it that we need to build in Gatsby. We're
                                                not gonna be
                                                doing a deep dive into what GraphQL is or the language specifics.
                                                We're also gonna get into MDX. MDX is a way to write React
                                                components in your
                                                markdown.
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <h4>
                                                8. Professional Development – 12 ECTS
                                                <span class="text-primary ms-2 h4">[300 Hours]</span>
                                            </h4>
                                            <p>
                                                We'll dive into GraphQL, the fundamentals of GraphQL. We're only
                                                gonna use the pieces of it that we need to build in Gatsby. We're
                                                not gonna be
                                                doing a deep dive into what GraphQL is or the language specifics.
                                                We're also gonna get into MDX. MDX is a way to write React
                                                components in your
                                                markdown.
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <h4>
                                                9. Research in Projects and Organisations – 20 ECTS
                                                <span class="text-primary ms-2 h4">[500 Hours]</span>
                                            </h4>
                                            <p>
                                                We'll dive into GraphQL, the fundamentals of GraphQL. We're only
                                                gonna use the pieces of it that we need to build in Gatsby. We're
                                                not gonna be
                                                doing a deep dive into what GraphQL is or the language specifics.
                                                We're also gonna get into MDX. MDX is a way to write React
                                                components in your
                                                markdown.
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                
                                <div class="tab-pane fade" id="assessment" role="tabpanel"
                                    aria-labelledby="assessment-tab">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-12 col-12">
                                                <div class="mb-3">

                                                    <p class="mb-0">
                                                        When it comes to assessment methods, we have included quite a variety that will allow learners with different learning styles and abilities to complete the programme successfully. Students will also have to prepare individual reports and presentations, apart from written and multiple-choice examinations. In addition, they will have submit assignments, e-portfolios and a final thesis. 
                                                    </p>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>

                        <div>
                            <!-- Related Course  -->
                            <div class="row mt-8">
                                <!-- col -->
                                <div class="col-12">
                                    <div class="mb-4">
                                        <h2 class="mb-1 h1 fw-bold">Related Courses</h2>
                                        <p>
                                            Explore our most popular programs, get job-ready for an in-demand career.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">

                                    <!-- Card -->
                                    <div class="card card-hover">
                                        <a href="course-details">
                                            <img src="{{ asset('frontend/images/course/award-recruitment-and-employee-selection.png')}}" alt="course" class="card-img-top"></a>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Award</span>
                                                <span class="badge bg-success-soft co-etcs">6 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="course-details" class="text-inherit">Award
                                                    in Recruitment and Employee Selection</a></h4>

                                                    <div class="lh-1 mt-3">

                                                        <span class="fs-6">
                                                            <i class="fe fe-user color-blue"></i>
                                                            1200 Enrolled
                                                        </span>
                            
                                                        </div>
                                        </div>
                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <div class="col course-price-flex">
                                                    <h5 class="mb-0 course-price">€15000</h5>
                                                    <h5 class="old-price">€23000 </h5>
                                                </div>

                                                <div class="col-auto">
                                                    <a href="#" class="text-inherit">
                                                        <i class="fe fe-shopping-cart text-primary align-middle me-2"></i>
                                                        </a><a href="#" class="buy-now">Buy Now</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="card card-hover">
                                        <a href="course-details">
                                            <img  src="{{ asset('frontend/images/course/certificate-human-resource-management.png')}}" alt="course" class="card-img-top"></a>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Certificate</span>
                                                <span class="badge bg-success-soft co-etcs">30 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="course-details" class="text-inherit">Post Graduate Certificate in Human Resource Management</a></h4>

                                            <div class="lh-1 mt-3">

                                                <span class="fs-6">
                                                    <i class="fe fe-user color-blue"></i>
                                                    1200 Enrolled
                                                </span>
                    
                                                </div>
                                        </div>
                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <div class="col course-price-flex">
                                                    <h5 class="mb-0 course-price">€1500</h5>
                                                    <h5 class="old-price">€2300 </h5>
                                                </div>

                                                <div class="col-auto">
                                                    <a href="#" class="text-inherit">
                                                        <i class="fe fe-shopping-cart text-primary align-middle me-2"></i>
                                                        </a><a href="#" class="buy-now">Buy Now</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-md-4">
                                    <div class="card card-hover">
                                        <a href="course-details">
                                            <img  src="{{ asset('frontend/images/course/diploma-human-resource-management.png')}}" alt="course" class="card-img-top"></a>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Diploma</span>
                                                <span class="badge bg-success-soft co-etcs">60 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="course-details" class="text-inherit">Post Graduate Diploma in Human Resource Management</a></h4>

                                            <div class="lh-1 mt-3">

                                                <span class="fs-6">
                                                    <i class="fe fe-user color-blue"></i>
                                                    1200 Enrolled
                                                </span>
                    
                                                </div>
                                        </div>
                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <div class="col course-price-flex">
                                                    <h5 class="mb-0 course-price">€1500</h5>
                                                    <h5 class="old-price">€2300 </h5>
                                                </div>

                                                <div class="col-auto">
                                                    <a href="#" class="text-inherit">
                                                        <i class="fe fe-shopping-cart text-primary align-middle me-2"></i>
                                                        </a><a href="#" class="buy-now">Buy Now</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            


                            </div>

                            <div class="mt-6">
                                <a href="browse-course" class="btn btn-outline-primary">Browse all</a>
                            </div>
                        </div>

                       
                </div>
                


                <div class="col-lg-3 col-md-12 col-12 course-preview-column">
                    <!-- Card -->
                    <div class="card mb-3 mb-4">
                        <div class="p-1">
                            <div class="d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover"
                            style="background-image:url({{asset('frontend/images/course/masters-human-resource-management.png') }});height:210px;">
                                


                                <a class="glightbox icon-shape rounded-circle btn-play icon-xl"
                                    href="https://iframe.mediadelivery.net/play/236384/a2f5e473-f440-4471-85d2-c56ebb9579c7">
                                    <i class="fe fe-play"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Card body -->
                        <div class="card-body p-3">
                            <!-- Price single page -->
                            <div class="mb-3 text-center">
                                <div class="text-dark fw-bold h2 color-blue">€15,000</div>
                                <del class="fs-4">€27,000</del>
                                <span class="course-off-discount">25% Scholarship</span>
                            </div>
                            <div class="d-grid"> 
                                <a href="#" class="btn btn-primary mb-2 color-green fs-4">Buy Course</a>
                                @php $CourseId = 75 @endphp
                                <a href="#" class="btn btn-outline-primary" id="addtocart" data-course-id="{{base64_encode($CourseId)}}" data-action="add"><i class="fe fe-shopping-cart text-primary"></i> Add to Cart</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="card mb-4">
                        <div>
                            <!-- Card header -->
                            <div class="card-header">
                                <h4 class="mb-0">What’s included</h4>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-transparent">
                                    <i class="fe fe-calendar align-middle me-2 text-info"></i>
                                    9 Modules
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <i class="fe fe-book align-middle me-2 text-success"></i>
                                    123 Lectures
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <i class="fe fe-play-circle align-middle me-2 text-primary"></i>
                                    2000+ Learning Hours
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <i class="fe fe-award me-2 align-middle text-danger"></i>
                                    Certificate  
                                    <!-- tooltip on top -->
                                    <i class="fe fe-info me-2 align-middle text-grey" data-bs-toggle="tooltip" data-placement="top" title="Certificate of Attendance OR MQF/EQF Certificate"></i>
                                </li>

                                <li class="list-group-item bg-transparent">
                                    <i class="fe fe-video align-middle me-2 text-secondary"></i>
                                    Access on mobile and TV
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="card">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="position-relative">
                                    <img src="{{ asset('frontend/images/team/italo-esposito-photo.jpg')}}" alt="avatar"
                                        class="rounded-circle avatar-xl">
                                        
                                    <a href="#" class="position-absolute mt-2 ms-n3" data-bs-toggle="tooltip"
                                        data-placement="top" title="Verifed">
                                        <img src="{{ asset('frontend/images/svg/checked-mark.svg')}}" alt="checked-mark" height="30" width="30">
                                    </a>
                                </div>
                                <div class="ms-4">
                                    <h4 class="mb-0">Italo Esposito </h4>
                                    <p class="mb-1 fs-6">Lecturer</p>

                                </div>
                            </div>
                            <div class="border-top row pt-2 mt-3 g-0">
                                <div class="col">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequatur natus accusantium impedit quae nobis ad totam, corporis pariatur recusandae in.
                                </div>

                            </div>
                        </div>

                        
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="position-relative">
                                    <img src="{{ asset('frontend/images/team/Alison-Abela-photo.jpg')}}" alt="avatar"
                                        class="rounded-circle avatar-xl">
                                        
                                    <a href="#" class="position-absolute mt-2 ms-n3" data-bs-toggle="tooltip"
                                        data-placement="top" title="Verifed">
                                        <img src="{{ asset('frontend/images/svg/checked-mark.svg')}}" alt="checked-mark" height="30" width="30">
                                    </a>
                                </div>
                                <div class="ms-4">
                                    <h4 class="mb-0">Alison Abela</h4>
                                    <p class="mb-1 fs-6">Lecturer</p>

                                </div>
                            </div>
                            <div class="border-top row pt-2 mt-3 g-0">
                                <div class="col">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequatur natus accusantium impedit quae nobis ad totam, corporis pariatur recusandae in.
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>



            
        </div>
    </section>
</main>





@endsection