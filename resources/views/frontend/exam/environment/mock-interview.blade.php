<style>
     /* .custom-file-input {
            display: none;
        } */
        .custom-file-label {
            display: inline-block;
            cursor: pointer;
            padding: 0.375rem 0.75rem;
            margin-right: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            color: #495057;
            background-color: #fff;
            white-space: nowrap;
            width: 100%;
        }
        .custom-file-label::after {
            content: 'Choose file';
            display: inline-block;
            padding: 0.375rem 0.75rem;
            margin-left: 0.5rem;
            border-left: 1px solid #ced4da;
        }
        .custom-file-label.selected::after {
            content: attr(data-filename);
        }
        .mainMockSection{
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 2rem;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .mockjobDesc{
            background: #ffffff;
            padding: 10px;
            border-radius: 8px;
            display: inline-block;
            font-weight: 600;
        }
</style>

<div class="header" >
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
                <h3 class="mb-0 text-truncate-line-2 color-blue studentAssignmentTitle"> {{isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : '' }} ({{isset($QuestionData[0]['percentage']) ? $QuestionData[0]['percentage'] : 0 }}%)</h3>
            </div>

        </div>

    </nav>
</div>

<!-- Page Header -->
@if (isset($QuestionData[0]['id']) && is_exist('exam_remark_master', ['user_id' => Auth::user()->id, 'course_id' => $QuestionData[0]['award_id'], 'student_course_master_id' => $student_course_master_id, 'exam_id' => $QuestionData[0]['id'], 'exam_type' => 2, 'attempt_remain' => 0, 'is_active' => 1]) > 0)
 @include('frontend.exam.environment.submitted-successfully',['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : ''])
@else
    @php
        $studentCourseMaster = DB::table('student_course_master')
            ->where('id', $student_course_master_id)
            // ->where('user_id', Auth::id())
            // ->where('course_id', $QuestionData[0]['award_id'])
            // ->latest()
            ->first();

    @endphp
    @if (isset($studentCourseMaster) && !empty($studentCourseMaster) && ($studentCourseMaster->exam_attempt_remain == '0' || $studentCourseMaster->exam_remark == '1'))
        @include('frontend.exam.environment.submitted-successfully',['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : '']);
    @else
        <!-- Container fluid -->
        <section class="container-fluid ps-5 pe-lg-3 pe-sm-1 pt-2">
                {{-- Assignment 1 --}}
                <div class="row justify-content-center">
                    <div class="col-md-12 mb-3">
                        
                @php
                    echo isset($QuestionData[0]['instructions']) ? html_entity_decode($QuestionData[0]['instructions']) : '';
                    @endphp
                        @if (isset($QuestionData[0]['instrcution_file_url']) && !empty($QuestionData[0]['instrcution_file_url']) && Storage::disk('local')->exists($QuestionData[0]['instrcution_file_url']))
                        <div class="mockjobDesc">
                            <a href="{{Storage::disk('local')->url($QuestionData[0]['instrcution_file_url'])}}" download="E-Ascencian Jd (Exam)"> Download job description from here JD.pdf <i class="fe fe-download fs-5"></i></a>
                        </div>
                        @endif
                    </div>
                @php
                $i = 1;
                @endphp
                <div class="mainMockSection">
                    <form id="mockExamFormData-{{$QuestionData[0]['award_id']}}-{{$index}}" class="mockExamFormData">
                        <input type="hidden" name="exam_id" id="exam_id" value="{{isset($QuestionData[0]['id']) ? base64_encode($QuestionData[0]['id']) : 0}}">
                        <input type="hidden" name="course_id" id="course_id" value="{{isset($QuestionData[0]['award_id']) ? base64_encode($QuestionData[0]['award_id']) : ''}}">
                        <input type="hidden" name="master_course_id" id="master_course_id" value="{{ isset($master_course_id) ? base64_encode($master_course_id) : '' }}">
                        <input type="hidden" name="student_course_master_id" id="student_course_master_id" value="{{ isset($student_course_master_id) ? base64_encode($student_course_master_id) : '' }}">
                        <input type="hidden" name="index" id="index" value="{{$index}}">

                        @if(isset($QuestionData[0]))
                            @foreach ($QuestionData[0]['mock_question'] as $item)
                                <div class="col-md-12 mb-5">
                                    {{-- <label for="textarea-input" class="form-label">
                                        <span class="color-blue">  </span>
                                        
                                    </label> --}}

                                    <div class="d-flex justify-content-between">
                                        <h5 class="color-blue mb-0">
                                            Question {{$i}}: {{isset($item['question']) ? html_entity_decode($item['question']) : '' }}
                                        </h5>
                                        <p class="color-blue mb-0 fw-semibold">
                                            [{{isset($item['marks']) ? $item['marks'] : '' }} Marks]
                                        </p>
                                    </div>



                                    <form enctype="multipart/form-data" id="mockUploadContent_{{$i}}">
                                        <input type="hidden" name="type" id="type" value="{{$QuestionData[0]['requires_word_count'] == 1 ? 'Final Thesis' : 'Mock Interview'}}">
                                        <input type="hidden" name="student_course_master_id" id="student_course_master_id" value="{{base64_encode($student_course_master_id)}}">
                                        <input type="text" name="formate" value="{{ !empty($item['file_type']) ? base64_encode($item['file_type']) : ''}}" hidden>
                                        <input type="hidden" name="exam_id" id="exam_id"
                                            value="{{isset($QuestionData[0]['id']) ? base64_encode($QuestionData[0]['id']) : 0}}">
                                            <input type="hidden" name="course_id" id="course_id"
                                            value="{{isset($QuestionData[0]['award_id']) ? base64_encode($QuestionData[0]['award_id']) : ''}}">
                                            <input type="hidden" name="master_course_id" id="master_course_id"
                                                value="{{ isset($master_course_id) ? base64_encode($master_course_id) : '' }}">
                                        <input type="hidden" name="ques_id" id="ques_id" value="{{base64_encode($item['id'])}}">
                                        
                                        <div class="col-md-6 mt-2  mock-interview-custom">
                                        <div class="mb-0 d-flex">
                                        <div class="input-group mock-interview-customInput" style="flex-wrap: inherit">
                                            <label class="custom-file-label" for="customFile{{$i}}" data-filename="">Choose {{ isset($item['file_type']) && $item['file_type'] === '1' ? "PDF": "Video" }}  file</label>
                                            <input type="file" class="custom-file-input"  data-content="{{$i}}" id="customFile{{$i}}" name="docFile" accept="{{ isset($item['file_type']) && $item['file_type'] === '1' ? 'application/pdf' : 'video/mp4' }}" style="display: none !important">
                                            <button type="button"  class="btn btn-primary mockContentUpload" data-id="{{$i}}">Upload</button>
                                        </div>
                                        </div>
                                        </div>
                                        <small>{{isset($item['file_type']) && $item['file_type'] === '1' ? "File size should be less than 5 MB.": "File size should be less than 500 MB." }}</small>

                                    </form>
                                    <input type="hidden" name="question_id[]" value="{{base64_encode($item['id'])}}">
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        @endif
                    </form>
                   <div class="col-12 mb-6">
                    <button type="button" class="btn btn-primary" data-bs-target="#instructionModal-{{$QuestionData[0]['award_id']}}-{{$index}}"  data-bs-toggle="modal">Submit Now</button>
                   </div>
                </div>
        </section>
        
        @include('frontend.exam.environment.declaration-form', [
            'modalId' => 'instructionModal-' . $QuestionData[0]['award_id'] . '-' . $index,
            'exam_name' => isset($QuestionData[0]['title']) 
                ? html_entity_decode($QuestionData[0]['title']) 
                : 'assessment',
            'submit_button_class' => 'submitMockExam',
            'extraRequirement' => ' data-index="' . e($index) . '" data-course_id="' . e($QuestionData[0]['award_id']) . '" data-action="submit"'
        ])
    @endif
@endif
<script>
    $(".custom-file-input").on("change", function (event) {
        var file = event.target.files[0];
        var fileType = file.type;
        var content = $(this).data("content");
        if (fileType === "application/pdf") {
            const label = document.querySelector(`label[for="${this.id}"]`);
            if (label) {
                label.setAttribute('data-filename', file.name);
                label.classList.add('selected');
            }
       } else {
            const label = document.querySelector(`label[for="${this.id}"]`);
            if (label) {
                label.setAttribute('data-filename', file.name);
                label.classList.add('selected');
            }
        }
    });
</script>