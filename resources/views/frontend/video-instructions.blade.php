@extends('frontend.master')
@section('content')

<style>
    /* .videos-instructions h3{
        text-align: left;
        color: #dae138;
    }
    .videos-instructions p{
        text-align: left;
        max-width: 650px;
        color: #fff;
    }
    .iconContent{
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 3px solid black;
    }
    .videoContent{
        padding: 1rem;
    }
    .videoinstructiontitle h4{
        font-size: 2rem;
        text-transform: uppercase;
        font-weight: 600;
        background: #dae138;
        padding: 5px 15px;
        display: inline-block;
    } */

     .box-1, .box-2, .box-3, .box-4{
        padding: 30px 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-align: left;
     }
     .box-1{
        background-color: #fff3e2;
     }
     .box-2{
        background-color: #deedfd;
     }
     .box-3{
        background-color: #d5f1e4;
     }
     .box-4{
        background-color: #fdeded;
     }
     .instruction-title{
        font-size: 18px;
     }
     .video-instruction-icon{
        font-size: 24px;
     }
     .instruction-main-heading{
        border-bottom: 3px solid #D34059;
        width: 50px;
        text-align: center;
        display: flex;
        justify-content: center;
        margin: 24px auto;
     }
     .start-now-btn{
        border: 1px solid #D34059;
     }
     .start-now-btn:hover{
        background-color: #D34059;
        color: #fff;
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

    <section class="pt-8 pb-4 bg-white">
        <div class="container text-center">
            <div class="container-fluid">
                {{-- <div class="card p-4 assignment-hour-instruction">
                    <div class="videoinstructiontitle">
                        <h4>Instruction for Videos</h4>
                    </div>
                    
                    <div class="videos-instructions position-relative mt-3">
                        <div class="row p-2">
                            <div class="col-3 iconContent" style="background-color: #FFF">
                                <i class="bi bi-journal-text fs-1 text-primary"></i>
                            </div>
                            <div class="col-9 videoContent" style="background-color: #2b3990">
                                <h3>Choose Relevant Content</h3>
                                <p>Select videos that match your learning goals, whether it's grammar, vocabulary, pronunciation, or specific topics of interest.</p>
                            </div>
                          
                        </div>
                        <div>
                            <p style="padding: 10px; color: black; background: #dae138; display: inline-block; position: absolute; left: -30px; top: -10px;" class="fw-bold">STEP 1</p>
                        </div>
                    </div>
                    <div class="videos-instructions position-relative mt-3">
                        <div class="row p-2">
                            <div class="col-3 iconContent" style="background-color: #FFF">
                                <i class="bi bi-journal-check fs-1 text-primary"></i>
                            </div>
                            <div class="col-9 videoContent" style="background-color: #2b3990">
                                <h3>Take Notes</h3>
                                <p>While watching, jot down important points, new words, or phrases. This will help reinforce your learning and provide a reference for future study.</p>
                            </div>
                          
                        </div>
                        <div>
                            <p style="padding: 10px; color: black; background: #dae138; display: inline-block; position: absolute; left: -30px; top: -10px;" class="fw-bold">STEP 2</p>
                        </div>
                    </div>
                    <div class="videos-instructions position-relative mt-3">
                        <div class="row p-2">
                            <div class="col-3 iconContent" style="background-color: #FFF">
                                <i class="bi bi-pause-circle fs-1 text-primary"></i>
                            </div>
                            <div class="col-9 videoContent" style="background-color: #2b3990">
                                <h3>Pause and Rewind</h3>
                                <p>Don’t hesitate to pause or rewind the video if you don’t understand something. Take your time to ensure you grasp the material fully.</p>
                            </div>
                          
                        </div>
                        <div>
                            <p style="padding: 10px; color: black; background: #dae138; display: inline-block; position: absolute; left: -30px; top: -10px;" class="fw-bold">STEP 3</p>
                        </div>
                    </div>
                    <div class="videos-instructions position-relative mt-3">
                        <div class="row p-2">
                            <div class="col-3 iconContent" style="background-color: #FFF">
                                <i class="bi bi-megaphone fs-1 text-primary"></i>
                            </div>
                            <div class="col-9 videoContent" style="background-color: #2b3990">
                                <h3>Practice Speaking</h3>
                                <p>After watching, practice speaking the phrases or sentences you've learned. Try to mimic the pronunciation and intonation of the speaker.</p>
                            </div>
                          
                        </div>
                        <div>
                            <p style="padding: 10px; color: black; background: #dae138; display: inline-block; position: absolute; left: -30px; top: -10px;" class="fw-bold">STEP 4</p>
                        </div>
                    </div>
                    <div class="videos-instructions position-relative mt-3">
                        <div class="row p-2">
                            <div class="col-3 iconContent" style="background-color: #FFF">
                                <i class="bi bi-repeat fs-1 text-primary"></i>
                            </div>
                            <div class="col-9 videoContent" style="background-color: #2b3990">
                                <h3>Review and Repeat</h3>
                                <p>Revisit the videos after some time to reinforce your understanding. Repetition is key to retaining new information</p>
                            </div>
                        </div>
                        <div>
                            <p style="padding: 10px; color: black; background: #dae138; display: inline-block; position: absolute; left: -30px; top: -10px;" class="fw-bold">STEP 5</p>
                        </div>
                    </div>

                    <div>
                        <a href="{{ route('video-view') }}" class="btn btn-outline-primary mt-3">Start Now</a>
                    </div>
                </div> --}}
                <div class="container d-flex justify-content-end">
                    <a href="{{ route('english-course-program') }}" class="btn btn-outline-primary underline back_to_home_page">Back</a>
                </div>
                <h2 class="instruction-main-heading text-dark">Instructions</h2>
                <p class="text-dark fs-4">Follow these simple instructions to enhance your video learning experience</p>
                <div class="row mt-5">
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                        <div class="box-1 position-relative">
                            <i class="bi bi-journal-text text-primary video-instruction-icon"></i>
                            <h3 class="instruction-title">Choose relevant content</h3>
                            <p>Select videos that match your learning goals, whether it's grammar, vocabulary, pronunciation, or specific topics of interest.</p>
                            <div>
                                <p style="padding: 5px; color: black; background: #ffd9a4; display: inline-block; position: absolute; right: 0px; top: 0px;" class="fw-bold">STEP 1</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                        <div class="box-2 position-relative">
                            <i class="bi bi-journal-check text-primary video-instruction-icon"></i>
                            <h3 class="instruction-title">Take notes</h3>
                            <p>While watching, jot down important points, new words, or phrases. This will help reinforce your learning and provide a reference for future study.</p>
                            <div>
                                <p style="padding: 5px; color: black; background: #b4d6fa; display: inline-block; position: absolute; right: 0px; top: 0px;" class="fw-bold">STEP 2</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                        <div class="box-3 position-relative">
                            <i class="bi bi-pause-circle text-primary video-instruction-icon"></i>
                            <h3 class="instruction-title">Pause and rewind</h3>
                            <p>Don’t hesitate to pause or rewind the video if you don’t understand something. Take your time to ensure you grasp the material fully.</p>
                            <div>
                                <p style="padding: 5px; color: black; background: #a6dec4; display: inline-block; position: absolute; right: 0px; top: 0px;" class="fw-bold">STEP 3</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                        <div class="box-4 position-relative">
                            <i class="bi bi-megaphone  text-primary video-instruction-icon"></i>
                            <h3 class="instruction-title">Practise speaking</h3>
                            <p>After watching, practise speaking the phrases or sentences you've learned. Try to mimic the pronunciation and intonation of the speaker.</p>
                            <div>
                                <p style="padding: 5px; color: black; background: #ffbcbc; display: inline-block; position: absolute; right: 0px; top: 0px;" class="fw-bold">STEP 4</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        @php
                            $currentUrl = $_SERVER['REQUEST_URI'];
                            $urlSegments = explode('/', $currentUrl);
                            $section_id = end($urlSegments);
                        @endphp    
                        <a href="{{ route('video-view',['section_id'=>$section_id]) }}" class="btn start-now-btn mt-5">Start Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
