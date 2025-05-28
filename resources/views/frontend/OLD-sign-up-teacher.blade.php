@extends('frontend.master')
@section('content')


<section class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0 h-lg-100 py-8">
        <div class="col-lg-5 col-md-8 py-8 py-xl-0">
            <!-- Card -->
            <div class="card shadow">
                <!-- Card body -->
                <div class="card-body p-md-6">
                    <div class="mb-4">
                        <h1 class="mb-1 fw-bold text-center">Teacher Sign up</h1>

                    </div>
                    <div class="mt-3 mb-5 row g-2 justify-content-center">
                        <!-- btn group -->
                        <div class="btn-group mb-2 mb-md-0 col-md-10" role="group" aria-label="socialButton">
                            {{-- <button type="button" class="btn btn-light shadow-sm">
                                <span class="me-1 ">
                                    <img src="{{asset('frontend/images/google-icon.svg')}}" alt="Google logo" width="30">
                                    <span>Continue with Google</span>
                                </span>
                            </button> --}}
                            <a href="{{ route('google.redirect',['role' => 'user']) }}" class="btn btn-light shadow-sm"><span class="me-1 ">
                                <img src="{{asset('frontend/images/google-icon.svg')}}" alt="Google logo" width="30">
                                <span>Continue with Google</span>
                            </span>
                            </a> 
                        </div>
                        <!-- btn group -->

                    </div>

                    <div class="mb-4">
                        <div class="border-bottom"></div>
                        <div class="text-center mt-n2 lh-1">
                            <span class="bg-white px-2 fs-6 rounded">OR</span>
                        </div>
                    </div>
                    <!-- Form -->
                    <form class="needs-validation" method="POST" action="{{ route('register') }}" novalidate>
                        @csrf
                        <div class="mb-3 name-fileds gap-2">
                            <div>
                                <label class="form-label" for="name">First Name</label>
                                <input type="text" name="name" value="{{old('name')}}" id="name" required autofocus autocomplete="name" class="form-control" placeholder="First Name">
                                  <input type="text" name="role" value="{{base64_encode('instructor')}}" id="role" required hidden />
                                @if ($errors->has('name'))
                                    @foreach ($errors->get('name') as $error)
                                          <div class="invalid-feedback">{{$error}}</div>
                                    @endforeach
                                @endif

                            </div>

                            <div>
                                <label class="form-label" for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name" value="{{old('last_name')}}" class="form-control" placeholder="Last Name">
                                 @if ($errors->has('last_name'))
                                    @foreach ($errors->get('last_name') as $error)
                                          <div class="invalid-feedback">{{$error}}</div>
                                    @endforeach
                                @endif

                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" value="{{old('email')}}" required autocomplete="email" id="email" class="form-control" name="email"
                                placeholder="Email address here" required>
                                @if ($errors->has('email'))
                                    @foreach ($errors->get('email') as $error)
                                          <div class="invalid-feedback">{{$error}}</div>
                                    @endforeach
                                @endif
                        </div>
                        <!-- Mobile -->
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile No.</label>
                            <div class="mobile-with-country-code">
                                <select class="form-select" name="mob_code" aria-label="Default select example">
                                    <option selected>+91</option>
                                    <option value="1">+356</option>
                                    <option value="2">+987</option>
                                    <option value="3">+54</option>
                                </select>
                                 @if ($errors->has('mob_code'))
                                    @foreach ($errors->get('mob_code') as $error)
                                          <div class="invalid-feedback">{{$error}}</div>
                                    @endforeach
                                @endif


                                <input type="number" id="mobile" class="form-control" name="mobile"
                                    placeholder="+123 4567 890" value="{{old('mobile')}}"  required>
                                      @if ($errors->has('mobile'))
                                    @foreach ($errors->get('mobile') as $error)
                                          <div class="invalid-feedback">{{$error}}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" name="password" 
                                placeholder="**************" required>
                                 @if ($errors->has('password'))
                                    @foreach ($errors->get('password') as $error)
                                          <div class="invalid-feedback">{{$error}}</div>
                                    @endforeach
                                @endif
                        </div>
                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Cofirm Password</label>
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                                placeholder="**************"   required>
                            @if ($errors->has('password_confirmation'))
                                    @foreach ($errors->get('password_confirmation') as $error)
                                          <div class="invalid-feedback">{{$error}}</div>
                                    @endforeach
                                @endif
                        </div>
                        <!-- Checkbox -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="tnc" id="agreeCheck" required>
                                <label class="form-check-label" for="agreeCheck">
                                    <span>
                                        I agree to the
                                        <a href="terms-and-conditions" target="_blank">Terms of Service</a>
                                        and
                                        <a href="privacy-policy" target="_blank">Privacy Policy.</a>
                                    </span>
                                </label>
                                 @if ($errors->has('tnc'))
                                    @foreach ($errors->get('tnc') as $error)
                                          <div class="invalid-feedback">{{$error}}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div>
                            <!-- Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name="submit">Create Free Account</button>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="mt-4 text-center">
                            <!--Facebook-->
                            <span>
                                Already have an account?
                                <a href="log-in.php" class="ms-1">Log in</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection