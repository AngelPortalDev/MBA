@extends('frontend.master')
@section('content')

<section class="pt-5 pb-5">
    <div class="container">


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
                  <div class="card mb-4">
                    <!-- Card body -->

                    <div class="card-body p-10">
                      <div class="text-center">
                        <!-- img -->
                        <img src="{{ asset('frontend/images/english-test-01.png')}}" alt="survey" class="img-fluid">
                        
                        <!-- text -->
                        <div class="px-lg-8 my-4">
                          <p class="mb-0 lead text-black">Welcome to the </p>
                          <h2 class="h1 color-blue">English Language Proficiency Test!</h2>
                          <p class="mb-0">This test is designed to assess your skills in English. Please read the following instructions carefully before starting the test.</p>
                                            <!-- Button -->
                            <div class="mt-3 d-flex justify-content-center">
                              <button class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">
                                Start Exam
                                <i class="fe fe-arrow-right"></i>
                              </button>
                            </div>
                        </div>
                      </div>
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



{{-- Modal --}}
<!-- toggle between modal -->
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">English Language Proficiency Test!</h5>
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        
      </div>
      <div class="mt-3 px-4">
        <!-- text -->
        <div class="d-flex justify-content-between">
          <span>Test Progress:</span>
          <span>Page 1 out of 4</span>
        </div>
        <!-- progress bar -->
        <div class="mt-2">
          <div class="progress" style="height: 6px">
            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>

      <div class="modal-body">
        <div class="row mt-0">
         
          <div class="col-lg-12 col-md-12 col-12">

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">1. Lisa ______ is buying a pet, but she's not sure what kind to get. <span class="color-blue">(1 Point)</span></h4>

                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault11">
                                  <label class="form-check-label" for="flexRadioDefault11">recalling</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault12">
                                  <label class="form-check-label" for="flexRadioDefault12">regretting</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault13">
                                  <label class="form-check-label" for="flexRadioDefault13">considering</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault14">
                                  <label class="form-check-label" for="flexRadioDefault14">counting</label>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">2. In the 1960s, computers were ______ expensive that ordinary people couldn't afford them. <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault25" >
                                  <label class="form-check-label" for="flexRadioDefault25">so</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault26">
                                  <label class="form-check-label" for="flexRadioDefault26">such</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault27">
                                  <label class="form-check-label" for="flexRadioDefault27">too</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault28">
                                  <label class="form-check-label" for="flexRadioDefault28">if</label>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">3. It's best not to talk to my father in the early morning. He's usually ______ until he's had his first cup of coffee. <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault3" id="flexRadioDefault35" >
                                  <label class="form-check-label" for="flexRadioDefault35">grumpy</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault3" id="flexRadioDefault36">
                                  <label class="form-check-label" for="flexRadioDefault36">lousy</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault3" id="flexRadioDefault37">
                                  <label class="form-check-label" for="flexRadioDefault37">painful</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault3" id="flexRadioDefault38">
                                  <label class="form-check-label" for="flexRadioDefault38">charismatic</label>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">4. "Are you ready to order?" "Not yet - I'm still looking at the ______." <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault4" id="flexRadioDefault45" >
                                  <label class="form-check-label" for="flexRadioDefault45">bill</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault4" id="flexRadioDefault46">
                                  <label class="form-check-label" for="flexRadioDefault46">menu</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault4" id="flexRadioDefault47">
                                  <label class="form-check-label" for="flexRadioDefault47">service</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault4" id="flexRadioDefault48">
                                  <label class="form-check-label" for="flexRadioDefault48">cheque</label>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">5. Lisa wanted to talk to a cute guy on the train but she didn't have the ______ to start a conversation. <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault5" id="flexRadioDefault55" >
                                  <label class="form-check-label" for="flexRadioDefault55">form</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault5" id="flexRadioDefault56">
                                  <label class="form-check-label" for="flexRadioDefault56">proof</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault5" id="flexRadioDefault57">
                                  <label class="form-check-label" for="flexRadioDefault57">courage</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault5" id="flexRadioDefault58">
                                  <label class="form-check-label" for="flexRadioDefault58">tolerance</label>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">6. The global financial crisis, ______ is forcing lots of small businesses to close, does not look set to end soon. <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault6" id="flexRadioDefault65" >
                                  <label class="form-check-label" for="flexRadioDefault65">it</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault6" id="flexRadioDefault66">
                                  <label class="form-check-label" for="flexRadioDefault66">that</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault6" id="flexRadioDefault67">
                                  <label class="form-check-label" for="flexRadioDefault67">which</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault6" id="flexRadioDefault68">
                                  <label class="form-check-label" for="flexRadioDefault68">the which</label>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">7. The clothing store H&M has recently a new campaign targeting teenage girls. <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault7" id="flexRadioDefault75" >
                                  <label class="form-check-label" for="flexRadioDefault75">gathered</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault7" id="flexRadioDefault76">
                                  <label class="form-check-label" for="flexRadioDefault76">launched</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault7" id="flexRadioDefault77">
                                  <label class="form-check-label" for="flexRadioDefault77">wrapped</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault7" id="flexRadioDefault78">
                                  <label class="form-check-label" for="flexRadioDefault78">injected</label>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">8. I went to a lovely ______ last Saturday. The bride was my best friend when we were at school. <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault87" id="flexRadioDefault875" >
                                  <label class="form-check-label" for="flexRadioDefault875">anniversary</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault87" id="flexRadioDefault876">
                                  <label class="form-check-label" for="flexRadioDefault876">marriage</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault87" id="flexRadioDefault877">
                                  <label class="form-check-label" for="flexRadioDefault877">wedding</label>
                              </div>
                          </div>

                      </div>

                  </div>
              </div>


          </div>
      </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Save & Next</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">English Language Proficiency Test! </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="mt-3 px-4">
        <!-- text -->
        <div class="d-flex justify-content-between">
          <span>Test Progress:</span>
          <span>Page 2 out of 4</span>
        </div>
        <!-- progress bar -->
        <div class="mt-2">
          <div class="progress" style="height: 6px">
            <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="row mt-0">
         
          <div class="col-lg-12 col-md-12 col-12">

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">9. The Christmas window ______ was very imaginative. <span class="color-blue">(1 Point)</span></h4>

                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault291" id="flexRadioDefault91">
                                  <label class="form-check-label" for="flexRadioDefault91">exhibition</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault291" id="flexRadioDefault92">
                                  <label class="form-check-label" for="flexRadioDefault92">display</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault291" id="flexRadioDefault93">
                                  <label class="form-check-label" for="flexRadioDefault93">collection</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault291" id="flexRadioDefault94">
                                  <label class="form-check-label" for="flexRadioDefault94">vision</label>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">10. Jamal has just sent me ______ to arrange plans for this weekend. <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check"10>
                                  <input class="form-check-input" type="radio" name="flexRadioDefault102" id="flexRadioDefault105" >
                                  <label class="form-check-label" for="flexRadioDefault105">a blog</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault102" id="flexRadioDefault106">
                                  <label class="form-check-label" for="flexRadioDefault106">a text</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault102" id="flexRadioDefault107">
                                  <label class="form-check-label" for="flexRadioDefault107">a website</label>
                              </div>
                          </div>

                      </div>

                  </div>
              </div>

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">11. Criminals are people who are guilty of the law. <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault113" id="12" >
                                  <label class="form-check-label" for="flexRadioDefault115">breaking</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault113" id="flexRadioDefault116">
                                  <label class="form-check-label" for="flexRadioDefault116">cheating</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault113" id="flexRadioDefault117">
                                  <label class="form-check-label" for="flexRadioDefault117">committing</label>
                              </div>
                          </div>

                      </div>

                  </div>
              </div>

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">12. "I can't hear you - it's ______ noisy in here!" <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault12" id="flexRadioDefault125" >
                                  <label class="form-check-label" for="flexRadioDefault125">too</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault12" id="flexRadioDefault126">
                                  <label class="form-check-label" for="flexRadioDefault126">too much</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault12" id="flexRadioDefault127">
                                  <label class="form-check-label" for="flexRadioDefault127">too many</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault12" id="flexRadioDefault128">
                                  <label class="form-check-label" for="flexRadioDefault128">so much</label>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">13. You may not like the cold weather here, but you'll have to ______ it, I'm afraid. <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault135" id="flexRadioDefault1325" >
                                  <label class="form-check-label" for="flexRadioDefault1325">tell it off</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault135" id="flexRadioDefault136">
                                  <label class="form-check-label" for="flexRadioDefault136">sort itself out</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault135" id="flexRadioDefault137">
                                  <label class="form-check-label" for="flexRadioDefault137">put up with</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault135" id="flexRadioDefault138">
                                  <label class="form-check-label" for="flexRadioDefault138">pit it against</label>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">14. There milk in the fridge. <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault146" id="flexRadioDefault1465" >
                                  <label class="form-check-label" for="flexRadioDefault1465">some</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault146" id="flexRadioDefault1466">
                                  <label class="form-check-label" for="flexRadioDefault1466">are some</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault146" id="flexRadioDefault1467">
                                  <label class="form-check-label" for="flexRadioDefault1467">is some</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault146" id="flexRadioDefault1468">
                                  <label class="form-check-label" for="flexRadioDefault1468">is any</label>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">15. "Do you ______ if I open the window?" <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault157" id="flexRadioDefault1575" >
                                  <label class="form-check-label" for="flexRadioDefault1575">matter</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault157" id="flexRadioDefault1576">
                                  <label class="form-check-label" for="flexRadioDefault1576">mind</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault157" id="flexRadioDefault1577">
                                  <label class="form-check-label" for="flexRadioDefault1577">think</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault7" id="flexRadioDefault1578">
                                  <label class="form-check-label" for="flexRadioDefault1578">wish</label>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <!-- card -->
              <div class="card mb-4">
                  <!-- card body -->
                  <div class="card-body">
                      <h4 class="mb-3">16. Daniel's hair is getting far too long; he really should ______ soon. <span class="color-blue">(1 Point)</span></h4>
                      <!-- list group -->
                      <div class="list-group">
                          <div class="list-group-item list-group-item-action" aria-current="true">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault167" id="flexRadioDefault1675" >
                                  <label class="form-check-label" for="flexRadioDefault1675">cut it</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault167" id="flexRadioDefault1676">
                                  <label class="form-check-label" for="flexRadioDefault1676">have it cut</label>
                              </div>
                          </div>
                          <!-- list group -->
                          <div class="list-group-item list-group-item-action">
                              <!-- form check -->
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="flexRadioDefault167" id="flexRadioDefault1677">
                                  <label class="form-check-label" for="flexRadioDefault1677">have cut it</label>
                              </div>
                          </div>

                      </div>

                  </div>
              </div>


          </div>
      </div>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" data-bs-dismiss="modal">Save & Next</button>
      </div>
    </div>
  </div>
</div>


  <div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel3">English Language Proficiency Test! </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="mt-3 px-4">
          <!-- text -->
          <div class="d-flex justify-content-between">
            <span>Test Progress:</span>
            <span>Page 3 out of 4</span>
          </div>
          <!-- progress bar -->
          <div class="mt-2">
            <div class="progress" style="height: 6px">
              <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
        <div class="modal-body">
          <div class="row mt-0">
           
            <div class="col-lg-12 col-md-12 col-12">
  
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">17. "Can you ______ a favour?" <span class="color-blue">(1 Point)</span></h4>
  
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault17291" id="flexRadioDefault1791">
                                    <label class="form-check-label" for="flexRadioDefault91">make</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault17291" id="flexRadioDefault1792">
                                    <label class="form-check-label" for="flexRadioDefault1792">make me</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault17291" id="flexRadioDefault1793">
                                    <label class="form-check-label" for="flexRadioDefault1793">do</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault17291" id="flexRadioDefault1794">
                                    <label class="form-check-label" for="flexRadioDefault1794">do me</label>
                                </div>
                            </div>
                        </div>
  
                    </div>
                </div>
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">18. "I wish I ______ have an exam tomorrow!" <span class="color-blue">(1 Point)</span></h4>
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <!-- form check -->
                                <div class="form-check"10>
                                    <input class="form-check-input" type="radio" name="flexRadioDefault18102" id="flexRadioDefault18105">
                                    <label class="form-check-label" for="flexRadioDefault18105">don't</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault18102" id="flexRadioDefault18106">
                                    <label class="form-check-label" for="flexRadioDefault18106">didn't</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault18102" id="flexRadioDefault18107">
                                    <label class="form-check-label" for="flexRadioDefault18107">won't</label>
                                </div>
                            </div>
  
                        </div>
  
                    </div>
                </div>
  
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">19. "How about going to the Black Slipper nightclub?" <br>
                          "There's no ______ I'm going there. It's awful!" <span class="color-blue">(1 Point)</span></h4>
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault19113" id="flexRadioDefault19115" >
                                    <label class="form-check-label" for="flexRadioDefault19115">breaking</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault19113" id="flexRadioDefault19116">
                                    <label class="form-check-label" for="flexRadioDefault19116">cheating</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault19113" id="flexRadioDefault19117">
                                    <label class="form-check-label" for="flexRadioDefault19117">committing</label>
                                </div>
                            </div>
  
                        </div>
  
                    </div>
                </div>
  
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">20. "It's pouring down and it's freezing." What are the weather conditions? <span class="color-blue">(1 Point)</span></h4>
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2012" id="flexRadioDefault20125" >
                                    <label class="form-check-label" for="flexRadioDefault20125">high winds and snow</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2012" id="flexRadioDefault20126">
                                    <label class="form-check-label" for="flexRadioDefault20126">heavy rain and cold temperatures</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2012" id="flexRadioDefault20127">
                                    <label class="form-check-label" for="flexRadioDefault20127">thick cloud and quite warm</label>
                                </div>
                            </div>

                        </div>
  
                    </div>
                </div>
  
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">21. I was about to go to sleep when it ______ to me where the missing keys might be. <span class="color-blue">(1 Point)</span></h4>
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault21135" id="flexRadioDefault211325" >
                                    <label class="form-check-label" for="flexRadioDefault211325">remembered</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault21135" id="flexRadioDefault21136">
                                    <label class="form-check-label" for="flexRadioDefault21136">happened</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault21135" id="flexRadioDefault21137">
                                    <label class="form-check-label" for="flexRadioDefault21137">appeared</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault21135" id="flexRadioDefault21138">
                                    <label class="form-check-label" for="flexRadioDefault21138">occurred</label>
                                </div>
                            </div>
                        </div>
  
                    </div>
                </div>
  
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">22. My cousin ______ getting a job in Bahrain. <span class="color-blue">(1 Point)</span></h4>
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault22146" id="flexRadioDefault221465" >
                                    <label class="form-check-label" for="flexRadioDefault221465">would like</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault22146" id="flexRadioDefault221466">
                                    <label class="form-check-label" for="flexRadioDefault221466">is planning</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault22146" id="flexRadioDefault221467">
                                    <label class="form-check-label" for="flexRadioDefault221467">is thinking of</label>
                                </div>
                            </div>

                        </div>
  
                    </div>
                </div>
  
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">23. My mother's Italian, so the language has been quite easy for me. <span class="color-blue">(1 Point)</span></h4>
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault23157" id="flexRadioDefault231575" >
                                    <label class="form-check-label" for="flexRadioDefault231575">to learn</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault23157" id="flexRadioDefault231576">
                                    <label class="form-check-label" for="flexRadioDefault231576">learn</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault23157" id="flexRadioDefault231577">
                                    <label class="form-check-label" for="flexRadioDefault231577">having learnt </label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault23157" id="flexRadioDefault231578">
                                    <label class="form-check-label" for="flexRadioDefault231578">learning</label>
                                </div>
                            </div>
                        </div>
  
                    </div>
                </div>
  
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">24. I usually ______ swimming at least once a week. <span class="color-blue">(1 Point)</span></h4>
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault247" id="flexRadioDefault2475" >
                                    <label class="form-check-label" for="flexRadioDefault2475">go</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault247" id="flexRadioDefault2476">
                                    <label class="form-check-label" for="flexRadioDefault2476">do</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault247" id="flexRadioDefault2477">
                                    <label class="form-check-label" for="flexRadioDefault2477">play</label>
                                </div>
                            </div>
  
                        </div>
  
                    </div>
                </div>
  
  
            </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
          <button class="btn btn-primary" data-bs-target="#exampleModalToggle4" data-bs-toggle="modal" data-bs-dismiss="modal">Save & Next</button>
        </div>
      </div>
    </div>
  </div>
  </div>


  <div class="modal fade" id="exampleModalToggle4" aria-hidden="true" aria-labelledby="exampleModalToggleLabel4" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">English Language Proficiency Test! </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="mt-3 px-4">
          <!-- text -->
          <div class="d-flex justify-content-between">
            <span>Test Progress:</span>
            <span>Page 4 out of 4</span>
          </div>
          <!-- progress bar -->
          <div class="mt-2">
            <div class="progress" style="height: 6px">
              <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
        <div class="modal-body">
          <div class="row mt-0">
           
            <div class="col-lg-12 col-md-12 col-12">
  
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">25. Ocean currents ______ play an important part in regulating global climate. <span class="color-blue">(1 Point)</span></h4>
  
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault25291" id="flexRadioDefault2591">
                                    <label class="form-check-label" for="flexRadioDefault2591">are known to</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault25291" id="flexRadioDefault2592">
                                    <label class="form-check-label" for="flexRadioDefault2592">thought to</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault25291" id="flexRadioDefault2593">
                                    <label class="form-check-label" for="flexRadioDefault2593">are believed that they</label>
                                </div>
                            </div>

                            
                        </div>
  
                    </div>
                </div>
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">26. Jamal has just sent me ______ to arrange plans for this weekend. <span class="color-blue">(1 Point)</span></h4>
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <!-- form check -->
                                <div class="form-check"10>
                                    <input class="form-check-input" type="radio" name="flexRadioDefault26102" id="flexRadioDefault26105" >
                                    <label class="form-check-label" for="flexRadioDefault26105">finish</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault26102" id="flexRadioDefault26106">
                                    <label class="form-check-label" for="flexRadioDefault26106">are finishing</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault26102" id="flexRadioDefault26107">
                                    <label class="form-check-label" for="flexRadioDefault26107">will have finished</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault26102" id="flexRadioDefault26108">
                                    <label class="form-check-label" for="flexRadioDefault26108">are finished</label>
                                </div>
                            </div>
  
                        </div>
  
                    </div>
                </div>
  
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">27. I'm 18 and my sister is 20, so she's ______ me. <span class="color-blue">(1 Point)</span></h4>
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault27113" id="12" >
                                    <label class="form-check-label" for="flexRadioDefault27115">he oldest of</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault27113" id="flexRadioDefault27116">
                                    <label class="form-check-label" for="flexRadioDefault27116">older than</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault27113" id="flexRadioDefault27117">
                                    <label class="form-check-label" for="flexRadioDefault27117">as old as</label>
                                </div>
                            </div>
  
                        </div>
  
                    </div>
                </div>
  
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">28. How about to the ______ bowling alley tonight? <span class="color-blue">(1 Point)</span></h4>
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2812" id="flexRadioDefault28125" >
                                    <label class="form-check-label" for="flexRadioDefault28125">going</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2812" id="flexRadioDefault28126">
                                    <label class="form-check-label" for="flexRadioDefault28126">go</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2812" id="flexRadioDefault28127">
                                    <label class="form-check-label" for="flexRadioDefault28127">to go</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2812" id="flexRadioDefault28128">
                                    <label class="form-check-label" for="flexRadioDefault28128">for going</label>
                                </div>
                            </div>
                        </div>
  
                    </div>
                </div>
  
  
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">29. He was wrong not to thank you; he ______ have done so. <span class="color-blue">(1 Point)</span></h4>
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2912" id="flexRadioDefault29125" >
                                    <label class="form-check-label" for="flexRadioDefault29125">may</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2912" id="flexRadioDefault29126">
                                    <label class="form-check-label" for="flexRadioDefault29126">should</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2912" id="flexRadioDefault29127">
                                    <label class="form-check-label" for="flexRadioDefault29127">must</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2912" id="flexRadioDefault29128">
                                    <label class="form-check-label" for="flexRadioDefault29128">would</label>
                                </div>
                            </div>
                        </div>
  
                    </div>
                </div>
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <h4 class="mb-3">30. "Do you think you ______ with my mobile phone soon? I need to make a call." <span class="color-blue">(1 Point)</span></h4>
                        <!-- list group -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action" aria-current="true">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault3012" id="flexRadioDefault30125" >
                                    <label class="form-check-label" for="flexRadioDefault30125">finish</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault3012" id="flexRadioDefault30126">
                                    <label class="form-check-label" for="flexRadioDefault30126">are finishing</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault3012" id="flexRadioDefault30127">
                                    <label class="form-check-label" for="flexRadioDefault30127">will have finished</label>
                                </div>
                            </div>
                            <!-- list group -->
                            <div class="list-group-item list-group-item-action">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault3012" id="flexRadioDefault30128">
                                    <label class="form-check-label" for="flexRadioDefault30128">are finished</label>
                                </div>
                            </div>
                        </div>
  
                    </div>
                </div>
  

            </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
          <button class="btn btn-primary" >Submit Now</button>
        </div>
      </div>
    </div>
  </div>

  </div>



@endsection