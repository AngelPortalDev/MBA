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
                            Exams Amount
                            <span class="fs-5" id="count">(0)</span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Exams</a></li>
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
                        <a href="#"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#examAmountView" >
                            Create <i class="fe fe-plus ms-1"></i>
                        </button></a>
                        {{-- <button type="button" class="btn btn-outline-primary ">
                            Delete <i class="fe fe-trash ms-1"></i>
                        </button> --}}
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
                                    <a class="nav-link active" data-bs-toggle="pill" href="#all-exams" role="tab" aria-controls="all-exams" aria-selected="true">All</a>
                                </li>

                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="deleted-e-mentor-tab" data-bs-toggle="pill" href="#deleted-e-mentor" role="tab" aria-controls="deleted-e-mentor" aria-selected="false" tabindex="-1">Deleted</a>
                                </li> --}}
                            </ul>
                        </div>
                        <!-- Form -->
                        <div class="d-flex align-items-center col-12 col-md-5 col-lg-5 justify-content-end border-bottom">
                            <div class="row justify-content-end">
                                <form class="d-flex align-items-center col-lg-8 col-md-12 col-sm-12 mt-2 mt-md-0 mb-2 mb-md-0 w-100">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-6 searchExam" id="searchInput" placeholder="Search Here">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="tab-content" id="tabContent">
                            <!-- Tab -->

                            <!-- All Exams Tab  -->
                            <div class="tab-pane fade active show" id="all-students" role="tabpanel" aria-labelledby="all-students-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover w-100 amount_list">
                                        <thead class="table-light">
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                                        <label class="form-check-label" for="checkAll"></label>
                                                    </div>
                                                </th>
                                                <th>Sr. No.</th>
                                                <th>Course Name</th>
                                                <th>Exam Name</th>
                                                <th>Amount</th>
                                                <th>Actions</th>
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

{{-- Add Exams --}}
<div class="modal fade" id="examAmountView" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Add Exam Amount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row needs-validation exams-section" id="addExamAmountData" novalidate class="">
                    @csrf
                    <div class="mb-3 col-12">
                        <label for="course_id" class="form-label">Select Course <span class="text-danger">*</span></label>
                        <select class="form-select getCourseExamList" id="course_id" name="course_id">
                            <option value="">Select Course</option>  
                            @php 
                                $data = DB::table('course_master')
                                    ->select('id', 'course_title')
                                    ->where('category_id', 1)
                                    ->whereIn('status', [1, 3])
                                    ->orderBy('id', 'DESC')
                                    ->get();
                            @endphp
                            @foreach ($data as $list)
                                <option value="{{base64_encode($list->id)}}">{{$list->course_title}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="course_error">Please select course</div>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="exam_id" class="form-label">Select Exam <span class="text-danger">*</span></label>
                        <select class="form-select" id="exam_id" name="exam_id" data-type="exam_type">
                            <option value="">Select Exam</option>
                        </select>
                        <div class="invalid-feedback" id="exam_error">Please select exam</div>
                    </div>
                    <input type="hidden" id="exam_type" name="exam_type">
                    <div class="mb-2 col-12">
                        <div class="row">
                            <div class="col">
                                <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter Amount" required>
                                <div class="invalid-feedback mt-0" id="amount_error">please enter amount</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end pt-2">
                        <button type="button" class="btn btn-primary me-2" id="addExamAmount">Add</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Exams --}}
<div class="modal fade" id="examViewEdit" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Edit Exam Amount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row needs-validation exams-section" id="editExamAmountData"  novalidate class="">
                    <div class="mb-2 col-12">
                        <div class="row">
                            <div class="col">
                                <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="amount" id="amount-edit" placeholder="Enter Amount" required>
                                <div class="invalid-feedback mt-0" id="amount_edit_error">please enter amount</div>
                            </div>
                            <input type="hidden" class="form-control" name="id" id="id">
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end pt-2">
                        <button type="button" class="btn btn-primary me-2" id="editExamAmount" >Edit</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('admin/js/examCommon.js')}}"></script>
<script>
    $(document).ready(function () {
        examAmountList();
        function examAmountList() {
            var amount_list = $(".amount_list").DataTable();
            var baseUrl = window.location.origin + "/";
            $("#processingLoader").fadeIn();
            $.ajax({
                url: baseUrl + "admin/get-exam-amount-list",
                method: "GET",
                success: function (data) {
                    $("#processingLoader").fadeOut();
                    $(".amount_list").DataTable().destroy();
                    $('#count').html("("+data.length+")");
                    $(".amount_list").DataTable({
                        data: data, 
                        
                        columns: [
                            {
                                data: "id",
                                render: function (data, type, full, meta) {
                                    var CourseId = btoa(data);
                                    var isChecked = full.checked ? "checked" : "";
                                    return (
                                        '<form class="actionData"><input type="checkbox" class="form-check-input checkbox sub_chk " name="userId[]" value="' +
                                        CourseId +
                                        '" ' +
                                        isChecked +
                                        "></form>"
                                    );
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
                                render: function (data, type, row) {
                                    var name = data.course_title;
                                    return name;
                                },
                                width: "30%"
                            },

                            {
                                data: null,
                                render: function (data) {
                                    var exam_title =  data.exam_title
                                    return exam_title;
                                },
                                width:"40%"
                            },
                            {
                                data: null,
                                render: function (data) {
                                    var amount = data.amount;
                                    return amount;
                                },
                                width:"10%"
                            },
                            {
                                data: null,
                                render: function (row) {
                                    var examAmountId = btoa(row.id);
                                    
                                    var action = btoa("edit");
                                    var editUrl = baseUrl + "admin/exam-amount-data-edit/" + examAmountId;

                                    return (
                                        '<div class="hstack gap-3"><a href="javascript:void(0);" data-exam-amount-id="' + examAmountId + '" data-bs-toggle="tooltip" data-placement="top" title="Edit" class="open-edit-modal"><i class="fe fe-edit"></i></a><a href="javascript:void(0);"  class="deleteExamAmount" data-exam-amount-id="'+examAmountId+'" data-bs-toggle="tooltip" data-placement="top" title="Delete" ><i class="fe fe-trash"></i></a></div>'
                                    );
                                },
                                width:"10%"
                            },
                        ],
                    });
                },
                error: function (xhr, status, error) {
                    $("#processingLoader").fadeOut();
                    console.error(xhr);
                },
            });
        } 
        
        handleSearchInput('searchInput', function() {
            assignmentList(btoa('All')); 
        });
    });
    
    $(document).on('click', '.open-edit-modal', function (e) {
        e.preventDefault();
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var examAmountId = $(this).data('exam-amount-id');
        var baseUrl = window.location.origin;
        $.ajax({
            url: baseUrl + "/admin/get-exam-amount/" + examAmountId,
            type: "GET",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                
                if (response.code === 200) {
                    let data = response.data;
                    
                    $('#amount-edit').val(data.amount);
                    $('#id').val(btoa(data.id));
                    $('#examViewEdit').modal('show');
                } else {
                }
            },
        });
    });

    $('.searchExam').on('keyup', function() {
        var table = $('.amount_list').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
</script>
@endsection
