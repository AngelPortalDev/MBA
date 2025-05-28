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
                            E-mentors
                            <span class="fs-5">(105)</span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">E-mentors</a></li>
                                <!-- <li class="breadcrumb-item active" aria-current="page">All Admin</li> -->
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">


                    </div>
                </div>
            </div>
            <!-- <form class="d-flex align-items-center col-12 col-lg-3"> -->
                <div class="col-lg-8 col-12 text-end pt-2 mb-0 mb-sm-3">
                    <div class="d-sm-flex justify-content-sm-end">
                          <!-- Button With Icon -->
                          <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">
                                Create <i class="fe fe-plus ms-1"></i>
                            </button>
                          </div>
                       <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
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
                        <button type="button" class="btn btn-outline-primary ">
                            Export <i class="fe fe-upload ms-1"></i>
                        </button>
                       </div>
                     

                    </div>
                </div>


        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 mt-3 mt-md-0">
                <!-- Card -->
                <div class="card rounded-3">
                    <!-- Card Header -->
                    <div class="p-4 row">
                        <div class="card-header p-0 col-12 col-lg-6 col-md-12 ">
                            <ul class="nav nav-lb-tab border-bottom-0" id="tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="all-students-tab" data-bs-toggle="pill" href="#all-students" role="tab" aria-controls="all-students" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="active-e-mentor-tab" data-bs-toggle="pill" href="#active-e-mentor" role="tab" aria-controls="active-e-mentor" aria-selected="false" tabindex="-1">Active</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="inactive-e-mentor-tab" data-bs-toggle="pill" href="#inactive-e-mentor" role="tab" aria-controls="inactive-e-mentor" aria-selected="false" tabindex="-1">Inactive</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="deleted-e-mentor-tab" data-bs-toggle="pill" href="#deleted-e-mentor" role="tab" aria-controls="deleted-e-mentor" aria-selected="false" tabindex="-1">Deleted</a>
                                </li>
                            </ul>
                        </div>
                    
                        <!-- Form -->
                       
                        <div class="d-flex align-items-center col-12 col-lg-6 col-md-12  justify-content-end border-bottom ">
                            <div class="row justify-content-end">
                                <form class="d-flex align-items-center col-12 col-lg-6 mt-2 mt-lg-0 ">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-6" placeholder="Search Here">
                                </form>

                                <!-- input -->
                                <div class="col-auto col-lg-6 col-12 mt-2 mt-lg-0 mb-2 mb-lg-0">
                                    <!-- form select -->
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected="">Filter</option>
                                        <option value="Newest">Newest</option>
                                        <option value="Price: High-Low">Active</option>
                                        <option value="Price: Low-High">Inactive</option>
                                        <option value="Price: Low-High">Delected</option>
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

                            <!-- All Students Tab  -->
                            <div class="tab-pane fade active show" id="all-students" role="tabpanel" aria-labelledby="all-students-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Sr. No.</th>
                                                    <th>Name</th>
                                                   
                                                    <th>Status</th>
                                                    <th>Courses</th>
                                                    <th>Assigned Course Name</th>
                                                    <th>Students</th>
                                                     
                                                    <th>Joined</th>
        
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
                                                        <div class="d-flex align-items-center">
                                                            <img src="assets/images/avatar/avatar-15.jpg" alt=""
                                                                class="rounded-circle avatar-md me-2">
                                                            <h5 class="mb-0">Rivao Luke</h5>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge text-success bg-light-success">Active</span></td>
                                                    <td>2 Courses</td>
                                                    <td>Masters of Arts in Human Resource Management <br> Award in Recruitment and Employee Selection</td>
 
                                                    <td>54,898</td>
                                                    <td>7 July, 2020</td>
        
        
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a href=" e-mentors-edit" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Edit"><i class="fe fe-edit"></i></a>
                                                            <a href="#" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Delete"><i class="fe fe-trash"></i></a>
                                                            <span class="dropdown dropstart">
                                                                <a class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                                    data-bs-offset="-20,20" aria-expanded="false">
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
                                                        <div class="d-flex align-items-center">
                                                            <img src="assets/images/avatar/avatar-15.jpg" alt=""
                                                                class="rounded-circle avatar-md me-2">
                                                            <h5 class="mb-0">Rivao Luke</h5>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge text-danger bg-light-danger">Inactive</span></td>
                                                    <td>1 Course</td>
                                                    <td>Masters of Arts in Human Resource Management</td>
 
                                                    <td>-</td>
                                                    <td>7 July, 2020</td>
        
        
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a href=" e-mentors-edit" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Edit"><i class="fe fe-edit"></i></a>
                                                            <a href="#" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Delete"><i class="fe fe-trash"></i></a>
                                                            <span class="dropdown dropstart">
                                                                <a class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                                    data-bs-offset="-20,20" aria-expanded="false">
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


                            <!-- Active E-mentors Tab  -->
                            <div class="tab-pane fade" id="active-e-mentor" role="tabpanel" aria-labelledby="active-e-mentor-tab">
                            <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Sr. No.</th>
                                                    <th>Name</th>
                                                   
                                                    <th>Status</th>
                                                    <th>Courses</th>
                                                    <th>Assigned Course Name</th>
                                                    <th>Students</th>
                                                     
                                                    <th>Joined</th>
        
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
                                                        <div class="d-flex align-items-center">
                                                            <img src="assets/images/avatar/avatar-15.jpg" alt=""
                                                                class="rounded-circle avatar-md me-2">
                                                            <h5 class="mb-0">Rivao Luke</h5>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge text-success bg-light-success">Active</span></td>
                                                    <td>2 Courses</td>
                                                    <td>Masters of Arts in Human Resource Management <br> Award in Recruitment and Employee Selection</td>
 
                                                    <td>54,898</td>
                                                    <td>7 July, 2020</td>
        
        
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a href=" e-mentors-edit" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Edit"><i class="fe fe-edit"></i></a>
                                                            <a href="#" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Delete"><i class="fe fe-trash"></i></a>
                                                            <span class="dropdown dropstart">
                                                                <a class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                                    data-bs-offset="-20,20" aria-expanded="false">
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
                                                        <div class="d-flex align-items-center">
                                                            <img src="assets/images/avatar/avatar-15.jpg" alt=""
                                                                class="rounded-circle avatar-md me-2">
                                                            <h5 class="mb-0">Rivao Luke</h5>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge text-success bg-light-success">Active</span></td>
                                                    <td>1 Course</td>
                                                    <td>Masters of Arts in Human Resource Management</td>
 
                                                    <td>54,898</td>
                                                    <td>7 July, 2020</td>
        
        
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a href=" e-mentors-edit" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Edit"><i class="fe fe-edit"></i></a>
                                                            <a href="#" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Delete"><i class="fe fe-trash"></i></a>
                                                            <span class="dropdown dropstart">
                                                                <a class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                                    data-bs-offset="-20,20" aria-expanded="false">
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

                            <!-- Inactive E-mentors Tab  -->
                            <div class="tab-pane fade" id="inactive-e-mentor" role="tabpanel" aria-labelledby="inactive-e-mentor-tab">
                            <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Sr. No.</th>
                                                    <th>Name</th>
                                                   
                                                    <th>Status</th>
                                                    <th>Courses</th>
                                                    <th>Assigned Course Name</th>
                                                    <th>Students</th>
                                                     
                                                    <th>Joined</th>
        
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
                                                        <div class="d-flex align-items-center">
                                                            <img src="assets/images/avatar/avatar-15.jpg" alt=""
                                                                class="rounded-circle avatar-md me-2">
                                                            <h5 class="mb-0">Rivao Luke</h5>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge text-danger bg-light-danger">Inactive</span></td>
                                                    <td>2 Courses</td>
                                                    <td>Masters of Arts in Human Resource Management <br> Award in Recruitment and Employee Selection</td>
 
                                                    <td>-</td>
                                                    <td>7 July, 2020</td>
        
        
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a href=" e-mentors-edit" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Edit"><i class="fe fe-edit"></i></a>
                                                            <a href="#" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Delete"><i class="fe fe-trash"></i></a>
                                                            <span class="dropdown dropstart">
                                                                <a class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                                    data-bs-offset="-20,20" aria-expanded="false">
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
                                                        <div class="d-flex align-items-center">
                                                            <img src="assets/images/avatar/avatar-15.jpg" alt=""
                                                                class="rounded-circle avatar-md me-2">
                                                            <h5 class="mb-0">Rivao Luke</h5>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge text-danger bg-light-danger">Inactive</span></td>
                                                    <td>1 Course</td>
                                                    <td>Masters of Arts in Human Resource Management</td>
 
                                                    <td>-</td>
                                                    <td>7 July, 2020</td>
        
        
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a href=" e-mentors-edit" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Edit"><i class="fe fe-edit"></i></a>
                                                            <a href="#" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Delete"><i class="fe fe-trash"></i></a>
                                                            <span class="dropdown dropstart">
                                                                <a class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                                    data-bs-offset="-20,20" aria-expanded="false">
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

                            <!-- Deleted E-mentors Tab  -->
                            <div class="tab-pane fade" id="deleted-e-mentor" role="tabpanel" aria-labelledby="deleted-e-mentor-tab">
                            <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Sr. No.</th>
                                                    <th>Name</th>
                                                   
                                                    <th>Status</th>
                                                    <th>Courses</th>
                                                    <th>Assigned Course Name</th>
                                                    <th>Students</th>
                                                     
                                                    <th>Joined</th>
        
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
                                                        <div class="d-flex align-items-center">
                                                            <img src="assets/images/avatar/avatar-15.jpg" alt=""
                                                                class="rounded-circle avatar-md me-2">
                                                            <h5 class="mb-0">Rivao Luke</h5>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge text-danger bg-light-danger">Inactive</span></td>
                                                    <td>2 Courses</td>
                                                    <td>Masters of Arts in Human Resource Management <br> Award in Recruitment and Employee Selection</td>
 
                                                    <td>-</td>
                                                    <td>7 July, 2020</td>
        
        
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a href=" e-mentors-edit" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Edit"><i class="fe fe-edit"></i></a>
                                                            <a href="#" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Delete"><i class="fe fe-trash"></i></a>
                                                            <span class="dropdown dropstart">
                                                                <a class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                                    data-bs-offset="-20,20" aria-expanded="false">
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
                                                        <div class="d-flex align-items-center">
                                                            <img src="assets/images/avatar/avatar-15.jpg" alt=""
                                                                class="rounded-circle avatar-md me-2">
                                                            <h5 class="mb-0">Rivao Luke</h5>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge text-danger bg-light-danger">Inactive</span></td>
                                                    <td>1 Course</td>
                                                    <td>Masters of Arts in Human Resource Management</td>
 
                                                    <td>-</td>
                                                    <td>7 July, 2020</td>
        
        
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a href=" e-mentors-edit" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Edit"><i class="fe fe-edit"></i></a>
                                                            <a href="#" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Delete"><i class="fe fe-trash"></i></a>
                                                            <span class="dropdown dropstart">
                                                                <a class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                                    data-bs-offset="-20,20" aria-expanded="false">
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
                    <!-- Card Footer -->
                    <div class="card-footer">
                        <nav>
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link mx-1 rounded" href="#" tabindex="-1" aria-disabled="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z">
                                        </path></svg>
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
                                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                        </path></svg>
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



<!-- Create Admin Modal -->
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Create New E-mentor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row needs-validation" novalidate>
                    <div class="mb-2 col-6">
                        <label for="FirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="FirstName" placeholder="First Name" required>
                        <div class="invalid-feedback">Please enter First Name</div>
                    </div>
                    <div class="mb-2 col-6">
                        <label for="LastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="LastName" placeholder="Last Name" required>
                        <div class="invalid-feedback">Please enter Last Name</div>
                    </div>
                    <div class="mb-2 col-12">
                        <label for="EmailId" class="form-label">Email Id</label>
                        <input type="text" class="form-control" id="EmailId" placeholder="Email Id" required>
                        <div class="invalid-feedback">Please enter Email Id</div>
                    </div>
                    <div class="mb-2 col-12">
                        <label for="MobileNumber" class="form-label">Mobile Number</label>
                        <div class="mobile-with-country-code">
                            <select class="form-select" aria-label="Default select example">
                                <option selected="">+91</option>
                                <option value="1">+356</option>
                                <option value="2">+987</option>
                                <option value="3">+54</option>
                            </select>
                            
                            <input type="number" id="mobile" class="form-control" name="mobile" placeholder="+123 4567 890" required="">

                        </div>
                        <div class="invalid-feedback">Please enter Mobile Number</div>
                    </div>
                    <div class="mb-2 col-12">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="Password" placeholder="*********" required>
                        <div class="invalid-feedback">Please enter Password</div>
                    </div>
                    <div class="mb-2 col-12">
                        <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="ConfirmPassword" placeholder="*********" required>
                        <div class="invalid-feedback">Please enter Password</div>
                    </div>



                    <div class="col-12 d-flex justify-content-end pt-2">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create E-mentor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
