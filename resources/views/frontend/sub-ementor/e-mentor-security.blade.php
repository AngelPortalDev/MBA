@extends('frontend.master')
@section('content')

<style>
    .sidenav.navbar .navbar-nav .e-men-5 > .nav-link {
    background-color: var(--gk-gray-200);
}
</style>


<main>
    <section class="pt-5 pb-5">
        <div class="container">
            
            <!-- Top Menubar -->
            @include('frontend.teacher.layout.e-mentor-common')

            <!-- Content -->

            {{-- <div class="row mt-0 mt-md-4"> --}}

                {{-- Left menubar  --}}
                
                {{-- @include('frontend.teacher.layout.e-mentor-left-menu') --}}

                <div class="col-lg-9 col-md-8 col-12">
                    @if (session('status') === 'password-updated')
                            <script>
                                    swal({
                                    title: "Password updated",
                                    text: '',
                                    icon: 'success',
                                });
                                </script>
                     @endif
                    <!-- Card -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">Security</h3>
                            <p class="mb-0">Edit your account settings and change your password here.</p>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                           
                            <form class="row needs-validation" novalidate="">
                                <div class="mb-1 col-lg-6 col-md-6 col-12 mb-2">
                                    <label class="form-label" for="email">Email Address</label>
                                    <input id="email" type="email" name="email" class="form-control" placeholder="" required=""  value="{{isset($ementorData[0]->user->email) ? $ementorData[0]->user->email : '' }}" disabled>
                                </div>
                                <div class="mb-1 col-lg-6 col-md-6 col-12 mb-2">
                                    <label class="form-label" for="text">Mobile Number</label>
                                    <input id="text" type="text" name="text" class="form-control" placeholder="" required="" value="{{ isset($ementorData[0]->user->phone) ? $ementorData[0]->user->mob_code.' '.$ementorData[0]->user->phone : '' }}" disabled>
                                </div>
                            </form>
                            <hr class="my-5">
                            <div>
                                <h4 class="mb-0">Change Password</h4>
                                <p>We will email you a confirmation when changing your password, so please expect that email after submitting.</p>
                                <!-- Form -->
                                <form class="row ChangePassword" method="POST" action="{{ route('password.update') }}" novalidate>
                                    @csrf
                                     @method('put')
                                     <div class="col-lg-6 col-md-12 col-12">
                                        <!-- Current password -->
                                        <div class="mb-3">
                                            <label class="form-label" for="current_password">Old Password <span class="text-danger">*</span></label>
                                            <input id="current_password" type="password" name="current_password" class="form-control" placeholder="Enter current password">
                                                @if($errors->updatePassword->has('current_password'))
                                                    @foreach($errors->updatePassword->get('current_password') as $error)
                                                    <div class="invalid-feedback d-block">{{$error}} </div>
                                                    @endforeach
                                                @endif
                                           
                                        </div>

                                        {{-- <div class="password-container">
                                            <input type="password" id="password" placeholder="Enter your password" onkeyup="checkPasswordStrength()">
                                            <span class="toggle-password" onclick="togglePasswordVisibility()">Show</span>
                                        </div>
                                        <div id="strengthMessage"></div>
                                        <div id="lengthMessage" class="error"></div> --}}
                                        <!-- New password -->
                                        <div class="mb-3 password-field">
                                            <label class="form-label" for="newpassword">New Password <span class="text-danger">*</span></label>
                                            <input id="newpassword" type="password" name="password" class="form-control mb-2" placeholder="Password (e.g., Abc@1234)" required  onkeyup="checkPasswordStrength()">
                                            <span class="toggle-password" toggle="#newpassword">
                                                {{-- <i class="fe fe-eye toggle-password-eye field-icon show-password-eye-security"></i> --}}
                                            </span>
                                                @if($errors->updatePassword->has('password'))
                                                    @foreach($errors->updatePassword->get('password') as $error)
                                                    <div class="invalid-feedback d-block">{{$error}} </div>
                                                    @endforeach
                                                @endif
                                            <div class="invalid-feedback" id="newpassword2_error">Password Formate Should be like . "Examples@123" </div>
                                            <div class="row align-items-center g-0">
                                                <div class="col-6">
                                                    <span
                                                        data-bs-toggle="tooltip"
                                                        data-placement="right"
                                                        title="Test it by typing a new password in the field above. To reach full strength, use at least 8 characters, a capital letter, a symbol and a digit, e.g. 'Abc@1010'">
                                                        Password strength
                                                        <i class="fe fe-help-circle ms-1"></i>
                                                        <div id="strengthMessage"></div>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <!-- Confirm new password -->
                                            <label class="form-label" for="confirmpassword">Confirm New Password <span class="text-danger">*</span></label>
                                            <input id="confirmpassword" type="password" name="password_confirmation" class="form-control mb-2" placeholder="Password (e.g., Abc@1234)" required>
                                            @if($errors->updatePassword->has('password_confirmation'))
                                                    @foreach($errors->updatePassword->get('password_confirmation') as $error)
                                                    <div class="invalid-feedback d-block">{{$error}} </div>
                                                    @endforeach
                                                @endif
                                        </div>
                                        <!-- Button -->
                                        <button type="submit" class="btn btn-primary" name="submit">Save Password</button>
     
                                        <div class="col-6"></div>
                                    </div>
                                    {{-- <div class="col-12 mt-4">
                                        <p class="mb-0">
                                            Can't remember your current password?
                                            <a href="#">Reset your password via email</a>
                                        </p>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </section>
</main>

@endsection