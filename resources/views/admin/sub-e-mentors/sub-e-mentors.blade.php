<!-- Header import -->
@extends('admin.layouts.main')
@section('content')

<style>
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
    .select2-container {
        width: auto !important;
    }
</style>
    <!-- Container fluid -->
    <section class="container-fluid p-4">
        <div class="row justify-content-between ">
            <!-- Page Header -->
            <div class="col-lg-4 col-12">
                <div class=" pb-3 mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Sub Mentors
                            <span class="fs-5 counts"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Sub Mentors</a></li>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ementor-create-modal">
                                Create <i class="fe fe-plus ms-1"></i>
                            </button>
                        </div>
                        {{-- <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                            <button type="button" class="btn btn-outline-primary deleteEmentor">
                                Delete <i class="fe fe-trash ms-1"></i>
                            </button>
                        </div> --}}
                        {{-- <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                            <button type="button" class="btn btn-outline-primary ">
                                Import <i class="fe fe-download ms-1"></i>
                            </button>
                        </div>
                        <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                            <button type="button" class="btn btn-outline-primary ">
                                Export <i class="fe fe-upload ms-1"></i>
                            </button>
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
                                    <a class="nav-link active section-ementor-tab"  data-cat="all" id="all-mentor-tab" data-bs-toggle="pill" href="#all-mentor" role="tab" aria-controls="all-mentor" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-ementor-tab" data-cat="Active" data-bs-toggle="pill" href="#active-e-mentor" role="tab" aria-controls="active-e-mentor" aria-selected="false" tabindex="-1">Active</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-ementor-tab" data-cat="Inactive"  data-bs-toggle="pill" href="#inactive-e-mentor" role="tab" aria-controls="inactive-e-mentor" aria-selected="false" tabindex="-1">Inactive</a>
                                </li>
                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link section-ementor-tab" data-cat="delete"  data-bs-toggle="pill" href="#deleted-e-mentor" role="tab" aria-controls="deleted-e-mentor" aria-selected="false" tabindex="-1">Deleted</a>
                                </li> --}}
                            </ul>
                        </div>

                    
                        <!-- Form -->

                       
                        <div class="d-flex align-items-center col-12 col-md-5 col-lg-5 justify-content-end border-bottom">
                            <div class="row justify-content-end">
                                <form class="d-flex align-items-center col-lg-8 mt-3 mt-md-0 mb-3 mb-md-0 w-100">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-6" id="searchInput" placeholder="Search Here">
                                </form>

                            
                                <!-- input -->
                                {{-- <div class="col-auto">
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
                                </div> --}}
                            </div>
                        </div>
                    </div>



                    <div>
                        <div class="tab-content" id="tabContent">
                            <!-- Tab -->

                            <!-- All Eentor Tab  -->
                            <div class="tab-pane fade active show" id="all-ementors" role="tabpanel" aria-labelledby="all-ementor-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover all_ementor_list w-100" width="100%">
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
                                                    {{-- <th>Assigned Course</th>
                                                    <th>Students</th> --}}
                                                     
                                                    <th>Joined</th>
        
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                </div>
                            </div>


                            <!-- Active E-mentors Tab  -->
                            {{-- <div class="tab-pane fade" id="active-e-mentor" role="tabpanel" aria-labelledby="active-e-mentor-tab">
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
                                                             
                                                            <a href="e-mentors-edit" data-bs-toggle="tooltip" data-placement="top"
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
                            </div> --}}

                            <!-- Inactive E-mentors Tab  -->
                            {{-- <div class="tab-pane fade" id="inactive-e-mentor" role="tabpanel" aria-labelledby="inactive-e-mentor-tab">
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
                            </div> --}}

                            <!-- Deleted E-mentors Tab  -->
                            {{-- <div class="tab-pane fade" id="deleted-e-mentor" role="tabpanel" aria-labelledby="deleted-e-mentor-tab">
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
                            </div> --}}
                        </div>
                    </div>
                    <!-- Card Footer -->
                    {{-- <div class="card-footer">
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
                    </div> --}}
                </div>
            </div>
        </div>

        
    </section>
</main>



<!-- Create Admin Modal -->
<div class="modal fade" id="ementor-create-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Create New Sub E-mentor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row ementorData" novalidate>
                    <div class="mb-2 col-6">
                        <label for="FirstName" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" required>
                        <div class="invalid-feedback" id="first_name_error">Please enter your first name.</div>
                    </div>
                    <div class="mb-2 col-6">
                        <label for="LastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="last_name" placeholder="Last Name"  name="last_name" required>
                        <div class="invalid-feedback" id="last_name_error" >Please enter your last name.</div>
                    </div>
                    <div class="mb-2 col-12">
                        <label for="EmailId" class="form-label">Email Id <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" placeholder="Email Id" name="email" required>
                        <div class="invalid-feedback" id="email_error" >Please enter your email id.</div>
                    </div>
                    <div class="mb-2 col-12">
                        <label for="MobileNumber" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                        <div class="mobile-with-country-code gap-2">
                            <select class="form-select select2" name="mob_code" aria-label="Default select example" id="mob_code">
                                <option value="">Select</option>
                                @foreach (getDropDownlist('country_master',['country_code']) as $mob_code)
                                <option value="+{{$mob_code->country_code}}"> +{{$mob_code->country_code}}</option>
                                @endforeach
                            </select>
                            <input type="number" id="mobile" class="form-control" name="mobile" placeholder="123 4567 890" required="">

                        </div>
                        <div class="invalid-feedback" id="mob_code_error" >Please select country code and enter mobile number.</div>
                    </div>
                    <input type="hidden" class="form-control" id="role" placeholder="Role"  name="role" value="sub-instructor">
                    <div class="mb-2 col-12 password-container">
                        <label for="Password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="*********" required>
                        <div class="invalid-feedback" id="password_error">Please enter your password</div>
                    </div>
                    <div class="mb-2 col-12 password-container">
                        <label for="Password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="ConfirmPassword" name="password_confirmation"  placeholder="*********" required style="position: relative;"> 
                        <span class="toggle-password ConfirmPassword" data-toggle="#ConfirmPassword">
                            <i class="fe fe-eye toggle-password-eye field-icon show-password-eye confirm-show-Passowrd-eye bi bi-eye"></i>
                        </span>
                        <div class="invalid-feedback" id="confirm_password_error">Please enter your confirm password</div>
                    </div>
                    <div class="col-12 d-flex justify-content-end pt-2">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary createEmentor" >Create Sub E-mentor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="topModalLabel">Alert</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <b>Please Select At Least One Record.</b>
            </div>
            <hr>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function () {
        AllEmentorList('all');
        handleSearchInput('searchInput', AllEmentorList);
    });
       $('#searchInput').on('keyup', function() {
        var table = $('.all_ementor_list').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
    $(".section-ementor-tab").on("click", function (event) {
        event.preventDefault();
        AllEmentorList($(this).data("cat"));
    });
    $('#checkAll').click(function (e) {
        $('.all_ementor_list tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });
    function AllEmentorList(action){
        $(".dataTables_filter").css('display','none');
        var baseUrl = window.location.origin + "/";
        $('.all_ementor_list').DataTable().destroy();
        $("#processingLoader").fadeIn();
        $.ajax({
            url: baseUrl +'admin/get-sub-ementor-data/'+action,
            method: 'GET',
            success: function(data) {
                
                $("#processingLoader").fadeOut();
                $(".counts").html("(" + data.length + ")");
                $('.all_ementor_list').DataTable({
                    data: data, // Pass
                    columns: [
                        {
                            data: null,
                            render: function (data, type, full, meta) {
                                 var Ementorid = '';
                                if(data.user){
                                    var Ementorid = btoa(data.user.id);
                                }
                                var isChecked = full.checked ? "checked" : "";
                                
                                // return (
                                //     '<form class="actionData"><input type="checkbox" class="form-check-input checkbox sub_chk " name="userId[]" value="' +
                                //     Studentid +
                                //     '" ' +
                                //     isChecked +
                                //     "></form>"
                                // );
                                return '<input type="checkbox"  data-deletes_id="'+Ementorid+'" class="form-check-input checkbox sub_chk" ' + isChecked + '>';
                            },
                            width:'5%'
                        },
                        {
                            data: null,
                            "render": function(data, type, full, meta) {
                                var autoincrement_no = meta.row + 1;
                                return autoincrement_no;
                            },
                            width:'10%'
                        },
                        { 
                            data: null,
                            render: function (row) {
                                var name ='';
                                var img ='';
                                var editUrl= '';
                                var Status ='';
                                if(row.user){
                                    var name = row.user.name != '' ? row.user.name : '';
                                    var img = row.user.photo ? baseUrl + 'storage/' + row.user.photo : baseUrl + 'storage/ementorDocs/e-mentor-profile-photo.png';
                                    if(row.user.is_active == 'Active'){
                                            var Status = '<span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>';
                                    }else{
                                        var Status = '<span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>';
                                    }
                                    var editUrl ="sub-e-mentors-edit/"+btoa(row.user.id);
                                }
                                return (
                                    "<div class='d-flex align-items-center'><img src='" + 
                                    img +
                                    "' alt='' class='rounded-circle avatar-md me-2'><h5 class='mb-0'><a href='" + editUrl + "'>" +
                                    name + ' ' + Status +
                                    "</a></h5></div>"
                                );
                            },
                            width:'35%'
                        },
                        { 
                            data: null,
                            "render": function(row) {
                                var status = row.status === '0' ? 'Active' : 'Inactive';
                                // if(status == ''){
                                    // return row.user.is_active;
                                // }else{
                                    return status;
                                // }
                            },
                            width:'20%'
                        },
                        { 
                            data: null,
                            render: function (row) {
                                const dateTimeStr = row.created_at; // 'dd-mm-yyyy hh:mm:ss'
                                const [day, month, year] = dateTimeStr.split(/[- ]/); // Split by '-' and ' '
                                return `${day}-${month}-${year}`; // Format as 'dd-mm-yyyy'
                            },
                            width:'15%'
                        },
                        { 
    
                            data: null,
                            "render": function(row) {
                                
                                var editUrl ='';
                                var adminId =''
                                if(row.user){
                                    var adminId = row.user.id != '' ? row.user.id : ''; 
                        
                                    var editUrl ="sub-e-mentors-edit/"+btoa(adminId);
                                }
                                // var Action = '<div class="hstack gap-3"><a href="' + editUrl + '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="deleteEmentor" data-status="'+btoa('delete')+'" data-delete_id="'+btoa(adminId)+'"><i class="fe fe-trash"></i></a><span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a><span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
                                    
                                var Action = '<div class="hstack gap-3"><a href="' + editUrl + '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="deleteEmentor" data-status="'+btoa('delete')+'" data-delete_id="'+btoa(adminId)+'" data-source="sub-e-mentor"><i class="fe fe-trash"></i></a><span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a><span class="dropdown-menu"><span class="dropdown-header">Settings</span>';

                                
                                if(adminId  != ''){
                                    if(row.status == '1'){ 
                                        Action += '<a class="dropdown-item statusEmentor" href="#" data-status="'+btoa('ementor_status_active')+'" data-ementor_id="'+btoa(row.user.id)+'" data-source="sub-e-mentor">  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Active</a> </div>'; 
                                    }
                                    if(row.status == '0'){ 
                                        Action += '<a class="dropdown-item statusEmentor" href="#" data-status="'+btoa('ementor_status_inactive')+'" data-ementor_id="'+btoa(row.user.id)+'" data-source="sub-e-mentor"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Inactive </a> </div>';
                                    }
                                }
                                Action +'</span></span></div>';
                            
                                // Action +=    "</div>";
                                return Action;

                            },
                            width:'15%'
                        }
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

    document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-password').forEach(function(togglePassword) {
                togglePassword.addEventListener('click', function () {
                    const targetInput = document.querySelector(togglePassword.getAttribute('data-toggle'));
                    const togglePasswordIcon = togglePassword.querySelector('.toggle-password-eye');
                    const type = targetInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    targetInput.setAttribute('type', type);
                    togglePasswordIcon.classList.toggle('bi-eye');
                    togglePasswordIcon.classList.toggle('bi-eye-slash');
                });
            });
        });

        $('#ementor-create-modal').on('shown.bs.modal', function () {
            $('#mob_code').select2({
                dropdownParent: $('#ementor-create-modal'),
                placeholder: "Select",
            });
});
    </script>
@endsection
