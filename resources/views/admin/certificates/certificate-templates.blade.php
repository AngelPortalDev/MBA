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
                            Certificates Template
                            <span class="fs-5 counts"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Certificates</a></li>
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
                            <button type="button" class="btn btn-primary cretModal" data-bs-toggle="modal" data-bs-target="#create-modal">
                                Create <i class="fe fe-plus ms-1"></i>
                            </button>
                          </div>
                       {{-- <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                        <button type="button" class="btn btn-outline-primary ">
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
                                    <a class="nav-link active" id="all-students-tab" data-bs-toggle="pill"
                                        href="#all-students" role="tab" aria-controls="all-students"
                                        aria-selected="true">All</a>
                                </li>

                            </ul>
                        </div>


                        <!-- Form -->


                        <div class="d-flex align-items-center col-12 col-md-5 col-lg-5 justify-content-end border-bottom">
                            <div class="row justify-content-end">
                                <form class="d-flex align-items-center col-12 col-lg-6 mt-2 mt-lg-0">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-6" placeholder="Search Here">
                                </form>


                                <!-- input -->
                                {{-- <div class="col-auto col-lg-6 col-12 mt-2 mt-lg-0 mb-2 mb-lg-0">
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
                            <div class="tab-pane fade active show" id="all-students" role="tabpanel"
                                aria-labelledby="all-students-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                    <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover all_cert_list container" width="100%">
                                        <thead class="table-light">
                                            <tr>
                                                {{-- <th>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                                        <label class="form-check-label" for="checkAll"></label>
                                                    </div>
                                                </th> --}}
                                                <th>Sr. No.</th>
                                                <th>Name</th>
                                                <th>Category</th>
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
                                    <a class="page-link mx-1 rounded" href="#" tabindex="-1"
                                        aria-disabled="true">
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
                    </div> --}}
                </div>
            </div>
        </div>


    </section>
    </main>



    <!-- Create creatificate  Modal -->
    <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Create Certificate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row needs-validation certTempData" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="mb-3 col-12">
                    <label for="certCat" class="form-label">Select Category</label>
                    <div>
                        <select class="form-select" aria-label="Default select example" name="certCat" id="certCat">
                            <option selected="" value="">select</option>
                            @foreach (getDropDownlist('categories', ['id','category_name']) as $item)
                                        <option value="{{base64_encode($item->id)}}">{{$item->category_name}}</option>
                            @endforeach
                        </select>
                            </div>
                            <div class="invalid-feedback errors" id="certCat_error">Please Select Course Category</div>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="certName" class="form-label">Certificate Name</label>
                            <input type="text" class="form-control" id="certName" name="certName" placeholder="e.g Certificate of Award Course" required>
                            <div class="invalid-feedback errors" id="certName_error">Please enter Certificate Name</div>
                        </div>

                   
                        <div class="mb-3 col-12">
                            <label for="certFile" class="form-label">Upload Certificate File</label>
                            <div class="input-group mb-1">
                                <input type="file" class="form-control" id="certFile" name="certFile" accept=".jpg,.png,.jpeg" onchange="document.getElementById('imgpreview').src = window.URL.createObjectURL(this.files[0])">
                                <input type="hidden" id="existing_file" name="existing_file"  value="">
                                 <div class="invalid-feedback errors" id="certFile_error">Please Upload Certificate File</div>
                                {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                              </div>
                              <small class="" >(Upload your certificate design with size below the 3MB )</small>
                              
                        </div>
                         <img class="img-responsive" id="imgpreview" >
                        <div class="col-12 d-flex justify-content-end pt-2 ">
                            <button type="button" class="btn btn-primary me-2 addCert">Add</button>
                            <button type="button" class="btn btn-outline-secondary "
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Admin Modal -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Edit Certificate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row needs-validation" novalidate>
                        <div class="mb-3 col-12">
                            <label for="FirstName" class="form-label">Certificate Name</label>
                            <input type="text" class="form-control" id="FirstName" placeholder="Certificate Name" required>
                            <div class="invalid-feedback">Please enter Certificate Name</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label for="MobileNumber" class="form-label">Select Category</label>
                            <div>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected="">select</option>
                                    <option value="1">Award</option>
                                    <option value="2">Certificate</option>
                                    <option value="3">Diploma</option>
                                    <option value="3">Masters</option>
                                </select>
                            </div>
                            <div class="invalid-feedback">Please enter Mobile Number</div>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="sa" class="form-label">Upload Certificate Design</label>
                            <div class="input-group mb-1">
                                <input type="file" class="form-control" id="inputLogo">
                                <label class="input-group-text" for="inputLogo">Upload</label>
                              </div>
                              <small class="">(Upload your certificate design with size below the 3MB )</small>
                        </div>



                        <div class="col-12 d-flex justify-content-end pt-2 ">
                            <button type="submit" class="btn btn-primary me-2">Add</button>

                            <button type="button" class="btn btn-outline-secondary "
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            AllCertList();
        });
       function AllCertList(){
        $(".dataTables_filter").css('display','none');
        var baseUrl = window.location.origin + "/";
        $('.all_cert_list').DataTable().destroy();
        $.ajax({
            url: baseUrl +'admin/get-temp-cert-data',
            method: 'GET',
            success: function(data) {
                $(".counts").html("(" + data.length + ")");
                $('.all_cert_list').DataTable({
                    data: data, // Pass
                    columns: [
                        // {
                        //     data: null,
                        //     render: function (data, type, full, meta) {
                        //          var Ementorid = '';
                        //         if(data.id){
                        //             var certid = btoa(data.id);
                        //         }
                        //         var isChecked = full.checked ? "checked" : "";
                        //         return '<input type="checkbox"  data-deletes_id="'+certid+'" class="form-check-input checkbox sub_chk" ' + isChecked + '>';
                        //     },
                        //      width:'5%'
                        // },
                        {
                            data: null,
                            "render": function(data, type, full, meta) {
                                var autoincrement_no = meta.row + 1;
                                return autoincrement_no;
                            },
                             width:'5%'
                        },
                        { 
                            data: null,
                            render: function (data) {
                                return data.certificate_name;
                            },
                        },
                         { 
                            data: null,
                            render: function (data) {
                                return data.category.category_name;
                            },
                        },
                        { 
                            data: null,
                            "render": function(row) {
                                var certid = row.id != '' ? row.id : ''; 
                                var Action = '<div class="hstack gap-3"><a href="#" data-status="'+btoa('edit')+'" data-certid='+btoa(certid)+'" class="updateModel"><i class="fe fe-edit"></i></a><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="deleteCertTemp" data-status="'+btoa('delete')+'" data-delete_id="'+btoa(certid)+'"><i class="fe fe-trash"></i></a>';
                                
                                // if(adminId  != ''){
                                //     if(row.status == '1'){ 
                                //         Action += '<a class="dropdown-item statusEmentor" href="#" data-status="'+btoa('ementor_status_active')+'" data-ementor_id="'+btoa(row.id)+'" data-source="e-mentor" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Active</a> </div>'; 
                                //     }
                                //     if(row.status == '0'){ 
                                //         Action += '<a class="dropdown-item statusEmentor" href="#" data-status="'+btoa('ementor_status_inactive')+'" data-ementor_id="'+btoa(row.id)+'" data-source="e-mentor"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Inactive </a> </div>';
                                //     }
                                // }
                                Action +'</span></span></div>';
                            
                                // Action +=    "</div>";
                                return Action;

                            },
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
      </script>
@endsection
