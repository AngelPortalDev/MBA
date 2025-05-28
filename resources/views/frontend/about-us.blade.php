@extends('frontend.master')
@section('content')

            <section class="pt-8 pb-4 bg-white">
                <div class="container">
                    <div class="row">
                        <div class="offset-lg-2 col-lg-8 col-md-12 col-12 mb-6">
                            <!-- caption-->
                            <h1 class="display-3 fw-bold mb-3">
                                Hi there, we’re
                                <span class="text-primary">E-Ascencia</span>
                            </h1>
                            <!-- para -->
                            <p class="h3 mb-3">
                            E-Ascencia Malta is a leading online learning platform designed to deliver top-notch education to students worldwide. Our platform provides a variety of courses meticulously developed to align with international benchmarks and accommodate learners from different backgrounds.
                            </p>
                            <p class="mb-0 text-body lh-lg">
                            Our platform aims to facilitate access to diverse pathways to success, fostering personal growth and academic achievement for career advancement.
                            </p>
                        </div>
                    </div>
                    <!-- gallery -->
                    <div class="gallery mb-6">
                        <!-- gallery-item -->
                        <figure class="gallery__item gallery__item--1 mb-0">
                            <img src="{{ asset('frontend/images/team/about-student-1.jpg')}}" alt="Gallery image 1" class="gallery__img rounded-3">
                        </figure>
                        <!-- gallery-item -->
                        <figure class="gallery__item gallery__item--2 mb-0">
                            <img src="{{ asset('frontend/images/team/about-claire-2.jpg')}}" alt="Gallery image 2" class="gallery__img rounded-3">
                        </figure>
                        <!-- gallery-item -->
                        <figure class="gallery__item gallery__item--3 mb-0">
                            <img src="{{ asset('frontend/images/team/about-tess-3.jpg')}}" alt="Gallery image 3" class="gallery__img rounded-3">
                        </figure>
                        <!-- gallery-item -->
                        <figure class="gallery__item gallery__item--4 mb-0">
                            <img src="{{ asset('frontend/images/team/about-laura-4.jpg')}}" alt="Gallery image 4" class="gallery__img rounded-3">
                        </figure>
                        <!-- gallery-item -->
                        <figure class="gallery__item gallery__item--5 mb-0">
                            <img src="{{ asset('frontend/images/team/about-student-5.jpg')}}" alt="Gallery image 5" class="gallery__img rounded-3">
                        </figure>
                        <!-- gallery-item -->
                        <figure class="gallery__item gallery__item--6 mb-0">
                            <img src="{{ asset('frontend/images/team/about-student-6.jpg')}}" alt="Gallery image 6" class="gallery__img rounded-3">
                        </figure>
                    </div>
                    <div class="row mb-2">
                        <!-- row -->
                        <div class="col-md-6 ">
                            <!-- heading -->
                            <h2 class="display-5 fw-bold">Mission</h2>
                            <!-- para -->
                            <p>Our mission is to empower students with accessible, flexible education transcending geographical barriers. We aim to nurture a learning space that encourages innovation, analytical thinking, and continuous learning.</p>
                        </div>
                        <div class="col-md-6 ">
                            <!-- heading -->
                            <h3 class="display-5 fw-bold">Vision</h3>
                            <!-- para -->
                            <p>We aspire to stand out as a leading figure in online education worldwide, recognized for our commitment to excellence and innovation. We aim to ensure that high-standard education is accessible for all, regardless of location.</p>
                        </div>

                    </div>
                </div>
            </section>

            <!-- features -->
            <section class="pb-4 pt-6 about-us-values">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-12 mb-3">
                            <!-- caption -->
                            <h2 class="display-5 fw-bold">Values</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12 d-flex">
                            <!-- card -->
                            <div class="card mb-4  ">
                                <!-- card body -->
                                <div class="card-body p-5">
                                    <!-- icon -->
                                    <div class="mb-3">
                                        <img src="{{ asset('frontend/images/icon/about-us-icons-01.png')}}" alt="">
                                    </div>
                                    <h3 class="mb-2">Excellence</h3>
                                    <p class="mb-0">We are committed to delivering excellence in education through high-quality course content and cutting-edge learning technologies.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 d-flex">
                            <!-- card -->
                            <div class="card mb-4  ">
                                <!-- card body -->
                                <div class="card-body p-5">
                                    <!-- icon -->
                                    <div class="mb-3">
                                        <img src="{{ asset('frontend/images/icon/about-us-icons-02.png')}}" alt="">
                                    </div>
                                    <h3 class="mb-2">Accessibility</h3>
                                    <p class="mb-0">We believe in breaking down barriers to education by providing an accessible and inclusive learning platform that accommodates diverse learners.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 d-flex">
                            <!-- card -->
                            <div class="card mb-4  ">
                                <!-- card body -->
                                <div class="card-body p-5">
                                    <!-- icon -->
                                    <div class="mb-3">
                                        <img src="{{ asset('frontend/images/icon/about-us-icons-03.png')}}" alt="">
                                    </div>
                                    <h3 class="mb-2">Innovation</h3>
                                    <p class="mb-0">We embrace innovation in teaching and learning methodologies, constantly evolving to meet the evolving needs of the digital age.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 d-flex">
                            <!-- card -->
                            <div class="card mb-4  ">
                                <!-- card body -->
                                <div class="card-body p-5">
                                    <!-- icon -->
                                    <div class="mb-3">
                                        <img src="{{ asset('frontend/images/icon/about-us-icons-04.png')}}" alt="">
                                    </div>
                                    <h3 class="mb-2">Integrity</h3>
                                    <p class="mb-0"> We pride ourselves on upholding the highest standards of integrity, ensuring transparency in all our actions, and conducting ourselves. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 d-flex">
                            <!-- card -->
                            <div class="card mb-4  ">
                                <!-- card body -->
                                <div class="card-body p-5">
                                    <!-- icon -->
                                    <div class="mb-3">
                                        <img src="{{ asset('frontend/images/icon/about-us-icons-05.png')}}" alt="">
                                    </div>
                                    <h3 class="mb-2">Empowerment </h3>
                                    <p class="mb-0">We empower students to take control of their learning journey, offering them the flexibility and resources they need to succeed academically and professionally.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 d-flex">
                            <!-- card -->
                            <div class="card mb-4  ">
                                <!-- card body -->
                                <div class="card-body p-5">
                                    <!-- icon -->
                                    <div class="mb-3">
                                        <img src="{{ asset('frontend/images/icon/about-us-icons-06.png')}}" alt="">
                                    </div>
                                    <h3 class="mb-2">Collaboration</h3>
                                    <p class="mb-0">We believe in the power of collaboration and community-building, so we foster an environment where students can collaborate with peers and instructors.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>



@endsection