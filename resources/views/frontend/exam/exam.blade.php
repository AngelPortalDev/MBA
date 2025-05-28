@extends('frontend.master')
@section('content')
    <style>
        .content-show {
            display: none;
        }

        .content-show.active {
            display: block;
        }

        .content-link.active {
            color: #122c78;
            font-weight: 600;
            background-color: #eeedff;
            padding: 3px;
            border-radius: 5px;
        }

        .content-link {
            padding: 3px;
        }
        .simplebar-content-wrapper{
            overflow: inherit !important;
        }
    </style>
    <!-- Wrapper -->
    <div id="db-wrapper" class="course-video-player-page course-video-player-page-studentExamSection toggled">
        <!-- Sidebar -->

        <nav class="navbar-vertical navbar customeNavbar">
            <div class="" data-simplebar>
                <section class="card " id="courseAccordion">
                    <!-- List group -->


                    <ul class="list-group list-group-flush" style="height: 850px" data-simplebar="init">
                        <div class="simplebar-wrapper" style="margin: 0px;">
                            <div class="simplebar-height-auto-observer-wrapper">
                                <div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                        aria-label="scrollable content" style="height: 100%; overflow: hidden;">
                                        <div class="simplebar-content" style="padding: 0px;">
                                            <li class="list-group-item">
                                                <h3 class="mb-0 color-blue" style="font-size: 17px;">Exam</h3>
                                            </li>
                                            <!-- List group item -->
                                            <li class="list-group-item">
                                                <!-- Toggle -->
                                                @php
                                                    $courseName = '';
                                                    if (
                                                        isset($examDetails[0]['course_id']) &&
                                                        !empty($examDetails[0]['course_id'])
                                                    ) {
                                                        $course_id = $examDetails[0]['course_id'];
                                                        $course = getData(
                                                            'course_master',
                                                            ['course_title'],
                                                            ['id' => $course_id, 'is_deleted' => 'No'],
                                                        );
                                                        $courseName = isset($course[0]->course_title)
                                                            ? $course[0]->course_title
                                                            : '';
                                                    }

                                                @endphp

                                                <a class="d-flex align-items-center h4 mb-0" data-bs-toggle="collapse"
                                                    href="#courseTwo" role="button" aria-expanded="false"
                                                    aria-controls="courseTwo">
                                                    <div class="me-auto" style="font-size: 15px">{{ $courseName }}</div>
                                                    <!-- Chevron -->
                                                    <span class="chevron-arrow ms-4">
                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                    </span>
                                                </a>
                                                <!-- Row -->
                                                <!-- Collapse -->
                                                <div class="collapse show" id="courseTwo" data-bs-parent="#courseAccordion">
                                                    <div class="py-3 nav" id="course-tabOne" role="tablist"
                                                        aria-orientation="vertical" style="display: inherit">

                                                        @if (isset($examDetails) && count($examDetails) > 0)
                                                            @foreach ($examDetails as $index => $examData)
                                                            
                                                                {{-- assignment --}}
                                                                @if (isset($examData['exam_type']) &&
                                                                        !empty($examData['exam_type']) &&
                                                                        $examData['exam_type'] == 1 &&
                                                                        $examData['is_deleted'] == 'No')
                                                                    <a class="mb-2 d-flex justify-content-between align-items-center text-inherit content-link studentExamTitle"
                                                                        href="#" data-target="content1-{{$index}}"
                                                                        onclick="showContent('content1-{{$index}}')">
                                                                        <div class="d-flex align-items-center">
                                                                            <span
                                                                                class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green p-2">
                                                                                {{-- <i class="bi bi-journal-text fs-6 color-primary"></i> --}}
                                                                                <img src="{{ asset('frontend/images/icon/assignment-icon.svg')}}" alt="assignmnetIcon" style="height: 16px; width: 16px;"/>
                                                                                </span>
                                                                            <span
                                                                                class="text-inherit">{{ isset($examData['assignment_exam'][0]['assignment_tittle']) ? html_entity_decode($examData['assignment_exam'][0]['assignment_tittle']) : '' }}</span>
                                                                        </div>
                                                                        <div class="text-muted mb-2">
                                                                            <span
                                                                                class="preview-course-heading">({{ isset($examData['assignment_exam'][0]['assignment_percentage']) ? $examData['assignment_exam'][0]['assignment_percentage'] : '' }}%)</span>
                                                                        </div>
                                                                    </a>
                                                                @endif

                                                                {{-- mock interview --}}
                                                                @if (isset($examData['exam_type']) &&
                                                                        !empty($examData['exam_type']) &&
                                                                        $examData['exam_type'] == 2 &&
                                                                        $examData['is_deleted'] == 'No')
                                                                    <a class="mb-2 d-flex justify-content-between align-items-center text-inherit content-link studentExamTitle"
                                                                        href="#" data-target="content2-{{ $index }}"
                                                                        onclick="showContent('content2-{{ $index }}')">
                                                                        <div class="d-flex align-items-center">
                                                                            <span
                                                                                class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green p-2">
                                                                                {{-- <i class="bi bi-journal-text fs-6 color-primary"></i> --}}
                                                                                <img src="{{ asset('frontend/images/icon/mock-interview.svg')}}" alt="MockIcon" style="height: 16px; width: 16px;"/>
                                                                            </span>
                                                                            <span
                                                                                class="text-inherit">{{ isset($examData['mock_exam'][0]['title']) ? html_entity_decode($examData['mock_exam'][0]['title']) : '' }}</span>
                                                                        </div>
                                                                        <div class="text-muted mb-2">
                                                                            <span
                                                                                class="preview-course-heading">({{ isset($examData['mock_exam'][0]['percentage']) ? $examData['mock_exam'][0]['percentage'] : '' }}%)</span>
                                                                        </div>
                                                                    </a>
                                                                @endif

                                                                {{-- vlog --}}
                                                                @if (isset($examData['exam_type']) &&
                                                                        !empty($examData['exam_type']) &&
                                                                        $examData['exam_type'] == 3 &&
                                                                        $examData['is_deleted'] == 'No')
                                                                    <a class="mb-2 d-flex justify-content-between align-items-center text-inherit content-link studentExamTitle"
                                                                        href="#" data-target="content3-{{ $index }}"
                                                                        onclick="showContent('content3-{{ $index }}')">
                                                                        <div class="d-flex align-items-center">
                                                                            <span
                                                                                class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green p-2">
                                                                                {{-- <i class="bi bi-journal-text fs-6 color-primary"></i> --}}
                                                                                <img src="{{ asset('frontend/images/icon/vlog-icon.svg')}}" alt="VlogIcon" style="height: 16px; width: 16px;"/>
                                                                            </span>
                                                                                
                                                                            <span
                                                                                class="text-inherit">{{ isset($examData['vlog_exam'][0]['title']) ? html_entity_decode($examData['vlog_exam'][0]['title']) : '' }}</span>
                                                                        </div>
                                                                        <div class="text-muted mb-2">
                                                                            <span
                                                                                class="preview-course-heading">({{ isset($examData['vlog_exam'][0]['percentage']) ? $examData['vlog_exam'][0]['percentage'] : '' }}%)</span>
                                                                        </div>
                                                                    </a>
                                                                @endif

                                                                {{-- peer review --}}
                                                                @if (isset($examData['exam_type']) && !empty($examData['exam_type']) && $examData['exam_type'] == 4)
                                                                    <a class="mb-2 d-flex justify-content-between align-items-center text-inherit content-link studentExamTitle"
                                                                        href="#" data-target="content4-{{ $index }}"
                                                                        onclick="showContent('content4-{{ $index }}')">
                                                                        <div class="d-flex align-items-center">
                                                                            <span
                                                                                class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green p-2">
                                                                                {{-- <i class="bi bi-journal-text fs-6 color-primary"></i> --}}
                                                                                <img src="{{ asset('frontend/images/icon/peer-review.svg')}}" alt="portfolioIcon" style="height: 16px; width: 16px;"/>
                                                                                </span>
                                                                            <span
                                                                                class="text-inherit">{{ isset($examData['peer_review_exam'][0]['title']) ? html_entity_decode($examData['peer_review_exam'][0]['title']) : '' }}</span>
                                                                        </div>
                                                                        <div class="text-muted mb-2">
                                                                            <span
                                                                                class="preview-course-heading">({{ isset($examData['peer_review_exam'][0]['percentage']) ? $examData['peer_review_exam'][0]['percentage'] : '' }}%)</span>
                                                                        </div>
                                                                    </a>
                                                                @endif

                                                                {{-- forum leadership --}}
                                                                @if (isset($examData['exam_type']) && !empty($examData['exam_type']) && $examData['exam_type'] == 5)
                                                                    <a class="mb-2 d-flex justify-content-between align-items-center text-inherit content-link studentExamTitle"
                                                                        href="#" data-target="content5-{{ $index }}"
                                                                        onclick="showContent('content5-{{ $index }}')">
                                                                        <div class="d-flex align-items-center">
                                                                            <span
                                                                                class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green p-2">
                                                                                <img src="{{ asset('frontend/images/icon/forum-leadership.svg')}}" alt="ForumLeadershipIcon" style="height: 16px; width: 16px;"/>
                                                                                </span>
                                                                            <span
                                                                                class="text-inherit">Forum Leadership</span>
                                                                        </div>
                                                                        <div class="text-muted mb-2">
                                                                            <span
                                                                                class="preview-course-heading">({{ isset($examData['discord'][0]['percentage']) ? $examData['discord'][0]['percentage'] : '' }}%)</span>
                                                                        </div>
                                                                    </a>
                                                                @endif

                                                                {{-- reflective journals --}}
                                                                @if (isset($examData['exam_type']) && !empty($examData['exam_type']) && $examData['exam_type'] == 6)
                                                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit content-link studentExamTitle"
                                                                    href="#" data-target="content6-{{ $index }}"
                                                                    onclick="showContent('content6-{{ $index }}')">
                                                                        <div class="d-flex align-items-center">
                                                                            <span
                                                                                class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green p-2">
                                                                                {{-- <i class="bi bi-journal-text fs-6 color-primary"></i> --}}
                                                                                <img src="{{ asset('frontend/images/icon/reflective-journals.svg')}}" alt="Reflective_Journals" style="height: 16px; width: 16px;"/>
                                                                            </span>
                                                                            <span class="text-inherit">{{ isset($examData['reflective_journal_exam'][0]['title']) ? html_entity_decode($examData['reflective_journal_exam'][0]['title']) : '' }}</span>
                                                                        </div>
                                                                        <div class="text-muted mb-2">
                                                                            <span class="preview-course-heading">({{ isset($examData['reflective_journal_exam'][0]['percentage']) ? $examData['reflective_journal_exam'][0]['percentage'] : '' }}%)</span>
                                                                        </div>
                                                                    </a>
                                                                @endif

                                                                {{-- Multiple choice --}}
                                                                @if (isset($examData['exam_type']) && !empty($examData['exam_type']) && $examData['exam_type'] == 7)
                                                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit content-link studentExamTitle mcqActive-1"
                                                                    href="#" data-target="content7-{{ $index }}"
                                                                    onclick="showContent('content7-{{ $index }}')">
                                                                        <div class="d-flex align-items-center">
                                                                            <span
                                                                                class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green p-2">
                                                                                <img src="{{ asset('frontend/images/icon/mcq.svg')}}" alt="Reflective_Journals" style="height: 16px; width: 16px;"/>
                                                                            </span>
                                                                            <span class="text-inherit" >{{ isset($examData['mcq_exam'][0]['title']) ? html_entity_decode($examData['mcq_exam'][0]['title']) : '' }}</span>
                                                                        </div>
                                                                        <div class="text-muted mb-2">
                                                                            <span class="preview-course-heading">({{ isset($examData['mcq_exam'][0]['percentage']) ? $examData['mcq_exam'][0]['percentage'] : '' }}%)</span>
                                                                        </div>
                                                                    </a>
                                                                @endif

                                                                {{-- Survey --}}
                                                                @if (isset($examData['exam_type']) && !empty($examData['exam_type']) && $examData['exam_type'] == 8)
                                                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit content-link studentExamTitle"
                                                                    href="#" data-target="content8-{{ $index }}"
                                                                    onclick="showContent('content8-{{ $index }}')">
                                                                        <div class="d-flex align-items-center">
                                                                            <span
                                                                                class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green p-2">
                                                                                <img src="{{ asset('frontend/images/icon/survey.svg')}}" alt="Survey" style="height: 16px; width: 16px;"/>
                                                                            </span>
                                                                            <span class="text-inherit">{{ isset($examData['survey_exam'][0]['title']) ? html_entity_decode($examData['survey_exam'][0]['title']) : '' }}</span>
                                                                        </div>
                                                                        <div class="text-muted mb-2">
                                                                            <span class="preview-course-heading">({{ isset($examData['survey_exam'][0]['percentage']) ? $examData['survey_exam'][0]['percentage'] : '' }}%)</span>
                                                                        </div>
                                                                    </a>
                                                                @endif
                                                                
                                                                {{-- Artificial Intelligence --}}
                                                                @if (isset($examData['exam_type']) && !empty($examData['exam_type']) && $examData['exam_type'] == 9)
                                                                    <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit content-link studentExamTitle"
                                                                    href="#" data-target="content9-{{ $index }}"
                                                                    onclick="showContent('content9-{{ $index }}')">
                                                                        <div class="d-flex align-items-center">
                                                                            <span
                                                                                class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green p-2">
                                                                                <img src="{{ asset('frontend/images/icon/ai_icon.svg')}}" alt="Survey" style="height: 16px; width: 16px;"/>
                                                                            </span>
                                                                            <span class="text-inherit">{{ isset($examData['artificial_intelligence_exam'][0]['title']) ? html_entity_decode($examData['artificial_intelligence_exam'][0]['title']) : 'Artificial Intelligence' }}</span>
                                                                        </div>
                                                                        <div class="text-muted mb-2">
                                                                            <span class="preview-course-heading">({{ isset($examData['artificial_intelligence_exam'][0]['percentage']) ? $examData['artificial_intelligence_exam'][0]['percentage'] : '' }}%)</span>
                                                                        </div>
                                                                    </a>
                                                                @endif
                                                            @endforeach
                                                        @endif

                                                        {{-- Final Thesis --}}
                                                        {{-- <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit content-link studentExamTitle"
                                                            href="#" data-target="content10"
                                                            onclick="showContent('content10')">
                                                            <div class="d-flex align-items-center">
                                                                <span
                                                                    class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green">
                                                                    <img src="{{ asset('frontend/images/icon/final_thesis.svg')}}" alt="FinalThesis" style="height: 16px; width: 16px;"/>
                                                                </span>
                                                                <span class="text-inherit">Final Thesis</span>
                                                            </div>
                                                            <div class="text-muted mb-2">
                                                                <span class="preview-course-heading">-</span>
                                                            </div>
                                                        </a> --}}

                                                        {{-- eportfolio --}}
                                                        <a class=" mb-2 d-flex justify-content-between align-items-center text-inherit content-link studentExamTitle"
                                                            href="#" data-target="content-{{$examData['course_id']}}"
                                                            onclick="showContent('content-{{$examData['course_id']}}')">
                                                            <div class="d-flex align-items-center">
                                                                <span
                                                                    class="icon-shape bg-light text-primary icon-sm rounded-circle me-2 color-light-green p-2">
                                                                    {{-- <i class="bi bi-journal-text fs-6 color-primary"></i> --}}
                                                                    <img src="{{ asset('frontend/images/icon/portfolio-icon.svg')}}" alt="portfolioIcon" style="height: 16px; width: 16px;"/>
                                                                </span>
                                                                <span class="text-inherit">E-Portfolio</span>
                                                            </div>
                                                            <div class="text-muted mb-2">
                                                                <span class="preview-course-heading"></span>
                                                            </div>
                                                        </a>

                                                    </div>
                                                </div>
                                            </li>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: 380px; height: 691px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                        </div>
                    </ul>
                </section>

            </div>
        </nav>
        <!-- Right Side Page Content -->
        <main id="page-content">

            @if (isset($examDetails) && count($examDetails) > 0)
                @php
                    // dd(session('exam_type'));
                    $i = 1;
                    $show = '';
                @endphp
                
                @foreach ($examDetails as $index => $examData)
                    @php
                        $triggeredMcqActive = 0;
                        
                        if (!session()->has('eportfolio')) {
                            if($examDetails[0]['exam_type'] == 7 && !session()->has('exam_type')){
                                $triggeredMcqActive = 1;
                            }
                            $show = '';
                            if (!session()->has('exam_type')) {
                                if ($i === 1) {
                                    $show = 'active';
                                }
                            } else {

                                // if (session('exam_type') === 'content' . $examData['exam_type'] . '-' . $index) {
                                //     $show = 'active';
                                // }

                                if (session('exam_type') === 'content' . $examData['exam_type']. '-' . $index) {
                                    $show = 'active';
                                }
                                //  elseif ($examData['exam_type'] !== 1 && session('exam_type') === 'content' . $examData['exam_type']) {
                                //     $show = 'active';
                                // }
                            }
                        }
                    @endphp

                    @switch($examData['exam_type'])
                        {{-- Assignment --}}
                        @case(1)
                            <div id="content1-{{ $index }}" class="content-show {{ $show }}">
                                @include('frontend.exam.environment.assignment', [
                                    'QuestionData' => $examData['assignment_exam'],
                                    'student_course_master_id' => $student_course_master_id,
                                    'index' => $index,

                                ])
                            </div>
                            @php $i++;@endphp
                            @break

                        {{-- Mock Interview --}}
                        @case(2)
                            <div id="content2-{{ $index }}" class="content-show {{ $show }}">
                                @include('frontend.exam.environment.mock-interview', [
                                    'QuestionData' => $examData['mock_exam'],
                                    'student_course_master_id' => $student_course_master_id,
                                    'index' => $index,
                                ])
                            </div>
                            @php $i++; @endphp
                            @break

                        {{-- Vlog --}}
                        @case(3)
                            <div id="content3-{{ $index }}" class="content-show {{ $show }}">
                                @include('frontend.exam.environment.vlog', [
                                    'QuestionData' => $examData['vlog_exam'],
                                    'student_course_master_id' => $student_course_master_id,
                                    'index' => $index,
                                ])
                            </div>
                            @php $i++; @endphp
                            @break

                        {{-- Peer Review --}}
                        @case(4)
                            <div id="content4-{{ $index }}" class="content-show {{ $show }}">
                                @include('frontend.exam.environment.peer-review', [
                                    'QuestionData' => $examData['peer_review_exam'],
                                    'student_course_master_id' => $student_course_master_id,
                                    'index' => $index,
                                ])
                            </div>
                            @php $i++; @endphp
                            @break

                        {{-- Forum Leadership --}}
                        @case(5)
                            <div id="content5-{{ $index }}" class="content-show {{ $show }}">
                                @include('frontend.exam.environment.forum-leadership', [
                                    'QuestionData' => $examData['discord'],
                                    'student_course_master_id' => $student_course_master_id,
                                    'index' => $index,
                                ])
                            </div>
                            @php $i++; @endphp
                            @break

                        {{-- Reflective Journals --}}
                        @case(6)
                            <div id="content6-{{ $index }}" class="content-show {{ $show }}">
                                @include('frontend.exam.environment.reflective-journals', [
                                    'QuestionData' => $examData['reflective_journal_exam'],
                                    'student_course_master_id' => $student_course_master_id,
                                    'index' => $index,
                                ])
                            </div>
                            @php $i++; @endphp
                            @break

                        {{-- Multiple Choice --}}
                        @case(7)
                            <div id="content7-{{ $index }}" class="content-show {{ $show }}">
                                @include('frontend.exam.environment.multiple-choice', [
                                    'QuestionData' => $examData['mcq_exam'],
                                    'student_course_master_id' => $student_course_master_id,
                                    'index' => $index,
                                    'key' => 1,
                                ])
                            </div>
                            @php $i++; @endphp
                            @break

                        {{-- Survey --}}
                        @case(8)
                            <div id="content8-{{ $index }}" class="content-show {{ $show }}">
                                @include('frontend.exam.environment.survey', [
                                    'QuestionData' => $examData['survey_exam'],
                                    'student_course_master_id' => $student_course_master_id,
                                    'index' => $index,
                                ])
                            </div>
                            @php $i++; @endphp
                            @break
                            
                        {{-- Artificial Intelligence --}}
                        @case(9)
                            <div id="content9-{{ $index }}" class="content-show {{ $show }}">
                                @include('frontend.exam.environment.artificial_intelligence', [
                                    'QuestionData' => $examData['artificial_intelligence_exam'],
                                    'student_course_master_id' => $student_course_master_id,
                                    'index' => $index,
                                ])
                            </div>
                            @php $i++; @endphp
                            @break
                    @endswitch
                @endforeach

            @endif
            {{-- <div id="content10" class="content-show">
                @include('frontend.exam.environment.final-thesis', [
                    'course_id' => $examData['course_id'],
                ]);
            </div> --}}


            @php
                $showActive = '';
                if (session()->has('eportfolio')) {
                    $showActive = 'active';
                }
            @endphp
            <div id="content-{{ $examData['course_id'] }}" class="content-show {{ $showActive }}">
                @if (isset($examDetails) && count($examDetails) > 0)
                    @foreach ($examDetails as $key => $examData)
                        @if ($key == 0)
                            @include('frontend.exam.environment.e-portfolio', [
                                'course_id' => $course_id,
                                'master_course_id' => $course_id,
                                'student_course_master_id' => $student_course_master_id
                            ]);
                        @endif
                    @endforeach
                @endif
            </div>
        </main>
    </div>

    <script src="{{ asset('frontend/js/examJs.js') }}"></script>
    <script>
        var triggeredMcqActive = <?php echo $triggeredMcqActive ?>;
        if(triggeredMcqActive == '1'){
            $('.mcqActive-1').trigger('click');
        }

        document.addEventListener('DOMContentLoaded', function () {
            var session = <?php echo session()->has('eportfolio') || session()->has('exam_type') ? json_encode(session('eportfolio') ?? session('exam_type')) : 'null'; ?>;


            if (session) {
                // const activeContentId = localStorage.getItem('activeContent');

                const activeLink = document.querySelector(`.content-link[data-target="${session}"]`);
                if (activeLink) {
                    activeLink.classList.add('active');
                }
            }else{
                
                function getTopVisibleElement() {
                    let topElement = null;
                    let topOffset = Infinity;

                    document.querySelectorAll('.content-link').forEach(link => {
                        const rect = link.getBoundingClientRect();
                        if (rect.top >= 0 && rect.top < topOffset) {
                            topOffset = rect.top;
                            topElement = link;
                        }
                    });

                    return topElement ? topElement.getAttribute('data-target') : null;
                }
                var firstExam = getTopVisibleElement();

                const activeLink = document.querySelector(`.content-link[data-target="${firstExam}"]`);
                if (activeLink) {
                    activeLink.classList.add('active');
                }
            }
        });

        function showContent(id) {
            // Hide all content divs and remove active class
            var contents = document.querySelectorAll('.content-show');
            contents.forEach(function(content) {
                content.classList.remove('active');
            });

            document.getElementById(id).classList.add('active');

            localStorage.setItem('activeContent', id);

            const links = document.querySelectorAll('.content-link');
            links.forEach(function(link) {
                link.classList.remove('active');
            });

            const activeLink = document.querySelector(`.content-link[data-target="${id}"]`);
            if (activeLink) {
                activeLink.classList.add('active');
            }
        }

        function buttonToggle(buttonId, iconId) {
            const button = document.getElementById(buttonId).classList,
                icon = document.getElementById(iconId).classList,
                isopened = "is-opened";
            const isOpen = button.contains(isopened);

            if (isOpen) {
                button.remove(isopened);
                icon.remove('bi-x');  
                icon.add("bi-arrow-right"); 
                document.getElementById('db-wrapper').classList.remove('toggled');  
            } else {
                button.add(isopened);
                icon.remove("bi-arrow-right");  
                icon.add("bi-x");
                document.getElementById('db-wrapper').classList.add('toggled'); 
            }
    }


        // function buttonToggle(buttonId, iconId) {
        //     const button = document.getElementById(buttonId).classList,
        //         icon = document.getElementById(iconId).classList,
        //         isopened = "is-opened";
        //     const isOpen = button.contains(isopened);

        //     if (isOpen) {
        //         button.remove(isopened);
        //         icon.remove('bi-x');
        //         icon.add("bi-arrow-right");
        //         $('.course-video-player-page-studentExamSection').addClass('toggled');
        //     } else {
        //         button.add(isopened);
        //         icon.remove("bi-arrow-right");
        //         icon.add("bi-x");
        //         $('.course-video-player-page-studentExamSection').removeClass('toggled');

        //     }
        // }

        function buttonToggleNew(button) {
            const icon = button.querySelector('.toggle-icon').classList;
            const buttonClass = button.classList;
            const isOpened = "is-opened"; 

            const sidebar = document.getElementById("db-wrapper");
            
            if (buttonClass.contains(isOpened)) {
                buttonClass.remove(isOpened);   
                icon.remove('bi-arrow-right');  
                icon.add('bi-x');               
            } else {
                buttonClass.add(isOpened);     
                icon.remove('bi-x');            
                icon.add('bi-arrow-right');     
            }

            // Toggle the sidebar visibility
            sidebar.classList.toggle('toggled');
        }
        
        $(document).ready(function () {
            $(document).on("change", "#instruction_check", function () {
                let modal = $(this).closest(".modal-content");
                let isChecked = $(this).prop("checked");
                modal.find("#acceptButton").attr("data-instruction", isChecked ? "true" : "false");
                modal.find("#acceptButton").prop("disabled", !isChecked);
            });
            $(".modal-content").each(function () {
                let modal = $(this);
                modal.find("#acceptButton").attr("data-instruction", "false").prop("disabled", true);
            });
        });
    </script>
@endsection
