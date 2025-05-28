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
        width: 80px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
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
    .exam_instructions {
            margin-left: 20px;
        }

        .exam_instructions_list {
            margin-bottom: 15px;
            line-height: 1.6;
        }

    .instruction-title{
        font-weight: bold;
        color: #000;
    }
    .highlight {
            font-weight: bold;
            color: #2b3990;
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
                    {{ isset($QuestionData[0]['assignment_tittle']) ? html_entity_decode($QuestionData[0]['assignment_tittle']) : '' }}
                    ({{ isset($QuestionData[0]['assignment_percentage']) ? $QuestionData[0]['assignment_percentage'] : '' }}%)
                </h3>
            </div>

        </div>
    </nav>

</div>


@if ($QuestionData[0]['exam_duration'] != '')

    @if (isset($QuestionData[0]['id']) &&
            is_exist('exam_remark_master', [
                'user_id' => Auth::user()->id,
                'course_id' => $QuestionData[0]['award_id'],
                'student_course_master_id' => $student_course_master_id,
                'exam_id' => $QuestionData[0]['id'],
                'exam_type' => 1,
                'attempt_remain' => 0,
                'is_active' => 1,
            ]) > 0)
        @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['assignment_tittle']) ? html_entity_decode($QuestionData[0]['assignment_tittle']) : ''])
    @else
        @php
            $studentCourseMaster = DB::table('student_course_master')
                ->where('id', $student_course_master_id)
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
            @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['assignment_tittle']) ? html_entity_decode($QuestionData[0]['assignment_tittle']) : ''])
        @else
            @if(session('duration_error'))
                <div class="alert alert-danger">
                    {{ session('duration_error') }}
                </div>
            @endif
    
            <div class="container-fluid">
                <div class="card p-4 assignment-hour-instruction"
                    style="box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); border-radius: 10px">
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
                        <a href="{{ route('examEnvironment', ['enc_id' => base64_encode($QuestionData[0]['award_id']), 'student_course_master_id' => base64_encode($student_course_master_id), 'exam_type' => base64_encode('1')]) }}"
                            class="btn btn-outline-primary rounded-0 startExam" id="startExamBtn-{{$QuestionData[0]['award_id']}}-{{$index}}"  style="display:none;">Start Exam</a>
                    </div>
                </div>
            </div>
        @endif
    @endif
@else
    <!-- Page Header -->
    @if (isset($QuestionData[0]['id']) &&
            is_exist('exam_remark_master', [
                'student_course_master_id' => $student_course_master_id,
                'user_id' => Auth::user()->id,
                'course_id' => $QuestionData[0]['award_id'],
                'exam_id' => $QuestionData[0]['id'],
                'exam_type' => 1,
                'attempt_remain' => 0,
                'is_active' => 1,
            ]) > 0)
        @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['assignment_tittle']) ? html_entity_decode($QuestionData[0]['assignment_tittle']) : '']);
    @else
        @php
            $studentCourseMaster = DB::table('student_course_master')
                ->where('id', $student_course_master_id)
                ->first();

            $assignmentAnswer = getData('exam_assignment_answers', ['answer'], ['student_course_master_id' => $student_course_master_id, 'course_id' => $QuestionData[0]['award_id'], 'is_active' => '1']);
        @endphp
        @if (isset($studentCourseMaster) && !empty($studentCourseMaster) && ($studentCourseMaster->exam_attempt_remain == '0' || $studentCourseMaster->exam_remark == '1'))
            @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['assignment_tittle']) ? html_entity_decode($QuestionData[0]['assignment_tittle']) : '']);
        @else
            <section class="container-fluid ps-5 pe-3 pt-2">

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        @php
                            echo isset($QuestionData[0]['instructions'])
                                ? html_entity_decode($QuestionData[0]['instructions'])
                                : '';
                            // $exam_assignments = getData('exam_assignments', ['enable_exam_feedback'], ['id' => $QuestionData[0]['id']]);
                            
                        @endphp
                    </div>
                    <?php $i = 0; ?>
                    <form id="assignExamFormData-{{$QuestionData[0]['award_id']}}-{{$index}}" class="assignExamFormData card p-4 mb-4">
                        <input type="hidden" name="exam_id" id="exam_id" value="{{ isset($QuestionData[0]['id']) ? base64_encode($QuestionData[0]['id']) : '' }}">
                        <input type="hidden" name="course_id" id="exam_id" value="{{ isset($QuestionData[0]['award_id']) ? base64_encode($QuestionData[0]['award_id']) : '' }}">
                        <input type="hidden" name="master_course_id" id="master_course_id" value="{{ isset($master_course_id) ? base64_encode($master_course_id) : '' }}">
                        <input type="hidden" name="student_course_master_id" id="student_course_master_id" value="{{ isset($student_course_master_id) ? base64_encode($student_course_master_id) : '' }}">
                        <input type="hidden" name="exam_type" id="exam_type" value="{{ base64_encode(1) }}">
                        <input type="hidden" name="type" id="type" value="Assignment">
                        <input type="hidden" name="index" id="index" value="{{$index}}">

                        @if (isset($QuestionData[0]['id']))
                            @foreach ($QuestionData[0]['assig_question'] as $key => $item)
                            
                                @php
                                    $draft_exam = getData('draft_exam', ['suggestion'], ['student_course_master_id' => $student_course_master_id, 'user_id' => Auth::user()->id, 'exam_id' => $QuestionData[0]['id'], 'exam_type' => '1', 'draft' => '1', 'is_active' => '1']);
                                @endphp
                                @if(isset($draft_exam[0]))
                                <label for="textarea-input" class="form-label mb-2">
                                    <i class="bi bi-lightbulb-fill fs-3"></i> Mentor's Suggestion for Improvement:
                                </label>
                                    {{-- <textarea rows="10" disabled>{{$draft_exam[0]->suggestion}}</textarea> --}}
                                    <div class="suggestion-box" style="background-color: #e9f7ff; border: 1px solid #b6d8f0; padding: 10px; border-radius: 5px;">
                                        <span>{{ $draft_exam[0]->suggestion }}</span>
                                    </div>

                                @endif

                                <div class="col-md-12 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <p class="fw-bold mb-1 mt-4" style="color: #333">Question {{ $key + 1 }}.</p>
                                        <p class="fw-bold mb-1 mt-4" style="color: #333"> [{{ $item['assignment_mark'] }} Marks ]</p>
                                    </div>
                                    <label for="textarea-input" class="form-label mb-0">
                                        <span class="color-blue"> </span>
                                       
                                        
                                        <span class="mb-0"> {!! $item['question'] !!}</span>
                                    </label>

                                    <input type="hidden" name="question_id[]" id="question_id" value="{{ base64_encode($item['id']) }}">
                                    
                                    

                                    <input type="hidden" name="answer_limit[]" id="answer_limit"
                                        value="{{ base64_encode($item['answer_limit']) }}">
                                    <h5>Answer:</h5>
                                    <textarea class="form-control mb-0" id="textarea-input" rows="10" name="answers[]">{{isset($assignmentAnswer[0]) ? $assignmentAnswer[0]->answer : ''}} </textarea>
                                    <small>(The answer for question may not be greater than {{ $item['answer_limit'] }}
                                        words.)</small>
                                    <div class="invalid-feedback" id="answer_error_{{ $i }}">The answer
                                        for question may not be greater than {{ $item['answer_limit'] }} words.</div>
                                </div>
                                <?php $i++; ?>
                            @endforeach
                        @endif
                        <div class="col-12 mb-6 text-center">
                            <button type="button" class="btn btn-primary" data-bs-target="#instructionModal-{{$QuestionData[0]['award_id']}}-{{$index}}" data-bs-toggle="modal">Submit Now</button>
                            @if(!empty($QuestionData[0]['enable_draft_mode']) && $QuestionData[0]['enable_draft_mode'] == 1)
                                <button type="button" class="btn btn-secondary draftAssignmentExam"
                                data-action="draft" data-index="{{$index}}" 
                                data-course-id="{{$QuestionData[0]['award_id']}}">
                                Save as Draft
                                </button>
                            @endif
                        
                        </div>
                    </form>
                </div>
            </section>
            
            @include('frontend.exam.environment.declaration-form', [
                'modalId' => 'instructionModal-' . $QuestionData[0]['award_id'] . '-' . $index,
                'exam_name' => isset($QuestionData[0]['assignment_tittle']) 
                    ? html_entity_decode($QuestionData[0]['assignment_tittle']) 
                    : 'assessment',
                'submit_button_class' => 'submitAssignExam',
                'extraRequirement' => ' data-index="' . e($index) . '" data-course-id="' . e($QuestionData[0]['award_id']) . '" data-action="submit"'
            ])



            {{-- <div class="modal fade" id="instructionModal-{{$QuestionData[0]['award_id']}}-{{$index}}" aria-hidden="true"
                aria-labelledby="instructionModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="instructionModalToggleLabel">Important Instructions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4 class="mb-1 color-blue">Assignment Checklist:</h4>
                            <ol class="mt-3">
                                <li class="mb-1 fs-5">
                                    <span>I have addressed all parts of the assignment.</span>
                                </li>
                                <li class="mb-1 fs-5">
                                    <span>My argument would be clear and unambiguous to any reader.</span>
                                </li>
                                <li class="mb-1 fs-5">
                                    <span>My paragraphs are organised logically and help advance my argument.</span>
                                </li>
                                <li class="mb-1 fs-5">
                                    <span>I use a variety of evidence (academic papers, case examples, current affairs
                                        etc) to reinforce my arguments.</span>
                                </li>
                                <li class="mb-1 fs-5">
                                    <span>My conclusion summarises my argument and explores its implications, it does
                                        not simply restate the topic paragraph.</span>
                                </li>
                                <li class="mb-1 fs-5">
                                    <span>I have proofread my paper carefully.</span>
                                </li>
                                <li class="mb-1 fs-5">
                                    <span>My student identifier in on the top of the page.</span>
                                </li>
                                <li class="mb-1 fs-5">
                                    <span>I have not used anyone else’s work or ideas without citing them
                                        appropriately.</span>
                                </li>
                                <li class="mb-1 fs-5">
                                    <span>All my sources are clearly referenced.</span>
                                </li>
                            </ol>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary submitAssignExam" data-bs-dismiss="modal" aria-label="Close" data-index="{{$index}}" data-course-id="{{$QuestionData[0]['award_id']}}" data-action="submit">Final Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        @endif
    @endif

@endif


<script>
    // var courseId = <?php echo $QuestionData[0]['award_id']; ?>;

    $(document).ready(function() {

        var course_id = <?php echo isset($QuestionData[0]['award_id']) ? $QuestionData[0]['award_id'] : 0; ?>;
        var index = <?php echo isset($index) ? $index : 0; ?>;
        
        $(window).on('load', function () {
            $('#startExamBtn'+'-'+course_id+'-'+index).show();
        });

        $('.startExam').on('click', async function (event) {


            var courseId = <?php echo isset($master_course_id) ? $master_course_id : (isset($QuestionData[0]['award_id']) ? $QuestionData[0]['award_id'] : ''); ?>;
            var student_course_master_id = <?php echo $student_course_master_id; ?>;

            var encodedCourseId = btoa(courseId); 
            var encodedStudentCourseMasterId = btoa(student_course_master_id);
            
            event.preventDefault();        
            localStorage.removeItem('examStartTime');
            const startExamButton = $(this);
            
            // const url = startExamButton.attr('href');
            // window.open(url, '_blank');


            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                const devices = await navigator.mediaDevices.enumerateDevices();
                const hasCamera = devices.some(device => device.kind === 'videoinput');

                if (!hasCamera) {
                    swal({
                        title: "No Camera Found",
                        text: "It seems that your device does not have a camera. Please check your device settings or connect an external camera to proceed with the exam.",
                        icon: "error",
                        buttons: {
                            confirm: {
                                text: "OK",
                                value: true,
                                visible: true,
                                className: "",
                                closeModal: true
                            }
                        }
                    });
                    return; 
                }

                try {
                    const mediaStream = await navigator.mediaDevices.getUserMedia({ video: true });
                    const video = document.createElement('video');
                    video.srcObject = mediaStream;
                    video.play();

                    // Wait for video to load and play
                    video.addEventListener('loadeddata', function () {
                        const canvas = document.createElement('canvas');
                        canvas.width = 640;
                        canvas.height = 480;
                        const context = canvas.getContext('2d');

                        // Function to capture a frame
                        function captureFrame() {
                            context.drawImage(video, 0, 0, canvas.width, canvas.height);
                            return context.getImageData(0, 0, canvas.width, canvas.height).data;
                        }

                        // Capture the first frame
                        const initialFrame = captureFrame();

                        // Wait 1 second and capture the second frame to compare
                        setTimeout(function () {
                            const secondFrame = captureFrame();

                            // Function to check if a frame is blank (all pixels are zero)
                            function isBlankFrame(frameData) {
                                return frameData.every(channel => channel === 0);
                            }

                            // Function to check if two frames are identical
                            function framesAreIdentical(frame1, frame2) {
                                return frame1.every((val, index) => val === frame2[index]);
                            }

                            const blankInitial = isBlankFrame(initialFrame);
                            const blankSecond = isBlankFrame(secondFrame);
                            const framesIdentical = framesAreIdentical(initialFrame, secondFrame);

                            if (blankInitial || blankSecond || framesIdentical) {
                                swal({
                                    title: "Camera Access Error",
                                    text: "Camera detected, but it is not providing a valid video stream. Please check your camera settings or reconnect your camera.",
                                    icon: "error",
                                    buttons: {
                                        confirm: {
                                            text: "OK",
                                            value: true,
                                            visible: true,
                                            className: "",
                                            closeModal: true
                                        }
                                    }
                                });
                                return;
                            }
                            
                            // const url = startExamButton.attr('href');
                            // window.open(url, '_blank'); 
                            
                            // var studentBaseUrl = window.location.origin + "/student";
                            // let newUrl = studentBaseUrl + '/exam/' + btoa(courseId) + '/' + btoa(student_course_master_id);
                            // window.location.replace(newUrl);

                            const url = startExamButton.attr('href');
                            window.open(url, '_blank');
                            
                            // var studentBaseUrl = window.location.origin + "/student";
                            // let newUrl = `${studentBaseUrl}/exam/${encodedCourseId}/${encodedStudentCourseMasterId}`;
                            // window.location.replace(newUrl);
                            
                            setTimeout(function() {
                                var studentBaseUrl = window.location.origin + "/student";

                                let newUrl = `${studentBaseUrl}/exam/${encodedCourseId}/${encodedStudentCourseMasterId}`;
                                window.location.replace(newUrl);
                            }, 4000)

                        }, 1000);
                    });


                } catch (error) {
                    swal({
                        title: "Camera Access Required",
                        text: "Camera access is required to proceed with the exam.",
                        icon: "error",
                        buttons: {
                            confirm: {
                                text: "OK",
                                value: true,
                                visible: true,
                                className: "",
                                closeModal: true
                            }
                        }
                    });
                }
            } else {
                swal({
                    title: "Browser Not Supported",
                    text: "Your browser does not support camera access. Please use a different browser.",
                    icon: "warning",
                    buttons: {
                        confirm: {
                            text: "OK",
                            value: true,
                            visible: true,
                            className: "",
                            closeModal: true
                        }
                    }
                });
            }
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
