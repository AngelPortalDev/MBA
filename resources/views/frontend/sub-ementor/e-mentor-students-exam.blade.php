@extends('frontend.master')
@section('content')

<style>
    .dataTables_filter {
        display: none;
    }
    .sidenav.navbar .navbar-nav .e-men-8 > .nav-link {
    background-color: var(--gk-gray-200);
    
}
</style>

<main>
    <section class="pt-5 pb-5">
        <div class="container">
            
            <!-- Top Menubar -->
            @include('frontend.teacher.layout.e-mentor-common')
            <!-- Content -->

            {{-- <div class="row mt-0 mt-md-4"> --}}

                {{-- Left menubar  --}}
                {{-- @include('frontend.teacher.layout.e-mentor-left-menu') --}}

                <div class="col-lg-9 col-md-8 col-12">
                    <!-- Card -->
                    <div class="card mb-1">
                        <!-- Card body -->
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">Examination</h3>
                                {{-- <span>Meet students taking your exam.</span> --}}
                            </div>

                        </div>
                    </div>
                    <!-- Tab content -->

                        <!-- Tab pane -->

                            <div class="container mt-2" style="padding: 10px">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12 mb-4 mb-lg-0 p-0">
                                        <!-- Card -->
                                        <div class="card rounded-3">
                                            <!-- Card header -->
                                            <div class="card-header border-bottom-0 p-0">
                                                <div>
                                                    <div class="table-responsive">
                                                        <!-- Nav tabs with existing classes -->
                                                        <ul class="nav nav-lb-tab studentTab" id="tab" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link active" id="pass" data-bs-toggle="tab" href="#note5" role="tab" aria-controls="note5" aria-selected="false">Pass</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" id="fail" data-bs-toggle="tab" href="#note6" role="tab" aria-controls="note6" aria-selected="false">Fail</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" id="checking-tab" data-bs-toggle="tab" href="#checking" role="tab" aria-controls="checking" aria-selected="false">Checking</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" id="pending" data-bs-toggle="tab" href="#note7" role="tab" aria-controls="note7" aria-selected="false"> Pending</a>
                                                            </li>
                                                            
                                                        </ul>
                                                        <div class="container">
                                                            <div class="row mt-3">
                                                                <div class="col-12 col-md-6 col-lg-9 mt-2 mt-lg-0">
                                                                    <form class="d-flex align-items-center">
                                                                        {{-- <input type="search" class="form-control ps-6 mb-1 searchSection" placeholder="Search Here"> --}}
                                                                    
                                                                        <input type="search" class="form-control searchSection" placeholder="Search Your Courses" id="searchInput">
                                                                    </form>
                                                                </div>
                                                                
                                                                {{-- <div class="col-12 col-md-6 col-lg-3 mt-2 mt-lg-0">
                                                                    <select class="form-select mb-1" aria-label="Default select example">
                                                                        <option selected>Date Created</option>
                                                                        <option value="Newest">Newest</option>
                                                                        <option value="Award">Award</option>

                                                                     
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
                                                        {{-- pass --}}
                                                        <div class="tab-pane fade show active" id="note5" role="tabpanel" aria-labelledby="pass">
                                                            <div class="table-responsive">
                                                                <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentListRemark"  width="100%">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>Sr .</th>
                                                                            <th>Name</th>
                                                                            <th>Course</th>
                                                                            <th>Enrolled</th>
                                                                            {{-- <th>Exam Status</th> --}}
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        {{-- <tr>
                                                                            <td>
                                                                                <a href="" class="d-flex align-items-center">
                                                                                    <img src="{{ asset('frontend/images/avatar/avatar-3.jpg')}}" alt="" class="rounded-circle avatar-md me-2" >
                                                                                    <h5 class="mb-0 color-blue">Guy Hawkins</h5>
                                                                                </a>
                                                                            </td>
                                                                            <td class="text-wrap-title">	Award in Recruitment and Employee Selection
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="me-2"><span>80%</span></div>
                                                                                    <div class="progress w-100" style="height: 6px">
                                                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>3/12/2020</td>
                            
                                                                            <td><span class="badge bg-success">Pass</span></td>
                                                                            <td><span class="badge bg-success">75%</span></td>
                                                                        </tr> --}}
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        {{-- pending --}}
                                                        <div class="tab-pane fade" id="note7" role="tabpanel" aria-labelledby="pending">
                                                            <div class="table-responsive">
                                                                <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentList"  width="100%">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>Sr .</th>
                                                                            <th>Name</th>
                                                                            <th>Course</th>
                                                                            <th>Exam</th>
                                                                            <th>Submitted Date</th>
                                                                            {{-- <th>Exam Status</th> --}}
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody >
                                                                        {{-- <tr>
                                                                            <td>
                                                                                <a href="{{route('e-mentor-students-exam-details')}}" class="d-flex align-items-center">
                                                                                    <img src="{{ asset('frontend/images/avatar/avatar-5.jpg')}}" alt="" class="rounded-circle avatar-md me-2" >
                                                                                    <h5 class="mb-0 color-blue">Guy Hawkins</h5>
                                                                                </a>
                                                                            </td>
                                                                            <td>	Award in Recruitment and Employee Selection
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="me-2"><span>11%</span></div>
                                                                                    <div class="progress w-100" style="height: 6px">
                                                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 11%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>3/12/2020</td>
                            
                                                                            <td><span class="badge bg-warning">Pending</span></td>
                                                                        </tr> --}}
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        {{-- checking --}}
                                                        <div class="tab-pane fade" id="checking" role="tabpanel" aria-labelledby="checking-tab">
                                                            <div class="table-responsive">
                                                                <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentList"  width="100%">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>Sr .</th>
                                                                            <th>Name</th>
                                                                            <th>Course</th>
                                                                            <th>Exam</th>
                                                                            <th>Enrolled</th>
                                                                            {{-- <th>Exam Status</th> --}}
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody >
                                                                        {{-- <tr>
                                                                            <td>
                                                                                <a href="{{route('e-mentor-students-exam-details')}}" class="d-flex align-items-center">
                                                                                    <img src="{{ asset('frontend/images/avatar/avatar-5.jpg')}}" alt="" class="rounded-circle avatar-md me-2" >
                                                                                    <h5 class="mb-0 color-blue">Guy Hawkins</h5>
                                                                                </a>
                                                                            </td>
                                                                            <td>	Award in Recruitment and Employee Selection
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="me-2"><span>11%</span></div>
                                                                                    <div class="progress w-100" style="height: 6px">
                                                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 11%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>3/12/2020</td>
                            
                                                                            <td><span class="badge bg-warning">Pending</span></td>
                                                                        </tr> --}}
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        {{-- fail --}}
                                                        <div class="tab-pane fade" id="note6" role="tabpanel" aria-labelledby="fail">
                                                            <div class="table-responsive">
                                                                <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentListRemark"  width="100%">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>Sr .</th>
                                                                            <th>Name</th>
                                                                            <th>Course</th>
                                                                            <th>Enrolled</th>
                                                                            {{-- <th>Exam Status</th> --}}
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody >
                                                                        {{-- <tr>
                                                                            <td>
                                                                                <a href="{{route('e-mentor-students-exam-details')}}" class="d-flex align-items-center">
                                                                                    <img src="{{ asset('frontend/images/avatar/avatar-5.jpg')}}" alt="" class="rounded-circle avatar-md me-2" >
                                                                                    <h5 class="mb-0 color-blue">Guy Hawkins</h5>
                                                                                </a>
                                                                            </td>
                                                                            <td>	Award in Recruitment and Employee Selection
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="me-2"><span>11%</span></div>
                                                                                    <div class="progress w-100" style="height: 6px">
                                                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 11%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>3/12/2020</td>
                            
                                                                            <td><span class="badge bg-warning">Pending</span></td>
                                                                        </tr> --}}
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>


                                                    </div>
                                                  <div class="pt-2 pb-4">
                                                    <!-- Pagination -->
                                                    {{-- <nav>
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
                                                    </nav> --}}
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                </div>
            {{-- </div> --}}
        </div>
    </section>
</main>
<script>
$(document).ready(function () {
    // studentList(0);
    studentListRemark(btoa(3));

    $("#pass").on("click", function (event) {
        studentListRemark(btoa(3));
    });
    $("#fail").on("click", function (event) {
        studentListRemark(btoa(2));
    });
    $("#checking-tab").on("click", function (event) {
        studentList(btoa(1));
    });
    $("#pending").on("click", function (event) {
        studentList(btoa(0));
    });
});
// $('#checkAll').click(function (e) {
//     $('.studentListRemark tbody :checkbox').prop('checked', $(this).is(':checked'));
//     e.stopImmediatePropagation();
// });

$(".dataTables_filter").css("display", "none");
function studentListRemark(token) {
    var baseUrl = window.location.origin + "/";
    $(".studentListRemark").DataTable().destroy();
    // $(".loader").removeClass("d-none");
    $.ajax({
        url: baseUrl + "ementor/get-e-mentor-students-exam/" + token,
        method: "GET",
        success: function (data) {

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
                                // var img =  baseUrl + "storage/studentDocs/student-profile-photo.png"; 
                                
                                var img = data.photo ? baseUrl + 'storage/' + data.photo : baseUrl + 'storage/studentDocs/student-profile-photo.png';
                                var url =  baseUrl + "ementor/e-mentor-students-exam-details/"+user_id+"/"+course_id; 
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
                        render: function (row) {
                             var course_title = row.course_title;
                             return '<p class="e-mentor-text-wrap-title">' + course_title + '</p>';
                        },
                    },

                    {
                        data: null,
                        render: function (row) {
                            return row.course_start_date;

                        }

                    },
                    // {
                    //     data: null,
                    //     render: function (data, type, full, row) {
                    //         if(data != ''){
                    //             if(data.exam_remark == '0'){
    
                    //                 return `<span class="badge bg-danger">Fail</span>`;
                    //             }else{
                                    
                    //                 return `<span class="badge bg-success">Pass</span>`;
                    //             }
                    //         }else{
                                
                    //             return `<span class="badge bg-danger">Pending</span>`;
                    //         }
                    //     },
                    // },
              
                    // Add more columns as needed
                ],            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}
function studentList(token) {
    var baseUrl = window.location.origin + "/";
    $(".studentList").DataTable().destroy();
    // $(".loader").removeClass("d-none");

    $.ajax({
        url: baseUrl + "ementor/get-e-mentor-students-exam/" + token,
        method: "GET",
        success: function (data) {
            
            $(".loader").addClass("d-none");
            
            
            $(".studentList").DataTable({
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
                        render: function (row) {
                            if(row){
                                if(row){

                                    var fname = row.name;
                                    var last_name = row.last_name;
                                }else{
                                    var fname = '';
                                    var last_name = '';

                                }
                                var photo = row.photo;
                                var user_id = btoa(row.user_id);
                                var course_id = btoa(row.id);
                                
                                // var img =  baseUrl + "storage/studentDocs/student-profile-photo.png"; 
                                var img = row.photo ? baseUrl + 'storage/' + row.photo : baseUrl + '/storage/studentDocs/student-profile-photo.png';
                                var url =  baseUrl + "ementor/e-mentor-students-exam-details/"+user_id+"/"+course_id; 
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
                        render: function (row) {
                             var course_title = row.course_title;
                             return '<p class="e-mentor-text-wrap-title">' + course_title + '</p>';
                        },
                    },
                    // {
                    //     data: null,
                    //     render: function (row) {
                    //          var exam_type = row.exam_type;
                             
                    //          if(row.exam_type == '1'){
                    //             var exam_id = btoa(row.exam_id);
                    //             var user_id = btoa(row.user_id);
                    //             if(row.is_cheking_completed != '2' ){
                    //                 var url = baseUrl + "ementor/answersheet/" + exam_id + "/" + btoa(1) + "/" + user_id;
                    //                 return '<a href="' + url + '">Assignment</a>';
                    //             }else{
                    //                 return 'Assignment';
                    //             }
                    //          }else if(row.exam_type == '2'){
                    //             var exam_id = btoa(row.exam_id);
                    //             var user_id = btoa(row.user_id);
                    //             if(row.is_cheking_completed != '2' ){
                    //                 var url = baseUrl + "ementor/answersheet/" + exam_id + "/" + btoa(2) + "/" + user_id;
                    //                 return '<a href="' + url + '">Mock</a>';
                    //             }else{
                    //                 return 'Mock';
                    //             }
                    //          }else if(row.exam_type == '3'){
                    //             var exam_id = btoa(row.exam_id);
                    //             var user_id = btoa(row.user_id);
                    //             if(row.is_cheking_completed != '2' ){
                    //                 var url = baseUrl + "ementor/answersheet/" + exam_id + "/" + btoa(3) + "/" + user_id;
                    //                 return '<a href="' + url + '">Vlog</a>';
                    //             }else{
                    //                 return 'Vlog';
                    //             }
                    //          }else if(row.exam_type == '4'){
                    //             var exam_id = btoa(row.exam_id);
                    //             var user_id = btoa(row.user_id);
                    //             if(row.is_cheking_completed != '2' ){
                    //                 var url = baseUrl + "ementor/answersheet/" + exam_id + "/" + btoa(4) + "/" + user_id;
                    //                 return '<a href="' + url + '">Peer Review</a>';
                    //             }else{
                    //                 return 'Peer Review';
                    //             }
                    //          }else if(row.exam_type == '5'){
                    //             var exam_id = btoa(row.exam_id);
                    //             var user_id = btoa(row.user_id);
                    //             if(row.is_cheking_completed != '2' ){
                    //                 var url = baseUrl + "ementor/answersheet/" + exam_id + "/" + btoa(5) + "/" + user_id;
                    //                 return '<a href="' + url + '">Forum Leadership</a>';
                    //             }else{
                    //                 return 'Forum Leadership';
                    //             }
                    //          }else if(row.exam_type == '6'){
                    //             var exam_id = btoa(row.exam_id);
                    //             var user_id = btoa(row.user_id);
                    //             if(row.is_cheking_completed != '2' ){
                    //                 var url = baseUrl + "ementor/answersheet/" + exam_id + "/" + btoa(6) + "/" + user_id;
                    //                 return '<a href="' + url + '">Reflective Journal</a>';
                    //             }else{
                    //                 return 'Reflective Journal';
                    //             }
                    //          }
                    //     },
                    // },
                    {
                        data: null,
                        render: function (row) {

                            var exam_id = btoa(row.exam_id);
                            var user_id = btoa(row.user_id);
                            var exam_type = row.exam_type;
                            var exam_title = row.exam_title;
                            var student_course_master_id = btoa(row.student_course_master_id);

                            var baseUrl = "answersheet/" + exam_id + "/" + btoa(row.exam_type) + "/" + user_id + "/" + student_course_master_id;

                            if (row.is_cheking_completed != '2') {
                                return '<a href="' + baseUrl + '">' + exam_title + '</a>';
                            } else {
                                return exam_title;
                            }
                        },
                    },
                    {
                        data: null,
                        render: function (row) {
                            
                            var created_at ='';
                            // if(row.exam_status[0]['exam_student'] != ''){
                            //     var arr = row.exam_status[0]['exam_student'][0];
                            //     if(arr != ''){
                            //         var created_at = arr['created_at'];
                            //     }
                            // }
                            const dateTimeStr = row.created_at;
                            return `${dateTimeStr}`;


                        }

                    },
                    // {
                    //     data: null,
                    //     render: function (data, type, full, row) {
                            
                    //         if(data.is_cheking_completed != '2' ){
                    //             return `<span class="badge bg-warning">Pending</span>`;
                    //         }else{
                    //             return `<span class="badge bg-warning">Checking</span>`;
                    //         }
                    //     },
                    // },
              
                    // Add more columns as needed
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

$('.searchSection').on('keyup', function() {
    var table = $('.studentList').DataTable();
    var searchTerm = $(this).val();
    table.search(searchTerm).draw();
});

    $('#searchInput').on('input', function() {
        var table = $('.studentListRemark').DataTable();
        var table1 = $('.studentList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
        table1.search(searchTerm).draw();
    });
</script>

@endsection