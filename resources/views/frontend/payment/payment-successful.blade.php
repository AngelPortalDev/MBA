@extends('frontend.master')
@section('content')

<section class="py-7 py-lg-8  bg-white">
    <div class="container my-lg-8">

        <!-- row -->
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-12 col-12">
                <!-- Features -->
                <div class="card mb-4 smooth-shadow-md text-center ">
                    <!-- Card body -->
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <div class="mb-3 mb-md-0">
                                <!-- Img -->
                                <img src="{{ asset('frontend/images/tick-mark-01.png')}}" alt="icon" class="icon-shape icon-xxl rounded-circle ">
                            </div>
                            <!-- Content -->
                            
                        </div>

                        <div class="">
                            <h2 class="fw-bold mb-1 color-blue">
                                Payment Successful
                            </h2>
                            <h5>Thank you! Your payment has been successfully processed.</h5>
                            
                        </div>
                        <p class="mb-4">Start exploring your new courses and begin your learning adventure</p>

                        <form action="{{ route('order-thank-you')}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{base64_encode($checkoutSessionId)}}" class="session_id"
                                name="session_id">
                            <a href="{{route('student-my-learning')}}" type="submit" class="btn btn-primary">Start Learning</a>
                            {{-- <button type="submit" class="btn btn-primary">Continue</button> --}}
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
</main>



@endsection