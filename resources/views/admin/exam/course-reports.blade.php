<!-- Header import -->
@extends('admin.layouts.main')
@section('content')



    <!-- Container fluid -->
    <section class="container-fluid p-4">
        <div class="row justify-content-between ">
            <!-- Page Header -->
            <div class="col-lg-4 col-12">
                <div class=" pb-3 mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Course Reports
                            <span class="fs-5"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Course Reports</a></li>
                                <!-- <li class="breadcrumb-item active" aria-current="page">All Admin</li> -->
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">


                    </div>
                </div>
            </div>
            <!-- <form class="d-flex align-items-center col-12 col-lg-3"> -->
            <div class="col-lg-8 col-12 text-end pt-2">
                <div>
                    <!-- Button With Icon -->
                    {{-- <a href="{{route('admin.course.award-course-add')}}">
                        <button type="button" class="btn btn-primary" >
                        Create <i class="fe fe-plus ms-1"></i>
                        </button>
                    </a>
                    <button type="button" class="btn btn-outline-primary ">
                        Delete <i class="fe fe-trash ms-1"></i>
                    </button>
                    <button type="button" class="btn btn-outline-primary ">
                        Import <i class="fe fe-download ms-1"></i>
                    </button> --}}
                    {{-- <button type="button" class="btn btn-outline-primary ">
                        Export <i class="fe fe-upload ms-1"></i>
                    </button> --}}
                    <form id="exportFormWithoutFilter" action="{{ route('export') }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="where" value="">
                        <input type="hidden" name="export" value="courseReportData">
                    </form>
                            
                    <button id="exportButtonWithoutFilter" class="btn btn-outline-primary ">
                       All Export<i class="bi bi-download ms-1"></i>
                    </button>

                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Card -->
                <div class="card rounded-3">
                    <!-- Card Header -->
                    <div class="p-4 row border-bottom">
                        <div class="card-header p-0 col-12 col-md-7 col-lg-2 border-bottom-0">
                            <ul class="nav nav-lb-tab border-bottom-0 border-top-0" id="tab" role="tablist">
                                <!-- Tab items will go here -->
                            </ul>
                        </div>
                    
                        <!-- Form -->
                        <div class="col-12 col-md-8 col-lg-10 p-3">
                            <div class="row justify-content-start justify-content-lg-end d-flex">
                                <!-- Search Form -->
                                <div class="col-auto mt-2 ">
                                    <form class="d-flex align-items-center mb-0 mb-xl-2">
                                        <span class="position-absolute ps-3 search-icon">
                                            <i class="fe fe-search"></i>
                                        </span>
                                        <input type="search" class="form-control ps-6 searchCourse" id="searchInput" placeholder="Search Here">
                                    </form>
                                </div>
                    
                                <!-- Date Inputs and Export Button -->
                                <div class="col-auto d-flex align-items-center mt-2 mt-xl-0">
                                    <form id="exportForm" action="{{ route('export') }}" method="POST" class="needs-validation d-flex flex-column flex-lg-row align-items-baseline" novalidate="">
                                        @csrf
                                        <div class="me-2 mb-2 mb-lg-0">
                                            <input type="date" name="start_date" class="form-control" aria-label="Start Date" placeholder="From Date" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid start date.
                                            </div>
                                        </div>
                                        <div class="me-2 mb-2 mb-lg-0">
                                            <input type="date" name="end_date" class="form-control" aria-label="End Date" placeholder="To Date" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid end date.
                                            </div>
                                        </div>
                                        <button type="button" id="clearButton" class="btn btn-outline-secondary mb-2 mb-lg-0" style="width: max-content">
                                            Clear <i class="fe fe-x ms-1"></i>
                                        </button>
                                        <input type="hidden" name="export" value="courseReportData">
                                        <button id="exportButton" class="btn btn-outline-primary ms-2" style="white-space: nowrap">
                                            Export <i class="fe fe-upload ms-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div>
                        <div class="tab-content" id="tabContent">
                            <!-- Tab -->

                            <!-- All Course Tab  -->
                            <div class="tab-pane fade active show" id="all-course" role="tabpanel"
                                aria-labelledby="all-course-tab">
                                <div class="table-responsive border-0 overflow-y-hidden table-with-checkbox">
                                    <table class="table mb-0 text-nowrap table-centered table-hover award_course_list w-100">
                                        <thead class="table-light">
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                                        <label class="form-check-label" for="checkAll"></label>
                                                    </div>
                                                </th>
                                                <th>Sr. No.</th>
                                                <th>Course Name</th>
                                                {{-- <th>Created At</th> --}}
                                                <th>Category</th>
                                                <th>E-mentor</th>
                                                <th>Status</th>
                                                <th>Enrolled Students</th>                                                 
                                                <th>Total Students</th>                                                 

                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="postOne">
                                                        <label class="form-check-label" for="postOne"></label>
                                                    </div>
                                                </td>
                                                <td>1</td>
                                                <td>
                                                    <a href="course-edit" class="text-inherit">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <img src=" assets/images/course/masters-human-resource-management.png"
                                                                    alt="" class="img-4by3-lg rounded">
                                                            </div>
                                                            <div class="">
                                                                <h4 class="mb-1 text-primary-hover">Award of Arts in Human Resource Management</h4>
                                                                
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="">
                                                        <span>Added on 7 July, 2023</span>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-info-soft">Award</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src=" assets/images/avatar/avatar-7.jpg" alt=""
                                                            class="rounded-circle avatar-xs me-2">
                                                        <h5 class="mb-0">Sabel</h5>
                                                    </div>
                                                </td>
                                                
                                                <td><span class="badge bg-success">Publish</span></td>
                                                <td>12,877</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="postOne">
                                                        <label class="form-check-label" for="postOne"></label>
                                                    </div>
                                                </td>
                                                <td>2</td>
                                                <td>
                                                    <a href="course-edit" class="text-inherit">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <img src="assets/images/course/award-recruitment-and-employee-selection.png"
                                                                    alt="" class="img-4by3-lg rounded">
                                                            </div>
                                                            <div class="">
                                                                <h4 class="mb-1 text-primary-hover">Award in Recruitment and Employee Selection</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="">
                                                        <span>Added on 7 July, 2023</span>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-info-soft">Award</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src=" assets/images/avatar/avatar-7.jpg" alt=""
                                                            class="rounded-circle avatar-xs me-2">
                                                        <h5 class="mb-0">Iyo sky</h5>
                                                    </div>
                                                </td>
                                                
                                                <td><span class="badge bg-danger">Unpublish</span></td>

                                                <td>967</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="postOne">
                                                        <label class="form-check-label" for="postOne"></label>
                                                    </div>
                                                </td>
                                                <td>3</td>
                                                <td>
                                                    <a href="course-edit" class="text-inherit">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <img src="assets/images/course/award-recruitment-and-employee-selection.png"
                                                                    alt="" class="img-4by3-lg rounded">
                                                            </div>
                                                            <div class="">
                                                                <h4 class="mb-1 text-primary-hover">Award in Recruitment and Employee Selection</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="">
                                                        <span>Added on 7 July, 2023</span>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-info-soft">Award</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src=" assets/images/avatar/avatar-7.jpg" alt=""
                                                            class="rounded-circle avatar-xs me-2">
                                                        <h5 class="mb-0">ember moon</h5>
                                                    </div>
                                                </td>
                                                
                                                <td><span class="badge bg-warning">Draft</span></td>
                                                
                                                <td>2135</td>
                                            </tr> --}}

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Footer -->
                    {{-- <div class="card-footer">
                        <nav>
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link mx-1 rounded" href="#" tabindex="-1" aria-disabled="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                            fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z">
                                            </path>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                            fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
</main>

<script src="{{ asset('admin/js/export.js')}}"></script>
<script>
    $(document).ready(function() {
        awardCoursList("undefined");
        handleSearchInput('searchInput', awardCoursList);
    });

    $('#checkAll').click(function (e) {
        $('.award_course_list tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });

    function awardCoursList(action = '') {
        // $("#processingLoader").fadeIn();
        $(".dataTables_filter").css("display", "none");
        var baseUrl = window.location.origin + "/";
        // $.ajax({
        //     url: baseUrl + "admin/all-course-get-data/" + action,
        //     method: "GET",
        //     success: function(data) {
                
        //     $("#processingLoader").fadeOut();
        //     $(".award_course_list").DataTable().destroy();
        //     $(".counts").html("(" + data.length + ")");
        //         $(".award_course_list").DataTable({
        //             data: data.data,
                    
        //             columns: [{
        //                     data: "id",
        //                     render: function(data, type, full, meta) {
        //                         var CourseId = btoa(data);
        //                         var isChecked = full.checked ? "checked" : "";
        //                         return (
        //                             '<form class="actionData"><input type="checkbox" class="form-check-input checkbox sub_chk " name="userId[]"  data-course_ids="'+CourseId+'" value="' +
        //                             CourseId +
        //                             '" ' +
        //                             isChecked +
        //                             "></form>"
        //                         );

        //                     },
        //                     width:"5%"
        //                 },
        //                 {
        //                     data: null,
        //                     render: function(data, type, full, row) {
        //                         i = row.row + 1;
        //                         return i;
        //                     },
        //                      width:"5%"
        //                 },
        //                 {
        //                     data: null,
        //                     render: function(data) {
        //                         var name = data.course_title != '' ? data.course_title : '';
        //                         var created_at = data.created_at;
        //                         var CourseId = btoa(data.id);
        //                         var action = btoa("edit");

        //                         var editUrl =
        //                             baseUrl +
        //                             "course-details/" +
        //                             CourseId;
        //                         return (
        //                             "<a href="+editUrl+"  class='text-inherit'><div class='d-flex align-items-center'><div></div><div class=''><h4 class='mb-1 text-primary-hover text-wrap-title'>" +
        //                             name +
        //                             "</div></h4><span><small>Updated at " +
        //                             created_at +
        //                             "</small></span></div></div></a>"
        //                         );
        //                     },
        //                     width:"35%"
        //                 },
        //                 {
        //                     data: null,
        //                     render: function(data) {
        //                         if(data.category_id == '1'){
        //                             return `<span class='badge bg-info-soft'>Award</span>`;
        //                         }else if(data.category_id == '2'){

        //                             return `<span class='badge bg-info-soft'>Certificate</span>`;
        //                         }else if(data.category_id == '3'){

        //                             return `<span class='badge bg-info-soft'>Diploma</span>`;
        //                         }else if(data.category_id == '4'){
        //                             return `<span class='badge bg-info-soft'>Master</span>`;
        //                         }else if(data.category_id == '5'){
        //                             return `<span class='badge bg-info-soft'>DBA</span>`;
        //                         }
        //                         return `<span class='badge bg-info-soft'></span>`;
        //                     },
        //                     width:"10%"
        //                 },
        //                 {
        //                     data: null,
        //                     render: function(data) {
        //                         var instructor = 'Not Assigned';
        //                         var img = baseUrl + "storage/ementorDocs/e-mentor-profile-photo.png";
        //                         if (data.ementor != null) {
        //                             var emt_fname = data.ementor.name != null ? data.ementor
        //                                 .name : '';
        //                             var emt_lname = data.ementor.last_name != null ? data
        //                                 .ementor.last_name : '';
        //                             var instructor =
        //                                 emt_fname +
        //                                 " " +
        //                                 emt_lname;
        //                             var img = data.ementor.photo  ? baseUrl + 'storage/' + data.ementor.photo : baseUrl + "storage/ementorDocs/e-mentor-profile-photo.png";
        //                         }
                                
        //                         return (
        //                             "<div class='d-flex align-items-center'><img src='" +
        //                             img +
        //                             "' alt='' class='rounded-circle avatar-xs me-2'><h5 class='mb-0'>" +
        //                             instructor +
        //                             "</h5></div>"
        //                         );
        //                     },
        //                     width:"20%"
        //                 },
        //                 {
        //                     data: null,
        //                     render: function(data) {
        //                         var status = data.status;
        //                         if (status === "1") {
        //                             return "<span class='badge text-warning bg-light-warning'>Draft</span>";
        //                         }
        //                         if (status === "2") {
        //                             return '<span class="badge text-danger bg-light-danger">Unpublish</span>';
        //                         }
        //                         if (status === "3") {
        //                             return '<span class="badge text-success bg-light-success">Publish</span>';
        //                         }
        //                     },
        //                     width:"10%"
        //                 },
        //                 {
        //                     data: null,
        //                     render: function(data) {
        //                         var joined = data.is_enrolled;
        //                         return joined;
        //                     },
        //                     width:"5%"
        //                 },
                        
        //                 // {
        //                 //     data: null,
        //                 //     render: function(data) {
        //                 //         console.log(data)
        //                 //         return data !== null && data !== undefined ? data.is_enrolled : "Not Available";
        //                 //     },
        //                 //     width: "5%"
        //                 // },

        //                 // {
        //                 //     data: null,
        //                 //     render: function(row) {
        //                 //         var CourseId = btoa(row.id);
        //                 //         var action = btoa("edit");
        //                 //         // var editUrl ="#";
        //                 //         // if (status == 3) {
        //                 //             var editUrl =
        //                 //                 baseUrl +
        //                 //                 "admin/award-course-get-data/" +
        //                 //                 CourseId +
        //                 //                 "/" +
        //                 //                 action;
        //                 //         // }
        //                 //         var Action =
        //                 //             '<div class="hstack gap-3"><a href="' +
        //                 //             editUrl +
        //                 //             '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a>    <span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a> <span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
        //                 //             // <a href="javascript:void(0);"  class="deleteCourse" data-course_id="'+CourseId+'" data-bs-toggle="tooltip" data-placement="top" title="Delete" ><i class="fe fe-trash"></i></a>
                                
                                   
                                    
        //                 //             if(row.status == '1'){ 
        //                 //                 Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_publish')+'" data-role="students" data-course_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Publish</a> </div>'; 
        //                 //             }else{
        //                 //                 if(row.status == '3'){ 
        //                 //                     Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_unpublish')+'" data-role="students" data-course_id="'+btoa(row.id)+'"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Unpublish </a>';
        //                 //                     Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_draft')+'" data-role="students" data-course_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Draft</a> </div>'; 
        //                 //                 }else if(row.status == '2'){ 
        //                 //                     Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_publish')+'" data-role="students" data-course_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Publish</a>';
        //                 //                     Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_draft')+'" data-role="students" data-course_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Draft</a> </div>'; 
        //                 //                 } 
        //                 //             } 
        //                 //             return Action;
        //                 //     },
        //                 //     width:"10%"
        //                 // },
        //                 // Add more columns as needed
        //             ],
        //         });
        //     },
        //     error: function(xhr, status, error) {
        //         console.error(error);
        //     },
        // });
        $('.award_course_list').DataTable().clear().destroy();

        var table = $(".award_course_list").DataTable({
        "processing": true,
        "serverSide": true,
        'searching': true,
        "paging": true,
        "ajax": {
            "url": baseUrl + "admin/all-course-get-data/" + action,
            "type": "GET",
        },
        "columns": 
        [
            {
                data: null,
                render: function (data, type, full, meta) {
                    var isChecked = data.checked ? "" : "";
                    return (
                        '<input type="checkbox"  data-id=' +
                        data +
                        ' class="form-check-input checkbox sub_chk" ' +
                        isChecked +
                        ">"
                    );
                },
            },
            {
                data: null,
                render: function (data, type, full, meta) {
                    var autoincrement_no = meta.row + 1;
                    return autoincrement_no;
                },
            },
            {
                data: null,
                render: function (data) {
                    var name = data.course_title;
                    var created_at = data.created_at;
                    if(data.category_id == '5'){
                        var editUrl =
                                baseUrl +
                                "dba-course-details/" +
                                btoa(data.id);
                    }else if(data.category_id == '1'){
                        var editUrl =
                                baseUrl +
                                "course-details/" +
                                btoa(data.id);
                    }else {
                        var editUrl =
                                baseUrl +
                                "master-course-details/" +
                                btoa(data.id);
                    }
                    return (
                        "<a href='"+editUrl+"' class='text-inherit'><div class='d-flex align-items-center'><div></div><div class='text-wrap-title'><h4 class='mb-1 text-primary-hover'>" +
                        name +
                        "</h4><span>" +
                        created_at +
                        "</span></div></div></a>"
                    );
                },
            },
            {
                data: null,
                render: function (data) {
                    category_name = '';
                    if(data.category){
                        category_name = data.category.category_name;
                    }
                        return (
                            '<span class="badge bg-info-soft">' +
                            category_name +
                            "</span>"
                        );
                    
                },
            },
            {
                data: null,
                render: function (data) {
                    if(data.ementor){
                        var instructor =
                            data.ementor.name +
                            " " +
                            data.ementor.last_name;
                        var img = data.ementor.photo
                            ? baseUrl + "storage/" + data.ementor.photo
                            : baseUrl + "/storage/ementorDocs/e-mentor-profile-photo.png";
                    }else{
                        var instructor = 'Not Assigned';
                        var img = baseUrl + "storage/ementorDocs/e-mentor-profile-photo.png";

                    }

                    // var img = baseUrl+ row.created_at;
                    return (
                        "<div class='d-flex align-items-center'><img src='" +
                        img +
                        "' alt='' class='rounded-circle avatar-xs me-2'><h5 class='mb-0'>" +
                        instructor +
                        "</h5></div>"
                    );
                },
            },
            {
                data: null,
                render: function (data) {
                    var status = data.status;
                        if (status == 1) {
                            return '<span class="badge text-warning bg-light-warning">Draft</span>';
                        }else if (status == 2) {
                            return '<span class="badge text-danger bg-light-danger">Unpublish</span>';
                        }else if (status == 3) {
                            return '<span class="badge text-success bg-light-success">Publish</span>';
                        }else{
                            return '';
                        }
                    
                },
            },
            {
                data: null,
                render: function (data) {
                    var joined = data.is_enrolled;
                    return joined;
                },
            },
            {
                data: null,
                render: function (data) {
                    var joined = data.total_students;
                    return joined;
                },
            },
            
        ],
                                
    });
    table.on('draw', function () {
        var PageInfo = table.page.info();
        table.column(1, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
    }

    $('.searchCourse').on('keyup', function() {
        var table = $('.award_course_list').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
    $('#clearButton').on('click', function () {
        $('#exportForm')[0].reset();
        $('#exportForm input').removeClass('is-invalid');
        $('#exportForm .invalid-feedback').remove();
    });

</script>

@endsection
