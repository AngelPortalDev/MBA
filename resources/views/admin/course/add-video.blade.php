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
                            <h1 class="mb-1 color-blue fw-bold">Add Videos</h1>
                            <p class="mb-0 lead text-black">Enhance Your Course with Lectures, Interviews, and Podcasts by Section</p>
                        </div>
                        <div>
                            <a href="videos" class="btn btn-white bg-blue color-green">Back to Videos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Container fluid -->



    <section class="container-fluid p-4 add-award-course">
        <div class="py-6">
            <!-- row -->
            <div class="row">
                <div class="offset-xl-2 col-xl-8 col-md-12 col-12">
                    <!-- card -->
                    <div class="card px-2">
                        
                        <!-- Organize Course Content -->
                        <div class="card-header">
                            <h3 class="mb-0">Organize Videos</h3>
                            <span class="fs-4">Add Lectures, Interviews, and Podcasts to    Section </span>
                        </div>
                        <div class="card-body">
                            <form class="row needs-validation" novalidate="">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <label class="form-label" for="email">Select Section</label>
                                    <!-- Select Option -->
                                    <div class="mb-3">
                                        <select class="form-select selectSectionId" aria-label="Default select example">
                                            <option selected>Select</option>
                                            <?php $SectionData = getData('course_section_masters',['id','section_name'],['is_deleted'=>'No'],'','id','DESC');?>
                                            @foreach($SectionData as $stud)                                             
                                                <option value="{{ base64_encode($stud->id)}}">{{$stud->section_name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                            </form>
                        </div>
                        <!-- First Section  -->
                        <div class="card-body bg-light rounded py-3 px-3 mb-3">
                            <div class="row " id="videoPreview">
                             <div class="col-md-4 col-lg-3 d-flex addVideo">
                                    <div class="card mb-2  w-100 d-flex justify-content-center align-items-center text-center p-3">
                                        <div class="upload">
                                            <p class="fs-4"> Add Video </p>
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



                    </div>
                </div>
            </div>
        </div>
    </section>





</main>


        <!-- Add Video Lecture Modal -->
        <div class="modal fade" id="addLectureVideoModal" tabindex="-1" role="dialog" aria-labelledby="addLectureVideoModalLabel" aria-hidden="true">
            <form class="CourseVideos">
                <input type="hidden" name="section_id" class="section_id">
                <input type="hidden" name="video_type" class="video_type" value="{{base64_encode('COURSE_VIDEO')}}">
                
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addLectureVideoModalLabel">Add New Video</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="mb-3">
                            <label for="courseTitle" class="form-label">Video Group Name</label>
                            <input id="courseTitle" class="form-control" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="video_title" id="video_title" type="text" placeholder="Please Enter Video Group Name">
                                <div class="invalid-feedback" id="video_title_error">Please Enter Video Group Name</div>
                        </div> --}}

                        <div class="mb-3">
                            <label for="courseTitle" class="form-label">Video Title</label>
                            <input id="courseTitle" class="form-control" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="video_title" id="video_title" type="text" placeholder="Video Title ">
                                <div class="invalid-feedback" id="video_title_error">Please Enter Video Title</div>
                        </div>
                        
                        <div class="custom-file-container mb-2">
                            <div class="label-container">
                                <label class="form-label">Upload Video</label>
                            </div>
                            <label class="input-container">
                                <input accept=".mp4" aria-label="Choose File" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="video_file" class="input-hidden video_file" id="file-upload-with-preview-courseImage" type="file">
                                <span class="input-visible">Choose file...<span class="browse-button">Browse</span></span>
                            </label>
                           
                        </div>

                        <div class="mb-3 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover" style="background-image:url({{asset('frontend/images/course/course-javascript.jpg')}}); height: 250px">
                            <a href="https://www.youtube.com/watch?v=Nfzi7034Kbg" class="icon-shape rounded-circle btn-play icon-xl glightbox position-absolute translate-middled">
                                <i class="bi bi-play-fill fs-3"></i>
                            </a>
                        </div>

                        <button class="btn btn-primary UploadVideo" type="Button">Add Video</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </form>
        </div>






@endsection
