@extends('frontend.master')
@section('content')

<style>
    .sidenav.navbar .navbar-nav .sp-6>.nav-link {
    color: #2b3990 !important;
    background-color:rgb(235 233 255);
    }
</style>


<main>
    <section class="pt-5 pb-5">
        <div class="container">
          @include('frontend.student.layout.student-common')

            <!-- User info -->
            {{-- <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    @include('frontend.student.layout.student-profile-top-menu')
                </div>
            </div> --}}
            <!-- Content -->
            {{-- <div class="row mt-0 mt-md-4"> --}}
                {{-- <div class="col-lg-3 col-md-4 col-12">
                     @include('frontend.student.layout.student-profile-left-menu')
                </div> --}}


                <div class="col-lg-9 col-md-8 col-12">
                  <!-- Card -->
                  <div class="card">
                      <!-- Card header -->
                      <div class="card-header">
                          <h3 class="mb-0">Deactivate your account</h3>
                          <p class="mb-0">Deactivate your account permanently.</p>
                      </div>
                      <!-- Card body -->
                      <div class="card-body p-4">
                          <span class="text-danger h4"> <i class="bi bi-exclamation-triangle"></i> Warning</span>
                            @php
                            // $studentCourseMaster = DB::table('student_course_master')->where('user_id',Auth::id())->where(function ($query) {
                            //     $query->where('course_expired_on', '>', now())
                            //         ->orWhere('exam_attempt_remain', '>', 0);
                            // })->count();
                            @endphp
                            <p class="mb-3">If you deactivate your account, you will be unsubscribed from all your courses, and will lose access forever.</p>
                            <input type="hidden" name="user_id" id="user_id" value="{{base64_encode(auth()->user()->id)}}">
                            <button class="btn btn-danger closeAccount">Deactivate Account</a>
                            {{-- @endif --}}
                      </div>
                  </div>
              </div>
            {{-- </div> --}}
        </div>
    </section>
</main>
@endsection