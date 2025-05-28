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
            @include('frontend.institute.layout.institute-common')

            <!-- Content -->

            {{-- <div class="row mt-0 mt-md-4"> --}}

                {{-- Left menubar  --}}
                
                {{-- @include('frontend.teacher.layout.e-mentor-left-menu') --}}

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
                            {{-- @php echo '<pre>'; print_r($instituteData[0]->user['name']); die; @endphp --}}
                            <div>
                                <h4 class="mb-0">Personal Details</h4>
                                <p class="mb-4">Edit your personal information and address.</p>
                                <!-- Form -->
                                <form class="row gx-3 instituteProfileData" novalidate="">
                                    <!-- Selection -->
                                    
                                    <input type="hidden" id="institute_id" class="form-control" name="institute_id" required
                                        value="{{ isset($instituteData[0]->user['id']) ? base64_encode($instituteData[0]->user['id']) : '' }}">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="university_name">Institute Name <span class="text-danger">*</span></label>
                                            <input type="text" id="university_name" class="form-control" name="university_name" required
                                                placeholder="University Name"
                                                value="{{ isset($instituteData[0]->user['name']) ? $instituteData[0]->user['name'] : '' }}">
                                            <div class="invalid-feedback" id="first_name_error">Please enter university name.</div>
                                        </div>
                        
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="website">Website <span class="text-danger">*</span></label>
                                            <input type="text" id="website" class="form-control" name="website" required
                                                placeholder="Website"
                                                value="{{ isset($instituteData[0]->website) ? $instituteData[0]->website : '' }}">
                                            <div class="invalid-feedback"  id="website_error">Please enter website.</div>
                                        </div>
                                    </div>
                                    <!-- Address Information -->
                                    <h5 class="mb-3 text-primary"><b>Address Details:</b></h5>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="billing_city">Billing City <span class="text-danger">*</span></label>
                                            <input type="text" id="billing_city" class="form-control" name="billing_city" required
                                                placeholder="Billing City"
                                                value="{{ isset($instituteData[0]->billing_city) ? $instituteData[0]->billing_city : '' }}">
                                            <div class="invalid-feedback" id="billing_city_error">Please enter billing city.</div>
                                        </div>
                        
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="billing_state">Billing State <span class="text-danger">*</span></label>
                                            <input type="text" id="billing_state" class="form-control" name="billing_state" required
                                                placeholder="Billing State"
                                                value="{{ isset($instituteData[0]->billing_state) ? $instituteData[0]->billing_state : '' }}">
                                            <div class="invalid-feedback" id="billing_state_error">Please enter billing state.</div>
                                        </div>
                                        
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="billing_country">Billing Country <span class="text-danger">*</span></label>
                                            <select name="billing_country" id="billing_country" class="form-control">
                                                <option value="" selected>-Select-</option>
                                                @foreach (getDropDownlist('country_master', ['id', 'country_code', 'country_flag', 'country_name']) as $mob_code)
                                                    <option value="{{ $mob_code->country_name }}"
                                                        {{ old('billing_country', trim($instituteData[0]->billing_country)) == trim($mob_code->country_name) ? 'selected' : '' }}
                                                        >
                                                        {{ $mob_code->country_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback" id="billing_country_error">Please enter billing country.</div>
                                        </div>

                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="textarea-input" class="form-label">Address <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="textarea-input" name="address" rows="2" placeholder="Enter your address here...">{{isset($instituteData[0]->address) ? $instituteData[0]->address : '' }}</textarea> 
                                            <div class="invalid-feedback" id="address_error">Address should be less than 100 words.</div>
                                            <small>Address max 100 words</small>
                                        </div>
                                    </div>
                                    <!-- Institute Contact Information -->
                                    <h5 class="mb-3 text-primary"><b>Contact Details:</b></h5>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="contact_person_name">Name <span class="text-danger">*</span></label>
                                            <input type="text" id="contact_person_name" class="form-control" name="contact_person_name" required
                                                placeholder="Contact Person Name"
                                                value="{{ isset($instituteData[0]->contact_person_name) ? $instituteData[0]->contact_person_name : '' }}">
                                            <div class="invalid-feedback" id="contact_person_name_error">Please enter name.</div>
                                        </div>
                        
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="contact_person_email">Email <span class="text-danger">*</span></label>
                                            <input type="email" id="contact_person_email" class="form-control" name="contact_person_email"
                                                placeholder="Email"
                                                value="{{ isset($instituteData[0]->contact_person_email) ? $instituteData[0]->contact_person_email : '' }}">
                                            <div class="invalid-feedback"  id="contact_person_email_error">Please enter email.</div>
                                        </div>
                        
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Mobile No. <span class="text-danger">*</span></label>
                                            <div class="d-flex gap-2">
                                                <!-- Country Code -->
                                                <select name="contact_person_mob_code" id="contact_person_mob_code" class="form-select w-25">
                                                    <option value="" selected>Choose Code</option>
                                                    @foreach (getDropDownlist('country_master', ['id', 'country_code', 'country_flag', 'country_name']) as $mob_code)
                                                        <option value="+{{ $mob_code->country_code }}"
                                                            {{ old('contact_person_mob_code', $instituteData[0]->contact_person_mob_code) == "+$mob_code->country_code" ? 'selected' : '' }}>
                                                            +{{ $mob_code->country_code }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input type="number" id="contact_person_mobile" class="form-control" name="contact_person_mobile" required
                                                    placeholder="123 4567 890"
                                                    value="{{ isset($instituteData[0]->contact_person_mobile) ? $instituteData[0]->contact_person_mobile : '' }}">
                                            </div>
                                            <div class="invalid-feedback" id="contact_person_mob_code_error">Please enter Mobile code.</div>
                                            <div class="invalid-feedback" id="contact_person_mobile_error">Please enter Mobile no.</div>
                                        </div>
                        
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="contact_person_designation">Designation <span class="text-danger">*</span></label>
                                            <input type="text" id="contact_person_designation" class="form-control" name="contact_person_designation"
                                                placeholder="Designation"
                                                value="{{ isset($instituteData[0]->contact_person_designation) ? $instituteData[0]->contact_person_designation : '' }}">
                                            <div class="invalid-feedback" id="contact_person_designation_error">Please enter designation.</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php
                                            $is_approved = DB::table('institute_profile_master')->where('institute_id', Auth::user()->id)->first()->is_approved;
                                        @endphp
                                        
                                        <!-- Photo ID -->
                                        <div class="mb-3 col-12 col-md-6">
                                            <label class="form-label">Photo ID <span class="text-danger">*</span></label>
                                            
                                            @if(isset($instituteData[0]->photo_id) && !empty($instituteData[0]->photo_id))
                                                <div class="mb-2">
                                                    <a href="{{ Storage::url($instituteData[0]->photo_id) }}" target="_blank" class="btn btn-primary">View Photo ID</a>
                                                </div>
                                            @else
                                                <p>No Photo ID available</p>
                                            @endif
                                            
                                            @if($is_approved == 4)
                                                <!-- File Upload Input -->
                                                <input type="file" name="photo_id" class="form-control" accept=".jpg, .jpeg, .png">
                                                <small class="text-muted">Upload JPG/JPEG/PNG (Max: 2MB)</small>
                                                
                                                @if ($errors->has('photo_id'))
                                                    <div class="text-danger">{{ $errors->first('photo_id') }}</div>
                                                @endif
                                            @endif
                                        </div>
                                    
                                        <!-- License -->
                                        <div class="mb-3 col-12 col-md-6">
                                            <label class="form-label">License <span class="text-danger">*</span></label>
                                            
                                            @if(isset($instituteData[0]->licence) && !empty($instituteData[0]->licence))
                                                <div class="mb-2">
                                                    <a href="{{ Storage::url($instituteData[0]->licence) }}" target="_blank" class="btn btn-primary">View License</a>
                                                </div>
                                            @else
                                                <p>No License available</p>
                                            @endif
                                            
                                            @if($is_approved == 4)
                                                <!-- File Upload Input -->
                                                <input type="file" name="licence" class="form-control" accept=".jpg, .jpeg, .png">
                                                <small class="text-muted">Upload JPG/JPEG/PNG (Max: 2MB)</small>
                                            
                                                @if ($errors->has('licence'))
                                                    <div class="text-danger">{{ $errors->first('licence') }}</div>
                                                @endif
                                            @endif
                                        </div>
                                        
                                        <!-- Reject Reason -->
                                        @if($is_approved == 2)
                                            <div class="mb-3 col-12 col-md-6">
                                                <label for="textarea-input" class="form-label">Reject Reason</label>
                                                <textarea class="form-control" id="textarea-input" name="reject_reason" rows="2" disabled>{{isset($instituteData[0]->reject_reason) ? $instituteData[0]->reject_reason : '' }}</textarea>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    
                                    <!-- Submit button -->
                                    
                                    @if($is_approved == 4)
                                        <div class="col-12">
                                            <button class="btn btn-primary updateInstituteProfile" type="submit">Update Profile</button>
                                        </div>
                                    @endif

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
