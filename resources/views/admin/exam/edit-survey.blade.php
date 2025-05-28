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
                                                <h3 class="mb-2 editExamTitle">Edit Survey</h3>
                                                <button class="btn btn-outline-primary custum-btn-mobile"
                                                    onclick="goBack()">Back</button>
                                            </div>
                                            <form class="w-100 surveyData">
                                                {{-- Survey --}}
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-lg-6">
                                                        <div class="w-100 ">

                                                            <label class="form-label" for="editState">Survey
                                                                Title <span class="text-danger">*</span></label>
                                                            <input type="text" id="title"
                                                                name="title" class="form-control"
                                                                placeholder="Survey Title" required=""
                                                                value="{{ isset($contentData[0]['title']) ? html_entity_decode($contentData[0]['title']) : '' }}">
                                                            <input type="text" id="survey_id" name="survey_id" value="{{isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0}}" hidden>
                                                            <small>Title must be between 3 to 255 characters.</small>
                                                           <div class="invalid-feedback" id="title_error">Please enter survey title</div>
                                                        </div>
                                                    </div>
                                                    {{-- Total Percentage --}}
                                                    <div class="col-md-12 col-sm-12 col-lg-6 mt-2 mt-md-0">
                                                        <div class="w-100">
                                                            <label class="form-label" for="percentage">Total
                                                                Percentage (%) <span class="text-danger">*</span></label>
                                                            <input type="number" id="percentage"
                                                                name="percentage" class="form-control"
                                                                placeholder="Survey Total Percentage"
                                                                required="" value="{{isset($contentData[0]['percentage']) ? $contentData[0]['percentage'] : ''}}">
                                                                <div class="invalid-feedback" id="percentage_error">Please enter reflective journal total percentage</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <label class="form-label">Instructions <span class="text-danger">*</span></label>
                                                    <div id="survey_instruction"  placeholder="Programme Outcomes"
                                                        class="form-control w-100" style="height: 200px">
                                                    @php echo !empty($contentData[0]['instructions']) ? htmlspecialchars_decode($contentData[0]['instructions']) : ''  @endphp
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
                                                                <input type="file" class="form-control" name="instruction_file" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" accept=".pdf">
                                                                <span class="input-visible">{{ isset($contentData[0]['instrcution_file_name']) ? $contentData[0]['instrcution_file_name'] : 'Choose file...' }} <span class="browse-button">Upload</span></span>
                                                            </label>
                                                            <small class="mt-1">(File size should be less than 5 MB)</small>
                                                            <div class="invalid-feedback" id="journal_file_error">Please upload file.</div>
                                                        </div>
                                                        @if (isset($contentData[0]['instrcution_file_url']) && !empty($contentData[0]['instrcution_file_url']) && Storage::disk('local')->exists($contentData[0]['instrcution_file_url']))
                                                        <div id="file-display" class="file-display d-flex justify-content-between p-3 bg-light text-primary fw-bold">
                                                            <div>
                                                                <a href="{{ Storage::disk('local')->url($contentData[0]['instrcution_file_url']) }}" target="_blank"><span class="file-name">{{ $contentData[0]['instrcution_file_name'] }}</span></a>
                                                            </div>
                                                            <div>
                                                                <a href="javascript:void(0)" class="me-1 text-inherit deleteSurveyPdfFile" data-file_id="{{ isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}"><i class="fe fe-trash-2 fs-5"></i></a>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="col-md-3">
                                                    <button type="button"
                                                        class="btn btn-primary mt-3 updateSurvey">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header px-2">
                                    <div class="row justify-content-between">
                                        <div class="col-md-8">
                                            <h4 class="mb-0">Choose Order</h4>
                                            <p class="mb-0">Survey Questions</p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-3 text-end">
                                                <a href="#" class="btn btn-primary addSurveyQuestionOpen" data-bs-target="#surveyQuestionModel" data-bs-toggle="modal">Question <i class="fe fe-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="bg-light rounded p-2 mb-4">
                                        <div class="list-group list-group-flush border-top-0" id="QuestionList">
                                            <div id="courseOne">
                                            @if (isset($contentData[0]['survey_question']) && count($contentData[0]['survey_question']) > 0)
                                                    
                                              @foreach ($contentData[0]['survey_question'] as $qusetions)
                                                <div class="list-group-item rounded px-3 text-nowrap mb-1" id="development">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h5 class="mb-0 text-truncate">
                                                            <a href="#" class="text-inherit">
                                                                <span class="align-middle fs-4 text-wrap-title questiontitle surveyquestiontitle"> 
                                                                    <i class="bi bi-question-circle me-2"></i>  {!! isset($qusetions['question']) ? $qusetions['question'] : '' !!}
                                                                </span>
                                                            </a>
                                                        </h5>
                                                        <div>
                                                            <a href="javascript:void(0);" class="me-2 text-inherit addViewInputFieldConfiguration" 
                                                                aria-label="Manage Input Field" 
                                                                data-question_id="{{ isset($qusetions['id']) ? base64_encode($qusetions['id']) : 0 }}" 
                                                                data-exam_id="{{ isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}" 
                                                                data-exam_type="7"
                                                                data-mode="add" 
                                                                data-bs-toggle="tooltip" 
                                                                data-bs-placement="top" 
                                                                data-bs-title="Add Input Field">
                                                                <i class="fe fe-plus edit-icon fs-5" data-bs-toggle="modal" data-bs-target="#inputFieldConfigurationModal"></i>
                                                            </a>

                                                            <a href="javascript:void(0);" class="me-2 text-inherit getInputFieldConfiguration" aria-label="Input Field List" 
                                                                data-question_id="{{isset($qusetions['id']) ? base64_encode($qusetions['id']) : 0 }}" 
                                                                data-exam_id="{{isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}" 
                                                                data-exam_type="{{base64_encode('8')}}"
                                                                data-bs-toggle="tooltip" 
                                                                data-bs-placement="top" 
                                                                data-bs-title="Input Field List">
                                                                <i class="fe fe-list edit-icon fs-5 " data-bs-toggle="modal" data-bs-target="#inputFieldConfigurationListModal"></i>
                                                            </a>
                                                            
                                                            <a href="javascript:void(0);" class="me-2 text-inherit editViewSurveyQuestion" aria-label="Edit" data-question_id="{{isset($qusetions['id']) ? base64_encode($qusetions['id']) : 0 }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
                                                                <i class="fe fe-edit edit-icon fs-5 " data-bs-toggle="modal" data-bs-target="#editQuestion"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" class="me-1 text-inherit deleteSurveyQuestion" data-question_id="{{isset($qusetions['id']) ? base64_encode($qusetions['id']) : 0 }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
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
    <div class="modal fade" id="surveyQuestionModel" tabindex="-1" aria-labelledby="surveyQuestionModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- modal body -->
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="modal-title" id="surveyQuestionModelLabel">Add Question</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div>
                        <!-- form -->
                        <form class="needs-validation surveyQuestions" novalidate>
                            <input type="text" id="survey_id" name="survey_id" value="{{isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0}}" hidden>
                            <div class="mb-5">
                                
                                <div class="mb-3">
                                    <label class="form-label" for="question">Write Your Question<span class="text-danger">*</span></label>
                                    <div id="question" placeholder="Instructions"
                                        class="form-control w-100 p-0" style="height: 150px">
                                    </div>
                                    <input type="hidden" id="questionData" name="questionData">
                                    <input type="text" id="question_id" name="question_id" hidden>
                                    <div class="invalid-feedback" id="question_error">Please enter question.</div>
                                </div>
                                <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="marks">Enter Marks <span class="text-danger">*</span></label>
                                    <input type="number" id="mark" name="marks" class="form-control" placeholder="Enter Marks">
                                    <div class="invalid-feedback" id="marks_error">Please enter marks.</div>

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="answer_limit">Enter Answer Word Limit <span class="text-danger">*</span></label>
                                    <input type="number" id="answer_limit" name="answer_limit" class="form-control" placeholder="Enter Answer Word Limit">
                                    <div class="invalid-feedback" id="answer_limit_error">Please enter answer word limit.</div>

                                </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary ms-2 addSurveyQuestion" id="editButton">Add Question</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <!-- Input Field Configuration Add Modal -->
    <div class="modal fade" id="inputFieldConfigurationModal" tabindex="-1" aria-labelledby="manageInputFieldLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manageInputFieldLabel">Manage Input Field Configuration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation manageInputFieldForm" novalidate>
                        <input type="hidden" id="exam_id" name="exam_id" value="{{ isset($contentData[0]['id']) ? base64_encode($contentData[0]['id']) : 0 }}">
                        <input type="hidden" id="exam_type" name="exam_type" value="{{base64_encode('8')}}">
                        <input type="hidden" id="exam_table" name="exam_table" value="{{base64_encode('exam_survey')}}">
                        <input type="hidden" id="questionId" name="question_id" value="">
                        <input type="hidden" id="id" name="id" value="">
                        <div class="mb-3">
                            <label for="labelName" class="form-label">Label Name</label>
                            <input type="text" class="form-control" id="label_name" name="label_name" placeholder="Enter label name">
                        </div>
                        {{-- <div class="mb-3">
                            <label for="configuration" class="form-label">Configuration</label>
                            <textarea class="form-control" id="configuration" name="configuration" rows="4" placeholder='{"mimes": "pdf,docx", "max_size": "5MB"}' required></textarea>
                        </div> --}}
                        
                        <div class="mb-3">
                            <label for="mimes" class="form-label">Allowed File Types</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="pdf" name="mimes[]" value="pdf">
                                <label class="form-check-label" for="pdf">PDF</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="mp4" name="mimes[]" value="mp4">
                                <label class="form-check-label" for="mp4">MP4</label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="max_size" class="form-label">Max Size (In MB)</label>
                            <input type="number" class="form-control" id="max_size" name="max_size" placeholder="e.g. 5" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="is_required" class="form-label">Is Required?</label>
                            <select class="form-select" id="is_required" name="is_required">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        
                        
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary addInputField">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Input Field Configuration List Modal -->
    <div class="modal fade" id="inputFieldConfigurationListModal" tabindex="-1" aria-labelledby="inputFieldConfigurationListLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputFieldConfigurationListLabel">Input Field Configuration List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" id="inputFieldListTable">
                        <thead>
                            <tr>
                                <th>Label Name</th>
                                <th>File Types</th>
                                <th>Max Size (In MB)</th>
                                <th>Required</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated here via AJAX -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


      

    {{-- <script>
        CKEDITOR.replace('instruction-editor');
    </script> --}}
@endsection
