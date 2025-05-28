@extends('frontend.master')
@section('content')

<style>
    .sidenav.navbar .navbar-nav .e-men-7 > .nav-link {
    background-color: var(--gk-gray-200);
}
</style>


<main>
    <section class="pt-5 pb-5">
        <div class="container">
            
            <!-- Top Menubar -->
            @include('frontend.teacher.layout.e-mentor-common')

            <!-- Content -->

            {{-- <div class="row mt-0 mt-md-4"> --}}

                {{-- Left menubar  --}}
                

                <div class="col-lg-9 col-md-8 col-12">
                    <!-- Card -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">Behind the Mentorship: Unveiling Personal Tidbits</h3>
                            <p class="mb-0">Exploring Favorites and Passions: Dive into the World of Your E-Mentor.</p>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">

                            <div>

                                <!-- Form -->
                                <form class="row gx-3 needs-validation ementorAboutme" novalidate="">
                                    <!-- Selection -->


                                    <!-- Question -->
                                    <div class="mb-6 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">
                                            <input type='hidden' name="question_id[]" value="{{base64_encode('1')}}">
                                            1.	Share a pivotal moment or experience that shaped your journey as a mentor.</label>
                                            <textarea class="form-control" name="answer[]" rows="2">{{isset($AboutmeData[0]->answer) ? $AboutmeData[0]->answer : '' }}</textarea>

                                    </div>
                                    <!-- Question -->
                                    <div class="mb-6 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">
                                            <input type='hidden' name="question_id[]" value="{{base64_encode('2')}}">
                                            2. What do you hope to achieve through mentoring others online?</label>
                                            <textarea class="form-control" name="answer[]" rows="2">{{isset($AboutmeData[1]->answer) ? $AboutmeData[1]->answer : '' }}</textarea>
                                    </div>
                                    <!-- Question -->
                                    <div class="mb-6 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">
                                            <input type='hidden' name="question_id[]" value="{{base64_encode('3')}}">
                                            3.	Describe a challenge you faced in your career and how you overcame it.</label>
                                            <textarea class="form-control" name="answer[]" rows="2">{{isset($AboutmeData[2]->answer) ? $AboutmeData[2]->answer : '' }}</textarea>

                                    </div>
                                    <!-- Question -->
                                    <div class="mb-6 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">
                                            <input type='hidden' name="question_id[]" value="{{base64_encode('4')}}">
                                            4.	Share a piece of advice or lesson that has had a significant impact on your life.</label>
                                            <textarea class="form-control" name="answer[]" rows="2">{{isset($AboutmeData[3]->answer) ? $AboutmeData[3]->answer : '' }}</textarea>
                                    </div>
                                    <!-- Question -->
                                    <div class="mb-6 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">
                                            <input type='hidden' name="question_id[]" value="{{base64_encode('5')}}">
                                            5.	What unique skills or expertise do you bring to your role as an e-mentor?</label>
                                            <textarea class="form-control" name="answer[]" rows="2">{{isset($AboutmeData[4]->answer) ? $AboutmeData[4]->answer : '' }}</textarea>
                                            </div>
                                    <!-- Question -->
                                    <div class="mb-6 col-12 col-md-12">
                                            <label for="textarea-input" class="form-label">
                                            <input type='hidden' name="question_id[]" value="{{base64_encode('6')}}">
                                            6.	How do you approach building a strong mentor-mentee relationship in a virtual setting?</label>
                                            <textarea class="form-control" name="answer[]" rows="2">{{isset($AboutmeData[5]->answer) ? $AboutmeData[5]->answer : '' }}</textarea>
                                    </div>
                                    <!-- Question -->
                                    <div class="mb-6 col-12 col-md-6">

                                        <button type="submit" class="btn btn-primary ementorAboutSubmit">Submit</button>
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
