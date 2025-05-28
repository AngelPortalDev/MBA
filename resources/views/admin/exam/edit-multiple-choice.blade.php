<!-- Header import -->
@extends('admin.layouts.main')
@section('content')


<!-- Container fluid -->
<section class="py-4">
    <div class="container">
        <div id="courseForm" class="bs-stepper">
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <!-- Card -->
                    <div class="card rounded ">
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- Multiple Choice Assessment -->
                            
                            <form class="w-100 mcqData">
                                <div class="row">
                                    <div class="w-100 ">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="mb-2 text-inherit">Edit Multiple Choice Assessment</h3>
                                            
                                            {{-- <button class="btn btn-outline-primary custum-btn-mobile" onclick="goBack()">Back</button> --}}
                                            <a href="{{ route('admin.exam.multiple-choice') }}" class="btn btn-outline-primary custum-btn-mobile">Back</a>

                                        </div>  
                                        
                                        <label class="form-label" for="section">Course <span class="text-danger">*</span></label>
                                        <input type="text" name="multiplechoice_name" id="multiplechoice_name" class="form-control" placeholder="Multiple Choice Assessment Title" required="" value="{{$contentData[0]['award_course']['course_title']}}" disabled>
                                        <input type="text" id="mcq_id" name="mcq_id" value="{{isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0}}" hidden>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-9">
                                        <div class="w-100 ">
                                            <label class="form-label" for="title">Multiple Choice Assessment Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Multiple Choice Assessment Title" required="" value="{{isset($contentData[0]['title']) ? html_entity_decode($contentData[0]['title']) :''}}">
                                            <small>Title must be between 3 to 255 characters.</small>
                                        <div class="invalid-feedback" id="title_error">Please enter multiple choice assessment title</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="w-100 ">
                                            <label class="form-label mt-2 mt-md-0" for="percentage">Total Percentage <span class="text-danger">*</span></label>
                                            <input type="number" name="percentage" id="percentage" class="form-control" placeholder="Total Percentage" required="" value="{{$contentData[0]['percentage']}}">
                                            <div class="invalid-feedback" id="percentage_error">Please enter assessment total percentage</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Enable Duration -->
                                <div class="col-md-12 col-sm-12 col-lg-6 mt-4">
                                    <label>
                                        <input type="checkbox" id="enable_duration" 
                                            {{ $contentData[0]['exam_duration'] != '' ? 'checked' : '' }}>
                                        Enable Duration
                                    </label>
                                </div>                                 

                                <div class="col-md-12 col-sm-12 col-lg-6 mt-4" id="duration_fields" style="{{ $contentData[0]['exam_duration'] != '' ? '' : 'display:none;' }}; margin-top: 10px;">
                                    <div class="w-100 w-md-50 w-sm-50 mt-2 mt-lg-0">
                                        <label class="form-label" for="exam_duration">Exam Duration</label>
                                        
                                        <div class="">
                                            <!-- Hours Dropdown -->
                                            <select id="exam_duration_hours" name="exam_duration_hours" class="form-control me-2" {{ $contentData[0]['exam_duration'] != '' ? '' : 'disabled' }}>
                                                <option value="">Hours</option>
                                                @for ($i = 0; $i <= 6; $i++)
                                                    <option value="{{ $i }}">
                                                        {{ $i }} hour{{ $i != 1 ? 's' : '' }}
                                                    </option>
                                                @endfor
                                            </select>
                                            <div class="invalid-feedback" id="exam_duration_hours_error" style="{{ $contentData[0]['exam_duration'] != '' ? 'display:none;' : '' }}">Please select hours.</div>
                                            
                                            <!-- Minutes Dropdown -->
                                            <select id="exam_duration_minutes" name="exam_duration_minutes" class="form-control mt-2" {{ $contentData[0]['exam_duration'] != '' ? '' : 'disabled' }}>
                                                <option value="">Minutes</option>
                                                <option value="0">0 minutes</option>
                                                <option value="5">05 minutes</option>
                                                <option value="15">15 minutes</option>
                                                <option value="30">30 minutes</option>
                                                <option value="45">45 minutes</option>
                                            </select>
                                            <div class="invalid-feedback" id="exam_duration_minutes_error" style="{{ $contentData[0]['exam_duration'] != '' ? 'display:none;' : '' }}">Please select minutes.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <button type="button"
                                        class="btn btn-primary mt-3 updateMcq">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div class="card-header rounded ">
                            <div class="row justify-content-between">
                                <div class="col-md-8">
                                    <h4 class="mb-0">Manage Multiple Choice Assessment</h4>
                                    <p class="mb-0">Edit and Organize Multiple Choice Assessment from the Admin Panel</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-3 text-end">
                                        <a href="#" class="btn btn-primary" id="addQuestionModal">Question <i class="fe fe-plus"></i></a>
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

<!-- Container fluid -->
<section>
    <div class="container">
        <div id="courseForm" class="bs-stepper">
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    @foreach ($contentData[0]['mcq_question'] as $question)
                        <div class="card mb-4">
                            <!-- card body -->
                            <div class="accordion" id="accordionQuiz">
                                <div class="accordion-item">
                                    <div class="card-body">
                                        <div class="list-group-item rounded text-nowrap" id="development">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0 text-truncate">
                                                    <a type="button" aria-controls="collapseOne">
                                                        <span class="align-middle fs-4 text-wrap-title questiontitle assignmnetquestiontitle d-flex" style="width: inherit"> <i class="bi bi-question-circle me-2"></i>  {{ isset($question['question']) ? html_entity_decode($question['question']) : '' }}</span>
                                                        {{-- <span class="align-middle fs-4 text-wrap-title"><span class="fw-bold">Ques:</span>
                                                            <span class="fw-bold">{{ html_entity_decode($question['question']) }} </span> </span> --}}
                                                    </a>
                                                </h5>
                                                <div>
                                                    <a href="#" class="me-1 text-inherit editMcqQuestion"
                                                        data-qestionid={{ base64_encode($question['id']) }}
                                                        data-bs-toggle="tooltip" data-placement="top" aria-label="Edit"
                                                        data-bs-original-title="Edit">
                                                        <i class="bi bi-pencil edit-icon fs-5" data-bs-toggle="modal"
                                                            data-bs-target="#editQuestion"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                    class="me-1 text-inherit deleteMcqQuestion" data-question_id="{{isset($question['id']) ? base64_encode($question['id']) : 0 }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="fe fe-trash-2 fs-5"></i></a>
                                                    <!-- Accordion Icon -->
                                                    {{-- <a href="#" class="me-3 text-inherit" id="accordion-toggle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View">
                                                        <i id="accordion-icon" class="bi bi-eye"></i>
                                                    </a> --}}

                                                </div>
                                            </div>
                                        </div>
                                        <!-- list group -->
                                        <div id="collapseOne" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionQuiz">
                                            <div class="accordion-body">
                                                <div class="list-group">
                                                    <div class="list-group-item list-group-item-action"
                                                        aria-current="true">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="flexcheckboxDefault" id="flexcheckboxDefault1">
                                                            <label class="form-check-label"
                                                                for="flexcheckboxDefault1">{{ $question['option1'] }}</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action bg-light">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="flexcheckboxDefault" id="flexcheckboxDefault2">
                                                            <label class="form-check-label"
                                                                for="flexcheckboxDefault2">{{ $question['option2'] }}</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="flexcheckboxDefault" id="flexcheckboxDefault3">
                                                            <label class="form-check-label"
                                                                for="flexcheckboxDefault3">{{ $question['option3'] }}</label>
                                                        </div>
                                                    </div>
                                                    <!-- list group -->
                                                    <div class="list-group-item list-group-item-action">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="flexcheckboxDefault" id="flexcheckboxDefault4">
                                                            <label class="form-check-label"
                                                                for="flexcheckboxDefault4">{{ $question['option4'] }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</main>


<!-- Add Question Modal -->
<div class="modal fade" id="addQuestionOpen" tabindex="-1" aria-labelledby="addQuizQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- modal body -->
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="modal-title" id="addQuizQuestionModalLabel">Add Question</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div>
                    <!-- form -->
                    <form class="needs-validation mcq" novalidate>
                        <div class="mb-5">
                            <div class="mb-3">
                                <label class="form-label" for="question">Write Question <span class="text-danger">*</span></label>
                                <input type="text" name="question" id="question" class="form-control" placeholder="Write Question Here" id="" required>
                                <input type="text"  name="mcq_id" value="{{base64_encode($contentData[0]['id'])}}" required hidden>
                                <div class="invalid-feedback">Please enter your question.</div>
                            </div>
                            <div class="mb-3" style="width: fit-content">
                                <label class="form-label" for="mark">Enter Marks <span class="text-danger">*</span></label>
                                <input type="number" name="mark" id="mark" class="form-control" placeholder="Write marks here" id="" required>
                                <div class="invalid-feedback">Please enter your marks.</div>
                            </div>
                        </div>
                        <div>
                            <h4 class="mb-3">Answer</h4>
                            <div class="mb-2">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0 fw-normal">Option 1</h5>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center lh-1">
                                            <span>Correct answer</span>
                                            <div class="form-check form-switch ms-2">
                                                <input class="form-check-input" type="radio" name="answer"
                                                id="answer" value="1">
                                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control"
                                    id="option1" name="option1" required>
                                <div class="invalid-feedback">Please enter your answer.</div>
                            </div>
                            <div class="mb-2">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0 fw-normal">Option 2</h5>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center lh-1">
                                            <span>Correct answer</span>
                                            <div class="form-check form-switch ms-2">
                                                <input class="form-check-input" type="radio" name="answer"
                                                id="answer" value="2">
                                                <label class="form-check-label" for="flexSwitchCheckDefaultTwo"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control"
                                id="option2" name="option2" required>
                                <div class="invalid-feedback">Please enter your answer.</div>
                            </div>
                            <div class="mb-2">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0 fw-normal">Option 3</h5>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center lh-1">
                                            <span>Correct answer</span>
                                            <div class="form-check form-switch ms-2">
                                                <input class="form-check-input" type="radio" name="answer"
                                                id="answer" value="3">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefaultThree"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control"
                                id="option3" name="option3" required>
                                <div class="invalid-feedback">Please enter your answer.</div>
                            </div>
                            <div class="mb-2">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0 fw-normal">Option 4</h5>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center lh-1">
                                            <span>Correct answer</span>
                                            <div class="form-check form-switch ms-2">
                                                <input class="form-check-input" type="radio" name="answer"
                                                id="answer" value="4">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefaultFour"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control"
                                id="option4" name="option4" required>
                                <div class="invalid-feedback">Please enter your answer.</div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary addMcqQuestion"  data-modal="add">Add Question</button>
                                <button type="button" class="btn btn-secondary  ms-2 " data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Question Modal -->
<div class="modal fade" id="editQuestion" tabindex="-1" aria-labelledby="editQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- modal body -->
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="modal-title" id="editQuestionModalLabel">Edit Question</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div>
                    <!-- form -->
               
                    <form class="needs-validation mcq" novalidate>
                        <div class="mb-5">
                            <div class="mb-3">
                                <label class="form-label" for="question">Write Question <span class="text-danger">*</span></label>
                                <input type="text" class="form-control question" placeholder="Write the Question" name="question" required>
                                <input type="hidden" class="form-control mcq_id" name="mcq_id" >
                                <input type="hidden" class="form-control question_id" name="question_id" >
                                <div class="invalid-feedback">Please enter your question.</div>
                            </div>
                            <div class="mb-3" style="width: fit-content">
                                <label class="form-label" for="mark">Enter Marks <span class="text-danger">*</span></label>
                                <input type="number" name="mark" id="mark" class="form-control mark" placeholder="Write marks here" id="" required>
                                <div class="invalid-feedback">Please enter your marks.</div>
                            </div>
                        </div>
                        <div>
                            <h4 class="mb-3">Answer</h4>
                            <div class="mb-2">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0 fw-normal">Option 1</h5>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center lh-1">
                                            <span>Correct answer</span>
                                            <div class="form-check form-switch ms-2">
                                                <input class="form-check-input answer1" type="radio" name="answer"
                                             value="1">
                                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control option1"
                                  name="option1" required>
                                <div class="invalid-feedback">Please enter your answer.</div>
                            </div>
                            <div class="mb-2">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0 fw-normal">Option 2</h5>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center lh-1">
                                            <span>Correct answer</span>
                                            <div class="form-check form-switch ms-2">
                                                <input class="form-check-input answer2" type="radio"name="answer"
                                                value="2">
                                                <label class="form-check-label" for="flexSwitchCheckDefaultTwo"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control option2"
                                 name="option2"  required>
                                <div class="invalid-feedback">Please enter your answer.</div>
                            </div>
                            <div class="mb-2">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0 fw-normal">Option 3</h5>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center lh-1">
                                            <span>Correct answer</span>
                                            <div class="form-check form-switch ms-2">
                                                <input class="form-check-input answer3" type="radio" name="answer"
                                               value="3">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefaultThree"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control option3"
                                 name="option3"  required>
                                <div class="invalid-feedback">Please enter your answer.</div>
                            </div>
                            <div class="mb-2">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0 fw-normal">Option 4</h5>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center lh-1">
                                            <span>Correct answer</span>
                                            <div class="form-check form-switch ms-2">
                                                <input class="form-check-input answer4" type="radio" name="answer"
                                                value="4">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefaultFour"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control option4" name="option4">
                                <div class="invalid-feedback">Please enter your answer.</div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary addMcqQuestion" data-modal="edit">Save</button>
                                <button type="button" class="btn btn-secondary  ms-2" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </form>
                 
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Delete Question  --}}
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                Are you really want to delete Question?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>

    
 
    document.addEventListener('DOMContentLoaded', function() {
 
        $("#addQuestionModal").on('click', function (e) {
            e.preventDefault();
            $("#question").val("");
            $("#option1").val("");
            $("#option2").val("");
            $("#option3").val("");
            $("#option4").val("");
            $('#answer').prop('checked', false);
            $("#addQuestionOpen").modal('show');
        });
        var accordionElement = document.getElementById('collapseOne');
        var accordionIcon = document.getElementById('accordion-icon');
        var accordionToggle = document.getElementById('accordion-toggle');
    
        var collapseInstance = new bootstrap.Collapse(accordionElement, {
            toggle: false
        });
    
        accordionElement.addEventListener('show.bs.collapse', function() {
            accordionIcon.classList.remove('bi-eye'); 
            accordionIcon.classList.add('bi-eye-slash'); 
        });
    
        accordionElement.addEventListener('hide.bs.collapse', function() {
            accordionIcon.classList.remove('bi-eye-slash'); 
            accordionIcon.classList.add('bi-eye'); 
        });
    
        accordionToggle.addEventListener('click', function(event) {
            event.preventDefault(); 
            if (accordionElement.classList.contains('show')) {
                collapseInstance.hide();
            } else {
                collapseInstance.show();
            }
        });
    });

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
        var examDuration = "<?php echo isset($contentData[0]['exam_duration']) ? $contentData[0]['exam_duration'] : ''; ?>";
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