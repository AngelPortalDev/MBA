<style>
.custom-offcanvas-search {
    height: 100vh;
    padding: 1.5rem 1rem;
    background-color: #fff;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

/* Stylish search bar */
.search-bar-wrapper {
    width: 100%;
    gap: 10px;
}

.search-input {
    flex: 1;
    padding: 9px 13px;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: border 0.3s ease;
    box-shadow: none;
    font-size:14px;
}

.search-input:focus {
    border-color: #4A90E2;
    outline: none;
    box-shadow: none;
}

/* Close button spacing */
.btn-close {
    background-color: transparent;
}

/* Search results styling */
.search-results-container {
    max-height: 60vh;
    overflow-y: auto;
    /* padding-top: 1rem; */
    border: 0 !important;
    /* border-top: 1px solid #eee; */

}
.search-results-containerextraLarge {
    max-width: 300px !important;
    position: absolute;
    max-height: 300px !important;
}

.search-results-container .result-item {
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
    font-size: 0.95rem;
    color: #333;
    cursor: pointer;
    transition: background 0.2s ease;
}

.search-results-container .result-item:hover {
    background-color: #f9f9f9;
}
</style>

<nav class="navbar navbar-expand-lg">
    <div class="container px-0">
        @if(Auth::check() && Auth::user()->role === 'user')
            <a class="navbar-brand logo-main" href="/"><img src="{{ asset('frontend/images/brand/logo/logo.png') }}"
                alt="E-Ascencia" /></a>
        @elseif(Auth::check() && Auth::user()->role === 'instructor')
            <a class="navbar-brand logo-main"  href="/"><img src="{{ asset('frontend/images/brand/logo/logo.png') }}"
            alt="E-Ascencia" /></a>
        @else
            <a class="navbar-brand logo-main" href="/"><img src="{{ asset('frontend/images/brand/logo/logo.png') }}"
            alt="E-Ascencia" /></a>   
        @endif  
        <!-- Mobile view nav wrap -->
        <div class="ms-auto d-flex align-items-center order-xl-3 shopping-cart-icon">
            <div class="mobile-search-wrapper d-block d-xxl-none">
                <i class="bi bi-search fs-3 me-3" data-bs-toggle="offcanvas" data-bs-target="#mobileSearchCanvas" aria-controls="mobileSearchCanvas"></i>
            </div>


            <!-- Top Offcanvas Search -->
                <div class="offcanvas offcanvas-top custom-offcanvas-search h-auto headersearchOffcampus " tabindex="-1" id="mobileSearchCanvas" aria-labelledby="mobileSearchCanvasLabel">
                    <div class="offcanvas-body">
                        <div class="search-bar-wrapper d-flex align-items-center">
                            <input type="search" class="form-control search-input" id="search-input-mobile" placeholder="Search for courses..." autofocus>
                        <button type="button" class="btn-close fs-2 btn-remove-searchdata" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div id="search-results-mobile" class="search-results-container mt-4 d-block d-xxl-none">
                            <!-- Search results will appear here -->
                        </div>
                    </div>
                </div>
            <div class="d-flex align-items-center">
                @if(Auth::check())
                    @if(Auth::user()->role === 'user')
                    <a href="{{ route('shopping-cart') }}"
                    class="btn btn-icon btn-light rounded-circle mx-2 position-relative bg-blue-light">
                    <i class="fe fe-shopping-cart align-middle fs-4"></i>
                    <span class="position-absolute translate-middle badge rounded-circle bg-primary cart-item-number">
                         @php $CartCount = getData('cart',['id'],['student_id'=>auth()->user()->id,'status'=>'Active','is_by'=>'1']); @endphp {{count($CartCount)}}
                    </span>
                    </a>
                    @endif
                @endif

                @if(Auth::check())
                    @if(Auth::user()->role === 'instructor' || Auth::user()->role === 'sub-instructor')
                        <div class="me-2 ms-2">
                            <li class="dropdown d-inline-block position-static">
                                <a
                                    class="btn btn-light btn-icon rounded-circle indicator indicator-primary"
                                    href="#"
                                    role="button"
                                    id="dropdownNotificationSecond"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fe fe-bell"></i>
                                    <span class="position-absolute translate-middle badge rounded-circle bg-primary notification-item-number">
                                        @php 
                                            $notificationsCount = auth()->user()->unreadNotifications()->count(); 
                                        @endphp
                                        {{ $notificationsCount }}
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg position-absolute mx-sm-1 mx-3 my-5 dropdown-notification-menu" aria-labelledby="dropdownNotificationSecond">
                                    <div id="notificationBody">
                                        <div class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center">
                                            <span class="h5 mb-0">Notifications</span>
                                        </div>
                                        <ul class="list-group list-group-flush" style="height: 200px" data-simplebar>
                                            @php 
                                                $notifications = auth()->user()->unreadNotifications()->orderBy('created_at', 'desc')->get();
                                            @endphp
                                            @if($notifications->isEmpty())
                                                <li class="list-group-item">No new notifications.</li>
                                            @else
                                                @foreach ($notifications as $notification)
                                                    @php
                                                        $examId = $notification->data['exam_id'];
                                                        $courseId = isset($notification->data['course_id']) ? $notification->data['course_id'] : 0;
                                                        $examType = isset($notification->data['exam_type']) ? base64_encode($notification->data['exam_type']) : 0;
                                                        $userId = $notification->data['student_id'];
                                                        $scmId = $notification->data['student_course_master_id'];
                                                        if(isset($notification->data['exam_name']) ?  $notification->data['exam_name'] == 'E-Portfolio' : ''){
                                                            $url = url("ementor/e-portfolio-answersheet/{$userId}/{$courseId}/{$scmId}");
                                                        }else{
                                                            $url = url("ementor/answersheet/{$examId}/{$examType}/{$userId}/{$scmId}");
                                                        }
                                                    @endphp

                                                    <li class="list-group-item bg-light" >
                                                        <div class="row">
                                                            <div class="col">
                                                                <a href="{{ $url }}" class="text-body text-decoration-none mark-as-read" data-notification-id="{{ $notification->id }}">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="{{ asset('frontend/images/avatar/avatar-1.jpg') }}" alt="Student Avatar" class="avatar-md rounded-circle" />
                                                                        <div class="ms-3">
                                                                            <strong>{{ $notification->data['student_name'] }}</strong> has submitted an <strong>{{ isset($notification->data['exam_name']) ? $notification->data['exam_name'] : getExamType($notification->data['exam_type']) }}</strong> for the course <strong>{{ $notification->data['course_name'] }}</strong>.
                                                                            <div class="fs-6 text-muted">
                                                                                <span>
                                                                                    <span class="bi bi-clock text-success me-1"></span>
                                                                                    {{ $notification->created_at->diffForHumans() }},
                                                                                </span>
                                                                                <span class="ms-1">{{ $notification->created_at->format('h:i A') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    
                                                    
                                                @endforeach
                                            @endif
                                        </ul>
                                        {{-- <div class="border-top px-3 pt-3 pb-0">
                                            <a href="#" class="text-link fw-semibold seeMore">See all Notifications</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </li>
                        </div>
                    @endif
                @endif
            
            
                @auth
                    @if (Auth::user()->role === 'user')
                        <div class="d-flex gap-2 flex-column flex-lg-row mt-2 mt-lg-0 align-items-center">
                            <div class="text-nowrap">
                                <a href="{{ route('student-my-learning') }}"
                                    class="btn btn-outline-primary d-block shadow-sm d-none d-xl-block">My Learning</a>
                            </div>
                            
                        </div>
                    @endif
                    <ul class="navbar-nav mx-auto sign-btns-main">
                        {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle sign-btns" href="#" id="navbarBrowse"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    data-bs-display="static">My Profile</a>
                                <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarBrowse">
                                    <li>
                                        <a href="{{route('dashboard')}}" class="dropdown-item">Dashboard</a>
                                    </li>
                                    <li>
                                         <form method="POST" action="{{ route('logout') }}">
                            @csrf<a href="{{route('logout')}}" onclick="event.preventDefault();
                                                this.closest('form').submit();" class="dropdown-item">Logout</a></form>
                                    </li>
                                </ul>
                            </li> --}}

                        <li class="dropdown ms-2 d-inline-block">
                            <a class="rounded-circle" href="#" data-bs-toggle="dropdown" data-bs-display="static"
                                aria-expanded="false">
                                <div class="avatar avatar-md avatar-indicators avatar-online ">
                                    @if(auth()->user()->photo)
                                    <img alt="avatar" src="{{ Storage::url(auth()->user()->photo) }}"
                                        class="rounded-circle border" />
                                    @else
                                        @if(Auth::user()->role === 'user')
                                            @php $path = "studentDocs/student-profile-photo.png";@endphp
                                        @elseif(Auth::user()->role === 'institute')
                                            {{-- @php $path = "instituteDocs/institute-profile-photo.jpeg";@endphp --}}
                                            @php $path = "frontend/images/colleges/Institute.jpg";@endphp
                                        @else
                                            @php $path = "ementorDocs/e-mentor-profile-photo.png";@endphp
                                        @endif
                                        @if(Auth::user()->role === 'institute')
                                            <img alt="avatar" src="{{ asset($path) }}" class="rounded-circle border"/>   
                                        @else      
                                            <img alt="avatar" src="{{ Storage::url($path) }}" class="rounded-circle border"/>   
                                        @endif     
                                    @endif
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end position-absolute mx-3 my-5">
                                <div class="dropdown-item">
                                    <div class="d-flex">

                                        <div class="ms-1 lh-1">
                                            <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                                            <p class="mb-0">
                                                <a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <ul class="list-unstyled">
                                    @if(Auth::check() && Auth::user()->role === 'instructor' )
                                        <li>
                                            <a class="dropdown-item" href="{{ route('e-mentor-profile') }}">
                                                <i class="fe fe-user me-2"></i>
                                                Profile
                                            </a>

                                        </li>
                                    @elseif(Auth::check() && Auth::user()->role === 'sub-instructor' )
                                        <li>
                                            <a class="dropdown-item" href="{{ route('e-mentor-profile') }}">
                                                <i class="fe fe-user me-2"></i>
                                                Profile
                                            </a>

                                        </li>
                                    @elseif(Auth::check() && Auth::user()->role === 'institute' )
                                        <li>
                                            <a class="dropdown-item" href="{{ route('institute-profiles') }}">
                                                <i class="fe fe-user me-2"></i>
                                                Profile
                                            </a>

                                        </li>
                                    @elseif(Auth::check() && (Auth::user()->role === 'admin' ||  Auth::user()->role === 'superadmin' || Auth::user()->role === 'sales'))
                                        <li>
                                            <a class="dropdown-item" href="{{ route('dashboard.admin') }}">
                                                <i class="fe fe-user me-2"></i>
                                                Profile
                                            </a>

                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                                <i class="fe fe-user me-2"></i>
                                                Profile
                                            </a>

                                        </li>
                                    @endif
                                    @if (Auth::check() && Auth::user()->role === 'user' )
                                    <li>
                                        <a class="dropdown-item" href="{{ route('student-my-learning') }}">
                                            <i class="fe fe-star me-2"></i>
                                           My Learning
                                        </a>
                                    </li>
                                    @endif
                                    {{-- <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="fe fe-settings me-2"></i>
                                            Settings
                                        </a>
                                    </li> --}}
                                </ul>
                                <div class="dropdown-divider"></div>
                                <ul class="list-unstyled">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf<a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                                class="dropdown-item"> <i class="fe fe-power me-2"></i> Logout</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                @else
                    <a href="{{ route('viewlogin') }}"
                        class="btn btn-outline-primary d-none shadow-sm me-2  d-lg-block text-nowrap">Log in</a>

                    <ul class="navbar-nav sign-btns-main">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle sign-btns d-none d-lg-block customSignupStyle "
                                href="#" id="navbarBrowse" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" data-bs-display="static">Sign up</a>
                            <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarBrowse">
                                @php $where = ['student'=>'register','status'=>'0'];@endphp
                                @php $isExists = is_exist('permission',$where);@endphp
                                @if (isset($isExists) && is_numeric($isExists) && $isExists === 0)
                                    <li>
                                        <a href="{{ route('user.signup') }}" class="dropdown-item">Student</a>
                                    </li>
                                @endif
                                @php $where = ['teacher'=>'register','status'=>'0'];@endphp
                                @php $isExists = is_exist('permission',$where);@endphp
                                @if (isset($isExists) && is_numeric($isExists) && $isExists === 0)
                                {{-- <li>
                                    <a href="{{ route('instructor.signup') }}" class="dropdown-item">Lecturer</a>
                                </li> --}}
                                @endif
                                {{-- @php $where = ['institute'=>'register','status'=>'0'];@endphp
                                @php $isExists = is_exist('permission',$where);@endphp
                                @if (isset($isExists) && is_numeric($isExists) && $isExists === 0)
                                <li>
                                    <a href="{{ route('institute.signup') }}" class="dropdown-item">Institute</a>
                                </li>
                                @endif --}}
                            </ul>
                        </li>
                    </ul>
                @endauth
            </div>
            {{-- <div class="dropdown language-change ms-2 d-none d-md-block">
                <button class="btn btn-light btn-icon rounded-circle d-flex align-items-center bg-blue-light" type="button"
                    aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
                    <i class="fe fe-globe align-middle mx-auto"></i> 
                    <span class="visually-hidden bs-theme-text">Langauge</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bs-theme-text">
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center" style="cursor: default">
                            <img src="{{ asset('frontend/images/english-flag.jpg') }}" alt="" />
                            <span class="ms-2">English</span>
                        </button>
                    </li>
                   
                </ul> --}}
                {{-- <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bs-theme-text">
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center language-option active" data-lang="en" onclick="changeLanguage('en')">
                            <img src="{{ asset('frontend/images/english-flag.jpg') }}" alt="English" />
                            <span class="ms-2">English</span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center language-option" data-lang="zh-CN" onclick="changeLanguage('zh-CN')">
                            <img src="{{ asset('frontend/images/chinese-flag.jpg') }}" alt="Chinese" />
                            <span class="ms-2">Chinese</span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center language-option" data-lang="fr" onclick="changeLanguage('fr')">
                            <img src="{{ asset('frontend/images/france-flag.jpg') }}" alt="French" />
                            <span class="ms-2">French</span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center language-option" data-lang="es" onclick="changeLanguage('es')">
                            <img src="{{ asset('frontend/images/spain.jpg') }}" alt="Spanish" />
                            <span class="ms-2">Spanish</span>
                        </button>
                    </li>
                </ul>
                <div id="google_translate_element" style="display: none;"></div> --}}
            {{-- </div> --}}
        </div>
        <div>
            <!-- Button -->
            <button class="navbar-toggler collapsed ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="icon-bar top-bar mt-0"></span>
                <span class="icon-bar middle-bar"></span>
                <span class="icon-bar bottom-bar"></span>
            </button>
        </div>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbar-default">
            <ul class="navbar-nav mt-3 mt-lg-0 mx-auto">
                @auth
                    @if (Auth::user()->role === 'user')
                        <div class="d-grid text-nowrap">
                            <a href="{{ route('student-my-learning') }}"
                                class="btn btn-outline-primary d-block d-xl-none shadow-sm">My Learning</a>
                        </div>
                         
                    @endif
                @else
                    <!-- Show login and signup buttons if user is not logged in -->
                    <li class="nav-item dropdown d-lg-none d-grid">
                        <a href="{{ route('viewlogin') }}"
                            class="btn btn-outline-primary shadow-sm mt-2 mt-md-none text-nowrap">Log in</a>
                    </li>

                    <li class="nav-item dropdown d-lg-none">
                        <a class="nav-link dropdown-toggle sign-btns text-center mt-2 mt-md-none customSignupStyle text-nowrap"
                            href="#" id="navbarBrowse" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" data-bs-display="static">Sign up</a>
                        <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarBrowse">
                            <li>
                                <a href="{{ route('user.signup') }}" class="dropdown-item">Student</a>
                            </li>
                            <li>
                                <a href="{{ route('instructor.signup') }}" class="dropdown-item">Teacher</a>
                            </li>
                            <li>
                                <a href="{{ route('institute.signup') }}" class="dropdown-item">Institute</a>
                            </li>
                        </ul>
                    </li>
                @endauth
                
                @if (Auth::guest() || (Auth::check() && !in_array(Auth::user()->role, ['instructor', 'sub-instructor'])))
                    <li class="nav-item dropdown mt-3 mt-md-0">
                        {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarBrowse" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" data-bs-display="static">E-Ascencia</a>
                        <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarBrowse">
                            <!-- <li class="dropdown-submenu dropend">
                                                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">Web Development</a>
                                                <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="pages/course-category.html">Bootstrap</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="pages/course-category.html">React</a>
                                                </li>

                                                </ul>
                                            </li>
                                            -->
                            <li>
                                <a href="{{route('about-us')}}" class="dropdown-item">About Us</a>
                            </li>
                            <li>
                                <a href="{{route('our-teachers')}}" class="dropdown-item">Our Teachers</a>
                            </li>
                        </ul> --}}
                        {{-- <li>
                            <a href="{{route('about-us')}}" class="dropdown-item">About Us</a>
                        </li>
                        <li>
                            <a href="{{route('our-teachers')}}" class="dropdown-item">Our Teachers</a>
                        </li> --}}
                    </li>
                    <li class="nav-item dropdown dropdown-fullwidth course-menubar-top">
                        {{-- <a class="nav-link dropdown-toggle show" href="#" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">Courses</a> --}}
                        <div class="dropdown-menu dropdown-menu-md" data-bs-popper="static">
                            <div class="px-4 pt-2 pb-2">
                                <div class="row">
                                    {{-- <div class="col-12">
                                        <div class="lh-1 mb-5">
                                            <h3 class="mb-1">Explore Our Courses</h3>
                                            <p>Embark on a journey of knowledge and skill development with our
                                                diverse course offerings.</p>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="row"> --}}
                                        <div class="col mt-4 mt-lg-0">
                                            <div class="border-bottom pb-2 mb-3">
                                                <h5 class="mb-0">Award</h5>
                                            </div>
                                            @php
                                            $award =
                                            getData('course_master',['course_title','id','selling_price','ects','course_final_price','course_old_price','course_thumbnail_file','status'],['category_id'=>'1'],'4',DB::raw('IFNULL(published_on, "NULL")'),'asc');
                                            $order='asc';
                                            $awardSorted = $award->sort(function ($a, $b) use ($order) {
                                                $aPublishedOn = isset($a->published_on) ? strtotime($a->published_on) : null;
                                                $bPublishedOn = isset($b->published_on) ? strtotime($b->published_on) : null;
                                                if ($aPublishedOn === null && $bPublishedOn === null) {
                                                    return 0;
                                                }
                                                if ($aPublishedOn === null) {
                                                    return 1; 
                                                }
                                                if ($bPublishedOn === null) {
                                                    return -1; 
                                                }
                                                return $order === 'asc'
                                                    ? $aPublishedOn <=> $bPublishedOn
                                                    : $bPublishedOn <=> $aPublishedOn;
                                            });
                                            $award = $awardSorted->values()->all();
                                            @endphp
                                            @foreach($award as $courses)
                                                @if($courses->status != '2')
                                                    @if($courses->status == '3')
                                                    <div>
                                                        <a href="{{route('get-course-details',['course_id'=>base64_encode($courses->id)])}}">
                                                            <div class="d-flex mb-3 align-items-center">
                                                                {{-- <img src="{{ Storage::url($courses->course_thumbnail_file) }}"
                                                                    alt="" /> --}}
                                                                <div class="">
                                                                    <h6 class="mb-0 border-bottom pb-1">{{htmlspecialchars_decode($courses->course_title)}}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @else
                                                        <div>
                                                            <a href="{{route('get-course-details',['course_id'=>base64_encode($courses->id)])}}">
                                                            <div class="d-flex mb-3 align-items-center">
                                                                {{-- <img src="{{ Storage::url($courses->course_thumbnail_file) }}"
                                                                    alt="" /> --}}
                                                                <div class="">
                                                                    <h6 class="mb-0 border-bottom pb-1">{{htmlspecialchars_decode($courses->course_title)}}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                            <div class="mt-4">
                                                <a href="{{ route('award-courses') }}"
                                                    class="btn btn-outline-primary btn-sm">More</a>
                                            </div>
                                        </div>
                                        <div class="col mt-4 mt-lg-0">
                                            <div class="border-bottom pb-2 mb-3">
                                                <h5 class="mb-0">Certificate</h5>
                                            </div>
                                            <div>
                                            @php
                                                $certificate =
                                                getData('course_master',['course_title','id','selling_price','ects','course_final_price','course_old_price','course_thumbnail_file','status'],['category_id'=>'2'],'4',DB::raw('IFNULL(published_on, "NULL")'),'asc');
                                                @endphp
                                            @if(count($certificate) > 0)
                                                @foreach($certificate as $courses)
                                                    @if($courses->status != '2')
                                                        @if($courses->status == '3')
                                                            <div>
                                                                <a href="{{route('get-master-course-details',['course_id'=>base64_encode($courses->id)])}}">
                                                                    <div class="d-flex mb-3 align-items-center">
                                                                        {{-- <img src="{{ Storage::url($courses->course_thumbnail_file) }}"
                                                                            alt="" /> --}}
                                                                        <div class="">
                                                                            <h6 class="mb-0 border-bottom pb-1">{{htmlspecialchars_decode($courses->course_title)}}
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <a href="{{route('get-master-course-details',['course_id'=>base64_encode($courses->id)])}}">
                                                            <div class="d-flex mb-3 align-items-center">
                                                                {{-- <img src="{{ Storage::url($courses->course_thumbnail_file) }}"
                                                                    alt="" /> --}}
                                                                <div class="">
                                                                    <h6 class="mb-0 border-bottom pb-1">{{htmlspecialchars_decode($courses->course_title)}}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                            </a>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @else   
                                                <h6>Coming Soon...</h6>
                                            @endif
                                                
                                                {{-- <a href="#">
                                                    <div class="d-flex mb-3 align-items-center">
                                                        <img src="{{ asset('frontend/images/course/certificate-human-resource-management.png') }}"
                                                            alt="" />
                                                        <div class="ms-2">
                                                            <h6 class="mb-0">Post Graduate Certificate in Human Resource
                                                                Management</h6>
                                                        </div>
                                                    </div>
                                                </a> --}}
                                                {{-- <a href="#">
                                                            <div class="d-flex mb-3 align-items-center">
                                                                <img src="{{ asset('frontend/images/course/award-performance-management.png')}}"
                                                                    alt="" />
                                                                <div class="ms-2">
                                                                    <h6 class="mb-0">Post Graduate Certificate in Computer
                                                                        Science</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#">
                                                            <div class="d-flex mb-3 align-items-center">
                                                                <img src="{{ asset('frontend/images/course/award-employee-and-labor-relation.png')}}"
                                                                    alt="" />
                                                                <div class="ms-2">
                                                                    <h6 class="mb-0">Post Graduate Certificate in Science and
                                                                        Artificial Intelligence</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#">
                                                            <div class="d-flex mb-3 align-items-center">
                                                                <img src="{{ asset('frontend/images/course/award-performance-management.png')}}"
                                                                    alt="" />
                                                                <div class="ms-2">
                                                                    <h6 class="mb-0">Post Graduate Certificate in
                                                                        Entrepreneurship</h6>
                                                                </div>
                                                            </div>
                                                        </a> --}}
    
                                                <div class="mt-4">
                                                    <a href="{{route('certificate-courses')}}" class="btn btn-outline-primary btn-sm">More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt-4 mt-lg-0">
                                            <div class="border-bottom pb-2 mb-3">
                                                <h5 class="mb-0">Diploma</h5>
                                            </div>
                                            <div>
                                                @php
                                                $diploma =
                                                    getData('course_master',['course_title','id','selling_price','ects','course_final_price','course_old_price','course_thumbnail_file','status'],['category_id'=>'3'],'4',DB::raw('IFNULL(published_on, "NULL")'),'asc');
                                                @endphp
                                                @if(count($diploma) > 0)
                                                    @foreach($diploma as $courses)
                                                        @if($courses->status != '2')
                                                            @if($courses->status == '3')
                                                                <div>
                                                                    <a href="{{route('get-master-course-details',['course_id'=>base64_encode($courses->id)])}}">
                                                                        <div class="d-flex mb-3 align-items-center">
                                                                            {{-- <img src="{{ Storage::url($courses->course_thumbnail_file) }}"
                                                                                alt="" /> --}}
                                                                            <div class="">
                                                                                <h6 class="mb-0 border-bottom pb-1">{{htmlspecialchars_decode($courses->course_title)}}
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <a href="{{route('get-master-course-details',['course_id'=>base64_encode($courses->id)])}}">
                                                                <div class="d-flex mb-3 align-items-center">
                                                                    {{-- <img src="{{ Storage::url($courses->course_thumbnail_file) }}"
                                                                        alt="" /> --}}
                                                                    <div class="">
                                                                        <h6 class="mb-0 border-bottom pb-1">{{htmlspecialchars_decode($courses->course_title)}}
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @else   
                                                    <h6>Coming Soon...</h6>
                                                @endif
                                                {{-- <a href="#">
                                                    <div class="d-flex mb-3 align-items-center">
                                                        <img src="{{ asset('frontend/images/course/diploma-human-resource-management.png') }}"
                                                            alt="" />
                                                        <div class="ms-2">
                                                            <h6 class="mb-0">Post Graduate Diploma in Human Resource
                                                                Management</h6>
                                                        </div>
                                                    </div>
                                                </a> --}}
                                                {{-- <a href="#">
                                                            <div class="d-flex mb-3 align-items-center">
                                                                <img src="{{ asset('frontend/images/course/award-employee-and-labor-relation.png')}}"
                                                                    alt="" />
                                                                <div class="ms-2">
                                                                    <h6 class="mb-0">Post Graduate Diploma in Business
                                                                        Administration</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#">
                                                            <div class="d-flex mb-3 align-items-center">
                                                                <img src="{{ asset('frontend/images/course/diploma-human-resource-management.png')}}"
                                                                    alt="" />
                                                                <div class="ms-2">
                                                                    <h6 class="mb-0">Post Graduate Diploma in Human Resource
                                                                        Management</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#">
                                                            <div class="d-flex mb-3 align-items-center">
                                                                <img src="{{ asset('frontend/images/course/award-employee-and-labor-relation.png')}}"
                                                                    alt="" />
                                                                <div class="ms-2">
                                                                    <h6 class="mb-0">Post Graduate Diploma in in Business
                                                                        Administration</h6>
                                                                </div>
                                                            </div>
                                                        </a> --}}
    
                                                <div class="mt-4">
                                                    <a href="{{route('diploma-courses')}}" class="btn btn-outline-primary btn-sm">More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt-4 mt-lg-0">
                                            <div class="border-bottom pb-2 mb-3">
                                                <h5 class="mb-0">Masters</h5>
                                            </div>
                                            <div>
                                                @php
                                                $masters =
                                                    getData('course_master',['course_title','id','selling_price','ects','course_final_price','course_old_price','course_thumbnail_file','status'],['category_id'=>'4'],'4',DB::raw('IFNULL(published_on, "NULL")'),'asc');
                                                @endphp
                                                @if(count($masters) > 0)
                                                    @foreach($masters as $courses)
                                                        @if($courses->status != '2')
                                                            @if($courses->status == '3')
                                                                <div>
                                                                    <a href="{{route('get-master-course-details',['course_id'=>base64_encode($courses->id)])}}">
                                                                        <div class="d-flex mb-3 align-items-center">
                                                                            {{-- <img src="{{ Storage::url($courses->course_thumbnail_file) }}"
                                                                                alt="" /> --}}
                                                                            <div class="">
                                                                                <h6 class="mb-0 border-bottom pb-1">{{htmlspecialchars_decode($courses->course_title)}}
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <a href="{{route('get-master-course-details',['course_id'=>base64_encode($courses->id)])}}">
                                                                <div class="d-flex mb-3 align-items-center">
                                                                    {{-- <img src="{{ Storage::url($courses->course_thumbnail_file) }}"
                                                                        alt="" /> --}}
                                                                    <div class="">
                                                                        <h6 class="mb-0 border-bottom pb-1">{{htmlspecialchars_decode($courses->course_title)}}
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @else   
                                                    <h6>Coming Soon...</h6>
                                                @endif
                                                {{-- <a href="#">
                                                    <div class="d-flex mb-3 align-items-center">
                                                        <img src="{{ asset('frontend/images/course/masters-human-resource-management.png') }}"
                                                            alt="" />
                                                        <div class="ms-2">
                                                            <h6 class="mb-0">Masters of Arts in Human Resource
                                                                Management</h6>
                                                        </div>
                                                    </div>
                                                </a> --}}
                                                {{-- <a href="#">
                                                            <div class="d-flex mb-3 align-items-center">
                                                                <img src="{{ asset('frontend/images/course/award-employee-and-labor-relation.png')}}"
                                                                    alt="" />
                                                                <div class="ms-2">
                                                                    <h6 class="mb-0">Master of Science (MSc) in Computer Science
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#">
                                                            <div class="d-flex mb-3 align-items-center">
                                                                <img src="{{ asset('frontend/images/course/award-employee-and-labor-relation.png')}}"
                                                                    alt="" />
                                                                <div class="ms-2">
                                                                    <h6 class="mb-0">Master of Arts (MA) in Entrepreneurship
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#">
                                                            <div class="d-flex mb-3 align-items-center">
                                                                <img src="{{ asset('frontend/images/course/masters-human-resource-management.png')}}"
                                                                    alt="" />
                                                                <div class="ms-2">
                                                                    <h6 class="mb-0">Masters of Arts in Human Resource
                                                                        Management</h6>
                                                                </div>
                                                            </div>
                                                        </a> --}}
    
                                                <div class="mt-4">
                                                    <a href="{{route('masters-courses')}}" class="btn btn-outline-primary btn-sm">More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt-4 mt-lg-0">
                                            <div class="border-bottom pb-2 mb-3">
                                                <h5 class="mb-0">DBA</h5>
                                            </div>
                                            <div>
                                                @php
                                                    $dba =
                                                        getData('course_master',['course_title','id','selling_price','ects','course_final_price','course_old_price','course_thumbnail_file','status'],['category_id'=>'5'], '4',DB::raw('IFNULL(published_on, "NULL")'),'asc');
                                                @endphp
                                                @if(count($dba) > 0)
                                                    @foreach($dba as $courses)
                                                        @if($courses->status != '2')
                                                            @if($courses->status == '3')
                                                                <div>
                                                                    <a href="{{route('dba-course-details',['course_id'=>base64_encode($courses->id)])}}">
                                                                        <div class="d-flex mb-3 align-items-center">
                                                                            <div class="">
                                                                                <h6 class="mb-0 border-bottom pb-1">{{htmlspecialchars_decode($courses->course_title)}}</h6>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <a href="{{route('dba-course-details',['course_id'=>base64_encode($courses->id)])}}">
                                                                <div class="d-flex mb-3 align-items-center">
                                                                    <div class="">
                                                                        <h6 class="mb-0 border-bottom pb-1">{{htmlspecialchars_decode($courses->course_title)}}
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @else   
                                                    <h6>Coming Soon...</h6>
                                                @endif
                                                <div class="mt-4">
                                                    <a href="{{route('dba-courses')}}" class="btn btn-outline-primary btn-sm">More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt-4 mt-lg-0">
                                            <div class="border-bottom pb-2 mb-3">
                                                <h5 class="mb-0">Language Courses</h5>
                                            </div>
                                            <div>
                                                <a href="{{route('english-course-program')}}">
                                                    <div class="d-flex mb-3 align-items-center">
                                                        <div class="">
                                                            <h6 class="mb-0 border-bottom pb-1">English Programmes</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                       
                                        
                                        
                                    {{-- </div> --}}
                                   
                                </div>
                            </div>
                        </div>
                    </li>
                    {{-- <li>
                        <a href="{{route('partner-university')}}" class="dropdown-item">Approved Partners</a>
                    </li> --}}
                  
                @endif

                <li class="nav-item dropdown">
                @if(Auth::check())
                    @if(Auth::user()->role === 'user')
                        <a href="{{ route('shopping-cart') }}" class="btn btn-icon btn-light rounded-circle d-block d-none mx-2"><i class="fe fe-shopping-cart align-middle shoppingCartMobileView"></i><span class="position-absolute translate-middle badge rounded-circle bg-primary cart-item-number">{{count($CartCount)}}</span></a>
                    @endif
                @endif
                </li>
                <li>
                    <div class="dropdown language-change mb-3 mb-xl-0 d-xl-none">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"
                                    href="#" id="navbarBrowse" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" data-bs-display="static"> Languages</a>
                                <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarBrowse">
                                    <li>
                                        <button type="button" class="dropdown-item d-flex align-items-center" style="cursor: default">
                                            <img src="{{ asset('frontend/images/english-flag.jpg') }}" alt="" />
                                            <span class="ms-2">English</span>
                                        </button>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            {{-- <form class="mt-3 mt-lg-0 ms-lg-3 d-flex align-items-center">
                <span class="position-absolute ps-3 search-icon">
                    <i class="fe fe-search"></i>
                </span> --}}
                {{-- <label for="search" class="visually-hidden"></label> --}}
                {{-- <input type="search" id="search" class="form-control ps-6 me-0 me-lg-2 "
                    placeholder="Search Courses" /> --}}
            {{-- </form> --}}


        </div>

        {{-- **********  Large device ******* --}}

        {{-- start --}}
        <div class="mobile-search-wrapper largedeviceicon">
            <i class="bi bi-search fs-3 me-3" data-bs-toggle="offcanvas" data-bs-target="#mobileSearchCanvasTwo" aria-controls="mobileSearchCanvasTwo"></i>
        </div>

        <!-- Top Offcanvas Search -->
        <div class="offcanvas offcanvas-top custom-offcanvas-search h-auto  headeroffcampusTwo" tabindex="-1" id="mobileSearchCanvasTwo" aria-labelledby="mobileSearchCanvasLabel">
            <div class="offcanvas-body">
                <div class="search-bar-wrapper d-flex align-items-center">
                    <input type="search" class="form-control search-input" id="search-input-large" placeholder="Search for courses..." autofocus>
                    <button type="button" class="btn-close  fs-2" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div id="search-results-large" class="search-results-container mt-4 d-none d-lg-block">
                    <!-- Search results will appear here -->
                </div>
            </div>
        </div>
        {{-- end --}}


        {{-- ********* extra large device ********* --}}
        {{-- <div class="me-3 headerSearch" >
            <input type="search" id="search-input-xl"class="form-control search-input mb-0 d-none d-xxl-block" placeholder="Search for courses..." >
            <div id="search-results-xl" class="search-results-container search-results-containerextraLarge"></div>
        </div> --}}
    </div>
</nav>
