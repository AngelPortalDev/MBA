@extends('frontend.master')
@section('content')

<style>
</style>
        <!-- Wrapper -->
        <div class="course-video-player-page">
            <!-- Sidebar -->
            <nav class="navbar-vertical navbar bg-white customeNavbar">
            </nav>
            <!-- Page Content -->
            <main id="page-content">
                <!-- Page Header -->
                <!-- Container fluid -->
                <div>
                    <h4 id="selected-title" style="padding-left: 24px; padding-bottom:0.9rem"></h4>
                </div>
                <section class="pb-8">
                    <section class="pt-lg-8 pt-5 pb-8 bg-primary">
                        <div class="container">
                            <h1 class="text-center ementorCourseHeading">Award of Recruitment and Employee Selection</h1>
                            <p class="text-center text-white">JavaScript is the popular programming language which powers web pages and web applications. This course will get you started coding in JavaScript.</p>
                            <div class="d-flex align-items-center justify-content-center flex-md-column flex-lg-row mentormainsection">
                                <span class="text-white ms-3 mt-1">
                                    <i class="bi bi-star-fill color-green rating-star"></i>
                                    ECTS: 2222 Credits
                                </span>
                                <span class="text-white ms-3 mt-1">
                                    <img src="{{ asset('frontend/images/icon/mqf-icon.svg') }}" alt="" width="15px">
                                    MQF/EQF Level: 65522
                                </span>
                                <span class="text-white ms-3 mt-1 price-tag">
                                   Price:  <i class="bi bi-currency-euro"></i><strong></i>199.99</strong> /  <i class="bi bi-currency-euro"></i> <del> 250</del>  
                                </span>
                            </div>
                        </div>
                    </section>
                    </p>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-6 col-sm-12 mt-2">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Enrolled Students</h5>
                                        <p class="student-card-number text-primary">350</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mt-2">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Active Students</h5>
                                        <p class="student-card-number text-info">280</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mt-2">
                              <div class="card">
                                  <div class="card-body text-center">
                                      <h5 class="card-title">Pass Student</h5>
                                      <p class="student-card-number text-success">140</p>
                                  </div>
                              </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mt-2">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Fail Student</h5>
                                    <p class="student-card-number text-danger">40</p>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mt-2">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Pending Exams</h5>
                                        <p class="student-card-number text-warning">50</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mt-2">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Average Exam Score</h5>
                                    <p class="student-card-number text-success">85%</p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 mb-4 mb-lg-0">
                                <!-- Card -->
                                <div class="card rounded-3">
                                    <!-- Card header -->
                                    <div class="card-header border-bottom-0 p-0">
                                        <div>
                                            <div class="table-responsive">
                                                <!-- Nav tabs with existing classes -->
                                                <ul class="nav nav-lb-tab studentTab" id="tab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link active" id="note4-tab" data-bs-toggle="tab" href="#note4" role="tab" aria-controls="note4" aria-selected="true">Enrolled Student</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="note5-tab" data-bs-toggle="tab" href="#note5" role="tab" aria-controls="note5" aria-selected="false">Active Student</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="note6-tab" data-bs-toggle="tab" href="#note6" role="tab" aria-controls="note6" aria-selected="false">Pass Student</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="note7-tab" data-bs-toggle="tab" href="#note7" role="tab" aria-controls="note7" aria-selected="false">Fail Student</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link " id="note8-tab" data-bs-toggle="tab" href="#note8" role="tab" aria-controls="note8" aria-selected="false">Course content</a>
                                                    </li>
                                                  
                                                   
                                                </ul>
                                                <div class="container">
                                                    <div class="row justify-content-end mt-3">
                                                        <div class="col-12 col-md-6 col-lg-4 mt-2 mt-lg-0">
                                                            <select class="form-select form-select-sm form-control p-2">
                                                                <option selected>5</option>
                                                                <option value="1">10</option>
                                                                <option value="2">50</option>
                                                                <option value="3">100</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-4 mt-2 mt-lg-0">
                                                            <form class="d-flex align-items-center">
                                                                <span class="position-absolute ps-3 search-icon">
                                                                    <i class="fe fe-search"></i>
                                                                </span>
                                                                <input type="search" class="form-control ps-6" placeholder="Search Here">
                                                            </form>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-4 mt-2 mt-lg-0">
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>Filter</option>
                                                                <option value="Newest">Newest</option>
                                                                <option value="Active">Active</option>
                                                                <option value="Pass">Pass</option>
                                                                <option value="Fail">Fail</option>
                                                                <option value="Pending">Pending</option>
                                                             
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="d-flex justify-between">
                                                   
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body with existing classes -->
                                    <div class="card-body">
                                        <!-- Tab content with existing classes -->
                                            <div class="tab-content" id="tabContent">
                                                <!-- Note 1 -->
                                                <div class="tab-pane fade show active" id="note4" role="tabpanel" aria-labelledby="note4-tab">
                                                        <div class="table-responsive">
                                                            <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentList"  width="100%">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Sr. No.</th>
                                                                        <th>Name</th>
                                                                        <th>Exam</th>
                                                                        <th>Status</th>
                                                                        <th>Joined</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody >
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <img src="frontend/images/avatar/avatar-3.jpg" alt=""
                                                                                    class="rounded-circle avatar-md me-2">
                                                                                <h5 class="mb-0">Rivao Luke</h5>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-success">Pass</td>
                                                                        <td><span class="badge text-success bg-light-success">Verified</span></td>
                                                                        <td>7 July, 2020</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2</td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <img src="frontend/images/avatar/avatar-2.jpg" alt=""
                                                                                    class="rounded-circle avatar-md me-2">
                                                                                <h5 class="mb-0">Vijay Malik</h5>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-success">Pass</td>
                                                                        <td><span class="badge text-success bg-light-success">Verified</span></td>
                                                                        <td>15 Aug, 2020</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3</td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <img src="frontend/images/avatar/avatar-3.jpg" alt=""
                                                                                    class="rounded-circle avatar-md me-2">
                                                                                <h5 class="mb-0">Nikolla jon</h5>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-danger">Fail</td>
                                                                        <td><span class="badge text-success bg-light-success">Verified</span></td>
                                                                        <td>31 dec, 2023</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>4</td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <img src="frontend/images/avatar/avatar-1.jpg" alt=""
                                                                                    class="rounded-circle avatar-md me-2">
                                                                                <h5 class="mb-0">andrew tye</h5>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-success">Pass</td>
                                                                        <td><span class="badge text-success bg-light-success">Verified</span></td>
                                                                        <td>12 July, 2021</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                </div>
                                                <div class="tab-pane fade" id="note5" role="tabpanel" aria-labelledby="note5-tab">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentList"  width="100%">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>Sr. No.</th>
                                                                    <th>Name</th>
                                                                    <th>Exam</th>
                                                                    <th>Status</th>
                                                                    <th>Joined</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody >
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="frontend/images/avatar/avatar-3.jpg" alt=""
                                                                                class="rounded-circle avatar-md me-2">
                                                                            <h5 class="mb-0">Rivao Luke</h5>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-warning">Pending</td>
                                                                    <td><span class="badge text-success bg-light-success">Verified</span></td>
                                                                    <td>7 July, 2020</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="frontend/images/avatar/avatar-2.jpg" alt=""
                                                                                class="rounded-circle avatar-md me-2">
                                                                            <h5 class="mb-0">Vijay Malik</h5>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-success">Pass</td>
                                                                    <td><span class="badge text-warning bg-light-warning">not Verified</span></td>
                                                                    <td>15 Aug, 2020</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="frontend/images/avatar/avatar-3.jpg" alt=""
                                                                                class="rounded-circle avatar-md me-2">
                                                                            <h5 class="mb-0">Nikolla jon</h5>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-danger">Fail</td>
                                                                    <td><span class="badge text-success bg-light-success">Verified</span></td>
                                                                    <td>31 dec, 2023</td>
                                                                </tr>
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="note6" role="tabpanel" aria-labelledby="note6-tab">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentList"  width="100%">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>Sr. No.</th>
                                                                    <th>Name</th>
                                                                    <th>Exam</th>
                                                                    <th>Status</th>
                                                                    <th>Joined</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody >
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="frontend/images/avatar/avatar-3.jpg" alt=""
                                                                                class="rounded-circle avatar-md me-2">
                                                                            <h5 class="mb-0">Rivao Luke</h5>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-success">Pass</td>

                                                                    <td><span class="badge text-success bg-light-success">Verified</span></td>
                                                                    <td>7 July, 2020</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="note7" role="tabpanel" aria-labelledby="note7-tab">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentList"  width="100%">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>Sr. No.</th>
                                                                    <th>Name</th>
                                                                    <th>Exam</th>
                                                                    <th>Status</th>
                                                                    <th>Joined</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody >
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="frontend/images/avatar/avatar-2.jpg" alt=""
                                                                                class="rounded-circle avatar-md me-2">
                                                                            <h5 class="mb-0">Rivao Luke</h5>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-danger">fail</td>
                                                                    <td><span class="badge text-success bg-light-success">Verified</span></td>
                                                                    <td>7 July, 2020</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="frontend/images/avatar/avatar-1.jpg" alt=""
                                                                                class="rounded-circle avatar-md me-2">
                                                                            <h5 class="mb-0">Vijay Malik</h5>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-danger">fail</td>
                                                                    <td><span class="badge text-warning bg-light-warning">not Verified</span></td>
                                                                    <td>15 Aug, 2020</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade " id="note8" role="tabpanel" aria-labelledby="note8-tab">
                                                    <div class="accordion" id="accordionExample">
                                                    {{-- Accrodian 1 --}}
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="courseHeading">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#courseCollapse" aria-expanded="false" aria-controls="courseCollapse">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <div class="me-auto">
                                                                        <h4>Award Training and Development</h4>
                                                                        <div class="d-flex flex-wrap align-items-center">
                                                                            <span class="badge bg-secondary me-2">6 ECTS</span>
                                                                            <span class="badge bg-secondary">150 Hours</span> 
                                                                        </div>
                                                                    </div>
                                                                    <span class="accordion-icon">
                                                                        <i class="fas fa-chevron-down"></i>
                                                                    </span>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="courseCollapse" class="accordion-collapse collapse" aria-labelledby="courseHeading" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                                                <div class="col">
                                                                    <div class="card h-100 shadow-sm">
                                                                        <div class="card-body rounded-2 d-flex align-items-center justify-content-center flex-colum contentCourseCardBody" >
                                                                            <h5 class="card-title mb-3 text-primary fs-lg">Assignments</h5>
                                                                            <img src="{{ asset('frontend/images/icons/assignment.png')}}" alt="Assignments" class="card-img-top img-fluid courseContentImage">
                                                                            <p class="card-text text-muted mt-2">Weight: 60%</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="card h-100 shadow-sm">
                                                                        <div class="card-body rounded-2 d-flex align-items-center justify-content-center contentCourseCardBody">
                                                                            <h5 class="card-title mb-3 text-primary fs-lg" >Portfolio</h5>
                                                                            <img src="{{ asset('frontend/images/icons/portfolio.png')}}" alt="Portfolio" class="card-img-top img-fluid courseContentImage">
                                                                            <p class="card-text text-muted mt-2">Weight: 30%</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="card h-100 shadow-sm">
                                                                        <div class="card-body rounded-2 d-flex align-items-center justify-content-center flex-colum contentCourseCardBody" >
                                                                            <h5 class="card-title mb-3 text-primary fs-lg" >MCQs</h5>
                                                                            <img src="{{ asset('frontend/images/icons/mcq.png')}}" alt="MCQs" class="card-img-top img-fluid courseContentImage">
                                                                            <p class="card-text text-muted mt-2">Weight: 10%</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="passing-criteria mt-4">
                                                                <hr>
                                                                <h3 class="text-center mb-3 text-success">Passing Criteria: 40%</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    
                                                    {{-- Accrodian 2 --}}
                                                    
                                                        <div class="accordion-item">
                                                        <h2 class="accordion-header" id="courseHeadingTwo">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#courseCollapseTwo" aria-expanded="false" aria-controls="courseCollapseTwo">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <div class="me-auto">
                                                                        <h4>Award Recuritment and employee Selection</h4>
                                                                        <div class="d-flex flex-wrap align-items-center">
                                                                            <span class="badge bg-secondary me-2">12 ECTS</span>
                                                                            <span class="badge bg-secondary">290 Hours</span>
                                                                        </div>
                                                                    </div>
                                                                    <span class="accordion-icon">
                                                                        <i class="fas fa-chevron-down"></i>
                                                                    </span>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="courseCollapseTwo" class="accordion-collapse collapse" aria-labelledby="courseHeadingTwo" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                                                <div class="col">
                                                                    <div class="card h-100 shadow-sm">
                                                                        <div class="card-body rounded-2 d-flex align-items-center justify-content-center flex-colum contentCourseCardBody" >
                                                                            <h5 class="card-title mb-3 text-primary fs-lg" >Assignments</h5>
                                                                            <img src="{{ asset('frontend/images/icons/assignment.png')}}" alt="Assignments" class="card-img-top img-fluid courseContentImage">
                                                                            <p class="card-text text-muted mt-2">Weight: 60%</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="card h-100 shadow-sm">
                                                                        <div class="card-body rounded-2 d-flex align-items-center justify-content-center contentCourseCardBody" >
                                                                            <h5 class="card-title mb-3 text-primary fs-lg" >Portfolio</h5>
                                                                            <img src="{{ asset('frontend/images/icons/portfolio.png')}}" alt="Portfolio" class="card-img-top img-fluid courseContentImage">
                                                                            <p class="card-text text-muted mt-2">Weight: 30%</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="card h-100 shadow-sm">
                                                                        <div class="card-body rounded-2 d-flex align-items-center justify-content-center flex-colum contentCourseCardBody" >
                                                                            <h5 class="card-title mb-3 text-primary fs-lg" >MCQs</h5>
                                                                            <img src="{{ asset('frontend/images/icons/mcq.png')}}" alt="MCQs" class="card-img-top img-fluid courseContentImage">
                                                                            <p class="card-text text-muted mt-2">Weight: 10%</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="passing-criteria mt-4">
                                                                <hr>
                                                                <h3 class="text-center mb-3 text-success">Passing Criteria: 40%</h3>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        </div>

                                                    {{-- Accrodian 3 --}}

                                                        <div class="accordion-item">
                                                        <h2 class="accordion-header" id="courseHeading">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#CoursecollapseThree" aria-expanded="false" aria-controls="CoursecollapseThree">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <div class="me-auto">
                                                                        <h4>Javascript Tutorial for Beginners</h4>
                                                                        <div class="d-flex flex-wrap align-items-center">
                                                                            <span class="badge bg-secondary me-2">2 ECTS</span>
                                                                            <span class="badge bg-secondary">70 Hours</span> 
                                                                        </div>
                                                                    </div>
                                                                    <span class="accordion-icon">
                                                                        <i class="fas fa-chevron-down"></i>
                                                                    </span>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="CoursecollapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                                                <div class="col">
                                                                    <div class="card h-100 shadow-sm">
                                                                        <div class="card-body rounded-2 d-flex align-items-center justify-content-center flex-colum contentCourseCardBody" >
                                                                            <h5 class="card-title mb-3 text-primary fs-lg" >Assignments</h5>
                                                                            <img src="{{ asset('frontend/images/icons/assignment.png')}}" alt="Assignments" class="card-img-top img-fluid courseContentImage">
                                                                            <p class="card-text text-muted mt-2">Weight: 60%</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="card h-100 shadow-sm">
                                                                        <div class="card-body rounded-2 d-flex align-items-center justify-content-center contentCourseCardBody">
                                                                            <h5 class="card-title mb-3 text-primary fs-lg" >Portfolio</h5>
                                                                            <img src="{{ asset('frontend/images/icons/portfolio.png')}}" alt="Portfolio" class="card-img-top img-fluid courseContentImage">
                                                                            <p class="card-text text-muted mt-2">Weight: 30%</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="card h-100 shadow-sm">
                                                                        <div class="card-body rounded-2 d-flex align-items-center justify-content-center flex-colum contentCourseCardBody">
                                                                            <h5 class="card-title mb-3 text-primary fs-lg">MCQs</h5>
                                                                            <img src="{{ asset('frontend/images/icons/mcq.png')}}" alt="MCQs" class="card-img-top img-fluid courseContentImage">
                                                                            <p class="card-text text-muted mt-2">Weight: 10%</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="passing-criteria mt-4">
                                                                <hr>
                                                                <h3 class="text-center mb-3 text-success">Passing Criteria: 40%</h3>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          <div class="pt-2 pb-4">
                                            <!-- Pagination -->
                                            <nav>
                                                <ul class="pagination justify-content-center mb-0">
                                                    <li class="page-item disabled">
                                                        <a class="page-link mx-1 rounded" href="#">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                                                <path
                                                                    fill-rule="evenodd"
                                                                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" >
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    <li class="page-item active">
                                                        <a class="page-link mx-1 rounded" href="#">1</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a class="page-link mx-1 rounded" href="#">2</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a class="page-link mx-1 rounded" href="#">3</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a class="page-link mx-1 rounded" href="#">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                                <path
                                                                    fill-rule="evenodd"
                                                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
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
</body>
<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</html>
@endsection
