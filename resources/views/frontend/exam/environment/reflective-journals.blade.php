<style>
    .reflectivejobDesc{
        background: #ffffff;
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
<!-- Container fluid -->
@if (isset($QuestionData[0]['id']) &&
        is_exist('exam_remark_master', [
            'student_course_master_id' => $student_course_master_id,
            'user_id' => Auth::user()->id,
            'course_id' => $QuestionData[0]['award_id'],
            'exam_id' => $QuestionData[0]['id'],
            'exam_type' => 6,
            'attempt_remain' => 0,
            'is_active' => 1,
        ]) > 0)
    @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : '']);
@else
    @php
        $studentCourseMaster = DB::table('student_course_master')
            ->where('id', $student_course_master_id)
            ->latest()
            ->first();
    @endphp
    @if (isset($studentCourseMaster) &&
            !empty($studentCourseMaster) &&
            ($studentCourseMaster->exam_attempt_remain == '0' || $studentCourseMaster->exam_remark == '1'))
        @include('frontend.exam.environment.submitted-successfully', ['message' => isset($QuestionData[0]['title']) ? html_entity_decode($QuestionData[0]['title']) : '']);
    @else
        <section class="container-fluid ps-4 pe-3">
            <div class="row">


                <div class="col-md-12 mb-3">
                          
                    @php
                        echo isset($QuestionData[0]['instructions']) ? html_entity_decode($QuestionData[0]['instructions']) : '';
                    @endphp
                    @if (isset($QuestionData[0]['instrcution_file_url']) && !empty($QuestionData[0]['instrcution_file_url']) && Storage::disk('local')->exists($QuestionData[0]['instrcution_file_url']))
                    <div class="mt-2 ms-2 reflectivejobDesc">
                        <a href="{{Storage::disk('local')->url($QuestionData[0]['instrcution_file_url'])}}" download="E-Ascencian Jd (Exam)"> Download job description from here JD.pdf <i class="fe fe-download fs-5"></i></a>
                    </div>
                    @endif
                </div>
                <?php $i = 0; ?>
                    

                <div class="container-fluid pb-3 reflectiveJournalcontainer">
                    <section class="card p-md-0 p-3">
                        <div class="my-lg-4">
                            <!-- row -->
                            <div class="row p-4">
                                <div class="col-12">
                                    <?php $i = 0; ?>
                                    
                                    <form id="reflectiveJournalformData-{{$QuestionData[0]['award_id']}}-{{$index}}" class="reflectiveJournalformData">
                                        <div class="accordion accordion-flush" id="accordionExample">
                                            <input type="hidden" name="exam_id" id="exam_id"
                                                value="{{ isset($QuestionData[0]['id']) ? base64_encode($QuestionData[0]['id']) : '' }}">
                                            <input type="hidden" name="course_id" id="exam_id"
                                                value="{{ isset($QuestionData[0]['award_id']) ? base64_encode($QuestionData[0]['award_id']) : '' }}">
                                            <input type="hidden" name="master_course_id" id="master_course_id"
                                                value="{{ isset($master_course_id) ? base64_encode($master_course_id) : '' }}">
                                            <input type="hidden" name="exam_type" id="exam_type" value="{{ base64_encode(1) }}">
                                            <input type="hidden" name="student_course_master_id" id="student_course_master_id" value="{{base64_encode($student_course_master_id)}}">
                                            <input type="hidden" name="index" id="index" value="{{$index}}">

                                            @if (isset($QuestionData[0]['id']))
                                                @foreach ($QuestionData[0]['reflective_journal_question'] as $key => $item)
                                                    <form class="reflectiveJournalSubmitAnswer">
                                                        
                                                        <input type="hidden" name="student_course_master_id" id="student_course_master_id" value="{{base64_encode($student_course_master_id)}}">
                                                        <input type="hidden" name="exam_id" id="exam_id" value="{{ isset($QuestionData[0]['id']) ? base64_encode($QuestionData[0]['id']) : '' }}">
                                                        <input type="hidden" name="course_id" id="exam_id" value="{{ isset($QuestionData[0]['award_id']) ? base64_encode($QuestionData[0]['award_id']) : '' }}">
                                                        <input type="hidden" name="index" id="index" value="{{$index}}">
                                                        <input type="hidden" name="key" id="key" value="{{$key}}">
            
                                                        <input type="hidden" name="question_id" id="question_id" value="{{base64_encode($item['id'])}}">
                                                        <input type="hidden" name="answer_limit" id="answer_limit" value="{{ base64_encode($item['answer_limit']) }}">
                                                        <input type="hidden" name="type" id="type" value="Reflective Journal">
                                                        <input type="hidden" name="master_course_id" id="master_course_id" value="{{ isset($master_course_id) ? base64_encode($master_course_id) : '' }}">
            
                                                        @php
                                                            if (session()->has('lastAnswerSubmit')) {
                                                                $lastAnswerSubmit = session('lastAnswerSubmit');
                                                            } else {
                                                                $lastAnswerSubmit = 0;
                                                            }
                                                        @endphp
                                                        <div class="pt-3 pb-0" id="headingOne">
                                                            <h3 class="mb-0 fw-bold">
                                                                <a
                                                                href="#"
                                                                class="d-flex align-items-center text-inherit {{ $key === $lastAnswerSubmit ? 'active' : '' }}"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapse{{$key}}"
                                                                aria-expanded="{{$key=== 0 ? 'true' : 'false'}}" 
                                                                aria-controls="collapse{{$key}}">
                                                                <span class="me-auto fs-4">
                                                                    <span class="reflectivejournalquestions" style="font-size: 15px">Q{{$key+1}}. </span> 
                                                                    <span class="text-primary reflectivejournalquestions fw-semibold " style="font-size: 15px">{!! $item['question'] !!}</span>
                                                                </span>
                                                                <span class="ms-4 fw-semibold reflectivemarks" style="color: #6c757d; font-size: 14px; white-space: nowrap;">
                                                                    [{{ $item['marks'] }} Marks]
                                                                </span>
                                                                <span class="collapse-toggle ms-4">
                                                                    <i class="fe fe-plus text-primary reflectiveplusicon"></i>
                                                                </span>
                                                            </a>
                                                            </h3>
                                                        </div>
                                                        <div id="collapse{{$key}}" class="collapse {{ $key === $lastAnswerSubmit ? 'show' : '' }} reflective-journal-custom" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                            <div class="py-3">
                                                                @php 
                                                                    $submittedAnswerData  = getData('exam_reflective_journal_answers', ['answer'], [
                                                                        'student_course_master_id' => $student_course_master_id,
                                                                        'user_id' => Auth::user()->id,
                                                                        'course_id' => $QuestionData[0]['award_id'],
                                                                        'question_id' => $item['id'],
                                                                        'is_active' => 1
                                                                    ]);
                                                                    $submittedAnswer = isset($submittedAnswerData[0]) ? $submittedAnswerData[0]->answer : '';
                                                                    $answerSubmitted = is_exist('exam_reflective_journal_answers', [
                                                                        'student_course_master_id' => $student_course_master_id,
                                                                        'user_id' => Auth::user()->id,
                                                                        'course_id' => $QuestionData[0]['award_id'],
                                                                        'question_id' => $item['id'],
                                                                        'is_active' => 1
                                                                    ]);
                                                                @endphp
                                                                
                                                                <textarea class="form-control mb-2" id="textarea-input" rows="6" name="answer" placeholder="Please write your answer here..." {{ $answerSubmitted == 1 ? 'disabled' : '' }}>{{ $submittedAnswer }}</textarea>
                                                                @if($answerSubmitted == 0)
                                                                    <p class="mb-0">
                                                                        <small>(The answer for question may not be greater than {{ $item['answer_limit'] }} words.)</small>
                                                                    </p>
                                                                    <div class="invalid-feedback mb-2" id="answer_error"></div>
                                                                    <button class="btn btn-primary w-auto submitReflectiveJournalAnswer mt-2" data-index="{{$index}}">Submit</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <?php $i++; ?>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="mt-5 text-center d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn btn-outline-primary w-auto" data-bs-target="#instructionModal-{{$QuestionData[0]['award_id']}}-{{$index}}" data-bs-toggle="modal">Submit Now</button>
                                        </div>
                                    </form>
                                </form> 
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        @include('frontend.exam.environment.declaration-form', [

            'modalId' => 'instructionModal-' . $QuestionData[0]['award_id'] . '-' . $index,
            'exam_name' => isset($QuestionData[0]['tittle']) 
                ? html_entity_decode($QuestionData[0]['tittle']) 
                : 'Reflective Journal',
            'submit_button_class' => 'submitReflectiveJournal',
            'extraRequirement' => ' data-index="' . e($index) . '" data-course_id="' . e($QuestionData[0]['award_id']) . '" data-action="submit"'
        ])
    @endif
@endif





