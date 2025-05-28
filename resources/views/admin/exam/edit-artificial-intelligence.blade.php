<!-- Header import -->
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
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="mb-2 editExamTitle">Edit Artificial Intelligence Exam</h3>
                                                <button class="btn btn-outline-primary custum-btn-mobile"
                                                    onclick="goBack()">Back</button>
                                            </div>
                                            <form class="w-100 artificialIntelligenceData">
                                                {{-- Artificial Intelligence --}}
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-lg-6">
                                                        <div class="w-100 ">

                                                            <label class="form-label" for="editState">Artificial
                                                                Intelligence Exam
                                                                Title <span class="text-danger">*</span></label>
                                                            <input type="text" id="title" name="title"
                                                                class="form-control"
                                                                placeholder="Artificial Intelligence Exam Title" required=""
                                                                value="{{ isset($contentData[0]['title']) ? html_entity_decode($contentData[0]['title']) : '' }}">
                                                            <input type="text" id="artificial_intelligence_id"
                                                                name="artificial_intelligence_id"
                                                                value="{{ isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}"
                                                                hidden>
                                                            <small>Artificial intelligence exam title must be between 3 to 255 characters.</small>
                                                            <div class="invalid-feedback"
                                                                id="artificial_intelligence_title_error">Please enter
                                                                artificial intelligence exam title</div>
                                                        </div>
                                                    </div>
                                                    {{-- Total Percentage --}}
                                                    <div class="col-md-12 col-sm-12 col-lg-6 mt-2 mt-md-0">
                                                        <div class="w-100">
                                                            <label class="form-label" for="edittotalpercentage">Total
                                                                Percentage (%) <span class="text-danger">*</span></label>
                                                            <input type="number" id="percentage" name="percentage"
                                                                class="form-control"
                                                                placeholder="Artificial Intelligence Total Percentage"
                                                                required=""
                                                                value="{{ isset($contentData[0]['percentage']) ? $contentData[0]['percentage'] : '' }}">
                                                            <div class="invalid-feedback" id="percentage_error">Please enter
                                                                total percentage</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Instrucritions --}}

                                                <div class="col-md-12 mt-3">
                                                    <label class="form-label">Instructions <span class="text-danger">*</span></label>
                                                    <div id="artificial_intelligence_instruction"
                                                        placeholder="Programme Outcomes" class="form-control w-100"
                                                        style="height: 200px">
                                                        @php 
                                                            echo !empty($contentData[0]['instructions']) ? htmlspecialchars_decode($contentData[0]['instructions']) : ''  
                                                        @endphp
                                                    </div>
                                                    <input type='text' name='instruction' hidden>
                                                    <div class="invalid-feedback" id="instruction_error">Please enter instructions</div>
                                                </div>

                                                {{-- Upload Document --}}
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
                                                                    <span class="browse-button">Upload</span>
                                                                </span>
                                                            </label>
                                                            <small class="mt-1">(File size should be less than 5MB)</small>
                                                            <div class="invalid-feedback" id="journal_file_error">Please upload file.</div>
                                                        </div>
                                                        @if (isset($contentData[0]['instrcution_file_url']) &&
                                                                !empty($contentData[0]['instrcution_file_url']) &&
                                                                Storage::disk('local')->exists($contentData[0]['instrcution_file_url']))
                                                            <div id="file-display"
                                                                class="file-display d-flex justify-content-between p-3 bg-light text-primary fw-bold">
                                                                <div>
                                                                    <a href="{{ Storage::disk('local')->url($contentData[0]['instrcution_file_url']) }}"
                                                                        target="_blank">
                                                                        <span class="file-name">{{ $contentData[0]['instrcution_file_name'] }}</span>
                                                                    </a>
                                                                </div>
                                                                <div>
                                                                    <a href="javascript:void(0)" class="me-1 text-inherit deleteArtificialIntelligencePdfFile"
                                                                        data-file_id="{{ isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}">
                                                                        <i class="fe fe-trash-2 fs-5"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="col-md-3">
                                                    <button type="button" class="btn btn-primary mt-3 updateArtificialIntelligence">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header px-0">
                                    <div class="row justify-content-between">
                                        <div class="col-md-8">
                                            <h4 class="mb-0">Choose Order</h4>
                                            <p class="mb-0">Artificial journals Categories</p>
                                        </div>
                                        @php
                                            use App\Models\ArtificialIntelligenceQuestion;
                                            $questionCount = ArtificialIntelligenceQuestion::where([
                                                'artificial_intelligence_id' => $contentData[0]['id'],
                                                'is_deleted' => 'No',
                                            ])->count();
                                        @endphp
                                        @if ($questionCount == 0)
                                            <div class="col-md-4">
                                                <div class="mt-3 text-end">
                                                    <a href="#" class="btn btn-primary addArtificialIntelligenceQuestionOpen">Question
                                                        <i class="fe fe-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-body reflective-journal-body pe-0 ps-0">
                                    <div class="bg-light rounded p-2 mb-4">
                                        <div class="list-group list-group-flush border-top-0" id="QuestionList">
                                            <div id="courseOne">
                                                @if (isset($contentData[0]['artificial_intelligence_question']) &&
                                                        count($contentData[0]['artificial_intelligence_question']) > 0)
                                                    @foreach ($contentData[0]['artificial_intelligence_question'] as $qusetions)
                                                        <div class="list-group-item rounded px-3 text-nowrap mb-1"
                                                            id="development">
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <h5 class="mb-0 text-truncate">
                                                                    <a href="#" class="text-inherit">
                                                                        <span class="align-middle fs-4 text-wrap-title questiontitle assignmnetquestiontitle d-flex"
                                                                            style="width: inherit"> 
                                                                            <i class="bi bi-question-circle me-2"></i>
                                                                           <span> {!! isset($qusetions['question']) ? $qusetions['question'] : '' !!} </span>
                                                                        </span>
                                                                    </a>
                                                                </h5>
                                                                <div>
                                                                    <a href="javascript:void(0);"
                                                                        class="me-2 text-inherit editViewArtificialIntelligenceQuestion"
                                                                        aria-label="Edit"
                                                                        data-question_id="{{ isset($qusetions['id']) ? base64_encode($qusetions['id']) : 0 }}"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        data-bs-title="Edit">
                                                                        <i class="fe fe-edit edit-icon fs-5 " data-bs-toggle="modal" data-bs-target="#editQuestion"></i>
                                                                    </a>
                                                                    <a href="javascript:void(0)" 
                                                                        class="me-1 text-inherit deleteArtificialIntelligenceQuestion" 
                                                                        data-question_id="{{ isset($qusetions['id']) ? base64_encode($qusetions['id']) : 0 }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                                                        <i class="fe fe-trash-2 fs-5"></i>
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
        </div>
        </div>
    </section>
    </main>

    <!-- Question Modal -->

    <div class="modal fade" id="questionModel" tabindex="-1" aria-labelledby="questionModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- modal body -->
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="modal-title" id="questionModelLabel">Add Question</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div>
                        <!-- form -->
                        <form class="needs-validation artificialIntelligenceQuestions" novalidate>
                            <input type="text" id="artificial_intelligence_id" name="artificial_intelligence_id" value="{{ isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}" hidden>
                            <div class="mb-5">
                                <div class="mb-3">
                                    <label class="form-label" for="question">Write Your Question<span class="text-danger">*</span></label>
                                    <div id="question" placeholder="Instructions" class="form-control w-100 p-0" style="height: 150px"></div>
                                    <input type="hidden" id="questionData" name="questionData">
                                    <input type="text" id="question_id" name="question_id" hidden>
                                    <div class="invalid-feedback" id="question_error">Please enter question.</div>
                                    <small>Question title must be between 3 to 255 characters.</small>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="marks">Enter Marks <span class="text-danger">*</span></label>
                                        <input type="number" id="marks" name="marks" class="form-control" placeholder="Enter Marks">
                                        <div class="invalid-feedback" id="mark_error">Please enter marks</div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary ms-2 addArtificialIntelligenceQuestion" id="editButton">Add Question</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        CKEDITOR.replace('instruction-editor');
    </script>
@endsection
