@extends('frontend.master')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


<section class="container d-flex flex-column">

{{-- <div id="zf_div_K8vJIdyyPszg4GgCtym12ir6ydVUV9bhzAduBVXz4hc"></div> --}}
 <div class="row align-items-center justify-content-center g-0 h-lg-100 py-8">

        <div class="col-lg-5 col-md-8 py-8 py-xl-0"> 

            <!-- Card -->

            <div class="card shadow">

                <!-- Card body -->

                <div class="card-body p-md-6">

                    <div class="mb-4">

                        <h1 class="mb-1 fw-bold text-center">Institute Sign up</h1>

                    </div> 

                    {{-- <div class="mt-3 mb-5 row g-2 justify-content-center">  --}}

                        <!-- btn group -->

                        {{-- <div class="btn-group mb-2 mb-md-0 col-md-10" role="group" aria-label="socialButton"> --> --}}
 
                            <!-- <button type="button" class="btn btn-light shadow-sm">

                                <span class="me-1 ">

                                    <img src="{{asset('frontend/images/google-icon.svg')}}" alt="Google logo" width="30">

                                    <span>Continue with Google</span>

                                </span>

                            </button>  -->
                            <!-- <a href="{{ route('google.redirect',['role' => 'institute']) }}" class="btn btn-light shadow-sm"><span class="me-1 ">

                                <img src="{{asset('frontend/images/google-icon.svg')}}" alt="Google logo" width="30">

                                <span>Continue with Google</span>

                            </span> -->

                            <!-- </a>  -->

                        {{-- </div>  --}}

                        <!-- btn group -->


<!--  -->
                    <!-- </div> -->



                    <!-- <div class="mb-4">

                        <div class="border-bottom"></div>

                        <div class="text-center mt-n2 lh-1">

                            <span class="bg-white px-2 fs-6 rounded">OR</span>

                        </div>

                    </div> -->

                    <!-- Form -->

                    <form class="" method="POST" action="{{ route('instituteRegister') }}" novalidate onsubmit="disableSubmitButton()" enctype="multipart/form-data" >
                        <input type="text" name="honeypot" value="" hidden />
                        @honeypot
                        @csrf

                        <!-- Institution Name -->
                        <div class="mb-3">
                            <label class="form-label" for="name">Institution Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{old('name')}}" id="name" required autofocus autocomplete="name" class="form-control" placeholder="Institution Name">
                              <input type="text" name="role" value="{{base64_encode('institute')}}" id="role" required hidden />
                              <input type="text" name="role_name" value="institute" id="role_name" required hidden />
                            @if ($errors->has('name'))
                                @foreach ($errors->get('name') as $error)
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

                        <!-- Website URL -->
                        <div class="mb-3">
                            <label class="form-label" for="website">Website URL <span class="text-danger">*</span></label>
                            <input type="text" name="website" value="{{old('website')}}" id="website" autofocus autocomplete="website" class="form-control" placeholder="Website URL">
                            @if ($errors->has('website'))
                                @foreach ($errors->get('website') as $error)
                                    <div class="invalid-feedback d-block">{{$error}}</div>
                                @endforeach
                            @endif
                        </div>
                        
                        <!-- Upload Logo -->
                        <div class="mb-3">
                            <label class="form-label" for="logo">Upload Logo <span class="text-danger">* </span><small class="text-muted">(Max: 2MB, JPG/JPEG/PNG, Width: 302px, Height: 272px)</small></label>
                            <input type="file" name="logo" id="logo" class="form-control" required>
                            {{-- @if ($errors->has('logo'))
                                @foreach ($errors->get('logo') as $error)
                                    <div class="invalid-feedback d-block">{{ $error }}</div>
                                @endforeach
                            @endif --}}
                            @if ($errors->has('logo'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('logo') }}
                                </div>
                            @endif
                        </div>

                        <!-- Upload Photo -->
                        <div class="mb-3">
                            <label class="form-label" for="photo_id">Upload Photo ID <span class="text-danger">* </span><small class="text-muted">(Max: 2MB, JPG/JPEG/PNG)</small></label>
                            <input type="file" name="photo_id" id="photo_id" class="form-control" required>
                            {{-- @if ($errors->has('photo_id'))
                                @foreach ($errors->get('photo_id') as $error)
                                    <div class="invalid-feedback d-block">{{ $error }}</div>
                                @endforeach
                            @endif --}}
                            @if ($errors->has('photo_id'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('photo_id') }}
                                </div>
                            @endif
                        </div>
                        
                        <!-- Upload Licence -->
                        <div class="mb-3">
                            <label class="form-label" for="licence">Upload License <span class="text-danger">* </span><small class="text-muted">(Max: 2MB, JPG/JPEG/PNG)</small></label>
                            <input type="file" name="licence" id="licence" class="form-control" required>
                            {{-- @if ($errors->has('licence'))
                                @foreach ($errors->get('licence') as $error)
                                    <div class="invalid-feedback d-block">{{ $error }}</div>
                                @endforeach
                            @endif --}}
                            @if ($errors->has('licence'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('licence') }}
                                </div>
                            @endif

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="{{ old('address') }}">
                            {{-- <small class="form-text text-muted">Address</small> --}}
                            @if ($errors->has('address'))
                                @foreach ($errors->get('address') as $error)
                                    <div class="invalid-feedback d-block">{{$error}}</div>
                                @endforeach
                            @endif
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="billing_city" id="billing_city" class="form-control" placeholder="Billing City" value="{{ old('billing_city') }}">
                                {{-- <small class="form-text text-muted">Billing City</small> --}}
                                @if ($errors->has('billing_city'))
                                    @foreach ($errors->get('billing_city') as $error)
                                        <div class="invalid-feedback d-block">{{$error}}</div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" name="billing_state" id="billing_state" class="form-control" placeholder="Billing State" value="{{ old('billing_state') }}">
                                {{-- <small class="form-text text-muted">Billing State</small> --}}
                                @if ($errors->has('billing_state'))
                                    @foreach ($errors->get('billing_state') as $error)
                                        <div class="invalid-feedback d-block">{{$error}}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <select name="billing_country" id="billing_country" class="form-control">
                                <option value="" selected>-Select-</option>
                                @foreach (getDropDownlist('country_master', ['id', 'country_code', 'country_flag', 'country_name']) as $mob_code)
                                    <option value="{{ $mob_code->country_name }}"
                                        {{ old('billing_country') == "$mob_code->country_name" ? 'selected' : '' }}
                                        data-content="{{ Storage::url('country_flags/' . $mob_code->country_flag) }}"
                                        data-name="{{ $mob_code->country_name }}">
                                        {{ $mob_code->country_name }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- <small class="form-text text-muted">Billing Country</small> --}}
                            @if ($errors->has('billing_country'))
                                @foreach ($errors->get('billing_country') as $error)
                                    <div class="invalid-feedback d-block">{{$error}}</div>
                                @endforeach
                            @endif
                        </div>
                        

                        <h5 class="mb-3 text-primary"><b>Institute Contact :</b></h5>
                    

                        <!-- Contact Person Name -->
                        <div class="mb-3">
                            <label class="form-label" for="contact_person_name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="contact_person_name" value="{{old('contact_person_name')}}" id="contact_person_name" required autofocus autocomplete="contact_person_name" class="form-control" placeholder="Name">
                            @if ($errors->has('contact_person_name'))
                                @foreach ($errors->get('contact_person_name') as $error)
                                    <div class="invalid-feedback d-block">{{$error}}</div>
                                @endforeach
                            @endif

                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="contact_person_email" class="form-label">Email <span class="text-danger">* </span></label>
                            <input type="contact_person_email" name="contact_person_email" value="{{old('contact_person_email')}}" autocomplete="contact_person_email" id="contact_person_email" class="form-control" name="contact_person_email"
                                placeholder="Email address here" required>
                                @if ($errors->has('contact_person_email'))
                                    @foreach ($errors->get('contact_person_email') as $error)
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
                                <select name="contact_person_mob_code" id="contact_person_mob_code" class="form-select">
                                    <option value="" selected>Choose Code</option>
                                    @foreach (getDropDownlist('country_master', ['id', 'country_code', 'country_flag', 'country_name']) as $mob_code)
                                        <option value="+{{ $mob_code->country_code }}"
                                                {{ old('contact_person_mob_code', "+$country_code") == "+$mob_code->country_code" ? 'selected' : '' }}
                                                data-content="{{ Storage::url('country_flags/' . $mob_code->country_flag) }}"
                                                data-name="{{ $mob_code->country_name }}">
                                            +{{ $mob_code->country_code }} - {{ $mob_code->country_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="number" id="contact_person_mobile" class="form-control" name="contact_person_mobile" placeholder="123 4567 890" value="{{old('contact_person_mobile')}}" required>
                            </div>
                            @if ($errors->has('contact_person_mobile'))
                                @foreach ($errors->get('contact_person_mobile') as $error)
                                        <div class="invalid-feedback d-block">{{$error}}</div>
                                @endforeach
                            @else
                                @if($errors->has('contact_person_mob_code'))
                                    @foreach ($errors->get('contact_person_mob_code') as $error)
                                        <div class="invalid-feedback d-block">{{$error}}</div>
                                    @endforeach
                                @endif
                            @endif
                            @if(session('contact_person_mob_code'))
                                <div class="invalid-feedback d-block">{{ session('contact_person_mob_code') }}</div>
                            @endif
                            @if($errors->first('error'))
                                <div class="invalid-feedback d-block">{{ $errors->first('error') }}</div>
                            @endif
                        </div>
                    
                        <div class="mb-3">
                            <label class="form-label" for="contact_person_designation">Designation <span class="text-danger">* </span></label>
                            <input type="text" name="contact_person_designation" id="contact_person_designation" class="form-control" placeholder="Enter Designation" value="{{ old('contact_person_designation') }}">
                            @if ($errors->has('contact_person_designation'))
                                @foreach ($errors->get('contact_person_designation') as $error)
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

                        <div>

                            <!-- Button -->

                            <div class="d-grid">

                                <button type="submit" class="btn btn-primary">Create Free Account</button>

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
{{-- 
<script type="text/javascript">(function() {
try{
var f = document.createElement("iframe");
f.src = 'https://forms.zohopublic.com/info5253/form/InstituteRegistrationInstituteContact1/formperma/K8vJIdyyPszg4GgCtym12ir6ydVUV9bhzAduBVXz4hc?zf_rszfm=1&zf_enablecamera=true';
f.style.border="none";
f.style.height="1603px";
f.style.width="90%";
f.style.transition="all 0.5s ease";
f.setAttribute("aria-label", 'Institute\x20Registration\x20Institute\x20Contact');
f.setAttribute("allow","camera;");
var d = document.getElementById("zf_div_K8vJIdyyPszg4GgCtym12ir6ydVUV9bhzAduBVXz4hc");
d.appendChild(f);
window.addEventListener('message', function (){
var evntData = event.data;
if( evntData && evntData.constructor == String ){
var zf_ifrm_data = evntData.split("|");
if ( zf_ifrm_data.length == 2 || zf_ifrm_data.length == 3 ) {
var zf_perma = zf_ifrm_data[0];
var zf_ifrm_ht_nw = ( parseInt(zf_ifrm_data[1], 10) + 15 ) + "px";
var iframe = document.getElementById("zf_div_K8vJIdyyPszg4GgCtym12ir6ydVUV9bhzAduBVXz4hc").getElementsByTagName("iframe")[0];
if ( (iframe.src).indexOf('formperma') > 0 && (iframe.src).indexOf(zf_perma) > 0 ) {
var prevIframeHeight = iframe.style.height;
var zf_tout = false;
if( zf_ifrm_data.length == 3 ) {
iframe.scrollIntoView();
zf_tout = true;
}
if ( prevIframeHeight != zf_ifrm_ht_nw ) {
if( zf_tout ) {
setTimeout(function(){
iframe.style.height = zf_ifrm_ht_nw;
},500);
} else {
iframe.style.height = zf_ifrm_ht_nw;
}
}
}
}
}
}, false);
}catch(e){}
})();</script> --}}

<script>
    $(document).ready(function() {
        $('#mob_code, #contact_person_mob_code').select2({
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
</script>


</main>

@endsection