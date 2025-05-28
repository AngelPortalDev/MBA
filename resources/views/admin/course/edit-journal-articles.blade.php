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
                                        <div class="row">
                                            <div class="d-lg-flex justify-content-between align-items-end col-md-6">
                                                    <!-- quiz img -->
                                                    
                                                    <!-- quiz content -->
                                                    <div class="w-100 ">
                                                        <h3 class="mb-2"><a href="#" class="text-inherit">Edit Journal Article</a></h3>
                                                        <form class="w-100 ">
                                                                <label class="form-label" for="editState">Select Section</label>
                                                                <select class="form-select" id="editsection" required="">
                                                                    <option selected>Select</option>
                                            @foreach(getDropDownlist('course_section_masters',['section_name','id']) as $stud)
                                             <option value="{{ base64_encode($stud->id)}}">{{$stud->section_name}}</option>
                                            @endforeach
                                                                </select>
                                                                <div class="invalid-feedback">Please choose section.</div>



                                                        </form>
                                                    </div>
                                                
                                            </div>


                                            <div class="d-lg-flex justify-content-between align-items-end col-md-6">
                                                    <!-- quiz img -->
                                                    
                                                    <!-- quiz content -->
                                                    <div class="w-100 ">
                                                        <form class="w-100 ">
                                                                <label class="form-label" for="editState">Journal Article Title</label>
                                                                <input type="text" name="journal_title" class="form-control" placeholder="Journal Article Title" required="" value="">

                                                        </form>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>


                                    

                                <div class="card-header ">
                                    <div class="row justify-content-between">
                                        <div class="col-md-8">
                                            <h4 class="mb-0">Upload here</h4>
                                            <p class="mb-0">Add One PDF Document at a Time for Student Study</p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-3 text-end">
                                                {{-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestion">Question <i class="fe fe-plus"></i></a> --}}

                                                {{-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMcq"> MCQ <i class="fe fe-plus"></i></a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
   
                                    <div class=" rounded p-2 mb-2">
      
                                      <div class="list-group list-group-flush border-top-0" id="courseList">
                                          <div id="courseOne">
                                              
                                            <div class="mb-3">
                                                <div class="input-group mb-1">
                                                    <input type="file" class="form-control" id="inputLogo">
                                                    <label class="input-group-text" for="inputLogo">Upload</label>
                                                  </div>
                                                  <small class=""> (PDF Only, Max Size: 5 MB)</small>
                                            </div>

                                          </div>
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


@endsection
