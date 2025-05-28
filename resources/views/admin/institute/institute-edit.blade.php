<!-- Header import -->
@extends('admin.layouts.main')
@section('content')

    <!-- Container fluid -->
    <section class="container p-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom d-md-flex align-items-center justify-content-between ">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-0 h2 fw-bold">Institute</h1>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.institute.institute') }}">Institute List</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Institute </li>
                            </ol>
                        </nav>
                    </div>
                    <!-- button -->
                    <div>
                            <a href="{{ route('admin.institute.institute') }}" class="btn btn-primary me-2 d-none d-md-block">Back</a>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- Container fluid -->

    <section class="py-4 container pt-0 my-learning-page">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- card -->
                <div class="card mb-1">
                    <!-- card body -->
                    <div class="card-body">

                        <div class="d-flex align-items-center flex-wrap">

                            <form class="profileImage position-relative" enctype="multipart/form-data" >
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
                                <div class="student-profile-photo-edit-pencil-icon">

                                    <input type="file" id="imageUpload_profile" class="image profileInstitutePic" name="image_file" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" id="user_id" value="{{ isset($instituteData[0]->user->id) ? base64_encode($instituteData[0]->user->id) : '' }}" name="user_id">
                                    <input type="hidden" id="user_name" value="{{ isset($instituteData[0]->user->name) ? base64_encode($instituteData[0]->user->name) : '' }}" name="user_name">
                                    <label for="imageUpload_profile"><i class="bi-pencil"></i></label>
                                    <input type="text" class='curr_img' value="{{ isset($instituteData[0]->user->photo) ? $instituteData[0]->user->photo : '' }}" name='old_img_name' hidden>

                                </div>
                            </form>
                            <div class="ms-sm-4">

                                <!-- text -->
                                <h3 class="mb-1">{{isset($instituteData[0]->user->name) ? htmlspecialchars_decode($instituteData[0]->user->name.' '.$instituteData[0]->user->last_name)  : 'NA' }}</h3>
                                <div class="d-flex flex-wrap flex-col flex-md-row">
                                    <div>
                                        <i class="fe fe-mail fs-4 align-middle"></i>
                                        <a href="mailto:{{ isset($instituteData[0]->user->email) ? $instituteData[0]->user->email : '' }}" class="ms-1">
                                            {{ isset($instituteData[0]->user->email) ? $instituteData[0]->user->email : 'NA' }}
                                        </a>
                                    </div>
                                    <div class="ms-sm-3 ms-2">
                                        <i class="fe fe-phone fs-4 align-middle"></i>
                                        <a href="tel:{{ isset($instituteData[0]->user->mob_code) && isset($instituteData[0]->user->phone) ? $instituteData[0]->user->mob_code.$instituteData[0]->user->phone : '' }}">
                                            <span class="ms-1">
                                                {{ isset($instituteData[0]->user->mob_code) && isset($instituteData[0]->user->phone) ? $instituteData[0]->user->mob_code.' '.$instituteData[0]->user->phone : 'NA' }}
                                            </span>
                                        </a>
                                    </div>
                                    <div class="ms-sm-3 ms-2" style="color:#333faf">
                                        <span >Code : </span> 
                                        <span class="ms-1">
                                            {{ isset($instituteData[0]->university_code) ? $instituteData[0]->university_code : 'NA' }}
                                        </span>
                                        </a>
                                    </div>
                                    <div class="ms-sm-3 ms-2" style="color:#333faf">
                                        <span >English Test Code : </span> 
                                        <span class="ms-1">
                                            {{ isset($instituteData[0]->englist_test_pass_code) ? $instituteData[0]->englist_test_pass_code : 'NA' }}
                                        </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>



        <!-- row -->
        <div class="row mb-6">
            <div class="col-md-12">
                <!-- Nav -->

                <ul class="nav nav-lb-tab mb-6" id="tab" role="tablist">
                    {{-- <li class="nav-item ms-0" role="presentation">
                  <a class="nav-link active" id="dashboard-tab" data-bs-toggle="pill" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
                </li>
                <li class="nav-item ms-0" role="presentation">
                  <a class="nav-link"  id="assigned-courses-tab" data-bs-toggle="pill" href="#assigned-courses" role="tab" aria-controls="assigned-courses" aria-selected="true">Assigned courses</a>
                </li>
                <li class="nav-item ms-0" role="presentation">
                  <a class="nav-link"  id="examination-tab" data-bs-toggle="pill" href="#examination" role="tab" aria-controls="examination" aria-selected="true">Examination</a>
                </li> --}}

                    <li class="nav-item  ms-0" role="presentation">
                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="pill" href="#dashboard" role="tab"
                            aria-controls="dashboard" aria-selected="false">Dashboard</a>
                    </li>
                    <li class="nav-item  ms-0" role="presentation">
                        <a class="nav-link" id="students-tab" data-bs-toggle="pill" href="#students" role="tab"
                            aria-controls="students" aria-selected="false">Students</a>
                    </li>
                    <li class="nav-item  ms-0" role="presentation">
                        <a class="nav-link" id="teachers-tab" data-bs-toggle="pill" href="#teachers" role="tab"
                            aria-controls="teachers" aria-selected="false">Teachers</a>
                    </li>
                    <li class="nav-item  ms-0" role="presentation">
                        <a class="nav-link" id="promocode-tab" data-bs-toggle="pill" href="#promocode" role="tab"
                            aria-controls="promocode" aria-selected="false">Promo Code</a>
                    </li>
                    <li class="nav-item  ms-0" role="presentation">
                        <a class="nav-link " id="profile-tab" data-bs-toggle="pill" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Profile</a>
                    </li>
                    {{-- <li class="nav-item  ms-0" role="presentation">
                  <a class="nav-link" id="security-tab" data-bs-toggle="pill" href="#security" role="tab" aria-controls="security" aria-selected="false">Security</a>
                </li> --}}
                    {{-- <li class="nav-item  ms-0" role="presentation">
                    <a class="nav-link" id="aboutme-tab" data-bs-toggle="pill" href="#aboutme" role="tab" aria-controls="aboutme" aria-selected="false">About Me</a>
                  </li> --}}
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="tabContent">

                    <div class="tab-pane fade  show active" id="dashboard" role="tabpanel"
                        aria-labelledby="dashboard-tab">
                        <div>
                            <div class="row mb-3">
                                <div class="col-lg custom-col mt-2" style="padding: 0px 5px">
                                    <div class="d-flex align-items-center rounded-2 mt-0 institute-dashboard-card"
                                        style="padding: 5px 8px; background-color: #fae0b4">
                                        <div class="icon">
                                            <i class="bi bi-person-workspace text-white rounded-2 bg-warning p-2"
                                                style="font-size: 1rem"></i>
                                        </div>
                                        <div class="instituteIinfo  ms-2">
                                            <h4 class="mb-0 fw-bold intitute-dashboardtitles">{{$registeredStudentCount}}</h4>
                                            <h5>Registered Students</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg custom-col mt-2" style="padding: 0px 5px">
                                    <div class="d-flex align-items-center rounded-2 mt-0 institute-dashboard-card"
                                        style="padding: 5px 8px; background-color: #e0d4f7;">
                                        <div class="icon">
                                            <i class="bi bi-person-vcard text-white rounded-2 p-2"
                                               style="font-size: 1rem; background-color: #6f42c1;"></i>
                                        </div>
                                        <div class="instituteIinfo ms-2">
                                            <h4 class="mb-0 fw-bold intitute-dashboardtitles">{{$registeredTeacherCount}}</h4>
                                            <h5>Registered Teachers</h5>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg custom-col mt-2" style="padding: 0px 5px">
                                    <div class=" d-flex align-items-center rounded-2 mt-0 institute-dashboard-card"
                                        style="padding: 5px 8px; background-color: #caf2dc">
                                        <div class="icon">
                                            <i class="bi bi-mortarboard text-white rounded-2 bg-success p-2"
                                                style="font-size: 1rem"></i>
                                        </div>
                                        <div class="instituteIinfo ms-2">
                                            <h4 class="mb-0 fw-bold intitute-dashboardtitles">{{$purchasedCount}}</h4>
                                            <h5>Purchased Students</h5>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg custom-col mt-2" style="padding: 0px 5px">
                                    <!-- Card -->
                                    <div class=" d-flex align-items-center rounded-2 mt-0 institute-dashboard-card"
                                        style="padding: 5px 8px; background-color: #bce3f5">
                                        <div class="icon">
                                            <i class="bi bi-people-fill text-white rounded-2 bg-info p-2"
                                                style="font-size: 1rem"></i>
                                        </div>
                                        <div class="instituteIinfo ms-2">
                                            <h4 class="mb-0 fw-bold intitute-dashboardtitles">{{$enrolledCount}}</h4>
                                            <h5>Enrolled Students</h5>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg custom-col mt-2" style="padding: 0px 5px">
                                    <div class="d-flex align-items-center rounded-2 institute-dashboard-card"
                                        style="padding: 5px 8px; background-color: #d4f4d4">
                                        <div class="icon">
                                            <i class="bi bi-check2 text-white rounded-2 bg-success p-2" style="font-size: 1.5rem"></i>
                                        </div>
                                        <div class="instituteIinfo ms-2">
                                            <h4 class="mb-0 fw-bold intitute-dashboardtitles">{{$coursesPassedCount ?? 0}}</h4>
                                            <h5>Courses Passed</h5>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-lg custom-col mt-2" style="padding: 0px 5px">
                                    <div class="d-flex align-items-center rounded-2 institute-dashboard-card"
                                        style="padding: 5px 10px; background-color: #fca6a6">
                                        <div class="icon">
                                            <i class="bi bi-x-lg text-white rounded-2 bg-danger p-2" style="font-size: 1.5rem"></i>
                                        </div>
                                        <div class="instituteIinfo ms-4">
                                            <h4 class="mb-0 fw-bold intitute-dashboardtitles">{{$coursesFailedCount ?? 0}}</h4>
                                            <h5>Courses Failed</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- First Chart Column -->
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="card p-4 mt-3" style="box-shadow: 0 2px 5px #0000001a">
                                        <h4>Total Course Sales Report</h4>
                                        <div class="row mt-2 mb-2">
                                            <div class="col">
                                                <label for="today" class="inline-block">Today</label>
                                                <div class="d-flex">
                                                    <h3 class="text-primary"> {{$todayCourseSales}} </h3>
                                                    {{-- <i class="bi bi-graph-up-arrow me-2 ms-2 fs-3 "
                                                        style="color: #38a169 "></i> --}}
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="today" class="inline-block">This Week</label>
                                                <div class="d-flex">
                                                    <h3 class="text-primary">{{$thisWeekCourseSales}}</h3>
                                                    {{-- <i class="bi bi-graph-down-arrow me-2 ms-2 color-orange fs-3"></i> --}}
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="today" class="inline-block">This Months</label>
                                                <div class="d-flex">
                                                    <h3 class="text-primary">{{$thisMonthCourseSales}}</h3>
                                                    {{-- <i class="bi bi-graph-up-arrow me-2 ms-2 fs-3 "
                                                        style="color: #38a169 "></i> --}}
                                                </div>
                                            </div>
                                            {{-- <div class="progress p-0 mt-2" role="progressbar"
                                                aria-label="Success example" aria-valuenow="25" aria-valuemin="0"
                                                aria-valuemax="100" style="height: 12px;">
                                                <div class="progress-bar bg-orange" style="width: 47%">47%</div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="card p-4 mt-3" style="box-shadow: 0 2px 5px #0000001a">
                                        <h4>Fees Collection Report</h4>
                                        <div class="row mt-2 mb-2">
                                            <div class="col">
                                                <label for="today" class="inline-block">Today</label>
                                                <div class="d-flex">
                                                    <h3 class="text-primary"><i class="bi bi-currency-euro"></i> {{$todaySales}} </h3>
                                                    {{-- <i class="bi bi-graph-up-arrow me-2 ms-2 fs-3 "
                                                        style="color: #38a169 "></i> --}}
                                                </div>

                                            </div>
                                            <div class="col">
                                                <label for="today" class="inline-block">This Week</label>
                                                <div class="d-flex">
                                                    <h3 class="text-primary"><i class="bi bi-currency-euro"></i> {{$thisWeekSales}} </h3>
                                                    {{-- <i class="bi bi-graph-down-arrow me-2 ms-2 color-orange fs-3"></i> --}}
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="today" class="inline-block">This Months</label>
                                                <div class="d-flex">
                                                    <h3 class="text-primary"><i class="bi bi-currency-euro"></i> {{$thisMonthSales}} </h3>
                                                    {{-- <i class="bi bi-graph-up-arrow me-2 ms-2 fs-3 "
                                                        style="color: #38a169 "></i> --}}
                                                </div>
                                            </div>
                                            {{-- <div class="progress p-0 mt-2" role="progressbar"
                                                aria-label="Success example" aria-valuenow="25" aria-valuemin="0"
                                                aria-valuemax="100" style="height: 12px;">
                                                <div class="progress-bar bg-success" style="width: 76%;">76%</div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <!-- Card header -->
                                <div class="card-header">
                                    <h3 class="h4 mb-0">New Student List</h3>
                                </div>
                                <!-- Table -->
                                <div class="card">
                                    <!-- Table -->
                                    <div class="table-responsive">
                                        <table class="table table-hover table-centered text-nowrap instituteLatestStudentList">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Course</th>
                                                    <th>Purchased</th>
                                                    <th>Enrolled</th>
                                                    <th>Exam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
        
                            </div>
                        </div>

                    </div>

                    <!-- Students Tab -->
                    <div class="tab-pane fade" id="students" role="tabpanel" aria-labelledby="students-tab">
                        <div class="card card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-centered text-nowrap instituteStudentList w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Purchased</th>
                                            <th>Enrolled</th>
                                            <th>Exam</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Teachers Tab -->
                    <div class="tab-pane fade" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                        <div class="card card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-centered text-nowrap instituteTeacherList w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Designation</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Promo Code Tab -->
                    <div class="tab-pane fade" id="promocode" role="tabpanel" aria-labelledby="promocode-tab">
                        <div class="card card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 text-nowrap promoCodeList" width="100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Course Title</th>
                                            <th>Code</th>
                                            <th>Discount (%)</th>
                                            <th>Expiry Date</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Tab -->
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <!-- Form -->
                                    <form class="row gx-3 universityForm" novalidate enctype="multipart/form-data">

                                        <!-- Hidden Institute ID -->
                                        <input type="hidden" id="institute_id" class="form-control" name="institute_id"
                                            required
                                            value="{{ isset($instituteData[0]->user['id']) ? base64_encode($instituteData[0]->user['id']) : '' }}">

                                        <input type="hidden" id="email" class="form-control" name="email"
                                            required
                                            value="{{ isset($instituteData[0]->user['email']) ? base64_encode($instituteData[0]->user['email']) : '' }}">

                                        <!-- Institute Information -->
                                        <h5 class="mb-3 text-primary"><b>Institute Details:</b></h5>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="university_name">Institute Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="university_name" class="form-control"
                                                    name="university_name" required placeholder="University Name"
                                                    value="{{ isset($instituteData[0]->user['name']) ? $instituteData[0]->user['name'] : '' }}">
                                                <div class="invalid-feedback" id="first_name_error">Please enter
                                                    university name.</div>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="website">Website <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="website" class="form-control" name="website"
                                                    required placeholder="Website"
                                                    value="{{ isset($instituteData[0]->website) ? $instituteData[0]->website : '' }}">
                                                <div class="invalid-feedback" id="website_error">Please enter website.
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Address Information -->
                                        <h5 class="mb-3 text-primary"><b>Address Details:</b></h5>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="billing_city">Billing City <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="billing_city" class="form-control"
                                                    name="billing_city" required placeholder="Billing City"
                                                    value="{{ isset($instituteData[0]->billing_city) ? $instituteData[0]->billing_city : '' }}">
                                                <div class="invalid-feedback" id="billing_city_error">Please enter billing
                                                    city.</div>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="billing_state">Billing State <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="billing_state" class="form-control"
                                                    name="billing_state" required placeholder="Billing State"
                                                    value="{{ isset($instituteData[0]->billing_state) ? $instituteData[0]->billing_state : '' }}">
                                                <div class="invalid-feedback" id="billing_state_error">Please enter
                                                    billing state.</div>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="billing_country">Billing Country <span
                                                        class="text-danger">*</span></label>
                                                <select name="billing_country" id="billing_country" class="form-control">
                                                    <option value="" selected>-Select-</option>
                                                    @foreach (getDropDownlist('country_master', ['id', 'country_code', 'country_flag', 'country_name']) as $mob_code)
                                                        <option value="{{ $mob_code->country_name }}"
                                                            {{ old('billing_country', trim($instituteData[0]->billing_country)) == trim($mob_code->country_name) ? 'selected' : '' }}>
                                                            {{ $mob_code->country_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback" id="billing_country_error">Please enter
                                                    billing country.</div>
                                            </div>

                                            <div class="mb-3 col-12 col-md-6">
                                                <label for="textarea-input" class="form-label">Address <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" id="textarea-input" name="address" rows="2"
                                                    placeholder="Enter your address here...">{{ isset($instituteData[0]->address) ? $instituteData[0]->address : '' }}</textarea>
                                                <div class="invalid-feedback" id="address_error">Address should be less
                                                    than 100 words.</div>
                                                <small>Address max 100 words</small>
                                            </div>
                                        </div>

                                        <!-- Institute Contact Information -->
                                        <h5 class="mb-3 text-primary"><b>Contact Details:</b></h5>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="contact_person_name">Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="contact_person_name" class="form-control"
                                                    name="contact_person_name" required placeholder="Contact Person Name"
                                                    value="{{ isset($instituteData[0]->contact_person_name) ? $instituteData[0]->contact_person_name : '' }}">
                                                <div class="invalid-feedback" id="contact_person_name_error">Please enter
                                                    name.</div>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="contact_person_email">Email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" id="contact_person_email" class="form-control"
                                                    name="contact_person_email" placeholder="Email"
                                                    value="{{ isset($instituteData[0]->contact_person_email) ? $instituteData[0]->contact_person_email : '' }}">
                                                <div class="invalid-feedback" id="contact_person_email_error">Please enter
                                                    email.</div>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Mobile No. <span
                                                        class="text-danger">*</span></label>
                                                <div class="d-flex gap-2">
                                                    <!-- Country Code -->
                                                    <select name="contact_person_mob_code" id="contact_person_mob_code"
                                                        class="form-select w-25">
                                                        <option value="" selected>Choose Code</option>
                                                        @foreach (getDropDownlist('country_master', ['id', 'country_code', 'country_flag', 'country_name']) as $mob_code)
                                                            <option value="+{{ $mob_code->country_code }}"
                                                                {{ old('contact_person_mob_code', $instituteData[0]->contact_person_mob_code) == "+$mob_code->country_code" ? 'selected' : '' }}>
                                                                +{{ $mob_code->country_code }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="number" id="contact_person_mobile" class="form-control"
                                                        name="contact_person_mobile" required placeholder="123 4567 890"
                                                        value="{{ isset($instituteData[0]->contact_person_mobile) ? $instituteData[0]->contact_person_mobile : '' }}">
                                                </div>
                                                <div class="invalid-feedback" id="contact_person_mob_code_error">Please
                                                    enter Mobile code.</div>
                                                <div class="invalid-feedback" id="contact_person_mobile_error">Please
                                                    enter Mobile no.</div>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="contact_person_designation">Designation
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" id="contact_person_designation"
                                                    class="form-control" name="contact_person_designation"
                                                    placeholder="Designation"
                                                    value="{{ isset($instituteData[0]->contact_person_designation) ? $instituteData[0]->contact_person_designation : '' }}">
                                                <div class="invalid-feedback" id="contact_person_designation_error">Please
                                                    enter designation.</div>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-12 col-md-6">
                                            <label class="form-label">Photo ID <span class="text-danger">*</span></label>
                                            @if (isset($instituteData[0]->photo_id) && !empty($instituteData[0]->photo_id))
                                                <div class="mb-2">
                                                    <a href="{{ Storage::url($instituteData[0]->photo_id) }}"
                                                        target="_blank" class="btn btn-primary">View Photo ID</a>
                                                </div>
                                            @else
                                                <p>No Photo ID available</p>
                                            @endif

                                            {{-- @if ($instituteData[0]->is_approved != 1) --}}
                                            <!-- File Upload Input -->
                                            <input type="file" id="photo_id" name="photo_id" class="form-control"
                                                accept=".jpg, .jpeg, .png">
                                            <small class="text-muted">Upload JPG/JPEG/PNG (Max: 2MB)</small>
                                            <div class="invalid-feedback" id="photo_id_error">Please upload photo ID.
                                            </div>
                                            {{-- @endif --}}
                                        </div>

                                        <div class="mb-3 col-12 col-md-6">
                                            <label class="form-label">License <span class="text-danger">*</span></label>
                                            @if (isset($instituteData[0]->licence) && !empty($instituteData[0]->licence))
                                                <div class="mb-2">
                                                    <a href="{{ Storage::url($instituteData[0]->licence) }}"
                                                        target="_blank" class="btn btn-primary">View License</a>
                                                </div>
                                            @else
                                                <p>No License available</p>
                                            @endif
                                            {{-- @if ($instituteData[0]->is_approved != 1) --}}
                                            <!-- File Upload Input -->
                                            <input type="file" id="licence" name="licence" class="form-control"
                                                accept=".jpg, .jpeg, .png">
                                            <small class="text-muted">Upload JPG/JPEG/PNG (Max: 2MB)</small>

                                            <div class="invalid-feedback" id="licence_error">Please upload license.</div>
                                            {{-- @endif --}}
                                        </div>


                                        <!-- Approval Status -->
                                        <h5 class="mb-3 text-primary"><b>Approval Status:</b></h5>
                                        <div class="mb-5 d-flex gap-3 align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="institute_approved3"
                                                    name="is_approved" value="0"
                                                    @if (!isset($instituteData[0]->is_approved) || $instituteData[0]->is_approved == 0) checked @endif>
                                                <label class="form-check-label"
                                                    for="institute_approved3"><b>Pending</b></label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="is_approved1"
                                                    name="is_approved" value="1"
                                                    @if (isset($instituteData[0]->is_approved) && $instituteData[0]->is_approved == 1) checked @endif>
                                                <label class="form-check-label" for="is_approved1"><b>Approve</b></label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="institute_approved2"
                                                    name="is_approved" value="2"
                                                    @if (!isset($instituteData[0]->is_approved) || $instituteData[0]->is_approved == 2) checked @endif>
                                                <label class="form-check-label"
                                                    for="institute_approved2"><b>Reject</b></label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="institute_approved4"
                                                    name="is_approved" value="4"
                                                    @if (!isset($instituteData[0]->is_approved) || $instituteData[0]->is_approved == 4) checked @endif>
                                                <label class="form-check-label"
                                                    for="institute_approved4"><b>Re-upload</b></label>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="textarea-input" class="form-label">Reject Reason</label>
                                            <textarea class="form-control" id="textarea-input" name="reject_reason" rows="2"
                                                placeholder="Enter your reason here...">{{ isset($instituteData[0]->reject_reason) ? $instituteData[0]->reject_reason : '' }}</textarea>
                                            <div class="invalid-feedback" id="reject_reason_error">Reject reason should be
                                                less than 100 words.</div>
                                        </div>


                                        <!-- Save Button -->
                                        <div class="col-12">
                                        <button class="btn btn-primary editInstituteProfile" type="button">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $('#promocode-tab').on('click', function() {
            var baseUrl = window.location.origin + "/";
        var id= "<?php echo base64_encode($instituteData[0]->user['id']) ?>";
            var cat = 'institute';
            $.ajax({
            url: baseUrl + "admin/promocode-get-data/"+ id + '/' + cat,
                method: "GET",
            success: function (data) {
                    $(".promoCodeList").DataTable().destroy();
                    $(".promoCodeList").DataTable({
                        data: data,
                    columns: [
                        {
                                data: null,
                            render: function (data, type, full, row) {
                                    i = row.row + 1;
                                    return i;
                                },
                             width:"10%"
                            },
                            {
                                data: null,
                            render: function (row) {
                                    var Status = '';
                                    if (row.status == 'Active') {
                                    Status = '<span class="badge-dot bg-success ms-1 d-inline-block align-middle"></span>';
                                    } else {
                                    Status = '<span class="badge-dot bg-danger ms-1 d-inline-block align-middle"></span>';
                                    }
                                return '<div class="d-flex align-items-center"><p class="custom-title mb-0 text-wrap-title">' + row.course_title + Status + '</p></div>';
                                },
                                width: "40%"
                            },
                            {
                                data: null,
                            render: function (row) {
                                    return row.coupon_name;

                                },
                             width:"15%"
                            },
                            {
                                data: null,
                            render: function (row) {
                                    return row.coupon_discount;
                                },
                            width:"10%"
                            },
                            {
                                data: null,
                            render: function (row) {
                                    return row.coupon_validity;
                                },
                             width:"10%"
                            },
                            // Add more columns as needed
                        ],
                    });
                },
            error: function (xhr, status, error) {
                    console.error(error);
                },
            });
        });

    $(document).ready(function () {
        InstituteStudentList();
        InstituteTeacherList();
        latestCourseStudentList()
    });
    function InstituteStudentList(){
        var baseUrl = window.location.origin;
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var userRole = "{{ Auth::user()->role }}";
        var id= "<?php echo base64_encode($instituteData[0]->user['id']) ?>";
        url = baseUrl + "/admin/institute-students/"+id;

        $.ajax({
            url: url,
            method: 'GET',
            success: function (data) {
                console.log(data);
                $(".instituteStudentList").DataTable().destroy();

                $(".instituteStudentList").DataTable({
                    data: data,
                    

                    columns: [
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                i = row.row + 1;
                                return i;
                            },
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                // return row.name+' '+row.last_name;


                                if(data.name != ''){
                                    if(data.name != ''  && data.last_name != ''){

                                        var fname = data.name;
                                        var last_name = data.last_name;
                                    }else{
                                        var fname = '';
                                        var last_name = '';

                                    }
                                    var photo = data.photo;
                                    var user_id = btoa(data.id);
                                    var course_id = data.courseId;

                                    // var img =  baseUrl + "storage/studentDocs/student-profile-photo.png"; 
                                    var img = data.photo ? baseUrl + '/storage/' + data.photo : baseUrl + '/storage/studentDocs/student-profile-photo.png';
                                    // if (userRole === 'instructor') {
                                    //     var url =  baseUrl + "/ementor/e-mentor-students-exam-details/"+user_id+"/"+course_id; 
                                    // } else if (userRole === 'admin'  || userRole === 'superadmin') {
                                    //     var url =  baseUrl + "/admin/e-mentor-students-exam-details/"+user_id+"/"+course_id; 
                                    // }
                                    var statusBadge = data.is_active == 'Active' ? 
                                        '<span class="badge-dot bg-success me-1 d-inline-block align-middle"></span>' : 
                                        '<span class="badge-dot bg-danger me-1 d-inline-block align-middle"></span>';
                                    return (
                                        // `<a href="#" class="d-flex align-items-center" style="cursor:default;"><img src="`+img+`" alt="" class="rounded-circle avatar-md me-2" >
                                        //     <h5 class="mb-0 color-blue">`+fname+` `+last_name+`</h5></a></td>`

                                        `<a href="#" class="d-flex align-items-center">
                                            <img src="`+img+`" alt="" class="rounded-circle avatar-md me-2">
                                            <h5 class="mb-0 color-blue">`+fname+` `+last_name+` `+statusBadge+`</h5>
                                        </a>`
                                    );
                                }else{
                                    return '';
                                }
                            },
                        },
                        {
                            data: null,
                            render: function(row) {
                                var courseTitles = [];
                                if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                    row.allPaidCourses.forEach(function(course, index) {
                                        var userId = btoa(row.id);
                                        var courseId = btoa(course.course_id);
                                        if(course.course_progress == null){
                                            progress_bar = 0;
                                        }else{
                                            progress_bar = course.course_progress;
                                        }
                                        // const courseUrl = `/ementor/e-mentor-students-exam-details/${userId}/${courseId}`;
                                        courseTitles += ` <div class="course-item">
                                                <div>${index + 1}. ${course.course_title}</div>
                                                <div class="d-flex align-items-center mt-1 mb-3">
                                                    <div class="me-2"><span>${progress_bar}%</span></div>
                                                    <div class="progress w-100" style="height: 6px;">
                                                        <div class="progress-bar bg-primary" role="progressbar" 
                                                            style="width:${progress_bar}%" aria-valuenow="${progress_bar}" 
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>`;

                                    });
                                }
                                return courseTitles;

                            },
                            width: '30%',
                        },
                        {
                            data: null,
                            render: function(row) {
                                var purchaseDates = [];
                                let badge = '';
                                if (row.allPaidCourses && row.allPaidCourses.length > 0) {

                                    row.allPaidCourses.forEach(function(course) {
                                        purchaseDates += `<p class="mb-3" style="height:3rem; display:flex; align-items:center; justify-content:center">${course.course_start_date}</p>`;
                                    });
                                }
                                return purchaseDates;

                            },
                            width: '30%',
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                var enrolled = 'Not enrolled';
                                if(data.verified_on != null){
                                    var dateInput = data.verified_on;
                                    enrolled = dateInput.split(' ')[0];
                                }
                                return enrolled;
                            }

                        },
                        {
                            data: null,
                            render: function(row) {

                                var courseTitles = [];
                                let badge = '';
                                if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                    row.allPaidCourses.forEach(function(course) {
                                        let examData = row.examResults && row
                                            .examResults[course.scmId] ? row
                                            .examResults[course.scmId] : null;

                                        if (examData) {
                                            badge =
                                                `<p class="mt-2 mb-2 badge bg-${examData.color}">${examData.result} ${examData.percent ? examData.percent + '%' : ''}</p>`;
                                        } else {
                                            badge =
                                                `<p class="badge bg-primary">Not Attempt</p>`;
                                        }

                                        courseTitles += `${badge}<br><br>`;

                                    });
                                }
                                return courseTitles;

                            },
                            width: '30%',
                        },
                    ],
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function InstituteTeacherList(){
        var baseUrl = window.location.origin;
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var userRole = "{{ Auth::user()->role }}";
        var id= "<?php echo base64_encode($instituteData[0]->user['id']) ?>";
        url = baseUrl + "/admin/institute-teachers/"+id;

        $.ajax({
            url: url,
            method: 'GET',
            success: function (data) {
                $(".instituteTeacherList").DataTable().destroy();

                $(".instituteTeacherList").DataTable({
                    data: data,

                    columns: [
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                i = row.row + 1;
                                return i;
                            },
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                if(data.lactrure_name != ''){
                                    if(data.lactrure_name != ''){

                                        var name = data.lactrure_name;
                                    }else{
                                        var name = '';
                                    }
                                    var photo = data.image;

                                    var img = data.image ? baseUrl + '/storage/' + data.image : baseUrl + '/storage/studentDocs/student-profile-photo.png';
                                    return (
                                        `<a href="#" class="d-flex align-items-center" style="cursor:default;"><img src="`+img+`" alt="" class="rounded-circle avatar-md me-2" >
                                            <h5 class="mb-0 color-blue">`+name+`</h5></a></td>`
                                    );
                                }else{
                                    return '';
                                }
                            },
                        },
                        {
                            data: 'email',
                            render: function (data, type, full, row) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'designation',
                            render: function (data, type, full, row) {
                                return data ? data : '';
                            }
                        }
                    ],
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    
    function latestCourseStudentList(){
        $(".dataTables_filter").css('display','none');
        var baseUrl = window.location.origin;  
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var userRole = "{{ Auth::user()->role }}";

        let url;
        if (userRole === 'admin' || userRole === 'superadmin') {
            url = baseUrl + "/admin/get-institute-students/1";
        }
        $.ajax({
            url: url,
            method: 'GET',
            success: function (data) {
                $(".instituteLatestStudentList").DataTable().destroy();

                $(".instituteLatestStudentList").DataTable({
                    data: data, // Pass
                    paging: false,
                    columns: [
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                i = row.row + 1;
                                return i;
                            },
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                // return row.name+' '+row.last_name;
                                
                                
                                if(data.name != ''){
                                    if(data.name != ''  && data.last_name != ''){
    
                                        var fname = data.name;
                                        var last_name = data.last_name;
                                    }else{
                                        var fname = '';
                                        var last_name = '';
    
                                    }
                                    var photo = data.photo;
                                    var user_id = btoa(data.id);
                                    var course_id = data.courseId;
                                    
                                    // var img =  baseUrl + "storage/studentDocs/student-profile-photo.png"; 
                                    var img = data.photo ? baseUrl + '/storage/' + data.photo : baseUrl + '/storage/studentDocs/student-profile-photo.png';
                                    // if (userRole === 'instructor') {
                                    //     var url =  baseUrl + "/ementor/e-mentor-students-exam-details/"+user_id+"/"+course_id; 
                                    // } else if (userRole === 'admin'  || userRole === 'superadmin') {
                                    //     var url =  baseUrl + "/admin/e-mentor-students-exam-details/"+user_id+"/"+course_id; 
                                    // }
                                    return (
                                        `<a href="#" class="d-flex align-items-center"><img src="`+img+`" alt="" class="rounded-circle avatar-md me-2" >
                                            <h5 class="mb-0 color-blue">`+fname+` `+last_name+`</h5></a></td>`
                                    );
                                }else{
                                    return '';
                                }
                            },
                        },
                        {
                            data: null,
                            render: function(row) {
                                var courseTitles = [];
                                if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                    row.allPaidCourses.forEach(function(course, index) {
                                        var userId = btoa(row.id);
                                        var courseId = btoa(course.course_id);
                                        if(course.course_progress == null){
                                            progress_bar = 0;
                                        }else{
                                            progress_bar = course.course_progress;
                                        }
                                        // const courseUrl = `/ementor/e-mentor-students-exam-details/${userId}/${courseId}`;
                                        courseTitles += ` <div class="course-item">
                                                <div>${index + 1}. ${course.course_title}</div>
                                                <div class="d-flex align-items-center mt-1 mb-3">
                                                    <div class="me-2"><span>${progress_bar}%</span></div>
                                                    <div class="progress w-100" style="height: 6px;">
                                                        <div class="progress-bar bg-primary" role="progressbar" 
                                                            style="width:${progress_bar}%" aria-valuenow="${progress_bar}" 
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>`;

                                    });
                                }
                                return courseTitles;

                            },
                            width: '30%',
                        },
                        {
                            data: null,
                            render: function(row) {
                                var purchaseDates = [];
                                let badge = '';
                                if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                    
                                    row.allPaidCourses.forEach(function(course) {
                                        purchaseDates += `${course.course_start_date}<br><br>`;
                                    });
                                }
                                return purchaseDates;

                            },
                            width: '30%',
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                var enrolled = 'Not enrolled';
                                if(data.verified_on != null){
                                    var dateInput = data.verified_on;
                                    enrolled = dateInput.split(' ')[0];
                                }
                                return enrolled;
                            }
                            
                        },
                        {
                            data: null,
                            render: function(row) {
                                
                                var courseTitles = [];
                                let badge = '';
                                if (row.allPaidCourses && row.allPaidCourses.length > 0) {
                                    row.allPaidCourses.forEach(function(course) {
                                        let examData = row.examResults && row
                                            .examResults[course.scmId] ? row
                                            .examResults[course.scmId] : null;

                                        if (examData) {
                                            badge =
                                                `<span class="badge bg-${examData.color}">${examData.result} ${examData.percent ? examData.percent + '%' : ''}</span>`;
                                        } else {
                                            badge =
                                                `<span class="badge bg-primary">Not Attempt</span>`;
                                        }

                                        courseTitles += `${badge}<br><br>`;

                                    });
                                }
                                return courseTitles;

                            },
                            width: '30%',
                        },
                    ],            
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    </script>
@endsection
