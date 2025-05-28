<!-- Header import -->
@extends('admin.layouts.main')
@section('content')

<style>
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
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
                            Block List
                            <span class="fs-5 counts"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">BlockList</a></li>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userblock-create-modal">
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
                                    <a class="nav-link active section-blocklist-tab"  data-cat="all" id="all-mentor-tab" data-bs-toggle="pill" href="#all-blocklist" role="tab" aria-controls="all-blocklist" aria-selected="true">All</a>
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
                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover all_block_list" width="100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>IP Address</th>
                                                    <th>Action</th>
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
<div class="modal fade" id="userblock-create-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Add IP Block List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row ipblockData" novalidate>
                    <div class="mb-2 col-12">
                        <label for="ipaddress" class="form-label">IP Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ipaddress" placeholder="IP Address" name="ipaddress" 
                        pattern="^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" required>                        
                        <div class="invalid-feedback" id="ipaddress_error">Please enter your ip address.</div>
                    </div>
                    <div class="col-12 d-flex justify-content-end pt-2">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary addipblock" >Add IP Block List</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        AllblockList('all');
        handleSearchInput('searchInput', AllblockList);
    });
    $('#searchInput').on('keyup', function() {
        var table = $('.all_block_list').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
    $('#checkAll').click(function (e) {
        $('.all_block_list tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });
    function AllblockList(action){
        $(".dataTables_filter").css('display','none');
        var baseUrl = window.location.origin + "/";
        $('.all_block_list').DataTable().destroy();
        $.ajax({
            url: baseUrl +'admin/get-blocklist/'+action,
            method: 'GET',
            success: function(data) {
                $(".counts").html("(" + data.length + ")");
                $('.all_block_list').DataTable({
                    data: data, // Pass
                    columns: [
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
                                return row.last_session_ip;
                            },
                            width:'15%'
                        },
                        { 
                            data: null,
                            "render": function(row) {
                                var ipaddress = row.last_session_ip;
                                return (
                                    '<div class="hstack gap-3"><a href="javascript:void(0);" class="unblockList" data-ipaddress="'+ipaddress+'" data-bs-toggle="tooltip" data-placement="top" title="Unblock" >Unblock</a></div>'
                                );
                            },
                            width:'10%'
                        },


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
    </script>
@endsection
