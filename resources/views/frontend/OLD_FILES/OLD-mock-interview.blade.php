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
                                <h3 class="mb-0 text-truncate-line-2 color-blue"> Mock Interview (40%)</h3>
                            </div>

                        </div>

                    </nav>
                </div>

                <!-- Page Header -->
                
                
                <!-- Container fluid -->
                <section class="container-fluid px-4 pt-2">
                        {{-- Assignment 1 --}}
                        <div class="row justify-content-center">
                            <div class="col-md-12 mb-3">
                                <p> <strong>Instructions:</strong> You’ll need to video yourself and a guest who you are interviewing. Using the below job description for a Customer Experience Manager, you will need to create an interview matrix and interview guide (10%) for this fictitous post. You will then need to source and interview the pseudo candidate, record the interview in video format and submit it (20%) and submit your final recommendation in writing (a one page report) on the suitability of the candidate for the role (10%). </p>
                                
                                <a href=""> Download job description from here JD.pdf <i class="fe fe-download fs-5"></i></a>
                            </div>
                            <div class="col-md-12 mb-5">
                                    <label for="textarea-input" class="form-label">
                                        <span class="color-blue"> Part 1: </span>
                                        Interview matrix and interview guide. [10 Marks]
                                    </label>
                                    <div class="col-md-6 mt-2">
                                        <div class="mb-1">
                                                <label for="et_pb_contact_brand_file_request_0" class="et_pb_contact_form_label">Enter</label>
                                                
                                                <input type="file" id="et_pb_contact_brand_file_request_0" class="file-upload mt-2">
                                            
                                        </div>
                                        
                                    </div>

                            </div>
                            <div class="col-md-12 mb-5">
                                    <label for="textarea-input" class="form-label">
                                        <span class="color-blue"> Part 2: </span>
                                        Interview Video [20 Marks]
                                    </label>
                                    <div class="col-md-6 mt-2">
                                        <div class="mb-1">
                                                <label for="et_pb_contact_brand_file_request_0" class="et_pb_contact_form_label">Enter</label>
                                                <input type="file" id="et_pb_contact_brand_file_request_0" class="file-upload mt-2">
                                            
                                        </div>
                                        
                                    </div>
                            </div>
                            <div class="col-md-12 mb-5">
                                    <label for="textarea-input" class="form-label">
                                        <span class="color-blue"> Part 3: </span>
                                        Final recommendation in writing (a one page report) on the suitability of the candidate for the role [10 Marks]
                                    </label>
                                    <div class="col-md-6 mt-2">
                                        <div class="mb-1">
                                                <label for="et_pb_contact_brand_file_request_0" class="et_pb_contact_form_label">Enter</label>
                                                <input type="file" id="et_pb_contact_brand_file_request_0" class="file-upload mt-2">
                                            
                                        </div>
                                        
                                    </div>  
                            </div>

    
    
                        <div class="col-12 mb-6">
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
//     isopened = "is-opened";
//     let isOpen = button.contains(isopened);
//     if(isOpen) {
//       button.remove(isopened);
      
//     } 
//     else {
//       button.add(isopened);
      
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

