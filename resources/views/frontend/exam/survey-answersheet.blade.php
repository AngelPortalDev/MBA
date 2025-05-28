@extends('frontend.master')
<style>
    .survey-question-text p{
        margin-bottom: 0px !important;
        font-weight: 600;
        color: #1E293B;
        white-space: pre-line;
    }
</style>

@section('content')
<main>
    <section class="p-lg-5 py-7">
        <div class="container">
            @php
                $exam = $examData[0];
                $surveyExam = $exam['survey_exam'][0];
                $surveyQuestion = $surveyExam['survey_question'];
                $studentData = $exam['exam_student'][0];
                $courseData = $exam['exam_course'][0];
                $totalMarks = 0;
                $totalObtain = 0;
                foreach ($surveyQuestion as $value) {
                    $totalMarks += isset($value['marks']) && !empty($value['marks']) ?  $value['marks'] : 0;
                    $totalObtain += isset($value['survey_answers'][0]['marks_given']) && !empty($value['survey_answers'][0]['marks_given']) ?  $value['survey_answers'][0]['marks_given'] : 0;
                }
            @endphp

            <!-- Content -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-3 mb-xl-0">
                    <!-- Card -->
                    <div class="card mb-4">
                        <!-- Card body -->
                        <div class="card-body py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="fw-bold mb-0 color-blue ">{{isset($surveyExam['title'])  ? html_entity_decode($surveyExam['title']) : ''}} ({{isset($surveyExam['percentage'])  ? $surveyExam['percentage'] : 0}}%) <span
                                        class="fs-6 fw-semibold">{{isset($courseData['course_title'])  ? $courseData['course_title'] : ''}}</span>
                                </h3>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">

                                    <div class="lh-1">
                                        <h4 class="mb-1"> Student Name: <span class="color-blue">{{isset($studentData['name']) || isset($studentData['last_name'])   ? $studentData['name']." ". $studentData['last_name'] : ''}}</span>
                                        </h4>
                                    </div>
                                </div>
                                <div>
                                    {{-- <a href="javascript:history.back()" class="btn btn-outline-primary mobileViewButton">Back</a> --}}
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-calendar4 text-primary"
                                                        viewBox="0 0 16 16">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-calendar4 text-primary"
                                                        viewBox="0 0 16 16">
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
                            <form id="examMarksForm">
                                <input type="hidden" name="actual_course_id" value="{{ base64_encode($courseId)}}">
                                <input type="hidden" name="course_id" value="{{ base64_encode($courseData['id'])}}">
                                <input type="hidden" name="exam_id"  value="{{ base64_encode($surveyExam['id'])}}">
                                <input type="hidden" name="student_id"  value="{{ base64_encode($studentData['id'])}}">
                                <input type="hidden" name="exam_type"  value="{{ base64_encode(8)}}">
                                <input type="hidden" name="student_course_master_id"  value="{{ base64_encode($exam['student_course_master_id'])}}">

                                <div class="row justify-content-center">
                                    <div class="col-md-12 mb-0">
                                        @php
                                            echo isset($surveyExam['instructions']) ? html_entity_decode($surveyExam['instructions']) : '';
                                            $num = 1;
                                        @endphp
                                    </div>
                                </div>
                                <hr>
                                @foreach ($surveyQuestion as $item)
                                    <h5 class="text-inherit mb-0 survey_ementor_question">
                                        Question {{$num}} : 
                                        <p class="d-inline mb-0" style="display: inline; margin: 0; float:inline-end">[{{ isset($item['marks']) ? $item['marks'] : 0}} Marks]</p>
                                    </h5>

                                     <!-- Display Question Text -->
                                    <div class="survey-question-text">
                                        {!! isset($item['question']) ? $item['question'] : '' !!}
                                    </div>
                                    <input type="hidden" name="question_id[]" id="question_id" value="{{ base64_encode($item['id'])}}">
                                    <p class="color-blue fw-semibold survey_ementor_answer mb-1 mt-1">Answer : </p>
                                    <div class="d-flex flex-wrap gap-3">
                                        @foreach($item['input_files'] as $inputFile)
                                            @if (isset($inputFile['file_url']) && !empty($inputFile['file_url']) && Storage::exists($inputFile['file_url']))
                                                <div class="col-12 col-md-3 mb-3"> <!-- Added column sizing for responsiveness -->
                                                    <label for="" class="fw-semibold mb-1 mt-1">{{ isset($inputFile['input_configurations']['label_name']) !== null ? $inputFile['input_configurations']['label_name'] : '' }}</label>
                                                    <div class="d-flex justify-content-center align-items-center rounded border-white border rounded-3 bg-cover" style="background-image:url({{ asset('frontend/images/document-thumbnail-01.png') }});height:155px;">
                                                        <a class="icon-shape rounded-circle btn-play icon-xl bg-blue" href="javascript:void(0)" onclick="openPdf('{{ asset('storage/' . $inputFile['file_url']) }}')">
                                                            <i class="bi color-green fs-4 fw-bold bi-eye"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-12 col-md-4 mb-3"> <!-- Added column sizing for responsiveness -->
                                                    <h6 class="badge text-bg-warning">Not Attempt</h6>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    
                                    <div class="pt-2 pb-2 ps-2 mt-2 mb-2" style="background: #f7f7f7">
                                        <p class="mb-0"> {{ isset($item['survey_answers'][0]) && !empty($item['survey_answers'][0]['answer']) ? $item['survey_answers'][0]['answer'] : '--Not Attempt--'}} </p>
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <div class="color-blue d-flex align-items-end">
                                            <div class="col-md-4 col-lg-2 col-sm-12">
                                                <h5 class="me-3 ">Marks: <span>(Out of {{ isset($item['marks']) ? $item['marks'] : 0}})</span></h5>
                                            <input type="number" name="marks[]" class="form-control marks-input" placeholder="Give Marks" max="" value="{{ isset($item['survey_answers'][0]['marks_given']) ? $item['survey_answers'][0]['marks_given'] : ''}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    @php
                                        $num++;
                                    @endphp
                                @endforeach

                                @if(Auth::user()->role == 'instructor' || Auth::user()->role === 'sub-instructor')
                                    <div class="mb-3 d-flex">
                                        <div class="me-2">
                                            <button type="button" class="btn btn-primary submitEmentor" data-type="1" data-examTypeId="2" style="white-space: nowrap">Final Submit</button>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-secondary updateEmentor" data-type="0" data-examTypeId="2" style="white-space: nowrap">Save Draft</button>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Survey Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive position-relative w-100 d-block overflow-hidden" style="height: 600px;">
                        <iframe class="position-absolute top-0 end-0 start-0 bottom-0 w-100 h-100" src="{{ asset('frontend/images/pdf/Unit-4.pdf') }}" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</main>
<script> 

    function openPdf(url) {
        urlFile = url;
        $("#exampleModal-2").modal('show');
        $("#exampleModal-2").find('iframe').attr('src',urlFile);
    }

    $(document).ready(function(){
        $('.marks-input').on('input', function() {
            let totalObtain = 0;
            $('.marks-input').each(function() {
                let marks = parseFloat($(this).val()) || 0;
                totalObtain += marks;
            });
            $('#total-obtain-display').text(totalObtain + ' / {{ $totalMarks }}');
        });
    });

</script>
<script src="{{ asset('admin/js/examCommon.js')}}"></script>
@endsection
