@extends('frontend.master')
@section('content')

<style>
    .main-card {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .main-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.3s ease, opacity 0.4s ease;
    }

    .new-main-card{
        /* background: #fff; */
        /* border: 1px solid #e0e0e0; */
        /* transition: transform 0.3s, box-shadow 0.3s; */
    }
    /* .new-main-card:hover{
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    } */
    .new-main-card img {
        width: 100%;
        height: auto;
        object-fit: cover;
        transition: transform 0.3s ease, opacity 0.4s ease;
        border-radius: 10px;
        margin-bottom: 5px;
    }

    .main-card img:hover {
        transform: scale(1.1);
        opacity: 0.8;
    }

    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 30px;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .main-card:hover .play-button {
        opacity: 1;
        cursor: pointer;
    }

    .new-main-card a {
        text-align: left;
        margin-top: 12px;
        font-size: 14px;
        color: #2b3990;
        font-weight: 600;
    }

    .new-main-card p {
        text-align: left;
        color: #666;
        margin-bottom: 15px;
    }
    .english-program-title{
        background: #2b3990;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
        margin-left: 1.5rem;
        margin-right: 1.5rem;
    }
    .podcast-title-heading {
        margin: auto;
        letter-spacing: 0.0015em;
        font-size: 2em;
        text-align: center;
    }
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

    .video {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1; /* Place video behind thumbnail */
    }

    .thumbnail {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2; /* Place thumbnail above video */
        cursor: pointer;
        background-color: black;
    }

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

            <section class="pt-8 pb-4 ">
                <div class="container d-flex justify-content-end mb-2">
                    <a href="{{ route('english-course-program') }}" class="back_to_home_page">Back</a>
                </div>
                <h1 class="text-center text-dark podcast-title-heading mb-2" style="font-weight: 800">Please Choose Your Favourite <span style="color: #D34059"> Podcast </span></h1>
                <div class="container">
                    {{-- <h3 class="text-dark">New & Noteworthy</h3> --}}
                    <div class="row">
                        @if(!empty($VideoData) && isset($VideoData))
                        @foreach($VideoData as $value)
                            @if( $value['course_video'])
                               
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
                                {{-- <br> --}}
                                <div class="d-flex align-items-center">
                                    @if(isset($videoProgress[0]) && $videoProgress[0]->full_check == 'Yes')
                                        <i id="play-pause-icon-{{ $video_id }}" class="bi bi-check2 playIconStudentCoursePanel me-2"></i>
                                    @else
                                        <i id="play-pause-icon-{{ $video_id }}" class="bi bi-check2 playIconStudentCoursePanel me-2" style="display: none;"></i>
                                    @endif
                                    <strong>{{$value['course_video'][0]['video_title']}}</strong>
                                </div>
                                {{-- <Strong>{{$value['course_video'][0]['video_title']}}</Strong> --}}
                            </div>
                            {{-- <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4"> --}}
                                     {{-- <div class="video-container"> --}}
                                        {{-- <iframe
                                            id="video"
                                            src="https://iframe.mediadelivery.net/play/331022/f8747464-2d0a-4d1f-8da3-139e65b986f2?loop=true&muted=true&preload=true&responsive=true&autoplay=false"
                                            frameborder="0"
                                            allow="autoplay; encrypted-media"
                                            allowfullscreen
                                            class="video"
                                            style="display: none;"
                                        ></iframe> --}}
                                        {{-- <img
                                            src="https://vz-e6e0478b-570.b-cdn.net/f8747464-2d0a-4d1f-8da3-139e65b986f2/thumbnail_c01e7b03.jpg"
                                            alt="Video Thumbnail"
                                            class="thumbnail"
                                            id="thumbnail"
                                            onclick="playVideo()"
                                        > --}}
                                        {{-- <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                                            <div class="video-container" data-video-url="{{$videoUrlIframe}}">
                                                <iframe src="{{$videoUrl}}" class="w-100" height="200" frameborder="0" allowfullscreen  style="pointer-events: none"></iframe>
                                            </div>
                                        </div> --}}
                                    {{-- </div> --}}
                               
                            {{-- </div> --}}
                      
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
                        @endif
                        {{-- <div class="col-lg-4 col-xl-3 col-md-6 col-sm-12 mt-2">
                            <div class="new-main-card p-2">
                                <img src="{{ asset('frontend/images/english-program/podcast-lesson-3.jpg') }}" alt="Entrepreneurship" />
                                <a href="{{route('podcast-details')}}" class="mb-0 text-dark">How i built this?</a>
                                <p>Updated Daily</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-3 col-md-6 col-sm-12 mt-2">
                            <div class="new-main-card p-2">
                                <img src="{{ asset('frontend/images/english-program/podcast-lesson-2.jpg') }}" alt="Careers" />
                                <a href="{{route('podcast-details')}}" class="mb-0 text-dark">The study podcast</a>
                                <p>Every Two Weeks</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-3 col-md-6 col-sm-12 mt-2">
                            <div class="new-main-card p-2">
                                <img src="{{ asset('frontend/images/english-program/podcast-lesson-1.jpg') }}" alt="Business" />
                                <a href="{{route('podcast-details')}}" class="mb-0 text-dark"> Ted talk education</a>
                                <p>Updated Weekly</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-3 col-md-6 col-sm-12 mt-2">
                            <div class="new-main-card p-2">
                                <a href="{{route('podcast-details')}}">
                                    <img src="{{ asset('frontend/images/english-program/podcast-lesson-3.jpg') }}" alt="True Crime" />
                                <a href="{{route('podcast-details')}}" class="mb-0 text-dark">How i built this?</a>
                                <p>Weekly Series</p>
                                </a>
                                
                            </div>
                        </div> --}}
                    </div>
                    {{-- <h3 class="text-dark">More to Discover</h3> --}}
                    {{-- <div class="row mb-3">
                    
                        <div class="col-lg-4 col-xl-3 col-md-6 col-sm-12 mt-2">
                            <div class="new-main-card p-2">
                                <img src="{{ asset('frontend/images/english-program/podcast-lesson-3.jpg') }}" alt="Business" />
                                <a href="{{route('podcast-details')}}" class="mb-0 text-dark">Ted talk education</a>
                                <p>Updated Weekly</p>
                            </div>
                        </div>
                      
                        <div class="col-lg-4 col-xl-3 col-md-6 col-sm-12 mt-2">
                            <div class="new-main-card p-2">
                                <a href="{{route('podcast-details')}}">
                                    <img src="{{ asset('frontend/images/english-program/podcast-lesson-3.jpg') }}" alt="True Crime" />
                                <a href="{{route('podcast-details')}}" class="mb-0 text-dark">How i built this?</a>
                                <p>Weekly Series</p>
                                </a>
                            </div>
                        </div>
                       
                        <div class="col-lg-4 col-xl-3 col-md-6 col-sm-12 mt-2">
                            <div class="new-main-card p-2">
                                <img src="{{ asset('frontend/images/english-program/podcast-lesson-3.jpg') }}" alt="Careers" />
                                <a href="{{route('podcast-details')}}" class="mb-0 text-dark">The study podcast</a>
                                <p>Every Two Weeks</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-3 col-md-6 col-sm-12 mt-2">
                            <div class="new-main-card p-2">
                                <img src="{{ asset('frontend/images/english-program/podcast-lesson-1.jpg') }}" alt="Entrepreneurship" />
                                <a href="{{route('podcast-details')}}" class="mb-0 text-dark">How i built this?</a>
                                <p>Updated Daily</p>
                            </div>
                        </div>
                      
                    </div> --}}
                </div>
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
            </section>
            {{-- <script> --}}
        <script>
            //   function playVideo() {

            //     const video = document.getElementById('video');
            //     const thumbnail = document.getElementById('thumbnail');
            //    // Show the video iframe and autoplay it instantly
            //     video.style.display = 'block'; // Make the video visible
            //     video.src = video.src.replace('autoplay=false', 'autoplay=true'); // Ensure autoplay is true

            
            //     // Keep the thumbnail visible during playback (optional)
            //     thumbnail.style.display = 'block';
            // }
            // document.querySelectorAll('.video-container').forEach(container => {
            //         container.addEventListener('click', function() {
            //             const videoUrl = this.getAttribute('data-video-url');
            //             const videoFrame = document.getElementById('videoFrame');
            //             videoFrame.src = videoUrl;
            //             const videoModal = new bootstrap.Modal(document.getElementById('videoModal'));
            //             videoModal.show();
            //         });
            //     });

            //     const videoModal = document.getElementById('videoModal');
            //     videoModal.addEventListener('hidden.bs.modal', function() {
            //         document.getElementById('videoFrame').src = '';
            //     });
            function videoDisplay(bn_video_url_id, video_id,video_url) {
                
                window.addEventListener('load', function () {
                    console.log("Page loaded. Displaying video box.");
                    
                    document.getElementById('video-box').style.display = 'block';
                });

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
        </script>
                {{-- </script> --}}
@endsection