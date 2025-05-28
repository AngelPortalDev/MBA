@extends('admin.layouts.main') 
<!-- Load app.js first -->
{{-- <script type="module" src="{{ env('APP_URL') . '/resources/js/app.js' }}" defer></script> --}}
<script type="module" src="https://{{ env('VITE_URL') }}:5173/resources/js/app.js" defer></script>
<!-- Load broadcasting.js -->
<script type="module" src="https://{{ env('VITE_URL') }}:5173/resources/js/broadcasting.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        function fetchDashboardData() {
            $.ajax({
                url: '/api/dashboard-data',
                method: 'GET',
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                success: function(data) {
                    $('#total-sales').text(`${data.totalSales}`);
                    $('#percentage-change').text(`${data.percentageChange}%`);
                    $('#total-students').text(`${data.totalActiveStudentsCount}`);
                    $('#enrolled-students').text(`${data.totalCourseSales}`);
                    $('#verified-students').text(`${data.verifiedStudentsCount}`);
                    if (data.latestCourse) {
                        $('#latest-course').text(data.latestCourse.course_title);
                        $('#published-on').text(data.latestCourse.published_on_text);
                        $('#course-ementor-name').text(data.latestCourse.ementor_name);
                    }
                    if (data.latestEnrolledStudent) {
                        $('#enrolled-student-name').text(data.latestEnrolledStudent.name);
                    }
                    if (data.ementorData) {
                        $('#ementor-name').text(data.ementorData.name);
                        $('#ementor-course-count').text(data.ementorData.assigned_course_count);
                        $('#ementor-enrolled-student').text(data.ementorData.total_enrollment_count);
                    }
                },
                error: function(error) {
                    console.error("Error fetching dashboard data:", error);
                }
            });
        }

        // fetchDashboardData(); // Fetch data on initial load

        if (typeof window.Echo !== 'undefined') {
            window.Echo.channel('dashboard')
                .listen('AdminDashboardUpdated', function(event) {
                    fetchDashboardData();
                });
        }
    });
</script>


@section('content')
@section('maintitle') Dashboard @endsection

<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-lg-flex justify-content-between align-items-center">
                <div class="mb-3 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Dashboard</h1>
                </div>
                <div class="d-flex">
                    {{-- <div class="input-group me-3">
                        <input class="form-control flatpickr" type="text" placeholder="Select Date" aria-describedby="basic-addon2">

                        <span class="input-group-text" id="basic-addon2"><i class="fe fe-calendar"></i></span>
                    </div> --}}
                    {{-- <a href="#" class="btn btn-primary">Setting</a> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body" style="height: 145px">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semibold ls-md">Sales</span>
                        </div>
                        <div>
                            <span class="fe fe-shopping-bag fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1"><i class="bi bi-currency-euro" ></i><span id="total-sales">{{isset($data['totalSales']) ? $data['totalSales'] : 0}}</span></h2>
                    {{-- <span class="text-success fw-semibold">
                        <i class="fe fe-trending-up me-1"></i>
                        +0<i class="bi bi-currency-euro"></i>
                    </span> --}}
                    @php
                        $iconClass = '';
                        $textClass = '';
                        $trendText = '';
                        $percentageChange = isset($data['percentageChange']) ? $data['percentageChange'] : 0;

                        if ($percentageChange > 0) {
                            $iconClass = 'fe fe-trending-up';
                            $textClass = 'text-success';
                            $trendText = '+' . $percentageChange . '%';  // Positive percentage
                        } elseif ($percentageChange < 0) {
                            $iconClass = 'fe fe-trending-down';
                            $textClass = 'text-danger';
                            $trendText = $percentageChange . '%';  // Negative percentage
                        } else {
                            $iconClass = 'fe fe-trending-flat';
                            $textClass = 'text-muted';
                            $trendText = '0%';  // No change
                        }
                    @endphp

                    <span class="{{ $textClass }} fw-semibold">
                        <i class="{{ $iconClass }} me-1"></i>
                        <span id="percentage-change">{{ $trendText }} </span><i class="bi bi-currency-euro"></i>
                    </span>

                    <span class="ms-1 fw-medium">Number of sales</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body" style="height: 145px">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semibold ls-md">Total Active Students</span>
                        </div>
                        <div>
                            <span class="fe fe-book-open fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 id="total-students" class="fw-bold mb-1">{{isset($data['totalActiveStudentsCount']) ? $data['totalActiveStudentsCount'] : 0}}</h2>
                    <span class="text-danger fw-semibold"></span>
                    <span class="ms-1 fw-medium"></span>
                    {{-- <span class="text-danger fw-semibold">0</span>
                    <span class="ms-1 fw-medium">Number of pending</span> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body" style="height: 145px">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semibold ls-md">Total Course Sales</span>
                        </div>
                        <div>
                            <span class="fe fe-users fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 id="enrolled-students" class="fw-bold mb-1" >{{isset($data['totalCourseSales']) ? $data['totalCourseSales'] : 0}}</h2>
                    <span class="text-success fw-semibold">
                    </span>
                    <span class="ms-1 fw-medium"></span>
                    {{-- <span class="text-success fw-semibold">
                        <i class="fe fe-trending-up me-1"></i>
                        +2
                    </span>
                    <span class="ms-1 fw-medium">Students</span> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body" style="height: 145px">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semibold ls-md">Verified Students</span>
                        </div>
                        <div>
                            <span class="fe fe-user-check fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 id="verified-students" class="fw-bold mb-1">{{isset($data['verifiedStudentsCount']) ? $data['verifiedStudentsCount'] : 0}}</h2>
                    <span class="text-success fw-semibold">
                    </span>
                    <span class="ms-1 fw-medium"></span>
                    {{-- <span class="text-success fw-semibold">
                        <i class="fe fe-trending-up me-1"></i>
                        +0
                    </span>
                    <span class="ms-1 fw-medium">E-mentors</span> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card header -->
                <div class="card-header align-items-center card-header-height d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">Earnings ({{$data['currentYear']}})</h4>
                    </div>
                    <div>
                        {{-- <div class="dropdown dropstart">
                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="courseDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fe fe-more-vertical"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="courseDropdown1">
                                <span class="dropdown-header">Settings</span>
                                <a class="dropdown-item" href="#">
                                    <i class="fe fe-external-link dropdown-item-icon"></i>
                                    Export
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fe fe-mail dropdown-item-icon"></i>
                                    Email Report
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fe fe-download dropdown-item-icon"></i>
                                    Download
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- Earning chart -->
                    <div id="earning" class="apex-charts"></div>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-4 col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card header -->
                <div class="card-header align-items-center card-header-height d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">Traffic</h4>
                    </div>
                    <div>
                        <div class="dropdown dropstart">
                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="courseDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fe fe-more-vertical"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="courseDropdown2">
                                <span class="dropdown-header">Settings</span>
                                <a class="dropdown-item" href="#">
                                    <i class="fe fe-external-link dropdown-item-icon"></i>
                                    Export
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fe fe-mail dropdown-item-icon"></i>
                                    Email Report
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fe fe-download dropdown-item-icon"></i>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <div id="traffic" class="apex-charts d-flex justify-content-center"></div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-12 col-md-12 col-12 mb-4">
            <!-- Card -->
            <div class="card h-100">
                <!-- Card header -->
            <div class="card-header d-flex align-items-center justify-content-between card-header-height">
                    <h4 class="mb-0">Enrolled Students</h4>
                    <a href="{{route('admin.students')}}" class="btn btn-outline-secondary btn-sm">View all</a>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    @if($data['latestEnrolledStudent'] != '')
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 pt-0">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar avatar-md avatar-indicators avatar-online">
                                            {{-- <img alt="avatar" src="{{ Storage::url($data['latestEnrolledStudent']->photo) }}" class="rounded-circle"> --}}
                                            <img alt="avatar" src="{{ !empty($data['latestEnrolledStudent']->photo) ? Storage::url($data['latestEnrolledStudent']->photo) : asset('frontend/images/profiles/student-profile-photo.png') }}" class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="col ms-n3">
                                        <h4 class="mb-0 h5" id="enrolled-student-name">{{$data['latestEnrolledStudent']->name}}</h4>
                                    </div>
                                    {{-- <div class="col-auto">
                                        <span class="dropdown dropstart">
                                            <a
                                                class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                href="#"
                                                role="button"
                                                id="courseDropdown7"
                                                data-bs-toggle="dropdown"
                                                data-bs-offset="-20,20"
                                                aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu" aria-labelledby="courseDropdown7">
                                                <span class="dropdown-header">Settings</span>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                                    Edit
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                    Remove
                                                </a>
                                            </span>
                                        </span>
                                    </div> --}}
                                </div>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        @if($data['latestCourse'] != '')
            <div class="col-xl-4 col-lg-12 col-md-12 col-12 mb-4">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Card header -->
                    <div class="card-header d-flex align-items-center justify-content-between card-header-height">
                        <h4 class="mb-0">Recent Course</h4>
                        <a href="{{route('admin.course.all-award')}}" class="btn btn-outline-secondary btn-sm">View all</a>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- List group flush -->
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 pt-0">
                                <div class="row">
                                    <!-- Col -->
                                    <div class="col-md-3 col-12 mb-3 mb-md-0">
                                        <a href="{{route('get-course-details', ['course_id' => base64_encode($data['latestCourse']->course_id)])}}">
                                            <img src="{{ Storage::url($data['latestCourse']->course_thumbnail_file) }}" alt="" class="img-fluid rounded">
                                        </a>
                                    </div>
                                    <!-- Col -->
                                    <div class="col-md-8 col-10">
                                        <a href="{{route('get-course-details', ['course_id' => base64_encode($data['latestCourse']->course_id)])}}">
                                            <h5 class="text-primary-hover" id="latest-course">{{$data['latestCourse']->course_title}}</h5>
                                        </a>
                                        {{-- <div class="d-flex align-items-center">
                                            <img src="{{ !empty($data['latestCourse']->photo) ? Storage::url($data['latestCourse']->photo) : asset('frontend/images/profiles/e-mentor-profile-photo.png') }}" alt="" class="rounded-circle avatar-xs me-2">
                                            <span class="fs-6" id="course-ementor-name">{{$data['latestCourse']->ementor_name}}</span>
                                            <span class="fs-6" id="published-on">{{$data['latestCourse']->published_on_text}}</span>
                                        </div> --}}

                                        <div class="d-flex align-items-center">
                                            <img src="{{ !empty($data['latestCourse']->photo) ? Storage::url($data['latestCourse']->photo) : asset('frontend/images/profiles/e-mentor-profile-photo.png') }}" alt="" class="rounded-circle avatar-xs me-2">
                                            <span class="fs-6" id="course-ementor-name">{{$data['latestCourse']->ementor_name}}</span>
                                            <span class="fs-6 ms-2" id="published-on">{{$data['latestCourse']->published_on_text}}</span>
                                        </div>
                                        
                                    </div>
                                    <!-- Col auto -->
                                    {{-- <div class="col-1 col-auto d-flex justify-content-center">
                                        <span class="dropdown dropstart">
                                            <a
                                                class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                href="#"
                                                role="button"
                                                id="courseDropdown3"
                                                data-bs-toggle="dropdown"
                                                data-bs-offset="-20,20"
                                                aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu" aria-labelledby="courseDropdown3">
                                                <span class="dropdown-header">Settings</span>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                                    Edit
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                    Remove
                                                </a>
                                            </span>
                                        </span>
                                    </div> --}}
                                </div>
                            </li>
                            <!-- List group -->
                            {{-- <li class="list-group-item px-0">
                                <div class="row">
                                    <div class="col-md-3 col-12 mb-3 mb-md-0">
                                        <a href="#"><img src="{{asset('admin/images/course/course-gatsby.jpg')}}" alt="" class="img-fluid rounded"></a>
                                    </div>
                                    <div class="col-md-8 col-10">
                                        <a href="#">
                                            <h5 class="text-primary-hover">Guide to Static Sites with Gatsby.js</h5>
                                        </a>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('admin/images/avatar/avatar-8.jpg')}}" alt="" class="rounded-circle avatar-xs me-2">
                                            <span class="fs-6">Jenny Wilson</span>
                                        </div>
                                    </div>
                                    <div class="col-1 col-auto d-flex justify-content-center">
                                        <span class="dropdown dropstart">
                                            <a
                                                class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                href="#"
                                                role="button"
                                                id="courseDropdown4"
                                                data-bs-toggle="dropdown"
                                                data-bs-offset="-20,20"
                                                aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu" aria-labelledby="courseDropdown4">
                                                <span class="dropdown-header">Settings</span>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                                    Edit
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                    Remove
                                                </a>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </li> --}}
                            <!-- List group -->
                            {{-- <li class="list-group-item px-0">
                                <div class="row">
                                    <div class="col-md-3 col-12 mb-3 mb-md-0">
                                        <a href="#">
                                            <img src="{{asset('admin/images/course/course-javascript.jpg')}}" alt="" class="img-fluid rounded">
                                        </a>
                                    </div>
                                    <div class="col-md-8 col-10">
                                        <a href="#">
                                            <h5 class="text-primary-hover">The Modern JavaScript Courses</h5>
                                        </a>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('admin/images/avatar/avatar-1.jpg')}}" alt="" class="rounded-circle avatar-xs me-2">
                                            <span class="fs-6">Guy Hawkins</span>
                                        </div>
                                    </div>
                                    <div class="col-1 col-auto d-flex justify-content-center">
                                        <span class="dropdown dropstart">
                                            <a
                                                class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                href="#"
                                                role="button"
                                                id="courseDropdown5"
                                                data-bs-toggle="dropdown"
                                                data-bs-offset="-20,20"
                                                aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu" aria-labelledby="courseDropdown5">
                                                <span class="dropdown-header">Settings</span>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                                    Edit
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                    Remove
                                                </a>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </li> --}}
                            <!-- List group -->
                            {{-- <li class="list-group-item px-0">
                                <div class="row">
                                    <div class="col-md-3 col-12 mb-3 mb-md-0">
                                        <a href="#">
                                            <img src="{{asset('admin/images/course/course-wordpress.jpg')}}" alt="" class="img-fluid rounded">
                                        </a>
                                    </div>
                                    <div class="col-md-8 col-10">
                                        <a href="#">
                                            <h5 class="text-primary-hover">Online WordPress Courses Become an Expert Today</h5>
                                        </a>
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('admin/images/avatar/avatar-5.jpg')}}" alt="" class="rounded-circle avatar-xs me-2">
                                            <span class="fs-6">Robert Fox</span>
                                        </div>
                                    </div>
                                    <div class="col-1 col-auto d-flex justify-content-center">
                                        <span class="dropdown dropstart">
                                            <a
                                                class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                href="#"
                                                role="button"
                                                id="courseDropdown6"
                                                data-bs-toggle="dropdown"
                                                data-bs-offset="-20,20"
                                                aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu" aria-labelledby="courseDropdown6">
                                                <span class="dropdown-header">Settings</span>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                                    Edit
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                    Remove
                                                </a>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="col-xl-4 col-lg-12 col-md-12 col-12 mb-4">
            <!-- Card -->
            <div class="card h-100">
                <!-- Card header -->
            <div class="card-header d-flex align-items-center justify-content-between card-header-height">
                    <h4 class="mb-0">Ementor</h4>
                    <a href="{{route('admin.e-mentors.e-mentors')}}" class="btn btn-outline-secondary btn-sm">View all</a>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    @if($data['ementorData'] != '')
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 pt-0">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar avatar-md avatar-indicators avatar-online">
                                            {{-- <img alt="avatar" src="{{ Storage::url($data['ementorData']->photo) }}" class="rounded-circle"> --}}
                                            <img alt="avatar" src="{{ !empty($data['ementorData']->photo) ? Storage::url($data['ementorData']->photo) : asset('frontend/images/profiles/e-mentor-profile-photo.png') }}" class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="col ms-n3">
                                        <h4 class="mb-0 h5" id="ementor-name">{{$data['ementorData']->name}}</h4>
                                        <span class="me-2 fs-6">
                                            <span class="text-dark me-1 fw-semibold" id="ementor-course-count">{{$data['ementorData']->assigned_course_count}}</span>
                                            Courses
                                        </span>
                                        <span class="me-2 fs-6">
                                            <span class="text-dark me-1 fw-semibold" id="ementor-enrolled-student">{{$data['ementorData']->total_enrollment_count}}</span>
                                            Students
                                        </span>
                                        {{-- <span class="fs-6">
                                            <span class="text-dark me-1 fw-semibold">0</span>
                                            Reviews
                                        </span> --}}
                                    </div>
                                    {{-- <div class="col-auto">
                                        <span class="dropdown dropstart">
                                            <a
                                                class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                href="#"
                                                role="button"
                                                id="courseDropdown7"
                                                data-bs-toggle="dropdown"
                                                data-bs-offset="-20,20"
                                                aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu" aria-labelledby="courseDropdown7">
                                                <span class="dropdown-header">Settings</span>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                                    Edit
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                    Remove
                                                </a>
                                            </span>
                                        </span>
                                    </div> --}}
                                </div>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add this in your <head> section or before your custom chart script -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    let earningChartInstance; // Store chart instance globally

    function renderEarningChart() {
        const earningsData = @json($data['chart_data']['earnings']);
        const monthLabels = @json($data['chart_data']['labels']);

        // Remove old chart if exists
        if (earningChartInstance) {
            earningChartInstance.destroy();
        }

        const earningChartConfig = {
            series: [{
                name: "Earnings",
                data: earningsData
            }],
            chart: {
                type: "bar",
                height: 300
            },
            colors: ['#2B3990'],
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    columnWidth: '45%'
                }
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    colors: ['#fff']
                },
                formatter: function (val) {
                    return val + " €";
                }
            },
            xaxis: {
                categories: monthLabels,
                labels: {
                    style: {
                        fontWeight: 'bold'
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value + " €"; // Format Y-axis
                    },
                    style: {
                        fontWeight: 'bold',
                    }
                }
            }
        };

        earningChartInstance = new ApexCharts(document.querySelector("#earning"), earningChartConfig);
        earningChartInstance.render();
    }

    document.addEventListener("DOMContentLoaded", function () {
        const interval = setInterval(() => {
            const el = document.querySelector("#earning");
            if (el) {
                clearInterval(interval);
                renderEarningChart();
            }
        }, 100); // check every 100ms until #earning exists
    });
</script>




@endsection