@extends('frontend.master')
@section('content')

<style>
    .sidenav.navbar .navbar-nav .e-men-6 > .nav-link {
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
                    <!-- Card -->
                    <div class="card">
                      <!-- Card header -->
                      <div class="card-header">
                        <h3 class="mb-0">Social Profiles</h3>
                        <p class="mb-0">Add your social profile links in below social accounts.</p>
                      </div>
                      <form class="socialProfileForm">
                      <!-- Card body -->
                        <div class="card-body">
                          <div class="row mb-5">
                            <!-- Twitter -->
                            <div class="col-lg-3 col-md-4 col-12">
                              <h5>Twitter</h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-12">
                              <input type="text" class="form-control mb-1" value="{{isset($ementorData[0]->twitter) ? $ementorData[0]->twitter : '' }}" name="twitter" placeholder="https://www.twitter.com">
                              <small class="text-dark">Add your twitter username (e.g. johnsmith).</small>
                            </div>
                          </div>
                          <!-- Facebook -->
                          <div class="row mb-5">
                            <div class="col-lg-3 col-md-4 col-12">
                              <h5>Facebook</h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-12">
                              <input type="text" class="form-control mb-1" value="{{isset($ementorData[0]->facebook) ? $ementorData[0]->facebook : '' }}" name="facebook" placeholder="https://www.facebook.com"> 
                              <div class="invalid-feedback facebook_error d-block text-dark">Add your facebook profile url.</div>

                            </div>
                          </div>
                          <!-- Instagram -->
                          <div class="row mb-5">
                            <div class="col-lg-3 col-md-4 col-12">
                              <h5>Instagram</h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-12">
                              <input type="text" class="form-control mb-1" value="{{isset($ementorData[0]->instagram) ? $ementorData[0]->instagram : '' }}" name="instagram" placeholder="https://www.instagram.com">
                              <div class="invalid-feedback facebook_error d-block text-dark">Add your instagram profile url.</div>
                            </div>
                          </div>
                          <!-- Linked in -->
                          <div class="row mb-5">
                            <div class="col-lg-3 col-md-4 col-12">
                              <h5>LinkedIn Profile URL</h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-12">
                              <input type="text" class="form-control mb-1" value="{{isset($ementorData[0]->linkedIn) ? $ementorData[0]->linkedIn : '' }}" name="linkedin" placeholder="https://www.linkedin.com/">
                              <div class="invalid-feedback facebook_error d-block text-dark">Add your linkedln profile url.</div>
                            </div>
                          </div>
                          <!-- Youtube -->
                          <div class="row mb-3">
                            <div class="col-lg-3 col-md-4 col-12">
                              <h5>YouTube</h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-12">
                              <input type="text" class="form-control mb-1 text-dark" value="{{isset($ementorData[0]->youtube) ? $ementorData[0]->youtube : '' }}" name="youtube" placeholder="https://www.youtube.com/">
                              <small class="text-dark">Add your youtube profile url.</small>
                            </div>
                          </div>
                          <!-- Button -->
                          <div class="row">
                            <div class="offset-lg-3 col-lg-6 col-12">
                              <a href="#" class="btn btn-primary updateSocialProfile">Save Social Profile</a>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
            {{-- </div> --}}
        </div>
    </section>
</main>

@endsection