@extends('frontend.master')
@section('content')

<style>
    .sidenav.navbar .navbar-nav .e-men-2 > .nav-link {
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
            @include('frontend.teacher.layout.e-mentor-common')

            <!-- Content -->

            {{-- <div class="row mt-0 mt-md-4"> --}}

                {{-- Left menubar  --}}
{{--                 
                @include('frontend.teacher.layout.e-mentor-left-menu') --}}

                <div class="col-lg-9 col-md-8 col-12">
                    <!-- Card -->
                    <div class="card mb-4">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">My Courses</h3>
                            {{-- <span>Manage your courses and its update like live, draft and insight.</span> --}}
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- Form -->
                            <form class="row gx-3">
                                <div class="col-lg-9 col-md-7 col-12 mb-lg-0 mb-2">
                                    <input type="search" class="form-control searchCourse" placeholder="Search Your Courses" id="searchInput">
                                </div>
                                {{-- <div class="col-lg-3 col-md-5 col-12"> --}}
                                    {{-- <select class="form-select">
                                        <option value="">Date Created</option>
                                        <option value="Newest">Newest</option>
                                        <option value="High Earned">High Earned</option>
                                        <option value="High Earned">Award</option> --}}
                                        {{-- <option value="High Earned">Certificate</option>
                                        <option value="High Earned">Diploma</option>
                                        <option value="High Earned">Masters</option> --}}
                                    {{-- </select> --}}
                                {{-- </div> --}}
                            </form>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive overflow-y-hidden">
                            <table class="table mb-0 text-nowrap table-hover table-centered text-nowrap assignedCourseList w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th>Courses</th>
                                        <th>Enrollments</th>
                                        {{-- <th>Exam </th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <a href="{{route('e-mentor-course-details')}}">
                                                        <img src="{{ asset('frontend/images/course/masters-human-resource-management.png')}}" alt="course" class="rounded img-4by3-lg">
                                                    </a>
                                                </div>
                                                <div class="ms-3">
                                                    <h4 class="mb-1 h5">
                                                        <a href="{{route('e-mentor-course-details')}}" class="text-inherit color-blue">Award in Training and Development</a>
                                                    </h4>
                                                    <ul class="list-inline fs-6 mb-0">
                                                        <li class="list-inline-item">
                                                            <span class="align-text-bottom">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                                                </svg>
                                                            </span>
                                                            <span>100h 30m</span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="badge bg-info-soft co-category">Award</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>11,200</td>

                                        <td>
                                            455
                                        </td>

                                    </tr> --}}

                                    {{-- <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                     <a href="{{route('e-mentor-course-details')}}"> <img src="{{ asset('frontend/images/course/award-recruitment-and-employee-selection.png')}}" alt="course" class="rounded img-4by3-lg"></a>
                                                </div>
                                                <div class="ms-3">
                                                    <h4 class="mb-1 h5">
                                                         <a href="{{route('e-mentor-course-details')}}" class="text-inherit color-blue">Award in Recruitment and Employee Selection</a>
                                                    </h4>
                                                    <ul class="list-inline fs-6 mb-0">
                                                        <li class="list-inline-item">
                                                            <span class="align-text-bottom">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                                                </svg>
                                                            </span>
                                                            <span>2h 59m</span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="badge bg-info-soft co-category">Award</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>650</td>

                                        <td>
                                            65
                                        </td>

                                    </tr> --}}
                                    {{-- <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <a href="{{route('e-mentor-course-details')}}"> <img src="{{ asset('frontend/images/course/course-gatsby.jpg')}}" alt="course" class="rounded img-4by3-lg"></a>
                                                </div>
                                                <div class="ms-3">
                                                    <h4 class="mb-1 h5">
                                                        <a href="{{route('e-mentor-course-details')}}" class="text-inherit color-blue">Award in Employee and Labour Relations</a>
                                                    </h4>
                                                    <ul class="list-inline fs-6 mb-0">
                                                        <li class="list-inline-item">
                                                            <span class="align-text-bottom">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                                                </svg>
                                                            </span>
                                                            <span>4h 10m</span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="badge bg-info-soft co-category">Award</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>4340</td>

                                        <td>
                                            434
                                        </td>

                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    </section>
</main>

<script>
    $(document).ready(function () {
        assignedCourseList('all');
    });

    $('.searchCourse').on('keyup', function() {
        var table = $('.assignedCourseList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });

    $('#clear-filter').click(function() {
        $('.assignedCourseList').DataTable().search( this.value ).draw();
    });

    // $('.searchStudent').on('keyup', function() {
    //     var table = $('.assignedStudentList').DataTable();
    //     var searchTerm = $(this).val();
    //     table.search(searchTerm).draw();
    // });
    function assignedCourseList(action){
        $(".dataTables_filter").css('display','none');
        var BaseUrl = window.location.origin;  
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
      
        // $('.assignedCourseList').DataTable().destroy();
        // $('.assignedStudentList').DataTable().destroy();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: BaseUrl + '/ementor/e-mentor-courses-list',
            method: 'GET',
            success: function(response) {
                $("#processingLoader").fadeOut();
                // const combinedData = response[0].course_module.map(course => {
                // const orders = response[0].order_module.filter(order => order.course_id == course.id);
                //     return {
                //         id: course.id,
                //         category_id: course.category_id,
                //         course_title: course.course_title,
                //         course_thumbnail_file: course.course_thumbnail_file, // Include other relevant properties
                //         order_count: orders.length,
                //         mqfeqf_level:course.mqfeqf_level,
                //         ects:course.ects
                //     };
                // });  
                let combinedData = []; // Array to hold all formatted data

                response.forEach((item, i) => {
                    // Ensure the item has the necessary properties
                    if (item.order_module && item.id) {

                        const courseSummary = {
                            id: item.id, // Base64 encode the course_id
                            category_id: item.category_id, // Use item properties
                            course_title: item.course_title, // Use item properties
                            course_thumbnail_file: item.course_thumbnail_file, // Use item properties
                            enrolledStudent: item.enrolledCount, // Number of orders
                            mqfeqf_level: item.mqfeqf_level, // Additional property
                            ects: item.ects // Additional property
                        };

                        // Add the course summary to the combined data
                        combinedData.push(courseSummary);

                        // combinedData = combinedData.concat(courseSummary);

                    }
                });
    
                // Initialize DataTable
                $('.assignedCourseList').DataTable({
                    data: combinedData,
                    columns: [
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                var img = data.course_thumbnail_file ? BaseUrl + '/storage/' + data.course_thumbnail_file :  + '';
                                var Category = 'NA';
                                    if(data.category_id == 1){
                                        Catgeory = '<span class="badge bg-info-soft co-category">Award</span>';
                                    }else if(data.category_id == 2){
                                        Catgeory = '<span class="badge bg-info-soft co-category">Certificate</span>';
                                    }else if(data.category_id == 3){
                                        Catgeory =  '<span class="badge bg-info-soft co-category">Diploma</span>';
                                    }else if(data.category_id == 4){
                                        Catgeory ='<span class="badge bg-info-soft co-category">Master</span>';
                                    }
                                    var baseUrl = window.location.origin + "/";

                                var url = baseUrl + "e-mentor-course-details/" + btoa(data.id) ;

                                return '<div class="d-flex align-items-center">' +
                                    '<div><a href="'+url+'"><img src="' + img + '" alt="course" class="rounded img-4by3-lg"></a></div>' +
                                    '<div class="ms-3">' +
                                    '<h4 class="mb-1 h5"><a href="'+url+'" class="text-inherit color-blue text-wrap-title">' + data.course_title + '</a></h4>' +
                                    '<ul class="list-inline fs-6 mb-0">' +
                                    '<li class="list-inline-item">' +
                                    '<b>MQF/EQF Level </b>: ' + (data.mqfeqf_level ? data.mqfeqf_level    : ' NA  ') +
                                    '<b>  ECTS </b> :'+ (data.ects ? data.ects       : ' NA  ') +
                                    '</li>' +
                                    '<li class="list-inline-item">'+ Catgeory + ' </li>' +
                                    '</ul></div></div>';
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                return data.enrolledStudent; // Row number starting from 1
                            }
                        },
                        // {
                        //     data: 'null',
                        //     render: function(data, type, row, meta) {
                        //         return ''; // Row number starting from 1
                        //     }
                        // }
                        // Add more columns as needed
                    ]
                });

            },
            error: function(xhr, status, error) {
                $("#processingLoader").fadeOut();
                console.error(error);
            }
        });
    }
    
    $('#searchInput').on('input', function() {
        var table = $('.assignedCourseList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
    </script>
@endsection