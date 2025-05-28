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
                                        <!-- Assignment -->
                                        <div class="row">
                                            <div class="d-lg-flex justify-content-between align-items-end col-md-8">
                                                    <!-- Assignment img -->
                                                    
                                                    <!-- Assignment content -->
                                                    <div class="w-100 ">
                                                        <h3 class="mb-2"><a href="#" class="text-inherit">Create Assignment</a></h3>
                                                        <form class="w-100 ">
                                                                <label class="form-label" for="editState">Select Award</label>
                                                                <select class="form-select" id="editsection" required="">
                                                                    <option value="">Award in Recruitment and Employee Selection</option>
                                                                    <option value="1">Award in Human Resource Management</option>
                                                                    <option value="2">Award in Human Resource Management</option>
                                                                    <option value="3">Award in Human Resource Management</option>
                                                                </select>
                                                                <div class="invalid-feedback">Please choose Award.</div>
                                                        </form>
                                                    </div>
                                                
                                            </div>
                                            <div class="d-lg-flex justify-content-between align-items-end col-md-4">
                                                <!-- Assignment img -->
                                                
                                                <!-- Assignment content -->
                                                <div class="w-100 ">
                                                    <form class="w-100 ">
                                                            <label class="form-label" for="editState">Assignment Total Percentage (%)</label>
                                                        <input type="text" id="assignment_percentage" name="assignment_percentage" class="form-control" placeholder="Assignment Percentage" required="" value="">

                                                    </form>
                                                </div>
                                
                                            </div>

                                            <div class="d-lg-flex justify-content-between align-items-end col-md-12">
                                                    
                                                    <!-- Assignment content -->
                                                    <div class="w-100 mt-3">
                                                        <form class="w-100 ">
                                                                <label class="form-label" for="editState">Assignment Title</label>
                                                        <input type="text" id="assignment_title" name="Assignment Title" class="form-control" placeholder="Assignment Title" required="" value="">

                                                        </form>
                                                    </div>
                                    
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <label class="form-label">Instructions</label>
                                                <textarea class="form-control" id="instruction-editor" rows="5"> </textarea>
                            
                                            </div>
                                            
                                        </div>

                                        

                                    </div>

                                <div class="card-header ">
                                    <div class="row justify-content-between">
                                        <div class="col-md-8">
                                            <h4 class="mb-0">Choose Order</h4>
                                            <p class="mb-0">Arrange assignment questions with Drag and Drop</p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-3 text-end">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestion">Question <i class="fe fe-plus"></i></a>

                                                {{-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMcq"> MCQ <i class="fe fe-plus"></i></a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
   
                                    <div class="bg-light rounded p-2 mb-4">
      
                                      <div class="list-group list-group-flush border-top-0" id="courseList">
                                          {{-- <div id="courseOne">
                                              
                                              <div class="list-group-item rounded px-3 text-nowrap mb-1" id="development"> --}}
                                                {{-- <div class="d-flex align-items-center justify-content-between"><h5 class="mb-0 text-truncate"><a href="#" class="text-inherit"><span class="align-middle fs-4"> <i class="bi bi-question-circle"></i></span> </a></h5><div><a href="#" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" aria-label="Edit" data-bs-original-title="Edit"><i class="bi bi-pencil edit-icon fs-5" data-bs-toggle="modal" data-bs-target="#editQuestion"></i></a><a href="#" class="me-1 text-inherit" data-bs-toggle="tooltip" data-placement="top" aria-label="Delete" data-bs-original-title="Delete"><i class="fe fe-trash-2 fs-5" data-bs-toggle="modal" data-bs-target="#delete-modal"></i></a></div></div>
       --}}
      
                                              {{-- </div>
      
                                 
                                          </div> --}}
                                      </div>
          
                                  </div>
                                  <a href="#" class="btn btn-primary">Save Now</a>
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
            <div class="modal-dialog ">
                <div class="modal-content">
                    <!-- modal body -->
                    <div class="modal-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="modal-title" id="addQuizQuestionModalLabel">Add Question</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div>
                            <!-- form -->
                            <form class="needs-validation assignment" novalidate>
                                <div class="mb-5">
                                    <div class="mb-3">
                                        <label class="form-label" for="question">Write Your Question</label>
                                        
                                         <input type="text" id="question" class="form-control" placeholder="Write Your Question Here">

                                        {{-- <textarea class="form-control mt-3" id="textarea-input" rows="5"> </textarea> --}}
                           
                                        <div class="invalid-feedback">Please enter your question.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="question">Enter Marks</label>
                                        
                                        <input type="text" id="assignment_mark" class="form-control" placeholder="Enter Marks">

                                        {{-- <textarea class="form-control mt-3" id="textarea-input" rows="5"> </textarea> --}}
                           
                                        <div class="invalid-feedback">Please enter your question.</div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ms-2 addassignment">Add Question</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
 
        <!-- Edit Modal -->
        <div class="modal fade" id="editQuestion" tabindex="-1" aria-labelledby="editQuizQuestionModalLabel" aria-hidden="true">
            <div class="modal-dialog  ">
                <div class="modal-content">
                    <!-- modal body -->
                    <div class="modal-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="modal-title" id="editQuizQuestionModalLabel">Edit Question</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div>
                            <!-- form -->
                            <form class="needs-validation assignment" novalidate>
                                <div class="mb-5">
                                    <div class="mb-3">
                                        <label class="form-label" for="question1">Edit Your Question</label>
                                        
                                        <input type="text" id="question1" class="form-control" placeholder=" ">

                                        {{-- <textarea class="form-control mt-3" id="textarea-input" rows="5"> </textarea> --}}
                           
                                        <div class="invalid-feedback">Please enter your question.</div>
                                    </div>

                                </div>
                                
                            </form>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ms-2 addassignment">Save Now</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        {{-- Delete video  --}}
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
            CKEDITOR.replace('instruction-editor');
        </script>

@endsection
