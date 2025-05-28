<!-- Header import -->
@extends('admin.layouts.main')
 @section('content')
@section('css')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}

<style>
.ConfirmPassword{
    margin-top:-24px;
}
    </style>
@endsection
    <!-- Container fluid -->
    <section class="container-fluid p-4">
        <div class="row justify-content-between ">
            <!-- Page Header -->
            <div class="col-lg-4 col-12">
                <div class=" pb-3 mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Students
                            <span class="fs-5" id="count"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="#">Students</a></li>
                                <!-- <li class="breadcrumb-item active" aria-current="page">All Admin</li> -->
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">


                    </div>
                </div>
            </div>
            
            <form id="exportFormWithoutFilter" action="{{ route('export') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="category" value="all">
                <input type="hidden" name="where" value="">
                <input type="hidden" name="export" value="studentData">
            </form>
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
                        <button type="button" class="btn btn-outline-primary deleteStudent">
                            Delete <i class="fe fe-trash ms-1"></i>
                        </button>
                       </div>
                       <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                            <a href="#" id="exportButtonWithoutFilter" data-route="{{ route('export') }}" class="btn btn-outline-primary">
                                Export <i class="fe fe-upload ms-1"></i>
                            </a>
                       </div>
                      
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
                                    <a class="nav-link active section-student-tab" data-cat="all" data-bs-toggle="pill" href="#all-admin" role="tab"  aria-selected="true">All</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-student-tab" data-cat="verified" data-bs-toggle="pill" href="#active-admin" role="tab" aria-selected="false" tabindex="-1">Verified</a>
                                </li>
                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link section-student-tab" data-cat="pending" data-bs-toggle="pill" href="#active-admin" role="tab" aria-selected="false" tabindex="-1">Pending for Approval</a>
                                </li> --}}
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-student-tab" data-cat="Rejected" data-bs-toggle="pill" href="#active-admin" role="tab" aria-selected="false" tabindex="-1">Rejected</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-student-tab" data-cat="unverified" data-bs-toggle="pill" href="#active-admin" role="tab" aria-selected="false" tabindex="-1">Unverified</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-student-tab" data-cat="Active" data-bs-toggle="pill" href="#active-admin" role="tab" aria-selected="false" tabindex="-1">Active</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-student-tab" data-cat="Inactive" data-bs-toggle="pill" href="#active-admin" role="tab" aria-selected="false" tabindex="-1">Inactive</a>
                                </li>
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
                                <div class="col-auto">
                                    <!-- form select -->
                                    {{-- <select class="form-select" aria-label="Default select example">
                                        <option selected="">Filter</option>
                                        <option value="Newest">Newest</option>
                                        <option value="Price: High-Low">Verified</option>
                                        <option value="Price: Low-High">Unverified</option>
                                        <option value="Price: Low-High">Hold</option>
                                        <option value="Price: Low-High">Pending</option>
                                        <option value="Price: Low-High">Award</option>
                                        <option value="Price: Low-High">Certificate</option>
                                        <option value="Price: Low-High">Diploma</option>
                                        <option value="Price: Low-High">Masters</option>
                                    </select> --}}
                                </div>
                            </div>
                        </div>
                    </div>


                        <!-- Form -->
                        <div class="col-sm-12 col-md-12 col-lg-12 p-3">
                            <div class="row justify-content-end d-flex">
                                <!-- Search Form -->
                                {{-- <div class="col-auto">
                                    <form class="d-flex align-items-center col-lg-8 mt-3 mt-md-0 mb-3 mb-md-0 w-100">
                                        <span class="position-absolute ps-3 search-icon">
                                            <i class="fe fe-search"></i>
                                        </span>
                                        <input type="search" class="form-control ps-6" id="searchInput" placeholder="Search Here">
                                    </form>
                                </div> --}}
                    
                                <!-- Date Input and Export Button -->
                                <div class="col-auto d-flex align-items-center mt-2 mt-xxl-0">
                                    <form id="searchForm" class="d-flex flex-column flex-sm-row align-items-baseline">
                                        <div class="me-2 mb-2 mb-md-0">
                                            <input type="date" id="start_date" name="start_date" class="form-control" aria-label="Start Date" placeholder="From Date" required>
                                            <div class="text-danger small mt-1" id="start_date_error" style="display: none;">Start date is required</div>
                                        </div>
                                        <div class="me-2 mb-2 mb-md-0">
                                            <input type="date" id="end_date" name="end_date" class="form-control" aria-label="End Date" placeholder="To Date" required>
                                            <div class="text-danger small mt-1" id="end_date_error" style="display: none;">End date is required</div>
                                        </div>
                                        <button id="search_button" class="btn btn-outline-primary" style="white-space: nowrap">
                                            Search <i class="fe fe-search ms-1"></i>
                                        </button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>

                    <div>
                        <div class="tab-content" id="tabContent">
                            <!-- Tab -->

                            <!-- All Students Tab  -->
                            <div class="tab-pane fade active show student-tab" role="tabpanel" aria-labelledby="student-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentList"  width="100%">
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
                                                    {{-- <th>Enrolled</th> --}}
                                                    <th>Course Name</th>
                                                    {{-- <th>Total Payment</th> --}}
                                                    <th>Exam</th>
                                                    <th>Course Status</th>
                                                    <th>Joined</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                {{-- <tr>
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
                                                    <td><span class="badge text-success bg-light-success">Verified</span></td>
                                                    <td>2 Courses</td>
                                                    <td>Masters of Arts in Human Resource Management <br> Award in Recruitment and Employee Selection</td>
 
                                                    <td>€ 4500 <br> € 1500</td>
                                                    <td>7 July, 2020</td>
        
        
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a href="{{route('admin.edit-student')}}" data-bs-toggle="tooltip" data-placement="top"
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
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                </div>
                            </div>


                            <!-- Enrolled Admin Tab  -->
                            {{-- <div class="tab-pane fade" id="enrolled-students" role="tabpanel" aria-labelledby="enrolled-students-tab">
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
                                                    <th>Enrolled</th>
                                                    <th>Course Name</th>
                                                    <th>Progress</th>
                                                    <th>Total Payment</th>
                                                    <th>Learning</th>
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
                                                            <img src="{{asset('admin/images/avatar/avatar-15.jpg')}}" alt=""
                                                                class="rounded-circle avatar-md me-2">
                                                            <h5 class="mb-0">Rivao Luke</h5>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge text-success bg-light-success">Verified</span></td>
                                                    <td>2 Courses</td>
                                                    <td>Masters of Arts in Human Resource Management <br> Award in Recruitment and Employee Selection</td>
 
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="me-2"><span>80%</span></div>
                                                            <div class="progress w-100" style="height: 6px">
                                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="me-2"><span>50%</span></div>
                                                            <div class="progress w-100" style="height: 6px">
                                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>€ 4500 <br> € 1500</td>
                                                    <td><a href="{{route('admin.learning')}}" class="btn btn-success btn-sm">Learning</a></td>
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a href="student-edit.php" data-bs-toggle="tooltip" data-placement="top"
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
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Create New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row needs-validation studentFrom" novalidate>
                    <div class="mb-2 col-6">
                        <label for="FirstName" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="fname" name="name" placeholder="First Name" required>
                         <input type="text" name="role_name" value="user" id="role_name" required hidden />
                            <div class="invalid-feedback" id="first_name_error">Please enter first name.</div>
                    </div>
                    <div class="mb-2 col-6">
                        <label for="LastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="LastName" name="last_name" placeholder="Last Name" required>
                        <div class="invalid-feedback" id="last_name_error" >Please enter last name.</div>
                    </div>
                    <div class="mb-2 col-12">
                        <label for="EmailId" class="form-label">Email Id <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="Email Id"  name="email" id="email" required />
                      <div class="invalid-feedback" id="email_error" >Please enter email id.</div>
                    </div>
                   
                    <div class="mb-2 col-12">
                        <label for="MobileNumber" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                        <div class="mobile-with-country-code">
                            <select class="form-select" aria-label="Default select example" id="mob_code" name="mob_code">
                                <option value="">Select</option>
                                 @foreach (getDropDownlist('country_master',['id','country_code','country_code']) as $mob_code)
                                    <option value="+{{$mob_code->country_code}}"> +{{$mob_code->country_code}}</option>
                                    @endforeach
                            </select>
                            {{-- <div class="invalid-feedback" id="mob_code_error" >Please select Mob Code</div> --}}
                            <input type="number" id="mobile" class="form-control" name="mobile" placeholder="123 4567 890" required="">
                        </div>
                        <div class="invalid-feedback" id="mobile_error" >Please select country code and enter mobile.</div>
                    </div>
                    <div class="mb-2 col-12 password-container">
                        <label for="Password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="*********" required>
                        {{-- <span class="toggle-password" toggle="#password">
                            <i class="fe fe-eye toggle-password-eye field-icon show-password-eye"></i>
                        </span> --}}
                        <div class="invalid-feedback" id="password_error">Please enter password.</div>
                    </div>
                    <div class="mb-2 col-12 password-container">
                        <label for="Password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <div class="password-input-container">
                            <input type="password" class="form-control" id="ConfirmPassword" name="password_confirmation"  placeholder="*********" required>
                            <span class="toggle-password ConfirmPassword" data-toggle="#ConfirmPassword">
                                <i class="fe fe-eye toggle-password-eye field-icon show-password-eye bi bi-eye"></i>
                            </span>
                        </div>
                        <div class="invalid-feedback" id="confirm_password_error">Please enter confirm password.</div>
                    </div>

                    <div class="col-12 d-flex justify-content-end pt-2">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="studentCreate">Create Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('admin/js/export.js')}}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    studentList("all");
    handleSearchInput('searchInput',function(){
        studentList("all");
    });

    // $('#search_button').on('click', function (e) {
    //     e.preventDefault();
    //     var startDate = $('#start_date').val();
    //     var endDate = $('#end_date').val();

    //     if (startDate && endDate) {  
    //         studentList("all");
    //     } else {
    //         alert("Please select both Start Date and End Date!");
    //     }
    // });

    $('#search_button').on('click', function (e) {
        e.preventDefault();

        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();

        // Hide previous errors
        $('#start_date_error, #end_date_error').hide();

        let hasError = false;

        if (!startDate) {
            $('#start_date_error').show();
            hasError = true;
        }

        if (!endDate) {
            $('#end_date_error').show();
            hasError = true;
        }

        if (!hasError) {
            studentList("all");
        }
    });


});
$('#checkAll').click(function (e) {
    $('.studentList tbody :checkbox').prop('checked', $(this).is(':checked'));
    e.stopImmediatePropagation();
});

 function studentList(token) {
    $("#processingLoader").fadeIn();
     var baseUrl = window.location.origin + "/";
     $(".loader").removeClass("d-none");
    var startDate = $('#start_date').val();
    var endDate = $('#end_date').val();
    //  $.ajax({
    //   url: baseUrl + "admin/students-get-data/" + token,
    //   method: "GET",
    //   success: function (data) {
    //         $('.studentList').DataTable().clear().destroy();
    //         $("#count").html("(" + data.length + ")");
    //          $(".studentList").DataTable({
    //              data: data, // Pass
    //              columns: [
    //                  {
    //                    data: "id",
    //                         render: function (data, type, full, meta) {
    //                         var Studentid = btoa(full.id);
    //                         var isChecked = full.checked ? "checked" : "";
                            
    //                          return (
    //                              '<form class="actionData"><input type="checkbox" class="form-check-input checkbox sub_chk " name="userId[]" data-deletes_id="'+Studentid+'" value="' +
    //                              Studentid +
    //                              '" ' +
    //                              isChecked +
    //                              "></form>"
    //                          );
    //                      },
    //                      width:'0%'
    //                  },
    //                  {
    //                      data: null,
    //                      render: function (data, type, full, row) {
    //                          i = row.row + 1;
    //                          return i;
    //                      },
    //                      width:'10%'
    //                  },
    //                  {
    //                      data: null,
    //                      render: function (row) {
    //                          // console.log(row.user);
    //                          var Studentid = btoa(row.id);
    //                          var name = row.name ? row.name+' '+row.last_name : '';
    //                          var profileUrl = baseUrl + 'admin/students-edit-view/' + Studentid; 
    //                          var img = row.photo ? baseUrl + 'storage/' + row.photo : baseUrl + 'storage/studentDocs/student-profile-photo.png';

    //                          var statusBadge = row.is_active == 'Active' ? 
    //                              '<span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>' : 
    //                              '<span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>';

    //                         return (
    //                             "<div class='d-flex align-items-center'>" +
    //                             "<img src='" + img + "' alt='' class='rounded-circle avatar-md me-2'>" +
    //                             "<h5 class='mb-0'>" +
    //                             "<a href='" + profileUrl + "'>" + name + "</a> " + statusBadge +
    //                             "</h5></div>"
    //                         );
    //                     },
    //                     width:'15%',
    //                 },

    //                 {
    //                     data: null,
    //                     render: function (data) {
    //                         var status = data.is_verified ? data.is_verified : ''; 
    //                         if (status === "Verified") {
    //                             return (
    //                                 "<span class='badge text-success bg-light-success'>" +
    //                                 status +
    //                                 "</span>"
    //                             );
    //                         }
    //                         if (status === "Pending") {
    //                             return (
    //                                 '<span class="badge text-warning bg-light-warning">' +
    //                                 status +
    //                                 "</span>"
    //                             );
    //                         }
    //                         if (status === "Unverified") {
    //                             return (
    //                                 '<span class="badge text-danger bg-light-danger">' +
    //                                 status +
    //                                 "</span>"
    //                             );
    //                         } else {
    //                             return (
    //                                 '<span class="badge text-secondary bg-light-secondary">' +
    //                                 status +
    //                                 "</span>"
    //                             );
    //                         }
    //                     },
    //                     width:'15%',
    //                 },
    //                 {
    //                     data: null,
    //                     render: function (row) {
    //                         var courseTitles = [];
    //                         let badge = '';
    //                         // console.log(row.orderlist);
    //                         if (row.paidCourses && row.paidCourses.length > 0) {
    //                             // let courseTitles = [];
    //                             row.paidCourses.forEach(function(course, index) {
                                 
    //                                 // Append the badge to courseTitles
    //                                 courseTitles += '<p class="mb-2">';
    //                                     courseTitles += `${index + 1}. ${course.course_title}`;
    //                                 courseTitles += '</p>';


    //                             });
    //                             // if (courseTitles.endsWith(', ')) {
    //                             //     courseTitles = courseTitles.slice(0, -2)+' - '+badge; 
    //                             //     courseTitles = courseTitles.replace(/,/g, "<br>");
    //                             // }
    //                         }
    //                         return courseTitles;  // Combines the titles into a single string

    //                     },
    //                     width:'30%',
    //                 },
    //                 {
    //                     data: null,
    //                     render: function (row) {
    //                         var courseTitles = [];
    //                         let badge = '';
    //                         // console.log(row.orderlist);
    //                         if (row.paidCourses && row.paidCourses.length > 0) {
    //                             // let courseTitles = [];
    //                             row.paidCourses.forEach(function(course) {
    //                                 let examData = row.examResults && row.examResults[course.scmId] ? row.examResults[course.scmId] : null;
                                   
    //                                 if (examData) {
    //                                     badge = `<span class="mb-2 badge bg-${examData.color}">${examData.result} ${examData.percent ? examData.percent + '%' : ''}</span>`;
    //                                 } else {
    //                                     badge = `<span class="badge bg-primary mb-2">Not Attempt</span>`;
    //                                 }

    //                                 // Append the badge to courseTitles
    //                                 courseTitles += `${badge}<br>`;

    //                             });
    //                             // if (courseTitles.endsWith(', ')) {
    //                             //     courseTitles = courseTitles.slice(0, -2)+' - '+badge; 
    //                             //     courseTitles = courseTitles.replace(/,/g, "<br>");
    //                             // }
    //                         }
    //                         return courseTitles;  // Combines the titles into a single string

    //                     },
    //                     width:'30%',
    //                 },
    //                 {
    //                     data: null,
    //                     render: function (row) {
    //                         var joined = '';
    //                         if(row){
    //                             const dateTimeStr =new Date(row.created_at); // 'dd-mm-yyyy hh:mm:ss'
    //                             const day = String(dateTimeStr.getDate()).padStart(2, '0');
    //                             const month = String(dateTimeStr.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    //                             const year = String(dateTimeStr.getFullYear()); // Get last 2 digits of the year
    //                             joined = `${year}-${month}-${day}`;
    //                         }
    //                         return joined;
    //                     },
    //                     width:'10%',
    //                 },
    //                 {
    //                     data: null,
    //                     render: function (row) {
    //                         var Studentid = btoa(row.id);

    //                         var editUrl =
    //                             baseUrl +
    //                             "admin/students-edit-view/" +
    //                             Studentid;
    //                         // return (
    //                             // <a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" ><i class="fe fe-trash"></i></a>
    //                             var Action = '<div class="hstack gap-3"><a href="' +
    //                             editUrl +
    //                             '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="deleteStudent" data-delete_id="'+btoa(row.id)+'"><i class="fe fe-trash"></i></a><span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a> <span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
    //                             // <a class="dropdown-item"  href="#"><span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Active</a><a class="dropdown-item" href="#"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Inactive</a><a class="dropdown-item" href="#"><i class="fe fe-mail dropdown-item-icon"></i>Mail</a><a class="dropdown-item" href="#"><i class="fe fe-move dropdown-item-icon"></i>Move</a></span>'

    //                             // var Action = '<div class="hstack gap-3"><a id="editpromocode" data-id="'+btoa(row.id)+'" href="#"><i class="fe fe-edit"></i></a><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="deletePromoCode" data-status="'+btoa('delete')+'" data-delete_id="'+btoa(row.id)+'"><i class="fe fe-trash"></i></a><span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i> </a><span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
    //                             if(row){
    //                                 if(row.is_active == 'Inactive'){ 
    //                                     Action += '<a class="dropdown-item statusStudent" href="#" data-status="'+btoa('student_status_active')+'" data-role="students" data-student_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Active</a> </div>'; 
    //                                 }
    //                                 if(row.is_active == 'Active'){ 
    //                                     Action += '<a class="dropdown-item statusStudent" href="#" data-status="'+btoa('student_status_inactive')+'" data-role="students" data-student_id="'+btoa(row.id)+'"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Inactive </a> </div>';
    //                                 }
    //                             }
    //                             Action +'</span></span></div>';
    //                             return Action;
    //                         // );
    //                     },
    //                     width:'10%',
    //                 },
    //                 // Add more columns as needed
    //             ],
    //         });
    //     },
    //     error: function (xhr, status, error) {
    //         console.error(error);
    //     },
    // });
    $('.studentList').DataTable().clear().destroy();
    $("#processingLoader").fadeOut();
    var table = $(".studentList").DataTable({
        "processing": true,
        "serverSide": true,
        'searching': true,
        "paging": true,
        "ajax": {
            "url": baseUrl + "admin/students-get-data/" + token,
            "type": "GET",
            "data": {
                "start_date": startDate,
                "end_date": endDate
            }
        },
        "columns": [
            {   
                "data": null,
                "orderable":false,
                render: function (data, type, full, meta) {
                var Studentid = btoa(full.id);
                var isChecked = full.checked ? "checked" : "";
                
                    return (
                        '<form class="actionData"><input type="checkbox" class="form-check-input checkbox sub_chk " name="userId[]" data-deletes_id="'+Studentid+'" value="' +
                        Studentid +
                        '" ' +
                        isChecked +
                        "></form>"
                    );
                },
                width:'0%'
            },
            {
                "data": null,
                "orderable":false,
                render: function (data, type, full, meta) {
                    var PageInfo = table.page.info();
                    return meta.row + 1 + PageInfo.start; // Add 1 to the row index, and adjust by PageInfo.start
                                },
                width:'10%'
            },
            {
                "data": null,
                "orderable":true,
                    render: function (row) {
                        var Studentid = btoa(row.id);
                        var name = row.name ? row.name+' '+row.last_name : '';
                        var profileUrl = baseUrl + 'admin/students-edit-view/' + Studentid; 
                        var img = row.photo ? baseUrl + 'storage/' + row.photo : baseUrl + 'storage/studentDocs/student-profile-photo.png';

                        var statusBadge = row.is_active == 'Active' ? 
                            '<span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>' : 
                            '<span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>';

                    return (
                        "<div class='d-flex align-items-center'>" +
                        "<img src='" + img + "' alt='' class='rounded-circle avatar-md me-2'>" +
                        "<h5 class='mb-0'>" +
                        "<a href='" + profileUrl + "'>" + name + "</a> " + statusBadge +
                        "</h5></div>"
                    );
                },
                width:'15%',
            },
            {
                "data": null,
                "orderable": true,
                render: function (data) {
                    var status = data.is_verified ? data.is_verified : ''; 
                    if (status === "Verified") {
                        return (
                            "<span class='badge text-success bg-light-success'>" +
                            status +
                            "</span>"
                        );
                    }
                    if (status === "Pending") {
                        return (
                            '<span class="badge text-warning bg-light-warning">' +
                            status +
                            "</span>"
                        );
                    }
                    if (status === "Unverified") {
                        return (
                            '<span class="badge text-danger bg-light-danger">' +
                            status +
                            "</span>"
                        );
                    } else {
                        return (
                            '<span class="badge text-secondary bg-light-secondary">' +
                            status +
                            "</span>"
                        );
                    }
                },
                width:'15%',
            },
            {
                "data": null,
                "orderable": true,
                render: function (row) {
                    var courseTitles = [];
                    let badge = '';
                    if (row.paidCourses && row.paidCourses.length > 0) {
                        row.paidCourses.forEach(function(course, index) {
                            courseTitles += '<div class="course-item" style="line-height:1.5rem">';  
                            courseTitles += '<p class="">';
                            courseTitles += `${index + 1}. ${course.course_title}`;
                            courseTitles += '</p>';
                            courseTitles += '</div>';  
                        });
                    }
                    return courseTitles;  // Combines the titles into a single string

                },
                width:'30%',
            },
            {
                "data": null,
                render: function (row) {
                    var examStatus = [];
                    let badge = '';
                    if (row.paidCourses && row.paidCourses.length > 0) {
                        row.paidCourses.forEach(function(course) {
                            let examData = row.examResults && row.examResults[course.scmId] ? row.examResults[course.scmId] : null;
                            
                            if (examData) {
                                badge = `<div class="exam-status" style="line-height:1.5rem">` + 
                                        `<span class="mb-3 badge bg-${examData.color}">${examData.result} ${examData.percent ? examData.percent + '%' : ''}</span>` + 
                                        `</div>`;
                            } else {
                                badge = `<div class="exam-status" style="line-height:1.5rem">` + 
                                        `<span class="badge bg-primary mb-3">Not Attempt</span>` + 
                                        `</div>`;
                            }
                            examStatus += `${badge}`;

                        });
                    }
                    return examStatus;

                },
                width:'30%',
            },
            {
                "data": null,
                render: function (row) {
                    var examStatus = [];
                    let badge = '';
                    if (row.paidCourses && row.paidCourses.length > 0) {
                        row.paidCourses.forEach(function(course) {
                            let examData = row.statusInfo && row.statusInfo[course.scmId] ? row.statusInfo[course.scmId] : null;
                            
                            if (examData) {
                                badge = `<div class="exam-status" style="line-height:1.5rem">` + 
                                        `<span class="mb-3 badge bg-${examData.color}">${examData.status}</span>` + 
                                        `</div>`;
                            } else {
                                badge = `<div class="exam-status" style="line-height:1.5rem">` + 
                                        `<span class="badge bg-primary mb-3">Not Attempt</span>` + 
                                        `</div>`;
                            }
                            examStatus += `${badge}`;

                        });
                    }
                    return examStatus;

                },
                width:'30%',
            },
            {
                "data": null,
                render: function (row) {
                    var joined = '';
                    if(row){
                        const dateTimeStr =new Date(row.created_at); // 'dd-mm-yyyy hh:mm:ss'
                        const day = String(dateTimeStr.getDate()).padStart(2, '0');
                        const month = String(dateTimeStr.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                        const year = String(dateTimeStr.getFullYear()); // Get last 2 digits of the year
                        joined = `${year}-${month}-${day}`;
                    }
                    return joined;
                },
                width:'10%',
            },
            {
                "data": null,
                render: function (row) {
                    var Studentid = btoa(row.id);

                    var editUrl =
                        baseUrl +
                        "admin/students-edit-view/" +
                        Studentid;
                    // return (
                        // <a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" ><i class="fe fe-trash"></i></a>
                        var Action = '<div class="hstack gap-3"><a href="' +
                        editUrl +
                        '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="deleteStudent" data-delete_id="'+btoa(row.id)+'"><i class="fe fe-trash"></i></a><span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a> <span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
                        // <a class="dropdown-item"  href="#"><span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Active</a><a class="dropdown-item" href="#"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Inactive</a><a class="dropdown-item" href="#"><i class="fe fe-mail dropdown-item-icon"></i>Mail</a><a class="dropdown-item" href="#"><i class="fe fe-move dropdown-item-icon"></i>Move</a></span>'

                        // var Action = '<div class="hstack gap-3"><a id="editpromocode" data-id="'+btoa(row.id)+'" href="#"><i class="fe fe-edit"></i></a><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="deletePromoCode" data-status="'+btoa('delete')+'" data-delete_id="'+btoa(row.id)+'"><i class="fe fe-trash"></i></a><span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i> </a><span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
                        if(row){
                            if(row.is_active == 'Inactive'){ 
                                Action += '<a class="dropdown-item statusStudent" href="#" data-status="'+btoa('student_status_active')+'" data-role="students" data-student_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Active</a> </div>'; 
                            }
                            if(row.is_active == 'Active'){ 
                                Action += '<a class="dropdown-item statusStudent" href="#" data-status="'+btoa('student_status_inactive')+'" data-role="students" data-student_id="'+btoa(row.id)+'"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Inactive </a> </div>';
                            }
                        }
                        Action +'</span></span></div>';
                        return Action;
                    // );
                },
                width:'10%',
            },
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

</script>
@endsection


