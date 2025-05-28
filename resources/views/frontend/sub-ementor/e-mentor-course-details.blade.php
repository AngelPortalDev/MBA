@extends('frontend.master')
@section('content')

<style>
.card {
    min-height: 165px; 
}

.card-body {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.dataTables_filter {
        display: none;
    }
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
                            <h1 class="text-center ementorCourseHeading">{{$data['course']->course_title}}</h1>
                            <p class="text-center text-white">{{$data['course']->course_subheading}}</p>
                            <div class="d-flex align-items-center justify-content-center flex-md-column flex-lg-row mentormainsection">
                                <span class="text-white ms-3 mt-1">
                                    <i class="bi bi-star-fill color-green rating-star"></i>
                                    ECTS: {{$data['course']->ects}} Credits
                                </span>
                                <span class="text-white ms-3 mt-1">
                                    <img src="{{ asset('frontend/images/icon/mqf-icon.svg') }}" alt="" width="15px">
                                    MQF/EQF Level: {{$data['course']->mqfeqf_level}}
                                </span>
                                <span class="text-white ms-3 mt-1 price-tag">
                                   Price:  <i class="bi bi-currency-euro"></i><strong></i>{{$data['course']->course_final_price != '' ?  $data['course']->course_final_price : ''}}</strong> /  <i class="bi bi-currency-euro"></i> <del> {{$data['course']->course_old_price != '' ? $data['course']->course_old_price : '' }}</del>  
                                </span>
                            </div><div class="mt-3">
                                <!-- button -->
                                {{-- <a href="javascript:history.back()" class="btn btn-outline-white float-end">Back</a> --}}
                            </div>
                        </div>
                    </section>
                    
                    <div class="container">
                        <div class="row mt-2">
                            <div class="col-lg-2 col-md-6 col-sm-12 mt-2">
                                <div class="card flex-grow-1 mt-2">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Enrolled Students</h5>
                                        <p class="student-card-number text-primary">{{$data['enrolledStudents']}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mt-2">
                                <div class="card flex-grow-1 mt-2">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Active Students</h5>
                                        <p class="student-card-number text-info">{{$data['activeStudents']}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mt-2">
                              <div class="card flex-grow-1 mt-2">
                                  <div class="card-body text-center">
                                      <h5 class="card-title">Pass Students</h5>
                                      <p class="student-card-number text-success">{{$data['passStudents']}}</p>
                                  </div>
                              </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mt-2">
                            <div class="card flex-grow-1 mt-2">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Fail Students</h5>
                                    <p class="student-card-number text-danger">{{$data['failStudents']}}</p>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mt-2">
                                <div class="card flex-grow-1 mt-2">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Pending Exams</h5>
                                        <p class="student-card-number text-warning">{{$data['pendingExamStudent']}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mt-2">
                            <div class="card flex-grow-1 mt-2">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Exam Success Rate</h5>
                                    
                                    <p class="student-card-number text-success">{{$data['averageExamPerc'] != '' ? $data['averageExamPerc'] : 0}}%</p>
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
                                                        <a class="nav-link active" id="enrolled-student" data-bs-toggle="tab" href="#note4" role="tab" aria-controls="note4" aria-selected="true">Enrolled Student</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="active-student" data-bs-toggle="tab" href="#note5" role="tab" aria-controls="note5" aria-selected="false">Active Student</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="pass" data-bs-toggle="tab" href="#note6" role="tab" aria-controls="note6" aria-selected="false">Pass Student</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="fail" data-bs-toggle="tab" href="#note7" role="tab" aria-controls="note7" aria-selected="false">Fail Student</a>
                                                    </li>
                                                    {{-- <li class="nav-item" role="presentation">
                                                        <a class="nav-link " id="note8-tab" data-bs-toggle="tab" href="#note8" role="tab" aria-controls="note8" aria-selected="false">Course content</a>
                                                    </li> --}}
                                                  
                                                   
                                                </ul>
                                                <div class="container">
                                                    <div class="row mt-3">
                                                        {{-- <div class="col-12 col-md-6 col-lg-4 mt-2 mt-lg-0">
                                                            <select class="form-select form-select-sm form-control p-2">
                                                                <option selected>5</option>
                                                                <option value="1">10</option>
                                                                <option value="2">50</option>
                                                                <option value="3">100</option>
                                                            </select>
                                                        </div> --}}
                                                        <div class="col-12 col-md-6 col-lg-4 mt-2 mt-lg-0">
                                                            <form class="d-flex align-items-center">
                                                                <span class="position-absolute ps-3 search-icon">
                                                                    <i class="fe fe-search"></i>
                                                                </span>
                                                                <input type="search" class="form-control ps-6 searchSection" placeholder="Search Here" id="searchInput">
                                                                {{-- <span class="position-absolute ps-3 clear-icon" style="cursor: pointer;">
                                                                    <i class="fe fe-x"></i>
                                                                </span> --}}
                                                            </form>
                                                        </div>
                                                        {{-- <div class="col-12 col-md-6 col-lg-4 mt-2 mt-lg-0">
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected>Filter</option>
                                                                <option value="Newest">Newest</option>
                                                                <option value="Active">Active</option>
                                                                <option value="Pass">Pass</option>
                                                                <option value="Fail">Fail</option>
                                                                <option value="Pending">Pending</option>
                                                             
                                                            </select>
                                                        </div> --}}
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
                                                            <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentListRemark w-100"  width="100%">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Sr. No.</th>
                                                                        <th>Name</th>
                                                                        <th>Exam</th>
                                                                        <th>Marks</th>
                                                                        <th>Joined</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody >
                                                                    {{-- <tr>
                                                                        <td>1</td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <img src="frontend/images/avatar/avatar-3.jpg" alt=""
                                                                                    class="rounded-circle avatar-md me-2">
                                                                            </div>
                                                                        </td>
                                                                        <td><span class="badge text-success bg-light-success">Pass</span></td>
                                                                        <td><span class="badge text-success bg-light-success">75%</span></td>
                                                                        <td>7 July, 2020</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2</td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <img src="frontend/images/avatar/avatar-2.jpg" alt=""
                                                                                    class="rounded-circle avatar-md me-2">
                                                                            </div>
                                                                        </td>
                                                                        <td><span class="badge text-success bg-light-success">Pass</span></td>
                                                                        <td><span class="badge text-success bg-light-success">62%</span></td>
                                                                        <td>15 Aug, 2020</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3</td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <img src="frontend/images/avatar/avatar-3.jpg" alt=""
                                                                                    class="rounded-circle avatar-md me-2">
                                                                            </div>
                                                                        </td>
                                                                        <td><span class="badge text-danger bg-light-danger">Fail</span></td>
                                                                        <td><span class="badge text-danger bg-light-danger">31%</span></td>
                                                                        <td>31 dec, 2023</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>4</td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <img src="frontend/images/avatar/avatar-1.jpg" alt=""
                                                                                    class="rounded-circle avatar-md me-2">
                                                                            </div>
                                                                        </td>
                                                                        <td><span class="badge text-success bg-light-success">Pass</span></td>
                                                                        <td><span class="badge text-success bg-light-success">60%</span></td>
                                                                        <td>12 July, 2021</td>
                                                                    </tr> --}}
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                </div>
                                                <div class="tab-pane fade" id="note5" role="tabpanel" aria-labelledby="note5-tab">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentListRemark"  width="100%">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>Sr. No.</th>
                                                                    <th>Name</th>
                                                                    <th>Exam</th>
                                                                    <th>Marks</th>
                                                                    <th>Joined</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody >
                                                                {{-- <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="frontend/images/avatar/avatar-3.jpg" alt=""
                                                                                class="rounded-circle avatar-md me-2">
                                                                            <a href="#" class="mb-0 text-primary">Rivao Luke</a>
                                                                        </div>
                                                                    </td>
                                                                    <td><span class="badge text-warning bg-light-warning">Pending</span></td>
                                                                    <td><span class="badge text-warning bg-light-warning">-</span></td>
                                                                    <td>7 July, 2020</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="frontend/images/avatar/avatar-2.jpg" alt=""
                                                                                class="rounded-circle avatar-md me-2">
                                                                            <a href="#" class="mb-0 text-primary">Vijay Malik</h5>
                                                                        </div>
                                                                    </td>
                                                                    <td><span class="badge text-success bg-light-success">Pass</span></td>
                                                                    <td><span class="badge text-success bg-light-success">91%</span></td>
                                                                    <td>15 Aug, 2020</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="frontend/images/avatar/avatar-3.jpg" alt=""
                                                                                class="rounded-circle avatar-md me-2">
                                                                            <a href="#" class="mb-0 text-primary">Nikolla jon</a>
                                                                        </div>
                                                                    </td>
                                                                    <td><span class="badge text-danger bg-light-danger">Fail</span></td>
                                                                    <td><span class="badge text-danger bg-light-danger">15%</span></td>
                                                                    <td>31 dec, 2023</td>
                                                                </tr> --}}
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="note6" role="tabpanel" aria-labelledby="note6-tab">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentListRemark"  width="100%">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>Sr. No.</th>
                                                                    <th>Name</th>
                                                                    <th>Exam</th>
                                                                    <th>Marks</th>
                                                                    <th>Joined</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody >
                                                                {{-- <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="frontend/images/avatar/avatar-3.jpg" alt=""
                                                                                class="rounded-circle avatar-md me-2">
                                                                            <a href="#" class="mb-0 text-primary">Rivao Luke</a>
                                                                        </div>
                                                                    </td>
                                                                    <td><span class="badge text-success bg-light-success">Pass</span></td>
                                                                    <td><span class="badge text-success bg-light-success">83%</span></td>
                                                                    <td>7 July, 2020</td>
                                                                </tr> --}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="note7" role="tabpanel" aria-labelledby="fail">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentListRemark"  width="100%">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>Sr. No.</th>
                                                                    <th>Name</th>
                                                                    <th>Exam</th>
                                                                    <th>Marks</th>
                                                                    <th>Joined</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody >
                                                                {{-- <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="frontend/images/avatar/avatar-2.jpg" alt=""
                                                                                class="rounded-circle avatar-md me-2">
                                                                            <a href="#" class="mb-0 text-primary">Rivao Luke</a>
                                                                        </div>
                                                                    </td>
                                                                    <td><span class="badge text-danger bg-light-danger">Fail</span></td>
                                                                    <td><span class="badge text-danger bg-light-danger">22%</span></td>
                                                                    <td>7 July, 2020</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="frontend/images/avatar/avatar-1.jpg" alt=""
                                                                                class="rounded-circle avatar-md me-2">
                                                                            <a href="#" class="mb-0 text-primary">Vijay Malik</a>
                                                                        </div>
                                                                    </td>
                                                                    <td><span class="badge text-danger bg-light-danger">Fail</span></td>
                                                                    <td><span class="badge text-danger bg-light-danger">36%%</span></td>
                                                                    <td>15 Aug, 2020</td>
                                                                </tr> --}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                          {{-- <div class="pt-2 pb-4">
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
                                          </div> --}}
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

<script>
    $(document).ready(function () {
        var courseId = @json($data['course']->id);
        
        studentListRemark(btoa(7), courseId);

        $("#fail").on("click", function (event) {
            studentListRemark(btoa(4), courseId );
        });
        $("#pass").on("click", function (event) {
            studentListRemark(btoa(5), courseId);
        });
        $("#active-student").on("click", function (event) {
            studentListRemark(btoa(6), courseId);
        });
        $("#enrolled-student").on("click", function (event) {
            studentListRemark(btoa(7), courseId);
        });
    });
    
    $(".dataTables_filter").css("display", "none");

    function studentListRemark(token, courseId) {
        var baseUrl = window.location.origin + "/";
        
        // $(".loader").removeClass("d-none");
        var userRole = "{{ Auth::user()->role }}";
        let url;
        if (userRole === 'instructor') {
            url = baseUrl + "ementor/get-students-list/" + token + "/" + courseId;
        } else if (userRole === 'admin' || userRole === 'superadmin' ) {
            url = baseUrl + "admin/get-students-list/" + token + "/" + courseId;
        } 
        
        $.ajax({
            // url: baseUrl + "ementor/get-students-list/" + token + "/" + courseId,
            url: url,
            method: "GET",
            success: function (data) {
                $(".studentListRemark").DataTable().destroy();
                // $(".loader").addClass("d-none");
                $(".studentListRemark").DataTable({
                    data: data, // Pass
    
                    columns: [
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                i = row.row + 1;
                                return i;
                            },
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                // return row.name+' '+row.last_name;
                                
                                if(data.name != ''){
                                    if(data.name != ''  && data.last_name != ''){
    
                                        var fname = data.name;
                                        var last_name = data.last_name;
                                    }else{
                                        var fname = '';
                                        var last_name = '';
    
                                    }
                                    var photo = data.photo;
                                    var user_id = data.userId;
                                    var course_id = data.courseId;
                                    var scmId = btoa(data.scmId);
                                    // var img =  baseUrl + "storage/studentDocs/student-profile-photo.png"; 
                                    var img = data.photo ? baseUrl + 'storage/' + data.photo : baseUrl + '/storage/studentDocs/student-profile-photo.png';
                                    if (userRole === 'instructor') {
                                        var url =  baseUrl + "ementor/e-mentor-students-exam-details/"+user_id+"/"+courseId+"/"+scmId; 
                                    } else if (userRole === 'admin' || userRole === "superadmin") {
                                        var url =  baseUrl + "admin/e-mentor-students-exam-details/"+user_id+"/"+courseId+"/"+scmId; 
                                    }
                                    return (
                                        `<a href="`+url+`" class="d-flex align-items-center"><img src="`+img+`" alt="" class="rounded-circle avatar-md me-2" >
                                            <h5 class="mb-0 color-blue">`+fname+` `+last_name+`</h5></a></td>`
                                    );
                                }else{
                                    return '';
                                }
                            },
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                if(data != ''){
                                    if(data.exam_remark == '0'){
                                        return `<span class="badge bg-danger">Fail</span>`;
                                    }else if(data.exam_remark == '1'){
                                        return `<span class="badge bg-success">Pass</span>`;
                                    }else{
                                        return `<span class="badge bg-warning">Pending</span>`;
                                    }
                                }else{
                                    return `<span class="badge bg-danger">Pending</span>`;
                                }
                            },
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                if(data != ''){
                                    if(data.exam_remark == '0'){
                                        return `<span class="badge bg-danger">`+data.exam_perc+`</span>`;
                                    }else if(data.exam_remark == '1'){
                                        return `<span class="badge bg-success">`+data.exam_perc+`</span>`;
                                    }else{
                                        return `<span class="badge bg-warning">Pending</span>`;
                                    }
                                }else{
                                    return `<span class="badge bg-danger">Pending</span>`;
                                }
                            },
                        },
                        {
                            data: null,
                            render: function (row) {
                                return row.course_start_date;
                            }
                        },
                    ],            
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    }
    
    $('.searchSection').on('keyup', function() {
        var table = $('.studentListRemark').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });

    $('#searchInput').on('input', function() {
        var table = $('.studentListRemark').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
    
</script>

</html>
@endsection
