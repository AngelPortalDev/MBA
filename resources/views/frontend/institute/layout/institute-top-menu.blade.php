<style>
    
</style>

<div class="row align-items-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <!-- Bg -->
        {{-- <div class="rounded-top" style="background-image:url({{ asset('frontend/images/background/profile-bg.jpg') }}); no-repeat; background-size: cover; height: 100px; position:relative">
            <div class="e-mentor-cover-photo-edit-pencil-icon">
                <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg">
                <label for="imageUpload"><i class="bi-pencil"></i></label>
            </div>
        </div> --}}

        <div class="card px-4 pt-2 pb-4 shadow-sm rounded-0 d-flex flex-lg-row flex-column justify-content-between align-items-center">
            <div class="d-flex flex-column flex-md-row">
                <!-- Profile Image and Background -->
                <div class="d-flex flex-wrap align-items-center">
                    <div class="me-2 position-relative d-flex justify-content-end align-items-end mt-n5">
                        <form class="proflilImage" enctype="multipart/form-data" method="post">
                            
                            @if (!empty($instituteData[0]->user->photo))
                                <img class="avatar-xl rounded-circle border border-4 border-white imageAdminPreview object-fit-cover"
                                    src="{{ Storage::url($instituteData[0]->user->photo) }}">
                            @elseif(!empty($instituteData[0]->logo))
                                <img class="avatar-xl rounded-circle border border-4 border-white imageAdminPreview object-fit-cover"
                                    src="{{ Storage::url($instituteData[0]->logo) }}">
                            @else
                                <img src="{{asset('frontend/images/colleges/Institute.jpg')}}"
                                    class="avatar-xl rounded-circle border border-4 border-white imagePreview"
                                    alt="avatar" />
                            @endif
                            <div class="student-cover-photo-edit-pencil-icon">
                                <input type="file" id="imageUpload_back" class="image profilePic" name="image_file" accept=".png, .jpg, .jpeg">
                                <input type="text" value="{{base64_encode('PROFILE')}}" name="cat" hidden>
                                <input type="text" class='curr_img' value="{{ isset($file_name[0]->photo) ? $file_name[0]->photo : ''  }}" name='old_img_name' hidden>
                                <label for="imageUpload_back"><i class="bi-pencil"></i></label>
                            </div>
                        </form>
                    </div>
                </div>
        
                <!-- Profile Info Section -->
                <div class="lh-1">
                    <h2 class="mb-0">{{  isset($instituteData[0]->user->name) ? $instituteData[0]->user->name : 'NA'}}</h2>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fe fe-mail fs-4"></i>
                        <a class="ms-1">{{  isset($instituteData[0]->user->email) ? $instituteData[0]->user->email : 'NA'}}</a>
                    </div>
                </div>
            </div>
        
            <!-- University Code Section -->
            @php
                $is_approved = DB::table('institute_profile_master')->where('institute_id', Auth::user()->id)->first()->is_approved;
            @endphp
            @if($is_approved == 1)
                <div class="mt-3">
                    <div class="d-flex flex-column flex-md-row p-3">
                        <div class="p-3 me-md-4 mb-2 mb-md-0" style="background-color: #c7f8ff; border-radius: 8px">
                            <h4 class="mb-0 text-capitalize">
                                <span class="text-uppercase">Institute Code :</span> 
                                <span class="fw-bold" style="letter-spacing: 1px">
                                    {{ isset($instituteData[0]->university_code) ? $instituteData[0]->university_code : 'NA' }}
                                </span>
                            </h4>
                        </div>
                        <div class="p-3 ms-md-4" style="background-color: #c7f8ff; border-radius: 8px">
                            <h4 class="mb-0 text-capitalize">
                                <span class="text-uppercase">English Test Code :</span> 
                                <span class="fw-bold" style="letter-spacing: 1px">
                                    {{ isset($instituteData[0]->englist_test_pass_code) ? $instituteData[0]->englist_test_pass_code : 'NA' }}
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        {{-- <div class="card">
                    <div>
                        <h3>Hello Ashish</h3>
                        <a href="mailto:ashish@gmail.com">ashish@gmail.com</a>
                    </div>
                   <div>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-secondary me-2">University Code:</span>
                        <span class="fs-5 fw-bold text-dark">UNIV10012</span> 
                   </div>
                </div>

            </div>
        </div> --}}
    </div>
</div>
