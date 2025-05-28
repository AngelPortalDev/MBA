@extends('frontend.master')

@section('content')

<style>

  .promo_code_hidden{

    display:none;

  }

  .promo_code_visible{

    display:block;

  }

  .loader {

   margin: auto;

   border: 20px solid #EAF0F6;

   border-radius: 50%;

   border-top: 20px solid #FF7A59;

   width: 200px;

   height: 200px;

   animation: spinner 4s linear infinite;

    }

    .save_loader-text {
            font-size: 24px;
            color: #2b3990;
            margin-bottom: 20px;
            align-self: center;
            font-weight: bold;
        }

        .save_loader-bar {
            width: 50px;
            height: 50px;
            aspect-ratio: 1;
            border-radius: 50%;
            background:
                radial-gradient(farthest-side, #2b3990 94%, #0000) top/8px 8px no-repeat,
                conic-gradient(#0000 30%, #2b3990);
            -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 8px), #000 0);
            animation: l13 1s infinite linear;
            margin-top: 10px;
            margin-left: 35px;
            margin: auto
        }

        @keyframes l13 {
            100% {
                transform: rotate(1turn);
            }
        }



    @keyframes spinner {

    0% { transform: rotate(0deg); }

    100% { transform: rotate(360deg); }

    }
    
  /* .direct-checkout {

    display: none;

   } */

</style>

                <section class="py-4 py-lg-6 bg-primary">

                    <div class="container">

                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-12">

                                <div>

                                    <h1 class="text-white mb-1 display-4 color-green">Checkout </h1>

                                </div>

                            </div>

                        </div>

                    </div>

                    

                </section>



                <!-- Container fluid -->

               <!-- Container fluid -->

               <section class="container p-4 checkout-page">

                @php $course_id = ''; @endphp

                @foreach($data['CourseData'] as $course)

                @php  $course_id .= $course->id.','; @endphp

                @endforeach

                <!-- row -->

                <div class="row">

                    <div class="col-xl-8 col-lg-7 order-lg-1 order-2">

                        <!-- stepper -->

                        <div id="stepperForm" class="bs-stepper">

                            <!-- card -->

                            <div class="card">

                                @if(!empty($data['MessageCheck']) && isset($data['MessageCheck']))

                                 <script>
                                    swal({
                                        title: "Already Purchased",
                                        text: "You have already purchased this award in the master",
                                        icon: "warning",
                                        position: 'top-start', // Position at the top of the page
                                        buttons: {
                                            select: {
                                                text: "Ok",
                                                value: true,
                                                className: "btn btn-primary",
                                            },
                                        },
                                        dangerMode: true,
                                    }).then((willSelect) => {
                                        if (willSelect) {
                                            return false;
                                        }
                                    });
                                    </script>

                                @endif

                                <div class="card-body">

                                    <!-- Stepper content -->

                                        <form onSubmit="return false"id="paymentprocess" novalidate>

                                            <!-- Content one -->

                                            <div>

                                                <!-- heading -->

                                                <div class="mb-5">

                                                    <h3 class="mb-1">Billing Information</h3>

                                                    <p class="mb-0">Please fill all information below.</p>

                                                </div>

                                                <!-- row -->

                                                <div class="row gx-3">

                                                    <!-- input -->

                                                    

                                                    <div class="mb-3 col-md-6">

                                                        <label class="form-label" for="firstName">First Name  <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" placeholder="Enter First Name" id="first_name" name="first_name" required/>

                                                        <div class="invalid-feedback" id="first_name_error">Please enter your first name.</div>



                                                    </div>

                                                    <!-- input -->

                                                    <div class="mb-3 col-md-6">

                                                        <label class="form-label" for="lastName">Last Name  <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" placeholder="Enter Last Name" id="last_name" name="last_name" required/>

                                                        <div class="invalid-feedback" id="last_name_error">Please enter your last name.</div>



                                                    </div>



                                                    <!-- input -->

                                                    <div class="mb-3 col-12">

                                                        <label class="form-label" for="address">Address  <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" placeholder="Enter Address" id="address" name="address" required/>

                                                        <div class="invalid-feedback" id="address_error">Please enter your valid address.</div>

                                                        

                                                    </div>

                                                    <!-- input -->

                                                    <div class="mb-3 col-12">

                                                        <label class="form-label" for="town">City  <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" placeholder="Enter City" id="town" name="town" required />

                                                        <div class="invalid-feedback" id="town_error">Please enter your city.</div>



                                                    </div>



                                                    <!-- select -->

                                                    <div class="mb-3 col-12">

                                                        <label class="form-label">Country <span class="text-danger">*</span></label>

                                                        <select class="form-select" id="country_id" name="country_id">

                                                            <option value="">Select Country</option>

                                                            @foreach (getDropDownlist('country_master',['id','country_name','currency_code']) as $mob_code)

                                                            <option value="{{$mob_code->id.'-'.$mob_code->country_name}}">{{$mob_code->country_name}}</option>

                                                            @endforeach

                                                        </select>

                                                        <div class="invalid-feedback" id="country_error">Please select your country.</div>



                                                    </div>

                                                    {{-- <input type='hidden' value="{{base64_encode($data['promoCodeDiscount'])}}" name="promo_code_discount" id="promo_code_discount"> --}}

                                                    {{-- <input type='hidden' value="{{base64_encode($data['promoCodeName'])}}" name="promo_code_name" id="promo_code_name"> --}}

                                                    <input type='hidden' value="{{base64_encode($data['overallFullTotal'])}}" name="overall_full_totals" class="overall_full_totals">

                                                    <input type='hidden' value="{{base64_encode($course_id)}}" name="course_id" id="course_id">

                                                    <input type='hidden' value="{{$data['promo_code_id']}}" name="promo_code_id" class="promo_code_id">

                                                    <input type="hidden" value="{{base64_encode($data['overalloldTotal'])}}"class="form-control overall_old_total" name="overall_old_total">

                                                    <input type="hidden" value="{{base64_encode($data['promoCodeDiscount'])}}" class="form-control promo_code_discounts" name="promo_code_discounts">





                                                    



                                                    <!-- checkbox -->



                                                </div>



                                                <!-- Button -->
                                                @php $show = ''; @endphp

                                                <div class="d-flex justify-content-end mt-3">

                                                    

                                                    <button class="btn btn-primary" {{$show}}  id="checkout-live-button">

                                                        Complete Checkout <div class="loader d-none"></div>

                                                    </button>

                                                </div>

                                            </div>



                                        </form>

                                </div>

                            </div>

                        </div>

                    </div>

                

                    <div class="col-lg-4 order-lg-2 order-1 mb-4 mb-lg-0 <?php echo ($data['directchekout'] == 1) ? 'promo_code_visible' : 'promo_code_hidden'; ?>">

                        <div class="card mt-4 mt-lg-0">

                            <div class="card-body">

                                <div class="mb-4 d-flex justify-content-between align-items-center">

                                    <h4 class="mb-1">Order Summary</h4>

                                    <a href="{{route('shopping-cart')}}">Edit Cart</a>

                                </div>

                                @php $total_price =0; @endphp

                                @foreach($data['CourseData'] as $course)

                               

                                <div class="d-md-flex">

                                    <div>

                                        <img src="{{Storage::url($course->course_thumbnail_file)}}" alt="" class="img-4by3-xl rounded" />

                                    </div>

                                    <div class="ms-md-3 ">

                                        <h5 class="mb-1 text-primary-hover course-name mt-2 mt-md-0">{{htmlspecialchars_decode($course->course_title)}}</h5>

                                        <h5>€{{$course->course_final_price}}
                                            @if(isset($course->course_old_price) && $course->course_old_price  > 0)<span class="old-price">€{{$course->course_old_price}}</span>@endif</h5>

                                    </div>

                                    @php $total_price += $course->course_final_price; @endphp

                                </div>

                                @if(count($data['CourseData']) > 1)

                                <hr class="my-3" />

                                @endif

                                @endforeach

                                {{-- <div class="d-md-flex">

                                    <div>

                                        <img src="{{ asset('frontend/images/course/award-recruitment-and-employee-selection.png')}}"  alt="" class="img-4by3-xl rounded" />

                                    </div>

                                    <div class="ms-md-3">

                                        <h4 class="mb-1 text-primary-hover course-name">Award in Recruitment and Employee Selection</h4>

                                        <h5>€1500 <span class="old-price">€2300 </span></h5>

                                    </div>

                                </div> --}}

                            </div>

                            <div class="card-body border-top pt-2">

                                <ul class="list-group list-group-flush mb-0">

                                    @if($data['overallTotal'] > 0)

                                    <li class="d-flex justify-content-between list-group-item px-0 text-dark fw-medium">

                                        <span>Original Prices :</span>

                                        <span class="text-dark fw-semibold">{{($data['overallTotal'])}}</span>

                                    </li>

                                    <li class="list-group-item px-0 d-flex justify-content-between fs-5 text-dark fw-medium">

                                        <span>Scholarship :</span>

                                      

                                        <span>{{$data['overalloldTotal']}}</span>

                                    </li>
                                    @endif
                                    

                                    <li class="d-flex justify-content-between list-group-item px-0 text-dark fw-medium">

                                       <span>

                                            Discount (Promo Code):

                                        </span>

                                        <span class="text-dark fw-semibold">{{($data['promoCodeDiscount'])}}</span>

                                    </li>



                                    <li class="d-flex justify-content-between list-group-item px-0 pb-0">

                                        <span class="fs-4 fw-semibold text-dark">Grand Total</span>

                                        <span class="fw-semibold text-dark">€{{($data['overallFullTotal'])}}</span>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4 order-lg-2 order-1  mb-4 mb-lg-0  <?php echo ($data['directchekout'] == 0) ? 'promo_code_visible' : 'promo_code_hidden'; ?>">

                        <!-- card -->
                            @php $CouponData = getData('coupons',['is_deleted','status'],['course_id'=>$course->course_id,'is_deleted'=>'No','status'=>'Active']); @endphp
                            @if(isset($CouponData) && $CouponData->isNotEmpty())

                            <div class="card mb-4 mt-4 mt-lg-0">



                                

                                <!-- card body -->

                                <div class="card-body">
                                

                                    <div class="">

                                        


                                            @php $coupon_name = $data['CourseData'][0]->coupon_name ;@endphp

                                

                                        {{-- <span class="bg-green fs-5 py-1 px-2 fw-bold rounded ">Promo Code- <span class="color-blue">{{$coupon_name}}</span> </span> --}}

                                    </div>



                                    <h5 class="mb-2 mt-3">Apply promo code here</h5>

                                    <!-- row -->

                                    <div class="row g-3">

                                        <!-- col -->

                                        <div class="col">

                                            <input type="text" class="form-control promo_code_0" placeholder="Promo Code" required >

                                            <div class="invalid-feedback coupon_code_error_0">Please Enter Promo Code</div>

                                            <input type='hidden' class="form-control discount_promo_0"  value="{{base64_encode($data['CourseData'][0]->coupon_discount)}}">

                                            <input type='hidden' class="form-control course_id_0"  value="{{base64_encode($data['CourseData'][0]->id)}}">

                                            <input type='hidden' class="form-control total_old_price_0" value="{{base64_encode($data['CourseData'][0]->course_final_price)}}">

                                            <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($data['CourseData'][0]->course_old_price)}}">

                                            <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($data['CourseData'][0]->course_old_price- $data['CourseData'][0]->course_final_price)}}">

                                            <input type='hidden' class="form-control direct_checkout"  value="{{base64_encode($data['directchekout'])}}">



                                        

                                            

                                            

                                        </div>

                                        <!-- col -->

                                        <div class="col-auto">

                                            <button class="btn btn-primary ApplyPromo" data-id="0" id="ApplyPromo-0">Apply</button>

                                            <button class="btn btn-primary RemovePromo d-none" data-id="0" id="RemovePromo-0">Remove</button>



                                        </div>

                                    </div>
                                    
                                </div>

                            </div>
                            @endif
                        <!-- card -->

                            <div class="card mb-1">

                                <!-- card body -->

                                <div class="card-body">

                                    <!-- text -->

                                    <h4 class="mb-3">Order Summary</h4>

                                    <!-- list group -->

                                    <ul class="list-group list-group-flush">



                                        {{-- @foreach($data['CourseData'] as $course) --}}

                                            <div class="d-md-flex">

                                                <div>

                                                    <img src="{{Storage::url($data['CourseData'][0]->course_thumbnail_file)}}" alt="" class="img-4by3-xl rounded" />

                                                </div>

                                                <div class="ms-md-3 ">

                                                    <h5 class="mt-2 mt-md-0 mb-1 text-primary-hover course-name">{{htmlspecialchars_decode($data['CourseData'][0]->course_title)}}</h5>

                                                    <h5>€{{$data['CourseData'][0]->course_final_price}}
                                                        
                                                        @if(isset($course->course_old_price) && $course->course_old_price  > 0)<span class="old-price">€{{$data['CourseData'][0]->course_old_price}}</span>@endif</h5>

                                                </div>

                                            </div>



                                            <hr class="my-3" />

                                        

                                        <!-- list group item -->

                                        @if($data['overallTotal'] > 0)


                                        <li class="list-group-item px-0 d-flex justify-content-between fs-5 text-dark fw-medium">

                                            <span>Original Price : </span>

                                            <span>{{$data['overallTotal']  ? $data['overallTotal'] : '0'}}</span>

                                        </li>

                                        <li class="list-group-item px-0 d-flex justify-content-between fs-5 text-dark fw-medium">

                                            <span>Scholarship :</span>

                                        

                                            <span>{{$data['overalloldTotal']  ? $data['overalloldTotal'] : '0'}}</span>

                                        </li>

                                        @endif
                                        <!-- list group item -->

                                        <li class="list-group-item px-0 d-flex justify-content-between fs-5 text-dark fw-medium">

                                            <span>

                                                Discount (Promo Code)

                                                <span class="promo_code_name"></span>

                                                :

                                            </span>

                                            <span class="promo_code_discount">0</span>

                                        </li>

                                        {{-- @endforeach --}}

                                    </ul>

                                </div>

                                <!-- card footer -->

                                <div class="card-footer">

                                    <div class="px-0 d-flex justify-content-between fs-5 text-dark fw-semibold">

                                        <h3 class="color-blue">Grand Total (EURO)</h3>

                                    <h3 class="color-blue overall_full_total">€{{ $data['overallFullTotal']  ? $data['overallFullTotal'] : '0' }}</h3> 

                                    </div>

                                </div>

                            </div>

                    </div>

                </div>

            </section>

        </main>



        <script src="https://js.stripe.com/v3/"></script>







@endsection