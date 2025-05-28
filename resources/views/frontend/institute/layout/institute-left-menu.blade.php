{{-- <div class="col-lg-3 col-md-4 col-12"> --}}
    <!-- User profile -->
    <nav class="navbar navbar-expand-md shadow-sm mb-4 mb-lg-0 sidenav">
        <!-- Menu -->
        <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Menu</a>
        <!-- Button -->
        <button
            class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#sidenav"
            aria-controls="sidenav"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="fe fe-menu"></span>
        </button>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav">
            <div class="navbar-nav flex-column">
                <span class="navbar-header">Dashboard</span>
                <ul class="list-unstyled ms-n2 mb-4">
                    <!-- Nav item -->
                    @php
                        $is_approved = DB::table('institute_profile_master')->where('institute_id', Auth::user()->id)->first()->is_approved;
                    @endphp
                    @if($is_approved == 1)
                        <li class="nav-item e-men-1">
                            <a class="nav-link" href="{{route('institute-dashboard')}}">
                                <i class="fe fe-home nav-icon"></i>
                                Dashboard
                            </a>
                        </li>

                        <!-- Nav item -->
                        {{-- <li class="nav-item e-men-2">
                            <a class="nav-link" href="{{route('institute-courses')}}">
                                <i class="fe fe-book nav-icon"></i>
                                Courses
                            </a>
                        </li> --}}

                        <!-- Nav item -->
                        <li class="nav-item e-men-3">
                            <a class="nav-link" href="{{route('institute-students')}}">
                                <i class="bi bi-people-fill nav-icon"></i>
                                Students
                            </a>
                        </li> 
                    @endif
                    
                    <!-- Nav item -->
                    <li class="nav-item e-men-4">
                        <a class="nav-link" href="{{route('institute-profiles')}}">
                            <i class="bi bi-person-circle nav-icon"></i>
                            Profile
                        </a>
                    </li>

                    {{-- <li class="nav-item e-men-7">
                        <a class="nav-link" href="{{route('e-mentor-about-me')}}">
                            <i class="bi bi-person-exclamation nav-icon"></i>
                            About You
                        </a>
                    </li> --}}
                    <!-- Nav item -->
                    {{-- <li class="nav-item e-men-5">
                        <a class="nav-link" href="{{route('e-mentor-security')}}">
                            <i class="bi bi-shield-lock nav-icon"></i>
                            Security
                        </a>
                    </li> --}}
                    <!-- Nav item -->
                    {{-- <li class="nav-item e-men-6">
                        <a class="nav-link" href="{{route('e-mentor-social-profile')}}">
                            <i class="bi bi-person-lines-fill nav-icon"></i>
                            Social Profiles
                        </a>
                    </li> --}}

                    <!-- Nav item -->
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="nav-link" href="{{route('logout')}}"  onclick="event.preventDefault();this.closest('form').submit();"><i class="fe fe-power nav-icon"></i>
                                 Sign Out
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
{{-- </div> --}}