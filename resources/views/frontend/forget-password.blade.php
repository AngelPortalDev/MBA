@extends('frontend.master')
@section('content')

            <section class="container d-flex flex-column vh-100">
                <div class="row align-items-center justify-content-center g-0 h-lg-100 py-8">
                    <div class="col-lg-5 col-md-8 py-8 py-xl-0">
                        <!-- Card -->
                        <div class="card shadow">
                            <!-- Card body -->
                            <div class="card-body p-6">
                                <div class="mb-4">
                                    <h1 class="mb-1 fw-bold">Forgot Password</h1>
                                    <p>Enter your registered email id to reset your password.</p>
                                </div>
                                <!-- Form -->
                                <form class="needs-validation"  action="{{ route('password.email') }}" method="POST" novalidate >
                                    <!-- Email -->
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="Enter Your Email " required />
                                        @if ($errors->has('email'))
                                        @foreach ($errors->get('email') as $error)
                                              <div class="invalid-feedback d-block">{{$error}}</div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <!-- Button -->
                                    <div class="mb-3 d-grid">
                                        <button type="submit" class="btn btn-primary" id="submitBtn" >Send Reset Link</button>
                                    </div>
                                    @if (session('status'))
                                    <div id="ResetPassword" data-reset="forget_password">
                                    <div id="statusMessage" data-status="{{ session('status') }}"></div>
                                    @endif
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <span>
                                        Return to
                                        <a href="{{route('viewlogin')}}">Log in</a>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>

<script>
    function disableSubmitButton() {
        document.getElementById('submitBtn').disabled = true;
        document.getElementById('submitBtn').innerText = 'Processing...';
    }
</script>
        
<!-- Import footer  -->
{{-- @endsection
@section('js')
<script>
    function disableSubmitButton() {
        document.getElementById('submitBtn').disabled = true;
        document.getElementById('submitBtn').innerText = 'Processing...';
    }
  $("#myModal").show();
</script> --}}

@endsection