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
                            All Courses
                            <span class="fs-5 courseCount"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Courses</a></li>
                                <!-- <li class="breadcrumb-item active" aria-current="page">All Admin</li> -->
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">


                    </div>
                </div>
            </div>
            
            <form id="exportForm" action="{{ route('export') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="where" value="">
                <input type="hidden" name="export" value="courseData">
            </form>

            <!-- <form class="d-flex align-items-center col-12 col-lg-3"> -->
            <div class="col-lg-8 col-12 text-end pt-2 mb-0 mb-sm-3">
                <div class="d-sm-flex justify-content-sm-end">
                    <!-- Button With Icon -->
                    <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                        {{-- <a> --}}
                            <a type="button" class="btn btn-primary"  href="{{route('admin.course.add-course')}}">
                                Create <i class="fe fe-plus ms-1"></i>
                            </a>
                            {{-- </a> --}}
                    </div>
                    {{-- <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                        <button type="button" class="btn btn-outline-primary ">
                            Delete <i class="fe fe-trash ms-1"></i>
                        </button>
                    </div>
                    <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                        <button type="button" class="btn btn-outline-primary ">
                            Import <i class="fe fe-download ms-1"></i>
                        </button>
                    </div>
                    <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                        <a href="#" id="exportButton" data-route="{{ route('export') }}" class="btn btn-outline-primary">
                            Export <i class="fe fe-upload ms-1"></i>
                        </a>
                    </div> --}}
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 mt-3 mt-md-0">
                <!-- Card -->
                <div class="card rounded-3">
                    <!-- Card Header -->
                    <div class="p-4 row">
                        <div class="card-header p-0 col-12 col-md-7 col-lg-7">
                            <ul class="nav nav-lb-tab border-bottom-0" id="tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active section-course-tab cursor-pointer">All</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-course-tab" data-cat="3" data-action='status'  data-bs-toggle="pill" href="#all-course"
                                    role="tab" aria-controls="all-course" aria-selected="true">Publish</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-course-tab"  data-cat="2" data-action='status'  data-bs-toggle="pill" href="#all-course"
                                    role="tab" aria-controls="all-course" aria-selected="true">Unpublish</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-course-tab"  data-cat="1" data-action='category'  data-bs-toggle="pill" href="#all-course"
                                    role="tab" aria-controls="all-course" aria-selected="true">Award</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-course-tab" data-cat="2"  data-action='category'  data-bs-toggle="pill" href="#all-course"
                                    role="tab" aria-controls="all-course" aria-selected="true">Certificate</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-course-tab" data-cat="3" data-action='category' data-bs-toggle="pill" href="#all-course"
                                    role="tab" aria-controls="all-course" aria-selected="true" >Diploma</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-course-tab" data-cat="4"  data-action='category' data-bs-toggle="pill" href="#all-course"
                                    role="tab" aria-controls="all-course" aria-selected="true">Masters</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-course-tab" data-cat="1" data-action='status' data-bs-toggle="pill" href="#all-course"
                                    role="tab" aria-controls="all-course" aria-selected="true">Draft</a>
                                </li>
                            </ul>
                        </div>


                        <!-- Form -->


                        <div class="d-flex align-items-center col-12 col-md-5 col-lg-5 justify-content-end border-bottom">
                            <div class="row justify-content-end">
                                <form class="d-flex align-items-center col-lg-12 col-md-12 col-sm-12 mt-2 mt-md-0 mb-2 mb-md-0">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-6 searchCourse" placeholder="Search Here" id="searchInput">
                                </form>


                                <!-- input -->
                                <div class="col-lg-6 col-md-12 col-sm-12 mt-2 mt-lg-0 mb-2 mb-md-0" style="display: none;">
                                    <!-- form select -->
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected="">Filter</option>
                                        <option value="Newest">Newest</option>
                                        <option value="Price: High-Low">Publish</option>
                                        <option value="Price: Low-High">Unpublish</option>
                                        <option value="Price: Low-High">Award</option>
                                        <option value="Price: Low-High">Certificate</option>
                                        <option value="Price: Low-High">Diploma</option>
                                        <option value="Price: Low-High">Masters</option>
                                    </select>
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
                                    <table class="table mb-0 text-nowrap table-centered table-hover all_course_list" width="100%">
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
                                                <th>Category</th>
                                                <th>E-mentor</th>
                                                <th>Status</th>
                                                <th>Enrolled</th>
                                                <th>Action</th>
                                                 
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        {{-- <tbody>
                                            <tr>
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
                                                            <div class="ms-3">
                                                                <h4 class="mb-1 text-primary-hover">Masters of Arts in Human Resource Management</h4>
                                                                <span>Added on 7 July, 2023</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td><span class="badge bg-info-soft">Masters</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src=" assets/images/avatar/avatar-7.jpg" alt=""
                                                            class="rounded-circle avatar-xs me-2">
                                                        <h5 class="mb-0">Reva Yokk</h5>
                                                    </div>
                                                </td>
                                                
                                                <td><span class="badge bg-success">Publish</span></td>
                                                <td>12,877</td>
                                                <td>
                                                    <div class="hstack gap-3">
                                                        <!--   -->
                                                        <a href="course-add.php" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
                                                        <a href="#" data-bs-toggle="tooltip" data-placement="top" aria-label="Delete" data-bs-original-title="Delete"><i class="fe fe-trash"></i></a>
                                                        <span class="dropdown dropstart">
                                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                <i class="fe fe-more-vertical"></i>
                                                            </a>
                                                            <span class="dropdown-menu">
                                                                <span class="dropdown-header">Settings</span>
                                                                <a class="dropdown-item" href="#">
                                                                    <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>
                                                                    Active
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>
                                                                    Inactive
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-mail dropdown-item-icon"></i>
                                                                    Mail
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-move dropdown-item-icon"></i>
                                                                    Move
                                                                </a>

                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
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
                                                            <div class="ms-3">
                                                                <h4 class="mb-1 text-primary-hover">Award in Recruitment and Employee Selection</h4>
                                                                <span>Added on 7 July, 2023</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td><span class="badge bg-info-soft">Award</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src=" assets/images/avatar/avatar-7.jpg" alt=""
                                                            class="rounded-circle avatar-xs me-2">
                                                        <h5 class="mb-0">Reva Yokk</h5>
                                                    </div>
                                                </td>
                                                
                                                <td><span class="badge bg-danger">Unpublish</span></td>

                                                <td>-</td>

                                                <td>
                                                    <div class="hstack gap-3">
                                                        <!--   -->
                                                        <a href="course-add.php" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
                                                        <a href="#" data-bs-toggle="tooltip" data-placement="top" aria-label="Delete" data-bs-original-title="Delete"><i class="fe fe-trash"></i></a>
                                                        <span class="dropdown dropstart">
                                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                <i class="fe fe-more-vertical"></i>
                                                            </a>
                                                            <span class="dropdown-menu">
                                                                <span class="dropdown-header">Settings</span>
                                                                <a class="dropdown-item" href="#">
                                                                    <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>
                                                                    Active
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>
                                                                    Inactive
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-mail dropdown-item-icon"></i>
                                                                    Mail
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-move dropdown-item-icon"></i>
                                                                    Move
                                                                </a>

                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
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
                                                            <div class="ms-3">
                                                                <h4 class="mb-1 text-primary-hover">Award in Recruitment and Employee Selection</h4>
                                                                <span>Added on 7 July, 2023</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td><span class="badge bg-info-soft">Award</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src=" assets/images/avatar/avatar-7.jpg" alt=""
                                                            class="rounded-circle avatar-xs me-2">
                                                        <h5 class="mb-0">Reva Yokk</h5>
                                                    </div>
                                                </td>
                                                
                                                <td><span class="badge bg-warning">Draft</span></td>
                                                
                                                <td>-</td>

                                                <td>
                                                    <div class="hstack gap-3">
                                                        <!--   -->
                                                        <a href="course-add.php" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
                                                        <a href="#" data-bs-toggle="tooltip" data-placement="top" aria-label="Delete" data-bs-original-title="Delete"><i class="fe fe-trash"></i></a>
                                                        <span class="dropdown dropstart">
                                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                <i class="fe fe-more-vertical"></i>
                                                            </a>
                                                            <span class="dropdown-menu">
                                                                <span class="dropdown-header">Settings</span>
                                                                <a class="dropdown-item" href="#">
                                                                    <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>
                                                                    Active
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>
                                                                    Inactive
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-mail dropdown-item-icon"></i>
                                                                    Mail
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-move dropdown-item-icon"></i>
                                                                    Move
                                                                </a>

                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody> --}}
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
$(document).ready(function () {
    AllCourseList('all');
    handleSearchInput('searchInput',function(){
        AllCourseList("all");
    });

});
$('#checkAll').click(function (e) {
    $('.all_course_list tbody :checkbox').prop('checked', $(this).is(':checked'));
    e.stopImmediatePropagation();
});
function AllCourseList(cat, action) {
    // $(".dataTables_filter").css('display','none');
    var baseUrl = window.location.origin + "/";
    // $.ajax({
    //     url: baseUrl + "admin/course-get-data/" + cat + "/" + action,
    //     method: "GET",
    //     success: function (data) {
    //         $(".courseCount").html("(" + data.length + ")");
    //         $(".all_course_list").DataTable().destroy();
    //         $(".all_course_list").DataTable({
    //             data: data, // Pass
    //             columns: [
    //                 {
    //                     data: "id",
    //                     render: function (data, type, full, meta) {
    //                         var isChecked = data.checked ? "" : "";
    //                         return (
    //                             '<input type="checkbox"  data-id=' +
    //                             data +
    //                             ' class="form-check-input checkbox sub_chk" ' +
    //                             isChecked +
    //                             ">"
    //                         );
    //                     },
    //                 },
    //                 {
    //                     data: null,
    //                     render: function (data, type, full, meta) {
    //                         var autoincrement_no = meta.row + 1;
    //                         return autoincrement_no;
    //                     },
    //                 },
    //                 {
    //                     data: null,
    //                     render: function (data) {
    //                         var name = data.course_title;
    //                         var created_at = data.created_at;
    //                         return (
    //                             "<a href='course-edit' class='text-inherit'><div class='d-flex align-items-center'><div></div><div class='text-wrap-title'><h4 class='mb-1 text-primary-hover'>" +
    //                             name +
    //                             "</h4><span>" +
    //                             created_at +
    //                             "</span></div></div></a>"
    //                         );
    //                     },
    //                 },
    //                 {
    //                     data: null,
    //                     render: function (data) {
    //                         category_name = '';
    //                         if(data.category){
    //                             category_name = data.category.category_name;
    //                         }
    //                             return (
    //                                 '<span class="badge bg-info-soft">' +
    //                                 category_name +
    //                                 "</span>"
    //                             );
                            
    //                     },
    //                 },
    //                 {
    //                     data: null,
    //                     render: function (data) {
    //                         if(data.ementor){
    //                             var instructor =
    //                                 data.ementor.name +
    //                                 " " +
    //                                 data.ementor.last_name;
    //                             var img = data.ementor.photo
    //                                 ? baseUrl + "storage/" + data.ementor.photo
    //                                 : baseUrl + "/storage/instructor_no_img.png";
    //                         }else{
    //                             var instructor = 'Not Assigned';
    //                             var img = baseUrl + "storage/ementorDocs/e-mentor-profile-photo.png";

    //                         }

    //                         // var img = baseUrl+ row.created_at;
    //                         return (
    //                             "<div class='d-flex align-items-center'><img src='" +
    //                             img +
    //                             "' alt='' class='rounded-circle avatar-xs me-2'><h5 class='mb-0'>" +
    //                             instructor +
    //                             "</h5></div>"
    //                         );
    //                     },
    //                 },
    //                 {
    //                     data:null,
    //                     render: function (data) {
    //                         var status = data.status;
    //                             if (status == 1) {
    //                                 return '<span class="badge text-warning bg-light-warning">Draft</span>';
    //                             }
    //                             if (status == 2) {
    //                                 return '<span class="badge text-danger bg-light-danger">Unpublish</span>';
    //                             }
    //                             if (status == 3) {
    //                                 return '<span class="badge text-success bg-light-success">Publish</span>';
    //                             }
                         
    //                     },
    //                 },
    //                 {
    //                     data: null,
    //                     render: function (data) {
    //                         var joined = data.is_enrolled;
    //                         return joined;
    //                     },
    //                 },
    //                 {
    //                     data: null,
    //                     render: function (row) {
    //                         var CourseId = btoa(row.id);
    //                                 var action = btoa("edit");
    //                                 // var editUrl ="#";
    //                                 if (row.category_id == "1") {
    //                                     var editUrl =
    //                                         baseUrl +
    //                                         "admin/award-course-get-data/" +
    //                                         CourseId +
    //                                         "/" +
    //                                         action;
    //                                 }else{
    //                                     var editUrl =
    //                                     baseUrl +
    //                                     "admin/course-editview/" +
    //                                     CourseId +
    //                                     "/" +
    //                                     action;
    //                                 }
    //                                 // }
    //                                 var Action =
    //                                     '<div class="hstack gap-3"><a href="' +
    //                                     editUrl +
    //                                     '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a> <span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
    //                                     // <a href="javascript:void(0);"  class="deleteCourse" data-course_id="'+CourseId+'" data-bs-toggle="tooltip" data-placement="top" title="Delete" ><i class="fe fe-trash"></i></a><span class="dropdown dropstart">
                                        
    //                                     if(row.status == '1'){ 
    //                                         Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_publish')+'" data-role="students" data-course_id="'+btoa(row.id)+'" data-courseall="courseall">  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Publish</a> </div>'; 
    //                                     }else{
    //                                         if(row.status == '3'){ 
    //                                             Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_unpublish')+'" data-role="students" data-course_id="'+btoa(row.id)+'" data-courseall="courseall" ><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Unpublish </a>';
    //                                             Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_draft')+'" data-role="students" data-course_id="'+btoa(row.id)+'" data-courseall="courseall">  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Draft</a> </div>'; 
    //                                         }else if(row.status == '2'){ 
    //                                             Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_publish')+'" data-role="students" data-course_id="'+btoa(row.id)+'" data-courseall="courseall">  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Publish</a>';
    //                                             Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_draft')+'" data-role="students" data-course_id="'+btoa(row.id)+'" data-courseall="courseall">  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Draft</a> </div>'; 
    //                                         } 
    //                                     } 
    //                                     return Action;
    //                     },
    //                 },
    //                 // Add more columns as needed
    //             ],
    //         });
    //     },
    //     error: function (xhr, status, error) {
    //         console.error(error);
    //     },
    // });
    $('.all_course_list').DataTable().clear().destroy();
    var table = $(".all_course_list").DataTable({
        "processing": true,
        "serverSide": true,
        'searching': true,
        "paging": true,
        "ajax": {
             "url": baseUrl + "admin/course-get-data/" + cat + "/" + action,
            "type": "GET"
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
                data:null,
                render: function (data) {
                    var status = data.status;
                        if (status == 1) {
                            return '<span class="badge text-warning bg-light-warning">Draft</span>';
                        }
                        if (status == 2) {
                            return '<span class="badge text-danger bg-light-danger">Unpublish</span>';
                        }
                        if (status == 3) {
                            return '<span class="badge text-success bg-light-success">Publish</span>';
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
                render: function (row) {
                    var CourseId = btoa(row.id);
                            var action = btoa("edit");
                            // var editUrl ="#";
                            if (row.category_id == "1") {
                                var editUrl =
                                    baseUrl +
                                    "admin/award-course-get-data/" +
                                    CourseId +
                                    "/" +
                                    action;
                            }else{
                                var editUrl =
                                baseUrl +
                                "admin/course-editview/" +
                                CourseId +
                                "/" +
                                action;
                            }
                            // }
                            var Action =
                                '<div class="hstack gap-3"><a href="' +
                                editUrl +
                                '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a> <span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
                                // <a href="javascript:void(0);"  class="deleteCourse" data-course_id="'+CourseId+'" data-bs-toggle="tooltip" data-placement="top" title="Delete" ><i class="fe fe-trash"></i></a><span class="dropdown dropstart">
                                
                                if(row.status == '1'){ 
                                    Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_publish')+'" data-role="students" data-course_id="'+btoa(row.id)+'" data-courseall="courseall">  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Publish</a> </div>'; 
                                }else{
                                    if(row.status == '3'){ 
                                        Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_unpublish')+'" data-role="students" data-course_id="'+btoa(row.id)+'" data-courseall="courseall" ><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Unpublish </a>';
                                        Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_draft')+'" data-role="students" data-course_id="'+btoa(row.id)+'" data-courseall="courseall">  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Draft</a> </div>'; 
                                    }else if(row.status == '2'){ 
                                        Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_publish')+'" data-role="students" data-course_id="'+btoa(row.id)+'" data-courseall="courseall">  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Publish</a>';
                                        Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_draft')+'" data-role="students" data-course_id="'+btoa(row.id)+'" data-courseall="courseall">  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Draft</a> </div>'; 
                                    } 
                                } 
                                return Action;
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

$('.searchCourse').on('keyup', function(){
    var table = $('.all_course_list').DataTable();
            var searchTerm = $(this).val();
            table.search(searchTerm).draw();
})


$(document).ready(function() {
    $('.section-course-tab').on('click', function() {
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        $('.nav-link').attr('aria-selected', 'false');
        $(this).attr('aria-selected', 'true');
    });
});

    </script>
@endsection
