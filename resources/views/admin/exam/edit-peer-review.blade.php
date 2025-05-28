<!-- Header import -->
@extends('admin.layouts.main')
@section('content')
    <style>
        #video-preview {
            margin-top: 20px;
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

        .iframe-container {
            position: relative;
            width: 100%;
            height: 315px;
            overflow: hidden;
            border-radius: 5px;
            margin-top: 20px;
            background: #000;
        }

        .videoPlayer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
    <!-- Container fluid -->
    <section class="p-4">
        <div class="container">
            <div id="courseForm" class="bs-stepper">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-12">
                        <!-- Card -->
                        <div class="card mb-4">
                            <!-- Card body -->
                            <div class="card-body border-bottom">
                                <!-- quiz -->
                                <div class="row">
                                    <div class="row">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="mb-2 editExamTitle">Edit Peer Review</h3>
                                            <button class="btn btn-outline-primary custum-btn-mobile"
                                                onclick="goBack()">Back</button>
                                        </div>
                                        <form class="w-100 PeerReviewFormData" enctype="multipart/form-data">
                                            <div class="col-md-12 col-sm-12 col-lg-12 mt-2">
                                                <div class="w-100">

                                                    <label class="form-label" for="editState">Award</label>
                                                    <input type="text" id="vlog " name="Vlog Title"
                                                        class="form-control"
                                                        value="{{ isset($contentData[0]['award_course']['course_title']) ? $contentData[0]['award_course']['course_title'] : '' }}"
                                                        placeholder="Award in recruitment and Employee Selection"
                                                        required="" disabled>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-lg-9">
                                                    <div class="w-100">
                                                        <label class="form-label" for="title">Peer Review Title <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="title" name="title"
                                                            class="form-control" placeholder="Peer Review Title"
                                                            required=""
                                                            value="{{ isset($contentData[0]['title']) ? html_entity_decode($contentData[0]['title']) : '' }}">
                                                        <input type="text" id="peer_review_id" name="peer_review_id"
                                                            value="{{ isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}"
                                                            hidden>
                                                        <div class="invalid-feedback" id="peer_review_title_error">Please
                                                            enter
                                                            peer review title</div>
                                                        <small>Peer review title must be between 3 to 255
                                                            characters.</small>

                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-lg-3 ">
                                                    <div class="w-100 ">
                                                        <label class="form-label mt-2 mt-md-0" for="percentage">Total
                                                            Percentage (%) <span class="text-danger">*</span></label>
                                                        <input type="number" id="percentage" name="percentage"
                                                            class="form-control" placeholder="Peer Review Total Percentage"
                                                            required=""
                                                            value="{{ isset($contentData[0]['percentage']) ? $contentData[0]['percentage'] : '' }}">
                                                        <div class="invalid-feedback" id="percentage_error">Please enter
                                                            peer review total percentage</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-lg-flex justify-content-between align-items-end col-md-12">
                                                <!-- quiz content -->
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <label class="form-label">Instructions <span
                                                        class="text-danger">*</span></label>
                                                <div id="instruction_peer_review" placeholder="Programme Outcomes"
                                                    class="form-control w-100" style="height: 200px">
                                                    @php echo !empty($contentData[0]['instructions']) ? htmlspecialchars_decode($contentData[0]['instructions']) : ''  @endphp
                                                </div>
                                                <input type='text' name='instruction' hidden>
                                                <div class="invalid-feedback" id="instruction_error">Please enter
                                                    Instruction</div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mt-3 text-start">
                                                    <label class="form-label">Upload Video <span
                                                            class="text-danger">*</span></label>
                                                    <div class="custom-file-container mb-2">
                                                        <label class="input-container">
                                                            <input type="file" class="form-control"
                                                                name="instruction_file" id="inputGroupFile04"
                                                                aria-describedby="inputGroupFileAddon04" aria-label="Upload"
                                                                value="{{ isset($contentData[0]['instruction_file']) ? base64_encode($contentData[0]['instruction_file']) : '' }}">
                                                        </label>
                                                        <div id="progress-bar-container">
                                                            <div id="progress-bar"></div>
                                                        </div>

                                                        <div id="video-preview">
                                                            <video id="preview-video" controlslist="nodownload"
                                                                controls="" oncontextmenu="return false;"
                                                                class="mb-4 d-flex justify-content-center align-items-center position-relative rounded py-16 border-white border rounded bg-cover video-preview-trailor d-block"
                                                                height="400px;" width="800px;"
                                                                style="display: none !important; width:100%"></video>
                                                        </div>
                                                        <small class="mt-1">(File size should be less than 500 MB)</small>
                                                        <div class="invalid-feedback" id="journal_file_error">Please upload
                                                            File.</div>
                                                    </div>

                                                    <br>
                                                    @if (isset($contentData[0]['instrcution_file_url']) && !empty($contentData[0]['instrcution_file_url']))
                                                        <div class="iframe-container">
                                                            <iframe
                                                                class="position-absolute top-0 end-0 start-0 end-0 bottom-0 h-100 w-100 videoPlayer"
                                                                width="560" height="315"
                                                                src="https://iframe.mediadelivery.net/embed/{{ env('Student_LIBRARY_ID') }}/{{ $contentData[0]['instrcution_file_url'] }}"
                                                                title="E-Ascencia - Academy and LMS Template"
                                                                frameborder="0" allow="fullscreen;"></iframe>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary mt-1 updatePeerReview">
                                                    Submit </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </main>


    <!-- Question Modal -->
    {{-- <div class="modal fade" id="addQuestion" tabindex="-1" aria-labelledby="addQuizQuestionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <!-- modal body -->
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="modal-title" id="addQuizQuestionModalLabel">Add Question</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div>
                        <!-- form -->
                        <form class="needs-validation assignment" novalidate>
                            <div class="mb-5">
                                <div class="mb-3">
                                    <label class="form-label" for="question">Write Your Question</label>

                                    <input type="text" id="question" class="form-control"
                                        placeholder="Write Your Question Here">

                                    <div class="invalid-feedback">Please enter your question.</div>
                                </div>

                            </div>

                        </form>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ms-2 addassignment">Add Question</button>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}

    <!-- Edit Modal -->
    <div class="modal fade" id="editQuestion" tabindex="-1" aria-labelledby="editQuizQuestionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  ">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="modal-title" id="editQuizQuestionModalLabel">Edit Question</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div>
                        <form class="needs-validation assignment" novalidate>
                            <div class="mb-5">
                                <div class="mb-3">
                                    <label class="form-label" for="question1">Edit Your Question</label>
                                    <input type="text" id="question1" class="form-control" placeholder=" ">
                                    <div class="invalid-feedback">Please enter your question.</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ms-2 addassignment">Save Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Delete video  --}}
    <div class="modal fade" id="addQuestion" tabindex="-1" aria-labelledby="addQuizQuestionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AssignQuestionModelLabel">Add Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <!-- modal body -->
                <div class="modal-body">
                    <form class="needs-validation PeerReviewQuestions" novalidate>
                        <div>
                            <input type="text" id="peer_review_id" name="peer_review_id"
                                value="{{ isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}"
                                hidden>
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label" for="question">Write Your Question <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="question" class="form-control" name="question"
                                        placeholder="Write Your Question Here">
                                    <input type="text" id="question_id" name="question_id" hidden>
                                    <div class="invalid-feedback" id="question_error">Please enter your question.</div>
                                    <small>Question title must be between 3 to 255 characters.</small>

                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="mark">Enter Marks <span
                                        class="text-danger">*</span></label>
                                <input type="number" id="mark" name="marks" class="form-control"
                                    placeholder="Enter Marks">
                                <div class="invalid-feedback" id="interview_mark_error">Please enter marks.</div>
                            </div>
                        </div>

                        <!-- radio-->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="file_type" id="fileVideo" value='2'>
                            <label class="form-check-label" for="fileVideo">
                                Video
                            </label>
                        </div>
                        <div class="invalid-feedback" id="file_type_error">Please select file type.</div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ms-2 addPeerReviewQuestion">Add Question</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css"
        rel="stylesheet">
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script> --}}

    <!-- FilePond CSS -->
    <link href="{{ asset('frontend/libs/filepond/filepond-plugin-image-preview.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/libs/filepond/filepond.min.css') }}" rel="stylesheet" />

    <!-- FilePond JS and Plugins -->
    <script src="{{ asset('frontend/libs/filepond/dist/js/filepond-plugin-file-encode.min.js') }}"></script>
    <script src="{{ asset('frontend/libs/filepond/dist/js/filepond-plugin-file-validate-type.min.js') }}"></script>
    <script src="{{ asset('frontend/libs/filepond/dist/js/filepond-plugin-image-exif-orientation.min.js') }}"></script>
    <script src="{{ asset('frontend/libs/filepond/dist/js/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('frontend/libs/filepond/dist/js/filepond.min.js') }}"></script>

    <script>
        // Register FilePond plugins
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview
        );

        // Create a FilePond instance
        const pond = FilePond.create(document.querySelector('input[type="file"]'), {
            acceptedFileTypes: ['video/mp4'],
            allowMultiple: false,
            server: {
                process: (fieldName, file, metadata, load, error, progress) => {
                    const reader = new FileReader();
                    const progressBar = document.getElementById('progress-bar');

                    reader.onload = () => {
                        // Simulate upload progress
                        let progressValue = 0;
                        const interval = setInterval(() => {
                            progressValue += 25;
                            progress(progressValue / 100);
                            progressBar.style.width = progressValue + '%';
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

        // Handle file processing and preview display
        pond.on('processfile', (error, file) => {
            if (error) {
                console.error('Error:', error);
            } else {
                const videoPreview = document.getElementById('preview-video');
                const fileUrl = URL.createObjectURL(file.file);

                // Ensure any previous video URL is revoked
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

            // Set the video source
            videoPreview.src = videoURL;
            videoPreviewDiv.style.display = 'block';
            iframeContainer.style.display = 'none';
        });

        pond.on('removefile', () => {
            const videoPreviewDiv = document.getElementById('video-preview');
            const videoPreview = document.getElementById('preview-video');
            const progressBar = document.getElementById('progress-bar');
            const iframeContainer = document.querySelector('.iframe-container');

            if (videoPreview.src) {
                URL.revokeObjectURL(videoPreview.src);
                videoPreview.src = '';
                videoPreviewDiv.style.display = 'none';
                iframeContainer.style.display = 'none';
            }
            progressBar.style.width = '0%';
        });

        // Clear video preview
        window.addEventListener('beforeunload', () => {
            const videoPreview = document.getElementById('preview-video');
            if (videoPreview.src) {
                URL.revokeObjectURL(videoPreview.src);
            }
        });
        var hasInstructionFileUploaded = {!! json_encode(
            isset($contentData[0]['instrcution_file_url']) && !empty($contentData[0]['instrcution_file_url']),
        ) !!};
    </script>
@endsection
