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
                                <img src="{{ asset('frontend/images/tick-mark-02.png')}}" alt="icon" class="icon-shape icon-xxl rounded-circle ">
                            </div>
                            <!-- Content -->
                            
                        </div>

                        <div class="">
                            <h2 class="fw-bold mb-1 color-blue">
                                Payment Unsuccessful
                            </h2>
                            <h5>Oops! There was an issue processing your payment.</h5>
                            
                        </div>
                        <p class="mb-4">We're sorry, but there was an issue processing your payment. Don’t worry, we’re here to help you resolve it and get back on track.</p>

                        {{-- <a href="order-thank-you" class="btn btn-primary">Continue</a> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
        </main>



@endsection