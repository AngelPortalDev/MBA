@extends('frontend.master')
@section('content')

<style>
    /* .mobileVerification .form-control{
        padding: 5px 15px;
    } */
    .swal2-styled{
        background-color: #2b3990
    }
    /* .otp-verification .form-control{
        padding: 0px
    } */
</style>

<section class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0 py-8">
        <div class="col-lg-5 col-md-8 py-8 py-xl-0">
            
            @if ($errors->has('error'))
                <div id="sessionMessage">
                    {{-- {{ $errors->first('error') }} --}}
                </div>
            @endif
            @if(session('rate_limit_error'))
                <div id="rateLimitAlert" class="alert alert-danger">
                    {{ session('rate_limit_error') }}
                </div>
            @endif
             {{-- <div class="alert alert-danger"  id="error-message" style="display: none">
                Please fill in all OTP fields.
             </div> --}}
            <!-- Card -->
            <?php 
                $user = getData('users',['phone', 'mob_code'],['email'=> base64_decode($email)],'');
            ?>
            <div class="card shadow">
                <!-- Card body -->
                <div class="card-body px-3 py-5 text-center ">
                    <div class="text-center">
                        <img src="{{ asset('frontend/images/email/mobile-verifiy-icon.png')}}" alt="course" class="" width="110px">
                    </div>
                    <div class="mb-4 mt-2">
                        <h2 class="mb-1 fw-bold text-center color-blue">Mobile Number Verification</h2>
                        <p>We will send you a <strong>One Time Password (OTP)</strong> <br> on your phone number </p>
                        <span>
                            
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                
                                <i class="fe fe-phone fs-4 ms-2"></i>
                                <span class="ms-2">({{isset($user[0]->mob_code) ? $user[0]->mob_code : '' }}) {{isset($user[0]->phone) ? $user[0]->phone : '' }}</span>
                                <button type="button" class="btn btn-link ms-2" data-bs-toggle="modal" data-bs-target="#editPhoneModal">Edit</button>
                            </div>
                        </span>
                    </div>
                    <!-- Form -->
                    <form id="otpForm" action="{{route('verifyOTP')}}" method="POST" novalidate>
                        @csrf
                        <div>
                            {{-- <a href="#" id="resendOTP" style="text-decoration: underline;" >Resend OTP</a> --}}
                            <a href="#" id="resendOTP" style="text-decoration: underline;">Resend OTP</a>
                            <span id="otpTimer" style="display:none;"></span>
                        </div>
                        <h5 class="my-2"> Please enter the 4 digit code below</h5>

                        <div class="mb-3 d-flex text-center mx-auto">
                            {{-- <input type="hidden" name="messageId" value="{{ $messageId }}"> --}}
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="d-flex gap-2 mx-auto mobileinput">
                                <input type="text" class="form-control otp-input" name="otp[]" maxlength="1" oninput="moveToNext(this)" required autofocus>
                                <input type="text" class="form-control otp-input" name="otp[]" maxlength="1" oninput="moveToNext(this)" required>
                                <input type="text" class="form-control otp-input" name="otp[]" maxlength="1" oninput="moveToNext(this)" required>
                                <input type="text" class="form-control otp-input" name="otp[]" maxlength="1" oninput="moveToNext(this)" required>
                                {{-- <input type="text" class="form-control otp-input" name="otp[]" maxlength="1" oninput="moveToNext(this)" required>
                                <input type="text" class="form-control otp-input" name="otp[]" maxlength="1" oninput="moveToNext(this)" required> --}}
                            </div>
                        </div>
                        <div id="error-message" style="color: red; display: none;">Please fill in all OTP fields.</div>
                        <div>
                            <!-- Button -->
                            <div class="mt-3">
                                <button class="btn btn-primary" type="submit"> Verify and Start</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- RESEND LINK Pop-up --}}
<!-- Modal -->
<div class="modal fade" id="resendOtpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
               <h5>We have successfully resent the OTP to your mobile number: [{{isset($user[0]->phone) ? $user[0]->phone : '' }}].</h5> 
               <h5>Thank you! </h5>
               <div>
                <button type="button" class="btn btn-primary float-end" data-bs-dismiss="modal">Okay</button>
               </div>
            </div>
        </div>
    </div>
</div>

{{-- EDIT PHONE NUMBER Modal --}}
<!-- Modal -->
<div class="modal fade {{ $errors->any() ? 'show' : '' }}" id="editPhoneModal" tabindex="-1" role="dialog" aria-labelledby="editPhoneLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPhoneLabel">Edit Phone Number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger"><strong>Note - Please enter a different mobile number than the previous one.</strong></p>

                <form action="{{route('changeMobileNumber')}}" method="POST" id="editPhoneForm" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="countryCode" class="form-label">Country Code</label>
                        <select name="mob_code" class="form-select" id="mob_code" aria-label="Default select example" required>
                            @foreach (getDropDownlist('country_master', ['id', 'country_code', 'country_flag']) as $mob_code)
                                <option value="+{{$mob_code->country_code}}" 
                                        {{ (isset($user[0]->mob_code) ? $user[0]->mob_code : '' ) == "+$mob_code->country_code" ? 'selected' : '' }} 
                                        data-content="{{ Storage::url("country_flags/" . $mob_code->country_flag) }}">
                                    +{{$mob_code->country_code}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phone" value="{{isset($user[0]->phone) ? $user[0]->phone : '' }}" required>
                        <input type="hidden" name="email" value="{{ $email }}">
                    </div>
                    @if ($errors->has('phone'))
                        @foreach ($errors->get('phone') as $error)
                                <div class="invalid-feedback d-block">{{$error}}</div>
                        @endforeach
                    @endif
                    @if(session('error'))
                        <div class="invalid-feedback d-block">{{ session('error') }}</div>
                    @endif
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="saveChangesBtn" disabled>Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        const mobCodeElement = document.getElementById('mob_code');
        const phoneNumberElement = document.getElementById('phoneNumber');
        const saveChangesBtn = document.getElementById('saveChangesBtn');
        
        const initialMobCode = mobCodeElement.value;
        const initialPhoneNumber = phoneNumberElement.value;
        
        function toggleSaveButton() {
            const currentMobCode = mobCodeElement.value;
            const currentPhoneNumber = phoneNumberElement.value;
            
            if (currentMobCode !== initialMobCode || currentPhoneNumber !== initialPhoneNumber) {
                saveChangesBtn.disabled = false;
            } else {
                saveChangesBtn.disabled = true;
            }
        }
        
        mobCodeElement.addEventListener('change', toggleSaveButton);
        phoneNumberElement.addEventListener('input', toggleSaveButton);
    });
    
    function resendOTP(mob_code, mobile, email) {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var baseUrl = window.location.origin + "/";
        var url = baseUrl + "resendOTP/" + mob_code.replace('+', '') + mobile + "/" + email;

        $.ajax({
            url: url,
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                if (typeof response === 'string') {
                    response = JSON.parse(response);
                }
                
                if (response.code == '200') {
                    Swal.fire({
                        icon: '',
                        title: 'Sent',
                        html: 'We have successfully resent the OTP to your mobile number: ' + mob_code+" "+mobile + '.<br><br>Thank you!',
                        confirmButtonText: 'OK'
                    });
                    startOTPTimer();
                } else if (response.code == 429) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                }else if (response.code == 201) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while resending the OTP. Please try again.',
                    confirmButtonText: 'OK'
                });
            },
        });
    }

    function startOTPTimer() {
        var currentTime = new Date().getTime();
        var expiryTime = currentTime + (300 * 1000);

        localStorage.setItem('otpTimerExpiry', expiryTime);

        updateOTPTimer();
    }

    function updateOTPTimer() {
        var otpTimerExpiry = localStorage.getItem('otpTimerExpiry');

        if (otpTimerExpiry) {
            var interval = setInterval(function() {
                var currentTime = new Date().getTime();
                var remainingTime = otpTimerExpiry - currentTime;

                if (remainingTime <= 0) {
                    clearInterval(interval);
                    $('#otpTimer').hide();
                    $('#resendOTP').show().text('Resend OTP');
                    localStorage.removeItem('otpTimerExpiry');
                } else {
                    $('#resendOTP').hide();
                    $('#otpTimer').show();

                    var minutes = Math.floor(remainingTime / 60000);
                    var seconds = Math.floor((remainingTime % 60000) / 1000);

                    minutes = minutes < 10 ? '0' + minutes : minutes;
                    seconds = seconds < 10 ? '0' + seconds : seconds;

                    $('#otpTimer').text('Resend code in: ' + minutes + ':' + seconds);
                }
            }, 1000);
        }
    }

    $(document).ready(function() {
        updateOTPTimer();
        
        $("#resendOTP").on("click", function (event) {
            event.preventDefault();
            var mob_code = "<?php echo isset($user[0]->phone) ? $user[0]->mob_code : '' ?>"
            var mobile = "<?php echo isset($user[0]->phone) ? $user[0]->phone : '' ?>"
            var email = "<?php echo $email ?>"
            resendOTP(mob_code, mobile, email);
        });
    }); 
    
    document.addEventListener('DOMContentLoaded', function() {
        const otpInputs = document.querySelectorAll('.otp-input');
        const form = document.getElementById('otpForm');
        const errorMessage = document.getElementById('error-message');
    
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                if (this.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });
    
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value.length === 0 && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });
        form.addEventListener('submit', function(event) {
            const allFilled = Array.from(otpInputs).every(input => input.value.length === 1);

            if (!allFilled) {
                event.preventDefault(); 
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none'; 
            }   
        });

    });

    var sessionMessage = document.getElementById('sessionMessage');
        if (sessionMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid otp',
            text: 'Please enter a valid otp',
            confirmButtonText: 'OK'
        })
    }

    function moveToNext(current) {
        const inputs = document.querySelectorAll('.otp-input');
        const currentIndex = Array.from(inputs).indexOf(current);

        if (currentIndex >= 0 && currentIndex < inputs.length - 1) {
            const nextInput = inputs[currentIndex + 1];

            if (current.value.length >= current.maxLength) {
                nextInput.focus();
            }
        }
    }
    
    @if ($errors->has('phone') || session('error'))
        $(document).ready(function() {
            $('#editPhoneModal').modal('show');
        });
    @endif
    
    @if(session('error'))
        $(document).ready(function() {
            $('#editPhoneModal').modal('show');
        });
    @endif

    @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif
    setTimeout(function() {
        var alert = document.getElementById('rateLimitAlert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 5000); 


</script>
    

@endsection