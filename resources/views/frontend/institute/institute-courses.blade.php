@extends('frontend.master')
@section('content')

<style>
    .sidenav.navbar .navbar-nav .e-men-2 > .nav-link {
    background-color: var(--gk-gray-200);
}
</style>

<main>
    <section class="pt-5 pb-5">
        <div class="container">
            
            <!-- Top Menubar -->
            @include('frontend.institute.layout.institute-common')

            <!-- Content -->

            {{-- <div class="row mt-0 mt-md-4"> --}}

                {{-- Left menubar  --}}
{{--                 
                @include('frontend.teacher.layout.e-mentor-left-menu') --}}

                <div class="col-lg-9 col-md-8 col-12">
                    <!-- Card -->
                    <div class="card mb-4">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">My Courses</h3>
                            {{-- <span>Manage your courses and its update like live, draft and insight.</span> --}}
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- Form -->
                            <form class="row gx-3">
                                <div class="col-lg-9 col-md-7 col-12 mb-lg-0 mb-2">
                                    <input type="search" class="form-control" placeholder="Search Your Courses">
                                </div>
                                <div class="col-lg-3 col-md-5 col-12">
                                    <select class="form-select">
                                        <option value="">Date Created</option>
                                        <option value="Newest">Newest</option>
                                        <option value="High Earned">High Earned</option>
                                        <option value="High Earned">Award</option>
                                        {{-- <option value="High Earned">Certificate</option>
                                        <option value="High Earned">Diploma</option>
                                        <option value="High Earned">Masters</option> --}}
                                    </select>
                                </div>
                            </form>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive overflow-y-hidden">
                            <table class="table mb-0 text-nowrap table-hover table-centered text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th>Courses</th>
                                        <th>Enrollments</th>
                                        <th>Exam </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/images/course/masters-human-resource-management.png')}}" alt="course" class="rounded img-4by3-lg">
                                                    </a>
                                                </div>
                                                <div class="ms-3">
                                                    <h4 class="mb-1 h5">
                                                        <a href="#" class="text-inherit color-blue">Award in Training and Development</a>
                                                    </h4>
                                                    <ul class="list-inline fs-6 mb-0">
                                                        <li class="list-inline-item">
                                                            <span class="align-text-bottom">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                                                </svg>
                                                            </span>
                                                            <span>100h 30m</span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="badge bg-info-soft co-category">Award</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>11,200</td>

                                        <td>
                                            455
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                     <a href="#"> <img src="{{ asset('frontend/images/course/award-recruitment-and-employee-selection.png')}}" alt="course" class="rounded img-4by3-lg"></a>
                                                </div>
                                                <div class="ms-3">
                                                    <h4 class="mb-1 h5">
                                                         <a href="#" class="text-inherit color-blue">Award in Recruitment and Employee Selection</a>
                                                    </h4>
                                                    <ul class="list-inline fs-6 mb-0">
                                                        <li class="list-inline-item">
                                                            <span class="align-text-bottom">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                                                </svg>
                                                            </span>
                                                            <span>2h 59m</span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="badge bg-info-soft co-category">Award</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>650</td>

                                        <td>
                                            65
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <a href="#"> <img src="{{ asset('frontend/images/course/course-gatsby.jpg')}}" alt="course" class="rounded img-4by3-lg"></a>
                                                </div>
                                                <div class="ms-3">
                                                    <h4 class="mb-1 h5">
                                                        <a href="#" class="text-inherit color-blue">Award in Employee and Labour Relations</a>
                                                    </h4>
                                                    <ul class="list-inline fs-6 mb-0">
                                                        <li class="list-inline-item">
                                                            <span class="align-text-bottom">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                                                </svg>
                                                            </span>
                                                            <span>4h 10m</span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="badge bg-info-soft co-category">Award</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>4340</td>

                                        <td>
                                            434
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    </section>
</main>

@endsection