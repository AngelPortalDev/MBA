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
                <h3 class="mb-0 text-truncate-line-2 color-blue studentAssignmentTitle">E-portfolio</h3>
            </div>

        </div>

    </nav>
</div>

<!-- Page Header -->


<!-- Container fluid -->
<section class="container-fluid ps-4 pe-3">
    {{-- E-portfolio --}}
    <div class="row">
        <div class="col-md-12 mb-3">
            <b>What is an E-portfolio?</b>
            <p>An E-portfolio is a document that you prepare over a period studying. It will include your feelings, your
                insights and your learning experiences. It details what you have learned, the impact of that learning,
                what it meant to you and how you will use that learning experience in the future. It may include a
                section on challenges faced, how you worked through those challenges and what you would do differently.
            </p>
            <p>It may also contain a section on reading or articles you read and what you learned from those or indeed
                theories or models that you can apply in the future. </p>
            <p>It is about growth and development. </p>
            <p><strong>NOTE- </strong> To complete the course, students must submit at least five E-portfolios.</p>
        </div>
        @php
            $studentCourseMaster = getData('student_course_master', ['id'], ['user_id' => Auth::user()->id, 'course_id' => $master_course_id], '1', 'id', 'desc');
        @endphp

        @if (is_exist('exam_eportfolio', ['user_id' => Auth::user()->id, 'course_id' => $course_id, 'student_course_master_id' => $student_course_master_id]) < 20)
            {{-- @if (!is_exist('exam_eportfolio', ['user_id' => Auth::user()->id, 'course_id' => $course_id, 'remark' => null])) --}}
                <form id="portfolioForm-{{$course_id}}">
                    <input type="hidden" name="course_id[]" value="{{ isset($course_id) ? $course_id : 0 }}">
                    <input type="hidden" name="master_course_id" value="{{ isset($master_course_id) ? $master_course_id : 0 }}">
                    <input type="hidden" name="student_course_master_id" value="{{ isset($student_course_master_id) ? $student_course_master_id : 0 }}">
                    
                    <div class="col-md-12 mb-2">
                        <label class="form-label fs-4 color-blue" for="eportfolioTitle">E-portfolio title <span class="text-danger">*</span></label>
                        <input type="text" id="eportfolioTitle" name="title" class="form-control mb-1"
                            placeholder="E-portfolio Title" required>
                        <small>The eportfolio title must not be greater than 25 words.</small>
                        <span id="eportfolio_title_error" class="error-message mt-0" style="display:none;">Please enter e-portfolio title.</span>
                        <div id="eportfolio_limit_error" style="display:none;color:red;">The eportfolio title must not be greater than 25 words.</div>

                    </div>

                    <div class="col-md-12 mb-4">
                        <label class="form-label" for="E-portfolio Title">1. Main points </label>

                        <textarea class="form-control" id="siteDescription" name="answer[]" placeholder="Write here..." required="" rows="10"></textarea>
                        <small>(The answer for question may not be greater than 1000 words.)</small>
                        <div class="invalid-feedback" id="eportfolio_answer_error_0">The answer for question may not be greater than 1000 words.</div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label class="form-label" for="E-portfolio Title">2. Models and theories introduced</label>

                        <textarea class="form-control" id="siteDescription" name="answer[]" placeholder="Write here..." required="" rows="10"></textarea>
                        <small>(The answer for question may not be greater than 1000 words.)</small>
                        <div class="invalid-feedback" id="eportfolio_answer_error_1">The answer for question may not be greater than 1000 words.</div>

                    </div>
                    <div class="col-md-12 mb-4">
                        <label class="form-label" for="E-portfolio Title">3. Key learnings</label>

                        <textarea class="form-control" id="siteDescription" name="answer[]" placeholder="Write here..." required="" rows="10"></textarea>
                        <small>(The answer for question may not be greater than 1000 words.)</small>
                        <div class="invalid-feedback" id="eportfolio_answer_error_2">The answer for question may not be greater than 1000 words.</div>

                    </div>
                    <div class="col-md-12 mb-4">
                        <label class="form-label" for="E-portfolio Title">4. Challenges faced </label>

                        <textarea class="form-control" id="siteDescription" name="answer[]" placeholder="Write here..." required="" rows="10"></textarea>
                        <small>(The answer for question may not be greater than 1000 words.)</small>
                        <div class="invalid-feedback" id="eportfolio_answer_error_3">The answer for question may not be greater than 1000 words.</div>

                    </div>
                    <div class="col-md-12 mb-4">
                        <label class="form-label" for="E-portfolio Title">5. How can I use what I learned in the future?</label>

                        <textarea class="form-control" id="siteDescription" name="answer[]" placeholder="Write here..." required="" rows="10"></textarea>
                        <small>(The answer for question may not be greater than 1000 words.)</small>
                        <div class="invalid-feedback" id="eportfolio_answer_error_4">The answer for question may not be greater than 1000 words.</div>

                    </div>
                    <div class="col-md-12 mb-4">
                        <label class="form-label" for="E-portfolio Title">6. How has this learning facilitated personal
                            growth?</label>

                        <textarea class="form-control" id="siteDescription" name="answer[]" placeholder="Write here..." required="" rows="10"></textarea>
                        <small>(The answer for question may not be greater than 1000 words.)</small>
                        <div class="invalid-feedback" id="eportfolio_answer_error_5">The answer for question may not be greater than 1000 words.</div>

                    </div>
                    <div class="col-md-12 mb-4">
                        <label class="form-label" for="E-portfolio Title">7. Any additional reflections</label>
                        <textarea class="form-control" id="siteDescription" name="answer[]"  placeholder="Write here..." required="" rows="10"></textarea>
                        <small>(The answer for question may not be greater than 1000 words.)</small>
                        <div class="invalid-feedback" id="eportfolio_answer_error_6">The answer for question may not be greater than 1000 words.</div>

                    </div>

                    <div class="col-12 mb-6 text-center">
                        <button type="button" class="btn btn-primary" data-bs-target="#instructionModal-{{$course_id}}" data-bs-toggle="modal">Submit</button>
                        {{-- <input type="submit" value="Submit" name="Submit" /> --}}
                        {{-- <p class="mt-2 fw-bold">(Student can submit up to 20 E-portfolios for each module.)</p> --}}
                    </div>
                </form>
            {{-- @endif --}}
        @else
            <label for="customerNotes" class="form-label">
                <h3 class="text-danger">Maximum 20 E-portfolios are allowed.</h3>
            </label>
        @endif


        <div class="col-12 mb-6">
            <div class="card">
                <div class="card-body">
                    <!-- row -->
                    <div class="row gx-3">
                        <div class="col-md-12">
                            <label for="customerNotes" class="form-label">
                                <h3 class="color-blue submittedPortfolioListTitle">Submitted E-portfolio List</h3>
                            </label>

                            <div id="submitted-list">
                                @php
                                    $count = 1;
                                    $getPort= getData('exam_eportfolio',['title'],['user_id' => Auth::user()->id, 'course_id' => $course_id, 'student_course_master_id' => $student_course_master_id]);
                                @endphp
                                @if (isset($getPort) && count($getPort) > 0)
                                @foreach ($getPort as $item)
                                <h4 class="mb-2"><a class="text-inherit">{{$count.". ".html_entity_decode($item->title)}}</a> <span class="badge bg-success-soft">Submitted</span> </h4>
                                @php
                                    $count++;
                                @endphp
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.exam.environment.declaration-form', [
    'modalId' => 'instructionModal-' . $course_id,
    'exam_name' => 'E-portfolio',
    'submit_button_class' => 'submitEportfolio',
    'extraRequirement' => '" data-course_id="' . e($course_id) . '" data-action="submit"'
])

<script>
    $(document).ready(function() {
        // $("#eportfolio_title_error").css('display','none');

        $("#submitBtn").click(function() {
            const eportfolioTitle = $("#eportfolioTitle").val().trim();
            const titleError = $("#title-error");

            titleError.text("");

            if (eportfolioTitle === "") {
                titleError.text("Please Enter Title");
            } else {
                const newTitleIndex = $("#submitted-list h4").length + 1;
                const newTitleHTML = `<h4 class="mb-2"><a class="text-inherit">${newTitleIndex}. ${eportfolioTitle}</a> <span class="badge bg-success-soft">Submitted</span></h4>`;
                $("#submitted-list").append(newTitleHTML);
                $("#eportfolioTitle").val("");
            }
        });

        $("#eportfolioTitle").on("input", function() {
            $("#title-error").text("");
        });
    });
</script>
