<style>
    #video-preview {
        margin-top: 20px;
        background: #000;
    }
    #preview-video{
        height: 500px;
    }
    video {
        max-width: 100%;
        height: auto;
    }
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
    #progress-bar-container {
        margin-top: 2rem;
        height: 5px;
        background: #e9ecef;
        position: relative;
    }
    #progress-bar {
        height: 100%;
        background: #007bff;
        width: 0;
        transition: width 0.2s ease;
    }
    .filepond--root{
        height: 79px;
        border-radius: 0;
    }
    .filepond--drop-label{
        background: #f6f6f6 !important;
    }
    .filepond--list-scroller{
        min-height: 60px;
    }
    .custom-form-container{
        padding: 20px !important;
        border: 1px solid #e0e0e0 !important;
        border-radius: 8px !important;
        background-color: #fff !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
    }
    .vlogjobDesc{
        background: #ffffff;
        padding: 10px;
        border-radius: 8px;
        display: inline-block;
        font-weight: 600;
    }
    .custom-file-input{
        display: block !important;
    }
    .filepond--credits {
        display: none !important;
    }

    .vlog_ementor_question_title p{
        margin-bottom: 0px;
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
                <h3 class="mb-0 text-truncate-line-2 color-blue studentAssignmentTitle">{{isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : '' }} ({{isset($QuestionData[0]['percentage']) ? $QuestionData[0]['percentage'] : 0 }}%)</h3>
            </div>
        </div>

    </nav>
</div>

<!-- Page Header -->


<!-- Container fluid -->
@if (isset($QuestionData[0]['id']) && is_exist('exam_remark_master', ['user_id' => Auth::user()->id, 'course_id' => $QuestionData[0]['award_id'],  'student_course_master_id' => $student_course_master_id, 'exam_id' => $QuestionData[0]['id'], 'exam_type' => 3, 'attempt_remain' => 0, 'is_active' => 1 ]) > 0)
    @include('frontend.exam.environment.submitted-successfully',['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : '']);
@else
    @php
        $studentCourseMaster = DB::table('student_course_master')
            ->where('id', $student_course_master_id)
            // ->where('user_id', Auth::id())
            // ->where('course_id', isset($QuestionData[0]['award_id']) ? $QuestionData[0]['award_id'] : 0)
            // ->where(function ($query) {
            //     $query->where('exam_attempt_remain', 0)
            //         ->orWhere('exam_remark', '1');
            // })
            ->latest()
            ->first();
    @endphp
    @if (isset($studentCourseMaster) && !empty($studentCourseMaster) && ($studentCourseMaster->exam_attempt_remain == '0' || $studentCourseMaster->exam_remark == '1'))
        @include('frontend.exam.environment.submitted-successfully',['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : '']);
    @else
        <section class="container-fluid ps-4 pe-3">
            {{-- E-portfolio --}}
            <div class="row">


                <div class="col-md-12 mb-3">
                    <ul class="ps-0">
                        @php
                            echo isset($QuestionData[0]['instructions']) ? html_entity_decode($QuestionData[0]['instructions']) : '';
                        @endphp
                        @if (isset($QuestionData[0]['instrcution_file_url']) && !empty($QuestionData[0]['instrcution_file_url']) && Storage::disk('local')->exists($QuestionData[0]['instrcution_file_url']))
                        <div class="mt-2 vlogjobDesc">
                            <a href="{{Storage::disk('local')->url($QuestionData[0]['instrcution_file_url'])}}" download="E-Ascencian Jd (Exam)"> Click here to download the Job Description <i class="fe fe-download fs-5"></i></a>
                        </div>
                        @endif
                    </ul>
                </div>

                <form id="vlogExamFormData-{{$QuestionData[0]['award_id']}}-{{$index}}" class="vlogExamFormData" enctype="multipart/form-data">
                    
                    <div class="custom-file-container mb-2 custom-form-container">
                        @php
                            $i = 0;
                        @endphp
                        @if(isset($QuestionData[0]))
                                <div class="d-flex justify-content-between">
                                    <div class="color-blue fw-semibold mb-0 gap-1 d-flex vlog_ementor_question_title"> Question:
                                        <span style="color: rgb(31, 31, 31);"> {!! isset($QuestionData[0]['vlog_question'][0]['question']) ? html_entity_decode($QuestionData[0]['vlog_question'][0]['question']) : '' !!} </span>
                                    </div>
                                    <div class="color-blue fw-semibold mb-0">[{{ isset($QuestionData[0]['vlog_question'][0]['marks']) ? $QuestionData[0]['vlog_question'][0]['marks'] : '' }} Marks]</div>
                                </div>
                                <label for="textarea-input" class="form-label">
                                  
                                </label>
                                <label class="input-container">
                                    <input type="file" class="custom-file-input" name="instruction_file" id="custom-file-input" aria-describedby="inputGroupFileAddon04" aria-label="Upload" accept="video/mp4">
                                </label>
                                <br><br>
                                <small class="mt-2">(The file must be in MP4 format and less than 500 MB.)</small>
                                <div id="progress-bar-container-{{$i+1}}">
                                    <div id="progress-bar"></div>
                                </div>

                                <div id="video-preview">
                                    <video id="preview-video" height="500" controlslist="nodownload" controls oncontextmenu="return false;" class="mb-4 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover video-preview-trailor d-block" height="400px;" width="800px;" style="display: none !important; width:100%"></video>
                                </div>
                              
                                <div class="invalid-feedback" id="journal_file_error">Please upload file.</div>
                            @php $i = 0; @endphp
                            @foreach ($QuestionData[0]['vlog_question'] as $item)
                                <input type="hidden" name="question_id[]" value="{{ base64_encode($item['id']) }}">
                                @php $i++; @endphp
                            @endforeach
                            <input type="hidden" name="exam_id" class="form-control" value="{{isset($QuestionData[0]['id']) ? base64_encode($QuestionData[0]['id']) : 0}}">
                            <input type="hidden" name="course_id" class="form-control" value="{{isset($QuestionData[0]['award_id']) ? base64_encode($QuestionData[0]['award_id']) : ''}}">
                            <input type="hidden" name="master_course_id" id="master_course_id" value="{{ isset($master_course_id) ? base64_encode($master_course_id) : '' }}">
                            <input type="hidden" name="student_course_master_id" id="student_course_master_id" value="{{base64_encode($student_course_master_id)}}">
                            <input type="hidden" name="type" id="type" value="Vlog">
                            <input type="hidden" name="index" id="index" value="{{$index}}">

                        @endif
                            
                        <button type="button" class="btn btn-primary mt-2" data-bs-target="#instructionModal-{{$QuestionData[0]['award_id']}}-{{$index}}" data-bs-toggle="modal">Submit Now</button>
                    </div>
                </form>
                
                

            </div>
        </section>

        @include('frontend.exam.environment.declaration-form', [
            'modalId' => 'instructionModal-' . $QuestionData[0]['award_id'] . '-' . $index,
            'exam_name' => isset($QuestionData[0]['tittle']) 
                ? html_entity_decode($QuestionData[0]['tittle']) 
                : 'Vlog',
            'submit_button_class' => 'submitVlogExam',
            'extraRequirement' => ' data-index="' . e($index) . '" data-course_id="' . e($QuestionData[0]['award_id']) . '" data-action="submit"'
        ])
@endif
@endif

<link href="{{ asset('frontend/libs/filepond/filepond-plugin-image-preview.min.css')}}" rel="stylesheet" />
<link href="{{ asset('frontend/libs/filepond/filepond.min.css')}}" rel="stylesheet" /> 

<!-- FilePond JS and Plugins -->

<script src="{{ asset('frontend/libs/filepond/dist/js/filepond-plugin-file-encode.min.js')}}"></script>
<script src="{{ asset('frontend/libs/filepond/dist/js/filepond-plugin-file-validate-type.min.js')}}"></script>
<script src="{{ asset('frontend/libs/filepond/dist/js/filepond-plugin-image-exif-orientation.min.js')}}"></script>
<script src="{{ asset('frontend/libs/filepond/dist/js/filepond-plugin-image-preview.min.js')}}"></script>
<script src="{{ asset('frontend/libs/filepond/dist/js/filepond.min.js')}}"></script>

{{-- <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet">
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script> --}}

<script>
    // Register FilePond plugins
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview
        );

        // Create a FilePond instance
        const pond = FilePond.create(document.querySelector('#custom-file-input'), {
            acceptedFileTypes: ['video/mp4'],
            allowMultiple: false,
            server: {
                process: (fieldName, file, metadata, load, error, progress) => {
                    const reader = new FileReader();

                    reader.onload = () => {
                        // Simulate upload progress
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
                },
                revert: null,
                load: null,
                restore: null
            }
        });

        // Show video preview on file upload
        pond.on('processfile', (error, file) => {
            if (!error) {
                const videoPreview = document.getElementById('preview-video');
                const fileUrl = URL.createObjectURL(file.file);

                if (videoPreview.src) {
                    URL.revokeObjectURL(videoPreview.src);
                }

                videoPreview.src = fileUrl;
                videoPreview.style.display = 'block';
            }
        });
        
        pond.on('addfile', (error, file) => {
            if (error) {
                console.error('Error adding file:', error);
                return;
            }

            const videoPreviewDiv = document.getElementById('video-preview');
            const videoPreview = document.getElementById('preview-video');
            const iframeContainer = document.querySelector('.iframe-container');

            // Create an object URL for the video file
            const videoURL = URL.createObjectURL(file.file);

            // Set the video source and make sure the preview is visible
            videoPreview.src = videoURL;
            videoPreviewDiv.style.display = 'block';
            iframeContainer.style.display = 'none';
        });
        
        // remove video preview on file remove
        pond.on('removefile', () => {
            const videoPreviewDiv = document.getElementById('video-preview');
            const videoPreview = document.getElementById('preview-video');
            
            if (videoPreview.src) {
                URL.revokeObjectURL(videoPreview.src);
                videoPreview.src = '';
                videoPreviewDiv.style.display = 'none';
            }
        });

        // Clear video preview
        window.addEventListener('beforeunload', () => {
            const videoPreview = document.getElementById('preview-video');
            if (videoPreview.src) {
                URL.revokeObjectURL(videoPreview.src);
            }
        });

    </script>