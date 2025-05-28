@extends('frontend.master')
@section('content')
<style>
    #overview ul, #entry-requirements ul, #course-content ul, #assessment ul{
       padding-left: 15px;
    }
   
    #overview li, #entry-requirements li, #course-content li , #assessment li{
        margin-bottom: 8px;
    }
   
    #overview li::marker, #entry-requirements li::marker, #course-content li::marker, #assessment li::marker{
        color: rgb(58 49 141);
    }

    .optional_course{
        font-size:0.75rem !important;
        color:#475569;
    }
    .center-button {
        display: block;
        margin: 0 auto;
        width: 200px;
        text-align: center;
    }
   </style>
<main>
    @php
        $data = $MasterCourseData[0];
    @endphp
    <!-- Page header -->
    <section class="pt-lg-8 pt-5 pb-8 bg-primary order-1">
        <div class="container pb-lg-6">
            <div class="row align-items-center">
                <div class="col-xl-8 col-lg-8 col-md-12">
                    <div>
                        <h1 class="text-white display-5 fw-bold color-green ">
                            {{ isset($data['course_title']) ? htmlspecialchars_decode($data['course_title']) : '' }}</h1>
                        <p class="text-white mb-6 fs-5">
                            {{ isset($data['course_subheading']) ? htmlspecialchars_decode($data['course_subheading']) : '' }}
                        </p>
                        <div class="d-flex align-items-center">
                            <span class="text-white">
                                <img src="{{ asset('frontend/images/icon/mqf-icon.svg') }}" alt="" width="15px">
                                MQF/EQF Level: {{ $data['mqfeqf_level'] ? $data['mqfeqf_level'] : "N/D" }}
                            </span>

                            <span class="text-white ms-3">
                                <i class="bi bi-star-fill color-green  rating-star"></i>
                                ECTS: {{ $data['ects'] ? $data['ects'].' Credits' : 'N/D' }} 
                            </span>

                            @if($data['status'] == '3')
                            <span class="text-white ms-3">
                                <i class="fe fe-user color-green"></i>
                                {{-- @php $CountEnrolled = is_enrolled('',$data['id']);@endphp {{$CountEnrolled}} Enrolled --}}
                                @php $CountEnrolled = $data['temp_count'];@endphp {{$CountEnrolled}} Enrolled
                            </span> 
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page content -->
    <section class="pb-8">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-12 mt-md-4 mt-5 mb-4 mb-lg-0 order-3 order-lg-2">
                    <!-- Card -->
                    <div class="card rounded-3 mt-0 mt-md-2">
                        <!-- Card header -->
                        <div class="card-header border-bottom-0 p-0">
                            <div>
                                <!-- Nav -->
                                <ul class="nav nav-lb-tab" id="tab" role="tablist">
                                    @if (Auth::check() && Auth::user()->role == 'user')
                                    @php
                                        $studentCourseMaster = getData('student_course_master', ['course_expired_on', 'exam_attempt_remain', 'exam_remark'], [
                                            'user_id' => Auth::user()->id,  'course_id' => $data['id'], 'is_deleted' => 'No' ], '', 'created_at');
                                    @endphp
                                    @if(isset($studentCourseMaster) && $studentCourseMaster->isNotEmpty() && !empty($studentCourseMaster[0]))
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="pill" href="#progress" role="tab" aria-controls="progress" aria-selected="true"> Progress
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item {{ isset($data['progress_tab']) && $data['progress_tab'] != 0 ? 'd-none' : '' }}">
                                            <a class="nav-link {{ isset($data['progress_tab']) && $data['progress_tab'] == 0 ? 'active' : '' }}" id="progress-tab" data-bs-toggle="pill"
                                                href="#progress" role="tab" aria-controls="progress"
                                                aria-selected="true">Progress</a>
                                        </li>
                                    @endif
                                    @else
                                        <li class="nav-item {{ isset($data['progress_tab']) && $data['progress_tab'] != 0 ? 'd-none' : '' }}">
                                            <a class="nav-link {{ isset($data['progress_tab']) && $data['progress_tab'] == 0 ? 'active' : '' }}" id="progress-tab" data-bs-toggle="pill"
                                                href="#progress" role="tab" aria-controls="progress"
                                                aria-selected="true">Progress</a>
                                        </li>
                                    @endif

                                    @if (Auth::check() && Auth::user()->role == 'user')
                                    @php
                                        $studentCourseMaster = getData('student_course_master', ['course_expired_on', 'exam_attempt_remain', 'exam_remark'], [
                                            'user_id' => Auth::user()->id,  'course_id' => $data['id'], 'is_deleted' => 'No' ], '', 'created_at');
                                    @endphp

                                    @if(isset($studentCourseMaster) && $studentCourseMaster->isNotEmpty() && !empty($studentCourseMaster[0]))
                                        <li class="nav-item">
                                            <a class="nav-link" id="overview-tab" data-bs-toggle="pill"
                                                href="#overview" role="tab" aria-controls="overview" aria-selected="false"> Overview  </a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link {{ isset($data['progress_tab']) && $data['progress_tab'] == 1 ? 'active' : '' }}" id="overview-tab" data-bs-toggle="pill"
                                                href="#overview" role="tab" aria-controls="overview" aria-selected="false">  Overview </a>
                                        </li>
                                    @endif
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link {{ isset($data['progress_tab']) && $data['progress_tab'] == 1 ? 'active' : '' }}" id="overview-tab" data-bs-toggle="pill"
                                                href="#overview" role="tab" aria-controls="overview" aria-selected="false">  Overview </a>
                                        </li>
                                    @endif
                                    <li class="nav-item">
                                        <a class="nav-link" id="entry-requirements-tab" data-bs-toggle="pill"
                                            href="#entry-requirements" role="tab" aria-controls="entry-requirements"
                                            aria-selected="false">
                                            Entry Requirements
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="course-content-tab" data-bs-toggle="pill"
                                            href="#course-content" role="tab" aria-controls="course-content"
                                            aria-selected="false">
                                            Course Content                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="assessment-tab" data-bs-toggle="pill" href="#assessment"
                                            role="tab" aria-controls="assessment" aria-selected="false">Assessment</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="tab-content" id="tabContent">
                                @if (Auth::check() && Auth::user()->role == 'user')
                            @php
                                $studentCourseMaster = getData('student_course_master', ['course_expired_on', 'exam_attempt_remain', 'exam_remark'], [
                                    'user_id' => Auth::user()->id,  'course_id' => $data['id'], 'is_deleted' => 'No' ], '', 'created_at');
                            @endphp
                            @if(isset($studentCourseMaster) && $studentCourseMaster->isNotEmpty() && !empty($studentCourseMaster[0]))
                                <div class="tab-pane fade show active" id="progress" role="tabpanel" aria-labelledby="progress-tab">
                            @else
                                <div class="tab-pane fade {{ isset($data['progress_tab']) && $data['progress_tab'] == 0 ? 'show active' : 'd-none' }}" id="progress" role="tabpanel" aria-labelledby="progress-tab">
                            @endif
                            @else
                                <div class="tab-pane fade {{ isset($data['progress_tab']) && $data['progress_tab'] == 0 ? 'show active' : 'd-none' }}" id="progress" role="tabpanel" aria-labelledby="progress-tab">
                            @endif
                                    <!-- Card -->
                                    <div class="accordion" id="courseAccordion">
                                        <div>
                                            <!-- List group -->
                                            <ul class="list-group list-group-flush">
                                                {{-- <li class="list-group-item px-0 pt-0">
                                                    <!-- Toggle -->
                                                    <a class="h4 mb-0 d-flex align-items-center active" data-bs-toggle="collapse" href="#section1" aria-expanded="false" aria-controls="section1">
                                                        <div class="me-auto">Recruitment and Employee Selection
                                                            <span class="mb-0 fs-6 mt-1 fw-normal">(6 ECTS) (150 Hours) </span>
                                                        </div>
                                                        <!-- Chevron -->
                                                        <span class="chevron-arrow ms-4">
                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                        </span>
                                                    </a>
                                                    <!-- Collapse -->
                                                    <div class="collapse " id="section1" data-bs-parent="#courseAccordion">
                                                        <div class="pt-3 pb-2">
                                                            <!-- Submenu for Recruitment and Employee Selection -->
                                                            <div class="accordion" id="sectionAccordion">
                                                                <div>
                                                                    <!-- List group -->
                                                                    <ul class="list-group list-group-flush">
                                                                        <div class="mb-2">
                                                                            <div class="progress" style="height: 6px">
                                                                                <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 45%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <small>45% Completed</small>
                                                                        </div>
                                                                        <li class="list-group-item px-0">
                                                                            <!-- Toggle -->
                                                                            <a class="h5 mb-0 d-flex align-items-center active" data-bs-toggle="collapse" href="#subsection1" aria-expanded="true" aria-controls="subsection1">
                                                                                <div class="me-auto">Section 1
                                                                                </div>
                                                                                <!-- Chevron -->
                                                                                <span class="chevron-arrow ms-4">
                                                                                    <i class="fe fe-chevron-down fs-4"></i>
                                                                                </span>
                                                                            </a>
                                                                            <!-- Collapse -->
                                                                            <div class="collapse show" id="subsection1" data-bs-parent="#sectionAccordion">
                                                                                <div class="pt-3 pb-2">
                                                                                    
                                                                                    <!-- Submenu items -->
                                                                                    <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Introduction</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 19s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>What Is a Variable?</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 11s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Declaring Variables</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 30s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Using let to Declare Variables</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 28s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Naming Variables</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 14s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Common Errors Using Variables</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 30s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Changing Variable Values</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 4s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Constants</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 15s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>The var Keyword</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>2m 20s</span>
                                                                </div>
                                                            </a>
                                                            <a href="#"
                                                                class="mb-0 d-flex justify-content-between align-items-center text-inherit disableClick">
                                                                <div class="text-truncate">
                                                                    <span
                                                                        class="icon-shape bg-light text-secondary icon-sm rounded-circle me-2"><i
                                                                            class="fe fe-lock"></i></span>
                                                                    <span>Summary</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>1m 49s</span>
                                                                </div>
                                                            </a>
                                                                                    <!-- Add more submenu items here -->
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>--}}
                                                @php
                                                $i = 1;
                                                $noofmodules = 0;
                                                    @endphp
                                                @if(!empty($data['masterCourseManage']))
                                             

                                                @foreach($data['masterCourseManage'] as $key => $award_course)                                                
                                                @if(!empty($award_course['courseModules'][0]))
                                                {{-- @php echo "<pre>"; dd($award_course['course_manage']); @endphp --}}
                                                <li class="list-group-item px-0 pt-0">
                                                    <!-- Toggle -->
                                                    <a class="h4 mb-0 d-flex align-items-center active" data-bs-toggle="collapse" href="#section{{ $i }}" aria-expanded="false" aria-controls="section{{ $i }}" style="font-size: 15px">
                                                        <div class="me-auto mt-3 text-inherit">{{ isset($award_course['courseModules'][0]['course_title']) && $award_course['courseModules'][0]['course_title'] != "null" ? htmlspecialchars_decode($award_course['courseModules'][0]['course_title']) : '' }}
                                                            
                                                            <span class="mb-0 fs-6 mt-1 fw-normal">{{ isset($award_course['courseModules'][0]['ects']) && !empty($award_course['courseModules'][0]['ects']) ? '('. htmlspecialchars_decode($award_course['courseModules'][0]['ects'])." ECTS)" : '' }} {{ isset($award_course['courseModules'][0]['total_learning']) && $award_course['courseModules'][0]['total_learning'] ? '('. htmlspecialchars_decode($award_course['courseModules'][0]['total_learning']).' Hours)' : '' }} </span>
                                                        </div>
                                                        <!-- Chevron -->
                                                        <span class="mb-0 fs-6 mt-1 fw-normal text-inherit" s>{{isset($award_course['optional_course_id']) && !empty($award_course['optional_course_id']) ? '(Optional)': ''}} </span>
                                                        <span class="chevron-arrow ms-4 text-inherit">
                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                        </span>
                                                    </a>
                                                    <!-- Collapse -->
                                                    <div class="collapse" id="section{{ $i }}" data-bs-parent="#courseAccordion">
                                                        <div class="pt-3 pb-2">
                                                            <!-- Submenu for Recruitment and Employee Selection -->
                                                            <div class="accordion" id="sectionAccordion{{ $i }}">
                                                                <div>
                                                                    <!-- List group -->
                                                                    <ul class="list-group list-group-flush">
                                                                        {{-- <div class="mb-2">
                                                                            <div class="progress" style="height: 6px">
                                                                                <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <small>0% Completed</small>
                                                                        </div>
                                                                       --}}
                                                                   
                                                                 
                                                                        @php $t=1; @endphp
                                                                        @foreach ($award_course['CourseManage'] as $course_manage)
                                                                        @foreach ($course_manage['sections'] as $key => $sections)
                                                                      
                                                                        <li class="list-group-item px-0 pt-0">
                                                                            <!-- Toggle -->
                                                                            @if (Auth::check() && Auth::user()->role =='user')
                                                                                @php
                                                                                $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $data['id'],'is_deleted'=>'No'], "", 'created_at');   @endphp
                                                                                @if(isset($studentCourseMaster) && $studentCourseMaster->isNotEmpty() && !empty($studentCourseMaster[0]))
                                                                                    @php
                                                                                  
                                                                                        $courseExpiredOn = $studentCourseMaster[0]->course_expired_on;
                                                                                        $examAttemptRemain = $studentCourseMaster[0]->exam_attempt_remain;
                                                                                        $examRemark = $studentCourseMaster[0]->exam_remark;
                                                                                        $showSectionLink = ($courseExpiredOn > now() && $examAttemptRemain == '1' && $examRemark == '0') || ($courseExpiredOn > now() && $examAttemptRemain == '2');   
                                                                                    @endphp
                                                                                    @if($showSectionLink == true)
                                                                                        <a class="h5 mb-0 d-flex align-items-center active" data-bs-toggle="collapse"  href="#subsection{{ $t .''. $i }}" aria-expanded="false"
                                                                                        aria-controls="subsection{{ $t .''. $i }}">
                                                                                            <div class="me-auto mt-2">
                                                                                                {{ isset($sections['section_name']) ? htmlspecialchars_decode($sections['section_name']) : '' }}
                                                                                                <span class="mb-0 fs-5 mt-1 fw-normal">
                                                                                                    {{-- (150 Hours)  --}}
                                                                                                </span>
                                                                                            </div>
                                                                                            <!-- Chevron -->
                                                                                            <span class="chevron-arrow ms-4">
                                                                                                <i class="fe fe-chevron-down fs-4"></i>
                                                                                            </span>
                                                                                        </a>
    
                                                                                    @else
                                                                                        {{-- For roles other than 'user' --}}
                                                                                        <a class="h4 mb-0 d-flex align-items-center active"
                                                                                            data-bs-toggle="collapse"
                                                                                            aria-expanded="false"
                                                                                            >
                                                                                            <div class="me-auto mt-2" style="font-size: 15px">
                                                                                                {{ isset($sections['section_name']) ? htmlspecialchars_decode($sections['section_name']) : '' }}
                                                                                            </div>
                                                                                        </a>
                                                                                    @endif
                                                                                @else
                                                                                    {{-- For roles other than 'user' --}}
                                                                                    <a class="h4 mb-0 d-flex align-items-center active"
                                                                                        data-bs-toggle="collapse"
                                                                                        aria-expanded="false"
                                                                                        >
                                                                                        <div class="me-auto mt-2" style="font-size: 15px">
                                                                                            {{ isset($sections['section_name']) ? htmlspecialchars_decode($sections['section_name']) : '' }}
                                                                                        </div>
                                                                                    </a>
                                                                                @endif
                                                                            @else   
                                                                            {{-- For unauthenticated users --}}
                                                                                <a class="h4 mb-0 d-flex align-items-center active"
                                                                                    data-bs-toggle="collapse"
                                                                                    aria-expanded="false"
                                                                                    >
                                                                                    <div class="me-auto mt-2" style="font-size: 15px">
                                                                                        {{ isset($sections['section_name']) ? htmlspecialchars_decode($sections['section_name']) : '' }}
                                                                                    </div>
                                                                                </a>
                                                                            @endif
                                                                            <!-- Row -->
                                                                            <!-- Collapse -->
                                                                            <div class="collapse" id="subsection{{ $t .''. $i }}" data-bs-parent="#sectionAccordion{{ $i }}">
                                                                                <div class="pt-2 pb-2">
                                                                                    <div class="mb-2">
                                                                                    </div>
                                                                                    @php $j=1; $k =1;@endphp
                                                                                    @foreach ($sections['sectionManage'] as $section_manage)
                                                                                    {{-- @php echo $m; echo "dfsd"; @endphp --}}
                                                                                    {{-- @if($j <= 3) --}}
                                                                                        @if (isset($section_manage['content_type_id']) && !empty($section_manage['content_type_id']) && $section_manage['content_type_id'] === 1)
                                                                                        
                                                                                            @foreach ($section_manage['courseVideo'] as $video)
                                                                                           
                                                                                                @if($video['video_duration'] == 0)
                                                                                                    @php $formattedTime = ''; @endphp
                                                                                                @else
                                                                                                @php  
                                                                                                    // $video_duration = $video['video_duration'];
                                                                                                    // $minutes = floor($video_duration / 60);
                                                                                                    // $seconds = $video_duration % 60;
                                                                                                    $formattedTime = $video['video_duration'];
                                                                                                    // $video_duration = floatval($video_duration);
                                                                                                    // $minutes = floor($video_duration / 60);
                                                                                                    // $remaining_seconds = $video_duration % 60 + 1;
                                                                                                    // $video_duration = $minutes . ':' . $remaining_seconds;  
                                                                                                @endphp
                                                                                                @endif
                                                                                           
                                                                                                <div class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                                    <div class="d-flex align-items-center">
                                                                                                        <span class="icon-shape  icon-sm rounded-circle me-2"><i class="fe fe-lock color-blue fs-5 playIconStudentCoursePanel"></i>
                                                                                                        </span>
                                                                                                        <span class="preview-course-heading d-inline-block text-inherit" style="font-size: 14px">{{ isset($video['video_title']) ? htmlspecialchars_decode($video['video_title']) : '' }}</span>
                                                                                                    </div>
                                                                                                    <div class="">
                                                                                                        <span>{{ 2 ? $formattedTime : '<i class="fe fe-lock color-blue"></i>' }}</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                {{-- </a> --}}
                                                                                            {{-- @endif --}}
                                                                                            @endforeach
                                                                                        @elseif(!empty($section_manage['content_type_id']) && $section_manage['content_type_id'] === 2)
                                                                                            @foreach ($section_manage['courseArticle'] as $key => $docs)
                                                                                                @php
                                                                                                    $doc_file_name = isset($docs['doc_file_name']) ? $docs['doc_file_name'] : '';
                                                                                                    $extensionFile = pathinfo($doc_file_name); 
                                                                                                    $displayIcon= '';
                                                                                                    if(!empty($extensionFile['extension'])){
                                                                                                        if($extensionFile['extension'] == 'pdf'){
                                                                                                            $displayIcon = "bi-file-earmark-pdf";
                                                                                                        }else if($extensionFile['extension']  == 'doc' || $extensionFile['extension']  == 'docx'){
                                                                                                            $displayIcon = "bi-file-earmark-word";
                                                                                                        }else if($extensionFile['extension']  == 'xls' || $extensionFile['extension']  == 'xlsx'){
                                                                                                            $displayIcon = "bi-filetype-exe";
                                                                                                        }
                                                                                                    }
                                                                                                @endphp         
                                                                                                {{-- @if($j <= 3)  --}}
                                                                                                <a 
                                                                                                    class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                                    <div class="d-flex align-items-center">
                                                                                                        <span
                                                                                                            class="icon-shape icon-sm rounded-circle me-2">
                                                                                                            <i
                                                                                                                class="bi {{$displayIcon}}  fs-5 playIconStudentCoursePanel"></i>
                                                                                                        </span>
                                                                                                        <span
                                                                                                            class="preview-course-heading">{{ isset($docs['docs_title']) ? htmlspecialchars_decode($docs['docs_title']) : '' }}</span>
        
                                                                                                    </div>
                                                                                                    <div class="text-truncate">
                                                                                                        <span class="icon-shape  icon-sm rounded-circle me-2"><i
                                                                                                                class="fe fe-lock color-blue fs-5 playIconStudentCoursePanel"></i></span>
                                                                                                    </div>
                                                                                                </a>
                                                                                                {{-- @endif --}}
                                                                                            {{-- @php $k++; @endphp --}}
                                                                                            @endforeach
                                                                                        @elseif(!empty($section_manage['content_type_id']) && $section_manage['content_type_id'] === 3)
                                                                                            @foreach ($section_manage['courseQuiz'] as $quiz)
                                                                                            {{-- @if($j <= 3)  --}}
        
                                                                                                <a 
                                                                                                    class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                                    <div class="text-truncate">
                                                                                                            <span class="icon-shape text-primary icon-sm rounded-circle me-2 color-light-cyan">
                                                                                                            <i class="fe fe-help-circle nav-icon fs-5 color-green"></i></span>
                                                                                                        <span
                                                                                                            class="preview-course-heading">{{ isset($quiz['quiz_tittle']) ? htmlspecialchars_decode($quiz['quiz_tittle']) : '' }}</span>
        
                                                                                                    </div>
                                                                                                    {{-- <div class="text-truncate"> --}}
                                                                                                        <span class="icon-shape  icon-sm rounded-circle me-2"><i
                                                                                                                class="fe fe-lock color-blue fs-5 playIconStudentCoursePanel"></i></span>
                                                                                                    {{-- </div> --}}
                                                                                                </a>
                                                                                            {{-- @endif --}}
                                                                                            @endforeach
                                                                                        @endif
                                                                                    {{-- @endif --}}
                                                                                    {{-- @php $j++; @endphp --}}
                                                                                    {{-- @php $m++; @endphp --}}
                                                                                    @endforeach
                                                                                   
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                      
                                                                        @endforeach
                                                                     
                                                                        @php $t++;  @endphp
                                                                        @endforeach

                                                                        {{-- @php echo "<pre>"; dd($award_course['course_manage'][$i]['sections']); @endphp --}}

                                                                        {{-- @endif --}}
                                                                        {{-- <li class="list-group-item px-0">
                                                                            <!-- Toggle -->
                                                                            <a class="h5 mb-0 d-flex align-items-center active" data-bs-toggle="collapse" href="#subsection1" aria-expanded="true" aria-controls="subsection1">
                                                                                <div class="me-auto">Training section 1
                                                                                </div>
                                                                                <!-- Chevron -->
                                                                                <span class="chevron-arrow ms-4">
                                                                                    <i class="fe fe-chevron-down fs-4"></i>
                                                                                </span>
                                                                            </a>
                                                                            <!-- Collapse -->
                                                                            <div class="collapse show" id="subsection1" data-bs-parent="#sectionAccordion">
                                                                                <div class="pt-3 pb-2">
                                                                                    
                                                                                    <!-- Submenu items -->
                                                                                    <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                        <div class="text-truncate">
                                                                                            <span class="icon-shape bg-blue icon-sm rounded-circle me-2">
                                                                                                <i class="bi bi-check2 color-green fs-4 fw-bold"></i>
                                                                                            </span>
                                                                                            <span class="preview-course-heading">Introduction</span>
                                                                                            
                                                                                        </div>
                                                                                        <div class="text-truncate">
                                                                                            <span>1m 7s</span>
                                                                                        </div>
                                                                                    </a>
                                                                                    <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                        <div class="text-truncate">
                                                                                            <span class="icon-shape bg-blue icon-sm rounded-circle me-2">
                                                                                                
                                                                                                <i class="bi bi-file-pdf color-green"></i>
                                                                                            </span>
                                                                                            <span class="preview-course-heading">Installing Development Software</span>
                                                                                        </div>
                                                                                        <div class="text-truncate">
                                                                                            <span>3m 11s</span>
                                                                                        </div>
                                                                                    </a>
                                                                                    <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                        <div class="text-truncate">
                                                                                            <span class="icon-shape bg-light icon-sm bg-blue rounded-circle me-2">
                                                                                                <i class="bi bi-play-fill color-green"></i>
                                                                                            </span>
                                                                                            <span class="preview-course-heading">Hello World Project from GitHub</span>
                                                                                        </div>
                                                                                        <div class="text-truncate">
                                                                                            <span>2m 33s</span>
                                                                                        </div>
                                                                                    </a>
                                                                                    <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                        <div class="text-truncate">
                                                                                            <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                                <i class="fe fe-lock"></i>
                                                                                            </span>
                                                                                            <span>Our Sample Website</span>
                                                                                        </div>
                                                                                        <div class="text-truncate">
                                                                                            <span>2m 15s</span>
                                                                                        </div>
                                                                                    </a>
                                                                                    <a href="course-resume.html" class="d-flex justify-content-between align-items-center text-inherit">
                                                                                        <div class="text-truncate">
                                                                                            <span class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                                <i class="fe fe-lock"></i>
                                                                                            </span>
                                                                                            <span>Sample Website</span>
                                                                                        </div>
                                                                                        <div class="text-truncate">
                                                                                            <span>2m 15s</span>
                                                                                        </div>
                                                                                    </a>
                                                                                    <!-- Add more submenu items here -->
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="list-group-item px-0">
                                                                            <!-- Toggle -->
                                                                            <a class="h5 mb-0 d-flex align-items-center active" data-bs-toggle="collapse" href="#trainingsubsection2" aria-expanded="true" aria-controls="trainingsubsection2">
                                                                                <div class="me-auto">Training section 2
                                                                                </div>
                                                                                <!-- Chevron -->
                                                                                <span class="chevron-arrow ms-4">
                                                                                    <i class="fe fe-chevron-down fs-4"></i>
                                                                                </span>
                                                                            </a>
                                                                            <!-- Collapse -->
                                                                            <div class="collapse show" id="trainingsubsection2" data-bs-parent="#sectionAccordion">
                                                                                <div class="pt-3 pb-2">
                                                                                    
                                                                                    <!-- Submenu items -->
                                                                                    <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                        <div class="text-truncate">
                                                                                            <span class="preview-course-heading">Introduction</span>
                                                                                        </div>
                                                                                        <div class="text-truncate">
                                                                                            <span>1m 7s</span>
                                                                                        </div>
                                                                                    </a>
                                                                                    <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                        <div class="text-truncate">
                                                                                            <span class="preview-course-heading">Installing Development Software</span>
                                                                                        </div>
                                                                                        <div class="text-truncate">
                                                                                            <span>3m 11s</span>
                                                                                        </div>
                                                                                    </a>
                                                                                    <!-- Add more submenu items here -->
                                                                                </div>
                                                                            </div>
                                                                        </li> --}}
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li> 
                                                @php
                                                    $i++;
                                                    $noofmodules++;
                                                @endphp
                                                @endif

                                                @endforeach
                                                @endif
                                                <br>
                                                
                                                @if(empty($data['preference_id_optional']) && $data['preference_status'] == '0')
                                                    <a href="{{route('student-my-learning')}}" class="btn btn-primary  mb-2 color-green fs-4 center-button">
                                                        Select Optional ECTS 
                                                    </a>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::check() && Auth::user()->role == 'user')
                            @php
                                $studentCourseMaster = getData('student_course_master', ['course_expired_on', 'exam_attempt_remain', 'exam_remark'], [
                                    'user_id' => Auth::user()->id,  'course_id' => $data['id'], 'is_deleted' => 'No' ], '', 'created_at');
                            @endphp
                            @if(isset($studentCourseMaster) && $studentCourseMaster->isNotEmpty() && !empty($studentCourseMaster[0]))

                                <div class="tab-pane fade" id="overview" role="tabpanel"
                                    aria-labelledby="overview-tab">
                            @else
                                <div class="tab-pane fade {{ isset($data['progress_tab']) && $data['progress_tab'] == 1 ? 'show active' : '' }}" id="overview" role="tabpanel"
                                    aria-labelledby="overview-tab">
                            @endif
                            @else
                                <div class="tab-pane fade {{ isset($data['progress_tab']) && $data['progress_tab'] == 1 ? 'show active' : '' }}" id="overview" role="tabpanel"
                                    aria-labelledby="overview-tab">
                            @endif
                                    <?php echo !empty($data['overview']) ? htmlspecialchars_decode($data['overview']) : 'Not Disclosed' ?>

                                    <br>

                                    <div class="mb-3">
                                        <h4>
                                            Programme Outcomes 
                                        </h4>
                                        <p class="mb-0">
                                            <?php echo !empty($data['programme_outcomes'] && $data['programme_outcomes'] != 'undefined') ? htmlspecialchars_decode($data['programme_outcomes']) : 'Not Disclosed' ?>

                                        </p>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="entry-requirements" role="tabpanel"
                                    aria-labelledby="entry-requirements-tab">
                                    <div class="mb-4">
                                        <div class="course__overview">
                                            <?php echo !empty($data['entry_requirements']) ? htmlspecialchars_decode($data['entry_requirements']) : 'Not Disclosed' ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="course-content" role="tabpanel"
                                    aria-labelledby="course-content-tab">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-12 col-12">
                                                <div class="mb-3">
                                                    <h4>
                                                        Course Syllabus Podcast
                                                    </h4>
                                                    <p class="mb-0">
                                                        Gain a Comprehensive Understanding of the Course Syllabus with Our Informative Podcast
                                                    </p>
                                                </div>
                                                <!-- Card -->
                                                <div class="col-lg-4 col-12">
                                                <div class="card mb-3 mb-4">
                                                    
                                                    <div class="p-1">
                                                      
                                                        @if (isset($data['OtherVideo'][0]['bn_video_url_id']) &&
                                                                !empty($data['OtherVideo'][0]['bn_video_url_id']) &&
                                                                !empty($data['OtherVideo'][0]['video_type']) &&
                                                                $data['OtherVideo'][0]['video_type'] === '1')
                                                            <div class="d-flex justify-content-center align-items-center cursor-pointer rounded border-white border rounded-3 bg-cover openVideoModal" data-videourl ="https://iframe.mediadelivery.net/embed/{{ env('MASTER_LIBRARY_ID') }}/{{ $data['OtherVideo'][0]['bn_video_url_id'] }}"
                                                                style="position: relative; overflow: hidden;">
                                                                <img src="{{Storage::url($data['podcast_thumbnail_file'])}}" alt="Trailer Thumbnail" 
                                                                style="width: 100%; height: 100%; object-fit: cover;">
                                                                <i class="bi bi-play-fill fs-3 course-details-play-icon" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>

                                                            
                                                            </div>
                                                        @else
                                                            <p>Not Disclosed</p>
                                                        @endif
                                                    </div>


                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="assessment" role="tabpanel"
                                    aria-labelledby="assessment-tab">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-12 col-12">
                                                <div class="mb-3">

                                                    <p class="mb-0">
                                                        <?php echo !empty($data['assessment']) ? htmlspecialchars_decode($data['assessment']) : 'Not Disclosed.' ?>
                                                    </p>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                            <!-- Related Course  -->
                            {{-- <div class="row mt-8">
                                <!-- col -->
                                <div class="col-12">
                                    <div class="mb-4">
                                        <h2 class="mb-1 h1 fw-bold">Related Courses</h2>
                                        <p>
                                            Explore our most popular programs, get job-ready for an in-demand career.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">

                                    <!-- Card -->
                                    <div class="card card-hover">
                                        <a href="course-details">
                                            <img src="{{ asset('frontend/images/course/award-recruitment-and-employee-selection.png')}}" alt="course" class="card-img-top"></a>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Award</span>
                                                <span class="badge bg-success-soft co-etcs">6 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="course-details" class="text-inherit">Award
                                                    in Recruitment and Employee Selection</a></h4>

                                                    <div class="lh-1 mt-3">

                                                        <span class="fs-6">
                                                            <i class="fe fe-user color-blue"></i>
                                                            1200 Enrolled
                                                        </span>
                            
                                                        </div>
                                        </div>
                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <div class="col course-price-flex">
                                                    <h5 class="mb-0 course-price">€15000</h5>
                                                    <h5 class="old-price">€23000 </h5>
                                                </div>

                                                <div class="col-auto">
                                                    <a href="#" class="text-inherit">
                                                        <i class="fe fe-shopping-cart text-primary align-middle me-2"></i>
                                                        </a><a href="#" class="buy-now">Buy Now</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="card card-hover">
                                        <a href="course-details">
                                            <img  src="{{ asset('frontend/images/course/certificate-human-resource-management.png')}}" alt="course" class="card-img-top"></a>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Certificate</span>
                                                <span class="badge bg-success-soft co-etcs">30 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="course-details" class="text-inherit">Post Graduate Certificate in Human Resource Management</a></h4>

                                            <div class="lh-1 mt-3">

                                                <span class="fs-6">
                                                    <i class="fe fe-user color-blue"></i>
                                                    1200 Enrolled
                                                </span>
                    
                                                </div>
                                        </div>
                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <div class="col course-price-flex">
                                                    <h5 class="mb-0 course-price">€1500</h5>
                                                    <h5 class="old-price">€2300 </h5>
                                                </div>

                                                <div class="col-auto">
                                                    <a href="#" class="text-inherit">
                                                        <i class="fe fe-shopping-cart text-primary align-middle me-2"></i>
                                                        </a><a href="#" class="buy-now">Buy Now</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-md-4">
                                    <div class="card card-hover">
                                        <a href="course-details">
                                            <img  src="{{ asset('frontend/images/course/diploma-human-resource-management.png')}}" alt="course" class="card-img-top"></a>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Diploma</span>
                                                <span class="badge bg-success-soft co-etcs">60 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="course-details" class="text-inherit">Post Graduate Diploma in Human Resource Management</a></h4>

                                            <div class="lh-1 mt-3">

                                                <span class="fs-6">
                                                    <i class="fe fe-user color-blue"></i>
                                                    1200 Enrolled
                                                </span>
                    
                                                </div>
                                        </div>
                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <div class="col course-price-flex">
                                                    <h5 class="mb-0 course-price">€1500</h5>
                                                    <h5 class="old-price">€2300 </h5>
                                                </div>

                                                <div class="col-auto">
                                                    <a href="#" class="text-inherit">
                                                        <i class="fe fe-shopping-cart text-primary align-middle me-2"></i>
                                                        </a><a href="#" class="buy-now">Buy Now</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            


                            </div>

                            <div class="mt-6">
                                <a href="browse-course" class="btn btn-outline-primary">Browse all</a>
                            </div> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-12 course-preview-column order-2 order-lg-3">
                    <!-- Card -->
                    @if (isset($data['bn_course_trailer_url']) && !empty($data['bn_course_trailer_url']))
                        <div class="card mb-3 mb-2">
                            <div class="p-1">
                                <div class="d-flex justify-content-center cursor-pointer align-items-center rounded border-white border rounded-3 bg-cover openVideoModal"
                                    data-videourl="https://iframe.mediadelivery.net/embed/{{env('MASTER_LIBRARY_ID')}}/{{ $data['bn_course_trailer_url'] }}?autoplay=true" 
                                    style="position: relative; overflow: hidden;">
                                    <img src="{{ Storage::url($data['trailer_thumbnail_file']) }}" alt="Trailer Thumbnail" 
                                        style="width: 100%; height: 100%; object-fit: cover;"/>
                                    <i class="bi bi-play-fill fs-3 course-details-play-icon" 
                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                </div>
                            </div>
                            <!-- Card body -->
                            <div class="card-body p-3">
                                
                                @if(isset($data['status']) && $data['status'] != '1')
                                    @if($data['course_final_price'] > 0)
                                        <div class="mb-3 text-center">
                                            <div class="text-dark fw-bold h2 color-blue">€{{isset($data['course_final_price']) ? htmlspecialchars($data['course_final_price']) : '' }}</div>
                                            @if(isset($data['course_old_price']) && $data['course_old_price'] > 0) <del class="fs-4">€{{isset($data['course_old_price']) ? htmlspecialchars($data['course_old_price']) : '' }}</del>
                                            <span class="course-off-discount">{{ (!empty($data['course_final_price']) && $data['course_final_price'] > 1) ? (isset($data['scholarship']) && $data['scholarship'] > 0 ? intval(round($data['scholarship'])).'%'.' Scholarship' : 'Scholarship') : 'Introductory Fees' }}</span>@endif
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            @php $promoCode = getCoursePromoCode($data['id']); @endphp
                                            @if($promoCode)
                                                <small class="promo-code font-weight-bold text-primary rounded p-1" style="background: #dae138">
                                                <span class="badge badge-success text-primary fs-5" ><span style="user-select: none">PROMO:</span> <span class="fw-bold">{{$promoCode}}</span></span>
                                                </small>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="d-grid">
                                            @if (Auth::check() && Auth::user()->role =='superadmin')
                                                <a href="{{route('admin-master-course-panel',['course_id'=>base64_encode($data['id'])])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center"><i class="fe fe-play btn-outline-primary"></i> Play </a>
                                            @elseif (Auth::check() && Auth::user()->role =='admin')
                                                <a href="{{route('admin-master-course-panel',['course_id'=>base64_encode($data['id'])])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center"><i class="fe fe-play btn-outline-primary"></i> Play </a>
                                            @elseif (Auth::check() && (Auth::user()->role =='instructor' || Auth::user()->role =='sub-instructor'))
                                            @elseif (Auth::check() && Auth::user()->role =='user')
                                                @php
                                                    $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $data['id']]);
                                                @endphp
                                                {{-- @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0) --}}
                                                    @php
                                                        $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $data['id'],'is_deleted'=>'No'], "", 'created_at');
                                                    @endphp
                                                    @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                        <a href="{{route('master-course-panel',['course_id'=>base64_encode($data['id'])])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center animated-button"><i class="bi bi-play-circle btn-outline-primary fs-3 playbtniconstyle"></i> Play </a>
                                                    @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                                        <a href="{{route('master-course-panel',['course_id'=>base64_encode($data['id'])])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center animated-button"><i class="bi bi-play-circle btn-outline-primary fs-3 playbtniconstyle"></i> Play </a>
                                                    @else
                                                    <form action="{{ route('checkout') }}" method="post">
                                                        @csrf <!-- CSRF protection -->
                                                        @php 
                                                            $total_full_price = $data['course_old_price'] - ($data['course_old_price'] - $data['course_final_price']); 
                                                        @endphp
                                                        <input type='hidden' value="{{base64_encode($data['id'])}}" name="course_id" id="course_id">
                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($data['course_old_price'])}}">
                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($data['course_old_price']-$data['course_final_price'])}}">
                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                        <div class="d-grid">
                                                            <button class="btn btn-primary mb-2 color-green fs-4">Buy Course</button>
                                                        </div>
                                                    </form>
                                                    <div class="d-grid">
                                                        <a href="#" class="btn btn-outline-primary addtocart coursedetailshoppingcarticon" id="addtocart" data-course-id="{{base64_encode($data['id'])}}" data-action="{{base64_encode('add')}}"><i class="fe fe-shopping-cart"></i> Add to Cart</a>
                                                    </div>
                                                    @endif      
                                            @else
                                                <form action="{{ route('checkout') }}" method="post">
                                                    @csrf <!-- CSRF protection -->
                                                    @php 
                                                        $total_full_price = $data['course_old_price'] - ($data['course_old_price'] - $data['course_final_price']); 
                                                    @endphp
                                                    <input type='hidden' value="{{base64_encode($data['id'])}}" name="course_id" id="course_id">
                                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($data['course_old_price'])}}">
                                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($data['course_old_price']-$data['course_final_price'])}}">
                                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                    <div class="d-grid">
                                                        <button class="btn btn-primary mb-2 color-green fs-4">Buy Course</button>
                                                    </div>
                                                </form>
                                                <div class="d-grid">
                                                    {{-- <a href="{{route('login')}}" class="btn btn-outline-primary"><i class="fe fe-shopping-cart text-primary"></i> Add to Cart</a> --}}
                                                    <a href="#" class="btn btn-outline-primary addtocart coursedetailshoppingcarticon" id="addtocart" data-course-id="{{base64_encode($data['id'])}}" data-action="{{base64_encode('add')}}"  data-withcart="withcart"><i class="fe fe-shopping-cart"></i> Add to Cart</a>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            
                            </div>
                        </div>
                    @else
                        @if (isset($data['trailer_thumbnail_file']) && !empty($data['trailer_thumbnail_file']))
                            <div class="card mb-3 mb-2 trailer_thumbnail_file_style">
                                <div class="p-1">
                                    <div class="d-flex justify-content-center cursor-pointer align-items-center rounded border-white border rounded-3 bg-cover"
                                        style="position: relative; overflow: hidden;">
                                        <img src="{{ Storage::url($data['trailer_thumbnail_file']) }}" alt="Trailer Thumbnail" 
                                            style="width: 100%; height: 100%; object-fit: cover;"/>
                                    </div>
                                </div>
                                <!-- Card body -->
                                <div class="card-body p-3">
                                    @if(isset($data['status']) && $data['status'] != '1')
                                        @if($data['course_final_price'] > 0)
                                            <div class="mb-3 text-center">
                                                <div class="text-dark fw-bold h2 color-blue">€{{isset($data['course_final_price']) ? htmlspecialchars($data['course_final_price']) : '' }}</div>
                                                @if(isset($data['course_old_price']) && $data['course_old_price'] > 0)<del class="fs-4">€{{isset($data['course_old_price']) ? htmlspecialchars($data['course_old_price']) : '' }}</del>
                                                <span class="course-off-discount">{{ (!empty($data['course_final_price']) && $data['course_final_price'] > 1) ? (isset($data['scholarship']) && $data['scholarship'] > 0 ? intval(round($data['scholarship'])).'%'.' Scholarship' : 'Scholarship') : 'Introductory Fees' }}</span>@endif
                                            </div>
                                            <div class="d-flex justify-content-center align-items-center">
                                                @php $promoCode = getCoursePromoCode($data['id']); @endphp
                                                @if($promoCode)
                                                    <small class="promo-code font-weight-bold text-primary rounded p-1" style="background: #dae138">
                                                    <span class="badge badge-success text-primary fs-5" ><span style="user-select: none">PROMO:</span> <span class="fw-bold">{{$promoCode}}</span></span>
                                                    </small>
                                                @endif
                                            </div>
                                            <br>
                                            <div class="d-grid">
                                                @if (Auth::check() && Auth::user()->role =='superadmin')
                                                    <a href="{{route('admin-master-course-panel',['course_id'=>base64_encode($data['id'])])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center animated-button"><i class="bi bi-play-circle btn-outline-primary fs-3 playbtniconstyle"></i> Play </a>
                                                @elseif (Auth::check() && Auth::user()->role =='admin')
                                                    <a href="{{route('admin-master-course-panel',['course_id'=>base64_encode($data['id'])])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center animated-button"><i class="bi bi-play-circle btn-outline-primary fs-3 playbtniconstyle"></i> Play </a>
                                                @elseif (Auth::check() && (Auth::user()->role =='instructor' || Auth::user()->role =='sub-instructor'))
                                                @elseif (Auth::check() && Auth::user()->role =='user')
                                                    @php
                                                        $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $data['id']]);
                                                    @endphp
                                                    {{-- @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0) --}}
                                                        @php
                                                            $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $data['id'],'is_deleted'=>'No'], "", 'created_at');
                                                        @endphp
                                                        @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                            <a href="{{route('master-course-panel',['course_id'=>base64_encode($data['id'])])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center animated-button"><i class="bi bi-play-circle btn-outline-primary fs-3 playbtniconstyle"></i> Play </a>
                                                        @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                                            <a href="{{route('master-course-panel',['course_id'=>base64_encode($data['id'])])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center animated-button"><i class="bi bi-play-circle btn-outline-primary fs-3 playbtniconstyle"></i> Play </a>
                                                        @else
                                                            <form action="{{ route('checkout') }}" method="post">
                                                                @csrf <!-- CSRF protection -->
                                                                @php 
                                                                    $total_full_price = $data['course_old_price'] - ($data['course_old_price'] - $data['course_final_price']); 
                                                                @endphp
                                                                <input type='hidden' value="{{base64_encode($data['id'])}}" name="course_id" id="course_id">
                                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($data['course_old_price'])}}">
                                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($data['course_old_price']-$data['course_final_price'])}}">
                                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                <div class="d-grid">
                                                                    <button class="btn btn-primary mb-2 color-green fs-4">Buy Course</button>
                                                                </div>
                                                            </form>
                                                            <div class="d-grid">
                                                                <a href="#" class="btn btn-outline-primary addtocart coursedetailshoppingcarticon" id="addtocart" data-course-id="{{base64_encode($data['id'])}}" data-action="{{base64_encode('add')}}"><i class="fe fe-shopping-cart"></i> Add to Cart</a>
                                                            </div>
                                                        @endif
                                                @else
                                                    <form action="{{ route('checkout') }}" method="post">
                                                        @csrf <!-- CSRF protection -->
                                                        @php 
                                                            $total_full_price = $data['course_old_price'] - ($data['course_old_price'] - $data['course_final_price']); 
                                                        @endphp
                                                        <input type='hidden' value="{{base64_encode($data['id'])}}" name="course_id" id="course_id">
                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($data['course_old_price'])}}">
                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($data['course_old_price']-$data['course_final_price'])}}">
                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                        <div class="d-grid">
                                                            <button class="btn btn-primary mb-2 color-green fs-4">Buy Course</button>
                                                        </div>
                                                    </form>
                                                    <a href="#" class="btn btn-outline-primary addtocart coursedetailshoppingcarticon" id="addtocart" data-course-id="{{base64_encode($data['id'])}}" data-action="{{base64_encode('add')}}"  data-withcart="withcart"><i class="fe fe-shopping-cart"></i> Add to Cart</a>
                                                @endif      
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                    <!-- Card -->
                    <div class="card mb-4">
                        <div>
                            <!-- Card header -->
                            <div class="card-header">
                                <h4 class="mb-0">What’s included</h4>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-transparent">
                                    <i class="fe fe-calendar  me-2 text-info"></i>No.of Modules:
                                    {{ isset($noofmodules) && $noofmodules > 0 ? $noofmodules : 'N/D'}}  
                                </li>
                                <li class="list-group-item bg-transparent">
                                    <div class="d-flex courseDuration">
                                        <div>  <i class="fe fe-calendar  me-2 text-info"></i>Duration: &nbsp;</div>
                                        @if(isset($data['full_time_duration_month']) && $data['full_time_duration_month'] > 0 && isset($data['duration_month']) && $data['duration_month'] > 0 )
                                        <div>
                                            Full Time- {{ isset($data['full_time_duration_month']) && $data['full_time_duration_month'] > 0 ?  $data['full_time_duration_month'].' Months' : 'N/D'}}  
                                            <br>
                                           <span style="white-space: nowrap"> Part Time- {{ isset($data['duration_month']) && $data['duration_month'] > 0  ?  $data['duration_month'].' Months' : 'N/D'}}  </span>
                                        </div>
                                        @else
                                        {{-- {{ isset($data['duration_month']) && $data['duration_month'] > 0 ?  $data['duration_month'] .' Months' : 'N/D'}} --}}
                                        {{ ($data['duration_month'] ?? 0) > 0 
                                        ? $data['duration_month'] . ' Months' 
                                        : (($data['full_time_duration_month'] ?? 0) > 0 
                                            ? $data['full_time_duration_month'] . ' Months' 
                                            : 'N/D')  }}

                                        @endif
                                    </div>
                                
                                    

                                </li>
                                {{-- <li class="list-group-item bg-transparent">
                                    <i class="fe fe-book  me-2 text-success"></i>Lectures:
                                    {{ isset($data['total_lectures']) && $data['total_lectures'] > 0 ?  $data['total_lectures'] : 'N/D'}} 
                                </li> --}}
                                <li class="list-group-item bg-transparent">
                                    <i class="fe fe-play-circle  me-2 text-primary"></i>Learning:
                                   {{isset($data['total_learning']) && $data['total_learning'] > 0 ?  $data['total_learning'].'+ Hours' : 'N/D'}} 
                                </li> 
                                <li class="list-group-item bg-transparent">
                                    <i class="fe fe-award me-2  text-danger"></i>Blockchain Certificates
                                    <!-- tooltip on top -->
                                    {{-- <i class="fe fe-info me-2  text-grey" data-bs-toggle="tooltip"
                                        data-placement="top"
                                        title="Certificate of Attendance OR MQF/EQF Certificate"></i> --}}
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="card">
                        @php $t=1; @endphp
                        @if (isset($data['lecturer_id']) && !empty($data['lecturer_id']) )
                        <div class="card">

                            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">

                                <div class="carousel-inner">

                                 @if (isset($data['lecturer_id']) && !empty($data['lecturer_id']) )
                                  @php

                                    $implodeLecturer = explode(",",$data['lecturer_id']);

                                  @endphp


                               
                                  @foreach($implodeLecturer as $key => $lecturesId)

                                  @php $show = '' @endphp
                                    @if($key == 0)
                                    @php $show = 'active' @endphp
                                  @endif

                                  @php

                                  $id = base64_decode($lecturesId);

                                  $lecData = getData('lecturers_master',['lactrure_name','discription','designation','image'],['id'=>$id,'is_deleted'=>'No','status'=>'0']);
                                    
                                  @endphp

                                  @if (isset($lecData[0]->lactrure_name) && !empty($lecData[0]->lactrure_name) )

                                    <div class="carousel-item {{$show}}" data-bs-interval="3000">

                                        <div class="card-body">

                                            <div class="d-flex align-items-center">

                                                <div class="position-relative">

                                                    <img src="{{ !empty($lecData[0]->image) && Storage::exists($lecData[0]->image) ? Storage::url($lecData[0]->image) : Storage::url('instructor_no_img.jpg')}}"

                                                        alt="avatar" class="rounded-circle avatar-xl">

                                                    <a href="#" class="position-absolute mt-2 ms-n3"

                                                        data-bs-toggle="tooltip" data-placement="top" title="Verified">

                                                        <img src="{{ asset('frontend/images/svg/checked-mark.svg') }}"

                                                            alt="checked-mark" height="30" width="30">

                                                    </a>

                                                </div>

                                                <div class="ms-4">

                                                    <h4 class="mb-0">{{isset($lecData[0]->lactrure_name) ?  $lecData[0]->lactrure_name : ''}}</h4>

                                                    <p class="mb-1 fs-6">{{isset($lecData[0]->designation) ?  htmlspecialchars_decode($lecData[0]->designation) : ''}}</p>

                                                </div>

                                            </div>

                                            <div class="border-top row pt-2 pb-3 mt-3 g-0">

                                                <div class="col">

                                                   <?php echo isset($lecData[0]->discription) ? htmlspecialchars_decode($lecData[0]->discription) : '' ?>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                  @endif
                                  @php $t++; @endphp
                                  @endforeach
                                  @else

                                    <div class="carousel-item {{$show}}" data-bs-interval="3000">

                                        <div class="card-body">

                                            <div class="d-flex align-items-center">

                                                <div class="position-relative">

                                                    <img src="{{ Storage::url('instructor_no_img.jpg')}}"

                                                        alt="avatar" class="rounded-circle avatar-xl">

                                                    <a href="#" class="position-absolute mt-2 ms-n3"

                                                        data-bs-toggle="tooltip" data-placement="top" title="Verified">

                                                        <img src="{{ asset('frontend/images/svg/checked-mark.svg') }}"

                                                            alt="checked-mark" height="30" width="30">

                                                    </a>

                                                </div>

                                                <div class="ms-4">

                                                    <h4 class="mb-0">{{ 'Instructor Not Available'}}</h4>

                                                    <p class="mb-1 fs-6">Lecturer</p>

                                                </div>

                                            </div>

                                            <div class="border-top row pt-2 pb-3 mt-3 g-0">

                                                <div class="col">

                                                  

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                 @endif

                                </div>
                                @if($t > 2)
                                <div class="d-flex justify-content-center main-carousel gap-3 mb-2">

                                    <button class="carousel-control-prev" type="button"

                                        data-bs-target="#carouselExample" data-bs-slide="prev">

                                        <span class="left-icon"><i class="bi bi-chevron-left"></i></span>

                                        <span class="visually-hidden">Previous</span>

                                    </button>

                                    <button class="carousel-control-next" type="button"

                                        data-bs-target="#carouselExample" data-bs-slide="next">

                                        <span class="right-icon"><i class="bi bi-chevron-right"></i></span>

                                        <span class="visually-hidden">Next</span>

                                    </button>

                                </div>
                                @endif

                            </div>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
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
    </section>
</main>





@endsection