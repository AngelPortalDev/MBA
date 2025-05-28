@extends('frontend.master')
@section('content')
<section class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0 h-lg-100 py-8">
        <div class="col-lg-5 col-md-8 py-8 py-xl-0">
            
            @if(session('rate_limit_error'))
                <div id="rateLimitAlert" class="alert alert-danger">
                    {{ session('rate_limit_error') }}
                </div>
            @endif
            <!-- Card -->
            <div class="card shadow">
                <!-- Card body -->
              
                <div class="card-body p-6">
                    <div class="mb-4 text-center">
                        <h2 class="mb-1 fw-bold">Log in to E-Study </h2>

                    </div>
                    {{-- <div class="mt-3 mb-5 row g-2 justify-content-center"> --}}
                        <!-- btn group -->
                        {{-- <div class="btn-group mb-2 mb-md-0 col-md-10" role="group" aria-label="socialButton"> --}}
                            {{-- <button type="button" class="btn btn-light shadow-sm" href="{{ route('google.redirect') }}">
                                <span class="me-1 ">
                                    <img src="{{asset('frontend/images/google-icon.svg')}}" alt="Google logo" width="30">
                                    <span>Continue with Google</span>
                                </span>
                            </button> --}}
                            {{-- <a href="{{ route('google.redirect',['role' => 'role']) }}" class="btn btn-light shadow-sm"><span class="me-1 ">
                                <img src="{{asset('frontend/images/google-icon.svg')}}" alt="Google logo" width="30">
                                <span>Continue with Google</span>
                            </span>
                            </a>  --}}

                        {{-- </div> --}}
                        <!-- btn group -->

                    {{-- </div> --}}
                    {{-- <div class="mb-4">
                        <div class="border-bottom"></div>
                        <div class="text-center mt-n2 lh-1">
                            <span class="bg-white px-2 fs-6 rounded">OR</span>
                        </div>
                    </div> --}}
                    @if($errors->first('error'))
                        <div class="alert alert-danger session-error d-block" style="display:none;">
                            <div class="invalid-feedback-error">{{ $errors->first('error') }}</div>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success" id="successMessage">
                            {{ session('success') }}
                        </div>
                    
                        <script>
                            setTimeout(function() {
                                document.getElementById('successMessage').style.display = 'none';
                            }, 5000);
                        </script>
                    @endif
                

                 
                    <div class="alert alert-danger" style="display:none;">
                        <div class="invalid-feedback-error" ></div>
                    </div>

                    <!-- Form -->
                    <form class="" method="POST"  action="{{route('login')}}"  novalidate>
                         <input type="text" name="honeypot" value="" hidden />
                        @honeypot
                        <!-- Username -->
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" name="email"
                                placeholder="Email address here" required>
                                @if ($errors->has('email'))
                                    @foreach ($errors->get('email') as $error)
                                          <div class="invalid-feedback">{{$error}}</div>
                                    @endforeach
                                @endif
                        </div>
                        <!-- Password -->
                        <div class="mb-3 password-container">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control " name="password"
                                placeholder="**************" required >
                                <span class="toggle-password" toggle="#password">
                                    <i class="fe fe-eye toggle-password-eye field-icon show-password-eye bi bi-eye"></i>
                                </span>
                            @if ($errors->has('password'))
                                @foreach ($errors->get('password') as $error)
                                    <div class="invalid-feedback">{{$error}}</div>
                                @endforeach
                             @endif
                        </div>
                        {{-- <div class="g-recaptcha" name="g-recaptcha-response" data-sitekey="{{env('GOOGLE_SITE_KEY')}}"> </div> --}}
                        <br>
                        <!-- Checkbox -->
                        <div class="d-lg-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                {{-- <input type="checkbox" class="form-check-input" id="rememberme" > --}}
                                {{-- <label class="form-check-label" for="rememberme">Remember me</label> --}}
                                {{-- <div class="invalid-feedback">You must agree before submitting.</div> --}}
                            </div>
                            <div>
                                <a href="{{route('forgot-password')}}">Forgot your password?</a>
                            </div>
                        </div>
                        <div>
                            <!-- Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name="submit">Sign in</button>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="mt-4 text-center">
                            <span>
                                Don’t have an account? <a href="{{route('user.signup')}}" class="ms-1">Sign up</a>
                                {{-- Don’t have an account ? Please Sign up first --}}
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    setTimeout(function() {
        var alert = document.getElementById('rateLimitAlert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 5000); 
</script>
@endsection