@extends('frontend.master')



@section('content')











                <!-- Container fluid -->



                <section class="container p-4 checkout-page">



                    <div class="row justify-content-center">



                        <div class="col-lg-8 col-12">



                            <!-- card -->



                            <div class="card">



                                <!-- card body -->



                                <div class="card-body">



                                    <div class="mb-6">



                                        <!-- heading -->



                                        <h2 class="mb-0">Thank you for your order</h2>



                                        <p class="mb-0">We will send you a confirmation email shortly.</p>



                                    </div>



                                    <div>



                                        <div class="border-bottom mb-3 pb-3">



                                            <!-- text -->



                                            <div class="d-flex align-items-center">



                                            <h4 class="mb-0">ORDER ID:</h4>



                                                <p class="mb-0 ms-2 text-dark fw-semibold">{{"#".$PaymentData->uni_order_id}}</p>



                                            </div>



                                        </div>



                                        <!-- row -->



                                        @php $promo_code = ''; $promo_code_discount = '';$total_original_price=0; @endphp



                                        @foreach($OrderData as $order)



                                        <div class="row justify-content-between">



                                            <!-- col -->



                                          



                                            <div class="col-lg-8 col-12">



                                               



                                                <div class="d-md-flex">



                                                    <!-- img -->



                                                    <div>



                                                        <img src="{{Storage::url($order->course_thumbnail_file)}}" alt="" class="img-4by3-xl rounded">



                                                    </div>



                                                    <!-- text -->



                                                    <div class="ms-md-4 mt-2 mt-lg-0">



                                                        <h5 class="mb-1">{{$order->course_title}}</h5>



                                                        <div>



                                                            <span>



                                                                ECTS: <span class="text-dark fw-medium">{{ $order->ects ? $order->ects : "N/D" }}&nbsp;</span>



                                                            </span>



                                                            



                                                            
                                                            <span>

                                                                MQF / EQF Level: <span class="text-dark fw-medium">{{ $order->mqfeqf_level ? $order->mqfeqf_level : "N/D" }} &nbsp;</span>

                                                            </span>



                                                            <span>



                                                                Lectures: <span class="text-dark fw-medium">{{ $order->total_lectures ? $order->total_lectures : "N/D" }}</span>



                                                            </span>



                                                        </div>



                                                    </div>



                                                </div>



                                            </div>



                                            



                                            <!-- price -->



                                            <div class="col-lg-4 col-12">



                                                <div class="d-flex justify-content-end mt-2">



                                                    <h5>€{{$order->course_final_price}}</h5>



                                                </div>



                                            </div>



                                            <hr class="my-3">



                                        </div>



                                        @php 

                                      

                                         $total_original_price += $order->course_old_price;

                                          @endphp





                                        



                                        @endforeach



                                        {{-- <div class="row justify-content-between">



                                            <!-- col -->



                                            <div class="col-lg-8 col-12">



                                                <div class="d-md-flex">



                                                    <!-- img -->



                                                    <div>



                                                        <img src="{{ asset('frontend/images/course/award-recruitment-and-employee-selection.png')}}" alt="" class="img-4by3-xl rounded">



                                                    </div>



                                                    <div class="ms-md-4 mt-2 mt-lg-0">



                                                        <h5 class="mb-1">Award in Recruitment and Employee Selection</h5>



                                                        <div>



                                                            <span>



                                                                ECTS: <span class="text-dark fw-medium">10 &nbsp;</span>



                                                            </span>



                                                            



                                                            <span>



                                                                Modules: <span class="text-dark fw-medium">70 &nbsp;</span>



                                                            </span>



                                                            <span>



                                                                Lectures: <span class="text-dark fw-medium">100</span>



                                                            </span>



                                                        </div>



                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-4 col-12">



                                                <!-- price -->



                                                <div class="d-flex justify-content-end mt-2">



                                                    <h5>€1500</h5>



                                                </div>



                                            </div>



                                        </div> --}}



                                        <!-- hr -->



                                        {{-- <hr class="my-3"> --}}



                                        <div>



                                          



                                            <!-- list -->



                                            <ul class="list-unstyled mb-0">



                                                <li class="d-flex justify-content-between mb-2">



                                                    <span>Original Price</span>



                                                    <span class="text-dark fw-medium">{{$total_original_price}}</span>



                                                </li>



                                                <li class="d-flex justify-content-between mb-2">



                                                    <span>Scholarship</span>



                                                    <span class="text-dark fw-medium">{{$PaymentData->scholarship}}</span>



                                                </li>



                                                <li class="d-flex justify-content-between mb-2">



                                                    <span>Discount (Promo Code) </span>



                                                    <span class="text-dark fw-medium">{{$PaymentData->discount}}</span>



                                                </li>



                                                <li class="border-top my-2"></li>



                                                <li class="d-flex justify-content-between mb-2">



                                                    <span class="fw-medium text-dark"><b>Grand Total (EURO)</b></span>



                                                    <span class="fw-medium text-dark">€{{ (int) $PaymentData->total_amount}}</span>



                                                </li>



                                            </ul>



                                        </div>



                                    </div>



                                </div>



                            </div>



                            <!-- card -->



                            <div class="card mt-4">



                                <!-- card body -->



                                <div class="card-body">



                                    <div class="mb-4">



                                        <!-- heading -->



                                        <h2 class="mb-0">Billing Information</h2>



                                    </div>



                                    <div class="row">



                                        <div class="col-md-6 col-12">



                                            <!-- address -->



                                            <h4>Billing  Address</h4>



                                            <p>



                                                {{$PaymentData->address}}







                                            </p>







                                        </div>



                                        <div class="col-md-6 col-12 mb-3">



                                            <!-- text -->



                                            <h4 class="mb-3">Payment Method</h4>







                                            {{-- <img src="{{ asset('frontend/images/creditcard/visa.svg')}}" alt="" class="mb-2"> --}}



                                            {{-- <p class="mb-0 text-dark">Ending with 1243</p> --}}



                                            <p class="mb-0 text-dark">{{$PaymentData->card_type}}</p>







                                            <p class="mb-0">Expires {{$PaymentData->exp_month}}/{{$PaymentData->exp_year}}</p>



                                        </div>



                                    </div>




                                        <a href="{{ route('student-my-learning') }}" class="btn btn-primary">Start Learning</a>
    






                                </div>







                                











                            </div>



                            



                        </div>



                    </div>



                </section>



        </main>















@endsection