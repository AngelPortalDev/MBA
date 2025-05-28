@extends('frontend.master')
@section('content')


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<section class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0 h-lg-100 py-8">
        <div class="col-lg-5 col-md-8 py-8 py-xl-0">
            <!-- Card -->
            <div class="card shadow">
                <!-- Card body -->
                <div class="card-body p-md-6">
                    <div class="mb-5  text-center">
                        <h1 class="mb-1 fw-bold color-blue">Teacher Registration</h1>
                    </div>

                    <!-- Form -->
                    <form class="" method="POST" action="{{ route('teacherRegister') }}" novalidate onsubmit="disableSubmitButton()" enctype="multipart/form-data" >
                        <input type="text" name="honeypot" value="" hidden />
                        @honeypot
                        @csrf
                        <div class="mb-3 name-fileds gap-2">
                            
                            <input type="category_id" name="category_id" value="0" required autocomplete="category_id" id="category_id" class="form-control" name="category_id" hidden>

                            <!-- First Name -->
                            <div class="col-md-6">
                                <label class="form-label" for="first_name">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" value="{{old('first_name')}}" id="first_name" required autofocus autocomplete="first_name" class="form-control" placeholder="First Name">
                                @if ($errors->has('first_name'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('first_name') }}
                                    </div>
                                @endif

                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6">
                                <label class="form-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" id="last_name" name="last_name" value="{{old('last_name')}}" class="form-control" placeholder="Last Name">
                                @if ($errors->has('last_name'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('last_name') }}
                                    </div>
                                @endif

                            </div>
                        </div>
                      
                        <!--  Profile Photo -->
                        <div class="mb-3">
                            <label class="form-label" for="image_file">Upload Profile Picture <span class="text-danger">* </span><small class="text-muted">(Max: 2MB, JPG/JPEG/PNG)</small></label>
                            <input type="file" name="image_file" id="image_file" class="form-control" required>
                            @if ($errors->has('image_file'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('image_file') }}
                                </div>
                            @endif
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{old('email')}}" required autocomplete="email" id="email" class="form-control" name="email"
                                placeholder="Email address here" required>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('email') }}
                                    </div>
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
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('mobile') }}
                                </div>
                            @else
                                @if($errors->has('mob_code'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('mob_code') }}
                                    </div>
                                @endif
                            @endif
                        </div>

                        <!-- Designation -->
                        <div class="mb-3">
                            <label class="form-label" for="designation">Designation <span class="text-danger">*</span></label>
                            <input type="text" name="designation" value="{{old('designation')}}" id="designation" required autofocus autocomplete="designation" class="form-control" placeholder="Designation">
                            @if ($errors->has('designation'))
                                @foreach ($errors->get('designation') as $error)
                                    <div class="invalid-feedback d-block">{{$error}}</div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Institute Code -->
                         <div class="mb-3">
                            <label class="form-label" for="university_code">Institute Code <span class="text-danger">*</span></label>
                            <input type="number" name="university_code" value="{{old('university_code')}}" id="university_code" required autofocus autocomplete="university_code" class="form-control" placeholder="Institute Code">
                            @if ($errors->has('university_code'))
                                @foreach ($errors->get('university_code') as $error)
                                    <div class="invalid-feedback d-block">{{$error}}</div>
                                @endforeach
                            @endif

                        </div>
                        <!-- resume -->
                        <div class="mb-3">
                            <label class="form-label" for="resume_file">Upload Resume <span class="text-danger">* </span><small class="text-muted">(Max: 2MB, JPG/JPEG/PNG)</small></label>
                            <input type="file" name="resume_file" id="resume_file" class="form-control" required>
                            @if ($errors->has('resume_file'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('resume_file') }}
                                </div>
                            @endif
                        </div>

                        <!-- Specialization -->
                        <div class="mb-3">
                            <label for="specialization" class="form-label">
                                Specialization <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="specialization" rows="5" placeholder="Enter Specialization" name="specialization" required="">{{old('specialization')}}</textarea>
                            <div class="invalid-feedback" id="specialization_error">Please enter specialization</div>
                            @if ($errors->has('specialization'))
                                @foreach ($errors->get('specialization') as $error)
                                    <div class="invalid-feedback d-block">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>

                        <!-- About Teacher -->
                        <div class="mb-3">
                            <label for="about_teacher" class="form-label">
                                About Teacher
                                <small>(Maximum 50 words)</small> <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="about_teacher" rows="5" placeholder="Write here..." name="about_teacher" required="">{{old('about_teacher')}}</textarea>
                            @if ($errors->has('about_teacher'))
                                @foreach ($errors->get('about_teacher') as $error)
                                    <div class="invalid-feedback d-block">{{ $error }}</div>
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
                                <button type="submit" class="btn btn-primary" name="submit">Complete Registration</button>
                            </div>
                        </div>
                        {{-- <hr class="my-4">
                        <div class="mt-4 text-center">
                            <span>
                                Already have an account?
                                <a href="{{route('viewlogin')}}" class="ms-1">Log in</a>
                            </span>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="autoModal" tabindex="-1" aria-labelledby="autoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title color-blue" id="autoModalLabel">Important Information</h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="mb-1 color-blue">About Us:</h4>
                <p class="mb-2"> E-Ascencia will keep hosting a faculty exchange program to invite academics from around the globe to work and share their knowledge with us. Working with cutting-edge technology and aiming to be the most innovative school in Malta, </p>
                
                <p>E-Ascencia welcomes you to be a part of our network.  </p>
                 
                <h4 class="mb-1 mt-3 color-blue">Eligibility Criteria:</h4>
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center mb-1">
                        <span class="me-2 mt-1">
                            <i class="bi bi-check-circle text-success"></i>
                        </span>
                        <span>Employed with a partner university </span>
                    </li>
                    <li class="d-flex align-items-center mb-1">
                        <span class="me-2 mt-1">
                            <i class="bi bi-check-circle text-success"></i>
                        </span>
                        <span>Experience with academic writing</span>
                    </li>
                    <li class="d-flex align-items-center mb-1">
                        <span class="me-2 mt-1">
                            <i class="bi bi-check-circle text-success"></i>
                        </span>
                        <span>Team player</span>
                    </li>
                </ul>

                <h4 class="mb-1 mt-3 color-blue">Minimum Qualification:</h4>
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center mb-1">
                        <span class="me-2 mt-1">
                            <i class="bi bi-check-circle text-success"></i>
                        </span>
                        <span>Level 8 - PhD / DBA or a Specialization in any Stream </span>
                    </li>

                </ul>

                <h4 class="mb-1 mt-3 color-blue">Application:</h4>
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center mb-1">
                        <span class="me-2 mt-1">
                            <i class="bi bi-check-circle text-success"></i>
                        </span>
                        <span>Motivation letter</span>

                    </li>
                    <li class="d-flex align-items-center mb-1">
                        <span class="me-2 mt-1">
                            <i class="bi bi-check-circle text-success"></i>
                        </span>
                        <span>CV</span>

                    </li>
                    <li class="d-flex align-items-center mb-1">
                        <span class="me-2 mt-1">
                            <i class="bi bi-check-circle text-success"></i>
                        </span>
                        <span>Endorsement by current university / college</span>

                    </li>
                    <li class="d-flex align-items-center mb-1">
                        <span class="me-2 mt-1">
                            <i class="bi bi-check-circle text-success"></i>
                        </span>
                        <span>Links to publications (where available)</span>

                    </li>

                </ul>

            </div>

          </div>
        </div>
    </div>
    <div id="zf_div_Ini03Ax0IticpnwjLh2eVO61DTRYOnuXgVj-7gt4cVo"></div>
{{-- <script type="text/javascript">(function() {
try{
var f = document.createElement("iframe");
f.src = 'https://forms.zohopublic.com/info5253/form/Teachers/formperma/Ini03Ax0IticpnwjLh2eVO61DTRYOnuXgVj-7gt4cVo?zf_rszfm=1';
f.style.border="none";
f.style.height="1350px";
f.style.width="100%";
f.style.transition="all 0.5s ease";
f.setAttribute("aria-label", 'Teacher\x20Registration');

var d = document.getElementById("zf_div_Ini03Ax0IticpnwjLh2eVO61DTRYOnuXgVj-7gt4cVo");
d.appendChild(f);
window.addEventListener('message', function (){
var evntData = event.data;
if( evntData && evntData.constructor == String ){
var zf_ifrm_data = evntData.split("|");
if ( zf_ifrm_data.length == 2 || zf_ifrm_data.length == 3 ) {
var zf_perma = zf_ifrm_data[0];
var zf_ifrm_ht_nw = ( parseInt(zf_ifrm_data[1], 10) + 15 ) + "px";
var iframe = document.getElementById("zf_div_Ini03Ax0IticpnwjLh2eVO61DTRYOnuXgVj-7gt4cVo").getElementsByTagName("iframe")[0];
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
})();

document.addEventListener('DOMContentLoaded', function () {
      var myModal = new bootstrap.Modal(document.getElementById('autoModal'));
      myModal.show();


    //   

    $('#mob_code,').select2({
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
</script> --}}
</section>


<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

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

