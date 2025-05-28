<!-- Header import -->
@extends('admin.layouts.main')
 @section('content')
<style>
    
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
    .clear-button {
        display: none; /* Initially hidden */
        font-size: 14px;
        right:10px;
        color:black;;
        top:1px;
        position: absolute;
    }


    .tab-wrapper {
        border: 1px solid #ccc;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .nav-tabs .nav-link {
        margin-right: 5px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link.active {
        background-color: #007bff;
        color: #fff;
    }

    .tab-content {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 8px;
        margin-top: 10px;
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
                            New Course
                            </h1>
                            <p class="mb-0 lead text-black">Just fill the form and create your course.</p>
                        </div>
                        <div>
                            <a href="{{ route('admin.course.all-course') }}" class="btn btn-white bg-blue color-green">Back to Course</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Container fluid -->
    <section class="p-4">
    <div class="container">
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
                        <form class="basicCourseFormAdd">
                            
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
                                            <input type='hidden' class="course_id" name='course_id' value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : ''}}">

                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Select Course Category <span class="text-danger">*</span> </label>
                                                <?php $CategoryData = getData('categories',['id','category_name'],[]);?>
                                                <select class="form-select" name="category_id" id="category_id">
                                                    <option value="">Select</option>
                                                    @foreach ($CategoryData as $list)
                                                        @if($list->id != '1')
                                                        @php $catgeoryId = '';  @endphp
                                                        @if(!empty($CourseData))
                                                           @php $catgeoryId = $CourseData[0]['category_id']; @endphp
                                                        @endif
                                                        <option value="{{$list->id}}" @if($list->id == $catgeoryId) selected @endif >{{$list->category_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select> 
                                                <div class="invalid-feedback" id="category_id_error">Select course category</div>
                                            </div>

                                            <div class="mb-3 col-md-12">
                                                <label for="courseTitle" class="form-label">Course Title <span class="text-danger">*</span> </label>
                                                <input id="course_title" class="form-control" name="title"  value="{{ isset($CourseData[0]['course_title']) ? htmlspecialchars_decode($CourseData[0]['course_title']) : ''}}" type="text" placeholder="Course Title ">
                                                <small>Title must be between 5 to 225 characters.</small>
                                                <div class="invalid-feedback" id="title_error">Please enter course title</div>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="subheading" class="form-label">Course Subheading  </label>
                                                <textarea class="form-control" name="subheading"  id="subheading" rows="3" placeholder="Course Subheading">{{ isset($CourseData[0]['course_subheading']) ? htmlspecialchars_decode($CourseData[0]['course_subheading']) : ''}}</textarea>
                                                <small>Write maximum 400 character course Subheading.</small>
                                                    <div class="invalid-feedback" id="subheading_error">Subheading should not be greater than 400 characters.</div>
                                            </div>


                                            <div class="mb-3 col-md-6">
                                                <label for="mqf" class="form-label"> MQF/EQF Level  </label>
                                                <input id="mqf" class="form-control" name="mqf" value="{{ isset($CourseData[0]['mqfeqf_level']) ? $CourseData[0]['mqfeqf_level'] : ''}}" type="number" placeholder="MQF/EQF Level">
                                                    <div class="invalid-feedback" id="mqf_error">Please Enter MQF/EQF</div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="ects" class="form-label"> ECTS</label>
                                                <input id="ects" class="form-control"
                                                    value="{{ isset($CourseData[0]['ects']) ? $CourseData[0]['ects'] : '' }}"
                                                    name="ects" type="number" placeholder="ECTS">
                                                <div class="invalid-feedback" id="ects_error">Please Enter ECTS</div>
                                            </div>

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
                                                <label class="form-label">Certificate </label>
                                               
                                                <select class="form-select" name="certificate_id" id="certificate_id">
                                                    <option value="">Select</option>
                                                    @foreach (getData('certificate',['id','certificate_name'],['deleted_at' => null],'','','') as $list)
                                                        @php $certificate_id = '';  @endphp
                                                        @if(!empty($CourseData))
                                                           @php $certificate_id = $CourseData[0]['certificate_id']; @endphp
                                                        @endif
                                                        <option value="{{base64_encode($list->id)}}" @if($list->id == $certificate_id) selected @endif >{{$list->certificate_name}}</option>
                                                    @endforeach
                                                </select>
                                                    <div class="invalid-feedback" id="certifica_id_error">Please Enter Certificate</div>
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
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Select Lecturer</label>
                                                @php
                                                     $lecture_id =isset($CourseData[0]['lecturer_id']) ? $CourseData[0]['lecturer_id'] :'';
                                                    $lecturerIds = explode(',',$lecture_id);
                                                      $lectureData= getData('lecturers_master', ['id','lactrure_name'],['is_deleted'=>'No']);
                                                @endphp
                                                <select class="form-select" name="lecturer_id[]" id="lecturer_id" multiple>
                                                    <option value="" disabled>Select</option>
                                                  
                                                    @foreach ($lecturerIds as $ids)
                                                       @php 
                                                       $lecId= base64_decode($ids);
                                                       $lectureid= getData('lecturers_master', ['id','lactrure_name'], ['id'=>$lecId,'is_deleted'=>'No']);
                                                    @endphp
                                                      @if (isset($lectureid[0]->lactrure_name) && !empty($lectureid[0]->id) && isset($lectureid[0]->id))
                                                    <option
                                                        value="{{ isset($lectureid[0]->id) ? base64_encode($lectureid[0]->id) : '' }}" selected>
                                                        {{ $lectureid[0]->lactrure_name ? $lectureid[0]->lactrure_name : '' }}
                                                    </option>
                                                       @endif
                                                    @endforeach
                                                    @foreach ($lectureData as $lecturer)
                                                     {{-- @foreach ($lecturerIds as $ids) --}}
                                                    {{-- @php 
                                                    $lecId= base64_decode($ids);
                                                    @endphp --}}
                                                    {{-- @if (isset($lecId) && $lecId != $lecturer->id) --}}
                                                    <option
                                                         value="{{ isset($lecturer->id) ? base64_encode($lecturer->id) : '' }}"> 
                                                        {{ $lecturer->lactrure_name }}</option>
                                                        {{-- @endif --}}
                                                    {{-- @endforeach  --}}
                                                    @endforeach 
                                                </select>
                                                <div class="invalid-feedback" id="lecturer_id_error">Please Select
                                                    Lecturer</div>
                                                {{-- <a href="#" class="btn btn-outline-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#addLecturerModal">Add Lecturer +</a> --}}
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="progressTab" class="form-label">Show Progress Tab</label> 
                                                <input type="checkbox" id="progressTab" name="progress_tab" {{ isset($CourseData[0]['progress_tab']) && $CourseData[0]['progress_tab'] == 0 ? 'checked' : '' }}>
                                            </div>
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
                                                    name="final_price" type="text" placeholder="Course Old Price" >
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

                                    </div>
                                    </div>
                                </div>
                                <!-- Button -->
                                <button class="btn btn-primary updateCourseBasicAdd" style="float:right;">Save & Next</button>
                                {{-- onclick="courseForm.next()" --}}
                            </div>
                        </form>

                        <form class="basicCourseOtherForm">
                            <!-- others-2 -->
                            <div id="others-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger2">
                                <!-- Card -->
                                <div class="card mb-3 border-0">
                                    <div class="card-header border-bottom px-4 py-3">
                                        <h4 class="mb-0">Others</h4>
                                    </div>
                                    <!-- Card body -->
                                    <div class="card-body">

                                        <div class="row">
                                            <input type='hidden' class="course_id" name='course_id' value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : ''}}">
                                            <div class="mb-3 col-md-12">
                                                <label for="course_overview" class="form-label">Course Overview</label>
                                                <div id="course_overview" name="course_overview"
                                                class="form-control w-100 course_overview" style="height: 200px" value="{{ !empty($CourseData[0]['overview']) ? ($CourseData[0]['overview']) : '' }}">
                                                <?php echo !empty($CourseData[0]['overview']) ? htmlspecialchars_decode($CourseData[0]['overview']) : '' ?>
                                                </div>
                                                <small>Enter course overview up to 1500 characters.</small>
                                                <div class="invalid-feedback" id="course_overview_error">Enter course overview up to 1500 characters</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="programme_outcomes">Programme Outcomes</label>
                                                {{-- <div id="editor" style="height: 200px"  name="programme_outcomes" placeholder="Programme Outcomes">{{ isset($CourseData[0]['programme_outcomes']) ? htmlspecialchars_decode(htmlspecialchars_decode($CourseData[0]['programme_outcomes'])) : ''}}</div> --}}
                                                <div id="programme_outcomes" name="programme_outcomes"
                                                class="form-control w-100" style="height: 200px">
                                                <?php echo !empty($CourseData[0]['programme_outcomes']) ? htmlspecialchars_decode($CourseData[0]['programme_outcomes']) : '' ?>
                                                </div>
                                                <small>Enter programme outcomes up to 1500 characters.</small>
                                                <div class="invalid-feedback" id="programme_outcomes_error">Enter programme outcomes up to 1500 characters.</div>

                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="entry_requirements" class="form-label">Entry Requirements</label>
                                                <div id="entry_requirements" name="entry_requirements"
                                                    class="form-control w-100" style="height: 200px">
                                                    <?php echo  !empty($CourseData[0]['entry_requirements']) ? htmlspecialchars_decode($CourseData[0]['entry_requirements']) : '' ?>
                                                </div>
                                                <small>Enter entry requirements up to 1500 characters.</small>

                                                <div class="invalid-feedback" id="entry_requirements_error">nter entry requirements up to 1500 characters.</div>

                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="courseTitle" class="form-label">Assessment </label>
                                                <div id="assessment" name="assessment"
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
                                    <button class="btn btn-secondary previousCourseBasic">Previous</button>
                                    <button class="btn btn-primary updateCourseOthers">Next</button>
                                </div>
                            </div>
                        </form>

                        <form class="CourseMediaForm">
                            <!-- Course Media -->
                            <div id="course-media-3" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger3">
                                <!-- Card -->
                                <div class="card mb-3 border-0">
                                    <div class="card-header border-bottom px-4 py-3">
                                        <h4 class="mb-0">Course Media</h4>
                                    </div>
                                    <!-- Card body -->
                                    <div class="card-body">

                                        <input type='hidden'  name='course_id' class='course_id' value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : ''}}">
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
                                                <input accept=".mp4"
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
                                        <div class="previouseVideo mb-4" style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/{{env('MASTER_LIBRARY_ID')}}/{{$videUrl}}?autoplay=false&loop=false&muted=true&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>
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
                                        <div class="previouseVideoPodcast mb-4" style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/{{env('MASTER_LIBRARY_ID')}}/{{$videUrl}}?autoplay=false&loop=false&muted=true&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>
                                        @endif
                                        <video controlslist="nodownload" controls="" oncontextmenu="return false;" class="mb-6 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover video-preview-podcast d-none" height="400px;" width="800px;" src=""></video>

                                        <div class="custom-file-container mb-2">
                                            <div class="label-container">
                                                <label class="form-label">Podcast Thumbnail</label>
                                            </div>
                                            <label class="input-container">
                                                <input id="podcast_thumbnail"
                                                    value="" accept=".jpeg,.png,.jpg,.svg"
                                                    name="podcast_thumbnail" aria-label="Choose File" class="input-hidden podcast_thumbnail"
                                                    id="" type="file">
                                                <span class="input-visible" id="podcast_thumbnail_file_name">{{ isset($CourseData[0]['podcast_thumbnail_file_name']) ? $CourseData[0]['podcast_thumbnail_file_name'] : 'Choose file...' }}<span
                                                        class="browse-button">Browse</span></span>
                                            </label>
                                            @php $URL = ""; @endphp
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
                                <!-- Button -->
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-secondary previousCourseOther">Previous</button>
                                    <button class="btn btn-primary updateCourseMediaAdd">Next</button>
                                </div>
                            </div>
                        </form>
                        
                            <!-- Course Content -->
                        <div id="course-content-4" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger4">
                            <!-- Card -->
                            <div class="card mb-4">
                                <div class="card-header">
                                <h3 class="mb-0">Selects Modules</h3>
                            </div>
                                <!-- Card Body -->
                            <div class="card-body">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-lg-8 col-12">
                                        <div><div class="mt-2">
                                            <div class="bg-white rounded-md-pill shadow rounded-3 mb-2  search-add-award-course">
                                                <!-- card body -->
                                                <div class="p-md-2 p-4 border-1 border-light-subtle">
                                                    <div class="row g-1">
                                                        <div class="col-12 col-md-12">
                                                            <div class="input-group mb-2 mb-md-0 border-md-0 border rounded-pill">
                                                                <div class="search-container">
                                                                    <input type="text" id="searchMainCourse" class="form-control rounded-pill border-0 ps-3 form-focus-none w-100" placeholder="Search and select section from here" aria-describedby="searchSection" aria-label="Section" style="padding-right: 1.5rem;"/>
                                                                    <i class="bi bi-search" id="searchMain" ></i>
                                                                    <i class="bi bi-x-lg clear-button" style="margin-top: 10px"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="search_course_list list-group d-none" style=""></ul>
                                        </div></div>
                                    </div>
                                </div>
                                <br>
                                <form class="CourseModuleForm">
                                    <input type="hidden"
                                    value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : '' }}"
                                    name="course_id" class="course_id">
                                    <div class="tab-wrapper">
                                    <ul class="nav nav-tabs" id="tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="main-course-tab" data-bs-toggle="pill" href="#main-course" role="tab" aria-controls="main-course" aria-selected="true">Main</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                        <a class="nav-link disabled" id="optional-course-tab" data-bs-toggle="pill" href="#optional-course" role="tab" aria-controls="optional-course" aria-selected="false">Optional</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="tabContent">
                                        <!-- All Course Tab  -->
                                        @if(isset($CourseData[0]['id']))
                                            @php $MasterData = DB::table('master_course_management')->select('optional_course_id','course_id')->where('award_id',$CourseData[0]['id'])->where('master_course_management.is_deleted','No')->orderBy('placement_id','asc')->get(); @endphp
                                        @endif
                                        <div class="tab-pane fade active show" id="main-course" role="tabpanel"
                                            aria-labelledby="main-course-tab">
                                            <div class="bg-light rounded p-2 mb-4">
                                                <div class="list-group list-group-flush border-top-0 "  id="mainCourseList">
                                                    <div id= "searchCourseList">
                                                    <div id="mainCourseLists">
                                                        @if (isset($MasterData))   
                                                            @foreach($MasterData as $data)
                                                                @if (empty($data->optional_course_id))
                                                                    @php $AwardData = getData('course_master',['course_title','ects','id'],['id' => $data->course_id,"status"=>'3']);@endphp

                                                                    <div class='list-group-item rounded px-3 text-nowrap mb-1' id="courseID">
                                                                        <input type='hidden' name='main_course_id[]' value="{{ isset($AwardData[0]->id) ? base64_encode($AwardData[0]->id) : 0}}">
                                                                        <div class='d-flex align-items-center justify-content-between'>
                                                                            <h5 class='mb-0 text-truncate'><a href='#' class='text-inherit'><span class='align-middle fs-4 text-wrap-title'> <i class='fe fe-menu me-1 align-middle'></i>  {{htmlspecialchars_decode($AwardData[0]->course_title .' '. $AwardData[0]->ects . ' ECTS ')}}</span></a></h5>
                                                                            <div><a href='javascript:void(0)'  onclick="removeCourse(this);"  class='me-1 text-inherit' data-bs-toggle='tooltip' data-placement='top' aria-label='Delete' data-bs-original-title='Delete'><i class='fe fe-trash-2 fs-6'></i></a></div>       
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="optional-course" role="tabpanel" aria-labelledby="optional-course-tab">
                                            <div class="bg-light rounded p-2 mb-4">
                                                <div class="list-group list-group-flush border-top-0" id="optionCourseList">
                                                    <div id= "searchCourseList">
                                                    <div id="optionalCourseLists">
                                                        @if (isset($MasterData))   
                                                            @foreach($MasterData as $data)
                                                            @if (!empty($data->optional_course_id))
                                                                @php $AwardData = getData('course_master',['course_title','ects','id'],['id' => $data->optional_course_id,"status"=>'3']);@endphp
                                                                <div class='list-group-item rounded px-3 text-nowrap mb-1' id="courseID">
                                                                    <input type='hidden' name='optional_course_id[]' value="{{ isset($AwardData[0]->id) ? base64_encode($AwardData[0]->id) : 0}}">
                                                                    <div class='d-flex align-items-center justify-content-between'>
                                                                        <h5 class='mb-0 text-truncate'><a href='#' class='text-inherit'><span class='align-middle fs-4 text-wrap-title'> <i class='fe fe-menu me-1 align-middle'></i>  {{htmlspecialchars_decode($AwardData[0]->course_title .' '. $AwardData[0]->ects . ' ECTS ')}}</span></a></h5>
                                                                        <div><a href='javascript:void(0)'  onclick="removeCourse(this);"  class='me-1 text-inherit' data-bs-toggle='tooltip' data-placement='top' aria-label='Delete' data-bs-original-title='Delete'><i class='fe fe-trash-2 fs-6'></i></a></div>       
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                    <br><br>
                                    <div class="d-flex justify-content-between mb-8">
                                        <!-- Button -->
                                        <button class="btn btn-secondary previousCourseMedia" >Previous</button>
                                        <button type="submit" class="btn btn-primary CourseSubmitForm">Save</button>
                                    </div>
                                </form>
                                {{-- <input type='hidden'  name='course_id' class='course_id' value="{{ isset($CourseData[0]['id']) ? base64_encode($CourseData[0]['id']) : ''}}"> --}}
                                <!-- Form -->
                                {{-- <form class="row"> --}}
                                {{-- <?php $AwardData = getData('course_master',['course_title','ects','id'],['category_id' => "1","status"=>'3']);?>
                                @php $MasterData = []; @endphp
                                @if(isset($CourseData[0]['id']))
                                @php $MasterData = DB::table('master_course_management')->join('course_master','course_master.id','master_course_management.course_id')->select('course_title','ects','course_master.id')->where('award_id',$CourseData[0]['id'])->where('master_course_management.is_deleted','No')->orderBy('placement_id','asc')->get(); @endphp
                                @endif --}}

                                {{-- @foreach($AwardData as $data)
                                    <div class="col-6 mb-2">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="shippingAddress_{{base64_encode($data->id)}}"  data-courseid="{{base64_encode($data->id)}}" data-coursetitle="{{base64_encode($data->course_title)}}" data-ects ="{{base64_encode($data->ects)}}" >
                                            <label class="form-check-label" for="shippingAddress1" >{{$data->course_title.' '.$data->ects. ' ECTS '}}</label>
                                        </div>
                                    </div>
                                @endforeach --}}
                            </div>
                            {{-- <div class="row card-body"> --}}
                                {{-- <div class="col-md-12">
                                    <p>Drag the module to your desired position in the sequence.
                                        Release the module to drop it into place.</p>
                                    <ul id="sortable">
                                        @if($MasterData)
                                        @foreach($MasterData as $data) 
                                            <li class="ui-state-default" id="listItem_{{base64_encode($data->id)}}" data-courseid="{{base64_encode($data->id)}}">{{$data->course_title .' '. $data->ects . ' ECTS '}}<i class="bi bi-arrow-down-up"></i>
                                            </li> 
                                        @endforeach 
                                        @endif
                                    </ul>
                                </div> --}}
                            {{-- </div> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</main>



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
        var price = $("#price").val() > 0 ?  $("#price").val() : 0;
        var old_price = $("#final_price").val() > 0  ?  $("#final_price").val() : 0;
        if (price >  0) {
            var scholarship_percent = ((old_price - price) / old_price) * 100;
            $("#scholarship_percent").attr('value', scholarship_percent);
        } else {
            $("#scholarship_percent").attr('value', 0);
        }
    });

    $(document).ready(function() {
        $('#lecturer_id').select2({
            theme: 'bootstrap-5',
            width: '100%', 
            placeholder: 'Select',
            closeOnSelect: true, 
        });

        // $('#lecturer_id').on('change', function(){
        //     var selectedOptions = $(this).find('option:selected');

        //     selectedOptions.each(function() {
        //     $(this).prependTo($(this).parent());
        // });
        // });

        toggleDiscordFields();

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
    // Pass PHP data to JavaScript

    // Map the IDs from masterData
    // const selectedCourseIds = masterData.map(course => course.id);

    // Pre-check checkboxes based on selectedCourseIds
    // selectedCourseIds.forEach(courseId => {
    //     const checkbox = document.getElementById('shippingAddress_' + btoa(courseId));
    //     if (checkbox) {
    //         checkbox.checked = true; // Check the checkbox
    //     }
    //     const listItem = document.getElementById('listItem_' + courseId);
    //     if (listItem) {
    //         listItem.remove();  // Remove the list item if it already exists
    //         console.log('Removed existing list item:', listItem);
    //     }
    // });

    // Function to handle adding/removing list items based on checkbox status
    // document.querySelectorAll('.form-check-input').forEach(checkbox => {
    //     checkbox.addEventListener('change', function() {
    //         const courseId = this.getAttribute('data-courseid');
    //         const courseTitle = this.getAttribute('data-coursetitle');
    //         const ects = this.getAttribute('data-ects');

    //         if (this.checked) {
    //             // Create a new list item when checked
    //             const listItem = document.createElement('li');
    //             listItem.className = 'ui-state-default';
    //             listItem.setAttribute('data-courseid', courseId);
    //             listItem.id = 'listItem_' + courseId;
    //             listItem.innerHTML = `${atob(courseTitle)} ${atob(ects)} ECTS <i class="bi bi-arrow-down-up"></i>`;
    //             console.log('Added:', listItem);
    //             // Append the new list item to the UL
    //             document.getElementById('sortable').appendChild(listItem);
    //         } else {
    //             // Remove the specific list item when unchecked
    //             const listItem = document.getElementById('listItem_' + courseId);
    //             if (listItem) {
    //                 listItem.remove();
    //                 console.log('Removed:', listItem);
    //             }
    //         }
    //     });
    // });
</script>
{{-- @section('js')
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
@endsection --}}
@endsection