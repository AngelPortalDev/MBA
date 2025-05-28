<!-- Header import -->
@extends('admin.layouts.main')
@section('content')


<!-- Container fluid -->
<section class="p-4">
    <div class="container">
        <div id="courseForm" class="bs-stepper">
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <!-- Card -->
                    <div class="card mb-4 mt-4">
                        <!-- Card body -->
                        <form class="w-100" method="POST" action="{{route('quiz.edit')}}">
                            @csrf
                            <div class="card-body">
                                <div class="w-100 d-flex justify-content-between">
                                    <h3 class="mb-2"><a href="#" class="text-inherit" style="cursor: default">Edit Quiz</a></h3>
                                    <a href="{{ route('admin.course.quiz') }}" class="btn btn-outline-primary me-2 custum-btn-mobile">Back</a>
                                </div>
                                
                                <!-- quiz -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="w-100">
                                            {{-- <label class="form-label" for="editState">Section</label> --}}
                                            @php 
                                            $section = getData('course_section_masters',['section_name'],['id' => $data[0]['section_id'], 'is_deleted'=>'No']);
                                            // $sectionName = htmlspecialchars_decode($section[0]->section_name);
                                            @endphp
                                            {{-- <input type="text" class="form-control" value="{{ old('section_name', $sectionName) }}" disabled> --}}
                                            <label class="form-label " for="editState">Select Section</label>
                                            <select class="form-select select2" name="quiz_section_id" id="section_id" required="">
                                                {{-- <option selected>Select</option> --}}
                                                @foreach(getDropDownlist('course_section_masters',['section_name','id']) as $stud)
                                                <option value="{{ base64_encode($stud->id)}}" @if($stud->id == $data[0]['section_id']) selected @endif>{{htmlspecialchars_decode($stud->section_name)}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please choose section.</div>


                                            <input type="hidden" name="quiz_id" id="quiz_id" value="{{ base64_encode($data[0]['id']) }}">
                                            {{-- <input type="hidden" name="quiz_section_id" value="{{ isset($data[0]['section_id']) && !empty($data[0]['section_id']) ? base64_encode($data[0]['section_id']) : 0 }}"> --}}
                                        </div>
                                        @if ($errors->has('quiz_section_id'))
                                            @foreach ($errors->get('quiz_section_id') as $error)
                                                <div class="invalid-feedback d-block">{{ $error }}</div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <br>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3 mt-md-0">
                                        <div class="w-100">
                                            <label class="form-label" for="editQuiz">Quiz Title <span class="text-danger">*</span></label>
                                            <input type="text" name="quiz_tittle" id="quiz_tittle" class="form-control" placeholder="Quiz Title" value="{{ old('quiz_tittle', $data[0]['quiz_tittle']) }}">
                                            @if ($errors->has('quiz_tittle'))
                                                @foreach ($errors->get('quiz_tittle') as $error)
                                                    <div class="invalid-feedback d-block">{{ $error }}</div>
                                                @endforeach
                                            @endif
                                            <small>Quiz title must be between 3 to 255 characters. </small>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-header">
                                <div class="row justify-content-between">
                                    <div class="col-md-8">
                                        <h4 class="mb-0">Manage Quizzes</h4>
                                        <p class="mb-0">Edit and Organize Quizzes from the Admin Panel</p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mt-3 text-end">
                                            <a href="#" class="btn btn-primary" id="addQuestionModal">Question <i class="fe fe-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <button class="btn btn-primary" type="submit">Save Now</button>
                            </div>
                        </form>
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
                    @foreach ($data[0]['quiz_question'] as $question)
                        <div class="card mb-4">
                            <!-- card body -->
                            <div class="accordion" id="accordionQuiz">
                                <div class="accordion-item">
                                    <div class="card-body">
                                        <div class="list-group-item rounded text-nowrap" id="development">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0 text-truncate">
                                                    <a type="button" aria-controls="collapseOne">
                                                        <span class="align-middle fs-4 text-wrap-title" style="cursor: default">Ques:
                                                            {{ html_entity_decode($question['question']) }} </span>
                                                    </a>
                                                </h5>
                                                <div>
                                                    <a href="#" class="me-1 text-inherit editquestionquiz"
                                                        data-qestionid={{ base64_encode($question['id']) }}
                                                         data-placement="top" aria-label="Edit"
                                                        data-bs-original-title="Edit">
                                                        <i class="bi bi-pencil edit-icon fs-5" data-bs-toggle="modal"
                                                            data-bs-target="#editQuestion"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                    class="me-1 text-inherit deleteQuizQuestion" data-question_id="{{isset($question['id']) ? base64_encode($question['id']) : 0 }}"  data-bs-placement="top" data-bs-title="Delete"><i class="fe fe-trash-2 fs-5"></i></a>
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
                    {{-- <button type="submit" class="btn btn-primary w-25 float-left m-2" name="submit">Submit
                    </button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</main>



<!-- Add Question Modal -->
<div class="modal fade" id="addQuestionOpen" tabindex="-1" aria-labelledby="addquiz_questionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- modal body -->
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="modal-title" id="addquiz_questionModalLabel">Add Question</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div>
                    <!-- form -->
                    <form class="needs-validation quiz" novalidate>
                        <div class="mb-5">
                            <div class="mb-3">
                                <label class="form-label" for="question">Write Question <span class="text-danger">*</span></label>
                                <input type="text" name="question" id="question" class="form-control" placeholder="Write Question Here" id="" required>
                                <input type="text"  name="quiz_id" value="{{base64_encode($data[0]['id'])}}" required hidden>
                                <div class="invalid-feedback">Please enter your question.</div>
                                <small>Question must be between 3 to 350 characters.</small>

                            </div>

                        </div>
                        <div>
                            <h4 class="mb-3">Answer</h4>
                            <div class="mb-2">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0 fw-normal">Option 1 <span class="text-danger">*</span></h5>
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
                                        <h5 class="mb-0 fw-normal">Option 2 <span class="text-danger">*</span></h5>
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
                                        <h5 class="mb-0 fw-normal">Option 3 <span class="text-danger">*</span></h5>
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
                                        <h5 class="mb-0 fw-normal">Option 4 <span class="text-danger">*</span></h5>
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
                                <button type="button" class="btn btn-primary addQuestion">Add Question</button>
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
               
                    <form class="needs-validation quiz" novalidate>
                        <div class="mb-5">
                            <div class="mb-3">
                                <label class="form-label" for="question">Write Question</label>
                                <input type="text" class="form-control question" placeholder="Write the Question" name="question" required>
                                <input type="hidden" class="form-control quiz_id" name="quiz_id" >
                                <input type="hidden" class="form-control question_id" name="question_id" >
                                <div class="invalid-feedback">Please enter your question.</div>
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
                                <input type="text" placeholder="Write the answer" class="form-control option4" name="option4"  required>
                                <div class="invalid-feedback">Please enter your answer.</div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary addQuestion">Save</button>
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
        $(".errors ").removeClass("d-block");
        
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

$(document).ready(function () {
        $('.select2').select2({
            placeholder: "Select Section",
            width: '100%'
        });
    });

</script>

@endsection