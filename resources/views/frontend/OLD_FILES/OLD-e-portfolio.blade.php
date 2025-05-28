@extends('frontend.master')
@section('content')


<!-- Wrapper -->
<div id="db-wrapper" class="course-video-player-page course-video-player-page-studentExamSection">
    <!-- Sidebar -->

    @include('frontend.exam.layout.exam-left-menu')

    <!-- Page Content -->
    <main id="page-content">
        <div class="header">
            <nav class="navbar-default navbar navbar-expand-lg" style="background-color: #f1f5f9;box-shadow: none;">
                <a id="nav-toggle" href="#" class="color-blue fs-4 ">
                    <button class="button is-text is-opened ms-2 m-2 m-md-0 m-md-0" id="menu-button" onclick="buttonToggle()">
                        <div class="button-inner-wrapper">
                            <i id="menu-icon" class="bi-x" style="font-size: x-large"></i>
                        </div>
                    </button>
                </a>
                <div class="d-flex align-items-center justify-content-between ps-3">
                    <div>
                        <h3 class="mb-0 text-truncate-line-2 color-blue">E-Portfolio</h3>
                    </div>

                </div>

            </nav>
        </div>

        <!-- Page Header -->


        <!-- Container fluid -->
        <section class="container-fluid ps-4 pe-3">
            {{-- E-portfolio --}}
            <div class="row">


                @foreach ($EportfolioData as $item)

                <div class="col-md-12">
                    <b>Instructions:</b>
                    <p>{{$item->eportfolio_instruction}} </p>
                </div>

                @endforeach
                <div class="col-md-12 mb-5">
                    <label class="form-label" for="E-portfolio Title">E-Portfolio Title </label>
                    <input type="text " id="E-portfolio Title" class="form-control  mb-3" placeholder="E-Portfolio Title" required>
                    <textarea class="form-control" id="siteDescription" placeholder="Write here..." required="" rows="16"></textarea>
                    <small>(Ensure your written answer are between 500 and 1000 words.)</small>
                </div>



                <div class="col-12 mb-6 text-center">
                    <a href="#" class="btn btn-primary">Submit</a>
                </div>

                <div class="col-12 mb-6">
                    <div class="card">
                        <div class="card-body">
                            <!-- row -->
                            <div class="row gx-3">
                                <div class="col-md-12">
                                    <label for="customerNotes" class="form-label">
                                        <h3 class="color-blue submittedPortfolioListTitle">Submitted E-Portfolio List</h3>
                                    </label>
                                    <h4 class="mb-2"><a href="#" class="text-inherit">1. E-portfolio Title 1</a> <span class="badge bg-success-soft">Submitted</span> </h4>
                                    <h4 class="mb-2"><a href="#" class="text-inherit">2. E-portfolio Title 2</a> <span class="badge bg-success-soft">Submitted</span> </h4>
                                    <h4 class="mb-2"><a href="#" class="text-inherit">3. E-portfolio Title 3</a> <span class="badge bg-success-soft">Submitted</span> </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </section>


    </main>
</div>


@endsection

<script>
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
