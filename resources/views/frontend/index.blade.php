@extends('frontend.master')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<style>
    .buy-now {
        background: none;
        border: none;
        color: rgb(27, 55, 177);
        cursor: pointer;
    }
    .buy-now:focus {
        outline: none;
    }
    .buy-now:active {
        color:rgb(8, 25, 122);
    }
    .swiper {
    /* width: 100% !important;  */
    /* max-width: 1100px; */
    /* margin: 0 auto;
    padding-bottom: 40px; */
}
    /* .swiper-slide {
    text-align: center !important;
    }
    .swiper-button-next:after{
        font-size: 17px !important;
        background: #e2e8f0;
        position: absolute;
        right: -10px;
        padding: 5px;
        border-radius: 5px;
    }
    .swiper-button-prev:after{
        font-size: 17px !important;
        background: #e2e8f0;
        position: absolute;
        left: -10px;
        padding: 5px;
        border-radius: 5px;
    } */
    
    /* .fade-in {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }
    img.loaded {
        opacity: 1;
    } */

    /* input[type="search"]::-webkit-search-results-decoration { display: none; } */
</style>

<div id="customModal" class="custom-modal-swal" style="display: none;">
    <div class="modal-content-swal">
      <div id="modalIcon" class="modal-icon-swal"></div>
      <h3 id="modalTitle" class="modal-title-swal"></h3>
      <p id="modalMessage" class="modal-message-swal"></p>
      <button id="modalCancel" class="modal-close-btn cancel-btn" style="display: none;">Cancel</button>
      <button id="modalOk" class="modal-close-btn ok-btn" style="display: none;">OK</button>
    </div>
  </div>

@if (session('response_data'))
<script>
    
    // Get the response data from the session and assign it to a JavaScript variable
    let responseData = @json(session('response_data'));
    function showModal(response, showButtons = false) {
      const modal = $("#customModal");
      const modalIcon = $("#modalIcon");
      const modalTitle = $("#modalTitle");
      const modalMessage = $("#modalMessage");

      modalIcon.html(`<img src="${response.icon}" alt="icon" style="width: 80px;">`);
      modalTitle.text(response.title);
      modalMessage.text(response.message);

      if (showButtons) {
        $("#modalOk").show();
        $("#modalCancel").show();
      } else {
        $("#modalOk").hide();
        $("#modalCancel").hide();
        setTimeout(function () {
          modal.hide();
        }, 3000);
      }

      modal.css("display", "flex");

      modal.on("click", function (event) {
        if ($(event.target).is(modal)) {
          modal.css("display", "none");
        }
      });

      $("#modalClose").on("click", function () {
        modal.css("display", "none");
      });
    }
    // Trigger the SweetAlert popup using the response data
    // swal({
    //     title: responseData.title,
    //     text: responseData.message,
    //     icon: responseData.icon,
    //     confirmButtonText: 'OK'
    // });
                        const modalData = {
                            title: responseData.title,
                            message: responseData.message,
                            icon: responseData.icon,
                        }
                        showModal(modalData);
</script>
@endif
@php
    $allowedRoles = ['institute', 'superadmin', 'admin', 'instructor', 'sub-instructor'];
@endphp
<!-- Slider Content -->
<section class="bg-primary hero-section">
    <div class="container">
        <!-- Hero Section -->
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="4000">
                    <div class="row align-items-center g-0">
                        <div class="col-xl-5 col-lg-6 col-md-12 ">
                            <div class="py-7 py-lg-0">
                                <h2 class=" display-4 slide-1-h2 bannerTitle">Blockchain-Encrypted Certificates</h2>
                                <p class="text-white-80 mb-4 lead bannerDescription">We ensure your achievements are secure, transparent, and globally recognised, setting you apart in your professional journey.</p>
                                
                                @if(!Auth::check())
                                    <a href="login-view" class="btn btn-dark btn-main-1 me-1 bannerButton">Enroll Now</a>
                                    {{-- <a href="#" class="btn btn-main-2 bannerButton">Learn More</a> --}}
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 col-md-12 text-lg-end text-center">
                            <img src="{{ asset('frontend/images/hero/blockchain_certificate.png') }}" alt="Student using a laptop for online learning on E-Ascencia's platform"
                                class="img-fluid"/>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <div class="row align-items-center g-0">
                        <div class="col-xl-5 col-lg-6 col-md-12 ">
                            <div class="py-7 py-lg-0">
                                <h2 class=" display-4 slide-1-h2 bannerTitle">Achieve Global Success with <br/> Self-Paced
                                    Learning. </h2>
                                <p class="text-white-80 mb-4 lead bannerDescription">Experience the flexibility and convenience of E-Ascencia’s learning platform, which offers self-paced courses and allows users to learn from anywhere at any time.</p>
                                
                                @if(!Auth::check())
                                    <a href="login-view" class="btn btn-dark btn-main-1 me-1 bannerButton">Enroll Now</a>
                                    <a href="student-enrollment" class="btn btn-main-2 bannerButton">Register
                                        Now</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 col-md-12 text-lg-end text-center">
                            <img src="{{ asset('frontend/images/hero/hero-img-1-main.webp') }}" alt="Student using a laptop for online learning on E-Ascencia's platform"
                                class="img-fluid"/>
                        </div>
                    </div>
                </div>

                <div class="carousel-item" data-bs-interval="4000">
                    <div class="row align-items-center g-0">
                        <div class="col-xl-5 col-lg-6 col-md-12 ">
                            <div class="py-7 py-lg-0">
                                <h2 class=" display-4 slide-2-h2 bannerTitle">Created, developed and accredited by
                                    Ascencia Malta.
                                </h2>
                                <p class="text-white-80 mb-4 lead bannerDescription">Transform your potential and reach
                                    new heights with the personalized guidance of our experienced and dedicated mentors.
                                </p>
                                @if(!Auth::check())
                                    <a href="login-view" class="btn btn-dark btn-main-1 me-1 bannerButton">Are You an
                                        E-Mentor?</a>
                                @endif
                                {{-- <a href="#" class="btn  btn-main-2 bannerButton" onclick="return false;">Learn More</a> --}}

                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 col-md-12 text-lg-end text-center">
                            <img src="{{ asset('frontend/images/hero/hero-img-2-main.webp') }}" alt="Inspiring educational journey with Ascencia Malta mentors"
                                class="img-fluid"/>
                        </div>
                    </div>
                </div>

                <div class="carousel-item" data-bs-interval="4000">
                    <div class="row align-items-center g-0">
                        <div class="col-xl-5 col-lg-6 col-md-12 ">
                            <div class="py-7 py-lg-0">
                                <h2 class=" display-4 slide-3-h2 bannerTitle">Recognised worldwide by the European
                                    Qualifications
                                    Framework (EQF).
                                </h2>
                                <p class="text-white-80 mb-4 lead bannerDescription">Our programs boast global
                                    recognition through accreditation by the prestigious European Qualifications
                                    Framework.</p>

                                {{-- <a href="#" class="btn  btn-main-2 bannerButton" onclick="return false;">Learn More</a> --}}
                                @if(!Auth::check())
                                    <a href="student-enrollment" class="btn btn-dark btn-main-1 me-1 bannerButton">Register
                                    Now</a>
                                @endif

                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 col-md-12 text-lg-end text-center">
                            <img src="{{ asset('frontend/images/hero/hero-img-3-main.webp') }}" alt="Accredited programs recognized by the European Qualifications Framework"
                                class="img-fluid"/>
                        </div>
                    </div>
                </div>

            </div>
            <a class="carousel-control-prev banner-carouse-prev" href="#carouselExampleInterval" role="button"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next banner-carousel-next" href="#carouselExampleInterval" role="button"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>
</section>
<section class="bg-white py-4 shadow-sm">
    <div class="container">
        <div class="row align-items-center g-0">
            <!-- Features -->
            <div class="col-xl-4 col-lg-4 col-md-6 mb-lg-0 mb-4">
                <div class="d-flex align-items-center">
                    <span class="icon-shape icon-lg bg-blue-light rounded-circle text-center color-blue fs-4">
                        <i class="fe fe-video"></i>
                    </span>
                    <div class="ms-3">
                        <h4 class="mb-0 fw-semibold">Explore Online Courses</h4>
                        <p class="mb-0 learning-opportunitie-title">Diverse learning opportunities await.</p>
                    </div>
                </div>
            </div>
            <!-- Features -->
            <div class="col-xl-4 col-lg-4 col-md-6 mb-lg-0 mb-4">
                <div class="d-flex align-items-center">
                    <span class="icon-shape icon-lg bg-blue-light rounded-circle text-center color-blue fs-4">
                        <i class="fe fe-users"></i>
                    </span>
                    <div class="ms-3">
                        <h4 class="mb-0 fw-semibold">Our Expert E-Mentors</h4>
                        <p class="mb-0">Guidance from trusted professionals.</p>
                    </div>
                </div>
            </div>
            <!-- Features -->
            <div class="col-xl-4 col-lg-4 col-md-6 mb-lg-0 mb-4">
                <div class="d-flex align-items-center">
                    <span class="icon-shape icon-lg bg-blue-light rounded-circle text-center color-blue fs-4">
                        <i class="fe fe-clock"></i>
                    </span>
                    <div class="ms-3">
                        <h4 class="mb-0 fw-semibold">Our Learning Community</h4>
                        <p class="mb-0">Connect, collaborate, and excel together.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- New on E-Ascencia -->
<section class="course-category-tabs-main pt-5">
    <!-- row -->
    <div class="container mb-lg-3">
        <div class="row">
            <!-- col -->
            <div class="col-12">
                <div class="mb-3">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <h1 class="mb-1 h1 fw-bold fs-md-3 sectionheading">New Courses on E-Ascencia!</h1>
                        <small class="promo-code text-primary rounded p-1 promo_code_blink mt-2 mt-md-0 mb-2 mb-md-0">
                            <span class="badge badge-success text-primary badge_icon flickering_text_styling" style="padding: 5px 20px; font-size:19px; user-select: none;">
                                Secure your 50% scholarship - <br class="d-md-none"> apply this  <b>WELCOME50</b> code today!
                            </span>
                        </small>
                    </div>
                    <p>
                        Explore Our Latest Programs Tailored to Meet Industry Demands.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            @php

            $awardCourses =
            getData('course_master',['temp_count','course_title','id','selling_price','ects','course_thumbnail_file','course_old_price','course_final_price','scholarship'],['status'=>3],1,'published_on','desc');
            
            $courses = DB::table('course_master')->select('temp_count','course_title','id','selling_price','ects','course_thumbnail_file','course_old_price','course_final_price','scholarship','status','category_id')->where('status','!=','2')->whereNotNull('published_on')->orderBy('category_id','desc')->orderBy('published_on','desc')->limit(4)->get();
            @endphp
            @if (Auth::check() && Auth::user()->role =='user')
                @php $doc_verified = getData('student_doc_verification',['english_level','english_score','identity_is_approved','edu_is_approved'],['student_id'=>Auth::user()->id]);@endphp
            @endif
                
            {{-- <div class="col-md-6 col-sm-12 col-lg-3 mt-3">
                <!-- Card -->
                <div class="card card-hover">
                    <a href="{{route('get-course-details',['course_id'=>base64_encode($awardCourses[0]->id)])}}">
                        <img src="{{ Storage::url($awardCourses[0]->course_thumbnail_file) }}" alt="course"
                            class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;" loading="lazy">
                    </a>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-info-soft co-category">Award</span>
                            @if(isset($awardCourses[0]->ects) && !empty($awardCourses[0]->ects))<span class="badge bg-success-soft co-etcs">{{isset($awardCourses[0]->ects) ? $awardCourses[0]->ects : ''}}
                                ECTS</span>@endif
                        </div>
                        <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                href="{{route('get-course-details',['course_id'=>base64_encode($awardCourses[0]->id)])}}"
                                class="text-inherit">{{isset($awardCourses[0]->course_title) ? $awardCourses[0]->course_title : ''}}</a>
                        </h4>
                        <span class="text-dark">
                            <i class="fe fe-user"></i>
                            @php $CountEnrolled = is_enrolled('',$awardCourses[0]->id);@endphp {{$CountEnrolled}} Enrolled
                        </span> 

                    </div>
                    <!-- Card Footer -->
                    <div class="card-footer">
                        <div class="row align-items-center g-0">
                            <div class="col course-price-flex">
                                <h5 class="mb-0 course-price">€{{isset($awardCourses[0]->course_final_price) ?
                                    $awardCourses[0]->course_final_price : 0}}</h5>
                                @if(isset($awardCourses[0]->course_old_price) && $awardCourses[0]->course_old_price > 0) <h5 class="old-price">€ {{isset($awardCourses[0]->course_old_price) ?
                                    $awardCourses[0]->course_old_price : 0}} </h5>@endif
                            </div>

                            <div class="col-auto">
                                @if (Auth::check() && Auth::user()->role =='user')
                                    @php
                                        $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $awardCourses[0]->id]);
                                    @endphp
                                    @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
 
                                            @php
                                                $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $awardCourses[0]->id ], "", 'created_at');
                                            @endphp
                                            @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                <a  href="{{route('start-course-panel',['course_id'=>base64_encode($awardCourses[0]->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="fe fe-play btn-outline-primary " ></i> Play</a>
                                            @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                                <a  href="{{route('start-course-panel',['course_id'=>base64_encode($awardCourses[0]->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="fe fe-play btn-outline-primary " ></i> Play</a>
                                            @else
                                            <div class="d-flex">
                                                @php
                                                    $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $awardCourses[0]->id,'status'=>'Active']);
                                                @endphp
                                                @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                    <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px"/></a>
                                                @else 
                                                    <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px"/></a>

                                                @endif
                                                <form action="{{ route('checkout') }}" method="post">
                                                    @csrf <!-- CSRF protection -->
                                                    @php $total_full_price = $awardCourses[0]->course_old_price - ($awardCourses[0]->course_old_price - $awardCourses[0]->course_final_price) ; @endphp
                                                    <input type='hidden' value="{{base64_encode($awardCourses[0]->id)}}" name="course_id" id="course_id">
                                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($awardCourses[0]->course_old_price)}}">
                                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($awardCourses[0]->course_old_price -$awardCourses[0]->course_final_price)}}">
                                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                    <button class="buy-now">Buy Now</button>
                                                </form>
                                            </div>
                                            @endif
                                    @else
                                    <div class="d-flex">
                                        @php
                                            $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $awardCourses[0]->id,'status'=>'Active']);
                                        @endphp
                                        @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px"/></a>
                                        @else 
                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px"/></a>
                                        @endif
                                        <form action="{{ route('checkout') }}" method="post">
                                        @csrf <!-- CSRF protection -->
                                        @php $total_full_price = $awardCourses[0]->course_old_price - ($awardCourses[0]->course_old_price - $awardCourses[0]->course_final_price) ; @endphp
                                        <input type='hidden' value="{{base64_encode($awardCourses[0]->id)}}" name="course_id" id="course_id">
                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($awardCourses[0]->course_old_price)}}">
                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($awardCourses[0]->course_old_price -$awardCourses[0]->course_final_price)}}">
                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                        <button class="buy-now">Buy Now</button>
                                        </form>
                                    </div>
                                    @endif      
                                @else
                                    <div class="d-flex">
                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}" data-withcart="withcart"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px"/></a>
                                        <form action="{{ route('checkout') }}" method="post">
                                            @csrf <!-- CSRF protection -->
                                            @php $total_full_price = $awardCourses[0]->course_old_price - ($awardCourses[0]->course_old_price - $awardCourses[0]->course_final_price) ; @endphp
                                            <input type='hidden' value="{{base64_encode($awardCourses[0]->id)}}" name="course_id" id="course_id">
                                            <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($awardCourses[0]->course_old_price)}}">
                                            <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($awardCourses[0]->course_old_price -$awardCourses[0]->course_final_price)}}">
                                            <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                            <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                            <button class="buy-now">Buy Now</button>
                                        </form>
                                    </div>
    
                                @endif
                            </div>
                        </div>

                        <div class="col-auto course-saved-btn">
                            @if (Auth::check() && Auth::user()->role =='user')
                                @php
                                    $isWishlist = is_exist('wishlist', ['student_id' => Auth::user()->id,'status'=>'Active','cart_wishlist' => '0','course_id'=> $awardCourses[0]->id]);
                                @endphp
                                @if (isset($isWishlist) && !empty($isWishlist) && is_numeric($isWishlist) &&  $isWishlist > 0) 
                                    @php $showicon="bi heart-icon bi-heart-fill";@endphp
                                @else
                                    @php $showicon="bi bi-heart heart-icon";@endphp
                                @endif
                                    <a  class="text-inherit addwishlist" aria-label="Add to Wishlist" data-course-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('wishlist')}}"><i class="{{$showicon}}"></i></a>
                            @else
                                <a  class="text-inherit addwishlist" aria-label="Add to Wishlist" data-course-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('wishlist')}}" data-withwishlist="withwishlist"><i class="bi bi-heart heart-icon"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div> --}}
            @if (isset($courses))
            @foreach ($courses as $course)
            {{-- @if($course->id != $awardCourses[0]->id) --}}
            <div class="col-md-6 col-sm-12 col-lg-4 col-xl-3 mt-3">
                @if($course->status != '2')
                <div class="item">
                    @if (isset($course->category_id) && !empty($course->category_id) && $course->category_id === 1)
                        @php $LINK = route('get-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                    @else
                        @php $LINK = route('get-master-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                    @endif
                    @if($course->status == '3')
                        @if (isset($course->category_id) && !empty($course->category_id) && $course->category_id === 5)
                            
                            <div class="card card-hover">
                                <a href="{{ route('dba-course-details',['course_id'=>base64_encode($course->id)]) }}">
                                    <img src="{{ Storage::url($course->course_thumbnail_file) }}" alt="course"
                                        class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;" loading="lazy">
                                </a>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge bg-info-soft co-category">DBA</span>
                                        {{-- <span class="badge bg-success-soft co-etcs">NA</span>              --}}
                                    </div>
                                    <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                            href="{{ route('dba-course-details',['course_id'=>base64_encode($course->id)]) }}"
                                            class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                                    </h4>
                                    <div class="d-flex align-items-center justify-content-between mt-1 promo_code_division">
                                        <span class="text-dark enroll_icon">
                                            <i class="fe fe-user"></i>
                                            @php $CountEnrolled = $course->temp_count;@endphp {{$CountEnrolled}} Enrolled
                                        </span>
                                        @php $promoCode = getCoursePromoCode($course->id);@endphp
                                        @if($promoCode)
                                            <small class="promo-code text-primary rounded p-1">
                                            <span class="badge badge-success text-primary badge_icon" style="padding: 2px 4px"><span style="user-select: none">PROMO:</span> <span class="fw-bolder">{{$promoCode}}</span></span>
                                            </small>
                                        @endif
                                    </div>
            
                                </div>
                                <!-- Card Footer -->
                                <div class="card-footer" style="min-height: 65px">
                                    <div class="row align-items-center g-0">
                                        <div class="col course-price-flex">
                                            <h5 class="mb-0 course-price">€{{$course->course_final_price}}<small>{{''.'/ per year'}}</small></h5>
                                            @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                             $course->course_old_price : 0}} </h5>@endif
                                        </div>
            
                                    <div class="col-auto">
                                            @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                            @elseif (Auth::check() && Auth::user()->role =='user')
                                            @php 
                                                $doc_verified = getData('student_doc_verification',['english_score','identity_is_approved','edu_is_approved','identity_doc_file','edu_doc_file','resume_file','edu_trail_attempt','identity_trail_attempt','english_test_attempt','proposal_is_approved'],['student_id'=>Auth::user()->id]);
                                                $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $course->id]); 
                                            @endphp
                                                @if(Auth::user()->apply_dba == 'Yes')
                                                    @if($doc_verified[0]->identity_is_approved = "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->resume_file != ''  && $doc_verified[0]->english_score >= 10 & $doc_verified[0]->proposal_is_approved == 'Approved') 
                                                        @if (isset($isPaid)  && is_numeric($isPaid) && $isPaid == 0)
                                                            <div class="d-flex" style="padding: 0px"> 
                                                                <form action="{{ route('checkout') }}" method="post">
                                                                @csrf <!-- CSRF protection -->
                                                                @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                <button class="buy-now">Buy Now</button>
                                                                </form>
                                                            </div>
                                                        @endif 
                                                    @else
                                                        <a href="{{route('student-document-verification')}}"><button class="buy-now">Buy Now</button></a>
                                                    @endif
                                                @else
                                                    @if (isset($isPaid)  && is_numeric($isPaid) && $isPaid == 0)
                                                        <div class="d-flex" style="padding: 0px"> 
                                                            <form action="{{ route('checkout') }}" method="post">
                                                            @csrf <!-- CSRF protection -->
                                                            @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                            <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                            <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                            <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                            <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                            <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                            <button class="buy-now">Buy Now</button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                @endif
                                                   
                                            @else
                                                <div class="d-flex" style="padding: 0px"> 
                                                    <form action="{{ route('checkout') }}" method="post">
                                                    @csrf <!-- CSRF protection -->
                                                    @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                    <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                    <button class="buy-now">Buy Now</button>
                                                    </form>
                                                </div>
                                            @endif     
                                        </div>
                                    </div>
            
                                    {{-- <div class="col-auto course-saved-btn">
            
                                    </div> --}}
                                </div>
                            </div>
                        @else
                            <!-- Card -->
                            <div class="card card-hover">
                                <a href="{{$LINK}}">
                                    <img src="{{ Storage::url($course->course_thumbnail_file) }}" alt="course"
                                        class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;" loading="lazy">
                                </a>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        @if (isset($course->category_id) && !empty($course->category_id) &&
                                        $course->category_id === 1)
                                        <span class="badge bg-info-soft co-category">Award</span>
                                        @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                        $course->category_id === 2)
                                        <span class="badge bg-info-soft co-category">Certificate</span>
                                        @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                        $course->category_id === 3)
                                        <span class="badge bg-info-soft co-category">Diploma</span>
                                        @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                        $course->category_id === 4)
                                        <span class="badge bg-info-soft co-category">Masters</span>
                                        @endif                                    
                                        @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ? $course->ects : ''}} ECTS</span> @endif                
                                    </div>
                                    <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                            href="{{$LINK}}"
                                            class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                                    </h4>
                                    <div class="d-flex align-items-center justify-content-between mt-1 promo_code_division">
                                        <span class="text-dark enroll_icon">
                                            <i class="fe fe-user"></i>
                                            {{-- @php $CountEnrolled = is_enrolled('',$course->id);@endphp {{$CountEnrolled}} Enrolled --}}
                                            @php $CountEnrolled = $course->temp_count;@endphp {{$CountEnrolled}} Enrolled
                                        </span>
                                        @php $promoCode = getCoursePromoCode($course->id);@endphp
                                        @if($promoCode)
                                            <small class="promo-code text-primary rounded p-1">
                                            <span class="badge badge-success text-primary badge_icon" style="padding: 2px 4px"><span style="user-select: none">PROMO:</span> <span class="fw-bolder">{{$promoCode}}</span></span>
                                            </small>
                                        @endif
                                    </div>
                                    
            
                                </div>
                                <!-- Card Footer -->
                                <div class="card-footer" style="min-height: 65px">
                                    <div class="row align-items-center g-0">
                                        <div class="col course-price-flex">
                                            <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                                $course->course_final_price : 0}}</h5>
                                            @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                                $course->course_old_price : 0}} </h5>@endif
                                        </div>

                                        <div class="col-auto">
                                            @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                            @elseif (Auth::check() && Auth::user()->role =='user')
                                                @php
                                                    $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $course->id]);
                                                @endphp
                                                @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                                        @php
                                                            $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $course->id,'is_deleted'=>'No'], "", 'created_at');
                                                            if (isset($course->category_id) && !empty($course->category_id) && $course->category_id === 1){
                                                                $playLink = "start-course-panel";
                                                            }else{
                                                                $playLink = "master-course-panel";
                                                            }

                                                        @endphp
                                                        @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                            <a  href="{{route($playLink,['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4" ></i> Play</a>
                                                        @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                                            <a  href="{{route($playLink,['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4" ></i> Play</a>
                                                        @else
                                                        <div class="d-flex" style="padding: 0px"> 
                                                            @php
                                                                $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                            @endphp
                                                            @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px"/></a>
                                                            @else 
                                                                <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px"/></a>
                                                            @endif
                                                            <form action="{{ route('checkout') }}" method="post">
                                                                @csrf
                                                                @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                <button class="buy-now">Buy Now</button>
                                                            </form>
                                                        </div>
                                                        @endif
                                                @else
                                                <div class="d-flex" style="padding: 0px"> 
                                                    @php
                                                        $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                    @endphp
                                                    @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px"/></a>
                                                    @else 
                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px"/></a>
                                                    @endif
                                                
                                                    <form action="{{ route('checkout') }}" method="post">
                                                    @csrf <!-- CSRF protection -->
                                                    @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                    <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                    <button class="buy-now">Buy Now</button>
                                                    </form>
                                                </div>
                                                @endif      
                                            @else
                                                <div class="d-flex">
                                                    <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}" data-withcart="withcart"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px"/></a>
                                                    <form action="{{ route('checkout') }}" method="post">
                                                        @csrf <!-- CSRF protection -->
                                                        @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                        <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price - $course->course_final_price)}}">
                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                        <button class="buy-now">Buy Now</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                    @else
                                    <div class="col-auto course-saved-btn">    
                                        @if (Auth::check() && Auth::user()->role =='user')
                                            @php
                                                $isWishlist = is_exist('wishlist', ['student_id' => Auth::user()->id,'status'=>'Active','cart_wishlist' => '0','course_id'=> $course->id]);
                                            @endphp
                                            @if (isset($isWishlist) && !empty($isWishlist) && is_numeric($isWishlist) &&  $isWishlist > 0) 
                                                @php $showicon="bi heart-icon bi-heart-fill";@endphp
                                            @else
                                                @php $showicon="bi bi-heart heart-icon";@endphp
                                            @endif
                                                <a  class="text-inherit addwishlist" aria-label="Add to Wishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}"><i class="{{$showicon}}"></i></a>
                                        @else
                                        <a  class="text-inherit addwishlist" aria-label="Add to Wishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}" data-withwishlist="withwishlist"><i class="bi bi-heart heart-icon"></i></a>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="card card-hover">
                            <a href="{{$LINK}}">
                                <img src="{{ Storage::url($course->course_thumbnail_file) }}" alt="course"
                                class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;" loading="lazy">
                            </a>
                            
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    @if (isset($course->category_id) && !empty($course->category_id) &&
                                    $course->category_id === 1)
                                    <span class="badge bg-info-soft co-category">Award</span>
                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                    $course->category_id === 2)
                                    <span class="badge bg-info-soft co-category">Certificate</span>
                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                    $course->category_id === 3)
                                    <span class="badge bg-info-soft co-category">Diploma</span>
                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                    $course->category_id === 4)
                                    <span class="badge bg-info-soft co-category">Masters</span>
                                    @endif                                    
                                    @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ? $course->ects : ''}} ECTS</span>@endif
                                </div>
                                <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                        href="{{$LINK}}"
                                        class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                                </h4>
                            </div>
                            <!-- Card Footer -->
                            <div class="card-footer" style="min-height: 65px">
                                <div class="row align-items-center g-0"  style="VISIBILITY: HIDDEN;">
                                    <div class="col course-price-flex">
                                        <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                            $course->course_final_price : 0}}</h5>
                                        @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                            $course->course_old_price : 0}} </h5>@endif
                                    </div>

                                    <div class="col-auto">
                                        <a class="text-inherit"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                        <a class="buy-now">Buy Now</a>
                                    </div>
                                </div>

                                <div class="col-auto course-saved-btn"   style="VISIBILITY: HIDDEN;">
                                    <a class="text-reset bookmark"><i class="bi bi-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @endif
            </div>
            {{-- @endif --}}
            @endforeach
            @endif
        </div>
    </div>
</section>




<!-- Top Course Category with Tabs -->
<section class="course-category-tabs-main pt-5">
    <!-- row -->
    <div class="container mb-lg-8">
        <div class="row">
            <!-- col -->
            <div class="col-12">
                <div class="mb-4">
                    <h1 class="mb-1 h1 fw-bold sectionheading">Discover Top Courses</h1>
                    <p>
                        Explore handpicked top-class courses crafted to enhance your learning experience and expertise
                        effortlessly.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Nav tab -->
                <ul class="nav nav-lb-tab mb-6 bg-gray-200 px-5 rounded-3" id="pills-tab" role="tablist">
                     <!-- nav item -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" href="#pills-all" role="tab"
                            aria-controls="pills-all" aria-selected="false">All</a>
                    </li>
                    <!-- nav item -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-award-tab" data-bs-toggle="pill" href="#pills-award"
                            role="tab" aria-controls="pills-award" aria-selected="false">
                            Award
                        </a>
                    </li>
                    <!-- nav item -->
                     <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-certificate-tab" data-bs-toggle="pill" href="#pills-certificate"
                            role="tab" aria-controls="pills-certificate" aria-selected="false">Certificate</a>
                    </li>
                    <!-- nav item -->
                     <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-diploma-tab" data-bs-toggle="pill" href="#pills-diploma"
                            role="tab" aria-controls="pills-diploma" aria-selected="false">
                            Diploma
                        </a>
                    </li>
                    <!-- nav item -->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-masters-tab" data-bs-toggle="pill" href="#pills-masters"
                            role="tab" aria-controls="pills-masters" aria-selected="true">
                            Masters
                        </a>
                    </li>
                    <!-- nav item -->
                     <li class="nav-item" role="presentation">
                        <a class="nav-link " id="pills-dba-tab" data-bs-toggle="pill" href="#pills-dba"
                            role="tab" aria-controls="pills-dba" aria-selected="true">
                            DBA
                        </a>
                    </li>
                  
                   
                   
                </ul>
                <!-- Tab content -->
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade" id="pills-dba" role="tabpanel" aria-labelledby="pills-dba-tab">
                        <div class="position-relative">
                            <ul class="controls" id="sliderSixthControls">
                                <li class="prev">
                                    <i class="fe fe-chevron-left"></i>
                                </li>
                                <li class="next">
                                    <i class="fe fe-chevron-right"></i>
                                </li>
                            </ul>
                            <div class="sliderSixth">
                                @php
                                $dba =
                                getData('course_master',['temp_count','course_title','id','selling_price','ects','course_final_price','course_old_price','course_thumbnail_file','status'],['category_id'=>'5',['status','!=','2']],'',DB::raw('IFNULL(published_on, "NULL")'),'asc');
                                @endphp
                                @if (count($dba) > 0)
                                    @foreach ($dba as $course) 
                                    @if($course->status != '2')
                                    <div class="item">
                                        <!-- Card -->
                                        @if($course->status == '3')
                                            <div class="card card-hover mb-3">
                                                <a
                                                    href="{{route('dba-course-details',['course_id'=>base64_encode($course->id)])}}"><img
                                                        src="{{ Storage::url($course->course_thumbnail_file) }}"
                                                        alt="course" class="card-img-top object-fit-cover img-fluid fade-in" loading="lazy"></a>
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="badge bg-info-soft co-category">DBA</span>
                                                        @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ?
                                                            $course->ects : ''}} ECTS</span>@endif
                                                    </div>
                                                    <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                                            href="{{route('dba-course-details',['course_id'=>base64_encode($course->id)])}}"
                                                            class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a></h4>
                                                    <div class="d-flex align-items-center justify-content-between mt-1 promo_code_division">
                                                        <span class="text-dark enroll_icon">
                                                            <i class="fe fe-user"></i>
                                                            {{-- @php $CountEnrolled = is_enrolled('',$course->id);@endphp {{$CountEnrolled}} Enrolle --}}
                                                            @php $CountEnrolled = $course->temp_count;@endphp {{$CountEnrolled}} Enrolled
                                                        </span> 
                                                        @php $promoCode = getCoursePromoCode($course->id);@endphp
                                                        @if($promoCode)
                                                            <small class="promo-code text-primary rounded p-1">
                                                            <span class="badge badge-success text-primary badge_icon" style="padding: 2px 4px"><span style="user-select: none">PROMO:</span> <span class="fw-bolder">{{$promoCode}}</span></span>
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- Card Footer -->
                                                <div class="card-footer" style="min-height: 65px">
                                                    <div class="row align-items-center g-0">
                                                        <div class="col course-price-flex">
                                                            <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                                                $course->course_final_price : 0}}<small>{{''.'/ per year'}}</small></h5>
                                                            @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                                                $course->course_old_price : 0}} </h5>@endif
                                                        </div>

                                                        <div class="col-auto">
                                                            @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                                            @elseif (Auth::check() && Auth::user()->role =='user')
                                                                @php 
                                                                    $doc_verified = getData('student_doc_verification',['english_score','identity_is_approved','edu_is_approved','identity_doc_file','edu_doc_file','resume_file','edu_trail_attempt','identity_trail_attempt','english_test_attempt','proposal_is_approved'],['student_id'=>Auth::user()->id]);
                                                                    $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $course->id]);
                                                                @endphp
                                                                @if(Auth::user()->apply_dba == 'Yes')
                                                                    @if($doc_verified[0]->identity_is_approved == "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->resume_file != ''  && $doc_verified[0]->english_score >= 10 && $doc_verified[0]->proposal_is_approved == 'Approved')
                                                                        @if (isset($isPaid) && is_numeric($isPaid) &&  $isPaid ==  0)
                                                                            <div class="d-flex">
                                                                                <form action="{{ route('checkout') }}" method="post">
                                                                                @csrf <!-- CSRF protection -->
                                                                                @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                                <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                                <button class="buy-now">Buy Now</button>
                                                                                </form>
                                                                            </div>
                                                                        @endif
                                                                    @else
                                                                        <a href="{{route('student-document-verification')}}"><button class="buy-now">Buy Now</button></a>
                                                                    @endif
                                                                @else
                                                                    @if (isset($isPaid) && is_numeric($isPaid) && $isPaid == 0)
                                                                        <div class="d-flex">
                                                                            <form action="{{ route('checkout') }}" method="post">
                                                                            @csrf <!-- CSRF protection -->
                                                                            @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                            <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                            <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                            <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                            <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                            <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                            <button class="buy-now">Buy Now</button>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @else
                                                                <div class="d-flex">
                                                                    <form action="{{ route('checkout') }}" method="post">
                                                                    @csrf <!-- CSRF protection -->
                                                                    @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                    <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                    <button class="buy-now">Buy Now</button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="card card-hover mb-3">
                                                <a
                                                href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"><img
                                                    src="{{ Storage::url($course->course_thumbnail_file) }}"
                                                    alt="course" class="card-img-top object-fit-cover img-fluid fade-in" loading="lazy"></a>
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="badge bg-info-soft co-category">DBA</span>
                                                        @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ? $course->ects : ''}}
                                                            ECTS</span>@endif
                                                    </div>
                                                    <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                                            href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"
                                                            class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                                                    </h4>
                                                </div>
                                                <!-- Card Footer -->
                                                <div class="card-footer" style="min-height: 65px">
                                                    <div class="row align-items-center g-0" style="VISIBILITY: HIDDEN;">
                                                        <div class="col course-price-flex">
                                                            <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                                                $course->course_final_price : 0}}</h5>
                                                            @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                                                $course->course_old_price : 0}} </h5>@endif
                                                        </div>
                            
                                                        <div class="col-auto">
                                                            {{-- <a class="text-inherit"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a> --}}
                                                            <a class="buy-now">Buy Now</a>
                                                        </div>
                                                    </div>
                            
                                                    <div class="col-auto course-saved-btn"   style="VISIBILITY: HIDDEN;">
                                                        <a class="text-reset bookmark"><i class="bi bi-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @endif
                                    @endforeach
                                @else
                                    <img src="{{ asset('frontend/images/ComingSoon.png') }}" alt="Master" class="img-fluid coming-soon-image" loading="lazy"/>
                                @endif
                            </div>

                        </div>
                        <div class="mt-8">
                            <a href="{{route('dba-courses')}}" class="btn btn-outline-primary">Browse all</a>
                        </div>
                    </div>
                    <!-- Masters Tab Pane -->
                    <div class="tab-pane fade" id="pills-masters" role="tabpanel" aria-labelledby="pills-masters-tab">
                        <div class="position-relative">
                            <ul class="controls" id="sliderFourthControls">
                                <li class="prev">
                                    <i class="fe fe-chevron-left"></i>
                                </li>
                                <li class="next">
                                    <i class="fe fe-chevron-right"></i>
                                </li>
                            </ul>
                            <div class="sliderFourth">
                                @php
                                $masters =
                                getData('course_master',['temp_count','course_title','id','selling_price','ects','course_final_price','course_old_price','course_thumbnail_file','status'],['category_id'=>'4',['status','!=','2']],'',DB::raw('IFNULL(published_on, "NULL")'),'asc');
                                @endphp
                                @if (count($masters) > 0)
                                    @foreach ($masters as $course) 
                                    @if($course->status != '2')
                                    <div class="item">
                                        <!-- Card -->
                                        @if($course->status == '3')
                                            <div class="card card-hover mb-3">
                                                <a
                                                    href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"><img
                                                        src="{{ Storage::url($course->course_thumbnail_file) }}"
                                                        alt="course" class="card-img-top object-fit-cover img-fluid fade-in" loading="lazy"></a>
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="badge bg-info-soft co-category">Masters</span>
                                                        @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ?
                                                            $course->ects : ''}} ECTS</span>@endif
                                                    </div>
                                                    <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                                            href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"
                                                            class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a></h4>
                                                    <div class="d-flex align-items-center justify-content-between mt-1 promo_code_division">
                                                        <span class="text-dark enroll_icon">
                                                            <i class="fe fe-user"></i>
                                                            {{-- @php $CountEnrolled = is_enrolled('',$course->id);@endphp {{$CountEnrolled}} Enrolle --}}
                                                            @php $CountEnrolled = $course->temp_count;@endphp {{$CountEnrolled}} Enrolled
                                                        </span> 
                                                        @php $promoCode = getCoursePromoCode($course->id);@endphp
                                                        @if($promoCode)
                                                            <small class="promo-code font-weight-bold text-primary rounded p-1 badge_icon">
                                                            <span class="badge badge-success text-primary badge_icon" style="padding: 2px 4px"><span style="user-select: none">PROMO:</span> <span style="font-weight: 800">{{$promoCode}}</span></span>
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- Card Footer -->
                                                <div class="card-footer" style="min-height: 65px">
                                                    <div class="row align-items-center g-0">
                                                        <div class="col course-price-flex">
                                                            <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                                                $course->course_final_price : 0}}</h5>
                                                            @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                                                $course->course_old_price : 0}} </h5>@endif
                                                        </div>

                                                        <div class="col-auto">
                                                            @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                                            @elseif (Auth::check() && Auth::user()->role =='user')
                                                                @php
                                                                    $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $course->id]);
                                                                @endphp
                                                                @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                                                    {{-- @if(!empty($doc_verified) && $doc_verified[0]->identity_is_approved == "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->english_score >= 10 ) --}}
                                                                    @php
                                                                    $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $course->id,'is_deleted'=>'No' ], "", 'created_at');

                                                                    @endphp
                                                                    @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() && $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                                        <a  href="{{route('master-course-panel',['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4" ></i> Play</a>
                                                                    @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                                                        <a  href="{{route('master-course-panel',['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4 " ></i> Play</a>
                                                                    @else
                                                                    <div class="d-flex">
                                                                        @php
                                                                        $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                                        @endphp
                                                                        @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                        @else 
                                                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></i></a>
                                                                        @endif
                                                                        <form action="{{ route('checkout') }}" method="post">
                                                                        @csrf <!-- CSRF protection -->
                                                                        @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                        <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                        <button class="buy-now">Buy Now</button>
                                                                        </form>
                                                                    </div>
                                                                    @endif
                                                                @else
                                                                    <div class="d-flex">
                                                                        @php
                                                                        $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                                        @endphp
                                                                        @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                        @else 
                                                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></i></a>
                                                                        @endif
                                                                        <form action="{{ route('checkout') }}" method="post">
                                                                        @csrf <!-- CSRF protection -->
                                                                        @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                        <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                        <button class="buy-now">Buy Now</button>
                                                                        </form>
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class="d-flex">
                                                                    <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}" data-withcart="withcart"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                
                                                                    <form action="{{ route('checkout') }}" method="post">
                                                                    @csrf <!-- CSRF protection -->
                                                                    @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                    <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                    <button class="buy-now">Buy Now</button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                    
                                                        </div>
                                                    </div>
                                                    @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                                    @else
                                                    <div class="col-auto course-saved-btn">
                                                        @if (Auth::check() && Auth::user()->role =='user')
                                                            @php
                                                                $isWishlist = is_exist('wishlist', ['student_id' => Auth::user()->id,'status'=>'Active','cart_wishlist' => '0','course_id'=> $course->id]);
                                                            @endphp
                                                            @if (isset($isWishlist) && !empty($isWishlist) && is_numeric($isWishlist) &&  $isWishlist > 0) 
                                                                @php $showicon="bi heart-icon bi-heart-fill";@endphp
                                                            @else
                                                                @php $showicon="bi bi-heart heart-icon";@endphp
                                                            @endif
                                                            <a  class="text-inherit addwishlist" aria-label="Add to Wishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}"><i class="{{$showicon}}"></i></a>
                                                        @else
                                                            <a  class="text-inherit addwishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}" data-withwishlist="withwishlist"><i class="bi bi-heart heart-icon"></i></a>
                                                        @endif
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="card card-hover mb-3">
                                                <a
                                                href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"><img
                                                    src="{{ Storage::url($course->course_thumbnail_file) }}"
                                                    alt="course" class="card-img-top object-fit-cover img-fluid fade-in" loading="lazy"></a>
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="badge bg-info-soft co-category">Masters</span>
                                                        @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ? $course->ects : ''}}
                                                            ECTS</span>@endif
                                                    </div>
                                                    <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                                            href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"
                                                            class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                                                    </h4>
                                                </div>
                                                <!-- Card Footer -->
                                                <div class="card-footer" style="min-height: 65px">
                                                    <div class="row align-items-center g-0" style="VISIBILITY: HIDDEN;">
                                                        <div class="col course-price-flex">
                                                            <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                                                $course->course_final_price : 0}}</h5>
                                                            @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                                                $course->course_old_price : 0}} </h5>@endif
                                                        </div>
                            
                                                        <div class="col-auto">
                                                            <a class="text-inherit"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                            <a class="buy-now">Buy Now</a>
                                                        </div>
                                                    </div>
                            
                                                    <div class="col-auto course-saved-btn"   style="VISIBILITY: HIDDEN;">
                                                        <a class="text-reset bookmark"><i class="bi bi-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @endif
                                    @endforeach
                                @else
                                    <img src="{{ asset('frontend/images/ComingSoon.png') }}" alt="Master" class="img-fluid coming-soon-image" loading="lazy" />
                                @endif
                            </div>

                        </div>
                        <div class="mt-8">
                            <a href="{{route('masters-courses')}}" class="btn btn-outline-primary">Browse all</a>
                        </div>
                    </div>

                    <!-- Diploma Tab Pane -->
                    <div class="tab-pane fade" id="pills-diploma" role="tabpanel" aria-labelledby="pills-diploma-tab">
                        <div class="position-relative">
                            <ul class="controls" id="sliderThirdControls">
                                <li class="prev">
                                    <i class="fe fe-chevron-left"></i>
                                </li>
                                <li class="next">
                                    <i class="fe fe-chevron-right"></i>
                                </li>
                            </ul>
                            <div class="sliderThird">
                                @php
                                $diploma =
                                getData('course_master',['temp_count','course_title','id','selling_price','ects','course_final_price','course_old_price','course_thumbnail_file','status'],['category_id'=>'3',['status','!=','2']],'',DB::raw('IFNULL(published_on, "NULL")'),'asc');
                                // dd($diploma);
                                @endphp
                                @if (count($diploma) > 0)
                                    @foreach ($diploma as $course) 
                                    @if($course->status != '2')
                                    <div class="item">
                                        <!-- Card -->
                                        @if($course->status == '3')
                                            <div class="card card-hover mb-3">
                                                <a
                                                    href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"><img
                                                        src="{{ Storage::url($course->course_thumbnail_file) }}"
                                                        alt="course" class="card-img-top object-fit-cover img-fluid fade-in" loading="lazy"></a>
                                                <!-- Card Body -->
                                                <div class="card-body course_cardbody">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="badge bg-info-soft co-category">Diploma</span>
                                                        @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ?
                                                            $course->ects : ''}} ECTS</span>@endif
                                                    </div>
                                                    <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                                            href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"
                                                            class="text-inherit">{{isset($course->course_title) ?  htmlspecialchars_decode($course->course_title) : ''}}</a></h4>
                                                    <div class="d-flex align-items-center justify-content-between mt-1 promo_code_division">
                                                        <span class="text-dark enroll_icon">
                                                            <i class="fe fe-user"></i>
                                                            {{-- @php $CountEnrolled = is_enrolled('',$course->id);@endphp {{$CountEnrolled}} Enrolled --}}
                                                            @php $CountEnrolled = $course->temp_count;@endphp {{$CountEnrolled}} Enrolled
                                                        </span>
                                                        @php $promoCode = getCoursePromoCode($course->id);@endphp
                                                        @if($promoCode)
                                                            <small class="promo-code text-primary rounded p-1">
                                                            <span class="badge badge-success text-primary badge_icon" style="padding: 2px 4px"><span style="user-select: none">PROMO:</span> <span class="fw-bolder">{{$promoCode}}</span></span>
                                                            </small>
                                                        @endif
                                                    </div> 
                                                </div>
                                                <!-- Card Footer -->
                                                <div class="card-footer" style="min-height: 65px">
                                                    <div class="row align-items-center g-0">
                                                        <div class="col course-price-flex">
                                                            <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                                                $course->course_final_price : 0}}</h5>
                                                            @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                                                $course->course_old_price : 0}} </h5>@endif
                                                        </div>

                                                        <div class="col-auto">
                                                        @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                                        @elseif (Auth::check() && Auth::user()->role =='user')
                                                            @php
                                                                $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $course->id]);
                                                            @endphp
                                                            @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                                                {{-- @if(!empty($doc_verified) && $doc_verified[0]->identity_is_approved == "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->english_score >= 10 ) --}}
                                                                @php
                                                                $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $course->id,'is_deleted'=>'No' ], "", 'created_at');
                                                                @endphp
                                                                @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() && $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                                    <a  href="{{route('master-course-panel',['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4" ></i> Play</a>
                                                                @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                                                    <a  href="{{route('master-course-panel',['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4 " ></i> Play</a>
                                                                @else
                                                                <div class="d-flex">
                                                                    @php
                                                                    $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                                    @endphp
                                                                    @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                    <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                    @else 
                                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></i></a>
                                                                    @endif
                                                                    <form action="{{ route('checkout') }}" method="post">
                                                                    @csrf <!-- CSRF protection -->
                                                                    @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                    <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                    <button class="buy-now">Buy Now</button>
                                                                    </form>
                                                                </div>
                                                                @endif
                                                                {{-- @else
                                                                    <a href="#" class="text-inherit learningVerified playBtnStyle"><i class="fe fe-play btn-outline-primary"></i>Play</a>
                                                                @endif --}}
                                                            @else
                                                                <div class="d-flex">
                                                                    @php
                                                                    $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                                    @endphp
                                                                    @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                    <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                    @else 
                                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></i></a>
                                                                    @endif
                                                                    
                                                                    <form action="{{ route('checkout') }}" method="post">
                                                                    @csrf <!-- CSRF protection -->
                                                                    @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                    <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                    <button class="buy-now">Buy Now</button>
                                                                    </form>
                                                                </div>
                                                            @endif      
                                                        @else
                                                        <div class="d-flex">
                                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}" data-withcart="withcart"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                            <form action="{{ route('checkout') }}" method="post">
                                                                @csrf <!-- CSRF protection -->
                                                                @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                <button class="buy-now">Buy Now</button>
                                                            </form>
                                                        </div>
                                                        @endif
                                                        </div>
                                                    </div>
                                                    @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                                    @else
                                                    <div class="col-auto course-saved-btn">
                                                        @if (Auth::check() && Auth::user()->role =='user')
                                                        @php
                                                                $isWishlist = is_exist('wishlist', ['student_id' => Auth::user()->id,'status'=>'Active','cart_wishlist' => '0','course_id'=> $course->id]);
                                                            @endphp
                                                            @if (isset($isWishlist) && !empty($isWishlist) && is_numeric($isWishlist) &&  $isWishlist > 0) 
                                                                @php $showicon="bi heart-icon bi-heart-fill";@endphp
                                                            @else
                                                                @php $showicon="bi bi-heart heart-icon";@endphp
                                                            @endif
                                                            <a  class="text-inherit addwishlist" aria-label="Add to Wishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}"><i class="{{$showicon}}"></i></a>
                                                        @else
                                                            <a  class="text-inherit addwishlist" aria-label="Add to Wishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}" data-withwishlist="withwishlist"><i class="bi bi-heart heart-icon"></i></a>
                                                        @endif
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="card card-hover mb-3">
                                                <a href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}">
                                                    <img src="{{ Storage::url($course->course_thumbnail_file) }}" alt="course"
                                                    class="card-img-top img-fluid object-fit-cover img-fluid fade-in" max-height='10px' style="object-fit: cover;" loading="lazy">
                                                </a>                                                <!-- Card Body -->
                                                <div class="card-body course_cardbody">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="badge bg-info-soft co-category">Diploma</span>
                                                        @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ? $course->ects : ''}}
                                                            ECTS</span>@endif
                                                    </div>
                                                    <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                                        href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"
                                                                class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                                                    </h4>
                                                </div>
                                                <!-- Card Footer -->
                                                <div class="card-footer">
                                                    <div class="row align-items-center g-0"  style="VISIBILITY: HIDDEN;">
                                                        <div class="col course-price-flex">
                                                            <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                                                $course->course_final_price : 0}}</h5>
                                                            @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                                                $course->course_old_price : 0}} </h5>@endif
                                                        </div>
                            
                                                        <div class="col-auto">
                                                            <a class="text-inherit"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                            <a class="buy-now">Buy Now</a>
                                                        </div>
                                                    </div>
                            
                                                    <div class="col-auto course-saved-btn"   style="VISIBILITY: HIDDEN;">
                                                        <a class="text-reset bookmark"><i class="bi bi-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @endif
                                    @endforeach
                                @else
                                    <img src="{{ asset('frontend/images/ComingSoon.png') }}" alt="Diploma" class="img-fluid responsive-image coming-soon-image" loading="lazy"/>
                                @endif
                            </div>
                        </div>
                        <div class="mt-8">
                            <a href="{{route('diploma-courses')}}" class="btn btn-outline-primary">Browse all</a>
                        </div>
                    </div>

                    <!-- Certificate tab content -->
                    <div class="tab-pane fade" id="pills-certificate" role="tabpanel" aria-labelledby="pills-certificate-tab">

                        <div class="position-relative">
                            <ul class="controls" id="sliderSecondControls">
                                <li class="prev">
                                    <i class="fe fe-chevron-left"></i>
                                </li>
                                <li class="next">
                                    <i class="fe fe-chevron-right"></i>
                                </li>
                            </ul>
                            <div class="sliderSecond">
                                @php
                                $certificate =
                                getData('course_master',['temp_count','course_title','id','selling_price','ects','course_final_price','course_old_price','course_thumbnail_file','status'],['category_id'=>'2',['status','!=','2']],'',DB::raw('IFNULL(published_on, "NULL")'),'asc');
                                @endphp
                                @if (count($certificate) > 0)
                                @foreach ($certificate as $course) 
                                @if($course->status != '2')
                                    <div class="item">
                                        <!-- Card -->
                                        @if($course->status == '3')
                                            <div class="card card-hover mb-3">
                                                <a
                                                    href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"><img
                                                        src="{{ Storage::url($course->course_thumbnail_file) }}"
                                                        alt="course" class="card-img-top object-fit-cover img-fluid fade-in" loading="lazy"></a>
                                                <!-- Card Body -->
                                                <div class="card-body course_cardbody">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="badge bg-info-soft co-category">Certificate</span>
                                                        @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ?
                                                            $course->ects : ''}} ECTS</span>@endif
                                                    </div>
                                                    <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                                            href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"
                                                            class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a></h4>
                                                    <div class="d-flex align-items-center justify-content-between mt-1 promo_code_division">
                                                        <span class="text-dark enroll_icon">
                                                            <i class="fe fe-user"></i>
                                                            {{-- @php $CountEnrolled = is_enrolled('',$course->id);@endphp {{$CountEnrolled}} Enrolled --}}
                                                            @php $CountEnrolled = $course->temp_count;@endphp {{$CountEnrolled}} Enrolled
                                                        </span>
                                                        @php $promoCode = getCoursePromoCode($course->id);@endphp
                                                        @if($promoCode)
                                                            <small class="promo-code text-primary rounded p-1">
                                                            <span class="badge badge-success text-primary badge_icon" style="padding: 2px 4px"><span style="user-select: none">PROMO:</span> <span class="fw-bolder">{{$promoCode}}</span></span>
                                                            </small>
                                                        @endif
                                                    </div> 
                                                </div>
                                                <!-- Card Footer -->
                                                <div class="card-footer">
                                                    <div class="row align-items-center g-0">
                                                        <div class="col course-price-flex">
                                                            <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                                                $course->course_final_price : 0}}</h5>
                                                            @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                                                $course->course_old_price : 0}} </h5>@endif
                                                        </div>

                                                        <div class="col-auto">
                                                            @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                                            @elseif (Auth::check() && Auth::user()->role =='user')
                                                                @php
                                                                    $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $course->id]);
                                                                @endphp
                                                                @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                                                    {{-- @if(!empty($doc_verified) && $doc_verified[0]->identity_is_approved == "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->english_score >= 10 ) --}}
                                                                    @php
                                                                        $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $course->id,'is_deleted'=>'No'], "", 'created_at');
                                                                    @endphp
                                                                    @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() && $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                                        <a  href="{{route('master-course-panel',['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4 " ></i> Play</a>
                                                                    @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                                                        <a  href="{{route('master-course-panel',['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4 " ></i> Play</a>
                                                                    @else
                                                                    <div class="d-flex">
                                                                        @php
                                                                        $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                                        @endphp
                                                                        @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                        @else 
                                                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                        @endif
                                                                        <form action="{{ route('checkout') }}" method="post">
                                                                        @csrf <!-- CSRF protection -->
                                                                        @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                        <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                        <button class="buy-now">Buy Now</button>
                                                                        </form>
                                                                    </div>
                                                                    @endif
                                                                    {{-- @else
                                                                        <a href="#" class="text-inherit learningVerified playBtnStyle"><i class="fe fe-play btn-outline-primary"></i>Play</a>
                                                                    @endif --}}
                                                                @else
                                                                    <div class="d-flex">
                                                                        @php
                                                                        $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                                        @endphp
                                                                        @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                        @else 
                                                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                        @endif
                                                                        
                                                                        <form action="{{ route('checkout') }}" method="post">
                                                                        @csrf <!-- CSRF protection -->
                                                                        @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                        <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                        <button class="buy-now">Buy Now</button>
                                                                        </form>
                                                                    </div>
                                                                @endif      
                                                            @else
                                                            <div class="d-flex">
                                                                <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}" data-withcart="withcart"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                <form action="{{ route('checkout') }}" method="post">
                                                                    @csrf <!-- CSRF protection -->
                                                                    @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                    <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                    <button class="buy-now">Buy Now</button>
                                                                </form>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                                    @else
                                                    <div class="col-auto course-saved-btn">
                                                        @if (Auth::check() && Auth::user()->role =='user')
                                                            @php
                                                            $isWishlist = is_exist('wishlist', ['student_id' => Auth::user()->id,'status'=>'Active','cart_wishlist' => '0','course_id'=> $course->id]);
                                                            @endphp
                                                            @if (isset($isWishlist) && !empty($isWishlist) && is_numeric($isWishlist) &&  $isWishlist > 0) 
                                                                @php $showicon="bi heart-icon bi-heart-fill";@endphp
                                                            @else
                                                                @php $showicon="bi bi-heart heart-icon";@endphp
                                                            @endif
                                                            <a  class="text-inherit addwishlist" aria-label="Add to Wishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}"><i class="{{$showicon}}"></i></a>
                                                        @else
                                                            <a  class="text-inherit addwishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}" data-withwishlist="withwishlist"><i class="bi bi-heart heart-icon"></i></a>
                                                        @endif
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="card card-hover mb-3">
                                                <a href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}">
                                                    <img src="{{ Storage::url($course->course_thumbnail_file) }}" alt="course"
                                                    class="card-img-top img-fluid object-fit-cover fade-in" max-height='10px' loading="lazy">
                                                </a>
                                                <!-- Card Body -->
                                                <div class="card-body course_cardbody">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="badge bg-info-soft co-category">Certificate</span>
                                                        @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ? $course->ects : ''}}
                                                            ECTS</span>@endif
                                                    </div>
                                                    <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                                        href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"
                                                            class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                                                    </h4>
                                                </div>
                                                <!-- Card Footer -->
                                                <div class="card-footer">
                                                    <div class="row align-items-center g-0"  style="VISIBILITY: HIDDEN;">
                                                        <div class="col course-price-flex">
                                                            <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                                                $course->course_final_price : 0}}</h5>
                                                            @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                                                $course->course_old_price : 0}} </h5>@endif
                                                        </div>
                            
                                                        <div class="col-auto">
                                                            <a class="text-inherit"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                            <a class="buy-now">Buy Now</a>
                                                        </div>
                                                    </div>
                            
                                                    <div class="col-auto course-saved-btn"  style="VISIBILITY: HIDDEN;">
                                                        <a class="text-reset bookmark"><i class="bi bi-heart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @endforeach
                                @else
                                <img src="{{ asset('frontend/images/ComingSoon.png') }}" alt="Certificate" class="img-fluid coming-soon-image" loading="lazy"/>
                                @endif
                            </div>
                        </div>
                        <div class="mt-8">
                            <a href="{{route('certificate-courses')}}" class="btn btn-outline-primary">Browse all</a>
                        </div>
                    </div>

                    <!-- Award tab content -->
                    <div class="tab-pane fade" id="pills-award" role="tabpanel" aria-labelledby="pills-award-tab">

                        <div class="position-relative">
                            <ul class="controls" id="sliderFirstControls" style="margin-bottom: -12px">
                                <li class="prev">
                                    <i class="fe fe-chevron-left"></i>
                                </li>
                                <li class="next">
                                    <i class="fe fe-chevron-right"></i>
                                </li>
                            </ul>
                            <div class="sliderFirst">
                                @php
                                $award = getData('course_master',['temp_count','course_title','id','selling_price','ects','course_final_price','course_old_price','course_thumbnail_file','status','published_on'],['category_id'=>'1',['status','!=','2']],'',DB::raw('IFNULL(published_on, "NULL")'),'asc');
                                $order='asc';
                                $awardSorted = $award->sort(function ($a, $b) use ($order) {
                                    $aPublishedOn = isset($a->published_on) ? strtotime($a->published_on) : null;
                                    $bPublishedOn = isset($b->published_on) ? strtotime($b->published_on) : null;
                                    if ($aPublishedOn === null && $bPublishedOn === null) {
                                        return $a->id <=> $b->id;
                                    }
                                    if ($aPublishedOn === null) {
                                        return 1; 
                                    }
                                    if ($bPublishedOn === null) {
                                        return -1; 
                                    }
                                    $result = $order === 'asc'
                                        ? $aPublishedOn <=> $bPublishedOn
                                        : $bPublishedOn <=> $aPublishedOn;
                                    return $result === 0 ? $a->id <=> $b->id : $result;
                                });
                                $award = $awardSorted->values()->all();
                                // dd($award);
                                @endphp
                                <!-- Card -->
                                {{-- <div class="item">
                                <div class="card card-hover">
                                    <a href="{{route('get-course-details',['course_id'=>base64_encode($awardCourses[0]->id)])}}">
                                        <img src="{{ Storage::url($awardCourses[0]->course_thumbnail_file) }}" alt="course"
                                            class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;" loading="lazy">
                                    </a>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="badge bg-info-soft co-category">Award</span>
                                            @if(isset($awardCourses[0]->ects) && !empty($awardCourses[0]->ects))<span class="badge bg-success-soft co-etcs">{{isset($awardCourses[0]->ects) ? $awardCourses[0]->ects : ''}}
                                                ECTS</span>@endif
                                        </div>
                                        <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                                href="{{route('get-course-details',['course_id'=>base64_encode($awardCourses[0]->id)])}}"
                                                class="text-inherit">{{isset($awardCourses[0]->course_title) ? $awardCourses[0]->course_title : ''}}</a>
                                        </h4>
                                        <span class="text-dark">
                                            <i class="fe fe-user"></i>
                                            @php $CountEnrolled = is_enrolled('',$awardCourses[0]->id);@endphp
                                             {{$CountEnrolled}} 
                                              Enrolled
                                        </span> 
                                    </div>
                                    <!-- Card Footer -->
                                    <div class="card-footer">
                                        <div class="row align-items-center g-0">
                                            <div class="col course-price-flex">
                                                <h5 class="mb-0 course-price">€{{isset($awardCourses[0]->course_final_price) ?
                                                    $awardCourses[0]->course_final_price : 0}}</h5>
                                                 @if(isset($awardCourses[0]->course_old_price) && $awardCourses[0]->course_old_price > 0)<h5 class="old-price">€{{isset($awardCourses[0]->course_old_price) ?
                                                    $awardCourses[0]->course_old_price : 0}} </h5>@endif
                                            </div>
                
                                            <div class="col-auto">
                                                @if (Auth::check() && Auth::user()->role =='user')
                                                    @php
                                                        $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $awardCourses[0]->id]);
                                                    @endphp
                                                    @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                                        @php
                                                            $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $awardCourses[0]->id,'is_deleted'=>'No'], "", 'created_at');
                                                        @endphp
                                                        @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                            <a  href="{{route('start-course-panel',['course_id'=>base64_encode($awardCourses[0]->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="fe fe-play btn-outline-primary " ></i> Play</a>
                                                        @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                                            <a  href="{{route('start-course-panel',['course_id'=>base64_encode($awardCourses[0]->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="fe fe-play btn-outline-primary " ></i> Play</a>
                                                        @else
                                                        <div class="d-flex">
                                                            @php
                                                                $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $awardCourses[0]->id,'status'=>'Active']);
                                                            @endphp
                                                            @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart"alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                            @else 
                                                                <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                            @endif
                                                            <form action="{{ route('checkout') }}" method="post">
                                                                @csrf
                                                                @php $total_full_price = $awardCourses[0]->course_old_price - ($awardCourses[0]->course_old_price - $awardCourses[0]->course_final_price) ; @endphp
                                                                <input type='hidden' value="{{base64_encode($awardCourses[0]->id)}}" name="course_id" id="course_id">
                                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($awardCourses[0]->course_old_price)}}">
                                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($awardCourses[0]->course_old_price - $awardCourses[0]->course_final_price)}}">
                                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                <button class="buy-now">Buy Now</button>
                                                            </form>
                                                        </div>
                                                        @endif
                                                    @else
                                                    <div class="d-flex">
                                                        @php
                                                            $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $awardCourses[0]->id,'status'=>'Active']);
                                                        @endphp
                                                        @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                        @else 
                                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
        
                                                        @endif
                                                        <form action="{{ route('checkout') }}" method="post">
                                                        @csrf <!-- CSRF protection -->
                                                        @php $total_full_price = $awardCourses[0]->course_old_price - ($awardCourses[0]->course_old_price - $awardCourses[0]->course_final_price) ; @endphp
                                                        <input type='hidden' value="{{base64_encode($awardCourses[0]->id)}}" name="course_id" id="course_id">
                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($awardCourses[0]->course_old_price)}}">
                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($awardCourses[0]->course_old_price -$awardCourses[0]->course_final_price)}}">
                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                        <button class="buy-now">Buy Now</button>
                                                        </form>
                                                    </div>
                                                    @endif      
                                                @else
                                                <div class="d-flex" style="padding: 0px"> 
                                                   <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}" data-withcart="withcart"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                    <form action="{{ route('checkout') }}" method="post">
                                                        @csrf <!-- CSRF protection -->
                                                        @php $total_full_price = $awardCourses[0]->course_old_price - ($awardCourses[0]->course_old_price - $awardCourses[0]->course_final_price) ; @endphp
                                                        <input type='hidden' value="{{base64_encode($awardCourses[0]->id)}}" name="course_id" id="course_id">
                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($awardCourses[0]->course_old_price)}}">
                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($awardCourses[0]->course_old_price -$awardCourses[0]->course_final_price)}}">
                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                        <button class="buy-now">Buy Now</button>
                                                    </form>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                
                                        <div class="col-auto course-saved-btn">
                                            @if (Auth::check() && Auth::user()->role =='user')
                                                @php
                                                    $isWishlist = is_exist('wishlist', ['student_id' => Auth::user()->id,'status'=>'Active','cart_wishlist' => '0','course_id'=> $awardCourses[0]->id]);
                                                @endphp
                                                @if (isset($isWishlist) && !empty($isWishlist) && is_numeric($isWishlist) &&  $isWishlist > 0) 
                                                    @php $showicon="bi heart-icon bi-heart-fill";@endphp
                                                @else
                                                    @php $showicon="bi bi-heart heart-icon";@endphp
                                                @endif
                                                    <a  class="text-inherit addwishlist" aria-label="Add to Wishlist" data-course-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('wishlist')}}"><i class="{{$showicon}}"></i></a>
                                            @else
                                            <a  class="text-inherit addwishlist" data-course-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('wishlist')}}" data-withwishlist="withwishlist"><i class="bi bi-heart heart-icon"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                </div> --}}
                                @if (isset($award))
                                @foreach ($award as $key => $course) 
                                @if($course->status != '2')
                                <div class="item">

                                    <!-- Card -->
                                    @if($course->status == '3')
                                    <div class="card card-hover">
                                        <a href="{{route('get-course-details',['course_id'=>base64_encode($course->id)])}}"><img
                                                src="{{ Storage::url($course->course_thumbnail_file) }}"
                                                alt="course" class="card-img-top object-fit-cover img-fluid fade-in" loading="lazy"></a>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Award</span>
                                                @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ?
                                                    $course->ects : ''}} ECTS</span>@endif
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                                    href="{{route('get-course-details',['course_id'=>base64_encode($course->id)])}}"
                                                    class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a></h4>
                                            <div class="d-flex align-items-center justify-content-between mt-1 promo_code_division">
                                                <span class="text-dark enroll_icon">
                                                    <i class="fe fe-user"></i>
                                                    {{-- @php $CountEnrolled = is_enrolled('',$course->id);@endphp {{$CountEnrolled}} Enrolled --}}
                                                    @php $CountEnrolled = $course->temp_count;@endphp {{$CountEnrolled}} Enrolled
                                                </span>
                                                @php $promoCode = getCoursePromoCode($course->id);@endphp
                                                    @if($promoCode)
                                                        <small class="promo-code text-primary rounded p-1">
                                                        <span class="badge badge-success text-primary badge_icon" style="padding: 2px 4px"><span style="user-select: none">PROMO:</span> <span class="fw-bolder">{{$promoCode}}</span></span>
                                                        </small>
                                                    @endif
                                        </div> 
                                        </div>
                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0">
                                                <div class="col course-price-flex">
                                                   <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                                        $course->course_final_price : 0}}</h5>
                                                    @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                                        $course->course_old_price : 0}} </h5>@endif
                                                </div>

                                                <div class="col-auto">
                                                    @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                                    @elseif (Auth::check() && Auth::user()->role =='user')
                                                        @php
                                                            $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $course->id]);
                                                        @endphp
                                                        @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                                            {{-- @if(!empty($doc_verified) && $doc_verified[0]->identity_is_approved == "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->english_score >= 10 ) --}}
                                                            @php
                                                                $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $course->id,'is_deleted'=>'No' ], "", 'created_at');
                                                            @endphp
                                                            @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() && $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                                <a  href="{{route('start-course-panel',['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4 " ></i> Play</a>
                                                            @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                                                <a  href="{{route('start-course-panel',['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4 " ></i> Play</a>
                                                            @else
                                                            <div class="d-flex">
                                                                @php
                                                                    $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                                @endphp
                                                                @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                @else 
                                                                    <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                @endif
                                                                <form action="{{ route('checkout') }}" method="post">
                                                                @csrf <!-- CSRF protection -->
                                                                @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                <button class="buy-now">Buy Now</button>
                                                                </form>
                                                            </div>
                                                            @endif
                                                            {{-- @else
                                                                <a href="#" class="text-inherit learningVerified playBtnStyle"><i class="fe fe-play btn-outline-primary"></i>Play</a>
                                                            @endif --}}
                                                        @else
                                                            <div class="d-flex">
                                                                @php
                                                                $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                                @endphp
                                                                @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                @else 
                                                                    <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></i></a>
                                                                @endif
                                                                <form action="{{ route('checkout') }}" method="post">
                                                                @csrf <!-- CSRF protection -->
                                                                @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                <button class="buy-now">Buy Now</button>
                                                                </form>
                                                            </div>
                                                        @endif      
                                                    @else
                                                    <div class="d-flex">
                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}" data-withcart="withcart"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                        <form action="{{ route('checkout') }}" method="post">
                                                            @csrf <!-- CSRF protection -->
                                                            @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                            <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                            <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                            <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                            <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                            <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                            <button class="buy-now">Buy Now</button>
                                                        </form>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                            @else
                                            <div class="col-auto course-saved-btn">
                                            @if (Auth::check() && Auth::user()->role =='user')
                                                @php
                                                    $isWishlist = is_exist('wishlist', ['student_id' => Auth::user()->id,'status'=>'Active','cart_wishlist' => '0','course_id'=> $course->id]);
                                                @endphp
                                                @if (isset($isWishlist) && !empty($isWishlist) && is_numeric($isWishlist) &&  $isWishlist > 0) 
                                                    @php $showicon="bi heart-icon bi-heart-fill";@endphp
                                                @else
                                                    @php $showicon="bi bi-heart heart-icon";@endphp
                                                @endif
                                                <a  class="text-inherit addwishlist" aria-label="Add to Wishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}"><i class="{{$showicon}}"></i></a>
                                            @else
                                                <a  class="text-inherit addwishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}" data-withwishlist="withwishlist"><i class="bi bi-heart heart-icon"></i></a>
                                            @endif
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @else
                                    <div class="card card-hover">
                                        <a href="{{route('get-course-details',['course_id'=>base64_encode($course->id)])}}">
                                            <img src="{{ Storage::url($course->course_thumbnail_file) }}" alt="course"
                                            class="card-img-top object-fit-cover img-fluid fade-in" max-height='10px' loading="lazy">
                                        </a>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Award</span>
                                                @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ? $course->ects : ''}}
                                                    ECTS</span>@endif
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                                    href="{{route('get-course-details',['course_id'=>base64_encode($course->id)])}}"
                                                    class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                                            </h4>
                                        </div>
                                        <!-- Card Footer -->
                                        <div class="card-footer">
                                            <div class="row align-items-center g-0"  style="VISIBILITY: HIDDEN;">
                                                <div class="col course-price-flex">
                                                    <h5 class="mb-0 course-price">{{isset($course->course_final_price) ? '€'.
                                                        $course->course_final_price : ''}}</h5>
                                                    @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">{{isset($course->course_old_price) ? '€'.
                                                        $course->course_old_price : ''}} </h5>@endif
                                                </div>
                    
                                                <div class="col-auto">
                                                    <a class="text-inherit"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                    <a class="buy-now">Buy Now</a>
                                                </div>
                                            </div>
            
                                            <div class="col-auto course-saved-btn"   style="VISIBILITY: HIDDEN;">
                                                <a class="text-reset bookmark"><i class="bi bi-heart"></i></a>
                                            </div>
                    
                                            
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif
                               
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="mt-8">
                            <a href="{{route('award-courses')}}" class="btn btn-outline-primary">Browse all</a>
                        </div>
                    </div>

                    <!-- All Tab Pane -->
                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                        <div class="position-relative">
                            <ul class="controls" id="sliderFifthControls">
                                <li class="prev">
                                    <i class="fe fe-chevron-left"></i>
                                </li>
                                <li class="next">
                                    <i class="fe fe-chevron-right"></i>
                                </li>
                            </ul>
                            <div class="sliderFifth">
                                @php
                                $master =
                                getData('course_master',['temp_count','course_title','id','selling_price','ects','course_thumbnail_file','course_old_price','course_final_price','scholarship','status','category_id','published_on'],[],'','published_on','desc');
                                $order = 'desc';
                                $customCategoryOrder = [5, 4, 3, 2, 1];
                                $masterSorted = $master->sort(function ($a, $b) use ($order, $customCategoryOrder) {
                                    if ($a->status == 3 && $b->status != 3) {
                                        return -1; // a comes first
                                    }
                                    if ($b->status == 3 && $a->status != 3) {
                                        return 1; // b comes first
                                    }
                                    $aPublishedOn = isset($a->published_on) ? strtotime($a->published_on) : null;
                                    $bPublishedOn = isset($b->published_on) ? strtotime($b->published_on) : null;
                                    if ($aPublishedOn === null && $bPublishedOn === null) {
                                        if ($a->category_id === $b->category_id) {
                                            return $a->id <=> $b->id; 
                                        }
                                        return $b->category_id <=> $a->category_id;
                                    }
                                    if ($aPublishedOn === null) {
                                        return -1; // Place null 'published_on' first
                                    }
                                    if ($bPublishedOn === null) {
                                        return 1; // Place null 'published_on' first
                                    }
                                    $result = $order === 'asc'
                                        ? $aPublishedOn <=> $bPublishedOn
                                        : $bPublishedOn <=> $aPublishedOn;

                                    return $result === 0 ? ($b->category_id <=> $a->category_id) : $result;
                                });
                                $masterSorted = $masterSorted->sort(function ($a, $b) {
                                    if ($a->published_on === $b->published_on && $a->category_id === $b->category_id) {
                                        return $a->id <=> $b->id;
                                    }
                                    return 0;
                                });
                                $master = $masterSorted->values()->all();
                                @endphp
                                @if(isset($master))
                                @foreach ($master as $course)
                                @if($course->status != '2' )
                                <div class="item">
                                    <!-- Card -->
                                    @if($course->status == '3')
                                        <div class="card card-hover mb-3">
                                            @if (isset($course->category_id) && !empty($course->category_id) && $course->category_id === 1)
                                                @php $LINK = route('get-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                                            @elseif (isset($course->category_id) && !empty($course->category_id) && $course->category_id === 5)
                                                @php $LINK = route('dba-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                                            @else
                                                @php $LINK = route('get-master-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                                            @endif

                                            <a href="{{$LINK}}">
                                            <img src="{{ Storage::url($course->course_thumbnail_file) }}" alt="course"
                                                class="card-img-top" loading="lazy"></a>
                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    @if (isset($course->category_id) && !empty($course->category_id) &&
                                                    $course->category_id === 1)
                                                       <span class="badge bg-info-soft co-category">Award</span>
                                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                                    $course->category_id === 2)
                                                        <span class="badge bg-info-soft co-category">Certificate</span>
                                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                                    $course->category_id === 3)
                                                        <span class="badge bg-info-soft co-category">Diploma</span>
                                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                                    $course->category_id === 4)
                                                        <span class="badge bg-info-soft co-category">Masters</span>
                                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                                        $course->category_id === 5)
                                                            <span class="badge bg-info-soft co-category">DBA</span>
                                                    @endif
                                                    @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ?
                                                        $course->ects : ''}} ECTS</span>@endif
                                                </div>

                                                <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                                        href="{{$LINK}}"
                                                        class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a></h4>
                                                <div class="d-flex align-items-center justify-content-between mt-1 promo_code_division">
                                                    <span class="text-dark enroll_icon">
                                                        <i class="fe fe-user"></i>
                                                        {{-- @php $CountEnrolled = is_enrolled('',$course->id);@endphp {{$CountEnrolled}} Enrolled --}}
                                                         @php $CountEnrolled = $course->temp_count;@endphp {{$CountEnrolled}} Enrolled
                                                    </span>
                                                    @php $promoCode = getCoursePromoCode($course->id);@endphp
                                                    @if($promoCode)
                                                        <small class="promo-code text-primary rounded p-1">
                                                        <span class="badge badge-success text-primary badge_icon" style="padding: 2px 4px"><span style="user-select: none">PROMO:</span> <span class="fw-bolder">{{$promoCode}}</span></span>
                                                        </small>
                                                    @endif
                                                </div> 

                                                {{-- <div class="lh-1 mt-3">

                                                    <span class="fs-6">
                                                        <i class="fe fe-user color-blue"></i>
                                                        1200 Enrolled
                                                    </span>

                                                </div> --}}
                                            </div>
                                            <!-- Card Footer -->
                                            <div class="card-footer">
                                                <div class="row align-items-center g-0">
                                                    <div class="col course-price-flex">
                                                        @if(isset($course->category_id) && !empty($course->category_id) &&
                                                        $course->category_id === 5)
                                                           <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                                            $course->course_final_price : 0}}<small>{{''.'/ per year'}}</small></h5>
                                                        @else
                                                           <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                                            $course->course_final_price : 0}}</h5>
                                                        @endif
                                                        @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                                            $course->course_old_price : 0}} </h5>@endif
                                                    </div>

                                                    <div class="col-auto">
                                                        {{-- <a href="#" class="text-inherit"> --}}
                                                        @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                                        @elseif (Auth::check() && Auth::user()->role =='user')
                                                            @php
                                                                $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $course->id]);
                                                            @endphp
                                                            @if(isset($course->category_id) && !empty($course->category_id) &&$course->category_id === 5)
                                                                @php 
                                                                    $doc_verified = getData('student_doc_verification',['english_score','identity_is_approved','edu_is_approved','identity_doc_file','edu_doc_file','resume_file','edu_trail_attempt','identity_trail_attempt','english_test_attempt','proposal_is_approved'],['student_id'=>Auth::user()->id]);
                                                                @endphp
                                                                @if(Auth::user()->apply_dba == 'Yes')
                                                                    @if($doc_verified[0]->identity_is_approved == "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->resume_file != ''  && $doc_verified[0]->english_score >= 10 && $doc_verified[0]->proposal_is_approved == 'Approved')
                                                                        @if (isset($isPaid)  && is_numeric($isPaid) &&  $isPaid == 0)
                                                                            <div class="d-flex">
                                                                                <form action="{{ route('checkout') }}" method="post">
                                                                                @csrf <!-- CSRF protection -->
                                                                                @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                                <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                                <button class="buy-now">Buy Now</button>
                                                                                </form>
                                                                            </div>
                                                                        @endif
                                                                    @else
                                                                        <a href="{{route('student-document-verification')}}"><button class="buy-now">Buy Now</button></a>
                                                                    @endif
                                                                @else
                                                                    @if (isset($isPaid) && is_numeric($isPaid) && $isPaid == 0)
                                                                        <div class="d-flex">
                                                                            <form action="{{ route('checkout') }}" method="post">
                                                                            @csrf <!-- CSRF protection -->
                                                                            @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                            <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                            <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                            <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                            <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                            <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                            <button class="buy-now">Buy Now</button>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @else
                                                                @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                                                    {{-- @if(!empty($doc_verified) && $doc_verified[0]->identity_is_approved == "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->english_score >= 10 ) --}}
                                                                    @php
                                                                    $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $course->id,'is_deleted'=>'No'], "", 'created_at');
                                                                    @endphp
                                                                    @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() && $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                                        @if($course->category_id == '1')
                                                                            @php $LINK = route('start-course-panel',['course_id'=>base64_encode($course->id)]); @endphp
                                                                        @else
                                                                            @php $LINK = route('master-course-panel',['course_id'=>base64_encode($course->id)]); @endphp
                                                                        @endif
                                                                        <a  href="{{$LINK}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4 " ></i> Play</a>
                                                                    @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                                                        @if($course->category_id == '1')
                                                                            @php $LINK = route('start-course-panel',['course_id'=>base64_encode($course->id)]); @endphp
                                                                        @else
                                                                            @php $LINK = route('master-course-panel',['course_id'=>base64_encode($course->id)]); @endphp
                                                                        @endif
                                                                        <a  href="{{$LINK}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4 " ></i> Play</a>
                                                                    @else
                                                                    <div class="d-flex">
                                                                        @if(isset($course->category_id) && !empty($course->category_id) && $course->category_id != 5)
                                                                        @php
                                                                        $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                                        @endphp
                                                                        @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                        @else 
                                                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></i></a>
                                                                        @endif
                                                                        @endif
                                                                        <form action="{{ route('checkout') }}" method="post">
                                                                        @csrf <!-- CSRF protection -->
                                                                        @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                        <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                        <button class="buy-now">Buy Now</button>
                                                                        </form>
                                                                    </div>
                                                                    @endif
                                                                    {{-- @else
                                                                        <a href="#" class="text-inherit learningVerified playBtnStyle"><i class="fe fe-play btn-outline-primary"></i>Play</a>
                                                                    @endif --}}
                                                                @else
                                                                    <div class="d-flex">
                                                                        @if(isset($course->category_id) && !empty($course->category_id) && $course->category_id != 5)
                                                                        
                                                                        @php
                                                                        $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                                        @endphp
                                                                        @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                                        @else 
                                                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></i></a>
                                                                        @endif
                                                                        @endif
                                                                        <form action="{{ route('checkout') }}" method="post">
                                                                        @csrf <!-- CSRF protection -->
                                                                        @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                        <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                        <button class="buy-now">Buy Now</button>
                                                                        </form>
                                                                    </div>
                                                                @endif   
                                                            @endif   
                                                        @else
                                                        <div class="d-flex">
                                                            @if(isset($course->category_id) && !empty($course->category_id) && $course->category_id != 5)
                                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}" data-withcart="withcart"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                            @endif
                                                            <form action="{{ route('checkout') }}" method="post">
                                                            @csrf <!-- CSRF protection -->
                                                            @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                            <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                            <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                            <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                            <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                            <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                            <button class="buy-now">Buy Now</button>
                                                            </form>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                                @else
                                                @if(isset($course->category_id) && !empty($course->category_id) && $course->category_id != 5)
                                                    <div class="col-auto course-saved-btn">
                                                        @if (Auth::check() && Auth::user()->role =='user')
                                                            @php
                                                                $isWishlist = is_exist('wishlist', ['student_id' => Auth::user()->id,'status'=>'Active','cart_wishlist' => '0','course_id'=> $course->id]);
                                                            @endphp
                                                            @if (isset($isWishlist) && !empty($isWishlist) && is_numeric($isWishlist) &&  $isWishlist > 0) 
                                                                @php $showicon="bi heart-icon bi-heart-fill";@endphp
                                                            @else
                                                                @php $showicon="bi bi-heart heart-icon";@endphp
                                                            @endif
                                                            <a  class="text-inherit addwishlist" aria-label="Add to Wishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}"><i class="{{$showicon}}"></i></a>
                                                        @else
                                                            <a  class="text-inherit addwishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}" data-withwishlist="withwishlist"><i class="bi bi-heart heart-icon"></i></a>
                                                        @endif
                                                    </div>
                                                @endif
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="card card-hover mb-3">
                                            @if (isset($course->category_id) && !empty($course->category_id) &&
                                                    $course->category_id === 1)
                                                <a href="{{route('get-course-details',['course_id'=>base64_encode($course->id)])}}">
                                                <img src="{{ Storage::url($course->course_thumbnail_file) }}" alt="course"
                                                        class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;" loading="lazy"></a>
                                            @else
                                                <a href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}">
                                                <img src="{{ Storage::url($course->course_thumbnail_file) }}" alt="course"
                                                        class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;" loading="lazy"></a>
                                            @endif
                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    @if (isset($course->category_id) && !empty($course->category_id) &&
                                                    $course->category_id === 1)
                                                    <span class="badge bg-info-soft co-category">Award</span>
                                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                                    $course->category_id === 2)
                                                    <span class="badge bg-info-soft co-category">Certificate</span>
                                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                                    $course->category_id === 3)
                                                    <span class="badge bg-info-soft co-category">Diploma</span>
                                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                                    $course->category_id === 4)
                                                    <span class="badge bg-info-soft co-category">Masters</span>
                                                    @endif
                                                    @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ?
                                                        $course->ects : ''}} ECTS</span> @endif
                                                </div>
                                                <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                                            @if($course->category_id == '1')
                                                                href="{{route('get-course-details',['course_id'=>base64_encode($course->id)])}}"
                                                            @else
                                                                href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"
                                                            @endif
                                                        class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                                                </h4>
                                               
                                            </div>
                                            <!-- Card Footer -->
                                            <div class="card-footer">
                                                <div class="row align-items-center g-0"  style="VISIBILITY: HIDDEN;">
                                                    <div class="col course-price-flex">
                                                        <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                                            $course->course_final_price : 0}}</h5>
                                                    @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ?
                                                            $course->course_old_price : 0}} </h5>@endif
                                                    </div>
                        
                                                    <div class="col-auto">
                                                        <a class="text-inherit"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                        <a class="buy-now">Buy Now</a>
                                                    </div>
                                                </div>
                        
                                                <div class="col-auto course-saved-btn"   style="VISIBILITY: HIDDEN;">
                                                    <a class="text-reset bookmark"><i class="bi bi-heart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>
                        {{-- <div class="mt-6">
                            <a href="#" class="btn btn-outline-primary" onclick="return false;">Browse all</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Most Popular Certificates -->
<section class="course-category-tabs-main mt-5 mt-lg-0">
    <!-- row -->
    <div class="container mb-lg-8">
        <div class="row">
            <!-- col -->
            <div class="col-12">
                <div class="mb-4">
                    <h1 class="mb-1 h1 fw-bold sectionheading">Most Popular Courses</h1>
                    <p>
                        Explore Our Most Loved Courses - Tried, Tested, and Trusted by Learners Around the Globe for
                        Quality and Relevance.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            @php
           $coursesExplore = course_data_enrolled('',$course->id);

            @endphp
            {{-- <div class="col-md-6 col-sm-12 col-lg-3 mt-3">
                <!-- Card -->
                <div class="card card-hover">
                    <a href="{{route('get-course-details',['course_id'=>base64_encode($awardCourses[0]->id)])}}">
                        <img src="{{ Storage::url($awardCourses[0]->course_thumbnail_file) }}" alt="course"
                            class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;" loading="lazy">
                    </a>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-info-soft co-category">Award</span>
                            @if(isset($awardCourses[0]->ects) && !empty($awardCourses[0]->ects))<span class="badge bg-success-soft co-etcs">{{isset($awardCourses[0]->ects) ? $awardCourses[0]->ects : ''}}
                                ECTS</span> @endif
                        </div>
                        <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                href="{{route('get-course-details',['course_id'=>base64_encode($awardCourses[0]->id)])}}"
                                class="text-inherit">{{isset($awardCourses[0]->course_title) ? $awardCourses[0]->course_title : ''}}</a>
                        </h4>
                        <span class="text-dark">
                            <i class="fe fe-user"></i>
                            @php $CountEnrolled = is_enrolled('',$awardCourses[0]->id);@endphp {{$CountEnrolled}} Enrolled
                        </span> 
                    </div>
                    <!-- Card Footer -->
                    <div class="card-footer">
                        <div class="row align-items-center g-0">
                            <div class="col course-price-flex">
                                <h5 class="mb-0 course-price">€{{isset($awardCourses[0]->course_final_price) ?
                                    $awardCourses[0]->course_final_price : 0}}</h5>
                                @if(isset($awardCourses[0]->course_old_price) && $awardCourses[0]->course_old_price > 0)<h5 class="old-price">€{{isset($awardCourses[0]->course_old_price) ?
                                    $awardCourses[0]->course_old_price : 0}} </h5>@endif
                            </div>

                            <div class="col-auto">
                                @if (Auth::check() && Auth::user()->role =='user')
                                    @php
                                        $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $awardCourses[0]->id]);
                                    @endphp
                                    @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                        @php
                                            $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $awardCourses[0]->id,'is_deleted'=>'No'], "", 'created_at');
                                        @endphp
                                        @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() && $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                            <a  href="{{route('start-course-panel',['course_id'=>base64_encode($awardCourses[0]->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="fe fe-play btn-outline-primary " ></i> Play</a>
                                        @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                            <a  href="{{route('start-course-panel',['course_id'=>base64_encode($awardCourses[0]->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="fe fe-play btn-outline-primary " ></i> Play</a>
                                        @else
                                            <div class="d-flex">
                                            @php
                                                $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $awardCourses[0]->id,'status'=>'Active']);
                                            @endphp
                                            @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                            @else 
                                                <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></a>

                                            @endif
                                            <form action="{{ route('checkout') }}" method="post">
                                            @csrf <!-- CSRF protection -->
                                            @php $total_full_price = $awardCourses[0]->course_old_price - ($awardCourses[0]->course_old_price - $awardCourses[0]->course_final_price) ; @endphp
                                            <input type='hidden' value="{{base64_encode($awardCourses[0]->id)}}" name="course_id" id="course_id">
                                            <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($awardCourses[0]->course_old_price)}}">
                                            <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($awardCourses[0]->course_old_price -$awardCourses[0]->course_final_price)}}">
                                            <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                            <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                            <button class="buy-now">Buy Now</button>
                                            </form>
                                            </div>
                                        @endif
                                    @else
                                    <div class="d-flex">
                                        @php
                                            $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $awardCourses[0]->id,'status'=>'Active']);
                                        @endphp
                                        @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                        @else 
                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></a>

                                        @endif
                                        <form action="{{ route('checkout') }}" method="post">
                                        @csrf <!-- CSRF protection -->
                                        @php $total_full_price = $awardCourses[0]->course_old_price - ($awardCourses[0]->course_old_price - $awardCourses[0]->course_final_price) ; @endphp
                                        <input type='hidden' value="{{base64_encode($awardCourses[0]->id)}}" name="course_id" id="course_id">
                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($awardCourses[0]->course_old_price)}}">
                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($awardCourses[0]->course_old_price -$awardCourses[0]->course_final_price)}}">
                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                        <button class="buy-now">Buy Now</button>
                                        </form>
                                    </div>
                                    @endif      
                                @else
                                <div class="d-flex">
                                    <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($awardCourses[0]->id)}}"  data-cart-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('add')}}" data-withcart="withcart"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" style="height: 25px; width: 25px" loading="lazy"/></a>

                                    <form action="{{ route('checkout') }}" method="post">
                                        @csrf <!-- CSRF protection -->
                                        @php $total_full_price = $awardCourses[0]->course_old_price - ($awardCourses[0]->course_old_price - $awardCourses[0]->course_final_price) ; @endphp
                                        <input type='hidden' value="{{base64_encode($awardCourses[0]->id)}}" name="course_id" id="course_id">
                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($awardCourses[0]->course_old_price)}}">
                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($awardCourses[0]->course_old_price -$awardCourses[0]->course_final_price)}}">
                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                        <button class="buy-now">Buy Now</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-auto course-saved-btn">
                            @if (Auth::check() && Auth::user()->role =='user')
                                @php
                                    $isWishlist = is_exist('wishlist', ['student_id' => Auth::user()->id,'status'=>'Active','cart_wishlist' => '0','course_id'=> $awardCourses[0]->id]);
                                @endphp
                                @if (isset($isWishlist) && !empty($isWishlist) && is_numeric($isWishlist) &&  $isWishlist > 0) 
                                    @php $showicon="bi heart-icon bi-heart-fill";@endphp
                                @else
                                    @php $showicon="bi bi-heart heart-icon";@endphp
                                @endif
                                    <a  class="text-inherit addwishlist" aria-label="Add to Wishlist" data-course-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('wishlist')}}"><i class="{{$showicon}}"></i></a>
                            @else
                                <a  class="text-inherit addwishlist" data-course-id="{{base64_encode($awardCourses[0]->id)}}" data-action="{{base64_encode('wishlist')}}" data-withwishlist="withwishlist"><i class="bi bi-heart heart-icon"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div> --}}
            @if (isset($coursesExplore))
            @foreach ($coursesExplore as $course)
            @if($course->status != '2')

            <div class="col-md-6 col-sm-12 col-lg-4 col-xl-3 mt-3">
                <!-- Card -->
                
                @if($course->status == '3')
                    <div class="card card-hover">
                        @if (isset($course->category_id) && !empty($course->category_id) && $course->category_id === 1)
                            @php $LINK = route('get-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                        @elseif (isset($course->category_id) && !empty($course->category_id) && $course->category_id === 5)
                            @php $LINK = route('dba-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                        @else
                            @php $LINK = route('get-master-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                        @endif
                        <a href="{{$LINK}}"><img
                                src="{{ Storage::url($course->course_thumbnail_file) }}"
                                alt="course" class="card-img-top" loading="lazy"></a>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                @if (isset($course->category_id) && !empty($course->category_id) &&  $course->category_id === 1)
                                <span class="badge bg-info-soft co-category">Award</span>
                                @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                $course->category_id === 2)
                                <span class="badge bg-info-soft co-category">Certificate</span>
                                @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                $course->category_id === 3)
                                <span class="badge bg-info-soft co-category">Diploma</span>
                                @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                $course->category_id === 4)
                                <span class="badge bg-info-soft co-category">Masters</span>
                                @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                $course->category_id === 5)
                                <span class="badge bg-info-soft co-category">DBA</span>
                                @endif
                                @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ? $course->ects : ''}}
                                    ECTS</span>@endif
                            </div>
                            <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                    href="{{route('get-course-details',['course_id'=>base64_encode($course->id)])}}"
                                    class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                            </h4>
                            <div class="d-flex justify-content-between mt-1">
                                @php $promoCode = getCoursePromoCode($course->id);@endphp
                                @if($promoCode)
                                    <small class="promo-code text-primary rounded p-1" style="background: #dae138;height:fit-content">
                                    <span class="badge badge-success text-primary" style="padding: 2px 4px"><span style="user-select: none">PROMO:</span> <span class="fw-bolder">{{$promoCode}}</span></span>
                                    </small>
                                @endif
                            </div>
                            {{-- <span class="text-dark"> --}}
                                {{-- <i class="fe fe-user"></i> --}}
                                {{-- @php $CountEnrolled = is_enrolled('',$course->id);@endphp {{$CountEnrolled}} Enrolled --}}
                                {{-- @php $CountEnrolled = $course->temp_count;@endphp {{$CountEnrolled}} Enrolled --}}
                            {{-- </span>  --}}
                        </div>
                        <!-- Card Footer -->
                        <div class="card-footer" style="min-height: 65px">
                            <div class="row align-items-center g-0">
                                <div class="col course-price-flex">
                                    @if(isset($course->category_id) && !empty($course->category_id) &&
                                    $course->category_id === 5)
                                        <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                        $course->course_final_price : 0}}<small>{{''.'/ per year'}}</small></h5>
                                    @else
                                        <h5 class="mb-0 course-price">€{{isset($course->course_final_price) ?
                                        $course->course_final_price : 0}}</h5>
                                    @endif
                                    @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_old_price) ? $course->course_old_price :
                                        0}} </h5>@endif
                                </div>

                                <div class="col-auto">
                                    @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                    @elseif (Auth::check() && Auth::user()->role =='user')
                                        @php
                                            $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $course->id]);
                                        @endphp
                                        @if(isset($course->category_id) && !empty($course->category_id) &&$course->category_id === 5)
                                            @php 
                                                $doc_verified = getData('student_doc_verification',['english_score','identity_is_approved','edu_is_approved','identity_doc_file','edu_doc_file','resume_file','edu_trail_attempt','identity_trail_attempt','english_test_attempt','proposal_is_approved'],['student_id'=>Auth::user()->id]);
                                            @endphp
                                            @if(Auth::user()->apply_dba == 'Yes')
                                                @if($doc_verified[0]->identity_is_approved == "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->resume_file != ''  && $doc_verified[0]->english_score >= 10 && $doc_verified[0]->proposal_is_approved == 'Approved')
                                                    @if (isset($isPaid)  && is_numeric($isPaid) &&  $isPaid == 0)
                                                        <div class="d-flex">
                                                            <form action="{{ route('checkout') }}" method="post">
                                                            @csrf <!-- CSRF protection -->
                                                            @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                            <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                            <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                            <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                            <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                            <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                            <button class="buy-now">Buy Now</button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                @else
                                                    <a href="{{route('student-document-verification')}}"><button class="buy-now">Buy Now</button></a>
                                                @endif
                                            @else
                                                @if (isset($isPaid) && is_numeric($isPaid) && $isPaid == 0)
                                                    <div class="d-flex">
                                                        <form action="{{ route('checkout') }}" method="post">
                                                        @csrf <!-- CSRF protection -->
                                                        @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                        <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                        <button class="buy-now">Buy Now</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endif
                                        @else
                                            @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                                @php
                                                    $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $course->id,'is_deleted'=>'No'], "", 'created_at');
                                                @endphp
                                                @if($course->category_id == '1')
                                                    @php $LINK = route('start-course-panel',['course_id'=>base64_encode($course->id)]); @endphp
                                                @else
                                                    @php $LINK = route('master-course-panel',['course_id'=>base64_encode($course->id)]); @endphp
                                                @endif
                                                @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() && $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                    <a  href="{{$LINK}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4 " ></i> Play</a>
                                                @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                                    <a  href="{{$LINK}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="bi bi-play-circle btn-outline-primary me-1 fs-4" ></i> Play</a>
                                                @else
                                                <div class="d-flex">
                                                    @php
                                                    $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                    @endphp
                                                    @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                    <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                    @else 
                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></i></a>
                                                    @endif
                                                    <form action="{{ route('checkout') }}" method="post">
                                                    @csrf <!-- CSRF protection -->
                                                    @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                    <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                    <button class="buy-now">Buy Now</button>
                                                    </form>
                                                </div>
                                                @endif
                                                {{-- @else
                                                    <a href="#"  class="text-inherit learningVerified playBtnStyle"><i class="fe fe-play btn-outline-primary "></i>Play</a>
                                                @endif --}}
                                            @else
                                                <div class="d-flex">
                                                    @php
                                                    $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                    @endphp
                                                    @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                    <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                                    @else 
                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px" loading="lazy"/></i></a>
                                                    @endif
                                                    
                                                    <form action="{{ route('checkout') }}" method="post">
                                                    @csrf <!-- CSRF protection -->
                                                    @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                    <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                    <button class="buy-now">Buy Now</button>
                                                    </form>
                                                </div>
                                            @endif 
                                        @endif     
                                    @else
                                        <div class="d-flex">
                                            <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}" data-withcart="withcart" loading="lazy"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" style="height: 25px; width: 25px"/></a>

                                            <form action="{{ route('checkout') }}" method="post">
                                                @csrf <!-- CSRF protection -->
                                                @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                <button class="buy-now">Buy Now</button>
                                            </form>
                                        </div>
                                    @endif
                            
                                </div>
                            </div>
                            @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                            @else
                            <div class="col-auto course-saved-btn">
                                @if (Auth::check() && Auth::user()->role =='user')
                                @php
                                        $isWishlist = is_exist('wishlist', ['student_id' => Auth::user()->id,'status'=>'Active','cart_wishlist' => '0','course_id'=> $course->id]);
                                    @endphp
                                    @if (isset($isWishlist) && !empty($isWishlist) && is_numeric($isWishlist) &&  $isWishlist > 0) 
                                        @php $showicon="bi heart-icon bi-heart-fill";@endphp
                                    @else
                                        @php $showicon="bi bi-heart heart-icon";@endphp
                                    @endif
                                    <a  class="text-inherit addwishlist" aria-label="Add to Wishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}"><i class="{{$showicon}}"></i></a>
                                @else
                                    <a  class="text-inherit addwishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}" data-withwishlist="withwishlist"><i class="bi bi-heart heart-icon"></i></a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="card card-hover">
                        <a href="{{route('get-course-details',['course_id'=>base64_encode($course->id)])}}">
                        <img src="{{ Storage::url($course->course_thumbnail_file) }}" alt="course"
                                class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;" loading="lazy"></a>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                @if (isset($course->category_id) && !empty($course->category_id) &&  $course->category_id === 1)
                                <span class="badge bg-info-soft co-category">Award</span>
                                @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                $course->category_id === 2)
                                <span class="badge bg-info-soft co-category">Certificate</span>
                                @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                $course->category_id === 3)
                                <span class="badge bg-info-soft co-category">Diploma</span>
                                @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                $course->category_id === 4)
                                <span class="badge bg-info-soft co-category">Masters</span>
                                @endif
                                @if(isset($course->ects) && !empty($course->ects))<span class="badge bg-success-soft co-etcs">{{isset($course->ects) ?
                                    $course->ects : ''}} ECTS</span>@endif
                            </div>
                            <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                    href="{{route('get-course-details',['course_id'=>base64_encode($course->id)])}}"
                                    class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                            </h4>

                        </div>
                        <!-- Card Footer -->
                        <div class="card-footer">
                            <div class="row align-items-center g-0"  style="VISIBILITY: HIDDEN;">
                                <div class="col course-price-flex">
                                    <h5 class="mb-0 course-price">€{{isset($course->course_old_price ) ?
                                        $course->course_old_price : 0}}</h5>
                                    @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{isset($course->course_final_price) ?
                                        $course->course_final_price : 0}} </h5>@endif
                                </div>

                                <div class="col-auto">
                                    <a class="text-inherit"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px" loading="lazy"/></a>
                                    <a class="buy-now">Buy Now</a>
                                </div>
                            </div>

                            <div class="col-auto course-saved-btn"   style="VISIBILITY: HIDDEN;">
                                <a class="text-reset bookmark"><i class="bi bi-heart"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @endif
            @endforeach
            @endif
        </div>

        {{-- <div class="mt-6">
            <a href="#" class="btn btn-outline-primary">Browse all</a>
        </div> --}}

    </div>


</section>


<!-- 4 Course Category top section  -->
<section class="bg-light mb-4 course-categories-section-top ">
    <!-- container -->

    <div class="container">
        <div class="row">
            <!-- col -->

            <div class="col-xl-12 col-md-12 col-12">
                <div class="row">
                    <div class="col-md-12 mb-4 mt-3 mt-lg-0">
                        <!-- heading -->
                        <h1 class="h1 fw-bold sectionheading">Course Categories</h1>
                        <!-- text -->

                        <p class="mb-0 fs-4">Browse Different Categories to Find Courses Aligned with Your Interests and
                            Learning Objectives.</p>
                    </div>
                </div>
                <div class="row gy-4">
                    <div class="col">
                        <!-- card -->

                        <div class="card border-top border-4 card-hover-with-icon">
                            <!-- card body -->
                            <a href="{{route('award-courses')}}">
                                <div class="card-body">
                                    <!-- icon  -->

                                    <div class="icon-shape icon-lg rounded-circle bg-light mb-3 card-icon">
                                        <img src="{{ asset('frontend/images/icon/course-category-icon-01.png') }}"
                                            alt="" loading="lazy">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <!-- heading -->

                                            <h4 class="mb-0">Award</h4>
                                            <!-- text -->
                                            @php $count=0; @endphp
                                            @foreach ($award as $key => $course)
                                            @if($course->status != 2)
                                               @php $count++; @endphp
                                            @endif
                                            @endforeach
                                            <p class="mb-0">{{($count)}} Courses</p>

                                        </div>
                                        <!-- arrow -->

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <!-- card -->

                        <div class="card border-top border-4 card-hover-with-icon">
                            <!-- card body -->
                            <a href="{{route('certificate-courses')}}">

                                <div class="card-body">
                                    <!-- icon -->
                                    <div class="icon-shape icon-lg rounded-circle bg-light mb-3 card-icon">
                                        <img src="{{ asset('frontend/images/icon/course-category-icon-02.png') }}"
                                            alt="" loading="lazy">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <!-- heading -->

                                            <h4 class="mb-0">Certificate</h4>
                                            <!-- text -->

                                            <p class="mb-0">{{count($certificate)}} Courses</p>
                                        </div>
                                        <!-- icon -->

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <!-- card -->

                        <div class="card border-top border-4 card-hover-with-icon">
                            <!-- card body -->
                            <a href="{{route('diploma-courses')}}" >

                                <div class="card-body">
                                    <div class="icon-shape icon-lg rounded-circle bg-light mb-3 card-icon">
                                        <img src="{{ asset('frontend/images/icon/course-category-icon-03.png') }}"
                                            alt="" loading="lazy">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <!-- heading -->

                                            <h4 class="mb-0">Diploma</h4>
                                            <!-- text -->

                                            <p class="mb-0">{{count($diploma)}} Courses</p>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <!-- card -->

                        <div class="card border-top border-4 card-hover-with-icon">
                            <!-- card body -->
                            <a href="{{route('masters-courses')}}">

                                <div class="card-body">
                                    <!-- icon -->
                                    <div class="icon-shape icon-lg rounded-circle bg-light mb-3 card-icon">
                                        <img src="{{ asset('frontend/images/icon/course-category-icon-04.png') }}"
                                            alt="" loading="lazy">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <!-- heading -->

                                            <h4 class="mb-0">Masters</h4>
                                            <!-- text -->

                                            <p class="mb-0">{{count($masters)}} Courses</p>
                                        </div>
                                        <!-- icon -->

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <!-- card -->

                        <div class="card border-top border-4 card-hover-with-icon">
                            <!-- card body -->
                            <a href="{{route('dba-courses')}}">
                                <div class="card-body">
                                    <!-- icon  -->

                                    <div class="icon-shape icon-lg rounded-circle bg-light mb-3 card-icon">
                                        <img src="{{ asset('frontend/images/icon/data-managemnet1.png') }}"
                                            alt="" loading="lazy">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <!-- heading -->

                                            <h4 class="mb-0">DBA</h4>
                                            <!-- text -->
                                            <p class="mb-0">1 Courses</p>

                                        </div>
                                        <!-- arrow -->

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                   
                   
                   

                  

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trending Now -->
<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body py-4">
                    <h2>Trending Now</h2>
                    <div class="mt-3">
                        @if (isset($master))
                        @foreach ($master as $key => $course)
                        @if($course->category_id != '5')
                            @if($key < 8 && $course->status != '2')
                                @if (isset($course->category_id) && !empty($course->category_id) && $course->category_id === 1)
                                    @php $LINK = route('get-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                                @elseif (isset($course->category_id) && !empty($course->category_id) && $course->category_id === 5)
                                    @php $LINK = route('dba-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                                @else
                                    @php $LINK = route('get-master-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                                @endif
                                @if($course->status == 3 )
                                    <a href="{{$LINK}}" 
                                    class="btn btn-light btn-xs mb-2 bg-blue-light color-blue text-start">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                                @else
                                    @if($course->category_id == '1')
                                            <a href="{{$LINK}}" 
                                        class="btn btn-light btn-xs mb-2 bg-blue-light color-blue text-start">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                                    @else
                                        <a href="{{$LINK}}" class="btn btn-light btn-xs mb-2 bg-blue-light color-blue text-start">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                                    @endif
                                @endif
                            @endif
                        @endif
                        @if($course->category_id == '5' && $course->status == 3)
                            <a href="{{route('dba-course-details',['course_id'=>base64_encode($course->id)])}}" 
                            class="btn btn-light btn-xs mb-2 bg-blue-light color-blue text-start">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a>
                        @endif
                        @endforeach
                        @endif
                      {{--   <a href="#" onclick="return false;"
                            class="btn btn-light btn-xs mb-2 bg-blue-light color-blue text-start">Training and
                            Development </a>
                        <a href="#" onclick="return false;"
                            class="btn btn-light btn-xs mb-2 bg-blue-light color-blue text-start">Employee and Labour
                            Relations </a>
                        <a href="#" onclick="return false;"
                            class="btn btn-light btn-xs mb-2 bg-blue-light color-blue text-start">Performance Management
                            and Compensation </a>
                        <a href="#" onclick="return false;"
                            class="btn btn-light btn-xs mb-2 bg-blue-light color-blue text-start">Professional
                            Development </a>
                        <a href="#" onclick="return false;"
                            class="btn btn-light btn-xs mb-2 bg-blue-light color-blue text-start">International
                            Organisational Management and Development </a>
                        <a href="#" onclick="return false;"
                            class="btn btn-light btn-xs mb-2 bg-blue-light color-blue text-start">Global Business
                            Strategy</a>
                        <a href="#" onclick="return false;"
                            class="btn btn-light btn-xs mb-2 bg-blue-light color-blue text-start">Public Speaking and
                            Presentation Skills</a>
                        <a href="#" onclick="return false;"
                            class="btn btn-light btn-xs mb-2 bg-blue-light color-blue text-start">Human Resource
                            Management</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Start Learning Section  -->
<section class="pb-lg-8 pt-3 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <div class="bg-primary py-6 px-4 px-lg-0 rounded-4 mb-3 mb-md-6">
                    <div class="row align-items-center">
                        <div class=" ps-lg-8 col-xl-7 col-md-7 col-12">
                            <div>
                                <h2 class="h1 text-white mb-3 fw-bold color-green">Begin Your Learning Journey Now!
                                </h2>
                                <p class="text-white-50 fs-4 mb-2 mb-md-2">Explore endless opportunities for growth and
                                    development with our expertly crafted courses. Take the first step towards enriching
                                    your knowledge and skills.</p>
                                    @if (!Auth::check())
                                        <a href="{{route('login')}}"><button class="btn btn-dark btn-main-3 ">Start
                                        Learning</button></a>
                                    @elseif (Auth::check() && Auth::user()->role == 'user')
                                        <a href="{{route('student-my-learning')}}"><button class="btn btn-dark btn-main-3 ">Start
                                        Learning</button></a>
                                    @endif
                            </div>
                        </div>
                        <div class="col-xl-5 col-md-5 col-12">
                            <div class="text-center d-none d-md-block">
                                <img src="{{ asset('frontend/images/student-seating-01.png') }}" alt="learning"
                                    class="img-fluid" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!--Certification Section-->
<section class="pb-lg-8 py-6 ">
    <div class="container ">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <div class=" mb-lg-5 mb-4">
                    <h1 class="h1 fw-bold sectionheading">
                        Master Your Skills with Our Certified Courses!
                    </h1>
                    <p class="lead mb-0 fs-4">Elevate your education with our MQF/EQF-certified courses. Aligned with
                        international standards, they enhance your global career opportunities.</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-6 col-md-12 col-12">
                <div class="mb-6 mb-lg-0">
                    <div class="mb-2">
                        <img src="{{ asset('frontend/images/certificate/certificate-sample-01.png') }}"
                            alt="certificate" class="img-fluid w-100" loading="lazy">
                    </div>
                    <div class="d-flex">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="var(--gk-primary)"
                                class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                <path
                                    d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                            </svg>
                        </span>
                        <span class="ms-2">Completion certificate for each course completed.</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 offset-xl-1 col-lg-6 col-md-12 col-12">
                <div class="row ">
                    <div class="col-md-12 col-lg-6">
                        <div class="mb-4 mb-xl-6">
                            <div class="mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="var(--gk-primary)"
                                    class="bi bi-trophy" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935zM3.504 1c.007.517.026 1.006.056 1.469.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.501.501 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667.03-.463.049-.952.056-1.469H3.504z" />
                                </svg>
                            </div>
                            <div>
                                <h4>Flexible Learning Schedule</h4>
                                <p>Study at your own pace from anywhere at any time.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="mb-lg-6 mb-4">
                            <div class="mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="var(--gk-primary)"
                                    class="bi bi-star" viewBox="0 0 16 16">
                                    <path
                                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4>Globally Recognized Certification</h4>
                                <p>Earn certifications recognized by the European Qualifications Framework.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="mb-4 mb-md-0">
                            <div class="mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="var(--gk-primary)"
                                    class="bi bi-shield-lock" viewBox="0 0 16 16">
                                    <path
                                        d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                                    <path
                                        d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                                </svg>
                            </div>
                            <div>
                                <h4>High-Quality Course Content</h4>
                                <p>Discover top-notch education by top instructors.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div>
                            <div class="mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="var(--gk-primary)"
                                    class="bi bi-nut" viewBox="0 0 16 16">
                                    <path
                                        d="m11.42 2 3.428 6-3.428 6H4.58L1.152 8 4.58 2h6.84zM4.58 1a1 1 0 0 0-.868.504l-3.428 6a1 1 0 0 0 0 .992l3.428 6A1 1 0 0 0 4.58 15h6.84a1 1 0 0 0 .868-.504l3.429-6a1 1 0 0 0 0-.992l-3.429-6A1 1 0 0 0 11.42 1H4.58z" />
                                    <path
                                        d="M6.848 5.933a2.5 2.5 0 1 0 2.5 4.33 2.5 2.5 0 0 0-2.5-4.33zm-1.78 3.915a3.5 3.5 0 1 1 6.061-3.5 3.5 3.5 0 0 1-6.062 3.5z" />
                                </svg>
                            </div>
                            <div>
                                <h4>Regular Assessment & Feedback</h4>
                                <p>Continuous assessment and personalized feedback for excellence.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- One Platform Many Courses -->
<section class="pb-2 pt-4 bg-white">
    <div class="container">
        <div class="row mb-4 align-items-center justify-content-center">
            <div class="col-md-12">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-12 text-lg-start">
                        <!-- caption -->
                        <span class="text-primary mb-3 d-block text-uppercase fw-semibold ls-xl">Premier Learning
                            Platform!</span>
                        <h2 class="mb-2 display-5 fw-bold mb-3">
                            One Platform Many Courses
                        </h2>
                        <p class="fs-4">Dive into a Multitude of Subjects, All in One Convenient Hub for Optimal
                            Learning and Growth.</p>

                        <hr class="my-5">
                        <!-- Counter -->
                        <div class="mt-5 row">
                            <!-- list -->
                            <div class="col">
                                <ul class="list-unstyled fs-4 fw-medium">
                                    <li class="mb-2 d-flex">
                                        <span class="me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" class="bi bi-check-circle-fill text-success"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="text-nowrap">Interactive Learning Modules</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" class="bi bi-check-circle-fill text-success"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="text-nowrap">Personalized Progress Tracking</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" class="bi bi-check-circle-fill text-success"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="text-nowrap">Supportive Community Forums</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <!-- list -->
                                <ul class="list-unstyled fs-4 fw-medium">
                                    <li class="mb-2 d-flex">
                                        <span class="me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" class="bi bi-check-circle-fill text-success"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="text-nowrap">Expert Guidance and Mentorship</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" class="bi bi-check-circle-fill text-success"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="text-nowrap">Accessible Anytime, Anywhere</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" class="bi bi-check-circle-fill text-success"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="">Continuous Assessment and Feedback</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Img -->
                    <div class="col-xl-4 col-lg-4 col-12 mb-2 mb-lg-0">
                        <img src="{{ asset('frontend/images/course-platform-01.png') }}" alt="instructor"
                            class="img-fluid" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tess and Claire section  -->
    @if(!Auth::check())
<section class="py-8 tess-claire-section">
    <div class="container ">

            <div class="row">

                <div class="col-md-6 mt-2 mt-md-0 d-flex">
                    <div class="bg-blue p-4 rounded-4">
                        <div class="row align-items-center">

                            <div class=" col-xl-8 col-md-6 col-12">
                                <div>
                                    <h2 class=" text-white mb-4 fw-bold color-green">Discover top-rated online courses
                                        with global recognition.</h2>
                                    @if (Auth::check())
                                    @if(Auth::user()->role =='instructor')
                                        <a><button class="btn  btn-main-3 " style="white-space: nowrap">Start Learning</button></a>
                                    @elseif(Auth::user()->role == 'user')
                                        <a href="{{route('dashboard')}}"><button class="btn  btn-main-3 " style="white-space: nowrap">Start Learning</button></a>
                                    @endif
                                    @else
                                        <a href="{{route('user.signup')}}"><button class="btn  btn-main-3" style="white-space: nowrap">Start
                                        Learning</button></a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="text-center d-none d-md-block">
                                    <img src="{{ asset('frontend/images/claire-photo-01.png') }}" alt="learning"
                                        class="img-fluid" loading="lazy">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6 mt-2 mt-md-0 d-flex">
                    <div class="bg-blue p-4 rounded-4">
                        <div class="row align-items-center">
                            @php $href = 'teacher-enrollment'; @endphp
                            <div class=" col-xl-8 col-md-6 col-12">
                                <div>
                                    <h2 class=" text-white mb-4 fw-bold color-green">Inviting teachers to join our
                                        exchange program.</h2>
                                    @if (Auth::check())
                                    @if(Auth::user()->role =='instructor' || Auth::user()->role == 'user')
                                        <a class="color-blue"><button class="btn  btn-main-3" style="cursor: default">Register
                                            Now</button></a>
                                    @endif
                                    @else
                                        <a href="{{route('instructor.signup')}}" class="color-blue"><button class="btn  btn-main-3">Register
                                            Now</button></a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="text-center d-none d-md-block">
                                    <img src="{{ asset('frontend/images/tess-photo-01.png') }}" alt="learning"
                                        class="img-fluid" loading="lazy">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
</section>
{{-- <hr/> --}}
@endif

{{-- Testimonial Section --}}

{{-- <section class="py-6">
<div class="container"> --}}
    {{-- <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12 col-12 text-center">
            <div class="mb-8">
                <!-- caption -->
                <span class="text-primary mb-3 d-block text-uppercase fw-semibold ls-xl">Testimonials</span>
                <h2 class="mb-2 display-4 fw-bold">Don’t just take our word for it.</h2>
                <p class="lead mb-0">12+ thousands people are already learning on Eascencia</p>
            </div>
        </div>
    </div> --}}

     <!-- row -->
     {{-- <div class="row">
        <div class="col-12">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @php 
                    $TestiMonialData =
                    getData('testimonals',['name','last_name','id','designation','image','feedback',],['status'=>'0','is_deleted'=>'No'],'','id','desc');
                        @endphp
                    @foreach($TestiMonialData as $key => $data)
                    <div class="swiper-slide">
                        <img src="{{Storage::url($data->image)}}" alt="Missy" class="testimonial-img">
                        <div class="testimonial-name">{{isset($data->name) ? $data->name.''.$data->last_name : ''}}</div>
                        <div class="testimonial-role">{{isset($data->designation) ? $data->designation : ''}}</div>
                        <div class="testimonial-text">{{isset($data->feedback) ? $data->feedback :''}}</div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
     </div> --}}
    
    
{{-- </div>

</section> --}}
</main>

{{-- <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script> --}}
<script>
    // document.querySelectorAll('img').forEach(img => {
    //     img.onload = () => img.classList.add('loaded');
    // });

    $(document).ready(function () {

        const $prevIcon = $('.prev');

        if ($prevIcon.attr('aria-disabled') === "true") {
            $prevIcon.hide(); // Hide the element
        }
});
</script>
@endsection
