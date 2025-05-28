@extends('frontend.master')
@section('content')
<main>
    <section class="p-lg-5 py-7">
        <div class="container">

            <!-- Content -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-3 mb-xl-0">
                    <!-- Card -->
                    <div class="card mb-4">
                        <!-- Card body -->
                        <div class="card-body py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="fw-bold mb-0 color-blue mentor-answersheet-header">E-Portfolio 
                                    <span class="fs-6 fw-semibold">{{isset($portfolioData[0]['course_title']) ? $portfolioData[0]['course_title'] : ''}}</span>
                                </h3>

                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">

                                    <div class="lh-1">
                                        <h4 class="mb-1 e-portfilio-studentname mobileviewtext"> Student Name: <span class="color-blue">{{isset($portfolioData[0]['name']) ? $portfolioData[0]['name']." ".$portfolioData[0]['last_name']  : "" }}</span>
                                        </h4>
                                    </div>
                                </div>
                                <div>
                                    {{-- <a href="javascript:history.back()" class="btn btn-outline-primary mobileViewButton">Back</a> --}}
                                    {{-- <a href="{{route('e-mentor-students-exam')}}" class="btn btn-outline-primary mobileViewButton">Back</a> --}}
                                    
                                    {{-- @php
                                        $routeName = auth()->user()->role == 'admin' ? 'admin-e-mentor-students-exam-details' : 'e-mentor-students-exam-details';
                                    @endphp --}}
                                    
                                    @php
                                        $routeName = in_array(auth()->user()->role, ['admin', 'superadmin']) 
                                            ? 'admin-e-mentor-students-exam-details' 
                                            : 'e-mentor-students-exam-details';
                                    @endphp

                                    <a href="{{ route($routeName, [
                                        'id' => $portfolioData[0]['userId'],
                                        'course_id' => $portfolioData[0]['actualCourseId'],
                                        'student_course_master_id' => $portfolioData[0]['student_course_master_id']
                                    ]) }}" class="btn btn-outline-primary mobileViewButton">Back</a>
                                </div>
                            </div>

                            {{-- <div class="row mt-2">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
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
                                        </li>
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
                                                        <p class="text-dark mb-0 fw-semibold">05 May, 2024</p>
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
                                                        <h5 class="mb-0 text-body">Checking Status</h5>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div>
                                                        <p class="text-success mb-0 fw-semibold">Pending </p>
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
                                                        <h5 class="mb-0 text-body">Last Checked</h5>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div>
                                                        <p class="mb-0 fw-semibold text-dark">05 May, 2024</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}

                        </div>

                    </div>
                    <!-- Card -->
                    <div class="card rounded-3">
                        <!-- Card body -->
                        <section class="container px-4 pt-4">


                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    {{-- <p> <strong>Instructions:</strong> You need to be keeping a log of what you have learnt, your accomplishments and reflections and they you will be provided with a monthly update from your module e-mentor about what learning outcomes needed to be met during the previous month, information about your progress, and guidance on where you need to reflect on your progress.
                                    </p> --}}
                                    <p class="mb-0">An E-portfolio is a document that you prepare over a period studying. It will include your feelings, your insights and your learning experiences. It details what you have learned, the impact of that learning, what it meant to you and how you will use that learning experience in the future. It may include a section on challenges faced, how you worked through those challenges and what you would do differently.</p>
                                    <p>It may also contain a section on reading or articles you read and what you learned from those or indeed theories or models that you can apply in the future.</p>
                                    <p>It is about growth and development.</p>
                                </div>
                                <hr>

                                @foreach($portfolioData as $key => $portfolio)
                                    <div class="col-md-12 mb-5">
                                        <label for="textarea-input" class="form-label">
                                            <h5 class="color-blue mb-0"> 
                                                {{$key+1}}. {{html_entity_decode($portfolio['title'])}} </h5>
                                        </label>

                                        <input type="hidden" name="question_id[]" id="question_id" value="{{$portfolio['eportfolioId']}}">
                                        <div class="d-flex">
                                            <div>
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewPortfolio{{$key}}">View <i class="bi bi-eye"></i></button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <hr>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="viewPortfolio{{$key}}" tabindex="-1" aria-labelledby="viewPortfolioLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-3" id="viewPortfolioLabel">E-Portfolio</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="col-md-12 mb-2">
                                                        <label class="form-label fs-4 color-blue" for="E-portfolio Title">E-portfolio Title</label>
                                                        <input type="text " id="E-portfolio Title" contenteditable="false" class="form-control mb-3 shadow-none" value="{{isset($portfolio['title']) ? html_entity_decode($portfolio['title']) : ''}}"  required readonly>
                                                    </div>
                                                        <div class="col-md-12 mb-4">
                                                            <label class="form-label" for="E-portfolio Title">1. Main points </label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][0]->answer) ? html_entity_decode($portfolio['answers'][0]->answer) : "" }}</textarea>
                                                        </div>

                                                        <div class="col-md-12 mb-4">
                                                            <label class="form-label" for="E-portfolio Title">2. Models and theories introduced</label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][1]->answer) ? html_entity_decode($portfolio['answers'][1]->answer) : '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-4">
                                                            <label class="form-label shadow-none" for="E-portfolio Title">3. Key learnings</label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][2]->answer) ? html_entity_decode($portfolio['answers'][2]->answer) : ''}}</textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-4">
                                                            <label class="form-label" for="E-portfolio Title">4. Challenges faced </label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][3]->answer) ? html_entity_decode($portfolio['answers'][3]->answer) : ''}}</textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-4">
                                                            <label class="form-label" for="E-portfolio Title">5. How can I use what I learned in the future?</label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][4]->answer) ? html_entity_decode($portfolio['answers'][4]->answer) : ""}}</textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-4">
                                                            <label class="form-label" for="E-portfolio Title">6. How has this learning facilitated personal growth?</label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][5]->answer) ? html_entity_decode($portfolio['answers'][5]->answer) : "" }}</textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-4">
                                                            <label class="form-label" for="E-portfolio Title">7. Any additional reflections</label>
                                                            
                                                            <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly>{{isset($portfolio['answers'][6]->answer) ? html_entity_decode($portfolio['answers'][6]->answer) : ""}}</textarea>
                                                        </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                @endforeach

                                <div class="feedback-container mb-3">
                                    <h4 class="feedback-header">Please provide your feedback on the exam experience by selecting the option that best describes your evaluation of the exam.</h4>
                                    <form id="examEportfolioMarksForm">
                                        <div class="d-flex flex-column">
                                            
                                            <input type="hidden" name="actual_course_id" value="{{isset($portfolioData[0]['actualCourseId']) ? $portfolioData[0]['actualCourseId'] : 0 }}">
                                            <input type="hidden" name="course_id" value="{{isset($portfolioData[0]['courseId']) ? $portfolioData[0]['courseId'] : 0 }}">
                                            <input type="hidden" name="student_id"  value="{{isset($portfolioData[0]['userId']) ? $portfolioData[0]['userId'] : 0 }}">
                                            <input type="hidden" name="student_course_master_id"  value="{{isset($portfolioData[0]['student_course_master_id']) ? $portfolioData[0]['student_course_master_id'] : 0 }}">

                                            @foreach($portfolioData as $portfolio)
                                                <input type="hidden" name="eportfolio_id[]" value="{{$portfolio['eportfolioId']}}">
                                            @endforeach

                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="remark" id="option1" value="1" required {{ isset($portfolioData[0]['remark']) && $portfolioData[0]['remark'] == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="option1">
                                                    Pass
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="remark" id="option2" value="0" required {{ isset($portfolioData[0]['remark']) && $portfolioData[0]['remark'] == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="option2">
                                                    Fail
                                                </label>
                                            </div>
                                            <div class="mb-3">
                                                <label for="additionalComments" class="form-label">Additional Comments</label>
                                                <textarea class="form-control" id="additionalComments" name="comment" rows="4" placeholder="Enter any additional details or comments..."></textarea>
                                            </div>
                                        </div>
                                        @if(Auth::user()->role == 'instructor' || Auth::user()->role === 'sub-instructor')
                                            <button type="submit" class="btn btn-primary submit-button submitEportfolioEmentor">Submit</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="{{ asset('admin/js/examCommon.js')}}"></script>
@endsection


  <!-- Modal -->
  <div class="modal fade" id="viewPortfolio" tabindex="-1" aria-labelledby="viewPortfolioLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="viewPortfolioLabel">E-Portfolio</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <div class="col-md-12 mb-2">
                    <label class="form-label fs-4 color-blue" for="E-portfolio Title">E-portfolio Title</label>
                    <input type="text " id="E-portfolio Title" contenteditable="false" class="form-control mb-3 shadow-none"  required readonly>

                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label" for="E-portfolio Title">1. Main points </label>
                     
                    <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly></textarea>
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label" for="E-portfolio Title">2. Models and theories introduced</label>
                     
                    <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly></textarea>
                </div>
                <div class="col-md-12 mb-4">
                    <label class="form-label shadow-none" for="E-portfolio Title">3. Key learnings</label>
                     
                    <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly></textarea>
                </div>
                <div class="col-md-12 mb-4">
                    <label class="form-label" for="E-portfolio Title">4. Challenges faced </label>
                     
                    <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly></textarea>
                </div>
                <div class="col-md-12 mb-4">
                    <label class="form-label" for="E-portfolio Title">5. How can I use what I learned in the future?</label>
                     
                    <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly></textarea>
                </div>
                <div class="col-md-12 mb-4">
                    <label class="form-label" for="E-portfolio Title">6. How has this learning facilitated personal growth?</label>
                     
                    <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly></textarea>
                </div>
                <div class="col-md-12 mb-4">
                    <label class="form-label" for="E-portfolio Title">7. Any additional reflections</label>
                     
                    <textarea class="form-control shadow-none" id="siteDescription" placeholder="" required="" rows="10" readonly></textarea>
                </div>

                {{-- <div class="col-12 mb-6 text-center">
                    <a href="#" class="btn btn-primary">Submit</a>
                   
                </div> --}}
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save</button> --}}
        </div>
      </div>
    </div>
  </div>