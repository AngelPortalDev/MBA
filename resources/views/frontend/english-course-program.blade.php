@extends('frontend.master')
@section('content')

<style>
  

    .main-card, .new-main-card {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .main-card img, .new-main-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease, opacity 0.4s ease;
    }

    .main-card img:hover, .new-main-card img:hover {
        transform: scale(1.1);
        opacity: 0.8;
    }

    /* Heading and Section Styling */
    .english-course-title-heading {
        font-size: 2.5rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 10px;
    }

    .mainheadingbackground {
        background: linear-gradient(45deg, #D34059, #2b3990);
        padding: 60px 0;
    }

    h4.text-white {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
    }

    /* Tab Styling */
    .english-program .nav-link {
        font-size: 1.2rem;
        padding: 15px 30px;
        color: #333;
        border: none;
        transition: background 0.3s ease;
    }

    .english-program .nav-link.active {
        background-color: #2b3990;
        color: white;
        /* border-radius: 10px; */
    }

    .english-program .nav-link:hover {
        background-color: #f1f1f1;
        color: #2b3990;
    }

    /* Card Styling */
    .main-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .main-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
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

    .new-main-card {
        margin-top: 30px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    .new-main-card a {
        text-align: center;
        font-weight: 600;
        font-size: 1.2rem;
        color: #2b3990;
        margin-top: 15px;
        display: block;
        text-decoration: none;
    }

    .new-main-card p {
        text-align: center;
        color: #777;
        font-size: 1rem;
    }

    .new-main-card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    /* Responsive Styling */
    @media (max-width: 991px) {
        .english-course-title-heading {
            font-size: 2rem;
        }
    }

    @media (max-width: 767px) {
        .mainheadingbackground {
            padding: 40px 0;
        }

        .english-course-title-heading {
            font-size: 1.75rem;
    }

        .new-main-card {
            margin-top: 20px;
        }

        .new-main-card a {
            font-size: 1.1rem;
        }
    }

    @media screen and (min-width: 1200px) and (max-width: 1400px) {
        .engaging-podcast {
            margin-top: 1.5rem !important;
        }
        .main-card{
            margin-top: 3rem;
        }
}

@media screen and (min-width: 992px) and (max-width: 1199px){
    .inspiringStories{
        margin-top: 2.4rem !important;
    }
}
@media screen and (min-width: 768px) and (max-width: 991px){
    .inspiringStories{
        margin-top: 2.4rem !important;
    }
}


</style>

<section class="py-4 py-lg-6 mb-3 mainheadingbackground">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div>
                    <h1 class="text-white mb-1 display-4 english-course-title-heading">English Programmes</h1>
                    <h4 class="text-white">English Language Courses</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container bg-white pt-4 pb-4">
    <section class="pb-8 pt-8">
        <div class="container english-program">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 mt-n8 mb-4 mb-lg-0 mt-4">
                    <div class="card rounded-3" style="border: 1px solid #e1e1e1;">
                        <div class="card-header border-bottom-0 p-0">
                            <ul class="nav nav-lb-tab" id="tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="table-tab" data-bs-toggle="pill"
                                        href="#table" role="tab" aria-controls="table" aria-selected="true">Beginner</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="description-tab" data-bs-toggle="pill"
                                        href="#description" role="tab" aria-controls="description"
                                        aria-selected="false">Intermediate</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="review-tab" data-bs-toggle="pill"
                                        href="#review" role="tab" aria-controls="review"
                                        aria-selected="false">Advanced</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="tabContent">
                                <div class="tab-pane fade show active" id="table" role="tabpanel" aria-labelledby="table-tab">
                                    <div class="container mt-3">
                                        <div class="row mb-5 text-center">
                                            <!-- Featured Videos Section -->
                                            <div class="col-md-6 col-lg-4 col-sm-12 mt-2">
                                                <h2 class="text-dark mt-3">Featured Videos</h2>
                                                <p>Explore our latest video content.</p>
                                                <div class="main-card p-2 inspiringStories">
                                                    @if(Auth::check() && Auth::user()->role == 'user')
                                                    @php $doc_verified = getData('student_doc_verification',['identity_is_approved'],['student_id'=>Auth::user()->id]);
                                                    @endphp
                                                    @endif
                                                    @if(Auth::check() && Auth::user()->role == 'user' && $doc_verified[0]->identity_is_approved == "Approved")
                                                    
                                                        <a href="{{route('video-instructions',['section_id'=> base64_encode(getCourseSectionId('Beginner'))])}}">
                                                        <img src="{{ asset('frontend/images/english-program/videos.jpg') }}" alt="Podcast Image 1" class="img-fluid" />
                                                        </a>
                                                    @else
                                                        <a href="#">
                                                            <img src="{{ asset('frontend/images/english-program/videos.jpg') }}" alt="Podcast Image 1" class="img-fluid" />
                                                        </a>
                                                    @endif
                                                    <h5 class="mt-2 text-dark">Inspiring Stories</h5>
                                                </div>
                                            </div>

                                            <!-- Podcasts Section -->
                                            <div class="col-md-6 col-lg-4 col-sm-12 mt-2">
                                                <h2 class="text-dark mt-3">Engaging Podcasts</h2>
                                                <p>Tune into our podcasts for insightful discussions.</p>
                                                <div class="main-card p-2 engaging-podcast">
                                                    @if(Auth::check() && Auth::user()->role == 'user'  && $doc_verified[0]->identity_is_approved == "Approved")
                                                        <a href="{{route('podcast-view',['section_id'=>base64_encode(getCourseSectionId('Beginner Podcast'))])}}">
                                                        {{-- <a href="#"> --}}
                                                            <img src="{{ asset('frontend/images/english-program/podcast.jpg') }}" alt="Podcast Image 2" class="img-fluid" />
                                                        </a>
                                                    @else
                                                       <a href="#"> 
                                                        <img src="{{ asset('frontend/images/english-program/podcast.jpg') }}" alt="Podcast Image 2" class="img-fluid" />
                                                       </a>
                                                    @endif
                                                    <h5 class="mt-2 text-dark">Innovative Ideas</h5>
                                                </div>
                                            </div>

                                            <!-- Quizzes Section -->
                                            <div class="col-md-6 col-lg-4 col-sm-12 mt-2">
                                                <h2 class="text-dark mt-3">Interactive Quizzes</h2>
                                                <p>Test your knowledge with our fun quizzes.</p>
                                                <div class="main-card p-2">
                                                    @if(Auth::check() && Auth::user()->role == 'user'  && $doc_verified[0]->identity_is_approved == "Approved")
                                                    <a href="{{route('quiz-view',['section_id'=>base64_encode(getCourseSectionId('Beginner'))])}}">
                                                    {{-- <a href="#"> --}}
                                                        <img src="{{ asset('frontend/images/english-program/quiz.jpg') }}" alt="Podcast Image 3" class="img-fluid" />
                                                        </a>
                                                    @else
                                                        <a href="#">
                                                            <img src="{{ asset('frontend/images/english-program/quiz.jpg') }}" alt="Podcast Image 3" class="img-fluid" />
                                                        </a>
                                                    @endif
                                                    <h5 class="mt-2 text-dark">Knowledge Check</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                                    <div class="container mt-3">
                                        <div class="row mb-5 text-center">
                                            <!-- Featured Videos Section -->
                                            <div class="col-md-6 col-lg-4 col-sm-12 mt-2">
                                                <h2 class="text-dark mt-3">Featured Videos</h2>
                                                <p>Explore our latest video content.</p>
                                                <div class="main-card p-2 inspiringStories">
                                                    @if(Auth::check() && Auth::user()->role == 'user'  && $doc_verified[0]->identity_is_approved == "Approved")
                                                    <a href="{{route('video-instructions',['section_id'=> base64_encode(getCourseSectionId('Intermediate'))])}}">
                                                    {{-- <a href="#"> --}}
                                                        <img src="{{ asset('frontend/images/english-program/videos.jpg') }}" alt="Podcast Image 1" class="img-fluid" />
                                                    </a>
                                                    @else
                                                        <a href="#">
                                                            <img src="{{ asset('frontend/images/english-program/videos.jpg') }}" alt="Podcast Image 1" class="img-fluid" />
                                                        </a>
                                                    @endif
                                                    <h5 class="mt-2 text-dark">Inspiring Stories</h5>
                                                </div>
                                            </div>

                                            <!-- Podcasts Section -->
                                            <div class="col-md-6 col-lg-4 col-sm-12 mt-2">
                                                <h2 class="text-dark mt-3">Engaging Podcasts</h2>
                                                <p>Tune into our podcasts for insightful discussions.</p>
                                                <div class="main-card p-2 engaging-podcast">
                                                    @if(Auth::check() && Auth::user()->role == 'user'  && $doc_verified[0]->identity_is_approved == "Approved")
                                                        <a href="{{route('podcast-view',['section_id'=> base64_encode(getCourseSectionId('Intermediate Podcast'))])}}">
                                                        {{-- <a href="#"> --}}
                                                            <img src="{{ asset('frontend/images/english-program/podcast.jpg') }}" alt="Podcast Image 2" class="img-fluid" />
                                                        </a>
                                                    @else
                                                        <a href="#">
                                                            <img src="{{ asset('frontend/images/english-program/podcast.jpg') }}" alt="Podcast Image 2" class="img-fluid" />
                                                        </a>
                                                    @endif
                                                    <h5 class="mt-2 text-dark">Innovative Ideas</h5>
                                                </div>
                                            </div>

                                            <!-- Quizzes Section -->
                                            <div class="col-md-6 col-lg-4 col-sm-12 mt-2">
                                                <h2 class="text-dark mt-3">Interactive Quizzes</h2>
                                                <p>Test your knowledge with our fun quizzes.</p>
                                                <div class="main-card p-2">
                                                    @if(Auth::check() && Auth::user()->role == 'user'  && $doc_verified[0]->identity_is_approved == "Approved")
                                                        <a href="{{route('quiz-view',['section_id'=> base64_encode(getCourseSectionId('Intermediate'))])}}">
                                                        {{-- <a href="#"> --}}
                                                            <img src="{{ asset('frontend/images/english-program/quiz.jpg') }}" alt="Podcast Image 3" class="img-fluid" />
                                                        </a>
                                                    @else
                                                       <a href="#">
                                                        <img src="{{ asset('frontend/images/english-program/quiz.jpg') }}" alt="Podcast Image 3" class="img-fluid" />
                                                       </a>
                                                    @endif
                                                    <h5 class="mt-2 text-dark">Knowledge Check</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                    <div class="container mt-3">
                                        <div class="row mb-5 text-center">
                                            <!-- Featured Videos Section -->
                                            <div class="col-md-6 col-lg-4 col-sm-12 mt-2">
                                                <h2 class="text-dark mt-3">Featured Videos</h2>
                                                <p>Explore our latest video content.</p>
                                                <div class="main-card p-2 inspiringStories">
                                                    @if(Auth::check() && Auth::user()->role == 'user'  && $doc_verified[0]->identity_is_approved == "Approved")
                                                        <a href="{{route('video-instructions',['section_id'=> base64_encode(getCourseSectionId('Advanced'))])}}">
                                                        {{-- <a href="#"> --}}
                                                            <img src="{{ asset('frontend/images/english-program/videos.jpg') }}" alt="Podcast Image 1" class="img-fluid" />
                                                        </a>
                                                    @else
                                                        <a href="#">
                                                          <img src="{{ asset('frontend/images/english-program/videos.jpg') }}" alt="Podcast Image 1" class="img-fluid" />
                                                        </a>
                                                    @endif
                                                    <h5 class="mt-2 text-dark">Inspiring Stories</h5>
                                                </div>
                                            </div>

                                            <!-- Podcasts Section -->
                                            <div class="col-md-6 col-lg-4 col-sm-12 mt-2">
                                                <h2 class="text-dark mt-3 engaging-podcast">Engaging Podcasts</h2>
                                                <p>Tune into our podcasts for insightful discussions.</p>
                                                <div class="main-card p-2">
                                                    @if(Auth::check() && Auth::user()->role == 'user'  && $doc_verified[0]->identity_is_approved == "Approved")
                                                        <a href="{{route('podcast-view',['section_id'=> base64_encode(getCourseSectionId('Advanced Podcast'))])}}">
                                                        {{-- <a href="#"> --}}
                                                            <img src="{{ asset('frontend/images/english-program/podcast.jpg') }}" alt="Podcast Image 2" class="img-fluid" />
                                                        </a>
                                                    @else
                                                        <a href="#">
                                                            <img src="{{ asset('frontend/images/english-program/podcast.jpg') }}" alt="Podcast Image 2" class="img-fluid" />
                                                        </a>
                                                    @endif
                                                    <h5 class="mt-2 text-dark">Innovative Ideas</h5>
                                                </div>
                                            </div>

                                            <!-- Quizzes Section -->
                                            <div class="col-md-6 col-lg-4 col-sm-12 mt-2">
                                                <h2 class="text-dark mt-3">Interactive Quizzes</h2>
                                                <p>Test your knowledge with our fun quizzes.</p>
                                                <div class="main-card p-2">
                                                    @if(Auth::check() && Auth::user()->role == 'user'  && $doc_verified[0]->identity_is_approved == "Approved")
                                                        <a href="{{route('quiz-view',['section_id'=> base64_encode(getCourseSectionId('Advanced'))])}}">
                                                        {{-- <a href="#"> --}}
                                                            <img src="{{ asset('frontend/images/english-program/quiz.jpg') }}" alt="Podcast Image 3" class="img-fluid" />
                                                        </a>
                                                    @else
                                                        <a href="#">
                                                            <img src="{{ asset('frontend/images/english-program/quiz.jpg') }}" alt="Podcast Image 3" class="img-fluid" />
                                                        </a>
                                                    @endif
                                                    <h5 class="mt-2 text-dark">Knowledge Check</h5>
                                                </div>
                                            </div>
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
</div>

@endsection
