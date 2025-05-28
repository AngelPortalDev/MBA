<!-- Header import -->
@extends('admin.layouts.main') @section('content')
@section('maintitle') Admin @endsection

<style>
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
                            Admin
                            <span class="fs-5 counts"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Admin</a></li>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">
                            Create <i class="fe fe-plus ms-1"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary deleteAdmin" >
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
                                    <a class="nav-link active section-admin-tab"   data-cat="all" data-bs-toggle="pill" href="#all-admin" role="tab" aria-controls="all-admin" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-admin-tab"   data-cat="active" data-bs-toggle="pill" href="#active-admin" role="tab" aria-controls="active-admin" aria-selected="false" tabindex="-1">Active</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-admin-tab"  data-cat="inactive"  data-bs-toggle="pill" href="#inactive-admin" role="tab" aria-controls="inactive-admin" aria-selected="false" tabindex="-1">Inactive</a>
                                </li>

                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="deleted-admin-tab" data-bs-toggle="pill" href="#deleted-admin" role="tab" aria-controls="deleted-admin" aria-selected="false" tabindex="-1">Deleted</a>
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
                            <div class="tab-pane fade active show" role="tabpanel" aria-labelledby="all-admin-tab" >
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table mb-0 text-nowrap table-hover all_admin_list w-100"  width="100%">
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
    <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Create New Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row needs-validation adminData" novalidate>
                        <div class="mb-2 col-6">
                            <label for="FirstName" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" required>
                            <div class="invalid-feedback" id="first_name_error" >Please enter first name.</div>
                        </div>
                        <div class="mb-2 col-6">
                            <label for="LastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" placeholder="Last Name"  name="last_name" required>
                            <div class="invalid-feedback" id="last_name_error">Please enter last name.</div>
                        </div>
                        <div class="mb-2 col-12">
                            <label for="EmailId" class="form-label">Email Id <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" placeholder="Email Id" name="email" required>
                            <div class="invalid-feedback" id="email_error">Please enter email.</div>
                            {{-- <div class="invalid-feedback" id="email_ptrn_error">Email id e.g abc@gmail.com</div> --}}
                            {{-- <div class="invalid-feedback" id="email_exists_error" >Already Exists.</div> --}}
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
                            <div class="invalid-feedback" id="mobile_error" >Please select the country code and enter mobile number.</div>
                        </div>
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
                            <button type="submit" class="btn btn-primary createAdmin" >Create Admin</button>
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
<script>
$(document).ready(function () {
    AllAdminList('all');
    // $("#active-admin-tab").on("click", function (event) {
    //     AllAdminList("active");
    // });
    // $("#inactive-admin-tab").on("click", function (event) {
    //     AllAdminList("inactive");
    // });
    // $("#all-admin-tab").on("click", function (event) {
    //     AllAdminList("all");
    // });
    
    $(".section-admin-tab").on("click", function (event) {
        event.preventDefault();
        AllAdminList($(this).data("cat"));
    });
});
$('#checkAll').click(function (e) {
    $('.all_admin_list tbody :checkbox').prop('checked', $(this).is(':checked'));
    e.stopImmediatePropagation();
});
function AllAdminList(action){
    $(".dataTables_filter").css('display','none');
    var baseUrl = window.location.origin + "/";
    $('.all_admin_list').DataTable().destroy();
    $.ajax({
        url: baseUrl +'admin/getadmindata/'+action,
        method: 'GET',
        success: function(data) {
            $(".counts").html("(" + data.length + ")");
            $('.all_admin_list').DataTable({
                data: data, // Pass
                columns: [
                    {
                        data: 'id',
                        "render": function(data, type, full, meta) {
                            var adminid = btoa(full.id);
                            var isChecked = data.checked ? 'checked' : '';
                            return '<input type="checkbox"  data-deletes_id="'+adminid+'" class="form-check-input checkbox sub_chk" ' + isChecked + '>';
                           
                        },
                        width:'0%'
                    },
                    {
                        data: null,
                        "render": function(data, type, full, meta) {
                            var autoincrement_no = meta.row + 1;
                            return autoincrement_no;
                        },
                        width:"10%"
                    },
                    { 
                        data: null,
                        render: function (row) {
                            var  adminId = btoa(row.id);
                            var name = row.name;
                            var profileUrl = "/admin/admin/"+ adminId +"/edit"; 
                            var img = row.photo ? baseUrl + 'storage/' + row.photo : baseUrl + 'storage/adminDocs/admin-profile-photo.png';

                            return (
                                "<div class='d-flex align-items-center'>" +
                                "<img src='" + img + "' alt='' class='rounded-circle avatar-md me-2'>" +
                                "<h5 class='mb-0'>" +
                                "<a href='" + profileUrl + "'>" + name + "</a> " +
                                "</h5></div>"
                            );
                        },
                    },
                    { 
                        data: 'email',
                         width:"20%"
                    },
                    { 
                        data: 'phone',
                         width:"20%"
                    },
                    { 
                        data: 'is_active',
                        "render": function(data, type, full, meta) {
                            var status = data === 'Active' ? 'Active' : 'Inactive';
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
                            const dateTimeStr = row.last_seen; // 'dd-mm-yyyy hh:mm:ss'
                            const [day, month, year] = dateTimeStr.split(/[- ]/); // Split by '-' and ' '
                            return `${day}-${month}-${year}`; // Format as 'dd-mm-yyyy'
                        },

                    },
                    { 

                        data: null,
                        "render": function(row) {
                            var adminId = row.id; 
                            var editUrl ="/admin/admin/"+btoa(adminId) +"/edit";
                            var Action = '<div class="hstack gap-3"><a href="' + editUrl + '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="deleteAdmin" data-status="'+btoa('delete')+'" data-delete_id="'+btoa(adminId)+'"><i class="fe fe-trash"></i></a><span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a><span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
                            if(row.is_active == 'Inactive'){ 
                                Action += '<a class="dropdown-item statusStudent" href="#" data-status="'+btoa('student_status_active')+'" data-role="admin" data-student_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Active</a> </div>'; 
                            }
                            if(row.is_active == 'Active'){ 
                                Action += '<a class="dropdown-item statusStudent" href="#" data-status="'+btoa('student_status_inactive')+'" data-role="admin" data-student_id="'+btoa(row.id)+'"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Inactive </a> </div>';
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
            var table = $('.all_admin_list').DataTable();
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

        $('#create-modal').on('shown.bs.modal', function () {
            $('#mob_code').select2({
                dropdownParent: $('#create-modal'),
                placeholder: "Select",
            });
});

</script>
@endsection
