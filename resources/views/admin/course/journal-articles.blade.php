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
                            Document
                            <span class="fs-5" id="count">(0)</span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Document</a></li>
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
                        <a href="{{route('admin.course.add-journal-articles')}}"><button type="button" class="btn btn-primary">
                            Create <i class="fe fe-plus ms-1"></i>
                        </button></a>
                        <button type="button" class="btn btn-outline-primary deleteEntries" data-section="{{base64_encode('article')}}">
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
                                    <a class="nav-link active section-journal-tab"  data-bs-toggle="pill"  role="tab" aria-controls="all-journal" aria-selected="true" data-cat="all">All</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    {{-- <a class="nav-link"  onclick="list('deleted')" >Deleted</a> --}}
                                    {{-- <a class="nav-link section-journal-tab" data-cat="deleted" data-bs-toggle="pill" href="#all-journal" role="tab"  aria-selected="true">Delete</a> --}}
                                </li>
                            </ul>
                        </div>

                    
                        <!-- Form -->

                       
                        <div class="d-flex align-items-center col-12 col-md-5 col-lg-5 justify-content-end border-bottom">
                            <div class="row">
                                <form class="d-flex align-items-center col-lg-8 mt-3 mt-md-0 mb-3 mb-md-0 w-100">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-6 SearchJournalArticle" id="searchInput" placeholder="Search Here">
                                </form>

                            
                                <!-- input -->
                                {{-- <div class="col-auto">
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
                                        {{-- <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover tableList"> --}}
                                        <table class="table mb-0 text-nowrap table-hover tableList" width="100%">

                                            <thead class="table-light">
                                                <tr>
                                                    <th class="small-width">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th class="small-width">Sr. No.</th>
                                                    <th class="big-width">Document Title</th>
                                                    <th class="big-width">Assigned to Section</th>
                                                    <th class="mid-width">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                            <!-- Deleted Journal Article Tab  -->
                    </div>
                    <!-- Card Footer -->
                    <div class="card-footer">
                 
                    </div>
                </div>
            </div>
        </div>

        
    </section>
</main>

<script>
$('#checkAll').click(function (e) {
    $('.tableList tbody :checkbox').prop('checked', $(this).is(':checked'));
    e.stopImmediatePropagation();
});
$('.SearchJournalArticle').on('keyup', function() {
    var table = $('.tableList').DataTable();
    var searchTerm = $(this).val();
    table.search(searchTerm).draw();
});
$(document).ready(function () {
list('all');
handleSearchInput('searchInput', list);
});
$(".section-journal-tab").on("click", function (event) {
    event.preventDefault();
    list($(this).data("cat"));
});
    function list(action) {
        $("#processingLoader").fadeIn();
    $(".dataTables_filter").css("display", "none");
    var table = $(".tableList").DataTable();
//    table.destroy();
    $.ajax({
        // url: "{{ route('admin.articleList')}}",
        url: "{{ route('/')}}/admin/get-journal-article/" + action,
        method: "GET",
        success: function (data) {
            $("#processingLoader").fadeOut();
            $(".tableList").DataTable().destroy();
            $('#count').html("("+data.length+")");
            $(".tableList").DataTable({
                data: data, // Pass
                columns: [
                    {
                        data: 'id',
                        render: function (data, type, full, meta) {
                            var id = btoa(data);
                            var isChecked = full.checked ? "checked" : "";
                            var section_type = btoa("article");
                            return (
                                '<form class="actionData"><input type="hidden" class="form-check-input action" name="action" value="'+section_type+'"><input type="checkbox" class="form-check-input checkbox sub_chk"  name="id[]" value="' +
                                id +
                                '" ' +
                                isChecked +
                                "></form>"
                            );
                        },
                        width:"0%"
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
                        render: function (data) {
                            var name = data.docs_title;
                            return (
                                "<div class='d-flex align-items-center'><div></div><div class='text-wrap-title'><h4 class='mb-1 text-primary-hover'>" +
                                name +
                                "</h4>"
                            );
                        },
                        width:"40%"
                    },
                    {
                        data: null,
                        render: function (data) {
                            section_name = '';
                            if(data.section){
                                var section_name = data.section.section_name;
                            }
                            return `
                                <div class="text-wrap-title">
                                    ${section_name}
                                </div>
                            `;
                        },
                        width:"40%"

                    },
                    {
                        data: null,
                        render: function (row) {
                            var id = btoa(row.id);
                            var section_type = btoa("article");
                            var action = btoa("edit");
                            var editUrl ="{{ route('/')}}/admin/get-journal-article-edit/" + id + "/"+ action;
                            return (
                                '<div class="hstack gap-3"><a href="' +
                                editUrl +
                                '" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a href="javascript:void(0)" data-bs-toggle="tooltip" data-placement="top" class="deleteEntry" data-delete_id="'+id+'" data-section_type="'+section_type+'" title="Delete" ><i class="fe fe-trash"></i></a></div>'
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

// const searchInput = document.getElementById('searchInput');
//     searchInput.addEventListener('input', function () {
//         if (searchInput.value === '') {
//             list();
//         }
// });

</script>

@endsection
