@extends('frontend.master')
@section('content')

    <style>
        .timer {
            text-align: center;
        }

        .timer-label {
            display: block;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .timer-card {
            border-radius: 8px;
            padding: 18px;
            margin: 0 10px;
            width: 90px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            margin-top: 12px;
        }

        .timer-value {
            font-size: 18px;
            font-weight: bold;
        }

        .timer-unit {
            font-size: 12px;
        }

        .minus-text {
            font-size: 24px;
            color: red;
        }

        .assignment-hour {
            margin-top: 20px;
        }

        .question-label {
            font-weight: bold;
            color: #343a40;
        }

        .submit-button {
            background-color: #2b3990;
            color: white;
        }

        .submit-button:hover {
            background-color: #024791;
        }

        .modal-header {
            background-color: #2b3990;
            color: white;
        }

        .modal-footer {
            justify-content: center;
        }

        .color-blue {
            color: #2b3990;
        }

        .btn-close {
            color: #ffffff;
        }

        .btn-primary {
            background-color: #2b3990;
            color: white;
            border: none;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }

        .finalsubmitTime {
            background: #2b3990 !important;
        }

        .question-label {
            font-weight: bold;
            color: #2b3990;
            margin-bottom: 10px;
        }

        textarea {
            transition: border 0.3s;
        }

        textarea:focus {
            border: 2px solid #2b3990;
            outline: none;
        }

        .btn-primary {
            border-radius: 30px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* transform: scale(1.05); */
        }

        .progress {
            height: 20px;
        }
        .img-4by3-lg{
            height: auto;
            width: 3.5rem;
        }
    </style>


    @php
        foreach ($examDetails as $detail) {
            if (!empty($detail['mcq_exam'])) {
                $QuestionData = $detail['mcq_exam'];
                break;
            }
        }
        [$hours, $minutes] = explode(':', $QuestionData[0]['exam_duration']);
        $total_seconds = $hours * 3600 + $minutes * 60;
        $examAttemptTime = getData(
            'exam_mcq_answers',
            ['exam_start_time', 'exam_end_time'],
            ['student_course_master_id' => $student_course_master_id, 'user_id' => Auth::id(), 'course_id' => $QuestionData[0]['award_id'], 'is_active' => '1'],
        );
        $examStartTime = $examAttemptTime[0]->exam_start_time;
        $examEndTime = $examAttemptTime[0]->exam_end_time;
        $timeDifferenceInSeconds = strtotime($examEndTime) - strtotime($examStartTime);
    @endphp
    
    <div class="container assignment-hour">
        <div class="card p-4 shadow-sm mt-5 mb-5">

            @if ($timeDifferenceInSeconds >= $total_seconds)
                <div class="timer">
                    <h4 class="timer-label text-center fs-3">Time Remaining:</h4>
                    <div class="d-flex justify-content-center flex-wrap pt-2 pb-4" style="background: #f8f8f8">
                        <div class="timer-card">
                            <span class="timer-value" id="hours">00</span>
                            <span class="timer-unit">Hours</span>
                        </div>
                        <div class="timer-card">
                            <span class="timer-value" id="minutes">00</span>
                            <span class="timer-unit">Minutes</span>
                        </div>
                        <div class="timer-card">
                            <span class="timer-value" id="seconds">00</span>
                            <span class="timer-unit">Seconds</span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="tab-pane mcqTab1-{{$key}} mcqPane1-{{$key}}" id="mcq-{{$key}}" role="tabpanel-{{$key}}" aria-labelledby="mcq-1-tab">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="embed-responsive position-relative w-100 d-block overflow-hidden p-0">
                            <div id=" " class="bs-stepper">
                                <div class="bs-stepper-header rounded-0 d-none" id="mcqHeader1-{{$key}}">
                                    <!-- your step headers -->
                                    <div class="step test-start-{{$key}}" data-target="#test-start-{{$key}}">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="test-start-{{$key}}"
                                            id="courseFormtrigger0">
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content mt-3">
                                    <form id="mcqForm-{{$index}}-{{$key}}" class="mcqForm" onSubmit="return false">
                                        <input type='text' id="course_id" name="course_id" vlaue="{{$QuestionData[0]['award_id']}}" hidden>
                                        <input type="hidden" name="master_course_id" id="master_course_id" value="{{ isset($master_course_id) ? base64_encode($master_course_id) : '' }}">
                                        <input type="hidden" name="student_course_master_id" id="student_course_master_id" value="{{base64_encode($student_course_master_id)}}">
                                        <input type="hidden" name="index" id="index" value="{{$index}}">
                                        <input type="hidden" name="key" id="key" value="{{$key}}">
                                        <input type="hidden" name="id" id="id" value="{{$QuestionData[0]['id']}}">

                                        <!-- Content test-start -->
                                        <div id="test-start-{{$key}}" role="tabpanel-{{$key}}" class="first-pane bs-stepper-pane"
                                            id="courseFormtrigger0">
                                            <div class="card mb-4 rounded-0">
                                                <!-- Card body -->
                                                <div class="card-body p-10">
                                                    <div class="text-center">
                                                        <!-- img -->
                                                        <img src="{{ asset('frontend/images/student-quiz-01.png') }}"
                                                            alt="survey" class="img-fluid" />
                                                        <!-- text -->
                                                        <div class="px-lg-8 mt-4">
                                                            <h2 class="h1 color-blue">Welcome
                                                                to MCQ</h2>
                                                            <p class="mb-0">Participate in interactive quizzes and polls, allowing you to respond to multiple-choice questions at your convenience. Enjoy the flexibility to engage at your own pace while testing your knowledge and sharing your insights!.</p>
                                                            <button class="btn btn-primary mt-4 color-green" type="button"
                                                                onclick="nextStep(1, {{$key}})">
                                                                Start Your MCQs <i class="fe fe-arrow-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                    <div id="test-last" role="tabpanel-{{$key}}" class="bs-stepper-pane" id="courseFormtrigger_last">
                                        <div class="card mb-4 rounded-0">
                                            <!-- Card body -->
                                            <div class="card-body p-10">
                                                <div class="text-center">
                                                    <!-- img -->
                                                    <img src="{{ asset('frontend/images/student_quiz_02.png') }}" alt="survey"
                                                        class="img-fluid" />
                                                    <!-- text -->
                                                    <div class="px-lg-8 mt-4">
                                                        <div class="score-container">
                                                            <h2 class="h1 color-blue score"></h2>
                                                        </div>
                                                        <p class="mb-0">Engage live or
                                                            asynchronously with quiz and
                                                            poll questions that
                                                            participants complete at their
                                                            own pace.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Time Up -->
    <div class="modal fade" id="timeUpModal" aria-hidden="true" aria-labelledby="timeUpModalLabel" tabindex="-1"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-4 text-white" id="timeUpModalLabel">Time is Up!</h5>
                </div>
                <div class="modal-body">
                    <p>Your time is up! The exam will be automatically submitted in <span id="countdownTimer">3</span>
                        seconds.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        var isFormSubmitted = false;
        var timerDuration = <?php echo $total_seconds; ?>;
        var examStartTime;
    
        function handleBeforeUnload(event) {
            if (!isFormSubmitted) {
                var confirmationMessage = 'You have unsaved changes. Are you sure you want to leave?';
                event.returnValue = confirmationMessage;
                return confirmationMessage;
            }
        }
    
        // Start the timer countdown
        function startTimer(duration) {
            var timer = duration,
                hours, minutes, seconds;
            var interval = setInterval(function() {
                hours = parseInt(timer / 3600, 10);
                minutes = parseInt((timer % 3600) / 60, 10);
                seconds = parseInt(timer % 60, 10);
    
                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
    
                // Display timer
                document.getElementById('hours').textContent = hours;
                document.getElementById('minutes').textContent = minutes;
                document.getElementById('seconds').textContent = seconds;
    
                // Check if timer has ended
                if (--timer < 0) {
                    clearInterval(interval);
                    $('#timeUpModal').modal('show');
                    var countdown = 3;
                    $('#countdownTimer').text(countdown);
                    var countdownInterval = setInterval(function() {
                        countdown--;
                        $('#countdownTimer').text(countdown);
    
                        if (countdown === 0) {
                            clearInterval(countdownInterval);
                            $('.mcqFinalSubmit').click();  // Submit the exam automatically
                        }
                    }, 1000);
                }
            }, 1000);
        }
    
        function initializeTimer() {
            examStartTime = localStorage.getItem('examStartTime');
    
            if (examStartTime) {
                var currentTime = Math.floor(Date.now() / 1000);
                var elapsedTime = currentTime - parseInt(examStartTime);
                var remainingTime = timerDuration - elapsedTime;
    
                if (remainingTime > 0) {
                    startTimer(remainingTime);
                } else {
                    $('#timeUpModal').modal('show');
                    setTimeout(function() {
                        $('.mcqFinalSubmit').click();  // Submit the exam automatically
                    }, 5000);
                }
            } else {
                localStorage.setItem('examStartTime', Math.floor(Date.now() / 1000));
                startTimer(timerDuration);
            }
        }
    
        // Prevent back navigation during the exam
        // window.addEventListener("popstate", function () {
        //     showModal("Warning", "You cannot go back during the exam. Please submit the exam before leaving.");
        //     history.pushState(null, null, window.location.href); // Keeps the page from going back
        // });

        // window.addEventListener("beforeunload", function(event) {
        //     if (!isFormSubmitted) {
        //         var confirmationMessage = 'You have unsaved changes. Are you sure you want to leave?';
        //         event.returnValue = confirmationMessage;
        //         return confirmationMessage;
        //     }
        // });
    
        $(document).ready(function () {
            $(window).on('load', function () {
                $('#startExamMcqBtn').show();
            });
            var examForm = $('.mcqFinalSubmit'); 
            var examSubmitted = false;
            var autoSubmitTimeout;
            window.addEventListener("beforeunload", handleBeforeUnload);

    
            // Show modal for submitting the exam
            function showSubmitModal(title, text, submitCallback, cancelCallback) {
                swal({
                    title: title,
                    text: text,
                    icon: "warning",
                    buttons: {
                        cancel: "Cancel",
                        submit: {
                            text: "Submit Exam",
                            value: "submit"
                        }
                    },
                    closeOnClickOutside: false,
                    closeOnEsc: false
                }).then((value) => {
                    if (value === "submit" && typeof submitCallback === "function") {
                        submitCallback();
                    } else if (typeof cancelCallback === "function") {
                        cancelCallback();
                    }
                });
            }
    
            function showModal(title, text) {
                swal({
                    title: title,
                    text: text,
                    icon: "warning",
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    button: false // Disable the button
                });
            }
    
            // Auto-submit exam after 10 seconds when the browser is closed
            function autoSubmitExam() {
                if (!examSubmitted) {
                    if (autoSubmitTimeout) {
                        clearTimeout(autoSubmitTimeout);  // Clear existing timeout if any
                    }
    
                    autoSubmitTimeout = setTimeout(function () {
                        $('.mcqFinalSubmit').click();  // Submit the exam
                        examSubmitted = true;
                    }, 10000);  // 10 seconds delay
                }
            }
    
            // Cancel the auto-submit if the user returns within 10 seconds
            function cancelAutoSubmitExam() {
                clearTimeout(autoSubmitTimeout);
            }
    
            window.addEventListener('focus', function () {
                cancelAutoSubmitExam();
            });
    
            window.onload = function() {
                initializeTimer();
            };

            $("#test-start-{{$key}}").show();
            $('.newAddedPane-{{$key}}').remove();
            $("#mcqHeader1-{{$key}} .step").not(':first').remove();
            $('.newAddedPane-{{$key}}').removeClass('active show');
            $('.mcqTab1-{{$key}}').removeClass("active show"); 
            
            var studentBaseUrl = window.location.origin + "/student";
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            
            // var mcqId = <?php echo $QuestionData[0]['id']; ?>;
            // var mcqId = form.find('input[name="id"]').val();
            var index = <?php echo $index; ?>;
            var key = <?php echo $key; ?>;
            var form = $("#mcqForm-" + index + '-' + key);
            var mcqId = form.find('input[name="id"]').val();
            var courseId = <?php echo $QuestionData[0]['award_id']; ?>;

            // $.ajax({
            //     url: studentBaseUrl + "/mcq-view",
            //     type: "POST",
            //     data: {
            //         id: btoa(mcqId),
            //         course_id: btoa(courseId),
            //     },
            //     dataType: "json",
            //     headers: {
            //         "X-CSRF-TOKEN": csrfToken,
            //     },
            //     success: function(response) {
            //         if (response.code === 200) {
            //             // Process quiz questions
                        
                        
            //             var course_id = response.data[0]['award_id'];
            //             var data = Object.keys(response.data[0]['mcq_question']);
            //             var values = Object.values(response.data[0]['mcq_question']);
            //             var num = 1;
            //             var length = data.length;

            //             data.forEach(function(key) {
            //                 var questionId = btoa(values[key]['id']);
            //                 var question = values[key]['question'];
            //                 var mcq_id = btoa(values[key]['mcq_id']);
            //                 var option1 = values[key]['option1'];
            //                 var option2 = values[key]['option2'];
            //                 var option3 = values[key]['option3'];
            //                 var option4 = values[key]['option4'];
            //                 var mark = values[key]['mark'];
            //                 var next = num + 1;
            //                 if (num == 1) {
            //                     $('#test-l-' + num).addClass('active show');

            //                 }
            //                 var progress = (num / length) * 100;
            //                 // Create navigation buttons
            //                 var previous = num > 1 ? `<div class="mt-0 ">
            //                     <button class="btn btn-secondary color-white" type="button" onclick="previousStep(${num})" style="border-radius:30px; padding:10px 20px;"><i class="fe fe-arrow-left me-1"></i>Previous
            //                     </button>
            //                 </div>` : '';

            //                 var nextBlock = length < next ?
            //                     `<div class="mt-0 d-flex justify-content-end">
            //                         <button class="btn btn-primary color-green mcqFinalSubmit" data-mcqid="${mcq_id}" data-courseid="${course_id}" data-index="{{$index}}"  type="button" style="border-radius:30px; padding:10px 20px;">Final Submit
            //                         </button>
            //                     </div>` :
            //                     `<div class="mt-0 d-flex justify-content-end">
            //                         <button class="btn btn-primary color-green" type="button" onclick="nextStep(${next})" style="border-radius:30px; padding:10px 20px;">Next
            //                         <i class="fe fe-arrow-right"></i></button>
            //                     </div>`;

            //                 // Create stepper and question container
            //                 var steperDiv = $(`
            //                     <div class="step newAddedStep" data-target="#test-l-${num}">
            //                         <button type="button" class="step-trigger" role="tab" aria-controls="test-l-${num}"
            //                             id="courseFormtrigger${num}"></button>
            //                     </div>`);

            //                 var stepcontain = `<div id="test-l-${num}" role="tabpanel" class="bs-stepper-pane newAddedPane"
            //                         aria-labelledby="courseFormtrigger${num}">
            //                         <div class="card mb-4">
            //                             <div class="card-body">
            //                                 <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
            //                                     <div class="d-flex align-items-center">
            //                                         <a href="#"><img src="{{ asset('frontend/images/quiz-image.jpg') }}"
            //                                                 alt="course" class="rounded img-4by3-lg" /></a>
            //                                         <div class="ms-3">
            //                                             <h3 class="mb-0"><a href="#" class="text-inherit mcqmainheading">Multiple Choice Questions</a></h3>
            //                                             <input value="${questionId}" type="text" name="question_id[]" hidden />
            //                                             <input value="${mcq_id}" type="text" name="mcq_id" hidden />
            //                                         </div>
            //                                     </div>
            //                                 </div>
            //                                 <div class="mt-3">
            //                                     <div class="d-flex justify-content-between">
            //                                         <span>Exam Progress:</span>
            //                                         <span>Question ${num} out of ${length}</span>
            //                                     </div>
            //                                     <div class="mt-2">
            //                                         <div class="progress" style="height: 6px">
            //                                             <div class="progress-bar bg-success" role="progressbar"
            //                                                 style="width: ${progress}%" aria-valuenow="15" aria-valuemin="0"
            //                                                 aria-valuemax="100"></div>
            //                                         </div>
            //                                     </div>
            //                                 </div>
            //                                 <div class="mt-5">
            //                                     <span>Question ${num}</span>
            //                                     <div class="d-flex justify-content-between">
            //                                         <h3 class="mb-3 color-blue mt-1 mcq_questiontitle">${question}</h3>
            //                                         <h4 class="mb-3 color-blue mt-1 mcq_questionmarks">${mark} Marks</h4>
            //                                     </div>
                                                
            //                                     <div class="list-group">
            //                                         <div class="list-group-item list-group-item-action">
            //                                             <div class="form-check">
            //                                                 <input class="form-check-input" type="radio"
            //                                                     name="answer${num}[]" value="1" id="flexRadioDefault1${num}" />
            //                                                 <label class="form-check-label stretched-link"
            //                                                     for="flexRadioDefault1${num}">${option1}</label>
            //                                             </div>
            //                                         </div>
            //                                         <div class="list-group-item list-group-item-action">
            //                                             <div class="form-check">
            //                                                 <input class="form-check-input" type="radio"
            //                                                     name="answer${num}[]" value="2" id="flexRadioDefault2${num}" />
            //                                                 <label class="form-check-label stretched-link"
            //                                                     for="flexRadioDefault2${num}">${option2}</label>
            //                                             </div>
            //                                         </div>
            //                                         <div class="list-group-item list-group-item-action">
            //                                             <div class="form-check">
            //                                                 <input class="form-check-input" type="radio"
            //                                                     name="answer${num}[]" value="3" id="flexRadioDefault3${num}" />
            //                                                 <label class="form-check-label stretched-link"
            //                                                     for="flexRadioDefault3${num}">${option3}</label>
            //                                             </div>
            //                                         </div>
            //                                         <div class="list-group-item list-group-item-action">
            //                                             <div class="form-check">
            //                                                 <input class="form-check-input" type="radio"
            //                                                     name="answer${num}[]" value="4" id="flexRadioDefault4${num}" />
            //                                                 <label class="form-check-label stretched-link"
            //                                                     for="flexRadioDefault4${num}">${option4}</label>
            //                                             </div>
            //                                         </div>
            //                                     </div>
            //                                 </div>
            //                             </div>
            //                         </div>
            //                         <div class="button-wrapper d-flex justify-content-between flex-row-reverse">
            //                             ${nextBlock} ${previous}
            //                         </div>
            //                     </div>`;
            //                 $("#mcqHeader1").append(steperDiv);
            //                 $(".mcqForm").append(stepcontain);
                            

            //                 num++;
            //             });
            //             // Show quiz pane
            //             $('.mcqTab1').addClass("active show");
            //             // $("#course-project").removeClass("active show").hide();
            //             // $(".mcqPane1").addClass("active").collapse("show");
            //         } else if (response.code === 203) {
            //             $("#test-last").addClass('bs-stepper-block fade active');
            //             $(".score").html("Your score is : " + response.score + '%');
            //         } else {
            //             swal({
            //                 title: response.title,
            //                 text: response.message,
            //                 icon: response.icon,
            //             }).then(function() {
            //                 window.location.href = baseUrl + "/admin/admin";
            //             });
            //         }
            //     },
            // });
            

            $.ajax({
                url: studentBaseUrl + "/mcq-view",
                type: "POST",
                data: {
                    id: btoa(mcqId),
                    course_id: btoa(courseId),
                },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function(response) {
                    if (response.code === 200) {
                        // Process quiz questions
                        
                        
                        var course_id = response.data[0]['award_id'];
                        var data = Object.keys(response.data[0]['mcq_question']);
                        var values = Object.values(response.data[0]['mcq_question']);
                        var num = 1;
                        var length = data.length;

                        data.forEach(function(key) {
                            var questionId = btoa(values[key]['id']);
                            var question = values[key]['question'];
                            var mcq_id = btoa(values[key]['mcq_id']);
                            var option1 = values[key]['option1'];
                            var option2 = values[key]['option2'];
                            var option3 = values[key]['option3'];
                            var option4 = values[key]['option4'];
                            var mark = values[key]['mark'];
                            var next = num + 1;
                            if (num == 1) {
                                $('#test-l-' + num + "-" + {{$key}}).addClass('active show');

                            }
                            var progress = (num / length) * 100;
                            // Create navigation buttons
                            var previous = num > 1 ? `<div class="mt-0 d-flex justify-content-start">
                                <button class="btn btn-secondary color-white" type="button" onclick="previousStep(${num}, {{$key}})"><i class="fe fe-arrow-left"></i>Previous
                                </button>
                            </div>` : '';

                            var nextBlock = length < next ?
                                `<div class="mt-0 d-flex justify-content-end">
                                    <button class="btn btn-primary color-green mcqFinalSubmit" data-mcqid="${mcq_id}" data-courseid="${course_id}" data-index="{{$index}}" data-key="{{$key}}"  type="button">Final Submit
                                    <i class="fe fe-arrow-right"></i></button>
                                </div>` :
                                `<div class="mt-0 d-flex justify-content-end">
                                    <button class="btn btn-primary color-green" type="button" onclick="nextStep(${next}, {{$key}})">Next
                                    <i class="fe fe-arrow-right"></i></button>
                                </div>`;

                            // Create stepper and question container
                            var steperDiv = $(`
                                <div class="step newAddedStep" data-target="#test-l-${num}-{{$key}}">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="test-l-${num}-{{$key}}"
                                        id="courseFormtrigger${num}-{{$key}}"></button>
                                </div>`);

                            var stepcontain = `<div id="test-l-${num}-{{$key}}" role="tabpanel-{{$key}}" class="bs-stepper-pane newAddedPane-{{$key}}"
                                    aria-labelledby="courseFormtrigger${num}-{{$key}}">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <a href="#"><img src="{{ asset('frontend/images/quiz-image.jpg') }}"
                                                            alt="course" class="rounded img-4by3-lg" /></a>
                                                    <div class="ms-3">
                                                        <h3 class="mb-0"><p href="#" class="text-inherit mcqheading mb-0">Multiple Choice Questions</p></h3>
                                                        <input value="${questionId}" type="text" name="question_id[]" hidden />
                                                        <input value="${mcq_id}" type="text" name="mcq_id" hidden />
                                                        <input value="MCQ" type="hidden" name="type" hidden />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <div class="d-flex justify-content-between">
                                                    <span>Exam Progress:</span>
                                                    <span>Question ${num} out of ${length}</span>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="progress" style="height: 6px">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: ${progress}%" aria-valuenow="15" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <span>Question ${num}.</span>
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="mb-3 color-blue mt-1 mcq_question_title">${question}</h3>
                                                    <h4 class="mb-3 color-blue mt-1 mcq_marks_title">${mark} Marks</h4>
                                                </div>
                                                
                                                <div class="list-group">
                                                    <div class="list-group-item list-group-item-action">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="answer${num}[]" value="1" id="flexRadioDefault1${num}" />
                                                            <label class="form-check-label stretched-link"
                                                                for="flexRadioDefault1${num}">${option1}</label>
                                                        </div>
                                                    </div>
                                                    <div class="list-group-item list-group-item-action">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="answer${num}[]" value="2" id="flexRadioDefault2${num}" />
                                                            <label class="form-check-label stretched-link"
                                                                for="flexRadioDefault2${num}">${option2}</label>
                                                        </div>
                                                    </div>
                                                    <div class="list-group-item list-group-item-action">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="answer${num}[]" value="3" id="flexRadioDefault3${num}" />
                                                            <label class="form-check-label stretched-link"
                                                                for="flexRadioDefault3${num}">${option3}</label>
                                                        </div>
                                                    </div>
                                                    <div class="list-group-item list-group-item-action">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="answer${num}[]" value="4" id="flexRadioDefault4${num}" />
                                                            <label class="form-check-label stretched-link"
                                                                for="flexRadioDefault4${num}">${option4}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-wrapper d-flex justify-content-between flex-row-reverse">
                                        ${nextBlock} ${previous}
                                    </div>
                                </div>`;
                            $("#mcqHeader1-{{$key}}").append(steperDiv);
                            $("#mcqForm-{{$index}}-{{$key}}").append(stepcontain);
                            

                            num++;
                        });
                        // Show quiz pane
                        $('.mcqTab1-{{$key}}').addClass("active show");
                    } else if (response.code === 203) {
                        $("#test-last").addClass('bs-stepper-block fade active');
                        $(".score").html("Your score is : " + response.score + '%');
                    } else {
                        swal({
                            title: response.title,
                            text: response.message,
                            icon: response.icon,
                        }).then(function() {
                            window.location.href = baseUrl + "/admin/admin";
                        });
                    }
                },
            });
        });

        function nextStep(id, key) {

            var remove = id - 1;
            
            if (id === 1) {

                $("#test-start-"+ key).hide();
                $("#test-start-"+ key).removeClass('fade');
                $("#test-start-"+ key).removeClass('dstepper-block active');


            } else {
                $('#test-l-' + remove + '-' + key).removeClass('fade');
                $('#test-l-' + remove + '-' + key).removeClass('active show');
            }
            $('#test-l-' + id + '-' + key).addClass('active show');

        }

        function previousStep(id, key) {

            var remove = id - 1;
            $('#test-l-' + id + '-' + key).removeClass('fade');
            $('#test-l-' + id + '-' + key).removeClass('active show');
            $('#test-l-' + remove + '-' + key).addClass('active show');
        }
    </script>
    



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend/js/examJs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>



@endsection
