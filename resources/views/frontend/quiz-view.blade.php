@extends('frontend.master')
@section('content')

<style>
    .bg-light {
        background: linear-gradient(to right, #f8f9fa, #e2e6ea);
    }
    .quiz-container {
        text-align: center;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }
    .quiz-instructions {
        margin: 20px 0;
        font-size: 1.2rem;
        color: #343a40;
    }
    .quiz-instructions li{
        font-size: 1rem;
    }
    .btn-primary {
        font-size: 1rem;
        padding: 10px 20px;
    }
    img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin-bottom: 20px;
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
        background-color: #f02042;
     }
</style>

<section class="pt-6 pb-4 bg-light">
    <div class="container d-flex justify-content-end p-0 mb-2">
        <a href="{{ route('english-course-program') }}" class="btn btn-outline-primary underline back_to_home_page">Back</a>
    </div>
    <div class="container quiz-container">
        <h1 class="mb-4 text-dark">Quiz Time!</h1>
        <img src="{{ asset('frontend/images/english-program/quiz-think.png') }}" class="img-fluid" alt="Quiz Banner" style="width: 35%"/>

        {{-- <div class="quiz-instructions">
            <h3>Instructions:</h3>
            <ul style="list-style-type: none; padding: 0;">
                <li>Answer all questions to the best of your ability.</li>
                <li>You will have a total of 15 minutes to complete the quiz.</li>
                <li>Once you start, you cannot go back to previous questions.</li>
                <li>Click the "Start Now" button to begin!</li>
            </ul>
        </div> --}}
        @php
            $currentUrl = $_SERVER['REQUEST_URI'];
            $urlSegments = explode('/', $currentUrl);
            $section_id = end($urlSegments);
        @endphp     
        <a href="{{ route('quiz-questions',['section_id'=>$section_id]) }}" class="btn text-white" style="display: block; margin: 0 auto; width: fit-content; background-color: #D34059">Start Now</a>

    </div>
</section>

@endsection
