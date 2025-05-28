<!-- Header import -->
@extends('admin.layouts.main')
@section('content')

<style>
    .select2-container {
        z-index: 9999 !important;
    }
    .select2-dropdown {
        z-index: 99999 !important;
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
                            Quiz
                            <span class="fs-5 counts"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Quiz</a></li>
                                <!-- <li class="breadcrumb-item active" aria-current="page">All Admin</li> -->
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">


                    </div>
                </div>
            </div>
            @if (session()->has('msg'))
                <script>
                    swal({
                        title: "{{session('msg')}}",
                        text: '',
                        icon: "{{session('icon')}}",
                    });

                    // const modalData = {
                    //     title: "{{session('msg')}}",
                    //     message: '',
                    //     icon: "{{session('icon')}}",
                    // }
                    // showModal(modalData);
                </script>
             @endif
              {{-- @if (session()->has('msg'))
             <script>
                swal({
                title: "{{session('msg')}}",
                text: '',
                icon: "{{session('icon')}}",
            });
            </script> --}}
             {{-- @endif --}}
            <!-- <form class="d-flex align-items-center col-12 col-lg-3"> -->
                <div class="col-lg-8 col-12 text-end pt-2 mb-0 mb-sm-3">
                    <div class="d-sm-flex justify-content-sm-end">
                          <!-- Button With Icon -->
                          <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuiz">
                                Create <i class="fe fe-plus ms-1"></i>
                                </button>
                          </div>
                          <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                            <button type="button" class="btn btn-outline-primary deleteQuiz">
                                Delete <i class="fe fe-trash ms-1"></i>
                            </button>
                          </div>
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
                                    <a class="nav-link active" id="all-students-tab" data-bs-toggle="pill" href="#all-students" role="tab" aria-controls="all-students" aria-selected="true">All</a>
                                </li>

                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="deleted-e-mentor-tab" data-bs-toggle="pill" href="#deleted-e-mentor" role="tab" aria-controls="deleted-e-mentor" aria-selected="false" tabindex="-1">Deleted</a> --}}
                                </li>
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
                                {{-- <div class="col-lg-6 col-md-12 col-sm-12 mt-2 mt-lg-0 mb-2 mb-lg-0">
                                    <!-- form select -->
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected="">Filter</option>
                                        <option value="Newest">Newest</option>
                                        <option value="Price: Low-High">Delected</option>
                                        <option value="Price: Low-High">Award</option>

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
                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover quiz_list w-100">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Sr. No.</th>
                                                    <th>Quiz Title</th>
                                                    <th>Assigned to Section</th>
                                                    <th>No. of Questions</th>
                                                    {{-- <th>Questions</th> --}}
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            </tbody>
                                        </table>
                                </div>
                            </div>

                            <!-- Deleted Quiz Tab  -->
                            <div class="tab-pane fade" id="deleted-e-mentor" role="tabpanel" aria-labelledby="deleted-e-mentor-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover quiz_list w-100">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Sr. No.</th>
                                                    <th>Quiz Title</th>
                                                   
                                                    <th>Assigned to</th>
                                                    <th>No. of Questions</th>
                                                     
        
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
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

<!-- Create Admin Modal -->
<div class="modal fade" id="addQuiz" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Create New Quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row needs-validation quiz-section"  id="quizForm" novalidate class="">
                    <div class="mb-4 col-12">
                        <label for="QuizTitle" class="form-label">Select Section <span class="text-danger">*</span></label>
                        <select class="form-select select2" id="section_id" name="section_id" >
                        <option value="">Select</option>
                        <?php $SectionData = getData('course_section_masters',['id','section_name'],['is_deleted'=>'No'],'','id','DESC');?>
                        @foreach($SectionData as $list)
                            <option value="{{ base64_encode($list->id)}}">
                                {{htmlspecialchars_decode($list->section_name)}}
                            </option>
                        @endforeach
                        </select>
                        <div class="invalid-feedback" id="section_error">Please select section</div>

                    </div>

                    <div class="mb-2 col-12">
                        <label for="QuizTitle" class="form-label">Quiz Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="quiz_tittle" id="quiz_tittle" placeholder="Quiz Title" required>
                        <small>Quiz title must be between 3 to 255 characters.</small>
                        <div class="invalid-feedback" id="quiz_tittle_error">Please enter quiz title</div>

                    </div>

                    <div class="col-12 d-flex justify-content-end pt-2">
                        <button type="button" class="btn btn-primary me-2 add-quiz-section" id="addQuiz" >Add</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        quizList();
        handleSearchInput('searchInput', quizList);
    });
    function quizList() {
        $("#processingLoader").fadeIn();
        $(".dataTables_filter").css("display", "none");
        var baseUrl = window.location.origin + "/";
        $.ajax({
            url: baseUrl + "admin/section-quiz-get-data/",
            method: "GET",
            success: function (data) {
                $("#processingLoader").fadeOut();
                $('.quiz_list').DataTable().destroy();
               $('.counts').html("("+data.length+")");
                $(".quiz_list").DataTable({
                    data: data, // Pass
                    columns: [
                        {
                            data: "id",
                            render: function (data, type, full, meta) {
                                var CourseId = btoa(data);
                                var isChecked = full.checked ? "checked" : "";
                                return (
                                    '<form class="actionData"><input type="checkbox" class="form-check-input checkbox sub_chk " name="userId[]" data-question_id="'+CourseId+'" value="' +
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
                                var name = data.quiz_tittle;
                                var CourseId = btoa(row.id);
                                var editUrl =
                                    baseUrl +
                                    "admin/edit-quiz-get-data/" +
                                    CourseId ;
                                return (
                                    "<div class='d-flex align-items-center text-inherit'><div></div><div class=''><h4 class='mb-1 text-primary-hover text-wrap-title'>" +
                                    name +
                                    "</h4>"
                                );
                            },
                        },
                        {
                            data: null,
                            render: function (data) {
                                var section_name = data.sections.length > 0 && data.sections[0].section_name != undefined  ? data.sections[0].section_name : 'Not Assign';
                                return (
                                    "<div class='d-flex align-items-center text-inherit'><div></div><div class=''><h4 class='mb-1 text-primary-hover text-wrap-title'>" +
                                        section_name +
                                    "</h4>"
                                );
                            },
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                var questionCount = 0;
                                if(data.quiz_question.length){
                                 var questionCount = data.quiz_question.length; 
                                }
                                return questionCount;
                            },
                        },
                  
                        {
                            data: null,
                            render: function (row) {
                                var CourseId = btoa(row.id);
                            
    
                                var editUrl =
                                    baseUrl +
                                    "admin/edit-quiz-get-data/" +
                                    CourseId ;
                                return (
                                    '<div class="hstack gap-3"><a href="' +
                                    editUrl +
                                    '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a href="javascript:void(0);"  class="deleteQuiz" data-question_id="'+CourseId+'" data-bs-toggle="tooltip" data-placement="top" title="Delete" ><i class="fe fe-trash"></i></a></div>'
                                );
                            },
                        },
                        // Add more columns as needed
                    ],
                });
            },
            error: function (xhr, status, error) {
                $("#processingLoader").fadeOut();
                console.error(xhr);
            },
        });
    }
    $('#checkAll').click(function (e) {
        $('.quiz_list tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });
    $('#searchInput').on('keyup', function() {
        var table = $('.quiz_list').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });

    $('#addQuiz').on('shown.bs.modal', function () {
    $('#section_id').select2({
        dropdownParent: $('#addQuiz'),
        placeholder: "Select Section",
        width: '100%'
    });
});

    </script>

@endsection
