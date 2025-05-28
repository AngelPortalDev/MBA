<!-- Header import -->
@extends('admin.layouts.main') @section('content')
@section('maintitle') Sales Executive @endsection

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
                            Sales Executive
                            <span class="fs-5 counts"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Sales Executive</a></li>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-sales-executive-modal">
                            Create <i class="fe fe-plus ms-1"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary deleteSalesExecutive" >
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
                                    <a class="nav-link active section-sales-executive-tab"  data-cat="all" data-bs-toggle="pill" href="#all-sales-executive" role="tab" aria-controls="all-sales-executive" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-sales-executive-tab"   data-cat="Active" data-bs-toggle="pill" href="#active-sales-executive" role="tab" aria-controls="active-sales-executive" aria-selected="false" tabindex="-1">Active</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-sales-executive-tab"  data-cat="Inactive"  data-bs-toggle="pill" href="#inactive-sales-executive" role="tab" aria-controls="inactive-sales-executive" aria-selected="false" tabindex="-1">Inactive</a>
                                </li>

                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="deleted-admin-tab" data-bs-toggle="pill" href="#deleted-admin" role="tab" aria-controls="deleted-admin" aria-selected="false" tabindex="-1">Deleted</a>
                                </li> --}}
                            </ul>
                        </div>

                    
                        <!-- Form -->

                       
                        <div class="d-flex align-items-center col-12 col-md-5 col-lg-5 justify-content-end border-bottom">
                            <div class="row justify-content-end">
                                
                                <div class="col-auto">
                                    <form class="d-flex align-items-center mb-0 mb-xlx-2">
                                        <span class="position-absolute ps-3 search-icon">
                                            <i class="fe fe-search"></i>
                                        </span>
                                        <input type="search" class="form-control ps-6 searchStudent mt-2 mt-md-0" id="searchInput" placeholder="Search Here">
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
                                        <table class="table mb-0 text-nowrap table-hover w-100 all_sales_executive_list"  width="100%">
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
                                </div>
                            </div>

                            <!-- Inactive Admin Tab  -->
                            <div class="tab-pane fade" id="inactive-admin" role="tabpanel" aria-labelledby="inactive-admin-tab">
                                <div class="table-responsive">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </section>

    <!-- Create Admin Modal -->
    <div class="modal fade" id="create-sales-executive-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Create New Sales Executive</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row salesExecutiveForm" novalidate>
                        <div class="mb-2 col-6">
                            <label for="name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="First Name" name="name" required>
                            <div class="invalid-feedback" id="name_error" >Please enter first name.</div>
                        </div>
                        <div class="mb-2 col-6">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" placeholder="Last Name"  name="last_name" required>
                            <div class="invalid-feedback" id="last_name_error">Please enter last name.</div>
                        </div>
                        <div class="mb-2 col-12">
                            <label for="email" class="form-label">Email Id <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" placeholder="Email Id" name="email" required>
                            <div class="invalid-feedback" id="email_error">Please enter email.</div>
                        </div>
                        <div class="mb-2 col-12">
                            <label for="mobile" class="form-label">Contact Number <span class="text-danger">*</span></label>
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
                            <div class="invalid-feedback" id="mobile_error" >Please enter a mobile number with at least 6 characters..</div>
                        </div>
                        <div class="mb-2 col-12">
                            <label for="Password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="*********" required>
                            <div class="invalid-feedback" id="password_error">Please enter password.</div>
                        </div>
                        <div class="mb-2 col-12 password-container">
                            <label for="ConfirmPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="confirm_password"  name="confirm_password"  placeholder="*********" required>
                            <span class="toggle-password ConfirmPassword" data-toggle="#confirm_password">
                                <i class="fe fe-eye toggle-password-eye field-icon show-password-eye bi bi-eye" style="top:50px; right:25px"></i>
                            </span>
                            <div class="invalid-feedback" id="confirm_password_error">Please enter confirm password.</div>
                        </div>
                        <div class="col-12 d-flex justify-content-end pt-2">
                            <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary salesExecutiveCreate" >Create Sales Executive</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<script src="{{ asset('admin/js/export.js') }}"></script>
<script>
$(document).ready(function () {
    AllSalesExecutiveList('all');
    handleSearchInput('searchInput', AllSalesExecutiveList);

  
    $(".section-sales-executive-tab").on("click", function (event) {
        event.preventDefault();
        AllSalesExecutiveList($(this).data("cat"));
    });
});
$('#checkAll').click(function (e) {
    $('.all_sales_executive_list tbody :checkbox').prop('checked', $(this).is(':checked'));
    e.stopImmediatePropagation();
});
function AllSalesExecutiveList(action){
    $("#processingLoader").fadeIn();
    $(".dataTables_filter").css('display','none');
    var baseUrl = window.location.origin + "/";
    $('.all_sales_executive_list').DataTable().destroy();
    $.ajax({
    url: baseUrl +'admin/get-sales-executive-list/'+action,
        method: 'GET',
        success: function(data) {
            
            $("#processingLoader").fadeOut();
            $(".counts").html("(" + data.length + ")");
            $('.all_sales_executive_list').DataTable({
                data: data,
                
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
                        "render": function(row, type, full, meta) {
                            var autoincrement_no = meta.row + 1;
                            return autoincrement_no;
                        },
                        width:"10%"
                    },
                    {
                        data: null,
                        render: function (row) {
                            var name = row.name ? row.name : '';

                            var editUrl = "sales-executive-edit/" + btoa(row.id);

                            var statusBadge = row.is_active == 'Active' ? 
                                '<span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>' : 
                                '<span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>';

                            return (
                                "<div class='d-flex align-items-center'>" +
                                    "<h5 class='mb-0'>" +
                                        "<a href='" + editUrl + "'>" + name + "</a> " + statusBadge +
                                    "</h5></div>"
                            );
                        },
                        width: '20%'
                    },
                    { 
                        data: null,
                        render: function (row) {
                            var email = row.email;
                           return email;
                        },
                        width: '20%'
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
                            var editUrl ="sales-executive-edit/"+btoa(row.id);                           
                            var Action = '<div class="hstack gap-3"><a href="' + editUrl + '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="deleteSalesExecutive" data-status="'+btoa('delete')+'" data-delete_id="'+btoa(adminId)+'"><i class="fe fe-trash"></i></a><span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a><span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
                            if(row.is_active == 'Inactive'){ 
                                Action += '<a class="dropdown-item statusSalesExecutive" href="#" data-status="'+btoa('sales_executive_status_active')+'" data-role="institute" data-id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Active</a> </div>'; 
                            }
                            if(row.is_active == 'Active'){ 
                                Action += '<a class="dropdown-item statusSalesExecutive" href="#" data-status="'+btoa('sales_executive_status_inactive')+'" data-role="institute" data-id="'+btoa(row.id)+'"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Inactive </a> </div>';
                            }
                            Action +'</span></span></div>';
                            // Action +=    "</div>";
                            return Action;
                            
                        },
                        width:"10%"

                    }
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
            var table = $('.all_sales_executive_list').DataTable();
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

</script>
@endsection
