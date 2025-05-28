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
                            <h1 class="mb-0 h2 fw-bold">Lecturer</h1>
                            <!-- Breadcrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.e-mentors.e-mentors') }}">Lecturer List</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Lecturer</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- button -->
                        <div>
                            <a href="{{ route('admin.e-mentors.e-mentors') }}" class="btn btn-primary me-2 d-none d-md-block">Back</a>
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
                            <!-- img -->
                            <form class="profileImage position-relative" enctype="multipart/form-data" >
                                @if (!empty($ementorData[0]->user->photo))
                                    <img class="avatar-xl rounded-circle border border-4 border-white imageAdminPreview object-fit-cover"
                                        src="{{ Storage::url($ementorData[0]->user->photo) }}">
                                @else
                                    <img src="{{Storage::url('ementorDocs/e-mentor-profile-photo.png')}}"
                                        class="avatar-xl rounded-circle border border-4 border-white imagePreview"
                                        alt="avatar" />
                                @endif
                                <div class="student-profile-photo-edit-pencil-icon">

                                    <input type="file" id="imageUpload_profile" class="image profileEmentorPic" name="image_file" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" id="user_id" value="{{ isset($ementorData[0]->user->id) ? base64_encode($ementorData[0]->user->id) : '' }}" name="user_id">
                                    <input type="hidden" id="user_name" value="{{ isset($ementorData[0]->user->name) ? base64_encode($ementorData[0]->user->name) : '' }}" name="user_name">
                                    <label for="imageUpload_profile"><i class="bi-pencil"></i></label>
                                    <input type="text" class='curr_img' value="{{ isset($ementorData[0]->ementor->photo) ? $ementorData[0]->ementor->photo : '' }}" name='old_img_name' hidden>

                                </div>
                            </form>


                            <div class="ms-sm-4">

                                <!-- text -->
                                <h3 class="mb-1">{{isset($ementorData[0]->user->name) ? htmlspecialchars_decode($ementorData[0]->user->name.' '.$ementorData[0]->user->last_name)  : 'NA' }}</h3>
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <i class="fe fe-mail fs-4 align-middle"></i>
                                        <a href="mailto:{{ isset($ementorData[0]->user->email) ? $ementorData[0]->user->email : '' }}" class="ms-1">
                                            {{ isset($ementorData[0]->user->email) ? $ementorData[0]->user->email : 'NA' }}
                                        </a>                                        
                                    </div>
                                    <div class="ms-sm-3">
                                        <i class="fe fe-phone fs-4 align-middle"></i>
                                        {{-- <a href="tel:+123456788">
                                        <span class="ms-1">{{isset($ementorData[0]->ementor->mob_code) ? $ementorData[0]->ementor->mob_code.' '.$ementorData[0]->ementor->phone : 'NA' }}</span>
                                        </a> --}}
                                        <a href="tel:{{ isset($ementorData[0]->user->mob_code) && isset($ementorData[0]->user->phone) ? $ementorData[0]->user->mob_code.$ementorData[0]->user->phone : '' }}">
                                            <span class="ms-1">
                                                {{ isset($ementorData[0]->user->mob_code) && isset($ementorData[0]->user->phone) ? $ementorData[0]->user->mob_code.' '.$ementorData[0]->user->phone : 'NA' }}
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
                </li> --}}
                <li class="nav-item ms-0" role="presentation">
                  <a class="nav-link active"  id="assigned-courses-tab" data-bs-toggle="pill" href="#assigned-courses" role="tab" aria-controls="assigned-courses" aria-selected="true">Assigned courses</a>
                </li>
                {{-- <li class="nav-item ms-0" role="presentation">
                  <a class="nav-link"  id="examination-tab" data-bs-toggle="pill" href="#examination" role="tab" aria-controls="examination" aria-selected="true">Examination</a>
                </li> --}}
                <li class="nav-item  ms-0" role="presentation">
                  <a class="nav-link" id="students-tab" data-bs-toggle="pill" href="#students" role="tab" aria-controls="students" aria-selected="false">Students</a>
                </li>
                <li class="nav-item  ms-0" role="presentation">
                  <a class="nav-link" id="profile-tab" data-bs-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
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

                <!-- Tab Pane -->
                {{-- <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Card -->
                            <div class="card mb-4 e-mentor-card">
                                <div class="p-4">
                                    <span class="fs-6 text-uppercase fw-semibold">Total Revenue</span>
                                    <h2 class="mt-4 fw-bold mb-1 d-flex align-items-center h1 lh-1 total_earnings"></h2>
                                    <span class="d-flex justify-content-between align-items-center">
                                        <span>Earning this month</span>
                                        <span class="badge bg-success ms-2 curmonth_earnings"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Card -->
                            <div class="card mb-4 e-mentor-card">
                                <div class="p-4">
                                    <span class="fs-6 text-uppercase fw-semibold">Total Enrolled</span>
                                    <h2 class="mt-4 fw-bold mb-1 d-flex align-items-center h1 lh-1 total_counts"></h2>
                                    <span class="d-flex justify-content-between align-items-center">
                                        <span>New this month</span>
                                        <span class="badge bg-info ms-2 curmonth_counts"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Card -->
                            <div class="card mb-4 e-mentor-card">
                                <div class="p-4">
                                    <span class="fs-6 text-uppercase fw-semibold">Exam Corrected</span>
                                    <h2 class="mt-4 fw-bold mb-1 d-flex align-items-center h1 lh-1 total_exam_corrected"></h2>
                                    <span class="d-flex justify-content-between align-items-center">
                                        <span>New this month</span>
                                        <span class="badge bg-warning ms-2 curmonth_exam_corrected"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="h4 mb-0">Best Selling Courses</h3>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table mb-0 table-hover table-centered text-nowrap">
                                <!-- Table Head -->
                                <thead class="table-light">
                                    <tr>
                                        <th>Courses</th>
                                        <th>Sales</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <!-- Table Body -->
                                <tbody>
                                    @php $i=0; $TotalPrice = 0; $TotalCount = 0;$MonthCount=0;$examCorrected =0;$MonthExamCorrected=0;
                                        $MonthPrice=0; @endphp
                                    @if(!empty($ementorDashboardData) && $ementorDashboardData->isNotEmpty())
                                        @foreach($ementorDashboardData as $course_module)
                                            @php 
                                                $orderCount =0;
                                                $OrderPrice=0;
                                                
                                                $courseId = $course_module['id'];     
                                            @endphp --}}
                                            {{-- @foreach($course_module['OrderModule'] as $order_module)
                                            @php $ExamCorrectedQuery = DB::table('student_course_master')->where('user_id',$order_module['user']['userData']['id'])->where('course_id',$courseId)->first();
                                                $specificDate = $ExamCorrectedQuery->course_start_date;
                                                if(!empty($specificDate)){
                                                    $dateObject = new DateTime($specificDate);
                                                    $specificMonth = $dateObject->format('m');
                                                    $currentMonth = date('m');
                                                    if ($specificMonth === $currentMonth) {
                                                        if($order_module['user']['studentDocument']['identity_is_approved'] == 'Approved' && $order_module['user']['studentDocument']['edu_is_approved'] == 'Approved' && $order_module['user']['studentDocument']['english_score'] >= 10){
                                                            $MonthPrice += $order_module['course_price'];
                                                            $MonthCount++; 
                                                        }
                                                        if($ExamCorrectedQuery->exam_remark == '0' || $ExamCorrectedQuery->exam_remark == '1'){
                                                            
                                                            $MonthExamCorrected++;
                                                        }
                                                    }
                                                }
                                                if($order_module['user']['studentDocument']['identity_is_approved'] == 'Approved' && $order_module['user']['studentDocument']['edu_is_approved'] == 'Approved' && $order_module['user']['studentDocument']['english_score'] >= 10){
                                                    $OrderPrice += $order_module['course_price'];
                                                    $TotalPrice += $order_module['course_price'];
                                                    $TotalCount++;
                                                    $orderCount++;
                                                }
                                                if($ExamCorrectedQuery->exam_remark == '0' || $ExamCorrectedQuery->exam_remark == '1'){
                                                $examCorrected++;
                                                }
                                            @endphp
                                            @endforeach --}}
                                    
                                    

                                            <!-- Printing the course module for debugging purposes -->
                                            {{-- <tr>
                                                <td>
                                                    <a href="{{route('e-mentor-course-details',['course_id'=>base64_encode($course_module->id)])}}">
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{storage::url($course_module->course_thumbnail_file)}}"  alt="course" class="rounded img-4by3-lg" >
                                                            <h5 class="ms-3 text-primary-hover mb-0  color-blue text-wrap-title">{{$course_module->course_title}}</h5>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>{{$orderCount}}</td>
                                                <td>€{{$OrderPrice}}</td>

                                            </tr>
                                        @endforeach
                                    @else   
                                        <tr>
                                            <td colspan="3" style="text-align: center;">No Data Found.</td>
                                        </tr>
                                    @endif --}}
                                    {{-- <div id="total_counts" value="{{$TotalCount}}">{{$TotalCount}}</div> 
                                    <div id="total_earnings" value="{{$TotalPrice}}">{{$TotalPrice}}</div>
                                    <div id="curmonth_counts" value="{{$MonthCount}}">{{$MonthCount}}</div> 
                                    <div id="curmonth_earnings" value="{{$MonthPrice}}">{{$MonthPrice}}</div>
                                    <div id="total_exam_corrected" value="{{$examCorrected}}">{{$examCorrected}}</div>
                                    <div id="curmonth_exam_corrected" value="{{$MonthExamCorrected}}">{{$MonthExamCorrected}}</div> --}}
                                {{-- </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}


                <div class="tab-pane fade show active" id="assigned-courses" role="tabpanel" aria-labelledby="assigned-courses-tab">
                  <!-- Tab pane -->
                    <div class="card mb-4">

                        <!-- Card body -->
                        <div class="card-body">
                            <!-- Form -->
                            <form class="row gx-3">
                                <div class="col-lg-9 col-md-7 col-12 mb-lg-0 mb-2">
                                    <input type="search" class="form-control searchCourse" placeholder="Search Your Courses" id="searchInput">
                                </div>
                                {{-- <div class="col-lg-3 col-md-5 col-12">
                                    <select class="form-select"> --}}
                                        {{-- <option value="">Date Created</option>
                                        <option value="Newest">Newest</option>
                                        <option value="High Earned">High Earned</option>
                                        <option value="High Earned">Award</option> --}}
                                        {{-- <option value="High Earned">Certificate</option>
                                        <option value="High Earned">Diploma</option>
                                        <option value="High Earned">Masters</option> --}}
                                    {{-- </select>
                                </div> --}}
                            </form>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive overflow-y-hidden">
                            <table class="table mb-0 text-nowrap table-hover table-centered text-nowrap assignedCourseList" width="100%">
                                <thead class="table-light">
                                    <tr>
                                        <th>Courses</th>
                                        <th>Enrollments</th>
                                        {{-- <th>Exam </th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    

                                    {{-- <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                     <a href="{{route('e-mentor-course-details')}}"> <img src="{{ asset('frontend/images/course/award-recruitment-and-employee-selection.png')}}" alt="course" class="rounded img-4by3-lg"></a>
                                                </div>
                                                <div class="ms-3">
                                                    <h4 class="mb-1 h5">
                                                         <a href="{{route('e-mentor-course-details')}}" class="text-inherit color-blue">Award in Recruitment and Employee Selection</a>
                                                    </h4>
                                                    <ul class="list-inline fs-6 mb-0">
                                                        <li class="list-inline-item">
                                                            <span class="align-text-bottom">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                                                </svg>
                                                            </span>
                                                            <span>2h 59m</span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="badge bg-info-soft co-category">Award</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>650</td>

                                        <td>
                                            65
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <a href="{{route('e-mentor-course-details')}}"> <img src="{{ asset('frontend/images/course/course-gatsby.jpg')}}" alt="course" class="rounded img-4by3-lg"></a>
                                                </div>
                                                <div class="ms-3">
                                                    <h4 class="mb-1 h5">
                                                        <a href="{{route('e-mentor-course-details')}}" class="text-inherit color-blue">Award in Employee and Labour Relations</a>
                                                    </h4>
                                                    <ul class="list-inline fs-6 mb-0">
                                                        <li class="list-inline-item">
                                                            <span class="align-text-bottom">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                                                </svg>
                                                            </span>
                                                            <span>4h 10m</span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="badge bg-info-soft co-category">Award</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>4340</td>

                                        <td>
                                            434
                                        </td>

                                    </tr>  --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Card Footer -->
                    {{-- <div class="card-footer">
                        <nav>
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link mx-1 rounded" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                            <path
                                                fill-rule="evenodd"
                                                d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z">
                                        </svg>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link mx-1 rounded" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link mx-1 rounded" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link mx-1 rounded" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link mx-1 rounded" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path
                                                fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div> --}}
                </div>

                <div class="tab-pane fade" id="examination" role="tabpanel" aria-labelledby="examination-tab">
                    <!-- Card -->
                    <div class="card rounded-3">
                        <!-- Card header -->
                        <div class="card-header border-bottom-0 p-0">
                            <div>
                                <div class="table-responsive">
                                    
                                    <ul class="nav nav-lb-tab studentTab" id="tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="pass" data-bs-toggle="tab" href="#note5" role="tab" aria-controls="note5" aria-selected="false">Pass</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="fail" data-bs-toggle="tab" href="#note6" role="tab" aria-controls="note6" aria-selected="false">Fail</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="checking-tab" data-bs-toggle="tab" href="#checking" role="tab" aria-controls="checking" aria-selected="false">Checking</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="pending" data-bs-toggle="tab" href="#note7" role="tab" aria-controls="note7" aria-selected="false"> Pending</a>
                                        </li>
                                        
                                    </ul>
                                    <div class="container card-body">
                                        <div class="row ">
                                            <div class="col-12 col-md-6 col-lg-9 mb-lg-0 mb-2">
                                                <form class="d-flex align-items-center">
                                                    <span class="position-absolute ps-3 search-icon">
                                                        <i class="fe fe-search"></i>
                                                    </span>
                                                    <input type="search" class="form-control ps-6 mb-1 searchSection" placeholder="Search Here" id="searchExamination">
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- Card Body with existing classes -->
                            <!-- Tab content with existing classes -->
                                <div class="tab-content" id="tabContent">
                                    
                                    {{-- pass --}}
                                    <div class="tab-pane fade show active" id="note5" role="tabpanel" aria-labelledby="pass">
                                        <div class="table-responsive">
                                            <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentListRemark"  width="100%">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Sr .</th>
                                                        <th>Name</th>
                                                        <th>Course</th>
                                                        <th>Enrolled</th>
                                                        {{-- <th>Exam</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- <tr>
                                                        <td>
                                                            <a href="" class="d-flex align-items-center">
                                                                <img src="{{ asset('frontend/images/avatar/avatar-3.jpg')}}" alt="" class="rounded-circle avatar-md me-2" >
                                                                <h5 class="mb-0 color-blue">Guy Hawkins</h5>
                                                            </a>
                                                        </td>
                                                        <td class="text-wrap-title">	Award in Recruitment and Employee Selection
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2"><span>80%</span></div>
                                                                <div class="progress w-100" style="height: 6px">
                                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>3/12/2020</td>
        
                                                        <td><span class="badge bg-success">Pass</span></td>
                                                        <td><span class="badge bg-success">75%</span></td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- pending --}}
                                    <div class="tab-pane fade" id="note7" role="tabpanel" aria-labelledby="pending">
                                        <div class="table-responsive">
                                            <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentList"  width="100%">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Sr .</th>
                                                        <th>Name</th>
                                                        <th>Course</th>
                                                        <th>Exam</th>
                                                        <th>Submitted Date</th>
                                                        {{-- <th>Exam Status</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody >
                                                    {{-- <tr>
                                                        <td>
                                                            <a href="{{route('e-mentor-students-exam-details')}}" class="d-flex align-items-center">
                                                                <img src="{{ asset('frontend/images/avatar/avatar-5.jpg')}}" alt="" class="rounded-circle avatar-md me-2" >
                                                                <h5 class="mb-0 color-blue">Guy Hawkins</h5>
                                                            </a>
                                                        </td>
                                                        <td>	Award in Recruitment and Employee Selection
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2"><span>11%</span></div>
                                                                <div class="progress w-100" style="height: 6px">
                                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 11%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>3/12/2020</td>
        
                                                        <td><span class="badge bg-warning">Pending</span></td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- checking --}}
                                    <div class="tab-pane fade" id="checking" role="tabpanel" aria-labelledby="checking-tab">
                                        <div class="table-responsive">
                                            <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentList"  width="100%">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Sr .</th>
                                                        <th>Name</th>
                                                        <th>Course</th>
                                                        <th>Exam</th>
                                                        <th>Enrolled</th>
                                                        {{-- <th>Exam Status</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody >
                                                    {{-- <tr>
                                                        <td>
                                                            <a href="{{route('e-mentor-students-exam-details')}}" class="d-flex align-items-center">
                                                                <img src="{{ asset('frontend/images/avatar/avatar-5.jpg')}}" alt="" class="rounded-circle avatar-md me-2" >
                                                                <h5 class="mb-0 color-blue">Guy Hawkins</h5>
                                                            </a>
                                                        </td>
                                                        <td>	Award in Recruitment and Employee Selection
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2"><span>11%</span></div>
                                                                <div class="progress w-100" style="height: 6px">
                                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 11%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>3/12/2020</td>
        
                                                        <td><span class="badge bg-warning">Pending</span></td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- fail --}}
                                    <div class="tab-pane fade" id="note6" role="tabpanel" aria-labelledby="fail">
                                        <div class="table-responsive">
                                            <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox table-hover w-100 studentListRemark"  width="100%">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Sr .</th>
                                                        <th>Name</th>
                                                        <th>Course</th>
                                                        <th>Enrolled</th>
                                                        {{-- <th>Exam Status</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody >
                                                    {{-- <tr>
                                                        <td>
                                                            <a href="{{route('e-mentor-students-exam-details')}}" class="d-flex align-items-center">
                                                                <img src="{{ asset('frontend/images/avatar/avatar-5.jpg')}}" alt="" class="rounded-circle avatar-md me-2" >
                                                                <h5 class="mb-0 color-blue">Guy Hawkins</h5>
                                                            </a>
                                                        </td>
                                                        <td>	Award in Recruitment and Employee Selection
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2"><span>11%</span></div>
                                                                <div class="progress w-100" style="height: 6px">
                                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 11%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>3/12/2020</td>
        
                                                        <td><span class="badge bg-warning">Pending</span></td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                </div>

                <div class="tab-pane fade" id="students" role="tabpanel" aria-labelledby="students-tab">
                  <!-- Tab pane -->
                  <div class="card">
                    <div class="card-header border-bottom-0">
                        <div>
                            <div>
                                <form class="row gx-3">
                                    <div class="col-lg-9 col-md-7 col-12 mb-lg-0 mb-2">
                                        <input type="search" class="form-control ementorStudentSearchInput" placeholder="Search By Name" id="ementorStudentSearchInput">
                                    </div>
                                    {{-- <div class="col-lg-3 col-md-5 col-12">
                                        <select class="form-select">
                                            <option value="">Date Created</option>
                                            <option value="Newest">Newest</option>
                                            <option value="High Earned">Award</option>
                                            <option value="High Earned">Certificate</option>
                                            <option value="High Earned">Diploma</option>
                                            <option value="High Earned">Masters</option>
                                        </select>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                      
                    </div>
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-centered text-nowrap ementorStudentList" width="100%">
                            <thead class="table-light">
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Enrolled</th>
                                    <th>Exam</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>
                                        <a href="student-details" class="d-flex align-items-center">
                                            <img src="{{ asset('frontend/images/avatar/avatar-3.jpg')}}" alt="" class="rounded-circle avatar-md me-2" >
                                            <h5 class="mb-0 color-blue">Guy Hawkins</h5>
                                        </a>
                                    </td>
                                    <td>Award in Recruitment and Employee Selection
                                        <div class="d-flex align-items-center">
                                            <div class="me-2"><span>80%</span></div>
                                            <div class="progress w-100" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>3/12/2020</td>
                                    <td><span class="badge bg-success">Pass</span></td>


                                </tr> --}}
                                {{-- <tr>
                                    <td>
                                        <a href="student-details" class="d-flex align-items-center">
                                            <img src="{{ asset('frontend/images/avatar/avatar-2.jpg')}}" alt="" class="rounded-circle avatar-md me-2" >
                                            <h5 class="mb-0 color-blue">Dianna Smiley</h5>
                                        </a>
                                    </td>
                                    <td>Award in Recruitment and Employee Selection
                                        <div class="d-flex align-items-center">
                                            <div class="me-2"><span>76%</span></div>
                                            <div class="progress w-100" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 76%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>3/12/2020</td>
                                     <td><span class="badge bg-danger">Fail</span></td>


                                </tr> --}}
                                {{-- <tr>
                                    <td>
                                        <a href="student-details" class="d-flex align-items-center">
                                            <img src="{{ asset('frontend/images/avatar/avatar-5.jpg')}}" alt="" class="rounded-circle avatar-md me-2" >
                                            <h5 class="mb-0 color-blue">Guy Hawkins</h5>
                                        </a>
                                    </td>
                                    <td>Award in Recruitment and Employee Selection
                                        <div class="d-flex align-items-center">
                                            <div class="me-2"><span>11%</span></div>
                                            <div class="progress w-100" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 11%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>3/12/2020</td>
                                     <td><span class="badge bg-success">Pass</span></td>


                                </tr> --}}
                                {{-- <tr>
                                    <td>
                                        <a href="student-details" class="d-flex align-items-center">
                                            <img src="{{ asset('frontend/images/avatar/avatar-6.jpg')}}" alt="" class="rounded-circle avatar-md me-2" >
                                            <h5 class="mb-0 color-blue">Guy Hawkins</h5>
                                        </a>
                                    </td>
                                    <td>Award in Recruitment and Employee Selection
                                        <div class="d-flex align-items-center">
                                            <div class="me-2"><span>45%</span></div>
                                            <div class="progress w-100" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 45%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>3/12/2020</td>
                                     <td><span class="badge bg-success">Pass</span></td>


                                </tr> --}}
                                {{-- <tr>
                                    <td>
                                        <a href="student-details" class="d-flex align-items-center">
                                            <img src="{{ asset('frontend/images/avatar/avatar-7.jpg')}}" alt="" class="rounded-circle avatar-md me-2" >
                                            <h5 class="mb-0 color-blue">Guy Hawkins</h5>
                                        </a>
                                    </td>
                                    <td>Award in Recruitment and Employee Selection
                                        <div class="d-flex align-items-center">
                                            <div class="me-2"><span>60%</span></div>
                                            <div class="progress w-100" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>3/12/2020</td>
                                     <td><span class="badge bg-warning">Pending</span></td>


                                </tr> --}}

                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="pt-2 pb-4"> --}}
                        <!-- Pagination -->
                        {{-- <nav>
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link mx-1 rounded" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                            <path
                                                fill-rule="evenodd"
                                                d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" >
                                        </svg>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link mx-1 rounded" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link mx-1 rounded" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link mx-1 rounded" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link mx-1 rounded" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path
                                                fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </nav> --}}
                    {{-- </div> --}}
                    </div>
                </div>
                
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card">

                        <!-- Card body -->
                        <div class="card-body">

                            <div>
                                <!-- Form -->
                                <form class="row gx-3 needs-validation profileData" novalidate="" enctype="multipart/form-data" >
                                    <!-- Selection -->
                                    <input type="hidden" id="ementor_id" class="form-control" placeholder="ementor_id" name="ementor_id" required="" value="{{isset($ementorData[0]->user['id']) ? base64_encode($ementorData[0]->user['id']) : '' }}">
                                    <!-- First name -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="fname">First Name <span class="text-danger">*</span></label>
                                        <input type="text" id="first_name" class="form-control" placeholder="First Name" name="first_name" required="" value="{{isset($ementorData[0]->user['name']) ? $ementorData[0]->user['name'] : '' }}">
                                        <div class="invalid-feedback" id="first_name_error">Please enter first name.</div>
                                    </div>
                                    <!-- Last name -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="lname">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" id="last_name" class="form-control" placeholder="Last Name" name="last_name" required="" value="{{isset($ementorData[0]->user['last_name']) ? $ementorData[0]->user['last_name'] : '' }}">
                                        <div class="invalid-feedback" id="last_name_error">Please enter last name.</div>
                                    </div>

                                    <!-- DOB -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="birth">Date of Birth</label>
                                        <input class="form-control flatpickr flatpickr-input" type="date" placeholder="Date of Birth" id="dob" name="dob" value="{{isset($ementorData[0]->dob) ? $ementorData[0]->dob : '' }}">
                                        <div class="invalid-feedback" >Please choose a date.</div>
                                    </div>

                                    <!-- Gender -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="editState">Gender</label>
                                        <select class="form-select" id="editState" required="" name="gender">
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
                                        <div class="invalid-feedback">Please choose Gender.</div>
                                    </div>

                                    <!-- Country -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="editState">Country</label>
                                        <select class="form-select" id="editState" required="" name="country_id">
                                            <option value=""> Select </option>
                                            @foreach (getDropDownlist('country_master', ['id','country_name']) as $country)
                                                @if(!empty($ementorData[0]->country_id))

                                                <option value="{{ $country->id}}" @if($country->id == $ementorData[0]->country_id) selected @endif>{{ $country->country_name}}</option>

                                                @else

                                                <option value="{{$country->id}}">{{$country->country_name}} </option>

                                                @endif
                                            @endforeach 


                                        </select>
                                        <div class="invalid-feedback">Please choose Country.</div>
                                    </div>
                                    
                                    <!-- Nationality -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="Nationality">Nationality</label>
                                        <input type="text" id="nationality" class="form-control" placeholder="Nationality" required="" name="nationality" value="{{isset($ementorData[0]->nationality) ? $ementorData[0]->nationality : '' }}">
                                        <div class="invalid-feedback">Please enter Nationality.</div>
                                    </div>

                                    <!-- Address -->
                                    <div class="mb-6 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">Address</label>
                                            <textarea class="form-control" id="textarea-input" name="address" rows="2" placeholder="Enter your address here...">{{isset($ementorData[0]->address) ? $ementorData[0]->address : '' }}</textarea>   
                                        </div>



                                    
                                    <h4 class="mb-0">Education Details</h4>
                                    <p class="mb-4">Enter your Higher Education Details</p>


                                    <!-- Gender -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="">Select Higher Education</label>
                                        {{-- <select class="form-select" id="" required=""> --}}
                                            @php $educationSelected = $ementorData[0]->highest_education ; @endphp
                                            <select class="form-select" id="highest_education" required="" name="highest_education">
                                                <option value="">Select</option>
                                                <option value="Bachelor" <?= $educationSelected == "Bachelor" ? "selected" : "" ?>>Bachelor</option>
                                                <option value="Master" <?= $educationSelected == "Master" ? "selected" : "" ?>>Master</option>
                                                <option value="PhD" <?= $educationSelected == "PhD" ? "selected" : "" ?>>PhD</option>
    
                                            </select>
                                        {{-- </select> --}}
                                        <div class="invalid-feedback">Please choose Higher Education Type</div>
                                    </div>

                                    <!-- Country -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="editState">Specialization</label>
                                        
                                        <input type="text" id="specialization" class="form-control" placeholder="Specialization" name="specialization" value="{{isset($ementorData[0]->specialization) ? $ementorData[0]->specialization : '' }}" required="">

                                        {{-- <select class="form-select" id="editState" required="" name="specialization">
                                            @php $specializationSelected = $ementorData[0]->specialization ; @endphp
                                            <option value="">Select</option>
                                            <option value="Bsc" <?= $specializationSelected == "Bsc" ? "selected" : "" ?>>Bsc</option>
                                            <option value="Bcom" <?= $specializationSelected == "Bcom" ? "selected" : "" ?>>Bcom</option>
                                            <option value="MA" <?= $specializationSelected == "MA" ? "selected" : "" ?>>MA</option>
                                            <option value="Msc" <?= $specializationSelected == "Msc" ? "selected" : "" ?>>Msc</option>
                                            <option value="Others" <?= $specializationSelected == "Others" ? "selected" : "" ?>>Others</option>
                                        </select> --}}
                                        <div class="invalid-feedback">Please enter specialization.</div>
                                        <div class="invalid-feedback" id="specialization_error" style="display: none;">Please enter specialization.</div>
                                    </div>

                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="lname">Institution Name</label>
                                        <input type="text" id="institution_name" name="institution_name" class="form-control" placeholder="Institution Name" value="{{isset($ementorData[0]->institution_name) ? $ementorData[0]->institution_name : '' }}" required="">
                                        <div class="invalid-feedback">Please enter Institution Name.</div>
                                    </div>

                                    <!-- Certificate  -->
                                    <div class=" col-12 col-md-12">
                                        <div class="mb-6">
                                            <label class="form-label">Upload Resume</label>
                                            <div class="custom-file-container mb-2">
                                                <label class="input-container">
                                                    <input accept=".pdf,.xls,.xlsx,.doc,.docx"  name="ementor_resume" aria-label="Choose File" class="form-control ementor_resume" id="inputLogo" type="file" draggable="false">
                                                    <span class="input-visible">{{ isset($ementorData[0]->resume_file_name) ? $ementorData[0]->resume_file_name : 'Choose file...' }} <span class="browse-button">Upload</span></span>
                                                </label>
                                                <div class="invalid-feedback" id="journal_file_error">Please upload file.</div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" id="old_resume_file" name="old_resume_file" value="{{isset($ementorData[0]->upload_resume) ? $ementorData[0]->upload_resume : '' }}">
                                        <input type="hidden" class="form-control" id="folder_name" name="folder_name" value="{{isset($ementorData[0]->folder_name) ? $ementorData[0]->folder_name : '' }}">
                                        <input type="hidden" class="form-control" id="resume_file_name" name="resume_file_name" value="{{isset($ementorData[0]->resume_file_name) ? $ementorData[0]->resume_file_name : '' }}">

                                        <div class="invalid-feedback">Please upload Resume.</div>
                                        <div class="mb-6">

                                            @if (isset($ementorData[0]->upload_resume))
                                            <a class="btn btn-primary" href="{{asset("storage/".$ementorData[0]->upload_resume)}}" class="resume @if (isset($ementorData[0]->upload_resume) && !empty($ementorData[0]->upload_resume)) @else '' @endif" download='My Resume'>Download Resume <i class="bi bi-download"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                   
                                    <br>

                                    <div class="col-12">
                                        <!-- Button -->
                                        <button class="btn btn-primary editEmentorProfile" type="button">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if(isset($subEmentorData[0]->linkedIn) && !empty($subEmentorData[0]->linkedIn))
                        <!-- Card -->
                        <div class="card mt-5">
                            <!-- Card header -->
                            <div class="card-header">
                                <h3 class="mb-0">Social Profiles</h3>
                            </div>
                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Twitter -->

                                {{-- <div class="row mb-5">
                                <div class="col-lg-3 col-md-4 col-12">
                                    <h5>Twitter</h5>
                                </div>
                                <div class="col-lg-9 col-md-8 col-12">  <input type="text" class="form-control mb-1" value="{{isset($ementorData[0]->twitter) ? $ementorData[0]->twitter : '' }}" name="twitter" placeholder="https://www.twitter.com" disabled>
                                
                                </div>
                                </div> --}}
                                <!-- Facebook -->
                                {{-- <div class="row mb-5">
                                <div class="col-lg-3 col-md-4 col-12">
                                    <h5>Facebook</h5>
                                </div>
                                <div class="col-lg-9 col-md-8 col-12">
                                    <input type="text" class="form-control mb-1" value="{{isset($ementorData[0]->facebook) ? $ementorData[0]->facebook : '' }}" name="facebook" placeholder="https://www.facebook.com" disabled> 
                                </div>
                                </div> --}}
                                <!-- Instagram -->
                                {{-- <div class="row mb-5">
                                <div class="col-lg-3 col-md-4 col-12">
                                    <h5>Instagram</h5>
                                </div>
                                <div class="col-lg-9 col-md-8 col-12">
                                    <input type="text" class="form-control mb-1" value="{{isset($ementorData[0]->instagram) ? $ementorData[0]->instagram : '' }}" name="instagram" placeholder="https://www.instagram.com" disabled>

                                </div>
                                </div> --}}
                                <!-- Linked in -->
                                {{-- <div class="row mb-5">
                                <div class="col-lg-3 col-md-4 col-12">
                                    <h5>LinkedIn Profile URL</h5>
                                </div>
                                <div class="col-lg-9 col-md-8 col-12">
                                    <input type="text" class="form-control mb-1" value="{{isset($ementorData[0]->linkedIn) ? $ementorData[0]->linkedIn : '' }}" name="linkedin" placeholder="https://www.linkedin.com/" disabled>
                                </div>
                                </div> --}}
                                <div class="ms-3">
                                    @if(isset($ementorData[0]->linkedIn) && !empty($ementorData[0]->linkedIn))
                                        <a href="{{ $ementorData[0]->linkedIn }}" target="_blank" rel="noopener noreferrer">
                                            <i class="bi bi-linkedin color-blue fs-3"></i>
                                        </a>
                                    @else
                                        <i class="bi bi-linkedin color-blue fs-3" title="LinkedIn profile not available"></i>
                                    @endif
                                </div>
                                

                                {{-- <div class="row mb-5">
                                    <div class="col-lg-3 col-md-4 col-12">
                                        <h5>Youtube</h5>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-12">
                                        <input type="text" class="form-control mb-1" value="{{isset($ementorData[0]->youtube) ? $ementorData[0]->youtube : '' }}" name="youtube" placeholder="https://www.youtube.com/" disabled>
                                    </div>
                                    </div> --}}
                                </div>


                                <!-- Button -->
                                {{-- <div class="row">
                                <div class="offset-lg-3 col-lg-6 col-12">
                                    <a href="#" class="btn btn-primary">Save Social Profile</a>
                                </div>
                                </div> --}}
                                </div>
                            </div>
                        </div>
                    @endif
                
                {{-- <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab"> --}}
                    <!-- Card body -->
                    {{-- <div class="card-body card"> --}}
    
                        {{-- <form class="row needs-validation" novalidate="">
                            <div class="mb-3 col-lg-6 col-md-12 col-12">
                                <label class="form-label" for="email">Email Address</label>
                                <input id="email" type="email" name="email" class="form-control" placeholder="" required="" value="cborg@ascencia-bs.com" disabled>
                                
                                <label class="form-label mt-3" for="text">Mobile Number</label>
                                <input id="text" type="text" name="text" class="form-control" placeholder="" required="" value="+356 545455454" disabled>
                            </div>
                        </form>
                        <hr class="my-3">
                        <div> --}}
                            {{-- <h4 class="mb-2">Change Password</h4> --}}
                            {{-- <p>We will email you a confirmation when changing your password, so please expect that email after submitting.</p> --}}
                            <!-- Form -->
                            {{-- <form class="row needs-validation" novalidate="">
                                <div class="col-lg-6 col-md-12 col-12">
                                    <!-- Current password -->
                                    <div class="mb-3">
                                        <label class="form-label" for="currentpassword">Current password</label>
                                        <input id="currentpassword" type="password" name="currentpassword" class="form-control" placeholder="" required="">
                                        <div class="invalid-feedback">Please enter current password.</div>
                                    </div>
                                    <!-- New password -->
                                    <div class="mb-3 password-field">
                                        <label class="form-label" for="newpassword">New password</label>
                                        <input id="newpassword" type="password" name="newpassword" class="form-control mb-2" placeholder="" required="">
                                        <div class="invalid-feedback">Please enter new password.</div>
                                        <div class="row align-items-center g-0">
                                            <div class="col-6">
                                                <span data-bs-toggle="tooltip" data-placement="right" data-bs-original-title="Test it by typing a password in the field below. To reach full strength, use at least 6 characters, a capital letter and a digit, e.g. 'Test01'">
                                                    Password strength
                                                    <i class="fe fe-help-circle ms-1"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <!-- Confirm new password -->
                                        <label class="form-label" for="confirmpassword">Confirm New Password</label>
                                        <input id="confirmpassword" type="password" name="confirmpassword" class="form-control mb-2" placeholder="" required="">
                                        <div class="invalid-feedback">Please enter confirm new password.</div>
                                    </div>
                                    <!-- Button -->
                                    <button type="submit" class="btn btn-primary">Save Password</button>
                                    <div class="col-6"></div>
                                </div>

                            </form> --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                {{-- </div> --}}

                <div class="tab-pane fade" id="aboutme" role="tabpanel" aria-labelledby="aboutme-tab">
                    <!-- Card body -->
                    <div class="card-body card">
    
                            <div>

                                <!-- Form -->
                                <form class="row gx-3 needs-validation ementorAboutme" novalidate="">
                                    <!-- Selection -->


                                    <!-- Question -->
                                    <div class="mb-6 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">
                                            <input type='hidden' name="question_id[]" value="{{base64_encode('1')}}">
                                            1.	Share a pivotal moment or experience that shaped your journey as a mentor.</label>
                                            <textarea class="form-control" name="answer[]" rows="2" disabled>{{isset($ementorAboutmedata[0]->answer) ? $ementorAboutmedata[0]->answer : '' }}</textarea>

                                    </div>
                                    <!-- Question -->
                                    <div class="mb-6 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">
                                            <input type='hidden' name="question_id[]" value="{{base64_encode('2')}}">
                                            2. What do you hope to achieve through mentoring others online?</label>
                                            <textarea class="form-control" name="answer[]" rows="2" disabled>{{isset($ementorAboutmedata[1]->answer) ? $ementorAboutmedata[1]->answer : '' }}</textarea>
                                    </div>
                                    <!-- Question -->
                                    <div class="mb-6 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">
                                            <input type='hidden' name="question_id[]" value="{{base64_encode('3')}}">
                                            3.	Describe a challenge you faced in your career and how you overcame it.</label>
                                            <textarea class="form-control" name="answer[]" rows="2" disabled>{{isset($ementorAboutmedata[2]->answer) ? $ementorAboutmedata[2]->answer : '' }}</textarea>

                                    </div>
                                    <!-- Question -->
                                    <div class="mb-6 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">
                                            <input type='hidden' name="question_id[]" value="{{base64_encode('4')}}">
                                            4.	Share a piece of advice or lesson that has had a significant impact on your life.</label>
                                            <textarea class="form-control" name="answer[]" rows="2" disabled>{{isset($ementorAboutmedata[3]->answer) ? $ementorAboutmedata[3]->answer : '' }}</textarea>
                                    </div>
                                    <!-- Question -->
                                    <div class="mb-6 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">
                                            <input type='hidden' name="question_id[]" value="{{base64_encode('5')}}">
                                            5.	What unique skills or expertise do you bring to your role as an e-mentor?</label>
                                            <textarea class="form-control" name="answer[]" rows="2" disabled>{{isset($ementorAboutmedata[4]->answer) ? $ementorAboutmedata[4]->answer : '' }}</textarea>
                                            </div>
                                    <!-- Question -->
                                    <div class="mb-6 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">
                                            <input type='hidden' name="question_id[]" value="{{base64_encode('6')}}">
                                            6.	How do you approach building a strong mentor-mentee relationship in a virtual setting?</label>
                                            <textarea class="form-control" name="answer[]" rows="2" disabled>{{isset($ementorAboutmedata[5]->answer) ? $ementorAboutmedata[5]->answer : '' }}</textarea>
                                    </div>
                                    <!-- Question -->
                                    {{-- <div class="mb-6 col-12 col-md-6">

                                        <button type="submit" class="btn btn-primary ementorAboutSubmit">Submit</button>
                                    </div>
         --}}



                                </form>
                            </div>
                   
                    </div>
                </div>
                    </div>
                </div>

                </div>
              </div>
            </div>
          </div>
</section>

</main>



<script>
    
    $(document).ready(function () {
        assignedCourseList();

        {{-- $(".total_counts").html("<?php echo $TotalCount ?>");
        $(".total_earnings").html("<?php echo $TotalPrice ?>");
        $(".curmonth_earnings").html("<?php echo $MonthPrice ?>");
        $(".curmonth_counts").html("<?php echo $MonthCount ?>");
        $(".total_exam_corrected").html("<?php echo $examCorrected ?>");
        $(".curmonth_exam_corrected").html("<?php echo $MonthExamCorrected ?>"); --}}
        

    });
    

    $('#examination-tab').on('click', function() {
        const paths = window.location.pathname.split("/").filter(path => path !== "");
        let ementorId = paths.length > 0 ? paths[paths.length - 1] : 0;

        try {
            if (btoa(atob(ementorId)) === ementorId) {
                ementorId = atob(ementorId);
            } else {
                ementorId = 0;
            }
        } catch (err) {
            ementorId = 0;
        }
        
        studentListRemark(btoa(3), btoa(ementorId));

        $("#pass").on("click", function (event) {
            studentListRemark(btoa(3), btoa(ementorId));
        });
        $("#fail").on("click", function (event) {
            studentListRemark(btoa(2), btoa(ementorId));
        });
        $("#checking-tab").on("click", function (event) {
            studentList(btoa(1), btoa(ementorId));
        });
        $("#pending").on("click", function (event) {
            studentList(btoa(0), btoa(ementorId));
        });
    });
    
    $('#students-tab').on('click', function() {
        const paths = window.location.pathname.split("/").filter(path => path !== "");
        let ementorId = paths.length > 0 ? paths[paths.length - 1] : 0;

        try {
            if (btoa(atob(ementorId)) === ementorId) {
                ementorId = atob(ementorId);
            } else {
                ementorId = 0;
            }
        } catch (err) {
            ementorId = 0;
        }

        assignedStudentList(ementorId);
    });

    $('.searchCourse').on('keyup', function() {
        var table = $('.assignedCourseList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });

    $('.searchStudent').on('keyup', function() {
        var table = $('.assignedStudentList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
    
    $('.searchSection').on('keyup', function() {
        var table = $('.studentListRemark').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });

    $('.searchSection').on('keyup', function() {
        var table = $('.studentList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });

    $('.ementorStudentSearchInput').on('keyup', function() {
        var table = $('.ementorStudentList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });

    function assignedCourseList(){
        $("#processingLoader").fadeIn();
        $(".dataTables_filter").css('display','none');
        var id = "<?php echo base64_encode($ementorData[0]->ementor_id) ?>";
        var baseUrl = window.location.origin + "/";
        $('.assignedCourseList').DataTable().destroy();
        $('.assignedStudentList').DataTable().destroy();
        $.ajax({
            url: baseUrl + 'admin/e-mentor-course-list/' + id,
            method: 'GET',
            success: function(response) {
                $("#processingLoader").fadeOut();
                // const combinedData = response[0].course_module.map(course => {
                // const orders = response[0].order_module.filter(order => order.course_id == course.id);
                //     return {
                //         id: course.id,
                //         category_id: course.category_id,
                //         course_title: course.course_title,
                //         course_thumbnail_file: course.course_thumbnail_file, // Include other relevant properties
                //         order_count: orders.length,
                //         mqfeqf_level:course.mqfeqf_level,
                //         ects:course.ects
                //     };
                // });  
                let combinedData = []; // Array to hold all formatted data

                response.forEach((item, i) => {
                    // Ensure the item has the necessary properties
                    if (item.order_module && item.id) {

                        const courseSummary = {
                            id: item.id, // Base64 encode the course_id
                            category_id: item.category_id, // Use item properties
                            course_title: item.course_title, // Use item properties
                            course_thumbnail_file: item.course_thumbnail_file, // Use item properties
                            order_count: item.order_module.length, // Number of orders
                            enrolledStudent: item.enrolledCount,
                            mqfeqf_level: item.mqfeqf_level, // Additional property
                            ects: item.ects // Additional property
                        };

                        // Add the course summary to the combined data
                        combinedData.push(courseSummary);

                        // combinedData = combinedData.concat(courseSummary);

                    }
                });
    
                // Initialize DataTable
                $('.assignedCourseList').DataTable({
                    data: combinedData,
                    columns: [
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                var baseUrl = window.location.origin + "/";

                                var img = data.course_thumbnail_file ? baseUrl + 'storage/' + data.course_thumbnail_file :  + '';
                                var Category = 'NA';
                                    if(data.category_id == 1){
                                        Catgeory = '<span class="badge bg-info-soft co-category">Award</span>';
                                    }else if(data.category_id == 2){
                                        Catgeory = '<span class="badge bg-info-soft co-category">Certificate</span>';
                                    }else if(data.category_id == 3){
                                        Catgeory =  '<span class="badge bg-info-soft co-category">Diploma</span>';
                                    }else if(data.category_id == 4){
                                        Catgeory ='<span class="badge bg-info-soft co-category">Master</span>';
                                    }
                                   
                                var url = baseUrl + "e-mentor-course-details/" + btoa(data.id) ;

                                return '<div class="d-flex align-items-center">' +
                                    '<div><a href="'+url+'"><img src="' + img + '" alt="course" class="rounded img-4by3-lg"></a></div>' +
                                    '<div class="ms-3">' +
                                    '<h4 class="mb-1 h5"><a href="'+url+'" class="text-inherit color-blue text-wrap-title">' + data.course_title + '</a></h4>' +
                                    '<ul class="list-inline fs-6 mb-0">' +
                                    '<li class="list-inline-item">' +
                                    '<b>MQF/EQF Level </b>: ' + (data.mqfeqf_level ? data.mqfeqf_level    : ' NA  ') +
                                    '<b>  ECTS </b> :'+ (data.ects ? data.ects       : ' NA  ') +
                                    '</li>' +
                                    '<li class="list-inline-item">'+ Catgeory + ' </li>' +
                                    '</ul></div></div>';
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                return data.enrolledStudent; // Row number starting from 1
                            }
                        },
                        // {
                        //     data: 'null',
                        //     render: function(data, type, row, meta) {
                        //         return ''; // Row number starting from 1
                        //     }
                        // }
                        // Add more columns as needed
                    ]
                });
                // let allFormattedData = []; // Array to hold all formatted data
                // response.forEach((item, i) => {
                //     // Ensure the item has the necessary properties
                //     if (item.order_module && item.id) {
                //         // Filter orders where course_id matches the current item's id
                //         const assignedStudent = item.order_module.filter(order => order.course_id == item.id);
                //         // Map each order to a formatted data structure
                //         const formattedData = assignedStudent.map(order => {
                //             const user = order.user; // Assuming order.user is a single user object
                //             return {
                //                 course_title: item.course_title, // Use item properties
                //                 course_id: btoa(item.id), // Base64 encode the course_id
                //                 user_id: btoa(user.id), // Base64 encode the user_id
                //                 category_id: item.category_id, // Use item properties
                //                 course_thumbnail_file: item.course_thumbnail_file, // Use item properties
                //                 user_name: `${user.name} ${user.last_name}`, // Concatenate first and last name
                //                 photo: user.photo, // User's photo
                //                 enrolled: user.student_course_data.course_start_date // Order created_at date

                //             };
                //         });
                //         allFormattedData = allFormattedData.concat(formattedData);

                //     }
                // });
                
                
                // console.log(allFormattedData);
                // Initialize DataTable
                // $('.assignedStudentList').DataTable({
                //     data: allFormattedData,
                //     columns: [
                //         {
                //             data:null,
                //             render: function(data, type, row, meta){
                                
                //                 var name = data.user_name ? data.user_name : 'NA';
                //                 var img = data.photo ? baseUrl + 'storage/' + data.photo : baseUrl + 'storage/studentDocs/student-profile-photo.png';
                //                 var url =  baseUrl + "admin/e-mentor-students-exam-details/"+data.user_id+"/"+data.course_id; 
                                
                //                 return (
                //                     "<div class='d-flex align-items-center'>" +
                //                     "<img src='" + img + "' alt='' class='rounded-circle avatar-md me-2'>" +
                //                     "<h5 class='mb-0'>" +
                //                     "<a href='"+url+"'>" + name + "</a> "  +
                //                     "</h5></div>"
                //                 );
                //             }
                //         },
                //         {
                //             data: null,
                //             render: function(data, type, row, meta) {
                //                 var img = data.course_thumbnail_file ? baseUrl + 'storage/' + data.course_thumbnail_file : baseUrl + '';
                //                 var Category = 'NA';
                //                     if(data.category_id == 1){
                //                         Catgeory = '<span class="badge bg-info-soft co-category">Award</span>';
                //                     }else if(data.category_id == 2){
                //                         Catgeory = '<span class="badge bg-info-soft co-category">Certificate</span>';
                //                     }else if(data.category_id == 3){
                //                         Catgeory =  '<span class="badge bg-info-soft co-category">Diploma</span>';
                //                     }else if(data.category_id == 4){
                //                         Catgeory ='<span class="badge bg-info-soft co-category">Master</span>';
                //                     }
                //                 // return data.course_title +  '<div class="d-flex align-items-center"><div class="me-2"><span>76%</span></div> <div class="progress w-100" style="height: 6px"> <div class="progress-bar bg-primary" role="progressbar" style="width: 76%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div></div> </div>';
                //                 return data.course_title +  '</div>';

                //             }
                //         },
                //         {
                //             data: null,
                //             render: function(data, type, row, meta) {
                //                 const dateTimeStr = data.enrolled; // 'dd-mm-yyyy hh:mm:ss'
                //                 // const [day, month, year] = dateTimeStr.split(/[- ]/); // Split by '-' and ' '
                //                 return dateTimeStr; // Format as 'dd-mm-yyyy'
                //             }
                //         },
                //         // {
                //         //     data: null,
                //         //     render: function(data, type, row, meta) {
                                 
                //         //         return '';
                //         //     }
                //         // },
                //         // Add more columns as needed
                //     ]
                // });

            },
            error: function(xhr, status, error) {
                $("#processingLoader").fadeOut();
                console.error(error);
            }
        });
       
    }

    $(".dataTables_filter").css("display", "none");

    function studentListRemark(token, ementorId) {
        
        $("#processingLoader").fadeIn();
        var baseUrl = window.location.origin + "/";
        $.ajax({
            url: baseUrl + "admin/get-e-mentor-students-exam/" + token + '/' + ementorId,
            method: "GET",
            success: function (data) {
                $("#processingLoader").fadeOut();
                $(".studentListRemark").DataTable().destroy();

                $(".studentListRemark").DataTable({
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
                                
                                if(data.name != ''){
                                    if(data.name != ''  && data.last_name != ''){

                                        var fname = data.name;
                                        var last_name = data.last_name;
                                    }else{
                                        var fname = '';
                                        var last_name = '';

                                    }
                                    var photo = data.photo;
                                    var user_id = data.userId;
                                    var course_id = data.courseId;
                                    
                                    var img = data.photo ? baseUrl + 'storage/' + data.photo : baseUrl + 'storage/studentDocs/student-profile-photo.png';
                                    var url =  baseUrl + "admin/e-mentor-students-exam-details/"+user_id+"/"+course_id; 
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
                            render: function (row) {
                                var course_title = row.course_title;
                                return '<p class="e-mentor-text-wrap-title">' + course_title + '</p>';
                            },
                        },

                        {
                            data: null,
                            render: function (row) {
                                return row.course_start_date;

                            }

                        },
                    ],            
                });
            },
            error: function (xhr, status, error) {
                $("#processingLoader").fadeOut();
                console.error(error);
            },
        });
    }
    

    function studentList(token, ementorId) {
        $("#processingLoader").fadeIn();
        var baseUrl = window.location.origin + "/";

        $.ajax({
            url: baseUrl + "admin/get-e-mentor-students-exam/" + token + '/' + ementorId,
            method: "GET",
            success: function (data) {
                $("#processingLoader").fadeOut();
             $(".studentList").DataTable().destroy();
                
                $(".loader").addClass("d-none");
                
                
                $(".studentList").DataTable({
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
                            render: function (row) {
                                if(row){
                                    if(row){

                                        var fname = row.name;
                                        var last_name = row.last_name;
                                    }else{
                                        var fname = '';
                                        var last_name = '';

                                    }
                                    var photo = row.photo;
                                    var user_id = btoa(row.user_id);
                                    var course_id = btoa(row.id);
                                    
                                    var img = row.photo ? baseUrl + 'storage/' + row.photo : baseUrl + 'storage/studentDocs/student-profile-photo.png';
                                    var url =  baseUrl + "admin/e-mentor-students-exam-details/"+user_id+"/"+course_id; 
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
                            render: function (row) {
                                var course_title = row.course_title;
                                return '<p class="e-mentor-text-wrap-title">' + course_title + '</p>';
                            },
                        },
                        {
                            data: null,
                            render: function (row) {
                                var exam_id = btoa(row.exam_id);
                                var user_id = btoa(row.user_id);
                                var exam_type = row.exam_type;
                                var exam_title = row.exam_title;
                                var student_course_master_id = btoa(row.student_course_master_id);

                                var baseUrl = "/admin/answersheet/" + exam_id + "/" + btoa(row.exam_type) + "/" + user_id + "/" + student_course_master_id;

                                if (row.is_cheking_completed != '2') {
                                    return '<a href="' + baseUrl + '">' + exam_title + '</a>';
                                } else {
                                    return exam_title;
                                }
                            },
                        },
                        {
                            data: null,
                            render: function (row) {
                                var created_at ='';
                                const dateTimeStr = row.created_at;
                                return `${dateTimeStr}`;


                            }

                        },
                    ],
                });
            },
            error: function (xhr, status, error) {
                $("#processingLoader").fadeOut();
                console.error(error);
            },
        });
    }
    
    function assignedStudentList(ementorId){
        $("#processingLoader").fadeIn();
        $(".dataTables_filter").css('display','none');
        var baseUrl = window.location.origin;  

        $.ajax({
            url: '/admin/get-all-students-list/'+ btoa(ementorId),
            method: 'GET',
            success: function (data) {
                
                $("#processingLoader").fadeOut();
                $(".ementorStudentList").DataTable().destroy();
                $(".ementorStudentList").DataTable({
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
                                    
                                    var img = data.photo ? baseUrl + '/storage/' + data.photo : baseUrl + '/storage/studentDocs/student-profile-photo.png';
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
                                        var scmId = btoa(course.scmId);

                                        const courseUrl = `/admin/e-mentor-students-exam-details/${userId}/${courseId}/${scmId}`;
                                        courseTitles += `${index + 1}. <a href="${courseUrl}">${course.course_title}</a><br><br>`;
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
                $("#processingLoader").fadeOut();
                console.error(error);
            }
        });
    }
    
    $('#searchInput').on('input', function() {
        var courseTable = $('.assignedCourseList').DataTable();
        var searchTerm = $(this).val();
        courseTable.search(searchTerm).draw();
    });

    $('#studentSearchInput').on('input', function() {
        var studentTable = $('.assignedStudentList').DataTable();
        var searchTerm = $(this).val();
        studentTable.search(searchTerm).draw();
    });

    $('#ementorStudentSearchInput').on('input', function() {
        var studentTable = $('.ementorStudentList').DataTable();
        var searchTerm = $(this).val();
        studentTable.search(searchTerm).draw();
    });

    $('#searchExamination').on('input', function() {
        var table = $('.studentListRemark').DataTable();
        var table1 = $('.studentList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
        table1.search(searchTerm).draw();
    });
    </script>
@endsection
