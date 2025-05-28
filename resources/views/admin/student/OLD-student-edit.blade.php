<!-- Header import -->
@extends('admin.layouts.main')
@section('content')
<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 d-md-flex align-items-center justify-content-between mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Edit Student</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.students')}}">Student List</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Student </li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
                <div>
                    <a href="{{route('admin.students')}}" class="btn btn-primary me-2">Back to Student List</a>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6">
        <!-- row -->
        <div class="row">
            <div class="offset-xl-3 col-xl-6 col-md-12 col-12">
                <!-- card -->
                <div class="card">

                    <!-- Account Security -->
                    <div class="card-header">
                        <h3 class="mb-0">Student Profile</h3>
                        <p class="mb-0">Edit your personal information and address.</p>
                    </div>
                    <div class="card-body">

                        <form class="row needs-validation" novalidate="">
                            <div class="mb-1 col-lg-6 col-md-12 col-12">
                                <label class="form-label" for="email">Email Address</label>
                                <input id="email" type="email" name="email" class="form-control" placeholder=""
                                    required=""
                                    value="{{ isset($studentData['user']->email) ?  $studentData['user']->email : ''}}" disabled>

                            </div>
                            <div class="mb-1 col-lg-6 col-md-12 col-12">

                                <label class="form-label" for="mob">Mobile Number</label>
                                <input id="mob" type="text" name="mob_no"
                                    value= "{{isset($studentData['user']->phone) ?  $studentData['user']->mob_code.' '.$studentData['user']->phone : ''}}"
                                    class="form-control" placeholder="" required="" disabled>
                            </div>
                        </form>

                    </div>
                    <!-- Public Profile Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">Public Profile</h3>
                    </div>
                    <!-- Card body -->
                    
                    <div class="card-body">
                        <div class="d-lg-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center mb-4 mb-lg-0">

                                {{-- @if (isset($studentData['user']->photo) &&
                                Storage::disk('local')->exists('studentDocs/UserFolder/'.$studentData['user']->photo))
                                <img src="{{ Storage::disk('local')->url('studentDocs/UserFolder/'.$studentData['user']->photo)}}"
                                    id="img-uploaded" class="avatar-xl rounded-circle" alt="avatar">
                                @else
                                <img src="{{ Storage::disk('local')->url('studentDocs/no_image_student.png')}}"
                                    id="img-uploaded" class="avatar-xl rounded-circle" alt="avatar">
                                @endif --}}
                        
                                <div class="me-2 position-relative">
                                    <form class="proflilImage" enctype="multipart/form-data">
                                    @if (!empty($studentData['user']->photo))
                                    <img class="avatar-xl rounded-circle border border-4 border-white imageAdminPreview" src="{{ Storage::url($studentData['user']->photo) }}">
                                    @else
                                            <img src="{{ asset('frontend/images/avatar/avatar-2.jpg')}}" class="avatar-xl rounded-circle border border-4 border-white imagePreview" alt="avatar" />
                                    @endif
                                    <div class="student-profile-photo-edit-pencil-icon">
                                       
                                        <input type="file" id="imageUpload_profile" class="image profileStudentPic" name="image_file" accept=".png, .jpg, .jpeg">                                        
                                        <input type="hidden" id="user_id" value="{{base64_encode($studentData->user['id'])}}" name="user_id" >
                                        <input type="hidden" id="user_name" value="{{base64_encode($studentData->user['name'])}}" name="user_name" >
                                        <label for="imageUpload_profile"><i class="bi-pencil"></i></label>
                                        <input type="text"  class='curr_img' value="{{ isset($studentData['user']->photo) ? $studentData['user']->photo : ''  }}" name='old_img_name' hidden>
                                        
                                    </div>
                                    </form>
                             
                                </div>
                                
                                <div class="ms-3">
                                    <h4 class="mb-0">Profile Photo</h4>
                                    <p class="mb-0">PNG or JPG no bigger than 800px wide and tall.</p>
                                </div>
                            </div>
                            {{-- <div>
                                <a href="#" class="btn btn-outline-secondary btn-sm">Update</a>
                                <a href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                            </div> --}}
                        </div>
                        <hr class="my-5">
                        <div>
                            <h4 class="mb-0">Personal Details</h4>
                            <p class="mb-4">Edit your personal information and address.</p>
                            <!-- Form -->
                          
                            <form class="row gx-3 needs-validation ProfileData" novalidate="">
                                <!-- Selection -->
                                  <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="occupation">Are you ?</label>
                                        <select class="form-select" id="occupation" name="occupation" required>
                                            <option value="{{isset($studentData->occupation) ? $studentData->occupation : '' }}">{{isset($studentData->occupation) ? $studentData->occupation : 'Select' }}</option>
                                             <option value="Student">Student</option>
                                             <option value="Employed">Employed</option>
                                             <option value="Unemployed">Unemployed</option>
                                        </select>
                                        <div class="invalid-feedback" id="occupation_error">Please enter last name.</div>
                                    </div>
                                <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="fname">First Name <span class="text-danger">*</span></label>
                                        <input type="text" id="fname" name="first_name" class="form-control" value="{{isset($studentData->user['name']) ? $studentData->user['name'] : '' }}" placeholder="First Name" required />
                                             <input type="text"  name="student_id"  value="{{isset($studentData->user['id']) ? base64_encode($studentData->user['id']) : '' }}" hidden />
                                        <div class="invalid-feedback" id="first_name_error">Please enter first name.</div>
                                    </div>
                                    <!-- Last name -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="lname">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" id="lname" value="{{isset($studentData->user['last_name']) ? $studentData->user['last_name'] : '' }}" class="form-control" placeholder="Last Name" name="last_name" required />
                                        <div class="invalid-feedback" id="last_name_error">Please enter last name.</div>
                                    </div>

                                    <!-- DOB -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="birth">Date of Birth <span class="text-danger">*</span></label>
                                        <input class="form-control flatpickr" value="{{isset($studentData->dob) ? $studentData->dob : '' }}" type="date" placeholder="Date of Birth" id="birth" name="dob" />
                                        <div class="invalid-feedback" id="dob_error">Please choose a date.</div>
                                    </div>

                                    <!-- Gender -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="gender">Gender</label>
                                        <select class="form-select" id="gender" name="gender" required>
                                            <option value="{{isset($studentData->gender) ? $studentData->gender : '' }}">{{isset($studentData->gender) ? $studentData->gender : 'Select' }}</option>
                                            @if (!empty($studentData->gender) && $studentData->gender === 'Male')
                                            <option value="Female">Female</option>
                                            <option value="Not Disclose">Not Disclose</option>
                                            @elseif(!empty($studentData->gender) && $studentData->gender === 'Female')
                                                 <option value="Male">Male</option>
                                                 <option value="Not Disclose">Not Disclose</option>
                                            @elseif(!empty($studentData->gender) && $studentData->gender === 'Not Disclose')
                                            <option value="Female">Female</option>
                                                <option value="Male">Male</option>
                                                @else
                                                  <option value="Female" @if('Female' == $studentData->gender) selected @endif>Female</option>
                                                <option value="Male" @if('Male' == $studentData->gender) selected @endif>Male</option>
                                                 <option value="Not Disclose" @if('Not Disclose' == $studentData->gender) selected @endif>Not Disclose</option>
                                            @endif
                                        </select>
                                        <div class="invalid-feedback" id="gender_error">Please choose Gender.</div>
                                    </div>

                                    <!-- Country -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="country">Country <span class="text-danger">*</span></label>
                                        <select class="form-select" id="country" name="country" required>
                                            <option value="{{isset($studentData->country_id) ? $studentData->country_id : '' }}">{{isset($studentData->name) ? $studentData->name : 'Select' }}</option>
                                               @foreach (getDropDownlist('country_master', ['id','country_name']) as $country)
                                                    <option value="{{ $country->id}}" @if($country->id ==$studentData->country_id) selected @endif>{{ $country->country_name}}</option>
                                                 @endforeach 
                                        </select>
                                        <div class="invalid-feedback" id="country_error">Please choose Country.</div>
                                    </div>
                                     <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="city">City <span class="text-danger">*</span></label>
                                        <input type="text" id="city" class="form-control" value="{{isset($studentData->city_id) ? $studentData->city_id : '' }}" placeholder="City" name="city" required />
                                        <div class="invalid-feedback" id="city_error" >Please enter City.</div>
                                    </div>
                                     <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="nationality">Postal Code</label>
                                        <input type="text" id="zip" name="zip" value="{{isset($studentData->zip) ? $studentData->zip : '' }}" class="form-control" placeholder="Postal Code" required />
                                        <div class="invalid-feedback" id="zip_error">Please enter Postal Code.</div>
                                    </div>
                                    <!-- Nationality -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="nationality">Nationality</label>
                                        <input type="text" id="nationality" name="nationality" value="{{isset($studentData->nationality) ? $studentData->nationality : '' }}" class="form-control" placeholder="Nationality" required />
                                        <div class="invalid-feedback" id="nationality_error">Please enter Nationality.</div>
                                    </div>

                                    <!-- Address -->
                                    <div class="mb-3 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">Address</label>
                                            <textarea class="form-control" id="textarea-input" name="address" rows="2" placeholder="Enter your address here...">{{isset($studentData->address) ? $studentData->address : '' }}</textarea>                                        
                                    </div>
                            <div class="col-12">
                            <!-- Button -->
                            <button class="btn btn-primary updateProfile" type="button">Update</button>
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
                        @if (isset($studentDoc->identity_doc_file) && !empty($studentDoc->identity_doc_file &&  Storage::disk('local')->exists($studentDoc->identity_doc_file)))
                            <a href="{{ Storage::disk('local')->url($studentDoc->identity_doc_file)}}" download="{{isset($studentDoc['user']->name) ? $studentDoc['user']->name."_ID_Card": " "}}"><button class="btn btn-primary d-flex flex-row-reverse  m-2">Download Doc</button></a>
                        <div>

                            <!-- Form -->
                            <form class="row gx-3 needs-validation studentDoc" novalidate="">
                                <!-- id proof -->
                                <div class=" col-9 col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Name of Person </label>
                                        <div class="input-group mb-1">
                                            <input type="text" class="form-control" id="name_person" name="name_person" value="{{isset($studentDoc->name_on_identity_card) ? $studentDoc->name_on_identity_card : '' }}">
                                            <input type="text"  name="student_id"  value="{{isset($studentDoc->student_id) ? base64_encode($studentDoc->student_id) : '' }}" hidden />

                                            {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                        </div>
                                    </div>
                                    <div class="invalid-feedback" id="name_error">Please Enter Name of Persons</div>
                                </div>
                                <div class=" col-3 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Date of Birth </label>
                                        <div class="input-group mb-1">
                                            <input type="date" class="form-control" name="birth_dob" value="{{isset($studentDoc->dob_on_identity_card) ? $studentDoc->dob_on_identity_card : '' }}">
                                            {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                        </div>
                                    </div>

                                    {{-- <div class="invalid-feedback" Please Select DOB.</div> --}}
                                </div>
                                <div class=" col-12 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Name of ID Proof </label>
                                        <div class="input-group mb-1">
                                            <input type="text" class="form-control" name="proof_name" id="proof_name" value="{{isset($studentDoc->identity_doc_type) ? $studentDoc->identity_doc_type : '' }}">
                                            {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                        </div>
                                    </div>

                                      <div class="invalid-feedback" id="id_name_error">Please Enter Name of ID Proof</div>
                                </div>
                                <div class=" col-12 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Document ID </label>
                                        <div class="input-group mb-1">
                                            <input type="text" class="form-control" id="ID" name="doc_id_no" value="{{isset($studentDoc->identity_doc_number) ? $studentDoc->identity_doc_number : '' }}">
                                            {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                        </div>
                                    </div>

                                   <div class="invalid-feedback" id="doc_id_error">Please Document ID</div>
                                </div>
                                <div class=" col-12 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Document Issuing Authority </label>
                                        <div class="input-group mb-1">
                                            <input type="text" class="form-control" id="Authority" name="doc_auth" value="{{isset($studentDoc->identity_doc_authority) ? $studentDoc->identity_doc_authority : '' }}">
                                            {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Issue Date </label>
                                        <div class="input-group mb-1">
                                            <input type="date" class="form-control" id="Issue" name="issue_date" value="{{isset($studentDoc->identity_doc_issue_date) ? $studentDoc->identity_doc_issue_date : '1900-01-01' }}">
                                            {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                        </div>
                                    </div>

                         
                                </div>
                                <div class=" col-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Expiry Date </label>
                                        <div class="input-group mb-1">
                                            <input type="date" class="form-control" id="expiry_date"  name="expiry_date" value="{{isset($studentDoc->identity_doc_expiry) ? $studentDoc->identity_doc_expiry : '' }}">
                                            {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                        </div>
                                    </div>

                                       <div class="invalid-feedback" id="expiry_error">Please Expiry Date</div>
                                </div>
                                <div class=" col-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Issuing Country </label>
                                        <div class="input-group mb-1">
                                            <input type="text" class="form-control" id="issue_country" name="issue_country" value="{{isset($studentDoc->identity_doc_country) ? $studentDoc->identity_doc_country : '' }}">
                                            {{-- <label class="input-group-text" for="inputLogo">Upload</label> --}}
                                        </div>
                                    </div>
                               <div class="invalid-feedback" id="issuing_country_error">Please Enter Issuing Country</div>
                                </div>
                                <div class="mb-3 col-12 col-md-6">
                                    <label class="form-label" for="">Remark</label>
                                   <input type="text" class="form-control" id="identity_doc_comments" name="identity_doc_comments" value="{{isset($studentDoc['identity_doc_comments']) ? $studentDoc['identity_doc_comments'] : ''}}" >
                                    <div class="invalid-feedback" id="eduComments_error">Please enter Remark</div>
                                </div>
                                <div class=" col-6 col-md-3">
                                    <div class="form-check mt-5">
                                        <input class="form-check-input id_doc_status1" id="id_doc_status1" type="radio" name="id_doc_status"
                                            value="1" @if (isset($studentDoc->identity_is_approved) && $studentDoc->identity_is_approved === 'Approved')
                                                checked
                                            @endif>
                                        <label class="form-check-label" for="id_doc_status1">
                                            <b>Approved</b>
                                        </label>
                                    </div>
                                </div>
                                <div class=" col-6 col-md-3">
                                    <div class="form-check mt-5">
                                        <input class="form-check-input id_doc_status2" id="id_doc_status2" type="radio" name="id_doc_status" 
                                            value="0" @if (isset($studentDoc->identity_is_approved) && $studentDoc->identity_is_approved != 'Approved')
                                                checked
                                            @endif>
                                        <label class="form-check-label" for="id_doc_status2">
                                           <b> Reject</b>
                                        </label>
                                    </div>
                                      <div class="invalid-feedback" id="approval_error">Please Select Verification Status</div>
                                </div>
                        <div class="col-12">
                            <!-- Button -->
                            <button class="btn btn-primary verifyDoc" type="button">Verify</button>
                        </div>
                              </form>
                        @else
                        <h4 class="text-danger">Document Not Uploaded yet.</h4>
                         @endif
                    <hr class="my-5">
                        <h4 class="mb-0">Education Details</h4>
                        <p class="mb-2">Enter your Higher Education Details</p>

                          @if (isset($studentDoc->edu_doc_file) && !empty($studentDoc->edu_doc_file && Storage::disk('local')->exists($studentDoc->edu_doc_file)))
                            <a href="{{ Storage::disk('local')->url($studentDoc->edu_doc_file)}}" download="{{isset($studentDoc['user']->name) ? $studentDoc['user']->name."_Education_Card": " "}}"><button class="btn btn-primary float-right  m-2">Download Educational Doc</button></a>
                            
                            <form class="row gx-3 needs-validation studentEduDoc" novalidate="">
                         <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="edu_level">Select Higher Education Type</label>
                                        <select class="form-select" id="edu_level"  name="edu_level" required>
                                             {{-- <option value="{{!empty($studentDoc['edu_level']) ? $studentDoc['edu_level'] : '' }}">{{!empty($studentDoc['edu_level']) ? $studentDoc['edu_level'] : 'Select' }}</option> --}}
                                            <option value="5" @if($studentDoc->edu_level == "E5") selected @endif>E5</option>
                                            <option value="6" @if($studentDoc->edu_level == "E6") selected @endif>E6</option>
                                            <option value="7" @if($studentDoc->edu_level == "E7") selected @endif>E7</option>
                                        </select>
                                        <div class="invalid-feedback" id="edu_level_error">Please choose Higher Education Type</div>
                                    </div>
                                       <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="specilization">Specialization</label>
                                        {{-- <select class="form-select" id="specilization" name="specilization" required>
                                            <option value="{{!empty($studentDoc['edu_specialization']) ? $studentDoc['edu_specialization'] : '' }}">{{!empty($studentDoc['edu_specialization']) ? $studentDoc['edu_specialization'] : 'Select' }}</option>
                                            <option value="Bsc">Bsc</option>
                                            <option value="Bcom">Bcom</option>
                                            <option value="MA">MA</option>
                                            <option value="Msc">Msc</option>
                                            <option value="Others">Others</option>
                                        </select> --}}
                                        <input type="text" class="form-control" id="specilization" name="specilization" value="{{isset($studentDoc['edu_specialization']) ? $studentDoc['edu_specialization'] : ''}}" required>

                                        <div class="invalid-feedback" id="specilization_error">Please enter Specialization.</div>
                                    </div>

                        <!-- Country -->
                  
                                          <div class="row eduDocDetails">
                                             <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="">Name As on Document </label>
                                       <input type="text" class="form-control" id="eduStudentName"  name="eduStudentName" value="{{isset($studentDoc['name_on_education_doc']) ? $studentDoc['name_on_education_doc'] : ''}}" >
                                       <input type="text"  name="student_id"  value="{{isset($studentDoc->student_id) ? base64_encode($studentDoc->student_id) : '' }}" hidden />
                                        <div class="invalid-feedback" id="eduStudentName_error">Please choose Higher Education Type</div>
                                        
                                    </div>
                                    <div class="mb-3 col-12 col-md-8">
                                        <label class="form-label" for="">Name of Institution or College</label>
                                       <input type="text" class="form-control" id="institue_name" name="institue_name" value="{{isset($studentDoc['university_name_on_edu_doc']) ? $studentDoc['university_name_on_edu_doc'] : ''}}" >
                                        <div class="invalid-feedback" id="institue_name_error" >Please choose Higher Education Type</div>
                                    </div>
                                         <div class="mb-3 col-12 col-md-4">
                                        <label class="form-label" for=""> Year of Passing</label>
                                       <input type="date" class="form-control" id="passsingYear" name="passsingYear" value="{{isset($studentDoc['passing_year']) ? $studentDoc['passing_year'] : ''}}" >
                                        <div class="invalid-feedback" id="passsingYear_error">Please choose Higher Education Type</div>
                                    </div>
                                     <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="">Name of Course of Degree </label>
                                       <input type="text" class="form-control" id="eduDocName" name="eduDocName" value="{{isset($studentDoc['degree_course_name']) ? $studentDoc['degree_course_name'] : ''}}" >
                                        <div class="invalid-feedback" id="eduDocName_error">Please enter Name of Course of Degree</div>
                                    </div>
                                        <div class="mb-3 col-12 col-md-4">
                                        <label class="form-label" for="">Document ID Number</label>
                                       <input type="text" class="form-control"  id="eduDocId" name="eduDocId" value="{{isset($studentDoc['education_doc_number']) ? $studentDoc['education_doc_number'] : ''}}" >
                                        <div class="invalid-feedback" id="eduDocId_error">Please enter Document ID Number</div>
                                    </div>
                                     {{-- <div class="mb-3 col-12 col-md-4">
                                        <label class="form-label" for="">Grade or Marks</label>
                                       <input type="text" class="form-control" id="eduGrade" name="eduGrade" value="{{isset($studentDoc['grade_on_edu_doc']) ? $studentDoc['grade_on_edu_doc'] : ''}}" >
                                        <div class="invalid-feedback" id="eduGrade_error">Please enter Grade or Marks</div>
                                    </div> --}}
                                     <div class="mb-3 col-12 col-md-4">
                                        <label class="form-label" for="">Education Remark</label>
                                       <input type="text" class="form-control" id="eduRemark" name="eduRemark" value="{{isset($studentDoc['remark_on_edu_doc']) ? $studentDoc['remark_on_edu_doc'] : ''}}" >
                                        <div class="invalid-feedback" id="eduRemark_error">Please enter Education Remark</div>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="">Remark</label>
                                       <input type="text" class="form-control" id="eduComments" name="eduComments" value="{{isset($studentDoc['comments_on_edu_doc']) ? $studentDoc['comments_on_edu_doc'] : ''}}" >
                                        <div class="invalid-feedback" id="eduComments_error">Please enter Remark</div>
                                    </div>
                                      <div class=" col-6 col-md-3">
                                    <div class="form-check mt-5">
                                        <input class="form-check-input edu_doc_status1" type="radio" id="edu_doc_status1" name="edu_doc_status"
                                            value="1" @if (isset($studentDoc->edu_is_approved) && $studentDoc->edu_is_approved === 'Approved')
                                                checked
                                            @endif>
                                        <label class="form-check-label" for="edu_doc_status1">
                                            <b>Approved</b>
                                        </label>
                                    </div>
                                </div>
                                <div class=" col-6 col-md-3">
                                    <div class="form-check mt-5">
                                        <input class="form-check-input edu_doc_status2" d="edu_doc_status2" type="radio" name="edu_doc_status" 
                                            value="0" @if (isset($studentDoc->edu_is_approved) && $studentDoc->edu_is_approved != 'Approved')
                                                checked
                                            @endif>
                                        <label class="form-check-label" for="edu_doc_status2">
                                           <b> Reject</b>
                                        </label>
                                    </div>
                                      <div class="invalid-feedback" id="edu_doc_status_error">Please Select Verification Status</div>
                                </div>
                                    </div>
                                       <div class="col-12">
                            <!-- Button -->
                            <button class="btn btn-primary verifyEduDoc" type="button">Verify</button>
                        </div>
                        </form>
                                     @else

                                    <h4 class="text-danger">Document Not Uploaded yet.</h4>
                                    @endif
                     
                            @if (isset($studentDoc->resume_file) && !empty($studentDoc->resume_file &&  Storage::disk('local')->exists($studentDoc->resume_file)))
                            <a href="{{ Storage::disk('local')->url($studentDoc->resume_file)}}" download="{{isset($studentDoc['user']->name) ? $studentDoc['user']->name."_Resume": " "}}"><button class="btn btn-primary float-right  m-2">Download Resume</button></a>
                             @endif
                      
                    </div>
                         <hr class="my-5">

                <!-- Social Profile Card header -->
                <div class="card-header">
                    <h3 class="mb-0">Social Profile</h3>
                    <p class="mb-0">Social profile links in below social accounts.</p>
                </div>
                <div class="card-body">

                    <!-- Facebook -->
                    <div class="row mb-5">
                        <div class="col-lg-2 col-md-4 col-12">
                            <h4>Facebook</h4>
                        </div>
                        <div class="col-lg-10 col-md-8 col-12">
                            <input type="text" class="form-control mb-1"  placeholder="https://www.facebook.com/" value="{{$studentData->facebook}}">
                            <small>Add your Facebook URL.</small>
                        </div>
                    </div>
                    <!-- Instagram -->
                    <div class="row mb-5">
                        <div class="col-lg-2 col-md-4 col-12">
                            <h5>Instagram</h5>
                        </div>
                        <div class="col-lg-10 col-md-8 col-12">
                            <input type="text" class="form-control mb-1" placeholder="https://www.instagram.com/" value="{{$studentData->instagram}}">
                            <small>Add your Instagram URL.</small>
                        </div>
                    </div>
                    <!-- Linked in -->
                    <div class="row mb-5">
                        <div class="col-lg-2 col-md-4 col-12">
                            <h5>LinkedIn</h5>
                        </div>
                        <div class="col-lg-10 col-md-8 col-12">
                            <input type="text" class="form-control mb-1" placeholder="https://www.linkedin.com/" value="{{$studentData->linkedIn}}"> 
                            <small>Add your linkedin profile URL.</small>
                        </div>
                    </div>
                    <!-- Youtube -->
                    <div class="row mb-3">
                        <div class="col-lg-2 col-md-4 col-12">
                            <h5>X (Twitter)</h5>
                        </div>
                        <div class="col-lg-10 col-md-8 col-12">
                            <input type="text" class="form-control mb-1" placeholder="https://twitter.com/i/flow/login" value="{{$studentData->twitter}}">
                            <small>Add your X (Twitter) profile URL.</small>
                        </div>
                    </div>
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
</section>
</main>

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
                        <input type="text" class="form-control" id="MobileNumber" placeholder="Mobile Number" required>
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