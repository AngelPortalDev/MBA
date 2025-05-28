@extends('frontend.master')
@section('content')

<style>
    .sidenav.navbar .navbar-nav .e-men-3 > .nav-link {
    background-color: var(--gk-gray-200);
}
.dataTables_filter{
    display: none;;
    }
</style>

<main>
    <section class="pt-5 pb-5">
        <div class="container">
            
            <!-- Top Menubar -->
            @include('frontend.sub-ementor.layout.sub-e-mentor-common')

            <!-- Content -->

            {{-- <div class="row mt-0 mt-md-4"> --}}

                {{-- Left menubar  --}}

                <div class="col-lg-9 col-md-8 col-12">
                    <!-- Card -->
                    <div class="card mb-4">
                        <!-- Card body -->
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">Students</h3>
                                <span>Meet students taking your course.</span>
                            </div>

                        </div>
                    </div>
                    <!-- Tab content -->

                        <!-- Tab pane -->
                            <div class="card">
                                <div class="card-header border-bottom-0">
                                    <div>
                                        <div>
                                            <form class="row gx-3">
                                                <div class="col-lg-9 col-md-7 col-12 mb-lg-0 mb-2">
                                                    <input type="search" class="form-control searchStudent" placeholder="Search by name" id="searchInput">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                  
                                </div>
                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered text-nowrap studentListRemark w-100">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Name</th>
                                                <th>Course</th>
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
            {{-- </div> --}}
        </div>
    </section>
</main>

<script>
    $('.searchStudent').on('keyup', function() {
        var table = $('.studentListRemark').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
    $(document).ready(function () {
        assignedCourseList();
    });

    function assignedCourseList(){
        $(".dataTables_filter").css('display','none');
        var baseUrl = window.location.origin;  
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var userRole = "{{ Auth::user()->role }}";
        
        let url;
        if (userRole === 'instructor') {
            url = baseUrl + "/ementor/get-all-students-list/";
        } else if (userRole === 'admin' || userRole === 'superadmin') {
            url = baseUrl + "/admin/get-all-students-list/";
        } 
        $.ajax({
            url: url,
            method: 'GET',
            success: function (data) {
                

                // $(".loader").addClass("d-none");
                const subEmentorsData = data.subEmentors;
                $(".studentListRemark").DataTable({
                    data: data.studentData, // Pass
                    
                    
    
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
                                        var scmId = btoa(course.scmId);
                                        
                                        const courseUrl = `/ementor/e-mentor-students-exam-details/${userId}/${courseId}/${scmId}`;
                                        courseTitles.push(`${index + 1}. <a href="${courseUrl}">${course.course_title}</a>`);

                                        if (index < row.allPaidCourses.length - 1) {
                                            courseTitles.push('<hr>');
                                        }
                                    });
                                }
                                return courseTitles.join('');

                            },
                            width: '30%',
                        },
                        {
                            data: null,
                            render: function(row) {
                                var purchaseDates = [];
                                let badge = '';
                                if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                    
                                    row.allPaidCourses.forEach(function(course, index) {
                                        purchaseDates += `${course.course_start_date}`;
                                        
                                        if (index < row.allPaidCourses.length - 1) {
                                            purchaseDates += '<hr>';
                                        }
                                    });
                                }
                                return purchaseDates;

                            },
                            width: '30%',
                        },
                        {
                            data: null,
                            render: function(row) {
                                
                                var courseTitles = [];
                                let badge = '';
                                if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                    row.allPaidCourses.forEach(function(course, index) {
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

                                        courseTitles += `${badge}`;
                                        if (index < row.allPaidCourses.length - 1) {
                                            courseTitles += '<hr>';
                                        }

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
        var table = $('.studentListRemark').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });

</script>
@endsection