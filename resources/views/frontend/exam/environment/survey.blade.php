<style>
    .filepond--file {
        position: relative;
    }
    .filepond--progress-bar {
        height: 5px;
        background: #2b3990;
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        transition: width 0.2s ease;
    }
    .filepond--file-status-info {
        display: none;
    }

    #progress-bar {
        height: 100%;
        background: #007bff;
        width: 0;
        transition: width 0.2s ease;
    }
    .filepond--root {
        height: 79px;
        border-radius: 0;
    }surveyExamFormData
    .filepond--drop-label {
        background: #f6f6f6 !important;
    }
    .custom-form-container {
        padding: 20px;
        /* border: 1px solid #e0e0e0 !important; */
        border-radius: 8px !important;
        background-color: #fff !important;
        /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important; */
    }
    .custom-file-input {
        display: block !important;
    }
    .filepond--credits {
        display: none !important;
    }
    .questionTitleSurvey p{
        margin-bottom: 0px;
        color: rgb(31, 31, 31);
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

@if (isset($QuestionData[0]['id']) &&
        is_exist('exam_remark_master', [
            'student_course_master_id' => $student_course_master_id,
            'user_id' => Auth::user()->id,
            // 'course_id' => $QuestionData[0]['award_id'],
            'exam_id' => $QuestionData[0]['id'],
            'exam_type' => 8,
            'attempt_remain' => 0,
            'is_active' => 1,
        ]) > 0)
    @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : '']);
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
        @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : '']);
    @else

        <!-- Container fluid -->
        <section class="container-fluid px-4 pt-2">
            <div class="col-md-12 mb-3">
                @php
                    echo isset($QuestionData[0]['instructions']) ? html_entity_decode($QuestionData[0]['instructions']) : '';
                @endphp
                @if (isset($QuestionData[0]['instrcution_file_url']) && !empty($QuestionData[0]['instrcution_file_url']) && Storage::disk('local')->exists($QuestionData[0]['instrcution_file_url']))
                    <a href="{{Storage::disk('local')->url($QuestionData[0]['instrcution_file_url'])}}" download="E-Ascencian Jd (Exam)"> Download job description from here JD.pdf <i class="fe fe-download fs-5"></i></a>
                @endif
            </div>

            <div class="card">
                <div class="card-body">
                    {{-- <h3 class="card-title">Survey</h3> --}}
                    <form id="surveyExamFormData-{{$QuestionData[0]['award_id']}}-{{$index}}" class="surveyExamFormData" enctype="multipart/form-data">
                        <div class="custom-file-container mb-2 custom-form-container">
                            @php
                                $i = 0;
                            @endphp
                            @if(isset($QuestionData[0]['survey_question']))
                                @foreach ($QuestionData[0]['survey_question'] as $key => $item)
                                    <div class="col-md-12 mb-3">
                                            @php
                                                $decodedQuestion = isset($item['question']) ? html_entity_decode($item['question']) : '';
                                            @endphp
                                            <div class="d-flex justify-content-between">
                                                <span class="color-blue fw-semibold mb-0">Question: <span class="questionTitleSurvey"> {!! $decodedQuestion !!} </span></span>
                                                {{-- <p class="color-blue fw-semibold mb-0">Question: {{ isset($item['question']) ? strip_tags($item['question']) : '' }}</p> --}}
                                                <p class="color-blue fw-semibold mb-0" style="white-space: pre">[{{ isset($item['marks']) ? $item['marks'] : '' }} Marks]</p>
                                            </div>
                                          
                                        @foreach ($item['input_configurations'] as $ind => $inputConfiguration)
                                            @php
                                                $mimes = isset($inputConfiguration['mimes']) ? $inputConfiguration['mimes'] : '*/*';
                                                $mimePrefix = 'application';
                                                if (in_array($mimes, ['mp4', 'avi', 'mov'])) {
                                                    $mimePrefix = 'video';
                                                } elseif (in_array($mimes, ['png', 'jpg', 'jpeg', 'gif'])) {
                                                    $mimePrefix = 'image';
                                                }
                                                $maxSize = isset($inputConfiguration['max_size']) ? $inputConfiguration['max_size'] : 'unknown size';
                                            @endphp

                                            {{-- <label for="textarea-input" class="form-label">{{isset($inputConfiguration['label_name']) ? $inputConfiguration['label_name'] : '' }}</label> --}}
                                            <label for="textarea-input" class="form-label">
                                                {{ isset($inputConfiguration['label_name']) ? $inputConfiguration['label_name'] : '' }}
                                                @if(isset($inputConfiguration['is_required']) && $inputConfiguration['is_required'] == 1)
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <label class="input-container">
                                                <div class="filepond--root">
                                                    <input 
                                                        type="file" 
                                                        class="custom-file-input filepond" 
                                                        name="survey_file[{{$inputConfiguration['id']}}]" 
                                                        id="survey_file_{{$inputConfiguration['id']}}"
                                                        data-id="{{$inputConfiguration['id']}}"
                                                        accept="{{ $mimePrefix }}/{{ $mimes }}" 
                                                        data-max-size="{{ $maxSize}}"
                                                        {{$inputConfiguration['is_required'] == 1 ? 'required' : ''}}
                                                    >

                                                    <div class="invalid-feedback" id="survey_file_{{$inputConfiguration['id']}}" style="font-size: 14px"></div>
                                                </div>
                                                
                                            </label>
                                            <br>
                                            <br>
                                            <small>
                                                (The file must be in {{ strtoupper($mimes) }} format and less than {{ $maxSize }}MB)
                                            </small>
                                            <br>
                                            <br>
                                        @endforeach

                                        <div class="invalid-feedback" id="file_error_{{ $i }}">Please upload file.</div>

                                        <input type="hidden" name="question_id[]" id="question_id" value="{{ base64_encode($item['id']) }}">
                                        <input type="hidden" name="answer_limit[]" id="answer_limit" value="{{ base64_encode($item['answer_limit']) }}">
                                        <input type="hidden" name="exam_id" class="form-control" value="{{ isset($QuestionData[0]['id']) ? base64_encode($QuestionData[0]['id']) : 0 }}">
                                        <input type="hidden" name="course_id" class="form-control" value="{{ isset($QuestionData[0]['award_id']) ? base64_encode($QuestionData[0]['award_id']) : '' }}">
                                        <input type="hidden" name="master_course_id" id="master_course_id" value="{{ isset($master_course_id) ? base64_encode($master_course_id) : '' }}">
                                        <input type="hidden" name="student_course_master_id" id="student_course_master_id" value="{{base64_encode($student_course_master_id)}}">
                                        <input type="hidden" name="type" id="type" value="Survey">
                                        <input type="hidden" name="index" id="index" value="{{$index}}">


                                        <textarea class="form-control mt-3" placeholder="Write you answer here..." rows="8" name="answers[]" ></textarea>
                                        <small>(The answer for question may not be greater than {{ $item['answer_limit'] }}
                                            words.)</small>
                                        <div class="invalid-feedback" id="answer_errors_{{ $i }}">The answer for question may not be greater than {{ $item['answer_limit'] }} words.</div>
                                    </div>

                                    <?php $i++; ?>
                                @endforeach
                            @endif
                            
                            <button type="button" class="btn btn-primary  mt-3 d-block" id="submitButton" data-bs-target="#instructionModal-{{$QuestionData[0]['award_id']}}-{{$index}}" data-bs-toggle="modal">Submit Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        @include('frontend.exam.environment.declaration-form', [

            'modalId' => 'instructionModal-' . $QuestionData[0]['award_id'] . '-' . $index,
            'exam_name' => isset($QuestionData[0]['tittle']) 
                ? html_entity_decode($QuestionData[0]['tittle']) 
                : 'Reflective Journal',
            'submit_button_class' => 'submitSurveyExam',
            'extraRequirement' => ' data-index="' . e($index) . '" data-course_id="' . e($QuestionData[0]['award_id']) . '" data-action="submit"'
        ])
    @endif
@endif
    

<!-- FilePond Library -->
<link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>

<script>
    
    // Array to store all FilePond instances
    // let filePondInstances = [];
    if (typeof filePondInstances === 'undefined') {
        var filePondInstances = [];
    }

    // Register FilePond plugin for file type validation
    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Initialize FilePond instances for each input element with the `filepond` class
    document.querySelectorAll('.filepond').forEach(inputElement => {
        
        // const maxSize = inputElement.getAttribute('data-max-size');
        const maxSize = parseFloat(inputElement.getAttribute('data-max-size')) * 1024 * 1024;
        
        const pondInstance = FilePond.create(inputElement, {
            acceptedFileTypes: ['application/pdf'],
            allowMultiple: false,
            maxFileSize: maxSize,
            fileSizeBase: 1024,
            server: {
                process: (fieldName, file, metadata, load, error, progress) => {
                    const reader = new FileReader();
                    reader.onload = () => {
                        let progressValue = 0;
                        const interval = setInterval(() => {
                            progressValue += 25;
                            progress(progressValue / 100);
                            if (progressValue >= 100) {
                                clearInterval(interval);
                                load(reader.result);
                            }
                        }, 300);
                    };
                    reader.onerror = () => error('Error reading file');
                    reader.readAsDataURL(file);
                }
            }
        });
        
        // Push each instance to the array
        filePondInstances.push(pondInstance);

        pondInstance.on('addfile', (error, file) => {
            if (file && file.fileSize > maxSize) {
                submitButton.disabled = true;
            } else {
                checkFileSizeAndToggleSubmitButton();
            }
        });
        
        pondInstance.on('removefile', () => {
            checkFileSizeAndToggleSubmitButton();
        });

        function checkFileSizeAndToggleSubmitButton() {
            const submitButton = document.getElementById('submitButton');
            let isDisabled = false;
    
            const files = pondInstance.getFiles();
            files.forEach(file => {
                if (file.fileSize > maxSize) {
                    isDisabled = true;
                }
            });
        
            submitButton.disabled = isDisabled;
        }
    });
    
</script>

