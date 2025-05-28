@extends('frontend.master')
@section('content')

<style>
    .sidenav.navbar .navbar-nav .e-men-1 > .nav-link {
    background-color: var(--gk-gray-200);
}
</style>

<main>
    <section class="pt-5 pb-5">
        <div class="container">
            
            <!-- Top Menubar -->
            @include('frontend.teacher.layout.e-mentor-common')

            <!-- Content -->

            {{-- <div class="row mt-0 mt-md-4"> --}}

                {{-- Left menubar  --}}
                
                {{-- @include('frontend.teacher.layout.e-mentor-left-menu') --}}

                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Card -->
                            <div class="card mb-4 e-mentor-card">
                                <div class="p-4">
                                    <span class="fs-6 text-uppercase fw-semibold">Total Revenue</span>
                                    <h2 class="mt-4 fw-bold mb-1 d-flex align-items-center h1 lh-1 total_earnings">€4,46,734</h2>
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
                                    <h2 class="mt-4 fw-bold mb-1 d-flex align-items-center h1 lh-1  total_exam_corrected"></h2>
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
                                    @foreach($ementorData as $course_module)
                                    @php 
                                        $orderCount =0;
                                        $OrderPrice=0;
                                        $courseId = $course_module['id'];     
                                    @endphp
                                        @foreach($course_module['OrderModule'] as $order_module)
                                            <!--@if($order_module['course_id'] == $courseId)-->
                                                @php $ExamCorrectedQuery = DB::table('student_course_master')->where('user_id',$order_module['user']['userData']['id'])->where('course_id',$courseId)->first();
                                                if ($ExamCorrectedQuery && $ExamCorrectedQuery->course_start_date) {
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
                                                }
                                                @endphp
                                            <!--@endif-->
                                        @endforeach
                                 
                                   

                                    <!-- Printing the course module for debugging purposes -->
                                    <tr>
                                        <td>
                                            <a href="{{route('e-mentor-course-details',['course_id'=>base64_encode($course_module->id)])}}">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{Storage::url($course_module->course_thumbnail_file)}}"  alt="course" class="rounded img-4by3-lg" >
                                                    <h5 class="ms-3 text-primary-hover mb-0  color-blue text-wrap-title">{{$course_module->course_title}}</h5>
                                                </div>
                                            </a>
                                        </td>
                                        <td>{{$orderCount}}</td>
                                        <td>€{{$OrderPrice}}</td>

                                    </tr>
                                    @endforeach
                                    <div id="total_counts" value="{{$TotalCount}}">{{$TotalCount}}</div> 
                                    <div id="total_earnings" value="{{$TotalPrice}}">{{$TotalPrice}}</div>
                                    <div id="curmonth_counts" value="{{$MonthCount}}">{{$MonthCount}}</div> 
                                    <div id="curmonth_earnings" value="{{$MonthPrice}}">{{$MonthPrice}}</div>
                                    <div id="total_exam_corrected" value="{{$examCorrected}}">{{$examCorrected}}</div>
                                    <div id="curmonth_exam_corrected" value="{{$MonthExamCorrected}}">{{$MonthExamCorrected}}</div>


                                    

                                    {{-- <tr>
                                        <td>
                                            <a href="{{route('e-mentor-course-details')}}">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('frontend/images/course/masters-human-resource-management.png')}}"  alt="course" class="rounded img-4by3-lg" >
                                                    <h5 class="ms-3 text-primary-hover mb-0  color-blue">Award in Training and Development</h5>
                                                </div>
                                            </a>
                                        </td>
                                        <td>34</td>
                                        <td>€500</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="{{route('e-mentor-course-details')}}">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('frontend/images/course/award-recruitment-and-employee-selection.png')}}"  alt="course" class="rounded img-4by3-lg" >
                                                    <h5 class="ms-3 text-primary-hover mb-0  color-blue">Award in Recruitment and Employee Selection</h5>
                                                </div>
                                            </a>
                                        </td>
                                        <td>30</td>
                                        <td>€500</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="{{route('e-mentor-course-details')}}">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('frontend/images/course/certificate-human-resource-management.png')}}"  alt="course" class="rounded img-4by3-lg" >
                                                    <h5 class="ms-3 text-primary-hover mb-0  color-blue">Award in Employee and Labour Relations</h5>
                                                </div>
                                            </a>
                                        </td>
                                        <td>26</td>
                                        <td>€500</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="{{route('e-mentor-course-details')}}">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('frontend/images/course/diploma-human-resource-management.png')}}"  alt="course" class="rounded img-4by3-lg" >
                                                    <h5 class="ms-3 text-primary-hover mb-0  color-blue">Award in Performance Management and Compensation</h5>
                                                </div>
                                            </a>
                                        </td>
                                        <td>20</td>
                                        <td>€500</td>

                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </section>
</main>
<script>
    // $(document).ready(function () {
        $(".total_counts").html(total_counts);
        $(".total_earnings").html(total_earnings);
        $(".curmonth_earnings").html(curmonth_earnings);
        $(".curmonth_counts").html(curmonth_counts);
        $(".total_exam_corrected").html(total_exam_corrected);
        $(".curmonth_exam_corrected").html(curmonth_exam_corrected);




    // });
</script>
@endsection