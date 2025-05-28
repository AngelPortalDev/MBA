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
            {{-- @include('frontend.teacher.layout.e-mentor-common') --}}
            @if (Auth::user()->role === 'instructor')
                @include('frontend.teacher.layout.e-mentor-common')
            @elseif (Auth::user()->role === 'sub-instructor')
                @include('frontend.sub-ementor.layout.sub-e-mentor-common')
            @endif
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
                                                    @if (Auth::user()->role !== 'sub-instructor')
                                                        <li class="nav-item" role="presentation">
                                                            <a class="nav-link {{ Auth::user()->role === 'instructor' ? 'active' : '' }}" id="pass" data-bs-toggle="tab" href="#note5" role="tab" aria-controls="note5" aria-selected="false">Pass</a>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <a class="nav-link" id="fail" data-bs-toggle="tab" href="#note6" role="tab" aria-controls="note6" aria-selected="false">Fail</a>
                                                        </li>
                                                    @endif
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link {{ Auth::user()->role === 'sub-instructor' ? 'active' : '' }}" id="checking-tab" data-bs-toggle="tab" href="#checking" role="tab" aria-controls="checking" aria-selected="false">Checking</a>
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
                                                <div class="tab-pane fade {{ Auth::user()->role === 'instructor' ? 'show active' : '' }}" id="note5" role="tabpanel" aria-labelledby="pass">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentListRemark"  width="100%">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>Sr .</th>
                                                                    <th>Name</th>
                                                                    <th>Course</th>
                                                                    <th>Enrolled</th>
                                                                    <th>Certificate</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                {{-- fail --}}
                                                <div class="tab-pane fade" id="note6" role="tabpanel" aria-labelledby="fail">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentListRemarkFail"  width="100%">
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
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                {{-- checking --}}
                                                <div class="tab-pane fade {{ Auth::user()->role === 'sub-instructor' ? 'show active' : '' }}" id="checking" role="tabpanel" aria-labelledby="checking-tab">
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
                                                            <tbody>
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
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-2 pb-4">
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
    var userRole = "{{ Auth::user()->role }}";
    if(userRole === 'sub-instructor'){
        studentList(btoa(1));
    }else{
        studentListRemark(btoa(3));
    }

    $("#pass").on("click", function (event) {
        studentListRemark(btoa(3));
    });
    $("#fail").on("click", function (event) {
        studentListRemarkFail(btoa(2));
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
            $(".studentListRemark").DataTable().destroy();
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
                                var student_course_master_id = btoa(data.student_course_master_id);
                                
                                var img = data.photo ? baseUrl + 'storage/' + data.photo : baseUrl + 'storage/studentDocs/student-profile-photo.png';
                                var url =  baseUrl + "ementor/e-mentor-students-exam-details/"+user_id+"/"+course_id+"/"+student_course_master_id; 
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
                   {
                        data: null,
                        render: function (row) {
                              var student_course_master_id = btoa(row.student_course_master_id);
                              var cert_file = baseUrl + 'storage/'+row.cert_file;
                             if (row.cert_file != null && row.cert_file != 0) {
                                 return '<a href="'+cert_file+'" target="_blank">View</a>';
                             }else{
                                 return '<button class="btn btn-success btn-sm genCert" data-student_id="'+student_course_master_id+'"> Generate</button>';
                             }
                            
                        },
                    },
              
                    // Add more columns as needed
                ],            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}

function studentListRemarkFail(token) {
    
    var baseUrl = window.location.origin + "/";
    $(".studentListRemarkFail").DataTable().destroy();
    // $(".loader").removeClass("d-none");
    $.ajax({
        url: baseUrl + "ementor/get-e-mentor-students-exam/" + token,
        method: "GET",
        success: function (data) {

            // $(".loader").addClass("d-none");
            $(".studentListRemarkFail").DataTable().destroy();
            $(".studentListRemarkFail").DataTable({
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
                                var student_course_master_id = btoa(data.student_course_master_id);
                                
                                var img = data.photo ? baseUrl + 'storage/' + data.photo : baseUrl + 'storage/studentDocs/student-profile-photo.png';
                                var url =  baseUrl + "ementor/e-mentor-students-exam-details/"+user_id+"/"+course_id+"/"+student_course_master_id; 
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
                ],            
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}
function studentList(token) {
    var baseUrl = window.location.origin + "/";
    // $(".loader").removeClass("d-none");

    $.ajax({
        url: baseUrl + "ementor/get-e-mentor-students-exam/" + token,
        method: "GET",
        success: function (data) {
            
            $(".loader").addClass("d-none");
            
            
            $(".studentList").DataTable().destroy();
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
                                var student_course_master_id = btoa(row.student_course_master_id);
                                
                                var img = row.photo ? baseUrl + 'storage/' + row.photo : baseUrl + '/storage/studentDocs/student-profile-photo.png';
                                var url =  baseUrl + "ementor/e-mentor-students-exam-details/"+user_id+"/"+course_id+"/"+student_course_master_id; 
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
                        render: function (row) {
                             var course_title = row.course_title;
                             return '<p class="e-mentor-text-wrap-title">' + course_title + '</p>';
                        },
                    },
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
                            const dateTimeStr = row.created_at;
                            return `${dateTimeStr}`;


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

$('.searchSection').on('keyup', function() {
    var table = $('.studentList').DataTable();
    var searchTerm = $(this).val();
    table.search(searchTerm).draw();
});

    $('#searchInput').on('input', function() {
        var table = $('.studentListRemark').DataTable();
        var table1 = $('.studentList').DataTable();
        var table2 = $('.studentListRemarkFail').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
        table1.search(searchTerm).draw();
        table2.search(searchTerm).draw();
    });
</script>

@endsection