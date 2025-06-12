<!-- Header import -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css" integrity="sha512-3//o69LmXw00/DZikLz19AetZYntf4thXiGYJP6L49nziMIhp6DVrwhkaQ9ppMSy8NWXfocBwI3E8ixzHcpRzw==" crossorigin="anonymous" referrerpolicy="no-referrer" />



@extends('admin.layouts.main')
@section('content')
<style>
    
input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance:textfield;
}

.clear-button {
    display: none; /* Initially hidden */
    font-size: 14px;
    right:10px;
    color:black;;
    top:1px;
    position: absolute;
}


.swal-button{
  background-color: #2b3990;
}
.swal-button-container{
  display: flex;
  justify-content: center;
}
.swal-button:hover{
  background-color: #2b3990 !important;
}
.swal-footer{
  display: flex;
  justify-content: center;
}
.swal-button--cancel{
  color: #000;
  background-color: #efefef;
}

.swal-button--cancel:hover{
  background-color: #efefef !important;
}
.swal-text{
  text-align: center;
}

.search-container {
    position: relative;
    width: 100%;
  }

  .search-container input {
    width: 100%;
    padding-left: 2.5rem !important; 
    box-sizing: border-box; 
  }

  .search-container .bi-search {
    position: absolute;
    left: 0.75rem; 
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d; 
    pointer-events: none; 
  }
  .bs-stepper-label{
    /* white-space: break-spaces; */
  }

    </style>
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
                            Create
                            @endif

                            Course
                        </h1>
                        <p class="mb-0 lead text-black">Just fill the form and create your course.</p>
                    </div>
                    <div>
                        <a href="{{route("admin.course.all-award")}}" class="btn btn-white bg-blue color-green">Back to Course</a>
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
                            <button type="button" class="step-trigger" role="tab" id="courseFormtrigger1"
                                aria-controls="basic-information-1">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Basic Information</span>
                            </button>
                        </div>
                        <div class="bs-stepper-line"></div>
                        <div class="step" data-target="#others-2">
                            <button type="button" class="step-trigger" role="tab" id="courseFormtrigger2"
                                aria-controls="others-2">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Others</span>
                            </button>
                        </div>
                        {{-- <div class="bs-stepper-line"></div>
                        <div class="step" data-target="#section-selection-3">
                            <button type="button" class="step-trigger" role="tab" id="courseFormtrigger3"
                                aria-controls="section-selection-3">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Section Selection </span>
                            </button>
                        </div> --}}

                        <div class="bs-stepper-line"></div>
                        <div class="step" data-target="#course-content-4">
                            <button type="button" class="step-trigger" role="tab" id="courseFormtrigger4"
                                aria-controls="course-content-4">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label" >Course Content </span>
                            </button>
                        </div>
                    </div>
                    <!-- Stepper content -->
                    <div class="bs-stepper-content mt-5">
                        <form class="basicCourseForm" enctype="multipart/form-data">
                            <input type="hidden"
                                value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : '' }}"
                                name="course_id" class="course_id">
                            <!-- Basic Information -->
                            <div id="basic-information-1" role="tabpanel" class="bs-stepper-pane fade"
                                aria-labelledby="courseFormtrigger1">
                                <!-- Card -->
                                <div class="card mb-3">
                                    <div class="card-header border-bottom px-4 py-3">
                                        <h4 class="mb-0">Basic Information </h4>
                                    </div>
                                    <!-- Card body -->

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <label for="courseTitle" class="form-label">Course Title <span class="text-danger">*</span></label>
                                                <input id="courseTitle" class="form-control"
                                                    value="{{ isset($CourseData[0]['course_title']) ? htmlspecialchars_decode($CourseData[0]['course_title']) : '' }}"
                                                    name="title" type="text" placeholder="Course Title ">
                                                <small>Course title must be between 5 to 150 characters.</small>
                                                <div class="invalid-feedback" id="title_error">Please enter course title
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="subheading" class="form-label">Course Subheading</label>
                                                <textarea class="form-control" name="subheading" id="subheading" placeholder="Course Subheading" 
                                                    rows="3">{{ isset($CourseData[0]['course_subheading']) ? htmlspecialchars_decode($CourseData[0]['course_subheading']) : '' }}</textarea>
                                                <small>Course subheading must be between 5 to 400 characters.</small>
                                                <div class="invalid-feedback" id="subheading_error">Please Enter Course
                                                    Subheading</div>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="course_specialization" class="form-label">Course Specialization</label>
                                                <input id="course_specialization" class="form-control"
                                                    value="{{ isset($CourseData[0]['course_specialization']) ? $CourseData[0]['course_specialization'] : '' }}"
                                                    name="course_specialization" type="text" placeholder="Course Specialization">
                                                <div class="invalid-feedback" id="course_specialization_error">Please Enter
                                                    Total Modules</div>
                                            </div>

                                            {{-- <div class="mb-3 col-md-12">
                                                <label class="form-label">Select DBA Module </label>
                                                <select class="form-select" name="award_dba" id="award_dba">
                                                    <option value="">Select</option>
                                                    <option value="award_dba_module" @if ($CourseData[0]['award_dba'] == 'award_dba_module')  selected @endif>Award DBA</option>
                                                </select> 
                                                <div class="invalid-feedback" id="award_dba_error">Select course category</div>
                                            </div> --}}
                                            <div class="mb-3 col-md-6">
                                                <label for="mqf" class="form-label"> MQF/EQF Level</label>
                                                <input id="mqf" class="form-control"
                                                    value="{{ isset($CourseData[0]['mqfeqf_level']) ? $CourseData[0]['mqfeqf_level'] : '' }}"
                                                    name="mqf" type="number" placeholder="MQF/EQF Level" onkeypress="return isNumberKey(event)"  oninput="validateNumberInput(this)">
                                                <div class="invalid-feedback" id="mqf_error">Please Enter MQF/EQF
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="ects" class="form-label"> ECTS</label>
                                                <input id="ects" class="form-control"
                                                    value="{{ isset($CourseData[0]['ects']) ? $CourseData[0]['ects'] : '' }}"
                                                    name="ects" type="number" placeholder="ECTS">
                                                <div class="invalid-feedback" id="ects_error">Please Enter ECTS</div>
                                            </div>
                                            {{-- <div class="mb-3 col-md-6">
                                                <label for="total_module" class="form-label"> Total Modules</label>
                                                <input id="total_module" class="form-control"
                                                    value="{{ isset($CourseData[0]['total_modules']) ? $CourseData[0]['total_modules'] : '' }}"
                                                    name="total_module" type="text" placeholder="">
                                                <div class="invalid-feedback" id="total_module_error">Please Enter
                                                    Total Modules</div>
                                            </div> --}}
                                            <div class="mb-3 col-md-6">
                                                <label for="course_duration" class="form-label">Part Time Course Duration (Month)</label>
                                                <input id="course_duration" class="form-control"
                                                    value="{{ isset($CourseData[0]['duration_month']) ? $CourseData[0]['duration_month'] : '' }}"
                                                    name="course_duration" type="number" placeholder="Part Time Course Duration">
                                                <div class="invalid-feedback" id="course_duration_error">Please Enter
                                                    Total Course Duration</div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="course_duration" class="form-label">Full Time Course Duration (Month)</label>
                                                <input id="course_duration" class="form-control"
                                                    value="{{ isset($CourseData[0]['full_time_duration_month']) ? $CourseData[0]['full_time_duration_month'] : '' }}"
                                                    name="full_time_course_duration" type="number" placeholder="Full Time Course Duration">
                                                <div class="invalid-feedback" id="course_duration_error">Please Enter
                                                    Total Course Duration</div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="total_lecture" class="form-label"> Total Lectures</label>
                                                <input id="total_lecture" class="form-control"
                                                    value="{{ isset($CourseData[0]['total_lectures']) ? $CourseData[0]['total_lectures'] : '' }}"
                                                    name="total_lecture" type="number" placeholder="Total Lectures">
                                                <div class="invalid-feedback" id="total_lecture_error">Please Enter
                                                    Total Lectures</div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="courseTitle" class="form-label"> Total Learning
                                                    Hours</label>
                                                <input id="courseTitle" class="form-control"
                                                    value="{{ isset($CourseData[0]['total_learning']) ? $CourseData[0]['total_learning'] : '' }}"
                                                    name="total_learning" type="number" placeholder="Total Learning">
                                                <div class="invalid-feedback" id="total_learning_error">Please Enter
                                                    Total Learning Hours</div>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Certificate</label>
                                                <select class="form-select" name="certifica_id" id="certifica_id">
                                                    <option value="">Select</option>
                                                    @foreach (getData('certificate',['id','certificate_name'],['deleted_at' => null],'','','') as $list)
                                                        @php $certificate_id = '';  @endphp
                                                        @if(!empty($CourseData))
                                                            @php $certificate_id = $CourseData[0]['certificate_id']; @endphp
                                                        @endif
                                                        <option value="{{ base64_encode($list->id)}}" @if($list->id == $certificate_id) selected @endif >{{$list->certificate_name}}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <select class="form-select" name="certifica_id" id="certifica_id">
                                                    <option
                                                        value="{{ isset($CourseData[0]['certificate_id']) ? $CourseData[0]['certificate_id'] : '' }}">
                                                        {{ isset($CourseData[0]['certificate_id']) ? $CourseData[0]['certificate_id'] : 'Select' }}
                                                    </option>
                                                    <option value="React">Post Graduate Diploma in Human Resource
                                                        Management</option>
                                                    <option value="Javascript">Award in Recruitment and Employee
                                                        Selection</option>
                                                    <option value="HTML">Post Graduate Certificate in Human Resource
                                                        Management</option>
                                                    <option value="Vue">Post Graduate Diploma in Human Resource
                                                        Management</option>
                                                </select> --}}
                                                <div class="invalid-feedback" id="certifica_id_error">Please Enter
                                                    Certificate</div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Select Lecturer</label>
                                                <select class="form-select" name="ementor_id" id="ementor_id">
                                                <option value="">Select</option>  

                                                @foreach (getData('users', ['id', 'name', 'last_name', 'role'],
                                                        ['role' => 'instructor','is_active'=>'Active','is_deleted'=>'No'],'','id','DESC') as $ementor)
                                                    @if (isset($CourseData[0]['ementor_id']) && !empty($CourseData[0]['ementor_id']))
                                                        <option value="{{ base64_encode($ementor->id) }}" @if($ementor->id == $CourseData[0]['ementor_id']) selected @endif>{{ $ementor->name . ' ' . $ementor->last_name }}</option>
                                                    @else
                                                        <option value="{{base64_encode($ementor->id)}}">{{ $ementor->name . ' ' . $ementor->last_name }}</option>
                                                    @endif
                                                @endforeach
                                                </select>
                                                <div class="invalid-feedback" id="ementor_id_error">Select Lecturer
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="course_cuttoff_perc" class="form-label">Course cut off percentage</label>
                                                <input id="course_cuttoff_perc" class="form-control"
                                                    value="{{ isset($CourseData[0]['course_cuttoff_perc']) ? $CourseData[0]['course_cuttoff_perc'] : '' }}"
                                                    name="course_cuttoff_perc" type="number" placeholder="Course cut off percentage">
                                                <div class="invalid-feedback" id="course_cuttoff_perc_error">Please enter cut off percentage.</div>
                                            </div>
                                            {{-- <div class="mb-3 col-md-12">
                                                <label class="form-label">Select Lecturer</label>
                                                @php
                                                    $lecture_id =isset($CourseData[0]['lecturer_id']) ? $CourseData[0]['lecturer_id'] :'';
                                                    $lecturerIds = explode(',',$lecture_id);
                                                    $lectureData= getData('lecturers_master', ['id','lactrure_name'],['is_deleted'=>'No','status'=>'0'],'','id','DESC');
                                                @endphp
                                                <select class="form-select" name="lecturer_id[]" id="lecturer_id" multiple>
                                                    <option value="" disabled>Select</option>
                                                    @foreach($lectureData as $lecturer)
                                                        <option value="{{ base64_encode($lecturer->id) }}" 
                                                            @if(in_array(base64_encode($lecturer->id), $lecturerIds))
                                                                selected
                                                            @endif>
                                                            {{ $lecturer->lactrure_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback" id="lecturer_id_error">Please Select
                                                    Lecturer</div> --}}
                                                {{-- <a href="#" class="btn btn-outline-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#addLecturerModal">Add Lecturer +</a> --}}
                                            {{-- </div> --}}
                                            <div class="mb-3 col-md-12">
                                                <label for="toggleDiscordLinks" class="form-label">Show Discord Links</label>
                                                <input type="checkbox" id="toggleDiscordLinks" onclick="toggleDiscordFields()" {{ isset($CourseData[0]['other_detail']) &&$CourseData[0]['other_detail']['discord_channel_link'] != null ? 'checked' : '' }}>
                                            </div>

                                            <div id="discordLinks">
                                                <div class="mb-3 col-md-12">
                                                    <label for="discord_joining_link" class="form-label">Discord Joining Link <span class="text-danger">*</span></label>
                                                    <input id="discord_joining_link" class="form-control"
                                                        value="{{ isset($CourseData[0]['other_detail']['discord_joining_link']) ? $CourseData[0]['other_detail']['discord_joining_link'] : '' }}"
                                                        name="discord_joining_link" type="text" placeholder="Discord Joining Link" required>
                                                    <div class="invalid-feedback" id="discord_joining_link_error">Please enter discord joining link.</div>
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label for="discord_channel_link" class="form-label">Discord Channel Link <span class="text-danger">*</span></label>
                                                    <input id="discord_channel_link" class="form-control"
                                                        value="{{ isset($CourseData[0]['other_detail']['discord_channel_link']) ? $CourseData[0]['other_detail']['discord_channel_link'] : '' }}"
                                                        name="discord_channel_link" type="text" placeholder="Discord Channel Link" required>
                                                    <div class="invalid-feedback" id="discord_channel_link_error">Please enter discord channel link.</div>
                                                </div>
                                            </div>

                                            <hr class="my-5">

                                            <h4 class="mb-0">Fees Details</h4>
                                            <p class="mb-4">Edit course fees details information.</p>
                                            <div class="mb-3 col-md-6">
                                                <label for="Price" class="form-label"> Course Final Price (€)</label>
                                                <input id="price" class="form-control" name="course_old_price"  value="{{ isset($CourseData[0]['course_final_price']) ? $CourseData[0]['course_final_price'] : '' }}" type="number" placeholder="Course Final Price">
                                                   <div class="invalid-feedback" id="course_old_price_error">Please
                                                    Enter Final Price</div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="final_price" class="form-label"> Course Old Price
                                                    (€)</label>
                                                <input id="final_price" class="form-control"
                                                    value="{{ isset($CourseData[0]['course_old_price']) ? $CourseData[0]['course_old_price'] : '' }}"
                                                    name="final_price" type="number" placeholder="Course Old Price" >
                                                <div class="invalid-feedback" id="final_price_error">Please Enter
                                                    Course Old Price</div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="scholarship_percent" class="form-label"> Scholarship
                                                    (%)</label>
                                                <input id="scholarship_percent" class="form-control"
                                                    value="{{ isset($CourseData[0]['scholarship']) ? $CourseData[0]['scholarship'] : '' }}"
                                                    name="scholarship_percent" type="number" placeholder="Scholarship" readonly>
                                                <div class="invalid-feedback" id="scholarship_percent_error">Please
                                                    Enter Scholarship</div>
                                            </div>
                                            <hr class="my-5">

                                            <h4 class="mb-5">Course Content</h4>
                                           {{--    <div class="mb-4">
                                                <label for="module_name" class="form-label">Module Name</label>
                                                <input id="module_name" class="form-control" type="text"
                                                    value="{{ isset($CourseData[0]['bn_module_name']) ? $CourseData[0]['bn_module_name'] : '' }}"
                                                    name="module_name" placeholder="Module Name ">
                                                <small>Write a 100 character Module Name.</small>
                                                <div class="invalid-feedback" id="module_name_error">Please Enter
                                                    Scholarship</div>
                                            </div> --}}
                                            <!-- <hr class="my-5"> -->

                                            <div class="custom-file-container mb-5">
                                                <div class="label-container">
                                                    <label class="form-label">Upload Course Thumbnail</label>
                                                </div>
                                                <label class="input-container mb-3">
                                                    <input accept=".jpeg,.png,.jpg,.svg" aria-label="Choose File" id="thumbnail"
                                                        name="thumbnail_img" class="input-hidden imageprv"
                                                        id="file-upload-with-preview-courseImage" type="file">
                                                    <span class="input-visible" id="thumbnail_file_name">{{ isset($CourseData[0]['thumbnail_file_name']) ? $CourseData[0]['thumbnail_file_name'] : 'Choose Thumbnail' }}<span
                                                            class="browse-button">Browse</span></span>
                                                </label>
                                                <div class="invalid-feedback" id="thumbnail_error">Please Upload
                                                    Thumbnail</div> 
                                                
                                                @if(isset($CourseData[0]['course_thumbnail_file']) && Storage::disk('local')->exists($CourseData[0]['course_thumbnail_file']))
                                                    <img class="image-preview img-fluid"src="{{ isset($CourseData[0]['course_thumbnail_file']) && Storage::disk('local')->exists($CourseData[0]['course_thumbnail_file']) ? Storage::url($CourseData[0]['course_thumbnail_file']) : '' }}">
                                                @else
                                                    <img class="image-preview img-fluid" src="" style="display:none;">
                                                @endif
                                            </div>

                                            <!-- Course Preview Video -->
                                            <div class="custom-file-container mb-2">
                                                <div class="label-container">
                                                    <label class="form-label">Upload Course Trailer</label>
                                                </div>
                                                <label class="input-container">
                                                    <input id="trailor" accept=".mp4"
                                                        value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : '' }}"
                                                        name="trailor_vid" aria-label="Choose File" class="input-hidden course_trailer"
                                                        id="file-upload-with-preview-courseImage" type="file">
                                                    <span class="input-visible" id="trailer_file_name">{{ isset($CourseData[0]['course_trailer_file_name']) ? $CourseData[0]['course_trailer_file_name'] : 'Choose file...' }}<span
                                                            class="browse-button">Browse</span></span>
                                                </label>
                                                {{-- <div class="invalid-feedback" id="trailor_error">Please Upload Course
                                                    Trailor</div> --}}
                                            </div>
                                           
                                            @if (isset($CourseData[0]['bn_course_trailer_url']) && !empty($CourseData[0]['bn_course_trailer_url']))
                                            @php
                                            $videUrl=  $CourseData[0]['bn_course_trailer_url'];
                                            @endphp
                                            <div class="previouseVideo mb-4" style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/{{env('AWARD_LIBRARY_ID')}}/{{$videUrl}}?autoplay=false&loop=false&muted=true&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>
                                            @endif
                                            <video controlslist="nodownload" controls="" oncontextmenu="return false;" class="mb-6 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover video-preview-trailor d-none" height="400px;" width="800px;" src=""></video>

                        
                                            <div class="custom-file-container mb-2">
                                                <div class="label-container">
                                                    <label class="form-label">Trailer Thumbnail</label>
                                                </div>
                                                <label class="input-container">
                                                    <input id="trailor_thumbnail" accept=".jpeg,.png,.jpg,.svg"
                                                        value=""
                                                        name="trailor_thumbnail" aria-label="Choose File" class="input-hidden trailor_thumbnail"
                                                        id="" type="file">
                                                    <span class="input-visible" id="trailor_thumbnail_file_name">{{ isset($CourseData[0]['trailer_thumbnail_file_name']) ? $CourseData[0]['trailer_thumbnail_file_name'] : 'Choose file...' }}<span
                                                            class="browse-button">Browse</span></span>
                                                </label>
                                                @php $URL = ""; @endphp
                                                @if (isset($CourseData[0]['trailer_thumbnail_file']) && !empty($CourseData[0]['trailer_thumbnail_file']))
                                                @php $URL = Storage::url($CourseData[0]['trailer_thumbnail_file']);@endphp
                                                @endif
                                                <img class="image-preview-trailer img-fluid" src="{{ isset($CourseData[0]['trailer_thumbnail_file']) ? $URL : '' }}">
                                            
                                                {{-- <div class="invalid-feedback" id="trailor_error">Please Upload Course
                                                    Trailor</div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Button -->
                                {{-- <button class="btn btn-primary updateCourseBasic">Save & Next</button> --}}
                                <div class="d-flex" style="float:right;">
                                    {{-- <button class="btn btn-secondary" onclick="courseForm.previous()">Previous</button> --}}
                                    <button type="button" class="btn btn-primary updateCourseBasic">
                                        Save & Next</button>
                                </div>
                                {{-- onclick="courseForm.next()" --}}
                            </div>
                        </form>

                        <!-- others-2 -->
                        <div id="others-2" role="tabpanel" class="bs-stepper-pane fade"
                            aria-labelledby="courseFormtrigger2">
                            <!-- Card -->
                            <form class="basicCourseOtherForm">
                                <div class="card mb-3 border-0">
                                    <div class="card-header border-bottom px-4 py-3">
                                        <h4 class="mb-0">Others</h4>
                                    </div>
                                    <!-- Card body -->
                                    <div class="card-body">

                                        <div class="row">
                                            <input type="hidden"
                                                value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : '' }}"
                                                name="course_id" class="course_id">
                                            <div class="mb-3 col-md-12">
                                                <label for="course_overview" class="form-label">Course
                                                    Overview</label>
                                                {{-- <textarea class="form-control" name="course_overview"
                                                    id="course_overview"
                                                    rows="7">{{ isset($CourseData[0]['overview']) ? $CourseData[0]['overview'] : '' }}
                                                </textarea> --}}
                                                <div id="course_overview" name="course_overview" placeholder="Course Overview"
                                                    class="form-control w-100 course_overview" style="height: 200px" value="{{ !empty($CourseData[0]['overview']) ? ($CourseData[0]['overview']) : '' }}">
                                                    <?php echo !empty($CourseData[0]['overview']) ? htmlspecialchars_decode($CourseData[0]['overview']) : '' ?>
                                                </div>
                                                <small>Enter course overview up to 2100 characters.</small>
                                                <div class="invalid-feedback" id="course_overview_error">Enter course overview up to 2100 characters.</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Programme Outcomes</label>
                                                <div id="programme_outcomes" name="programme_outcomes" placeholder="Programme Outcomes"
                                                    class="form-control w-100" style="height: 200px">
                                                    <?php echo !empty($CourseData[0]['programme_outcomes']) ? htmlspecialchars_decode($CourseData[0]['programme_outcomes']) : '' ?>
                                                </div>
                                                <small>Enter programme outcomes up to 1800 characters.</small>
                                                <div class="invalid-feedback" id="programme_outcomes_error">Please
                                                    Enter programme outcomes up to 1800 characters.</div>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="entry_requirements_error" class="form-label">Entry
                                                    Requirements</label>
                                                {{-- <textarea class="form-control" name="entry_requirements"
                                                    id="entry_requirements"
                                                    rows="7">{{ !empty($CourseData[0]['entry_requirements']) ? $CourseData[0]['entry_requirements'] : '' }}
                                                </textarea> --}}
                                                <div id="entry_requirements" name="entry_requirements" placeholder="Entry Requirements"
                                                    class="form-control w-100" style="height: 200px">
                                                    <?php echo  !empty($CourseData[0]['entry_requirements']) ? htmlspecialchars_decode($CourseData[0]['entry_requirements']) : '' ?>
                                                </div>
                                                <small> Enter entry requirement up to 1800 characters.</small>

                                                <div class="invalid-feedback" id="entry_requirements_error">Please
                                                    Enter Entry Requirement up to 1800 characters.</div>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="assessment" class="form-label">Assessment</label>
                                                {{-- <textarea class="form-control" name="assessment" id="assessment"
                                                    rows="7">{{ !empty($CourseData[0]['assessment']) ? $CourseData[0]['assessment'] : '' }}
                                                </textarea> --}}
                                                <div id="assessment" name="assessment"  placeholder="Assessment"
                                                class="form-control w-100" style="height: 200px">
                                                <?php echo !empty($CourseData[0]['assessment']) ? htmlspecialchars_decode($CourseData[0]['assessment']) : '' ?>
                                                </div>
                                                <small>Enter assessment up to 500 characters.</small>

                                                <div class="invalid-feedback" id="assessment_error">Enter assessment up to 500 characters.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-secondary previousCourseBasic" >Previous</button>
                                    {{-- <button class="btn btn-primary" onclick="courseForm.next()">Next</button> --}}
                                    <button class="btn btn-primary updateCourseOthers">Save & Next</button>
                                </div>
                                {{-- onclick="courseForm.next()" --}}
                            </form>
                        </div>

                        <!-- Course Media -->
                      

                        <!-- Course Content -->
                        <div id="course-content-4" role="tabpanel" class="bs-stepper-pane fade"
                            aria-labelledby="courseFormtrigger4">
                            <form class="CourseContentForm">
                                <input type="hidden"
                                    value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : '' }}"
                                    name="course_id" class="course_id">
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
                                                <input accept=".mp4" aria-label="Choose File"
                                                    value="{{ isset($CourseData[0]['other_video'][0]['video_file_name']) ? $CourseData[0]['other_video'][0]['video_file_name'] : '' }}"
                                                    name="video_file" class="input-hidden course_podcast"  type="file">
                                                <span class="input-visible" id="podcast_file_name">
                                                    
                                                    {{isset($CourseData[0]['other_video'][0]['bn_video_url_id'])  && !empty($CourseData[0]['other_video'][0]['bn_video_url_id']) ? $CourseData[0]['other_video'][0]['video_file_name']: 'Choose file...'}}
                                                    
                                                    <span
                                                        class="browse-button">Browse</span></span>
                                                <div class="invalid-feedback" id="course_podcast_error">Please Select
                                                    Podcast Syllabus File</div>
                                            </label>

                                        </div>

                                   
                                        @if (isset($CourseData[0]['other_video'][0]['bn_video_url_id']) && !empty($CourseData[0]['other_video'][0]['bn_video_url_id']))
                                        @php
                                        $videUrl=  $CourseData[0]['other_video'][0]['bn_video_url_id'];
                                        @endphp
                                        <div class="previouseVideoPodcast mb-4" style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/{{env('AWARD_LIBRARY_ID')}}/{{$videUrl}}?autoplay=false&loop=false&muted=true&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>
                                                @endif
                                        <video controlslist="nodownload" controls="" oncontextmenu="return false;" class="mb-6 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover video-preview-podcast d-none" height="400px;" width="800px;" src=""></video>
                                    
                                            {{-- <a href=""
                                                class="videoUrlLink icon-shape rounded-circle btn-play icon-xl glightbox position-absolute top-50 start-50 translate-middle">
                                                <i class="bi bi-play-fill fs-3"></i>
                                            </a> --}}
                                {{-- <a class="glightbox icon-shape rounded-circle btn-play icon-xl"
                                    href="https://iframe.mediadelivery.net/play/236384/{{$videUrl}}">
                                    <i class="fe fe-play"></i>
                                </a> --}}

                                        <!-- <hr class="my-5"> -->
                                        {{-- <div class="mb-3 col-md-12">
                                            <label for="about_module" class="form-label">About Module</label>
                                            <textarea class="form-control" id="about_module" name="about_module" rows="6">{{ isset($CourseData[0]['about_module']) ? $CourseData[0]['about_module'] : '' }} </textarea>
                                            <small>Write maximum 600 character Module.</small>
                                            <div class="invalid-feedback" id="course_about_module_error">Please Enter
                                                Course Module</div>
                                        </div> --}}

                                        <div class="custom-file-container mb-2">
                                            <div class="label-container">
                                                <label class="form-label">Podcast Thumbnail</label>
                                            </div>
                                            <label class="input-container">
                                                <input id="podcast_thumbnail" accept=".jpeg,.png,.jpg,.svg"
                                                    value=""
                                                    name="podcast_thumbnail" aria-label="Choose File" class="input-hidden podcast_thumbnail"
                                                    id="" type="file">
                                                <span class="input-visible" id="podcast_thumbnail_file_name">{{ isset($CourseData[0]['podcast_thumbnail_file_name']) ? $CourseData[0]['podcast_thumbnail_file_name'] : 'Choose file...' }}<span
                                                        class="browse-button">Browse</span></span>
                                            </label>
                                            @if (isset($CourseData[0]['podcast_thumbnail_file']) && !empty($CourseData[0]['podcast_thumbnail_file']))
                                            @php $URL = Storage::url($CourseData[0]['podcast_thumbnail_file']) @endphp
                                            @endif
                                            <img class="image-preview-podcast img-fluid"
                                            src="{{ isset($CourseData[0]['podcast_thumbnail_file']) ? $URL : '' }}">
                                            {{-- <div class="invalid-feedback" id="trailor_error">Please Upload Course
                                                Trailor</div> --}}
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-8">
                                    <!-- Button -->
                                    <button class="btn btn-secondary sectionSelection">Previous</button>
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
<div class="modal fade" id="addLecturerModal" tabindex="-1" role="dialog" aria-labelledby="addLecturerModalLabel"
    aria-hidden="true">
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
<div class="modal fade" id="addLectureVideoModal" tabindex="-1" role="dialog"
    aria-labelledby="addLectureVideoModalLabel" aria-hidden="true">
    <form class="CourseVideos">
        <input type="hidden" value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : '' }}"
            name="course_id" class="course_id">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addLectureVideoModalLabel">Add New Video</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="courseTitle" class="form-label">Video Group Name</label>
                        <input id="courseTitle" class="form-control"
                            value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : '' }}"
                            name="video_title" id="video_title" type="text" placeholder="Please Enter Video Group Name">
                        <div class="invalid-feedback" id="video_title_error">Please Enter Video Group Name</div>
                    </div>

                    <div class="mb-3">
                        <label for="courseTitle" class="form-label">Video Title</label>
                        <input id="courseTitle" class="form-control"
                            value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : '' }}"
                            name="video_title" id="video_title" type="text" placeholder="Video Title ">
                        <div class="invalid-feedback" id="video_title_error">Please Enter Video Title</div>
                    </div>

                    <div class="custom-file-container mb-2">
                        <div class="label-container">
                            <label class="form-label">Upload Video</label>

                        </div>
                        <label class="input-container">
                            <input accept=".mp4" aria-label="Choose File"
                                value="{{ isset($CourseData[0]['course_title']) ? $CourseData[0]['course_title'] : '' }}"
                                name="video_file" class="input-hidden" id="file-upload-with-preview-courseImage"
                                type="file">
                            <span class="input-visible">Choose file...<span class="browse-button">Browse</span></span>
                        </label>

                    </div>

                    <div class="mb-3 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover"
                        style="background-image:url({{ asset('frontend/images/course/course-javascript.jpg') }}); height: 250px">
                        <a href="https://www.youtube.com/watch?v=Nfzi7034Kbg"
                            class="icon-shape rounded-circle btn-play icon-xl glightbox position-absolute translate-middled">
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
<div class="modal fade" id="add-section" tabindex="-1" role="dialog" aria-labelledby="add-sectionLabel"
    aria-hidden="true">
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
                    <option value="3">Section Analysis</option>
                    <option value="3">Talent Management and Sourcing Candidates</option>
                </select>
                <button class="btn btn-primary" type="Button">Add Section</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Delete   --}}
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                Are you really want to delete Content?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script>

    $('#search').on('keyup', function() {
        if ($(this).val().length > 0) {
            $('.clear-button').css('display','block');
        } else {
            $('.clear-button').hide();
        }
    });

    // Function to clear search input and hide clear button
    $('.clear-button').on('click', function() {
        $('#search').val('');
        $(".search_list").removeClass('d-block').addClass('d-none');
        $(this).hide();
        $('#search').focus();
    });

    $("#final_price,#price").on("keyup", function (event) {
    event.preventDefault();
     $("#course_old_price_error").hide();
    // var scholership_percent = $(this).val() > 0 ? $(this).val() : 0;
    var price =
        $("#price").val() > 0
            ?  $("#price").val()
            : 0;
    // alert(price);
    var old_price =
        $("#final_price").val() > 0
            ?  $("#final_price").val()
            : 0;
    // alert(old_price);
    // var scholership_percent = $("#scholarship_percent").val();
    if (price >  0) {
        // var final_price = (scholership_percent/100)*price;
        var scholarship_percent = ((old_price - price)/old_price)*100;
        $("#scholarship_percent").attr('value',scholarship_percent);
    } else {
        $("#scholarship_percent").attr('value',0);
        // $("#course_old_price_error").show();
    }
});
    // CKEDITOR.replace('programme_outcomes');


    // Select

    $(document).ready(function() {
    $('#lecturer_id').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: 'Select',
        closeOnSelect: true
    });
    toggleDiscordFields()

    $('#lecturer_id').on('change', function() {
        // Get all selected options
        var selectedOptions = $('#lecturer_id option:selected');
        var selectedValues = selectedOptions.map(function() {
            return this.value;
        }).get();

        // Reorder options
        $('#lecturer_id option').each(function() {
            if (selectedValues.indexOf(this.value) !== -1) {
                $(this).appendTo('#lecturer_id');
            }
        });
    });
});
function toggleDiscordFields() {
    const discordLinksDiv = document.getElementById('discordLinks');
    const toggleCheckbox = document.getElementById('toggleDiscordLinks');

    if (toggleCheckbox.checked) {
        discordLinksDiv.style.display = 'block';
    } else {
        discordLinksDiv.style.display = 'none';
    }
}
window.onload = function() {
    console.log(window.location.hash);
    if (window.location.hash === "#section-selection-3") {
        $("#section-selection-3")
            .removeClass("dstepper-none")
            .addClass("active");
        $('.step[data-target="#section-selection-3"]').addClass("active");

        $("#basic-information-1")
             .removeClass("active")
             .addClass("dstepper-none");
        $('.step[data-target="#basic-information-1"]').removeClass("active");

    }
};
</script>
@endsection