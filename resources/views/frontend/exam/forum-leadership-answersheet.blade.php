@extends('frontend.master')
@section('content')
    <main>
        <section class="p-lg-5 py-7">
            <div class="container">
                @php
                    $exam = $examData[0];
                    $discordExam = $exam['discord_exam'][0];
                    $discordExamAnswer = $exam['discord_exam_answers'][0];
                    $studentData = $exam['exam_student'][0];
                    $courseData = $exam['exam_course'][0];
                    $totalMarks = isset($discordExam['marks']) && !empty($discordExam['marks']) ?  $discordExam['marks'] : 0;
                    $totalObtain = isset($discordExamAnswer['marks_given']) && !empty($discordExamAnswer['marks_given']) ?  $discordExamAnswer['marks_given'] : 0;
                    $courseOtherDetail = getData('course_other_details', ['discord_channel_link'], ['course_id' => $exam['course_id']]);
                    $discordChannelLink = $courseOtherDetail[0]->discord_channel_link;
                @endphp

                <!-- Content -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-3 mb-xl-0">
                        <!-- Card -->
                        <div class="card mb-4">
                            <!-- Card body -->
                            <div class="card-body py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="fw-bold mb-0 color-blue ">Forum leadership ({{isset($discordExam['percentage'])  ? $discordExam['percentage'] : 0}}%) <span class="fs-6 fw-semibold">{{isset($courseData['course_title'])  ? html_entity_decode($courseData['course_title']) : ''}}</span>
                                    </h3>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">

                                        <div class="lh-1">
                                            <h4 class="mb-1 mentor-studentname mobileviewtext"> Student Name: <span class="color-blue">{{isset($studentData['name']) || isset($studentData['last_name'])   ? $studentData['name']." ". $studentData['last_name'] : ''}}</span>
                                            </h4>
                                        </div>
                                    </div>
                                    <div>
                                        {{-- <a href="javascript:history.back()" class="btn btn-outline-primary mobileViewButton">Back</a> --}}
                                        {{-- <a href="{{route('e-mentor-students-exam')}}" class="btn btn-outline-primary mobileViewButton">Back</a> --}}
                                        
                                        {{-- @php
                                            $routeName = auth()->user()->role == 'admin' ? 'admin-e-mentor-students-exam-details' : 'e-mentor-students-exam-details';
                                        @endphp --}}

                                        @php
                                            $routeName = in_array(auth()->user()->role, ['admin', 'superadmin']) 
                                                ? 'admin-e-mentor-students-exam-details' 
                                                : 'e-mentor-students-exam-details';
                                        @endphp

                                        <a href="{{ route($routeName, [
                                            'id' => base64_encode($studentData['id']),
                                            'course_id' => base64_encode($courseId),
                                            'student_course_master_id' => base64_encode($exam['student_course_master_id'])
                                        ]) }}" class="btn btn-outline-primary mobileViewButton">Back</a>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-flush">
                                            {{-- <li class="list-group-item px-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-calendar4 text-primary" viewBox="0 0 16 16">
                                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5
                                                                0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0
                                                                1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1
                                                                2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0
                                                                0-1 1v1h14V3a1 1 0 0 0-1-1H2zm13 3H1v9a1
                                                                1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z"></path>
                                                        </svg>
                                                        <div class="ms-2">
                                                            <h5 class="mb-0 text-body">Start Date</h5>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <p class="text-dark mb-0 fw-semibold">01 May, 2024</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> --}}
                                            <li class="list-group-item px-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-calendar4 text-primary" viewBox="0 0 16 16">
                                                            <path d="M3.5 0a.5.5 0 0 1
                                                                        .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0
                                                                        1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0
                                                                        1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1
                                                                        .5-.5zM2 2a1 1 0 0 0-1 1v1h14V3a1 1 0
                                                                        0 0-1-1H2zm13 3H1v9a1 1 0 0 0 1 1h12a1
                                                                        1 0 0 0 1-1V5z"></path>
                                                        </svg>
                                                        <div class="ms-2">
                                                            <h5 class="mb-0 text-body">Submitted On</h5>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div>
                                                              <p class="text-dark mb-0 fw-semibold">{{isset($exam['submitted_on'])  ?  \Carbon\Carbon::parse($exam['submitted_on'])->format('Y-m-d') : ''}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0 pb-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                            fill="currentColor" class="bi bi-clock text-primary" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5
                                                                0 0 0 .252.434l3.5 2a.5.5 0 0 0
                                                                .496-.868L8 8.71V3.5z"></path>
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0
                                                                    0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7
                                                                    0 0 1 14 0z"></path>
                                                        </svg>
                                                        <div class="ms-2">
                                                            <h5 class="mb-0 text-body">Last Update</h5>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <p class="mb-0 fw-semibold text-dark">{{isset($exam['last_update_at'])  ?  \Carbon\Carbon::parse($exam['last_update_at'])->format('Y-m-d') : ''}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        fill="currentColor" class="bi bi-award text-primary"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702z" />
                                                        <path
                                                            d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z" />
                                                    </svg>
                                                        <div class="ms-2">
                                                            <h5 class="mb-0 text-body"> Marks Obtained</h5>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <p id="total-obtain-display" class="text-success mb-0 fw-semibold">{{$totalObtain}}/ {{$totalMarks}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- Card -->
                        <div class="card rounded-3">
                            <!-- Card body -->
                            <section class="container px-4 pt-4">


                                <div class="row justify-content-center">
                                    <div class="col-md-12 mb-3">
                                        <p> <strong>Instructions:</strong> As a mentor, your role is to assess students
                                            based on their performance and communication skills within the Discord platform.
                                            Evaluate each student's engagement, clarity, and effectiveness in interactions,
                                            and assign marks accordingly. Ensure that your feedback is constructive and
                                            helps guide them towards improvement. Your evaluations will play a crucial role
                                            in their overall success and growth in this forum.</p>
                                    </div>
                                    <hr>
                                    <div class="d-flex">
                                        <a href="{{ $discordChannelLink }}" class="btn btn-outline-primary d-flex align-items-center">
                                            <i class="bi bi-arrow-right me-2"></i> Go to Student Discord
                                        </a>
                                    </div>
                                  
                                    <form id="examMarksForm">
                                    
                                        <input type="hidden" name="actual_course_id" value="{{ base64_encode($courseId)}}">
                                        <input type="hidden" name="course_id" value="{{ base64_encode($exam['course_id'])}}">
                                        <input type="hidden" name="exam_id"  value="{{ base64_encode($exam['exam_id'])}}">
                                        <input type="hidden" name="student_id"  value="{{ base64_encode($exam['user_id'])}}">
                                        <input type="hidden" name="exam_type"  value="{{ base64_encode(5)}}">
                                        <input type="hidden" name="student_course_master_id"  value="{{ base64_encode($exam['student_course_master_id'])}}">
                                        
                                        <div class="col-md-12 mb-5">
                                            <div class="col-md-12 col-12 mt-3 mb-3">
                                                <div class="color-blue d-flex align-items-end">
                                                    <div class="col-md-4 col-lg-2">
                                                        <h5 class="me-3 ">Marks: <span>(Out of {{$totalMarks}})</span></h5>
                                                        <input type="number" name="mark" id="mark" class="form-control" placeholder="Give Marks" value="{{ isset($discordExamAnswer['marks_given']) ? $discordExamAnswer['marks_given'] : ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            @if(Auth::user()->role == 'instructor' || Auth::user()->role === 'sub-instructor')
                                                <hr />
                                                <div class="mb-3 d-flex mt-3">
                                                    <div class="me-2">
                                                        <button type="button" class="btn btn-primary submitExam" data-type="1"
                                                            data-examTypeId="2" style="white-space: nowrap">Final
                                                            Submit</button>
                                                    </div>
                                                    <div class="">
                                                        <button type="button" class="btn btn-secondary updateExam"
                                                            data-type="0" data-examTypeId='2' style="white-space: nowrap">Save
                                                            Draft</button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    <form>
                                </div>
                            </section>
                        </div>
                    </div>


                </div>
            </div>
        </section>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0"
                            style="height: 600px">
                            <div style="text-align:center">
                                <h4>Pdf viewer testing</h4>
                                <iframe class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100"
                                    width="560" height="315" src="{{ asset('frontend/images/pdf/Unit-4.pdf') }}"
                                    title="E-Ascencia - Academy and LMS Template" frameborder="0"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('admin/js/examCommon.js')}}"></script>
@endsection
