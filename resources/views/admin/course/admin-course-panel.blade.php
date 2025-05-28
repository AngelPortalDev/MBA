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
    <div id="db-wrapper" class="course-video-player-page toggled">
        <!-- Sidebar -->
<nav class="navbar-vertical navbar bg-white customeNavbar">
<div class="mobileviewsection" data-simplebar>
<section class="card " id="courseAccordion">
<!-- List group -->
<ul class="list-group list-group-flush" style="height: 100vh" data-simplebar="init">
    @php
        $i = 1;
    @endphp
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
<li class="list-group-item">
<h4 class="mb-0">
    {{ htmlspecialchars_decode($courseDetails[0]['course'][0]['course_title']) }}
</h4>
@php $j=0; @endphp

<div class="mb-3 mt-3">
<div class="progress" style="height: 6px">

<div class="progress-bar bg-blue progress-bar-striped progress-bar-animated total_progress_display_value"
    role="progressbar"
    value="";
    style="width:100%"
    aria-valuenow="10"
    aria-valuemin="0"
    aria-valuemax="100">
</div>

</div>
<small class="total_progress_display_complete">100</small>
</div>
</li>

<!-- Orientation Section -->
{{-- 
<li class="list-group-item">
<!-- Toggle -->
<a class="d-flex align-items-center h4 mb-0"
data-bs-toggle="collapse" href="#orientaion" role="button"
aria-expanded="false" aria-controls="orientaion">
<div class="me-auto accrodanTitle">
Orientation</div>
<!-- Chevron -->
<span class="chevron-arrow ms-4">
<i class="fe fe-chevron-down fs-lg-4 fs-sm-3"></i>
</span>
</a>
<!-- Row -->
<!-- Collapse -->
@php
$getModuleData = getData('course_section_masters', ['id'], ['section_category' => 2]);
$orientationData = getData('course_modules_videos', ['bn_collection_id', 'bn_video_url_id', 'video_title', 'id', 'video_duration'], ['section_id' => $getModuleData[0]->id, 'is_deleted' => 'No']); @endphp
<div class="collapse show" id="orientaion"
data-bs-parent="#courseAccordion">
<div class="py-3 nav" id="course-orientaion" role="tablist"
aria-orientation="vertical" style="display: inherit">
<div class="mb-3">
<div class="progress" style="height: 6px">
    <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated"
        role="progressbar" style="width: 45%"
        aria-valuenow="10" aria-valuemin="0"
        aria-valuemax="100">
    </div>
</div>
<small>45%
    Completed</small>
</div> 

@if (isset($orientationData) && !empty($orientationData) && count($orientationData) > 0)
    @foreach ($orientationData as $key => $data)
       @php
        $oriId = base64_encode($data->id);
        $libraryId = env('MASTER_LIBRARY_ID');
        $videoUrl = "https://iframe.mediadelivery.net/embed/$libraryId/$data->bn_video_url_id?&loop=true&muted=true&preload=true&responsive=true";
        $video_duration = $data->video_duration;
        $video_duration = floatval($video_duration);
        $minutes = floor($video_duration / 60);
        $remaining_seconds = $video_duration % 60;
        $video_duration = $minutes . 'm ' . $remaining_seconds . 's';
        if ($data->bn_collection_id == '') {
            $icons = 'pdf';
        } else {
            $icons = '';
        }
      @endphp
        @if ($data->bn_collection_id != '')
            <a href="#ori-{{ $oriId }}"
                class="mb-2 d-flex justify-content-between align-items-center tab-link {{ $key === 0 ? 'active' : '' }}"
                id="ori-{{ $oriId }}-tab"
                data-ori-id="{{ $oriId }}"
                data-video-url="{{ $videoUrl }}"
                data-bs-toggle="pill" role="tab"
                style="{{ $key === 0 ? 'background-color: whitesmoke;  border-radius: 3px;' : '' }}"
                data-icons="{{ $icons }}">
                <div class="text-truncate">
                    <span
                        class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 bg-blue">
                        <i class="bi {{ $key === 0 ? 'bi-pause-fill' : 'bi-play-fill' }}  color-green fs-lg-4 fs-sm-3 fw-bold"
                            id="bi-{{ $oriId }}"></i>
                    </span>
                    <span
                        class="preview-course-heading">
                        {{ strlen($data->video_title) > 35 ? Str::limit($data->video_title, 35) . '...' : $data->video_title }}
                    </span>
                </div>
                <div style="white-space: nowrap"
                    class="timeduration">
                    <span
                        class="timeduration">{{ $video_duration }}</span>
                </div>
            </a>
        @else
            <a href="#ori-{{ $oriId }}"
                class="mb-2 d-flex justify-content-between align-items-center tab-link {{ $key === 0 ? 'active' : '' }}"
                id="ori-{{ $oriId }}-tab"
                data-ori-id="{{ $oriId }}"
                data-video-url="{{ $videoUrl }}"
                data-bs-toggle="pill" role="tab"
                style="{{ $key === 0 ? 'background-color: whitesmoke;  border-radius: 3px;' : '' }}"
                data-icons="{{ $icons }}">
                <div class="text-truncate">
                    <span
                        class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 bg-blue">
                        <i class="bi bi-file-pdf  color-green fs-lg-4 fs-sm-3 fw-bold"
                            id="bi-{{ $oriId }}"></i>
                    </span>
                    <span
                        class="preview-course-heading">
                        {{ strlen($data->video_title) > 35 ? Str::limit($data->video_title, 35) . '...' : $data->video_title }}
                    </span>
                </div>
                <div style="white-space: nowrap"
                    class="timeduration">
                    <span
                        class="timeduration">{{ $video_duration }}</span>
                </div>
            </a>
        @endif
    @endforeach
@endif
</div>
</div>
</li>  --}}
<!--Course Content Section -->

@php $totalProgress = 0; @endphp
@if (isset($courseDetails) && !empty($courseDetails) && count($courseDetails) > 0)
@php 
$quizsteper = 1;
$CourseIconData = getData('student_course_master',['watch_content_id','id'],['user_id'=>auth()->user()->id,'course_id'=>$courseDetails[0]['course'][0]['id']],'','id','DESC'); 
@endphp

@php
$sectionData = getData('course_managment_master', ['section_id'], ['course_master_id' => $courseDetails[0]['course'][0]['id'], 'is_deleted' => 'No'],'','id','ASC');
$VideoData = getData('course_modules_videos', ['bn_collection_id', 'bn_video_url_id', 'video_title', 'id', 'video_duration'], ['section_id' => $sectionData[0]->section_id, 'is_deleted' => 'No']);
@endphp


@foreach ($courseDetails as $keys => $sections)



                                    

<li class="list-group-item">
<!-- Toggle -->
<a class="d-flex align-items-center h4 mb-0 "
    data-bs-toggle="collapse"
    href="#course{{ $i }}" role="button"
    aria-expanded="{{ $i === 1 ? 'true' : 'false' }}"
    aria-controls="course{{ $i }}">
    <div class="me-auto accrodanTitle" style="font-size: 15px">
        {{ isset($sections['sections'][0]['section_name']) ? htmlspecialchars_decode($sections['sections'][0]['section_name']) :'' }}
    </div>
    <!-- Chevron -->
    <span class="chevron-arrow ms-4">
        <i class="fe fe-chevron-down fs-4"></i>
    </span>
</a>
<!-- Row -->
<!-- Collapse -->

<div class="collapse {{ $i === 1 ? 'show' : '' }}" id="course{{ $i }}"
    data-bs-parent="#courseAccordion">
    <div class="pt-3 nav"
        id="course-tab{{ $i }}"
        role="tablist" aria-orientation="vertical"
        style="display: inherit">

        {{-- <div class="mb-3">
            <div class="progress" style="height: 6px">
                <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated"
                    role="progressbar"
                    style="width: 45%"
                    aria-valuenow="10"
                    aria-valuemin="0"
                    aria-valuemax="100">
                </div>
            </div>
            <small>45%
                Completed</small>
        </div> --}}
        @if ((isset($sections['sections'][0]['section_manage']) && is_array($sections['sections'][0]['section_manage'])))
        @foreach ($sections['sections'][0]['section_manage'] as $key => $section_manage)
            @if (!empty($section_manage['content_type_id']) && $section_manage['content_type_id'] === 1)
                @foreach ($section_manage['course_video'] as $video)
                <a class="mb-0 d-flex justify-content-between align-items-center text-inherit studentAwardCourseTitle tab-link {{ $j === 0 ?  'active' : '' }}"
                id="course-project-tab"
                data-bs-toggle="pill"
                href="#course-project"
                onclick="videoDisplay('{{ $video['bn_video_url_id'] }}','{{$video['id']}}')"
                role="tab"
                aria-controls="course-project"
                aria-selected="false">
                 <div class="d-flex align-items-center">
                     <span class="icon-shape bg-green text-primary icon-sm rounded-circle me-2">
                        <i id="play-pause-icon-{{ $video['id'] }}" class="bi bi-play-fill playIconStudentCoursePanel"></i>
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
                            onclick="ExcelContentDisplay('{{ $docs['file'] }}','{{ $docs['docs_title'] }}','{{$docs['id']}}','{{ $docs['doc_file_name'] }}')"
                            href="#resource-excel"
                            role="tab"
                            aria-controls="resource-excel"
                            aria-selected="false">
                            <div class="d-flex align-items-center">
                                <span
                                    class="icon-shape text-primary icon-sm rounded-circle me-2 bg-green">
                                    <i id="play-pause-icon-{{ $docs['id'] }}" data-filetype="excel" class="bi bi-filetype-exe nav-icon fs-6 color-blue playIconStudentCoursePanel"></i>
                                    
                                </span>
                            
                                <span class="d-inline-block preview-course-heading" style="font-size: 13px">{{ isset($docs['docs_title']) ? htmlspecialchars_decode($docs['docs_title']) : '' }}</span>
                            </div>
                            <div class="text-truncate">
                                {{-- <span></span> --}}
                            </div>
                        </a>
                        
                    @else
                        <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit studentAwardCourseTitle tab-link"
                        id="resource-tab"
                        data-bs-toggle="pill"
                        onclick="PdfContentDisplay('{{ $docs['file'] }}','{{ $docs['docs_title'] }}','{{$docs['id']}}')"
                        href="#resource"
                        role="tab"
                        aria-controls="resource"
                        aria-selected="false">
                        <div class="d-flex align-items-center">
                            <span
                                class="icon-shape text-primary icon-sm rounded-circle me-2 bg-green">
                                    <i id="play-pause-icon-{{ $docs['id'] }}" data-filetype="pdf"
                                    class="bi bi-file-earmark-pdf nav-icon fs-6 color-blue playIconStudentCoursePanel"></i>
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
                    data-course_id="{{base64_encode($sections['course'][0]['id'])}}"
                    data-bs-toggle="pill"
                    href="javascript:void(0);" role="tab"
                    aria-controls="quiz"
                    aria-selected="false">
                    <div class="text-truncate">
                        <span 
                            class="icon-shape text-primary icon-sm rounded-circle me-2 color-light-cyan bg-green">
                         
                            <i id="play-pause-icon-{{ $section_manage['content_id'] }}" data-filetype="quiz"
                            class="fe fe-help-circle nav-icon fs-6 color-primary playIconStudentCoursePanel"></i>
                   
                        </span>
                        <span class="text-inherit preview-course-heading" style="font-size: 13px">Quiz : {{htmlspecialchars_decode($quiz['quiz_tittle'])}}</span>
                        
                    </div>
                    <div class="text-truncate">
                        <span></span>
                    </div>
                </a>
                @php
                    $quizsteper ++;
                @endphp
                @php $totalProgress++; @endphp
             
                @endforeach
            @endif
            
                <div class="progress_bar" value="{{$j}}"></div>
    

            @php $j++; @endphp
        @endforeach
             @endif
    </div>
</div>
</li>
@php
$i++;
// $key++;

@endphp

@endforeach
@endif
<div class="progress_count" data-progress="{{$totalProgress}}"></div>

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

                     
                            {{-- @foreach ($orientationData as $key => $data)
                                @php
                                    $oriId = base64_encode($data->id);
                                    $libraryId = env('MASTER_LIBRARY_ID');
                                    if ($data->bn_collection_id == '') {
                                        $videoUrl = Storage::url($data->bn_video_url_id . '#toolbar=0');
                                    } else {
                                        $videoUrl = "https://iframe.mediadelivery.net/embed/$libraryId/$data->bn_video_url_id";
                                    }
                                @endphp --}}
                                {{-- <div class="tab-pane fade orientation {{ $key === 0 ? 'show active' : '' }}"
                                    id="ori-{{ $oriId }}" role="tabpanel{{ $key }}"
                                    aria-labelledby="ori-{{ $oriId }}-tab">
                                    <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0"
                                        style="height: 600px;position:relative;padding-top:56.25%;">
                                        <iframe id="videoPlayer-{{ $oriId }}"
                                            class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100 videoPlayer"
                                            width="560" height="315" src="{{ $videoUrl }}"
                                            title="E-Ascencia - Academy and LMS Template" frameborder="0"
                                            allow="fullscreen;"></iframe>
                                    </div>
                                </div> --}}
                            {{-- @endforeach --}}
                            <!-- Tab pane -->
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
                          @include('admin/course/part-quiz-course-panel',['QuizCourse'=>$courseDetails])
        
                            <!-- Resource 1 Tab pane -->
                            <div class="tab-pane fade" id="resource" role="tabpanel"
                                aria-labelledby="resource-tab">
                                <!-- Video -->
                                <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0 "
                                    style="height: 100vh; overflow-y: auto">
                                    <div style="text-align:center; height: 100% !important;" >
                                        {{-- <h4>Pdf Viewer</h4> --}}
                                        {{-- <iframe id="pdfDisply"
                                            class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100"
                                            width="560" height="315" src="" title=""
                                            frameborder="0"></iframe> --}}
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
                <h4 class="mt-2 course-selected-title" id="selected-title" style="padding-left: 24px; padding-bottom:0.9rem"></h4>
            </div>
            {{-- <section class="pb-8">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-12 mb-4 mb-lg-0">
                            <!-- Card -->
                            <div class="card rounded-3">
                                <!-- Card header -->
                                <div class="card-header border-bottom-0 p-0">
                                    <div>
                                        <!-- Nav -->
                                        <ul class="nav nav-lb-tab" id="tab" role="tablist">

                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="faq-tab" data-bs-toggle="pill"
                                                    href="#faq" role="tab" aria-controls="faq"
                                                    aria-selected="false" tabindex="-1">Create Notes</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="tab-content" id="tabContent">

                                        <!-- Tab pane -->
                                        <div class="tab-pane fade show active" id="faq" role="tabpanel"
                                            aria-labelledby="faq-tab">
                                            <!-- FAQ -->
                                            <!-- Card -->

                                            <!-- Card Body -->
                                            <form>

                                                <div class="mb-3 mb-4">
                                                    <label for="siteDescription" class="form-label">Add your
                                                        notes here
                                                    </label>
                                                    <textarea class="form-control" id="siteDescription" placeholder="Write Notes.... " required="" rows="4"></textarea>

                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <a href="#" class="text-white">Add Note
                                                        +</a></button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </section> --}}
        </main>
    </div>
    </body>

    </html>
<script src="{{ asset('frontend/js/examJs.js')}}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.7/plyr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.worker.min.js"></script>
<script>
    let playerInstance = null;
    let currentPauseIcon = null;
    // let stepper;
    let previousTabId = null; // Variable to store the previous tab ID
    // var totalProgress = $(".progress_count").data("progress");
    let currentVideoId = null; 

   
    document.addEventListener("DOMContentLoaded", function() {
    
     

        var defaultVideoId = "<?php echo $VideoData[0]->bn_video_url_id;?>";
        var defaultId = "<?php echo $VideoData[0]->id;?>";

        // Call videoDisplay to set the default video
        videoDisplay(defaultVideoId, defaultId);
        
    });
    
    function videoDisplay(videoId,vid) {
        currentVideoId = videoId;
        console.log("currentVideoId", currentVideoId);
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
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

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

            pdfjsLib.getDocument(newUrl).promise.then(pdfDoc=>{
            let pages = pdfDoc._pdfInfo.numPages;
            for(let i=0;i<=pages;i++){
                pdfDoc.getPage(i).then(page=>{
                let pdfCanvas = document.createElement('canvas')
                let context = pdfCanvas.getContext('2d');
                let scale = 1.6;
                let pageViewPort = page.getViewport({scale:scale});
                // console.log("pageViewPort",pageViewPort)
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


    }
    function ExcelContentDisplay(file, title,doid,file_name) {
        if(playerInstance){
            playerInstance.pause();
        }
        var newUrl = "{{ Storage::url('') }}" + file + "#toolbar=0&navpanes=0&scrollbar=0";
        $('#excelDisplay')
            .attr("href", newUrl)
            .attr("download", file_name) ;

        $('#course-project').hide();
        $("#course-project").removeClass("active show");
        $('.quizTab').removeClass("active show"); 
        $('#resource').hide(); 
        $("#resource-excel").show();


    }
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
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
                var course_id = "<?php echo base64_encode($courseDetails[0]['course'][0]['id']); ?>";       

            } else {
                previousTabId = currentTabId;
            }
            if(playerInstance){
                playerInstance.pause();
            }
            var studentBaseUrl = window.location.origin + "/admin";

            console.log(studentBaseUrl);
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
                                var answerSelected = values[key]['answer'];

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
                                            var nextBlock =  `<div class="mt-0 d-flex justify-content-end"></div>`;
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
                                            <div class="card mb-4">
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
                                                                <h3 class="mb-0"><a href="#" class="text-inherit">`+question+`</a></h3>
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
                                                        <h3 class="mb-3 color-blue  mt-1">`+question+`</h3>
                                                        <!-- list group -->
                                                        <div class="list-group">
                                                            <div class="list-group-item list-group-item-action" aria-current="true">
                                                                <!-- form check -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="answer`+num+`[]" value="1" id="flexRadioDefault1`+num+`"
                                                                        ${answerSelected == "1" ? "checked" : ""} />
                                                                    <label class="form-check-label stretched-link"
                                                                        for="flexRadioDefault1`+num+`">`+option1+`</label>
                                                                </div>
                                                            </div>
                                                            <!-- list group -->
                                                            <div class="list-group-item list-group-item-action">
                                                                <!-- form check -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="answer`+num+`[]" value="2" id="flexRadioDefault2`+num+`"
                                                                        ${answerSelected == "2" ? "checked" : ""} />
                                                                    <label class="form-check-label stretched-link"
                                                                        for="flexRadioDefault2`+num+`">`+option2+`</label>
                                                                </div>
                                                            </div>
                                                            <!-- list group -->
                                                            <div class="list-group-item list-group-item-action">
                                                                <!-- form check -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="answer`+num+`[]" value="3" id="flexRadioDefault3`+num+`" 
                                                                          ${answerSelected == "3" ? "checked" : ""}  />
                                                                    <label class="form-check-label stretched-link"
                                                                        for="flexRadioDefault3`+num+`">`+option3+`</label>
                                                                </div>
                                                            </div>
                                                            <!-- list group -->
                                                            <div class="list-group-item list-group-item-action">
                                                                <!-- form check -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="answer`+num+`[]" value="4" id="flexRadioDefault4`+num+`" 
                                                                        ${answerSelected == "4" ? "checked" : ""}/>
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
                        // $(".quizActive").addClass("active show");
                        // $(".quizTab").collapse("hide");
                        $('.quizTab').addClass("active show"); 
                        $("#course-project").removeClass("active show");
                        $("#course-project").hide();
                        $(".quizPane").addClass("active");
                        $(".quizActive").show();
                        $(".quizPane").collapse("show");
                        
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


