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
                                    <h1 class="mb-1 fw-bold">Reset Password</h1>
                                    <p>Enter new password to reset your password.</p>
                                </div>
                                @if (session('status'))
                                    {{-- <div class="alert alert-success"> --}}
                                        <div class="invalid-feedback d-block"></div>
                                    {{-- </div> --}}
                                @endif
                                <!-- Form -->
                                <form action="{{ route('password.store') }}" method="POST" novalidate onsubmit="disableSubmitButton()">
                                    <!-- Email -->
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    <input type="hidden" id="email" class="form-control" name="email" placeholder="Enter Your Email" value="{{$request->email}}" required />
                                    <div class="mb-3">
										<label class="font-weight-700">New Password *</label>
										<input type="password" id="password"  class="form-control" name="password"  placeholder="Password must follow the format 'Abc@1234'" required/>
                                        @if ($errors->has('password'))
                                        @foreach ($errors->get('password') as $error)
                                              <div class="invalid-feedback d-block">{{$error}}</div>
                                        @endforeach
                                    @endif
									</div>
									<div class="mb-3">
										<label class="font-weight-700">Confirm New Password *</label>
										<input type="password" id="password_confirmation"  class="form-control" name="password_confirmation" placeholder="Password must follow the format 'Abc@1234'" required/>
                                        @if ($errors->has('password_confirmation'))
                                        @foreach ($errors->get('password_confirmation') as $error)
                                              <div class="invalid-feedback d-block">{{$error}}</div>
                                        @endforeach
                                        @endif
									</div>
                                    @if (session('status'))
                                    <div id="ResetPassword" data-reset="reset_password">
                                    <div id="statusMessage" data-status="{{ session('status') }}"></div>
                                    @endif
                                    <div class="mb-3 d-grid">
                                        <button type="submit" class="btn btn-primary" id="submitBtn">Reset Password</button>
                                    </div>
                                   
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
@endsection
