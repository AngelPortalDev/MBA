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
    .aijobDesc{
        background: #f7f7f7;
        padding: 10px;
        border-radius: 8px;
        display: inline-block;
        font-weight: 600;
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
                    ({{ isset($QuestionData[0]['percentage']) ? $QuestionData[0]['percentage'] : '' }}%)
                </h3>
            </div>

        </div>
    </nav>

</div>

<!-- Page Header -->
@if (isset($QuestionData[0]['id']) &&
        is_exist('exam_remark_master', [
            'student_course_master_id' => $student_course_master_id,
            'user_id' => Auth::user()->id,
            'course_id' => $QuestionData[0]['award_id'],
            'exam_id' => $QuestionData[0]['id'],
            'exam_type' => 9,
            'attempt_remain' => 0,
            'is_active' => 1,
        ]) > 0)
    @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : '']);
@else
    @php
        $studentCourseMaster = DB::table('student_course_master')
            ->where('id', $student_course_master_id)
            ->first();
    @endphp
    @if (isset($studentCourseMaster) && !empty($studentCourseMaster) && ($studentCourseMaster->exam_attempt_remain == '0' || $studentCourseMaster->exam_remark == '1'))
        @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : '']);
    @else

        <div class="col-md-12 mb-3">
            <ul class="ps-0 aiInstructions">
                @php
                    echo isset($QuestionData[0]['instructions']) ? html_entity_decode($QuestionData[0]['instructions']) : '';
                @endphp
                @if (isset($QuestionData[0]['instrcution_file_url']) && !empty($QuestionData[0]['instrcution_file_url']) && Storage::disk('local')->exists($QuestionData[0]['instrcution_file_url']))
                    {{-- <div class="mt-2 aijobDesc">
                        <a href="{{Storage::disk('local')->url($QuestionData[0]['instrcution_file_url'])}}" download="E-Ascencian Jd (Exam)"> Click here to download the Job Description <i class="fe fe-download fs-5"></i></a>
                    </div> --}}
                @endif
            </ul>
        </div>
        <section class="pt-4 pb-4 bg-light p-4">
            {{-- <div class="container"> --}}
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-12 mb-6">
                        <!-- Instructions Card -->
                        <div class="card shadow-lg border-0 rounded-3">
                            <div class="card-body p-5">
                                <h5></h5>
                                <!-- Title -->
                                <h3 class="mb-4 text-primary fw-bold">
                                    📌 Submission Guidelines
                                </h3>

                                <!-- Instructions List -->
                                <ul class="list-group list-group-flush mb-4">
                                    <li class="list-group-item bg-transparent">
                                        ✅ A detailed report delivered as a PDF and formatted in ACM style (2) (maximum length of 10 pages).
                                    </li>
                                    <li class="list-group-item bg-transparent">
                                        📚 References to academic literature: Ensure citations are included for all referenced papers and sources.
                                    </li>
                                    <li class="list-group-item bg-transparent">
                                        💻 Your submission should also contain the supporting code in a Jupyter Notebook. Additionally, all necessary files should be included in a compressed (ZIP) folder with the following:
                                        <ul class="mt-1">
                                            <li>📄 A README file that provides clear instructions on how to execute the code.</li>
                                            <li>📋 A requirements.txt file that lists all dependencies required for running the code.</li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item bg-transparent">
                                        ✅ Ensure that the code is functional, well-documented, and reproducible.
                                    </li>
                                </ul>

                                <!-- Additional Information -->
                                <p class="mb-3">
                                    📥 For more details, download the guideline PDF below.
                                </p>

                                <!-- Compact Download Button -->
                                <a href="{{Storage::disk('local')->url($QuestionData[0]['instrcution_file_url'])}}" target="_blank" class="btn btn-sm btn-outline-primary shadow-sm mb-4">
                                    📄 Download PDF
                                </a>
                                <hr>

                                <div class="d-flex justify-content-between">
                                    <div class="color-blue fw-semibold mb-0 gap-1 d-flex vlog_ementor_question_title"> Question: {!! isset($QuestionData[0]['artificial_intelligence_question'][0]['question']) ? html_entity_decode($QuestionData[0]['artificial_intelligence_question'][0]['question']) : '' !!}</div>
                                    <div class="color-blue fw-semibold mb-0">[{{ isset($QuestionData[0]['artificial_intelligence_question'][0]['marks']) ? $QuestionData[0]['artificial_intelligence_question'][0]['marks'] : '' }} Marks]</div>
                                </div>

                                <form id="artificialIntelligenceExamFormData-{{$QuestionData[0]['award_id']}}-{{$index}}" class="artificialIntelligenceExamFormData card p-3 mb-4" enctype="multipart/form-data">

                                    <input type="hidden" name="exam_id" id="exam_id" value="{{ isset($QuestionData[0]['id']) ? base64_encode($QuestionData[0]['id']) : '' }}">
                                    <input type="hidden" name="course_id" id="exam_id" value="{{ isset($QuestionData[0]['award_id']) ? base64_encode($QuestionData[0]['award_id']) : '' }}">
                                    <input type="hidden" name="master_course_id" id="master_course_id" value="{{ isset($master_course_id) ? base64_encode($master_course_id) : '' }}">
                                    <input type="hidden" name="student_course_master_id" id="student_course_master_id" value="{{ isset($student_course_master_id) ? base64_encode($student_course_master_id) : '' }}">
                                    <input type="hidden" name="exam_type" id="exam_type" value="{{ base64_encode(9) }}">
                                    <input type="hidden" name="type" id="type" value="Artificial Intelligence">
                                    <input type="hidden" name="index" id="index" value="{{$index}}">

                                    <input type="hidden" name="question_id" id="question_id" value="{{ isset($QuestionData[0]['artificial_intelligence_question'][0]['id']) ? base64_encode($QuestionData[0]['artificial_intelligence_question'][0]['id']) : 0 }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="link" class="form-label fw-semibold">
                                                    🔗 Enter Your GitHub Repository Url or Online Compiler Link
                                                </label>
                                                <div class="input-group shadow-sm">
                                                    <input type="text" id="link" name="link" class="form-control" required placeholder="e.g., https://github.com/username/repository-name or https://replit.com/@example" >
                                                </div>
                                                <small class="mt-2 d-block invalid-feedback" id="link_error" style="display:none;color:red;"></small>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="pdf_file" class="form-label fw-semibold">
                                                    📄 Upload Your PDF File (File size should be less than 5 MB.)
                                                </label>
                                                <input type="file" id="pdf_file" name="pdf_file" class="form-control shadow-sm" accept=".pdf" required>
                                                <small class="mt-2 d-block invalid-feedback" id="pdf_file_error" style="display:none;color:red;"></small>
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="requirement_file" class="form-label fw-semibold">
                                                    📂 Upload Requirement File (.txt, .zip) (File size should be less than 5 MB.)
                                                </label>
                                                <input type="file" id="requirement_file" name="requirement_file" class="form-control shadow-sm" accept=".txt, .zip" required>
                                                <small class="mt-2 d-block invalid-feedback" id="requirement_file_error" style="display:none;color:red;"></small>
                                            </div>
                                        </div>
                                    </div>
                                
                                  

                                    <div class="col-12 mb-6 text-center">
                                        <button type="button" class="btn btn-primary" data-bs-target="#instructionModal-{{$QuestionData[0]['award_id']}}-{{$index}}" data-bs-toggle="modal">Submit Now</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
        </section>
        
        @include('frontend.exam.environment.declaration-form', [
            'modalId' => 'instructionModal-' . $QuestionData[0]['award_id'] . '-' . $index,
            'exam_name' => isset($QuestionData[0]['title']) 
                ? html_entity_decode($QuestionData[0]['title']) 
                : 'assessment',
            'submit_button_class' => 'submitArtificialIntelligenceExam',
            'extraRequirement' => ' data-index="' . e($index) . '" data-course-id="' . e($QuestionData[0]['award_id']) . '" data-action="submit"'
        ])
    @endif
@endif
