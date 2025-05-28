@extends('frontend.master') @section('content')
@section('content')
    <main>
        @php
            $data = $awardCourseData[0];
        @endphp
        <!-- Page header -->
        <section class="pt-lg-8 pt-5 pb-8 bg-primary order-1">
            <div class="container pb-lg-6">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-lg-8 col-md-12">
                        <div>
                            <h1 class="text-white display-5 fw-bold color-green ">
                                {{ isset($data['course_title']) ? $data['course_title'] : '' }}</h1>
                            <p class="text-white mb-6 fs-5">
                                {{ isset($data['course_subheading']) ? $data['course_subheading'] : '' }}
                            </p>
                            <div class="d-flex align-items-center">
                                <span class="text-white">
                                    <img src="{{ asset('frontend/images/icon/mqf-icon.svg') }}" alt="" width="15px">
                                    MQF/EQF Level: {{ isset($data['mqfeqf_level']) ? $data['mqfeqf_level'] : '' }}
                                </span>

                                <span class="text-white ms-3">
                                    <i class="bi bi-star-fill color-green  rating-star"></i>
                                    ECTS: {{ isset($data['ects']) ? $data['ects'] : '' }} Credits 
                                </span>


                                <span class="text-white ms-3">
                                    <i class="fe fe-user color-green"></i>
                                    0 Enrolled
                                </span>



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

                    <div class="col-lg-9 col-md-12 col-12 mt-md-n8 mt-n5 mb-4 mb-lg-0 order-lg-2 order-md-3 order-3 ">
                        <!-- Card -->
                        <div class="card rounded-3">
                            <!-- Card header -->
                            <div class="card-header border-bottom-0 p-0 ">
                                <div>
                                    <!-- Nav -->
                                    <ul class="nav nav-lb-tab" id="tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="progress-tab" data-bs-toggle="pill"
                                                href="#progress" role="tab" aria-controls="progress"
                                                aria-selected="true">Progress </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="overview-tab" data-bs-toggle="pill" href="#overview"
                                                role="tab" aria-controls="overview" aria-selected="false">
                                                Overview
                                            </a>
                                        </li>
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
                                                Course Content </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="assessment-tab" data-bs-toggle="pill" href="#assessment"
                                                role="tab" aria-controls="assessment"
                                                aria-selected="false">Assessment</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="tab-content" id="tabContent">

                                    <div class="tab-pane fade show active" id="progress" role="tabpanel"
                                        aria-labelledby="progress-tab">
                                        <!-- Card -->
                                        <div class="accordion" id="courseAccordion">
                                            <div>


                                                {{-- {{dd($data['course_manage'][0]['section_manage']['section_name'])}} --}}
                                                <!-- List group -->
                                                <ul class="list-group list-group-flush">
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    {{-- {{ $data['course_manage']['sections'] }} --}}
                                                    @foreach ($data['course_manage'] as $course_manage)
                                                     
                                                        @foreach ($course_manage['sections'] as $sections)
                                                            <li class="list-group-item px-0 pt-0">
                                                                <!-- Toggle -->
                                                                <a class="h4 mb-0 d-flex align-items-center active"
                                                                    data-bs-toggle="collapse"
                                                                    href="#course{{ $i }}" aria-expanded="false"
                                                                    aria-controls="course{{ $i }}">
                                                                    <div class="me-auto mt-2">
                                                                        {{ isset($sections['section_name']) ? $sections['section_name'] : '' }}
                                                                        <span class="mb-0 fs-6 mt-1 fw-normal">
                                                                            {{-- (150 Hours)  --}}
                                                                        </span>
                                                                    </div>
                                                                    <!-- Chevron -->
                                                                    <span class="chevron-arrow ms-4">
                                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                                    </span>
                                                                </a>
                                                                <!-- Row -->
                                                                <!-- Collapse -->
                                                                <div class="collapse" id="course{{ $i }}"
                                                                    data-bs-parent="#courseAccordion">
                                                                    <div class="pt-3 pb-2">
                                                                        <div class="mb-2">
                                                                            {{-- <div class="progress" style="height: 6px">
                                                                                <div class="progress-bar bg-blue progress-bar-striped progress-bar-animated"
                                                                                    role="progressbar" style="width: 45%"
                                                                                    aria-valuenow="10" aria-valuemin="0"
                                                                                    aria-valuemax="100"></div>
                                                                            </div>
                                                                            <small>45% Completed</small> --}}
                                                                        </div>
                                                                     
                                                                        @foreach ($sections['section_manage'] as $section_manage)
                                                                            @if (isset($section_manage['content_type_id']) && !empty($section_manage['content_type_id']) && $section_manage['content_type_id'] === 1)
                                                                                @foreach ($section_manage['course_video'] as $video)
                                                                                    <a href="course-resume.html"
                                                                                        class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                        <div class="text-truncate course-details-text-truncate">
                                                                                            <span
                                                                                                class="icon-shape bg-blue icon-sm rounded-circle me-2">
                                                                                                <i
                                                                                                    class="bi bi-play-fill color-green"></i>
                                                                                            </span>
                                                                                            <span
                                                                                                class="preview-course-heading">{{ isset($video['video_title']) ? $video['video_title'] : '' }}</span>

                                                                                        </div>
                                                                                        <div class="text-truncate">
                                                                                            <span>{{ 2 ? '12m 23s' : '<i class="bi bi-lock-fill"></i>' }}</span>
                                                                                        </div>
                                                                                    </a>
                                                                                @endforeach
                                                                            @elseif(!empty($section_manage['content_type_id']) && $section_manage['content_type_id'] === 2)
                                                                                @foreach ($section_manage['course_article'] as $docs)
                                                                                    <a href="#"
                                                                                        class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                        <div class="text-truncate">
                                                                                            <span
                                                                                                class="icon-shape bg-gray icon-sm rounded-circle me-2">
                                                                                                <i
                                                                                                    class="bi bi-file-earmark-pdf text-red"></i>
                                                                                            </span>
                                                                                            <span
                                                                                                class="preview-course-heading">{{ isset($docs['docs_title']) ? $docs['docs_title'] : '' }}</span>

                                                                                        </div>
                                                                                        <div class="text-truncate">
                                                                                            <span><i
                                                                                                    class="bi bi-lock-fill"></i></span>
                                                                                        </div>
                                                                                    </a>
                                                                                @endforeach
                                                                            @elseif(!empty($section_manage['content_type_id']) && $section_manage['content_type_id'] === 3)
                                                                            @foreach ($section_manage['course_quiz'] as $quiz)
                                                                                    <a href="#"
                                                                                        class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                                        <div class="text-truncate">
                                                        <span class="icon-shape text-primary icon-sm rounded-circle me-2 color-light-cyan">
                                    <i class="fe fe-help-circle nav-icon fs-6 color-cyan"></i></span>
                                                                                            <span
                                                                                                class="preview-course-heading">{{ isset($quiz['quiz_tittle']) ? $quiz['quiz_tittle'] : '' }}</span>

                                                                                        </div>
                                                                                        <div class="text-truncate">
                                                                                            <span><i
                                                                                                    class="bi bi-lock-fill"></i></span>
                                                                                        </div>
                                                                                    </a>
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                        {{-- @endif --}}
                                                                        {{-- <a href="course-resume.html" class="mb-2 d-flex justify-content-between align-items-center text-inherit">
                                                                <div class="text-truncate">
                                                                    <span class="icon-shape bg-blue icon-sm rounded-circle me-2">
                                                                        
                                                                        <i class="bi bi-play-fill color-green"></i>
                                                                    </span>
                                                                    <span class="preview-course-heading">Installing Development Software</span>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <span>3m 11s</span>
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
                                                            </a> --}}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="overview" role="tabpanel"
                                        aria-labelledby="overview-tab">
                                        {{ isset($data['overview']) ? htmlspecialchars($data['overview']) : '' }}

                                    </div>


                                    <div class="tab-pane fade" id="entry-requirements" role="tabpanel"
                                        aria-labelledby="entry-requirements-tab">
                                        <div class="mb-4">
                                            <div class="course__overview">
                                                {{ isset($data['entry_requirements']) ? htmlspecialchars($data['entry_requirements']) : '' }}
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
                                                            Gain a Comprehensive Understanding of the Course Syllabus with
                                                            Our Informative Podcast
                                                        </p>
                                                    </div>
                                                    <!-- Card -->
                                                    <div class="card mb-3 mb-4">

                                                        <div class="p-1">
                                                            @if (isset($data['other_video'][0]['bn_video_url_id']) &&
                                                                    !empty($data['other_video'][0]['bn_video_url_id']) &&
                                                                    !empty($data['other_video'][0]['video_type']) &&
                                                                    $data['other_video'][0]['video_type'] === '1')
                                                                <div class="d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover"
                                                                    style="background-image:url('https://{{env('THUMBNAIL_PULL_ID')}}/{{ $data['other_video'][0]['bn_video_url_id'] }}/thumbnail.jpg');height:210px;">

                                                                    <a class="glightbox icon-shape rounded-circle btn-play icon-xl"
                                                                        href="https://iframe.mediadelivery.net/embed/{{ env('AWARD_LIBRARY_ID') }}/{{ $data['other_video'][0]['bn_video_url_id'] }}?autoplay=false&loop=false&muted=false&preload=true&responsive=true">
                                                                        <i class="fe fe-play"></i>

                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    {{ isset($data['about_module']) ? htmlspecialchars($data['about_module']) : '' }}

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
                                                            {{ isset($data['assessment']) ? htmlspecialchars($data['assessment']) : '' }}
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
                            <div class="row mt-8">
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
                                <div class="col-md-4 mt-3 mt-md-0">
                                    <!-- Card -->
                                    <div class="card card-hover">
                                        <a href="#">
                                            <img src="{{ asset('frontend/images/course/award-recruitment-and-employee-selection.png') }}"
                                                alt="course" class="card-img-top"></a>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Award</span>
                                                <span class="badge bg-success-soft co-etcs">6 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="#"
                                                    class="text-inherit">Award
                                                    in Recruitment and Employee Selection</a></h4>

                                            <div class="lh-1 mt-3">

                                                <span class="fs-6">
                                                    <i class="fe fe-user color-blue"></i>
                                                    0 Enrolled
                                                </span>

                                            </div>
                                        </div>
                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <div class="col course-price-flex">
                                                    <h5 class="mb-0 course-price">€500</h5>
                                                    <h5 class="old-price">€1000 </h5>
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


                                <div class="col-md-4 mt-3 mt-md-0">
                                    <div class="card card-hover">
                                        <a href="#">
                                            <img src="{{ asset('frontend/images/course/award-training-development.png') }}"
                                                alt="course" class="card-img-top"></a>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Award</span>
                                                <span class="badge bg-success-soft co-etcs">30 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="#"
                                                    class="text-inherit">Award in Training and Development 
                                                    </a></h4>

                                            <div class="lh-1 mt-3">

                                                <span class="fs-6">
                                                    <i class="fe fe-user color-blue"></i>
                                                    0 Enrolled
                                                </span>

                                            </div>
                                        </div>
                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <div class="col course-price-flex">
                                                    <h5 class="mb-0 course-price">€500</h5>
                                                    <h5 class="old-price">€1000 </h5>
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


                                <div class="col-md-4 mt-3 mt-md-0">
                                    <div class="card card-hover">
                                        <a href="#">
                                            <img src="{{ asset('frontend/images/course/award-employee-and-labor-relation.png') }}"
                                                alt="course" class="card-img-top"></a>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Award</span>
                                                <span class="badge bg-success-soft co-etcs">60 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="#"
                                                    class="text-inherit">Award in Employee and Labour Relations </a></h4>

                                            <div class="lh-1 mt-3">

                                                <span class="fs-6">
                                                    <i class="fe fe-user color-blue"></i>
                                                    0 Enrolled
                                                </span>

                                            </div>
                                        </div>
                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <div class="col course-price-flex">
                                                    <h5 class="mb-0 course-price">€500</h5>
                                                    <h5 class="old-price">€1000 </h5>
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
                            </div>

                            {{-- Carousel Award Courses --}}

                        </div>


                    </div>

                    <div class="col-lg-3 col-md-12 col-12 course-preview-column order-lg-3 order-md-2 order-2">
                        <!-- Card -->
                        <div class="card mb-3 mb-2">
                            <div class="p-1">
                          
                                @if (isset($data['bn_course_trailer_url']) && !empty($data['bn_course_trailer_url']))
                                    <div class="d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover"
                                        style="background-image:url('https://{{env('THUMBNAIL_PULL_ID')}}/{{ $data['bn_course_trailer_url'] }}/thumbnail.jpg');height:210px;"> 

                                <a class="glightbox icon-shape rounded-circle btn-play icon-xl"
                                    href="https://iframe.mediadelivery.net/embed/{{env('AWARD_LIBRARY_ID')}}/{{ $data['bn_course_trailer_url'] }}">
                                    <i class="fe fe-play"></i>
                                </a>
                           </div>
                                  @endif
                        </div>
                        <!-- Card body -->
                        <div class="card-body p-3">
                            <!-- Price single page -->
                            <div class="mb-3 text-center">
                                <div class="text-dark fw-bold h2 color-blue">€{{isset($data['course_old_price']) ? htmlspecialchars($data['course_old_price']) : '' }}</div>
                                <del class="fs-4">€{{isset($data['course_final_price']) ? htmlspecialchars($data['course_final_price']) : '' }}</del>
                                <span class="course-off-discount">{{isset($data['scholarship']) ? htmlspecialchars($data['scholarship']) : '' }}% Scholarship</span>
                            </div>
                            <div class="d-grid"> </div>
                            
                                {{-- <a href="#" class="btn btn-primary mb-2 color-green fs-4">Buy Course</a> --}}
                              
                                    {{-- <input type='hidden' class="form-control promo_code_name" name="promo_code_name">
                                    <input type='hidden' class="form-control promo_code_discount" name="promo_code_discount"> --}}
                                   
                                 
                                    @if (Auth::check() && Auth::user()->role =='user')
                                   @php
                                       $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $data['id']]);
                                    @endphp
                                @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                   <a  href="{{route('start-course-panel',['course_id'=>base64_encode($data['id'])])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center"><i
                                            class="fe fe-play btn-outline-primary "></i> Play & Continue</a>
                                @else
                                      <form action="{{ route('checkout') }}" method="post">
                                    @csrf <!-- CSRF protection -->
                                    @php $total_full_price = $data['course_old_price'] - ($data['course_old_price'] - $data['course_final_price']) ; @endphp
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
                                    <a href="#" class="btn btn-outline-primary addtocart" id="addtocart" data-course-id="{{base64_encode($data['id'])}}" data-action="{{base64_encode('add')}}"><i class="fe fe-shopping-cart text-primary"></i> Add to Cart</a>
                                    </div>
                                 @endif      
                                 @else
                                  <a href='{{route('login')}}'><button class="btn btn-primary mb-2 color-green fs-4 w-100">Buy Course</button></a>
                                    <div class="d-grid">
                                        <a href="{{route('login')}}" class="btn btn-outline-primary"><i class="fe fe-shopping-cart text-primary"></i> Add to Cart</a>

                                    </div>
                                    @endif
                            </div>
                        </div>
                 
                    <!-- Card -->
                    <div class="card mb-4">
                        <div>
                            <!-- Card header -->
                            <div class="card-header">
                                <h4 class="mb-0">What’s included</h4>
                            </div>
                             <ul class="list-group list-group-flush">
                                    <li class="list-group-item bg-transparent">
                                        <i class="fe fe-calendar align-middle me-2 text-info"></i>
                                        {{isset($data['total_modules']) ?  $data['total_modules'] : 0}} Modules
                                    </li>
                                    <li class="list-group-item bg-transparent">
                                        <i class="fe fe-book align-middle me-2 text-success"></i>
                                        {{isset($data['total_lectures']) ?  $data['total_lectures'] : 0}} Lectures
                                    </li>
                                    <li class="list-group-item bg-transparent">
                                        <i class="fe fe-play-circle align-middle me-2 text-primary"></i>
                                       {{isset($data['total_learning']) ?  $data['total_learning'] : 0}} + Learning Hours 
                                    </li> 
                                    <li class="list-group-item bg-transparent">
                                        <i class="fe fe-award me-2 align-middle text-danger"></i>
                                        Certificate
                                        <!-- tooltip on top -->
                                        <i class="fe fe-info me-2 align-middle text-grey" data-bs-toggle="tooltip"
                                            data-placement="top"
                                            title="{{isset($data['certificate_id']) ?  $data['certificate_id'] : ''}}"></i>
                                    </li>

                                    <li class="list-group-item bg-transparent">
                                        <i class="fe fe-video align-middle me-2 text-secondary"></i>
                                        Access on mobile and TV
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="card courseDetailMentorCard">
                            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                  @php
                                    $implodeLecturer = explode(",",$data['lecturer_id']);
                                  @endphp


                                  @foreach($implodeLecturer as $key => $lecturesId)
                                  @php
                                  $id = base64_decode($lecturesId);
                                  $lecData = getData('lecturers_master',['lactrure_name','discription','designation',
                                'image'],['id'=>$id,'is_deleted'=>'No']);
                                  @endphp
                                    @php $show = '' @endphp
                                    @if($key == 0)
                                    @php $show = 'active' @endphp
                                     @endif
                                  @if (isset($lecData[0]->lactrure_name) && !empty($lecData[0]->lactrure_name))
                                    
                                      
                                        <div class="carousel-item {{$show}}" data-bs-interval="3000">
                                        <div class="card-body ">
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
                                                    <p class="mb-1 fs-6">{{isset($lecData[0]->designation) ?  $lecData[0]->designation : ''}}</p>
                                                </div>
                                            </div>
                                            <div class="border-top row pt-2 pb-3 mt-3 g-0">
                                                <div class="col">
                                                   {{isset($lecData[0]->discription) ? $lecData[0]->discription : ''}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                           <div class="carousel-item active" data-bs-interval="3000">
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
                                    @endforeach
                                </div>
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
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </main>
@endsection
