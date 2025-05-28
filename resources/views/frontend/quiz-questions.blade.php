@extends('frontend.master')
@section('content')
    <style>
        /* TITLE */
        #title-container {
            min-height: 460px;
            height: 100%;
            color: #000;
            background-color: #FFF;
            text-align: center;
            padding: 105px 28px 28px 28px;
            box-sizing: border-box;
            position: relative;
            box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
            -webkit-box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
            -moz-box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
        }

        #title-container h2 {
            font-size: 45px;
            font-weight: 800;
            color: #fff;
            padding: 0;
            margin-bottom: 0px;
        }

        #title-container h3 {
            font-size: 25px;
            font-weight: 600;
            color: #000;
            padding: 0;
            line-height: normal;
        }

        #title-container p {
            font-size: 13px;
            padding: 0 25px;
            line-height: 20px;
        }

        .covid-image {
            width: 214px;
            margin-bottom: 15px;
        }

        /* FORMS */
        #qbox-container {
            background: url(../img/corona.png);
            background-repeat: repeat;
            position: relative;
            padding: 62px;
            min-height: 630px;
            box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
            -webkit-box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
            -moz-box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
        }

        #steps-container {
            margin: auto;
            width: 500px;
            min-height: 420px;
            display: flex;
            vertical-align: middle;
            align-items: center;
        }

        .step {
            display: none;
        }

        .step h4 {
            margin: 0 0 26px 0;
            padding: 0;
            position: relative;
            font-weight: 500;
            font-size: 20px !important;
            font-size: 1.4375rem;
            line-height: 1.6;
            color: #000;
        }

        button#prev-btn,
        button#next-btn,
        button#submit-btn {
            font-size: 17px;
            font-weight: bold;
            position: relative;
            width: 130px;
            height: 50px;
            background: #D34059;
            margin: 0 auto;
            margin-top: 40px;
            overflow: hidden;
            z-index: 1;
            cursor: pointer;
            transition: color .3s;
            text-align: center;
            color: #fff;
            border: 0;
        }

        button#prev-btn,
        button#next-btn,
        button#submit-btn:hover{
            color: #000;
            border: 1px solid #D34059;
        }

        button#prev-btn:after,
        button#next-btn:after,
        button#submit-btn:after {
            position: absolute;
            top: 0;
            left: -100%;  
            width: 100%;
            height: 100%;
            background: #fff !important;
            content: "";
            z-index: -2;
            transition: transform .3s;
        }

        button#prev-btn:hover::after,
        button#next-btn:hover::after,
        button#submit-btn:hover::after {
            transform: translateX(100%); 
            transition: transform .3s;
        }

        .closing-text h2{
            color: #D34059;
        }


        .progress {
            border-radius: 0px !important;
        }

        .q__question {
            position: relative;
        }

        .q__question:not(:last-child) {
            margin-bottom: 10px;
        }

        .question__input {
            position: absolute;
            left: -9999px;
        }

        .question__label {
            position: relative;
            display: block;
            line-height: 40px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #fff;
            padding: 5px 20px 5px 50px;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
        }

        .question__label:hover {
            border-color: #D34059;
        }

        .question__label:before,
        .question__label:after {
            position: absolute;
            content: "";
        }

        .question__label:before {
            top: 12px;
            left: 10px;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background-color: #fff;
            box-shadow: inset 0 0 0 1px #ced4da;
            -webkit-transition: all 0.15s ease-in-out;
            -moz-transition: all 0.15s ease-in-out;
            -o-transition: all 0.15s ease-in-out;
            transition: all 0.15s ease-in-out;
        }

        .question__input:checked+.question__label:before {
            background-color: #D34059;
            box-shadow: 0 0 0 0;
        }

        .question__input:checked+.question__label:after {
            top: 22px;
            left: 18px;
            width: 10px;
            height: 5px;
            border-left: 2px solid #fff;
            border-bottom: 2px solid #fff;
            transform: rotate(-45deg);
        }

        .form-check-input:checked,
        .form-check-input:focus {
            background-color: #D34059 !important;
            outline: none !important;
            border: none !important;
        }

        input:focus {
            outline: none;
        }

        #input-container {
            display: inline-block;
            box-shadow: none !important;
            margin-top: 36px !important;
        }

        label.form-check-label.radio-lb {
            margin-right: 15px;
        }

        #q-box__buttons {
            text-align: center;
        }

        input[type="text"],
        input[type="email"] {
            padding: 8px 14px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border: 1px solid #D34059;
            border-radius: 5px;
            outline: 0px !important;
            -webkit-appearance: none;
            box-shadow: none !important;
            -webkit-transition: all 0.15s ease-in-out;
            -moz-transition: all 0.15s ease-in-out;
            -o-transition: all 0.15s ease-in-out;
            transition: all 0.15s ease-in-out;
        }

        .form-check-input:checked[type=radio],
        .form-check-input:checked[type=radio]:hover,
        .form-check-input:checked[type=radio]:focus,
        .form-check-input:checked[type=radio]:active {
            border: none !important;
            -webkit-outline: 0px !important;
            box-shadow: none !important;
        }

        .form-check-input:focus,
        input[type="radio"]:hover {
            box-shadow: none;
            cursor: pointer !important;
        }

        #success {
            display: none;
        }

        #success h4 {
            color: #D34059;
        }

        .back-link {
            font-weight: 700;
            color: #D34059;
            text-decoration: none;
            font-size: 18px;
        }

        .back-link:hover {
            color: #D34059;
        }

        /* PRELOADER */
        #preloader-wrapper {
            width: 100%;
            height: 100%;
            z-index: 1000;
            display: none;
            position: fixed;
            top: 0;
            left: 0;
        }

        #preloader {
            background-image: url('../img/preloader.png');
            width: 120px;
            height: 119px;
            border-top-color: #fff;
            border-radius: 100%;
            display: block;
            position: relative;
            top: 50%;
            left: 50%;
            margin: -75px 0 0 -75px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
            z-index: 1001;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        #preloader-wrapper .preloader-section {
            width: 51%;
            height: 100%;
            position: fixed;
            top: 0;
            background: #F7F9FF;
            z-index: 1000;
        }

        #preloader-wrapper .preloader-section.section-left {
            left: 0
        }

        #preloader-wrapper .preloader-section.section-right {
            right: 0;
        }

        .loaded #preloader-wrapper .preloader-section.section-left {
            transform: translateX(-100%);
            transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
        }

        .loaded #preloader-wrapper .preloader-section.section-right {
            transform: translateX(100%);
            transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
        }

        .loaded #preloader {
            opacity: 0;
            transition: all 0.3s ease-out;
        }

        .loaded #preloader-wrapper {
            visibility: hidden;
            transform: translateY(-100%);
            transition: all 0.3s 1s ease-out;
        }

        /* MEDIA QUERIES */
        @media (min-width: 990px) and (max-width: 1199px) {
            #title-container {
                padding: 80px 28px 28px 28px;
            }

            #steps-container {
                width: 85%;
            }
        }

        @media (max-width: 991px) {
            #title-container {
                padding: 30px;
                min-height: inherit;
            }
        }

        @media (max-width: 767px) {
            #qbox-container {
                padding: 30px;
            }

            #steps-container {
                width: 100%;
                min-height: 400px;
            }

            #title-container {
                padding-top: 50px;
            }
        }

        @media (max-width: 560px) {
            #qbox-container {
                padding: 40px;
            }

            #title-container {
                padding-top: 45px;
            }
        } .step {
            display: none;
        }
        .active-step {
            display: block;
        }
        .back_to_home_page{
            display: block;
            width: fit-content;
            background-color: #D34059;
            color: #fff;
            border: 0;
            padding: 6px 16px;
            border-radius: 6px;
        }

        .back_to_home_page:hover{
            background-color: #D34059;
            color: #fff;
            border: 0;
        }

    </style>
     @php
     $currentUrl = $_SERVER['REQUEST_URI'];
     $urlSegments = explode('/', $currentUrl);
     $section_id = end($urlSegments);
     @endphp
    <section class="pt-6 pb-4">
        <div class="container d-flex justify-content-end">
            <a class="btn btn-outline-primary underline back_to_home_page" href="{{ route('quiz-view', ['section_id' => $section_id]) }}">Back</a>
        </div>
        <br>
        <div class="container d-flex align-items-center">
            <div class="row g-0 justify-content-center">
                <!-- TITLE -->
                <div class="col-lg-4 offset-lg-1 mx-0 px-0">
                    <div id="title-container">
                        <img src="{{ asset('frontend/images/english-program/quiz-think.png') }}" class="img-fluid" alt="Quiz Banner" style="width: 45%"/>
                        <h3>Technical Knowledge Assessment</h3>
                        <p>This assessment aims to evaluate your understanding of essential technical concepts and practices.
                             By answering the following questions, you'll gain insights into your technical proficiency and
                              identify areas for further learning.</p>
                    </div>
                </div>
                <!-- FORMS -->
                <div class="col-lg-7 mx-0 px-0">
                    <div class="progress">
                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50"
                            class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            style="width: 0%; background-color: #D34059"></div>
                    </div>
                    <div id="qbox-container">

                        <div id="quiz-container">
                            <form  id="englishCourseQuizData">

                            <div id="dynamic-content">
                                <!-- Dynamic content will be appended here -->
                            </div>
                            <div id='empty-content' style="display: none;margin-top: 2rem;">
                                <img src="{{ asset('frontend/images/comingSoon2.png') }}" alt="Coming Soon" class="mb-8" style="max-width: 250px;display: flex;margin: 0 auto;">
                
                                <!-- Heading -->
                                <h1 class="display-6 fw-bold mb-3" style="justify-content: center;display:flex;">The quiz is coming up soon!</h1>
                                
                            </div>
                            </form>
                        </div>
                    
                        <!-- Navigation Buttons -->
                        
                        <div id="q-box__buttons">
                            <button id="prev-btn" style="display: none;">Previous</button>
                            <button id="next-btn"  style="display: none;">Next</button>
                            <button id="submit-btn" class="submit-btn" style="display: none;">Submit</button>
                        </div>
                    
                        <div id="success" style="display: none;">
                            {{-- <div class="step"> --}}
                                <div class="mt-1">
                                    <div class="closing-text">
                                        @if(isset($section_id) && (Auth::check() && Auth::user()->role =='user'))
                                            @php $quizScore = getData('english_course_quiz', ['quiz_score'], [
                                                'section_id' => base64_decode($section_id),
                                                'user_id' => Auth()->user()->id,
                                            ]); 
                                            if (!empty($quizScore) && count($quizScore) > 0) {                                                
                                                $quizScoreValue = $quizScore[0]->quiz_score;
                                            }else{
                                                $quizScoreValue = '';
                                            }
                                            @endphp
                                        @else
                                            @php $quizScoreValue = ''; @endphp
                                        @endif
                                        <img src="{{ asset('frontend/images/completed.png') }}" class="img-fluid" alt="Quiz Banner" style="width: 25%; display: flex; margin: 0 auto;"/>
                                        <h2 class="text-center">You have successfully submitted the quiz!</h2>
                                        <p class="fs-4 text-center"><b>Your score is: {{$quizScoreValue}} % </b> </p>
                                        <p class="fs-4 text-center">Thank you for completing the quiz. Your responses have been recorded.</p>
                                        <div class="d-flex justify-content-center">
                                            {{-- <button class="btn btn-outline-primary back_to_home_page">Back to Home Page</button> --}}
                                            <a href="{{ route('english-course-program') }}" class="back_to_home_page">Back to Home Page</a>
                                        </div>
                                        {{-- <p>Click on the submit button to continue.</p> --}}
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>
                        {{-- <form class="needs-validation" id="form-wrapper" method="post" name="form-wrapper" novalidate=""> --}}
                            {{-- <div id="steps-container">
                                <div id="beforeend"></div> --}}

                                {{-- <div class="step">
                                    <h4>What is the primary purpose of an Operating System (OS)? </h4>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="q_hardware" name="q_1"
                                                type="radio" value="hardware">
                                            <label class="form-check-label question__label" for="q_hardware">To manage hardware resources</label>
                                        </div>
                                        <div class="q-box__question">
                                            <input  class="form-check-input question__input" id="q_internet"
                                                name="q_1" type="radio" value="internet">
                                            <label class="form-check-label question__label" for="q_internet">To provide internet access</label>
                                        </div>
                                        <div class="q-box__question">
                                            <input  class="form-check-input question__input" id="q_application"
                                                name="q_1" type="radio" value="application">
                                            <label class="form-check-label question__label" for="q_application">To create applications</label>
                                        </div>
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="q_data"
                                                name="q_1" type="radio" value="data">
                                            <label class="form-check-label question__label" for="q_data">To store data</label>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="step">
                                    <h4>Which of the following is a commonly used programming language for web development?
                                    </h4>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="q_2_yes" name="q_2"
                                                type="radio" value="Yes">
                                            <label class="form-check-label question__label" for="q_2_yes">Python</label>
                                        </div>
                                        <div class="q-box__question">
                                            <input checked class="form-check-input question__input" id="q_2_no"
                                                name="q_2" type="radio" value="No">
                                            <label class="form-check-label question__label" for="q_2_no">HTML</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="step">
                                    <h4>What does HTTP stand for?</h4>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="q_3_yes" name="q_3"
                                                type="radio" value="Yes">
                                            <label class="form-check-label question__label" for="q_3_yes">HyperText Transfer Protocol</label>
                                        </div>
                                        <div class="q-box__question">
                                            <input checked class="form-check-input question__input" id="q_3_no"
                                                name="q_3" type="radio" value="No">
                                            <label class="form-check-label question__label" for="q_3_no">HyperText Transmission Protocol</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="step">
                                    <h4>Which of the following data structures uses LIFO (Last In First Out) order?</h4>
                                    <div class="row">
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_queue"
                                                    name="structure" type="radio" value="queue">
                                                <label class="form-check-label question__label"
                                                    for="q_queue">Queue</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_array"
                                                name="structure" type="radio" value="array">
                                                <label class="form-check-label question__label" for="q_array">Array</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_stack"
                                                name="structure" type="radio" value="stack">
                                                <label class="form-check-label question__label" for="q_stack">Stacks</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_list"
                                                name="structure" type="radio" value="list">
                                                <label class="form-check-label question__label" for="q_list">Linked List</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step">
                                    <h4>In database management, what does SQL stand for?</h4>
                                    <div class="row">
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_sql_standard"
                                                    name="sql_definition" type="radio" value="standard_query_language">
                                                <label class="form-check-label question__label" for="q_sql_standard">Standard Query Language</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_sql_structured"
                                                    name="sql_definition" type="radio" value="structured_query_language">
                                                <label class="form-check-label question__label" for="q_sql_structured">Structured Query Language</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_sql_simple"
                                                    name="sql_definition" type="radio" value="simple_query_language">
                                                <label class="form-check-label question__label" for="q_sql_simple">Simple Query Language</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_sql_sequential"
                                                    name="sql_definition" type="radio" value="sequential_query_language">
                                                <label class="form-check-label question__label" for="q_sql_sequential">Sequential Query Language</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="step">
                                    <h4>What is the function of a firewall in a network?</h4>
                                    <div class="row">
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_firewall_speed"
                                                    name="firewall_function" type="radio" value="increase_speed">
                                                <label class="form-check-label question__label" for="q_firewall_speed">To increase internet speed</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_firewall_filter"
                                                    name="firewall_function" type="radio" value="filter_traffic">
                                                <label class="form-check-label question__label" for="q_firewall_filter">To filter incoming and outgoing traffic</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_firewall_backups"
                                                    name="firewall_function" type="radio" value="create_backups">
                                                <label class="form-check-label question__label" for="q_firewall_backups">To create backups</label>
                                            </div>
                                        </div>
                                        <div class="form-check ps-0 q-box">
                                            <div class="q-box__question">
                                                <input class="form-check-input question__input" id="q_firewall_connect"
                                                    name="firewall_function" type="radio" value="connect_internet">
                                                <label class="form-check-label question__label" for="q_firewall_connect">To connect to the internet</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="step">
                                    <div class="mt-1">
                                        <div class="closing-text">
                                            <h4>That's about it! Stay healthy!</h4>
                                            <p>This assessment aims to evaluate your understanding of essential technical concepts and practices.
                                                By answering the following questions, you'll gain insights into your technical proficiency and
                                                 identify areas for further learning</p>
                                            <p>Click on the submit button to continue.</p>
                                        </div>
                                    </div>
                                </div>
                                <div id="success">
                                    <div class="mt-5">
                                        <h4>Success! We'll get back to you ASAP!</h4>
                                        <p>Meanwhile, This assessment aims to evaluate your understanding of essential technical concepts and practices.
                                            By answering the following questions, you'll gain insights into your technical proficiency and
                                             identify areas for further learning</p>
                                        <a class="back-link" href="">Go back from the beginning ➜</a>
                                    </div>
                                </div> --}}
                            {{-- </div>
                            <div id="q-box__buttons">
                                <button id="prev-btn" type="button">Previous</button>
                                <button id="next-btn" type="button">Next</button>
                                <button id="submit-btn" type="submit">Submit</button>
                            </div> --}}
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div><!-- PRELOADER -->
        <div id="preloader-wrapper">
            <div id="preloader"></div>
            <div class="preloader-section section-left"></div>
            <div class="preloader-section section-right"></div>
        </div>
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to submit?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmSubmit">Yes, Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>

  
  $(document).ready(function () {
    let currentStep = 0; // Track the current step (question)
    let totalQuestions = 0; // Store the total number of questions
    const steps = [];
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");
    const submitBtn = document.getElementById("submit-btn");
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    const studentBaseUrl = window.location.origin + "/student";
    const currentUrl = window.location.href;
    const lastSegment = currentUrl.split('/').pop();
    const section_id = lastSegment; // Example course ID

    // AJAX request to load quiz questions
    $.ajax({
        url: studentBaseUrl + "/english-course-quiz-view",
        type: "POST",
        data: { section_id: section_id },
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        success: function (response) {

            console.log(response);
            if(response.code == 200){
                if (response && response.data[0]['quiz_question']) {
                    const quizData = response.data[0]['quiz_question'];
                    const data = Object.keys(quizData); // Get the keys of the quiz questions
                    totalQuestions = data.length; // Set total number of questions

                    if(totalQuestions > 0){
                    // Dynamically create quiz questions
                        data.forEach((key, index) => {
                            const question = quizData[key].question;
                            
                            const options = [
                                quizData[key].option1,
                                quizData[key].option2,
                                quizData[key].option3,
                                // quizData[key].option4
                            ];
                            let questionId = btoa(quizData[key].id); // Ensure you retrieve the correct question ID
                            let quiz_id = btoa(response.data[0].id); // Assuming `quiz_id` is part of the response
                            
                            var answer=0;
                            let questionHTML = `
                                <div class="step">
                                    <h4>${question}</h4>
                                    ${options.map((option, i) => {
                                            let currentAnswer = answer++; // Increment answer and store the current value
                                            return `
                                                <div class="form-check ps-0 q-box">
                                                    <div class="q-box__question">
                                                    <input class="form-check-input question__input" id="q${index}-option${currentAnswer}" name="answer${index}" type="radio" value="${answer}">
                                                        <label class="form-check-label question__label" for="q${index}-option${currentAnswer}">${option}</label>
                                                    </div>
                                                </div>
                                            `;
                                        }).join('')}
                                    <!-- Hidden inputs for question ID and quiz ID -->
                                        <input value="${questionId}" type="hidden" name="question_id[]">
                                        <input value="${quiz_id}" type="hidden" name="quiz_id" id="quiz_id">
                                        <input value="${section_id}" type="hidden" name="section_id" id="section_id">
                                        

                                </div>
                            `;
                            // Append the question HTML
                            $('#dynamic-content').append(questionHTML);
                        });
                        showStep(currentStep);

                    }else{

                        $('#empty-content').css('display','block');

                    }

                    // Initially show the first question
                }
            }else if(response.code == 202){
                $('#empty-content').css('display','block');
            }else{
                $('#success').css('display','block');
                $('#next-btn').css('display','none');
            }
        },
        error: function (error) {
            console.log("Error loading quiz:", error);
        }
    });

    // Show the current question step and manage button visibility
    function showStep(stepIndex) {
        const allSteps = document.querySelectorAll(".step");

        const progressBar = $(".progress-bar");
        const progressPercentage = ((stepIndex + 1) / totalQuestions) * 100;

        // Update the progress bar width and aria attributes using jQuery
        progressBar.css("width", progressPercentage + "%"); // Set the width
        progressBar.attr("aria-valuenow", progressPercentage.toFixed(0)); // Update the aria-valuenow
        progressBar.text(progressPercentage.toFixed(0) + "%"); // Set the text to show percentage
        allSteps.forEach((step, index) => {
            
            step.classList.toggle("active-step", index === stepIndex);
        });
        if (stepIndex === 0) {
        // First step: Show Next, hide Previous and Submit
            prevBtn.style.display = "none";  // Hide Previous button
            nextBtn.style.display = "inline-block";  // Show Next button
            submitBtn.style.display = "none";  // Hide Submit button
        } else if (stepIndex === totalQuestions - 1) {
            // Last step: Show Previous and Submit, hide Next
            prevBtn.style.display = "inline-block";  // Show Previous button
            nextBtn.style.display = "none";  // Hide Next button
            submitBtn.style.display = "inline-block";  // Show Submit button
        } else {
            // Middle steps: Show Next and Previous, hide Submit
            prevBtn.style.display = "inline-block";  // Show Previous button
            nextBtn.style.display = "inline-block";  // Show Next button
            submitBtn.style.display = "none";  // Hide Submit button
        }
    }

    // function showStep(stepIndex) {
    //     // Hide all steps
    //     const allSteps = document.querySelectorAll(".step");

    //     allSteps.forEach((step, index) => {
    //         step.style.display = (index === stepIndex) ? "block" : "none";
    //     });

    //     // Show or hide buttons based on the current step
    //     if (stepIndex === 0) {
    //         prevBtn.style.display = "none"; // Hide Previous button on first step
    //         nextBtn.style.display = "inline"; // Show Next button
    //         submitBtn.style.display = "none"; // Hide Submit button
    //     } else if (stepIndex === steps.length - 1) {
    //         prevBtn.style.display = "inline"; // Show Previous button
    //         nextBtn.style.display = "none"; // Hide Next button
    //         submitBtn.style.display = "inline"; // Show Submit button
    //     } else {
    //         prevBtn.style.display = "inline"; // Show Previous button
    //         nextBtn.style.display = "inline"; // Show Next button
    //         submitBtn.style.display = "none"; // Hide Submit button
    //     }
    // }


    // Handle the Previous button click
    prevBtn.addEventListener("click", function () {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    // Handle the Next button click
    nextBtn.addEventListener("click", function () {
        if (currentStep < totalQuestions - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });

    // Handle the form submission
    submitBtn.addEventListener("click", function () {

        event.preventDefault(); // Prevent default form submission
        var modal = new bootstrap.Modal(document.getElementById("confirmModal"));
        modal.show(); // Show modal
    });
    $("#confirmSubmit").on("click", function () {
        // Collect all form data

        var modal = bootstrap.Modal.getInstance(document.getElementById("confirmModal"));
        if (modal) {
            modal.hide(); // Hide the modal
        }
            var formData = $("#englishCourseQuizData").serialize();
            $("#loader").fadeIn();
            $.ajax({
                url: studentBaseUrl + "/english-course-quiz-submit",
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    // alert("fdsfd");
                    window.location.reload();

                    $("#quiz-container").css('display','none');
                    $('#success').css('display','block');
                    $('#next-btn').css('display','none');
                    $('#prev-btn').css('display','none');
                    $('#submit-btn').css('display','none');

                }
            });

        // const formData = new FormData();
        // $("input[type='radio']:checked").each(function () {
        //     formData.append($(this).attr("name"), $(this).val());
        // });

        // // Send the form data to the server
        // $.ajax({
        //     url: '/submit-quiz', // Define the endpoint to handle form submission
        //     type: 'POST',
        //     data: formData,
        //     processData: false,
        //     contentType: false,
        //     success: function (response) {
        //         console.log("Quiz Submitted Successfully:", response);
        //         // Show success message
        //         document.getElementById("success").style.display = "block";
        //         document.getElementById("quiz-container").style.display = "none"; // Hide the quiz
        //     },
        //     error: function (error) {
        //         console.error("Error submitting quiz:", error);
        //     }
        // });
    });
});
        </script>
    {{-- <script>
        const progress = (value) => {
            document.getElementsByClassName('progress-bar')[0].style.width = `${value}%`;
        }

        let step = document.getElementsByClassName('step');
        let prevBtn = document.getElementById('prev-btn');
        let nextBtn = document.getElementById('next-btn');
        let submitBtn = document.getElementById('submit-btn');
        let form = document.getElementsByTagName('form')[0];
        let preloader = document.getElementById('preloader-wrapper');
        let bodyElement = document.querySelector('body');
        let succcessDiv = document.getElementById('success');

        form.onsubmit = () => {
            return false
        }

        let current_step = 0;
        let stepCount = 6
        step[current_step].classList.add('d-block');
        if (current_step == 0) {
            prevBtn.classList.add('d-none');
            submitBtn.classList.add('d-none');
            nextBtn.classList.add('d-inline-block');
        }


        nextBtn.addEventListener('click', () => {
            current_step++;
            let previous_step = current_step - 1;
            if ((current_step > 0) && (current_step <= stepCount)) {
                prevBtn.classList.remove('d-none');
                prevBtn.classList.add('d-inline-block');
                step[current_step].classList.remove('d-none');
                step[current_step].classList.add('d-block');
                step[previous_step].classList.remove('d-block');
                step[previous_step].classList.add('d-none');
                if (current_step == stepCount) {
                    submitBtn.classList.remove('d-none');
                    submitBtn.classList.add('d-inline-block');
                    nextBtn.classList.remove('d-inline-block');
                    nextBtn.classList.add('d-none');
                }
            } else {
                if (current_step > stepCount) {
                    form.onsubmit = () => {
                        return true
                    }
                }
            }
            progress((100 / stepCount) * current_step);
        });


        prevBtn.addEventListener('click', () => {
            if (current_step > 0) {
                current_step--;
                let previous_step = current_step + 1;
                prevBtn.classList.add('d-none');
                prevBtn.classList.add('d-inline-block');
                step[current_step].classList.remove('d-none');
                step[current_step].classList.add('d-block')
                step[previous_step].classList.remove('d-block');
                step[previous_step].classList.add('d-none');
                if (current_step < stepCount) {
                    submitBtn.classList.remove('d-inline-block');
                    submitBtn.classList.add('d-none');
                    nextBtn.classList.remove('d-none');
                    nextBtn.classList.add('d-inline-block');
                    prevBtn.classList.remove('d-none');
                    prevBtn.classList.add('d-inline-block');
                }
            }

            if (current_step == 0) {
                prevBtn.classList.remove('d-inline-block');
                prevBtn.classList.add('d-none');
            }
            progress((100 / stepCount) * current_step);
        });


        submitBtn.addEventListener('click', () => {
            preloader.classList.add('d-block');

            const timer = ms => new Promise(res => setTimeout(res, ms));

            timer(3000)
                .then(() => {
                    bodyElement.classList.add('loaded');
                }).then(() => {
                    step[stepCount].classList.remove('d-block');
                    step[stepCount].classList.add('d-none');
                    prevBtn.classList.remove('d-inline-block');
                    prevBtn.classList.add('d-none');
                    submitBtn.classList.remove('d-inline-block');
                    submitBtn.classList.add('d-none');
                    succcessDiv.classList.remove('d-none');
                    succcessDiv.classList.add('d-block');
                })

        });
    </script> --}}
@endsection
