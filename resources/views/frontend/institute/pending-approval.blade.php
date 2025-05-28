@extends('frontend.master')

@section('content')
    <section class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4 text-center" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                <h2 class="card-title text-primary">Account Pending Approval</h2>
                <p class="card-text">
                    Thank you for registering! Your account is currently under review by our administrators.
                    Once approved, you will receive a confirmation email, and you will be able to access your dashboard.
                </p>
                <a href="/" class="btn btn-primary mt-3">Return to Homepage</a>
            </div>
        </div>
    </section>
</main>
@endsection