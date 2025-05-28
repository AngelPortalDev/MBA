<style>
    .video-embed-responsive {
        position: relative;
        display: block;
        width: 100%;
        padding: 0;
        background-color: #000;
        overflow: hidden;
    }

    .embed-responsive-16by9 {
        padding-bottom: 35.25%;
    }

    .video-embed-responsive iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
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
            'exam_type' => 4,
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
            // ->where(function ($query) {
            //     $query->where('exam_attempt_remain', 0)->orWhere('exam_remark', '1');
            // })
            ->latest()
            ->first();
            
        $peerReviewAnswer = getData('exam_peer_review_answers', ['answer'], ['student_course_master_id' => $student_course_master_id, 'is_active' => '1']);
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
                        echo isset($QuestionData[0]['instructions'])
                            ? html_entity_decode($QuestionData[0]['instructions'])
                            : '';
                    @endphp
                </div>

                <div class="col-md-12 mb-1">
                    <label for="exampleFormControlTextarea1 " class="form-label color-blue" style="font-size: 15px">Peer Review Video</label>
                    <div class="video-embed-responsive embed-responsive-16by9 mb-3">
                        <iframe class="embed-responsive-item"
                            src="https://iframe.mediadelivery.net/embed/{{ env('Student_LIBRARY_ID') }}/{{ $QuestionData[0]['instrcution_file_url'] }}"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <form id="peerReviewExamFormData-{{$QuestionData[0]['award_id']}}-{{$index}}" class="peerReviewExamFormData">
                    <input type="hidden" name="exam_id" id="exam_id"
                        value="{{ isset($QuestionData[0]['id']) ? base64_encode($QuestionData[0]['id']) : '' }}">
                    <input type="hidden" name="course_id" id="course_id"
                        value="{{ isset($QuestionData[0]['award_id']) ? base64_encode($QuestionData[0]['award_id']) : '' }}">
                    <input type="hidden" name="master_course_id" id="master_course_id"
                        value="{{ isset($master_course_id) ? base64_encode($master_course_id) : '' }}">
                    <input type="hidden" name="exam_type" id="exam_type" value="{{ base64_encode(4) }}">
                    <input type="hidden" name="student_course_master_id" id="student_course_master_id" value="{{base64_encode($student_course_master_id)}}">
                    <input type="hidden" name="type" id="type" value="Peer Review">
                    <input type="hidden" name="index" id="index" value="{{$index}}">

                    <div class="mb-3 mt-3">
                        <label for="exampleFormControlTextarea1" class="form-label color-blue" style="font-size: 15px">Feedback</label>
                        <textarea class="form-control" id="answer" rows="8" name="answer" placeholder="Please Write your feedback..." style="border-radius: 5px; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);">{{isset($peerReviewAnswer[0]) ? $peerReviewAnswer[0]->answer : ''}}</textarea>
                        <small class="mt-2 d-block invalid-feedback" id="feedback_error" style="display:none;color:#000;">(Feedback must be less than 1500 words)</small>
                        <a class="btn btn-primary mt-3" type="button" style="width: auto" data-bs-target="#instructionModal-{{$QuestionData[0]['award_id']}}-{{$index}}" data-bs-toggle="modal">Submit Now</a>
                        <a class="btn btn-primary mt-3 draftPeerReviewExam" type="button" style="width: auto" data-action="draft" data-index="{{$index}}" data-course_id="{{$QuestionData[0]['award_id']}}">Draft</a>
                    </div>
                </form>
            </div>
        </section>
        @include('frontend.exam.environment.declaration-form', [
            'modalId' => 'instructionModal-' . $QuestionData[0]['award_id'] . '-' . $index,
            'exam_name' => isset($QuestionData[0]['tittle']) 
                ? html_entity_decode($QuestionData[0]['tittle']) 
                : 'Vlog',
            'submit_button_class' => 'submitPeerReviewExam',
            'extraRequirement' => ' data-index="' . e($index) . '" data-course_id="' . e($QuestionData[0]['award_id']) . '" data-action="submit"'
        ])
    @endif
@endif
