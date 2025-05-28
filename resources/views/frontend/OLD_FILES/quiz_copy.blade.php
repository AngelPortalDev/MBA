

@if (isset($QuizCourse) && !empty($QuizCourse) && count($QuizCourse) > 0)
    @php
        $quiztab = 1;
    @endphp
    @foreach ($QuizCourse as $sections)
            @if ((isset($sections['sections'][0]['section_manage']) && is_array($sections['sections'][0]['section_manage'])))
        @foreach ($sections['sections'][0]['section_manage'] as $section_manage)
            @if (!empty($section_manage['content_type_id']) && $section_manage['content_type_id'] === 3)
                @foreach ($section_manage['course_quiz'] as $quiz)
                    @php
                        $question = getData(
                            'exam_quiz_questions',
                            ['id', 'question', 'option1', 'option2', 'option3', 'option4'],
                            ['quiz_id' => $quiz['id'], 'is_deleted' => 'No'],
                        );
                        $questionCount = count($question);
                        $i = 1;
                        $stp = 1;
                        $is_done =  is_exist('score_quiz',['course_id'=>$sections['course'][0]['id'],'quiz_id'=>$quiz['id'],'user_id'=>Auth::user()->id,'is_deleted'=>'No']);
                    @endphp

                    <div class="tab-pane fade quizTab quizPane{{ $quiztab }}" id="quiz_{{ $quiztab }}"
                        role="tabpanel" aria-labelledby="quiz-{{ $quiztab }}-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0">
                                    <div id="courseForm{{ $quiztab }}" class="bs-stepper">
                                        <div class="bs-stepper-header" id="custom_stepers{{ $quiztab }}">
                                            <!-- Step headers dynamically generated -->

                                      
                                            <div class="step courseFormtrigger"
                                                data-target="#test-start{{ $quiztab }}">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="test-start{{ $quiztab }}"
                                                    id="courseFormtrigger-start{{ $quiztab }}">
                                                </button>
                                            </div>
                                            @foreach ($question as $getQues)
                                                <div class="step courseFormtrigger{{ $getQues->id }}"
                                                    data-target="#test-l-{{ $getQues->id }}">
                                                    <button type="button" class="step-trigger" role="tab"
                                                        aria-controls="test-l-{{ $getQues->id }}"
                                                        id="courseFormtrigger-{{ $getQues->id }}">
                                                    </button>
                                                </div>
                                                @php
                                                    $stp++;
                                                @endphp
                                            @endforeach
                                           
                                        </div>
                                    <div class="bs-stepper-content">

                                        <form form class="quizForm" onSubmit="return false" id="quizForm{{ $quiztab }}">
                                            <!-- Content test-start -->
                                            <input type='text' value="{{ base64_encode($quiz['id']) }}" name="quiz_id" hidden>
                                            <input type='text' value="{{ base64_encode($sections['course'][0]['id']) }}" name="course_id" hidden>
                                            <div id="test-start{{ $quiztab }}" role="tabpanel"
                                                class="bs-stepper-pane fade quizTab quizPane{{ $quiztab }}"
                                                id="courseFormtrigger0">
                                                <div class="card mb-4">
    <!-- Card body -->
@if($is_done === 0)
    <div class="card-body p-10">
        <div class="text-center">
            <!-- Start quiz content -->
            <h2 class="h1 color-blue">Welcome to Quiz
                {{ $quiztab }}</h2>
            <p class="mb-0">Engage live or asynchronously with
                quiz and poll questions that
                participants complete at their own pace.</p>
            <button class="btn btn-primary mt-4 color-green"
                type="button" onclick="nextStep({{ $quiztab }})">
                Start Your Quiz <i class="fe fe-arrow-right"></i>
            </button>
        </div>
    </div>
    @endif
</div>
</div>
<!-- Content one -->
@if($is_done === 0)
@foreach ($question as $getQues)
<div id="test-l-{{ $getQues->id }}" role="tabpanel"
    class="bs-stepper-pane fade"
    aria-labelledby="courseFormtrigger{{ $getQues->id }}">
    <div class="card mb-4">
        <!-- Card body -->
        <div class="card-body">
            <!-- quiz -->
            <div
                class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                <div class="d-flex align-items-center">
                    <!-- quiz img -->
                    <a href="#"><img
                            src="{{ asset('frontend/images/quiz-image.jpg') }}"
                            alt="course"
                            class="rounded img-4by3-lg" style="width: 4.5rem" /></a>
                    <!-- quiz content -->
                    <div class="ms-3">
                        <h3 class="mb-0"><a href="#"
                                class="text-inherit">{{ isset($quiz['quiz_tittle']) ? $quiz['quiz_tittle'] : '' }}</a>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <!-- text -->
                <div class="d-flex justify-content-between">
                    <span>Exam Progress:</span>
                    <span>Question {{ $i }} out of
                        {{ $questionCount }}</span>
                </div>
                <!-- progress bar -->
                <div class="mt-2">
                    <div class="progress" style="height: 6px">
                        <div class="progress-bar bg-success"
                            role="progressbar" style="width: {{ (100 / $questionCount) * $i }}%"
                            aria-valuenow="{{ (100 / $questionCount) * $i }}" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <!-- text -->
            <div class="mt-5">
                <span>Question {{ $i }}</span>
                <h3 class="mb-3 color-blue  mt-1">
                    {{ isset($getQues->question) ? $getQues->question : 'NA' }}
                     <input value="{{base64_encode($getQues->id)}}" type="text" name="question_id[]" hidden  />
                </h3>
                <!-- list group -->
                <div class="list-group">
                    @if (isset($getQues->option1) && !empty($getQues->option1))
                        <div class="list-group-item list-group-item-action"
                            aria-current="true">
                            <!-- form check -->
                            <div class="form-check">
                                <input class="form-check-input"
                                    type="radio"
                                    name="answer{{$i}}[]" value="1"
                                    id="flexRadioDefault1_{{ $i . '_' . $quiztab }}" />
                                <label
                                    class="form-check-label stretched-link"
                                    for="flexRadioDefault1_{{ $i . '_' . $quiztab }}">{{ $getQues->option1 }}</label>
                            </div>
                        </div>
                    @endif
                    @if (isset($getQues->option2) && !empty($getQues->option2))
                        <div class="list-group-item list-group-item-action">
                            <div class="form-check">
                                <input class="form-check-input"
                                    type="radio"
                                    name="answer{{$i}}[]" value="2"
                                    id="flexRadioDefault2_{{ $i . '_' . $quiztab }}" />
                                <label
                                    class="form-check-label stretched-link"
                                    for="flexRadioDefault2_{{ $i . '_' . $quiztab }}">{{ $getQues->option2 }}</label>
                            </div>
                        </div>
                    @endif
                    @if (isset($getQues->option3) && !empty($getQues->option3))
                        <div class="list-group-item list-group-item-action">
                            <div class="form-check">
                                <input class="form-check-input"
                                    type="radio"
                                    name="answer{{$i}}[]" value="3"
                                    id="flexRadioDefault3_{{ $i . '_' . $quiztab }}" />
                                <label
                                    class="form-check-label stretched-link"
                                    for="flexRadioDefault3_{{ $i . '_' . $quiztab }}">{{ $getQues->option3 }}</label>
                            </div>
                        </div>
                    @endif
                    @if (isset($getQues->option4) && !empty($getQues->option4))
                        <div class="list-group-item list-group-item-action">
                            <div class="form-check">
                                <input class="form-check-input"
                                    type="radio"
                                    name="answer{{$i}}[]" value="4"
                                    id="flexRadioDefault4_{{ $i . '_' . $quiztab }}" />
                                <label
                                    class="form-check-label stretched-link"
                                    for="flexRadioDefault4_{{ $i . '_' . $quiztab }}">{{ $getQues->option4 }}</label>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-start">
        @if ($i > 1)
            <button type="button" class="btn btn-secondary"
                onclick="previousStep({{ $quiztab }})">
                <i class="fe fe-arrow-left"></i>
                Previous
            </button>
        @endif
    </div>
    <div class="d-flex justify-content-end">
        @if ($questionCount > $i)
            <button type='button'
                class="btn btn-primary color-green"
                onclick="nextStep({{ $quiztab }})">
                Next
                <i class="fe fe-arrow-right"></i>
            </button>
        @else
            <button type='button'
                class="btn btn-primary color-green quizSubmit">
                Finish
                <i class="fe fe-arrow-right"></i>
            </button>
        @endif
    </div>
</div>
@php
    $i++;
@endphp
@endforeach
</form>
@else
@php
$score = getData(
    'score_quiz',
    ['quiz_score'],
    ['course_id'=>$sections['course'][0]['id'],'quiz_id'=>$quiz['id'],'user_id'=>Auth::user()->id,'is_deleted'=>'No']
);
$score = $score[0]->quiz_score;

@endphp
    {{-- result --}}
<div id="quiz-result" role="tabpanel" class="bs-stepper-pane fade active show"
    aria-labelledby="courseFormtrigger6">
    <div class="card mb-4">
        <!-- card body -->
        <div class="card-body p-10 text-center">
            <!-- text -->
            <div class="mb-4">
                <h2 class="color-blue">
                    🎉 Well Done !!!! You are successfully completed the Quiz
                </h2>
                {{-- <p class="mb-0 px-lg-8">
                    You are successfully completed the
                    quiz. Now you
                    click on finish and back to your
                    quiz page.
                </p> --}}
            </div>
            <!-- chart -->
            <div class="d-flex justify-content-center">
                <div class="resultChart">{{$score}}</div>
            </div>
            <!-- text -->
            <div class="mt-3">
                <span>
                    Your Score:
                    <span class="text-dark">%
                        ({{$score}} points)</span>
                </span>
                <br />
                {{-- <span class="mt-2 d-block">
                    Passing Score:
                    <span class="text-dark">80%</span>
                </span> --}}
            </div>
            <!-- btn -->
            {{-- <div class="mt-5">
                <!-- <a href="#" class="btn btn-primary color-green">Finish</a> -->
                <a href="#" class="btn btn-outline-secondary ms-2">
                    Share
                    <i class="fe fe-external-link"></i>
                </a>
            </div> --}}
        </div>
    </div>
</div>
@endif
</div>
</div>
</div>
</div>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper{{ $quiztab }} = new Stepper(document.querySelector('#courseForm{{ $quiztab }}'), {
            linear: false,
            animation: true
        });
    });

    function nextStep(quiztab) {
        window['stepper' + quiztab].next();
    }

    function previousStep(quiztab) {
        window['stepper' + quiztab].previous();
    }
</script>
                    @php
                        $quiztab++;
                    @endphp
                @endforeach
            @endif
        @endforeach
          @endif
    @endforeach
@endif

<script>
//    document.addEventListener('DOMContentLoaded', function () {
//     console.log('Script is running');
//     var steppers = document.querySelectorAll('.bs-stepper');
//     console.log(`Found ${steppers.length} steppers`);

//     window.steppers = [];
//     document.querySelectorAll('.bs-stepper').forEach(function (stepper, index) {
//         var stepperInstance = new Stepper(stepper, {
//             linear: false,
//             animation: true
//         });
//         window.steppers.push(stepperInstance);
//         console.log(`Stepper ${index} initialized:`, stepperInstance);
      
//     });
//     console.log('All steppers:', window.steppers);
// });

// function nextStep(quiztab) {
//     console.log('Next step button clicked with quiztab:', quiztab);
//     var stepperIndex = quiztab - 1; 
//     console.log('Navigating to next step for stepper index:', stepperIndex);
//     var stepper = window.steppers[stepperIndex];
//     if (stepper) {
//         stepper.next();
//     } else {
//         console.error('Stepper not found for index:', stepperIndex);
//     }
// }

// function previousStep(quiztab) {
//     console.log('Previous step button clicked with quiztab:', quiztab);
//     var stepperIndex = quiztab - 1;  
//     var stepper = window.steppers[stepperIndex];
//     if (stepper) {
//         stepper.previous();
//     } else {
//         console.error('Stepper not found for index:', stepperIndex);
//     }
// }


</script>
