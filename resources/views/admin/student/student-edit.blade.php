<!-- Header import -->
@extends('admin.layouts.main')
@section('content')
<style>
    .buy-now {
        background: none;
        border: none;
        color: blue;
        cursor: pointer;
        font-family: serif;
    }
    .buy-now:focus {
        outline: none;
    }
    .buy-now:active {
        color:red;
    }
</style>
    <!-- Container fluid -->
    <section class="container p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom d-md-flex align-items-center justify-content-between ">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-0 h2 fw-bold">Edit Student</h1>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.students') }}">Student List</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Student </li>
                            </ol>
                        </nav>
                    </div>
                    <!-- button -->
                    <div>
                        <a href="{{ route('admin.students') }}" class="btn btn-primary me-2">Back</a>
                    </div>
                </div>


            </div>
        </div>
    </section>


    <section class="py-4 container pt-0 my-learning-page">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <!-- card -->
                    <div class="card mb-1">
                        <!-- card body -->
                        <div class="card-body">

                            <div class="d-flex align-items-center">
                                <!-- img -->
                                <form class="proflilImage position-relative" enctype="multipart/form-data" >
                                    @if (!empty($studentData['user']->photo))
                                        <img class="avatar-xl rounded-circle border border-4 border-white imageAdminPreview"
                                            src="{{ Storage::url($studentData['user']->photo) }}">
                                    @else
                                        <img src="{{Storage::url('studentDocs/student-profile-photo.png')}}"
                                            class="avatar-xl rounded-circle border border-4 border-white imagePreview"
                                            alt="avatar" />
                                    @endif
                                    <div class="student-profile-photo-edit-pencil-icon">

                                        <input type="file" id="imageUpload_profile"
                                            class="image profileStudentPic" name="image_file"
                                            accept=".png, .jpg, .jpeg">
                                        <input type="hidden" id="user_id"
                                            value="{{ base64_encode($studentData->user['id']) }}"
                                            name="user_id">
                                        <input type="hidden" id="user_name"
                                            value="{{ base64_encode($studentData->user['name']) }}"
                                            name="user_name">
                                        <label for="imageUpload_profile"><i class="bi-pencil"></i></label>
                                        <input type="text" class='curr_img'
                                            value="{{ isset($studentData['user']->photo) ? $studentData['user']->photo : '' }}"
                                            name='old_img_name' hidden>

                                    </div>
                                </form>

                                <div class="ms-4">
                                    <!-- text -->
                                    <h3 class="mb-1">{{$studentData['user']->name.' '.$studentData['user']->last_name}}</h3>
                                    <div>
                                        <span>
                                            <i class="fe fe-mail fs-4 align-middle"></i>
                                            <a href="mailto:{{ isset($studentData['user']->email) ? $studentData['user']->email : '' }}" class="ms-1">
                                                {{ isset($studentData['user']->email) ? $studentData['user']->email : 'No email available' }}
                                            </a>                                            
                                        </span>
                                        <span class="ms-3">
                                            <i class="fe fe-phone fs-4 align-middle"></i>
                                            {{-- <a href="tel:+123456788">
                                        <span class="ms-1">{{ isset($studentData['user']->phone) ? $studentData['user']->mob_code . ' ' . $studentData['user']->phone : '' }}</span>
                                            </a> --}}
                                            <a href="tel:{{ isset($studentData['user']->mob_code) && isset($studentData['user']->phone) ? $studentData['user']->mob_code.$studentData['user']->phone : '' }}">
                                                <span class="ms-1">
                                                    {{ isset($studentData['user']->mob_code) && isset($studentData['user']->phone) ? $studentData['user']->mob_code . ' ' . $studentData['user']->phone : 'NA' }}
                                                </span>
                                            </a>
                                            
                                        </span>
                                        @if(isset($studentData['user']->university_code) && !empty($studentData['user']->university_code))
                                        <span class="ms-3" style="color:#333faf">Code : </span> 
                                        <span class="ms-1" style="color:#333faf">
                                                {{ isset($studentData['user']->university_code) ? $studentData['user']->university_code : 'NA' }}
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                </div>
            </div>



            <!-- row -->
            <div class="row">
                <div class="col-md-12 col-12">


                    <!-- Side Navbar -->
                    <ul class="nav nav-lb-tab mb-6" id="tab" role="tablist">
                        <li class="nav-item ms-0" role="presentation">
                            <a class="nav-link active" id="student-profile-tab" data-bs-toggle="pill"
                                href="#student-profile" role="tab" aria-controls="student-profile" aria-selected="false"
                                tabindex="-1">Profile</a>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                            <a class="nav-link" id="about-tab" data-bs-toggle="pill" href="#about"
                                role="tab" aria-controls="about" aria-selected="true" tabindex="-1">
                                About
                            </a>
                        </li> --}}
                        <li class="nav-item ms-0" role="presentation">
                            <a class="nav-link" id="purchased-courses-tab" data-bs-toggle="pill" href="#purchased-courses"
                                role="tab" aria-controls="purchased-courses" aria-selected="false" tabindex="-1">Purchased Courses</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="wishlist-tab" data-bs-toggle="pill" href="#wishlist" role="tab" aria-controls="wishlist" aria-selected="true">
                                Wishlist
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="expired-courses-tab" data-bs-toggle="pill" href="#expired-courses"
                                role="tab" aria-controls="expired-courses" aria-selected="true">
                                Expired Courses
                            </a>
                        </li>
                       
                        {{-- <li class="nav-item" role="presentation">
                            <a class="nav-link" id="exam-tab" data-bs-toggle="pill" href="#exam" role="tab" aria-controls="exam" aria-selected="true">
                                Exam
                            </a>
                        </li> --}}
                    </ul>




                    <!-- Tab content -->
                        <div class="tab-content" id="tabContent">
                            <div class="tab-pane fade active show" id="student-profile" role="tabpanel" aria-labelledby="student-profile-tab">


                                <!-- card -->
                                <div class="card">

                                    <!-- Account Security -->
                                    {{-- <div class="card-header">
                                        <h3 class="mb-0">Student Profile</h3>
                                        <p class="mb-0">Edit your personal information and address.</p>
                                    </div> --}}
                                    {{-- <div class="card-body">

                                        <form class="row needs-validation" novalidate="">
                                            <div class="mb-1 col-lg-6 col-md-12 col-12">
                                                <label class="form-label" for="email">Email Address</label>
                                                <input id="email" type="email" name="email" class="form-control"
                                                    placeholder="" required=""
                                                    value="{{ isset($studentData['user']->email) ? $studentData['user']->email : '' }}"
                                                    disabled>

                                            </div>
                                            <div class="mb-1 col-lg-6 col-md-12 col-12">

                                                <label class="form-label" for="mob">Mobile Number</label>
                                                <input id="mob" type="text" name="mob_no"
                                                    value= "{{ isset($studentData['user']->phone) ? $studentData['user']->mob_code . ' ' . $studentData['user']->phone : '' }}"
                                                    class="form-control" placeholder="" required="" disabled>
                                            </div>
                                        </form>

                                    </div> --}}
                                    <!-- Public Profile Card header -->
                                    {{-- <div class="card-header">
                                        <h3 class="mb-0">Public Profile</h3>
                                    </div> --}}
                                    <!-- Card body -->

                                    <div class="card-body">
                                        {{-- <div class="d-lg-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center mb-4 mb-lg-0"> --}}

                                                {{-- @if (isset($studentData['user']->photo) && Storage::disk('local')->exists('studentDocs/UserFolder/' . $studentData['user']->photo))
                                                <img src="{{ Storage::disk('local')->url('studentDocs/UserFolder/'.$studentData['user']->photo)}}"
                                                    id="img-uploaded" class="avatar-xl rounded-circle" alt="avatar">
                                                @else
                                                <img src="{{ Storage::disk('local')->url('studentDocs/no_image_student.png')}}"
                                                    id="img-uploaded" class="avatar-xl rounded-circle" alt="avatar">
                                                @endif --}}

                                                {{-- <div class="me-2 position-relative">
                                                    <form class="proflilImage" enctype="multipart/form-data">
                                                        @if (!empty($studentData['user']->photo))
                                                            <img class="avatar-xl rounded-circle border border-4 border-white imageAdminPreview"
                                                                src="{{ Storage::url($studentData['user']->photo) }}">
                                                        @else
                                                            <img src="{{ asset('admin/images/avatar/avatar-2.jpg') }}"
                                                                class="avatar-xl rounded-circle border border-4 border-white imagePreview"
                                                                alt="avatar" />
                                                        @endif
                                                        <div class="student-profile-photo-edit-pencil-icon">

                                                            <input type="file" id="imageUpload_profile"
                                                                class="image profileStudentPic" name="image_file"
                                                                accept=".png, .jpg, .jpeg">
                                                            <input type="hidden" id="user_id"
                                                                value="{{ base64_encode($studentData->user['id']) }}"
                                                                name="user_id">
                                                            <input type="hidden" id="user_name"
                                                                value="{{ base64_encode($studentData->user['name']) }}"
                                                                name="user_name">
                                                            <label for="imageUpload_profile"><i class="bi-pencil"></i></label>
                                                            <input type="text" class='curr_img'
                                                                value="{{ isset($studentData['user']->photo) ? $studentData['user']->photo : '' }}"
                                                                name='old_img_name' hidden>

                                                        </div>
                                                    </form>

                                                </div> --}}

                                                {{-- <div class="ms-3">
                                                    <h4 class="mb-0">Profile Photo</h4>
                                                    <p class="mb-0">PNG or JPG no bigger than 800px wide and tall.</p>
                                                </div> --}}
                                            {{-- </div> --}}
                                            {{-- <div>
                                                <a href="#" class="btn btn-outline-secondary btn-sm">Update</a>
                                                <a href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                                            </div> --}}
                                        {{-- </div> --}}
                                        {{-- <hr class="my-5"> --}}
                                        <div>
                                            <h3 class="mb-0">Personal Details</h3>
                                            <p class="mb-4">Edit your personal information and address.</p>
                                            <!-- Form -->

                                            <form class="row gx-3 needs-validation ProfileData" novalidate="">
                                                <!-- Selection -->
                                                <div class="mb-3 col-12 col-md-6">
                                                    <label class="form-label" for="occupation">Are you?</label>
                                                    <select class="form-select" id="occupation" name="occupation" required>
                                                        <option value="" {{ empty($studentData->occupation) ? 'selected' : '' }}>Select</option>
                                                        <option value="Student" {{ isset($studentData->occupation) && $studentData->occupation === 'Student' ? 'selected' : '' }}>Student</option>
                                                        <option value="Employed" {{ isset($studentData->occupation) && $studentData->occupation === 'Employed' ? 'selected' : '' }}>Employed</option>
                                                        <option value="Unemployed" {{ isset($studentData->occupation) && $studentData->occupation === 'Unemployed' ? 'selected' : '' }}>Unemployed</option>
                                                    </select>                                                                                                        
                                                    <div class="invalid-feedback" id="occupation_error">Please enter occupation.</div>
                                                </div>
                                                <div class="mb-3 col-12 col-md-6">
                                                    <label class="form-label" for="fname">First Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" id="fname" name="first_name"
                                                        class="form-control"
                                                        value="{{ isset($studentData->user['name']) ? $studentData->user['name'] : '' }}"
                                                        placeholder="First Name" required />
                                                    <input type="text" name="student_id"
                                                        value="{{ isset($studentData->user['id']) ? base64_encode($studentData->user['id']) : '' }}"
                                                        hidden />
                                                    <div class="invalid-feedback" id="first_name_error">Please enter first name.</div>
                                                </div>
                                                <!-- Last name -->
                                                <div class="mb-3 col-12 col-md-6">
                                                    <label class="form-label" for="lname">Last Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" id="lname"
                                                        value="{{ isset($studentData->user['last_name']) ? $studentData->user['last_name'] : '' }}"
                                                        class="form-control" placeholder="Last Name" name="last_name"
                                                        required />
                                                    <div class="invalid-feedback" id="last_name_error">Please enter last name.
                                                    </div>
                                                </div>

                                                <!-- DOB -->
                                                <div class="mb-3 col-12 col-md-6">
                                                    <label class="form-label" for="birth">Date of Birth <span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control flatpickr"
                                                        value="{{ isset($studentData->dob) ? $studentData->dob : '' }}"
                                                        type="date" placeholder="Date of Birth" id="birth"
                                                        name="dob" />
                                                    <div class="invalid-feedback" id="dob_error">Please select date of birth.</div>
                                                </div>

                                                <!-- Gender -->
                                                <div class="mb-3 col-12 col-md-6">
                                                    <label class="form-label" for="gender">Gender</label>
                                                    <select class="form-select" id="gender" name="gender" required>
                                                        <option value="{{ isset($studentData->gender) ? $studentData->gender : '' }}">{{ isset($studentData->gender) ? $studentData->gender : 'Select' }}</option>
                                                        <option value="Male" @if (empty($studentData->gender) || $studentData->gender === 'Female') @endif>Male</option>
                                                        <option value="Female" @if (empty($studentData->gender) || $studentData->gender === 'Male') @endif>Female</option>
                                                    </select>                                                    
                                                    <div class="invalid-feedback" id="gender_error">Please select gender.
                                                    </div>
                                                </div>

                                                <!-- Country -->
                                                <div class="mb-3 col-12 col-md-6">
                                                    <label class="form-label" for="country">Country <span
                                                            class="text-danger">*</span></label>    
                                                    <select class="form-select" id="country" name="country" required>
                                                        <option value="">Select</option>
                                                        @foreach (getDropDownlist('country_master', ['id', 'country_name']) as $country)
                                                            <option value="{{ $country->id }}"
                                                                @if ($country->id == $studentData->country_id) selected @endif>
                                                                {{ $country->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback" id="country_error">Please select country.
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-12 col-md-6">
                                                    <label class="form-label" for="city">City <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" id="city" class="form-control"
                                                        value="{{ isset($studentData->city_id) ? $studentData->city_id : '' }}"
                                                        placeholder="City" name="city" required />
                                                    <div class="invalid-feedback" id="city_error">Please enter city.</div>
                                                </div>
                                                <div class="mb-3 col-12 col-md-6">
                                                    <label class="form-label" for="nationality">Postal Code</label>
                                                    <input type="text" id="zip" name="zip"
                                                        value="{{ isset($studentData->zip) ? $studentData->zip : '' }}"
                                                        class="form-control" placeholder="Postal Code" required />
                                                    <div class="invalid-feedback" id="zip_error">Please enter postal code.
                                                    </div>
                                                </div>
                                                <!-- Nationality -->
                                                <div class="mb-3 col-12 col-md-6">
                                                    <label class="form-label" for="nationality">Nationality</label>
                                                    <input type="text" id="nationality" name="nationality"
                                                        value="{{ isset($studentData->nationality) ? $studentData->nationality : '' }}"
                                                        class="form-control" placeholder="Nationality" required />
                                                    <div class="invalid-feedback" id="nationality_error">Please enter
                                                        nationality.</div>
                                                </div>

                                                <!-- Address -->
                                                <div class="mb-3 col-12 col-md-12">
                                                    <label for="textarea-input" class="form-label">Address</label>
                                                    <textarea class="form-control" id="textarea-input" name="address" rows="2"
                                                        placeholder="Enter your address here...">{{ isset($studentData->address) ? $studentData->address : '' }}</textarea>
                                                </div>
                                                <div class="col-12">
                                                    <!-- Button -->
                                                    <button class="btn btn-primary updateProfile"
                                                        type="button">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Document Verification Card header -->
                                    <div class="card-header">
                                        <h3 class="mb-0">Document Verification</h3>
                                        <p class="mb-0">Ensuring Authenticity: The Process for Course Enrollment</p>
                                    </div>
                                    <div class="card-body">
                                        @if (isset($studentDoc->identity_doc_file) &&
                                                !empty($studentDoc->identity_doc_file && Storage::disk('local')->exists($studentDoc->identity_doc_file)))
                                          
                                                <!-- Form -->
                                                <form class="row gx-3 needs-validation studentDoc" novalidate="">
                                                    <!-- id proof -->
                                                    <div class="mb-3 col-12 col-md-8">
                                                        <div class="">
                                                            <label class="form-label">Name of Person <span class="text-danger">*</span></label>
                                                            <div class="input-group mb-1">
                                                                <input type="text" class="form-control" id="name_person"
                                                                    name="name_person"
                                                                    value="{{ isset($studentDoc->name_on_identity_card) ? $studentDoc->name_on_identity_card : '' }}">
                                                                <input type="text" name="student_id"
                                                                    value="{{ isset($studentDoc->student_id) ? base64_encode($studentDoc->student_id) : '' }}"
                                                                    hidden />

                                                                {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                                            </div>
                                                        </div>
                                                        <div class="invalid-feedback" id="name_error">Please enter name of
                                                            persons.</div>
                                                    </div>
                                                    <div class="mb-3 col-12 col-md-4">
                                                        <div class="">
                                                            <label class="form-label">Date of Birth</label>
                                                            <div class="input-group mb-1">
                                                                <input type="date" class="form-control" name="birth_dob"
                                                                    value="{{ isset($studentDoc->dob_on_identity_card) ? $studentDoc->dob_on_identity_card : '' }}">
                                                                {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                                            </div>
                                                        </div>

                                                        {{-- <div class="invalid-feedback" Please Select DOB.</div> --}}
                                                    </div>
                                                    <div class="mb-3 col-12 col-md-12">
                                                        <div class="">
                                                            <label class="form-label">Name of ID Proof <span class="text-danger">*</span></label>
                                                            <div class="input-group mb-1">
                                                                <input type="text" class="form-control" name="proof_name"
                                                                    id="proof_name"
                                                                    value="{{ isset($studentDoc->identity_doc_type) ? $studentDoc->identity_doc_type : '' }}">
                                                                {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                                            </div>
                                                        </div>

                                                        <div class="invalid-feedback" id="id_name_error">Please enter name of
                                                            id proof.</div>
                                                    </div>
                                                    <div class="mb-3 col-12 col-md-12">
                                                        <div class="">
                                                            <label class="form-label">Document ID <span class="text-danger">*</span></label>
                                                            <div class="input-group mb-1">
                                                                <input type="text" class="form-control" id="doc_id_no"
                                                                    name="doc_id_no"
                                                                    value="{{ isset($studentDoc->identity_doc_number) ? htmlspecialchars_decode($studentDoc->identity_doc_number) : '' }}">
                                                                {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                                            </div>
                                                        </div>

                                                        <div class="invalid-feedback" id="doc_id_error">Please enter document id.
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 col-12 col-md-12">
                                                        <div class="">
                                                            <label class="form-label">Document Issuing Authority <span class="text-danger">*</span></label>
                                                            <div class="input-group mb-1">
                                                                <input type="text" class="form-control" id="Authority"
                                                                    name="doc_auth"
                                                                    value="{{ isset($studentDoc->identity_doc_authority) ? htmlspecialchars_decode($studentDoc->identity_doc_authority) : '' }}">
                                                                {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                                            </div>
                                                        </div>
                                                        <div class="invalid-feedback" id="doc_authority_error">Please enter document issue authority.</div>
                                                    </div>
                                                    <div class="mb-3 col-12 col-md-4">
                                                        <div class="">
                                                            <label class="form-label">Issue Date </label>
                                                            <div class="input-group mb-1">
                                                                <input type="date" class="form-control" id="Issue"
                                                                    name="issue_date"
                                                                    value="{{ isset($studentDoc->identity_doc_issue_date) ? $studentDoc->identity_doc_issue_date : '1900-01-01' }}">
                                                                {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="mb-3 col-12 col-md-4">
                                                        <div class="">
                                                            <label class="form-label">Expiry Date <span class="text-danger">*</span></label>
                                                            <div class="input-group mb-1">
                                                                <input type="date" class="form-control" id="expiry_date"
                                                                    name="expiry_date"
                                                                    value="{{ isset($studentDoc->identity_doc_expiry) ? $studentDoc->identity_doc_expiry : '' }}">
                                                                {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                                            </div>
                                                        </div>

                                                        <div class="invalid-feedback" id="expiry_error">Please enter expiry date.
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 col-12 col-md-4">
                                                        <div class="">
                                                            <label class="form-label">Issuing Country <span
                                                                class="text-danger">*</span></label>
                                                            <div class="input-group mb-1">
                                                                <input type="text" class="form-control" id="issue_country"
                                                                    name="issue_country"
                                                                    value="{{ isset($studentDoc->identity_doc_country) ? $studentDoc->identity_doc_country : '' }}">
                                                                {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                                            </div>
                                                        </div>
                                                        <div class="invalid-feedback" id="issuing_country_error">Please enter
                                                            issuing country.</div>
                                                    </div>
                                                    <div class="mb-3 col-12 col-md-12">
                                                        <label class="form-label" for="">Remark</label>
                                                        <input type="text" class="form-control" id="identity_doc_comments"
                                                            name="identity_doc_comments"
                                                            value="{{ isset($studentDoc['identity_doc_comments']) ? $studentDoc['identity_doc_comments'] : '' }}">
                                                        <div class="invalid-feedback" id="eduComments_error">Please enter
                                                            remark.</div>
                                                    </div>
                                                    <div class="mb-5 col-6 col-md-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input id_doc_status1" id="id_doc_status1"
                                                                type="radio" name="id_doc_status" value="1"
                                                                @if (isset($studentDoc->identity_is_approved) && $studentDoc->identity_is_approved === 'Approved') checked @endif>
                                                            <label class="form-check-label" for="id_doc_status1">
                                                                <b>Approved</b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class=" mb-5 col-6 col-md-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input id_doc_status2" id="id_doc_status2"
                                                                type="radio" name="id_doc_status" value="0"
                                                                @if (isset($studentDoc->identity_is_approved) && $studentDoc->identity_is_approved != 'Approved') checked @endif>
                                                            <label class="form-check-label" for="id_doc_status2">
                                                                <b> Reject</b>
                                                            </label>
                                                        </div>
                                                        <div class="invalid-feedback" id="approval_error">Please select
                                                            verification status.</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <!-- Button -->
                                                        <button class="btn btn-primary verifyDoc" type="button">Submit Now <i class="bi bi-patch-check"></i></button>
                                                        {{-- <a href="{{ Storage::disk('local')->url($studentDoc->identity_doc_file) }}"
                                                            download="{{ isset($studentDoc['user']->name) ? $studentDoc['user']->name . '_ID_Card' : ' ' }}"><button
                                                                class="btn btn-primary ms-2">Download Doc <i class="bi bi-download"></i></button></a> --}}
                                                        @if (isset($studentDoc->identity_doc_file) &&  !empty($studentDoc->identity_doc_file && Storage::disk('local')->exists($studentDoc->identity_doc_file)))
                                                            <a class="btn btn-primary ms-2" href="{{ Storage::disk('local')->url($studentDoc->identity_doc_file) }}" target="_blank">View Doc</a>
                                                        @endif       
                                                    </div>
                                                </form>
                                            @else
                                                <h4 class="text-danger">Document not uploaded yet.</h4>
                                            @endif
                                        <div>
                                            <hr class="my-5">
                                            <h3 class="mb-0">Education Details</h3>
                                            <p class="mb-2">Enter your Higher Education Details</p>

                                            @if (isset($studentDoc->edu_doc_file) &&
                                                    !empty($studentDoc->edu_doc_file && Storage::disk('local')->exists($studentDoc->edu_doc_file)))
                                            
                                                <form class="row gx-3 needs-validation studentEduDoc" novalidate="">
                                                    <div class="mb-3 col-12 col-md-6">
                                                        <label class="form-label" for="edu_level">Select Higher Education
                                                            Type<span class="text-danger">*</span></label>
                                                        <select class="form-select" id="edu_level" name="edu_level" required>
                                                            {{-- <option value="{{!empty($studentDoc['edu_level']) ? $studentDoc['edu_level'] : '' }}">{{!empty($studentDoc['edu_level']) ? $studentDoc['edu_level'] : 'Select' }}</option> --}}
                                                            <option value="0">Select</option>
                                                            <option value="5"
                                                                @if ($studentDoc->edu_level == '5') selected @endif>E5</option>
                                                            <option value="6"
                                                                @if ($studentDoc->edu_level == '6') selected @endif>E6</option>
                                                            <option value="7"
                                                                @if ($studentDoc->edu_level == '7') selected @endif>E7</option>
                                                            
                                                        </select>
                                                        <div class="invalid-feedback" id="edu_level_error">Please select higher
                                                            education type.</div>
                                                    </div>
                                                    <div class="mb-3 col-12 col-md-6">
                                                        <label class="form-label" for="specilization">Specialization <span class="text-danger">*</span></label>
                                                        {{-- <select class="form-select" id="specilization" name="specilization" required>
                                                                <option value="{{!empty($studentDoc['edu_specialization']) ? $studentDoc['edu_specialization'] : '' }}">{{!empty($studentDoc['edu_specialization']) ? $studentDoc['edu_specialization'] : 'Select' }}</option>
                                                                <option value="Bsc">Bsc</option>
                                                                <option value="Bcom">Bcom</option>
                                                                <option value="MA">MA</option>
                                                                <option value="Msc">Msc</option>
                                                                <option value="Others">Others</option>
                                                            </select> --}}
                                                        <input type="text" class="form-control" id="specilization"
                                                            name="specilization"
                                                            value="{{ isset($studentDoc['edu_specialization']) ? htmlspecialchars_decode($studentDoc['edu_specialization']) : '' }}"
                                                            required>

                                                        <div class="invalid-feedback" id="specilization_error">Please enter
                                                            specialization.</div>
                                                    </div>

                                                    <!-- Country -->
                                                    <div class="col-12">
                                                        <div class="row eduDocDetails">
                                                            <div class="mb-3 col-12 col-md-12">
                                                                <label class="form-label" for="">Name As on Document<span class="text-danger">*</span> </label>
                                                                <input type="text" class="form-control" id="eduStudentName"
                                                                    name="eduStudentName"
                                                                    value="{{ isset($studentDoc['name_on_education_doc']) ? $studentDoc['name_on_education_doc'] : '' }}">
                                                                <input type="text" name="student_id"
                                                                    value="{{ isset($studentDoc->student_id) ? base64_encode($studentDoc->student_id) : '' }}"
                                                                    hidden />
                                                                <div class="invalid-feedback" id="eduStudentName_error">Please enter your document.</div>

                                                            </div>
                                                            <div class="mb-3 col-12 col-md-8">
                                                                <label class="form-label" for="">Name of Institution or
                                                                    College<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="institue_name"
                                                                    name="institue_name"
                                                                    value="{{ isset($studentDoc['university_name_on_edu_doc']) ? htmlspecialchars_decode($studentDoc['university_name_on_edu_doc']) : '' }}">
                                                                <div class="invalid-feedback" id="institue_name_error">Please enter name of institution.</div>
                                                            </div>
                                                            <div class="mb-3 col-12 col-md-4">
                                                                <label class="form-label" for=""> Year of Passing<span class="text-danger">*</span></label>
                                                                <input type="date" class="form-control" id="passsingYear"
                                                                    name="passsingYear"
                                                                    value="{{ isset($studentDoc['passing_year']) ? $studentDoc['passing_year'] : '' }}">
                                                                <div class="invalid-feedback" id="passsingYear_error">Please select passing year.</div>
                                                            </div>
                                                            <div class="mb-3 col-12 col-md-12">
                                                                <label class="form-label" for="">Name of Course of Degree<span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control" id="eduDocName"
                                                                    name="eduDocName"
                                                                    value="{{ isset($studentDoc['degree_course_name']) ? htmlspecialchars_decode(htmlspecialchars_decode($studentDoc['degree_course_name'])) : '' }}">
                                                                <div class="invalid-feedback" id="eduDocName_error">Please enter name
                                                                    of course of degree</div>
                                                            </div>
                                                            <div class="mb-3 col-12 col-md-4">
                                                                <label class="form-label" for="">Document ID Number<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="eduDocId"
                                                                    name="eduDocId"
                                                                    value="{{ isset($studentDoc['education_doc_number']) ? htmlspecialchars_decode($studentDoc['education_doc_number']) : '' }}">
                                                                <div class="invalid-feedback" id="eduDocId_error">Please enter
                                                                    document iD number</div>
                                                            </div>
                                                            {{-- <div class="mb-3 col-12 col-md-4">
                                                                <label class="form-label" for="">Grade or Marks</label>
                                                                <input type="text" class="form-control" id="eduGrade" name="eduGrade" value="{{isset($studentDoc['grade_on_edu_doc']) ? $studentDoc['grade_on_edu_doc'] : ''}}" >
                                                                <div class="invalid-feedback" id="eduGrade_error">Please enter Grade or Marks</div>
                                                            </div> --}}
                                                            <div class="mb-3 col-12 col-md-4">
                                                                <label class="form-label" for="">Education Remark<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="eduRemark"
                                                                    name="eduRemark"
                                                                    value="{{ isset($studentDoc['remark_on_edu_doc']) ? $studentDoc['remark_on_edu_doc'] : '' }}">
                                                                <div class="invalid-feedback" id="eduRemark_error">Please enter
                                                                    education remark</div>
                                                            </div>
                                                            <div class="mb-3 col-12 col-md-12">
                                                                <label class="form-label" for="">Remark</label>
                                                                <input type="text" class="form-control" id="eduComments"
                                                                    name="eduComments"
                                                                    value="{{ isset($studentDoc['comments_on_edu_doc']) ? $studentDoc['comments_on_edu_doc'] : '' }}">
                                                                <div class="invalid-feedback" id="eduComments_error">Please enter
                                                                    Remark</div>
                                                            </div>
                                                            <div class="mb-5 col-6 col-md-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input edu_doc_status1" type="radio"
                                                                        id="edu_doc_status1" name="edu_doc_status" value="1"
                                                                        @if (isset($studentDoc->edu_is_approved) && $studentDoc->edu_is_approved === 'Approved') checked @endif>
                                                                    <label class="form-check-label" for="edu_doc_status1">
                                                                        <b>Approved</b>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-5 col-6 col-md-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input edu_doc_status2" d="edu_doc_status2"
                                                                        type="radio" name="edu_doc_status" value="0"
                                                                        @if (isset($studentDoc->edu_is_approved) && $studentDoc->edu_is_approved != 'Approved') checked @endif>
                                                                    <label class="form-check-label" for="edu_doc_status2">
                                                                        <b> Reject</b>
                                                                    </label>
                                                                </div>
                                                                <div class="invalid-feedback" id="edu_doc_status_error">Please Select Verification Status</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <!-- Button -->
                                                        <button class="btn btn-primary verifyEduDoc"
                                                            type="button">Submit Now <i class="bi bi-patch-check"></i> </button>
                                                        {{-- <button class="btn btn-primary ms-1" type="button"> Download Doc <i class="bi bi-download"></i></button> --}}
                                                        {{-- <a href="{{ Storage::disk('local')->url($studentDoc->edu_doc_file) }}"
                                                            download="{{ isset($studentDoc['user']->name) ? $studentDoc['user']->name . '_Education_Card' : ' ' }}"><button
                                                                class="btn btn-primary ms-1">Download Doc <i class="bi bi-download"></i></button></a> --}}
                                                        @if (isset($studentDoc->edu_doc_file) &&  !empty($studentDoc->edu_doc_file && Storage::disk('local')->exists($studentDoc->edu_doc_file)))
                                                        <a class="btn btn-primary ms-2" href="{{ Storage::disk('local')->url($studentDoc->edu_doc_file) }}" target="_blank">View Doc</a>
                                                        @endif
                                                            

                                                    </div>
                                                </form>
                                            @else
                                                <h4 class="text-danger">Document not uploaded yet.</h4>
                                            @endif

                                            <hr class="my-5">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Resume Card header -->
                                            <div class="border-bottom pb-2 mb-4">
                                                @if (isset($studentDoc->english_score))
                                                @php 
                                                    $english_score = $studentDoc->english_score;
                                                @endphp
                                                @if($english_score >= 10)
                                                    @php $english_text = "Pass"; @endphp
                                                @elseif($english_score < 10)
                                                    @php $english_text = "Fail";@endphp
                                                @else
                                                    @php $english_text = "Fail"; @endphp
                                                @endif
                                                <h3 class="mb-0">English Test : {{$english_text}} / {{$english_score}}</h3>

                                                @else
                                                <h3 class="mb-0"> English Test : </h3><br><h4 class="text-danger"> The english test is not done yet.</h4>
                                                @endif
                                            </div>
                                    </div>
                                    <div class="card-body">
                                    <!-- Resume Card header -->
                                        <div class="border-bottom pb-2 mb-4">
                                            <h3 class="mb-0">Resume</h3>
                                            <p class="mb-0">Check and download resume from here</p>
                                        </div>
                                        
                                        @if (isset($studentDoc->resume_file) &&
                                                !empty($studentDoc->resume_file && Storage::disk('local')->exists($studentDoc->resume_file)))
                                            <a href="{{ Storage::disk('local')->url($studentDoc->resume_file) }}"
                                                download="{{ isset($studentDoc['user']->name) ? $studentDoc['user']->name . '_Resume' : ' ' }}"><button
                                                    class="btn btn-primary">Download Resume <i class="bi bi-download"></i> </button></a>
                                        @else
                                            <h4 class="text-danger">Resume not uploaded yet.</h4>
                                        @endif

                                    </div>
                                    <div class="card-body">
                                        <!-- Resume Card header -->
                                            <div class="border-bottom pb-2 mb-4">
                                                <h3 class="mb-0">Research Proposal</h3>
                                                <p class="mb-0">Check and download Research Proposal from here</p>
                                            </div>
                                            @if (Auth::check() && Auth::user()->role =='superadmin')
                                            @if (isset($studentDoc->research_proposal_file) &&
                                                    !empty($studentDoc->research_proposal_file && Storage::disk('local')->exists($studentDoc->research_proposal_file)))
                                                {{-- <a href="{{ Storage::disk('local')->url($studentDoc->research_proposal_file) }}"
                                                    download="{{ isset($studentDoc['user']->name) ? $studentDoc['user']->name . '_ResearchProposal' : ' ' }}"><button
                                                        class="btn btn-primary">Download Research Proposal <i class="bi bi-download"></i> </button></a> --}}
                                                    <form class="row gx-3 needs-validation studentResearchDoc" novalidate="">
                                                        <input type="text" name="student_id"
                                                        value="{{ isset($studentDoc->student_id) ? base64_encode($studentDoc->student_id) : '' }}"
                                                        hidden />
                                                        <div class="mb-5 col-6 col-md-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input research_doc_status1" type="radio"
                                                                    id="research_doc_status1" name="research_doc_status" value="1"
                                                                    @if (isset($studentDoc->proposal_is_approved) && $studentDoc->proposal_is_approved === 'Approved') checked @endif>
                                                                <label class="form-check-label" for="research_doc_status1">
                                                                    <b>Approved</b>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-5 col-6 col-md-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input research_doc_status2" id="research_doc_status2"
                                                                    type="radio" name="research_doc_status" value="0"
                                                                    @if (isset($studentDoc->proposal_is_approved) && $studentDoc->proposal_is_approved != 'Approved') checked @endif>
                                                                <label class="form-check-label" for="research_doc_status2">
                                                                    <b> Reject</b>
                                                                </label>
                                                            </div>
                                                            <div class="invalid-feedback" id="research_doc_status_error">Please Select Verification Status</div>
                                                        </div>
                                                        <div class="mb-5 col-6 col-md-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input research_doc_status3" id="research_doc_status3"
                                                                    type="radio" name="research_doc_status" value="2"
                                                                    @if (isset($studentDoc->proposal_is_approved) && $studentDoc->proposal_is_approved === 'Reupload')  @endif>
                                                                <label class="form-check-label" for="research_doc_status3">
                                                                    <b> Re-upload</b>
                                                                </label>
                                                            </div>
                                                            <div class="invalid-feedback" id="research_doc_status_error">Please Select Verification Status</div>
                                                        </div>
                                                    <div class="col-12">
                                                        <button class="btn btn-primary verifyResearchDoc"
                                                            type="button">Submit Now <i class="bi bi-patch-check"></i> </button>
                                                        {{-- <button class="btn btn-primary ms-1" type="button"> Download Doc <i class="bi bi-download"></i></button> --}}
                                                        {{-- <a href="{{ Storage::disk('local')->url($studentDoc->edu_doc_file) }}"
                                                            download="{{ isset($studentDoc['user']->name) ? $studentDoc['user']->name . '_Education_Card' : ' ' }}"><button
                                                                class="btn btn-primary ms-1">Download Doc <i class="bi bi-download"></i></button></a> --}}
                                                        @if (isset($studentDoc->research_proposal_file) &&  !empty($studentDoc->research_proposal_file && Storage::disk('local')->exists($studentDoc->research_proposal_file)))
                                                        <a class="btn btn-primary ms-2" href="{{ Storage::disk('local')->url($studentDoc->research_proposal_file) }}" target="_blank">View Doc</a>
                                                        @endif
                                                    </div>
                                                    </form>


                                            @else
                                                <h4 class="text-danger">Research Proposal not uploaded yet.</h4>
                                            @endif
                                            @else
                                                @if (isset($studentDoc->research_proposal_file) &&  !empty($studentDoc->research_proposal_file && Storage::disk('local')->exists($studentDoc->research_proposal_file)))
                                                <a class="btn btn-primary ms-2" href="{{ Storage::disk('local')->url($studentDoc->research_proposal_file) }}" target="_blank">View Doc</a>
                                                @endif
                                            @endif
    
                                        </div>
                                    <div class="card-body">
                                    <!-- Social Profile Card header -->
                                    <div class="border-bottom mt-5 mb-3 pb-2">
                                        <h3 class="mb-0">Social Profile</h3>
                                        <p class="mb-0">Find the links to our social profiles below.</p>
                                    </div>
                                    <div class="col-12">
                                        <div class="card-body">
                                            @if (isset( $studentData->whatsapp) &&  $studentData->whatsapp)
                                                <a href="{{ isset( $studentData->whatsapp) && !empty( $studentData->whatsapp) ? 'https://wa.me/' . ltrim( $studentData->whatsapp_country_code).ltrim($studentData->whatsapp, '+') : '#' }}" class="me-4" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#25de66" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                        <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                                      </svg>
                                                </a>
                                            @endif
                                            <!--Facebook-->
                                            @if (isset($studentData->facebook) && $studentData->facebook)
                                                <a href="{{ isset($studentData->facebook) ? (strpos($studentData->facebook, 'http') === 0 ? $studentData->facebook : 'http://' .  $studentData->facebook) : '#' }}" target="_blank"
                                                    class=" me-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                        fill="#316ff6" class="bi bi-facebook" viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                                    </svg>
                                                </a>
                                            @endif
                                            @if (isset($studentData->instagram) &&  $studentData->instagram)
                                                <a href="{{ isset( $studentData->instagram) ? (strpos( $studentData->instagram, 'http') === 0 ?  $studentData->instagram : 'http://' .  $studentData->instagram) : '#' }}" target="_blank"
                                                    class=" me-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                        fill="#dd2a7b" class="bi bi-instagram" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                                    </svg>
                                                </a>
                                            @endif
                                            <!-- Facebook -->
                                            {{-- <div class="row mb-5">
                                                <div class="col-lg-2 col-md-4 col-12">
                                                    <h5>Facebook</h5>
                                                </div>
                                                <div class="col-lg-10 col-md-8 col-12">
                                                    <input type="text" class="form-control mb-1"
                                                        placeholder="https://www.facebook.com/"
                                                        value="{{ $studentData->facebook }}">
                                                </div>
                                            </div>
                                            <!-- Instagram -->
                                            <div class="row mb-5">
                                                <div class="col-lg-2 col-md-4 col-12">
                                                    <h5>Instagram</h5>
                                                </div>
                                                <div class="col-lg-10 col-md-8 col-12">
                                                    <input type="text" class="form-control mb-1"
                                                        placeholder="https://www.instagram.com/"
                                                        value="{{ $studentData->instagram }}">
                                                </div>
                                            </div>
                                            <!-- Linked in -->
                                            <div class="row mb-5">
                                                <div class="col-lg-2 col-md-4 col-12">
                                                    <h5>LinkedIn</h5>
                                                </div>
                                                <div class="col-lg-10 col-md-8 col-12">
                                                    <input type="text" class="form-control mb-1"
                                                        placeholder="https://www.linkedin.com/"
                                                        value="{{ $studentData->linkedIn }}">
                                                </div>
                                            </div>
                                            <!-- Youtube -->
                                            <div class="row mb-3">
                                                <div class="col-lg-2 col-md-4 col-12">
                                                    <h5>X (Twitter)</h5>
                                                </div>
                                                <div class="col-lg-10 col-md-8 col-12">
                                                    <input type="text" class="form-control mb-1"
                                                        placeholder="https://twitter.com/"
                                                        value="{{ $studentData->twitter }}">
                                                </div>
                                            </div> --}}
                                            <!-- Button -->
                                            {{-- <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <a href="#" class="btn btn-primary">Save Now</a>
                                            </div>
                                        </div> --}}
                                        </div>  
                                    </div>
                                    </div>
                                </div>
                            </div>
                  
                          

                                                   
                        
                            <div class="tab-pane fade" id="purchased-courses" role="tabpanel" aria-labelledby="purchased-courses-tab">
                                <div class="row">
                                    {{-- @if(!empty($wishlistData[0]['orderlist']))
                                        @foreach($wishlistData[0]['orderlist']  as $key =>  $value)
                                        @if($value['status'] == '0')
                                        @php
                                       $award = getData('course_master',['course_title','id','selling_price','ects','course_final_price','course_old_price','category_id','course_thumbnail_file'],['id'=>$value['course_id'],'status'=>3,'is_deleted'=>'No'],'','created_at','desc');

                                        $studentCourseMaster = getData('student_course_master',['course_expired_on','course_progress','exam_remark','exam_attempt_remain'],['course_id'=>$value['course_id'], 'user_id'=>$value['user_id'],'is_deleted'=>'No','payment_id'=>$value['payment_id']],'','created_at','desc');
                                        
                                        @endphp 
                                        @if (isset($studentCourseMaster) && count($studentCourseMaster) > 0 && $studentCourseMaster[0]->course_expired_on > now() && ($studentCourseMaster[0]->exam_attempt_remain != "0" && $studentCourseMaster[0]->exam_remark == '0'  || $studentCourseMaster[0]->exam_attempt_remain == "2" || $studentCourseMaster[0]->exam_attempt_remain == '1' && $studentCourseMaster[0]->exam_remark == '0' ))
                                        @if($studentCourseMaster[0]->course_expired_on >  now())  --}}
                                        @php
                                             $where = [
                                                'user_id' => $studentData->user['id'],
                                                'include_adjusted_expiry' => false
                                            ];
                                            $PurchasedData = getPaidCourse($where);
                                        @endphp
                                        @if(!empty($PurchasedData))
                                        @foreach($PurchasedData  as $key =>  $value)
                                        {{-- @if(!empty($award[0]->course_title)) --}}
                                        <div class="col-lg-3 col-md-6 col-12 mt-3">
                                            <!-- Card -->
                                            <div class="card card-hover">

                                                {{-- <a href="{{route('get-course-details',['course_id'=>base64_encode($award[0]->id)])}}"> --}}
                                                    <img
                                                    src="{{ Storage::url($value->course_thumbnail_file) }}"
                                                    alt="course" class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;">
                                                {{-- </a> --}}

                                                <a id="play-video" class="video-play-button" href="#">
                                                    <span></span>
                                                </a>

                                                        
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        @php  $catgeory_name = ""; @endphp
                                                        @if($value->category_id == '1') @php  $catgeory_name = "Award"; @endphp
                                                        @elseif($value->category_id == '2') @php  $catgeory_name = "Certificate"; @endphp
                                                        @elseif($value->category_id == '3') @php  $catgeory_name = "Diploma"; @endphp
                                                        @elseif($value->category_id == '4') @php  $catgeory_name = "Master"; @endphp
                                                        @endif
        
                                                        <span class="badge bg-info-soft co-category">{{$catgeory_name}}</span>
                                                        <span class="badge bg-success-soft co-etcs">{{$value->ects}} ECTS</span>
                                                    </div>
                                                    <h4 class="mb-2 text-truncate-line-2 course-title">
                                                        {{-- @if($doc_verified[0]->identity_is_approved == "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->english_score >= 10 )    --}}
                                                        {{$value->course_title}}
                                                            @if($value->course_expired_on != '')
                                                            <h5 class="badge mt-2" style="background: #dae138; color: #2b3990"> 
                                                            {{isset($value->course_expired_on) ? 'Access until '.\Carbon\Carbon::parse($value->course_expired_on)->format('d-m-y') : ''}}.</h5>
                                                            @endif
                                                        {{-- @else
                                                            <a href="#" class="text-inherit learningVerified">{{$award[0]->course_title}}</a>
                                                        @endif --}}
                                                    </h4>

                                                    <div class="mt-3">

                                                        <div class="progress" style="height: 6px">
        
                                                            <div class="progress-bar bg-blue" role="progressbar" style="width: {{isset($value->course_progress) ? $value->course_progress : 0}}%" aria-valuenow="{{isset($value->course_progress) ? $value->course_progress : 0}}" aria-valuemin="0" aria-valuemax="100"></div>
        
                                                        </div>
        
                                                        <small>{{isset($value->course_progress) ? $value->course_progress : 0}} % Completed</small>
        
                                                    </div>
                                                </div>
                                            

                                            
                                            </div>
                                            
                                        </div>
                                        {{-- @endif --}}
                                       
                                        {{-- @endif --}}

                                        @endforeach
                                    @else
                                        <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-5">
                                            <img src="{{ asset('frontend/images/icon/no-purchase.svg')}}" alt="not found" style="height: 160px; width: 160px">
                                            <h3 class="mt-3">Your cart is empty!</h3>
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>


                           
            
                            <div class="tab-pane fade " id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                                <div class="row">
                                @if(!empty($wishlistData[0]['wishlist']))
                                    @foreach($wishlistData[0]['wishlist']  as $key =>  $value)
                                    @php
                                    $award = getData('course_master',['course_title','id','selling_price','ects','course_final_price','course_old_price','category_id','course_thumbnail_file'],['id'=>$value['course_id'],'status'=>3,'is_deleted'=>'No'],'','created_at','desc');
                                    @endphp 
                                    @if(!empty($award[0]->course_title))
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <!-- Card -->
                                        <div class="card card-hover">
                                        
                                            {{-- <a href="course-details.php " style="position: relative">
                                                <img src="{{ asset('admin/images/course/masters-human-resource-management.png') }}"
                                                    alt="course" class="card-img-top">
                                                    

                                                    <span class="course-video-overlay"></span>
                                                </a> --}}
                                                    
                                                {{-- <a href="{{route('get-course-details',['course_id'=>base64_encode($award[0]->id)])}}" target="_blank"> --}}
                                                    <img
                                                    src="{{ Storage::url($award[0]->course_thumbnail_file) }}"
                                                    alt="course" class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;">
                                                {{-- </a> --}}

                                                    <a id="play-video" class="video-play-button" href="#">
                                                        <span></span>
                                                    </a>

                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    @php  $catgeory_name = ""; @endphp
                                                    @if($award[0]->category_id == '1') @php  $catgeory_name = "Award"; @endphp
                                                    @elseif($award[0]->category_id == '2') @php  $catgeory_name = "Certificate"; @endphp
                                                    @elseif($award[0]->category_id == '3') @php  $catgeory_name = "Diploma"; @endphp
                                                    @elseif($award[0]->category_id == '4') @php  $catgeory_name = "Master"; @endphp
                                                    @endif



                                                    <span class="badge bg-info-soft co-category">{{$catgeory_name}}</span>
                                                    <span class="badge bg-success-soft co-etcs">{{$award[0]->ects}} ECTS</span>
                                                </div>
                                                <h4 class="mb-2 text-truncate-line-2 course-title">
                                                    {{-- <a target="_blank" href="{{route('get-course-details',['course_id'=>base64_encode($award[0]->id)])}}" class="text-inherit"> --}}
                                                        {{$award[0]->course_title}}
                                                    {{-- </a> --}}
                                                </h4>
                        

                                            </div>
                                            <!-- Card Footer -->
                                            <div class="card-footer">
                                                <div class="row align-items-center g-0">
                                                    <div class="col course-price-flex">
                                                        <h5 class="mb-0 course-price">€{{$award[0]->course_final_price}}</h5>
                                                        <h5 class="old-price">€{{$award[0]->course_old_price}}</h5>
                                                    </div>
                        
                                                    <div class="col-auto">
                                                        {{-- <a href='{{route('login')}}'> <i class="fe fe-shopping-cart text-primary align-middle me-4"></i></a>
                                                        <a href="{{route('login')}}">Buy Now</a> --}}
                                                                        {{-- @php
                                                        $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '1','course_id'=> $award[0]->id]);
                                                        @endphp
                                                        @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                                            {{-- <a  href="{{route('start-course-panel',['course_id'=>base64_encode($award[0]->id)])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center"><i
                                                                    class="fe fe-play btn-outline-primary "></i> Play & Continue</a> --}}
                                                        {{-- @else --}}
                                                        {{-- <div class="d-flex"> --}}
                                                        {{-- <a href="#" class="text-inherit addtocart" id="addtocart" data-course-id="{{base64_encode($award[0]->id)}}" data-action="{{base64_encode('add')}}"> <i class="fe fe-shopping-cart text-primary align-middle me-4"></i></a>
                                                        <form action="{{ route('checkout') }}" method="post">
                                                            @csrf <!-- CSRF protection -->
                                                            @php $total_full_price = $award[0]->course_old_price - ($award[0]->course_old_price - $award[0]->course_final_price) ; @endphp
                                                            <input type='hidden' value="{{base64_encode($award[0]->id)}}" name="course_id" id="course_id">
                                                            <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($award[0]->course_old_price)}}">
                                                            <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($award[0]->course_old_price-$award[0]->course_final_price)}}">
                                                            <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                            <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                            <button class="buy-now">Buy Now</button>
                                                        </form> --}}
                                                        {{-- </div> --}}
                                                        {{-- @endif --}}
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @endif
                                    @endforeach
                                @else
                                    <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-5">
                                        <img src="{{ asset('frontend/images/icon/add-to-wishlist-icon.svg')}}" alt="not found" style="height: 160px; width: 160px">
                                        <h3 class="mt-3">Your wishlist is empty!</h3>
                                        <p>Explore more and shortlist some items.</p>
                                    </div>
                                @endif
                                </div>
                            </div>


                            <div class="tab-pane fade " id="expired-courses" role="tabpanel" aria-labelledby="expired-courses-tab">
                                <div class="row">

                                    @php
                                    // $studentCourseMasters = DB::table('student_course_master')->join('course_master', 'course_master.id', 'student_course_master.course_id')->where('user_id', $studentData->user['id'])->where(function ($query) {
                                    //             $query->where('course_expired_on', '<', now())
                                    //             ->orWhere('exam_remark','1')
                                    //             ->orWhere('exam_attempt_remain', '=', 0);
                                    //         })->select('category_id', 'course_id', 'ects', 'student_course_master.id as studentCourseMasterId', 'course_title', 'course_thumbnail_file')->get();
                                    $where = [
                                        'user_id' => $studentData->user['id']
                                    ];
                                    $studentCourseMasters = getStudentExpiredCourse($where);

                                    @endphp 
                                    @if(isset($studentCourseMasters) && (!empty($studentCourseMasters)))
                                        @foreach ($studentCourseMasters as $studentCourseMaster)
                                        @php $exm_remark = ''; @endphp
                                        @if($studentCourseMaster->exam_remark == 0)
                                            @php $exm_remark = "Failed"; @endphp
                                        @elseif($studentCourseMaster->exam_remark == 1)
                                            @php $exm_remark = "Passed";@endphp
                                        @endif
                                        <div class="col-lg-3 col-md-6 col-12 mt-3">
                                            <!-- Card -->
                                            <div class="card card-hover">

                                                <img
                                                src="{{ Storage::url($studentCourseMaster->course_thumbnail_file) }}"
                                                alt="course" class="card-img-top img-fluid" max-height='10px' style="object-fit: cover;">

                                                <a id="play-video" class="video-play-button" href="#">
                                                    <span></span>
                                                </a>
                                                        
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        @php  $catgeory_name = ""; @endphp
                                                        @if($studentCourseMaster->category_id == '1') @php  $catgeory_name = "Award"; @endphp
                                                        @elseif($studentCourseMaster->category_id == '2') @php  $catgeory_name = "Certificate"; @endphp
                                                        @elseif($studentCourseMaster->category_id == '3') @php  $catgeory_name = "Diploma"; @endphp
                                                        @elseif($studentCourseMaster->category_id == '4') @php  $catgeory_name = "Master"; @endphp
                                                        @endif
        
                                                        <span class="badge bg-info-soft co-category">{{$catgeory_name}}</span>
                                                        <span class="badge bg-success-soft co-etcs">{{$studentCourseMaster->ects}} ECTS</span>
                                                    </div>
                                                    <h4 class="mb-2 text-truncate-line-2 course-title">

                                                        {{$studentCourseMaster->course_title}}

                                                    </h4>
                                                    @if(isset($exm_remark))
                                                    <h5 class="badge mt-2" style="background: #dae138; color: #2b3990"> 
                                                        {{isset($exm_remark) ? $exm_remark : ''}}.</h5>
                                                    @endif
                                                </div>
                                            

                                            
                                            </div>
                                            
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-1 mb-1">
                                            <img src="{{ asset('frontend/images/icon/expired-icon.svg')}}" alt="not found" style="height: 160px; width: 160px">
                                            <h3 class="mt-3">Course Expired!</h3>
                                            <p>Unfortunately, This course has expired. Check out our latest offerings!</p>

                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="tab-pane fade " id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <!-- Card -->
                                        <div class="card card-hover">
                                            <a href="course-details.php"><img src="{{ asset('frontend/images/certificate/certificate-sample-01.jpg')}}" alt="course" class="card-img-top"></a>
                                            <!-- Card Body -->
                                            <div class="card-body">

                                                <h4 class=" mb-1 text-truncate-line-2 course-title"><a href="course-details.php" class="text-inherit">Award in Employee and Labour Relations</a></h4>

                                            </div>



                                        </div>
                                    </div>


                                    <div class="col-lg-3 col-md-6 col-12">
                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-5">
                                        <p>You’ve reached the end of the list</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="exam" role="tabpanel" aria-labelledby="exam-tab">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <!-- Card -->
                                        <div class="card card-hover">
                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <h3>Pass</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                                    
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                        <!-- Card -->
                                                <!-- Question -->
                                            <div class="mb-6 col-12 col-md-12">
                                                    <label for="textarea-input" class="form-label">
                                                        1.	What is your favorite hobby or pastime?</label>
                                                    <textarea class="form-control" name="answer[]" rows="2" disabled >{{isset($aboutmeData[0]->answer) ? $aboutmeData[0]->answer : '' }}</textarea>
                                            </div>
                                            <!-- Question -->
                                            <div class="mb-6 col-12 col-md-12">
                                                    <label for="textarea-input" class="form-label">
                                                        2.	What is your favorite book, and why?</label>
                                                    <textarea class="form-control" name="answer[]" rows="2" disabled>{{isset($aboutmeData[1]->answer) ? $aboutmeData[1]->answer : '' }}</textarea>
                                            </div>
                                            <!-- Question -->
                                            <div class="mb-6 col-12 col-md-12">
                                                    <label for="textarea-input" class="form-label">
                                                        3.	If you could travel anywhere in the world, where would you go and why?</label>
                                                    <textarea class="form-control" name="answer[]" rows="2" disabled>{{isset($aboutmeData[2]->answer) ? $aboutmeData[2]->answer : '' }}</textarea>
                                            </div>
                                            <!-- Question -->
                                            <div class="mb-6 col-12 col-md-12">
                                                    <label for="textarea-input" class="form-label">
                                                        4.	What is your favorite movie or TV show, and what do you love about it?</label>
                                                    <textarea class="form-control" name="answer[]" rows="2" disabled>{{isset($aboutmeData[3]->answer) ? $aboutmeData[3]->answer : '' }}</textarea>
                                            </div>
                                            <!-- Question -->
                                            <div class="mb-6 col-12 col-md-12">
                                                    <label for="textarea-input" class="form-label">
                                                        5.	Share a memorable childhood experience or story.</label>
                                                    <textarea class="form-control" name="answer[]" rows="2" disabled>{{isset($aboutmeData[4]->answer) ? $aboutmeData[4]->answer : '' }}</textarea>
                                            </div>
                                            <!-- Question -->
                                            <div class="mb-6 col-12 col-md-12">
                                                    <label for="textarea-input" class="form-label">
                                                        6.	If you could have any superpower, what would it be and how would you use it?</label>
                                                    <textarea class="form-control" name="answer[]" rows="2" disabled>{{isset($aboutmeData[5]->answer) ? $aboutmeData[5]->answer : '' }}</textarea>
                                            </div>
                                            <!-- Question -->
                                            <div class="mb-6 col-12 col-md-12">
                                                    <label for="textarea-input" class="form-label">
                                                        7.	Share a goal or dream you have for the future.</label>
                                                    <textarea class="form-control" name="answer[]" rows="2" disabled>{{isset($aboutmeData[6]->answer) ? $aboutmeData[6]->answer : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                      
                                </div>
                                <div class="row">
                                    <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center mt-5">
                                        <p>You’ve reached the end of the list</p>
                                    </div>
                                </div>
                            </div> --}}

                        </div>

                </div>
            </div>
    </section>

    <!-- Create Admin Modal -->
    <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Create New Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row needs-validation" novalidate>
                        <div class="mb-2 col-6">
                            <label for="FirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="FirstName" placeholder="First Name" required>
                            <div class="invalid-feedback">Please enter First Name</div>
                        </div>
                        <div class="mb-2 col-6">
                            <label for="LastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="LastName" placeholder="Last Name" required>
                            <div class="invalid-feedback">Please enter Last Name</div>
                        </div>
                        <div class="mb-2 col-12">
                            <label for="EmailId" class="form-label">Email Id</label>
                            <input type="text" class="form-control" id="EmailId" placeholder="Email Id" required>
                            <div class="invalid-feedback">Please enter Email Id</div>
                        </div>
                        <div class="mb-2 col-12">
                            <label for="MobileNumber" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="MobileNumber" placeholder="Mobile Number"
                                required>
                            <div class="invalid-feedback">Please enter Mobile Number</div>
                        </div>
                        <div class="mb-2 col-12">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="Password" placeholder="*********" required>
                            <div class="invalid-feedback">Please enter Password</div>
                        </div>
                        <div class="mb-2 col-12">
                            <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="ConfirmPassword" placeholder="*********"
                                required>
                            <div class="invalid-feedback">Please enter Password</div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer import -->
@endsection
