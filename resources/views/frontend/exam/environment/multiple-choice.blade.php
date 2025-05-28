<style>
    .score-container {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        display: inline-block;
        text-align: center;
        margin-top: 20px;
        box-shadow: 0px 3px 8px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .score {
        font-size: 1.8rem;
        margin-bottom: 0;
        font-weight: bold
    }

    .img-4by3-lg {
        width: 3.5rem;
    }


</style>

<div class="header">
    <nav class="navbar-default navbar navbar-expand-lg" style="background-color: #f1f5f9;box-shadow: none;">
        
        <a id="nav-toggle" href="#" class="color-blue fs-4 d-none">
            <button class="button is-text toggle-button" onclick="buttonToggleNew(this)">
                <div class="button-inner-wrapper">
                    <i class="bi bi-x toggle-icon" style="font-size: x-large"></i>
                </div>
            </button>
        </a>
        
        <a id="nav-toggle" href="#" class="color-blue fs-4">
            <button class="button is-text toggle-button" onclick="buttonToggleNew(this)">
                <div class="button-inner-wrapper">
                    <i class="bi bi-x toggle-icon" style="font-size: x-large"></i>
                </div>
            </button>
        </a>
        <div class="d-flex align-items-center justify-content-between ps-3">
            <div>
                <h3 class="mb-0 text-truncate-line-2 color-blue studentAssignmentTitle">
                    {{ isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : '' }}
                    ({{ isset($QuestionData[0]['percentage']) ? $QuestionData[0]['percentage'] : '' }}%)</h3>
            </div>

        </div>

    </nav>
</div>

<!-- Page Header -->


<!-- Container fluid -->
@if ($QuestionData[0]['exam_duration'] != '')

    @if (isset($QuestionData[0]['id']) &&
        is_exist('exam_remark_master', [
            'student_course_master_id' => $student_course_master_id,
            'user_id' => Auth::user()->id,
            // 'course_id' => $QuestionData[0]['award_id'],
            'exam_id' => $QuestionData[0]['id'],
            'exam_type' => 7,
            'attempt_remain' => 0,
            'is_active' => 1,
        ]) > 0)
        @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : ''])
    @else
        @php
            $studentCourseMaster = DB::table('student_course_master')
                ->where('id', $student_course_master_id)
                // ->where('user_id', Auth::id())
                // ->where('course_id', $QuestionData[0]['award_id'])
                // ->latest()
                ->first();

                [$hours, $minutes] = explode(':', $QuestionData[0]['exam_duration']);
                $total_seconds = $hours * 3600 + $minutes * 60;
                $examDuration = '';

                if ($hours > 0) {
                    $examDuration .= $hours . ' Hour';
                    if ($hours > 1) {
                        $examDuration .= 's';
                    }
                }

                if ($minutes > 0) {
                    if ($examDuration) {
                        $examDuration .= ' ';
                    }
                    $examDuration .= $minutes . ' minute';
                    if ($minutes > 1) {
                        $examDuration .= 's';
                    }
                }

                if ($examDuration === '') {
                    $examDuration = '0 minutes';
                }
        @endphp
        @if (isset($studentCourseMaster) && !empty($studentCourseMaster) && ($studentCourseMaster->exam_attempt_remain == '0' || $studentCourseMaster->exam_remark == '1'))
            @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : ''])
        @else
            <div class="container-fluid">
                <div class="card p-4 assignment-hour-instruction shadow-sm"
                    >
                    <h4>Exam Instructions</h4>
                    <ol class="exam_instructions">
                        <li class="exam_instructions_list">
                            <span class="instruction-title">Online Important Exam Instructions:</span>
                            Read each question carefully. Take your time to understand what is being asked before answering.
                        </li>
                        <li class="exam_instructions_list">
                            <span class="instruction-title">Camera and Screen Monitoring:</span>
                            You have <span class="highlight">{{$examDuration}}</span> to complete the examination. Be prepared to answer as many questions as possible.
                        </li>
                        <li class="exam_instructions_list">
                            <span class="instruction-title">Exam Duration:</span>
                            Once you start the exam, you cannot exit the exam interface until you have finished.
                        </li>
                        <li class="exam_instructions_list">
                            <span class="instruction-title">Attempt All Questions:</span>
                            Stay focused and minimize distractions. If you need assistance during the exam, use the chat feature to ask for help.
                        </li>
                        <li class="exam_instructions_list">
                            <span class="instruction-title">No Interruptions Allowed:</span>
                            Ensure that you attempt all questions to the best of your ability.
                        </li>
                    </ol>
                    <div class="d-flex justify-content-center ">
                        <a href="{{ route('examEnvironment', ['enc_id' => base64_encode($QuestionData[0]['award_id']), 'student_course_master_id' => base64_encode($student_course_master_id), 'exam_type' => base64_encode('7')]) }}"
                            class="btn btn-outline-primary rounded-0 startExamMCQ" 
                            id="startExamMCQBtn-{{$QuestionData[0]['award_id']}}-{{$index}}" 
                            >Start Exam</a>
                    </div>
                </div>
            </div>
        @endif
    @endif
@else
            
    @if (isset($QuestionData[0]['id']) &&
        is_exist('exam_remark_master', [
            'student_course_master_id' => $student_course_master_id,
            'user_id' => Auth::user()->id,
            // 'course_id' => $QuestionData[0]['award_id'],
            'exam_id' => $QuestionData[0]['id'],
            'exam_type' => 7,
            'attempt_remain' => 0,
            'is_active' => 1,
        ]) > 0)
        @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : ''])
    @else
        @php
            $studentCourseMaster = DB::table('student_course_master')
                ->where('id', $student_course_master_id)
                // ->where('user_id', Auth::id())
                // ->where('course_id', $QuestionData[0]['award_id'])
                // ->latest()
                ->first();
        @endphp
        @if (isset($studentCourseMaster) &&
            !empty($studentCourseMaster) &&
            ($studentCourseMaster->exam_attempt_remain == '0' || $studentCourseMaster->exam_remark == '1'))
            @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : ''])
        @else
            <section class="container-fluid ps-4 pe-3">
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
                                    <div class="bs-stepper-content">
                                        <form id="mcqForm-{{$index}}-{{$key}}" class="mcqForm" onSubmit="return false">
                                            <input type='hidden' id="course_id" name="course_id" vlaue="{{$QuestionData[0]['award_id']}}">
                                            <input type="hidden" name="master_course_id" id="master_course_id" value="{{ isset($master_course_id) ? base64_encode($master_course_id) : '' }}">
                                            <input type="hidden" name="student_course_master_id" id="student_course_master_id" value="{{base64_encode($student_course_master_id)}}">
                                            <input type="hidden" name="type" id="type" value="MCQ">
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
                                                            <p class="mb-0">Engage live or asynchronously with quiz and poll questions that participants complete at their own pace.</p>
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
            </section>
        @endif
    @endif
@endif

<script>
    // var mcqId = <?php echo $QuestionData[0]['id']; ?>;
    
    var courseId = <?php echo $QuestionData[0]['award_id']; ?>;
    var master_course_id = <?php echo isset($master_course_id) ? $master_course_id : 0; ?>;
    
    var student_course_master_id = <?php echo $student_course_master_id; ?>;
    var index = <?php echo $index; ?>;
    var key = <?php echo $key; ?>;

    var encodedStudentCourseMasterId = btoa(student_course_master_id);

    var form = $("#mcqForm-" + index + '-' + key);
    var mcqId = form.find('input[name="id"]').val();
    
    $(document).ready(function () {
        // $(".mcqActive").click();

        $(window).on('load', function () {
            // $('#startExamMCQBtn').show();
            
            var courseId = <?php echo $QuestionData[0]['award_id']; ?>;
            $('#startExamMCQBtn-'+courseId+'-'+index).show();
        });
        

        // $('.startExamMCQ').on('click', async function (event) {
        $(document).off('click', '.startExamMCQ').on('click', '.startExamMCQ', function (event) {

            event.preventDefault();
            localStorage.removeItem('examStartTime');
            let startExamButton = $(this);
            const url = startExamButton.attr('href');
            if (!startExamButton.data('clicked')) {
                startExamButton.data('clicked', true);
                    window.open(url, '_blank');
            }

            

            // if (courseId == master_course_id ) {
            //     encodedCourseId = btoa(courseId);
            // } else {
            //     encodedCourseId = btoa(master_course_id);
            // }

            
            if (master_course_id == 0) {
                encodedCourseId = btoa(courseId);
            } else {
                encodedCourseId = btoa(master_course_id);
            }

            // let newUrl = studentBaseUrl + '/exam/' + btoa(encId) + '/' + btoa(student_course_master_id);
            
            // let newUrl = `${studentBaseUrl}/exam/${$encodedCourseId}/${encodedStudentCourseMasterId}`;
            
            
            // window.location.replace(newUrl);
            
            setTimeout(function() {
                var studentBaseUrl = window.location.origin + "/student";

                let newUrl = `${studentBaseUrl}/exam/${encodedCourseId}/${encodedStudentCourseMasterId}`;
                window.location.replace(newUrl);
            }, 4000)
        });

        function startTimer(duration) {
            let timer = duration,
                hours, minutes, seconds;

            const updateDisplay = () => {
                hours = Math.floor(timer / 3600);
                minutes = Math.floor((timer % 3600) / 60);
                seconds = Math.floor(timer % 60);

                // Update timer values
                document.getElementById('hours').textContent = hours < 10 ? "0" + hours : hours;
                document.getElementById('minutes').textContent = minutes < 10 ? "0" + minutes : minutes;
                document.getElementById('seconds').textContent = seconds < 10 ? "0" + seconds : seconds;

                if (timer < 600) {
                    document.querySelectorAll('.timer-value, .timer-unit').forEach(card => {
                        card.style.color = 'red';
                    });
                } else {
                    document.querySelectorAll('.timer-value, .timer-unit').forEach(card => {
                        card.style.color = '#64748b';
                    });
                }

                // Show minus sign when timer is up
                if (timer < 0) {
                    clearInterval(countdown);
                    document.getElementById('minus-text').style.display = 'block';
                    document.getElementById('hours').textContent = "00";
                    document.getElementById('minutes').textContent = "00";
                    document.getElementById('seconds').textContent = "00";
                    alert("Time's up! Submitting your answers.");
                }
            };

            const countdown = setInterval(function() {
                updateDisplay();
                timer--;
            }, 1000);
        }
    });
</script>

@if ($QuestionData[0]['exam_duration'] == '')
    <script>
        
        var isClickable = true;
        $(".mcqActive-{{$key}}").on("click", function(event) {
            // alert('clicked');

            event.preventDefault();
            if (!isClickable) {
                return; // If not clickable, exit the function
            }
            isClickable = false;

            $("#test-start-{{$key}}").show();
            $('.newAddedPane-{{$key}}').remove();
            $("#mcqHeader1-{{$key}} .step").not(':first').remove();
            $('.newAddedPane-{{$key}}').removeClass('active show');
            $('.mcqTab1-{{$key}}').removeClass("active show"); 
        

            var studentBaseUrl = window.location.origin + "/student";
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            var mcqId = <?php echo $QuestionData[0]['id']; ?>;


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

                    setTimeout(function() {
                        isClickable = true;
                    }, 2000);
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
@endif
