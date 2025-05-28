@extends('frontend.master')
@section('content')

<section class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0 py-8">
        <div class="col-lg-5 col-md-8 py-8 py-xl-0">
            <!-- Card -->
            <div class="card shadow">
                <!-- Card body -->
                <div class="card-body px-3 py-5 text-center ">
                    <div class="text-center">
                        <img src="{{ asset('frontend/images/email/thank-you-verifiy-icon.png')}}" alt="course" class="" width="110px">
                    </div>
                    <div class="mb-4 mt-2">
                        <h2 class="mb-1 fw-bold text-center color-blue"> Verification Successful!</h2>
                        <p><strong>Congratulations!</strong> You have successfully verified your email ID.</p>

                    </div>
                    <!-- Form -->


                        <div>
                            <!-- Button -->
                            <div class="mt-3">
                                {{-- <button type="submit" class="btn btn-primary">Start Learning</button> --}}
                                <a class="" data-email="" class="btn btn-primary">Start Learning</a>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</section>



@endsection