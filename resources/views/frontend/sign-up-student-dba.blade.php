@extends('frontend.master')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<section class="container d-flex flex-column sign-up-form">
    <div class="row align-items-center justify-content-center g-0 h-lg-100 py-8">
        <div class="col-lg-5 col-md-8 py-8 py-xl-0">

            @if(session('rate_limit_error'))
                <div id="rateLimitAlert" class="alert alert-danger">
                    {{ session('rate_limit_error') }}
                </div>
            @endif

            @if(session('error'))
                <div id="rateLimitAlert" class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Card -->
            <div class="card shadow">
                <!-- Card body -->
                <div class="card-body p-md-6">
                    <div class="mb-4">
                        <h1 class="mb-1 fw-bold text-center">Sign up and start learning</h1>

                    </div>
                    {{-- <div class="mt-3 mb-5 row g-2 justify-content-center"> --}}
                        <!-- btn group -->
                        {{-- <div class="btn-group mb-2 mb-md-0 col-md-10" role="group" aria-label="socialButton"> --}}
                            {{-- <button type="button" class="btn btn-light shadow-sm">
                                <span class="me-1 ">
                                    <img src="{{asset('frontend/images/google-icon.svg')}}" alt="Google logo" width="30">
                                    <span>Continue with Google</span>
                                </span>
                            </button> --}}
                            {{-- <a href="{{ route('google.redirect',['role' => 'user']) }}" class="btn btn-light shadow-sm"><span class="me-1 ">
                                <img src="{{asset('frontend/images/google-icon.svg')}}" alt="Google logo" width="30">
                                <span>Continue with Google</span>
                            </span>
                            </a> 
                        </div> --}}
                        <!-- btn group -->

                    {{-- </div> --}}

                    {{-- <div class="mb-4">
                        <div class="border-bottom"></div>
                        <div class="text-center mt-n2 lh-1">
                            <span class="bg-white px-2 fs-6 rounded">OR</span>
                        </div>
                    </div> --}}
                    <!-- Form -->
                    <form class="" method="POST" action="{{ route('register') }}" novalidate onsubmit="disableSubmitButton()">
                        <input type="text" name="honeypot" value="" hidden />
                        @honeypot
                        @csrf
                        
                        <div class="mb-3 name-fileds gap-6">
                            <div>
                                <label class="form-label" for="name">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{old('name')}}" id="name" required autofocus autocomplete="name" class="form-control" placeholder="First Name">
                                  <input type="text" name="role" value="{{base64_encode('user')}}" id="role" required hidden />
                                  <input type="text" name="role_name" value="user" id="role_name" required hidden />
                                @if ($errors->has('name'))
                                    @foreach ($errors->get('name') as $error)
                                          <div class="invalid-feedback d-block">{{$error}}</div>
                                    @endforeach
                                @endif
                            </div>

                            <div>
                                <label class="form-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" id="last_name" name="last_name" value="{{old('last_name')}}" class="form-control" placeholder="Last Name" required>
                                 @if ($errors->has('last_name'))
                                    @foreach ($errors->get('last_name') as $error)
                                          <div class="invalid-feedback d-block">{{$error}}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{old('email')}}" required autocomplete="email" id="email" class="form-control" name="email"
                                placeholder="Email address here" required>
                                @if ($errors->has('email'))
                                    @foreach ($errors->get('email') as $error)
                                          <div class="invalid-feedback d-block">{{$error}}</div>
                                    @endforeach
                                @endif
                        </div>
                        <!-- Mobile -->
                        <?php
                            $countryData = getCountryCodeByIp();
                            $country_code = $countryData['country_code'];
                            $country_flag = $countryData['country_flag'];
                        ?>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile No.<span class="text-danger">*</span></label>
                            <div class="mobile-with-country-code">
                                {{-- <select class="form-select select2" name="mob_code" id="mob_code" data-live-search="true">
                                    <option value="" selected>Choose Code</option>
                                    @foreach (getDropDownlist('country_master', ['id', 'country_code', 'country_flag', 'country_name']) as $mob_code)
                                        <option value="+{{$mob_code->country_code}}" 
                                                {{ old('mob_code') == "+$mob_code->country_code" ? 'selected' : '' }} 
                                                data-content="{{ Storage::url("country_flags/" . $mob_code->country_flag) }}"
                                                data-name="{{ $mob_code->country_name }}">
                                            +{{$mob_code->country_code}} - {{$mob_code->country_name}}
                                        </option>
                                    @endforeach
                                </select> --}}

                                {{-- <select name="mob_code" id="mob_code" class="form-select">
                                    <option value="" selected>Choose Code</option>
                                    @foreach (getDropDownlist('country_master', ['id', 'country_code', 'country_flag', 'country_name']) as $mob_code)
                                        <option value="+{{ $mob_code->country_code }}"
                                                {{ old('mob_code', "+$country_code") == "+$mob_code->country_code" ? 'selected' : '' }}
                                                data-content="{{ Storage::url('country_flags/' . $mob_code->country_flag) }}"
                                                data-name="{{ $mob_code->country_name }}">
                                            +{{ $mob_code->country_code }} - {{ $mob_code->country_name }}
                                        </option>
                                    @endforeach
                                </select> --}}
                                
                                <select name="mob_code" id="mob_code" class="form-select">
                                    <option value="" selected>Choose Code</option>
                                    @foreach (getDropDownlist('country_master', ['id', 'country_code', 'country_flag', 'country_name']) as $mob_code)
                                        <option value="+{{ $mob_code->country_code }}"
                                                {{ old('mob_code', "+$country_code") == "+$mob_code->country_code" ? 'selected' : '' }}
                                                data-content="{{ Storage::url('country_flags/' . $mob_code->country_flag) }}"
                                                data-name="{{ $mob_code->country_name }}">
                                            +{{ $mob_code->country_code }} - {{ $mob_code->country_name }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                
                                
                                
                                
                                
                                
                                
                                <input type="number" id="mobile" class="form-control" name="mobile" placeholder="123 4567 890" value="{{old('mobile')}}" required>
                            </div>
                            
                            <!--@if ($errors->has('mob_code'))-->
                            <!--@foreach ($errors->get('mob_code') as $error)-->
                            <!--      <div class="invalid-feedback d-block">{{$error}}</div>-->
                            <!--@endforeach-->
                            <!--@endif-->
                            @if ($errors->has('mobile'))
                                @foreach ($errors->get('mobile') as $error)
                                        <div class="invalid-feedback d-block">{{$error}}</div>
                                @endforeach
                            @else
                                @if($errors->has('mob_code'))
                                    @foreach ($errors->get('mob_code') as $error)
                                        <div class="invalid-feedback d-block">{{$error}}</div>
                                    @endforeach
                                @endif
                            @endif
                            @if(session('mob_code'))
                                <div class="invalid-feedback d-block">{{ session('mob_code') }}</div>
                            @endif
                            @if($errors->first('error'))
                                <div class="invalid-feedback d-block">{{ $errors->first('error') }}</div>
                            @endif
                        
                        </div>
                        <!-- university code  -->

                        <div class="mb-3">
                            <label for="university_code" class="form-label">University Code (optional)</label>
                            <input type="text" id="university_code" class="form-control" name="university_code"  value="{{old('university_code')}}"
                                placeholder="University Code" required>
                                 @if ($errors->has('university_code'))
                                    @foreach ($errors->get('university_code') as $error)
                                          <div class="invalid-feedback d-block">{{$error}}</div>
                                    @endforeach
                                @endif
                        </div>
                        
                        <!-- Password -->
                        <div class="mb-3 password-container">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" id="password" class="form-control" name="password" 
                                placeholder="Password (e.g., Abc@1234)" required>
                                {{-- <span class="toggle-password" toggle="#password">
                                    <i class="fe fe-eye toggle-password-eye field-icon show-password-eye"></i>
                                </span> --}}
                                 @if ($errors->has('password'))
                                    @foreach ($errors->get('password') as $error)
                                          <div class="invalid-feedback d-block">{{$error}}</div>
                                    @endforeach
                                @endif
                        </div>
                        <!-- Confirm Password -->
                        <div class="mb-3 password-container">
                            <label for="" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                                placeholder="Password (e.g., Abc@1234)"   required>
                                <span class="toggle-password" toggle="#password_confirmation">
                                    <i class="fe fe-eye toggle-password-eye field-icon show-password-eye bi bi-eye"></i>
                                </span>
                                @if ($errors->has('password_confirmation'))
                                    @foreach ($errors->get('password_confirmation') as $error)
                                          <div class="invalid-feedback d-block">{{$error}}</div>
                                    @endforeach
                                @endif
                        </div>
                        <div class="g-recaptcha" name="g-recaptcha-response" data-sitekey="{{env('GOOGLE_SITE_KEY')}}"> </div>
                        <br>
                        <!-- Checkbox -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="tnc" id="agreeCheck" required checked>
                                <label class="form-check-label" for="agreeCheck">
                                    <span>
                                        I reviewed and accept the
                                        <a href="terms-and-conditions" target="_blank">terms of service</a>
                                        and
                                        <a href="privacy-policy" target="_blank">privacy policy.</a>
                                    </span>
                                </label>
                                 @if ($errors->has('tnc'))
                                    @foreach ($errors->get('tnc') as $error)
                                          <div class="invalid-feedback d-block">{{$error}}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="apply_dba" id="applyDBA" required checked>
                                <label class="form-check-label" for="applyDBA">
                                    <span>
                                        Apply for the DBA course
                                    </span>
                                </label>
                            </div>
                        <div>
                            <br>
                        <div>
                            <!-- Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" id="submitBtn" name="submit">Create Free Account</button>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="mt-4 text-center">
                            <!--Facebook-->
                            <span>
                                Already have an account?
                                <a href="{{route('viewlogin')}}" class="ms-1">Log in</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    
    // $(document).ready(function() {
    //     // Function to format the option with an image
    //     function formatState(state) {
    //         if (!state.id) {
    //             return state.text;
    //         }
    //         var content = $(state.element).data('content');
    //         return $('<span>').html(content);
    //     }

    //     $('#mob_code').select2({
    //         templateResult: formatState,
    //         templateSelection: formatState,
    //         placeholder: "Select a country code",
    //         allowClear: true,
    //     });
    // });

    $(document).ready(function() {
        $('#mob_code').select2({
            templateResult: formatOption,
            templateSelection: formatSelection,
            escapeMarkup: function (markup) { return markup; }
        });

        function formatOption(option) {
            if (!option.id) { return option.text; }
            
            const flagUrl = $(option.element).data('content');
            const countryCode = option.text.split(' - ')[0];
            const countryName = option.text.split(' - ')[1];
            
            return $(
                '<span><img src="' + flagUrl + '" class="img-flag" style="width: 24px; height: 16px; margin-right: 5px;" /> ' +
                countryCode + ' - ' + countryName + '</span>'
            );
        }

        function formatSelection(option) {
            if (!option.id) { return option.text; }
            
            const flagUrl = $(option.element).data('content');
            const countryCode = option.text.split(' - ')[0];
             
            return $(
                '<span><img src="' + flagUrl + '" class="img-flag" style="width: 24px; height: 16px; margin-right: 5px;" /> ' +
                countryCode + '</span>'
            );
        }
        
    });

    function disableSubmitButton() {
        document.getElementById('submitBtn').disabled = true;
        document.getElementById('submitBtn').innerText = 'Processing...';
    }

    setTimeout(function() {
        var alert = document.getElementById('rateLimitAlert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 5000); 

</script>
@endsection