<!-- Header import -->
@extends('admin.layouts.main')
 @section('content')



    <section class="py-4 py-lg-6 bg-primary bg-green">
        <div class="container">
            <div class="row">
                <div class="offset-lg-1 col-lg-10 col-md-12 col-12">
                    <div class="d-lg-flex align-items-center justify-content-between">
                        <!-- Content -->
                        <div class="mb-4 mb-lg-0">
                            <h1 class="mb-1 color-blue fw-bold">Orientation Video Management</h1>
                            <p class="mb-0 lead text-black">Add and Manage Orientation Videos from the Admin Panel</p>
                        </div>
                        {{-- <div>
                            <a href="all-award" class="btn btn-white bg-blue color-green">Back to Course</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Container fluid -->
    <section class="p-4">
    <div class="container">
                        <div class="row">
                            <div class="offset-lg-1 col-lg-10 col-md-12 col-12">

                                <div class="bs-stepper-content mt-5">
                                    <form class="basicCourseForm" enctype="multipart/form-data">
                                        
                                        <!-- Course Media -->
                                        <div>
                                            <!-- Card -->
                                              <form class="CourseMediaForm" >
                                            <div class="card mb-3 border-0 px-3">
                                                <div class="card-header border-bottom px-4 py-3 mb-4">
                                                    <h4 class="mb-0">Orientation</h4>
                                                </div>
                                               
                                                <div class="row ori-video">
                                                    <div class="col-md-3">
                                                        <div class="card mb-3 mb-4">
                                                            <div class="p-1">
                                                                <div class="d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover  position-relative" style="background-image:url({{asset('admin/images/course/masters-human-resource-management.png') }});height:210px;">
                                                                    <a class="glightbox icon-shape rounded-circle btn-play icon-xl" href="https://www.youtube.com/watch?v=Nfzi7034Kbg">
                                                                        <i class="fe fe-play"></i>
                                                                    </a>

                                                                    
                                                                </div>
                                                                <i class="bi bi-x-circle-fill close-icon" data-bs-toggle="modal" data-bs-target="#delete-video"></i>
                                                                <i class="bi bi-pencil edit-icon" data-bs-toggle="modal" data-bs-target="#edit-video"></i>
                                                                
                                                            </div>
                                                            <!-- Card body -->
                                                            <div class="card-body p-1 ps-3">
                                                                <!-- Price single page -->
                                                                <div class="mb-3">
                                                                    <h4 class="text-dark fw-bold">1. Director’s Introduction</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-3">
                                                        <div class="card mb-3 mb-4">
                                                            <div class="p-1">
                                                                <div class="d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover  position-relative" style="background-image:url({{asset('admin/images/course/masters-human-resource-management.png') }});height:210px;">
                                                                    <a class="glightbox icon-shape rounded-circle btn-play icon-xl" href="https://www.youtube.com/watch?v=Nfzi7034Kbg">
                                                                        <i class="fe fe-play"></i>
                                                                    </a>

                                                                    
                                                                </div>
                                                                <i class="bi bi-x-circle-fill close-icon" data-bs-toggle="modal" data-bs-target="#delete-video"></i>
                                                                <i class="bi bi-pencil edit-icon" data-bs-toggle="modal" data-bs-target="#edit-video"></i>
                                                                
                                                            </div>
                                                            <!-- Card body -->
                                                            <div class="card-body p-1 ps-3">
                                                                <!-- Price single page -->
                                                                <div class="mb-3">
                                                                    <h4 class="text-dark fw-bold">2. Orientation</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 d-flex">
                                                        <div class="card mb-3 mb-4 w-100 d-flex justify-content-center align-items-center text-center">
                                                            <div class="upload">
                                                                <p> Add Video </p>
                                                                <label class="upload-area">
                                                                <span class="upload-button" data-bs-toggle="modal" data-bs-target="#addLectureVideoModal">
                                                                    <i class="fe fe-plus"></i>
                                                                </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <!-- Button -->
                                            <div class="d-flex justify-content-between">
                                                {{-- <button class="btn btn-secondary" onclick="courseForm.previous()">Previous</button> --}}
                                                 <button class="btn btn-primary ">Save Now </button>
                                            </div>
                                              </form>
                                        </div>



                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
    </section>
</main>
@php
  $getModuleData = getData('course_section_masters',['id'],['section_category' => 2]);
@endphp

        <!-- Add Video Modal -->
        <div class="modal fade" id="addLectureVideoModal" tabindex="-1" role="dialog" aria-labelledby="addLectureVideoModalLabel" aria-hidden="true">
            <form class="CourseVideos">
                <input type="hidden" value="{{ isset($getModuleData[0]->id) ? base64_encode($getModuleData[0]->id) : ''}}" name="section_id" class="section_id">
                 <input type="hidden" value="{{base64_encode('ORIENTATIOIN')}}" name="video_type" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addLectureVideoModalLabel">Add Orientation Video</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="courseTitle" class="form-label">Video Title</label>
                            <input id="courseTitle" class="form-control" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="video_title" id="video_title" type="text" placeholder="Video Title ">
                                <div class="invalid-feedback" id="video_title_error">Please Enter Scholarship</div>
                        </div>
                        
                        <div class="custom-file-container mb-2">
                            <div class="label-container">
                                <label class="form-label">Upload Video Lecture</label>

                            </div>
                            <label class="input-container">
                                <input accept=".mp4" aria-label="Choose File" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="video_file" class="input-hidden" id="file-upload-with-preview-courseImage" type="file">
                                <span class="input-visible">Choose file...<span class="browse-button">Browse</span></span>
                            </label>
                           
                        </div>

                        <div class="mb-3 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover" style="background-image:url({{asset('frontend/images/course/course-javascript.jpg')}}); height: 250px">
                            <a href="https://www.youtube.com/watch?v=Nfzi7034Kbg" class="icon-shape rounded-circle btn-play icon-xl glightbox position-absolute top-50 start-50 translate-middled">
                                <i class="bi bi-play-fill fs-3"></i>
                            </a>
                        </div>

                        <button class="btn btn-primary UploadVideo" type="Button">Add Lecture</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </form>
        </div>


        <!-- Edit Video Modal -->
        <div class="modal fade" id="edit-video" tabindex="-1" role="dialog" aria-labelledby="addLectureVideoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addLectureVideoModalLabel">Edit Orientation Video</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="courseTitle" class="form-label">Video Title</label>
                            <input id="courseTitle" class="form-control" name="teststts"  type="text" placeholder="Video Title ">
                        </div>
                        
                        <div class="custom-file-container mb-2">
                            <div class="label-container">
                                <label class="form-label">Upload Video</label>

                            </div>
                            <label class="input-container">
                                <input accept="*" aria-label="Choose File" class="input-hidden" id="file-upload-with-preview-courseImage" type="file">
                                <span class="input-visible">Choose file...<span class="browse-button">Browse</span></span>
                            </label>
                           
                        </div>

                        <div class="mb-3 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover" style="background-image:url({{asset('frontend/images/course/course-javascript.jpg')}}); height: 250px">
                            <a href="https://www.youtube.com/watch?v=Nfzi7034Kbg" class="icon-shape rounded-circle btn-play icon-xl glightbox position-absolute top-50 start-50 translate-middle">
                                <i class="bi bi-play-fill fs-3"></i>
                            </a>
                        </div>

                        <button class="btn btn-primary" type="Button">Edit</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Delete video  --}}
        <div class="modal fade" id="delete-video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you really want to delete video?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Delete</button>
                    </div>
                </div>
            </div>
        </div>


@endsection
