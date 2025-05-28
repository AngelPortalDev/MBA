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
                            Testimonials
                            <span class="fs-5" id="count"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Testimonials</a></li>
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
                          <a href="create-testimonials">
                            <button type="button" class="btn btn-primary">
                            Create <i class="fe fe-plus ms-1"></i>
                            </button>
                        </a>
                        <button type="button" class="btn btn-outline-primary deleteTestimonials">
                            Delete <i class="fe fe-trash ms-1"></i>
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
                                    <a class="nav-link active" id="all-students-tab" data-bs-toggle="pill" href="#all-students" role="tab" aria-controls="all-students" aria-selected="true">All</a>
                                </li>
                            </ul>
                        </div>

                    
                        <!-- Form -->

                       
                        <div class="d-flex align-items-center col-12 col-md-5 col-lg-5 justify-content-end border-bottom">
                            <div class="row justify-content-end">
                                <form class="d-flex align-items-center col-lg-12 ">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-6" id="searchInput" placeholder="Search Here">
                                </form>

                            
                                {{-- <!-- input -->
                                <div class="col-auto">
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

                            <!-- All Students Tab  -->
                            <div class="tab-pane fade active show" id="all-students" role="tabpanel" aria-labelledby="all-students-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover testimonialList w-100">
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
                                                    <th>Designation</th>  
                                                    {{-- <th>Feedback</th>   --}}
                                                    {{-- <th>Status</th> /     --}}
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





<script>
    $(document).ready(function () {
        testimonialList('all');
        handleSearchInput('searchInput', testimonialList);
    });

    $('#checkAll').click(function (e) {
        $('.testimonialList tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });
    $('#searchInput').on('keyup', function() {
        var table = $('.testimonialList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
    $('#clearButton').on('click', function () {
        $('#exportForm')[0].reset();
        $('#exportForm input').removeClass('is-invalid');
        $('#exportForm .invalid-feedback').remove();
    });

    function testimonialList(action) {
        $("#processingLoader").fadeIn();
        var baseUrl = window.location.origin + "/";
        // $(".loader").removeClass("d-none");
        $.ajax({
            url: baseUrl + "admin/testimonial-get-data/"+action,
            method: "GET",
            success: function (data) {
                $("#processingLoader").fadeOut();
                if ($.fn.DataTable.isDataTable('.testimonialList')) {
                    $('.testimonialList').DataTable().clear().destroy();
                }
                $('#count').html("("+data.length+")");
                // $(".loader").addClass("d-none");
                $(".testimonialList").DataTable({
                    data: data, // Pass
                    columns: [
                        {
                            data: "id",
                            render: function (data, type, full, meta) {
                                var testimonialId = btoa(full.id);
                                var isChecked = full.checked ? "checked" : "";
                                // return (
                                //     '<form class="actionData"><input type="checkbox" class="form-check-input checkbox sub_chk " name="userId[]" value="' +
                                //     testimonialId +
                                //     '" ' +
                                //     isChecked +
                                //     "></form>"
                                // );
                                return '<input type="checkbox"  data-status="'+btoa('delete')+'" data-deletes_id="'+testimonialId+'" class="form-check-input checkbox sub_chk" ' + isChecked + '>';

                            },
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                i = row.row + 1;
                                return i;
                            },
                            width:'10%'
                        },
                        {
                            data: null,
                            render: function (row) {
                                var testimonialId = btoa(row.id);
                                var name = row.name+''+row.last_name;
                                var editUrl = baseUrl + "admin/edit-testimonials/" +testimonialId;
                                var img = row.image ? baseUrl + 'storage/' + row.image : baseUrl + 'storage/teacherDocs/no-image.jpeg';
                                if(row.status == 0){
                                    var Status = '<span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>';
                                }else{
                                    var Status = '<span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>';
                                }
    
                                return (
                                    "<div class='d-flex align-items-center'>" +
                                    "<img src='" + img + "' alt='' class='rounded-circle avatar-md me-2'>" +
                                    "<h5 class='mb-0'>" +
                                    "<a href='" + editUrl + "'>" + name + "</a> " + Status +
                                    "</h5></div>"
                                );
                            },
                            width:'40%'
                        },
                        {
                            data: null,
                            render: function (row) {
              
                                var designation = row.designation;
                                return designation;
                            },
                            width:'30%'
                        },
                        {
                            data: null,
                            render: function (row) {
                                var testimonialid = btoa(row.id);

                                var editUrl =
                                    baseUrl +
                                    "admin/edit-testimonials/" +
                                    testimonialid;

                                    // <a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" ><i class="fe fe-trash"></i></a>
                                   var Action= '<div class="hstack gap-3"><a href="' +
                                    editUrl +
                                    '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="deleteTestimonials" data-status="'+btoa('delete')+'" data-delete_id="'+btoa(row.id)+'"><i class="fe fe-trash"></i></a><span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a> <span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
                                    
                                    // <a class="dropdown-item"  href="#"><span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Active</a><a class="dropdown-item" href="#"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Inactive</a>
                                    // <a class="dropdown-item" href="#"><i class="fe fe-mail dropdown-item-icon"></i>Mail</a><a class="dropdown-item" href="#"><i class="fe fe-move dropdown-item-icon"></i>Move</a></span></span></div>';


                                    // var Action = '<div class="hstack gap-3"><a id="editpromocode" data-id="'+btoa(row.id)+'" href="#"><i class="fe fe-edit"></i></a><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="deletePromoCode" data-status="'+btoa('delete')+'" data-delete_id="'+btoa(row.id)+'"><i class="fe fe-trash"></i></a><span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i> </a><span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
                                if(row.status == '1'){ 
                                    Action += '<a class="dropdown-item statusTestimonials" href="#" data-status="'+btoa('testimonial_status_active')+'" data-testimonial_id="'+testimonialid+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Active</a>'; 
                                }
                                if(row.status == '0'){ 
                                    Action += '<a class="dropdown-item statusTestimonials" href="#" data-status="'+btoa('testimonial_status_inactive')+'" data-testimonial_id="'+testimonialid+'"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Inactive </a>';
                                }
                                // Action += '<a class="dropdown-item" href="#"><i class="fe fe-mail dropdown-item-icon"></i>Mail</a><a class="dropdown-item" href="#"><i class="fe fe-move dropdown-item-icon"></i>Move</a></span></span></div>';

                                return Action;
                            },
                            width:'20%'
                        },
                        // Add more columns as needed
                    ],
                });
            },
            error: function (xhr, status, error) {
                $("#processingLoader").fadeOut();
                console.error(error);
            },
        });
    }
    </script>
</script>

@endsection