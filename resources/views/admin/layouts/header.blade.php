<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('admin/libs/flatpickr/dist/flatpickr.min.css') }}">
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Malta Business Academy" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56" href="{{ asset('admin/images/favicon/favicon.png') }}">

    <!-- darkmode js -->    
    <link rel="stylesheet" href="{{ asset('admin/libs/quill/dist/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/libs/glightbox/dist/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/libs/bs-stepper/dist/css/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/libs/dragula/dist/dragula.min.css') }}">

    <!-- Libs CSS -->
    <link href="{{ asset('admin/libs/dropzone/dist/dropzone.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/fonts/feather/feather.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="{{ asset('admin/js/vendors/jquery.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src=" {{ asset('admin/js/jquery.dataTables.js') }}"></script>
    <link href="{{ asset('frontend/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>



<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('admin/css/theme.min.css')}}">
<!-- Custom CSS  -->
<link rel="stylesheet" href="{{ asset('admin/css/responsive.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css">
<script type="text/javascript" src="{{ asset('frontend/js/sweetalert.min.js')}}"></script>
{{-- <script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script> --}}
<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/decoupled-document/ckeditor.js"></script>
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.css" rel="stylesheet"> --}}
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/theme.min.css') }}">
    <!-- Custom CSS  -->
    <link rel="stylesheet" href="{{ asset('admin/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css">
    <script type="text/javascript" src="{{ asset('frontend/js/sweetalert.min.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>


    {{-- <link rel="stylesheet" href="{{ asset('admin/css/spinner.scss')}}"> --}}
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">


    <title>Malta Business Academy | Admin @yield('maintitle') </title>
    @yield('css')

    <style>
        .loader {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            background: #ffffff32;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* justify-content: space-evenly; */
            padding: 10px;
            box-shadow: 2px 2px 10px -5px lightgrey;
            z-index: 999999;
            position: fixed;
            top: 50%;
            left: 0%;
        }

        .loading {
            width: 30%;
            height: 10px;
            background: lightgrey;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 10%;
            height: 10px;
            background: #002;
            border-radius: 10px;
            z-index: 1;
            animation: loading 0.6s alternate infinite;
        }

        .labelloader {
            color: #002;
            font-size: 18px;
            animation: bit 0.6s alternate infinite;
        }

        @keyframes bit {
            from {
                opacity: 0.3;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes loading {
            0% {
                left: -25%;
            }

            100% {
                left: 70%;
            }

            0% {
                left: -25%;
            }
        }

        .sidenav.navbar .navbar-nav .sp-3>.nav-link {
            color: #2b3990 !important;
            background-color: rgb(235 233 255);
        }

        .save_loader {
            /* background-color: blue; */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: fixed;
            z-index: 999999;
            width: 100%;
            height: 100%;
            padding: 20%;
            border-radius: 10px;
            /* background: #ffffff52; */
            background: #fff;
            opacity: 0.8;
        }

        /* .save_loader-text {
            font-size: 24px;
            color: #2b3990;
            margin-bottom: 20px;
            align-self: center;
            font-weight: bold;
            display: flex;
            align-items: center;
            margin: 0 250px auto;
        } */

        .save_loader-bar {
            width: 50px;
            height: 50px;
            aspect-ratio: 1;
            border-radius: 50%;
            background:
                radial-gradient(farthest-side, #2b3990 94%, #0000) top/8px 8px no-repeat,
                conic-gradient(#0000 30%, #2b3990);
            -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 8px), #000 0);
            animation: l13 1s infinite linear;
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
        }

        @keyframes l13 {
            100% {
                transform: rotate(1turn);
            }
        }

        @keyframes loader-bar-animation {
            0% {
                /* transform: translateX(-100%) rotate(270deg); */
                transform: translateX(-100%);
            }

            50% {
                /* transform: translateX(100%) rotate(-90deg); */
                transform: translateX(100%);
            }

            100% {
                /* transform: translateX(-100%) rotate(270deg); */
                transform: translateX(-100%);
            }
        }
        .swal-button{
        background-color: #2b3990;
        }
        .swal-button-container{
        display: flex;
        justify-content: center;
        }
        .swal-button:hover{
        background-color: #2b3990 !important;
        }
        .swal-footer{
        display: flex;
        justify-content: center;
        }
        .swal-button--cancel{
        color: #000;
        background-color: #efefef;
        }

        .swal-button--cancel:hover{
        background-color: #efefef !important;
        }
        .swal-text{
        text-align: center;
        }


    </style>
</head>

<body>

    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <!-- Sidebar -->
        <nav class="navbar-vertical navbar">
            <div class="vh-100" data-simplebar>

                @if(Auth::check() && Auth::user()->role === 'sales')
                    <a class="navbar-brand" href="{{ route('dashboard.admin') }}">
                        <img src="{{ asset('admin/images/brand/logo/E-Ascencia-Logo-White.svg') }}" alt="E-Ascencia" />
                    </a>
                    <ul class="navbar-nav flex-column" id="sideNavbar">
                        <li class="nav-item">
                            <a class="nav-link  collapsed " href="{{ route('dashboard.admin') }}">
                                <i class="nav-icon fe fe-home me-2"></i> Dashboard 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('admin.students') }}">
                                <i class="nav-icon bi bi-people me-2"></i>
                                Students
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.payment.payment') }}">
                                <i class="nav-icon bi bi-wallet2 me-2"></i>
                                Payment
                            </a>
    
                        </li>
                    </ul>
                @else
                <!-- Brand logo -->
                <a class="navbar-brand" href="{{ route('admin.index') }}">
                    <img src="{{ asset('admin/images/brand/logo/logo.png') }}" alt="E-Study" />
                </a>
                <!-- Navbar nav -->
                <ul class="navbar-nav flex-column" id="sideNavbar">
                    <li class="nav-item">
                        {{-- <a class="nav-link " href="{{ route('dashboard') }}" data-bs-toggle="collapse" data-bs-target="#navDashboard"
                            aria-expanded="false" aria-controls="navDashboard">
                            <i class="nav-icon fe fe-home me-2"></i>
                            Dashboard
                        </a> --}}
                        {{-- <div id="navDashboard" class="collapse  " data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link  " href="{{ route('dashboard') }}">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('dashboard') }}">Analytics</a>
                                </li>
                            </ul>
                        </div> --}}
                    </li>
                
                    @if(Auth::check() && Auth::user()->role === 'superadmin')
                    <li class="nav-item">                
                        <a class="nav-link  collapsed " href="{{ route('admin.index') }}">
                            <i class="nav-icon fe fe-book me-2"></i> Admin
                        </a>
                        <!-- <div id="nav-admin" class="collapse " data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link " href="admin-all.php">All Admin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="admin-create.php">Create</a>
                                </li>
    
                            </ul>
                        </div> -->
                    </li>
                    @endif
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/e-mentors*') ? 'active' : '' }}" href="{{ route('admin.e-mentors.e-mentors') }}">
                            <i class="nav-icon bi bi-person-lines-fill me-2"></i>
                            Lecturers
                        </a>
                    </li>

                    {{-- sub ementor --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/sub-e-mentors*') ? 'active' : '' }}" href="{{ route('admin.sub-e-mentors.sub-e-mentors') }}">
                            <i class="nav-icon bi bi-person-lines-fill me-2"></i>
                            Sub E-mentors
                        </a>
                    </li> --}}
                    


                    <!-- Teacher -->
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/teacher*') ? 'active' : '' }}" href="{{ route('admin.teacher.teacher') }}">
                            <i class="nav-icon bi bi-person-square me-2"></i>
                            Teacher
                        </a>

                    </li> --}}

                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/students*') ? 'active' : '' }}" href="{{ route('admin.students') }}">
                            <i class="nav-icon bi bi-people me-2"></i>
                            Students
                        </a>
                    </li>

                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/institute*') ? 'active' : '' }}" href="{{ route('admin.institute.institute') }}">

                            <i class="nav-icon bi bi-buildings me-2"></i>
                            Institute
                        </a>
                    </li> --}}
                    
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/sales-executive*') ? 'active' : '' }}" href="{{ route('admin.sales-executive') }}">
        
                            <i class="nav-icon bi bi-briefcase me-2"></i>

                            Sales Executive
                        </a>
                    </li> --}}
                    
                    <!-- Nav item -->
                    {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/section*') || request()->is('admin/videos*') || request()->is('admin/quiz*') || request()->is('admin/edit-quiz-get-data*') || request()->is('admin/journal-articles') || request()->is('admin/get-journal-article-edit*') ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse"
                            data-bs-target="#course-content" 
                            aria-expanded="{{ request()->is('admin/section*') ? 'true' : 'false' }}" 
                            aria-controls="course-content">
                            <i class="nav-icon bi bi-journal-text me-2"></i>
                            Course Content
                        </a>
                        <div id="course-content" class="collapse {{ request()->is('admin/section*') || request()->is('admin/videos*') || request()->is('admin/quiz*') || request()->is('admin/edit-quiz-get-data*') || request()->is('admin/journal-articles') || request()->is('admin/get-journal-article-edit*') ? 'show' : '' }}"  data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin/section*') ? 'active' : '' }}" href="{{ route('admin.course.section') }}" >Section</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin/videos*') ? 'active' : '' }}" href="{{ route('admin.course.videos') }}">Video</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin/quiz') || request()->is('admin/edit-quiz-get-data*') ? 'active' : '' }}" href="{{ route('admin.course.quiz') }}">Quiz</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin/journal-articles') || request()->is('admin/get-journal-article-edit*') ? 'active' : '' }}" href="{{ route('admin.course.journal-articles') }}">Document
                                        </a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}

                    <!-- Nav item -->

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/all-award*') || request()->is('admin/award-course-get-data*') ? 'active' : '' }}" href="{{ route('admin.course.all-award') }}">
                      <i class="nav-icon bi bi-journal-bookmark-fill me-2"></i>
                            Courses
                        </a>
                    </li>
                
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/all-award*') || request()->is('admin/award-course-get-data*') || request()->is('admin/all-course*') ? '' : 'collapsed' }} " href="#" data-bs-toggle="collapse"
                            data-bs-target="#course-page" aria-expanded="false" aria-controls="course-page">
                            
                            <i class="nav-icon bi bi-journal-bookmark-fill me-2"></i>
                            Course
                        </a>
                        <div id="course-page" class="collapse {{ request()->is('admin/all-award*') || request()->is('admin/award-course-get-data*') || request()->is('admin/all-course*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin/all-award*') || request()->is('admin/award-course-get-data*') ? 'active' : '' }}" href="{{ route('admin.course.all-award') }}">Award</a>
                           </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('admin/all-course*') ? 'active' : '' }}" href="{{ route('admin.course.all-course') }}">All</a>
                                </li>
                               
                            </ul>
                        </div>
                    </li> --}}
                    
                    <!-- Certificate Templates -->
                    @if(Auth::check() && Auth::user()->role === 'superadmin')
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.certificates.certificate-templates') }}">
                            
                                <i class="nav-icon bi bi-layout-text-window me-2"></i>
                                Certificate Templates
                            </a>

                        </li> --}}
                    @endif

                    <!-- Promo Code -->
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.payment.promo-code') }}">
                            <i class="nav-icon bi bi-qr-code me-2"></i>
                            Promo Code
                        </a>

                    </li> --}}
                    <!-- Payment -->
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.payment.payment') }}">
                            <i class="nav-icon bi bi-wallet2 me-2"></i>
                            Payment
                        </a>

                    </li> --}}
                    <!-- Exam Amount -->
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.coures.exams-amount') }}">
                            <i class="nav-icon bi bi-currency-euro me-2"></i>
                            Exam Amount
                        </a>

                    </li> --}}

                    <!-- Certificates -->
                    @if(Auth::check() && Auth::user()->role === 'superadmin')
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.certificate') }}">
                                <i class="bi bi-clipboard2-check me-2"></i>
                                Certificates
                            </a>
                        </li> --}}
                    @endif

                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.testimonials.testimonials') }}">
                            <i class="nav-icon bi bi-people me-2"></i>
                            Testimonials
                        </a>
                    </li> --}}

                    <!-- Nav item -->
                    {{-- <li class="nav-item">
                        <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse"
                            data-bs-target="#exam" aria-expanded="false" aria-controls="exam">
                            <i class="nav-icon bi bi-book me-2"></i>
                            Exam
                        </a>
                        <div id="exam" class="collapse" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">

                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('admin.exam.assignment') }}">Assignment</a>
                
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('admin.exam.mock-interview') }}">Mock
                                        Interview</a>
       
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('admin.exam.vlog') }}">Vlog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('admin.exam.peer-review') }}">Peer Review</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('admin.exam.forum-leadership') }}">Forum Leadership</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('admin.exam.reflective-journals') }}">Reflective Journals</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('admin.exam.multiple-choice') }}">Multiple Choice</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('admin.exam.survey') }}">Survey</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('admin.exam.final-thesis') }}">Final Thesis</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('admin.exam.artificial-intelligence') }}">Artificial Intelligence</a>
                                </li>
                                
                            </ul>
                        </div>
                    </li> --}}

                       <!-- Nav item -->
                       <li class="nav-item">
                        <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse"
                            data-bs-target="#report" aria-expanded="false" aria-controls="report">
                            <i class="bi bi-journal-richtext me-2"></i>
                            Reports
                        </a>
                        <div id="report" class="collapse" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.exam.student-report') }}">Student Report</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.exam.course-reports') }}">Course Report</a>
                                </li> --}}
                            </ul>
                        </div>
                    </li>

                    @if(Auth::check() && Auth::user()->role === 'superadmin')
                    {{-- <li class="nav-item">
                        <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse"
                        data-bs-target="#setting" aria-expanded="false" aria-controls="setting">
                        <i class="nav-icon bi bi-gear me-2"></i>
                        Settings
                        </a>
                        <div id="setting" class="collapse" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link  collapsed " href="{{ route('admin.settings.blocklist') }}">
                                   Blocks IP
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  collapsed " href="{{ route('admin.settings.payment-method') }}">
                                   Payment Method
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  collapsed " href="{{ route('admin.settings.onboarding') }}">
                                   OnBoarding
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  collapsed " href="{{ route('admin.settings.tickets') }}">
                                   Ticket
                                </a>
                            </li>
                            </ul>
                        </div>
                    </li> --}}
                    @endif


                    <!-- Nav item -->
                    {{-- <li class="nav-item">
                        <a class="nav-link " href="{{ route('dashboard') }}">
                            <i class="nav-icon fe fe-help-circle me-2"></i>
                            Help Center
                        </a>
                    </li> --}}
                    <!-- Nav item -->

                    <!-- Nav item -->
                    <!-- <li class="nav-item">
                        <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#navMenuLevel" aria-expanded="false" aria-controls="navMenuLevel">
                            <i class="nav-icon fe fe-corner-left-down me-2"></i> Menu Level
                        </a>
                        <div id="navMenuLevel" class="collapse " data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a
                                        class="nav-link "
                                        href="#"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#navMenuLevelSecond"
                                        aria-expanded="false"
                                        aria-controls="navMenuLevelSecond">
                                        Two Level
                                    </a>
                                    <div id="navMenuLevelSecond" class="collapse" data-bs-parent="#navMenuLevel">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link " href="#">NavItem 1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " href="#">NavItem 2</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link  collapsed "
                                        href="#"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#navMenuLevelThree"
                                        aria-expanded="false"
                                        aria-controls="navMenuLevelThree">
                                        Three Level
                                    </a>
                                    <div id="navMenuLevelThree" class="collapse " data-bs-parent="#navMenuLevel">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a
                                                    class="nav-link  collapsed "
                                                    href="#"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#navMenuLevelThreeOne"
                                                    aria-expanded="false"
                                                    aria-controls="navMenuLevelThreeOne">
                                                    NavItem 1
                                                </a>
                                                <div id="navMenuLevelThreeOne" class="collapse collapse " data-bs-parent="#navMenuLevelThree">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item">
                                                            <a class="nav-link " href="#">NavChild Item 1</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " href="#">Nav Item 2</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li> -->
                    <!-- Nav item -->
                    <li class="nav-item">
                        <div class="nav-divider"></div>
                    </li>

                </ul>
                @endif
            </div>
        </nav>

        <script>
            // document.addEventListener('DOMContentLoaded', function() {
            //     var collapseElements = document.querySelectorAll('[data-bs-toggle="collapse"]');
            //     var currentCollapse = localStorage.getItem('currentCollapse');
        
            //     collapseElements.forEach(function(element) {
            //         element.addEventListener('click', function() {
            //             var target = this.getAttribute('data-bs-target');
            //             var isCollapsed = document.querySelector(target).classList.contains('show');
        
            //             if (!isCollapsed) {
            //                 collapseElements.forEach(function(el) {
            //                     if (el.getAttribute('data-bs-target') !== target) {
            //                         var otherTarget = el.getAttribute('data-bs-target');
            //                         if (document.querySelector(otherTarget).classList.contains('show')) {
            //                             var bsCollapse = new bootstrap.Collapse(document.querySelector(otherTarget), {
            //                                 toggle: false
            //                             });
            //                             bsCollapse.hide();
            //                         }
            //                     }
            //                 });
            //                 localStorage.setItem('currentCollapse', target);
            //             } else {
            //                 localStorage.removeItem('currentCollapse');
            //             }
            //         });
            //     });
        
            //     if (currentCollapse) {
            //         var bsCollapse = new bootstrap.Collapse(document.querySelector(currentCollapse), {
            //             toggle: false
            //         });
            //         bsCollapse.show();
            //     }
            // });

        //     $(document).ready(function() {
        //         var url = window.location;
        //         $('ul.nav a[href="'+ url +'"]').addClass('active');
        //         $('ul.nav a').filter(function() {
        //             return this.href == url;
        //         }).addClass('active');
        //    });
        </script> 