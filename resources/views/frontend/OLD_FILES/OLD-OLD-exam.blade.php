@extends('frontend.master')
@section('content')


        <!-- Wrapper -->
        <div id="db-wrapper" class="course-video-player-page">
            <!-- Sidebar -->
        
            @include('frontend.exam.exam-left-menu')

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
                                <h3 class="mb-0 text-truncate-line-2 color-blue">Award in Recruitment and Employee Selection (Assignment)</h3>
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
                                
                                <!-- Assessment 1 Tab pane -->
                                <div class="tab-pane fade show active" id="course-assessment" role="tabpanel" aria-labelledby="course-assessment-tab">
                                    <!-- Video -->
                                    <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0" style="height: 600px">
                                        <iframe class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100" width="560" height="315" src="{{ ('assignment')}}" title="E-Ascencia - Academy and LMS Template" frameborder="0">
                                        
                                        </iframe>
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