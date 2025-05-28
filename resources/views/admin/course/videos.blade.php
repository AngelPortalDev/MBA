<!-- Header import -->
@extends('admin.layouts.main')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2-container--default .select2-selection--single{
        border: 0;
    }
    .select2-container .select2-selection--single .select2-selection__rendered{
        padding-left: 0;
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
                            Video
                            <span class="fs-5 counts">(0)</span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Video</a></li>
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
                        <a href="javascript:void(0)" id="addVideo"><button type="button" class="btn btn-primary">
                            Create <i class="fe fe-plus ms-1"></i>
                        </button></a>
                        {{-- <button type="button" class="btn btn-outline-primary deleteVideo">
                            Delete <i class="fe fe-trash ms-1"></i>
                        </button> --}}
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
            <div class="col-lg-12 col-md-12 col-12 mt-3 mt-lg-0">
                <!-- Card -->
                <div class="card rounded-3">
                    <!-- Card Header -->
                    <div class="p-4 row">
                        <div class="card-header p-0 col-12 col-md-7 col-lg-7">
                            <ul class="nav nav-lb-tab border-bottom-0" id="tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active section-video-tab" data-bs-toggle="pill" href="#all-videos" role="tab"  aria-selected="true">All</a>

                                </li>

                                <li class="nav-item" role="presentation">
                                    {{-- <a class="nav-link" id="deleted-e-mentor-tab" data-bs-toggle="pill" href="#deleted-e-mentor" role="tab" aria-controls="deleted-e-mentor" aria-selected="false" tabindex="-1">Deleted</a> --}}
                                    {{-- <a class="nav-link section-video-tab" data-cat="deleted" data-bs-toggle="pill" href="#all-videos" role="tab"  aria-selected="true">Delete</a> --}}

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
                                    <input type="search" class="form-control ps-6 searchVideo" id="searchInput" placeholder="Search Here">
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
                            <div class="tab-pane fade active show" id="all-videos" role="tabpanel" aria-labelledby="all-students-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table table-responsive mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover course_vides_table w-100">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="w-0">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th class="w-0">Sr. No.</th>
                                                    <th class="w-0">Video Title</th>
                                                    <th class="w-0">Assigned to Section</th>
                                                    <th class="w-0">Section Status</th>
                                                    <th class="w-0">Action</th>
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
                                                        <td>2</td>
            

                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="">
                                                                    <a class="glightbox " href="https://www.youtube.com/watch?v=Nfzi7034Kbg">
                                                                        
                                                                    
                                                                        <span class="icon-shape bg-blue color-green text-white icon-xs rounded-circle">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z">
                                                                            </path></svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                <div class="ms-2">
                                                                        
                                                              Video Title 2
                                                                       
                                                                </div>
                                                            </div>
                                                        </td>
                                                    <td>Job Analysis</td>
                                                    <td>Award in Recruitment and Employee Selection</td>
 
        
        
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a href="#" data-bs-toggle="tooltip" data-placement="top" title="Edit" >
                                                                <span class="upload-button" data-bs-toggle="modal" data-bs-target="#addCourseVideoModal">
                                                                    <i class="fe fe-edit"></i>
                                                                </span>
                                                            </a>


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
                                                </tr> --}}
                                                
                                               
                                                                                                
                                               

                                            </tbody>
                                        </table>
                                </div>
                            </div>

                            <!-- Deleted Video Tab  -->
                            {{-- <div class="tab-pane fade" id="deleted-e-mentor" role="tabpanel" aria-labelledby="deleted-e-mentor-tab">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->
                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-centered table-hover ">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Sr. No.</th>
                                                    <th>Video Title</th>
                                                    <th>Assigned to Section</th>
                                                    <th>Assigned to Award</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> --}}
                                                {{-- <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="postOne">
                                                                <label class="form-check-label" for="postOne"></label>
                                                            </div>
                                                        </td>
                                                        <td>1</td>
            

                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="">
                                                                    <a class="glightbox " href="https://www.youtube.com/watch?v=Nfzi7034Kbg">
                                                                        
                                                                    
                                                                        <span class="icon-shape bg-blue color-green text-white icon-xs rounded-circle">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z">
                                                                            </path></svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                <div class="ms-2">
                                                                        
                                                              Video Title 1
                                                                       
                                                                </div>
                                                            </div>
                                                        </td>
                                                    <td>Job Analysis</td>
                                                    <td>Award in Recruitment and Employee Selection</td>
 
        
        
                                                    <td>
                                                        <div class="hstack gap-3">
                                                             
                                                            <a href="#" data-bs-toggle="tooltip" data-placement="top" title="Edit" >
                                                                <span class="upload-button" data-bs-toggle="modal" data-bs-target="#addCourseVideoModal">
                                                                    <i class="fe fe-edit"></i>
                                                                </span>
                                                            </a>


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
                                                </tr> --}}
                                            {{-- </tbody>
                                        </table>
                                </div>
                            </div> --}}
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




<!-- Add Video Lecture Modal -->
<div class="modal fade" id="addCourseVideoModal" tabindex="-1" role="dialog" aria-labelledby="addCourseVideoModalLabel" aria-hidden="true">
    <form class="CourseVideos">
        {{-- <input type="hidden" name="section_id" class="section_id"> --}}
        
        <input type="hidden" name="video_type" class="video_type" value="{{base64_encode('COURSE_VIDEO')}}">
        {{-- <input type="hidden" name="video_id" id="video_id" value="{{base64_encode(0)}}"> --}}
        
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addCourseVideoModalLabel">Add Video</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <div class="mb-3">
                        <label for="courseTitle" class="form-label">Video Group Name</label>
                        <input id="courseTitle" class="form-control" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="video_title" id="video_title" type="text" placeholder="Please Enter Video Group Name">
                            <div class="invalid-feedback" id="video_title_error">Please Enter Video Group Name</div>
                    </div> --}}

                    <div class="mb-3">
                        <label for="courseTitle" class="form-label">Select Section <span class="text-danger">*</span> </label>
                        <select class="form-select selectSectionId" id="selectSectionId" aria-label="Default select example" name='section_id'>
                            <option value='' selected="">Select</option>
                            <?php $SectionData = getData('course_section_masters',['id','section_name'],['is_deleted'=>'No'],'','id','DESC');?>
                            @foreach($SectionData as $stud) 
                                <option value="{{ base64_encode($stud->id)}}">
                                    {{htmlspecialchars_decode($stud->section_name)}}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="section_error">Please Select Section.</div>

                    </div>

                    <div class="mb-3 pe-none">
                        <label for="videoTitle" class="form-label">Video Title  <span class="text-danger">*</span></label>
                        <input id="videoTitle" class="form-control bg-light" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="video_title" type="text" placeholder="Video Title">
                            <div class="invalid-feedback" id="video_title_error">Please Enter Video Title</div>
                    </div>
                    <input id="videoLength" class="form-control" value="" name="video_length" type="hidden" placeholder="Video Length">
                    <input id="collectionId" class="form-control" value="" name="collection_id" type="hidden" placeholder="Collection Id">
                    <input id="guid" class="form-control" value="" name="guid" type="hidden" placeholder="Video Id">
                    <input id="video_id" class="form-control" value="" name="video_id" type="hidden" placeholder="Video Id">
                    

                    <div class="mb-3">
                        <label for="videoId" class="form-label">Video Id  <span class="text-danger">*</span></label>
                        <input id="videoId" class="form-control" value="{{ isset($CourseData[0]['video_id']) ? base64_encode($CourseData[0]['video_id']) : ''}}" name="video_id" type="text" placeholder="Video Id">
                            <div class="invalid-feedback" id="video_id_error">Please Enter Video Id</div>
                            <div class="invalid-feedback" id="correct_video_id_error">Please Enter Correct Video Id</div>
                    </div>
                    
                    {{-- <div class="custom-file-container mb-2">
                        <div class="label-container">
                            <label class="form-label">Upload Video  <span class="text-danger">*</span></label>
                        </div>
                        <label class="input-container">
                            <input accept=".mp4" aria-label="Choose File" name="video_file" class="input-hidden video_file" id="file-upload-with-preview-courseImage" type="file">
                            <span class="input-visible" id="filUrl">Choose file...<span class="browse-button">Browse</span></span>
                        </label>
                    </div> --}}

                    {{-- <div class="mb-3">
                        <input id="video_duration" class="form-control video_duration" value="" name="video_duration" type="hidden" placeholder="video_duration">
                    </div> --}}

                    <video controlslist="nodownload" controls="" oncontextmenu="return false;" class="mb-6 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover video-preview-trailor d-none w-100" height="250px;" width="450px;" src=""></video>
                    <div class="thumbnail-edit d-block mb-3 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover d-none" style="background-image:url({{asset('frontend/images/course/course-javascript.jpg')}}); height: 250px">
                        <a href="#" class="videoUrlLink icon-shape rounded-circle btn-play icon-xl glightbox position-absolute translate-middled">
                            <i class="bi bi-play-fill fs-3"></i>
                        </a> 
                    </div>

                    <button class="btn btn-primary UploadCourseVideo" type="Button" disabled id="saveButton">Save</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade modal-lg videoOpen " tabindex="-1" role="dialog" aria-labelledby="addLecturerModalLabel"
aria-hidden="true" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content position-relative" style="background: none; border: none">
            {{-- <button type="button" class="btn-close videoclose" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            <i class="bi bi-x fs-2 text-white couser-detail-modal-close-button" data-bs-dismiss="modal" aria-label="Close"></i>

            <div class="previouseVideo mb-4" style="position:relative;padding-top:56.25%;"><iframe src="" class="videoFrame" id="videoFrame" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {

    $('.videoUrlLink').click(function (e) {
    $(".save_loader").addClass("d-none").fadeOut();
    $("#addCourseVideoModal").modal("hide");
    $("#glightbox-body").addClass("d-none")
        var videourl = $(this).data("videourl");
        $('.videoOpen').modal({
            backdrop: 'static',
            keyboard: false
        });
        $(".save_loader").addClass("d-none").fadeOut();
        $(".videoOpen").modal('show');
        // $('.videoFrame').attr('src', videourl);
        const videoFrame = document.querySelector(".videoFrame");

        if (videoFrame) {
            // Set the src attribute of the iframe
            var hrefValue = $('.videoUrlLink').attr('href');
            
            videoFrame.src = hrefValue; // Replace with your video URL
            // const player = new playerjs.Player(videoFrame);
            // const icons = document.querySelectorAll('.plyr__control svg');
    
            // icons.forEach(icon => {
            //     icon.style.width = '10px';
            //     icon.style.height = '10px';
            // });

            // player.on('ready', () => {
            //     // Set CSS variable for icon size
            //     document.documentElement.style.setProperty('--plyr-control-icon-size', '10px');
            //     // Adjust the size of control icons
            //     const icons = document.querySelectorAll('.plyr__control svg');
    
            //     icons.forEach(icon => {
            //         icon.style.width = '10px';
            //         icon.style.height = '10px';
            //     });
            // });
        }

    });
    videoList();
    handleSearchInput('searchInput', videoList);
     $("#addVideo").on("click", function (event) {
        $(".CourseVideos")[0].reset();
        $("#addCourseVideoModal").modal("show");
        $('#videoId').removeAttr('style');
        $('#videoId').removeAttr('disabled');
        $("#addCourseVideoModalLabel").html("Add Video");
        
    });
});
$(".section-video-tab").on("click", function (event) {
    event.preventDefault();
    videoList($(this).data("cat"));
});
$('#checkAll').click(function (e) {
    $('.course_vides_table tbody :checkbox').prop('checked', $(this).is(':checked'));
    e.stopImmediatePropagation();
});
$('.searchVideo').on('keyup', function() {
    var table = $('.course_vides_table').DataTable();
    var searchTerm = $(this).val();
    table.search(searchTerm).draw();
});



function videoList(action= '') {
    $("#processingLoader").fadeIn();
    $(".dataTables_filter").css("display", "none");
    $.ajax({
        url: "{{route('admin.getCourseVideo')}}",
        method: "GET",
        data :{
            'action': btoa(action)
        },
        success: function (data) {
            $("#processingLoader").fadeOut();
            $(".course_vides_table").DataTable().destroy();
            $('.counts').html("("+data.data.length+")");
            $(".course_vides_table").DataTable({
                data: data.data, // Pass
                columns: [
                    {
                        data: "id",
                        render: function (data, type, full, meta) {
                            
                            var VideoId = btoa(data);
                            var isChecked = full.checked ? "checked" : "";

                            return (
                                '<form class="actionData"><input type="hidden" class="form-check-input action" name="action" ><input type="checkbox" data-delete_id="'+VideoId+'" class="form-check-input checkbox sub_chk " name="id[]" value="' +
                                VideoId +
                                '" ' +
                                isChecked +
                                "></form>"
                            );
                        },

                        width:"2%"
                    },
                    {
                        data: null,
                        render: function (data, type, full, row) {
                            i = row.row + 1;
                            return i;
                        },
                        width:"8%"
                    },
                    {
                        data: null,
                        render: function (data) {
                            var name = data.video_title != '' ? data.video_title : '';                         
                            var bn_video_url_id = data.bn_video_url_id != '' ? data.bn_video_url_id : '';                         
                            return (
                                "<div class='d-flex align-items-center' ><div class=''><a href='https://iframe.mediadelivery.net/embed/253882/"+bn_video_url_id+"?autoplay=false&loop=false&muted=true&preload=false&responsive=true' target='_blank'><span class='icon-shape bg-blue color-green text-white icon-xs rounded-circle'><svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='currentColor' class='bi bi-play-fill' viewBox='0 0 16 16'><path d='m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z'></path></svg></span></a></div><div class='ms-2 text-wrap-title'>"+name+"</div></div>"
                            );
                        },
                        width:"30%"
                    },
                    {
                        data: null,
                        render: function (data) {
                            var section_name =  data.section_video.length > 0 ?  data.section_video[0].section_name : '';
                            return `
                                <div class="text-wrap-title">
                                    ${section_name}
                                </div>
                            `;
                        },
                        width:"30%"
                    },
                    {
                        data: null,
                        render: function (data) {
                            if(data.section_video[0]){
                                var status = data.section_video[0].is_active;
                            }else{
                                status = "No";
                            }
                            if (status === "No") {
                                return '<span class="badge text-danger bg-light-danger">Inactive</span>';
                            }
                            if (status === "Yes") {
                                return '<span class="badge text-success bg-light-success">Active</span>';
                            }
                        },
                        width:"10%"
                    },
                    {
                        data: "id",
                        render: function (data) {
                             var VideoId = btoa(data);
                            var action = btoa("edit");
                            return (
                                '<div class="hstack gap-3 m-2"><a href="#" class="videoEdit" data-video_id="'+VideoId+'" data-action="'+action+'" data-bs-toggle="tooltip" data-placement="top" title="Edit"><i class="fe fe-edit"></i></a><a href="#" class="deleteVideo" data-delete_id="'+VideoId+'"   data-bs-toggle="tooltip" data-placement="top" title="Delete" ><i class="fe fe-trash"></i></a></div>'
                            );
                        },
                        width:"20%"
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
    document.getElementById('videoId').addEventListener('blur', function () {
        const videoId = this.value;

        const videoIdInput = document.getElementById('videoId');
        const saveButton = document.getElementById('saveButton');
        const loader = $(".save_loader");


        if (videoId) {
            // loader.removeClass("d-none").addClass("d-block");
            $("#processingLoader").fadeIn();
            fetch('{{ route("check.video.id") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ video_id: videoId })
            })
            .then(response => response.json())
            .then(data => {
                // $(".save_loader").addClass("d-none").removeClass("d-block");
                $("#processingLoader").fadeOut();
                if (data.code === 200) {
                    if (data.exists) {
                        videoIdInput.style.borderColor = 'green';
                        videoIdInput.style.borderWidth = '2px';
                        videoIdInput.style.borderStyle = 'solid';
                        videoIdInput.style.boxShadow = '0 0 5px rgba(0, 255, 0, 0.5)';
                        videoIdInput.style.backgroundColor = '#eaffea';
                        document.getElementById('correct_video_id_error').style.display = 'none';
                        saveButton.disabled = false;
                        videoIdInput.disabled = true;
                        $("#videoTitle").val(data.data.data.title);
                        $("#videoLength").val(btoa(data.data.data.length));
                        $("#collectionId").val(btoa(data.data.data.collectionId));
                        $("#guid").val(btoa(data.data.data.guid));
                    } else {
                        document.getElementById('correct_video_id_error').style.display = 'block';
                    }
                } else {
                    videoIdInput.style.borderColor = 'red';
                    videoIdInput.style.borderWidth = '2px';
                    videoIdInput.style.borderStyle = 'solid';
                    videoIdInput.style.boxShadow = '0 0 5px rgba(255, 0, 0, 0.5)';
                    videoIdInput.style.backgroundColor = '#ffe6e6'
                    document.getElementById('correct_video_id_error').style.display = 'block';
                    saveButton.disabled = true;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });

    $('#addCourseVideoModal').on('shown.bs.modal', function () {
    $('#selectSectionId').select2({
        dropdownParent: $('#addCourseVideoModal'),
        placeholder: "Select a section",
    });
});


</script>
@endsection
