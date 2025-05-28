@extends('frontend.master')
@section('content')

<section class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0 py-8">
        <div class="col-lg-5 col-md-8 py-8 py-xl-0">
            <!-- Card -->
            <div class="card shadow">
                <!-- Card body -->
                <div class="card-body px-3 py-5 text-center">
                    <div class="text-center">
                        <img src="{{ asset('frontend/images/email/mobile-verifiy-icon.png')}}" alt="course" width="110px">
                    </div>
                    <div class="mb-4 mt-2">
                        <h2 class="mb-1 fw-bold text-center color-blue">Mobile Number Verification</h2>
                        <p>We will send you a <strong>One Time Password (OTP)</strong> <br> on your phone number </p>
                        <span>
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <i class="fe fe-phone fs-4 ms-2"></i>
                                <span class="ms-2">+(000) 123465 987</span>
                                <button type="button" class="btn btn-link ms-2" data-bs-toggle="modal" data-bs-target="#editPhoneModal">Edit</button>
                            </div>
                        </span>
                    </div>
                    <!-- Form -->
                    <form class="" novalidate>
                        <div>
                            <a href="#" style="text-decoration: underline;" data-bs-toggle="modal" data-bs-target="#resendOtpModal">Resend OTP</a>
                        </div>
                        <h5 class="my-2">Please enter the 4 digit code below</h5>

                        <div class="mb-3 d-flex gap-2 text-center m-auto mobileinput">
                            <input type="text" class="form-control" maxlength="1">
                            <input type="text" class="form-control" maxlength="1">
                            <input type="text" class="form-control" maxlength="1">
                            <input type="text" class="form-control" maxlength="1">
                        </div>
                        <div>
                            <!-- Button -->
                            <div class="mt-3">
                                <a href="{{route('thank-you-verification')}}" class="btn btn-primary">Verify and Start</a>
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
                <h5>We have successfully resent the OTP to your mobile number: [9086545678].</h5> 
                <h5>Thank you!</h5>
                <div>
                    <button type="button" class="btn btn-primary float-end" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- EDIT PHONE NUMBER Modal --}}
<!-- Modal -->
<div class="modal fade" id="editPhoneModal" tabindex="-1" role="dialog" aria-labelledby="editPhoneLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPhoneLabel">Edit Phone Number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPhoneForm" novalidate>
                    <div class="mb-3">
                        <label for="countryCode" class="form-label">Country Code</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Choose Code</option>
                            <option value="1">+91</option>
                            <option value="2">+352</option>
                            <option value="3">+122</option>
                          </select>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" value="123465 987" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
