@extends('frontend.master')
@section('content')
<style>
    .buy-now {
        background: none;
        border: none;
        color: rgb(27, 55, 177);
        cursor: pointer;
        font-size:13px;
    }
    .buy-now:focus {
        outline: none;
    }
    .buy-now:active {
        color:rgb(8, 25, 122);
    }

    [aria-current="page"] > span {
    background-color: #2b3990 !important; 
    color: white !important;
    font-weight: bold;
    border-color: #2b3990 !important;          
    /* border-radius: 0.375rem;          */
}

.pagination nav > div:first-child {
    display: none;
}

    .hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
        margin: 0;
        padding: 0.75rem;
        text-align: left;
        white-space: normal;
        line-height: 2.4rem;
    }

    a[rel="prev"] {
    background-color: #fff !important;
    /* border: none !important; */
    box-shadow: none !important;
}

/* span[aria-disabled="true"][aria-label*="Previous"] > span{
    border: 0 !important;
} */

/* a[rel="next"] {
    background-color: #fff !important;
    border: none !important;
    box-shadow: none !important;
} */

/* span[aria-disabled="true"][aria-label*="Next"] > span{
    border: 0 !important;
} */

.rotate-icon {
        transition: transform 0.3s ease;
    }
    /* div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        margin: 12px 24px;
        white-space: nowrap;
    }
    div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item {
        margin-left: 0.25rem;
    } */

    /* .hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
        display: none;
    } */
</style>
<main>
    <!-- Page header -->
    <section class="py-8 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10 col-12">
                    <!-- text -->
                    <div>
                        <div class="mb-4 text-center">
                            <h1 class="fw-bold mb-4">
                                What do you want to
                                <span class="text-primary">learn?</span>
                            </h1>
                        </div>
                        <div class="bg-white rounded-md-pill me-lg-8 shadow rounded-3">
                            <!-- card body -->
                            <div class="p-md-2 p-4">
                                <!-- form -->
                                <div class="row g-1">
                                    <div class="col-12 col-md-9">
                                        <!-- input -->
                                        <div class="input-group mb-2 mb-md-0 border-md-0 border rounded-pill">
                                            <!-- input group -->
                                            <span class="input-group-text bg-transparent border-0 pe-0 ps-md-3 ps-md-0"
                                                id="searchCourse">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                                                </svg>
                                            </span>
                                            <!-- search -->
                                            <label for="CourseTitle" class="visually-hidden"></label>
                                            <input type="search"
                                                class="form-control rounded-pill border-0 ps-3 form-focus-none course_name_search"
                                                placeholder="Search Course" aria-label="Course Title"
                                                aria-describedby="searchCourse" id="CourseTitle">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-3 text-end d-grid">
                                        <!-- button -->
                                        <button type="submit" class="btn btn-primary rounded-pill SearchButton">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-4 py-md-8 bg-white browse-course-page">
        <div class="container">

            {{-- Filter Added For Mobile--}}
            <a class="btn btn-primary browserCourseFilterMobileView d-block d-md-none " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" style="width: fit-content">
                Show Filter <i class="bi bi-arrow-right-circle-fill ms-1" style="font-size: large"></i>
            </a>
            {{-- End Filter For Mobile --}}
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header bg-white" style="border-bottom: 1px solid #e2e8f0;">
                  <h5 class="offcanvas-title fs-4" id="offcanvasExampleLabel">Advance Options</h5>
                  <i class="bi bi-x-lg fs-3" data-bs-dismiss="offcanvas" aria-label="Close" style="color: #000"></i>
                {{-- <button type="button" class="btn-close text-reset"  style="font-size: 1rem"></button> --}}
                </div>
                <div class="offcanvas-body bg-white">
                    <div class="">
                        <div class="card border mb-6 mb-md-0 shadow-none">
                            <div class="card-header">
                                <h4 class="mb-0 fs-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-filter me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z">
                                    </svg>
                                    All Filters
                                </h4>
                            </div>
                            <form id="filterForm">
                            <div class="card-body py-3">
                                <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse" href="#collapseExample"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Category
                                    <span class="float-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                            class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                        </svg>
                                    </span>
                                </a>
                                <div class="collapse show" id="collapseExample">
                                    <div class="mt-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="5"
                                                id="flexCheckLocationFive">
                                            <label class="form-check-label" for="flexCheckLocationFive">
                                                DBA
                                                {{-- <span>(12)</span> --}}
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="4"
                                                id="flexCheckLocationFour">
                                            <label class="form-check-label" for="flexCheckLocationFour">
                                                Masters
                                                {{-- <span>(12)</span> --}}
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="3"
                                                id="flexCheckLocationThree">
                                            <label class="form-check-label" for="flexCheckLocationThree">
                                                Diploma
                                                {{-- <span>(18)</span> --}}
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="2"
                                                id="flexCheckLocationTwo" />
                                            <label class="form-check-label" for="flexCheckLocationTwo">
                                                Certificate
                                                {{-- <span>(21)</span> --}}
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="flexCheckLocationOne">
                                            <label class="form-check-label" for="flexCheckLocationOne">
                                                Award
                                                {{-- <span>(40)</span> --}}
                                            </label>
                                        </div>
                                        <!-- <a href="#" class="fw-semibold">12+ More</a> -->
                                    </div>
                                </div>
                            </div>
    
    
                            <div class="card-body border-top py-3">
                                <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse"
                                    href="#collapseExampleSecond" role="button" aria-expanded="true"
                                    aria-controls="collapseExampleSecond">
                                    Subject
                                    <span class="float-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                            class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                        </svg>
                                    </span>
                                </a>
                                <div class="collapse show" id="collapseExampleSecond">
                                    <div class="mt-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="business"
                                                id="flexCheckSalaryOneBusiness">
                                            <label class="form-check-label" for="flexCheckSalaryOneBusiness">Business</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="computer" id="flexCheckSalaryTwoComputer"
                                                 />
                                            <label class="form-check-label" for="flexCheckSalaryTwoComputer">Computer Science</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="human"
                                                id="flexCheckSalaryThreeHRM">
                                            <label class="form-check-label" for="flexCheckSalaryThreeHRM">HRM</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="management"
                                                id="flexCheckSalaryFourManagment">
                                            <label class="form-check-label" for="flexCheckSalaryFourManagment">Management</label>
                                        </div>
                                        {{-- <a href="#" class="fw-semibold">12+ More</a> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="card-body border-top py-3">
                                <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse"
                                    href="#collapseExampleFourth" role="button" aria-expanded="true"
                                    aria-controls="collapseExampleFourth">
                                    Status
                                    <span class="float-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                            class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                        </svg>
                                    </span>
                                </a>
                                <div class="collapse show" id="collapseExampleFourth">
                                    <div class="mt-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="course_status" value="3" id="launchedCourse" checked>
                                            <label class="form-check-label" for="launchedCourse">Launched Course</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="course_status" value="1" id="upcomingCourse">
                                            <label class="form-check-label" for="upcomingCourse">Upcoming Course</label>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                            
    
                            {{-- <div class="card-body border-top py-3">
                                <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse"
                                    href="#collapseExampleThird" role="button" aria-expanded="false"
                                    aria-controls="collapseExampleThird">
                                    Video Duration
                                    <span class="float-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                            class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                        </svg>
                                    </span>
                                </a>
                                <div class="collapse show" id="collapseExampleThird">
                                    <div class="mt-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckSalaryOne">
                                            <label class="form-check-label" for="flexCheckSalaryOne">0-10 Hour (22)</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckSalaryTwo"
                                                 />
                                            <label class="form-check-label" for="flexCheckSalaryTwo ">10-100 Hour (4,919)</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckSalaryThree">
                                            <label class="form-check-label" for="flexCheckSalaryThree ">100-150 Hour (35)</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckSalaryFour">
                                            <label class="form-check-label" for="flexCheckSalaryFour ">150+ Hour (40)</label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="card-body border-top py-3">
                                <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse"
                                    href="" role="button" aria-expanded="true"
                                    aria-controls="collapseExampleFourth">
                                    Status
                                    <span class="float-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                            class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                        </svg>
                                    </span>
                                </a>
                                <div class="collapse show collapseExampleFourth" id="">
                                    <div class="mt-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input launchedCourse" type="radio" name="course_status" value="3" checked>
                                            <label class="form-check-label" for="launchedCourse">Launched Course</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input upcomingCourse" type="radio" name="course_status" value="1">
                                            <label class="form-check-label" for="upcomingCourse">Upcoming Course</label>
                                        </div>
    
                                    </div>
                                </div>
                            </div> --}}
                        
                            
                            <div class="card-body border-top py-3">
                                <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse"
                                    href="#collapseExampleThird" role="button" aria-expanded="true"
                                    aria-controls="collapseExampleThird">
                                    ECTS Credits 
                                    <span class="float-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                            class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                        </svg>
                                    </span>
                                </a>
                                <div class="collapse" id="collapseExampleThird">
                                    <div class="mt-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="ects_30"
                                                id="flexCheckSalaryOne">
                                            <label class="form-check-label" for="flexCheckSalaryOne">1-30</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="ects_60" id="flexCheckSalaryTwo"
                                                 />
                                            <label class="form-check-label" for="flexCheckSalaryTwo">30-60</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="ects_90"
                                                id="flexCheckSalaryThree">
                                            <label class="form-check-label" for="flexCheckSalaryThree">60-90</label>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            
                           
                            <div class="card-body border-top py-3 price_hide">
                                <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse"
                                    href="#collapseExampleFifth" role="button" aria-expanded="true"
                                    aria-controls="collapseExampleFifth">
                                    Price
                                    <span class="float-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                            class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                        </svg>
                                    </span>
                                </a>
                                <div class="collapse" id="collapseExampleFifth">
                                    <div class="mt-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="price_500" id="flexCheckPriceOne">
                                            <label class="form-check-label" for="flexCheckPriceOne">500-1000</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="price_5000" id="flexCheckPriceTwo" />
                                            <label class="form-check-label" for="flexCheckPriceTwo">1000-5000</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="price_above" id="flexCheckPriceThree">
                                            <label class="form-check-label" for="flexCheckPriceThree">5000 + </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card-body border-top py-3">
                                <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse"
                                    href="#collapseExampleSeventh" role="button" aria-expanded="false"
                                    aria-controls="collapseExampleSeventh">
                                    Price
                                    <span class="float-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                            class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                        </svg>
                                    </span>
                                </a>
                                <div class="collapse " id="collapseExampleSeventh">
                                    <div class="mt-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckSalaryOne">
                                            <label class="form-check-label" for="flexCheckSalaryOne">Paid (919)</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckSalaryTwo"
                                                 />
                                            <label class="form-check-label" for="flexCheckSalaryTwo ">Free (4,919)</label>
                                        </div>
    
                                    </div>
                                </div>
                            </div> --}}
    
    
                            <div class="card-body pb-3 pt-0 d-grid">
                                <a href="" class="btn btn-outline-secondary clearButton">Clear Data</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <!-- Filters Left Menus -->
                <div class="col-md-4 col-xl-3 d-md-block d-none">
                    <div class="card border mb-6 mb-md-0 shadow-none">
                        <div class="card-header">
                            <h4 class="mb-0 fs-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-filter me-2" viewBox="0 0 16 16">
                                    <path
                                        d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z">
                                </svg>
                                All Filters
                            </h4>
                        </div>
                        <form id="filterForm">
                        <div class="card-body py-3">
                            <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse" href="#collapseExample"
                                role="button" aria-expanded="false" aria-controls="collapseExample">
                                Category
                                <span class="float-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                    </svg>
                                </span>
                            </a>
                            <div class="collapse show" id="collapseExample">
                                <div class="mt-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="5"
                                            id="flexCheckLocationFive">
                                        <label class="form-check-label" for="flexCheckLocationFive">
                                            DBA
                                            {{-- <span>(12)</span> --}}
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="4"
                                            id="flexCheckLocationFour ">
                                        <label class="form-check-label" for="flexCheckLocationFour">
                                            Masters
                                            {{-- <span>(12)</span> --}}
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="3"
                                            id="flexCheckLocationThree ">
                                        <label class="form-check-label" for="flexCheckLocationThree">
                                            Diploma
                                            {{-- <span>(18)</span> --}}
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="2"
                                            id="flexCheckLocationTwo "  />
                                        <label class="form-check-label" for="flexCheckLocationTwo">
                                            Certificate
                                            {{-- <span>(21)</span> --}}
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            id="flexCheckLocationOne">
                                        <label class="form-check-label" for="flexCheckLocationOne">
                                            Award
                                            {{-- <span>(40)</span> --}}
                                        </label>
                                    </div>
                                    <!-- <a href="#" class="fw-semibold">12+ More</a> -->
                                </div>
                            </div>
                        </div>


                        <div class="card-body border-top py-3">
                            <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse"
                                href="#collapseExampleSecond" role="button" aria-expanded="true"
                                aria-controls="collapseExampleSecond">
                                Subject
                                <span class="float-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                    </svg>
                                </span>
                            </a>
                            <div class="collapse show" id="collapseExampleSecond">
                                <div class="mt-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="business"
                                            id="flexCheckSalaryBusiness">
                                        <label class="form-check-label" for="flexCheckSalaryBusiness">Business</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="computer" id="flexCheckSalaryComputer"
                                             />
                                        <label class="form-check-label" for="flexCheckSalaryComputer">Computer Science</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="human"
                                            id="flexCheckSalaryHRM">
                                        <label class="form-check-label" for="flexCheckSalaryHRM">HRM</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="management"
                                            id="flexCheckSalaryManagment">
                                        <label class="form-check-label" for="flexCheckSalaryManagment">Management</label>
                                    </div>
                                    {{-- <a href="#" class="fw-semibold">12+ More</a> --}}
                                </div>
                            </div>
                        </div>
                        

                        {{-- <div class="card-body border-top py-3">
                            <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse"
                                href="#collapseExampleThird" role="button" aria-expanded="false"
                                aria-controls="collapseExampleThird">
                                Video Duration
                                <span class="float-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                    </svg>
                                </span>
                            </a>
                            <div class="collapse show" id="collapseExampleThird">
                                <div class="mt-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckSalaryOne">
                                        <label class="form-check-label" for="flexCheckSalaryOne">0-10 Hour (22)</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckSalaryTwo"
                                             />
                                        <label class="form-check-label" for="flexCheckSalaryTwo ">10-100 Hour (4,919)</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckSalaryThree">
                                        <label class="form-check-label" for="flexCheckSalaryThree ">100-150 Hour (35)</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckSalaryFour">
                                        <label class="form-check-label" for="flexCheckSalaryFour ">150+ Hour (40)</label>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="card-body border-top py-3">
                            <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse"
                                href="#collapseExampleFourth" role="button" aria-expanded="true"
                                aria-controls="collapseExampleFourth">
                                Status
                                <span class="float-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                    </svg>
                                </span>
                            </a>
                            <div class="collapse show" id="collapseExampleFourth">
                                <div class="mt-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="course_status" value="3" id="launchedCourse" checked>
                                        <label class="form-check-label" for="launchedCourse">Launched Course</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="course_status" value="1" id="upcomingCourse">
                                        <label class="form-check-label" for="upcomingCourse">Upcoming Course</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body border-top py-3">
                            <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse"
                                href="#collapseExampleThird" role="button" aria-expanded="true"
                                aria-controls="collapseExampleThird">
                                ECTS Credits
                                <span class="float-end">
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                    </svg> --}}
                                    <i class="bi bi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="collapse" id="collapseExampleThird">
                                <div class="mt-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="ects_30"
                                            id="flexCheckSalaryOne">
                                        <label class="form-check-label" for="flexCheckSalaryOne">1-30</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="ects_60" id="flexCheckSalaryTwo"
                                             />
                                        <label class="form-check-label" for="flexCheckSalaryTwo">30-60</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="ects_90"
                                            id="flexCheckSalaryThree">
                                        <label class="form-check-label" for="flexCheckSalaryThree">60-90</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="card-body border-top py-3 price_hide">
                            <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse"
                                href="#collapseExampleFifth" role="button" aria-expanded="true"
                                aria-controls="collapseExampleFifth">
                                Price
                                <span class="float-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                    </svg>
                                </span>
                            </a>
                            <div class="collapse" id="collapseExampleFifth">
                                <div class="mt-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="price_500" id="flexCheckPriceOne">
                                        <label class="form-check-label" for="flexCheckPriceOne">500-1000</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="price_5000" id="flexCheckPriceTwo" />
                                        <label class="form-check-label" for="flexCheckPriceTwo">1000-5000</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="price_above" id="flexCheckPriceThree">
                                        <label class="form-check-label" for="flexCheckPriceThree">5000 + </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-body border-top py-3">
                            <a class="fs-5 text-dark fw-semibold" data-bs-toggle="collapse"
                                href="#collapseExampleSeventh" role="button" aria-expanded="false"
                                aria-controls="collapseExampleSeventh">
                                Price
                                <span class="float-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z">
                                    </svg>
                                </span>
                            </a>
                            <div class="collapse " id="collapseExampleSeventh">
                                <div class="mt-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckSalaryOne">
                                        <label class="form-check-label" for="flexCheckSalaryOne">Paid (919)</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckSalaryTwo"
                                             />
                                        <label class="form-check-label" for="flexCheckSalaryTwo ">Free (4,919)</label>
                                    </div>

                                </div>
                            </div>
                        </div> --}}


                        <div class="card-body pb-3 pt-0 d-grid">
                            <a href="" class="btn btn-outline-secondary clearButton">Clear Data</a>
                        </div>
                        </form>
                    </div>
                </div>

                <!-- Course Grid right menus -->
                <div class="col-xl-9 col-md-8 mb-6 mb-md-0 ">
                    <div class="row align-items-center mb-4">
                        <div class="col">
                            <h3 class="mb-0 browseAllResult mt-2 mt-md-0"><strong>{{$totalCourseCount}} </strong> results found</h3>
                        </div>
                        <div class="col-auto">
                            <div class="d-flex">

                                {{-- <div class="ms-3">
                                    <label for="sorting" class="visually-hidden">Sorting</label>
                                    <select class="form-select" id="sorting">
                                        <option value="Sorting">Sorting</option>
                                        <option value="Newest">Newest</option>
                                        <option value="Oldest">Oldest</option>
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row" id="courseList">
                        {{-- @php print_r($browseCourseData); @endphp --}}
                        @foreach($browseCourseData as $course)
                        @if (isset($course->category_id) && !empty($course->category_id) && $course->category_id === 1)
                            @php $LINK = route('get-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                        @elseif (isset($course->category_id) && !empty($course->category_id) && $course->category_id === 5)
                            @php $LINK = route('dba-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                        @else
                            @php $LINK = route('get-master-course-details',['course_id'=>base64_encode($course->id)]) ;@endphp
                        @endif
                        <div class="col-12 mb-1">
                            <div class="card mb-4 card-hover browse-page-card">
                                <div class="row g-0">
                                    <a class="col-12 col-md-12  col-lg-4 bg-cover img-left-rounded" href="{{$LINK}}">
                                        <img src="{{Storage::url($course->course_thumbnail_file)}}" alt="..."
                                            class="img-fluid course-thumbnail">
                                    </a>
                                    <div class="col-lg-8 col-md-12 col-12">
                                        <!-- Card body -->
                                        <div class="card-body browseAllCourse">
                                            <h3  class="mb-2 course-title color-blue"><a href="{{$LINK}}" class="text-inherit color-blue fs-4">{{isset($course->course_title) ? htmlspecialchars_decode($course->course_title) : ''}}</a></h3>
                                            <!-- List inline -->
                                            <ul class="mb-3 list-inline">
                                                
                                                <li class="list-inline-item">
                                                    @if (isset($course->category_id) && !empty($course->category_id) &&
                                                        $course->category_id === 1)
                                                        <span class="badge bg-info-soft co-category">Award</span>
                                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                                        $course->category_id === 2)
                                                        <span class="badge bg-info-soft co-category">Certificate</span>
                                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                                        $course->category_id === 3)
                                                        <span class="badge bg-info-soft co-category">Diploma</span>
                                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                                        $course->category_id === 4)
                                                        <span class="badge bg-info-soft co-category">Masters</span>
                                                    @elseif(isset($course->category_id) && !empty($course->category_id) &&
                                                        $course->category_id === 5)
                                                        <span class="badge bg-info-soft co-category">DBA</span>
                                                    @endif   
                                                    @if(isset($course->ects) && !empty($course->ects))
                                                        <span class="badge bg-success-soft co-etcs">{{isset($course->ects) ? htmlspecialchars_decode($course->ects) : ''}} ECTS</span>
                                                    @endif
                                                    @if(isset($course->mqfeqf_level) && !empty($course->mqfeqf_level) && $course->mqfeqf_level > 0)
                                                    <span class="badge bg-success-soft co-etcs">MQF/EQF Level {{isset($course->mqfeqf_level)  ? htmlspecialchars_decode($course->mqfeqf_level) : ''}}</span>
                                                    @endif
                                                </li>
 
                                            </ul>
                                            <div class="d-flex align-items-center justify-content-between mt-1">
                                                <span class="text-dark enroll_icon">
                                                    <i class="fe fe-user"></i>
                                                    @php $CountEnrolled = $course->temp_count;@endphp {{$CountEnrolled}} Enrolled
                                                </span>
                                            </div>
                                            <!-- Row -->
                                            <div class="row align-items-center g-0 pt-3">
                                                <div class="card-footer">
                                                    <div class="row align-items-center g-0">
                                                        <div class="col course-price-flex ">
                                                        <h5 class="mb-0 course-price fs-4">€{{isset($course->course_final_price) ?$course->course_final_price : 0}}</h5>
                                                        @if(isset($course->course_old_price) && $course->course_old_price > 0)<h5 class="old-price">€{{ $course->course_old_price}} </h5>@endif
                                                        </div>
                              
                                                        <div class="col-auto">
                                                            @if (Auth::check() && Auth::user()->role =='user')
                                                                @php
                                                                    $isPaid = is_exist('orders', ['user_id' => Auth::user()->id,'status' => '0','course_id'=> $course->id]);
                                                                @endphp
                                                                @if (isset($isPaid) && !empty($isPaid) && is_numeric($isPaid) &&  $isPaid > 0)
                                                                        @php
                                                                            $studentCourseMaster = getData('student_course_master',['course_expired_on','exam_attempt_remain','exam_remark'],['user_id' => Auth::user()->id, 'course_id'=> $course->id,'is_deleted'=>'No'], "", 'created_at');
                                                                            if (isset($course->category_id) && !empty($course->category_id) && $course->category_id === 1){
                                                                                $playLink = "start-course-panel";
                                                                            }else{
                                                                                $playLink = "master-course-panel";
                                                                            }
                                                                            
                                                                        @endphp
                                                                        @if(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '1' &&  $studentCourseMaster[0]->exam_remark == '0')
                                                                            <a  href="{{route($playLink,['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="fe fe-play btn-outline-primary " ></i>Play</a>
                                                                            {{$studentCourseMaster[0]->exam_remark}}
                                                                        @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster[0]) && $studentCourseMaster[0]->course_expired_on > now() &&    $studentCourseMaster[0]->exam_attempt_remain == '2') 
                                                                            <a  href="{{route($playLink,['course_id'=>base64_encode($course->id)])}}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle" ><i class="fe fe-play btn-outline-primary " ></i>Play</a>
                                                                            {{$studentCourseMaster[0]->exam_remark}}
                                                                        @else
                                                                        <div class="d-flex" style="padding: 0px"> 
                                                                            @if($course->category_id != '5')

                                                                            @php
                                                                            $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                                            @endphp
                                                                            @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                                <a class="text-inherit addtocartBrowse" id="addtocartBrowse" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px;cursor: pointer;" loading="lazy"/></a>
                                                                            @else 
                                                                                <a class="text-inherit addtocartBrowse" id="addtocartBrowse" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px;cursor: pointer;" loading="lazy"/></i></a>
                                                                            @endif
                                                                            @endif
                                                                            <form action="{{ route('checkout') }}" method="post">
                                                                                @csrf
                                                                                @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                                <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                                <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                                <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                                <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                                <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                                <button class="buy-now">Buy Now</button>
                                                                            </form>
                                                                        </div>
                                                                        @endif
                                                                @else
                                                                <div class="d-flex" style="padding: 0px"> 
                                                                    @if($course->category_id != '5')
                                                                    @php
                                                                        $isCart = is_exist('cart', ['student_id' => Auth::user()->id,'course_id'=> $course->id,'status'=>'Active']);
                                                                    @endphp
                                                                    @if (isset($isCart) && !empty($isCart) && is_numeric($isCart) &&  $isCart > 0)
                                                                        <a class="text-inherit addtocartBrowse" id="addtocartBrowse" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/check-out-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px;cursor: pointer;"/></a>
                                                                    @else 
                                                                        <a class="text-inherit addtocartBrowse" id="addtocartBrowse" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px;cursor: pointer;"/></a>
                                                                    @endif
                                                                    @endif
                                                                    <form action="{{ route('checkout') }}" method="post">
                                                                    @csrf <!-- CSRF protection -->
                                                                    @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                    <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                    <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                    <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price -$course->course_final_price)}}">
                                                                    <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                    <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                    <button class="buy-now">Buy Now</button>
                                                                    </form>
                                                                </div>
                                                                @endif      
                                                            @else
                                                                <div class="d-flex">
                                                                    @if($course->category_id != '5')
                                                                    <a class="text-inherit addtocartBrowse" id="addtocartBrowse" data-course-id="{{base64_encode($course->id)}}"  data-cart-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('add')}}" data-withcart="withcart"><img src="{{ asset('frontend/images/add-to-cart-icon.svg')}}" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px;cursor: pointer;"/></a>
                                                                    @endif
                                                                    <form action="{{ route('checkout') }}" method="post">
                                                                        @csrf <!-- CSRF protection -->
                                                                        @php $total_full_price = $course->course_old_price - ($course->course_old_price - $course->course_final_price) ; @endphp
                                                                        <input type='hidden' value="{{base64_encode($course->id)}}" name="course_id" id="course_id">
                                                                        <input type="hidden" class="form-control overall_total" name="overall_total" value="{{base64_encode($course->course_old_price)}}">
                                                                        <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="{{base64_encode($course->course_old_price - $course->course_final_price)}}">
                                                                        <input type='hidden' class="form-control overall_full_totals" name="overall_full_totals" value="{{base64_encode($total_full_price)}}">
                                                                        <input type='hidden' class="form-control directchekout" name="directchekout" value="{{base64_encode('0')}}">
                                                                        <button class="buy-now">Buy Now</button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                  </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @if($course->category_id != '5')
                                <div class="col-auto course-saved-btn">
                                    @if (Auth::check() && Auth::user()->role =='user')
                                        @php
                                            $isWishlist = is_exist('wishlist', ['student_id' => Auth::user()->id,'status'=>'Active','cart_wishlist' => '0','course_id'=> $course->id]);
                                        @endphp
                                        @if (isset($isWishlist) && !empty($isWishlist) && is_numeric($isWishlist) &&  $isWishlist > 0) 
                                            @php $showicon="bi heart-icon bi-heart-fill";@endphp
                                        @else
                                            @php $showicon="bi bi-heart heart-icon";@endphp
                                        @endif
                                        <a  class="text-inherit addwishlistBrowse" aria-label="Add to Wishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}"><i class="{{$showicon}}"></i></a>
                                    @else
                                        <a  class="text-inherit addwishlistBrowse" aria-label="Add to Wishlist" data-course-id="{{base64_encode($course->id)}}" data-action="{{base64_encode('wishlist')}}" data-withwishlist="withwishlist"><i class="bi bi-heart heart-icon"></i></a>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        {{--                         
                        <div class="col-12 mb-1">
                            <div class="card mb-4 card-hover browse-page-card">
                                <div class="row g-0">
                                    <a class="col-12 col-md-12  col-lg-4 bg-cover img-left-rounded" href="#">
                                        <img src="{{ asset('frontend/images/course/award-recruitment-and-employee-selection.png')}}" alt="..."
                                            class="img-fluid course-thumbnail">
                                    </a>
                                    <div class="col-lg-8 col-md-12 col-12">
                                        <!-- Card body -->
                                        <div class="card-body browseAllCourse">
                                            <h3  class="mb-2 course-title color-blue"><a href="#" class="text-inherit color-blue">Award in Recruitment and Employee Selection</a></h3>
                                            <!-- List inline -->
                                            <ul class="mb-3 list-inline">

                                                <li class="list-inline-item">
                                                    <span class="badge bg-info-soft co-category">Award</span>
                                                    <span class="badge bg-success-soft co-etcs">6 ECTS</span>
                                                    <span class="badge bg-success-soft co-etcs">MQF/EQF Level 7</span>
                                                </li>
 
                                            </ul>
                                            <ul class="mb-2 list-inline">
                                                <li class="list-inline-item">
                                                    <span>
                                                        <i class="bi bi-clock"></i>
                                                    </span>
                                                    <span>100h 45m</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="bi bi-play-btn"></i>
                                                    323 Lectures
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="bi bi-person-check"></i>
                                                    535 Students Enrolled
                                                </li>
                                            </ul>
                                            <!-- Row -->
                                            <div class="row align-items-center g-0 pt-3">
                                                <div class="card-footer">
                                                    <div class="row align-items-center g-0">
                                                        <div class="col course-price-flex">
                                                        <h5 class="mb-0 course-price">€1500</h5>
                                                        <h5 class="old-price">€2300 </h5>
                                                        </div>
                              
                                                      <div class="col-auto">
                                                        <a href="#" class="text-inherit">
                                                          <i class="fe fe-shopping-cart text-primary align-middle me-2"></i>
                                                          </a><a href="#" class="buy-now">Buy Now</a>
                                                        
                                                      </div>

                                                    </div>
                                                  </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-auto course-saved-btn">
                                    <a href="#" class="text-reset bookmark">
                                        <i class="bi bi-suit-heart fs-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div> --}}


                        {{-- <div class="col-12 mb-1">
                            <div class="card mb-4 card-hover browse-page-card">
                                <div class="row g-0">
                                    <a class="col-12 col-md-12  col-lg-4 bg-cover img-left-rounded" href="#">
                                        <img src="{{ asset('frontend/images/course/diploma-human-resource-management.png')}}" alt="..."
                                            class="img-fluid course-thumbnail">
                                    </a>
                                    <div class="col-lg-8 col-md-12 col-12">
                                        <!-- Card body -->
                                        <div class="card-body browseAllCourse">
                                            <h3  class="mb-2 course-title color-blue"><a href="#" class="text-inherit color-blue">Post Graduate Diploma in Human Resource Management</a></h3>
                                            <!-- List inline -->
                                            <ul class="mb-3 list-inline">

                                                <li class="list-inline-item">
                                                    <span class="badge bg-info-soft co-category">Diploma</span>
                                                    <span class="badge bg-success-soft co-etcs">60 ECTS</span>
                                                    <span class="badge bg-success-soft co-etcs">MQF/EQF Level 7</span>
                                                </li>
 
                                            </ul>
                                            <ul class="mb-2 list-inline">
                                                <li class="list-inline-item">
                                                    <span>
                                                        <i class="bi bi-clock"></i>
                                                    </span>
                                                    <span>560h 60m</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="bi bi-play-btn"></i>
                                                    323 Lectures
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="bi bi-person-check"></i>
                                                    535 Students Enrolled
                                                </li>
                                            </ul>
                                            <!-- Row -->
                                            <div class="row align-items-center g-0 pt-3">
                                                <div class="card-footer">
                                                    <div class="row align-items-center g-0">
                                                        <div class="col course-price-flex">
                                                        <h5 class="mb-0 course-price">€1500</h5>
                                                        <h5 class="old-price">€2300 </h5>
                                                        </div>
                              
                                                      <div class="col-auto">
                                                        <a href="#" class="text-inherit">
                                                          <i class="fe fe-shopping-cart text-primary align-middle me-2"></i>
                                                          </a><a href="#" class="buy-now">Buy Now</a>
                                                        
                                                      </div>

                                                    </div>
                                                  </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-auto course-saved-btn">
                                    <a href="#" class="text-reset bookmark">
                                        <i class="bi bi-suit-heart fs-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>


                        
                        <div class="col-12 mb-1">
                            <div class="card mb-4 card-hover browse-page-card">
                                <div class="row g-0">
                                    <a class="col-12 col-md-12  col-lg-4 bg-cover img-left-rounded" href="#">
                                        <img src="{{ asset('frontend/images/course/award-global-business-strategy.png')}}" alt="..."
                                            class="img-fluid course-thumbnail">
                                    </a>
                                    <div class="col-lg-8 col-md-12 col-12">
                                        <!-- Card body -->
                                        <div class="card-body browseAllCourse">
                                            <h3  class="mb-2 course-title color-blue"><a href="#" class="text-inherit color-blue">Award in Global Business Strategy</a></h3>
                                            <!-- List inline -->
                                            <ul class="mb-3 list-inline">

                                                <li class="list-inline-item">
                                                    <span class="badge bg-info-soft co-category">Award</span>
                                                    <span class="badge bg-success-soft co-etcs">10 ECTS</span>
                                                    <span class="badge bg-success-soft co-etcs">MQF/EQF Level 7</span>
                                                </li>
 
                                            </ul>
                                            <ul class="mb-2 list-inline">
                                                <li class="list-inline-item">
                                                    <span>
                                                        <i class="bi bi-clock"></i>
                                                    </span>
                                                    <span>560h 60m</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="bi bi-play-btn"></i>
                                                    323 Lectures
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="bi bi-person-check"></i>
                                                    535 Students Enrolled
                                                </li>
                                            </ul>
                                            <!-- Row -->
                                            <div class="row align-items-center g-0 pt-3">
                                                <div class="card-footer">
                                                    <div class="row align-items-center g-0">
                                                        <div class="col course-price-flex">
                                                        <h5 class="mb-0 course-price">€1500</h5>
                                                        <h5 class="old-price">€2300 </h5>
                                                        </div>
                              
                                                      <div class="col-auto">
                                                        <a href="#" class="text-inherit">
                                                          <i class="fe fe-shopping-cart text-primary align-middle me-2"></i>
                                                          </a><a href="#" class="buy-now">Buy Now</a>
                                                        
                                                      </div>

                                                    </div>
                                                  </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-auto course-saved-btn">
                                    <a href="#" class="text-reset bookmark">
                                        <i class="bi bi-suit-heart fs-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>



                        
                        <div class="col-12 mb-1">
                            <div class="card mb-4 card-hover browse-page-card">
                                <div class="row g-0">
                                    <a class="col-12 col-md-12  col-lg-4 bg-cover img-left-rounded" href="#">
                                        <img src="{{ asset('frontend/images/course/award-performance-management.png')}}" alt="..."
                                            class="img-fluid course-thumbnail">
                                    </a>
                                    <div class="col-lg-8 col-md-12 col-12">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <h3  class="mb-2 course-title color-blue"><a href="#" class="text-inherit color-blue">Award in Performance Management and Compensation</a></h3>
                                            <!-- List inline -->
                                            <ul class="mb-3 list-inline">

                                                <li class="list-inline-item">
                                                    <span class="badge bg-info-soft co-category">Award</span>
                                                    <span class="badge bg-success-soft co-etcs">7 ECTS</span>
                                                    <span class="badge bg-success-soft co-etcs">MQF/EQF Level 7</span>
                                                </li>
 
                                            </ul>
                                            <ul class="mb-2 list-inline">
                                                <li class="list-inline-item">
                                                    <span>
                                                        <i class="bi bi-clock"></i>
                                                    </span>
                                                    <span>560h 60m</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="bi bi-play-btn"></i>
                                                    323 Lectures
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="bi bi-person-check"></i>
                                                    535 Students Enrolled
                                                </li>
                                            </ul>
                                            <!-- Row -->
                                            <div class="row align-items-center g-0 pt-3">
                                                <div class="card-footer">
                                                    <div class="row align-items-center g-0">
                                                        <div class="col course-price-flex">
                                                        <h5 class="mb-0 course-price">€1500</h5>
                                                        <h5 class="old-price">€2300 </h5>
                                                        </div>
                              
                                                      <div class="col-auto">
                                                        <a href="#" class="text-inherit">
                                                          <i class="fe fe-shopping-cart text-primary align-middle me-2"></i>
                                                          </a><a href="#" class="buy-now">Buy Now</a>
                                                        
                                                      </div>

                                                    </div>
                                                  </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-auto course-saved-btn">
                                    <a href="#" class="text-reset bookmark">
                                        <i class="bi bi-suit-heart fs-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        

                        <div class="col-12 mb-1">
                            <div class="card mb-4 card-hover browse-page-card">
                                <div class="row g-0">
                                    <a class="col-12 col-md-12  col-lg-4 bg-cover img-left-rounded" href="#">
                                        <img src="{{ asset('frontend/images/course/certificate-human-resource-management.png')}}" alt="..."
                                            class="img-fluid course-thumbnail">
                                    </a>
                                    <div class="col-lg-8 col-md-12 col-12">
                                        <!-- Card body -->
                                        <div class="card-body browseAllCourse">
                                            <h3  class="mb-2 course-title color-blue"><a href="#" class="text-inherit color-blue">Post Graduate Certificate in Human Resource Management</a></h3>
                                            <!-- List inline -->
                                            <ul class="mb-3 list-inline">

                                                <li class="list-inline-item">
                                                    <span class="badge bg-info-soft co-category">Certificate</span>
                                                    <span class="badge bg-success-soft co-etcs">30 ECTS</span>
                                                    <span class="badge bg-success-soft co-etcs">MQF/EQF Level 7</span>
                                                </li>
 
                                            </ul>
                                            <ul class="mb-2 list-inline">
                                                <li class="list-inline-item">
                                                    <span>
                                                        <i class="bi bi-clock"></i>
                                                    </span>
                                                    <span>130h 50m</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="bi bi-play-btn"></i>
                                                    323 Lectures
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="bi bi-person-check"></i>
                                                    535 Students Enrolled
                                                </li>
                                            </ul>
                                            <!-- Row -->
                                            <div class="row align-items-center g-0 pt-3">
                                                <div class="card-footer">
                                                    <div class="row align-items-center g-0">
                                                        <div class="col course-price-flex">
                                                        <h5 class="mb-0 course-price">€1500</h5>
                                                        <h5 class="old-price">€2300 </h5>
                                                        </div>
                              
                                                      <div class="col-auto">
                                                        <a href="#" class="text-inherit">
                                                          <i class="fe fe-shopping-cart text-primary align-middle me-2"></i>
                                                          </a><a href="#" class="buy-now">Buy Now</a>
                                                        
                                                      </div>

                                                    </div>
                                                  </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-auto course-saved-btn">
                                    <a href="#" class="text-reset bookmark">
                                        <i class="bi bi-suit-heart fs-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div> --}}

                        


                        {{-- <nav> --}}
                            <!-- pagination start -->
                            {{-- <ul class="pagination mt-4 mb-2">
                                <li class="page-item disabled">
                                    <a class="page-link mx-1 rounded" href="#" tabindex="-1" aria-disabled="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                            fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z">
                                        </svg>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link mx-1 rounded" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link mx-1 rounded" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link mx-1 rounded" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link mx-1 rounded" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                            fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                        </svg>
                                    </a>
                                </li>
                            </ul> --}}
                            <!-- pagination end -->
                        {{-- </nav> --}}
                    </div>
                    <div class="pagination">
                        @if ($browseCourseData->isNotEmpty())
                            {{ $browseCourseData->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>

    $('.SearchButton').on('click', function () {
        var searchName = btoa($(".course_name_search").val());
        MainCourseFetch(searchName,'');
    });
    function togglePriceSection(selectedStatus) {
        if (selectedStatus == '3') {
            // $('#collapseExampleFifth').closest('.card-body').show();
            $(".price_hide").show();
        } else {
            $(".price_hide").hide();
            // $('#collapseExampleFifth').closest('.card-body').hide();
            $('#collapseExampleFifth input[type="checkbox"]').prop('checked', false);
        }
    }
    // Filter form submission
    $('#collapseExample input[type="checkbox"], #collapseExampleSecond input[type="checkbox"],#collapseExampleThird input[type="checkbox"],#collapseExampleFourth input[type="radio"],#collapseExampleFifth input[type="checkbox"]').on('change', function () {
       
        const inputType = $(this).attr('type');
        const inputValue = $(this).val();

        // Find all matching inputs (excluding the one that triggered the event)
        if (inputType === 'checkbox') {
        // Sync checkboxes
        $('input[type="checkbox"]').not(this).filter(function () {
            return $(this).val() === inputValue;
        }).prop('checked', $(this).prop('checked'));
    }

    if (inputType === 'radio') {
        const radioName = $(this).attr('name');
        // Sync radio buttons with same name and value
        $('input[type="radio"][name="' + radioName + '"]').not(this).each(function () {
            if ($(this).val() === inputValue) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });
    }

        // Set checked state to match
        // matchingInputs.prop('checked', $(this).prop('checked'));
        
        var searchName = btoa($(".course_name_search").val());
        var selectedStatus = $('#collapseExampleFourth input[type="radio"]:checked').val();

        togglePriceSection(selectedStatus);
        MainCourseFetch(searchName,'');
    });
    // Pagination links
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        var searchName = btoa($(".course_name_search").val());
        MainCourseFetch(searchName,page);
    });
    $('#CourseTitle').on('input', function () {
        if ($(this).val() === '') {
            // Refresh the page when the input is cleared
            MainCourseFetch();
        }
    });

    function MainCourseFetch(searchName = '', page = 1) {
        var selectedCategories = getSelectedValues('#collapseExample');
        var selectedSubjects = getSelectedValues('#collapseExampleSecond');
        var selectedEcts = getSelectedValues('#collapseExampleThird');
        var selectedPrice = getSelectedValues('#collapseExampleFifth');        
        var selectedStatus = $('#collapseExampleFourth input[type="radio"]:checked').val();
        fetchCourses(page, selectedCategories, selectedSubjects, selectedEcts, selectedStatus, selectedPrice, searchName);
    }

    function getSelectedValues(selector) {
        var values = [];
        $(selector + ' input[type="checkbox"]:checked, ' + selector + ' input[type="radio"]:checked').each(function () {
            values.push(btoa($(this).val())); // Base64 encode
        });
        return values;
    }

    $('#clearButton').on('click', function() {
        $(".course_name_search").val('');
        $('#collapseExample input[type="checkbox"]').prop('checked', false);
        $('#collapseExampleThird input[type="checkbox"]').prop('checked', false);
        $('#collapseExampleSecond input[type="checkbox"]').prop('checked', false);
        $('#collapseExampleFourth input[type="checkbox"]').prop('checked', false);
        MainCourseFetch();
    });
    function fetchCourses(page = 1,selectedCategories=[],selectedSubjects=[],selectedEcts=[],selectedStatus,selectedPrice=[],searchName) {

        console.log(selectedPrice);

        let formData = $('#filterForm').serialize();
        formData += '&page='+page;
        formData += '&categories=' + selectedCategories.join(',');
        formData += '&subjects=' + selectedSubjects.join(',');
        formData += '&ects=' + selectedEcts.join(',');
        formData += '&price=' + selectedPrice.join(',');
        formData += '&course_status=' + selectedStatus;
        formData += '&search_name=' + searchName;


        var baseUrl = window.location.origin + "/";
    
        $.ajax({
            url:baseUrl + "browse-course",
            type: 'GET',
            data: formData,
            success: function(response) {
                // console.log(response.pagination);
                var html = '';
                const user = response.user; // User data from API
                console.log(user);
                $('.browseAllResult strong').text(response.totalCourseCount);

                if(response.courses.length > 0){
                    response.courses.forEach(function(course) {
                        // console.log(course);
                        let isLoggedIn = user !== null;
                        let isPaid = course.isPaid; // Check if the user has paid for the course
                        let isCart = course.isCart; // Assume this field is pre-computed in Laravel
                        let isWishlist = course.isWishlist; // Assume this field is pre-computed in Laravel
                        let master = course.studentCourseMaster;
                        var courseExpiredOn ='';
                        // if (master){
                        // console.log(master);
                        if (master && Object.keys(master).length > 0) {
                            courseExpiredOn = new Date(master[0].course_expired_on);
                            // console.log(master[0].exam_remark );
                            // console.log(master[0].exam_attempt_remain );
                            // console.log(courseExpiredOn.toDateString());
                            var now = new Date();
                        }
                        if(course.category_id == 1){
                            var url = "course-details/"+btoa(course.id);
                        }else if(course.category_id == 5){
                            var url = "dba-course-details/"+btoa(course.id);
                        }else{
                            var url ="master-course-details/"+btoa(course.id);
                        }
                        html += `
                            <div class="col-12 mb-1">
                                <div class="card mb-4 card-hover browse-page-card">
                                    <div class="row g-0">
                                        <a class="col-12 col-md-12 col-lg-12 col-xl-4 bg-cover img-left-rounded" href="${url}">
                                            <img src="` + baseUrl + 'storage/' + course.course_thumbnail_file + `" alt="..." class="img-fluid course-thumbnail">
                                        </a>
                                        <div class="col-lg-12 col-xl-8 col-md-12 col-12">
                                            <div class="card-body browseAllCourse">
                                                <h3 class="mb-2 course-title color-blue">
                                                    <a href="${url}" class="text-inherit color-blue fs-4">${course.course_title}</a>
                                                </h3>
                                                <ul class="mb-3 list-inline">
                                                    <li class="list-inline-item">
                                                        ${course.category_id === 1 ? '<span class="badge bg-info-soft co-category">Award</span>' : ''}
                                                        ${course.category_id === 2 ? '<span class="badge bg-info-soft co-category">Certificate</span>' : ''}
                                                        ${course.category_id === 3 ? '<span class="badge bg-info-soft co-category">Diploma</span>' : ''}
                                                        ${course.category_id === 4 ? '<span class="badge bg-info-soft co-category">Masters</span>' : ''}
                                                        ${course.category_id === 5 ? '<span class="badge bg-info-soft co-category">DBA</span>' : ''}`;
                                                        if (course.ects != null && course.ects != '') {
                                                            html += `<span class="badge bg-success-soft co-etcs">${course.ects} ECTS</span>`;
                                                        }
                                                        if (course.mqfeqf_level != null && course.mqfeqf_level != '' && course.mqfeqf_level > 0) {
                                                            html +=  `<span class="badge bg-success-soft co-etcs">MQF/EQF Level ${course.mqfeqf_level}</span>`;
                                                        }
                                                    html +=  `</li>
                                                </ul>`;
                                                if(course.status == '3'){
                                                    html +=`
                                                     <div class="d-flex align-items-center justify-content-between mt-1">
                                                     <span class="text-dark enroll_icon">
                                                        <i class="fe fe-user"></i>
                                                        ${course.temp_count != null ? course.temp_count : 0} Enrolled
                                                    </span>
                                                    </div>
                                                <div class="row align-items-center g-0 pt-3">
                                                <div class="card-footer">
                                                    <div class="row align-items-center g-0">
                                                        <div class="col course-price-flex">
                                                            <h5 class="mb-0 course-price fs-4">€${course.course_final_price}</h5>`;
                                                            if(course.course_old_price > 0){
                                                            html += `<h5 class="old-price">€${course.course_old_price}</h5>`;
                                                            }
                                                        html += `</div>`;
                                                        html += `  <div class="col-auto">`;
                                                                if (user && user.role === 'user') {
                                                                    if(isPaid > 0){
                                                                    
                                                                                if (master.length > 0 && courseExpiredOn > now && master[0].exam_attempt_remain == '1' && master[0].exam_remark == "null") {

                                                                                    html += `<a href="${course.playLink}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle">
                                                                                                <i class="bi bi-play-circle btn-outline-primary me-1 fs-4"></i> Play
                                                                                            </a>`;
                                                                                } else if (master.length > 0 && courseExpiredOn > now && master[0].exam_attempt_remain == '2') {

                                                                                    html += `<a href="${course.playLink}" class="mt-0 d-flex align-items-center justify-content-center playBtnStyle">
                                                                                            <i class="bi bi-play-circle btn-outline-primary me-1 fs-4"></i> Play
                                                                                            </a>`;
                                                                                } else {
                                                                                    html += `<div class="d-flex">`;
                                                                                    if(course.category_id != '5'){
                                                                                    if(isCart > 0){
                                                                                            html +=  `<a class="text-inherit addtocartBrowse" id="addtocartBrowse" data-course-id="${btoa(course.id)}"  data-cart-id="${btoa(course.id)}" data-action=" ${btoa('add')}"><img src="${window.location.origin}/frontend/images/check-out-icon.svg" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px;cursor: pointer;"/></a>`;
                                                                                        }else{
                                                                                            html += ` <a class="text-inherit addtocartBrowse" id="addtocartBrowse" data-course-id="${btoa(course.id)}" data-cart-id="${btoa(course.id)}" data-action="YWRk"><img src="${window.location.origin}/frontend/images/add-to-cart-icon.svg" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px;cursor: pointer;" loading="lazy"></a>`;
                                                                                        }
                                                                                    }
                                                                                    html +=  createBuyNowForm(course);
                                                                                    html += `</div>`;
                                                                                }
                                                                        }else{
                                                                            html += `<div class="d-flex">`;
                                                                            if(course.category_id != '5'){
                                                                                if(isCart > 0){
                                                                                    html +=  `<a class="text-inherit addtocartBrowse" id="addtocartBrowse" data-course-id="${btoa(course.id)}"  data-cart-id="${btoa(course.id)}" data-action=" ${btoa('add')}"><img src="${window.location.origin}/frontend/images/check-out-icon.svg" class="text-primary align-middle me-2" alt="add to cart" style="height: 25px; width: 25px;cursor: pointer;"/></a>`;
                                                                                }else{
                                                                                    html += ` <a class="text-inherit addtocartBrowse" id="addtocartBrowse" data-course-id="${btoa(course.id)}" data-cart-id="${btoa(course.id)}" data-action="YWRk"><img src="${window.location.origin}/frontend/images/add-to-cart-icon.svg" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px;cursor: pointer;" loading="lazy"></a>`;
                                                                                }
                                                                            }
                                                                            html +=  createBuyNowForm(course);
                                                                            html += `</div>`;
                                                                    }
                                                                }else{
                                                                    html += `<div class="d-flex">`;
                                                                        if(course.category_id != '5'){

                                                                            html += `<a class="text-inherit addtocartBrowse" id="addtocartBrowse" data-course-id="${btoa(course.id)}" data-cart-id="${btoa(course.id)}" data-action="YWRk"   data-withcart="withcart"><img src="${window.location.origin}/frontend/images/add-to-cart-icon.svg" class="text-primary align-middle me-2" alt="added to cart" style="height: 25px; width: 25px;cursor: pointer;" loading="lazy"></a>`;
                                                                        }
                                                                        html +=  createBuyNowForm(course);                           
                                                                }
                                                
                                                                html += `</div>`;
                                                            html +=
                                                        `</div>
                                                    </div>
                                                </div></div>`;
                                                }
                                                html += `</div>
                                        </div>
                                    `;
                                    if(course.status == '3' && course.category_id != '5'){
                                    html += `<div class="col-auto course-saved-btn">`;
                                        if (user && user.role === 'user') {
                                            if(isWishlist > 0){
                                                var showicon="bi heart-icon bi-heart-fill";
                                            }else{
                                                var showicon="bi bi-heart heart-icon";
                                            }
                                            console.log(showicon);
                                            html += `<a class='text-inherit addwishlistBrowse' aria-label='Add to Wishlist' data-course-id='${btoa(course.id)}' data-action='${btoa("wishlist")}'><i class='${showicon}'></i></a>`;
                                        }else{
                                            html += `<a class="text-inherit addwishlistBrowse" aria-label="Add to Wishlist" data-course-id="${btoa(course.id)}" data-action="${btoa('wishlist')}" data-withwishlist="withwishlist"><i class="bi bi-heart heart-icon"></i></a>`;
                                        }
                                    html +=`</div></div>`;
                                    }
                            html +=`</div>
                            </div>
                        `;
                    });
                }else{
                    var html = `  <div class="col-12 mb-4">
                                        <div class="d-flex justify-content-center bg-light">
                                            <div class="p-4 text-center border-0" style="max-width: 500px;">
                                            <div class="browseAllCourse">
                                                <div class="mb-3">
                                                <img class="img-fluid" src="{{ asset('frontend/images/browser-svg/not-found-browse-course.svg') }}" alt="E-Ascencia" style="width: 100px;">
                                                </div>
                                                <div>
                                                <h4 class="text-primary mb-0" style="color: #2b3990;">Courses Not Found</h4>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    `;

                }
                $('#courseList').html(html).hide().slideDown(500);
                $('.pagination').html(response.pagination).hide().slideDown(500);
            },
            error: function(xhr) {
                console.error('An error occurred:', xhr.responseText);
            }
        });
    }

    const parseDate = (dateStr) => {
            const [day, month, year] = dateStr.split('-').map(Number);
            return new Date(year, month - 1, day); // JavaScript months are zero-based
        };

    function renderCartActions(isCart) {
        let cartHtml = `<div class="d-flex">`;
        if (isCart > 0) {
            cartHtml += `<a class="text-inherit addtocartBrowse" id="addtocartBrowse" 
                        data-course-id="${btoa(course.id)}"  
                        data-cart-id="${btoa(course.id)}" 
                        data-action="${btoa('add')}">
                            <img src="${window.location.origin}/frontend/images/check-out-icon.svg" 
                                class="text-primary align-middle me-2" 
                                alt="add to cart" style="height: 25px; width: 25px;cursor: pointer;"/>
                        </a>`;
        } else {
            cartHtml += `<a class="text-inherit addtocartBrowse" id="addtocartBrowse" 
                        data-course-id="${btoa(course.id)}" 
                        data-cart-id="${btoa(course.id)}" 
                        data-action="YWRk">
                            <img src="${window.location.origin}/frontend/images/add-to-cart-icon.svg" 
                                class="text-primary align-middle me-2" 
                                alt="added to cart" style="height: 25px; width: 25px;cursor: pointer;" loading="lazy">
                        </a>`;
        }
        cartHtml += createBuyNowForm(course);
        cartHtml += `</div>`;
        return cartHtml;
    }
    function createBuyNowForm(course) {

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        if(course.course_old_price == undefined){
            var courseOldPrice = 0;
        }else{
            var courseOldPrice = course.course_old_price;
        }
        if(course.course_final_price == undefined){
            var courseFinalPrice = 0;
        }else{
            var courseFinalPrice = course.course_final_price;
        }
        const totalFullPrice = courseOldPrice - (courseOldPrice - courseFinalPrice);
        return `<form action="${window.location.origin}/checkout" method="post">
             <input type="hidden" name="_token" value="${csrfToken}">
            <input type="hidden" name="course_id" value="${btoa(course.id)}">
            <input type="hidden" class="form-control overall_total" name="overall_total" value="${btoa(courseOldPrice)}">
            <input type="hidden" class="form-control overall_old_total" name="overall_old_total" value="${btoa(courseOldPrice - courseFinalPrice)}">
            <input type="hidden" class="form-control overall_full_totals" name="overall_full_totals" value="${btoa(totalFullPrice)}">
            <input type="hidden" class="form-control directchekout" name="directchekout" value="${btoa('0')}">
            <button class="buy-now">Buy Now</button>
        </form>`;
    }
   

    var baseUrl = window.location.origin;
    $(document).on('click', '.addwishlistBrowse', function() {
        var courseId = $(this).data("course-id");
        var action = ($(this).data("action"));
        var withwishlist = $(this).data("withwishlist");
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
       
        if(withwishlist == "withwishlist"){
            $.ajax({
                url: baseUrl + "/store-intended-wishlist", // Route to store session data
                method: "POST",
                data: {
                    _token: $("meta[name='csrf-token']").attr("content"), // CSRF token for security
                    course_id: courseId,
                    action: action
                },
                success: function(response) {
                    if(response.status == 'success'){
                        window.location.href = baseUrl + "/login";
                    }

                    // Redirect to the login page after storing the session data
                    // window.location.href = baseUrl + "/login";
                },
                error: function(xhr, status, error) {
                }
            });
        }else{
            $.ajax({
                url: baseUrl + "/student/addwishlist/",
                type: "POST",
                data: {
                    courseid: courseId,
                    action: action,
                },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     return window.location.reload();
                    // });
                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData);
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                    
                },
            });
        }
    });
    $(document).on('click', '.addtocartBrowse', function() {
        var courseId = $(this).data("course-id");
        var action = $(this).data("action");
        var actions = atob($(this).data("action"));
        var withcart = ($(this).data("withcart"));
        if (actions == "wishlist") {
            var cartid = atob($(this).data("cart-id"));
        } else {
            var cartid = "";
        }
        if(withcart == "withcart"){
            $.ajax({
                url: baseUrl + "/store-intended-cart", // Route to store session data
                method: "POST",
                data: {
                    _token: $("meta[name='csrf-token']").attr("content"), // CSRF token for security
                    course_id: courseId,
                    action: action
                },
                success: function(response) {
                    if(response.status == 'success'){
                        window.location.href = baseUrl + "/login";
                    }

                    // Redirect to the login page after storing the session data
                    // window.location.href = baseUrl + "/login";
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred:", error);
                }
            });
        }
        var removeid = $(this).data("id");  
        var Message = "";
        if(actions == "remove"){
            Message = "cart";
            Title_Message = "Cart";

        }
        if(actions == "wishlist_remove"){
            Title_Message = "wishlist";
            Message = "wishlist";

        }
        if (actions == "remove" || actions == "wishlist_remove") {
            swal({
                title: "Remove  From " + Title_Message + "",
                text: "Are you sure you want to remove this course from your " + Message + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    CartFunctionBrowse(courseId, action, removeid, cartid);
                }
            });
        } else {
            var removeid = "";
            CartFunctionBrowse(courseId, action, removeid, cartid);
        }
    });

    function CartFunctionBrowse(courseId, action, removeid='', cartid='') {
    var baseUrl = window.location.origin;
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    if (courseId) {
        $.ajax({
            url: baseUrl + "/course/addtocart/",
            type: "POST",
            data: {
                courseid: courseId,
                action: action,
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                console.log(response);
                if (response.code === 201) {
                    swal({
                        title: response.title,
                        text: response.message,
                        icon: response.icon,
                    }).then(function () {
                        return (window.location.href = "/login");
                    });
                } else {
                    var CountCourse = $(".CourseItems").text();
                    $(".CourseItems").html(CountCourse - 1);
                    if (
                        atob(action) == "remove" ||
                        atob(action) == "wishlist"
                    ) {
                        if (atob(action) == "remove") {
                            $(".course_" + atob(courseId)).css(
                                "display",
                                "none"
                            );
                        } else {
                            $(".course_" + cartid).css("display", "none");
                        }
                        var Id = removeid;

                        $(".promo_code_" + Id).val("");
                        if($(".total_old_price_" + Id).val() != undefined){
                            var total_old_price = atob(
                                $(".total_old_price_" + Id).val()
                            );
                            var total_price = atob($(".total_price_" + Id).val());
                        }
                        if($(".discount_promo_" + Id).val() != undefined){
                            // var DiscountCode = atob(
                            //     $(".discount_promo_" + Id).val()
                            // );
                            var DiscountCode = '';
                        }
                        var promo_code_discount =
                            (total_old_price * DiscountCode) / 100;
                        var DiscountTotal = $(".promo_code_discount").text();
                        if (DiscountTotal == 0) {
                            promo_code_discount = 0;
                        }
                        if($(".overall_total" + Id).val() != undefined){
                            var overall_total = atob($(".overall_total").val());
                            var overall_old_total = atob(
                                $(".overall_old_total").val()
                            );
                        }
                        var full_price =
                            parseFloat(overall_total) -
                            parseFloat(overall_old_total);
                        var DiscountOverAllTotal =
                            parseFloat(DiscountTotal) -
                            parseFloat(promo_code_discount);
                        var full_total_price =
                            parseFloat(full_price) -
                            parseFloat(DiscountOverAllTotal);
                        $(".promo_code_discount").html(DiscountOverAllTotal);
                        $(".overall_full_total").html("€" + full_total_price);
                        $(".promo_code_discounts").val(
                            btoa(DiscountOverAllTotal)
                        );
                        $(".overall_full_totals").val(btoa(full_total_price));
                        var total_price_last = $(".total_price_last").text();

                        $(".total_price_last").html(
                            parseFloat(total_price_last) -
                                parseFloat(total_price)
                        );
                        var full_price_last = $(".full_price_last").text();
                        // alert(full_price_last);
                        // alert(total_price);
                        // alert(total_old_price);
                        // alert(parseFloat(total_price) - parseFloat(total_old_price));
                        $(".full_price_last").html(
                            parseFloat(full_price_last) -
                                (parseFloat(total_price) -
                                    parseFloat(total_old_price))
                        );

                        var CountCourse = $(".CourseItemscount").text();
                        // alert(CountCourse);
                        $(".CourseItems").html(CountCourse - 1 + " Items");
                    }
                    // swal({
                    //     title: response.title,
                    //     text: response.message,
                    //     icon: response.icon,
                    // }).then(function () {
                    //     return window.location.reload();
                    // });
                    const modalData = {
                        title: response.title,
                        message: response.message,
                        icon: response.icon,
                    }
                    showModal(modalData);
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            },
        });
    } else {
        swal({
            title: "Something Went Wrong",
            text: "Please Try Again",
            icon: "error",
        });
    }
}

// To hide the offcanvas when its reach above medium device

function handleOffCanvasOnResize() {
    const offcanvasEl = document.querySelector('.offcanvas');
    const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasEl);

    if (window.innerWidth > 768 && offcanvasEl.classList.contains('show')) {
      offcanvasInstance.hide();
    }
  }

  window.addEventListener('resize', handleOffCanvasOnResize);
  window.addEventListener('load', handleOffCanvasOnResize);



//   To hide the offcanvas when click on checkbox
  function handleCheckboxClickToCloseOffcanvas() {
  const offcanvasEl = document.querySelector('.offcanvas');
  const checkboxes = offcanvasEl.querySelectorAll('input[type="checkbox"]');
  const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasEl);

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('click', () => {
        offcanvasInstance.hide();
    });
  });
}

window.addEventListener('load', () => {
  handleCheckboxClickToCloseOffcanvas();
});

   $(document).ready(function () {
    $(window).on("pageshow", function (event) {
      if (event.originalEvent.persisted || (window.performance && performance.navigation.type === 2)) {
        window.location.reload(); // Refresh the page on back button
      }
    });
  });

</script>
@endsection