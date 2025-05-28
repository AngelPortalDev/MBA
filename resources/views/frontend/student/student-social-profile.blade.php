@extends('frontend.master')
@section('content')
<style>
    .sidenav.navbar .navbar-nav .sp-2>.nav-link {
    color: #2b3990 !important;
    background-color:rgb(235 233 255);
    }
</style>


<main>
    <section class="pt-5 pb-5">
        <div class="container">
            <!-- User info -->
               @include('frontend.student.layout.student-common')
                <div class="col-lg-9 col-md-8 col-12">
                    <!-- Card -->
                    <div class="card">
                      <!-- Card header -->
                      <div class="card-header">
                        <h3 class="mb-0">Social Profile</h3>
                        <p class="mb-0">Add your social profile links in below social accounts.</p>
                      </div>
                      <!-- Card body -->
                      <form class="socialProfileForm">
                      <div class="card-body">
                        <!-- Facebook -->
                        <div class="row mb-5">
                          <div class="col-lg-2 col-md-4 col-12">
                            <h5>Facebook</h5>
                          </div>
                          <div class="col-lg-10 col-md-8 col-12">
                            <input type="url" class="form-control mb-1 facebook" value="{{isset($studentData->facebook) ? $studentData->facebook : '' }}" name="facebook" placeholder="https://www.facebook.com/">
                             <div class="invalid-feedback facebook_error d-block text-dark">Add your facebook profile url.</div>
                          </div>
                        </div>
                        <!-- Instagram -->
                        <div class="row mb-5">
                          <div class="col-lg-2 col-md-4 col-12">
                            <h5>Instagram</h5>
                          </div>
                          <div class="col-lg-10 col-md-8 col-12">
                            <input type="url" class="form-control mb-1 insta" value="{{isset($studentData->instagram) ? $studentData->instagram : '' }}" name="insta" placeholder="https://www.instagram.com/">
                            <div class="invalid-feedback insta_error d-block text-dark">Add your instagram profile url.</div>
                          </div>
                        </div>
                        <!-- Linked in -->
                        <div class="row mb-5">
                          <div class="col-lg-2 col-md-4 col-12">
                            <h5>LinkedIn</h5>
                          </div>
                          <div class="col-lg-10 col-md-8 col-12">
                            <input type="url" class="form-control mb-1 linkedin" value="{{isset($studentData->linkedIn) ? $studentData->linkedIn : '' }}" name="linkedin" placeholder="https://www.linkedin.com/">
                            <div class="invalid-feedback linkedin_error d-block text-dark" >Add your linkedin profile url.</div>
                          </div>
                        </div>
                        <!-- twitter -->
                        <div class="row mb-3">
                          <div class="col-lg-2 col-md-4 col-12">
                            <h5>X (Twitter)</h5>
                          </div>
                          <div class="col-lg-10 col-md-8 col-12">
                            <input type="url" class="form-control mb-1 twitter" value="{{isset($studentData->twitter) ? $studentData->twitter : '' }}" name="twitter" placeholder="https://twitter.com/">
                            <div class="invalid-feedback twitter_error d-block text-dark">Add your x (twitter) profile url.</div>
                          </div>
                        </div>
                        <!-- WhatsApp -->
                        <div class="row mb-3">
                          <div class="col-lg-2 col-md-4 col-12">
                            <h5>WhatsApp</h5>
                          </div>
                          <div class="col-lg-10 col-md-8 col-12">
                            <input type="url" class="form-control mb-1 whatsapp" value="{{isset($studentData->whatsapp) ? $studentData->whatsapp : '' }}" name="whatsapp" placeholder="https://whatsapp.com/">
                            <div class="invalid-feedback whatsapp_error d-block text-dark">Add your whatsapp profile url.</div>
                          </div>
                        </div>
                        <!-- Button -->
                        <div class="row">
                          <div class="offset-lg-2 col-lg-6 col-12">
                            <a href="#" class="btn btn-primary updateSocialProfile">Save Social Profile</a>
                          </div>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
            </div>
        </div>
    </section>
</main>


@endsection