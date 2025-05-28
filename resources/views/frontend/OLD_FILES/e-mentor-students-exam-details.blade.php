@extends('frontend.master')
@section('content')




<div style="background-image:url({{ asset('frontend/images/background/company-bg.jpg') }});  no-repeat; background-position: center; background-size: cover;height: 6rem !important;">

</div>
    <section class="bg-white">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row align-items-center">
                <!-- col -->
                <div class="col-12">
                    <div class="d-md-flex align-items-center">
                        <!-- img -->
                        <div class="position-relative mt-n4 ">
                            <img src="{{ asset('frontend/images/avatar/avatar-4.jpg')}}" alt="logo" class="rounded-3 border student-profile-e-mentor">
                        </div>

                        <div class="w-100 ms-md-3 mt-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <!-- heading -->
                                    <h2 class="mb-0 color-blue">Haresh Gurav</h2>

                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fe fe-mail fs-4"></i>
                                        <a href="#" class="ms-2">hareshgurav@gmail.com</a>
                                    </div>
                                </div>
                                <div>
                                    <!-- button -->
                                    <a href="demo-e-mentor-students-exam" class="btn btn-outline-primary">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-6 bg-white" >
        <div class="container">
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
                                        <a class="nav-link " id="profile-tab" data-bs-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Profile</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="verification-tab" data-bs-toggle="pill" href="#verification" role="tab" aria-controls="verification" aria-selected="false" tabindex="-1">
                                            Verification
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="courses-tab" data-bs-toggle="pill" href="#courses" role="tab" aria-controls="courses" aria-selected="false" tabindex="-1">
                                            Courses
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="exam-tab" data-bs-toggle="pill" href="#exam" role="tab" aria-controls="exam" aria-selected="false" tabindex="-1">Exam</a>
                                    </li>


                                </ul>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="tab-content" id="tabContent">
                                {{-- Student profile  --}}
                                <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <!-- Card -->
                                    <div class="mb-4 pb-4 border-bottom">
                                        <h4 class="color-blue">Basic Information</h4>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Student is:</span>
                                            Employed
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Mobile No. :</span>
                                            +21 323234546
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Date of Birth:</span>
                                            23th June 1998
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Gender:</span>
                                            Male
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Country:</span>
                                            India
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">City:</span>
                                            Mumbai
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Nationality:</span>
                                            Indian
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Postal Code:</span>
                                            434354
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Address:</span>
                                            Borivali East, Near Tata Power House, Mumbai
                                        </p>
                                    </div>
                                    <div class="mb-2 ">
                                        {{-- <h4 class="color-blue">Social Profile</h4> --}}
                                        <!--Facebook-->
                                        <a href="#" class=" me-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                              </svg>
                                        </a>
                                        <a href="#" class=" me-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                              </svg>
                                        </a>
                                        <!--LinkedIn-->
                                        <a href="#" class=" me-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                                <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                                              </svg>
                                        </a>                                        
                                        <!--Twitter-->
                                        <a href="#" class=" me-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                              </svg>
                                        </a>

                                        <!--GitHub-->

                                        
                                    </div>
                                </div>

                                <!-- Document Verification -->
                                <div class="tab-pane fade" id="verification" role="tabpanel" aria-labelledby="verification-tab">
                                    <!-- verification -->
                                        
                                        <div class="mb-4 pb-4 border-bottom">
                                            <h4 class="color-blue">Identity Proof</h4>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Status:</span>
                                                <span class="text-success fw-bold">Verified</span>
                                            </p>

                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Document Type:</span>
                                                Aadhar Card
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Name as per Document:</span>
                                                Haresh Gurav
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Document ID Number:</span>
                                                32322V32
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Document Expiry:</span>
                                                Not Applicable
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Document Issuing Authority:</span>
                                                Govt. of India
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Document Issuing Country:</span>
                                                India
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Download:</span>
                                                <a href="#"> Identity-Proof.pdf <i class="fe fe-download fs-5"></i></a>
                                            </p>

                                        </div>
                                        
                                        <div class="mb-4 pb-4 border-bottom">
                                            <h4 class="color-blue">Education Details</h4>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Status:</span>
                                                <span class="text-success fw-bold">Verified</span>
                                            </p>

                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Name of Institution or University:</span>
                                                Mumbai University
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Specialization:</span>
                                                Computer Science
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Name of Course of Degree:</span>
                                                Bachelor
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Document ID Number:</span>
                                               322D22
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Name as per Document:</span>
                                                Haresh Gurav
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Year of Passing:</span>
                                                2018
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Remark:</span>
                                                A Grade
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Download:</span>
                                                <a href="#"> Education-Details.pdf <i class="fe fe-download fs-5"></i></a>
                                            </p>

                                        </div>

                                        <div class="mb-4 pb-4 border-bottom">
                                            <h4 class="color-blue">Resume </h4>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Status:</span>
                                                <span class="text-success fw-bold">Uploaded</span>
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Download:</span>
                                                <a href="#"> My-Resume.pdf <i class="fe fe-download fs-5"></i></a>
                                            </p>
 

                                        </div>

                                        <div class="mb-2">
                                            <h4 class="color-blue">English Language Proficiency Test</h4>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Status:</span>
                                                <span>Completed</span>
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Result:</span>
                                                <span class="text-success fw-bold">Pass</span>
                                            </p>
    
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Total Marks Obtained:</span>
                                                [Marks Obtained] / 30
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Percentage:</span>
                                                [Percentage]%
                                            </p>
    
                                        </div>
                                </div>


                                
                                <!-- Courses  -->
                                <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                                    <!-- Description -->
                                        <div class="mb-4 border-bottom">
                                            <h4 class="color-blue">
                                                Purchased Courses
                                            </h4>
                                            <div class="d-flex align-items-center mb-3">
                                                <div>
                                                    <a href="course-details">
                                                        <img src="{{ asset('frontend/images/course/masters-human-resource-management.png')}}" alt="course" class="rounded img-4by3-lg">
                                                    </a>
                                                </div>
                                                <div class="ms-3">
                                                    <h4 class="mb-1 h5">
                                                        <a href="course-details" class="text-inherit color-blue">Masters of Arts in Human Resource Management</a>
                                                    </h4>
                                                    <div class="mt-2">
                                                        <div class="progress" style="height: 4px">
                                                            <div class="progress-bar bg-blue" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <small>10% Completed</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex align-items-center mb-3">
                                                <div>
                                                    <a href="course-details">
                                                        <img src="{{ asset('frontend/images/course/masters-human-resource-management.png')}}" alt="course" class="rounded img-4by3-lg">
                                                    </a>
                                                </div>
                                                <div class="ms-3">
                                                    <h4 class="mb-1 h5">
                                                        <a href="course-details" class="text-inherit color-blue">Masters of Arts in Human Resource Management</a>
                                                    </h4>
                                                    <div class="mt-2">
                                                        <div class="progress" style="height: 4px">
                                                            <div class="progress-bar bg-blue" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <small>10% Completed</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="mb-4 border-bottom">
                                            <h4 class="color-blue">
                                                Wishlist
                                            </h4>
                                            <div class="d-flex align-items-center mb-3">
                                                <div>
                                                    <a href="course-details">
                                                        <img src="{{ asset('frontend/images/course/masters-human-resource-management.png')}}" alt="course" class="rounded img-4by3-lg">
                                                    </a>
                                                </div>
                                                <div class="ms-3">
                                                    <h4 class="mb-1 h5">
                                                        <a href="course-details" class="text-inherit color-blue">Masters of Arts in Human Resource Management</a>
                                                    </h4>

                                                </div>
                                            </div>

                                            
                                        </div>


                                        <div class="mb-4 ">
                                            <h4 class="color-blue">
                                                Expired Courses
                                            </h4>
                                            <div class="d-flex  mb-3">
                                                <div>
                                                    <a href="course-details">
                                                        <img src="{{ asset('frontend/images/course/masters-human-resource-management.png')}}" alt="course" class="rounded img-4by3-lg">
                                                    </a>
                                                </div>
                                                <div class="ms-3">
                                                    <h4 class="mb-1 h5">
                                                        <a href="course-details" class="text-inherit color-blue">Masters of Arts in Human Resource Management</a>
                                                    </h4>

                                                </div>
                                            </div>
                                            
                                        </div>
                                </div>

                                <!-- Exams  -->
                                <div class="tab-pane fade active show" id="exam" role="tabpanel" aria-labelledby="exam-tab">

                                    <div class="card border mb-4">
                                        <!-- card body  -->
                                        <div class="card-body p-4">
                                            <div class="mb-4">
                                                <h3 class="fw-bold color-blue">Award in Recruitment and Employee Selection<span class="badge bg-success ms-2">Pass</span> </h3>
                                                <p>View student performance in each course module</p>
                                            </div>

                                            <div class="accordion accordion-flush" id="accordionExample">
                                                <div class="border p-3 rounded-3 mb-2" id="headingOne1">
                                                    <h3 class="mb-0 fs-4">
                                                        <a href="#" class="d-flex align-items-center text-inherit active collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne1" aria-expanded="false" aria-controls="collapseOne1">
                                                            <span class="me-auto">Recruitment and Employee Selection <span class="badge bg-success-soft ms-2">Pass</span></span>
                                                            <span class="collapse-toggle ms-4">
                                                                <i class="fe fe-chevron-down"></i>
                                                            </span>
                                                        </a>
                                                    </h3>
                
                                                    <div id="collapseOne1" class="collapse" aria-labelledby="headingOne1" data-bs-parent="#accordionExample" style="">
                                                        <div class="pt-2">
                                                            <ul class="ps-3">
                                                                <li class="mb-2"> <a href="assignment-answersheet" class="fw-semibold">Individual Assignment (60%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 40%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="mock-interview-answersheet" class="fw-semibold">Mock interview (40%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 20%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="e-portfolio-answersheet" class="fw-semibold">E-portfolio <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Remark:</span> <span> Good</span> </li>
                                                                    </ul>
                                                                
                                                                </li>

                                                              </ul>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- card footer  -->
                                        <div class="card-footer">
                                            <span class="fw-bold color-blue">Final Result:</span> <span class="text-success fw-bold"> Pass</span> | 
                                            <span class="fw-bold color-blue">Total Marks Obtained:</span> <span class="text-success fw-bold"> 60%</span> 
                                        </div>
                                    </div>

                                    
                                    <div class="card border mb-4">
                                        <!-- card body  -->
                                        <div class="card-body p-4">
                                            <div class="mb-4">
                                                <h3 class="fw-bold color-blue">Masters of Arts in Human Resource Management <span class="badge bg-danger ms-2">Fail</span> </h3>
                                                <p>View student performance in each course module</p>
                                            </div>

                                            <div class="accordion accordion-flush" id="accordionExample">
                                                <div class="border p-3 rounded-3 mb-2" id="headingOne">
                                                    <h3 class="mb-0 fs-4">
                                                        <a href="#" class="d-flex align-items-center text-inherit active collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                            <span class="me-auto"> 1. Recruitment and Employee Selection <span class="badge bg-success-soft ms-2">Pass</span></span>
                                                            <span class="collapse-toggle ms-4">
                                                                <i class="fe fe-chevron-down"></i>
                                                            </span>
                                                        </a>
                                                    </h3>
                
                                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                                        <div class="pt-2">
                                                            <ul class="ps-3">
                                                                <li class="mb-2"> <a href="assignment-answersheet" class="fw-semibold">Individual Assignment (60%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 40%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="mock-interview-answersheet" class="fw-semibold">Mock interview (40%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 20%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="e-portfolio-answersheet" class="fw-semibold">E-portfolio <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Remark:</span> <span> Good</span> </li>
                                                                    </ul>
                                                                
                                                                </li>

                                                              </ul>
                                                              <div class="border-top pt-3">
                                                                    <span class="fw-bold color-blue">Final Result:</span> <span class="text-success fw-bold"> Pass</span> | 
                                                                    <span class="fw-bold color-blue">Total Marks Obtained:</span> <span class="text-success fw-bold"> 60%</span> 
                                                                     
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Card  -->
                                                <!-- Card header  -->
                                                <div class="border p-3 rounded-3 mb-2" id="headingTwo">
                                                    <h3 class="mb-0 fs-4">
                                                        <a href="#" class="d-flex align-items-center text-inherit collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            <span class="me-auto">2. Training and Development<span class="badge bg-success-soft ms-2">Pass</span></span>
                                                            <span class="collapse-toggle ms-4">
                                                                <i class="fe fe-chevron-down"></i>
                                                            </span>
                                                        </a>
                                                    </h3>
                
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                                        <div class="pt-2">
                                                            <ul class="ps-3">
                                                                <li class="mb-2"> <a href="assignment-answersheet" class="fw-semibold">Individual Assignment (60%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 40%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="mock-interview-answersheet" class="fw-semibold">Mock interview (40%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 20%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="e-portfolio-answersheet" class="fw-semibold">E-portfolio <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Remark:</span> <span> Good</span> </li>
                                                                    </ul>
                                                                
                                                                </li>

                                                              </ul>
                                                              <div class="border-top pt-3">
                                                                    <span class="fw-bold color-blue">Final Result:</span> <span class="text-success fw-bold"> Pass</span> | 
                                                                    <span class="fw-bold color-blue">Total Marks Obtained:</span> <span class="text-success fw-bold"> 60%</span> 
                                                                     
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Card  -->
                                                <!-- Card header  -->
                                                <div class="border p-3 rounded-3 mb-2" id="headingThree">
                                                    <h3 class="mb-0 fs-4">
                                                        <a href="#" class="d-flex align-items-center text-inherit active collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            <span class="me-auto">3. Employee and Labour Relations<span class="badge bg-success-soft ms-2">Pass</span></span>
                                                            <span class="collapse-toggle ms-4">
                                                                <i class="fe fe-chevron-down"></i>
                                                            </span>
                                                        </a>
                                                    </h3>
                
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample" style="">
                                                        <div class="pt-2">
                                                            <ul class="ps-3">
                                                                <li class="mb-2"> <a href="assignment-answersheet" class="fw-semibold">Individual Assignment (60%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 40%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="mock-interview-answersheet" class="fw-semibold">Mock interview (40%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 20%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="e-portfolio-answersheet" class="fw-semibold">E-portfolio <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Remark:</span> <span> Good</span> </li>
                                                                    </ul>
                                                                
                                                                </li>

                                                              </ul>
                                                              <div class="border-top pt-3">
                                                                    <span class="fw-bold color-blue">Final Result:</span> <span class="text-success fw-bold"> Pass</span> | 
                                                                    <span class="fw-bold color-blue">Total Marks Obtained:</span> <span class="text-success fw-bold"> 60%</span> 
                                                                     
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Card  -->
                                                <!-- Card header  -->
                                                <div class="border p-3 rounded-3 mb-2" id="headingFour">
                                                    <h3 class="mb-0 fs-4">
                                                        <a href="#" class="d-flex align-items-center text-inherit active collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                            <span class="me-auto">4. Global Business Strategy<span class="badge bg-danger-soft ms-2">Fail</span></span>
                                                            <span class="collapse-toggle ms-4">
                                                                <i class="fe fe-chevron-down"></i>
                                                            </span>
                                                        </a>
                                                    </h3>
                
                                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample" style="">
                                                        <div class="pt-2">
                                                            <ul class="ps-3">
                                                                <li class="mb-2"> <a href="assignment-answersheet" class="fw-semibold">Individual Assignment (60%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 40%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="mock-interview-answersheet" class="fw-semibold">Mock interview (40%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 0%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="e-portfolio-answersheet" class="fw-semibold">E-portfolio <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Remark:</span> <span> Good</span> </li>
                                                                    </ul>
                                                                
                                                                </li>

                                                              </ul>
                                                              <div class="border-top pt-3">
                                                                    <span class="fw-bold color-blue">Final Result:</span> <span class="text-danger fw-bold"> Fail</span> | 
                                                                    <span class="fw-bold color-blue">Total Marks Obtained:</span> <span class="text-danger fw-bold"> 40%</span> 
                                                                     
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border p-3 rounded-3 mb-2" id="headingFive">
                                                    <h3 class="mb-0 fs-4">
                                                        <a href="#" class="d-flex align-items-center text-inherit active collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                            <span class="me-auto">5. Performance Management and Compensation<span class="badge bg-success-soft ms-2">Pass</span></span>
                                                            <span class="collapse-toggle ms-4">
                                                                <i class="fe fe-chevron-down"></i>
                                                            </span>
                                                        </a>
                                                    </h3>
                
                                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                                        <div class="pt-2">
                                                            <ul class="ps-3">
                                                                <li class="mb-2"> <a href="assignment-answersheet" class="fw-semibold">Individual Assignment (60%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 40%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="mock-interview-answersheet" class="fw-semibold">Mock interview (40%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 20%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="e-portfolio-answersheet" class="fw-semibold">E-portfolio <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Remark:</span> <span> Good</span> </li>
                                                                    </ul>
                                                                
                                                                </li>

                                                              </ul>
                                                              <div class="border-top pt-3">
                                                                    <span class="fw-bold color-blue">Final Result:</span> <span class="text-success fw-bold"> Pass</span> | 
                                                                    <span class="fw-bold color-blue">Total Marks Obtained:</span> <span class="text-success fw-bold"> 60%</span> 
                                                                     
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border p-3 rounded-3 mb-2" id="headingSix">
                                                    <h3 class="mb-0 fs-4">
                                                        <a href="#" class="d-flex align-items-center text-inherit active collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                            <span class="me-auto">6. Public Speaking and Presentation Skills<span class="badge bg-success-soft ms-2">Pass</span></span>
                                                            <span class="collapse-toggle ms-4">
                                                                <i class="fe fe-chevron-down"></i>
                                                            </span>
                                                        </a>
                                                    </h3>
                
                                                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                                        <div class="pt-2">
                                                            <ul class="ps-3">
                                                                <li class="mb-2"> <a href="assignment-answersheet" class="fw-semibold">Individual Assignment (60%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 40%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="mock-interview-answersheet" class="fw-semibold">Mock interview (40%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 20%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="e-portfolio-answersheet" class="fw-semibold">E-portfolio <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Remark:</span> <span> Good</span> </li>
                                                                    </ul>
                                                                
                                                                </li>

                                                              </ul>
                                                              <div class="border-top pt-3">
                                                                    <span class="fw-bold color-blue">Final Result:</span> <span class="text-success fw-bold"> Pass</span> | 
                                                                    <span class="fw-bold color-blue">Total Marks Obtained:</span> <span class="text-success fw-bold"> 60%</span> 
                                                                     
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border p-3 rounded-3 mb-2" id="headingSeven">
                                                    <h3 class="mb-0 fs-4">
                                                        <a href="#" class="d-flex align-items-center text-inherit active collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                            <span class="me-auto">7. International Organisational Management and Development<span class="badge bg-danger-soft ms-2">Fail</span></span>
                                                            <span class="collapse-toggle ms-4">
                                                                <i class="fe fe-chevron-down"></i>
                                                            </span>
                                                        </a>
                                                    </h3>
                
                                                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                                        <div class="pt-2">
                                                            <ul class="ps-3">
                                                                <li class="mb-2"> <a href="assignment-answersheet" class="fw-semibold">Individual Assignment (60%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 0%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="mock-interview-answersheet" class="fw-semibold">Mock interview (40%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 40%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="e-portfolio-answersheet" class="fw-semibold">E-portfolio <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Remark:</span> <span> Good</span> </li>
                                                                    </ul>
                                                                
                                                                </li>

                                                              </ul>
                                                              <div class="border-top pt-3">
                                                                <span class="fw-bold color-blue">Final Result:</span> <span class="text-danger fw-bold"> Fail</span> | 
                                                                <span class="fw-bold color-blue">Total Marks Obtained:</span> <span class="text-danger fw-bold"> 40%</span> 
                                                                     
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border p-3 rounded-3 mb-2" id="headingEight">
                                                    <h3 class="mb-0 fs-4">
                                                        <a href="#" class="d-flex align-items-center text-inherit active collapsed" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                            <span class="me-auto">8. Professional Development <span class="badge bg-danger-soft ms-2">Fail</span></span>
                                                            <span class="collapse-toggle ms-4">
                                                                <i class="fe fe-chevron-down"></i>
                                                            </span>
                                                        </a>
                                                    </h3>
                
                                                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                                        <div class="pt-2">
                                                            <ul class="ps-3">
                                                                <li class="mb-2"> <a href="assignment-answersheet" class="fw-semibold">Individual Assignment (60%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 0%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="mock-interview-answersheet" class="fw-semibold">Mock interview (40%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 40%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="e-portfolio-answersheet" class="fw-semibold">E-portfolio <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Remark:</span> <span> Good</span> </li>
                                                                    </ul>
                                                                
                                                                </li>

                                                              </ul>
                                                              <div class="border-top pt-3">
                                                                <span class="fw-bold color-blue">Final Result:</span> <span class="text-danger fw-bold"> Fail</span> | 
                                                                <span class="fw-bold color-blue">Total Marks Obtained:</span> <span class="text-danger fw-bold"> 40%</span> 
                                                                     
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border p-3 rounded-3 mb-2" id="headingNine">
                                                    <h3 class="mb-0 fs-4">
                                                        <a href="#" class="d-flex align-items-center text-inherit active collapsed" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                                            <span class="me-auto">9. Research in Projects and Organisations <span class="badge bg-danger-soft ms-2">Fail</span></span>
                                                            <span class="collapse-toggle ms-4">
                                                                <i class="fe fe-chevron-down"></i>
                                                            </span>
                                                        </a>
                                                    </h3>
                
                                                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                                        <div class="pt-2">
                                                            <ul class="ps-3">
                                                                <li class="mb-2"> <a href="assignment-answersheet" class="fw-semibold">Individual Assignment (60%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 0%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="mock-interview-answersheet" class="fw-semibold">Mock interview (40%)  <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Total Marks Obtained:</span> <span> 40%</span> </li>
                                                                    </ul>
                                                                
                                                                </li>
                                                                <li class="mb-2"> <a href="e-portfolio-answersheet" class="fw-semibold">E-portfolio <i class="bi bi-arrow-right fw-bold"></i></a>
                                                                    <ul class="ps-3">
                                                                        <li class="fs-6 color-blue"><span>Remark:</span> <span> Good</span> </li>
                                                                    </ul>
                                                                
                                                                </li>

                                                              </ul>
                                                              <div class="border-top pt-3">
                                                                <span class="fw-bold color-blue">Final Result:</span> <span class="text-danger fw-bold"> Fail</span> | 
                                                                <span class="fw-bold color-blue">Total Marks Obtained:</span> <span class="text-danger fw-bold"> 40%</span> 
                                                                     
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- card footer  -->
                                        <div class="card-footer">
                                            <span class="fw-bold color-blue">Final Result:</span> <span class="text-danger fw-bold"> Fail</span> | 
                                            <span class="fw-bold color-blue">Total Marks Obtained:</span> <span class="text-danger fw-bold"> 60%</span> 
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



@endsection