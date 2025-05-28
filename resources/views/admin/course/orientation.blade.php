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
    @php
        $getModuleData = getData('course_section_masters',['id'],['section_category' => 2]);
    @endphp
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
                                                <?php $orientationData = getData('course_modules_videos', ['bn_collection_id', 'bn_video_url_id','video_title','id','video_duration'], ['section_id' => $getModuleData[0]->id,'is_deleted'=>'No']); ?>
                                                <div class="row ori-video">
                                                    @foreach($orientationData as $key => $data)

                                                    <div class="col-lg-4 col-md-6 col-sm-12">

                                                        <div class="card mb-3 mb-4">
                                                            <div class="p-1">
                                                                <?php 

                                                                $libraryId = env('MASTER_LIBRARY_ID');
                                                                $pullZone = env('PULL_ZONE_ID');
                                                                $videoUrl = "https://iframe.mediadelivery.net/embed/$libraryId/$data->bn_video_url_id?&loop=true&muted=true&preload=true&responsive=true";
                                                                $thumbnailUrl = $pullZone.$data->bn_video_url_id.'/thumbnail.jpg';
                                                          
                                                                ?>
                                                                @if($data->bn_collection_id != '')

                                                                <div class="d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover  position-relative" style="background-image:url('{{$thumbnailUrl}}');height:210px;">
                                                                    <a class="glightbox icon-shape rounded-circle btn-play icon-xl" href="{{$videoUrl}}">
                                                                        <i class="fe fe-play"></i>
                                                                    </a>

                                                                    
                                                                </div>
                                                                @else
                                                                @php $PDfURL = Storage::url($data->bn_video_url_id); @endphp
                                                                <div class="d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover  position-relative" style="background-image:url({{asset('frontend/images/PDF_file_icon.png')}}); height: 210px;">
                                                                    <a class="icon-shape rounded-circle btn-play icon-xl pdfiframe" style="position:relative">
                                                                        {{-- <i class="fe fe-eye"></i> --}}
                                                                        <i class="bi bi-eye edit-icon orientationPdf" data-action='{{$PDfURL}}'></i> 
                                                                        {{-- <i class="bi bi-eye edit-icon" class="btn btn-primary" data-toggle="modal" data-target="#orientation-pdf" data-video-url="{{$data->bn_video_url_id}}"></i> --}}
                                                                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#orientation-pdf">
                                                                            Open PDF
                                                                        </button> --}}
                                                                    </a>

                                                                    
                                                                </div>
                                                                @endif
                                                            
                                                                <i class="bi bi-x-circle-fill close-icon deleteVideo" data-bs-toggle="modal" data-delete_id="{{base64_encode($data->id)}}"></i>
                                                               
                                                                <i class="bi bi-pencil edit-icon edit-orientation" data-bs-toggle="modal" data-id="{{$data->id}}" data-bs-target="#edit-video"></i>
                                                             
                                                                
                                                            </div>
                                                          
                                                            <!-- Card body -->
                                                            <div class="card-body p-1 ps-3">
                                                                <!-- Price single page -->
                                                                <div class="mb-3">
                                                                    <h4 class="text-dark fw-bold">{{$data->video_title}}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     
                                                    </div>
                                                    @endforeach 
                                                    {{-- <div class="col-md-3">
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
                                                    </div>  --}}

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
                                                 {{-- <button class="btn btn-primary ">Save Now </button> --}}
                                            </div>
                                              </form>
                                        </div>



                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
    </section>

        <!-- Add Video Modal -->
        <div class="modal fade" id="addLectureVideoModal" tabindex="-1" role="dialog" aria-labelledby="addLectureVideoModalLabel" aria-hidden="true">
            <form class="CourseVideos">
                <input type="hidden" value="{{ isset($getModuleData[0]->id) ? base64_encode($getModuleData[0]->id) : ''}}" name="section_id" class="section_id">
                 <input type="hidden" value="{{base64_encode('ORIENTATIOIN')}}" name="video_type" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addLectureVideoModalLabel">Add Orientation Video </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="courseTitle" class="form-label">Video Title <span class="text-danger">*</span> </label>
                            <input class="form-control video_title" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="video_title" id="video_title" type="text" placeholder="Video Title ">
                                <div class="invalid-feedback" id="video_title_error">Please Enter Video Title</div>
                                <br>Video Title : Must be less than 150 characters.
                            </div>
                        
                        <div class="custom-file-container mb-2">
                            <div class="label-container">
                                <label class="form-label">Upload Video Lecture   <span class="text-danger">*</span> </label>
                            </div>
                            <label class="input-container">
                                <label class="form-label">Upload Video <span class="text-danger">*</span>
                                <input accept=".mp4,.pdf" aria-label="Choose File" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="video_file" class="input-hidden video_file" id="file-upload-with-preview-courseImage" type="file">
                                <span class="input-visible">Choose file...<span class="browse-button">Browse</span></span>
                                <div class="invalid-feedback" id="video_file_error">Please Upload Video File</div>
                            </label>
                            <div class="label-container">
                                  <br>For Video files: Must be MP4 and less than 2GB. <br>
                                    For PDF files: Must be less than 5MB.
                                  </label>
    
                            </div>
    
                        </div>
                     
                        <br><br>
                        {{-- <div class="mb-3 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover" style="background-image:url({{asset('frontend/images/course/course-javascript.jpg')}}); height: 250px">
                            <a href="https://www.youtube.com/watch?v=Nfzi7034Kbg" class="icon-shape rounded-circle btn-play icon-xl glightbox position-absolute top-50 start-50 translate-middled">
                                <i class="bi bi-play-fill fs-3"></i>
                            </a>
                        </div> --}}
                        <video controlsList="nodownload"  controls oncontextmenu="return false;" class="mb-6 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover video-preview-trailor d-none" controls height="150px;" width="450px;"></video>
                        <iframe class="pdfvieweradd d-none" src="" width="450px" height="210px"></iframe>

                        <br>
                        <button class="btn btn-primary UploadVideo" type="Button">Add Video</button>
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

                        
                    <form class="EditCourseVideos">
                        <input type="hidden" id="library_id" value="{{base64_encode(env('MASTER_LIBRARY_ID'))}}">                 
                        <input type="hidden" id="pull_zone_id" value="{{base64_encode(env('PULL_ZONE_ID'));}}">
                        <input type="hidden" value="{{ isset($getModuleData[0]->id) ? base64_encode($getModuleData[0]->id) : ''}}" name="section_id" class="section_id">
                        <input type="hidden" value="{{base64_encode('ORIENTATIOIN')}}" name="video_type" >
                        <input class="form-control" type="hidden" id="orientation_id" name="orientation_id" required>
                        <input class="form-control" type="hidden" id="video_duration" name="video_duration" required>

                        
                        <div class="mb-3">
                            <label for="courseTitle" class="form-label">Video Title <span class="text-danger">*</span> </label>
                            <input id="edit_video_title" class="form-control video_title" name="edit_video_title" type="text" placeholder="Video Title" class="edit_video_title" >
                            <div class="invalid-feedback" id="edit_video_title_error">Please Enter Video Title</div>
                             <br>Video Title : Must be less than 150 characters.
                        </div>
                        
                        <div class="custom-file-container mb-2">
                            <label class="form-label">Upload Video <span class="text-danger">*</span></label>
                            <label class="input-container">
                                {{-- <input accept="*" aria-label="Choose File" class="input-hidden" id="file-upload-with-preview-courseImage" type="file"> --}}
                                <input accept=".mp4,.pdf" aria-label="Choose File" name="edit_video_file" class="input-hidden edit_video_file" type="file" id="file-upload-with-preview-courseImage">
                                <span class="input-visible" id="video_file_name"><span class="browse-button">Browse</span></span>
                                <div class="invalid-feedback video_file_error">Please Upload Video File</div>
                            </label>
                                 <br>For Video files: Must be MP4 and less than 2GB. <br>
                                    For PDF files: Must be less than 5MB.
                               
                        </div>
                        <br>
                        <video controlsList="nodownload"  controls oncontextmenu="return false;" class="mb-6 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover video-preview-trailor d-none" controls height="150px;" width="450px;"></video>
                        <iframe class="pdfvieweradd d-none" src="" width="450px" height="210px"></iframe>
                        
                        <div class="mb-3 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover thumbnail-edit" style="visibility: hidden;">
                            <a href="" class="icon-shape rounded-circle btn-play icon-xl glightbox position-absolute top-50 start-50 translate-middle">
                                <i class="bi bi-play-fill fs-3"></i>
                            </a>
                        </div>
                        <div class="d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover  position-relative thumbnail-edit-pdf" style="visibility: hidden;">
                            <a class="icon-shape rounded-circle btn-play icon-xl pdfiframe">
                                {{-- <i class="fe fe-eye"></i> --}}
                                {{-- <i class="bi bi-eye edit-icon orientationPdf" data-action='{{$PDfURL}}'></i>  --}}
                                <iframe class="pdfviewer" src="" width="550px" height="210px"></iframe>
                                {{-- <i class="bi bi-eye edit-icon" class="btn btn-primary" data-toggle="modal" data-target="#orientation-pdf" data-video-url="{{$data->bn_video_url_id}}"></i> --}}
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#orientation-pdf">
                                    Open PDF
                                </button> --}}
                            </a>

                            
                        </div>

                        <button class="btn btn-primary UploadEditVideo" type="Button">Edit</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </form>
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
                        <input type='hidden' id="deleteId" name="deleteId" class="deleteId">
                        <input type="hidden" value="{{ isset($getModuleData[0]->id) ? base64_encode($getModuleData[0]->id) : ''}}" name="section_id" class="section_id">
                        <input type="hidden" value="{{base64_encode('ORIENTATIOIN')}}" name="video_type" class="video_type">
                        Are you really want to delete video?
                    </div>
                    <div class="modal-footer">
                       

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary deleteVideo">Delete</button>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="orientation-pdf" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
                        <button type="button" class="orientation-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe id="pdfViewer" src="" width="100%" height="500px"></iframe>
                    </div>
                </div>
            </div>
        </div>


@endsection