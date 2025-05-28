<!-- Header import -->
@extends('admin.layouts.main')
@section('content')

<style>
    .assignmnetquestiontitle p{
        display: inline-block;
    }
</style>

<!-- Container fluid -->
<section class="p-4">
    <div class="container">
        <div id="courseForm" class="bs-stepper">
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <form class="w-100 AssignmetFormData">
                        <!-- Card -->
                        <div class="card mb-4">
                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Assignment -->
                                <div class="row">
                                    <div class="d-lg-flex justify-content-between align-items-end col-12 mb-2">
                                        <div class="w-100 d-flex justify-content-between">
                                            <h3 class="mb-2"><a href="#" class="text-inherit editExamTitle">Edit Assignment</a></h3>
                                                {{-- <button class="btn btn-outline-primary custum-btn-mobile" onclick="{{ route('assignment') }}">Back</button> --}}
                                                <a href="{{ route('admin.exam.assignment') }}" class="btn btn-outline-primary custum-btn-mobile">Back</a>

                                        </div>
                                    </div>
                                    
                                    <!-- Assignment title -->
                                    <div class="col-md-12 col-sm-12 col-lg-6 ">
                                        <div class="w-100">
                                            {{-- <form class="w-100 AssignmetFormData"> --}}
                                            <label class="form-label" for="assignment_title">Assignment Title <span class="text-danger">*</span></label>
                                            <input type="text" id="assignment_title" name="assignment_title" class="form-control" placeholder="Assignment Title" required="" value="{{ isset($assignmentData[0]['assignment_tittle']) ? html_entity_decode($assignmentData[0]['assignment_tittle'], ENT_QUOTES, 'UTF-8') : '' }}" >
                                            <input type="text" id="assign_id" name="assign_id" value="{{isset($assignmentData[0]['id']) ? base64_encode($assignmentData[0]['id']) : 0}}" hidden>
                                            <small>Assignment title must be between 3 to 255 characters.</small>
                                            <div class="invalid-feedback" id="assignment_title_error">Please enter assignment title</div>
                                        </div>
                                    </div>

                                    <!-- Percentage -->
                                    <div class="col-md-12 col-sm-12 col-lg-6 mt-2 mt-md-0">
                                        <div class="w-100 mt-2 mt-lg-0">
                                            <label class="form-label" for="assignment_percentage">Assignment Total Percentage (%)<span class="text-danger">*</span></label>
                                            <input type="number" id="assignment_percentage" name="assignment_percentage" class="form-control" placeholder="Assignment Percentage" required="" value="{{isset($assignmentData[0]['assignment_percentage']) ? $assignmentData[0]['assignment_percentage'] : ''}}">
                                            <div class="invalid-feedback" id="assignment_percentage_error">Please enter assignment total percentage</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Instructions -->
                                    <div class="col-md-12 mt-3">
                                        <label class="form-label">Instructions <span class="text-danger">*</span></label>
                                        <div id="instruction"  placeholder="Programme Outcomes" class="form-control w-100" style="height: 200px">
                                        @php echo !empty($assignmentData[0]['instructions']) ? htmlspecialchars_decode($assignmentData[0]['instructions']) : ''  @endphp
                                    </div>
                                    <input type='text' name='instruction' hidden>
                                    <div class="invalid-feedback" id="programme_outcomes_error">Please enter instructions</div>
                                    </div>


                                    <!-- Enable Draft Mode -->
                                    <div class="col-md-12 col-sm-12 col-lg-12 mt-4">
                                        <label>
                                            <input type="checkbox" name="enable_draft_mode" id="enable_draft_mode" value="1" {{ $assignmentData[0]['enable_draft_mode'] == '1' ? 'checked' : '' }}> Enable Draft Mode?
                                        </label>
                                    </div>

                                    <!-- Enable Exam Feedback -->
                                    <div class="col-md-12 col-sm-12 col-lg-12 mt-4">
                                        <label>
                                            <input type="checkbox" name="enable_exam_feedback" id="enable_exam_feedback" value="1" {{ $assignmentData[0]['enable_exam_feedback'] == '1' ? 'checked' : '' }}> Enable Exam Feedback?
                                        </label>
                                    </div>


                                    <!-- Duration -->
                                    <div class="row d-flex flex-column">
                                        <div class="col-md-12 col-sm-12 col-lg-6 mt-4">
                                            <label>
                                                <input type="checkbox" id="enable_duration" 
                                                    {{ $assignmentData[0]['exam_duration'] != '' ? 'checked' : '' }}>
                                                Enable Duration
                                            </label>
                                        </div>                                 
        
                                        <div class="col-md-12 col-sm-12 col-lg-6 mt-2" id="duration_fields" style="{{ $assignmentData[0]['exam_duration'] != '' ? '' : 'display:none;' }}; margin-top: 10px;">
                                            <div class="w-100 w-md-50 w-sm-50 mt-2 mt-lg-0">
                                                <label class="form-label" for="exam_duration">Exam Duration</label>
                                                
                                                <div class="">
                                                    <!-- Hours Dropdown -->
                                                    <div class="hoursesection">
                                                        <select id="exam_duration_hours" name="exam_duration_hours" class="form-control me-2 " {{ $assignmentData[0]['exam_duration'] != '' ? '' : 'disabled' }}>
                                                            <option value="">Hours</option>
                                                            @for ($i = 0; $i <= 6; $i++)
                                                                <option value="{{ $i }}">
                                                                    {{ $i }} hour{{ $i != 1 ? 's' : '' }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                        <div class="invalid-feedback mt-2" id="exam_duration_hours_error" style="{{ $assignmentData[0]['exam_duration'] != '' ? 'display:none;' : '' }}">Please select hours.</div>
                                                    </div>
                                                    <!-- Minutes Dropdown -->
                                                    <div class="minutssection mt-2">
                                                        <select id="exam_duration_minutes" name="exam_duration_minutes" class="form-control" {{ $assignmentData[0]['exam_duration'] != '' ? '' : 'disabled' }}>
                                                            <option value="">Minutes</option>
                                                            <option value="0">0 minutes</option>
                                                            <option value="5">05 minutes</option>
                                                            <option value="15">15 minutes</option>
                                                            <option value="30">30 minutes</option>
                                                            <option value="45">45 minutes</option>
                                                        </select>
                                                        <div class="invalid-feedback" id="exam_duration_minutes_error" style="{{ $assignmentData[0]['exam_duration'] != '' ? 'display:none;' : '' }}">Please select minutes.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- question --}}
                            <div class="card-header ">
                                <div class="row justify-content-between">
                                    <div class="col-md-6 col-sm-12 col-lg-6">
                                        <h4 class="mb-0">Questions</h4>
                                        <p class="mb-0">Assignment questions categories</p>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-6">
                                        <div class="mt-3 text-end">
                                            <a href="#" class="btn btn-primary addAssignQuestionOpen">Question <i class="fe fe-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="bg-light rounded p-2 mb-4">
                                    <div class="list-group list-group-flush border-top-0" id="QuestionList">
                                        <div id="courseOne">
                                            @if (isset($assignmentData[0]['assig_question']) && count($assignmentData[0]['assig_question']) > 0)
                                                @foreach ($assignmentData[0]['assig_question'] as $qusetions)
                                                    <div class="list-group-item rounded px-3 text-nowrap mb-1" id="development">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h5 class="mb-0 text-truncate">
                                                                <a href="#" class="text-inherit">
                                                                    <span class="align-middle fs-4 text-wrap-title questiontitle assignmnetquestiontitle"> 
                                                                        <i class="bi bi-question-circle me-2"></i>  {!! isset($qusetions['question']) ? $qusetions['question'] : '' !!}
                                                                    </span>
                                                                </a>
                                                            </h5>
                                                            <div>
                                                                <a href="javascript:void(0);" class="me-2 text-inherit editViewAssignQuestion" aria-label="Edit"
                                                                    data-question_id="{{isset($qusetions['id']) ? base64_encode($qusetions['id']) : 0 }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
                                                                    <i class="fe fe-edit edit-icon fs-5 " data-bs-toggle="modal" data-bs-target="#editQuestion"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    class="me-1 text-inherit deleteAssingQuestion" data-question_id="{{isset($qusetions['id']) ? base64_encode($qusetions['id']) : 0 }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                                                        <i class="fe fe-trash-2 fs-5"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary updateAssignment">Save Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</main>

<!-- Question Modal -->
<div class="modal fade" id="AssignQuestionModel" tabindex="-1" aria-labelledby="AssignQuestionModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- modal body -->
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="modal-title" id="AssignQuestionModelLabel">Add Question</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div>
                    <!-- form -->
                    <form class="needs-validation assignmentQuestions" novalidate>
                        <input type="text" id="assign_id" name="assign_id" value="{{isset($assignmentData[0]['id']) ? base64_encode($assignmentData[0]['id']) : 0}}" hidden>
                        <div class="mb-5">
                            {{-- <div class="mb-3">
                                <label class="form-label" for="question">Write Your Question<span class="text-danger">*</span></label>
                                <input type="text" id="question"  name="question" class="form-control"
                                    placeholder="Write Your Question Here">
                                <input type="text" id="question_id"  name="question_id" hidden>
                                <small>Question title must be between 3 to 255 characters.</small>
                                <div class="invalid-feedback" id="question_error">Please enter question.</div>

                            </div> --}}
                            
                            <div class="mb-3">
                                <label class="form-label" for="question">Write Your Question<span class="text-danger">*</span></label>
                                <div id="question" placeholder="Instructions"
                                    class="form-control w-100 p-0" style="height: 150px">
                                </div>
                                <input type="hidden" id="questionData" name="questionData">
                                <input type="text" id="question_id" name="question_id" hidden>
                                <div class="invalid-feedback" id="question_error">Please enter question.</div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="assignment_mark">Enter Marks <span class="text-danger">*</span></label>
                                    <input type="number" id="assignment_mark" name="assignment_mark" class="form-control" placeholder="Enter Marks">
                                    <div class="invalid-feedback" id="assignment_mark_error">Please enter marks.</div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="assignment_answer_limit">Enter Answer Word Limit <span class="text-danger">*</span></label>
                                    <input type="number" id="assignment_answer_limit" name="assignment_answer_limit" class="form-control" placeholder="Enter Answer Word Limit">
                                    <div class="invalid-feedback" id="assignment_answer_limit_error">Please enter answer word limit.</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary ms-2 addAssignQuestion" id="editButton">Add Question</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#enable_duration").change(function() {
        if ($(this).is(":checked")) {
            // Show duration fields and enable them
            $("#duration_fields").show();
            $("#exam_duration_hours").prop("disabled", false);
            $("#exam_duration_minutes").prop("disabled", false);
        } else {
            // Hide duration fields and disable them
            $("#duration_fields").hide();
            $("#exam_duration_hours").prop("disabled", true);
            $("#exam_duration_minutes").prop("disabled", true);
        }
    });

    $(document).ready(function () {
        var examDuration = "<?php echo isset($assignmentData[0]['exam_duration']) ? $assignmentData[0]['exam_duration'] : ''; ?>";
        if (examDuration) {
            var timeParts = examDuration.split(':');
            
            var hours = parseInt(timeParts[0], 10);
            var minutes = parseInt(timeParts[1], 10);;

            $("#exam_duration_hours").val(hours);
            $("#exam_duration_minutes").val(minutes);
        }
    });

</script>
@endsection