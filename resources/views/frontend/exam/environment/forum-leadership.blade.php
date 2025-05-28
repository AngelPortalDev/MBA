@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

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
                <h3 class="mb-0 text-truncate-line-2 color-blue studentAssignmentTitle">Forum leadership
                    ({{ isset($QuestionData[0]['percentage']) ? $QuestionData[0]['percentage'] : '' }}%)</h3>
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
            'exam_type' => 5,
            'attempt_remain' => 0,
            'is_active' => 1,
            'is_cheking_completed' => '2',
        ]) > 0)
    @include('frontend.exam.environment.submitted-successfully', ['message' => 'Forum Leadership']);
@else
    @php
        $studentCourseMaster = DB::table('student_course_master')
            ->where('id', $student_course_master_id)
            ->where('user_id', Auth::id())
            // ->where('course_id', $QuestionData[0]['award_id'])
            // ->where(function ($query) {
            //     $query->where('exam_attempt_remain', 0)->orWhere('exam_remark', '1');
            // })
            // ->latest()
            ->first();
    @endphp
    @if (isset($studentCourseMaster) && !empty($studentCourseMaster) && ($studentCourseMaster->exam_attempt_remain == '0' || $studentCourseMaster->exam_remark == '1'))
        @include('frontend.exam.environment.submitted-successfully', ['message' => 'Forum Leadership']);
    @else
    <section class="container-fluid ps-4 pe-3">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 class="text-start mb-4">
                    Forum Leadership Instructions
                </h4>
                
                <div class="card shadow-sm">
                    <div class="card-body">
                        <ol class="list-group list-group-flush">
                            <li class="list-group-item"> <i class="bi bi-check-circle text-success"></i> Define the purpose and goals of the discussion to guide participants.</li>
                            <li class="list-group-item"> <i class="bi bi-check-circle text-success"></i> Invite input from all members, ensuring diverse voices are included.</li>
                            <li class="list-group-item"> <i class="bi bi-check-circle text-success"></i> Be attentive to interactions, fostering a respectful and inclusive environment.</li>
                            <li class="list-group-item"> <i class="bi bi-check-circle text-success"></i> Mediate disagreements constructively to maintain a collaborative atmosphere.</li>
                            <li class="list-group-item"> <i class="bi bi-check-circle text-success"></i> Keep discussions on track by gently steering back to the agenda when necessary.</li>
                        </ol>
                        <div class="text-center mt-4">
                            <a href="{{ route('discordJoin', ['user_id' => base64_encode(Auth::id()), 'course_id' => base64_encode($QuestionData[0]['award_id']), 'exam_type' => base64_encode(5), 'student_course_master_id' => base64_encode($student_course_master_id)]) }}"
                               class="btn btn-primary btn-md" target="_blank">Go to Discord</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endif
