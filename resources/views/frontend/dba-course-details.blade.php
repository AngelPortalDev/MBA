@extends('frontend.master')
@section('content')
    <style>
        .add_background {
            background-color: #2b3990;
            color: #ffffff;
            padding: 12px;
            border-radius: 50%;
            height: 30px;
            width: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 8px;
            font-weight: bold;
        }

        .add_circle {
            background-color: #ffffff;
            color: #2b3990;
            padding: 5px;
            border-radius: 50%;
            height: 30px;
            width: 30px;
            display: flex;
            justify-content: center;
            margin-right: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            align-items: center;
            border: 1px solid #2b3990;
        }

        .download_btn{
            border: 1px solid #2b3990;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
        }

        .download_btn:hover{
            background-color: #2b3990;
            color: #fff;
            border: none;
        }

        .course-item{
            background-color: #f8f8f8;
            padding: 12px 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .course-item h4{
            font-size: 16px;
            color: #333;
            margin: 0;
            font-weight: 600;

        }
        .section_heading{
            font-size: 20px;
        }
        .dba_proposal_title{
            font-weight: 500;
        }
        .wring-proposal-tab_list{
            margin-left: 1.5rem;
        }
    </style>


    <main>
        <!-- Page header -->
        <section class="pt-lg-8 pt-5 pb-8 bg-primary order-1">
            <div class="container pb-lg-6">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-lg-8 col-md-12">
                        <div>
                            <h1 class="text-white display-5 fw-bold color-green ">Doctor of Business Administration</h1>
                            <p class="text-white mb-6 fs-5">
                                The Doctor of Business Administration (DBA) program is meticulously designed to provide seasoned
                                professionals with an enriching and comprehensive academic journey aimed at attaining the highest level 
                                of scholarly and strategic expertise in business leadership.
                            </p>
                            <div class="d-flex align-items-center">
                                <span class="text-white">
                                    <img src="{{ asset('frontend/images/icon/mqf-icon.svg') }}" alt="" width="15px">
                                    MQF/EQF Level: 8
                                </span>
                                {{-- <span class="text-white ms-3">
                                    <i class="bi bi-star-fill color-green  rating-star"></i>
                                    ECTS: NA
                                </span> --}}
                                <span class="text-white ms-3">
                                    <i class="fe fe-user color-green"></i>
                                    45 Enrolled
                                </span> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Page content -->
        <section class="pb-8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-12 mb-4 mb-lg-0 order-3 order-lg-2">
                        <!-- Card -->
                        <div class="card rounded-3 mt-0 mt-md-3">
                            <!-- Card header -->
                            <div class="card-header border-bottom-0 p-0">
                                <div>
                                    <!-- Nav -->
                                    <ul class="nav nav-lb-tab" id="tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="overview-tab" data-bs-toggle="pill"
                                                href="#overview" role="tab" aria-controls="overview"
                                                aria-selected="false">
                                                Overview
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="entry-requirements-tab" data-bs-toggle="pill"
                                                href="#entry-requirements" role="tab" aria-controls="entry-requirements"
                                                aria-selected="false">
                                                Entry Requirements
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="application-form" data-bs-toggle="pill"
                                                href="#progress" role="tab" aria-controls="progress"
                                                aria-selected="true">Application Form</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="course-content-tab" data-bs-toggle="pill"
                                                href="#course-content" role="tab" aria-controls="course-content"
                                                aria-selected="false">
                                                DBA Research Proposal</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="writing-proposal-tab" data-bs-toggle="pill"
                                                href="#assessment" role="tab" aria-controls="assessment"
                                                aria-selected="false">Writing Research Proposal</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="tab-content" id="tabContent">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                        aria-labelledby="overview-tab">
                                        <h2 class="mb-3 section_heading">Overview</h2>

                                        <div class="mb-4">
                                            <p>
                                                The <b>Doctor of Business Administration (DBA)</b> program is meticulously
                                                designed to provide
                                                seasoned professionals with an enriching and comprehensive academic journey
                                                aimed at
                                                attaining the highest level of scholarly and strategic expertise in business
                                                leadership. Over
                                                a structured duration of 3 years (full-time) or 5 to 7 years (part-time),
                                                candidates engage
                                                in six weekend schools, each dedicated to specific components that form the
                                                bedrock of
                                                advanced research and strategic thinking in the field.
                                            </p>


                                            <div class="mb-3">
                                                <div class="course-item">
                                                    <h4>1. Advanced Quantitative Research Methods for Business Leadership</h4>
                                                </div>
                                                <div class="course-item">
                                                    <h4>2. Advanced Qualitative Research Methods for Business Leadership</h4>
                                                </div>
                                                <div class="course-item">
                                                    <h4>3. Advanced Critical Thinking in Business Decision-Making</h4>
                                                </div>
                                                <div class="course-item">
                                                    <h4>4. Scholarly Writing for Doctoral Success</h4>
                                                </div>
                                                <div class="course-item">
                                                    <h4>5. Foundations of Inquiry: Unraveling Ontology and Epistemology in Doctoral Research</h4>
                                                </div>
                                                <div class="course-item">
                                                    <h4>6. Crafting Significance: Strategic Decision-Making for Your Doctoral Inquiry</h4>
                                                </div>
                                            </div>
                                            


                                            <p> These core modules meticulously guide candidates through advanced research
                                                methods,
                                                critical thinking, scholarly writing, and the foundational aspects of
                                                inquiry, laying a robust
                                                foundation for their doctoral journey.
                                            </p>

                                            <div class="mt-4">
                                                <p> <span class="fw-bold">Part 1 </span> of the program is a critical
                                                    juncture, featuring the Doctoral Thesis Proposal Presentation and
                                                    Defense.
                                                    This phase contributes 80% to the overall evaluation and entails a
                                                    comprehensive examination,
                                                    including an interview and defense with the Level 8 Doctoral Theses and
                                                    Professional Research Committee.
                                                    Candidates present a succinct thesis proposal, limited to 7,500 words,
                                                    articulating their
                                                    research objectives, questions, and methodologies.
                                                </p>
                                                <p> <span class="fw-bold">Part 2 </span> focuses on crafting the Doctoral
                                                    Thesis, allowing candidates
                                                    to choose between the traditional monograph or the Compilation Thesis.
                                                    The monograph, not exceeding 60,000 words, adheres to prescribed
                                                    guidelines, while the
                                                    Compilation Thesis showcases a curated collection of research
                                                    contributions.
                                                </p>
                                                <p><span class="fw-bold">Part 3</span> the Viva Examination, serves as the
                                                    pinnacle of
                                                    the DBA journey. Candidates undergo a rigorous assessment led by
                                                    internal
                                                    and external examiners. This final stage provides a platform
                                                    for candidates to defend their research and demonstrate a profound
                                                    understanding of
                                                    their scholarly contributions.
                                                </p>
                                            </div>
                                            <div class="">
                                                <p>Throughout the program, candidates benefit from dedicated supervision, a
                                                    blend of face
                                                    to-face and online interactions, written feedback, and reviews of draft
                                                    chapters. This ensures
                                                    a balanced amalgamation of theoretical insights and practical
                                                    applications, fostering the
                                                    development of critical thinking, research skills, and strategic
                                                    decision-making capabilities.
                                                </p>
                                                <p>The DBA program culminates in the creation of a comprehensive scholarly
                                                    contribution,
                                                    reflecting the candidate’s advanced knowledge, originality in research,
                                                    and ability to
                                                    contribute meaningfully to the field of business leadership. This
                                                    program equips candidates
                                                    with the intellectual tools and research prowess necessary for
                                                    leadership roles in academia,
                                                    consultancy, and executive management.</p>
                                            </div>

                                            <div class="mb-4">
                                               <p style="font-weight: 500"> If you want to explore more about the DBA program, 
                                                download the brochure today to access comprehensive details on entry requirements,
                                                 course structure, and benefits!</p>
                                            </div>


                                            <a href="{{ asset('frontend/images/pdf/Doctorate of Business Administration _DBA.pdf') }}"
                                                download="Download DBA Brochure" class="download_btn">Download DBA Brochure <i
                                                    class="fe fe-download fs-5"></i></a>
                                        </div>


                                    </div>
                                    <div class="tab-pane fade" id="progress" role="tabpanel"
                                        aria-labelledby="application-form">
                                        <!-- Card -->

                                        <div class="mb-4">
                                            <h2 class="mb-3 section_heading">Aplication Form</h2>
                                            <p>
                                                Submit your completed application form along with all required documents.
                                                Once we receive your application, we will send a confirmation email.
                                                This step helps you expand your expertise and unlock new leadership 
                                                opportunities with the DBA program.
                                            </p>
                                            <p style="font-weight: 500">You can download the application form by clicking the button below.
                                                 If you need any assistance, feel free to contact us at <a href="mailto:info@eascencia.mt">info@eascencia.mt.</a>  We will be happy to help!</p>
                                            <a href="{{ asset('frontend/images/pdf/Application Form-DBA.pdf') }}"
                                                download="Application_Form-DBA" class="download_btn">Download Application Form <i
                                                    class="fe fe-download fs-5"></i></a>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="entry-requirements" role="tabpanel"
                                        aria-labelledby="entry-requirements-tab">
                                        <div class="mb-4">
                                            <div class="course__overview">
                                                <h2 class="mb-3 section_heading">Entry Requirments</h2>
                                                <h4 class="text-dark"> In order to be eligible for the DBA, students will
                                                    need to provide:</h4>
                                                <div>
                                                    <h4 class="color-blue mt-3"> Pathway 1:</h4>


                                                    <p class="fw-bold text-dark">1. Academic Qualifications:</p>
                                                    <ul style="list-style-type: disc">
                                                        <li>Completion of an MQF Level 6 Degree and an MQF Level 7
                                                            Master’s degree, amassing at least 240 ECTS credits in fields
                                                            such as management, business administration, engineering,
                                                            and education.
                                                        </li>
                                                    </ul>


                                                    <p class="fw-bold text-dark">2. Professional Experience:</p>
                                                    <ul style="list-style-type: disc">
                                                        <li>Professionals from other disciplines who satisfy the Level 7 and
                                                            Level 6 requirements, totaling 240 ECTS, and possess at least 7
                                                            years of managerial experience.</li>
                                                    </ul>


                                                </div>
                                                <hr />
                                                <p class="fw-bold text-center">
                                                    OR
                                                </p>
                                                <hr />
                                                <div class="mb-5">
                                                    <h4 class="color-blue">Pathway 2:</h4>
                                                    <p class="fw-bold text-dark">1. Academic Qualifications:</p>

                                                    <ul style="list-style-type: disc">
                                                        <li>Hold a Level 7 Master’s Degree comprising 90 ECTS in
                                                            management, business administration, engineering, education,
                                                            or another relevant field.
                                                        </li>
                                                        <li>Hold a Level 5 Higher Diploma equivalent to 120 ECTS.</li>
                                                    </ul>

                                                    <p class="fw-bold text-dark">2. Professional Experience:</p>
                                                    <ul style="list-style-type: disc">
                                                        <li>A minimum of 5 years of management experience in a
                                                            specialized area directly pertinent to the doctoral research
                                                            topic.</li>
                                                    </ul>
                                                    </ol>
                                                </div>
                                                <div>
                                                    <div class="bg-blue p-2 rounded-md">
                                                        <h4 class="text-white mb-0"> Definition and Assessment of
                                                            Managerial Experience:</h4>
                                                    </div>
                                                    <h4 class="color-blue mt-3"> Minimum Level of Experience:</h4>
                                                    <ul>
                                                        <li class="mt-2">At least 5 years of relevant managerial
                                                            experience for Pathway 2.</li>
                                                        <li class="mt-2">At least 7 years of relevant managerial
                                                            experience for Pathway 1.</li>
                                                    </ul>
                                                    <h4 class="color-blue mt-2"> Qualifying Managerial Roles:</h4>
                                                    <ul>
                                                        <li class="mt-2">Managerial experience should include roles with
                                                            significant supervisory or leadership
                                                            responsibilities. Examples of qualifying managerial positions
                                                            could include.
                                                            <ol>
                                                                <li>Department Manager</li>
                                                                <li>Project Manager</li>
                                                                <li>Operations Manager</li>
                                                                <li>Director</li>
                                                                <li>Vice President</li>
                                                                <li>Chief Executive Officer</li>
                                                            </ol>
                                                        </li>
                                                    </ul>
                                                    <h4 class="color-blue mt-2"> Evaluation Criteria:</h4>
                                                    <ul>
                                                        <li class="mt-2">The assessment of managerial experience will
                                                            consider the scope of responsibilities,
                                                            including decision-making authority, strategic planning, team
                                                            leadership, and
                                                            resource management.
                                                        </li>
                                                        <li class="mt-2">Applicants must provide detailed documentation
                                                            of their managerial roles, including
                                                            job descriptions, letters of reference, and any relevant
                                                            certifications or professional
                                                            achievements.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="course-content" role="tabpanel"
                                        aria-labelledby="course-content-tab">
                                        <div>
                                            <div class="row">
                                                <h2 class="mb-3 section_heading"> Introduction to the DBA Research Proposal</h2>
                                                <div class="col-lg-12 col-12">
                                                    <div class="mb-3">
                                                        <p>The Doctor of Business Administration (DBA) program at Ascencia
                                                            Business School provides
                                                            an exceptional platform for seasoned professionals to bridge the
                                                            gap between business
                                                            theory and practical application. Rooted in the core values of
                                                            entrepreneurship, digital
                                                            management, and responsibility, the program is designed to
                                                            develop thought leaders who
                                                            can drive innovation and sustainability within their respective
                                                            industries.</p>
                                                        <p>A critical component of your application is the submission of a
                                                            DBA Research Proposal.
                                                            This document is essential in outlining your intended research,
                                                            demonstrating your ability
                                                            to contribute to both academic knowledge and your professional
                                                            field. The proposal
                                                            allows you to showcase the originality of your research idea,
                                                            its relevance to contemporary
                                                            business challenges, and its potential impact on industry and
                                                            society.</p>

                                                        <h5 class="fw-bold">The research proposal should:</h5>
                                                        <p class="d-flex align-items-center"><span
                                                                class="add_background">1</span> <span
                                                                class="fs-4 dba_proposal_title">Define a clear and focused research question
                                                                aligned with your professional
                                                                expertise and industry needs.</span></p>
                                                        <p class="d-flex align-items-center"><span
                                                                class="add_background">2</span> <span
                                                                class="fs-4 dba_proposal_title">Establish the significance of your research,
                                                                explaining how it fills a gap in current
                                                                academic or business knowledge.</span></p>
                                                        <p class="d-flex align-items-center"><span
                                                                class="add_background">3</span> <span
                                                                class="fs-4 dba_proposal_title">Outline a methodological approach that is
                                                                appropriate and feasible for answering
                                                                your research question.</span></p>
                                                        <p class="d-flex align-items-center"><span
                                                                class="add_background">4</span> <span class="fs-4 dba_proposal_title">
                                                                Project the expected outcomes and their application to both
                                                                business theory
                                                                and practice. </span></p>
                                                        <p class="d-flex align-items-center"><span
                                                                class="add_background">5</span> <span class="fs-4 dba_proposal_title">
                                                                Include a timeline to demonstrate how you plan to execute
                                                                the research within
                                                                the time frame of the DBA program. </span></p>

                                                        <p class="mt-5">This proposal will not only provide you with a
                                                            roadmap for your doctoral studies but will
                                                            also help Ascencia Business School evaluate the viability and
                                                            innovation of your project. As
                                                            a DBA candidate at Ascencia, you will be part of a learning
                                                            environment that emphasizes
                                                            entrepreneurial leadership, digital transformation, and a
                                                            culture of responsibility, which are
                                                            the pillars of our institution.
                                                        </p>
                                                        <p>We encourage you to approach this proposal with a mindset of
                                                            innovation and practical
                                                            application, reflecting the school’s mission to produce business
                                                            leaders capable of
                                                            addressing the complexities of today’s global business
                                                            environment.</p>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="assessment" role="tabpanel"
                                        aria-labelledby="wring-proposal-tab">
                                        <div>
                                            <div class="row">
                                                <div class="col-lg-12 col-12">
                                                    <div class="mb-3">

                                                        <h2 class="mb-3 section_heading">Guidelines for Writing a Research Proposal
                                                            at Ascencia Business School</h2>

                                                        <div class="">
                                                            <p class="d-flex align-items-center"> <span
                                                                    class="add_circle">1</span> <span
                                                                    class="color-blue fw-semibold"> Title of the
                                                                    Research</span></p>
                                                            <ul class="wring-proposal-tab_list">
                                                                <li>Provide a concise and descriptive working title that
                                                                    reflects the focus of your research.
                                                                    Ensure the title includes key concepts and themes of the
                                                                    study.</li>
                                                            </ul>
                                                            <p class="d-flex align-items-center"> <span
                                                                    class="add_circle">2</span> <span
                                                                    class="color-blue fw-semibold">Introduction and
                                                                    Research Background</span></p>
                                                            <ul class="wring-proposal-tab_list">
                                                                <li>Contextualize your research within the existing
                                                                    literature and industry challenges.</li>
                                                                <li>Clearly state the business problem or opportunity that
                                                                    your research addresses.</li>
                                                                <li>Highlight the significance of your study in relation to
                                                                    both academic research and
                                                                    professional practice.</li>
                                                            </ul>
                                                            <p class="d-flex align-items-center"> <span
                                                                    class="add_circle">3</span> <span
                                                                    class="color-blue fw-semibold">Research Questions or
                                                                    Hypotheses </span></p>
                                                            <ul class="wring-proposal-tab_list">
                                                                <li>Formulate clear, focused, and researchable questions. If
                                                                    applicable, state your
                                                                    hypothesis.</li>
                                                                <li>Ensure the research questions are specific, measurable,
                                                                    and aligned with the broader
                                                                    field of business administration.</li>
                                                            </ul>
                                                            <p class="d-flex align-items-center"> <span
                                                                    class="add_circle">4</span><span
                                                                    class="color-blue fw-semibold"> Research Objectives
                                                                </span></p>
                                                            <ul class="wring-proposal-tab_list">
                                                                <li>Define 2-4 key objectives that guide your research.</li>
                                                                <li>These objectives should outline the scope of your study
                                                                    and what you intend to achieve.</li>
                                                            </ul>
                                                            <p class="d-flex align-items-center"> <span
                                                                    class="add_circle">5</span> <span
                                                                    class="color-blue fw-semibold">Literature Review
                                                                </span></p>
                                                            <ul class="wring-proposal-tab_list">
                                                                <li>Provide a summary of key theories, models, and debates
                                                                    relevant to your topic.</li>
                                                                <li>Identify gaps in the existing literature that your
                                                                    research aims to fill.</li>
                                                                <li>Ensure the literature review demonstrates critical
                                                                    engagement with existing research
                                                                    and aligns with Ascencia’s emphasis on practical
                                                                    business leadership.</li>

                                                            </ul>
                                                            <p class="d-flex align-items-center"> <span
                                                                    class="add_circle">6</span><span
                                                                    class="color-blue fw-semibold"> Research Methodology
                                                                </span></p>
                                                            <ul class="wring-proposal-tab_list">
                                                                <li>Clearly define the research methods you will use (e.g.,
                                                                    qualitative, quantitative, or
                                                                    mixed methods).</li>
                                                                <li>Explain your data collection techniques (e.g.,
                                                                    interviews, surveys, case studies,
                                                                    experiments).</li>
                                                                <li>Justify why your chosen methods are the most appropriate
                                                                    for addressing your
                                                                    research question.</li>
                                                                <li>Discuss the sampling approach and explain how you will
                                                                    ensure data validity and reliability.</li>

                                                            </ul>
                                                            <p class="d-flex align-items-center"> <span
                                                                    class="add_circle">7</span> <span
                                                                    class="color-blue fw-semibold">Ethical Considerations
                                                                </span></p>
                                                            <ul class="wring-proposal-tab_list">
                                                                <li>Ascencia, like other institutions, expects research to
                                                                    adhere to high ethical standards.</li>
                                                                <li>Describe any ethical issues related to your research,
                                                                    such as informed consent,
                                                                    confidentiality, and data protection.</li>
                                                                <li>Mention whether your research requires approval from an
                                                                    ethics committee.</li>

                                                            </ul>
                                                            <p class="d-flex align-items-center"> <span
                                                                    class="add_circle">8</span> <span
                                                                    class="color-blue fw-semibold">Expected Contribution
                                                                    and Impact </span></p>
                                                            <ul class="wring-proposal-tab_list">
                                                                <li>Highlight the theoretical contributions your research
                                                                    will make to academic knowledge.</li>
                                                                <li>Explain the practical implications of your study,
                                                                    especially how your findings may
                                                                    influence business practices, policies, or
                                                                    industry-specific strategies.</li>
                                                                <li>Align the expected outcomes with Ascencia’s focus on
                                                                    entrepreneurial and
                                                                    responsible business leadership.</li>
                                                            </ul>
                                                            <p class="d-flex align-items-center"> <span
                                                                    class="add_circle">9</span> <span
                                                                    class="color-blue fw-semibold">Timeline and Research
                                                                    Plan </span></p>
                                                            <ul class="wring-proposal-tab_list">
                                                                <li>Provide a detailed timeline outlining the stages of your
                                                                    research (e.g., literature
                                                                    review, data collection, analysis, writing).</li>
                                                                <li>Ensure the timeline is realistic and shows your
                                                                    awareness of the key milestones in the
                                                                    DBA program</li>
                                                                <li>Use a Gantt chart or other visual aids if necessary to
                                                                    illustrate your plan.</li>
                                                            </ul>
                                                            <p class="d-flex align-items-center"> <span
                                                                    class="add_circle">10</span> <span
                                                                    class="color-blue fw-semibold">References</span></p>
                                                            <ul class="wring-proposal-tab_list">
                                                                <li>Include a list of key academic references using the
                                                                    Harvard style.</li>
                                                                <li>Ensure all sources cited are relevant, recent, and drawn
                                                                    from credible academic
                                                                    publications, industry reports, or governmental
                                                                    databases.</li>

                                                            </ul>
                                                            <p class="d-flex align-items-center"> <span
                                                                    class="add_circle">11</span> <span
                                                                    class="color-blue fw-semibold">Presentation and Format
                                                                </span></p>
                                                            <ul class="wring-proposal-tab_list">
                                                                <li>Write the proposal in clear, professional language, free
                                                                    from jargon.</li>
                                                                <li>Ensure the proposal is well-structured, with headings
                                                                    and subheadings clearly
                                                                    marking different sections.</li>
                                                                <li>Follow any specific formatting guidelines provided by
                                                                    Ascencia (e.g., word count
                                                                    between 1500 and 2000 words, use of 12-point font, 1.5
                                                                    line spacing).</li>

                                                            </ul>
                                                            <p class="d-flex align-items-center"> <span
                                                                    class="add_circle">12</span> <span
                                                                    class="color-blue fw-semibold">Feasibility and
                                                                    Resources</span></p>
                                                            <ul class="wring-proposal-tab_list">
                                                                <li>Demonstrate the feasibility of your project by
                                                                    explaining how you will access
                                                                    necessary resources (e.g., data, software, research
                                                                    tools).</li>
                                                                <li>Mention any collaborations or partnerships that could
                                                                    support your research, if relevant.</li>
                                                            </ul>
                                                            <p class="d-flex align-items-center"> <span
                                                                    class="add_circle">13</span> <span
                                                                    class="color-blue fw-semibold">Limitations </span></p>
                                                            <ul class="wring-proposal-tab_list">
                                                                <li>Acknowledge any potential limitations of your study,
                                                                    such as constraints in data
                                                                    access, time, or scope.</li>
                                                                <li>Explain how you plan to address or mitigate these
                                                                    limitations.</li>
                                                            </ul>

                                                            <div class="mb-4">
                                                               <p style="font-weight: 500"> By following these guidelines, you will create a strong, 
                                                                    impactful research proposal that sets the foundation for a successful DBA journey. 
                                                                </p>
                                                                <p style="font-weight: 500">You can download the research proposal application form by clicking the button below.</p>
                                                            </div>

                                                            <a href="{{ asset('frontend/images/pdf/Research proposal application.pdf') }}"
                                                                download="Research proposal application" class="download_btn">Download Research
                                                                Proposal Application <i
                                                                    class="fe fe-download fs-5"></i></a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-12 course-preview-column order-2 order-lg-3">
                        <!-- Card -->
                        @php 
                        $currentUrl = $_SERVER['REQUEST_URI'];
                        $urlSegments = explode('/', $currentUrl);
                        $course_id = end($urlSegments);
                        $data = DB::table('course_master')->select('id','selling_price','ects','course_thumbnail_file','course_old_price','course_final_price','scholarship','status','category_id','trailer_thumbnail_file')->where('id',base64_decode($course_id))->limit(1)->get();
                        $dataPodcast = DB::table('course_other_videos')->select('bn_video_url_id')->where('course_master_id',base64_decode($course_id))->limit(1)->get();
                        @endphp
                        @if (isset($dataPodcast[0]->bn_video_url_id) && !empty($dataPodcast[0]->bn_video_url_id))
                        <div class="card mb-3 mb-2">
                            <div class="p-1">
                                <div class="d-flex justify-content-center cursor-pointer align-items-center rounded border-white border rounded-3 bg-cover openVideoModal"
                                    data-videourl="https://iframe.mediadelivery.net/embed/{{env('MASTER_LIBRARY_ID')}}/{{ $dataPodcast[0]->bn_video_url_id}}?autoplay=true" 
                                    style="position: relative; overflow: hidden;">
                                    <img src="{{ Storage::url($data[0]->trailer_thumbnail_file) }}" alt="Trailer Thumbnail" 
                                        style="width: 100%; height: 100%; object-fit: cover;"/>
                                    <i class="bi bi-play-fill fs-3 course-details-play-icon" 
                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                </div>
                            </div>
                            <!-- Card body -->
                            <div class="card-body p-3">
                                @if($data[0]->course_final_price > 0)
                                    <div class="mb-3 text-center">
                                        <div class="text-dark fw-bold h2 color-blue">€{{isset($data[0]->course_final_price) ? htmlspecialchars($data[0]->course_final_price) : '' }}/<span class="color-blue h5">per year</span></div>
                                        @if(isset($data[0]->course_old_price) && $data[0]->course_old_price > 0)<del class="fs-4">€{{isset($data[0]->course_old_price) ? htmlspecialchars($data[0]->course_old_price) : '' }}</del>
                                        <span class="course-off-discount">{{ (!empty($data[0]->course_final_price) && $data[0]->course_final_price > 1) ? (isset($data[0]->scholarship) && $data[0]->scholarship > 0 ? intval(round($data[0]->scholarship)).'%'.' Scholarship' : 'Scholarship') : 'Introductory Fees' }}</span>@endif
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center">
                                        @php $promoCode = getCoursePromoCode($data[0]->id); @endphp
                                        @if($promoCode)
                                            <small class="promo-code font-weight-bold text-primary rounded p-1" style="background: #dae138">
                                            <span class="badge badge-success text-primary fs-5" ><span style="user-select: none">PROMO:</span> <span class="fw-bold">{{$promoCode}}</span></span>
                                            </small>
                                        @endif
                                    </div>
                                    <br>
                                    <div class="d-grid">
                                        @if (Auth::check() && Auth::user()->role =='superadmin')
                                            {{-- <a href="{{route('admin-course-panel',['course_id'=>base64_encode($data[0]->id)])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center"><i class="fe fe-play btn-outline-primary"></i> Play </a> --}}
                                        @elseif (Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='instructor' || Auth::user()->role =='sub-instructor'))
                                            {{-- <a href="{{route('admin-course-panel',['course_id'=>base64_encode($data[0]->id)])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center"><i class="fe fe-play btn-outline-primary"></i> Play </a> --}}
                                        @elseif (Auth::check() && Auth::user()->role =='user')
                                                @php
                                                    $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $data[0]->id]);
                                                    $doc_verified = getData('student_doc_verification',['english_score','identity_is_approved','edu_is_approved','identity_doc_file','edu_doc_file','resume_file','edu_trail_attempt','identity_trail_attempt','english_test_attempt','proposal_is_approved'],['student_id'=>Auth::user()->id]);
                                                @endphp
                                                
                                                @if(Auth::user()->apply_dba == 'Yes')
                                                    @if($doc_verified[0]->identity_is_approved = "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->resume_file != '' && $doc_verified[0]->english_score >= 10 && $doc_verified[0]->proposal_is_approved == 'Approved') 
                                                        @if (isset($isPaid)  && is_numeric($isPaid) &&  $isPaid == 0)
                                                            <form action="{{ route('checkout') }}" method="post">
                                                                @csrf <!-- CSRF protection -->
                                                                @php 
                                                                    $total_full_price = $data[0]->course_old_price - ($data[0]->course_old_price - $data[0]->course_final_price); 
                                                                @endphp
                                                                <input type='hidden' value="{{base64_encode($data[0]->id)}}" name="course_id" id="course_id">
                                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($data[0]->course_old_price)}}">
                                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($data[0]->course_old_price-$data[0]->course_final_price)}}">
                                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                <div class="d-grid">
                                                                    <button class="btn btn-primary mb-2 color-green fs-4">Buy Course</button>
                                                                </div>
                                                            </form>
                                                        @endif
                                                    @else
                                                        <a href="{{route('student-document-verification')}}"><button class="btn btn-primary mb-2 color-green fs-4">Buy Course</button></a>
                                                    @endif
                                                @else
                                                    @if (isset($isPaid) && is_numeric($isPaid) &&  $isPaid == 0)
                                                        <form action="{{ route('checkout') }}" method="post">
                                                            @csrf <!-- CSRF protection -->
                                                            @php 
                                                               $total_full_price = $data[0]->course_old_price - ($data[0]->course_old_price - $data[0]->course_final_price); 
                                                            @endphp
                                                            <input type='hidden' value="{{base64_encode($data[0]->id)}}" name="course_id" id="course_id">
                                                            <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($data[0]->course_old_price)}}">
                                                            <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($data[0]->course_old_price-$data[0]->course_final_price)}}">
                                                            <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                            <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                            <div class="d-grid">
                                                                <button class="btn btn-primary mb-2 color-green fs-4">Buy Course</button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                @endif
                                                <div class="d-grid">
                                                    {{-- <a href="#" class="btn btn-outline-primary addtocart coursedetailshoppingcarticon" id="addtocart" data-course-id="{{base64_encode($data[0]->id)}}" data-action="{{base64_encode('add')}}"><i class="fe fe-shopping-cart"></i> Add to Cart</a> --}}
                                                </div>
                                        @else
                                            <form action="{{ route('checkout') }}" method="post">
                                                @csrf <!-- CSRF protection -->
                                                @php 
                                                    $total_full_price = $data[0]->course_old_price - ($data[0]->course_old_price - $data[0]->course_final_price); 
                                                @endphp
                                                <input type='hidden' value="{{base64_encode($data[0]->id)}}" name="course_id" id="course_id">
                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($data[0]->course_old_price)}}">
                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($data[0]->course_old_price-$data[0]->course_final_price)}}">
                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary mb-2 color-green fs-4">Buy Course</button>
                                                </div>
                                            </form>
                                            <div class="d-grid">
                                                {{-- <a href="{{route('login')}}" class="btn btn-outline-primary"><i class="fe fe-shopping-cart text-primary"></i> Add to Cart</a> --}}
                                                {{-- <a href="#" class="btn btn-outline-primary addtocart coursedetailshoppingcarticon" id="addtocart" data-course-id="{{base64_encode($data[0]->id)}}" data-action="{{base64_encode('add')}}"  data-withcart="withcart"><i class="fe fe-shopping-cart"></i> Add to Cart</a> --}}
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            
                            </div>
                        </div>
                    @else
                        @if (isset($data[0]->trailer_thumbnail_file) && !empty($data[0]->trailer_thumbnail_file))
                            <div class="card mb-3 mb-2 trailer_thumbnail_file_style">
                                <div class="p-1">
                                    <div class="d-flex justify-content-center cursor-pointer align-items-center rounded border-white border rounded-3 bg-cover"
                                        style="position: relative; overflow: hidden;">
                                        <img src="{{ Storage::url($data[0]->trailer_thumbnail_file) }}" alt="Trailer Thumbnail" 
                                            style="width: 100%; height: 100%; object-fit: cover;"/>
                                    </div>
                                </div>
                                <!-- Card body -->
                                <div class="card-body p-3">
                                    @if($data[0]->course_final_price > 0)
                                        <div class="mb-3 text-center">
                                            <div class="text-dark fw-bold h2 color-blue">€{{isset($data[0]->course_final_price) ? htmlspecialchars($data[0]->course_final_price) : '' }}/<span class="color-blue h5">per year</span></div>
                                            @if(isset($data[0]->course_old_price) && $data[0]->course_old_price > 0)<del class="fs-4">€{{isset($data[0]->course_old_price) ? htmlspecialchars($data[0]->course_old_price) : '' }}</del>
                                            <span class="course-off-discount">{{ (!empty($data[0]->course_final_price) && $data[0]->course_final_price > 1) ? (isset($data[0]->scholarship) && $data[0]->scholarship > 0 ? intval(round($data[0]->scholarship)).'%'.' Scholarship' : 'Scholarship') : 'Introductory Fees' }}</span>@endif
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            @php $promoCode = getCoursePromoCode($data[0]->id); @endphp
                                            @if($promoCode)
                                                <small class="promo-code font-weight-bold text-primary rounded p-1" style="background: #dae138">
                                                <span class="badge badge-success text-primary fs-5" ><span style="user-select: none">PROMO:</span> <span class="fw-bold">{{$promoCode}}</span></span>
                                                </small>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="d-grid">
                                            @if (Auth::check() && Auth::user()->role =='superadmin')
                                                {{-- <a href="{{route('admin-course-panel',['course_id'=>base64_encode($data[0]->id)])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center"><i class="fe fe-play btn-outline-primary"></i> Play </a> --}}
                                            @elseif (Auth::check() && (Auth::user()->role =='admin' || Auth::user()->role =='instructor' || Auth::user()->role =='sub-instructor'))
                                                {{-- <a href="{{route('admin-course-panel',['course_id'=>base64_encode($data[0]->id)])}}" class="btn btn-outline-primary mt-2 d-flex align-items-center justify-content-center"><i class="fe fe-play btn-outline-primary"></i> Play </a> --}}
                                            @elseif (Auth::check() && Auth::user()->role =='user')
                                                @php
                                                    $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $data[0]->id]);
                                                    $doc_verified = getData('student_doc_verification',['english_score','identity_is_approved','edu_is_approved','identity_doc_file','edu_doc_file','resume_file','edu_trail_attempt','identity_trail_attempt','english_test_attempt','proposal_is_approved'],['student_id'=>Auth::user()->id]);
                                                @endphp
                                                
                                                @if(Auth::user()->apply_dba == 'Yes')
                                                    @if($doc_verified[0]->identity_is_approved = "Approved" && $doc_verified[0]->edu_is_approved == "Approved" && $doc_verified[0]->resume_file != '' && $doc_verified[0]->english_score >= 10  && $doc_verified[0]->proposal_is_approved == 'Approved') 
                                                        @if (isset($isPaid) && is_numeric($isPaid) &&  $isPaid == 0)
                                                            <form action="{{ route('checkout') }}" method="post">
                                                                @csrf <!-- CSRF protection -->
                                                                @php 
                                                                    $total_full_price = $data[0]->course_old_price - ($data[0]->course_old_price - $data[0]->course_final_price); 
                                                                @endphp
                                                                <input type='hidden' value="{{base64_encode($data[0]->id)}}" name="course_id" id="course_id">
                                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($data[0]->course_old_price)}}">
                                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($data[0]->course_old_price-$data[0]->course_final_price)}}">
                                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                <div class="d-grid">
                                                                    <button class="btn btn-primary mb-2 color-green fs-4">Buy Course</button>
                                                                </div>
                                                            </form>
                                                        @endif
                                                    @else
                                                        
                                                            <a href="{{route('student-document-verification')}}"><div class="d-grid"><button class="btn btn-primary mb-2 color-green fs-4">Buy Course</button> </div></a>
                                                       
                                                    @endif
                                                @else
                                                        @if (isset($isPaid)  && is_numeric($isPaid) &&  $isPaid == 0)
                                                        <form action="{{ route('checkout') }}" method="post">
                                                            @csrf <!-- CSRF protection -->
                                                            @php 
                                                                $total_full_price = $data[0]->course_old_price - ($data[0]->course_old_price - $data[0]->course_final_price); 
                                                            @endphp
                                                            <input type='hidden' value="{{base64_encode($data[0]->id)}}" name="course_id" id="course_id">
                                                            <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($data[0]->course_old_price)}}">
                                                            <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($data[0]->course_old_price-$data[0]->course_final_price)}}">
                                                            <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                            <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                            <div class="d-grid">
                                                                <button class="btn btn-primary mb-2 color-green fs-4">Buy Course</button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                @endif
                                            @else
                                                <form action="{{ route('checkout') }}" method="post">
                                                    @csrf <!-- CSRF protection -->
                                                    @php 
                                                        $total_full_price = $data[0]->course_old_price - ($data[0]->course_old_price - $data[0]->course_final_price); 
                                                    @endphp
                                                    <input type='hidden' value="{{base64_encode($data[0]->id)}}" name="course_id" id="course_id">
                                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($data[0]->course_old_price)}}">
                                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($data[0]->course_old_price-$data[0]->course_final_price)}}">
                                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                    <div class="d-grid">
                                                        <button class="btn btn-primary mb-2 color-green fs-4">Buy Course</button>
                                                    </div>
                                                </form>
                                                {{-- <a href="#" class="btn btn-outline-primary addtocart coursedetailshoppingcarticon" id="addtocart" data-course-id="{{base64_encode($data[0]->id)}}" data-action="{{base64_encode('add')}}"  data-withcart="withcart"><i class="fe fe-shopping-cart"></i> Add to Cart</a> --}}
                                            @endif      
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                        <!-- Card -->
                        <div class="card mb-4">
                            <div>
                                <!-- Card header -->
                                <div class="card-header">
                                    <h4 class="mb-0">What’s included</h4>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item bg-transparent">
                                        <i class="bi bi-clock align-middle me-2 text-warning"></i>
                                        3 years Duration
                                    </li>
                                    <li class="list-group-item bg-transparent">
                                        <i class="fe fe-calendar align-middle me-2 text-info"></i>
                                        8 Modules
                                    </li>
                                    {{-- <li class="list-group-item bg-transparent">
                                        <i class="fe fe-book align-middle me-2 text-success"></i>
                                        N/D Lectures
                                    </li> --}}
                                    <li class="list-group-item bg-transparent">
                                        <i class="fe fe-play-circle align-middle me-2 text-primary"></i>
                                        2000+ Learning Hours
                                    </li>
                                    <li class="list-group-item bg-transparent">
                                        <i class="fe fe-award me-2 align-middle text-danger"></i>
                                        Blockchain Certificate
                                        <!-- tooltip on top -->
                                        {{-- <i class="fe fe-info me-2 align-middle text-grey" data-bs-toggle="tooltip"
                                            data-placement="top"
                                            title="Certificate of Attendance OR MQF/EQF Certificate"></i> --}}
                                    </li>

                                    <li class="list-group-item bg-transparent">
                                        <i class="fe fe-video align-middle me-2 text-secondary"></i>
                                        Access on mobile and TV
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- Card -->
                        {{-- <div class="card mb-5">
                            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active" data-bs-interval="3000">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="position-relative">
                                                    <img src="{{ asset('frontend/images/team/italo-esposito-photo.jpg') }}"
                                                        alt="avatar" class="rounded-circle avatar-xl">
                                                    <a href="#" class="position-absolute mt-2 ms-n3"
                                                        data-bs-toggle="tooltip" data-placement="top" title="Verified">
                                                        <img src="{{ asset('frontend/images/svg/checked-mark.svg') }}"
                                                            alt="checked-mark" height="30" width="30">
                                                    </a>
                                                </div>
                                                <div class="ms-4">
                                                    <h4 class="mb-0">Italo Esposito</h4>
                                                    <p class="mb-1 fs-6">Lecturer</p>
                                                </div>
                                            </div>
                                            <div class="border-top row pt-2 pb-3 mt-3 g-0">
                                                <div class="col">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                                                    natus accusantium impedit quae nobis ad totam, corporis pariatur
                                                    recusandae in.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item " data-bs-interval="3000">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="position-relative">
                                                    <img src="{{ asset('frontend/images/team/italo-esposito-photo.jpg') }}"
                                                        alt="avatar" class="rounded-circle avatar-xl">
                                                    <a href="#" class="position-absolute mt-2 ms-n3"
                                                        data-bs-toggle="tooltip" data-placement="top" title="Verified">
                                                        <img src="{{ asset('frontend/images/svg/checked-mark.svg') }}"
                                                            alt="checked-mark" height="30" width="30">
                                                    </a>
                                                </div>
                                                <div class="ms-4">
                                                    <h4 class="mb-0">Italo Esposito</h4>
                                                    <p class="mb-1 fs-6">Lecturer</p>
                                                </div>
                                            </div>
                                            <div class="border-top row pt-2 pb-3 mt-3 g-0">
                                                <div class="col">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                                                    natus accusantium impedit quae nobis ad totam, corporis pariatur
                                                    recusandae in.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item " data-bs-interval="3000">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="position-relative">
                                                    <img src="{{ asset('frontend/images/team/italo-esposito-photo.jpg') }}"
                                                        alt="avatar" class="rounded-circle avatar-xl">
                                                    <a href="#" class="position-absolute mt-2 ms-n3"
                                                        data-bs-toggle="tooltip" data-placement="top" title="Verified">
                                                        <img src="{{ asset('frontend/images/svg/checked-mark.svg') }}"
                                                            alt="checked-mark" height="30" width="30">
                                                    </a>
                                                </div>
                                                <div class="ms-4">
                                                    <h4 class="mb-0">Italo Esposito</h4>
                                                    <p class="mb-1 fs-6">Lecturer</p>
                                                </div>
                                            </div>
                                            <div class="border-top row pt-2 pb-3 mt-3 g-0">
                                                <div class="col">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
                                                    natus accusantium impedit quae nobis ad totam, corporis pariatur
                                                    recusandae in.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center main-carousel gap-3 mb-2">
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExample" data-bs-slide="prev">
                                        <span class="left-icon"><i class="bi bi-chevron-left"></i></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExample" data-bs-slide="next">
                                        <span class="right-icon"><i class="bi bi-chevron-right"></i></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="modal fade modal-lg videoOpen " tabindex="-1" role="dialog" aria-labelledby="addLecturerModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content position-relative" style="background: none; border: none">
                        {{-- <button type="button" class="btn-close videoclose" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        <i class="bi bi-x fs-2 text-white couser-detail-modal-close-button" data-bs-dismiss="modal" aria-label="Close"></i>

                        <div class="previouseVideo mb-4" style="position:relative;padding-top:56.25%;"><iframe src="" class="videoFrame" id="videoFrame" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>
                </div>
            </div>
            </div>
        </section>
    </main>
@endsection
