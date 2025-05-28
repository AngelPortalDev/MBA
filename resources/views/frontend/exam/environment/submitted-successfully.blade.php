{{-- <div class="header" >
    <nav class="navbar-default navbar navbar-expand-lg" style="background-color: #f1f5f9;box-shadow: none;">
        <a id="nav-toggle" href="#" class=" color-blue fs-4">
            <button class="button is-text is-opened" id="menu-button4" onclick="buttonToggle('menu-button4','menu-icon4')">
                <div class="button-inner-wrapper">
                    <i id="menu-icon4" class="bi bi-x" style="font-size: x-large"></i>
                </div>
            </button>
        </a>


    </nav>
</div> --}}
<!-- Container fluid -->
<section class="container px-4 mt-5">
        {{-- Assignment 1 --}}
        <div class="row justify-content-center">

            <div class="col-md-12 col-lg-6  mb-3 ExamSubmissionForm">
                <div class="row justify-content-center bg-white pt-4 px-md-3 rounded">
                    <div class="col-md-8 text-center">

                        <img class="p-3 " src="{{ asset('frontend/images/after-submitted-exam.png')}}" alt="E-Ascencia" width="100%">
        
                    </div>

                    <div class="col-md-12">
                        <h2 class="color-blue">Submission Confirmation</h2>

                        <p> You have successfully submitted your @if(isset($message))  {{$message}}. @endif <br>
                            Your submission has been sent to your E-mentor for detailed review. The e-mentor will evaluate your work and provide feedback.</p>
                            {{-- <h5>Assessment Type: [Assignment/Mock Interview]</h5> --}}
                            <p>Your final score will be emailed to you after you have completed all the assessments. <br>
                            Thank you for your effort and dedication! Keep up the good work. <br>
                            Happy Learning!</p>
                    </div>

                    <div class="col-md-12 mb-6  text-center ">
                        <a href="{{url('/')}}" class="btn btn-primary">Back to Home</a>
                    </div>
                </div>
            </div>


        </div>
</section>