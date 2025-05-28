@extends('frontend.master')
@section('content')

<section class="d-flex align-items-center justify-content-center vh-100 text-white text-center position-relative" style="background: url('{{ asset('images/coming-soon-bg.jpg') }}') no-repeat center center/cover;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-10 col-12">
                <!-- Logo -->
                <img src="{{ asset('frontend/images/comingSoon2.png') }}" alt="Coming Soon" class="mb-8" style="max-width: 350px;">
                
                <!-- Heading -->
                <h1 class="display-3 fw-bold mb-3">We are Coming Soon</h1>
                <p class="h4 mb-4">We are almost there! Our courses will be live soon, bringing you top-quality education and learning experiences.<br>Stay tuned!</p>
                
                <!-- Contact Us Message -->
                 <a href="mailto:support@eascencia.mt" class="fw-bold">support@eascencia.mt</a></p>
                
            </div>
        </div>
    </div>
</section>

@endsection