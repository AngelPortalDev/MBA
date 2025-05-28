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
                                    <div class="row">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="mb-2 editExamTitle">Edit Vlog</h3>
                                            <button class="btn btn-outline-primary custum-btn-mobile"
                                                onclick="goBack()">Back</button>
                                        </div>
                                        <form class="w-100 VlogFormData" enctype="multipart/form-data">
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
                                                <div class="col-md-12 col-sm-12 col-lg-6 col-xl-9">
                                                    <div class="w-100">
                                                        <label class="form-label" for="title">Vlog Title <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="title" name="title"
                                                            class="form-control" placeholder="Vlog Title" required=""
                                                            value="{{ isset($contentData[0]['title']) ? html_entity_decode($contentData[0]['title']) : '' }}">
                                                        <input type="text" id="vlog_id" name="vlog_id"
                                                            value="{{ isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}"
                                                            hidden>
                                                        <div class="invalid-feedback" id="vlog_title_error">Please enter
                                                            vlog title</div>
                                                        <small>Vlog title must be between 3 to 255 characters.</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-lg-6 col-xl-3">
                                                    <div class="w-100 ">

                                                        <label class="form-label mt-2 mt-md-0" for="percentage">Total
                                                            Percentage (%) <span class="text-danger">*</span></label>
                                                        <input type="number" id="percentage" name="percentage"
                                                            class="form-control" placeholder="Vlog Total Percentage"
                                                            required=""
                                                            value="{{ isset($contentData[0]['percentage']) ? $contentData[0]['percentage'] : '' }}">
                                                        <div class="invalid-feedback" id="percentage_error">Please enter
                                                            vlog total percentage</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-lg-flex justify-content-between align-items-end col-md-12">
                                                <!-- quiz content -->
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <label class="form-label">Instructions <span
                                                        class="text-danger">*</span></label>
                                                <div id="instruction_vlog" placeholder="Programme Outcomes"
                                                    class="form-control w-100" style="height: 200px">
                                                    @php echo !empty($contentData[0]['instructions']) ? htmlspecialchars_decode($contentData[0]['instructions']) : ''  @endphp
                                                </div>
                                                <input type='text' name='instruction' hidden>
                                                <div class="invalid-feedback" id="instruction_error">Please enter
                                                    instructions</div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mt-3 text-start">
                                                    <label class="form-label">Upload Document</label>
                                                    <div class="custom-file-container mb-2">
                                                        <label class="input-container">
                                                            <input type="file" class="form-control"
                                                                name="instruction_file" id="inputGroupFile04"
                                                                aria-describedby="inputGroupFileAddon04" aria-label="Upload"
                                                                accept=".pdf">
                                                            <span
                                                                class="input-visible">{{ isset($contentData[0]['instrcution_file_name']) ? $contentData[0]['instrcution_file_name'] : 'Choose file...' }}
                                                                <span class="browse-button">Upload</span></span>
                                                        </label>
                                                        <small class="mt-1">(File size should be less than 5 MB)</small>
                                                        <div class="invalid-feedback" id="journal_file_error">Please upload
                                                            file.</div>
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
                                                                    class="me-1 text-inherit deleteVlogPdfFile"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Delete"
                                                                    data-file_id="{{ isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}"><i
                                                                        class="fe fe-trash-2 fs-5"></i></a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary mt-3 updateVlog">
                                                    Submit </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header ">
                                <div class="row justify-content-between">
                                    <div class="col-md-8">
                                        <h4 class="mb-0">Questions</h4>
                                        <p class="mb-0">Vlog questions categories</p>
                                    </div>
                                    @php
                                        use App\Models\VlogQuestion;
                                        $questionCount = VlogQuestion::where([
                                            'vlog_id' => $contentData[0]['id'],
                                            'is_deleted' => 'No',
                                        ])->count();
                                    @endphp
                                    @if ($questionCount == 0)
                                        <div class="col-md-4">
                                            <div class="mt-3 text-end">
                                                {{-- <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#addQuestion">Question <i class="fe fe-plus"></i></a> --}}
                                                <a href="#" class="btn btn-primary addVlogQuestionOpen">Question <i
                                                        class="fe fe-plus"></i></a>


                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>




                            {{-- <div class="card-header ">
                                <div class="row justify-content-between">
                                    <div class="col-md-8">
                                        <h4 class="mb-0">Choose Order</h4>
                                        <p class="mb-0">Arrange Mock Interview questions with Drag and Drop</p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mt-3 text-end">
                                            <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addQuestion">Question <i class="fe fe-plus"></i></a>

                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="card-body">
                                <div class="bg-light rounded p-2 mb-4">
                                    <div class="list-group list-group-flush border-top-0" id="courseList">
                                        <div id="courseOne">
                                            @if (isset($contentData[0]['vlog_question']) && count($contentData[0]['vlog_question']) > 0)
                                                @foreach ($contentData[0]['vlog_question'] as $qusetions)
                                                    <div class="list-group-item rounded px-3 text-nowrap mb-1"
                                                        id="development">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h5 class="mb-0 text-truncate"><a href="#"
                                                                    class="text-inherit"><span
                                                                        class="align-middle fs-4 text-wrap-title questiontitle">
                                                                        <i
                                                                            class="bi bi-question-circle"></i>{!! isset($qusetions['question']) ? htmlspecialchars_decode($qusetions['question']) : '' !!}
                                                                    </span>
                                                                </a></h5>
                                                            <div><a href="javascript:void(0);"
                                                                    class="me-1 text-inherit editViewVlogQuestion"
                                                                    aria-label="Edit"
                                                                    data-question_id="{{ isset($qusetions['id']) ? base64_encode($qusetions['id']) : 0 }}"><i
                                                                        class="bi bi-pencil edit-icon fs-5 "
                                                                        data-bs-toggle="modal" data-bs-target="#"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Edit"></i></a><a
                                                                    href="javascript:void(0)"
                                                                    class="me-1 text-inherit deleteVlogQuestion"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Delete"
                                                                    data-question_id="{{ isset($qusetions['id']) ? base64_encode($qusetions['id']) : 0 }}"><i
                                                                        class="fe fe-trash-2 fs-5"></i></a></div>

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
                        <form class="needs-validation vlogQuestions" novalidate>
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
    <div class="modal fade" id="vlogQuestionModelOpen" tabindex="-1" aria-labelledby="addQuizQuestionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vlogQuestionModelLabel">Add Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <!-- modal body -->
                <div class="modal-body">
                    <form class="needs-validation VlogQuestions" novalidate>
                        <div>
                            <input type="text" id="vlog_id" name="vlog_id"
                                value="{{ isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}"
                                hidden>
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label" for="question">Write Your Question <span
                                            class="text-danger">*</span></label>
                                    {{-- <input type="text" id="question" class="form-control w-100 p-0" style="height: 150px"  name="question" placeholder="Write Your Question Here"> --}}
                                    <div id="question" placeholder="Instructions" class="form-control w-100 p-0"
                                        style="height: 150px"></div>
                                    {{-- <input type="hidden" id="questionData" name="questionData"> --}}
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
                                <div class="invalid-feedback" id="vlog_mark_error">Please enter marks.</div>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ms-2 addVlogQuestion">Add Question</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
