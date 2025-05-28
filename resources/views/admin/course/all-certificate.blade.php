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
                            All CERTIFICATE Courses
                            <span class="fs-5">(20)</span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.php">Dashboard</a>
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
                <div>
                    <!-- Button With Icon -->
                    <a href="#">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">
                        Create <i class="fe fe-plus ms-1"></i>
                        </button>
                    </a>
                    <button type="button" class="btn btn-outline-primary ">
                        Delete <i class="fe fe-trash ms-1"></i>
                    </button>
                    <button type="button" class="btn btn-outline-primary ">
                        Import <i class="fe fe-download ms-1"></i>
                    </button>
                    <button type="button" class="btn btn-outline-primary ">
                        Export <i class="fe fe-upload ms-1"></i>
                    </button>

                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Card -->
                <div class="card rounded-3">
                    <!-- Card Header -->
                    <div class="p-4 row">
                        <div class="card-header p-0 col-12 col-md-7 col-lg-7">
                            <ul class="nav nav-lb-tab border-bottom-0" id="tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="all-course-tab" data-bs-toggle="pill"
                                        href="#all-course" role="tab" aria-controls="all-course"
                                        aria-selected="true">All</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="publish-course-tab" data-bs-toggle="pill" href="#publish-course"
                                        role="tab" aria-controls="publish-course" aria-selected="false"
                                        tabindex="-1">Publish</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="unpublish-course-tab" data-bs-toggle="pill"
                                        href="#unpublish-course" role="tab" aria-controls="unpublish-course"
                                        aria-selected="false" tabindex="-1">Unpublish</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="draft-course-tab" data-bs-toggle="pill"
                                        href="#draft-course" role="tab" aria-controls="draft-course"
                                        aria-selected="false" tabindex="-1">Draft</a>
                                </li>
                            </ul>
                        </div>


                        <!-- Form -->


                        <div
                            class="d-flex align-items-center col-12 col-md-5 col-lg-5 justify-content-end border-bottom">
                            <div class="row justify-content-end">
                                <form class="d-flex align-items-center col-lg-6 ">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-6" placeholder="Search Here">
                                </form>


                                <!-- input -->
                                <div class="col-auto">
                                    <!-- form select -->
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected="">Filter</option>
                                        <option value="Newest">Newest</option>
                                        <option value="Price: High-Low">Publish</option>
                                        <option value="Price: Low-High">Unpublish</option>
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
                                                <th></th>
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
                                                                <h4 class="mb-1 text-primary-hover">Certificate of Arts in Human Resource Management</h4>
                                                                <span>Added on 7 July, 2023</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td><span class="badge bg-info-soft">Certificate</span></td>
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
                                                        <a href="certificate-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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
                                                                <h4 class="mb-1 text-primary-hover">Certificate in Recruitment and Employee Selection</h4>
                                                                <span>Added on 7 July, 2023</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td><span class="badge bg-info-soft">Certificate</span></td>
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
                                                        <a href="certificate-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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
                                                                <h4 class="mb-1 text-primary-hover">Certificate in Recruitment and Employee Selection</h4>
                                                                <span>Added on 7 July, 2023</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td><span class="badge bg-info-soft">Certificate</span></td>
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
                                                        <a href="certificate-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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


                            <!-- Publish Tab  -->
                            <div class="tab-pane fade" id="publish-course" role="tabpanel"
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
                                                    <th></th>
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
                                                                    <h4 class="mb-1 text-primary-hover">Certificate of Arts in Human Resource Management</h4>
                                                                    <span>Added on 7 July, 2023</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td><span class="badge bg-info-soft">Certificate</span></td>
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
                                                            <a href="certificate-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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
                                                                    <h4 class="mb-1 text-primary-hover">Certificate in Recruitment and Employee Selection</h4>
                                                                    <span>Added on 7 July, 2023</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td><span class="badge bg-info-soft">Certificate</span></td>
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
                                                            <a href="certificate-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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
                                                <th></th>
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
                                                                <h4 class="mb-1 text-primary-hover">Certificate of Arts in Human Resource Management</h4>
                                                                <span>Added on 7 July, 2023</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td><span class="badge bg-info-soft">Certificate</span></td>
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
                                                        <a href="certificate-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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
                                                                <h4 class="mb-1 text-primary-hover">Certificate in Recruitment and Employee Selection</h4>
                                                                <span>Added on 7 July, 2023</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td><span class="badge bg-info-soft">Certificate</span></td>
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
                                                        <a href="certificate-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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
                                                    <th></th>
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
                                                                    <h4 class="mb-1 text-primary-hover">Certificate of Arts in Human Resource Management</h4>
                                                                    <span>Added on 7 July, 2023</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td><span class="badge bg-info-soft">Certificate</span></td>
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
                                                            <a href="certificate-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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
                                                                    <h4 class="mb-1 text-primary-hover">Certificate in Recruitment and Employee Selection</h4>
                                                                    <span>Added on 7 July, 2023</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td><span class="badge bg-info-soft">Certificate</span></td>
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
                                                            <a href="certificate-course-add" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="fe fe-edit"></i></a>
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
                        </div>
                    </div>
                    <!-- Card Footer -->
                    <div class="card-footer">
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
                    </div>
                </div>
            </div>
        </div>


    </section>
</main>




@endsection
