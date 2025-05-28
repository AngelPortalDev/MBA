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
                                <div class="card mb-4">
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <!-- quiz -->
                                        <div class="d-lg-flex justify-content-between align-items-end">
                                            <div class="d-flex align-items-center col-md-7">
                                                <!-- quiz img -->
                                                
                                                <!-- quiz content -->
                                                <div class="w-100 ">
                                                    <h3 class="mb-2"><a href="#" class="text-inherit">Add Assessment</a></h3>
                                                    <form class="w-100 ">
                                                            <label class="form-label" for="editState">Select Award</label>
                                                            <select class="form-select" id="editState" required="">
                                                                <option value="">Award in Recruitment and Employee Selection</option>
                                                                <option value="1">Award in Human Resource Management</option>
                                                                <option value="2">Award in Human Resource Management</option>
                                                                <option value="3">Award in Human Resource Management</option>
                                                            </select>
                                                            <div class="invalid-feedback">Please choose state.</div>

                                                        <div>
                                                            
                                                        </div>


                                                    </form>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-3">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestion">Question <i class="fe fe-plus"></i></a>

                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMcq"> MCQ <i class="fe fe-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- card -->
                                <div class="card mb-4">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <h4 class="mb-3">Que 1: HR Recruitment is mainly used for building ___.</h4>
    
                                        <!-- list group -->
                                        <div class="list-group">
                                            <div class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">Database</label>
                                                </div>
                                            </div>
                                            <!-- list group -->
                                            <div class="list-group-item list-group-item-action bg-light">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                    <label class="form-check-label" for="flexRadioDefault2">Connectivity</label>
                                                </div>
                                            </div>
                                            <!-- list group -->
                                            <div class="list-group-item list-group-item-action">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                                    <label class="form-check-label" for="flexRadioDefault3">User interface</label>
                                                </div>
                                            </div>
                                            <!-- list group -->
                                            <div class="list-group-item list-group-item-action">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                                                    <label class="form-check-label" for="flexRadioDefault4">Design Platform</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- buttons -->
                                        <div class="mt-3">
                                            <a href="#" class="btn btn-outline-secondary">Edit</a>
                                            <a href="#" class="btn btn-outline-danger ms-2">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- card -->
                                <div class="card mb-4">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <h4 class="mb-3">Que 2: The lifecycle methods are mainly used for?</h4>
                                        <!-- list group -->
                                        <textarea class="form-control" id="textarea-input" rows="7"></textarea>
                                        <!-- buttons -->
                                        <div class="mt-3">
                                            <a href="#" class="btn btn-outline-secondary">Edit</a>
                                            <a href="#" class="btn btn-outline-danger ms-2">Delete</a>
                                        </div>
                                    </div>
                                </div>

                                
                                <!-- card -->
                                <div class="card mb-4">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <h4 class="mb-3">Que 3: Is HR Recruitment a programming language?</h4>
                                        <!-- list group -->
                                        <div class="list-group">
                                            <div class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault9">
                                                    <label class="form-check-label" for="flexRadioDefault9">Yes</label>
                                                </div>
                                            </div>
                                            <!-- list group -->
                                            <div class="list-group-item list-group-item-action bg-light">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault10">
                                                    <label class="form-check-label" for="flexRadioDefault10">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- button -->
                                        <div class="mt-3">
                                            <a href="#" class="btn btn-outline-secondary">Edit</a>
                                            <a href="#" class="btn btn-outline-danger ms-2">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</main>

 
        <!-- Question Modal -->
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
                            <form class="needs-validation" novalidate>
                                <div class="mb-5">
                                    <div class="mb-3">
                                        <label class="form-label" for="question">Write Your Question</label>
                                        
                                        <input type="text" id="textInput" class="form-control" placeholder="Write Your Question Here">

                                        <textarea class="form-control mt-3" id="textarea-input" rows="5"> </textarea>
                           
                                        <div class="invalid-feedback">Please enter your question.</div>
                                    </div>

                                </div>
                                
                            </form>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ms-2">Add Question</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- MCQ Modal -->
        <div class="modal fade" id="addMcq" tabindex="-1" aria-labelledby="addQuizQuestionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <!-- modal body -->
                    <div class="modal-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="modal-title" id="addQuizQuestionModalLabel">Add MCQ</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div>
                            <!-- form -->
                            <form class="needs-validation" novalidate>
                                <div class="mb-5">
                                    <div class="mb-3">
                                        <label class="form-label" for="question">Write question</label>
                                        <input type="text" class="form-control" placeholder="Quiz title" id="question" required>
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
                                                        <input class="form-check-input me-0" type="checkbox" role="switch" id="flexSwitchCheckDefault" required>
                                                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="text" placeholder="Write the answer" class="form-control" id="correctAnswer" required>
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
                                                        <input class="form-check-input me-0" type="checkbox" role="switch" id="flexSwitchCheckDefaultTwo">
                                                        <label class="form-check-label" for="flexSwitchCheckDefaultTwo"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="text" placeholder="Write the answer" class="form-control" id="correctAnswer2" required>
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
                                                        <input class="form-check-input me-0" type="checkbox" role="switch" id="flexSwitchCheckDefaultThree">
                                                        <label class="form-check-label" for="flexSwitchCheckDefaultThree"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="text" placeholder="Write the answer" class="form-control" id="correctAnswer3" required>
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
                                                        <input class="form-check-input me-0" type="checkbox" role="switch" id="flexSwitchCheckDefaultFour">
                                                        <label class="form-check-label" for="flexSwitchCheckDefaultFour"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="text" placeholder="Write the answer" class="form-control" id="correctAnswer4" required>
                                        <div class="invalid-feedback">Please enter your answer.</div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary ms-2">Add MCQ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



@endsection
