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
                            <!-- quiz -->
                            <div class="row">
                                <div class="d-lg-flex justify-content-between align-items-end col-md-6">
                                    <!-- quiz img -->

                                    <!-- quiz content -->
                                    <div class="w-100 ">
                                        <h3 class="mb-2"><a href="#" class="text-inherit">Edit Quiz</a></h3>
                                        <form class="w-100 ">
                                            <input type="hidden" name="qid" id="qid">
                                            <label class="form-label" for="editState">Select Section</label>
                                            <select class="form-select" id="editsection" name="editsection" required="" disabled>
                                                <option value="">Recruitment and Employee Selection</option>
                                                <option value="1">Human Resource Management</option>
                                                <option value="2">Human Resource Management</option>
                                                <option value="3">Human Resource Management</option>
                                            </select>
                                            <div class="invalid-feedback">Please choose Section.</div>

            

                                        </form>
                                    </div>

                                </div>


                                <div class="d-lg-flex justify-content-between align-items-end col-md-6">
                                    <!-- quiz img -->

                                    <!-- quiz content -->
                                    <div class="w-100 ">
                                        <form class="w-100 ">
                                            <label class="form-label" for="editQuiz">Quiz Title</label>
                                            <input type="text" name="quiz_name" id="quiz_name" class="form-control"
                                                placeholder="Quiz Title" required="" value="" disabled>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-header rounded pt-1">
                            <div class="row justify-content-between">
                                <div class="col-md-8">
                                    <h4 class="mb-0">Manage Quizzes</h4>
                                    <p class="mb-0">Edit and Organize Quizzes from the Admin Panel</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-3 text-end">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addQuestion">Question <i class="fe fe-plus"></i></a>

                                        {{-- <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addQuestion"> Question <i class="fe fe-plus"></i></a> --}}
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

                    <!-- card -->
                    <div class="card mb-4">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="list-group-item rounded text-nowrap mb-3" id="development">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0 text-truncate">
                                        <a href="#" class="text-inherit">
                                            <span class="align-middle fs-4"> Que 1: The lifecycle methods are mainly
                                                used for?</span>
                                        </a>
                                    </h5>
                                    <div>

                                        <a href="#" class="me-1 text-inherit" data-bs-toggle="tooltip"
                                            data-placement="top" aria-label="Edit" data-bs-original-title="Edit">
                                            <i class="bi bi-pencil edit-icon fs-5" data-bs-toggle="modal"
                                                data-bs-target="#editQuestion"></i>
                                        </a>

                                        <a href="#" class="me-1 text-inherit" data-bs-toggle="tooltip"
                                            data-placement="top" aria-label="Delete" data-bs-original-title="Delete">
                                            <i class="fe fe-trash-2 fs-5" data-bs-toggle="modal"
                                                data-bs-target="#delete-modal"></i>
                                        </a>
                                    </div>

                                </div>


                            </div>
                            <!-- list group -->
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action" aria-current="true">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">Database</label>
                                    </div>
                                </div>
                                <!-- list group -->
                                <div class="list-group-item list-group-item-action bg-light">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">Connectivity</label>
                                    </div>
                                </div>
                                <!-- list group -->
                                <div class="list-group-item list-group-item-action">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">User interface</label>
                                    </div>
                                </div>
                                <!-- list group -->
                                <div class="list-group-item list-group-item-action">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault4">Design Platform</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- card -->
                    <div class="card mb-4">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="list-group-item rounded text-nowrap mb-3" id="development">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0 text-truncate">
                                        <a href="#" class="text-inherit">
                                            <span class="align-middle fs-4"> Que 2: The lifecycle methods are mainly
                                                used for?</span>
                                        </a>
                                    </h5>
                                    <div>

                                        <a href="#" class="me-1 text-inherit" data-bs-toggle="tooltip"
                                            data-placement="top" aria-label="Edit" data-bs-original-title="Edit">
                                            <i class="bi bi-pencil edit-icon fs-5" data-bs-toggle="modal"
                                                data-bs-target="#editQuestion"></i>
                                        </a>

                                        <a href="#" class="me-1 text-inherit" data-bs-toggle="tooltip"
                                            data-placement="top" aria-label="Delete" data-bs-original-title="Delete">
                                            <i class="fe fe-trash-2 fs-5" data-bs-toggle="modal"
                                                data-bs-target="#delete-modal"></i>
                                        </a>
                                    </div>

                                </div>


                            </div>
                            <!-- list group -->
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action" aria-current="true">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">Database</label>
                                    </div>
                                </div>
                                <!-- list group -->
                                <div class="list-group-item list-group-item-action bg-light">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">Connectivity</label>
                                    </div>
                                </div>
                                <!-- list group -->
                                <div class="list-group-item list-group-item-action">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">User interface</label>
                                    </div>
                                </div>
                                <!-- list group -->
                                <div class="list-group-item list-group-item-action">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault4">Design Platform</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- card -->
                    <div class="card mb-4">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="list-group-item rounded text-nowrap mb-3" id="development">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0 text-truncate">
                                        <a href="#" class="text-inherit">
                                            <span class="align-middle fs-4"> Que 3: The lifecycle methods are mainly
                                                used for?</span>
                                        </a>
                                    </h5>
                                    <div>

                                        <a href="#" class="me-1 text-inherit" data-bs-toggle="tooltip"
                                            data-placement="top" aria-label="Edit" data-bs-original-title="Edit">
                                            <i class="bi bi-pencil edit-icon fs-5" data-bs-toggle="modal"
                                                data-bs-target="#editQuestion"></i>
                                        </a>

                                        <a href="#" class="me-1 text-inherit" data-bs-toggle="tooltip"
                                            data-placement="top" aria-label="Delete" data-bs-original-title="Delete">
                                            <i class="fe fe-trash-2 fs-5" data-bs-toggle="modal"
                                                data-bs-target="#delete-modal"></i>
                                        </a>
                                    </div>

                                </div>


                            </div>
                            <!-- list group -->
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action" aria-current="true">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">Database</label>
                                    </div>
                                </div>
                                <!-- list group -->
                                <div class="list-group-item list-group-item-action bg-light">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">Connectivity</label>
                                    </div>
                                </div>
                                <!-- list group -->
                                <div class="list-group-item list-group-item-action">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">User interface</label>
                                    </div>
                                </div>
                                <!-- list group -->
                                <div class="list-group-item list-group-item-action">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault4">Design Platform</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- card -->
                    <div class="card mb-4">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="list-group-item rounded text-nowrap mb-3" id="development">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0 text-truncate">
                                        <a href="#" class="text-inherit">
                                            <span class="align-middle fs-4"> Que 4: The lifecycle methods are mainly
                                                used for?</span>
                                        </a>
                                    </h5>
                                    <div>

                                        <a href="#" class="me-1 text-inherit" data-bs-toggle="tooltip"
                                            data-placement="top" aria-label="Edit" data-bs-original-title="Edit">
                                            <i class="bi bi-pencil edit-icon fs-5" data-bs-toggle="modal"
                                                data-bs-target="#editQuestion"></i>
                                        </a>

                                        <a href="#" class="me-1 text-inherit" data-bs-toggle="tooltip"
                                            data-placement="top" aria-label="Delete" data-bs-original-title="Delete">
                                            <i class="fe fe-trash-2 fs-5" data-bs-toggle="modal"
                                                data-bs-target="#delete-modal"></i>
                                        </a>
                                    </div>

                                </div>


                            </div>
                            <!-- list group -->
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action" aria-current="true">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">Database</label>
                                    </div>
                                </div>
                                <!-- list group -->
                                <div class="list-group-item list-group-item-action bg-light">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">Connectivity</label>
                                    </div>
                                </div>
                                <!-- list group -->
                                <div class="list-group-item list-group-item-action">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">User interface</label>
                                    </div>
                                </div>
                                <!-- list group -->
                                <div class="list-group-item list-group-item-action">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault4">Design Platform</label>
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



<!-- Add Question Modal -->
<div class="modal fade" id="addQuestion" tabindex="-1" aria-labelledby="addQuizQuestionModalLabel" aria-hidden="true">
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
                    <form class="needs-validation quiz" novalidate>
                        <div class="mb-5">
                            <div class="mb-3">
                                <label class="form-label" for="question">Write Question</label>
                                <input type="text" class="form-control" placeholder="Write Question Here" id="
                                
                                
                                " required>
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
                                                <input class="form-check-input me-0" type="checkbox" role="switch"
                                                    id="flexSwitchCheckDefault" required>
                                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control"
                                    id="correctAnswer" required>
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
                                                <input class="form-check-input me-0" type="checkbox" role="switch"
                                                    id="flexSwitchCheckDefaultTwo">
                                                <label class="form-check-label" for="flexSwitchCheckDefaultTwo"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control"
                                    id="correctAnswer2" required>
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
                                                <input class="form-check-input me-0" type="checkbox" role="switch"
                                                    id="flexSwitchCheckDefaultThree">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefaultThree"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control"
                                    id="correctAnswer3" required>
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
                                                <input class="form-check-input me-0" type="checkbox" role="switch"
                                                    id="flexSwitchCheckDefaultFour">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefaultFour"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control"
                                    id="correctAnswer4" required>
                                <div class="invalid-feedback">Please enter your answer.</div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary addquiz">Add Question</button>
                                <button type="button" class="btn btn-secondary ms-2 " data-bs-dismiss="modal">Close</button>

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
                    <form class="needs-validation" novalidate>
                        <div class="mb-5">
                            <div class="mb-3">
                                <label class="form-label" for="question">Write Question</label>
                                <input type="text" class="form-control" placeholder="Write Question Here" id="question" required>
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
                                                <input class="form-check-input me-0" type="checkbox" role="switch"
                                                    id="flexSwitchCheckDefault" required>
                                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control"
                                    id="correctAnswer" required>
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
                                                <input class="form-check-input me-0" type="checkbox" role="switch"
                                                    id="flexSwitchCheckDefaultTwo">
                                                <label class="form-check-label" for="flexSwitchCheckDefaultTwo"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control"
                                    id="correctAnswer2" required>
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
                                                <input class="form-check-input me-0" type="checkbox" role="switch"
                                                    id="flexSwitchCheckDefaultThree">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefaultThree"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control"
                                    id="correctAnswer3" required>
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
                                                <input class="form-check-input me-0" type="checkbox" role="switch"
                                                    id="flexSwitchCheckDefaultFour">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefaultFour"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" placeholder="Write the answer" class="form-control"
                                    id="correctAnswer4" required>
                                <div class="invalid-feedback">Please enter your answer.</div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary ">Save</button>
                                <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Close</button>

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

@endsection