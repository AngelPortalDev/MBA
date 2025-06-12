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
        font-family: serif;
    }
    .buy-now:focus {
        outline: none;
    }
    .buy-now:active {
        color:red;
    }
    .link-button {
        background: none; /* Removes the button background */
        border: none; /* Removes the button border */
        color: blue; /* Matches the typical link color */
        text-decoration: underline; /* Adds underline to mimic a link */
        cursor: pointer; /* Changes the cursor to pointer like a link */
        padding: 0; /* Removes any default button padding */
        font: inherit; /* Ensures it inherits the font styles from the surrounding text */
    }

    .link-button:hover {
        text-decoration: none; /* Optional: Removes underline on hover */
        color: darkblue; /* Optional: Darker color for hover effect */
    }

</style>

<main>
    <section class="py-4 py-lg-6 bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div>
                        <h1 class="text-white mb-1 display-4">My Learning</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5 py-md-5 my-learning-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Side Navbar -->           
                    <ul class="nav nav-lb-tab mb-6" id="tab" role="tablist">
                        <li class="nav-item ms-0" role="presentation">
                            <a class="nav-link active" id="purchased-courses-tab" data-bs-toggle="pill" href="#purchased-courses" role="tab" aria-controls="purchased-courses" aria-selected="false" tabindex="-1">Assigned Courses</a>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                            <a class="nav-link " id="shopping-cart-tab" data-bs-toggle="pill" href="#shopping-cart" role="tab" aria-controls="shopping-cart" aria-selected="true">
                                My Cart
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item" role="presentation">
                            <a class="nav-link " id="wishlist-tab" data-bs-toggle="pill" href="#wishlist" role="tab" aria-controls="wishlist" aria-selected="true">
                                Wishlist
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="expired-courses-tab" data-bs-toggle="pill" href="#expired-courses" role="tab" aria-controls="expired-courses" aria-selected="true">
                                Expired Courses
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="certificate-tab" data-bs-toggle="pill" href="#certificate" role="tab" aria-controls="certificate" aria-selected="true">
                                Certificate
                            </a>
                        </li> --}}

                    </ul>
                    <!-- Tab content -->
                    <div class="tab-content" id="tabContent">
                        
                        {{-- Purchased Courses --}}
                        <div class="tab-pane fade active show" id="purchased-courses" role="tabpanel" aria-labelledby="purchased-courses-tab">
                            <div class="row">
                                @php $count = '';@endphp
                                 @php 
                                    if(session('optional_master_courseid')){
                                        $existOptionalCourseData = 
                                        getData('student_course_master', [ 'course_id' => session('optional_master_courseid'), ['preference_id', '=', null],'preference_status' => '1',  ['course_expired_on', '>', now()], 'user_id' => auth()->user()->id  ],'1','','desc'
                                        );
                                        if (is_null($existOptionalCourseData)) {
                                            $existOptionalCourseData = [];
                                        }
                                        $count = count($existOptionalCourseData);
                                    }
                                @endphp
                                @php
                                    $DocumentVerified = ''; 
                                    $where = [
                                        'user_id' => Auth()->user()->id,
                                        'include_adjusted_expiry' => false
                                    ];
                                    $studentRecords = getPaidCourse($where); 
                                @endphp
                                @if(!empty($studentRecords))
                                    {{-- @php 
                                        $doc_verified = getData('student_doc_verification',['english_score','identity_is_approved','edu_is_approved','identity_doc_file','edu_doc_file','resume_file','edu_trail_attempt','identity_trail_attempt','english_test_attempt'],['student_id'=>Auth::user()->id]);
                                    @endphp
                                        @if($doc_verified[0]->identity_is_approved == "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->resume_file != ''  && $doc_verified[0]->english_score >= 10)
                                        @php $DocumentVerified = "";  @endphp
                                        @elseif(($doc_verified[0]->identity_is_approved == "Reject" && $doc_verified[0]->identity_trail_attempt == 0 ) || ($doc_verified[0]->edu_is_approved == "Reject" && $doc_verified[0]->edu_trail_attempt == 0))
                                            @php $DocumentVerified = "";   @endphp
                                        @elseif($doc_verified[0]->english_test_attempt == "1" && $doc_verified[0]->english_score <= 10)
                                            @php $DocumentVerified = "englishVerified";   @endphp
                                        @elseif($doc_verified[0]->english_test_attempt == "0" && $doc_verified[0]->english_score <= 10)
                                            @php $DocumentVerified = "englishAttempt";   @endphp
                                        @elseif($doc_verified[0]->edu_doc_file != "" && $doc_verified[0]->identity_doc_file != "" &&    $doc_verified[0]->resume_file != ''  && $doc_verified[0]->english_score != '')
                                            @php $DocumentVerified = ""; @endphp
                                        @else
                                            @php $DocumentVerified = "NotVerified"; @endphp
                                        @endif --}}
                                    @foreach($studentRecords  as $key =>  $value)


                                        @php 
                                        $existOptionalCourse = 
                                            getData('master_course_management',['optional_course_id'],['award_id'=>$value->course_id,['optional_course_id','!=',''],'is_deleted'=>'No'],'','','asc');
                                        @endphp
                                        <div class="col-lg-3 col-md-6 col-12 my-2">
                                            <!-- Card -->
                                            <div class="card card-hover">
                                             
                                                <img src="{{ Storage::url($value->podcast_thumbnail_file) }}" 
                                                        alt="Trailer Thumbnail" 
                                                        style="width: 100%; height: 100%; object-fit: cover;"  
                                                        class="openVideoModal"
                                                        {{-- data-video-url="{{ Storage::url($value->bn_video_url_id) }}" --}}
                                                        data-video-url ="https://iframe.mediadelivery.net/embed/{{env('AWARD_LIBRARY_ID')}}/{{ $value->bn_video_url_id }}?autoplay=true" 
                                                        
                                                        />

                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        @php  $catgeory_name = ""; @endphp
                                                        @if($value->category_id == '1') @php  $catgeory_name = "Award"; @endphp
                                                        @elseif($value->category_id == '2') @php  $catgeory_name = "Certificate"; @endphp
                                                        @elseif($value->category_id == '3') @php  $catgeory_name = "Diploma"; @endphp
                                                        @elseif($value->category_id == '4') @php  $catgeory_name = "Master"; @endphp
                                                        @endif
                                                        {{-- <span class="badge bg-info-soft co-category">{{$catgeory_name}}</span> --}}
                                                        {{-- <span class="badge bg-success-soft co-etcs">{{$value->ects}} ECTS</span> --}}
                                                    </div>
                                                    <h4 class="mb-2 text-truncate-line-2 course-title">
                                                            <a target="_blank" class="text-inherit">{{htmlspecialchars_decode($value->course_title)}}</a>
                                                            {{-- @if($value->course_expired_on != '')
                                                            <h5 class="badge mt-2" style="background: #dae138; color: #2b3990"> 
                                                            {{isset($value->course_expired_on) ? 'Access until '.\Carbon\Carbon::parse($value->course_expired_on)->format('d-m-y') : ''}}.</h5>
                                                            @endif --}}

                                                    </h4>
                                                    {{-- <div class="mt-3">

                                                        <div class="progress" style="height: 6px">

                                                            <div class="progress-bar bg-blue" role="progressbar" style="width: {{isset($value->course_progress) ? $value->course_progress : 0}}%" aria-valuenow="{{isset($value->course_progress) ? $value->course_progress : 0}}" aria-valuemin="0" aria-valuemax="100"></div>

                                                        </div> 

                                                        <small>{{isset($value->course_progress) ? $value->course_progress : 0}} % Completed</small>

                                                    </div>
                                                   --}}
                                                    @if(count($existOptionalCourse) > 0 && $value->preference_id == '') 
                                                        <button class="optionalCourseAdd link-button" id="optionalCourseAdd" data-master_course_id="{{base64_encode($value->course_id)}}"
                                                            data-master_course_ects="{{base64_encode($value->ects)}}" data-student_course_master_id={{base64_encode($value->scmId)}}>Select Your Optional ECTS</button>
                                                    @endif
        
                                                </div> 
                                                <div class="modal fade modal-lg" id="addOptionalCourse" tabindex="" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="taskModalLabel">Select Your Optional ECTS</h5>
                                                                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"  disabled aria-label="Close"></button> --}}
                                                            </div>
                                                            <div class="modal-body">
                                                                <button class="btn btn-primary proceedButton" data-course-id="{{ base64_encode($value->course_id) }}" disabled>Proceed</button>
    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- @if(!empty($studentData[0]['orderlist'])) --}}
                                        {{-- @foreach($studentData[0]['orderlist']  as $key =>  $value)
                                        @php $studentExist = getData('student_course_master',['course_expired_on','course_id','exam_attempt_remain','exam_remark'],['course_id'=>$value['course_id'], 'user_id'=>$value['user_id'],'payment_id'=>$value['payment_id'],'is_deleted'=>'No'],'','created_at','desc');
                                        @endphp
                                        @if (isset($studentExist) && count($studentExist) > 0 && ($studentExist[0]->exam_attempt_remain != "0" && $studentExist[0]->exam_remark == '0'  || $studentExist[0]->exam_attempt_remain == "2" || $studentExist[0]->exam_attempt_remain == '1' && $studentExist[0]->exam_remark == '0' ))
                                            @if($studentExist[0]->course_expired_on > now()) 
                                                @php
                                                    $doc_verified = getData('student_doc_verification',['english_score','identity_is_approved','edu_is_approved','identity_doc_file','edu_doc_file','resume_file','edu_trail_attempt','identity_trail_attempt','english_test_attempt'],['student_id'=>Auth::user()->id]);
                                                @endphp 
                                                @if($doc_verified[0]->identity_is_approved == "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->resume_file != ''  && $doc_verified[0]->english_score >= 10)
                                                    @php $DocumentVerified = "";  @endphp
                                                @elseif(($doc_verified[0]->identity_is_approved == "Reject" && $doc_verified[0]->identity_trail_attempt == 0 ) || ($doc_verified[0]->edu_is_approved == "Reject" && $doc_verified[0]->edu_trail_attempt == 0))
                                                    @php $DocumentVerified = "";   @endphp
                                                @elseif($doc_verified[0]->english_test_attempt == "1" && $doc_verified[0]->english_score <= 10)
                                                    @php $DocumentVerified = "englishVerified";   @endphp
                                                @elseif($doc_verified[0]->english_test_attempt == "0" && $doc_verified[0]->english_score <= 10)
                                                    @php $DocumentVerified = "englishAttempt";   @endphp
                                                @elseif($doc_verified[0]->edu_doc_file != "" && $doc_verified[0]->identity_doc_file != "" &&    $doc_verified[0]->resume_file != ''  && $doc_verified[0]->english_score != '')
                                                    @php $DocumentVerified = ""; @endphp
                                                @else
                                                    @php $DocumentVerified = "NotVerified"; @endphp
                                                @endif
                                    
                                                @if($value['status'] == '0')
                                                @php
                                                    $award = getData('course_master',['course_title','id','selling_price','ects','course_final_price','course_old_price','category_id','course_thumbnail_file'],['id'=>$value['course_id'],'status'=>3,'is_deleted'=>'No'],'','created_at','desc');
                                                    $studentCourseMaster = getData('student_course_master',['course_expired_on','course_progress','exam_remark','exam_attempt_remain'],['course_id'=>$value['course_id'], 'user_id'=>$value['user_id'],'is_deleted'=>'No','payment_id'=>$value['payment_id']],'','created_at','desc');
                                                @endphp
                                                

                                                @if(!empty($award[0]->course_title))
                                                    <div class="col-lg-3 col-md-6 col-12 my-2">
                                                        <!-- Card -->
                                                        <div class="card card-hover">
                                                            
                                                            @php $exam_remark = ''; @endphp
                                                            @if($studentCourseMaster[0]->exam_remark == 0)
                                                                @php $exam_remark = "Failed"; @endphp
                                                            @elseif($studentCourseMaster[0]->exam_remark == 1)
                                                                @php $exm_remark = "Passed";@endphp
                                                            @endif
                                                            @php $STYLE = "" @endphp
                                                            @if(isset($studentCourseMaster) && !empty($studentCourseMaster) &&  $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                                <a target="_blank" href="{{route('start-course-panel',['course_id'=>base64_encode($award[0]->id)])}}" class="text-inherit"><img  src="{{ Storage::url($award[0]->course_thumbnail_file) }}" alt="course" class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;"></a>
                                                                @php $LINK = route('start-course-panel',['course_id'=>base64_encode($award[0]->id)]); @endphp
                                                            @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster)  &&    $studentCourseMaster[0]->exam_attempt_remain == '2')
                                                                <a target="_blank" href="{{route('start-course-panel',['course_id'=>base64_encode($award[0]->id)])}}" class="text-inherit"><img
                                                                    src="{{ Storage::url($award[0]->course_thumbnail_file) }}"
                                                                    alt="course" class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;"></a>
                                                                @php $LINK = route('start-course-panel',['course_id'=>base64_encode($award[0]->id)]); @endphp
                                                            @else
                                                                <img src="{{ Storage::url($award[0]->course_thumbnail_file) }}"
                                                                alt="course" class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;">
                                                                @php $LINK = "#"; $STYLE="style='pointer-events: none !important;'"; @endphp

                                                            @endif

                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                                    @php  $catgeory_name = ""; @endphp
                                                                    @if($award[0]->category_id == '1') @php  $catgeory_name = "Award"; @endphp
                                                                    @elseif($award[0]->category_id == '2') @php  $catgeory_name = "Certificate"; @endphp
                                                                    @elseif($award[0]->category_id == '3') @php  $catgeory_name = "Diploma"; @endphp
                                                                    @elseif($award[0]->category_id == '4') @php  $catgeory_name = "Master"; @endphp
                                                                    @endif
                                                                    <span class="badge bg-info-soft co-category">{{$catgeory_name}}</span>
                                                                    <span class="badge bg-success-soft co-etcs">{{$award[0]->ects}} ECTS</span>
                                                                </div>
                                                                <h4 class="mb-2 text-truncate-line-2 course-title">
                                                                        <a target="_blank" href="{{$LINK}}" {!! $STYLE !!} class="text-inherit">{{$award[0]->course_title}}</a>
                                                                        @if($studentCourseMaster[0]->course_expired_on != '')
                                                                        <h5 class="badge mt-2" style="background: #dae138; color: #2b3990"> 
                                                                        {{isset($studentCourseMaster[0]->course_expired_on) ? 'Access until '.\Carbon\Carbon::parse($studentCourseMaster[0]->course_expired_on)->format('d-m-y') : ''}}.</h5>
                                                                        @endif

                                                                </h4>
                                                                <div class="mt-3">

                                                                    <div class="progress" style="height: 6px">

                                                                        <div class="progress-bar bg-blue" role="progressbar" style="width: {{isset($studentCourseMaster[0]->course_progress) ? $studentCourseMaster[0]->course_progress : 0}}%" aria-valuenow="{{isset($studentCourseMaster[0]->course_progress) ? $studentCourseMaster[0]->course_progress : 0}}" aria-valuemin="0" aria-valuemax="100"></div>

                                                                    </div> 

                                                                    <small>{{isset($studentCourseMaster[0]->course_progress) ? $studentCourseMaster[0]->course_progress : 0}} % Completed</small>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @elseif ($studentExist[0]->course_expired_on < now() )
                                                    <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-4 mb-3">
                                                        <a href="{{ route('index', ['scroll' => 'true']) }}" width="20;" class="btn btn-primary">Start Learning</a>
                                                    </div>                                            
                                            @endif
                                            @endif
                                        @endif
                                    @endforeach --}}
                                @else
                                    <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-2 mb-3">
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="{{ asset('frontend/images/icon/purchase_course.svg')}}" alt="not found" style="height: 160px; width: 160px">
                                            <h3 class="mt-3">Purchase Course</h3>
                                            <p>Unfortunately, There is no purchase course. Check out our latest offerings!</p>
                                            <a href="{{ route('index', ['scroll' => 'true']) }}" width="20;" class="btn btn-primary">Start Learning</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <br>
                              @php $show @endphp
                            {{-- <div class="row">
                                <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-5">
                                    <p>You’ve reached the end of the list</p>
                                </div>
                            </div> --}}
                        </div>




                        {{-- Wishlist --}}
                      
                
                        {{-- @php print_r($studentData[0]['wishlist']);die;  @endphp --}}
                        <div class="tab-pane fade mt-3" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                            
                        <div class="row">
                           
                            @if(!empty($studentData[0]['wishlist']))
                                @foreach($studentData[0]['wishlist']  as $key =>  $value)
                                @php
                                $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '1','course_id'=> $value['course_id']]);
                                $isPayNotDone = getData('orders',['status'],['id'=>$value['course_id']],'','created_at','desc');   @endphp
                                {{-- @php  print_r($studentData[0]['wishlist']); @endphp --}}
                                        @php
                                        $award = getData('course_master',['course_title','id','selling_price','ects','course_final_price','course_old_price','category_id','course_thumbnail_file'],['id'=>$value['course_id'],'status'=>3],'','created_at','desc');
                                        @endphp 

                                        @if(!empty($award[0]->course_title))
                                            <div class="col-lg-3 col-md-6 col-12 mt-2">
                                                <!-- Card -->
                                                <div class="card card-hover">
                                                    <a href="{{route('get-course-details',['course_id'=>base64_encode($award[0]->id)])}}" target="_blank">
                                                        <img
                                                        src="{{ Storage::url($award[0]->course_thumbnail_file) }}"
                                                        alt="course" class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;">
                                                    </a>

                                                    <div class="col-auto bookmark-icon course-saved-btn">
                                                    @php
                                                        $isWishlist = is_exist('wishlist', ['student_id' => Auth::user()->id,'cart_wishlist' => '0','course_id'=> $award[0]->id]);
                                                    @endphp
                                                    @if (isset($isWishlist) && !empty($isWishlist) && is_numeric($isWishlist) &&  $isWishlist > 0) 
                                                        @php $showicon="bi heart-icon bi-heart-fill";@endphp
                                                    @else
                                                        @php $showicon="bi bi-heart heart-icon";@endphp
                                                    @endif
                                                        <a href="#" class="text-reset addwishlist" data-course-id="{{base64_encode($award[0]->id)}}" data-action="{{base64_encode('wishlist_remove')}}"> 
                                                            {{-- <i class="bi bi-bookmark-fill  fs-4"></i> --}}
                                                            <i class="{{$showicon}}"></i>
                                                        </a>
                                                    </div>

                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                                            @php  $catgeory_name = ""; @endphp
                                                            @if($award[0]->category_id == '1') @php  $catgeory_name = "Award"; @endphp
                                                            @elseif($award[0]->category_id == '2') @php  $catgeory_name = "Certificate"; @endphp
                                                            @elseif($award[0]->category_id == '3') @php  $catgeory_name = "Diploma"; @endphp
                                                            @elseif($award[0]->category_id == '4') @php  $catgeory_name = "Master"; @endphp
                                                            @endif



                                                            <span class="badge bg-info-soft co-category">{{$catgeory_name}}</span>
                                                            <span class="badge bg-success-soft co-etcs">{{$award[0]->ects}} ECTS</span>
                                                        </div>
                                                        <h4 class="mb-2 text-truncate-line-2 course-title"><a target="_blank" href="{{route('get-course-details',['course_id'=>base64_encode($award[0]->id)])}}" class="text-inherit">{{htmlspecialchars_decode($award[0]->course_title)}}</a></h4>
                                

                                                    </div>
                                                    <!-- Card Footer -->
                                                    <div class="card-footer">
                                                        <div class="row align-items-center g-0">
                                                            <div class="col course-price-flex">
                                                                <h5 class="mb-0 course-price">€{{$award[0]->course_final_price}}</h5>
                                                                @if(isset($award[0]->course_old_price) && $award[0]->course_old_price > 0)<h5 class="old-price">€{{isset($award[0]->course_old_price) ? $award[0]->course_old_price :    0}} </h5>@endif
                                                            </div>
                                
                                                            <div class="col-auto">
                                                                {{-- <a href="#" class="text-inherit"> --}}
                                                                    {{-- <i class="fe fe-trash text-primary align-middle me-2"></i> --}}
                                                                    {{-- <i class="fe fe-shopping-cart text-primary align-middle me-2"></i>
                                                                    </a><a href="#" class="buy-now">Buy Now</a> --}}

                                                                @if (Auth::check() && Auth::user()->role =='user')
                                                                    @php
                                                                    $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $award[0]->id]);
                                                                    @endphp
                                                                    @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                                                        {{-- <a  href="{{route('start-course-panel',['course_id'=>base64_encode($award[0]->id)])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center"><i
                                                                                class="fe fe-play btn-outline-primary "></i> Play & Continue</a> --}}
                                                                    @else
                                                                    <div class="d-flex">
                                                                    @php
                                                                        $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $award[0]->id,'status'=>'Active']);
                                                                    @endphp
                                                                    @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($award[0]->id)}}"  data-cart-id="{{base64_encode($award[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" style="height: 25px; width: 25px"/></a>
                                                                    @else 
                                                                        <a class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($award[0]->id)}}"  data-cart-id="{{base64_encode($award[0]->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" style="height: 25px; width: 25px"/></a>
                    
                                                                    @endif

                                                                    {{-- <a href="#" class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($award[0]->id)}}" data-action="{{base64_encode('add')}}"> <i class="fe fe-shopping-cart text-primary align-middle me-4" style="font-size: 17px"></i></a> --}}
                                                                    <form action="{{ route('checkout') }}" method="post">
                                                                        @csrf <!-- CSRF protection -->
                                                                        @php $total_full_price = $award[0]->course_old_price - ($award[0]->course_old_price - $award[0]->course_final_price) ; @endphp
                                                                        <input type='hidden' value="{{base64_encode($award[0]->id)}}" name="course_id" id="course_id">
                                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($award[0]->course_old_price)}}">
                                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($award[0]->course_old_price-$award[0]->course_final_price)}}">
                                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                        <button class="buy-now text-primary" style="font-weight: 600;font-family: sans-serif">Buy Now</button>
                                                                    </form>
                                                                    </div>
                                                                    @endif
                                                                @endif      
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                           
                                        @endif
                                   
                             
                                @endforeach
                     
                            @else
                   

                                <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-5">
                                    <img src="{{ asset('frontend/images/icon/add-to-wishlist-icon.svg')}}" alt="not found" style="height: 160px; width: 160px">
                                    <h3 class="mt-3">Your wishlist is empty!</h3>
                                    <p>Explore more and shortlist some items.</p>
                                    <a href="/" class="text-white btn btn-primary">Go To Homepage</a>
                                </div>
                       
                           
                            @endif
                        </div>
                            
                            {{-- <div class="row">
                                <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-5">
                                    <p>You’ve reached the end of the list</p>
                                </div>
                            </div> --}}
                            
                        </div>
                           
                  

                        {{-- Expired Courses --}}
                        <div class="tab-pane fade" id="expired-courses" role="tabpanel" aria-labelledby="expired-courses-tab">
                            {{-- <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <!-- Card -->
                                    <div class="card card-hover">
                                        <a href="course-details"><img src="{{ asset('frontend/images/course/masters-human-resource-management.png')}}" alt="course" class="card-img-top"></a>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-info-soft co-category">Award</span>
                                                <span class="badge bg-success-soft co-etcs">4 ECTS</span>
                                            </div>
                                            <h4 class="mb-2 text-truncate-line-2 course-title"><a href="course-details" class="text-inherit"></a></h4>
                    

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
                                                        <i class="fe fe-trash text-primary align-middle me-2"></i>
                                                        </a><a href="#" class="buy-now text-primary" style="font-weight: 600">Buy Again</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 col-12">
                                   
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-5">
                                    <p>You’ve reached the end of the list</p>
                                </div>
                            </div> --}}
                            <div class="row">
                                {{-- @if(!empty($studentData[0]['orderlist'])) --}}
                            
                                    {{-- @foreach($studentData[0]['orderlist']  as $key =>  $value) --}}
                                    {{-- @if($value['status'] == '0') --}}
                                        @php
                                            // $award = getData('course_master',['course_title','id','selling_price','ects','course_final_price','course_old_price','category_id','course_thumbnail_file'],['id'=>$value['course_id'],'status'=>3,'is_deleted'=>'No'],'','created_at','desc');
                                            
                                            // $studentCourseMasters = DB::table('student_course_master')->join('course_master', 'course_master.id', 'student_course_master.course_id')->where('user_id', Auth::id())->where(function ($query) {
                                            //     $query->where('course_expired_on', '<', now())
                                            //         ->orWhere('exam_remark','1')
                                            //         ->orWhere('exam_attempt_remain', '=', 0);
                                            // })->select('category_id', 'course_id', 'ects', 'student_course_master.id as studentCourseMasterId', 'course_title', 'course_thumbnail_file','course_old_price','course_final_price')->get();
                                            $where = [
                                                'user_id' => Auth()->user()->id,
                                            ];
                                            $studentCourseMasters = getStudentExpiredCourse($where);

                                        @endphp
                                        

                                        @if(isset($studentCourseMasters) && !empty($studentCourseMasters))
                                            @foreach ($studentCourseMasters as $studentCourseMaster)


                                                @php 
                                                    $exm_remark = ''; 
                                                    $courseExamCount =  getCourseExamCount(base64_encode($studentCourseMaster->course_id));
                                                    $submittedExamsCount = DB::table('exam_remark_master')->where([
                                                        'student_course_master_id' => $studentCourseMaster->scmId,
                                                        'is_active' => 1,
                                                    ])->get();
                                                    $exm_remark = determineExamResult($studentCourseMaster->exam_attempt_remain, count($submittedExamsCount), $courseExamCount, $studentCourseMaster->course_id, $studentCourseMaster->userId, $studentCourseMaster->scmId);
                                                    $exm_remark = $exm_remark['result'];
                                                    if($exm_remark == 'Not Attempt'){
                                                        $exm_remark = "Not Attempted";
                                                    }
                                                @endphp
                                                {{-- @if($studentCourseMaster->exam_remark == 0)
                                                    @php $exm_remark = "Failed"; @endphp
                                                @elseif($studentCourseMaster->exam_remark == 1)
                                                    @php $exm_remark = "Passed";@endphp
                                                @endif --}}
                                                <div class="col-lg-3 col-md-6 col-12 my-2">
                                                    <!-- Card -->
                                                    <div class="card card-hover">
                                                        
                                                        <a href="{{route('get-course-details',['course_id'=>base64_encode($studentCourseMaster->course_id)])}}" target="_blank">
                                                            <img
                                                                src="{{ Storage::url($studentCourseMaster->course_thumbnail_file) }}"
                                                            alt="course" class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;">
                                                        </a>

                                                        @php $doc_verified = getData('student_doc_verification',['english_level','english_score','identity_is_approved','edu_is_approved'],['student_id'=>Auth::user()->id]); @endphp
                                                        <!-- Card Body -->
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                                @php  $catgeory_name = ""; @endphp
                                                                @if($studentCourseMaster->category_id == '1') @php  $catgeory_name = "Award"; @endphp
                                                                @elseif($studentCourseMaster->category_id == '2') @php  $catgeory_name = "Certificate"; @endphp
                                                                @elseif($studentCourseMaster->category_id == '3') @php  $catgeory_name = "Diploma"; @endphp
                                                                @elseif($studentCourseMaster->category_id == '4') @php  $catgeory_name = "Master"; @endphp
                                                                @endif
                                                                <span class="badge bg-info-soft co-category">{{$catgeory_name}}</span>
                                                                <span class="badge bg-success-soft co-etcs">{{$studentCourseMaster->ects}} ECTS</span>
                                                            </div>
                                                            <h4 class="mb-2 text-truncate-line-2 course-title">
                                                                <a href="{{route('get-course-details',['course_id'=>base64_encode($studentCourseMaster->course_id)])}}" target="_blank" class="text-inherit">{{htmlspecialchars_decode($studentCourseMaster->course_title)}}</a>

                                                            </h4>
                                                            <div class="mt-3">
                                                                @if(isset($exm_remark))
                                                                <h5 class="badge mt-2" style="background: #dae138; color: #2b3990"> 
                                                                    {{isset($exm_remark) ? $exm_remark : ''}}</h5>
                                                                @endif
                                                                {{-- <div class="progress" style="height: 6px"> --}}

                                                                    {{-- <div class="progress-bar bg-blue" role="progressbar" style="width: {{isset($studentCourseMaster[0]->course_progress) ? $studentCourseMaster[0]->course_progress : 0}}%" aria-valuenow="{{isset($studentCourseMaster[0]->course_progress) ? $studentCourseMaster[0]->course_progress : 0}}" aria-valuemin="0" aria-valuemax="100"></div> --}}

                                                                {{-- </div>  --}}

                                                                {{-- <small>{{isset($studentCourseMaster[0]->course_progress) ? $studentCourseMaster[0]->course_progress : 0}} % Completed</small> --}}

                                                            </div>
                                                        </div>
                                                        <!-- Card Footer -->
                                                    </div>
                                                </div>  
                                            @endforeach
                                        @else
                                            <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-1 mb-1">
                                                <img src="{{ asset('frontend/images/icon/expired-icon.svg')}}" alt="not found" style="height: 160px; width: 160px">
                                                <h3 class="mt-3">Course Expired!</h3>
                                                <p>Unfortunately, This course has expired. Check out our latest offerings!</p>
                                                <a href="/" class="text-white btn btn-primary">Go To Homepage</a>

                                            </div>
                                        @endif
                                    {{-- @endif --}}
                                    {{-- @endforeach --}}
                                {{-- @else
                                    <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-4 mb-3">
                                        <p> You have not purchased the course.</p>
                                    </div>
                                @endif --}}
                            </div>
                            <br>
                        </div>

                        {{-- Certificate --}}
                        <div class="tab-pane fade " id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
                            <div class="row">
                                    <!-- Card -->
                                        @if(!empty($certData) && isset($certData))
                                            @foreach($certData as $data)
                                            {{-- {{"DSAdsa"}} --}}
                                              
                                            @if(!empty($data['student_certificate_issue']) && $data['student_certificate_issue']['transferred_on'] != '')
                                            <div class="col-lg-3 col-md-6 col-12">
                                                <div class="card card-hover">
                                                <img src="{{ env('PINATA_IPFS_VIEW_PATH') . ($data['student_certificate_issue']['cid'] ?? '') }}" alt="course" class="card-img-top">
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <h4 class="mb-1 text-truncate-line-2 course-title">
                                                        <a href="#" class="text-inherit">
                                                            {{ $data['student_courses']['course_title'] ?? '' }}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div class="d-grid p-2">
                                                    <a href="{{ env('PINATA_IPFS_VIEW_PATH') . ($data['student_certificate_issue']['cid'] ?? '') }}" target="_blank" class="btn btn-primary">
                                                        View
                                                    </a>
                                                </div>
                                            </div>   
                                            </div>
                                            @endif
                                            @endforeach
                                        @else
                                        <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-1 mb-1">
                                            <img src="{{ asset('frontend/images/icon/certificate.png')}}" alt="not found" style="height: 160px; width: 160px">
                                            <h3 class="mt-3">Certificate Unavailable!</h3>
                                            <p>Unfortunately, your certificate for this course is no longer available. Please check out our latest courses for more opportunities!</p>
                                            <a href="/" class="text-white btn btn-primary">Go To Homepage</a>

                                        </div>
                                        @endif

                                    </div>
                           
                            {{-- <div class="row">
                                <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-5">
                                    <p>You’ve reached the end of the list</p>
                                </div>
                            </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="height: 81vh;">
                    <div class="modal-body p-0" style="height: 100%;">
                        <iframe id="videoFrame" src="" frameborder="0" allowfullscreen
                                style="width: 100%; height: 100%; object-fit: cover; border: none;"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>

    let selectedCheckboxes = {}; // Store checkbox states per masterCourseId
        
    $(document).on('click', '.optionalCourseAdd', function (e) {
            
        var master_course_id = $(this).data('master_course_id');
        var master_course_ects = atob($(this).data('master_course_ects'));
        var student_course_master_id =  $(this).data('student_course_master_id');
        var baseUrl = window.location.origin + "/";
        $.ajax({
            url: baseUrl + "get-optional_course_data/" + master_course_id,
            type: 'GET',
            success: function(response) {
                var masterOptionalData = response;
                var mainCourseId = [];
                var mainCourseEcts = 0;
                var selectedOptionalECTS = 0;

                var content = `
                <div class="card-body">
                    <table>`;
                masterOptionalData.forEach(item => {
                    var course_ects = item.course_ects != null ? item.course_ects : 0;
                    var optional_ects = item.optional_ects != null ? item.optional_ects : 0;
                    var isChecked = item.is_selected ? "checked" : ""; // Set `checked` if the course is already selected

                    if (item.course_ects != null) {
                        mainCourseEcts += parseInt(item.course_ects); // Add ECTS values
                        if (mainCourseId && !mainCourseId.includes(item.course_id.toString())) {
                            mainCourseId.push(btoa(item.course_id.toString()));
                        }
                    }

                    if (item.optional_course_id != null) {
                        content += `
                            <tr>
                                <td>
                                    <input type="checkbox" id="courseCheck_${item.optional_course_id}" 
                                        name="courseCheck" 
                                        value="${item.optional_course_id}" 
                                        class="courseCheckbox" 
                                        data-ects="${item.optional_ects}" 
                                        data-optional_course_id="${item.optional_course_id}" 
                                        ${isChecked}>
                                    <label for="courseCheck_${item.optional_course_id}">
                                        ${item.optional_course_title} - ECTS: ${item.optional_ects}
                                    </label>
                                </td>
                            </tr>`;
                    }
                });
                var remainingEcts = parseInt(master_course_ects) - parseInt(mainCourseEcts);
                content += `<b>Please select your remaining ${remainingEcts} ECTS from the options below : <b><br><br><br>`;
                content += `
                        <input type="hidden" id="main_course_ects" 
                            name="main_course_ects" 
                            value="${mainCourseEcts}">
                        <input type="hidden" id="master_course_ects" 
                            name="master_course_ects" 
                            value="${master_course_ects}">
                        <input type="hidden" id="master_course_id" 
                            name="master_course_id" 
                            value="${master_course_id}">
                        <input type="hidden" id="student_course_master" 
                            name="student_course_master_id" 
                            value="${student_course_master_id}">
                        <input type="hidden" id="main_course_id" 
                            name="main_course_id" 
                            value="${mainCourseId}">

                        </table>
                        <br><br>
                        <button class="btn btn-primary proceedButton" data-master_course_id="${master_course_id}">
                            Proceed
                        </button>
                    </div>
                </div>`;
                var mainCourseEcts = $(`#main_course_ects`).val();

                ChelkboxDisable(master_course_ects,mainCourseEcts);

                // Append content to the specific modal
                $('#addOptionalCourse  .modal-body').html(content);
                $('#addOptionalCourse').modal('show');
            }
        });
    });

    $(document).on('click', '.proceedButton', function () {
        var masterCourseId = atob($(this).data('master_course_id'));
        removeErrorMessage("addOptionalCourse");    // Retrieve ECTS and selected course data
        var mainCourseEcts = $(`#main_course_ects`).val();
        var masterCourseEcts = $(`#master_course_ects`).val();
        var studentCourseMasterId = $(`#student_course_master`).val();
        var selectedOptionalECTS = 0;
        var selectedOptionalCourseIds =[];
        $(`input[name="courseCheck"]:checked`).each(function () {
            selectedOptionalECTS += parseInt($(this).data('ects'));
            var selectedOptionalCourseId = $(this).data('optional_course_id');
            if (selectedOptionalCourseId && !selectedOptionalCourseIds.includes(selectedOptionalCourseId.toString())) {
                selectedOptionalCourseIds.push(btoa(selectedOptionalCourseId.toString()));
            }
        });

        var TotalEcts = parseInt(mainCourseEcts) + parseInt(selectedOptionalECTS);

        var selectedOptionalCourseIds = selectedOptionalCourseIds.join(',');
        if (TotalEcts === parseInt(masterCourseEcts)) {
            $(`#addOptionalCourse`).modal('hide');
            $(`#optionalCourseAdd`).text('');
            // swal({
            //     title: "Confirm ECTS Selection",
            //     text: "Once you proceed, no modifications will be allowed.",
            //     icon: "warning",
            //     buttons: {
            //         cancel: {
            //             text: "Cancel",
            //             value: null,
            //             visible: true,
            //             className: "btn-danger",
            //             closeModal: true
            //         },
            //         confirm: {
            //             text: "OK",
            //             value: true,
            //             visible: true,
            //             className: "btn-success",
            //             closeModal: true
            //         }
            //     },
            //     dangerMode: true, // Optional: If you want to show a danger icon when clicked
            // }).then((willOk) => {  // Custom variable 'willOk'
            //     if(willOk){

            const modalData = {
                title: "Confirm ECTS Selection",
                message: "Once you proceed, no modifications will be allowed.",
                icon: warningIconPath,
            }
            showModal(modalData, true);
            $("#modalCancel").on("click", function () {
                $("#customModal").hide();
            });
            $("#modalOk").on("click", function () {
                $("#customModal").hide();
                    var baseUrl = window.location.origin;
                    var csrfToken = $('meta[name="csrf-token"]').attr("content");   
                    $.ajax({
                        url: baseUrl + "/store-optional-course",
                        type: 'POST',
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        data:{
                            student_course_master_id:studentCourseMasterId,
                            all_award_course_id:selectedOptionalCourseIds,
                            master_course_id:btoa(masterCourseId)
                        }, 
                        success: function(response) {
                            if (response.code === 200) {
                                // swal({
                                //     title: response.title,
                                //     text: response.message,
                                //     icon: response.icon,
                                // }).then(function () {
                                //     window.location.href = window.location.origin + '/student/student-master-course-panel/' + btoa(masterCourseId);
                                // });

                                const modalData = {
                                    title: response.title,
                                    message: response.message || "",
                                    icon: response.icon,
                                };
            
                                var redirect = '/student/student-master-course-panel/' + btoa(masterCourseId);
            
                                showModalWithRedirect(modalData, redirect);
                            }
                        }
                    });
            });
        } else {
            // selectedCheckboxes[masterCourseId] = {};  // Reset t
            // $(`input[name="courseCheck"]`).prop('disabled', false);
            $(`input[name="courseCheck"]`).prop('checked', false);
            $('input[name="courseCheck"]:not(:checked)').prop('disabled', false);
            $('input[name="courseCheck"]').prop('disabled', false);
            var mainCourseEcts = $(`#main_course_ects`).val();
            ChelkboxDisable(masterCourseEcts,mainCourseEcts);
            var errorMessage = `
                <div class="alert alert-danger">
                    Please review your selections to ensure the total ECTS matches the required number before proceeding.
                </div>`;
            var existingContent = $(`#addOptionalCourse .modal-body`).html();

            $(`#addOptionalCourse .modal-body`).html(errorMessage + existingContent);
        
        }
    

    });
    let selectOptionEcts = 0;
    function ChelkboxDisable(mastercoursects,maincourseects){
            let selectOptionEcts = maincourseects;
            let currentEcts = 0;
            $(document).on('change', `input[name="courseCheck"]`, function() {

                // If checkbox is checked, add its ECTS to the total; if unchecked, subtract its ECTS
                if ($(this).prop('checked')) {
                    selectOptionEcts += parseInt($(this).data('ects'));
                } 
                if (selectOptionEcts == mastercoursects) {
                    $(`input[name="courseCheck"]:not(:checked)`).prop('disabled', true);
                }
            });

            // Log the selected ECTS and master course ECTS for debugging
           
    }
    function removeErrorMessage(modalId) {
        $("#" + modalId + " .modal-body .alert-danger").remove();
    }


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
    $(document).ready(function() { 
        var optional_course_error = "<?php echo session('optional_course_error')?>";
        var DocumentVerified = "<?php echo $DocumentVerified ?>";
        if(optional_course_error == ''){
            if (DocumentVerified === "NotVerified") {
                UploadDocument(); // Call function to upload documents
            } else if (DocumentVerified === "englishVerified") {
                EnglishTest(); // Call function for English test
            } else if (DocumentVerified === "englishAttempt") {
                englishAttempt(); // Call function for English attempt
            }    
        }else{
            const existOptionalCourseData = parseInt("<?php echo $count; ?>");
            if (existOptionalCourseData > 0) {
                if (DocumentVerified === "NotVerified") {
                    UploadDocument(); // Call function to upload documents
                } else if (DocumentVerified === "englishVerified") {
                    EnglishTest(); // Call function for English test
                } else if (DocumentVerified === "englishAttempt") {
                    englishAttempt(); // Call function for English attempt
                } 
            } 
        }
    });
</script>

<script>
   $(document).ready(function() {
    $('.openVideoModal').on('click', function() {
        var videoUrl = $(this).data('video-url');
        $('#videoModal iframe').attr('src', videoUrl);
        // $('#videoModal')[0].load();
        $('#videoModal').modal('show');
    });

    $('#videoModal').on('hidden.bs.modal', function () {
        $('#videoModal')[0].pause();
    });
});
    </script>
@endsection
