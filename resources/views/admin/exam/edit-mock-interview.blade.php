<!-- Header import -->
<style>
    .file-display {
        display: none;
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: .25rem;
        margin-top: 10px;
    }

    .file-remove {
        color: var(--primary);
        visibility: visible;
    }
</style>

@extends('admin.layouts.main')
@section('content')
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
                                    <div class="d-lg-flex justify-content-between align-items-end col-12 mb-2">
                                        <!-- Mock Interview content -->
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="mb-2 editExamTitle">Edit Mock Interview</h3>
                                                {{-- <button class="btn btn-outline-primary custum-btn-mobile"
                                                    onclick="goBack()">Back</button> --}}
                                                <a href="{{ route('admin.exam.mock-interview') }}" class="btn btn-outline-primary custum-btn-mobile">Back</a>
                                            </div>
                                            <form class="w-100 MockFormData" enctype="multipart/form-data">
                                                <div class="row">
                                                    <!-- Mock Interview Title -->
                                                    <div class="col-md-12 col-sm-12 col-lg-6">
                                                        <div class="w-100">
                                                            <label class="form-label" for="title">Mock Interview Title
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text" id="title" name="title"
                                                                class="form-control" placeholder="Mock Interview Title"
                                                                required=""
                                                                value="{{ isset($contentData[0]['title']) ? html_entity_decode($contentData[0]['title']) : '' }}">
                                                            <input type="text" id="mock_id" name="mock_id"
                                                                value="{{ isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}"
                                                                hidden>
                                                            <div class="invalid-feedback" id="mock_title_error">Please enter
                                                                mock interview title</div>
                                                            <small>Mock Interview title must be between 3 to 255
                                                                characters.</small>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="redirect" id="redirect"
                                                        value="mock-interview">
                                                    <!-- Total Percentage -->
                                                    <div class="col-md-12 col-sm-12 col-lg-6 mt-2 mt-md-0">
                                                        <div class="w-100">
                                                            <label class="form-label mt-2 mt-md-0" for="percentage">Total
                                                                Percentage (%) <span class="text-danger">*</span></label>
                                                            <input type="number" id="percentage" name="percentage"
                                                                class="form-control"
                                                                placeholder="Mock Interview Total Percentage" required=""
                                                                value="{{ isset($contentData[0]['percentage']) ? $contentData[0]['percentage'] : '' }}">
                                                            <div class="invalid-feedback" id="percentage_error">Please enter
                                                                mock interview total percentage</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Instructions -->
                                                <div class="col-md-12 mt-3">
                                                    <label class="form-label">Instructions <span
                                                            class="text-danger">*</span></label>
                                                    <div id="interview_instruction" placeholder="Instructions"
                                                        class="form-control w-100" style="height: 200px">
                                                        @php echo !empty($contentData[0]['instructions']) ? htmlspecialchars_decode($contentData[0]['instructions']) : '' @endphp
                                                    </div>
                                                    <input type='text' name='instruction' hidden>
                                                    <div class="invalid-feedback" id="instruction_error">Please enter
                                                        instructions</div>
                                                </div>

                                                <!-- Upload Document -->
                                                <div class="col-md-12">
                                                    <div class="mt-3 text-start">
                                                        <label class="form-label">Upload Document</label>
                                                        <div class="custom-file-container mb-2">
                                                            <label class="input-container">
                                                                <input type="file" class="form-control"
                                                                    name="instruction_file" id="inputGroupFile04"
                                                                    aria-describedby="inputGroupFileAddon04"
                                                                    aria-label="Upload" accept=".pdf">
                                                                <span
                                                                    class="input-visible">{{ isset($contentData[0]['instrcution_file_name']) ? $contentData[0]['instrcution_file_name'] : 'Choose file...' }}
                                                                    <span class="browse-button">Upload</span></span>
                                                            </label>
                                                            <small class="mt-1">(File size should be less than 5
                                                                MB)</small>
                                                            <div class="invalid-feedback" id="journal_file_error">Please
                                                                upload file.</div>
                                                        </div>
                                                        @if (isset($contentData[0]['instrcution_file_url']) &&
                                                                !empty($contentData[0]['instrcution_file_url']) &&
                                                                Storage::disk('local')->exists($contentData[0]['instrcution_file_url']))
                                                            <div id="file-display"
                                                                class="file-display d-flex justify-content-between p-3 bg-light text-primary fw-bold">
                                                                <div>
                                                                    <a href="{{ Storage::disk('local')->url($contentData[0]['instrcution_file_url']) }}"
                                                                        target="_blank"><span
                                                                            class="file-name">{{ $contentData[0]['instrcution_file_name'] }}</span></a>
                                                                </div>
                                                                <div>
                                                                    <a href="javascript:void(0)"
                                                                        class="me-1 text-inherit deletePdfFile"
                                                                        data-file_id="{{ isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}"><i
                                                                            class="fe fe-trash-2 fs-5"></i></a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="col-md-3">
                                                    <button type="button"
                                                        class="btn btn-primary mt-3 updateMockInterview">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-header ">
                                    <div class="row justify-content-between">
                                        <div class="col-md-8">
                                            <h4 class="mb-0">Questions</h4>
                                            <p class="mb-0">Mock interview questions categories</p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-3 text-end">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#addQuestion">Question <i class="fe fe-plus"></i></a>

                                                {{-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMcq"> MCQ <i class="fe fe-plus"></i></a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="bg-light rounded p-2 mb-4">
                                        <div class="list-group list-group-flush border-top-0" id="courseList">
                                            <div id="courseOne">
                                                @if (isset($contentData[0]['mock_question']) && count($contentData[0]['mock_question']) > 0)
                                                    @foreach ($contentData[0]['mock_question'] as $qusetions)
                                                        <div class="list-group-item rounded px-3 text-nowrap mb-1"
                                                            id="development">
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <h5 class="mb-0 text-truncate"><a href="#"
                                                                        class="text-inherit"><span
                                                                            class="align-middle fs-4 text-wrap-title questiontitle">
                                                                            <i class="bi bi-question-circle"></i>
                                                                            {{ isset($qusetions['question']) ? $qusetions['question'] : '' }}</span>
                                                                    </a></h5>
                                                                <div>
                                                                    <a href="javascript:void(0);"
                                                                        class="me-1 text-inherit editViewMockQuestion"
                                                                        aria-label="Edit"
                                                                        data-question_id="{{ isset($qusetions['id']) ? base64_encode($qusetions['id']) : 0 }}"><i
                                                                            class="bi bi-pencil edit-icon fs-5 "
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#editQuestion"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Edit"></i>
                                                                    </a>
                                                                    <a
                                                                        href="javascript:void(0)"
                                                                        class="me-1 text-inherit deleteMockQuestion"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Remove"
                                                                        data-question_id="{{ isset($qusetions['id']) ? base64_encode($qusetions['id']) : 0 }}"><i
                                                                            class="fe fe-trash-2 fs-5"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
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
    </main>

    <!-- Add PDF Modal -->
    {{-- <div class="modal fade" id="addpdf" tabindex="-1" aria-labelledby="addpdfModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                    </div>
                <!-- modal body -->
                <div class="modal-body">
                    <div>
                        <!-- form -->
                        <form class="needs-validation pdf" novalidate>
                            <div class="mb-3">
                                <p class="mb-1 text-dark">Upload PDF</p>
                                <div class="input-group mb-1">
                                    <input type="file" class="form-control" id="inputLogo">
                                    <label class="input-group-text" for="inputLogo">Upload</label>
                                </div>
                                <small class="">(File size should be less than 5 MB)</small>
                            </div>
                            
                        </form>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ms-2 addassignment">Add PDF</button>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}

    <!-- Question Modal -->
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
                    <form class="needs-validation MockQuestions" novalidate>
                        <div>
                            <input type="text" id="mock_id" name="mock_id"
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
                            <input class="form-check-input" type="radio" name="file_type" id="filePdf" value="1">
                            <label class="form-check-label" for="filePdf">
                                PDF
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="file_type" id="fileVideo" value='2'>
                            <label class="form-check-label" for="fileVideo">
                                Video
                            </label>
                        </div>
                        <div class="invalid-feedback" id="file_type_error">Please select file type.</div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ms-2 addMockQuestion">Add Question</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    //   document.addEventListener('DOMContentLoaded', function() {
    //         const fileInput = document.getElementById('inputGroupFile04');
    //         const fileDisplay = document.getElementById('file-display');
    //         const fileNameSpan = document.querySelector('.file-name');

    //         fileInput.addEventListener('change', function(event) {
    //             if (fileInput.files.length > 0) {
    //                 const file = fileInput.files[0];
    //                 fileNameSpan.textContent = file.name;
    //                 fileDisplay.style.display = 'flex';
    //             }
    //         });
    //     });
</script>
