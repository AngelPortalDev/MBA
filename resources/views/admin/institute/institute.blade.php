<!-- Header import -->
@extends('admin.layouts.main') @section('content')
@section('maintitle') Institute @endsection

<style>
    .select2-results{
        overflow: scroll !important;
        height: 200px !important;
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
                            Institute
                            <span class="fs-5 counts"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Institute</a></li>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-institute-modal">
                            Create <i class="fe fe-plus ms-1"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary deleteInstitute" >
                            Delete <i class="fe fe-trash ms-1"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-outline-primary ">
                            Import <i class="fe fe-download ms-1"></i>
                        </button> --}}
                        {{-- <a class="btn btn-outline-primary" role="button" data-bs-toggle="modal" data-bs-target="#import-admin-modal"> Import <i class="fe fe-download ms-1"></i></a> --}}
                        {{-- <button type="button" class="btn btn-outline-primary" href="{{ route('export') }}">
                            Export <i class="fe fe-upload ms-1"></i>
                        </button> --}}
                        {{-- <a class="btn btn-outline-primary" href="{{ route('admin.export') }}"> Export <i class="fe fe-upload ms-1"></i></a> --}}

                    </div>
                </div>


        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 mt-3 mt-lg-0 mt-0">
                <!-- Card -->
                <div class="card rounded-3">
                    <!-- Card Header -->
                    <div class="p-4 row">
                        <div class="card-header p-0 col-12 col-md-7 col-lg-7">
                            <ul class="nav nav-lb-tab border-bottom-0" id="tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active section-institute-tab"  data-cat="all" data-bs-toggle="pill" href="#all-institue" role="tab" aria-controls="all-institue" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-institute-tab"   data-cat="Active" data-bs-toggle="pill" href="#active-institue" role="tab" aria-controls="active-institue" aria-selected="false" tabindex="-1">Active</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-institute-tab"  data-cat="Inactive"  data-bs-toggle="pill" href="#inactive-institue" role="tab" aria-controls="inactive-institue" aria-selected="false" tabindex="-1">Inactive</a>
                                </li>

                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="deleted-admin-tab" data-bs-toggle="pill" href="#deleted-admin" role="tab" aria-controls="deleted-admin" aria-selected="false" tabindex="-1">Deleted</a>
                                </li> --}}
                            </ul>
                        </div>

                    
                        <!-- Form -->

                       
                        <div class="d-flex align-items-center col-12 col-md-5 col-lg-5 justify-content-end border-bottom">
                            <div class="row justify-content-end">
                                {{-- <form class="d-flex align-items-center col-lg-8 mt-3 mt-md-0 mb-3 mb-md-0 w-100">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-6" id="searchInput" placeholder="Search Here">

                                </form> --}}
                                
                                <div class="col-auto">
                                    <form class="d-flex align-items-center mb-0 mb-xlx-2">
                                        <span class="position-absolute ps-3 search-icon">
                                            <i class="fe fe-search"></i>
                                        </span>
                                        <input type="search" class="form-control ps-6 searchStudent mt-2 mt-md-0" id="searchInput" placeholder="Search Here">
                                    </form>
                                </div>
                                
                                <!-- Date Input and Export Button -->
                                <div class="col-auto d-flex align-items-center mb-2 mt-2 mt-xxl-0 mt-sm-0">
                                    @php
                                        $allInstitutes = DB::table('users')
                                        ->where('role', 'institute')
                                        ->where('is_deleted', 'No')
                                        ->where('block_status', '0')
                                        ->get();
                                    @endphp
                                    
                                    <form id="exportForm" action="{{ route('export') }}" method="POST" class="d-flex flex-column flex-xl-row align-items-baseline mt-3">
                                        @csrf

                                        <div class="me-2 mb-2 selectSearchdropdownstyle" style="min-width: 300px;">
                                            <select name="institutes[]" id="institutes" class="form-control d-none" multiple required>
                                                @foreach ($allInstitutes as $institute)
                                                    <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                                                               
                                        <div class="me-2 mb-2 mb-lg-0">
                                            <input type="date" id="start_date" name="start_date" class="form-control" aria-label="Start Date" placeholder="From Date" required>
                                        </div>

                                        <div class="me-2 mb-2 mb-xl-0">
                                            <input type="date" id="end_date" name="end_date" class="form-control" aria-label="End Date" placeholder="To Date" required>
                                        </div>
                                        <button type="button" id="clearButton" class="btn btn-outline-secondary me-2 mb-2 mb-xl-0" style="width: max-content">
                                            Clear <i class="fe fe-x ms-1"></i>
                                        </button>
                                        <input type="hidden" name="export" value="instituteReportData">
                                        <button id="exportButton" class="btn btn-outline-primary me-2" style="white-space: nowrap">
                                            Export <i class="fe fe-upload ms-1"></i>
                                        </button>

                                        
                                    </form>
                                </div>

                            
                                <!-- input -->
                                <div class="col-auto" style="display: none;">
                                    <!-- form select -->
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected="">Filter</option>
                                        <option value="Newest">Newest</option>
                                        <option value="Price: High-Low">Active</option>
                                        <option value="Price: Low-High">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div>
                        <div class="tab-content" id="tabContent">
                            <!-- Tab -->

                            <!-- All Admin Tab  -->
                            <div class="tab-pane fade active show" role="tabpanel" aria-labelledby="all-institute-tab" >
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table mb-0 text-nowrap table-hover w-100 all_institute_list"  width="100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Sr. No.</th>
                                                    <th>Code</th>
                                                    <th>English Test Code</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    {{-- <th>Mobile</th> --}}
                                                    <th>Approval Status</th>
                                                    <th>Status</th>
                                                    <th>Joined</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                </div>
                            </div>


                            <!-- Active Admin Tab  -->
                            <div class="tab-pane fade" id="active-admin" role="tabpanel" aria-labelledby="active-admin-tab">
                                <div class="table-responsive" >
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        {{-- <table class="table mb-0 text-nowrap table-hover all_admin_list"  width="100%">
                                            

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
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Status</th>
                                                    <th>Joined</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table> --}}
                                </div>
                            </div>

                            <!-- Inactive Admin Tab  -->
                            <div class="tab-pane fade" id="inactive-admin" role="tabpanel" aria-labelledby="inactive-admin-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        {{-- <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover all_admin_list" >
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
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Status</th>
                                                    <th>Joined</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table> --}}
                                </div>
                            </div>

                            <!-- Deleted Admin Tab  -->
                            
                            {{-- <div class="tab-pane fade" id="deleted-admin-tab" role="tabpanel" aria-labelledby="deleted-admin-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover all_admin_list">
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
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Status</th>
                                                    <th>Joined</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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

    <!-- Create Admin Modal -->
    <div class="modal fade" id="create-institute-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Create New Institute</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row universityForm" novalidate>
                        <div class="mb-2 col-12">
                            <label for="FirstName" class="form-label">Institute Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="university_name" placeholder="Institute Name" name="university_name" required>
                            <div class="invalid-feedback" id="university_name_error" >Please enter institute name.</div>
                        </div>
                        {{-- <div class="mb-2 col-6">
                            <label for="LastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" placeholder="Last Name"  name="last_name" required>
                            <div class="invalid-feedback" id="last_name_error">Please enter last name.</div>
                        </div> --}}
                        <div class="mb-2 col-12">
                            <label for="EmailId" class="form-label">Email Id <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" placeholder="Email Id" name="email" required>
                            <div class="invalid-feedback" id="email_error">Please enter email.</div>
                            {{-- <div class="invalid-feedback" id="email_ptrn_error">Email id e.g abc@gmail.com</div> --}}
                            {{-- <div class="invalid-feedback" id="email_exists_error" >Already Exists.</div> --}}
                        </div>
                        <div class="mb-2 col-12">
                            <label for="MobileNumber" class="form-label">Contact Number <span class="text-danger">*</span></label>
                            <div class="mobile-with-country-code">
                                <select class="form-select" name="mob_code" aria-label="Default select example" id="mob_code">
                                    <option value="">Select</option>
                                    @foreach (getDropDownlist('country_master',['country_code']) as $mob_code)
                                    <option value="+{{$mob_code->country_code}}"> +{{$mob_code->country_code}}</option>
                                    @endforeach
                                </select>
                                <input type="number" id="mobile" class="form-control" name="mobile" placeholder="123 4567 890" required="">
                            </div>
                            <div class="invalid-feedback" id="mob_code_error" >Please select the country code and enter mobile number.</div>
                        </div>
                        {{-- <div class="mb-2 col-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea id="address" name="address" rows="3"  class="form-control" placeholder="address" required></textarea>
                            <div class="invalid-feedback" id="address_error">Please enter address.</div>
                        </div>
                        <div class="mb-2 col-12">
                            <label for="website" class="form-label">Website</label>
                            <input type="text" id="website" name="website" class="form-control" placeholder="website" >
                            <div class="invalid-feedback" id="website_error">Please enter website.</div>
                        </div> --}}
                        <div class="mb-2 col-12">
                            <label for="Password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="*********" required>
                            <div class="invalid-feedback" id="password_error">Please enter password.</div>
                            {{-- <div id="password_error1" class="invalid-feedback">Password Should be Atleast 8 Character with AlphaNumeric & Spec.Char (e.g Abc@12345)</div> --}}
                        </div>
                        <div class="mb-2 col-12 password-container">
                            <label for="ConfirmPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="confirm_password"  name="confirm_password"  placeholder="*********" required>
                            <span class="toggle-password ConfirmPassword" data-toggle="#confirm_password">
                                <i class="fe fe-eye toggle-password-eye field-icon show-password-eye bi bi-eye" style="top:50px; right:25px"></i>
                            </span>
                            <div class="invalid-feedback" id="confirm_password_error">Please enter confirm password.</div>
                            {{-- <div class="invalid-feedback" id="confirm_password_error1">Confirm Password Doesn't Match</div> --}}
                        </div>
                        <div class="col-12 d-flex justify-content-end pt-2">
                            <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary instituteCreate" >Create Institute</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Delete manually Modal  -->
    {{-- <div id="delete-modal" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body p-2">
                    <div style="float: right;">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="text-center">
                        <i class="ri-information-line h1 text-info"></i>
                        <h5 class="mt-2">Are you sure you want to delete this records?</h5>
                        <button type="button" class="btn btn-primary my-2" data-bs-dismiss="modal" id="deleteAdmin">Delete</button>
                        <input type="hidden" name="adminId" id="adminId" value=""/>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 
     --}}
    
    {{-- <div id="alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
    </div><!-- /.modal --> --}}

               <!-- Import Modal  -->
    <div class="modal fade" id="import-admin-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Import</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row needs-validation" novalidate id="importFile">
                    <div class="mb-2 col-12">
                        <label for="File" class="form-label">Choose File</label>
                        <input type="file" class="form-control" id="customfile" placeholder="File" name="customfile" required>
                        <div class="invalid-feedback" id="file_error" ></div>
                    </div>
                    <div class="col-12 d-flex justify-content-end pt-2">
                        <input type="submit" class="btn btn-primary importAdmin" value="Import">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('admin/js/export.js') }}"></script>
<script>
$(document).ready(function () {
    AllInstituteList('all');
    handleSearchInput('searchInput', AllInstituteList);

  
    $(".section-institute-tab").on("click", function (event) {
        event.preventDefault();
        AllInstituteList($(this).data("cat"));
    });
});
$('#checkAll').click(function (e) {
    $('.all_institute_list tbody :checkbox').prop('checked', $(this).is(':checked'));
    e.stopImmediatePropagation();
});
function AllInstituteList(action){
    $("#processingLoader").fadeIn();
    $(".dataTables_filter").css('display','none');
    var baseUrl = window.location.origin + "/";
    $('.all_institute_list').DataTable().destroy();
    $.ajax({
    url: baseUrl +'admin/get-institute-list/'+action,
        method: 'GET',
        success: function(data) {
            $("#processingLoader").fadeOut();
            $(".counts").html("(" + data.length + ")");
            $('.all_institute_list').DataTable({
                data: data, // Pass
                columns: [
                    {
                        data: 'id',
                        "render": function(data, type, full, meta) {
                            var adminid = btoa(full.user.id);
                            var isChecked = data.checked ? 'checked' : '';
                            return '<input type="checkbox"  data-deletes_id="'+adminid+'" class="form-check-input checkbox sub_chk" ' + isChecked + '>';
                           
                        },
                        width:'0%'
                    },
                    {
                        data: null,
                        "render": function(row, type, full, meta) {
                            var autoincrement_no = meta.row + 1;
                            return autoincrement_no;
                        },
                        width:"10%"
                    },
                    {
                        data: null,
                        "render": function(row, type, full, meta) {
                            var university_code = row.university_code;
                            return university_code;
                        },
                        width:"10%"
                    },
                    {
                        data: null,
                        "render": function(row, type, full, meta) {
                            var englist_test_pass_code = row.englist_test_pass_code;
                            return englist_test_pass_code;
                        },
                        width:"10%"
                    },
                    {
                        data: null,
                        render: function (row) {
                            var name = row.user.name ? row.user.name : '';

                            // Extract the photo and encode only the filename part
                            // var photo = row.user.photo ? row.user.photo : 'instituteDocs/institute-profile-photo.jpeg';
                            var photo = row.user.photo ? row.user.photo : (row.logo ? row.logo : 'frontend/images/colleges/Institute.jpg');


                            // Split the path and encode only the filename
                            var photoParts = photo.split('/');
                            var fileName = encodeURIComponent(photoParts.pop());
                            var photoPath = photoParts.join('/') + '/' + fileName;

                            // Construct the full image source URL
                            var imgSrc = baseUrl + 'storage/' + photoPath;

                            var editUrl = "institute-edit/" + btoa(row.id);

                            return (
                                "<div class='d-flex align-items-center'>" +
                                    "<img src='" + imgSrc + "' alt='Image' class='rounded-circle avatar-md me-2' onerror=\"this.src='" + baseUrl + "frontend/images/colleges/Institute.jpg'\">" +
                                    "<h5 class='mb-0'>" +
                                        "<a href='" + editUrl + "'>" + name + "</a> " +
                                    "</h5></div>"
                            );
                        },
                        width: '20%'
                    },
                    { 
                        data: null,
                        render: function (row) {
                            var email = row.user.email;
                           return email;
                        },
                        width: '20%'
                    },
                    // { 
                    //     data: null,
                    //     render: function (row) {
                    //         var website = row.website;
                    //        return website;
                    //     },
                    // },
                    { 
                        data: null,
                        "render": function(row) {
                            console.log(row.is_approved);
                            
                            let statusText = '';
                            let badgeClass = '';

                            switch (row.is_approved) {
                                case 0:
                                    statusText = 'Pending';
                                    badgeClass = 'bg-warning';
                                    break;
                                case 1:
                                    statusText = 'Approved';
                                    badgeClass = 'bg-success';
                                    break;
                                case 2:
                                    statusText = 'Rejected';
                                    badgeClass = 'bg-danger';
                                    break;
                                case 4:
                                    statusText = 'Re-upload';
                                    badgeClass = 'bg-secondary';
                                    break;
                                default:
                                    statusText = 'Unknown';
                                    badgeClass = 'bg-info';
                            }

                            return `<span class="badge-dot ${badgeClass} me-1 d-inline-block align-middle"></span>${statusText}`;
                        },
                        width: "15%"
                    },
                    { 
                        data: null,
                        "render": function(row) {
                            var status = row.status === '0' ? 'Active' : 'Inactive';
                            if(status == 'Active'){
                                return '<span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>' + status + '';
                            }else{
                                return '<span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>' + status + '';
                            }
                        },
                        width:"10%"
                    },
                    { 
                        data: null,
                        width:"10%",
                        render: function (row) {
                            const dateTimeStr = row.user.last_seen; // 'dd-mm-yyyy hh:mm:ss'
                            const [day, month, year] = dateTimeStr.split(/[- ]/); // Split by '-' and ' '
                            return `${day}-${month}-${year}`; // Format as 'dd-mm-yyyy'
                        },

                    },
                    { 

                        data: null,
                        "render": function(row) {
                            var adminId = row.user.id; 
                            var editUrl ="institute-edit/"+btoa(row.id);                           
                            var Action = '<div class="hstack gap-3"><a href="' + editUrl + '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="deleteInstitute" data-status="'+btoa('delete')+'" data-delete_id="'+btoa(adminId)+'"><i class="fe fe-trash"></i></a><span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a><span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
                            if(row.status == '1'){ 
                                Action += '<a class="dropdown-item statusInstitute" href="#" data-status="'+btoa('institute_status_active')+'" data-role="institute" data-institute_id="'+btoa(row.user.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Active</a> </div>'; 
                            }
                            if(row.status == '0'){ 
                                Action += '<a class="dropdown-item statusInstitute" href="#" data-status="'+btoa('institute_status_inactive')+'" data-role="institute" data-institute_id="'+btoa(row.user.id)+'"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Inactive </a> </div>';
                            }
                            Action +'</span></span></div>';
                            // Action +=    "</div>";
                            return Action;
                            
                        },
                        width:"10%"

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

        $('#searchInput').on('keyup', function() {
            var table = $('.all_institute_list').DataTable();
            var searchTerm = $(this).val();
            table.search(searchTerm).draw();
        });
        // const searchInput = document.getElementById('searchInput');
        // searchInput.addEventListener('input', () => {
        //     if (searchInput.value === '') {
        //         const currentAction = getCurrentAction(); 
        //         AllAdminList(currentAction);
        //     }
        // });

        // function getCurrentAction() {
        //     if ($("#active-admin-tab").hasClass('active')) {
        //         return 'active';
        //     } else if ($("#inactive-admin-tab").hasClass('active')) {
        //         return 'inactive';
        //     } else {
        //         return 'all';
        //     }
        // }

        $('#clearButton').on('click', function () {
            $('#exportForm')[0].reset();
            $('#institutes').val(null).trigger('change');
            $('#exportForm input').removeClass('is-invalid');
            $('#exportForm .invalid-feedback').remove();
        });


        $(document).ready(function() {
            const $select = $('#institutes');
        $('#institutes').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Select',
            closeOnSelect: true
        });
       $select.removeClass('d-none');
    $('#institutes').on('change', function() {
        // Get all selected options
        var selectedOptions = $('#institutes option:selected');
        var selectedValues = selectedOptions.map(function() {
            return this.value;
        }).get();

        // Reorder options
        $('#institutes option').each(function() {
            if (selectedValues.indexOf(this.value) !== -1) {
                $(this).appendTo('#institutes');
            }
        });
    });

})

</script>
@endsection
