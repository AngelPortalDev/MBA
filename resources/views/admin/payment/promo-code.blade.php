<!-- Header import -->
@extends('admin.layouts.main')
@section('content')
<style>
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
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
                            Promo Code
                            <span class="fs-5"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Promo Code</a></li>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpromo-modal">
                            Create <i class="fe fe-plus ms-1"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary deletePromoCode">
                            Delete <i class="fe fe-trash ms-1"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-outline-primary ">
                            Import <i class="fe fe-download ms-1"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary ">
                            Export <i class="fe fe-upload ms-1"></i>
                        </button> --}}

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
                                    <a class="nav-link active section-promocode-tab" id="all-promocode-tab"  data-cat="all" data-bs-toggle="pill" href="#all-promocode" role="tab" aria-controls="all-promocode" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-promocode-tab" id="all-promocode-tab"  data-cat="Active" data-bs-toggle="pill" href="#all-promocode" role="tab" aria-controls="all-promocode" aria-selected="true">Active</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-promocode-tab" id="all-promocode-tab"  data-cat="Inactive" data-bs-toggle="pill" href="#all-promocode" role="tab" aria-controls="all-promocode" aria-selected="true">Inactive</a>
                                </li>
                            
                             

                            </ul>
                        </div>

                    
                        <!-- Form -->

                       
                        <div class="d-flex align-items-center col-12 col-md-5 col-lg-5 justify-content-end border-bottom">
                            <div class="row justify-content-end">
                                <form class="d-flex align-items-center col-lg-8 mt-3 mt-md-0 mb-3 mb-md-0 w-100 ">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-6 SearchCode" id="searchInput" placeholder="Search Here">
                                </form>

                            
                                <!-- input -->
                                <div class="col-auto">
                                    <!-- form select -->
                                    {{-- <select class="form-select" aria-label="Default select example">
                                        <option selected="">Filter</option>
                                        <option value="Newest">Newest</option>
                                        <option value="Price: High-Low">Active</option>
                                        <option value="Price: Low-High">Inactive</option>
                                        <option value="Price: Low-High">Delected</option>
                                        <option value="Price: Low-High">Award</option>
                                        <option value="Price: Low-High">Certificate</option>
                                        <option value="Price: Low-High">Diploma</option>
                                        <option value="Price: Low-High">Masters</option>
                                    </select> --}}
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
                                        <table class="table mb-0 text-nowrap promoCodeList" width="100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th >
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th >Sr. No.</th>
                                                    <th >Institute</th>
                                                    <th >Course Title</th>
                                                    <th >Code</th>
                                                    <th >Discount (%)</th>
                                                    <th >Expiry Date</th>
                                                    <th> Applied User</th>
                                                    <th >Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                                                                
{{--                                                                                                 
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

                                                            <h5 class="mb-0">30 Percent Discount</h5>
                                                        </div>
                                                    </td>
                                                    <td>GDTAOA30%</td>
                                                    <td>30</td>

                                                    <td>7 July, 2025</td>
        
        
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a data-bs-toggle="modal" data-bs-target="#edit-modal" href="_blank"><i class="fe fe-edit"></i></a>
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

                                                            <h5 class="mb-0">50 Percent Discount</h5>
                                                        </div>
                                                    </td>
                                                    <td>FFDAOA50%</td>
                                                    <td>50</td>

                                                    <td>7 July, 2026</td>
        
        
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a data-bs-toggle="modal" data-bs-target="#edit-modal" href="_blank"><i class="fe fe-edit"></i></a>
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
                                                 --}}

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



<!-- Create Promo Code Modal -->
<div class="modal fade" id="addpromo-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Promo Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row addpromo">
                    <input type="hidden" class="form-control coupon_id"  id="coupon_id" name="coupon_id"  required>
                    <div class="mb-3 col-12">
                        <label for="PromoCodeName" class="form-label">Institute</label>
                        <select class="form-select institute_id" name="institute_id">
                            <option value="">Select</option>
                            @php 
                            $data = DB::table('institute_profile_master')->Join('users','users.id','=','institute_profile_master.institute_id')->select('users.id','name','institute_profile_master.university_code')->where('institute_profile_master.status','0')->get();
                            @endphp
                            @foreach ($data as $list)                                               
                            <option value="{{base64_encode($list->id)}}">{{$list->name.' - '.$list->university_code}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback institute_id_error">Please select institute</div>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="PromoCodeName" class="form-label">Course <span class="text-danger">*</span></label>
                        <select class="form-select course_id select2" name="course_id">
                            <option value="">Select</option>
                            @php 
                            $data = DB::table('course_master')
                            ->select('id', 'course_title')
                            ->whereIn('status', [1, 3])
                            ->orderBy('id', 'DESC')
                            ->get();
                            @endphp
                            @foreach ($data as $list)                                               
                            <option value="{{base64_encode($list->id)}}">{{$list->course_title}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback course_id_error">Please select course</div>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="PromoCodeName" class="form-label">Promo Code Name (optional)</label>
                        <input type="text" class="form-control promo_code_name"  name="promo_code_name" placeholder="Promo Code Name" required>
                        <div class="invalid-feedback promo_name_error">Please enter Promo Code Name.</div>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="Code" class="form-label">Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control promo_code" placeholder="Code" name="promo_code"  required>
                        <div class="invalid-feedback promo_code_error">Please enter Code.</div>
                        <label>Code must be between 4 to 10 characters.</label>

                    </div>
                    <div class="mb-3 col-12">
                        <label for="Discount" class="form-label">Discount (%) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control discount"  placeholder="Discount" name="discount"  min="1" max="100" required>
                        <div class="invalid-feedback promo_discount_error" >Please enter Discount.</div>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="date" class="form-label">Expiry Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control expiry_date" placeholder="Expiry" name="expiry_date" required>
                        <div class="invalid-feedback expiry_date_error" >Please enter expiry date.</div>
                    </div>


                    <div class="col-12 d-flex justify-content-end pt-2">
                        <button type="button" class="btn btn-primary me-2 promoadd">Create</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Promo Code Modal -->
<div class="modal fade" id="editpromo-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Edit Promo Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row needs-validation" novalidate>
                    <input type="text" class="form-control coupon_id"  name="coupon_id"  required>

                    <div class="mb-3 col-12">
                        <label for="PromoCodeName" class="form-label">Promo Code Name (optional)</label>
                        <input type="text" class="form-control promo_code_name"  name="promo_code_name" placeholder="Promo Code Name" required>
                        <div class="invalid-feedback promo_name_error">Please enter Promo Code Name</div>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="Code" class="form-label">Code</label>
                        <input type="text" class="form-control promo_code" placeholder="Code" name="promo_code"  required>
                        <div class="invalid-feedback promo_code_error">Please enter Code</div>
                        <label>Code must be between 4 to 10 characters.</label>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="Discount" class="form-label">Discount (%)</label>
                        <input type="text" class="form-control discount"  placeholder="Discount" name="discount"  required>
                        <div class="invalid-feedback promo_discount_error" >Please enter Discount</div>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="date" class="form-label">Expiry Date</label>
                        <input type="date" class="form-control expiry_date" placeholder="Expiry" name="expiry_date" required>
                        <div class="invalid-feedback expiry_date_error" >Please enter Expiry Date</div>
                    </div>


                    <div class="col-12 d-flex justify-content-end pt-2">
                        <button type="submit" class="btn btn-primary me-2">Create</button>
                        <button type="button" class="btn btn-outline-secondary " data-bs-dismiss="modal">Cancel</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

// $(document).ready(function () {

    $(document).ready(function () {
        promoCodeList('all');
        handleSearchInput('searchInput', () => {
            promoCodeList('all'); 
        });
        $(".section-promocode-tab").on("click", function (event) {
        promoCodeList(($(this).data("cat")));
    });
    });

   
    function promoCodeList(cat) {     
        // $(".promoCodeList").DataTable().destroy();
        $("#processingLoader").fadeIn();

        var baseUrl = window.location.origin + "/";
        var id='0';
        $.ajax({
        url: baseUrl + "admin/promocode-get-data/"+ id + '/' + cat,
            method: "GET",
            success: function (data) {
                $("#processingLoader").fadeOut();
                $(".promoCodeList").DataTable().destroy();
                $(".promoCodeList").DataTable({
                    data: data, 
                    columns: [
                        {
                            data: "id",
                            render: function (data, type, full, meta) {
                                var PromoCodeId = btoa(full.id);
                                var isChecked = full.checked ? "checked" : "";
                                // return (
                                //     '<form class="actionData"><input type="checkbox" class="form-check-input checkbox sub_chk " name="PromoCodeId[]" value="' +
                                //     PromoCodeId +
                                //     '" ' +
                                //     isChecked +
                                //     "></form>"
                                // );
                                return '<input type="checkbox"  data-status="'+btoa('delete')+'" data-deletes_id="'+PromoCodeId+'" class="form-check-input checkbox sub_chk" ' + isChecked + '>';

                            },
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                i = row.row + 1;
                                return i;
                            },
                             width:"10%"
                        },
                        {
                            data: null,
                            render: function (row) {
                                var institute_name = '-';
                                if(row.institute_id != '' && row.institute_id != null){
                                    institute_name = row.name+ ' ' + row.university_code;
                                }
                                return '<div class="d-flex align-items-center"><p class="custom-title mb-0 text-wrap-title">' + institute_name  + '</p></div>';

                            },
                        },
                        {
                            data: null,
                            render: function (row) {
                                var Status = '';
                                if (row.status == 'Active') {
                                    Status = '<span class="badge-dot bg-success ms-1 d-inline-block align-middle"></span>';
                                } else {
                                    Status = '<span class="badge-dot bg-danger ms-1 d-inline-block align-middle"></span>';
                                }
                                return '<div class="d-flex align-items-center"><p class="custom-title mb-0 text-wrap-title">' + row.course_title + Status + '</p></div>';
                            },
                            width: "40%"
                        },
                        {
                            data: null,
                            render: function (row) {
                                return row.coupon_name;

                            },
                             width:"15%"
                        },
                        {
                            data: null,
                            render: function (row) {
                                return row.coupon_discount;
                            },
                            width:"10%"
                        },
                        {
                            data: null,
                            render: function (row) {
                                return row.coupon_validity;
                            },
                             width:"10%"
                        },
                        {
                            data: null,
                            render: function (row) {
                                return row.count_apply;
                            },
                             width:"10%"
                        },
                        {
                            data: null,
                            render: function (row) {
                                var Action = '<div class="hstack gap-3"><a id="editpromocode" data-id="'+btoa(row.id)+'" href="#" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Delete" class="deletePromoCode" data-status="'+btoa('delete')+'" data-delete_id="'+btoa(row.id)+'"><i class="fe fe-trash"></i></a><span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i> </a><span class="dropdown-menu"><span class="dropdown-header">Settings</span>';
                                if(row.status == 'Inactive'){ 
                                    Action += '<a class="dropdown-item statusPromoCode" href="#" data-status="'+btoa('promo_status_active')+'" data-promo_id="'+btoa(row.id)+'" >  <span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>Active</a> </div>'; 
                                }
                                if(row.status == 'Active'){ 
                                    Action += '<a class="dropdown-item statusPromoCode" href="#" data-status="'+btoa('promo_status_inactive')+'" data-promo_id="'+btoa(row.id)+'"><span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>Inactive </a> </div>';
                                }
                                return Action;
                            },
                             width:"15%"
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
$('.SearchCode').on('keyup', function() {
    var table = $('.promoCodeList').DataTable();
    var searchTerm = $(this).val();
    table.search(searchTerm).draw();
});
$('#addpromo-modal').on('shown.bs.modal', function () {
    $('.course_id').select2({
        dropdownParent: $('#addpromo-modal'),
        placeholder: "Select Course",
    });
}); 
</script>
@endsection
