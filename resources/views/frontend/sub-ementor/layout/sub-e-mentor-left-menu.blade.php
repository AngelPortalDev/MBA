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
                    <li class="nav-item e-men-1">
                        <a class="nav-link" href="{{route('sub-e-mentor-dashboard')}}">
                            <i class="fe fe-home nav-icon"></i>
                            Dashboard
                        </a>
                    </li>

                    <!-- Nav item -->
                    <li class="nav-item e-men-3">
                        <a class="nav-link" href="{{route('sub-e-mentor-students')}}">
                            <i class="bi bi-people-fill nav-icon"></i>
                            Students
                        </a>
                    </li>

                     <!-- Nav item -->
                     <li class="nav-item e-men-8">
                        <a class="nav-link" href="{{route('e-mentor-students-exam')}}">
                            <i class="bi bi-journal-check nav-icon"></i>
                            Examination
                        </a>
                    </li>  
                    
                    <!-- Nav item -->
                    <li class="nav-item e-men-4">
                        <a class="nav-link" href="{{route('e-mentor-profile')}}">
                            <i class="bi bi-person-circle nav-icon"></i>
                            My Profile
                        </a>
                    </li>

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