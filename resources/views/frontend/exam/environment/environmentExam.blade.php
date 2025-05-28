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
            background-color: #ffffff;
            color: #024791;
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
    </style>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}


    @php
        $QuestionData = $examDetails[$index]['assignment_exam'];
        [$hours, $minutes] = explode(':', $QuestionData[0]['exam_duration']);
        $total_seconds = $hours * 3600 + $minutes * 60;
        $examAttemptTime = getData(
            'exam_assignment_answers',
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
                    <div class="d-flex justify-content-center flex-wrap">
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

            <div>
                <?php $i = 0; ?>

                <video id="video" width="640" height="480" autoplay style="display:none;"></video>
                <canvas id="canvas" width="640" height="480" style="display:none;"></canvas>
                <form id="assignExamFormData-{{$QuestionData[0]['award_id']}}-{{$index}}" class="assignExamFormData" id="examForm" enctype="multipart/form-data"  style="display:none;">
                    <input type="hidden" id="snapshots" name="snapshots[]" value="">
                    <input type="hidden" name="exam_id" id="exam_id" value="{{ isset($QuestionData[0]['id']) ? base64_encode($QuestionData[0]['id']) : '' }}">
                    <input type="hidden" name="course_id" id="course_id" value="{{ isset($QuestionData[0]['award_id']) ? base64_encode($QuestionData[0]['award_id']) : '' }}">
                    <input type="hidden" name="student_course_master_id" id="student_course_master_id" value="{{base64_encode($student_course_master_id)}}">
                    <input type="hidden" name="exam_type" id="exam_type" value="{{ base64_encode(1) }}">
                    <input type="hidden" name="type" id="type" value="Assignment">
                    <input type="hidden" name="index" id="index" value="{{$index}}">
                    
                    @if (isset($QuestionData[0]['id']))
                        @foreach ($QuestionData[0]['assig_question'] as $key => $item)
                            <div class="col-md-12 mb-5 mt-5 question-container" data-word-limit="{{ $item['answer_limit'] }}">
                                <label for="textarea-input" class="form-label ">
                                    <span class="color-blue"> </span>
                                    {!! $item['question'] !!} [{{ $item['assignment_mark'] }} Marks]
                                </label>
                                <input type="hidden" name="question_id[]" id="question_id"
                                    value="{{ base64_encode($item['id']) }}">
                                <input type="hidden" name="answer_limit[]" id="answer_limit"
                                    value="{{ base64_encode($item['answer_limit']) }}">
                                <h6>Answer:</h6>
                                {{-- <textarea class="form-control shadow-none" id="textarea-input-{{ $i }}" rows="10" name="answers[]"> </textarea>
                                <small>(The answer for question may not be greater than {{ $item['answer_limit'] }}
                                    words.)</small>
                                <div class="invalid-feedback" id="answer_error_{{ $i }}">The answer for question
                                    may not be greater than {{ $item['answer_limit'] }} words.</div> --}}

                                <textarea class="form-control shadow-none" id="textarea-input-{{ $i }}" rows="10" name="answers[]"></textarea>
                                <small>(The answer for question may not be greater than {{ $item['answer_limit'] }} words.)</small>
                                <div class="invalid-feedback" id="answer_error_{{ $i }}">
                                    The answer for question may not be greater than {{ $item['answer_limit'] }} words.
                                </div>
                            </div>
                            <?php $i++; ?>
                        @endforeach
                    @endif
                    @if ($timeDifferenceInSeconds >= $total_seconds)
                        <div class="col-12 mb-6 text-center">
                            <button type="button" class="btn btn-primary finalsubmitTime"
                                data-bs-target="#instructionModal-{{$QuestionData[0]['award_id']}}-{{$index}}" data-bs-toggle="modal">Submit Now</button>
                        </div>
                    @else
                        <p class="text-danger">You have already submitted the exam.</p>
                    @endif
                </form>
                <div id="afterSetup">Please wait a few moments while we set up your exam environment. This process ensures everything is ready for a smooth experience. Thank you for your patience!</div>
            </div>
        </div>
    </div>

    @include('frontend.exam.environment.declaration-form', [
        'modalId' => 'instructionModal-' . $QuestionData[0]['award_id'] . '-' . $index,
        'exam_name' => isset($QuestionData[0]['assignment_tittle']) 
            ? html_entity_decode($QuestionData[0]['assignment_tittle']) 
            : 'assessment',
        'submit_button_class' => 'submitAssignExam',
        'extraRequirement' => ' data-index="' . e($index) . '" data-course-id="' . e($QuestionData[0]['award_id']) . '" data-action="submit"'
    ])

    {{-- <div class="modal fade" id="instructionModal-{{$index}}" aria-hidden="true" aria-labelledby="instructionModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-4 text-white" id="instructionModalToggleLabel">Important Instructions</h5>
                    <span data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer"><i class="bi bi-x"
                            style="font-size: 2rem"></i></span>

                </div>
                <div class="modal-body">
                    <h5 class="mb-1 color-white fs-4">Assignment Checklist:</h5>
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
                            <span>I use a variety of evidence (academic papers, case examples, current affairs etc) to
                                reinforce my arguments.</span>
                        </li>
                        <li class="mb-1 fs-5">
                            <span>My conclusion summarises my argument and explores its implications, it does not simply
                                restate the topic paragraph.</span>
                        </li>
                        <li class="mb-1 fs-5">
                            <span>I have proofread my paper carefully.</span>
                        </li>
                        <li class="mb-1 fs-5">
                            <span>My student identifier in on the top of the page.</span>
                        </li>
                        <li class="mb-1 fs-5">
                            <span>I have not used anyone else’s work or ideas without citing them appropriately.</span>
                        </li>
                        <li class="mb-1 fs-5">
                            <span>All my sources are clearly referenced.</span>
                        </li>
                    </ol>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary submitAssignExam" data-bs-dismiss="modal" aria-label="Close" data-index="{{$index}}" data-course-id="{{$QuestionData[0]['award_id']}}">Final
                            Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Modal for Time Up -->
    <div class="modal fade" id="timeUpModal" aria-hidden="true" aria-labelledby="timeUpModalLabel" tabindex="-1"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-4 text-white" id="timeUpModalLabel">Time is Up!</h5>
                </div>
                <div class="modal-body">
                    <p>Your time is up! The exam will be automatically submitted in <span id="countdownTimer">3</span> seconds.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        awardId = atob($('#course_id').val());
        index = $('#index').val();
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

        function startTimer(duration) {
            var timer = duration, hours, minutes, seconds;
            var interval = setInterval(function() {
                hours = parseInt(timer / 3600, 10);
                minutes = parseInt((timer % 3600) / 60, 10);
                seconds = parseInt(timer % 60, 10);

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                document.getElementById('hours').textContent = hours;
                document.getElementById('minutes').textContent = minutes;
                document.getElementById('seconds').textContent = seconds;

                if (--timer < 0) {
                    clearInterval(interval);
                    // $('#timeUpModal').modal('show');
                    // var countdown = 3;
                    var submitTimeout;
                    // $('#countdownTimer').text(countdown);
                    // var countdownInterval = setInterval(function() {
                        // countdown--;
                        // $('#countdownTimer').text(countdown);

                        // if (countdown === 0) {
                            // clearInterval(countdownInterval);
                            // $('.submitAssignExam').click();

                            // $('#timeUpModal').modal('hide'); 

                            let instructionModal = $("#instructionModal-" + awardId + "-" + index);
                            instructionModal.modal("show"); // Show modal when countdown hits 0

                            $("#modalCloseBtn").addClass("d-none");
                            $("#countdownContainer").removeClass("d-none");

                            // Reset countdown in modal
                            let modalCountdown = 15;
                            $("#modalCountdownTimer").text(modalCountdown);

                            let modalCountdownInterval = setInterval(function () {
                                modalCountdown--;
                                $("#modalCountdownTimer").text(modalCountdown);

                                if (modalCountdown <= 0) {
                                    clearInterval(modalCountdownInterval);
                                    instructionModal.find(".submitAssignExam").trigger("click"); // Auto-submit after 15 sec
                                }
                            }, 1000);

                            // let instructionModal = $("#instructionModal-" + awardId + "-" + index);
                            // instructionModal.modal("show");

                            // // Start 15-sec auto-submit timer
                            // clearTimeout(submitTimeout);
                            // submitTimeout = setTimeout(function () {
                            //     instructionModal.find(".submitAssignExam").trigger("click");
                            // }, 15000);
                        // }
                    // }, 1000);
                }
            }, 1000);
            
            $('#timeUpModal').modal({
                backdrop: 'static',
                keyboard: false
            });
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
                    // $('#timeUpModal').modal('show');
                    // setTimeout(function() {
                    //     $('.submitAssignExam').click();
                    // }, 5000);
                    
                    let instructionModal = $("#instructionModal-" + awardId + "-" + index);
                    instructionModal.modal("show"); // Show modal when countdown hits 0

                    $("#modalCloseBtn").addClass("d-none");
                    $("#countdownContainer").removeClass("d-none");

                    // Reset countdown in modal
                    let modalCountdown = 15;
                    $("#modalCountdownTimer").text(modalCountdown);

                    let modalCountdownInterval = setInterval(function () {
                        modalCountdown--;
                        $("#modalCountdownTimer").text(modalCountdown);

                        if (modalCountdown <= 0) {
                            clearInterval(modalCountdownInterval);
                            instructionModal.find(".submitAssignExam").trigger("click"); // Auto-submit after 15 sec
                        }
                    }, 1000);
                }
            } else {
                localStorage.setItem('examStartTime', Math.floor(Date.now() / 1000));
                startTimer(timerDuration);
            }
        }

        // window.addEventListener("beforeunload", function(event) {
        //     if (!isFormSubmitted) {
        //         var confirmationMessage = 'You have unsaved changes. Are you sure you want to leave?';
        //         event.returnValue = confirmationMessage;
        //         return confirmationMessage;
        //     }
        // });


        $(document).on('click', '.submitAssignExam', function() {
            $('.finalsubmitTime').prop('disabled', true);
        });

        $(document).ready(function () {
            var video = document.getElementById('video');
            var canvas = document.getElementById('canvas');
            var hiddenInput = document.getElementById('snapshots');
            var snapshotContainer = document.getElementById('snapshotContainer');
            var snapshotsArray = [];
            var stream;
            var examForm = $('.submitAssignExam');  // Form element for exam submission
            var examSubmitted = false;  // Track if the exam has already been submitted
            var autoSubmitTimeout;  // Timeout ID for automatic exam submission
            let initialSnapshotTaken = false; 
            window.addEventListener("beforeunload", handleBeforeUnload);

            async function checkCameraPermissions() {
                try {
                    const permissionStatus = await navigator.permissions.query({ name: 'camera' });
                    if (permissionStatus.state === 'denied') {
                        showModal("Camera Access Denied", "Camera access is required to proceed. Please enable the camera.");
                        return false;
                    }
                    return true;
                } catch (error) {
                    console.error("Error checking camera permissions: ", error);
                    return false;
                }
            }

            async function startCamera() {
                const hasPermission = await checkCameraPermissions();
                if (!hasPermission) return;

                try {
                    stream = await navigator.mediaDevices.getUserMedia({ video: true });
                    video.srcObject = stream;
                    video.play();

                    if (!initialSnapshotTaken) {
                        video.addEventListener('loadeddata', function() {
                            setTimeout(() => {
                                takeSnapshot();
                            }, 500);
                        });
                        initialSnapshotTaken = true;  
                    }
                } catch (err) {
                    console.error("Error accessing the camera: ", err);
                    showModal("Camera Access Denied", "Camera access is required to proceed.");
                }
            }

            function stopCamera() {
                if (stream) {
                    let tracks = stream.getTracks();
                    tracks.forEach(track => track.stop());
                    stream = null;
                }
            }

            function takeSnapshot() {
                var context = canvas.getContext('2d');
                context.drawImage(video, 0, 0, 640, 480);

                var imageData = canvas.toDataURL('image/png');
                
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                var courseId = $('#course_id').val();
                var examType = $('#exam_type').val();

                $.ajax({
                    url: '/save-snapshot',
                    method: 'POST',
                    data: {
                        snapshot: imageData,
                        course_id: courseId,
                        exam_type: examType 
                    },
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function(response) {
                    },
                    error: function(err) {
                    }
                });
            }
            
            $(window).on('load', function () {
                $('.assignExamFormData').show();
                $('#afterSetup').hide();
            });

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


            // Automatically submit exam after 10 seconds when the browser is closed
            function autoSubmitExam() {
                if (!examSubmitted) {
                    if (autoSubmitTimeout) {
                        clearTimeout(autoSubmitTimeout);  // Clear existing timeout if any
                    }

                    autoSubmitTimeout = setTimeout(function () {
                        $('.submitAssignExam').click();  // Submit the exam
                        examSubmitted = true;
                        stopSnapshotInterval();  // Stop taking snapshots
                    }, 10000);  // 10 seconds delay
                }
            }

            // Cancel the auto-submit if the user returns within 10 seconds
            function cancelAutoSubmitExam() {
                clearTimeout(autoSubmitTimeout);
            }

            function stopSnapshotInterval() {
                clearInterval(snapshotInterval);
            }

            window.addEventListener('focus', function () {
                cancelAutoSubmitExam();
            });

            // Start the camera initially
            startCamera();
            
            window.onload = function() {
                initializeTimer();
                setInterval(takeSnapshot, 15 * 60 * 1000);
            };

            
            $('.question-container').on('input', 'textarea', function() {
                const $textarea = $(this);
                const wordLimit = parseInt($textarea.closest('.question-container').data('word-limit'));
                const $errorFeedback = $textarea.siblings('.invalid-feedback');

                let words = $textarea.val().trim().split(/\s+/);
                let wordCount = words.filter(word => word.length > 0).length;

                if (wordCount >= wordLimit) {
                    let wordsTrimmed = $textarea.val().trim().split(/\s+/).slice(0, wordLimit).join(' ');
                    $textarea.val(wordsTrimmed);
                    $errorFeedback.show();
                } else {
                    $errorFeedback.hide();
                }
            });
            
            $(document).on("change", "#instruction_check", function () {
                let modal = $(this).closest(".modal-content");
                let isChecked = $(this).prop("checked");
                modal.find("#acceptButton").attr("data-instruction", isChecked ? "true" : "false");
                modal.find("#acceptButton").prop("disabled", !isChecked);
            });
            $(".modal-content").each(function () {
                let modal = $(this);
                modal.find("#acceptButton").attr("data-instruction", "false").prop("disabled", true);
            });
        });



    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend/js/examJs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>



@endsection
