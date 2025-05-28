@extends('frontend.master')
@section('content')

<section class="pt-5 pb-5">
    <div class="container">
      <!-- User info -->
      <div class="row align-items-center">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
          <!-- Bg -->
          <div class="card px-4 pt-2 pb-4 shadow-sm rounded gap-3">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
              <div class="d-flex align-items-center">

                <div class="lh-1">
                  <h2 class="mb-2 ">
                    <span class="color-blue">Examination:</span> Recruitment and Employee Selection
                  </h2>
                  <p class="mb-0 d-block">Answer the following Multiple Choice and Theoretical Questions</p>
                </div>
              </div>
              <div>

                <div class="countdown pt-3">
                    <h3>Time Left</h3>
                    {{-- <p>Keep track of your time</p> --}}

                      <li class="list-inline-item me-md-5">
                        <span class="hour display-5 fw-bold text-primary">02</span>
                        <p class="fs-5 mb-0">Hours</p>
                      </li>
                      <li class="list-inline-item me-md-5">
                        <span class="minute display-5 fw-bold text-primary">30</span>
                        <p class="fs-5 mb-0">Minutes</p>
                      </li>
                      <li class="list-inline-item me-md-5">
                        <span class="second display-5 fw-bold text-primary">00</span>
                        <p class="fs-5 mb-0">Seconds</p>
                      </li>
                    </ul>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Content -->

      <div class="row mt-0 mt-md-4">
        
        <div class="col-md-12 col-12">
          <div id="courseForm" class="bs-stepper">
            <!-- Stepper Button -->

            <!-- Stepper content -->
            <div class="bs-stepper-content">
              <div role="tablist">

                <div class="step" data-target="#start">
                  <div class="step-trigger visually-hidden" role="tab" id="courseFormtrigger6" aria-controls="start"></div>
                </div>

                <div class="step" data-target="#exam-l-1">
                  <div class="step-trigger visually-hidden" role="tab" id="courseFormtrigger1" aria-controls="exam-l-1"></div>
                </div>



                <div class="step" data-target="#exam-l-2">
                  <button type="button" class="step-trigger visually-hidden" role="tab" id="courseFormtrigger2" aria-controls="exam-l-2"></button>
                </div>

                <div class="step" data-target="#exam-l-3">
                  <button type="button" class="step-trigger visually-hidden" role="tab" id="courseFormtrigger3" aria-controls="exam-l-3"></button>
                </div>

                <div class="step" data-target="#exam-l-4">
                  <button type="button" class="step-trigger visually-hidden" role="tab" id="courseFormtrigger4" aria-controls="exam-l-4"></button>
                </div>
                <div class="step" data-target="#exam-l-5">
                  <button type="button" class="step-trigger visually-hidden" role="tab" id="courseFormtrigger5" aria-controls="exam-l-5"></button>
                </div>
              </div>
              <form onSubmit="return false">

                <!-- Start -->
                <div id="start" role="tabpanel" class="bs-stepper-pane fade">
                  <div class="card mb-4">
                    <!-- Card body -->

                    <div class="card-body p-10">
                      <div class="text-center">
                        <!-- img -->
                        <img src="{{ asset('frontend/images/exam-bg-01.png')}}" alt="survey" class="img-fluid">
                        
                        <!-- text -->
                        <div class="px-lg-8 my-4">
                          <h2 class="h1 color-blue">Welcome to Exam</h2>
                          <p class="mb-0">Welcome to your examination portal! Please read the following instructions carefully before you begin</p>
                                            <!-- Button -->
                            <div class="mt-3 d-flex justify-content-center">
                              <button class="btn btn-primary" onclick="courseForm.next()">
                                Start your Exam
                                <i class="fe fe-arrow-right"></i>
                              </button>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <!-- Content one -->
                <div id="exam-l-1" role="tabpanel" class="bs-stepper-pane fade">
                  <div class="card mb-4">
                    <!-- Card body -->

                    <div class="card-body">

                    <div class="mb-4">
                        <!-- text -->
                        <div class="d-flex justify-content-between">
                            <span>Exam Progress:</span>
                            <span>Page 1 out of 5</span>
                        </div>
                        <!-- progress bar -->
                        <div class="mt-2">
                            <div class="progress" style="height: 6px">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>


                      <!-- text -->
                      <div class="mb-5">
                        <span>Question 1</span>
                        <h4 class="mb-3 mt-1 color-blue">Define 'human capital' and explain its significance in an organization.</h4>
                        <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                      </div>


                      <div class="mb-5">
                        <span>Question 2</span>
                        <h4 class="mb-3 mt-1 color-blue">Which of the following is NOT a function of human resource management?</h4>
                        <!-- list group -->
                        <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault1">Recruitment and selection</label>
                            </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault2">Financial auditing</label>
                            </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault3">Training and development</label>
                            </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault4">Employee relations </label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="mb-5">
                        <span>Question 3</span>
                        <h4 class="mb-3 mt-1 color-blue">What are the key differences between transactional and transformational leadership in the context of HRM?</h4>
                        <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                      </div>

                      <div class="mb-5">
                        <span>Question 4</span>
                        <h4 class="mb-3 mt-1 color-blue">What is the importance of continuous professional development (CPD) for HR professionals?</h4>
                        <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                      </div>


                    </div>
                  </div>
                  <!-- Button -->
                  <div class="mt-3 d-flex justify-content-end">
                    <button class="btn btn-primary" onclick="courseForm.next()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-2">
                      Next
                      <i class="fe fe-arrow-right"></i>
                    </button>
                  </div>
                </div>


                <!-- Content two -->
                <div id="exam-l-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger2">
                 <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">

                        <div class="mb-4">
                            <!-- text -->
                            <div class="d-flex justify-content-between">
                                <span>Exam Progress:</span>
                                <span>Page 2 out of 5</span>
                            </div>
                            <!-- progress bar -->
                            <div class="mt-2">
                                <div class="progress" style="height: 6px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>

                      <!-- text -->
                      <div class="mb-5">
                        <span>Question 5</span>
                        <h4 class="mb-3 mt-1 color-blue">Define 'human capital' and explain its significance in an organization.</h4>
                        <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                      </div>


                      <div class="mb-5">
                        <span>Question 6</span>
                        <h4 class="mb-3 mt-1 color-blue">Which of the following is NOT a function of human resource management?</h4>
                        <!-- list group -->
                        <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault1">Recruitment and selection</label>
                            </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault2">Financial auditing</label>
                            </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault3">Training and development</label>
                            </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault4">Employee relations </label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="mb-5">
                        <span>Question 7</span>
                        <h4 class="mb-3 mt-1 color-blue">What are the key differences between transactional and transformational leadership in the context of HRM?</h4>
                        <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                      </div>

                      <div class="mb-5">
                        <span>Question 8</span>
                        <h4 class="mb-3 mt-1 color-blue">What is the importance of continuous professional development (CPD) for HR professionals?</h4>
                        <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                      </div>


                    </div>
                  </div>
                  <!-- Button -->
                  <div class="d-flex justify-content-between">
                    <button class="btn btn-secondary" onclick="courseForm.previous()">
                      <i class="fe fe-arrow-left"></i>
                      Previous
                    </button>
                    <button class="btn btn-primary" onclick="courseForm.next()">
                      Next
                      <i class="fe fe-arrow-right"></i>
                    </button>
                  </div>
                </div>


                <!-- Content three -->
                <div id="exam-l-3" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger3">
                    <div class="card mb-4">
                        <!-- Card body -->
                        <div class="card-body">
                            
                        
                            <div class="mb-4">
                                <!-- text -->
                                <div class="d-flex justify-content-between">
                                    <span>Exam Progress:</span>
                                    <span>Page 3 out of 5</span>
                                </div>
                                <!-- progress bar -->
                                <div class="mt-2">
                                    <div class="progress" style="height: 6px">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                          <!-- text -->
                          <div class="mb-5">
                            <span>Question 9</span>
                            <h4 class="mb-3 mt-1 color-blue">Define 'human capital' and explain its significance in an organization.</h4>
                            <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                          </div>
    
    
                          <div class="mb-5">
                            <span>Question 10</span>
                            <h4 class="mb-3 mt-1 color-blue">Which of the following is NOT a function of human resource management?</h4>
                            <!-- list group -->
                            <div class="list-group">
                              <div class="list-group-item list-group-item-action" aria-current="true">
                                <!-- form check -->
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
                                  <label class="form-check-label stretched-link" for="flexRadioDefault1">Recruitment and selection</label>
                                </div>
                              </div>
                              <!-- list group -->
                              <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                                  <label class="form-check-label stretched-link" for="flexRadioDefault2">Financial auditing</label>
                                </div>
                              </div>
                              <!-- list group -->
                              <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" />
                                  <label class="form-check-label stretched-link" for="flexRadioDefault3">Training and development</label>
                                </div>
                              </div>
                              <!-- list group -->
                              <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" />
                                  <label class="form-check-label stretched-link" for="flexRadioDefault4">Employee relations </label>
                                </div>
                              </div>
                            </div>
                          </div>
    
                          <div class="mb-5">
                            <span>Question 11</span>
                            <h4 class="mb-3 mt-1 color-blue">What are the key differences between transactional and transformational leadership in the context of HRM?</h4>
                            <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                          </div>
    
                          <div class="mb-5">
                            <span>Question 12</span>
                            <h4 class="mb-3 mt-1 color-blue">What is the importance of continuous professional development (CPD) for HR professionals?</h4>
                            <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                          </div>
    
    
                        </div>
                      </div>
                  <!-- Button -->
                  <div class="d-flex justify-content-between">
                    <button class="btn btn-secondary" onclick="courseForm.previous()">
                      <i class="fe fe-arrow-left"></i>
                      Previous
                    </button>
                    <button class="btn btn-primary" onclick="courseForm.next()">
                      Next
                      <i class="fe fe-arrow-right"></i>
                    </button>
                  </div>
                </div>


                <!-- Content four -->
                <div id="exam-l-4" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger4">
                  <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                            
                        
                        <div class="mb-4">
                            <!-- text -->
                            <div class="d-flex justify-content-between">
                                <span>Exam Progress:</span>
                                <span>Page 4 out of 5</span>
                            </div>
                            <!-- progress bar -->
                            <div class="mt-2">
                                <div class="progress" style="height: 6px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>

                      <!-- text -->
                      <div class="mb-5">
                        <span>Question 13</span>
                        <h4 class="mb-3 mt-1 color-blue">Define 'human capital' and explain its significance in an organization.</h4>
                        <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                      </div>


                      <div class="mb-5">
                        <span>Question 14</span>
                        <h4 class="mb-3 mt-1 color-blue">Which of the following is NOT a function of human resource management?</h4>
                        <!-- list group -->
                        <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault1">Recruitment and selection</label>
                            </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault2">Financial auditing</label>
                            </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault3">Training and development</label>
                            </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault4">Employee relations </label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="mb-5">
                        <span>Question 15</span>
                        <h4 class="mb-3 mt-1 color-blue">What are the key differences between transactional and transformational leadership in the context of HRM?</h4>
                        <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                      </div>

                      <div class="mb-5">
                        <span>Question 16</span>
                        <h4 class="mb-3 mt-1 color-blue">What is the importance of continuous professional development (CPD) for HR professionals?</h4>
                        <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                      </div>


                    </div>
                  </div>
                  <!-- Button -->
                  <div class="d-flex justify-content-between">
                    <button class="btn btn-secondary" onclick="courseForm.previous()">
                      <i class="fe fe-arrow-left"></i>
                      Previous
                    </button>
                    <button class="btn btn-primary" onclick="courseForm.next()">
                      Next
                      <i class="fe fe-arrow-right"></i>
                    </button>
                  </div>
                </div>


                <div id="exam-l-5" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger5">
                  <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                            
                        
                        <div class="mb-4">
                            <!-- text -->
                            <div class="d-flex justify-content-between">
                                <span>Exam Progress:</span>
                                <span>Page 5 out of 5</span>
                            </div>
                            <!-- progress bar -->
                            <div class="mt-2">
                                <div class="progress" style="height: 6px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>

                      <!-- text -->
                      <div class="mb-5">
                        <span>Question 17</span>
                        <h4 class="mb-3 mt-1 color-blue">Define 'human capital' and explain its significance in an organization.</h4>
                        <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                      </div>


                      <div class="mb-5">
                        <span>Question 18</span>
                        <h4 class="mb-3 mt-1 color-blue">Which of the following is NOT a function of human resource management?</h4>
                        <!-- list group -->
                        <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault1">Recruitment and selection</label>
                            </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault2">Financial auditing</label>
                            </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault3">Training and development</label>
                            </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                            <!-- form check -->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" />
                              <label class="form-check-label stretched-link" for="flexRadioDefault4">Employee relations </label>
                            </div>
                          </div>
                        </div>
                      </div>




                    </div>
                  </div>

                  <!-- Button -->
                  <div class="d-flex justify-content-between">
                    <button class="btn btn-secondary" onclick="courseForm.previous()">
                      <i class="fe fe-arrow-left"></i>
                      Previous
                    </button>
                    <button type="submit" class="btn btn-primary" onclick=" location.href='student-quiz-result.html' ">Finish</button>
                  </div>
                </div>


              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>




<!-- Modal -->
<div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              ...
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
          </div>
      </div>
  </div>
</div>







@endsection