@extends('frontend.master')
@section('content')
    <style>
        .sidenav.navbar .navbar-nav .e-men-1>.nav-link {
            background-color: var(--gk-gray-200);
        }

        .intitute-dashboardtitles {
            font-size: 18px;
            color: #2b3990;
        }

        /* Set the height of the chart */
        .chart-small {
            max-width: 100%;
            height: 350px;
            /* You can adjust this value to make the chart smaller or larger */
            margin: 0 auto;
        }
        .chart-smalltwo{
            max-width: 100%;
            height: 300px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .chart-small {
                height: 200px;
                /* Reduce the size on smaller screens */
            }
        }
    </style>

    <main>
        <section class="pt-5 pb-5">
            <div class="container">

                <!-- Top Menubar -->
                @include('frontend.institute.layout.institute-common')

                <!-- Content -->

                {{-- <div class="row mt-0 mt-md-4"> --}}

                {{-- Left menubar  --}}

                {{-- @include('frontend.teacher.layout.e-mentor-left-menu') --}}

                <div class="col-lg-9 col-md-8 col-12 ">
                    <div class="row mb-3 flex-wrap">
                        <div class="col-lg custom-col mt-2" style="padding: 0px 3px">
                            <div class="d-flex align-items-center rounded-2 institute-dashboard-card"
                                style="padding: 5px 8px; background-color: #fae0b4">
                                <div class="icon">
                                    <i class="bi bi-person-workspace text-white rounded-2 bg-warning p-2"
                                        style="font-size: 1rem"></i>
                                </div>
                                <div class="instituteIinfo ms-2">
                                    <p class="mb-0 fw-bold intitute-dashboardtitles">{{$registeredStudentCount}}</p>
                                    <h5 style="font-size: 13px">Registered Students</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg custom-col mt-2" style="padding: 0px 5px">
                            <div class="d-flex align-items-center rounded-2 mt-0 institute-dashboard-card"
                                style="padding: 5px 8px; background-color: #e0d4f7;">
                                <div class="icon">
                                    <i class="bi bi-person-vcard text-white rounded-2 p-2"
                                       style="font-size: 1rem; background-color: #6f42c1;"></i>
                                </div>
                                <div class="instituteIinfo ms-2">
                                    <h4 class="mb-0 fw-bold intitute-dashboardtitles">{{$registeredTeacherCount}}</h4>
                                    <h5>Registered Teachers</h5>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-lg custom-col mt-2" style="padding: 0px 3px">
                            <div class="d-flex align-items-center rounded-2 institute-dashboard-card"
                                style="padding: 5px 8px; background-color: #caf2dc">
                                <div class="icon">
                                    <i class="bi bi-mortarboard text-white rounded-2 bg-success p-2"
                                        style="font-size: 1rem"></i>
                                </div>
                                <div class="instituteIinfo ms-2">
                                    <h4 class="mb-0 fw-bold intitute-dashboardtitles">{{$purchasedCount}}</h4>
                                    <h6 style="font-size: 13px">Purchased Course</h6>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-lg custom-col mt-2" style="padding: 0px 3px">
                            <div class="d-flex align-items-center rounded-2 institute-dashboard-card"
                                style="padding: 5px 8px; background-color: #bce3f5">
                                <div class="icon">
                                    <i class="bi bi-people-fill text-white rounded-2 bg-info p-2"
                                        style="font-size: 1rem"></i>
                                </div>
                                <div class="instituteIinfo ms-2">
                                    <h4 class="mb-0 fw-bold intitute-dashboardtitles">{{$enrolledCount}}</h4>
                                    <h6 style="font-size: 13px">Enrolled Students</h6>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-lg custom-col mt-2" style="padding: 0px 3px">
                            <div class="d-flex align-items-center rounded-2 institute-dashboard-card"
                                style="padding: 5px 8px; background-color: #d4f4d4">
                                <div class="icon">
                                    <i class="bi bi-pass text-white rounded-2 bg-success p-2" style="font-size: 1rem"></i>
                                </div>
                                <div class="instituteIinfo ms-2">
                                    <h4 class="mb-0 fw-bold intitute-dashboardtitles">{{$coursesPassedCount ?? 0}}</h4>
                                    <h6 style="font-size: 13px">Courses Passed</h6>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-lg custom-col mt-2" style="padding: 0px 3px">
                            <div class="d-flex align-items-center rounded-2 institute-dashboard-card"
                                style="padding: 5px 8px; background-color: #fca6a6">
                                <div class="icon">
                                    <i class="bi-exclamation-octagon text-white rounded-2 bg-danger p-2" style="font-size: 1rem"></i>
                                </div>
                                <div class="instituteIinfo ms-2">
                                    <h4 class="mb-0 fw-bold intitute-dashboardtitles">{{$coursesFailedCount ?? 0}}</h4>
                                    <h6 style="font-size: 13px">Courses Failed</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row mb-3">
                       <!-- First Chart Column -->
                        
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="card p-4 mt-3" style="box-shadow: 0 2px 5px #0000001a">
                                <h4>Total Course Sales Report</h4>
                                <div class="row mt-2 mb-2">
                                    <div class="col">
                                        <label for="today" class="inline-block">Today</label>
                                        <div class="d-flex">
                                            <h3 class="text-primary"> {{$todayCourseSales}} </h3>
                                            {{-- <i class="bi bi-graph-up-arrow me-2 ms-2 fs-3 "
                                                style="color: #38a169 "></i> --}}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="today" class="inline-block">This Week</label>
                                        <div class="d-flex">
                                            <h3 class="text-primary">{{$thisWeekCourseSales}}</h3>
                                            {{-- <i class="bi bi-graph-down-arrow me-2 ms-2 color-orange fs-3"></i> --}}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="today" class="inline-block">This Months</label>
                                        <div class="d-flex">
                                            <h3 class="text-primary">{{$thisMonthCourseSales}}</h3>
                                            {{-- <i class="bi bi-graph-up-arrow me-2 ms-2 fs-3 "
                                                style="color: #38a169 "></i> --}}
                                        </div>
                                    </div>
                                    {{-- <div class="progress p-0 mt-2" role="progressbar"
                                        aria-label="Success example" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100" style="height: 12px;">
                                        <div class="progress-bar bg-orange" style="width: 47%">47%</div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="card p-4 mt-3" style="box-shadow: 0 2px 5px #0000001a">
                                <h4>Fees Collection Report</h4>
                                <div class="row mt-2 mb-2">
                                    <div class="col">
                                        <label for="today" class="inline-block">Today</label>
                                        <div class="d-flex">
                                            <h3 class="text-primary"><i class="bi bi-currency-euro"></i> {{$todaySales}} </h3>
                                            {{-- <i class="bi bi-graph-up-arrow me-2 ms-2 fs-3 "
                                                style="color: #38a169 "></i> --}}
                                        </div>

                                    </div>
                                    <div class="col">
                                        <label for="today" class="inline-block">This Week</label>
                                        <div class="d-flex">
                                            <h3 class="text-primary"><i class="bi bi-currency-euro"></i> {{$thisWeekSales}} </h3>
                                            {{-- <i class="bi bi-graph-down-arrow me-2 ms-2 color-orange fs-3"></i> --}}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="today" class="inline-block">This Months</label>
                                        <div class="d-flex">
                                            <h3 class="text-primary"><i class="bi bi-currency-euro"></i> {{$thisMonthSales}} </h3>
                                            {{-- <i class="bi bi-graph-up-arrow me-2 ms-2 fs-3 "
                                                style="color: #38a169 "></i> --}}
                                        </div>
                                    </div>
                                    {{-- <div class="progress p-0 mt-2" role="progressbar"
                                        aria-label="Success example" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100" style="height: 12px;">
                                        <div class="progress-bar bg-success" style="width: 76%;">76%</div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        

                        <!-- Second Chart Column -->
                        {{-- <div class="col-lg-6 col-md-12 col-12">
                            <div class="card p-3 mt-3" style="box-shadow: 0 2px 5px #0000001a">
                                <h4>Sales Distribution (Pie Chart)</h4>
                                <div class="d-flex justify-content-center">
                                    <canvas id="salesPieChart" class="chart-smalltwo"></canvas>
                                </div>
                            </div>
                        </div> --}}


                    </div>

                    <div class="card mb-4">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="h4 mb-0">New Student List</h3>
                        </div>
                        <!-- Table -->
                        <div class="card">
                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-hover table-centered text-nowrap instituteStudentList">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Purchased</th>
                                            <th>Enrolled</th>
                                            <th>Exam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    
            // Pie chart
            // const ctx2 = document.getElementById('salesPieChart').getContext('2d');
            // const salesPieChart = new Chart(ctx2, {
            //     type: 'pie',  // Changed from 'line' to 'pie'
            //     data: {
            //         labels: ['Course A', 'Course B', 'Course C', 'Course D'],  // Customize as needed
            //         datasets: [{
            //             data: [300, 50, 100, 25],  // These values should be dynamically set based on your data
            //             backgroundColor: [
            //                 '#4e73df',  // Color for Course A
            //                 '#1cc88a',  // Color for Course B
            //                 '#36b9cc',  // Color for Course C
            //                 '#f6c23e',  // Color for Course D
            //             ],
            //             borderWidth: 0, // Optional: Set to 0 if you don't want borders around the segments
            //         }]
            //     },
            //     options: {
            //         responsive: true,
            //         plugins: {
            //             legend: {
            //                 position: 'top',  // You can adjust this as needed
            //             },
            //             tooltip: {
            //                 callbacks: {
            //                     label: function (tooltipItem) {
            //                         return tooltipItem.label + ': ' + tooltipItem.raw;
            //                     }
            //                 }
            //             }
            //         }
            //     }
            // });

            latestCourseStudentList();

        });

    $('.searchStudent').on('keyup', function() {
        var table = $('.instituteStudentList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });

    function latestCourseStudentList(){
        $(".dataTables_filter").css('display','none');
        var baseUrl = window.location.origin;  
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var userRole = "{{ Auth::user()->role }}";

        let url;
        if (userRole === 'institute') {
            url = baseUrl + "/institute/get-institute-students/1";
        } else if (userRole === 'admin' || userRole === 'superadmin') {
            url = baseUrl + "/admin/get-all-students-list/";
        } 
        $.ajax({
            url: url,
            method: 'GET',
            success: function (data) {
                $(".instituteStudentList").DataTable({
                    data: data, // Pass
                    paging: false,
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
                                    var user_id = btoa(data.id);
                                    var course_id = data.courseId;
                                    
                                    // var img =  baseUrl + "storage/studentDocs/student-profile-photo.png"; 
                                    var img = data.photo ? baseUrl + '/storage/' + data.photo : baseUrl + '/storage/studentDocs/student-profile-photo.png';
                                    // if (userRole === 'instructor') {
                                    //     var url =  baseUrl + "/ementor/e-mentor-students-exam-details/"+user_id+"/"+course_id; 
                                    // } else if (userRole === 'admin'  || userRole === 'superadmin') {
                                    //     var url =  baseUrl + "/admin/e-mentor-students-exam-details/"+user_id+"/"+course_id; 
                                    // }
                                    return (
                                        `<a href="#" class="d-flex align-items-center"><img src="`+img+`" alt="" class="rounded-circle avatar-md me-2" >
                                            <h5 class="mb-0 color-blue">`+fname+` `+last_name+`</h5></a></td>`
                                    );
                                }else{
                                    return '';
                                }
                            },
                        },
                        {
                            data: null,
                            render: function(row) {
                                var courseTitles = [];
                                if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                    row.allPaidCourses.forEach(function(course, index) {
                                        var userId = btoa(row.id);
                                        var courseId = btoa(course.course_id);
                                        if(course.course_progress == null){
                                            progress_bar = 0;
                                        }else{
                                            progress_bar = course.course_progress;
                                        }
                                        // const courseUrl = `/ementor/e-mentor-students-exam-details/${userId}/${courseId}`;
                                        courseTitles += ` <div class="course-item">
                                                <div>${index + 1}. ${course.course_title}</div>
                                                <div class="d-flex align-items-center mt-1 mb-3">
                                                    <div class="me-2"><span>${progress_bar}%</span></div>
                                                    <div class="progress w-100" style="height: 6px;">
                                                        <div class="progress-bar bg-primary" role="progressbar" 
                                                            style="width:${progress_bar}%" aria-valuenow="${progress_bar}" 
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>`;

                                    });
                                }
                                return courseTitles;

                            },
                            width: '30%',
                        },
                        {
                            data: null,
                            render: function(row) {
                                var purchaseDates = [];
                                let badge = '';
                                if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                    
                                    row.allPaidCourses.forEach(function(course) {
                                        purchaseDates += `${course.course_start_date}<br><br>`;
                                    });
                                }
                                return purchaseDates;

                            },
                            width: '30%',
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                var enrolled = 'Not enrolled';
                                if(data.verified_on != null){
                                    var dateInput = data.verified_on;
                                    enrolled = dateInput.split(' ')[0];
                                }
                                return enrolled;
                            }
                            
                        },
                        {
                            data: null,
                            render: function(row) {
                                
                                var courseTitles = [];
                                let badge = '';
                                if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                    row.allPaidCourses.forEach(function(course) {
                                        let examData = row.examResults && row
                                            .examResults[course.scmId] ? row
                                            .examResults[course.scmId] : null;

                                        if (examData) {
                                            badge =
                                                `<span class="badge bg-${examData.color}">${examData.result} ${examData.percent ? examData.percent + '%' : ''}</span>`;
                                        } else {
                                            badge =
                                                `<span class="badge bg-primary">Not Attempt</span>`;
                                        }

                                        courseTitles += `${badge}<br><br>`;

                                    });
                                }
                                return courseTitles;

                            },
                            width: '30%',
                        },
                    ],            
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    $('#searchInput').on('input', function() {
        var table = $('.instituteStudentList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });

    </script>
    
@endsection
