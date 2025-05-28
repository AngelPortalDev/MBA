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
                            <h1 class="mb-1 color-blue fw-bold">
                                @if (isset($CourseData) && !empty($CourseData))
                                         Update 
                                @else
                                         Add New 
                                @endif
                           
                                
                                AWARD Course</h1>
                            <p class="mb-0 lead text-black">Just fill the form and create your course.</p>
                        </div>
                        <div>
                            <a href="all-award" class="btn btn-white bg-blue color-green">Back to Course</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

   
    </section>
    <!-- Container fluid -->
    <section class="p-4">
    <div class="container add-award-course">
                    <div id="courseForm" class="bs-stepper">
                        <div class="row">
                            <div class="offset-lg-1 col-lg-10 col-md-12 col-12">
                                <!-- Stepper Button -->
                                <div class="bs-stepper-header shadow-sm" role="tablist">
                                    <div class="step" data-target="#basic-information-1">
                                        <button type="button" class="step-trigger" role="tab" id="courseFormtrigger1" aria-controls="basic-information-1">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Basic Information</span>
                                        </button>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#others-2">
                                        <button type="button" class="step-trigger" role="tab" id="courseFormtrigger2" aria-controls="others-2">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Others</span>
                                        </button>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#course-media-3">
                                        <button type="button" class="step-trigger" role="tab" id="courseFormtrigger3" aria-controls="course-media-3">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Course Media</span>
                                        </button>
                                    </div>

                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#course-content-4">
                                        <button type="button" class="step-trigger" role="tab" id="courseFormtrigger4" aria-controls="course-content-4">
                                            <span class="bs-stepper-circle">4</span>
                                            <span class="bs-stepper-label">Course Content</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- Stepper content -->
                                <div class="bs-stepper-content mt-5">
                                    <form class="basicCourseForm" enctype="multipart/form-data">
                                         <input type="hidden" value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : ''}}" name="course_id" class="course_id">
                                        <!-- Basic Information -->
                                        <div id="basic-information-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger1">
                                            <!-- Card -->
                                            <div class="card mb-3">
                                                <div class="card-header border-bottom px-4 py-3">
                                                    <h4 class="mb-0">Basic Information</h4>
                                                </div>
                                                <!-- Card body -->
                                   
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-12">
                                                            <label for="courseTitle" class="form-label">Course Title</label>
                                                            <input id="courseTitle" class="form-control" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="title"  type="text" placeholder="Course Title ">
                                                            <small>Write maximum 70 character course title.</small>
                                                             <div class="invalid-feedback" id="title_error">Please Enter Course Title</div>
                                                        </div>
                                                        <div class="mb-3 col-md-12">
                                                            <label for="subheading" class="form-label">Course Subheading</label>
                                                            <textarea class="form-control" name="subheading"  id="subheading" rows="3">{{ isset($CourseData[0]['course_subheading']) ? $CourseData[0]['course_subheading'] : ''}}</textarea>
                                                            <small>Write maximum 400 character course Subheading.</small>
                                                             <div class="invalid-feedback" id="subheading_error">Please Enter Course Subheading</div>
                                                        </div>


                                                        <div class="mb-3 col-md-6">
                                                            <label for="mqf" class="form-label"> MQF/EQF Level</label>
                                                            <input id="mqf" class="form-control" value="{{ isset($CourseData[0]['mqfeqf_level']) ? $CourseData[0]['mqfeqf_level'] : ''}}" name="mqf"  type="text" placeholder="">
                                                             <div class="invalid-feedback" id="mqf_error">Please Enter MQF/EQF</div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="ects" class="form-label"> ECTS</label>
                                                            <input id="ects" class="form-control" value="{{ isset($CourseData[0]['ects']) ? $CourseData[0]['ects'] : ''}}" name="ects"  type="text" placeholder="">
                                                             <div class="invalid-feedback" id="ects_error">Please Enter ECTS</div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="total_module" class="form-label"> Total Modules</label>
                                                            <input id="total_module" class="form-control" value="{{ isset($CourseData[0]['total_modules']) ? $CourseData[0]['total_modules'] : ''}}" name="total_module"  type="text" placeholder="">
                                                             <div class="invalid-feedback" id="total_module_error">Please Enter Total Modules</div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="total_lecture" class="form-label"> Total Lectures</label>
                                                            <input id="total_lecture" class="form-control" value="{{ isset($CourseData[0]['total_lectures']) ? $CourseData[0]['total_lectures'] : ''}}" name="total_lecture"  type="text" placeholder="">
                                                             <div class="invalid-feedback" id="total_lecture_error">Please Enter Total Lectures</div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="courseTitle" class="form-label">  Total Learning Hours</label>
                                                            <input id="courseTitle" class="form-control" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="total_learning"  type="text" placeholder="">
                                                             <div class="invalid-feedback" id="total_learning_error">Please Enter Total Learning Hours</div>
                                                        </div>

                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Certificate</label>
                                                            <select class="form-select"  name="certifica_id" id="certifica_id">
                                                                <option value="{{ !empty($CourseData[0]['certificate_id']) ? $CourseData[0]['certificate_id'] : ''}}">{{ !empty($CourseData[0]['certificate_id']) ? $CourseData[0]['certificate_id'] : 'Select'}}</option>
                                                                <option value="React">Post Graduate Diploma in Human Resource Management</option>
                                                                <option value="Javascript">Award in Recruitment and Employee Selection</option>
                                                                <option value="HTML">Post Graduate Certificate in Human Resource Management</option>
                                                                <option value="Vue">Post Graduate Diploma in Human Resource Management</option>
                                                            </select>
                                                             <div class="invalid-feedback" id="certifica_id_error">Please Enter Certificate</div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Select E-mentor</label>
                                                            <select class="form-select" name="ementor_id" id="ementor_id">
                                                               {{-- <option value="{{ !empty($CourseData[0]['ementor_id']) ? $CourseData[0]['ementor_id'] : ''}}">{{ !empty($CourseData[0]['ementor_id']) ? $CourseData[0]['ementor_id'] : 'Select'}}</option> --}}
                                                               @foreach (getData('users',['id','name','last_name','role'], ['role'=>'instructor']) as $ementor)
                                                                <option value="{{ isset($ementor->id) ? base64_encode($ementor->id) : ''}}">{{$ementor->name." ".$ementor->last_name}}</option>
                                                                @endforeach
                                                            </select>
                                                             <div class="invalid-feedback" id="ementor_id_error">Select E-mentor</div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Select Lecturer</label>
                                                            <select class="form-select" name="lecturer_id" id="lecturer_id">
                                                                <option value="">Select</option>
                                                               @foreach(getDropDownlist('lactrures_master',['id','lactrure_name']) as $lactrures)
                                                                <option value="{{ isset($lactrures->id) ? base64_encode($lactrures->id) : ''}}">{{ $lactrures->lactrure_name ? $lactrures->lactrure_name : ''}}</option>
                                                                @endforeach
                                                            </select>
                                                             <div class="invalid-feedback" id="lecturer_id_error">Please Select Lecturer</div>
                                                            {{-- <a href="#" class="btn btn-outline-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#addLecturerModal">Add Lecturer +</a> --}}
                                                        </div>

                                                        <hr class="my-5">

                                                        <h4 class="mb-0">Fees Details</h4>
                                                        <p class="mb-4">Edit course fees details information.</p>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="final_price" class="form-label"> Course Final Price (€)</label>
                                                            <input id="final_price" class="form-control" value="{{ isset($CourseData[0]['course_final_price']) ? $CourseData[0]['course_final_price'] : ''}}" name="final_price"  type="text" placeholder="">
                                                             <div class="invalid-feedback" id="final_price_error">Please Enter Course Final Price</div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="scholarship_percent" class="form-label"> Scholarship (%)</label>
                                                            <input id="scholarship_percent" class="form-control" value="{{ isset($CourseData[0]['scholarship']) ? $CourseData[0]['scholarship'] : ''}}" name="scholarship_percent"  type="text" placeholder="">
                                                             <div class="invalid-feedback" id="scholarship_percent_error">Please Enter Scholarship</div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="Price" class="form-label"> Course Old Price (€)</label>
                                                            <input id="Price" class="form-control" type="text" placeholder="" disabled>
                                                        </div>
                                                         <hr class="my-5"> 
    
                                                        <h4 class="mb-5">Course Content</h4>
                                                    <div class="mb-4">
                                                        <label for="module_name" class="form-label">Module Name</label>
                                                        <input id="module_name" class="form-control" type="text" value="{{ isset($CourseData[0]['bn_module_name']) ? $CourseData[0]['bn_module_name'] : ''}}" name="module_name" placeholder="Module Name ">
                                                        <small>Write a 100 character Module Name.</small>
                                                         <div class="invalid-feedback" id="module_name_error">Please Enter Scholarship</div>
                                                    </div>
                                                    <!-- <hr class="my-5"> -->

                                                  
                                                        <div class="custom-file-container mb-5">
                                                            <div class="label-container">
                                                                <label class="form-label">Upload Course Thumbnail</label>
                                                            </div>
                                                            <label class="input-container mb-3">
                                                                <input accept="*" aria-label="Choose File" id="thumbnail" name="thumbnail_img" class="input-hidden imageprv" id="file-upload-with-preview-courseImage" type="file">
                                                                <span class="input-visible">Choose Thumbnail...<span class="browse-button">Browse</span></span>
                                                            </label>
                                                                  <div class="invalid-feedback" id="thumbnail_error">Please Upload Thumbnail</div>
                                                                <img class="image-preview d-none"  src="{{ isset($CourseData[0]['course_thumbnail_file']) && Storage::disk('local')->exists($CourseData[0]['course_thumbnail_file']) ? Storage::disk('local')->url($CourseData[0]['course_thumbnail_file']) : asset('frontend/images/course/masters-human-resource-management.png')}}">
                                                        </div>    
                                                        
                                                        
                                                        <!-- Course Preview Video -->
                                                        <div class="custom-file-container mb-2">
                                                            <div class="label-container">
                                                                <label class="form-label">Upload Course Trailor</label>
                                                            </div>
                                                            <label class="input-container">
                                                                <input  id="trailor" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="trailor_vid" aria-label="Choose File" class="input-hidden" id="file-upload-with-preview-courseImage" type="file">
                                                                <span class="input-visible">Choose file...<span class="browse-button">Browse</span></span>
                                                            </label>
                                                          <div class="invalid-feedback" id="trailor_error">Please Upload Course Trailor</div>
                                                        </div>
    
                                                            {{-- <a href="https://www.youtube.com/watch?v=Nfzi7034Kbg" class="icon-shape rounded-circle btn-play icon-xl glightbox position-absolute top-50 start-50 translate-middle"> --}}
                                                                 {{-- <img class="mb-6 align-items-center position-relative rounded py-16 border-white border rounded image-preview d-none"  src="{{asset('frontend/images/course/masters-human-resource-management.png')}}" style=" height: 250px">
                                                                <i class="bi bi-play-fill fs-3"></i> --}}
                                                            {{-- </a> --}}

                                                </div>
                                                </div>
                                            </div>
                                            <!-- Button -->
                                            <button class="btn btn-primary updateCourseBasic" >Save & Next</button>
                                            {{-- onclick="courseForm.next()" --}}
                                        </div>
                                    </form>


                                        <!-- others-2 -->
                                        <div id="others-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger2">
                                            <!-- Card -->
                                            <form class="basicCourseOtherForm" >
                                            <div class="card mb-3 border-0">
                                                <div class="card-header border-bottom px-4 py-3">
                                                    <h4 class="mb-0">Others</h4>
                                                </div>
                                                <!-- Card body -->
                                                <div class="card-body">

                                                    <div class="row">
                                                          <input type="hidden" value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : ''}}" name="course_id" class="course_id">
                                                        <div class="mb-3 col-md-12">
                                                            <label for="course_overview" class="form-label">Course Overview</label>
                                                            <textarea class="form-control" value="{{ isset($CourseData[0]['overview']) ? $CourseData[0]['overview'] : ''}}" name="course_overview"  id="course_overview" rows="7"> </textarea>
                                                            <small>Write maximum 400 character course overview.</small>
                                                            <div class="invalid-feedback" id="course_overview_error">Please Enter Course Overview</div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Programme Outcomes</label>
                                                               <textarea id="programme_outcomes" name="programme_outcomes" class="form-control w-100" style="height: 200px">
                                                                {{ isset($CourseData[0]['programme_outcomes']) ? htmlspecialchars_decode(htmlspecialchars_decode($CourseData[0]['programme_outcomes'])) : ''}} 
                                                            </textarea>
                                                            
                                                     
                                                             <div class="invalid-feedback" id="programme_outcomes_error">Please Enter Entry Requirements</div>
                                                        </div>
                                                        <div class="mb-3 col-md-12">
                                                            <label for="entry_requirements_error" class="form-label">Entry Requirements</label>
                                                            <textarea class="form-control" value="{{ isset($CourseData[0]['entry_requirements']) ? $CourseData[0]['entry_requirements'] : ''}}" name="entry_requirements"  id="entry_requirements" rows="7"> </textarea>
                                                                <div class="invalid-feedback" id="entry_requirements_error">Please Enter Entry Requirements</div>
                                                        </div>
                                                        <div class="mb-3 col-md-12">
                                                            <label for="assessment" class="form-label">Assessment</label>
                                                            <textarea class="form-control" value="{{ isset($CourseData[0]['assessment']) ? $CourseData[0]['assessment'] : ''}}" name="assessment"  id="assessment" rows="7"> </textarea>
                                                                <div class="invalid-feedback" id="assessment_error">Please Enter Course Assessment</div>
                                                        </div>
                                                </div>
                                                </div>
                                            </div>
                                            <!-- Button -->
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-secondary" onclick="courseForm.previous()">Previous</button>
                                                {{-- <button class="btn btn-primary" onclick="courseForm.next()">Next</button> --}}
                                                    <button class="btn btn-primary updateCourseOthers">Save & Next</button>
                                            </div>
                                            {{-- onclick="courseForm.next()" --}}
                                             </form>
                                        </div>
                                   


                                        <!-- Course Media -->
                                        <div id="course-media-3" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger3">
                                            <!-- Card -->
                                              <form class="CourseMediaForm" >
                                            <div class="card mb-3 border-0 px-3">
                                                <div class="card-header border-bottom py-3 mb-4 d-flex justify-content-between px-1 align-items-center">
                                                    <div>
                                                        <h4 class="mb-0">Add Multimedia Content</h4>
                                                        <p class="mb-1">Add Lectures, Interviews, and Podcasts to Each Section</p>
                                                    </div>

                                                <div><a href="#" class="btn btn-outline-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#add-section">Add Section +</a></div>

                                                </div>
                                                <input type="hidden" value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : ''}}" name="course_id" class="course_id">
                                                <!-- Card body -->
                                                {{-- <div class="card-body"> --}}
                                                    <!-- Add video Lectures  -->
                                                    {{-- <div class="bg-light rounded p-3 mb-2">
                                                        <div class="mb-3">
                                                            <label for="courseTitle" class="form-label">Video Title</label>
                                                            <input id="courseTitle" class="form-control" type="text" placeholder="Video Title ">
                                                        </div> --}}

                                                    <!-- Course Preview Video -->
                                                    {{-- <div class="custom-file-container mb-2">
                                                        <div class="label-container">
                                                            <label class="form-label">Upload Video Lecture</label>

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
                                                    </div> --}}


                                                    {{-- </div> --}}

                                                    {{-- <a href="#" class="btn btn-outline-primary btn-sm mt-3" >Add Video Lecture +</a> --}}

                                                {{-- </div> --}}
                                                
                                                <!-- First Section  -->
                                                <div class="card-body bg-light rounded py-2 px-3 mb-3">
                                                    <h4>Job Analysis</h4>
                                                    <div class="row " id="coursePreview">
                                                        <div class="col-md-2 d-flex">
                                                            <div class="card mb-2">
                                                                <div class="p-1">
                                                                    <div class="d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover course-thumn-video" style="background-image:url({{asset('admin/images/course/masters-human-resource-management.png') }});">
                                                                        <a class="glightbox icon-shape rounded-circle btn-play icon-lg" href="https://www.youtube.com/watch?v=Nfzi7034Kbg">
                                                                            <i class="fe fe-play"></i>
                                                                        </a>
                                                                    </div>
                                                                    <i class="bi bi-x-circle-fill"></i>
                                                                </div>
                                                                <!-- Card body -->
                                                                <div class="card-body p-1 ps-3">
                                                                    <!-- Price single page -->
                                                                    <div class="mb-3">
                                                                        <h5 class="text-dark fw-bold">1. Introduction to Talent Management</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2 d-flex">
                                                            <div class="card mb-2">
                                                                <div class="p-1">
                                                                    <div class="d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover course-thumn-video" style="background-image:url({{asset('admin/images/course/masters-human-resource-management.png') }});">
                                                                        <a class="glightbox icon-shape rounded-circle btn-play icon-lg" href="https://www.youtube.com/watch?v=Nfzi7034Kbg">
                                                                            <i class="fe fe-play"></i>
                                                                        </a>
                                                                    </div>
                                                                    <i class="bi bi-x-circle-fill"></i>
                                                                </div>
                                                                <!-- Card body -->
                                                                <div class="card-body p-1 ps-3">
                                                                    <!-- Price single page -->
                                                                    <div class="mb-3">
                                                                        <h5 class="text-dark fw-bold">2. Introduction to Module</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 d-flex">
                                                            <div class="card mb-2 w-100 d-flex justify-content-center align-items-center text-center p-3">
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
                                                

                                                
                                                <!-- Second Section  -->
                                                <div class="card-body bg-light rounded py-2 px-3 mb-3">
                                                    <h4>Talent Management and Sourcing Candidates</h4>
                                                    <div class="row " id="coursePreview">

                                                        <div class="col-md-2 d-flex">
                                                            <div class="card mb-2 w-100 d-flex justify-content-center align-items-center text-center p-3">
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
                                            <!-- Button -->
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-secondary" onclick="courseForm.previous()">Previous</button>
                                                 <button class="btn btn-primary d-none" id="courseMediaButton"> Next</button>
                                            </div>
                                              </form>
                                        </div>


                                         <!-- Course Content -->
                                         <div id="course-content-4" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger4">
                                             <form class="CourseContentForm" >
                                                 <input type="hidden" value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : ''}}" name="course_id" class="course_id">
                                            <!-- Card -->
                                            <div class="card mb-3 border-0">
                                                <div class="card-header border-bottom px-4 py-3">
                                                    <h4 class="mb-0">Course Content</h4>
                                                </div>
                                                <!-- Card body -->
                                                <div class="card-body">                                           
                                                    
                                                    <!-- Course Preview Video -->
                                                    <div class="custom-file-container mb-2">
                                                        <div class="label-container">
                                                            <label class="form-label">Upload Course Syllabus Podcast</label>

                                                        </div>
                                                        <label class="input-container">
                                                            <input accept="*" aria-label="Choose File" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="video_file" class="input-hidden" id="video_file" type="file">
                                                            <span class="input-visible">Choose file...<span class="browse-button">Browse</span></span>
                                                            <div class="invalid-feedback" id="course_podcast_error">Please Select Podcast Syllabus File</div>
                                                        </label>
                                                       
                                                    </div>

                                                    <div class="mb-6 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover" style="background-image:url({{asset('frontend/images/course/course-javascript.jpg')}}); height: 250px">
                                                        <a href="https://www.youtube.com/watch?v=Nfzi7034Kbg" class="icon-shape rounded-circle btn-play icon-xl glightbox position-absolute top-50 start-50 translate-middle">
                                                            <i class="bi bi-play-fill fs-3"></i>
                                                        </a>
                                                    </div>

                                                    <!-- <hr class="my-5"> -->

                                                    
                                                    <div class="mb-3 col-md-12">
                                                        <label for="about_module" class="form-label">About Module</label>
                                                        <textarea class="form-control" id="about_module" value="{{ isset($CourseData[0]['about_module']) ? $CourseData[0]['about_module'] : ''}}" name="about_module" rows="6"> </textarea>
                                                        <small>Write maximum 600 character Module.</small>
                                                        <div class="invalid-feedback" id="course_about_module_error">Please Enter Course Module</div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between mb-8">
                                                <!-- Button -->
                                                <button class="btn btn-secondary" onclick="courseForm.previous()">Previous</button>
                                               <button class="btn btn-primary updateCourseContent">Submit & Complete</button>
                                            </div>
                                            </form>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</main>

        <!-- Modal -->
        <div class="modal fade" id="addLecturerModal" tabindex="-1" role="dialog" aria-labelledby="addLecturerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addLecturerModalLabel">Add New Lecturer</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <select class="form-select mb-3">
                                <option value="">Select</option>
                                <option value="React">Claire-Suzanne Borg</option>
                                <option value="Javascript">Italo Esposito</option>
                                <option value="HTML">Matthew John Chetcuti</option>
                                <option value="Vue">Peter Medawar</option>
                            </select>

                        <button class="btn btn-primary" type="Button">Add New Lecturer</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Add Video Lecture Modal -->
        <div class="modal fade" id="addLectureVideoModal" tabindex="-1" role="dialog" aria-labelledby="addLectureVideoModalLabel" aria-hidden="true">
            <form class="CourseVideos">
                <input type="hidden" value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : ''}}" name="course_id" class="course_id">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addLectureVideoModalLabel">Add New Video</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="courseTitle" class="form-label">Video Group Name</label>
                            <input id="courseTitle" class="form-control" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="video_title" id="video_title" type="text" placeholder="Please Enter Video Group Name">
                                <div class="invalid-feedback" id="video_title_error">Please Enter Video Group Name</div>
                        </div>

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
                                <input accept=".mp4" aria-label="Choose File" value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : ''}}" name="video_file" class="input-hidden" id="file-upload-with-preview-courseImage" type="file">
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







        <!-- Add Section Modal -->
        <div class="modal fade" id="add-section" tabindex="-1" role="dialog" aria-labelledby="add-sectionLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="add-sectionLabel">Please select section from here</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select class="form-select mb-4" id="editCountry" required="">
                            <option value="">Select</option>
                            <option value="1">Coursework</option>
                            <option value="2">Personnel selection, design and validation process</option>
                            <option value="3">Methods and tools for employee selection and recruitment</option>
                            <option value="3">Job Analysis</option>
                            <option value="3">Talent Management and Sourcing Candidates</option>
                        </select>
                        <button class="btn btn-primary" type="Button">Add Section</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>









      <script>
CKEDITOR.replace('programme_outcomes');
</script>
@endsection
