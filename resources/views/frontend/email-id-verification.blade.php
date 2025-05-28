@extends('frontend.master')
@section('content')

<section class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0 py-8">
        <div class="col-lg-5 col-md-8 py-8 py-xl-0">
            <!-- Card -->
            <div class="card shadow">
                <!-- Card body -->
                <div class="card-body px-3 py-5 text-center ">
                    <div class="text-center">
                        <img src="{{ asset('frontend/images/email/mail-verifiy-icon.png')}}" alt="course" class="" width="90px">
                    </div>
                    <div class="mb-4 mt-2">
                        <h2 class="mb-1 fw-bold text-center color-blue">Email Id Verification</h2>
                        <p>We have sent a Verification link to your registered Email Id.</p>

                    </div>
                    <!-- Form -->
                    <form class="needs-validation" novalidate>
                        <p> Click on the link to complete verification process and <br> then enter "Next" button.</p>
                        {{-- <div>
                            <a href="#" style="text-decoration: underline;" data-bs-toggle="modal" data-bs-target="#resendLinkModal">Resend Email</a>
                        </div> --}}
                        <div>
                            <!-- Button -->
                            {{-- <div class="mt-3">
                                <a href="{{route('viewlogin')}}" style="cursor:pointer;" class="btn btn-primary">Next</a>
                            </div> --}}
                            {{-- @if(session('statusEmail')) --}}
                            <div class="mt-3">
                                @php 
                                    // echo auth()->user()->id;
                                    $User = DB::table('users')->where('email',session('statusEmail'))->first(); 
                                     @endphp
                                @if(!empty($User) && $User->email_verified_at != '')
                                    <a class="studentVerified" style="cursor:pointer;" data-verified="{{session('statusEmail')}}" data-checkemail="{{ $User->email_verified_at }}" class="btn btn-primary">Next</a>
                                @else
                                    <a class="studentVerified" style="cursor:pointer;" data-verified="{{session('statusEmail')}}"  data-checkemail="" class="btn btn-primary">Next</a>
                                @endif
                                {{-- <a href="{{route('viewlogin')}}" style="cursor:pointer;" class="btn btn-primary">Next</a> --}}
                                
                            </div>
                            {{-- @endif --}}
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- RESEND LINK Pop-up --}}
<!-- Modal -->
<div class="modal fade" id="resendLinkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
               <h5>We have successfully resent the email verification link to your email ID: [email@example.com].</h5> 
               <h5>Thank you! </h5>
               <div>
                <button type="button" class="btn btn-primary float-end" data-bs-dismiss="modal">Okay</button>
               </div>
            </div>

        </div>
    </div>
</div>



@endsection