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
                            <span class="fs-5 counts"></span>
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


            <!-- <form class="d-flex align-items-center col-12 col-lg-3"> -->
            <div class="col-lg-8 col-12 text-end pt-2">
                <div class="d-sm-flex justify-content-sm-end">
                    <!-- Button With Icon -->
                    <a href="{{ route('admin.course.award-course-add') }}">
                        <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                            <button type="button" class="btn btn-primary">
                                Create <i class="fe fe-plus ms-1"></i>
                            </button>
                        </div>

                    </a>
                    {{-- <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                        <button type="button" class="btn btn-outline-primary deleteCourse">
                            Delete <i class="fe fe-trash ms-1"></i>
                        </button>
                    </div> --}}
                    {{-- <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                        <button type="button" class="btn btn-outline-primary ">
                            Import <i class="fe fe-download ms-1"></i>
                        </button>
                    </div>--}}
                    {{-- <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                        <a href="#" id="exportButtonWithoutFilter" class="btn btn-outline-primary">
                            Export <i class="fe fe-upload ms-1"></i>
                        </a>
                    </div>  --}}


                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 mt-3 mt-lg-0">
                <!-- Card -->
                <div class="card rounded-3">
                    <!-- Card Header -->
                    <div class="p-4 row d-flex justify-content-between">
                        <!-- Tab Navigation -->
                        <div class="d-flex flex-column flex-xxl-row justify-content-between ">
                            <div class="card-header p-0 col-12 col-xxl-4 mt-3">
                                <ul class="nav nav-lb-tab border-bottom-0" id="tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="all-course-tab" data-bs-toggle="pill" href="#all-course" role="tab" aria-controls="all-course" aria-selected="true" onclick="awardCoursList('all')">All</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="publish-course-tab" data-bs-toggle="pill" href="#all-course" role="tab" aria-controls="publish-course" aria-selected="false" tabindex="-1" onclick="awardCoursList('3')">Publish</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="unpublish-course-tab" data-bs-toggle="pill" href="#all-course" role="tab" aria-controls="unpublish-course" aria-selected="false" tabindex="-1" onclick="awardCoursList('2')">Unpublish</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="draft-course-tab" data-bs-toggle="pill" href="#all-course" role="tab" aria-controls="draft-course" aria-selected="false" tabindex="-1" onclick="awardCoursList('1')">Draft</a>
                                    </li>
                                </ul>
                            </div>


                             <!-- Search Form -->
                             <div class="col-12 col-xxl-2 mt-3 d-flex">
                                <form class="d-flex align-items-center w-100">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-6 searchCourse" id="searchInput" placeholder="Search Here">
                                </form>
                            </div>
                        </div>
                        <div class="allCourseaward d-flex">
                            <!-- Radio Buttons -->
                            <div class="col-12 col-xxl-2 col-xl-3 col-lg-4 d-flex align-items-center mt-5">
                                <div class="me-2 d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked onchange="toggleDateFields()">
                                        <label class="form-check-label" for="flexRadioDefault1">All</label>
                                    </div>
                                    <div class="form-check ms-2">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" onchange="toggleDateFields()">
                                        <label class="form-check-label" for="flexRadioDefault2">Choose Dates</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Export Form -->
                            <form id="exportFormWithoutFilter" action="{{ route('export') }}" method="POST" class="needs-validation d-flex flex-column flex-md-row allawardform align-items-center align-items-md-start col-12 col-xxl-10 col-xl-9 col-lg-8 mt-3" novalidate>
                                @csrf
                                <div class="row date-fields d-none" id="dateFields">
                                    <div class="col-md-6 mb-2">
                                        <label for="start_date" class="form-label mb-0">From Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                        <div class="invalid-feedback">Please provide a valid start date.</div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="end_date" class="form-label mb-0">To Date</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date">
                                        <div class="invalid-feedback">Please provide a valid end date.</div>
                                    </div>
                                </div>

                                <input type="hidden" name="category" id="category" value="all">
                                <input type="hidden" name="export" value="awardCourseData">

                                <!-- Label for Export Button -->
                                <div class="col-md-4 mb-2 " style="display: flex; flex-direction: column;">
                                    <label for="exportButtonWithoutFilter" class="form-label mb-0 ms-2" style="visibility: hidden">Export Data</label>
                                    <a href="#" id="exportButtonWithoutFilter" class="btn btn-outline-primary fieldsButton ms-2" style="width: fit-content">
                                        Export <i class="fe fe-upload ms-1"></i>
                                    </a>
                                </div>
                            </form>

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
                                                <th>Category</th>
                                                <th>Lecturer</th>
                                                <th>Status</th>
                                                <th>Enrolled</th>
                                                <th>Action</th>
                                                <th>Schedule</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- <tr>

                                                <td>
                                                    <a href="course-edit" class="text-inherit">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <img src=" assets/images/course/masters-human-resource-management.png"
                                                                    alt="" class="img-4by3-lg rounded">
                                                            </div>
                                                            <div class="ms-3">
                                                                <h4 class="mb-1 text-primary-hover">Award of Arts in Human Resource Management</h4>
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

                                                <td><span class="badge bg-success">Publish</span></td>
                                                <td>12,877</td>
                                                <td>
                                                    <div class="hstack gap-3">
                                                        <!--   -->
                                                        <a href="award-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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
                                                        <a href="award-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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
                                                        <a href="award-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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
                                            </tr> --}}

                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <!-- Publish Tab  -->
                            {{--  <div class="tab-pane fade" id="publish-course" role="tabpanel"
                                aria-labelledby="publish-course-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <div class="table-responsive border-0 overflow-y-hidden table-with-checkbox">
                                        <table class="table mb-0 text-nowrap table-centered table-hover">
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
                                            <tbody>
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
                                                                    <h4 class="mb-1 text-primary-hover">Award of Arts in Human Resource Management</h4>
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

                                                    <td><span class="badge bg-success">Publish</span></td>
                                                    <td>12,877</td>
                                                    <td>
                                                        <div class="hstack gap-3">
                                                            <!--   -->
                                                            <a href="award-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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

                                                    <td><span class="badge bg-success">Publish</span></td>
                                                    <td>545</td>

                                                    <td>
                                                        <div class="hstack gap-3">
                                                            <!--   -->
                                                            <a href="award-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Unpublish Tab  -->
                           <div class="tab-pane fade" id="unpublish-course" role="tabpanel"
                                aria-labelledby="unpublish-course-tab">
                                <div class="table-responsive border-0 overflow-y-hidden table-with-checkbox">
                                    <table class="table mb-0 text-nowrap table-centered table-hover">
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
                                        <tbody>
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
                                                                <h4 class="mb-1 text-primary-hover">Award of Arts in Human Resource Management</h4>
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
                                                        <a href="award-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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
                                                        <a href="award-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Draft Tab  -->
                            <div class="tab-pane fade" id="draft-course" role="tabpanel"
                                aria-labelledby="draft-course-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <div class="table-responsive border-0 overflow-y-hidden table-with-checkbox">
                                        <table class="table mb-0 text-nowrap table-centered table-hover">
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
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
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
                                                                    <h4 class="mb-1 text-primary-hover">Award of Arts in Human Resource Management</h4>
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

                                                    <td> <span class="badge bg-warning">Draft</span></td>
                                                    <td>
                                                        <div class="hstack gap-3">
                                                            <!--   -->
                                                            <a href="award-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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

                                                    <td> <span class="badge bg-warning">Draft</span></td>


                                                    <td>
                                                        <div class="hstack gap-3">
                                                            <!--   -->
                                                            <a href="award-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        </div>
                    </div>
                </div>
            </div>

<div class="modal fade" id="ScheduleMeeting" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Schedule Meeting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row ScheduleData" novalidate>
                    <div class="mb-2 col-12">
                        <label for="FirstName" class="form-label">Description <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                    </div>
                    <div class="mb-2 col-6">
                        <label for="LastName" class="form-label">Date<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date" placeholder="date"  min="28-5-2025" name="date" required>
                        <div class="invalid-feedback" id="last_name_error" >Please Date.</div>
                    </div>
                    <div class="mb-2 col-6">
                        <label for="EmailId" class="form-label">Start Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="time" placeholder="time" name="time" required>
                        <div class="invalid-feedback" id="email_error" >Please Time.</div>

                    </div>
                    <div class="mb-2 col-6">
                        <label for="EmailId" class="form-label">End Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="endtime" placeholder="time" name="endtime" required>
                        <div class="invalid-feedback" id="email_error" >Please Time.</div>

                    </div>

                    <div class="col-12 d-flex justify-content-end pt-2">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary createSchedule" >Create Meeting</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </section>
    </main>
    <script src="{{ asset('admin/js/export.js')}}"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            awardCoursList('all');
            handleSearchInput('searchInput',function(){
                awardCoursList("all");
            });
        });
        $('#checkAll').click(function (e) {
            $('.award_course_list tbody :checkbox').prop('checked', $(this).is(':checked'));
            e.stopImmediatePropagation();
        });

        document.querySelectorAll(".form-check-input").forEach((checkbox) => {
            checkbox.addEventListener("change", function() {
                var checkboxId = this.id; // Get the ID of the checkbox
                var listItem = document.querySelector(
                `li[data-id="${checkboxId}"]`); // Select the list item using the checkbox ID
                if (this.checked) {
                    var coursetitleEncoded = this.getAttribute(
                    "data-coursetitle"); // Get the encoded value of data-coursetitle attribute
                    var NameDisplay = atob(coursetitleEncoded); // Decode the Base64 encoded value
                    var courseEcts = this.getAttribute(
                    "data-ects"); // Get the encoded value of data-coursetitle attribute
                    var Ects = atob(courseEcts); // Decode the Base64 encoded value
                    var courseId = this.getAttribute("data-courseid");
                    var newListItem = $(
                        '<li class="ui-state-default ui-sortable-handle" id="listItem" data-id="shippingAddress_' +
                        courseId +
                        '" data-courseid="' +
                        courseId +
                        '">' +
                        NameDisplay +
                        "  " +
                        Ects +
                        '  ECTS <i class="bi bi-arrow-down-up"></i><input type="hidden" name="sorted_course_module_ids[]" value="' +
                        courseId +
                        '"></li>'
                    );
                    $("#sortable").append(newListItem);
                } else {
                    listItem.remove();
                }
            });
        });

        function awardCoursList(action) {
            $("#processingLoader").fadeIn();
            $(".dataTables_filter").css("display", "none");
            var baseUrl = window.location.origin + "/";
            // $.ajax({
            //     url: baseUrl + "admin/award-course-get-data/" + action,
            //     method: "GET",
            //     success: function(data) {
            //     $(".award_course_list").DataTable().destroy();
            //     $(".counts").html("(" + data.length + ")");
            //         $(".award_course_list").DataTable({
            //             data: data, // Pass
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
            //                         return "<span class='badge bg-info-soft'>Award</span>";
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
            //                 {
            //                     data: null,
            //                     render: function(row) {
            //                         var CourseId = btoa(row.id);
            //                         var action = btoa("edit");
            //                         // var editUrl ="#";
            //                         // if (status == 3) {
            //                             var editUrl =
            //                                 baseUrl +
            //                                 "admin/award-course-get-data/" +
            //                                 CourseId +
            //                                 "/" +
            //                                 action;
            //                         // }
            //                         var Action =
            //                             '<div class="hstack gap-3"><a href="' +
            //                             editUrl +
            //                             '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a>    <span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a> <span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
            //                             // <a href="javascript:void(0);"  class="deleteCourse" data-course_id="'+CourseId+'" data-bs-toggle="tooltip" data-placement="top" title="Delete" ><i class="fe fe-trash"></i></a>



            //                             if(row.status == '1'){
            //                                 Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_publish')+'" data-role="students" data-course_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Publish</a> </div>';
            //                             }else{
            //                                 if(row.status == '3'){
            //                                     Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_unpublish')+'" data-role="students" data-course_id="'+btoa(row.id)+'"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Unpublish </a>';
            //                                     Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_draft')+'" data-role="students" data-course_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Draft</a> </div>';
            //                                 }else if(row.status == '2'){
            //                                     Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_publish')+'" data-role="students" data-course_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Publish</a>';
            //                                     Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_draft')+'" data-role="students" data-course_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Draft</a> </div>';
            //                                 }
            //                             }
            //                             return Action;
            //                     },
            //                     width:"10%"
            //                 },
            //                 // Add more columns as needed
            //             ],
            //         });
            //     },
            //     error: function(xhr, status, error) {
            //         console.error(error);
            //     },
            // });
            $('.award_course_list').DataTable().clear().destroy();
            $("#processingLoader").fadeOut();
            var table = $(".award_course_list").DataTable({
                "processing": true,
                "serverSide": true,
                'searching': true,
                "paging": true,
                "ajax": {
                    "url": baseUrl + "admin/award-course-get-data/" + action,
                    "type": "GET"
                },
                "columns":
                [
                        {
                            data: "null",
                            render: function(data, type, full, meta) {
                                var CourseId = btoa(data);
                                var isChecked = full.checked ? "checked" : "";
                                return (
                                    '<form class="actionData"><input type="checkbox" class="form-check-input checkbox sub_chk " name="userId[]"  data-course_ids="'+CourseId+'" value="' +
                                    CourseId +
                                    '" ' +
                                    isChecked +
                                    "></form>"
                                );

                            },
                            width:"5%"
                        },
                        {
                            data: null,
                            render: function(data, type, full, row) {
                                i = row.row + 1;
                                return i;
                            },
                                width:"5%"
                        },
                        {
                            data: null,
                            render: function(data) {
                                var name = data.course_title != '' ? data.course_title : '';
                                var created_at = data.created_at;
                                var CourseId = btoa(data.id);
                                var action = btoa("edit");

                                var editUrl =
                                    baseUrl +
                                    "course-details/" +
                                    CourseId;
                                return (
                                    "<a href="+editUrl+"  class='text-inherit'><div class='d-flex align-items-center'><div></div><div class=''><h4 class='mb-1 text-primary-hover text-wrap-title'>" +
                                    name +
                                    "</div></h4><span><small>Created at " +
                                    created_at +
                                    "</small></span></div></div></a>"
                                );
                            },
                            width:"35%"
                        },
                        {
                            data: null,
                            render: function(data) {
                                return "<span class='badge bg-info-soft'>Award</span>";
                            },
                            width:"10%"
                        },
                        {
                            data: null,
                            render: function(data) {
                                var instructor = 'Not Assigned';
                                var img = baseUrl + "storage/ementorDocs/e-mentor-profile-photo.png";
                                if (data.ementor != null) {
                                    var emt_fname = data.ementor.name != null ? data.ementor
                                        .name : '';
                                    var emt_lname = data.ementor.last_name != null ? data
                                        .ementor.last_name : '';
                                    var instructor =
                                        emt_fname +
                                        " " +
                                        emt_lname;
                                    var img = data.ementor.photo  ? baseUrl + 'storage/' + data.ementor.photo : baseUrl + "storage/ementorDocs/e-mentor-profile-photo.png";
                                }

                                return (
                                    "<div class='d-flex align-items-center'><img src='" +
                                    img +
                                    "' alt='' class='rounded-circle avatar-xs me-2'><h5 class='mb-0'>" +
                                    instructor +
                                    "</h5></div>"
                                );
                            },
                            width:"20%"
                        },
                        {
                            data: null,
                            render: function(data) {
                                var status = data.status;
                                if (status === "1") {
                                    return "<span class='badge text-warning bg-light-warning'>Draft</span>";
                                }
                                if (status === "2") {
                                    return '<span class="badge text-danger bg-light-danger">Unpublish</span>';
                                }
                                if (status === "3") {
                                    return '<span class="badge text-success bg-light-success">Publish</span>';
                                }
                            },
                            width:"10%"
                        },
                        {
                            data: null,
                            render: function(data) {
                                var joined = data.is_enrolled;
                                return joined;
                            },
                            width:"5%"
                        },
                        {
                            data: null,
                            render: function(row) {
                                var CourseId = btoa(row.id);
                                var action = btoa("edit");
                                // var editUrl ="#";
                                // if (status == 3) {
                                    var editUrl =
                                        baseUrl +
                                        "admin/award-course-get-data/" +
                                        CourseId +
                                        "/" +
                                        action;
                                // }
                                var Action =
                                    '<div class="hstack gap-3"><a href="' +
                                    editUrl +
                                    '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a>    <span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a> <span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
                                    // <a href="javascript:void(0);"  class="deleteCourse" data-course_id="'+CourseId+'" data-bs-toggle="tooltip" data-placement="top" title="Delete" ><i class="fe fe-trash"></i></a>



                                    if(row.status == '1'){
                                        Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_publish')+'" data-role="students" data-course_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Publish</a> </div>';
                                    }else{
                                        if(row.status == '3'){
                                            Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_unpublish')+'" data-role="students" data-course_id="'+btoa(row.id)+'"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Unpublish </a>';
                                            Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_draft')+'" data-role="students" data-course_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Draft</a> </div>';
                                        }else if(row.status == '2'){
                                            Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_publish')+'" data-role="students" data-course_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Publish</a>';
                                            Action += '<a class="dropdown-item statusCourse" href="#" data-status="'+btoa('course_status_draft')+'" data-role="students" data-course_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Draft</a> </div>';
                                        }
                                    }
                                    return Action;
                            },
                            width:"10%"
                        },
                        {
                            data: null,
                            render: function(data) {
                                   var CourseId = btoa(data.id);
                                return '<button class="btn btn-primary openScheduleModal" data-bs-toggle="modal" data-course-id='+ CourseId +' data-bs-target="#ScheduleMeeting">Schedule</button>';
                            },
                            width:"5%"
                        }
                            // Add more columns as needed
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

        function toggleDateFields() {
            const dateFields = document.getElementById('dateFields');
            const radioAll = document.getElementById('flexRadioDefault1');

            if (!radioAll.checked) {
                dateFields.classList.remove('d-none');
                allFields.classList.add('d-none');
                $('#exportButtonWithoutFilter').attr('id', 'exportButton');
                $('#exportFormWithoutFilter').attr('id', 'exportForm');
                $("#catgeory").val("");
                loadExternalScript(); // Replace 'someScriptCall' with the actual script function you want to call



            } else {
                dateFields.classList.add('d-none');
                allFields.classList.add('d-block');
                $("#start_date").val("");
                $("#end_date").val("");
                $("#catgeory").val("all");
                $('#exportButton').attr('id', 'exportButtonWithoutFilter');
                $('#exportForm').attr('id', 'exportFormWithoutFilter');
            }
        }

        function loadExternalScript() {
            $.getScript("{{ asset('admin/js/export.js') }}")
            .done(function() {
                // The script loaded successfully
                console.log('Script loaded successfully.');
            })
            .fail(function() {
                // There was an error loading the script
                console.log('Failed to load the script.');
            });
        }


        //Meeting link
        $(document).on("click", ".openScheduleModal", function () {
            var courseId = $(this).data("course-id");
            // Store it in a hidden field or modal attribute
            $("#ScheduleMeeting").data("course-id", courseId);
        });
    </script>
@endsection
