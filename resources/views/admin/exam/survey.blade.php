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
                            Survey
                            <span class="fs-5" id="count">(0)</span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Survey</a></li>
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
                <div class="d-sm-flex justify-content-sm-end">
                    <!-- Button With Icon -->
                    <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#surveyModal">
                            Create <i class="fe fe-plus ms-1"></i>
                        </button>
                    </div>
                    {{-- <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                        <button type="button" class="btn btn-outline-primary ">
                            Delete <i class="fe fe-trash ms-1"></i>
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
                                <form
                                    class="d-flex align-items-center col-lg-8 col-md-12 col-sm-12 mt-2 mt-md-0 mb-2 mb-md-0 w-100">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-6 searchSurvey" placeholder="Search Here">
                                </form>
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
                                    <table
                                        class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover contentList w-100">
                                        <thead class="table-light">
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                                        <label class="form-check-label" for="checkAll"></label>
                                                    </div>
                                                </th>
                                                <th>Sr. No.</th>
                                                <th>Survey Title</th>
                                                <th>Assigned to Course</th>
                                                <th>Total Percentage (%)</th>
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
    </section>
    </main>

    <div class="modal fade" id="surveyModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Create Survey</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row needs-validation survey-section" id="addSurveyData"  novalidate class="">
                        <div class="mb-4 col-12">
                            <label for="Select Award" class="form-label">Select Award <span class="text-danger">*</span></label>
                            <select class="form-select select2" id="award_id" name="award_id" >
                                <option value="">Select Award Course</option>  
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
                            <div class="invalid-feedback" id="award_error">Please select award course</div>
                        </div>

                        <div class="mb-2 col-12">
                            <label for="SurveyTitle" class="form-label">Survey Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title"
                                id="title" placeholder="Survey Title" required>
                            <small>Survey title must be between 3 to 255 characters.</small>
                            <div class="invalid-feedback" id="title_error">Please enter survey title
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end pt-2">
                            <button type="button" class="btn btn-primary me-2" id="addSurvey">Add</button>
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<script>
    $(document).ready(function () {
        list(btoa('All'));
        
        handleSearchInput('searchInput', function() {
            list(btoa('All')); 
        });
        function list(action='') {
            $("#processingLoader").fadeIn();
            var list = $(".contentList").DataTable();
            var baseUrl = window.location.origin + "/";
            var condition =  action !='' ? action : btoa('ALL');
            
            $.ajax({
                url: baseUrl + "admin/survey-data/"+condition,
                method: "GET",
                success: function (data) {
                    $("#processingLoader").fadeOut();
                    $(".contentList").DataTable().destroy();
                    $('#count').html("("+data.length+")");
                    $(".contentList").DataTable({
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
                            },
                            {
                                data: null,
                                render: function (data,row) {
                                    var name = data.title;
                                    var assignId = btoa(data.id);
                                    var action = btoa("edit");
                                    var editUrl =
                                        baseUrl +
                                        "admin/survey-data-edit/" +
                                        action +
                                        "/" +
                                        assignId;
                                    return (
                                        "<div class='d-flex align-items-center text-inherit'>" +
                                                "<div class=''>" +
                                                    "<h4 class='mb-1 text-primary-hover text-wrap-title'>" +
                                                        "<a href='" + editUrl + "'>" + name + "</a>" +
                                                    "</h4>" +
                                                "</div>" +
                                        "</div>"
                                    );
                                },
                                width:"35%"
                            },
                            {
                                data: null,
                                render: function (data) {
                                    var course_title =  data['award_course'] && data['award_course']['course_title'] != null ?  data['award_course']['course_title'] : '';
                                    return(
                                        "<div class='d-flex align-items-center'><div></div><div class=''><p class='mb-1 text-wrap-title '>" +
                                            course_title +
                                        "</p>"
                                    )
                                        
                                },
                                width:"35%"
                            },
                            {
                                data: null,
                                render: function (data) {
                                    var percentage = data.percentage;
                                    return percentage;
                                },
                                width:"10%"
                            },
                            {
                                data: null,
                                render: function (row) {
                                    var assignId = btoa(row.id);
                                    var courseId = btoa(row.award_id);
                                    
                                    var action = btoa("edit");
                                    var editUrl =
                                        baseUrl +
                                        "admin/survey-data-edit/" +
                                        action +
                                        "/" +
                                        assignId;
                                    return (
                                        '<div class="hstack gap-3"><a href="' +
                                        editUrl +
                                        '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a href="javascript:void(0);"  class="deleteSurvey" data-assign_id="'+assignId+'" data-course_id="'+courseId+'" data-bs-toggle="tooltip" data-placement="top" title="Delete" ><i class="fe fe-trash"></i></a></div>'
                                    );
                                },
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

        $(".list-tab").on("click", function (event) {
            event.preventDefault();
            list(btoa($(this).data("cat")));
        });
    });
    $('.searchSurvey').on('keyup', function() {
        var table = $('.contentList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
    $('#surveyModal').on('shown.bs.modal', function () {
    $('#award_id').select2({
        dropdownParent: $('#surveyModal'),
        placeholder: "Select Award Course",
    });
}); 
</script>
@endsection
