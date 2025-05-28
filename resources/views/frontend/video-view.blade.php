@extends('frontend.master')
@section('content')

<style>
.video-container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

.video-container img {
    transition: opacity 0.3s; 
}

.play-icon {
    position: absolute;
    color: white; 
    opacity: 0;
    transition: opacity 0.3s;
    font-size: 2rem; 
}

.video-container:hover img {
    opacity: 0.6;
}

.video-container:hover .play-icon {
    opacity: 1; 
    cursor: pointer;
}
.sub-title{
    display: inline-block;
    line-height: 1.62;
    background: #efeefe;
    border-radius: 30px;
    padding: 3px 16px;
    font-weight: 500;
    color: #2b3990;
    margin: 0 0 14px;
    
}

.main-title{
    font-size: 24px;
    line-height: 1.33;
    margin: 0;
    letter-spacing: -.75px;
    text-transform: capitalize;
}

iframe[src*="mediadelivery.net"]::before, 
iframe[src*="mediadelivery.net"] .plyr__controls {
    display: none !important; /* Hide control icons */
}
/* Hide any custom play/pause icons */

i { -webkit-text-stroke: 2px }


.back_to_home_page{
        display: block;
        width: fit-content;
        background-color: #D34059;
        color: #fff;
        border: 0;
        padding: 6px 16px;
        border-radius: 6px;
     }
     .back_to_home_page:hover{
        background-color: #f02042;
     }


</style>
@php
            $currentUrl = $_SERVER['REQUEST_URI'];
            $urlSegments = explode('/', $currentUrl);
            $section_id = end($urlSegments);
        @endphp 
<section class="pt-8 pb-4">
    <div class="container d-flex justify-content-end">
        <a class="btn btn-outline-primary underline back_to_home_page" href="{{ route('video-instructions', ['section_id' => $section_id]) }}">Back</a>
    </div>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <span class="sub-title">Top Class Courses</span>
        </div>
        
        <h2 class="text-center mb-4 fw-bold text-dark main-title">Explore Our Latest English Programmes Videos</h2>
        <div class="row" id="video-box" style="display: none;">

            @foreach($VideoData as $value)
                @if($value['course_video'])
                <?php 

                $video_url_id = $value['course_video'][0]['bn_video_url_id'];
                $video_id = $value['course_video'][0]['id'];
                $libraryId = env('AWARD_LIBRARY_ID');
                $pullZone = env('PULL_ZONE_ID');
                $videoUrl = "https://iframe.mediadelivery.net/embed/$libraryId/$video_url_id?&loop=true&muted=true&responsive=true&autoplay=false&hidecontrols=0&hide_settings=true";
                $videoUrlIframe = "https://iframe.mediadelivery.net/embed/$libraryId/$video_url_id";
                $videoProgress = getData('english_video_progress',['full_check','video_id','user_id'],['user_id'=>Auth::user()->id,'video_id'=>$video_id]);
                ?>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div onclick="videoDisplay('{{ $video_url_id }}','{{$video_id}}','{{$videoUrl}}')" style="cursor: pointer;">
                        <iframe src="{{$videoUrl}}" class="w-100" height="200" loading="lazy"
                            style="pointer-events: none" id="videoDisply"
                            allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true">
                        </iframe>
                    </div>
                    <br>
                    <div class="d-flex align-items-center">
                        @if(isset($videoProgress[0]) && $videoProgress[0]->full_check == 'Yes')
                            <i id="play-pause-icon-{{ $video_id }}" class="bi bi-check2 playIconStudentCoursePanel me-2"></i>
                        @else
                            <i id="play-pause-icon-{{ $video_id }}" class="bi bi-check2 playIconStudentCoursePanel me-2" style="display: none;"></i>
                        @endif
                        <strong>{{$value['course_video'][0]['video_title']}}</strong>
                    </div>
                </div>
                {{-- <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="video-container" data-video-url="https://drive.google.com/file/d/10bPtMXW8_wZMpPiLaH93NkdmGKw1T18m/preview">
                        <img src="{{ asset('frontend/images/english-program/video-lesson2.jpg') }}" class="img-fluid" alt="Video 2" />
                        <i class="bi bi-play-circle fs-1 play-icon"></i>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="video-container" data-video-url="https://drive.google.com/file/d/10bPtMXW8_wZMpPiLaH93NkdmGKw1T18m/preview">
                        <img src="{{ asset('frontend/images/english-program/video-lesson3.jpg') }}" class="img-fluid" alt="Video 3" />
                        <i class="bi bi-play-circle fs-1 play-icon"></i>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="video-container" data-video-url="https://drive.google.com/file/d/10bPtMXW8_wZMpPiLaH93NkdmGKw1T18m/preview">
                        <img src="{{ asset('frontend/images/english-program/video-lesson4.jpg') }}" class="img-fluid" alt="Video 4" />
                        <i class="bi bi-play-circle fs-1 play-icon"></i>
                    </div>
                </div> --}}
                @endif
        @endforeach
    </div>
        {{-- <div class="row mt-5">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="video-container" data-video-url="https://drive.google.com/file/d/10bPtMXW8_wZMpPiLaH93NkdmGKw1T18m/preview">
                    <img src="{{ asset('frontend/images/english-program/video-lesson1.jpg') }}" class="img-fluid" alt="Video 1" />
                    <i class="bi bi-play-circle fs-1 play-icon"></i>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="video-container" data-video-url="https://drive.google.com/file/d/10bPtMXW8_wZMpPiLaH93NkdmGKw1T18m/preview">
                    <img src="{{ asset('frontend/images/english-program/video-lesson2.jpg') }}" class="img-fluid" alt="Video 2" />
                    <i class="bi bi-play-circle fs-1 play-icon"></i>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="video-container" data-video-url="https://drive.google.com/file/d/10bPtMXW8_wZMpPiLaH93NkdmGKw1T18m/preview">
                    <img src="{{ asset('frontend/images/english-program/video-lesson3.jpg') }}" class="img-fluid" alt="Video 3" />
                    <i class="bi bi-play-circle fs-1 play-icon"></i>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="video-container" data-video-url="https://drive.google.com/file/d/10bPtMXW8_wZMpPiLaH93NkdmGKw1T18m/preview">
                    <img src="{{ asset('frontend/images/english-program/video-lesson4.jpg') }}" class="img-fluid" alt="Video 4" />
                    <i class="bi bi-play-circle fs-1 play-icon"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="video-container" data-video-url="https://drive.google.com/file/d/10bPtMXW8_wZMpPiLaH93NkdmGKw1T18m/preview">
                    <img src="{{ asset('frontend/images/english-program/video-lesson4.jpg') }}" class="img-fluid" alt="Video 1" />
                    <i class="bi bi-play-circle fs-1 play-icon"></i>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="video-container" data-video-url="https://drive.google.com/file/d/10bPtMXW8_wZMpPiLaH93NkdmGKw1T18m/preview">
                    <img src="{{ asset('frontend/images/english-program/video-lesson3.jpg') }}" class="img-fluid" alt="Video 2" />
                    <i class="bi bi-play-circle fs-1 play-icon"></i>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="video-container" data-video-url="https://drive.google.com/file/d/10bPtMXW8_wZMpPiLaH93NkdmGKw1T18m/preview">
                    <img src="{{ asset('frontend/images/english-program/video-lesson1.jpg') }}" class="img-fluid" alt="Video 3" />
                    <i class="bi bi-play-circle fs-1 play-icon"></i>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="video-container" data-video-url="https://drive.google.com/file/d/10bPtMXW8_wZMpPiLaH93NkdmGKw1T18m/preview">
                    <img src="{{ asset('frontend/images/english-program/video-lesson2.jpg') }}" class="img-fluid" alt="Video 4" />
                    <i class="bi bi-play-circle fs-1 play-icon"></i>
                </div>
            </div>
        </div> --}}
    </div>
</section>

<!-- Modal -->
{{-- <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="videoModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="videoFrame" width="100%" height="400" src="" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">Video Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="modalVideo" src="" class="w-100" height="400" frameborder="0" allowfullscreen allow="autoplay; encrypted-media"></iframe>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.7/plyr.min.js"></script>
<script src="https://assets.mediadelivery.net/castjs/5.2.0/cast.min.js"></script>
<script src="https://assets.mediadelivery.net/hls/1.5.15/hls.min.js"></script>
<script>
$("document").ready(function () {
    window.addEventListener('load', function () {
        console.log("Page loaded. Displaying video box.");
        document.querySelector('#video-box').style.display = 'flex';
    });
});
    //     playerInstance = new playerjs.Player('.video-container'));
    //     console.log(playerInstance);

    // });
    // document.querySelectorAll('.video-container').forEach(container => {
    //     container.addEventListener('click', function() {
    //         const videoUrl = this.getAttribute('data-video-url');
    //         const videoFrame = document.getElementById('videoFrame');
    //         videoFrame.src = videoUrl;
    //         const videoModal = new bootstrap.Modal(document.getElementById('videoModal'));
    //         videoModal.show();

    //         let playerInstance = null;
    //         let currentPauseIcon = null;
    //         let previousTabId = null; 
    //         let currentVideoId = null; 
    //         $("#videoDisply").addClass("videoDisply_"+videoId);
    //     });
    // });
    function videoDisplay(bn_video_url_id, video_id,video_url) {
        
        window.addEventListener('load', function () {
                console.log("Page loaded. Displaying video box.");
                
                document.getElementById('video-box').style.display = 'block';
            });
        // alert(video_url);
        // let videoUrl = document.getElementById('videoDisply').getAttribute('src');
        // let videoUrl = document.getElementById('videoDisply').getAttribute('src');
        // // Set the video URL in the modal iframe
        document.getElementById('modalVideo').src = video_url;
        // console.log(video_url);
        // Open the modal
        var videoModal = new bootstrap.Modal(document.getElementById('videoModal'));
        let playerInstance = null;
        let currentPauseIcon = null;
        let previousTabId = null; 
        let currentVideoId = null; 
        videoModal.show();
        $("#modalVideo").addClass("modalVideo_"+video_id);
        playerInstance = new playerjs.Player(document.querySelector(".modalVideo_" + video_id));
        let duration = 0;
        let watchTime = 0;
        let timeStarted = -1;
        let playbackSpeed = 1; // Default playback speed
        const buffer = 1; // Allowable buffer time in seconds
        let videoFullyWatched = false; // To prevent multiple calls

        playerInstance.on('ready', function() {
            playerInstance.on('ended', function() {
                cosmole.log("bvideo is already watchaed.")
                playerInstance.stop();
            });
        })
        playerInstance.on('play', () => {
            if (timeStarted < 0) {
                timeStarted = new Date().getTime() / 1000;
            }
            // if (videoCompleted) {
            //     console.log("Video was already completed.");
                // playerInstance.pause(); // Prevent unnecessary playback
            // }/
        });
        
        // Event listener for when the video is paused
        playerInstance.on('pause', () => {
            if (timeStarted > 0) {
                const timeEnded = new Date().getTime() / 1000;
                watchTime += (timeEnded - timeStarted);
                timeStarted = -1; // Reset timeStarted
            }
        });
        playerInstance.on('ended', () => {
            if (timeStarted > 0) {
                const timeEnded = new Date().getTime() / 1000;
                watchTime += (timeEnded - timeStarted) ;
                timeStarted = -1;
            }
            playerInstance.pause(); // Stop video playback

            console.log("[VIDEO ENDED]");
            alert("sddsf");
            checkIfWatchedFully(video_id);
        });
        
        var videoCompleted = false;
        let lastVideoTime = 0;

        playerInstance.on('timeupdate', (data) => {

            const currentTime = data.seconds;

            // === JUMP DETECTION ===
            const diff = Math.abs(currentTime - lastVideoTime);
            if (diff > 0.5) {
                // console.log(`[JUMP DETECTED] Skipped ${diff.toFixed(2)}s`);
                const timeRemaining = duration - currentTime;
                // console.log(`[INFO] Duration: ${duration}, Current: ${currentTime}, Remaining: ${timeRemaining}`);

                if (!videoCompleted && timeRemaining <= 10) {
                    // console.log("[AUTO-COMPLETE] User skipped near end. Marking video as completed.");
                    videoCompleted = true;
                    playerInstance.pause();
                    checkIfWatchedFully(video_id);
                }
                
            }

            // === Watch Time Calculation ===
            if (timeStarted > 0) {
                const now = new Date().getTime() / 1000;
                watchTime += (now - timeStarted);
                timeStarted = now;
            }

            // === Duration Init ===
            if (duration <= 0) {
                duration = data.duration || playerInstance.duration;
                // console.log(`[INIT] Duration set: ${duration.toFixed(2)}s`);
            }

            // === Logging Progress ===
            const percentWatched = ((currentTime / duration) * 100).toFixed(2);
            // console.log(`[WATCHING] Time: ${currentTime.toFixed(2)}s / ${duration.toFixed(2)}s (${percentWatched}%)`);

            // === Completion Check ===
            const timeRemaining = duration - currentTime;
            if (!videoCompleted && timeRemaining <= 0.22) {
                // console.log(`[COMPLETE] Time remaining: ${timeRemaining.toFixed(2)}s - Video considered fully watched.`);

                videoCompleted = true;
                playerInstance.pause();

                checkIfWatchedFully(video_id);
            }

            // === Update Last Time Always ===
            lastVideoTime = currentTime;
        });

        // var videoCompleted = false;
        
        // playerInstance.on('timeupdate', (data) => {
        //     console.log(data);
        //     if (timeStarted > 0) {
        //         const currentTime = new Date().getTime() / 1000;
        //         watchTime += (currentTime - timeStarted);
        //         timeStarted = currentTime;
        //     }
        //     // console.log(timeStarted);

        //     const date = new Date(timeStarted * 1000);

        //     // console.log(date);


        //     if (duration <= 0) {
        //         duration = data.duration || playerInstance.duration;
        //     }
            
        //     // console.log(data.duration);
        //     if (Math.abs(data.seconds - duration) <= 0.2) {                
        //         videoCompleted = true;
        //         console.log('[VIDEO FULLY WATCHED]');
        //         playerInstance.pause(); // Stop video playback
        //         checkIfWatchedFully(video_id, duration, playerInstance.currentTime);
        //     }

        // });

        playerInstance.on('loadedmetadata', (data) => {
            duration = data.duration;
            console.log("Metadata loaded. Duration:", duration);
        });

        playerInstance.on('error', (error) => {
            console.error("An error occurred:", error);
        });

        function checkIfWatchedFully(video_id) {
            console.log('Checking watch status...');
            console.log('Duration:', duration);
            console.log('Watch Time:', watchTime);
            console.log('Buffer:', buffer);
            var studentBaseUrl = window.location.origin + "/student";
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            if (duration > 0 && Math.abs(duration - watchTime) <= buffer) {
                console.log("Video has  been watched completely.");
                $.ajax({
                    url: studentBaseUrl + "/student-englishvideoprogess/",
                    type: "post",
                    data: {
                        video_id: btoa(video_id),
                        duration: duration
                    },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        videoCompleted = false;
                        playerInstance.pause();
                        $("#play-pause-icon-" + video_id).css("display", "block");

                    }
                });
            }else{
                videoCompleted = false;
                playerInstance.pause();
                watchTime = 0;
                console.log("Video has not been watched completely.");
            }
            // var studentBaseUrl = window.location.origin + "/student";
            // $.ajax({
            //     url: studentBaseUrl + "/student-videoprogess/",
            //     type: "post",
            //     data: {
            //         course_id: course_id,
            //         watch_content: vid,
            //         duration: duration,
            //     },
            //     dataType: "json",
            //     headers: {
            //         "X-CSRF-TOKEN": csrfToken,
            //     },
            //     success: function (response) {
            //         // console.log("Progress saved successfully");
            //     }
            // });
            


    }
}
var videoModalEl = document.getElementById('videoModal');
videoModalEl.addEventListener('hidden.bs.modal', function() {
    document.getElementById('modalVideo').src = '';
});
    // const videoModal = document.getElementById('videoModal');
    // videoModal.addEventListener('hidden.bs.modal', function() {
    //     document.getElementById('videoFrame').src = '';
    // });
</script>

@endsection
