
<div class="accordion accordion-flush" id="accordionExample">
    <div class="border p-3 rounded-3 mb-2" id="headingOne1">
        <h3 class="mb-0 fs-4">
            <a href="#"
                class="d-flex align-items-center text-inherit active"
                data-bs-toggle="collapse"
                data-bs-target="#collapseOne1" aria-expanded="true"
                aria-controls="collapseOne1">
                <span
                    class="me-auto">{{ isset($courseData['course_title']) ? $courseData['course_title'] : '' }}
                    {{-- <span class="badge bg-success-soft ms-2">Pass</span> --}}
                </span>
                <span class="collapse-toggle ms-4">
                    <i class="fe fe-chevron-down"></i>
                </span>
            </a>
        </h3>

        <div id="collapseOne1" class="collapse show"
            aria-labelledby="headingOne1"
            data-bs-parent="#accordionExample" style="">
            <div class="pt-2">
                <ul class="ps-3">
                    @foreach ($ementorStudentData['studentData'] as $key =>  $exam)

                        @php
                            $examtype = $exam['exam_type'];
                            
                            // assignment
                            $exam_assign = isset(
                                $exam['exam_course'][0][
                                    'assginment_status'
                                ][$key]['assginment_exam'][0],
                            )
                                ? $exam['exam_course'][0][
                                    'assginment_status'
                                ][0]['assginment_exam'][0]
                                : [];
                            // mock
                            $exam_mock = isset(
                                $exam['exam_course'][0][
                                    'mock_exam_status'
                                ][0]['mock_exam'][0],
                            )
                                ? $exam['exam_course'][0][
                                    'mock_exam_status'
                                ][0]['mock_exam'][0]
                                : [];
                            // vlog
                            $exam_vlog = isset(
                                $exam['exam_course'][0][
                                    'vlog_status'
                                ][0]['vlog_exam'][0],
                            )
                                ? $exam['exam_course'][0][
                                    'vlog_status'
                                ][0]['vlog_exam'][0]
                                : [];
                            // peer_review
                            $exam_peer_review = isset(
                                $exam['exam_course'][0][
                                    'peer_review_status'
                                ][0]['peer_review_exam'][0],
                            )
                                ? $exam['exam_course'][0][
                                    'peer_review_status'
                                ][0]['peer_review_exam'][0]
                                : [];
                            // Forum leadership
                            $exam_discord = isset(
                                $exam['exam_course'][0][
                                    'discord_status'
                                ][0]['discord_exam'][0],
                            )
                                ? $exam['exam_course'][0][
                                    'discord_status'
                                ][0]['discord_exam'][0]
                                : [];
                            // reflective journal
                            $exam_reflective_journal = isset(
                                $exam['exam_course'][0][
                                    'reflective_journal_status'
                                ][0]['reflective_journal_exam'][0],
                            )
                                ? $exam['exam_course'][0][
                                    'reflective_journal_status'
                                ][0]['reflective_journal_exam'][0]
                                : [];
                            // multiple choice
                            $exam_mcq = isset(
                                $exam['exam_course'][0][
                                    'mcq_status'
                                ][0]['mcq_exam'][0],
                            )
                                ? $exam['exam_course'][0][
                                    'mcq_status'
                                ][0]['mcq_exam'][0]
                                : [];
                            $total_mark_obtain += isset(
                                $exam['final_score_obtain'],
                            )
                                ? $exam['final_score_obtain']
                                : 0;
                            // survey
                            $exam_survey = isset(
                                $exam['exam_course'][0][
                                    'survey_status'
                                ][0]['survey_exam'][0],
                            )
                                ? $exam['exam_course'][0][
                                    'survey_status'
                                ][0]['survey_exam'][0]
                                : [];
                            // artificial intelligence
                            $exam_artificial_intelligence = isset(
                                $exam['exam_course'][0][
                                    'artificial_intelligence_status'
                                ][0]['artificial_intelligence_exam'][0],
                            )
                                ? $exam['exam_course'][0][
                                    'artificial_intelligence_status'
                                ][0]['artificial_intelligence_exam'][0]
                                : [];
                            $total_mark_obtain += isset(
                                $exam['final_score_obtain'],
                            )
                                ? $exam['final_score_obtain']
                                : 0;

                        @endphp
                        
                        {{-- assignment --}}
                        @if ($examtype === 1)
                            @php
                                $assignmentExamCount = count($exam['exam_course'][0]['assginment_status']);
                                $exam_assign = isset(
                                    $exam['exam_course'][0][
                                        'assginment_status'
                                    ][$assignmentExamCount > 1 ? $key : 0]['assginment_exam'][0],
                                )
                                    ? $exam['exam_course'][0][
                                        'assginment_status'
                                    ][$assignmentExamCount > 1 ? $key : 0]['assginment_exam'][0]
                                    : [];
                            @endphp
                            <li class="mb-2">

                                @if ($exam['is_cheking_completed'] === '2')
                                    <a href="#"
                                        class="fw-semibold"
                                        @disabled(true)>
                                        {{ isset($exam_assign['assignment_tittle']) ? html_entity_decode($exam_assign['assignment_tittle']) : '' }} 
                                        ({{ isset($exam_assign['assignment_percentage']) ? $exam_assign['assignment_percentage'] : 0 }}%)
                                        <i
                                            class="bi bi-arrow-right fw-bold"></i></a>
                                @else
                                    @if (Auth::user()->role === 'instructor' || Auth::user()->role === 'sub-instructor')
                                        <a href="{{ url('/ementor/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(1), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold assignmentTitleSection text-primary">
                                            {{ isset($exam_assign['assignment_tittle']) ? html_entity_decode($exam_assign['assignment_tittle']) : '' }} 
                                            ({{ isset($exam_assign['assignment_percentage']) ? $exam_assign['assignment_percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @else
                                        <a href="{{ url('/admin/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(1), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold assignmentTitleSection text-primary">
                                            {{ isset($exam_assign['assignment_tittle']) ? html_entity_decode($exam_assign['assignment_tittle']) : '' }} 
                                            ({{ isset($exam_assign['assignment_percentage']) ? $exam_assign['assignment_percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @endif
                                @endif
                                <ul class="ps-3">
                                    <li
                                        class="fs-md-6 badge text-bg-primary text-white marksObtainedTitle">
                                        <span>Total Marks
                                            Obtained:</span> <span>
                                            {{ isset($exam['final_obtain_percentage']) ? $exam['final_obtain_percentage'] : 0 }}%</span>
                                    </li>
                                </ul>
                                <?php
                                    $totalPercentage += $exam['final_obtain_percentage'];
                                ?>
                            </li>

                        {{-- mock --}}
                        @elseif($examtype === 2)
                            @php
                                $exam_mock = isset(
                                    $exam['exam_course'][0][
                                        'mock_exam_status'
                                    ][0]['mock_exam'][0],
                                )
                                    ? $exam['exam_course'][0][
                                        'mock_exam_status'
                                    ][0]['mock_exam'][0]
                                    : [];
                            @endphp
                            <li class="mb-2">

                                @if ($exam['is_cheking_completed'] === '2')
                                    <a href="#"
                                        class="fw-semibold mockTitleSection text-primary">{{ isset($exam_mock['title']) ? html_entity_decode($exam_mock['title']) : '' }}
                                        ({{ isset($exam_mock['percentage']) ? $exam_mock['percentage'] : 0 }}%)
                                        <i
                                            class="bi bi-arrow-right fw-bold"></i></a>
                                @else
                                    @if (Auth::user()->role === 'instructor' || Auth::user()->role === 'sub-instructor')
                                    <a href="{{ url('/ementor/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(2), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold mockTitleSection text-primary">{{ isset($exam_mock['title']) ? html_entity_decode($exam_mock['title']) : '' }}
                                            ({{ isset($exam_mock['percentage']) ? $exam_mock['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @else
                                        <a href="{{ url('/admin/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(2), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold mockTitleSection text-primary">{{ isset($exam_mock['title']) ? html_entity_decode($exam_mock['title']) : '' }}
                                            ({{ isset($exam_mock['percentage']) ? $exam_mock['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @endif
                                @endif
                                <ul class="ps-3">
                                    <li
                                        class="fs-md-6 badge text-bg-primary text-white marksObtainedTitle">
                                        <span>Total Marks
                                            Obtained:</span> <span>
                                            {{ isset($exam['final_obtain_percentage']) ? $exam['final_obtain_percentage'] : 0 }}%</span>
                                    </li>
                                </ul>
                            </li>
                            <?php
                                $totalPercentage += $exam['final_obtain_percentage'];
                            ?>

                        {{-- vlog --}}
                        @elseif($examtype === 3)
                            @php
                                $exam_vlog = isset(
                                    $exam['exam_course'][0][
                                        'vlog_status'
                                    ][0]['vlog_exam'][0],
                                )
                                    ? $exam['exam_course'][0][
                                        'vlog_status'
                                    ][0]['vlog_exam'][0]
                                    : [];
                            @endphp
                            <li class="mb-2">

                                @if ($exam['is_cheking_completed'] === '2')
                                    <a href="#"
                                        class="fw-semibold">{{ isset($exam_vlog['title']) ? html_entity_decode($exam_vlog['title']) : '' }}
                                        ({{ isset($exam_vlog['percentage']) ? $exam_vlog['percentage'] : 0 }}%)
                                        <i
                                            class="bi bi-arrow-right fw-bold"></i></a>
                                @else
                                    @if (Auth::user()->role === 'instructor' || Auth::user()->role === 'sub-instructor')
                                        <a href="{{ url('/ementor/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(3), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">{{ isset($exam_vlog['title']) ? html_entity_decode($exam_vlog['title']) : '' }}
                                            ({{ isset($exam_vlog['percentage']) ? $exam_vlog['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @else
                                        <a href="{{ url('/admin/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(3), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">{{ isset($exam_vlog['title']) ? html_entity_decode($exam_vlog['title']) : '' }}
                                            ({{ isset($exam_vlog['percentage']) ? $exam_vlog['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @endif
                                @endif
                                <ul class="ps-3">
                                    <li
                                        class="fs-md-6 badge text-bg-primary text-white marksObtainedTitle">
                                        <span>Total Marks
                                            Obtained:</span> <span>
                                            {{ isset($exam['final_obtain_percentage']) ? $exam['final_obtain_percentage'] : 0 }}%</span>
                                    </li>
                                </ul>
                            </li>
                            <?php
                            $totalPercentage += $exam['final_obtain_percentage'];
                            ?>

                        {{-- peer review --}}
                        @elseif($examtype === 4)
                            @php
                                $exam_peer_review = isset(
                                    $exam['exam_course'][0][
                                        'peer_review_status'
                                    ][0]['peer_review_exam'][0],
                                )
                                    ? $exam['exam_course'][0][
                                        'peer_review_status'
                                    ][0]['peer_review_exam'][0]
                                    : [];
                            @endphp
                            <li class="mb-2">

                                @if ($exam['is_cheking_completed'] === '2')
                                    <a href="#"
                                        class="fw-semibold">{{ isset($exam_peer_review['title']) ? html_entity_decode($exam_peer_review['title']) : '' }}
                                        ({{ isset($exam_peer_review['percentage']) ? $exam_peer_review['percentage'] : 0 }}%)
                                        <i
                                            class="bi bi-arrow-right fw-bold"></i></a>
                                @else
                                    @if (Auth::user()->role === 'instructor' || Auth::user()->role === 'sub-instructor')
                                        <a href="{{ url('/ementor/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(4), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">{{ isset($exam_peer_review['title']) ? html_entity_decode($exam_peer_review['title']) : '' }}
                                            ({{ isset($exam_peer_review['percentage']) ? $exam_peer_review['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @else
                                        <a href="{{ url('/admin/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(4), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">{{ isset($exam_peer_review['title']) ? html_entity_decode($exam_peer_review['title']) : '' }}
                                            ({{ isset($exam_peer_review['percentage']) ? $exam_peer_review['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @endif
                                @endif
                                <ul class="ps-3">
                                    <li
                                        class="fs-md-6 badge text-bg-primary text-white marksObtainedTitle">
                                        <span>Total Marks
                                            Obtained:</span> <span>
                                            {{ isset($exam['final_obtain_percentage']) ? $exam['final_obtain_percentage'] : 0 }}%</span>
                                    </li>
                                </ul>
                            </li>
                            <?php
                                $totalPercentage += $exam['final_obtain_percentage'];
                            ?>

                        {{-- forum leadership --}}
                        @elseif($examtype === 5)
                            @php
                                $exam_discord = isset(
                                    $exam['exam_course'][0][
                                        'discord_status'
                                    ][0]['discord_exam'][0],
                                )
                                    ? $exam['exam_course'][0][
                                        'discord_status'
                                    ][0]['discord_exam'][0]
                                    : [];
                            @endphp
                            <li class="mb-2">

                                @if ($exam['is_cheking_completed'] === '2')
                                    <a href="#"
                                        class="fw-semibold">Forum Leadership
                                        ({{ isset($exam_discord['percentage']) ? $exam_discord['percentage'] : 0 }}%)
                                        <i
                                            class="bi bi-arrow-right fw-bold"></i></a>
                                @else
                                    @if (Auth::user()->role === 'instructor' || Auth::user()->role === 'sub-instructor')
                                        <a href="{{ url('/ementor/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(5), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">Forum Leadership
                                            ({{ isset($exam_discord['percentage']) ? $exam_discord['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @else
                                        <a href="{{ url('/admin/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(5), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">Forum Leadership
                                            ({{ isset($exam_discord['percentage']) ? $exam_discord['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @endif
                                @endif
                                <ul class="ps-3">
                                    <li
                                        class="fs-md-6 badge text-bg-primary text-white marksObtainedTitle">
                                        <span>Total Marks
                                            Obtained:</span> <span>
                                            {{ isset($exam['final_obtain_percentage']) ? $exam['final_obtain_percentage'] : 0 }}%</span>
                                    </li>
                                </ul>
                            </li>
                            <?php
                            $totalPercentage += $exam['final_obtain_percentage'];
                            ?>

                        {{-- reflective journal --}}
                        @elseif($examtype === 6)
                            @php
                                $exam_reflective_journal = isset(
                                    $exam['exam_course'][0][
                                        'reflective_journal_status'
                                    ][0]['reflective_journal_exam'][0],
                                )
                                    ? $exam['exam_course'][0][
                                        'reflective_journal_status'
                                    ][0]['reflective_journal_exam'][0]
                                    : [];
                            @endphp
                            <li class="mb-2">

                                @if ($exam['is_cheking_completed'] === '2')
                                    <a href="#"
                                        class="fw-semibold">{{ isset($exam_reflective_journal['title']) ? html_entity_decode($exam_reflective_journal['title']) : '' }}
                                        ({{ isset($exam_reflective_journal['percentage']) ? $exam_reflective_journal['percentage'] : 0 }}%)
                                        <i
                                            class="bi bi-arrow-right fw-bold"></i></a>
                                @else
                                    @if (Auth::user()->role === 'instructor' || Auth::user()->role === 'sub-instructor')
                                        <a href="{{ url('/ementor/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(6), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">{{ isset($exam_reflective_journal['title']) ? html_entity_decode($exam_reflective_journal['title']) : '' }}
                                            ({{ isset($exam_reflective_journal['percentage']) ? $exam_reflective_journal['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @else
                                        <a href="{{ url('/admin/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(6), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">{{ isset($exam_reflective_journal['title']) ? html_entity_decode($exam_reflective_journal['title']) : '' }}
                                            ({{ isset($exam_reflective_journal['percentage']) ? $exam_reflective_journal['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @endif
                                @endif
                                <ul class="ps-3">
                                    <li
                                        class="fs-md-6 badge text-bg-primary text-white marksObtainedTitle">
                                        <span>Total Marks
                                            Obtained:</span> <span>
                                            {{ isset($exam['final_obtain_percentage']) ? $exam['final_obtain_percentage'] : 0 }}%</span>
                                    </li>
                                </ul>
                            </li>
                            <?php
                            $totalPercentage += $exam['final_obtain_percentage'];
                            ?>

                        {{-- multiple choice --}}
                        @elseif($examtype === 7)
                            @php
                                $exam_mcq = isset(
                                    $exam['exam_course'][0][
                                        'mcq_status'
                                    ][0]['mcq_exam'][0],
                                )
                                    ? $exam['exam_course'][0][
                                        'mcq_status'
                                    ][0]['mcq_exam'][0]
                                    : [];
                            @endphp
                            <li class="mb-2">
                                @if ($exam['is_cheking_completed'] === '2')
                                    <a href="#"
                                        class="fw-semibold">{{ isset($exam_mcq['title']) ? html_entity_decode($exam_mcq['title']) : '' }}
                                        ({{ isset($exam_mcq['percentage']) ? $exam_mcq['percentage'] : 0 }}%)
                                        <i
                                            class="bi bi-arrow-right fw-bold"></i></a>
                                @else
                                    @if (Auth::user()->role === 'instructor' || Auth::user()->role === 'sub-instructor')
                                        <a href="{{ url('/ementor/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(7), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">{{ isset($exam_mcq['title']) ? html_entity_decode($exam_mcq['title']) : '' }}
                                            ({{ isset($exam_mcq['percentage']) ? $exam_mcq['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @else
                                        <a href="{{ url('/admin/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(7), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">{{ isset($exam_mcq['title']) ? html_entity_decode($exam_mcq['title']) : '' }}
                                            ({{ isset($exam_mcq['percentage']) ? $exam_mcq['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @endif
                                @endif
                                <ul class="ps-3">
                                    <li
                                        class="fs-md-6 badge text-bg-primary text-white marksObtainedTitle">
                                        <span>Total Marks
                                            Obtained:</span> <span>
                                            {{ isset($exam['final_obtain_percentage']) ? $exam['final_obtain_percentage'] : 0 }}%</span>
                                    </li>
                                </ul>
                            </li>
                            <?php
                                $totalPercentage += $exam['final_obtain_percentage'];
                            ?>
                            
                        {{-- survey --}}
                        @elseif($examtype === 8)
                            @php
                                $exam_survey = isset(
                                    $exam['exam_course'][0][
                                        'survey_status'
                                    ][0]['survey_exam'][0],
                                )
                                    ? $exam['exam_course'][0][
                                        'survey_status'
                                    ][0]['survey_exam'][0]
                                    : [];
                            @endphp
                            <li class="mb-2">

                                @if ($exam['is_cheking_completed'] === '2')
                                    <a href="#"
                                        class="fw-semibold">{{ isset($exam_survey['title']) ? html_entity_decode($exam_survey['title']) : '' }}
                                        ({{ isset($exam_survey['percentage']) ? $exam_survey['percentage'] : 0 }}%)
                                        <i
                                            class="bi bi-arrow-right fw-bold"></i></a>
                                @else
                                    @if (Auth::user()->role === 'instructor' || Auth::user()->role === 'sub-instructor')
                                        <a href="{{ url('/ementor/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(8), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">{{ isset($exam_survey['title']) ? html_entity_decode($exam_survey['title']) : '' }}
                                            ({{ isset($exam_survey['percentage']) ? $exam_survey['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @else
                                        <a href="{{ url('/admin/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(8), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">{{ isset($exam_survey['title']) ? html_entity_decode($exam_survey['title']) : '' }}
                                            ({{ isset($exam_survey['percentage']) ? $exam_survey['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @endif
                                @endif
                                <ul class="ps-3">
                                    <li
                                        class="fs-md-6 badge text-bg-primary text-white marksObtainedTitle">
                                        <span>Total Marks
                                            Obtained:</span> <span>
                                            {{ isset($exam['final_obtain_percentage']) ? $exam['final_obtain_percentage'] : 0 }}%</span>
                                    </li>
                                </ul>
                            </li>
                            <?php
                            $totalPercentage += $exam['final_obtain_percentage'];
                            ?>
                            
                        {{-- artificial intelligence --}}
                        @elseif($examtype === 9)
                            @php
                                $exam_artificial_intelligence = isset(
                                    $exam['exam_course'][0][
                                        'artificial_intelligence_status'
                                    ][0]['artificial_intelligence_exam'][0],
                                )
                                    ? $exam['exam_course'][0][
                                        'artificial_intelligence_status'
                                    ][0]['artificial_intelligence_exam'][0]
                                    : [];
                            @endphp
                            <li class="mb-2">

                                @if ($exam['is_cheking_completed'] === '2')
                                    <a href="#"
                                        class="fw-semibold">{{ isset($exam_artificial_intelligence['title']) ? html_entity_decode($exam_artificial_intelligence['title']) : '' }}
                                        ({{ isset($exam_artificial_intelligence['percentage']) ? $exam_artificial_intelligence['percentage'] : 0 }}%)
                                        <i
                                            class="bi bi-arrow-right fw-bold"></i></a>
                                @else
                                    @if (Auth::user()->role === 'instructor' || Auth::user()->role === 'sub-instructor')
                                        <a href="{{ url('/ementor/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(9), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">{{ isset($exam_artificial_intelligence['title']) ? html_entity_decode($exam_artificial_intelligence['title']) : '' }}
                                            ({{ isset($exam_artificial_intelligence['percentage']) ? $exam_artificial_intelligence['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @else
                                        <a href="{{ url('/admin/answersheet', ['exam_id' => base64_encode($exam['id']), 'exam_type' => base64_encode(9), 'user_id' => base64_encode($exam['user_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) }}"
                                            class="fw-semibold vlogTitleSection text-primary">{{ isset($exam_artificial_intelligence['title']) ? html_entity_decode($exam_artificial_intelligence['title']) : '' }}
                                            ({{ isset($exam_artificial_intelligence['percentage']) ? $exam_artificial_intelligence['percentage'] : 0 }}%)
                                            <i
                                                class="bi bi-arrow-right fw-bold"></i></a>
                                    @endif
                                @endif
                                <ul class="ps-3">
                                    <li
                                        class="fs-md-6 badge text-bg-primary text-white marksObtainedTitle">
                                        <span>Total Marks
                                            Obtained:</span> <span>
                                            {{ isset($exam['final_obtain_percentage']) ? $exam['final_obtain_percentage'] : 0 }}%</span>
                                    </li>
                                </ul>
                            </li>
                            <?php
                            $totalPercentage += $exam['final_obtain_percentage'];
                            ?>
                        @endif
                    @endforeach

                    {{-- eportfolio --}}
                    @php
                        $exists = is_exist('exam_eportfolio', [
                            'user_id' =>
                                $ementorStudentData[
                                    'studentData'
                                ][0]['user_id'],
                            'course_id' =>
                                $ementorStudentData[
                                    'studentData'
                                ][0]['course_id'],
                            'student_course_master_id' => $exam['student_course_master_id'],
                        ]);
                    @endphp

                    @if (isset($exists) && is_numeric($exists) && !empty($exists) && $exists > 0)
                        <li class="mb-2">
                            
                            <a href="{{ 
                                Auth::user()->role === 'instructor' ? 
                                    url('ementor/e-portfolio-answersheet', ['user_id' => base64_encode($stData['id']), 'course' => base64_encode($exam['course_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) :
                                    (isset($exists) && is_numeric($exists) && !empty($exists) && $exists > 0 ?
                                    url('admin/e-portfolio-answersheet', ['user_id' => base64_encode($stData['id']), 'course' => base64_encode($exam['course_id']), 'student_course_master_id' => base64_encode($exam['student_course_master_id'])]) : '#') 
                                }}" 
                                class="fw-semibold portfolioTitleSection text-primary">
                                E-portfolio
                                <i class="bi bi-arrow-right fw-bold"></i>
                            </a>
                            

                            @if (isset($exists) && is_numeric($exists) && !empty($exists) && $exists > 0)
                                <ul class="ps-3">
                                    @php
                                        $eportfolio = getData('exam_eportfolio', ['remark'], ['user_id' => $ementorStudentData['studentData'][0]['user_id'], 'course_id' => $exam['course_id'], 'student_course_master_id' => $exam['student_course_master_id']], '1', 'created_at', 'desc');
                                        $remark = isset($eportfolio[0]->remark) ? $eportfolio[0]->remark : '';
                                    @endphp
                                    <li class="fs-md-6 badge text-bg-{{ $remark == '1' ? 'success' : ($remark == '0' ? 'danger' : 'warning') }} text-white marksObtainedTitle">
                                        <span>Remark:</span>
                                        <span>{{ $remark == '1' ? 'Pass' : ($remark == '0' ? 'Fail' : 'Not Checked') }}</span>
                                    </li>
                                    
                                </ul>
                            @else
                                <ul class="ps-3">
                                    <li
                                        class="fs-md-6 text-bg-warning text-white marksObtainedTitle">
                                        <span>Remark:</span> <span>
                                            Checked</span>
                                    </li>
                                </ul>
                            @endif
                        </li>
                    @endif
                    <div class="card-footer">
                        <span class="fw-bold color-blue">Total Marks Obtained:</span> <span
                            class="text-success fw-bold"> {{ $totalPercentage }}%</span>
                    </div>
                </ul>
            </div>
        </div>
    </div>

</div>
