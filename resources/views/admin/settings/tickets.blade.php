<!-- Header import -->
@extends('admin.layouts.main')
@section('content')
<style>
.modal-content {
    border-radius: 10px;  /* Rounded corners */
}

/* Header Styling */
.modal-header {
    color: white; /* White text for the header */
    padding: 20px; /* Padding around the header */
    border-top-left-radius: 10px; /* Round top-left corners */
    border-top-right-radius: 10px; /* Round top-right corners */
}

.modal-title {
    font-size: 1.0rem; /* Increase title font size */
    font-weight: bold; /* Bold title */
}
/* Modal Body */
.modal-body {
    padding: 20px; /* Padding around the body */
}

/* Ticket Title */
.ticket_title {
    font-size: 1.25rem; /* Title font size */
    font-weight: 600; /* Bold font */
    color: #333; /* Dark text color */
}

/* Ticket Status */
#ticket_status {
    font-size: 1rem; /* Status font size */
    font-weight: 500; /* Medium weight */
    color: green; /* Green color for success */
}

/* Ticket Details Section */
#ticket_details {
    margin-top: 20px;
    font-size: 1rem;
    color: #444;
    line-height: 1.5;
}

/* Image Styling */
.error_screenshot {
    display: none; /* Initially hidden */
    margin-top: 20px;
    max-width: 100%;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Ticket Details Text */
#ticket_details_text {
    margin-top: 20px;
    font-size: 1rem;
    color: #555;
    line-height: 1.5;
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
                            Ticket List
                            <span class="fs-5 counts"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Tickets</a></li>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ticket-create-modal">
                                Create <i class="fe fe-plus ms-1"></i>
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
                        <div class="card-header p-0 col-12 col-md-7 col-lg-7">
                            <ul class="nav nav-lb-tab border-bottom-0" id="tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active"  data-cat="all" id="all-ticket-tab" data-bs-toggle="pill" href="#all-tickets" role="tab" aria-controls="all-tickets" aria-selected="true">All</a>
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
                            <div class="tab-pane fade active show" id="all-tickets" role="tabpanel" aria-labelledby="all-tickets-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover all_ticket_list" width="100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Subject</th>
                                                    <th>Error Type</th>
                                                    <th>Assigned</th>
                                                    <th>Priority</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                </div>
                            </div>


                            
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>

        
    </section>
</main>



<!-- Create Admin Modal -->
<div class="modal fade" id="ticket-create-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Add Tickets</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row ticketData" novalidate>
                    <div class="mb-2 col-12">
                        <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" required>                        
                        <div class="invalid-feedback" id="subject_error">Please enter your subject.</div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="error_type" class="form-label">Error Type <span class="text-danger">*</span></label>
                        <div class="error_type">
                            <select class="form-select" aria-label="Default select example" id="error_type" name="error_type">
                                <option value="">Select</option>
                                    <option value="{{base64_encode('client_error')}}">Client Error</option>
                                    <option value="{{base64_encode('internal_error')}}">Internal Error</option>
                            </select>
                            <div class="invalid-feedback" id="error_type_error" >Please select error type</div>
                        </div>
                    </div>   
                    <div class="mb-3 col-md-12">
                        <label for="assigned_to" class="form-label">Assigned To <span class="text-danger">*</span></label>
                        <div class="assigned_to">
                            <select class="form-select" aria-label="Default select example" id="assigned_to" name="assigned_to">
                                <option value="">Select</option>
                                    <option value="{{base64_encode('dev_team')}}">Dev Team</option>
                                    <option value="{{base64_encode('content_team')}}">Content Team</option>
                                    <option value="{{base64_encode('video_team')}}">Video Team</option>

                            </select>
                            <div class="invalid-feedback" id="assigned_to_error" >Please select assigned to</div>
                        </div>
                    </div> 
                    <div class="mb-3 col-md-12">
                        <label for="error_details" class="form-label">Error Details <span class="text-danger">*</span></label>
                        <div id="error_details" name="error_details" placeholder="Error Details"
                            class="form-control w-100 error_details" style="height: 200px">
                        </div>
                        <small>Enter error details up to 1500 characters.</small>
                        <div class="invalid-feedback" id="error_details_error">Enter error details up to 1500 characters.</div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
                        <div class="priority">
                            <select class="form-select" aria-label="Default select example" id="priority" name="priority">
                                <option value="">Select</option>
                                    <option value="{{base64_encode('urgent')}}">Urgent</option>
                                    <option value="{{base64_encode('medium')}}">Medium</option>
                                    <option value="{{base64_encode('low')}}">Low</option>

                            </select>
                            <div class="invalid-feedback" id="priority_error" >Please select priority</div>
                        </div>
                    </div>   
                    <div class="mb-2 col-12">
                        <label for="file" class="form-label">File upload</label>
                        <input type="file" class="form-control" id="error_screenshot" name="error_screenshot" required>                        
                        <div class="invalid-feedback" id="file_upload_error">Please enter your file upload.</div>
                    </div>  
                    <div class="col-12 d-flex justify-content-end pt-2">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary addticket" >Add Ticket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ticket-view-modal"  role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">View Tickets</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <h4 class="ticket_title"></h4>
                    <small class="text-success" id="ticket_status"></small>
                    <br><BR>
                    <div id="ticket_details"></div>
                    <div id="ticket_details_text"></div>
                    <img class="error_screenshot_display" src="">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        AllticketList('all');
        handleSearchInput('searchInput', () => {
            AllticketList('all'); 
        });
    });
    $('#searchInput').on('keyup', function() {
        var table = $('.all_ticket_list').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
    $('#checkAll').click(function (e) {
        $('.all_ticket_list tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });
    function AllticketList(action){
        $(".dataTables_filter").css('display','none');
        var baseUrl = window.location.origin + "/";
        $.ajax({
            url: baseUrl +'admin/get-tickets/'+action,
            method: 'GET',
            success: function(data) {
                $('.all_ticket_list').DataTable().destroy();
                $(".counts").html("(" + data.length + ")");
                $('.all_ticket_list').DataTable({
                    data: data, // Pass
                    columns: [
                        {
                            data: null,
                            "render": function(data, type, full, meta) {
                                var autoincrement_no = meta.row + 1;
                                return autoincrement_no;
                            },
                            width:'15%'
                        },
                        { 
                            data: null,
                            render: function (row) {
                                return row.subject;
                            },
                            width:'20%'
                        },
                        { 
                            data: null,
                            "render": function(row) {
                                var error_type = row.error_type;
                                var errorType = '';
                                if(error_type == 'client_error'){
                                    errorType = "Client Error";
                                } else if(error_type == 'internal_error'){
                                    errorType = "Internal Error";
                                } 

                                return errorType;
                            },
                            width:'15%'
                        },
                        { 
                            data: null,
                            "render": function(row) {
                                var assigned_to = row.assigned_to;
                                var assigned = '';
                                if(assigned_to == 'content_team'){
                                    assigned = "Content Team";
                                } else if(assigned_to == 'dev_team'){
                                    assigned = "Dev Team";
                                } else if(assigned_to == 'video_team'){
                                    assigned = "Video Team";
                                }

                                return assigned;
                            },
                            width:'15%'
                        },
                        { 
                            data: null,
                            "render": function(row) {
                                var priority = row.priority;
                                return priority;
                            },
                            width:'15%'
                        },
                        {

                            data: null,
                            render: function (row) {
                                // var ticket_id = btoa(row.id);
                                // editUrl = 'view_tickets/'+ticket_id;
                                var Action =
                                '<div class="hstack gap-3"><a href="#" class="btn-icon ticket_view" data-bs-toggle="tooltip" data-ticket_id="'+btoa(row.id)+'" data-placement="top" title="View"><i class="fe fe-eye"></i></a>';

                                if(row.status == 'Open'){ 
                                    Action +='<a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a> <span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
                                    Action += '<a class="dropdown-item statusTicket" href="#" data-role="tickets" data-ticket_id="'+btoa(row.id)+'" data-status="'+btoa("Closed")+'"> <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Closed</a> </div>'; 
                                }
                                // else{
                                //     Action += '<a class="dropdown-item statusTicket" href="#" data-role="tickets" data-ticket_id="'+btoa(row.id)+'" data-status="'+btoa("Open")+'"><span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Open</a>';      
                                // }
                                return Action;
                            },
                            width:'15%'

                        }

                    ]
                });
               
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // document.addEventListener('DOMContentLoaded', function() {
    //         document.querySelectorAll('.toggle-password').forEach(function(togglePassword) {
    //             togglePassword.addEventListener('click', function () {
    //                 const targetInput = document.querySelector(togglePassword.getAttribute('data-toggle'));
    //                 const togglePasswordIcon = togglePassword.querySelector('.toggle-password-eye');
    //                 const type = targetInput.getAttribute('type') === 'password' ? 'text' : 'password';
    //                 targetInput.setAttribute('type', type);
    //                 togglePasswordIcon.classList.toggle('bi-eye');
    //                 togglePasswordIcon.classList.toggle('bi-eye-slash');
    //             });
    //         });
    // });
    </script>
@endsection
