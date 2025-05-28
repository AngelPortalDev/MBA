@extends('frontend.master')
@section('content')

<style>
    .sidenav.navbar .navbar-nav .sp-8>.nav-link {
    color: #2b3990 !important;
    background-color:rgb(235 233 255);
    }
</style>


<main>
    <section class="pt-5 pb-5">
        <div class="container">
            <!-- User info -->
          {{-- <div class="row align-items-center"> --}}
                {{-- <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    @include('frontend.student.layout.student-profile-top-menu')
                </div> --}}
            {{-- </div> --}}
            <!-- Content -->
            {{-- <div class="row mt-0 mt-md-4"> --}}
                @include('frontend.student.layout.student-common')


                <div class="col-lg-9 col-md-8 col-12">
                  <!-- Card -->
                  <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        {{-- <h3 class="mb-0">Exploring My World</h3> --}}
                        <h3 class="mb-0">About You</h3>
                        {{-- <p class="mb-0">Inside Out: Personal Insights Shared Through Answers to Life's Thoughtful Questions</p> --}}
                    </div>
                    <!-- Card body -->
                    <div class="card-body">

                        <div>

                            <!-- Form -->
                            <form class="row gx-3 needs-validation aboutmeData" novalidate="">
                                <!-- Selection -->
                            

                                <!-- Question -->
                                <div class="mb-6 col-12 col-md-12">
                                        <label for="textarea-input" class="form-label">
                                            1.	What is your favorite hobby or pastime?</label>
                                        <input type='hidden' name="question_id[]" value="{{base64_encode('1')}}">
                                        <textarea class="form-control" name="answer[]" rows="2">{{isset($AboutmeData[0]->answer) ? $AboutmeData[0]->answer : '' }}</textarea>
                                </div>
                                <!-- Question -->
                                <div class="mb-6 col-12 col-md-12">
                                        <label for="textarea-input" class="form-label">
                                            2.	What is your favorite book, and why?</label>
                                        <input type='hidden' name="question_id[]" value="{{base64_encode('2')}}">
                                        <textarea class="form-control" name="answer[]" rows="2">{{isset($AboutmeData[1]->answer) ? $AboutmeData[1]->answer : '' }}</textarea>
                                </div>
                                <!-- Question -->
                                <div class="mb-6 col-12 col-md-12">
                                        <label for="textarea-input" class="form-label">
                                            3.	If you could travel anywhere in the world, where would you go and why?</label>
                                        <input type='hidden' name="question_id[]" value="{{base64_encode('3')}}">
                                        <textarea class="form-control" name="answer[]" rows="2">{{isset($AboutmeData[2]->answer) ? $AboutmeData[2]->answer : '' }}</textarea>
                                </div>
                                <!-- Question -->
                                {{-- <div class="mb-6 col-12 col-md-12">
                                        <label for="textarea-input" class="form-label">
                                            4.	What is your favorite movie or TV show, and what do you love about it?</label>
                                        <input type='hidden' name="question_id[]" value="{{base64_encode('4')}}">
                                        <textarea class="form-control" name="answer[]" rows="2">{{isset($AboutmeData[3]->answer) ? $AboutmeData[3]->answer : '' }}</textarea>
                                </div> --}}
                                <!-- Question -->
                                <div class="mb-6 col-12 col-md-12">
                                        <label for="textarea-input" class="form-label">
                                            4.	Share a memorable childhood experience or story.</label>
                                        <input type='hidden' name="question_id[]" value="{{base64_encode('5')}}">
                                        <textarea class="form-control" name="answer[]" rows="2">{{isset($AboutmeData[4]->answer) ? $AboutmeData[4]->answer : '' }}</textarea>
                                </div>
                                <!-- Question -->
                                <div class="mb-6 col-12 col-md-12">
                                        <label for="textarea-input" class="form-label">
                                            5.	If you could have any superpower, what would it be and how would you use it?</label>
                                        <input type='hidden' name="question_id[]" value="{{base64_encode('6')}}">
                                        <textarea class="form-control" name="answer[]" rows="2">{{isset($AboutmeData[5]->answer) ? $AboutmeData[5]->answer : '' }}</textarea>
                                </div>
                                <!-- Question -->
                                {{-- <div class="mb-6 col-12 col-md-12">
                                        <label for="textarea-input" class="form-label">
                                            7.	Share a goal or dream you have for the future.</label>
                                        <input type='hidden' name="question_id[]" value="{{base64_encode('7')}}">
                                        <textarea class="form-control" name="answer[]" rows="2">{{isset($AboutmeData[6]->answer) ? $AboutmeData[6]->answer : '' }}</textarea>
                                </div> --}}

                                <div class="mb-6 col-12 col-md-6">

                                <button type="submit" class="btn btn-primary aboutMe">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                  </div>
                </div>
            {{-- </div> --}}
        </div>
    </section>
</main>
@endsection