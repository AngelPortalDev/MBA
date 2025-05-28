@extends('frontend.master')
@section('content')

                           
        <!-- Wrapper -->
        <div id="db-wrapper" class="course-video-player-page course-video-player-page-studentExamSection">
            <!-- Sidebar -->
        
            @include('frontend.exam.layout.exam-left-menu')

            <!-- Page Content -->
            <main id="page-content">
                <div class="header" >
                    <nav class="navbar-default navbar navbar-expand-lg" style="background-color: #f1f5f9;box-shadow: none;">
                        <a id="nav-toggle" href="#" class=" color-blue fs-4">
                            <button class="button is-text is-opened" id="menu-button" onclick="buttonToggle()">
                                <div class="button-inner-wrapper">
                                    <i id="menu-icon" class="bi bi-x" style="font-size: x-large"></i>
                                </div>
                            </button>
                        </a>
                        <div class="d-flex align-items-center justify-content-between ps-3">
                            <div>
                                <h3 class="mb-0 text-truncate-line-2 color-blue studentAssignmentTitle">Individual Assignment (60%)</h3>
                            </div>
    
                        </div>
                    </nav>
                    
                </div>

                <!-- Page Header -->
                
                
                <!-- Container fluid -->
                <section class="container-fluid ps-5 pe-3 pt-2">
                        {{-- Assignment 1 --}}
                       
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <p class="mb-3"> <strong>Instructions:</strong>  This is the case that you’ll need to follow: XYZ Tech Solutions, a mid-sized software development company, is experiencing high employee turnover in its software engineering department. Despite offering competitive salaries and a positive work environment, the company has struggled to retain skilled software engineers for more than two years. Recent exit interviews indicate that many departing employees felt the job roles were not accurately represented during the recruitment process, leading to mismatched expectations. </p>
                                
                            <p class="mb-3"> <strong>You are be required to prepare a written assignment (1000 – 1500 words) that includes:</strong> <br>
                                    -	A solution to the presented organisation problem on recruitment and selection (with relevant literature and referencing) – 15 marks<br>
                                    -	Information on where candidates can be sourced from – 10 marks<br>
                                    -	Proposed candidate selection methods – 15 marks<br>
                                    -	Proposed package for compensation and benefits for the chosen candidate – 15 marks<br>
                                    -	Reference list – 5 marks
                                    
                                </p>
                            </div>
                            <input type="hidden" name="course_id" id="course_id" value="{{base64_encode($AssignmentData[0]->award_id)}}">
                            {{-- <input type="hidden" name="ementor_id" id="ementor_id" value="{{base64_encode($AssignmentData[0]->ementor_id)}}"> --}}
                            <input type="hidden" name="student_id" id="student_id" value="{{base64_encode(auth()->user()->id)}}">
                            @foreach ($QuestionData as $item)   
                            <div class="col-md-12 mb-5">
                                <label for="textarea-input" class="form-label">
                            <span class="color-blue">  </span>
                             {{$item->question}} [{{$item->assignment_mark}} Marks]
                        </label>
                        <input type="hidden" name="question_id" id="question_id" value="{{$item->id}}">
                        <input type="hidden" name="assignment_mark" id="assignment_mark" value="{{$item->assignment_mark}}">
                                <h6>Answer:</h6>
                                <textarea class="form-control" id="textarea-input" rows="10"> </textarea>
                            </div>
                            @endforeach
                        <div class="col-12 mb-6 text-center">
                            <a href="#" class="btn btn-primary">Submit Now</a>
                        </div>
                        </div>
                </section>
              

                
            </main>
        </div>


@endsection



<script>
// let buttonToggle = () => {
//     const button = document.getElementById("menu-button").classList,
//     icon = document.getElementById('menu-icon').classList
//     isopened = "is-opened";
//     let isOpen = button.contains(isopened);

//     if(isOpen) {
//       button.remove(isopened);
//       icon.remove('bi-x');
//       icon.add("bi-arrow-right");
//     } 
//     else {
//       button.add(isopened);
//       icon.remove("bi-arrow-right");
//       icon.add("bi-x");
//     }
// } 


const buttonToggle = () => {
        const button = document.getElementById("menu-button").classList,
              icon = document.getElementById('menu-icon').classList,
              isopened = "is-opened";
        const isOpen = button.contains(isopened);
    
        if (isOpen) {
            button.remove(isopened);
            icon.remove('bi-x');
            icon.add("bi-arrow-right");
        } else {
            button.add(isopened);
            icon.remove("bi-arrow-right");
            icon.add("bi-x");
        }
    };
    
    // Initial setup based on window size
    window.addEventListener('load', () => {
        const button = document.getElementById("menu-button").classList,
              icon = document.getElementById('menu-icon').classList;
    
        if (window.innerWidth <= 768) { 
            button.remove('is-opened');
            icon.remove('bi-x');
            icon.add('bi-arrow-right');
        } else { 
            button.add('is-opened');
            icon.add('bi-x');
            icon.remove('bi-arrow-right');
        }
    });
</script>