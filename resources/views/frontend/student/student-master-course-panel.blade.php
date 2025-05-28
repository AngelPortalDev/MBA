@extends('frontend.master')
@section('content')


  <style>
         #pdfDisply {
        /* pointer-events: none; */
    }
    canvas {
            display: flex;
            justify-content: center;
            margin: 0 auto;
            height: auto;
            overflow: scroll !important;
        }
    .button-wrapper{
        display: flex;
        flex-direction: row-reverse;
        justify-content: space-between;
    }
    .studentAwardCourseTitle.active {
        color: #122c78;
        font-weight: 600;
        background-color: #eeedff;
        padding: 3px;
        border-radius: 5px;
    }
    .studentAwardCourseTitle{
        padding: 3px;
    }
    </style>

<!-- Wrapper -->

<?php $DocumentVerified = ''; ?>
@php
    $doc_verified = getData('student_doc_verification',['english_score','identity_is_approved','edu_is_approved','identity_doc_file','edu_doc_file','resume_file','edu_trail_attempt','identity_trail_attempt','english_test_attempt'],['student_id'=>Auth::user()->id]);
@endphp 
@if($doc_verified[0]->identity_is_approved == "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->resume_file != '' && $doc_verified[0]->english_score >= 10)
    @php $DocumentVerified = "";  @endphp
@elseif(($doc_verified[0]->identity_is_approved == "Reject" && $doc_verified[0]->identity_trail_attempt == 0 ) || ($doc_verified[0]->edu_is_approved == "Reject" && $doc_verified[0]->edu_trail_attempt == 0))
    @php $DocumentVerified = "";   @endphp
@elseif($doc_verified[0]->english_test_attempt == "1" && $doc_verified[0]->english_score <= 10)
    @php $DocumentVerified = "englishVerified";   @endphp
@elseif($doc_verified[0]->english_test_attempt == "0" && $doc_verified[0]->english_score <= 10)
    @php $DocumentVerified = "englishAttempt";   @endphp
@elseif($doc_verified[0]->edu_doc_file != "" && $doc_verified[0]->identity_doc_file != "" &&  $doc_verified[0]->resume_file != '' && $doc_verified[0]->english_score != '')
    @php $DocumentVerified = ""; @endphp
@else
    @php $DocumentVerified = "NotVerified"; @endphp
@endif

<div id="db-wrapper" class="course-video-player-page toggled" onbeforeunload="return myFunction()">
    <!-- Sidebar -->
    <nav class="navbar-vertical navbar bg-white customeNavbar">
        <div class="mobileviewsection" data-simplebar>
            <section class="card " id="courseAccordion">
                <!-- List group -->
                <ul class="list-group list-group-flush" style="height: 850px" data-simplebar="init">
                    <div class="simplebar-wrapper" style="margin: 0px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                    aria-label="scrollable content"
                                    style="height: 100%; overflow-y:auto; overflow-x:hidden !important;">
                                    <div class="simplebar-content student-award-panel-scrollbar" style="padding: 0px;">
                                         @php
                                                $courseName = '';
                                                if (
                                                    isset($course_id) &&
                                                    !empty($course_id)
                                                ) {
                                                    $course_id = $course_id;
                                                    $course = getData(
                                                        'course_master',
                                                        ['course_title', 'id'],
                                                        ['id' => $course_id, 'is_deleted' => 'No'],
                                                    );
                                                    $courseName = isset($course[0]->course_title)
                                                        ? $course[0]->course_title
                                                        : '';
                                                        
                                                    $masterCourseId = isset($course[0]->course_title)
                                                        ? $course[0]->id
                                                        : '';
                                                }
                                                
                                                $CourseWatchData = getData('student_course_master',['watch_content_id','course_progress'],['user_id'=>auth()->user()->id,'course_id'=>$course_id],'','id','DESC');

                                                $CourseIconData = getData('student_course_master',['watch_content_id','id'],['user_id'=>auth()->user()->id,'course_id'=>$course_id],'','id','DESC'); 
                                            @endphp

                                            <li class="list-group-item">
                                                <h3 class="mb-0 color-blue" style="font-size: 18px">{{htmlspecialchars_decode($courseName)}}</h3>
                                            
                                            <div class="mb-3 mt-3">
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated total_progress_display_value"
                                                        role="progressbar"
                                                        value="";
                                                        style="width:{{ isset($CourseWatchData[0]->course_progress)  ?  $CourseWatchData[0]->course_progress.'%' : ''}} "
                                                        aria-valuenow="10"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100">
                                                    </div>
                                                </div>
                                                <small class="total_progress_display_complete"> {{ isset($CourseWatchData[0]->course_progress)  ?  $CourseWatchData[0]->course_progress : '0'}} %
                                                    Completed</small>
                                            </div> 
                                            </li>
                                        @php $i=1; $totalProgress = 0; @endphp
                                        @foreach ($MasterCourseData as  $masterdata)
                                            {{-- @php dd($masterdata['coursemodules'][0]['id']); @endphp --}}
                                        <!-- List group item -->

                                        @php 
                                       

                                        $sectionData = getData('course_managment_master', ['section_id'], ['course_master_id' => $masterdata['coursemodules'][0]['id'], 'is_deleted' => 'No'],'','id','ASC');
                                        if (isset($sectionData[0]->section_id)) {
                                            $VideoData = getData('course_modules_videos', ['bn_collection_id', 'bn_video_url_id', 'video_title', 'id', 'video_duration'], ['section_id' => $sectionData[0]->section_id, 'is_deleted' => 'No']);
                                        }
                                        

                                        @endphp
                                
                                        <ul class="list-group-item">
                                            <!-- Toggle -->
                                            <a class="d-flex align-items-center h4 mb-0" data-bs-toggle="collapse"
                                                href="#course{{$i}}" role="button" aria-expanded="{{ $i == 1 ? 'true' : 'false'}}"
                                                aria-controls="course{{$i}}">
                                                <div class="me-auto accrodanTitle" style="font-size: 15px">{{htmlspecialchars_decode($masterdata['coursemodules'][0]['course_title'])}}</div>
                                                <!-- Chevron -->
                                                <span class="chevron-arrow ms-4">
                                                    <i class="fe fe-chevron-down fs-4"></i>
                                                </span>
                                            </a>
                                        {{-- </li> --}}
                                            <!-- Row -->
                                            <!-- Collapse -->
                                       
                                            
                                            <div class="collapse {{ $i == 1 ? 'show' : 'hide'}}" id="course{{$i}}" data-bs-parent="#courseAccordion">
                                                <div class="py-3 nav" id="course-tabOne" role="tablist"
                                                    aria-orientation="vertical" style="display: inherit">
                                                    
                                                    {{-- <div class="mb-3">
                                                        <div class="progress" style="height: 6px">
                                                            <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated total_progress_display_value"
                                                                role="progressbar"
                                                                value="";
                                                                style="width:{{ isset($CourseWatchData[0]->course_progress)  ?  $CourseWatchData[0]->course_progress.'%' : ''}} "
                                                                aria-valuenow="10"
                                                                aria-valuemin="0"
                                                                aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                        <small class="total_progress_display_complete"> {{ isset($CourseWatchData[0]->course_progress)  ?  $CourseWatchData[0]->course_progress : '0'}} %
                                                            Completed</small>
                                                    </div> --}}
                                                    @php $j =0; @endphp
                                                    
                                                    <div class="accordion" id="sectionAccordion{{$i}}">
                                                        @php 
                                                        $quizsteper = 1;
                                                       
                                                        @endphp
                                                        @foreach ($masterdata['course_manage'] as  $sections)
                                                        <li class="list-group-item">
                                                        <a class="mb-0 justify-content-between align-items-center text-inherit d-flex"
                                                            data-bs-toggle="collapse"
                                                            href="#course_section{{ $j }}" role="button"
                                                            aria-expanded="{{ $i === 1 && $j === 0 ? 'true' : 'false' }}"
                                                            aria-controls="course_section{{ $j }}">
                                                            <div class="me-auto ms-1 accrodanTitle d-inline-block h3" style="font-size: 14px; color: #1E293B">
                                                                {{ isset($sections['sections'][0]['section_name']) ? htmlspecialchars_decode($sections['sections'][0]['section_name']) :'' }}
                                                            </div>
                                                            <!-- Chevron -->
                                                            <span class="chevron-arrow ms-4">
                                                                <i class="fe fe-chevron-down fs-4"></i>
                                                            </span>
                                                        </a>
                                                        
                                                        <div class="collapse {{ $i === 1 && $j === 0 ? 'show' : '' }}" id="course_section{{ $j }}"
                                                                data-bs-parent="#sectionAccordion{{$i}}">
                                                                <div class="pt-3 nav" id="course-tab{{ $j }}" role="tablist" aria-orientation="vertical" style="display: inherit">
                                                                    @php $k =0;@endphp
                                                                    @if ((isset($sections['sections'][0]['section_manage']) && is_array($sections['sections'][0]['section_manage'])))
                                                                    @foreach ($sections['sections'][0]['section_manage'] as $key => $section_manage)
                                                                        @if (!empty($section_manage['content_type_id']) && $section_manage['content_type_id'] === 1)
                                                                            @foreach ($section_manage['course_video'] as $video)
                                                                                <a class="mb-0 d-flex justify-content-between align-items-center text-inherit studentAwardCourseTitle tab-link {{ $k === 0 ?  'active' : '' }}" id="course-project-tab" data-bs-toggle="pill"  href="#course-project"  onclick="videoDisplay('{{ $video['bn_video_url_id'] }}','{{$video['id']}}','{{base64_encode($masterdata['coursemodules'][0]['id'])}}')"  role="tab" aria-controls="course-project" aria-selected="false">
                                                                                    <div class="d-flex align-items-center">
                                                                                        <span class="icon-shape bg-green text-primary icon-sm rounded-circle me-2">
                                                                                            {{-- @php $CourseProgressData = getData('video_progress',['full_check'],['video_id'=>$video['id'],'course_id' => $masterdata['coursemodules'][0]['id'],'user_id'=>auth()->user()->id,'student_course_master_id'=>$CourseIconData[0]->id]);@endphp
                                                                                            @if(!empty($CourseProgressData[0]))
                                                                                                @if($CourseProgressData[0]->full_check == 'Yes')
                                                                                                    <i id="play-pause-icon-{{ $video['id'] }}" class="bi bi-check2 playIconStudentCoursePanel"></i>
                                                                                                @else
                                                                                                    <i id="play-pause-icon-{{ $video['id'] }}" class="bi bi-play-fill playIconStudentCoursePanel"></i>
                                                                                                @endif
                                                                                            @else  --}}
                                                                                                <i id="play-pause-icon-{{ $video['id'] }}" class="bi bi-play-fill playIconStudentCoursePanel"></i>
                                                                                            {{-- @endif --}}
                                                                                        </span>
                                                                                        <div class="ms-1">
                                                                                            <span class="d-inline-block preview-course-heading" style="font-size: 13px">{{ isset($video['video_title']) ? htmlspecialchars_decode($video['video_title']) : '' }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                                <div class="text-muted mb-2" style="margin-left: 2.8rem;">
                                                                                    <p class="preview-course-heading" style="font-size: 13px">{{$video['video_duration']}}</p>
                                                                                </div>
                                                                                @php $totalProgress++; @endphp
                                                                            @endforeach
                                                                        @elseif(!empty($section_manage['content_type_id']) && $section_manage['content_type_id'] === 2)
                                                                            @foreach ($section_manage['course_article'] as $docs)
                                                                                @php $extensionFile = pathinfo( $docs['doc_file_name']); @endphp
                                                                                @if(!empty($extensionFile['extension']))
                                                                                @if($extensionFile['extension']  == 'xls' || $extensionFile['extension']  == 'xlsx')
                                                                                <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit studentAwardCourseTitle tab-link"
                                                                                    id="resource-excel-tab"
                                                                                    data-bs-toggle="pill"
                                                                                    onclick="ExcelContentDisplay('{{ $docs['file'] }}','{{ $docs['docs_title'] }}','{{$docs['id']}}','{{ $docs['doc_file_name'] }}','{{base64_encode($masterdata['coursemodules'][0]['id'])}}')"
                                                                                    href="#resource-excel"
                                                                                    role="tab"
                                                                                    aria-controls="resource-excel"
                                                                                    aria-selected="false">
                                                                                    <div class="d-flex align-items-center">
                                                                                        <span
                                                                                            class="icon-shape text-primary icon-sm rounded-circle me-2 bg-green">
                                                                                            @if(!empty($CourseIconData[0]->watch_content_id))
                                                                                            @php  $Watcharray = explode(",", $CourseIconData[0]->watch_content_id); @endphp
                                                                                                @if (in_array('do_'.$docs['id'], $Watcharray))
                                                                                                    <i id="play-pause-icon-{{ $docs['id'] }}" data-filetype="excel"
                                                                                                    class="bi bi-check2 nav-icon fs-6 color-blue playIconStudentCoursePanel"></i>
                                                                                                @else
                                                                                                    <i id="play-pause-icon-{{ $docs['id'] }}" data-filetype="excel" class="bi bi-filetype-exe nav-icon fs-6 color-blue playIconStudentCoursePanel"></i>
                                                                                                @endif
                                                                                            @else
                                                                                                <i id="play-pause-icon-{{ $docs['id'] }}" data-filetype="excel"
                                                                                                    class="bi bi-filetype-exe nav-icon fs-6 color-blue playIconStudentCoursePanel"></i>
                                                                                            @endif
                                                                                        </span>
                                                                                    
                                                                                        <span class="d-inline-block preview-course-heading" style="font-size: 13px">{{ isset($docs['docs_title']) ? htmlspecialchars_decode($docs['docs_title']) : '' }}</span>
                                                                                    </div>
                                                                                    <div class="text-truncate">
                                                                                        {{-- <span></span> --}}
                                                                                    </div>
                                                                                </a>
                                                                                
                                                                                @else
                                                                                <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit studentAwardCourseTitle tab-link"
                                                                                id="resource-tab" data-bs-toggle="pill" onclick="PdfContentDisplay('{{ $docs['file'] }}','{{ $docs['docs_title'] }}','{{$docs['id']}}','{{base64_encode($masterdata['coursemodules'][0]['id'])}}')"  href="#resource" role="tab"  aria-controls="resource"  aria-selected="false">
                                                                                    <div class="d-flex align-items-center">
                                                                                        <span
                                                                                            class="icon-shape text-primary icon-sm rounded-circle me-2 bg-green">
                                                                                            @if(!empty($CourseIconData[0]->watch_content_id))
                                                                                            @php  $Watcharray = explode(",", $CourseIconData[0]->watch_content_id); @endphp
                                                                                                @if (in_array('pd_'.$docs['id'], $Watcharray))
                                                                                                    <i id="play-pause-icon-{{ $docs['id'] }}" data-filetype="pdf"
                                                                                                    class="bi bi-check2 nav-icon fs-6 color-blue playIconStudentCoursePanel"></i>
                                                                                                @else
                                                                                                    <i id="play-pause-icon-{{ $docs['id'] }}" data-filetype="pdf" class="bi bi-file-earmark-pdf nav-icon fs-6 color-blue playIconStudentCoursePanel"></i>
                                                                                                @endif
                                                                                            @else
                                                                                                <i id="play-pause-icon-{{ $docs['id'] }}" data-filetype="pdf"
                                                                                                class="bi bi-file-earmark-pdf nav-icon fs-6 color-blue playIconStudentCoursePanel"></i>
                                                                                            @endif
                                                                                        </span>
                                                                                        <span class="d-inline-block preview-course-heading" style="font-size: 13px">{{ isset($docs['docs_title']) ? htmlspecialchars_decode($docs['docs_title']) : '' }}</span>
                                                                                    </div>
                                                                                    <div class="text-truncate">
                                                                                        {{-- <span></span> --}}
                                                                                    </div>
                                                                                </a>

                                                                                @endif
                                                                                @endif
                                                                                @php $totalProgress++; @endphp
                                                                            @endforeach
                                                                        @elseif(!empty($section_manage['content_type_id']) && $section_manage['content_type_id'] === 3)
                                                                    
                                                                            @foreach ($section_manage['course_quiz'] as $quiz)
                                                                                <a class="mb-2 d-flex justify-content-between align-items-center text-inherit quizActive studentAwardCourseTitle tab-link"
                                                                                    id="quiz-tab"
                                                                                    data-quiz_id="{{base64_encode($section_manage['content_id'])}}"
                                                                                    data-course_id="{{base64_encode($course_id)}}"
                                                                                    data-bs-toggle="pill"
                                                                                    href="javascript:void(0);" role="tab"
                                                                                    aria-controls="quiz"
                                                                                    aria-selected="false">
                                                                                    <div class="text-truncate">
                                                                                        <span 
                                                                                            class="icon-shape text-primary icon-sm rounded-circle me-2 color-light-cyan bg-green">
                                                                                            @if(!empty($CourseIconData[0]->watch_content_id))
                                                                                            @php  $Watcharray = explode(",", $CourseIconData[0]->watch_content_id); @endphp
                                                                                            @if (in_array('qu_'.$section_manage['content_id'], $Watcharray))
                                                                                                <i id="play-pause-icon-{{ $section_manage['content_id'] }}" data-filetype="quiz" class="bi bi-check2 nav-icon fs-6 color-blue playIconStudentCoursePanel"></i>
                                                                                            @else
                                                                                                <i id="play-pause-icon-{{ $section_manage['content_id'] }}" class="fe fe-help-circle nav-icon fs-6 color-primary playIconStudentCoursePanel" data-filetype="quiz"></i>
                                                                                            @endif
                                                                                        @else
                                                                                            <i id="play-pause-icon-{{ $section_manage['content_id'] }}" data-filetype="quiz"
                                                                                            class="fe fe-help-circle nav-icon fs-6 color-primary playIconStudentCoursePanel"></i>
                                                                                        @endif
                                                                                        </span>
                                                                                        <span class="text-inherit preview-course-heading" style="font-size: 13px">Quiz : {{htmlspecialchars_decode($quiz['quiz_tittle'])}}</span>
                                                                                        
                                                                                    </div>
                                                                                    <div class="text-truncate">
                                                                                        <span></span>
                                                                                    </div>
                                                                                </a>
                                                                                @php  $quizsteper ++;@endphp
                                                                                @php $totalProgress++; @endphp
                                                                            @endforeach
                                                                        @endif
                                                                    @php $k++; @endphp
                                                                    @endforeach
                                                                    @endif
                                                                </div>
                                                        </div>
                                                        </li>
                                                        {{-- <hr> --}}
                                                        @php $j++; @endphp
                                                        @endforeach
                                                    </div>
                                                   {{-- <a class="mb-2 d-flex justify-content-between align-items-center text-inherit"
                                                        id="course-development-tab" data-bs-toggle="pill"
                                                        href="#course-development" role="tab"
                                                        aria-controls="course-development" aria-selected="false">
                                                        <div class="text-truncate">
                                                            <span
                                                                class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 bg-blue"><i
                                                                    class=""></i></span>
                                                            <span class="preview-course-heading">Installing Development
                                                                Software</span>
                                                        </div>
                                                        <div class="text-truncate">
                                                            <span>3m 11s</span>
                                                        </div>
                                                    </a>
                                                    <a class="mb-2 d-flex justify-content-between align-items-center text-inherit"
                                                        id="course-project-tab" data-bs-toggle="pill"
                                                        href="#course-project" role="tab" aria-controls="course-project"
                                                        aria-selected="false">
                                                        <div class="text-truncate">
                                                            <span
                                                                class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 bg-blue"><i
                                                                    class=""></i></span>
                                                            <span class="preview-course-heading">Installing Development
                                                                Software</span>
                                                        </div>
                                                        <div class="text-truncate">
                                                            <span>3m 11s</span>
                                                        </div>
                                                     </a>
                                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit"
                                                        id="course-website-tab" data-bs-toggle="pill"
                                                        href="#course-website" role="tab" aria-controls="course-website"
                                                        aria-selected="false">
                                                        <div class="text-truncate">
                                                            <span
                                                                class="icon-shape bg-light text-primary icon-sm rounded-circle me-2"><i
                                                                    class="fe fe-play fs-6"></i></span>
                                                            <span>Our Sample Website</span>
                                                        </div>
                                                        <div class="text-truncate">
                                                            <span>2m 15s</span>
                                                        </div>
                                                    </a>


                                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit"
                                                        id="quiz-1-tab" data-bs-toggle="pill" href="#quiz-1" role="tab"
                                                        aria-controls="quiz-1" aria-selected="false">
                                                        <div class="text-truncate">
                                                            <span
                                                                class="icon-shape text-primary icon-sm rounded-circle me-2 color-light-cyan">
                                                                <i
                                                                    class="fe fe-help-circle nav-icon fs-6 color-cyan"></i></span>
                                                            <span class="color-cyan">Quiz 1</span>
                                                        </div>
                                                        <div class="text-truncate">
                                                            <span>20 Min</span>
                                                        </div>
                                                    </a>
                                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit"
                                                        id="resource-tab" data-bs-toggle="pill" href="#resource"
                                                        role="tab" aria-controls="resource" aria-selected="false">
                                                        <div class="text-truncate">
                                                            <span
                                                                class="icon-shape text-primary icon-sm rounded-circle me-2 bg-light">
                                                                <i class="fe fe-book nav-icon fs-6"></i></span>
                                                            <span class="">Journal Article</span>
                                                        </div>
                                                        <div class="text-truncate">
                                                            <span>20 Min</span>
                                                        </div>
                                                    </a> --}}

                                                </div>
                                            </div>
                                        </ul>
                                        @php $i++; @endphp
                                        @endforeach
                                        <div class="progress_count" data-progress="{{$totalProgress}}"></div>


                                        {{-- <li class="list-group-item">
                                            <!-- Toggle -->
                                            <a class="h4 mb-0 d-flex align-items-center active"
                                                data-bs-toggle="collapse" href="#traningsection1" aria-expanded="false"
                                                aria-controls="traningsection1">
                                                <div class="me-auto mt-3">Award Training and developmnet
                                                    <span class="mb-0 fs-6 mt-1 fw-normal">(6 ECTS) (150 Hours) </span>
                                                </div>
                                                <!-- Chevron -->
                                                <span class="chevron-arrow ms-4">
                                                    <i class="fe fe-chevron-down fs-4"></i>
                                                </span>
                                            </a>
                                            <!-- Collapse -->
                                            <div class="collapse " id="traningsection1"
                                                data-bs-parent="#courseAccordion">
                                                <div class="pt-3 pb-2">
                                                    <!-- Submenu for Recruitment and Employee Selection -->
                                                    <div class="accordion" id="sectionAccordion">
                                                        <div>
                                                            <!-- List group -->
                                                            <ul class="list-group list-group-flush">
                                                                <div class="mb-2">
                                                                    <div class="progress" style="height: 6px">
                                                                        <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated"
                                                                            role="progressbar" style="width: 0%"
                                                                            aria-valuenow="10" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small>0% Completed</small>
                                                                </div>
                                                                <li class="list-group-item px-0">
                                                                    <!-- Toggle -->
                                                                    <a class="h5 mb-0 d-flex align-items-center active"
                                                                        data-bs-toggle="collapse" href="#subsection1"
                                                                        aria-expanded="true"
                                                                        aria-controls="subsection1">
                                                                        <div class="me-auto">Training section 1
                                                                        </div>
                                                                        <!-- Chevron -->
                                                                        <span class="chevron-arrow ms-4">
                                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                                        </span>
                                                                    </a>
                                                                    <!-- Collapse -->
                                                                    <div class="collapse" id="subsection1"
                                                                        data-bs-parent="#sectionAccordion">
                                                                        <div class="pt-3 pb-2">

                                                                            <!-- Submenu items -->
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="icon-shape bg-blue icon-sm rounded-circle me-2">
                                                                                        <i
                                                                                            class="bi bi-check2 color-green fs-4 fw-bold"></i>
                                                                                    </span>
                                                                                    <span
                                                                                        class="preview-course-heading">Introduction</span>

                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>1m 7s</span>
                                                                                </div>
                                                                            </a>
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="icon-shape bg-blue icon-sm rounded-circle me-2">

                                                                                        <i
                                                                                            class="bi bi-file-pdf color-green"></i>
                                                                                    </span>
                                                                                    <span
                                                                                        class="preview-course-heading">Installing
                                                                                        Development Software</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>3m 11s</span>
                                                                                </div>
                                                                            </a>
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="icon-shape bg-light icon-sm bg-blue rounded-circle me-2">
                                                                                        <i
                                                                                            class="bi bi-play-fill color-green"></i>
                                                                                    </span>
                                                                                    <span
                                                                                        class="preview-course-heading">Hello
                                                                                        World Project from GitHub</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>2m 33s</span>
                                                                                </div>
                                                                            </a>
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                        <i class="fe fe-lock"></i>
                                                                                    </span>
                                                                                    <span>Our Sample Website</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>2m 15s</span>
                                                                                </div>
                                                                            </a>
                                                                            <a href="course-resume.html"
                                                                                class="d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="icon-shape bg-light icon-sm rounded-circle me-2">
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
                                                                    <a class="h5 mb-0 d-flex align-items-center active"
                                                                        data-bs-toggle="collapse"
                                                                        href="#trainingsubsection2" aria-expanded="true"
                                                                        aria-controls="trainingsubsection2">
                                                                        <div class="me-auto">Training section 2
                                                                        </div>
                                                                        <!-- Chevron -->
                                                                        <span class="chevron-arrow ms-4">
                                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                                        </span>
                                                                    </a>
                                                                    <!-- Collapse -->
                                                                    <div class="collapse" id="trainingsubsection2"
                                                                        data-bs-parent="#sectionAccordion">
                                                                        <div class="pt-3 pb-2">

                                                                            <!-- Submenu items -->
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="preview-course-heading">Introduction</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>1m 7s</span>
                                                                                </div>
                                                                            </a>
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="preview-course-heading">Installing
                                                                                        Development Software</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>3m 11s</span>
                                                                                </div>
                                                                            </a>
                                                                            <!-- Add more submenu items here -->
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item px-0">
                                                                    <!-- Toggle -->
                                                                    <a class="h5 mb-0 d-flex align-items-center active"
                                                                        data-bs-toggle="collapse"
                                                                        href="#trainingsubsection3" aria-expanded="true"
                                                                        aria-controls="trainingsubsection3">
                                                                        <div class="me-auto">Training section 3
                                                                        </div>
                                                                        <!-- Chevron -->
                                                                        <span class="chevron-arrow ms-4">
                                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                                        </span>
                                                                    </a>
                                                                    <!-- Collapse -->
                                                                    <div class="collapse" id="trainingsubsection3"
                                                                        data-bs-parent="#sectionAccordion">
                                                                        <div class="pt-3 pb-2">

                                                                            <!-- Submenu items -->
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="preview-course-heading">Introduction</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>1m 7s</span>
                                                                                </div>
                                                                            </a>
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="preview-course-heading">Installing
                                                                                        Development Software</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>3m 11s</span>
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
                                        </li>
                                        <li class="list-group-item">
                                            <!-- Toggle -->
                                            <a class="h4 mb-0 d-flex align-items-center active"
                                                data-bs-toggle="collapse" href="#devsection" aria-expanded="false"
                                                aria-controls="devsection">
                                                <div class="me-auto mt-3">Professional Development
                                                    <span class="mb-0 fs-6 mt-1 fw-normal">(12 ECTS) (150 Hours) </span>
                                                </div>
                                                <!-- Chevron -->
                                                <span class="chevron-arrow ms-4">
                                                    <i class="fe fe-chevron-down fs-4"></i>
                                                </span>
                                            </a>
                                            <!-- Collapse -->
                                            <div class="collapse " id="devsection" data-bs-parent="#courseAccordion2">
                                                <div class="pt-3 pb-2">
                                                    <!-- Submenu for Recruitment and Employee Selection -->
                                                    <div class="accordion" id="sectionAccordion2">
                                                        <div>
                                                            <!-- List group -->
                                                            <ul class="list-group list-group-flush">
                                                                <div class="mb-2">
                                                                    <div class="progress" style="height: 6px">
                                                                        <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated"
                                                                            role="progressbar" style="width: 0%"
                                                                            aria-valuenow="10" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small>0% Completed</small>
                                                                </div>
                                                                <li class="list-group-item px-0">
                                                                    <!-- Toggle -->
                                                                    <a class="h5 mb-0 d-flex align-items-center active"
                                                                        data-bs-toggle="collapse" href="#devsection1"
                                                                        aria-expanded="true"
                                                                        aria-controls="devsection1">
                                                                        <div class="me-auto">Development section 1
                                                                        </div>
                                                                        <!-- Chevron -->
                                                                        <span class="chevron-arrow ms-4">
                                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                                        </span>
                                                                    </a>
                                                                    <!-- Collapse -->
                                                                    <div class="collapse" id="devsection1"
                                                                        data-bs-parent="#sectionAccordion2">
                                                                        <div class="pt-3 pb-2">

                                                                            <!-- Submenu items -->
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="icon-shape bg-blue icon-sm rounded-circle me-2">
                                                                                        <i
                                                                                            class="bi bi-check2 color-green fs-4 fw-bold"></i>
                                                                                    </span>
                                                                                    <span
                                                                                        class="preview-course-heading">Introduction</span>

                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>1m 7s</span>
                                                                                </div>
                                                                            </a>
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="icon-shape bg-blue icon-sm rounded-circle me-2">

                                                                                        <i
                                                                                            class="bi bi-file-pdf color-green"></i>
                                                                                    </span>
                                                                                    <span
                                                                                        class="preview-course-heading">Installing
                                                                                        Development Software</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>3m 11s</span>
                                                                                </div>
                                                                            </a>
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="icon-shape bg-light icon-sm bg-blue rounded-circle me-2">
                                                                                        <i
                                                                                            class="bi bi-play-fill color-green"></i>
                                                                                    </span>
                                                                                    <span
                                                                                        class="preview-course-heading">Hello
                                                                                        World Project from GitHub</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>2m 33s</span>
                                                                                </div>
                                                                            </a>
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="icon-shape bg-light icon-sm rounded-circle me-2">
                                                                                        <i class="fe fe-lock"></i>
                                                                                    </span>
                                                                                    <span>Our Sample Website</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>2m 15s</span>
                                                                                </div>
                                                                            </a>
                                                                            <a href="course-resume.html"
                                                                                class="d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="icon-shape bg-light icon-sm rounded-circle me-2">
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
                                                                    <a class="h5 mb-0 d-flex align-items-center active"
                                                                        data-bs-toggle="collapse" href="#devsection2"
                                                                        aria-expanded="true"
                                                                        aria-controls="devsection2">
                                                                        <div class="me-auto">Development section 2
                                                                        </div>
                                                                        <!-- Chevron -->
                                                                        <span class="chevron-arrow ms-4">
                                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                                        </span>
                                                                    </a>
                                                                    <!-- Collapse -->
                                                                    <div class="collapse" id="devsection2"
                                                                        data-bs-parent="#sectionAccordion2">
                                                                        <div class="pt-3 pb-2">

                                                                            <!-- Submenu items -->
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="preview-course-heading">Introduction</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>1m 7s</span>
                                                                                </div>
                                                                            </a>
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="preview-course-heading">Installing
                                                                                        Development Software</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>3m 11s</span>
                                                                                </div>
                                                                            </a>
                                                                            <!-- Add more submenu items here -->
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item px-0">
                                                                    <!-- Toggle -->
                                                                    <a class="h5 mb-0 d-flex align-items-center active"
                                                                        data-bs-toggle="collapse" href="#devsection3"
                                                                        aria-expanded="true"
                                                                        aria-controls="devsection3">
                                                                        <div class="me-auto">Development section 3
                                                                        </div>
                                                                        <!-- Chevron -->
                                                                        <span class="chevron-arrow ms-4">
                                                                            <i class="fe fe-chevron-down fs-4"></i>
                                                                        </span>
                                                                    </a>
                                                                    <!-- Collapse -->
                                                                    <div class="collapse" id="devsection3"
                                                                        data-bs-parent="#sectionAccordion2">
                                                                        <div class="pt-3 pb-2">

                                                                            <!-- Submenu items -->
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="preview-course-heading">Introduction</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>1m 7s</span>
                                                                                </div>
                                                                            </a>
                                                                            <a href="course-resume.html"
                                                                                class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                <div class="text-truncate">
                                                                                    <span
                                                                                        class="preview-course-heading">Installing
                                                                                        Development Software</span>
                                                                                </div>
                                                                                <div class="text-truncate">
                                                                                    <span>3m 11s</span>
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
                                        </li> --}}
                                        <!-- List group item -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: 380px; height: 691px;"></div>
                    </div>
                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                    </div>
                    <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                    </div>
                </ul>
            </section>
        </div>
    </nav>
    <!-- Page Content -->
    <main id="page-content" style="width: 100%">
        <div class="header">
            <nav class="navbar-default navbar navbar-expand-lg p-0"
                style="background-color: #f1f5f9;box-shadow: none;">
                <a id="nav-toggle" href="#" class="color-blue fs-4">
                    <div class="desktop-button">
                        <button class="button is-text is-opened" id="menu-button" onclick="buttonToggle()">
                            <div class="button-inner-wrapper">
                                <i class="bi bi-x" style="font-size: x-large"></i>
                            </div>
                        </button>
                    </div>
                </a>                    
            </nav>
        </div>
        <!-- Page Header -->
        <!-- Container fluid -->
        <section class="container-fluid p-2">
            <div class="row">
                <div class="col-12">
                    <!-- Tab content -->
                    <div class="tab-content content" id="course-tabContent">
                        <div class="tab-pane fade  show active" id="course-project" role="tabpanel"
                            aria-labelledby="course-project-tab">
                            <!-- Video -->
                            <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0 "
                                style="height: 100%">
                                <div style="position:relative;height:88vh;background:#000;">
                                    <iframe id="videoDisply" loading="lazy" class=""
                                        style="border:0;top:0;left:0;height:100%;width:100%;"
                                        allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;"
                                        allowfullscreen="true"></iframe>
                                </div>
                            </div>
                        </div>
                        <!-- Quiz Tab pane -->
                      @include('frontend/student/part-quiz-award-course-panel',['QuizCourse'=>$MasterCourseData])
    
                        <!-- Resource 1 Tab pane -->
                        <div class="tab-pane fade" id="resource" role="tabpanel"
                            aria-labelledby="resource-tab">
                            <!-- Video -->
                            <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0 "
                                style="height: 100vh; overflow-y: auto">
                                <div style="text-align:center; height: 100% !important;" >
                                        <div id="pdfDisplay" style="height: 100%; overflow-y: auto"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="resource-excel" role="tabpanel"
                            aria-labelledby="resource-excel-tab">
                            <!-- Video -->
                            <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0"
                                style="height: 100vh">
                                <div  class="d-flex justify-content-center align-items-center h-100 flex-column">
                                    <h4>Please download the Excel file above to view its content.</h4>
                                    <a id="excelDisplay" class="btn btn-primary mt-2">Downlaod Excel File <i class="bi bi-download"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div>
            <h4 class="mt-0 course-selected-title" id="selected-title" style="padding-left: 24px; padding-bottom:0.9rem"></h4>
        </div>
</div>
</body>

</html>

<script src="{{ asset('frontend/js/examJs.js')}}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.7/plyr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.worker.min.js"></script>
<script>
    let playerInstance = null;
    let currentPauseIcon = null;
    // let stepper;
    let previousTabId = null; // Variable to store the previous tab ID
    // var totalProgress = $(".progress_count").data("progress");
    let currentVideoId = null; 


    function UploadDocument() {      
        swal({
            title: "Verification Process",
            text: "Please click on verify now to upload your Documents for verification and to proceed with the English Language Proficiency Test.",
            icon: "warning",
            buttons: true,
            buttons: ["Do later", "Verify now"], // Customize button names here
            dangerMode: true,
        }).then((willVerified) => {
            if (willVerified) {
                var baseUrl = window.location.origin;
                window.location.href =
                    baseUrl + "/student/student-document-verification";
            }
        });

    }
    function EnglishTest() {      
        swal({
            title: "English Test Failed",
            text: "You have one final attempt remaining to improve your score. Please review carefully and try again.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            buttons: ["Do later", "Start English Test"], // Customize button names here
        }).then((willVerified) => {
            if (willVerified) {
                var baseUrl = window.location.origin;
                window.location.href =
                    baseUrl + "/student/english-test";
            }
        });
    }
    function englishAttempt(){
        swal({
            title: "Your English Test has Failed",
            text: "All attempts have been used. You are no longer enrolled for the exam or certificate but can still access your course materials.",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "", // Text for the cancel button
                    value: null, // Return null if "Ok" is clicked
                    visible: false, // Ensure the button is visible
                    className: "", // Optional: add custom class
                    closeModal: true // Close the modal on click
                },
                confirm: {
                    text: "Ok", // Text for the confirmation button
                }
            },
            dangerMode: true,
        }).then((willVerified) => {
            if (willVerified) {
                window.location.refresh();
            }
        });
    }
    document.addEventListener("DOMContentLoaded", function() {
    
        var DocumentVerified = "<?php echo $DocumentVerified ?>";
        if (DocumentVerified == "NotVerified") { // Assuming isDocumentVerified is a boolean variable indicating document status.
            UploadDocument();
        }else if (DocumentVerified == "englishVerified") { // Assuming isDocumentVerified is a boolean variable indicating document status.
            EnglishTest();
        }else if(DocumentVerified == "englishAttempt"){
            englishAttempt();
        }
        
       
        var defaultVideoId = "<?php echo $VideoData[0]->bn_video_url_id;?>";
        var defaultId = "<?php echo $VideoData[0]->id;?>";
        var course_id= "<?php echo $masterdata['coursemodules'][0]['id'];?>";
        videoDisplay(defaultVideoId, defaultId);
        
    });
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    function videoDisplay(videoId,vid) {
        currentVideoId = videoId;
        var newUrl = "https://iframe.mediadelivery.net/embed/253882/" +
            videoId +
            "?autoplay=false&loop=false&muted=false&preload=true&responsive=true";
        $('#videoDisply').prop('src', newUrl);
        $('.quizTab').removeClass("active show"); 
        $('#resource').hide(); 
        $('#course-project').show();
		$('#course-project').addClass('active show')
        $("#resource-excel").hide();
        $("#videoDisply").addClass("videoDisply_"+videoId);

        if (currentPauseIcon) {
            currentPauseIcon.classList.remove('bi-pause-fill');
            currentPauseIcon.classList.add('bi-play-fill');
        }

        if (playerInstance) {
            playerInstance.pause(); // Clean up previous instance if exists
        }
          
        playerInstance = new playerjs.Player(document.querySelector(".videoDisply_" + videoId));
        let duration = 0;
        let watchTime = 0;
        let timeStarted = -1;
        let playbackSpeed = 1; // Default playback speed
        const buffer = 1; // Allowable buffer time in seconds

        playerInstance.on('play', () => {
            if (timeStarted < 0) {
                timeStarted = new Date().getTime() / 1000;
            }
        });

        // Event listener for when the video is paused
        playerInstance.on('pause', () => {
            if (timeStarted > 0) {
                const timeEnded = new Date().getTime() / 1000;
                watchTime += (timeEnded - timeStarted);
                timeStarted = -1; // Reset timeStarted
            }
            var iconElement = document.getElementById("play-pause-icon-" + vid);
            if (iconElement) {
                iconElement.classList.remove('bi-pause-fill');
                iconElement.classList.add('bi-play-fill');
            }
            // checkIfWatchedFully(vid);
        });

        // Event listener for when the video ends
        playerInstance.on('ended', () => {
            if (timeStarted > 0) {
                const timeEnded = new Date().getTime() / 1000;
                watchTime += (timeEnded - timeStarted) ;
                timeStarted = -1;
            }
            checkIfWatchedFully(vid);
        });

        playerInstance.on('timeupdate', (data) => {
            if (timeStarted > 0) {
                const currentTime = new Date().getTime() / 1000;
                watchTime += (currentTime - timeStarted);
                timeStarted = currentTime;
            }

            if (duration <= 0) {
                duration = data.duration || playerInstance.duration;
                if (duration) {
                    console.log('Video duration set to:', duration);
                }
            }
        });
        var course_id = "<?php echo base64_encode($course_id); ?>";
        var iconElement = $("#play-pause-icon-" + vid);
    
        if (iconElement.hasClass("bi-play-fill")) {
            console.log("Found bi-play-fill class");
            iconElement.removeClass("bi-play-fill").addClass("bi-pause-fill");
        } else if (iconElement.hasClass("bi-pause-fill")) {
            console.log("Found bi-pause-fill class sdfdfdsf");
            iconElement.removeClass("bi-pause-fill").addClass("bi-play-fill");
        } else if (iconElement.hasClass("bi-check2")) {
            $.ajax({
                url: studentBaseUrl + "/student-getprogess/",
                type: "post",
                data: {
                    course_id: course_id,
                },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    if(response.data != undefined){
                        response.data.forEach(item => {
                            if (iconElement) {
                                if (item.full_check === 'Yes' && vid == item.video_id) {
                                    iconElement.classList.remove('bi-pause-fill', 'bi-play-fill');
                                    iconElement.classList.add('bi-check2');
                                }
                            }
                        });
                    }else{
                        iconElement.removeClass("bi-check2").addClass("bi-pause-fill");
                    }
                }
            });
        } else{
            // Handle case where neither class is present (optional)
            console.log("No class found or unknown state");
        }


            const currentTabId = vid; // Get the ID of the currently clicked tab

            if (previousTabId) {
                console.log("Previous Tab ID:", previousTabId);

                var iconElement = $("#play-pause-icon-" + previousTabId);
                var filetype = iconElement.data('filetype');
                if (iconElement.hasClass("bi-play-fill")) {
                    console.log("Found bi-play-fill class");
                    iconElement.removeClass("bi-play-fill").addClass("bi-pause-fill");
                }else if (iconElement.hasClass("bi-pause-fill")) {
                    console.log("Found bi-pause-fill class testing");
                    iconElement.removeClass("bi-pause-fill").addClass("bi-play-fill");
                }
                if(filetype == 'pdf'){
                        iconElement.removeClass("bi-file-earmark-pdf").addClass("bi-check2");
                }
                if(filetype == 'excel'){
                    iconElement.removeClass("bi-filetype-exe").addClass("bi-check2");
                }
            
                // Retrieve the course ID from PHP variable

                // AJAX request to get progress
                $.ajax({
                    url: studentBaseUrl + "/student-getprogess/",
                    type: "post",
                    data: {
                        course_id: course_id,
                    },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        console.log(response.data);
                        if(response.data != undefined){
                            response.data.forEach(item => {
                                // console.log(`Full Check: ${item.full_check}, Video ID: ${item.video_id}`);
                                var iconElement = document.getElementById("play-pause-icon-" + item.video_id);
                                if (iconElement) {
                                    if (item.full_check === 'Yes' && previousTabId == item.video_id) {
                                        // Remove existing classes and add the new one
                                        iconElement.classList.remove('bi-pause-fill', 'bi-play-fill');
                                        iconElement.classList.add('bi-check2');
                                    }
                                }
                            });
                        }
                        var iconElement = $("#play-pause-icon-" + previousTabId);

                        previousTabId = currentTabId;
                      
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching data:", status, error);
                    }
                });

            } else {
                // No previousTabId to compare with, just set previousTabId to the current one
                previousTabId = currentTabId;
                var iconElement = $("#play-pause-icon-" + currentTabId);

            }

        function checkIfWatchedFully(vid) {
            var course_id = "<?php echo base64_encode($course_id); ?>";
            console.log('Checking watch status...');
            console.log('Duration:', duration);
            console.log('Watch Time:', watchTime);
            console.log('Buffer:', buffer);
            var studentBaseUrl = window.location.origin + "/student";
            $.ajax({
                url: studentBaseUrl + "/student-videoprogess/",
                type: "post",
                data: {
                    course_id: course_id,
                    watch_content: vid,
                    duration: duration,
                },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                }
            });

            if (duration > 0 && Math.abs(duration - watchTime) <= buffer) {
                var studentBaseUrl = window.location.origin + "/student";
                $.ajax({
                url: studentBaseUrl + "/student-watchprogess-check/",
                type: "post",
                data: {
                    course_id:course_id,
                    watch_content:"v_"+vid,
                },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    var iconElement = document.getElementById("play-pause-icon-" + vid);
                    console.log(iconElement);
                    iconElement.classList.remove('bi-pause-fill', 'bi-play-fill');
                    iconElement.classList.add('bi-check2');
                    console.log(response.data);
                    if(response.data == "FALSE"){
                        var watch_content = "v_"+vid;
                        var currentValue = $('.total_progress_display_value').attr('value');
                        var progress_count_total = $(".progress_count").data("progress");
                        if(response.count == '0'){
                            var total_progress_display_count = 1;
                        }else{
                            var total_progress_display_count = Number(response.count) + 1;
                        }
                        var total_progress_display =  (total_progress_display_count/progress_count_total)*100;
                        $(".total_progress_display_value").css('width', total_progress_display.toFixed(0)+"%");
                        $('.total_progress_display_value').attr('value', total_progress_display_count);
                        document.querySelector('.total_progress_display_complete').textContent =  total_progress_display.toFixed(0) + '% Completed';
                        var progress_bar = $('.progress_bar').attr('value');
                        var studentBaseUrl = window.location.origin + "/student";
                        $.ajax({
                            url: studentBaseUrl + "/student-watchprogess",
                            type: "post",
                            data: {
                                progress_bar:total_progress_display.toFixed(0),
                                total_progress_display_value:watch_content,
                                total_progress_display_count:total_progress_display_count,
                                course_id:course_id
                            },
                            dataType: "json",
                            headers: {
                                "X-CSRF-TOKEN": csrfToken,
                            },
                            success: function (response) {
                                
                            },
                        }); 
                    }
                  
                }
                });
            } else {
                watchTime = 0;
                console.log("Video has not been watched completely.");
            }
        }
     


         
    }
    // Function to disable print functionality
    function PdfContentDisplay(file, title,pdid) {
        if(playerInstance){
            playerInstance.pause();
        }
        var newUrl = "{{ Storage::url('') }}" + file + "#toolbar=0&navpanes=0&scrollbar=0";
        $('#pdfDisplay').html('');
        // New Added  
        const currentTabId = pdid; // Get the ID of the currently clicked tab

        var iconElement = $("#play-pause-icon-" + currentTabId);
        var filetype = iconElement.data('filetype');
        var course_id = "<?php echo base64_encode($course_id); ?>";
        if(filetype == 'pdf'){
            if (iconElement.hasClass("bi-check2")) {
                console.log("sfsffsdf");
                iconElement.removeClass("bi-check2").addClass("bi-file-earmark-pdf");
            } 
        }
        
            if (previousTabId) {

                console.log(previousTabId);
                console.log("Previous Tab ID:", previousTabId);

                var iconElement = $("#play-pause-icon-" + previousTabId);
                console.log(iconElement);
                var filetype = iconElement.data('filetype');
                if (iconElement.hasClass("bi-play-fill")) {
                    iconElement.removeClass("bi-play-fill").addClass("bi-pause-fill");
                } else if (iconElement.hasClass("bi-pause-fill")) {
                    iconElement.removeClass("bi-pause-fill").addClass("bi-play-fill");
                }else if (iconElement.hasClass("bi-check2")) {
                    iconElement.removeClass("bi-check2").addClass("bi-check2");
                }else{
                    console.log("Found bi-pause-fill class testisdfdsfng");

                }
                if(filetype) {
                    if(filetype == 'pdf'){
                        if (iconElement.hasClass("bi-check2")) {
                            console.log("previosucheck");
                            iconElement.removeClass("bi-check2").addClass("bi-file-earmark-pdf");
                        } else if (iconElement.hasClass("bi-file-earmark-pdf")) {
                            console.log("previosupdf");
                            iconElement.removeClass("bi-file-earmark-pdf").addClass("bi-check2");
                        }
                    }
                    if(filetype == 'excel'){
                        // iconElement.removeClass("bi-filetype-exe").addClass("bi-check2");
                         if (iconElement.hasClass("bi-check2")) {
                            console.log("previosucheck");
                            iconElement.removeClass("bi-check2").addClass("bi-filetype-exe");
                        } else if (iconElement.hasClass("bi-filetype-exe")) {
                            console.log("previosuexcel");
                            iconElement.removeClass("bi-filetype-exe").addClass("bi-check2");
                        }
                    }
                }
                // Retrieve the course ID from PHP variable

                // AJAX request to get progress
                $.ajax({
                    url: studentBaseUrl + "/student-getprogess/",
                    type: "post",
                    data: {
                        course_id: course_id,
                    },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        if(response.data != undefined){
                            response.data.forEach(item => {
                                var iconElement = document.getElementById("play-pause-icon-" + item.video_id);
                                if (iconElement) {
                                    if (item.full_check === 'Yes' && previousTabId == item.video_id) {
                                        // Remove existing classes and add the new one
                                        iconElement.classList.remove('bi-pause-fill', 'bi-play-fill');
                                        iconElement.classList.add('bi-check2');
                                    }
                                }
                            });
                        }

                        // Update previousTabId for the next use
                        previousTabId = currentTabId;
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching data:", status, error);
                    }
                });

            } else {

                // No previousTabId to compare with, just set previousTabId to the current one
                previousTabId = currentTabId;
                var iconElement = $("#play-pause-icon-" + currentTabId);
                
            }

            $.ajax({
                    url: studentBaseUrl + "/student-getprogess/",
                    type: "post",
                    data: {
                        course_id: course_id,
                    },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        if(response.data != undefined){
                            response.data.forEach(item => {
                                var iconElement = document.getElementById("play-pause-icon-" + item.video_id);
                                if (iconElement) {
                                    if (item.full_check === 'Yes') {
                                        // Remove existing classes and add the new one
                                        iconElement.classList.remove('bi-pause-fill', 'bi-play-fill');
                                        iconElement.classList.add('bi-check2');
                                    }
                                }
                            });
                        }

                        // Update previousTabId for the next use
                        previousTabId = currentTabId;
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching data:", status, error);
                    }
                });
            pdfjsLib.getDocument(newUrl).promise.then(pdfDoc=>{
            let pages = pdfDoc._pdfInfo.numPages;
            for(let i=0;i<=pages;i++){
                pdfDoc.getPage(i).then(page=>{
                let pdfCanvas = document.createElement('canvas')
                let context = pdfCanvas.getContext('2d');
                let scale = 1.6;
                let pageViewPort = page.getViewport({scale:scale});
                pdfCanvas.width = pageViewPort.width;
                pdfCanvas.height = pageViewPort.height;
                $("#pdfDisplay").append(pdfCanvas)
                page.render({
                    canvasContext: context,
                    viewport: pageViewPort
                })
            })
            }
           
        }).catch(err=>{
            console.log(err,"error loading")
        })
        // End

        $('#pdfDisply').prop('src', newUrl);
        $('#course-project').hide();
        $('.quizTab').removeClass("active show"); 
        $('#resource').show(); 
        $("#resource-excel").hide();

        $.ajax({
            url: studentBaseUrl + "/student-watchprogess-check/",
            type: "post",
            data: {
                course_id:course_id,
                watch_content:"pd_"+pdid
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                if(response.data == "FALSE"){
                    var watch_content = "pd_"+pdid;
                    var currentValue = $('.total_progress_display_value').attr('value');
                    var progress_count_total = $(".progress_count").data("progress");
                    if(response.count == '0'){
                        var total_progress_display_count = 1;
                    }else{
                        var total_progress_display_count = Number(response.count) + 1;
                    }

                    var total_progress_display =  (total_progress_display_count/progress_count_total)*100;
                    $(".total_progress_display_value").css('width', total_progress_display.toFixed(0)+"%");
                    $('.total_progress_display_value').attr('value', total_progress_display_count);
                    document.querySelector('.total_progress_display_complete').textContent =  total_progress_display.toFixed(0) + '% Completed';

                    
                    var progress_bar = $('.progress_bar').attr('value');
                    
                    var studentBaseUrl = window.location.origin + "/student";
                    $.ajax({
                        url: studentBaseUrl + "/student-watchprogess",
                        type: "post",
                        data: {
                            progress_bar:total_progress_display.toFixed(0),
                            total_progress_display_value:watch_content,
                            total_progress_display_count:total_progress_display_count,
                            course_id:course_id
                        },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        success: function (response) {
                            
                        },
                    });


                }
            },
        });
            

    }
    function ExcelContentDisplay(file, title,doid,file_name) {
        if(playerInstance){
            playerInstance.pause();
        }
        var newUrl = "{{ Storage::url('') }}" + file + "#toolbar=0&navpanes=0&scrollbar=0";
        $('#excelDisplay')
            .attr("href", newUrl)
            .attr("download", file_name);
        $('#course-project').hide();
        $("#course-project").removeClass("active show");
        $('.quizTab').removeClass("active show"); 
        $('#resource').hide(); 
        var course_id = "<?php echo base64_encode($course_id); ?>";
        $("#resource-excel").show();
            const currentTabId = doid; // Get the ID of the currently clicked tab
            var iconElement = $("#play-pause-icon-" + currentTabId);
            console.log("sdfsdf");
            if (iconElement.hasClass("bi-check2")) {
                iconElement.removeClass("bi-check2").addClass("bi-filetype-exe");
            } else if (iconElement.hasClass("bi-filetype-exe")) {
                iconElement.removeClass("bi-filetype-exe").addClass("bi-check2");
            }
            if (previousTabId) {
                console.log(previousTabId);
                console.log("Previous Tab ID:", previousTabId);

                var iconElement = $("#play-pause-icon-" + previousTabId);
                var filetype = iconElement.data('filetype');
                if (iconElement.hasClass("bi-play-fill")) {
                    console.log("Found bi-play-fill class");
                    iconElement.removeClass("bi-play-fill").addClass("bi-pause-fill");
                } else if (iconElement.hasClass("bi-pause-fill")) {
                    console.log("Found bi-pause-fill class testing");
                    iconElement.removeClass("bi-pause-fill").addClass("bi-play-fill");
                } 
                if(filetype) {
                    if(filetype == 'pdf'){
                        iconElement.removeClass("bi-file-earmark-pdf").addClass("bi-check2");
                    }
                    if(filetype == 'excel'){
                        iconElement.removeClass("bi-filetype-exe").addClass("bi-check2");
                    }
                }
                $.ajax({
                    url: studentBaseUrl + "/student-getprogess/",
                    type: "post",
                    data: {
                        course_id: course_id,
                    },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        console.log(response.data);
                        if(response.data != undefined){
                            response.data.forEach(item => {
                                var iconElement = document.getElementById("play-pause-icon-" + item.video_id);
                                if (iconElement) {
                                    if (item.full_check === 'Yes' && previousTabId == item.video_id) {
                                        iconElement.classList.remove('bi-pause-fill', 'bi-play-fill');
                                        iconElement.classList.add('bi-check2');
                                    }
                                }
                            });
                        }
                        previousTabId = currentTabId;
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching data:", status, error);
                    }
                });

            } else {
                // No previousTabId to compare with, just set previousTabId to the current one
                previousTabId = currentTabId;
            }
            $.ajax({
                url: studentBaseUrl + "/student-watchprogess-check/",
                type: "post",
                data: {
                    course_id:course_id,
                    watch_content:"do_"+doid
                },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {

                    console.log(response.data);
                    if(response.data == "FALSE"){
                        var watch_content = "do_"+doid;
                        var currentValue = $('.total_progress_display_value').attr('value');
                        var progress_count_total = $(".progress_count").data("progress");
                        if(response.count == '0'){
                            var total_progress_display_count = 1;
                        }else{
                            var total_progress_display_count = Number(response.count) + 1;
                        }

                        var total_progress_display =  (total_progress_display_count/progress_count_total)*100;



                        $(".total_progress_display_value").css('width', total_progress_display.toFixed(0)+"%");
                        $('.total_progress_display_value').attr('value', total_progress_display_count);
                        document.querySelector('.total_progress_display_complete').textContent =  total_progress_display.toFixed(0) + '% Completed';

                        
                        var progress_bar = $('.progress_bar').attr('value');
                        
                        var studentBaseUrl = window.location.origin + "/student";
                        $.ajax({
                            url: studentBaseUrl + "/student-watchprogess",
                            type: "post",
                            data: {
                                progress_bar:total_progress_display.toFixed(0),
                                total_progress_display_value:watch_content,
                                total_progress_display_count:total_progress_display_count,
                                course_id:course_id
                            },

                            dataType: "json",
                            headers: {
                                "X-CSRF-TOKEN": csrfToken,
                            },
                            success: function (response) {
                                
                            },
                        });


                    }
                },
            });
    }
    var studentBaseUrl = window.location.origin + "/student";
    $(".quizActive").on("click", function (event) {
           event.preventDefault();
           var quiz_id = $(this).data("quiz_id");
           var course_id = $(this).data("course_id");
            $("#course_id").attr("value",course_id);
            $("#quizHeader").find('.newAddedStep').remove();
            $("#quizForm").find('.newAddedPane').remove();
            $("#quizForm").find("#test-start").removeClass('dstepper-block bs-stepper-block fade active');
            $("#test-last").removeClass('bs-stepper-block fade active');
            $(".save_loader").removeClass("d-none").addClass("d-block");
            var progress_count_total = $(".progress_count").data("progress");

            const currentTabId = atob(quiz_id); // Get the ID of the currently clicked tab
            if (previousTabId) {
                var iconElement = $("#play-pause-icon-" + previousTabId);
                var filetype = iconElement.data('filetype');
                if (iconElement.hasClass("bi-play-fill")) {
                    console.log("Found bi-play-fill class");
                    iconElement.removeClass("bi-play-fill").addClass("bi-pause-fill");
                } else if (iconElement.hasClass("bi-pause-fill")) {
                    console.log("Found bi-pause-fill class testing");
                    iconElement.removeClass("bi-pause-fill").addClass("bi-play-fill");
                } 
                if(filetype) {
                    if(filetype == 'pdf'){
                        iconElement.removeClass("bi-file-earmark-pdf").addClass("bi-check2");
                    }
                    if(filetype == 'excel'){
                        iconElement.removeClass("bi-filetype-exe").addClass("bi-check2");
                    }
                }
                // Retrieve the course ID from PHP variable
                $.ajax({
                    url: studentBaseUrl + "/student-getprogess/",
                    type: "post",
                    data: {
                        course_id: course_id,
                    },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        console.log(response.data);
                        if(response.data != undefined){
                            response.data.forEach(item => {
                                var iconElement = document.getElementById("play-pause-icon-" + item.video_id);
                                if (iconElement) {
                                    if (item.full_check === 'Yes' && previousTabId == item.video_id) {
                                        // Remove existing classes and add the new one
                                        iconElement.classList.remove('bi-pause-fill', 'bi-play-fill');
                                        iconElement.classList.add('bi-check2');
                                    }
                                }
                            });
                        }
                        previousTabId = currentTabId;
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching data:", status, error);
                    }
                });

            } else {
                previousTabId = currentTabId;
            }
            if(playerInstance){
                playerInstance.pause();
            }

           $.ajax({
               url: studentBaseUrl + "/quiz-view",
               type: "POST",
               data: { id: quiz_id,course_id: course_id },
               dataType: "json",
               headers: {
                   "X-CSRF-TOKEN": csrfToken,
               },
               success: function (response) {
                  $(".save_loader").addClass("d-none").removeClass("d-block");
                   $("#loader").fadeOut();
                   if (response.code === 200) {
                      $("#test-start").addClass('dstepper-block bs-stepper-block fade active');
                       var data = Object.keys(response.data[0]['quiz_question']);
                       var values = Object.values(response.data[0]['quiz_question']);
                       var num = 1;
                       var length = data.length;
                  
                        data.forEach(function (key) {
                            var questionId = btoa(values[key]['id']);
                            var question = values[key]['question'];
                            var quiz_id = btoa(values[key]['quiz_id']);
                            var option1 = values[key]['option1'];
                            var option2 = values[key]['option2'];
                            var option3 = values[key]['option3'];
                            var option4 = values[key]['option4'];
                            var next = num +1;

                            var progress = (num/length) * 100;
                            var previous = '';
                            var nextBlock = '';
                             if (num > 1) {
                                        var previous =  `<div class="mt-0 d-flex justify-content-start">
                                            <button class="btn btn-secondary color-white" type="button" onclick="previousStep(`+num+`)"><i class="fe fe-arrow-left"></i>Previous
                                                </button>
                                        </div>`;  
                                        }
                                if (length < next) {
                                      var nextBlock =  `<div class="mt-0 d-flex justify-content-end">
                                            <button class="btn btn-primary color-green quizFinalSubmit" data-quizid="` + quiz_id + `" data-courseid="` +course_id+ `"  data-progress_count_total="`+ progress_count_total +`"  type="button">Final Submit
                                                <i class="fe fe-arrow-right"></i></button>
                                        </div>`;
                                        }else{
                                        var nextBlock =  `<div class="mt-0 d-flex justify-content-end">
                                            <button class="btn btn-primary color-green" type="button" onclick="nextStep(`+next+`)">Next
                                                <i class="fe fe-arrow-right"></i></button>
                                        </div>`;

                                        }
                           
                            var steperDiv = $(
                            `<div class="step newAddedStep" data-target="#test-l-`+num+`">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="test-l-`+num+`"
                                        id="courseFormtrigger`+num+`">
                                    </button>
                                </div>`
                            );

                            var stepcontain = `<div id="test-l-`+num+`" role="tabpanel" class="bs-stepper-pane  newAddedPane"
                                        aria-labelledby="courseFormtrigger`+num+`">
                                        <div class="card mb-4 rounded-top-0">
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <!-- quiz -->
                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <!-- quiz img -->
                                                        <a href="#"><img src="{{ asset('frontend/images/quiz-image.jpg') }}"
                                                                alt="course" class="rounded img-4by3-lg" /></a>
                                                        <!-- quiz content -->
                                                        <div class="ms-3">
                                                            <h3 class="mb-0"><p class="text-inherit mcqheading ">Multiple Choice Questions</a></p>
                                                             <input value="`+questionId+`" type="text" name="question_id[]" hidden   />
                                                             <input value="`+quiz_id+`" type="text" name="quiz_id" hidden  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <!-- text -->
                                                    <div class="d-flex justify-content-between">
                                                        <span>Exam Progress:</span>
                                                        <span>Question `+num+` out of `+length+`</span>
                                                    </div>
                                                    <!-- progress bar -->
                                                    <div class="mt-2">
                                                        <div class="progress" style="height: 6px">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                style="width: `+progress+`%" aria-valuenow="15" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- text -->
                                                <div class="mt-5">
                                                    <span>Question `+num+`</span>
                                                    <h4 class="mb-3 color-blue  mt-1">`+question+`</h4>
                                                    <!-- list group -->
                                                    <div class="list-group">
                                                        <div class="list-group-item list-group-item-action" aria-current="true">
                                                            <!-- form check -->
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="answer`+num+`[]" value="1" id="flexRadioDefault1`+num+`" />
                                                                <label class="form-check-label stretched-link"
                                                                    for="flexRadioDefault1`+num+`">`+option1+`</label>
                                                            </div>
                                                        </div>
                                                        <!-- list group -->
                                                        <div class="list-group-item list-group-item-action">
                                                            <!-- form check -->
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="answer`+num+`[]" value="2" id="flexRadioDefault2`+num+`" />
                                                                <label class="form-check-label stretched-link"
                                                                    for="flexRadioDefault2`+num+`">`+option2+`</label>
                                                            </div>
                                                        </div>
                                                        <!-- list group -->
                                                        <div class="list-group-item list-group-item-action">
                                                            <!-- form check -->
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="answer`+num+`[]" value="3" id="flexRadioDefault3`+num+`" />
                                                                <label class="form-check-label stretched-link"
                                                                    for="flexRadioDefault3`+num+`">`+option3+`</label>
                                                            </div>
                                                        </div>
                                                        <!-- list group -->
                                                        <div class="list-group-item list-group-item-action">
                                                            <!-- form check -->
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="answer`+num+`[]" value="4" id="flexRadioDefault4`+num+`" />
                                                                <label class="form-check-label stretched-link"
                                                                    for="flexRadioDefault4`+num+`">`+option4+`</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <div class="button-wrapper ">
                                         ` + nextBlock + ` ` + previous + `
                                        </div>
                                    </div>`;
                            $("#quizHeader").append(steperDiv);
                            $("#quizForm").append(stepcontain);

                            num++;
                        });
                   }else if(response.code === 203){
                         $("#test-last").addClass('bs-stepper-block fade active');
                       
                          $(".score").html("Your score is : "+response.score+'%');
                    }else{
                           swal({
                            title: response.title,
                            text: response.message,
                            icon: response.icon,
                        }).then(function () {
                            window.location.href =
                                baseUrl + "/admin/admin";
                        });
                    }
                    $("#resource").hide();
                    $('.quizTab').addClass("active show"); 
                    $("#course-project").removeClass("active show");
                    $("#course-project").hide();
                    $(".quizPane").addClass("active");
                    $(".quizActive").show();
                    $(".quizPane").collapse("show");
                    $("#resource-excel").hide();
                    
               },
           });

    
       });


  
       let buttonToggle = () => {
            const button = document.getElementById("menu-button");
            const icon = button.querySelector("i.bi");
            const isOpen = button.classList.contains("is-opened");
            
            if (isOpen) {
                button.classList.remove("is-opened");
                icon.classList.remove("bi-x");
                icon.classList.add("bi-arrow-right");
            } else {
                button.classList.add("is-opened");
                icon.classList.remove("bi-arrow-right");
                icon.classList.add("bi-x");
            }
    }

    document.addEventListener("DOMContentLoaded", () => {
        const button = document.getElementById("menu-button");
        const icon = button.querySelector("i.bi");
        if (!button.classList.contains("is-opened")) {
            icon.classList.add("bi-x");
            icon.classList.remove("bi-arrow-right");
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const titleLinks = document.querySelectorAll('.tab-link');
        const h1Element = document.getElementById('selected-title');
        titleLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const title = this.querySelector(
                        '.preview-course-heading')
                    .textContent;
                h1Element.textContent = title;
            });
        });
        const title = this.querySelector('.preview-course-heading').textContent;
        h1Element.textContent = title;
    });
    document.addEventListener('DOMContentLoaded', function(){
        const tabs = document.querySelectorAll('.tab-link');
        tabs.forEach(tab => {
            tab.addEventListener('click', function(event) {
                tabs.forEach(t=>t.classList.remove('active'));
                event.currentTarget.classList.add('active');
            })
        })
    })


window.courseForm = new Stepper(document.querySelector('#courseFormtrigger0'), {
    linear: false,
    animation: true
});

function nextStep(id) {

    var remove = id-1;
if (id === 1) {
      $('#test-start').removeClass('fade');
      $('#test-start').removeClass('dstepper-block active');
      
}else{
      $('#test-l-'+remove).removeClass('fade');
    $('#test-l-'+remove).removeClass('active show');
}
      
    $('#test-l-'+id).addClass('active show');
}
function previousStep(id) {

    var remove = id-1;
    $('#test-l-'+id).removeClass('fade');
    $('#test-l-'+id).removeClass('active show'); 
    $('#test-l-'+remove).addClass('active show');
}




</script>
@endsection