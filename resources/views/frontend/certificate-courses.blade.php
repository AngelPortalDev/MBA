@extends('frontend.master') @section('content')

<style>
    .sidenav.navbar .navbar-nav .sp-1 > .nav-link {
        color: #2b3990 !important;
        background-color: rgb(235 233 255);
    }
    .buy-now {
        background: none;
        border: none;
        color: blue;
        cursor: pointer;
    }
    .buy-now:focus {
        outline: none;
    }
    .buy-now:active {
        color:rgb(12, 34, 136);
    }
</style>

<main>
    <section class="py-4 py-lg-6 bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div>
                        <h1 class="text-white mb-1 display-4 color-green">Certificate Courses</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="course-category-tabs-main pt-5 pb-3 pb-lg-2">
        <!-- row -->
        <div class="container mb-lg-8">
            <div class="row">
                <!-- col -->
                <div class="col-12">
                    {{-- <div class="mb-4">
                        <p>
                            Explore our most popular programs, get job-ready for an in-demand career.
                        </p>
                    </div> --}}
                </div>
            </div>
            <div class="row row-gap-3">
                @php
                $certificate =
                    getData('course_master',['course_title','id','selling_price','ects','course_final_price','course_old_price','course_thumbnail_file','status','temp_count'],['category_id'=>'2'],'',DB::raw('IFNULL(published_on, "NULL")'),'asc');
                $allowedRoles = ['institute', 'superadmin', 'admin', 'instructor', 'sub-instructor'];
                
                @endphp
                @if (count($certificate) > 0)
                @foreach ($certificate as $course) 
                @if($course->status != '2')
                <div class="col-md-6 col-sm-12 col-lg-4 col-xl-3 mt-3">
                    
                        @if($course->status == '3')
                        <!-- Card -->
                            <div class="card card-hover">
                                <a href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"><img
                                    src="{{ Storage::url($course->course_thumbnail_file) }}"
                                    alt="course" class="card-img-top" loading="lazy"></a>
                                <!-- Card Body -->
                                <div class="card-body course_cardbody">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge bg-info-soft co-category">Certificate</span>
                                        <span class="badge bg-success-soft co-etcs">{{isset($course->ects) ?
                                            $course->ects : ''}} ECTS</span>
                                    </div>
                                    <h4 class="mb-2 text-truncate-line-2 course-title"><a
                                            href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"
                                            class="text-inherit">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a></h4>
                                    <div class="d-flex justify-content-between mt-1 promo_code_division">
                                        <span class="text-dark enroll_icon">
                                            <i class="fe fe-user"></i>
                                            {{-- @php $CountEnrolled = is_enrolled('',$course->id);@endphp {{$CountEnrolled}} Enrolled --}}
                                            @php $CountEnrolled = $course->temp_count;@endphp {{$CountEnrolled}} Enrolled
                                        </span> 
                                        @php $promoCode = getCoursePromoCode($course->id);@endphp
                                        @if($promoCode)
                                            <small class="promo-code font-weight-bold text-primary rounded p-1">
                                            <span class="badge badge-success text-primary badge_icon" style="padding: 2px 4px"><span style="user-select: none">PROMO:</span> <span class="fw-bold">{{$promoCode}}</span></span>
                                            </small>
                                        @endif
                                    </div>
                                    {{-- <div class="lh-1 mt-3">

                                        <span class="fs-6">
                                            <i class="fe fe-user color-blue"></i>
                                            0 Enrolled
                                        </span>

                                    </div> --}}
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

                                        {{-- <div class="col-auto">
                                            @if (Auth::check() && Auth::user()->role =='user')
                                                @php
                                                    $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $course->id]);
                                                @endphp
                                                @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                                    @php
                                                    $isVerified = is_exist('student_doc_verification', ['student_id'=>auth()->user()->id,'identity_is_approved'=>'Approved','edu_is_approved'=>'Approved']);
                                                    @endphp
                                                    @if (isset($isVerified) && !empty($isVerified) && is_numeric($isVerified) &&  $isVerified > 0)
                                                        <a  href="{{route('start-course-panel',['course_id'=>base64_encode($course->id)])}}" class="mt-2 d-flex align-items-center justify-content-center"><i
                                                            class="fe fe-play btn-outline-primary "></i> Play & Continue</a>
                                                    @else
                                                        <a href="#" class="text-inherit learningVerified"><i class="fe fe-play btn-outline-primary "></i>Play</a>
                                                    @endif
                                                    @else
                                                    <div class="d-flex">
                                                        <a href="#" class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><i class="fe fe-shopping-cart text-primary align-middle me-2"></i></a>
                                                        
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
                                                    <a href="{{route('login')}}" class="text-inherit"><i class="fe fe-shopping-cart text-primary align-middle me-2"></i></a>
                                                    <a href="{{route('login')}}" class="buy-now">Buy Now</a>
                                                @endif
                                        </div> --}}
                                        
                                        <div class="col-auto">
                                            @if(Auth::check() && in_array(Auth::user()->role, $allowedRoles))
                                            @elseif (Auth::check() && Auth::user()->role =='user')
                                                @php
                                                    $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $course->id]);
                                                @endphp
                                                @php
                                                    $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $course->id ,'is_deleted'=>'No'], "", 'created_at');
                                                @endphp
                                                @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                    <a href="{{route('master-course-panel',['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle "><i class="bi bi-play-circle btn-outline-primary me-1 fs-4"></i> Play </a>
                                                @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                                    <a href="{{route('master-course-panel',['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle"><i class="bi bi-play-circle btn-outline-primary me-1 fs-4"></i> Play </a>
                                                @else
                                                    <div class="d-flex">
                                                        @php
                                                            $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                        @endphp
                                                        @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" style="height: 25px; width: 25px"/></a>
                                                        @else 
                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" style="height: 25px; width: 25px"/></a>
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
                                                    <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}" data-withcart="withcart"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" style="height: 25px; width: 25px"/></a>
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
                                        </div>
                                    </div>

                                    {{-- <div class="col-auto course-saved-btn">
                                        <a href="#" class="text-reset bookmark">
                                            <i class="bi bi-suit-heart fs-4"></i>
                                        </a>
                                    </div> --}}
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
                                            <a  class="text-inherit addwishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}"><i class="{{$showicon}}"></i></a>
                                        @else
                                            {{-- <a href="{{route('login')}}" class="text-reset bookmark"> --}}
                                                {{-- <i class="bi bi-suit-heart fs-4"></i> --}}
                                                {{-- <i class="bi bi-heart heart-icon"></i> --}}
                                            {{-- </a> --}}
                                            <a  class="text-inherit addwishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}" data-withwishlist="withwishlist"><i class="bi bi-heart heart-icon"></i></a>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="card card-hover">
                            <img src="{{ Storage::url($course->course_thumbnail_file) }}" alt="course"
                                        href="{{route('get-master-course-details',['course_id'=>base64_encode($course->id)])}}"
                                        class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;" loading="lazy">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge bg-info-soft co-category">Certificate</span>
                                        <span class="badge bg-success-soft co-etcs">{{isset($course->ects) ? $course->ects : ''}} ECTS</span>
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
                                            <a class="text-inherit"><i class="fe fe-shopping-cart text-primary align-middle me-2"></i></a>
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
                <img src="{{ asset('frontend/images/ComingSoon.png') }}" alt="Certificate" style="width:auto;height:auto" loading="lazy"/>
                @endif
            </div>
        </div>
    </section>
</main>

@endsection
