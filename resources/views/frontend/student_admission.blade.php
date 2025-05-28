<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ascencia </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets_admissions/imgs/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/responsive.css">
    <link rel="stylesheet" href="">

<style>
    *,
body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    scroll-behavior: smooth;
    background-color: #f1f5f9;
    font-family: Inter, sans-serif;
}

html {
    scroll-behavior: smooth;
}

body {
    overflow-x: hidden
}

.eascencia_logo {
    width: 139px;
    height: 51px;
    position: absolute;
    top: 15%;
    left: 12%
}

.btnstyle {
    /* font-family: Raleway, Sans-serif; */
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .5px;
    border-radius: 8px;
    padding: 8px 20px;
    top: 16px;
    left: 14px;
    line-height: 30px;
    position: absolute;
    background-color: #2b3990;
}
.btnstyle:hover{
    background-color: #191913;
}

.malta_heading_title,
.malta_sub_heading {
    /* font-family: Raleway, Sans-serif; */
    font-weight: 900;
    text-transform: uppercase
}

.ascencia_malta_logo_style {
    width: 200px;
    height: 80px;
    border-radius: 16px 0 0 16px;
    position: relative;
    border: 1px solid #fff;
    overflow: hidden
}

.navtopbar {
    background: #020101;
    height: 80px; 
    border-radius: 18px;
    box-shadow: 0px 0px 50px -20px rgba(0, 0, 0, 0.4);
}

.home_page {
    padding: 200px 0 60px;
}

.malta_heading_title {
    color: #191913;
    font-size: 50px;
    line-height: 58px
}

.malta_sub_heading {
    color: #2b3990;
    font-size: 31px;
    line-height: 40px
}

.malta_offer_title {
    color: #191913;
    /* font-family: "Open Sans", Sans-serif; */
    font-size: 19px;
    font-weight: 600;
    line-height: 30px
}

.study_benifi_list span,
.study_benifit_title {
    /* font-family: "Quattrocento Sans", Sans-serif; */
    margin-left: 5px
}

.study_benifi_list span {
    font-size: 17px;
    font-weight: 600;
}

.study_benifi_list .check-icon {
    color: #bc0f2c;
    font-size: 1.5rem;
    font-weight: 600 !important
}

.study_benifi_list li {
    display: flex;
    align-items: center;
    line-height: 30px;
}

.bi::before,
[class*=" bi-"]::before {
    font-weight: 700 !important
}

.study_benifit_title {
    font-size: 19px;
    font-weight: 700;
    margin-bottom: 0
}

.malta_form_column {
    display: flex;
    justify-content: end
}

.malta_lead_form {
    width: 496px;
    height: auto
}

.about_us_heading {
    color: #2b3990;
    /* font-family: Raleway, Sans-serif; */
    font-size: 16px;
    font-weight: 300;
    text-transform: uppercase;
    line-height: 28px;
    letter-spacing: 0;
    margin-top: 10rem
}

.about_us_title,
.our_mission_section_title,
.program_section_title {
    color: #191913;
    /* font-family: Raleway, Sans-serif; */
    font-size: 40px;
    font-weight: 800;
    line-height: 45px
}

.malta_description,
.program_description {
    color: #191913;
    /* font-family: "Open Sans", Sans-serif; */
    font-size: 15px;
    font-weight: 400;
    line-height: 30px
}

.apply_btn_style,
.program_heading_section {
    /* font-family: Raleway, Sans-serif; */
    text-transform: uppercase
}

.program_heading_section {
    color: #bc0f2c;
    font-size: 16px;
    font-weight: 300;
    line-height: 28px;
    letter-spacing: 0
}

.apply_btn_style {
    font-size: 12px;
    font-weight: 500;
    line-height: 24px;
    letter-spacing: .5px;
    background: linear-gradient(to right, #d5213f 50%, #bc0f2c 50%);
    background-size: 200% 100%;
    background-position: right bottom;
    transition: .4s;
    padding: 10px 20px;
    margin-top: 2rem
}

.campus_notes,
.campus_right_column {
    background-color: #191914
}

.our_program_section {
    margin-top: 0;
    margin-bottom: 0;
    padding: 120px 0 60px
}

.our_program_course_title {
    /* font-family: "Futura Bold", Sans-serif; */
    font-weight: 700;
    color: #222218
}

.campus_notes_heading,
.our_mission_section_heading {
    font-size: 16px;
    font-weight: 300;
    text-transform: uppercase;
    line-height: 28px;
    letter-spacing: 0;
    /* font-family: Raleway, Sans-serif */
}

.button_wrapper_program {
    margin-top: 40px
}

.button_wrapper_apply_now .apply_now_btn_style,
.button_wrapper_program .apply_now_btn_style {
    padding: 12px 24px;
    background-color: #bc0f2c !important;
    color: #fff !important;
    text-transform: uppercase;
    font-size: 13px
}

.button_wrapper_apply_now .apply_now_btn_style:hover,
.button_wrapper_program .apply_now_btn_style:hover {
    background-color: #dc3545 !important
}

.button_wrapper_apply_now {
    margin-top: 60px !important
}

.campus_notes {
    padding: 0 20% 0 10%;
    color: #fff;
    align-content: center
}

.campus_notes_heading {
    color: #fff
}

.campus_notes_title {
    color: #fff;
    /* font-family: Raleway, Sans-serif; */
    font-size: 40px;
    font-weight: 800;
    line-height: 45px
}

.campus_description {
    color: #fff;
    /* font-family: "Open Sans", Sans-serif; */
    font-size: 14px;
    font-weight: 400;
    line-height: 30px
}

.program_description_main {
    background-color: #bc0f2c;
    color: #fff;
    height: 1.7rem;
    width: 1.7rem;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-size: 1rem
}

.program_description_icon {
    font-size: 1rem
}

.our_program_course_title {
    font-size: 1.5rem;
    margin-left: .5rem;
    line-height: 1.5
}

.mission_chev_icon_style i {
    font-size: 1.2rem
}

.our_mission_title {
    font-size: 1rem;
    line-height: 1.5
}

.my_icon {
    font-size: 1.2rem;
    background: #222218;
    height: 28px;
    width: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff
}

.my_icon:hover {
    background: #bc0f2c
}




/* New styling */

.bi-check-circle{
    color: #38A169;
}

.study_benifi_list span{
    color: #64748b;
}

.about-us-values{
    background-color: white !important;
}

.card-body h4{
    font-size: 22px;
}

@media only screen and (max-width: 768px) {
    .malta_heading_title {
      font-size: 32px !important;
        line-height: 40px !important;
    }
    .malta_sub_heading{
        font-size: 22px !important;
        line-height: 30px !important;
    }
    .malta_offer_title,.study_benifit_title {
        font-size: 16px !important;
    }
    .study_benifi_list span{
        font-size: 15px !important;
    }
    .about_us_title{
        font-size: 30px !important;
        line-height: 35px;
    }
 
    .home_page{
        padding: 160px 0px 60px 0px !important;
    }
    .program_section_title{
        font-size: 24px !important;
        line-height: 30px !important;
    }
    .button_wrapper{
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }
    .course-list-heading{
        margin-top: 3rem !important;
    }

 
    .campus_notes_title{
        font-size: 30px !important;
        line-height: 35px !important;
    }
    /* iframe{
        height: 1200px !important;
    } */
    
  }


   @media only screen and (max-width: 992px) {
    .our_program_course_title{
        font-size: 1rem !important;
        line-height: 1.5 !important;
    }
    .about_us_heading{
        margin-top: 5rem !important;
    }
    .about_us_mobile{
        display: none;
    }

  }

   @media only screen and (min-width: 992px) {
    .img_section_university{
        padding: 0;
    }
    .img_section_graduate{
        padding: 0;
    }
    .about_us_desktop{
        display: none;
    }
  } 

  #apply-form {
    scroll-margin-top: 100px;
  }


</style>
</head>

<body>
    <section class="main_contaniner">
        <header>
            <div class="container mt-4 fixed-top">
                <div class="navtopbar d-flex justify-content-between">
                    <div class="logo bg-white ascencia_malta_logo_style">
                        <img src="{{ asset('assets_admissions/imgs/logo.svg') }}" alt="not found" class="img-fluid eascencia_logo bg-white" />
                    </div>
                    <div style="width: 150px; position: relative;">
                        <a href="#apply-form"> <button class="btn text-white btnstyle">Apply Now</button></a> 
                    </div>
                </div>
            </div>
        </header>
        <!-- <div class="container">
            <nav class="navbar">
                <div class="container-fluid">
                <img src="./assets/imgs/logo.svg" style="width: 160px;">
                <form class="d-flex" role="search">
                    <a href="#home"> <button class="btn btn-primary text-white ">Apply Now</button></a> 
                </form>
                </div>
            </nav>
        </div> -->
       <section class="home_page" id="home">
        <div class="container mb-4">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="heading_section">
                        <p class="malta_heading_title">100% Online <br />E-ASCENCIA</p>
                        <p class="malta_sub_heading">
                            Our Courses
                        </p>
                        <!-- <p class="malta_offer_title mt-3">50% Scholarship for Eligible Candidates</p> -->
                    </div>
                    <div class="study_benifits">
                        <p class="study_benifit_title ">Award Courses</p>
                        <ul class="list-unstyled study_benifi_list">
                            <li><i class="bi bi-check-circle"></i><span>Award in Recruitment and Employee Selection</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Award in Strategic Leadership</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Award in Public Speaking and Presentation Skills</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Award in Employee and Labour Relations</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Award in Leadership Frameworks and Principles</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Award in Professional Development</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Award in Executive Presence and Impression Management</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Award in Training and Development</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Award in Decision Making Frameworks and Data Analysis</span></li>  
                        </ul>

                        <p class="study_benifit_title ">Certificate Courses</p>
                        <ul class="list-unstyled study_benifi_list">
                            <li><i class="bi bi-check-circle"></i><span>Post Graduate Certificate in Human Resources Management</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Post Graduate Certificate in Entrepreneurship</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Post Graduate Certificate in Leadership and Business Development</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Postgraduate Certificate in Business Administration in Leadership Excellence</span></li>
                        </ul>
                        <p class="study_benifit_title ">Diploma Courses</p>
                        <ul class="list-unstyled study_benifi_list">
                            <li><i class="bi bi-check-circle"></i><span>Post Graduate Diploma in Human Resources Management</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Post Graduate Diploma in International Management and Global Business</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Post Graduate Diploma in Leadership and Business Development</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Postgraduate Diploma in Business Administration in Leadership Excellence</span></li>
                        </ul>
                        <p class="study_benifit_title ">Master Courses</p>
                        <ul class="list-unstyled study_benifi_list">
                            <li><i class="bi bi-check-circle"></i><span>Masters of Arts in Human Resources Management</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Masters of Arts in Leadership and Business Development</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Masters of Arts in International Management and Global Business</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Masters of Arts in Entrepreneurship</span></li>
                            <li><i class="bi bi-check-circle"></i><span>Masters of Business Administration (MBA) in Leadership Excellence</span></li>

                        </ul>
                    </div>
                    <div class="about_us about_us_mobile">
                        <p class="about_us_heading mb-0">About us</p>
                        <p class="about_us_title">About E-Ascencia</p>
                        <p class="malta_description">E-Ascencia Malta is a leading online learning platform designed to deliver top-notch education to students worldwide. Our platform provides a variety of courses meticulously developed to align with international benchmarks and accommodate learners from different backgrounds.

                        </p>
                    </div>
                
                </div>
                <div class="col-lg-6 col-md-6 col-12 malta_form_column">
                    <div class="malta_lead_form" id="apply-form">
                        {{-- <iframe aria-label='Admission Open for 2025' frameborder="0" style="height:1450px;width:100%;border:none; overflow-y: hidden;" src='https://forms.zohopublic.com/info5253/form/AdmissionOpenfor2025/formperma/wLjpz1XvT3qwQsXPAbdHs_zHGsPW7lKz2OmoVmLWlR4'></iframe> --}}

                        <iframe aria-label='Admission Open for 2025 Intake!' frameborder="0" style="height:1450px;width:100%;border:none; overflow-y: hidden;;" src='https://forms.zohopublic.com/info5253/form/AdmissionOpenfor2025Intake4/formperma/wLjpz1XvT3qwQsXPAbdHs_zHGsPW7lKz2OmoVmLWlR4'></iframe>
                    </div>
                </div>
                <div class="about_us about_us_desktop">
                    <p class="about_us_heading mb-0">About us</p>
                    <p class="about_us_title">About E-Ascencia </p>
                    <p class="malta_description">E-Ascencia Malta is a leading online learning platform designed to deliver top-notch education to students worldwide. Our platform provides a variety of courses meticulously developed to align with international benchmarks and accommodate learners from different backgrounds.
                    </p>
                </div>
            </div>
        </div>
    <div class="container-fluid pb-4 pt-5 about-us-values bg-white">
        <section class="pb-4 pt-6 about-us-values">
            <div class="container">
                <div class="row bg-white">
                    <div class="col-lg-6 col-md-8 col-12 mb-3 bg-white">
                        <!-- caption -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 d-flex bg-white">
                        <!-- card -->
                        <div class="card mb-4 border-0">
                            <!-- card body -->
                            <div class="card-body p-4 rounded-3">
                                <!-- icon -->
                                <div class="mb-3">
                                    <img src="{{asset('assets_admissions/imgs/about/about-us-icons-01.png')}}" alt="img not found">
                                </div>
                                <h4 class="mb-2">Excellence</h4>
                                <p class="mb-0">We are committed to delivering excellence in education through high-quality course content and cutting-edge learning technologies.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 d-flex bg-white">
                        <!-- card -->
                        <div class="card mb-4 border-0">
                            <!-- card body -->
                            <div class="card-body p-4 rounded-3">
                                <!-- icon -->
                                <div class="mb-3">
                                    <img src="{{asset('assets_admissions/imgs/about/about-us-icons-02.png')}}" alt="img not found">
                                </div>
                                <h4 class="mb-2">Accessibility</h4>
                                <p class="mb-0">We believe in breaking down barriers to education by providing an accessible and inclusive learning platform that accommodates diverse learners.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 d-flex bg-white">
                        <!-- card -->
                        <div class="card mb-4 border-0">
                            <!-- card body -->
                            <div class="card-body p-4 rounded-3">
                                <!-- icon -->
                                <div class="mb-3">
                                    <img src="{{asset('assets_admissions/imgs/about/about-us-icons-03.png')}}" alt="img not found">
                                </div>
                                <h4 class="mb-2">Innovation</h4>
                                <p class="mb-0">We embrace innovation in teaching and learning methodologies, constantly evolving to meet the evolving needs of the digital age.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 d-flex bg-white">
                        <!-- card -->
                        <div class="card mb-4 border-0">
                            <!-- card body -->
                            <div class="card-body p-4 rounded-3">
                                <!-- icon -->
                                <div class="mb-3">
                                    <img src="{{asset('assets_admissions/imgs/about/about-us-icons-04.png')}}" alt="img not found">
                                </div>
                                <h4 class="mb-2">Integrity</h4>
                                <p class="mb-0"> We pride ourselves on upholding the highest standards of integrity, ensuring transparency in all our actions, and conducting ourselves. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 d-flex bg-white">
                        <!-- card -->
                        <div class="card mb-4 border-0">
                            <!-- card body -->
                            <div class="card-body p-4 rounded-3">
                                <!-- icon -->
                                <div class="mb-3">
                                    <img src="{{asset('assets_admissions/imgs/about/about-us-icons-05.png')}}" alt="img not found">
                                </div>
                                <h4 class="mb-2">Empowerment </h4>
                                <p class="mb-0">We empower students to take control of their learning journey, offering them the flexibility and resources they need to succeed academically and professionally.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 d-flex bg-white">
                        <!-- card -->
                        <div class="card mb-4 border-0">
                            <!-- card body -->
                            <div class="card-body p-4 rounded-3">
                                <!-- icon -->
                                <div class="mb-3">
                                    <img src="{{asset('assets_admissions/imgs/about/about-us-icons-06.png')}}" alt="img not found">
                                </div>
                                <h4 class="mb-2">Collaboration</h4>
                                <p class="mb-0">We believe in the power of collaboration and community-building, so we foster an environment where students can collaborate with peers and instructors.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    </section>
    </section>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>