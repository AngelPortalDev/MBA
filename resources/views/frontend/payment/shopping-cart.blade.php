

@extends('frontend.master')

@section('content')

    

                <section class="py-4 py-lg-6 bg-primary">

                    <div class="container">

                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-12">

                                <div>

                                    <h1 class="text-white mb-1 display-4 color-green">Shopping Cart</h1>

                                </div>

                            </div>

                        </div>

                    </div>

                    

                </section>



                <!-- Container fluid -->

                <section class="container p-4 checkout-page">

                    <!-- row -->

                    <div class="row">

                        {{-- <div class="col-12 mb-2">

                            <!-- alert -->

                            <div class="alert alert-warning alert-dismissible fade show bg-green color-blue" role="alert">

                                Use coupon code

                                <strong>(GKDIS15%)</strong>

                                and get 15% discount!

                            </div>

                             <!-- custom content -->





                            

                        </div> --}}



                        <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">

                            <div class="d-flex">

                            <div class="toast-body">

                            Hello, world! This is a toast message.

                            </div>

                            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>

                            </div>

                        </div>

                        <div class="col-lg-8">

                            <!-- card -->

                            @php  $total_price = 0; $total_old_price = 0; $full_price = 0; $course_id = '';@endphp



                            @if(Auth::check())

                            @php

                          

                            $CourseData = DB::table('cart')->select(['cart.id','course_title','ects','mqfeqf_level','total_modules','total_lectures','cart.course_id','course_final_price','course_old_price','course_master.id as course_id','course_thumbnail_file'])
                            ->join('course_master','course_master.id','=','cart.course_id')
                            ->where(['cart.created_by'=>auth()->user()->id])
                            ->where(['cart.status'=>'Active'])->where(['cart.is_deleted'=>'No'])
                            ->where(['cart.is_by'=>'1'])->get()->groupBy('course_id') // Group by `course_id`
                            ->map(function ($items) {
                                return $items->sortBy('course_id')->first(); // Get the record with the smallest `id`
                            })
                            ->values(); // Reindex;
                          
                            @endphp

                            @endif


                            @if(count($CourseData) > 0)


                            <div class="card">

                                <!-- card header -->

                                <div class="card-header">

                                    <div class="d-flex">

                                        <!-- heading -->

                                        <h4 class="mb-0">

                                            Shopping Cart

                                            <span class="CourseItemscount" style="display:none">{{ isset($CourseData) ? count($CourseData):''}}</span>

                                            <span class="CourseItems">{{ isset($CourseData) ? count($CourseData).' Items': ''}}</span>

                                        </h4>

                                    </div>

                                </div>

                                <div class="card-body">

                                    <div class="table-responsive table-card">

                                        <!-- Table -->

                                        <table class="table mb-0 text-nowrap">

                                            <!-- Table Head -->

                                            <thead class="table-light">

                                                <tr>

                                                    <th>Course</th>

                                                    <th>Price</th>

                                                    {{-- <th>Total</th> --}}

                                                </tr>

                                            </thead>

                                            <tbody>



                                                @if(!empty($CourseData))

                                                 @if(count($CourseData) > 0)

                                                 <!-- Table body -->
                                    

                                                 @foreach($CourseData as $key => $course)

                                                    @php
                                                    $MessageCheck = '';
                                                    $course_id_array = explode(',', $course->course_id);
                                                    $checkAwardBuy = alreadyAwardBuy(Auth::user()->id,$course_id_array);
                                                    if($checkAwardBuy ===  TRUE){
                                                        $MessageCheck = "You have already purchased this award in the master";
                                                    }
                                                   @endphp
                                                    <tr class="course_{{$course->id}}">

                                                     <td >

                                                         <div class="d-flex">

                                                             <div>

                                                                {{-- <a href="course-details"> <img  src="{{ asset('frontend/images/course/masters-human-resource-management.png')}}" alt="" class="img-4by3-md rounded" ></a> --}}

                                                                <a href="{{route('get-course-details',['course_id'=>base64_encode($course->course_id)])}}"><img src="{{Storage::url($course->course_thumbnail_file)}}" alt="" class="img-4by3-xl rounded" /></a>
                                                                   
                                                             </div>

                                                             <div class="ms-4 mt-2 mt-lg-0">

                                                                 <h4 class="mb-1 text-primary-hover "><a href="{{route('get-course-details',['course_id'=>base64_encode($course->course_id)])}}"
                                                                    class="text-inherit">{{isset($course->course_title) ?  htmlspecialchars_decode($course->course_title) : ''}}</a></h4>
                                                                    @if($MessageCheck != '')
                                                                    <div class="alert alert-warning d-block p-1" style="display:none;">
                                                                        <div class="invalid-error" style="font-size: 12px">{{ $MessageCheck }}</div>
                                                                    </div>
                                                                    @endif
                                                                 <div>

                                                                     <span>

                                                                         ECTS: <span class="text-dark fw-medium">{{ $course->ects ? $course->ects : 'N/D' }} &nbsp;</span>

                                                                     </span>

                                                                     

                                                                     <span>

                                                                         MQF / EQF Level: <span class="text-dark fw-medium">{{ $course->mqfeqf_level ? $course->mqfeqf_level : "N/D" }} &nbsp;</span>

                                                                     </span>

                                                                     <span>

                                                                         Lectures: <span class="text-dark fw-medium">{{ ($course->total_lectures > 0) ? $course->total_lectures : "N/D" }}</span>

                                                                     </span>

                                                                 </div>







                                                                <!-- card body -->

                                                                <div class="">

                                                                @php $CouponData = getData('coupons',['is_deleted','status'],['course_id'=>$course->course_id,'is_deleted'=>'No','status'=>'Active']); @endphp
                                                                @if(isset($CouponData) && $CouponData->isNotEmpty())
                                                                    <div class="mt-4">

                                                                            {{-- @php $coupon_name = $course->coupon_name ;@endphp
                                                                            <span class="bg-green fs-5 py-1 px-2 fw-bold rounded ">Promo Code- <span class="color-blue">{{$coupon_name}}</span> </span> --}}

                                                                    </div>

                                                                    <h5 class="mb-1 mt-2"></h5>

                                                                    <!-- row -->

                                                                    <div class="row g-3">

                                                                        <!-- col -->

                                                                        <div class="col">

                                                                            <input type="text" class="form-control promo_code_{{$key}}" placeholder="Apply your promo code here" required>

                                                                            <div class="invalid-feedback coupon_code_error_{{$key}}">Please enter your promo code</div>

                                                                            <input type='hidden' class="form-control discount_promo_{{$key}}">

                                                                            <input type='hidden' class="form-control course_id_{{$key}}"  value="{{base64_encode($course->course_id)}}">

                                                                            <input type='hidden' class="form-control total_old_price_{{$key}}" value="{{base64_encode($course->course_final_price)}}">

                                                                            <input type='hidden' class="form-control total_price_{{$key}}" value="{{base64_encode($course->course_old_price)}}">



                                                                        </div>

                                                                        <!-- col -->

                                                                        <div class="col-auto">

                                                                        <button class="btn btn-primary ApplyPromo" data-id={{$key}} id="ApplyPromo-{{$key}}">Apply</button>

                                                                        <i class="fe fe-shopping-cart d-none"></i>

                                                                        <button class="btn btn-primary RemovePromo d-none" data-id={{$key}} id="RemovePromo-{{$key}}">Remove</button>



                                                                        </div>

                                                                    </div>
                                                                @endif
                                                                 

                                                                </div>

                                                                



                                                                <div class="mt-3">

                                                                    <a href="#" data-course-id="{{base64_encode($course->id)}}" class="addtocart" data-id={{$key}} data-action="{{base64_encode('remove')}}" class="text-body ms-3">Remove</a> &nbsp;
                                                                    @php
                                                                        $isPaid = is_exist('wishlist', ['student_id' => Auth::user()->id,'course_id'=> $course->course_id,'cart_wishlist'=>'0','status'=>'Active']);
                                                                    @endphp
                                                                    @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                                                        <a></a>
                                                                    @else
                                                                        <a href="#" data-course-id="{{base64_encode($course->course_id)}}" data-cart-id={{base64_encode($course->id)}} class="addtocart"  data-id={{$key}} data-action="{{base64_encode('wishlist')}}" class="text-body ms-3">Move to Wishlist</a>
                                                                    @endif

                                                                </div>

                                                             </div>

                                                         </div>

                                                     </td>

                                                     <td>
                                                        <div class="d-flex align-items-center flex-column flex-md-row">
                                                            <h4 class="mb-0">€{{$course->course_final_price}}</h4>

                                                            @if(isset($course->course_old_price) && $course->course_old_price  > 0)<h5 class="old-price">€{{$course->course_old_price}}</h5>@endif
                                                        </div>
                                                     </td>

 

                                                     {{-- <td>

                                                         <h4 class="mb-0">€{{$course->course_final_price}}</h4>

                                                     </td> --}}

                                                     @php 
                                                     if($course->course_old_price == 0){
                                                        $total_price = $total_price + $course->course_final_price; 
                                                     }else{
                                                        $total_price = $total_price + $course->course_old_price; 
                                                     }

                                                     $total_old_price = $total_old_price + $course->course_final_price;  

                                                     $course_id .=  $course->course_id.',';

                                                     @endphp



                                                 </tr>

                                                 {{-- <tr>

                                                     <td>

                                                         <div class="d-flex">

                                                             <div>

                                                                 <a href="course-details">  <img src="{{ asset('frontend/images/course/award-recruitment-and-employee-selection.png')}}" alt="" class="img-4by3-md rounded" > </a>

                                                             </div>

                                                             <div class="ms-4 mt-2 mt-lg-0">

                                                                 <a href="course-details"> <h4 class="mb-1 text-primary-hover color-blue">Award in Recruitment and Employee Selection</h4></a>

                                                                 <div>

                                                                     <span>

                                                                         ECTS: <span class="text-dark fw-medium">6 &nbsp;</span>

                                                                     </span>

                                                                     

                                                                     <span>

                                                                         Modules: <span class="text-dark fw-medium">10 &nbsp;</span>

                                                                     </span>

                                                                     <span>

                                                                         Lectures: <span class="text-dark fw-medium">70</span>

                                                                     </span>

                                                                 </div>

                                                                 <div class="mt-3">

                                                                     <a href="#" class="text-body ms-3">Remove</a>

                                                                     <a href="#" class="text-body ms-3">Move to Wishlist</a>

                                                                 </div>

                                                             </div>

                                                         </div>

                                                     </td>

                                                     <td>

                                                         <h4 class="mb-0">€1500</h4>

                                                     </td>

 

                                                     <td>

                                                         <h4 class="mb-0">€1500</h4>

                                                     </td>

                                                 </tr> --}}

                                                 

                                                 @endforeach

                                                 @php 

                                                 $full_price =  $total_price - $total_old_price; 

                                              

                                                 @endphp

                                                 @php

                                                    //  $CoursePromo = DB::table('course_promo_code')->join('course_master','course_master.id','=','cart.course_id')->where(['cart.created_by'=>auth()->user()->id])->where(['cart.status'=>'Active'])->get();

                                                    //  $total_price = 0;

                                                     @endphp

                                                 {{-- <tr>

                                                     <td class="align-middle border-top-0 border-bottom-0"></td>

                                                     <td class="align-middle border-top-0 border-bottom-0">

                                                         <h4 class="mb-0">Total</h4>

                                                     </td>

 

                                                     <td>

                                                         <h4 class="mb-0">€{{$total_price}}</h4>

                                                     </td>

                                                 </tr>--}}

                                                 @else

                                                 <tr>

                                                     

                                                     <td colspan="3" class="align-middle border-top-0 border-bottom-0 text-center">

                                                         <h4 class="mb-0">No Cart Found.</h4>

                                                     </td>

 

                                                 </tr> 

                                                 @endif

                                                 @else

                                                 <tr>

                                                     

                                                     <td colspan="3" class="align-middle border-top-0 border-bottom-0 text-center">

                                                         <h4 class="mb-0">No Cart Found.</h4>

                                                     </td>

 

                                                 </tr>

                                                 @endif

                                             </tbody>

                                    

                                        </table>

                                    </div>

                                </div>

                            </div>

                            <div class="mt-4 d-flex justify-content-between">

                                {{-- @php

                                $disabled = '';

                                $total_full_prices = $total_price - $full_price;

                                if($total_full_prices == 0){

                                    $disabled = 'disabled';

                                }

                                @endphp --}}

                                {{-- <a href="/" class="btn btn-outline-primary">Continue Shopping</a> --}}

                                {{-- <form action="{{ route('checkout') }}" method="post">

                                    @csrf <!-- CSRF protection -->

                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($total_price)}}">

                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($full_price)}}">

                                    <input type='hidden' class="form-control promo_code_discounts" name="promo_code_discounts" value="{{base64_encode('0')}}">

                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_price - $full_price)}}">

                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('1')}}">

                                    <input type='hidden' class="form-control course_id" name="course_id" value="{{base64_encode($course_id)}}">

                                    <input type='hidden' class="form-control promo_code_id" name="promo_code_id">





                                    <button class="btn btn-primary" id="checkoutButton" {{$disabled}}>Checkout</button>

                                </form> --}}

                            </div>
                            @else
                            <div class="card text-center">

                                <!-- card header -->

                                <div class="card-header">

                                    <div class="">

                                        <!-- heading -->

                                        <h4 class="mb-0 text-center">

                                            Shopping Cart

                                            <span class="CourseItemscount" style="display:none">{{ isset($CourseData) ? count($CourseData):''}}</span>

                                            <span class="CourseItems">{{ isset($CourseData) ? count($CourseData).' Items': ''}}</span>

                                        </h4>

                                    </div>

                                </div>
                                <div class="card-body">
                                <div class="table-responsive table-card">

                                    <!-- Table -->
                                                    
                                    <table class="table mb-0 text-nowrap">
                                    <tbody>
                                    <tr>
                                        <td colspan="3" class="align-middle border-top-0 border-bottom-0 text-center">
                                            <h4 class="mb-0">Your cart is empty!</h4>
                                        </td>
                                    </tr>
                                    </tbody>
                                    </table>

                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="w-100 text-center d-flex flex-column align-items-center">
                                <img src="{{ asset('frontend/images/icon/empty_cart-icon.svg')}}" alt="not found" style="height: 200px; width: 200px">
                                <p>Look like you haven't added any courses <br/> to your cart yet.</p>
                                {{-- <a href="/" class="btn btn-outline-primary">Continue Shopping</a> --}}
                                <a href="/" class="btn btn-outline-primary">Add Course to Cart</a>

                            </div>
                            @endif
                        </div>

                        <div class="col-lg-4">

                            <!-- card -->

                            {{-- <div class="card mb-4 mt-4 mt-lg-0">

                                <!-- card body -->

                                <div class="card-body">

                                    <h4 class="mb-3">Have a promo code?</h4>

                                    <!-- row -->

                                    <div class="row g-3">

                                        <!-- col -->

                                        <div class="col">

                                            <input type="text" class="form-control" placeholder="Promo Code" id="promo_code" required >

                                            <div class="invalid-feedback" id="coupon_code_error">Please enter Coupon Code</div>

                                            <input type='hidden' class="form-control" id="total_price" value="{{base64_encode($total_price)}}">

                                            <input type='hidden' class="form-control" id="total_old_price" value="{{base64_encode($total_old_price)}}">

                                            <input type='hidden' class="form-control" id="full_price" value="{{base64_encode($full_price)}}">





                                        </div>

                                        <!-- col -->

                                        <div class="col-auto">

                                            <button id="promocodeApply" class="btn btn-dark">Apply</button>

                                        </div>

                                    </div>

                                </div>

                            </div> --}}

                            <!-- card -->
                            @if(count($CourseData) > 0)
                            <div class="card mb-4 mt-3 mt-lg-0">

                                <!-- card body -->

                                <div class="card-body">

                                    <!-- text -->

                                    <h4 class="mb-3">Order Summary</h4>

                                    <!-- list group -->

                                    <ul class="list-group list-group-flush">

                                        <!-- list group item -->
                                        @if($total_price > 0)

                                        <li class="list-group-item px-0 d-flex justify-content-between fs-5 text-dark fw-medium">

                                            <span>Original Price :</span>

                                            <span class="total_price_last">{{$total_price}}</span>

                                        </li>

                                        <li class="list-group-item px-0 d-flex justify-content-between fs-5 text-dark fw-medium">

                                            <span>Scholarship :</span>

                                          

                                            <span class="full_price_last">{{$full_price}}</span>

                                        </li>

                                        @endif

                                        <!-- list group item -->

                                        <li class="list-group-item px-0 d-flex justify-content-between fs-5 text-dark fw-medium">

                                            <span>

                                                Discount (Promo Code)

                                               

                                                :

                                            </span>

                                            <span class="promo_code_discount">0</span>

                                        </li>



                                    </ul>

                                </div>

                                <!-- card footer -->

                                <div class="card-footer">

                                    <div class="px-0 d-flex justify-content-between fs-5 text-dark fw-semibold">

                                        <h3 class="color-blue shoppingCartTotal">Grand Total (EURO)</h3>

                                        <h3 class="color-blue overall_full_total shoppingCartTotalCurrency">€{{$total_price- $full_price}}</h3> 

                                    </div>

                                </div>

                            </div>
                           

                            <div>
                                @php

                                $disabled = '';

                                $total_full_prices = $total_price - $full_price;

                                if($total_full_prices == 0){

                                    $disabled = 'disabled';

                                }

                                @endphp
                                <form action="{{ route('checkout') }}" method="post">

                                    @csrf <!-- CSRF protection -->

                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($total_price)}}">

                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($full_price)}}">

                                    <input type='hidden' class="form-control promo_code_discounts" name="promo_code_discounts" value="{{base64_encode('0')}}">

                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_price - $full_price)}}">

                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('1')}}">

                                    <input type='hidden' class="form-control course_id" name="course_id" value="{{base64_encode($course_id)}}">

                                    <input type='hidden' class="form-control promo_code_id" name="promo_code_id">





                                    <button class="btn btn-primary w-100" id="checkoutButton" {{$disabled}}>Checkout</button>

                                </form>
                            </div>

                            @endif
                        </div>

                        

                    </div>

                </section>

        </main>







@endsection