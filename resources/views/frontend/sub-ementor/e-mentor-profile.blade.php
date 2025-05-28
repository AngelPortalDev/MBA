@extends('frontend.master')
@section('content')

<style>
    .sidenav.navbar .navbar-nav .e-men-4 > .nav-link {
    background-color: var(--gk-gray-200);
}
</style>


<main>
    <section class="pt-5 pb-5">
        <div class="container">
            
            <!-- Top Menubar -->
            @include('frontend.teacher.layout.e-mentor-common')

            <!-- Content -->

            {{-- <div class="row mt-0 mt-md-4">

                {{-- Left menubar  --}}
                
      

                <div class="col-lg-9 col-md-8 col-12">
                    <!-- Card -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">Profile Details</h3>
                            <p class="mb-0">You have full control to manage your own account setting.</p>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">

                            <div>
                                {{-- <h4 class="mb-0">Personal Details</h4>
                                <p class="mb-4">Edit your personal information and address.</p> --}}
                                <!-- Form -->
                              @if($ementorData[0]->specialization != '')
                              <fieldset id="personalInfoFieldset">
                              @endif
                                <form class="row ementorProfileData" enctype="multipart/form-data">
                                    <!-- Selection -->

                                    <!-- First name -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="fname">First Name <span class="text-danger">*</span></label>
                                        <input type="text" id="fname" class="form-control" placeholder="First Name" name="first_name" value="{{isset($ementorData[0]->user['name']) ? $ementorData[0]->user['name'] : '' }}" required="">
                                        <div class="invalid-feedback" id="first_name_error" style="display: none;">Please enter your first name.</div>
                                    </div>
                                    <!-- Last name -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="lname">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" id="lname" class="form-control" placeholder="Last Name" name="last_name" value="{{isset($ementorData[0]->user['last_name']) ? $ementorData[0]->user['last_name'] : '' }}" required="">
                                        <div class="invalid-feedback" id="last_name_error" style="display: none;">Please enter your last name.</div>
                                    </div>

                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="mobile" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                                        <div class="mobile-with-country-code">
                                            <select class="form-select" name="mob_code" aria-label="Default select example" disabled >
                                                @foreach (getDropDownlist('country_master',['id','country_code']) as $mob_code)
                                                @if(!empty($ementorData[0]->user))

                                                <option value="+{{$mob_code->country_code}}"  @if('+'.$mob_code->country_code == $ementorData[0]->user['mob_code']) selected @endif> +{{$mob_code->country_code}} </option>

                                                @else

                                                <option value="+{{$mob_code->country_code}}"> +{{$mob_code->country_code}} </option>

                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback" id="mob_code_error">Please choose Country Code.</div>
                                            <input type="number" id="mobile" class="form-control" name="mobile" value="{{isset($ementorData[0]->user['phone']) ? $ementorData[0]->user['phone'] : '' }}"
                                                placeholder="123 4567 890" disabled  required>
                                        </div>
                                        <div class="invalid-feedback" id="mobile_error">Please enter Mobile.</div>
                                    </div>

                                    <!-- DOB -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="birth">Date of Birth <span class="text-danger">*</span></label>
                                        <input class="form-control flatpickr flatpickr-input" type="date" placeholder="Date of Birth" id="birth" name="dob"  value="{{isset($ementorData[0]->dob) ? $ementorData[0]->dob : '' }}" required="">
                                        <div class="invalid-feedback" id="dob_error">Please choose a date.</div>
                                    </div>

                                    <!-- Gender -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="editState">Gender <span class="text-danger">*</span></label>
                                        <select class="form-select" id="gender" required="" name="gender">
                                            <option value="{{isset($ementorData[0]->gender) ? $ementorData[0]->gender : '' }}">{{isset($ementorData[0]->gender) ? $ementorData[0]->gender : 'Select' }}</option>
                                            @if (!empty($ementorData[0]->gender) && $ementorData[0]->gender === 'Male')
                                            <option value="Female">Female</option>
                                            @elseif(!empty($ementorData[0]->gender) && $ementorData[0]->gender === 'Female')
                                                 <option value="Male">Male</option>
                                            @else
                                                  <option value="Female">Female</option>
                                                <option value="Male">Male</option>
                                            @endif
                                        </select>
                                        <div class="invalid-feedback" id="gender_error">Please choose gender.</div>
                                    </div>

                                    <!-- Country -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="editState">Country <span class="text-danger">*</span></label>
                                        <select class="form-select" id="country" name="country_id" required="">
                                            <option value="">Select</option>  
                                            @foreach (getDropDownlist('country_master', ['id','country_name']) as $country)
                                                @if(!empty($ementorData[0]->country_id))

                                                <option value="{{ $country->id}}" @if($country->id == $ementorData[0]->country_id) selected @endif>{{ $country->country_name}}</option>

                                                @else

                                                <option value="{{$country->id}}">{{$country->country_name}} </option>

                                                @endif
                                            @endforeach 

                                        </select>
                                        <div class="invalid-feedback" id="country_error">Please choose country.</div>
                                    </div>
                                    
                                    <!-- Nationality -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="Nationality">Nationality <span class="text-danger">*</span></label>
                                        <input type="text" id="nationality" class="form-control" placeholder="Nationality" name="nationality" value="{{isset($ementorData[0]->nationality) ? $ementorData[0]->nationality : '' }}" required="">
                                        <div class="invalid-feedback" id="nationality_error">Please enter nationality.</div>
                                    </div>

                                    <!-- Address -->
                                    <div class="mb-6 col-12 col-md-12">
                                        <label for="textarea-input" class="form-label">Address <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter your address here...">{{isset($ementorData[0]->address) ? $ementorData[0]->address : '' }}</textarea> 
                                        <div class="invalid-feedback" id="address_error">Please enter address.</div>  

                                    </div>

                                    <hr>

                                    
                                    <h4 class="mb-0">Education Details</h4>
                                    <p class="mb-4">Enter your Higher Education Details</p>


                                    <!-- Gender -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="">Select Higher Education <span class="text-danger">*</span></label>
                                        @php $educationSelected = isset($ementorData[0]->highest_education) ? $ementorData[0]->highest_education : '' ; @endphp
                                        <select class="form-select" id="highest_education" required="" name="highest_education">
                                            <option value="">Select</option>
                                            <option value="Bachelor" <?= $educationSelected == "Bachelor" ? "selected" : "" ?>>Bachelor</option>
                                            <option value="Master" <?= $educationSelected == "Master" ? "selected" : "" ?>>Master</option>
                                            <option value="PhD" <?= $educationSelected == "PhD" ? "selected" : "" ?>>PhD</option>

                                        </select>
                                        <div class="invalid-feedback">Please choose Higher Education Type</div>
                                        <div class="invalid-feedback" id="highest_education_error" style="display: none;">Please choose higher education type.</div>
                                    </div>

                                    <!-- Specialization -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="specialization">Specialization <span class="text-danger">*</span></label>
                                        <input type="text" id="specialization" class="form-control" placeholder="Specialization" name="specialization" value="{{isset($ementorData[0]->specialization) ? $ementorData[0]->specialization : '' }}" required="">
                                        {{-- <select class="form-select" id="specialization" required="" name="specialization">
                                        @php $specializationSelected = isset($ementorData[0]->specialization) ? $ementorData[0]->specialization : '' ; @endphp

                                            <option value="">Select</option>
                                            <option value="Bsc" <?= $specializationSelected == "Bsc" ? "selected" : "" ?>>Bsc</option>
                                            <option value="Bcom" <?= $specializationSelected == "Bcom" ? "selected" : "" ?>>Bcom</option>
                                            <option value="MA" <?= $specializationSelected == "MA" ? "selected" : "" ?>>MA</option>
                                            <option value="Msc" <?= $specializationSelected == "Msc" ? "selected" : "" ?>>Msc</option>
                                            <option value="Others" <?= $specializationSelected == "Others" ? "selected" : "" ?>>Others</option>

                                        </select> --}}
                                        <div class="invalid-feedback">Please choose specialization.</div>
                                        <div class="invalid-feedback" id="specialization_error" style="display: none;">Please choose specialization.</div>
                                    </div>

                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="institution_name">Institution Name <span class="text-danger">*</span></label>
                                        <input type="text" id="institution_name" name="institution_name" class="form-control" placeholder="Institution Name" value="{{isset($ementorData[0]->institution_name) ? $ementorData[0]->institution_name : '' }}" required=''>
                                        <div class="invalid-feedback">Please enter Institution Name.</div>
                                        <div class="invalid-feedback" id="institution_name_error" style="display: none;">Please enter institution name.</div>
                                    </div>

                                    <!-- Resume  -->
                                    <div class=" col-12 col-md-12">
                                        <div class="mb-6">
                                            <label class="form-label">Upload Resume <span class="text-danger">*</span></label>
                                            <div class="custom-file-container mb-2">
                                                <label class="input-container">
                                                    <input accept=".pdf,.xls,.xlsx,.doc,.docx"  name="ementor_resume" aria-label="Choose File" class="form-control ementor_resume" id="ementor_resume" type="file" draggable="false" required>
                                                    <span class="input-visible">{{ isset($ementorData[0]->resume_file_name) ? $ementorData[0]->resume_file_name : 'Choose file...' }} <span class="browse-button">Upload</span></span>
                                                </label>
                                                <div class="invalid-feedback" id="journal_file_error">Please upload file.</div>
                                                <div class="invalid-feedback" id="ementor_resume_error">Please upload resume.</div>
                                            </div>
                                            {{-- <div class="invalid-feedback" id="ementor_resume_error">Please upload resume.</div> --}}
                                        </div>
                                        <input type="hidden" class="form-control" id="old_resume_file" name="old_resume_file" value="{{isset($ementorData[0]->upload_resume) ? $ementorData[0]->upload_resume : '' }}">
                                        <div class="invalid-feedback">Please upload resume.</div>
                                    </div>

                                    <div class="col-12">
                                        <!-- Button -->
                                        <button class="btn btn-primary updateEmentorProfile" type="button">Save</button>
                                    </div>
                                </form>
                              {{-- </fieldset> --}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card">
                      <!-- Card header -->
                      <div class="card-header">
                        <h3 class="mb-0">Social Profiles</h3>
                        <p class="mb-0">Add your social profile links in below social accounts.</p>
                      </div>
                      <form class="socialProfileForm">
                      <!-- Card body -->
                        <div class="card-body">
                            
                            <!-- WhatsApp -->
                            {{-- <div class="row mb-3">
                                <div class="col-lg-2 col-md-4 col-12">
                                  <h5>WhatsApp No.</h5>
                                </div> --}}
                                {{-- <div class="col-lg-10 col-md-8 col-12">
                                  <input type="number" class="form-control mb-1 whatsapp" min="10" max="15" value="{{isset($studentData->whatsapp) ? $studentData->whatsapp : '' }}" name="whatsapp" placeholder="https://www.whatsapp.com/">
                                  <div class="invalid-feedback whatsapp_error d-block text-dark">Add your whatsapp number.</div>
                                </div> --}}
                                {{-- <div class="col-lg-10 col-md-8 col-12">
                                 
                                  <input type="url" class="form-control mb-1 whatsapp" value="{{isset($ementorData[0]->whatsapp) ? $ementorData[0]->whatsapp : (isset($ementorData[0]->user['phone']) ? $ementorData[0]->user['mob_code'] . $ementorData[0]->user['phone'] : '') }}" name="whatsapp" placeholder="Enter your whatsapp number">
                                  <div class="invalid-feedback whatsapp_error d-block text-dark">Add a valid whatsapp number.</div>
                                </div>
  
                              </div>
                            <!-- Facebook -->
                            <div class="row mb-3">
                              <div class="col-lg-2 col-md-4 col-12">
                                <h5>Facebook</h5>
                              </div>
                              <div class="col-lg-10 col-md-8 col-12">
                                <input type="url" class="form-control mb-1 facebook" value="{{isset($ementorData[0]->facebook) ? $ementorData[0]->facebook : '' }}" name="facebook" placeholder="https://www.facebook.com/">
                                 <div class="invalid-feedback facebook_error d-block text-dark">Add your facebook profile url.</div>
                              </div>
                            </div>
                            <!-- Instagram -->
                            <div class="row mb-5">
                              <div class="col-lg-2 col-md-4 col-12">
                                <h5>Instagram</h5>
                              </div>
                              <div class="col-lg-10 col-md-8 col-12">
                                <input type="url" class="form-control mb-1 insta" value="{{isset($ementorData[0]->instagram) ? $ementorData[0]->instagram : '' }}" name="insta" placeholder="https://www.instagram.com/">
                                <div class="invalid-feedback insta_error d-block text-dark">Add your instagram profile url.</div>
                              </div>
                            </div> --}}

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




                          {{-- <div class="row mb-5">
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
                          </div> --}}
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
       
        </div>
    </section>
</main>
<script>
    $(document).ready(function() {
        $('#personalInfoFieldset').prop('disabled', true);
    });
</script>

@endsection
