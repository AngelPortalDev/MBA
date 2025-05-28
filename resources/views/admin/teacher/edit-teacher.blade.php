<!-- Header import -->
@extends('admin.layouts.main')
@section('content')


    <!-- Container fluid -->
    <section class="container-fluid p-4">
        <div class="row justify-content-between ">
            <!-- Page Header -->
            <div class="col-lg-12 col-12">
                <div class=" pb-3 mb-3 d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Edit Teacher
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Edit Teacher</a></li>
                                <!-- <li class="breadcrumb-item active" aria-current="page">All Admin</li> -->
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">


                    </div>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="offset-xl-3 col-xl-6 col-12">
                <!-- card -->
                <form class="TeacherForm" novalidate enctype="multipart/form-data">
                    <div class="card mb-4">
                        <!-- card body -->
                        <div class="card-body">

                            <!-- row -->
                            <div class="d-lg-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center mb-4 mb-lg-0">

                                    <div class="me-2 position-relative">
                                            
                                        @if (!empty($teacherData->image))
                                            <img class="avatar-xl rounded-circle border border-4 border-white imageAdminPreview object-fit-cover"
                                            src="{{ Storage::url($teacherData->image) }}">
                                        @else
                                            <img  src="{{ Storage::url('teacherDocs/no-image.jpeg') }}"
                                                class="avatar-xl rounded-circle border border-4 border-white imagePreview"
                                                alt="avatar" />
                                        @endif
                                        <div class="student-profile-photo-edit-pencil-icon">
                                            <input type="file" id="image_file" class="image profileTeacherPic" name="image_file" accept=".png, .jpg, .jpeg">
                                            <label for="image_file"><i class="bi-pencil"></i></label>
                                            <input type="text" class="old_img_name" value="{{$teacherData->image}}" name="old_img_name" id="old_img_name" hidden="">
                                        </div>
                                        <div class="invalid-feedback" id="file_error">Please Upload File</div>
                                    </div>

                                    <div class="ms-2">
                                        <h4 class="mb-0">{{isset($teacherData->lactrure_name) ? $teacherData->lactrure_name : ''}}</h4>
                                        <div>
                                            <span>
                                                @if(!empty($teacherData->email))
                                                <i class="fe fe-mail fs-4 align-middle"></i>
                                                <span class="ms-1">{{isset($teacherData->email) ? $teacherData->email : ''}}</span>
                                                @endif
                                            </span>
                                            <span class="ms-3">
                                                @if(!empty($teacherData->mobile))
                                                <i class="fe fe-phone fs-4 align-middle"></i>
                                                <span class="ms-1">{{isset($teacherData->mobile) ? $teacherData->mobile : ''}}</span>
                                                @endif
                                            </span>
                                            <span class="ms-3">
                                                @if(!empty($teacherData->university_code))
                                                <span class="fs-5 align-middle">University Code : </span>
                                                <span class="ms-1">{{isset($teacherData->university_code) ? $teacherData->university_code : ''}}</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <!-- card body -->
                        <div class="card-body">
                            <h4 class="mb-4 border-bottom pb-2">Edit Teacher Profile</h4>

                            <!-- row -->
                            <div class="row gx-3">
                                <!-- input -->
                                <input type="hidden" class="form-control" id="teacher_id" value="{{base64_encode($teacherData->id)}}" name="teacher_id" required>
                                <?php $Name = explode(" ",$teacherData->lactrure_name);?>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="firstName">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="First Name" id="firstName" value="{{$Name[0]}}" name="first_name"  required>
                                    <div class="invalid-feedback" id="first_name_error">Please enter your first name.</div>
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="lastName">Last Name  <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Last Name" id="lastName" value="{{$Name[1]}}" name="last_name"   required>
                                    <div class="invalid-feedback" id="last_name_error">Please enter your last name.</div>
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="Designation">Designation <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Designation" id="designation" name="designation"   value="{{htmlspecialchars_decode($teacherData['designation'])}}" required>
                                    <div class="invalid-feedback" id="designation_error">Please enter your designation.</div>
                                </div>     
                                <div class="mb-3 col-md-6">
                                    <label for="catgeory" class="form-label">Catgeory <span class="text-danger">*</span></label>
                                    <div class="category_id">
                                        <select class="form-select" aria-label="Default select example" id="category_id" name="category_id">
                                            <option value="">Select</option>
                                                <option value="1"  @if('1' == $teacherData['category_id']) selected @endif>Primary</option>
                                                <option value="2"  @if('2' == $teacherData['category_id']) selected @endif>Secondary</option>
                                                <option value="0"  @if('0' == $teacherData['category_id']) selected @endif>Institute Associate</option>
                                        </select>
                                        <div class="invalid-feedback" id="category_error" >Please select category</div>
                                    </div>
                                </div>                              
                                <!-- input -->
                                <?php 
                                $mob_code = ''; $mobile_no =''; $selected_country_code='';
                                 if($teacherData->mobile != null){
                                    $Mobile = explode(" ",$teacherData->mobile);
                                    if($Mobile[0]){
                                        $mob_code = $Mobile[0];
                                        $selected_country_code = $mob_code; // Example selected country code

                                    }
                                    if($Mobile[1]){
                                        $mobile_no = $Mobile[1];
                                    }
                                }
                                ?>

                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" placeholder="Email Address" id="email"  value="{{$teacherData['email']}}" name="email"  required>
                                    <div class="invalid-feedback" id="email_error">Please enter valid email address.</div>
                                </div>
                                <!-- input -->
                                <div class="mb-3 col-12">
                                    <label for="MobileNumber" class="form-label">Mobile Number</label>
                                    <div class="mobile-with-country-code">
                                        <select class="form-select" aria-label="Default select example" id="mob_code" name="mob_code">
                                            <option value="">Select</option>
                                             @foreach (getDropDownlist('country_master',['id','country_code','country_code']) as $mob_code)
                                             <option value="+{{$mob_code->country_code}}" @if('+'.$mob_code->country_code == $selected_country_code) selected @endif>+{{$mob_code->country_code}}</option>
                                                @endforeach
                                        </select>
                                            <div class="invalid-feedback" id="mob_code_error" >Please select Mob Code</div>
                                        <input type="number" id="mobile" class="form-control" name="mobile" placeholder="123 4567 890" value="{{$mobile_no}}" required="">
                                    </div>
                                    <br>
                                    <div class="invalid-feedback" id="mobile_error" >Please enter Mobile Number</div>                                
                                </div>
                                <div class="mb-3 col-12 col-md-12">
                                    <label class="form-label">Resume</label>
                                    <small class="text-muted">Upload JPG/JPEG/PNG/PDF (Max: 2MB)</small>
                                    <input type="file" id="resume_file" name="resume_file" class="form-control"
                                        accept=".jpg, .jpeg, .png, .pdf">
                                    <input type="hidden" class="old_resume_name" value="{{$teacherData->resume}}" name="old_resume_name" id="old_resume_name" hidden="">
                                    <div class="invalid-feedback" id="resume_error">Please upload resume.</div>
                                    <br>
                                    @if (isset($teacherData->resume) && !empty($teacherData->resume))
                                        <div class="mb-2">
                                            <a href="{{ Storage::url($teacherData->resume) }}"
                                                target="_blank" class="btn btn-primary">View Resume</a>
                                        </div>
                                    @else
                                        <p>No Resume available</p>
                                    @endif
                                    {{-- @endif --}}
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="specialization" class="form-label">
                                        Specialization
                                        <small>(Maximum 50 words)</small>
                                    </label>
                                    <textarea class="form-control" id="specialization" rows="5" name="specialization" placeholder="Write here...">{{ isset($teacherData->specialization) ? htmlspecialchars_decode($teacherData->specialization) : '' }}</textarea>
                                    <div class="invalid-feedback" id="specialization_error">Please enter specialization</div>

                                </div>

                                <div class="col-md-12">
                                    <label for="customerNotes" class="form-label">
                                        About Teacher
                                        <small>(Maximum 50 words)</small>
                                    </label> <span class="text-danger">*</span>
                                    <textarea class="form-control" id="about_teacher" rows="5" name="about_teacher" placeholder="Write here..." required="">{{ isset($teacherData->discription) ? htmlspecialchars_decode($teacherData->discription) : '' }}</textarea>
                                    <div class="invalid-feedback" id="about_teacher_error">Please enter Details</div>

                                </div>
                            </div>
                        </div>
                    </div>
                   

                    <div class="d-flex justify-content-end">
                        <!-- buttons -->
                        <button class="btn btn-primary  me-2 teacherCreate" type="submit">Save Now</button>
                        <a href="{{route('admin.teacher.teacher')}}" class="btn btn-outline-primary" >Cancel</a>

                    </div>
                </form>
            </div>
        </div>
        
    </section>
</main>


@endsection
