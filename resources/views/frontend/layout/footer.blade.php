{{-- @php
$setting = App\Models\SiteSetting::find(1);
@endphp --}}

        <!-- footer -->
        <footer class="pt-6 footer">
            <div class="container ">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- about company -->
                        <div class="mb-4">
                            <!-- list -->
                            <h3 class="fw-bold mb-2">E-Ascencia</h3>
                            <ul class="list-unstyled nav nav-footer flex-column nav-x-0">
                                <li><a href="{{route('about-us')}}" class="nav-link d-inline-block">About Us</a></li>
                                <li><a href="{{route('our-teachers')}}" class="nav-link d-inline-block">Our Teachers</a></li>
                                <li><a href="{{route('contact-us')}}" class="nav-link d-inline-block">Contact Us</a></li>
                                <li><a href="{{route('partner-university')}}" class="nav-link d-inline-block">Approved Partners</a></li>

                                {{-- <li><a href="https://www.ustudious.com/" class="nav-link" target="_blank">E-Ascencia Business</a></li> --}}

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="mb-4">
                            <!-- list -->
                            <h3 class="fw-bold mb-2">Course</h3>
                            <ul class="list-unstyled nav nav-footer flex-column nav-x-0">
                                <li><a href="{{route('award-courses')}}" class="nav-link d-inline-block">Award</a></li>
                                <li><a href="{{route('certificate-courses')}}" class="nav-link d-inline-block">Certificate</a></li>
                                <li><a href="{{route('diploma-courses')}}" class="nav-link d-inline-block">Diploma</a></li>
                                <li><a href="{{route('masters-courses')}}" class="nav-link d-inline-block">Masters</a></li>
                                <li><a href="{{route('dba-courses')}}" class="nav-link d-inline-block">DBA</a></li>
                                <li><a href="{{route('english-course-program')}}" class="nav-link d-inline-block">Language Courses</a></li>

                                {{-- <li><a href="#" onclick="return false;" class="nav-link">Browse All</a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="mb-4">
                            <!-- list -->
                            <h3 class="fw-bold mb-2">Support</h3>
                            <ul class="list-unstyled nav nav-footer flex-column nav-x-0">
                                <li><a href="{{route('terms-and-conditions')}}" class="nav-link d-inline-block">Terms and Conditions</a></li>
                                <li><a href="{{route('privacy-policy')}}" class="nav-link d-inline-block">Privacy Policy</a></li>
                                <li><a href="{{route('faq')}}" class="nav-link d-inline-block">FAQ's</a></li>
                                <li><a href="{{route('cookies')}}" class="nav-link d-inline-block">Cookies</a></li>
                                {{-- <li><a href="#" onclick="return false;" class="nav-link">Sitemap</a></li> --}}
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-12">
                        <!-- contact info -->
                        <div class="mb-3">
                            <h3 class="fw-bold mb-2">Get in Touch</h3>
                            {{-- <p class="mb-1">23, Vincenzo Dimech Street, Malta</p> --}}

                            @if (Auth::guest() || (Auth::check() && Auth::user()->role == 'user'))
                            @if (Route::current()->getName() == '/' || Route::current()->getName() == 'index')
                            {{-- <div class="mb-3">
                                <form class="newsletter-form" action="" method="POST">
                                    <input type="email" name="email" placeholder="Enter your email" required class="form-control">
                                    <button type="submit" class="btn btn-primary rounded-0">Subscribe</button>
                                </form>
                            </div> --}}
                            @endif
                            @endif
                            <p class="mb-0">
                                Contact:
                                <a href="mailto:info@eascencia.mt" class="color-blue d-inline-block">info@eascencia.mt</a>
                            </p>
                            <p class="mb-1">
                                Support:
                                <a href="mailto:support@eascencia.mt" class="color-blue d-inline-block">support@eascencia.mt</a>
                            </p>
                            {{-- <p>
                                Phone:
                                <span class="text-dark fw-semibold"><a href="tel:+91 740017795" class="text-dark">+91 7400177951</a></span>
                            </p> --}}
                        </div>
                        <div class="fs-6 mt-3">
                        <a href="https://www.facebook.com/people/E-Ascencia-Malta/61559646792486/" target="_blank"><img class="social-logo mb-2 "
                                src="{{ asset('frontend/images/social/social-media-01.png') }}" alt="social logo"></a>
                        <a href="https://www.instagram.com/eascencia/" target="_blank"><img class="social-logo mb-2 "
                                src="{{ asset('frontend/images/social/social-media-02.png') }}" alt="social logo"></a>
                        <a href="https://www.linkedin.com/company/ascencia-malta-business-school/" target="_blank"><img class="social-logo mb-2 "
                                src="{{ asset('frontend/images/social/social-media-03.png') }}" alt="social logo"></a>
                        <a href="https://x.com/eascenciamalta" target="_blank"><img class="social-logo mb-2 twitterLogoStyle"
                                src="{{ asset('frontend/images/social/social-media-09.png') }} " alt="social logo"></a>
                        {{-- <a href="#" target="_blank" onclick="return false"><img class="social-logo mb-2 "
                                src="{{ asset('frontend/images/social/social-media-07.png') }}" alt="social logo"></a> --}}
                        {{-- <a href="https://www.quora.com/profile/E-Ascencia-Malta" target="_blank"><img class="social-logo mb-2 "
                                src="{{ asset('frontend/images/social/social-media-08.png') }}" alt="social logo"></a> --}}
                        </div>
                    </div>
                </div>
                <div class="row align-items-center g-0 border-top py-2 mt-3">
                    <!-- Desc -->
                    <div class="col-lg-12 col-md-12 col-12">
                        <span>
                            ©
                            <span id="copyright2">
                                <script>
                                    document.getElementById("copyright2").appendChild(document.createTextNode(new Date().getFullYear()));
                                </script>
                            </span>
                            E-Ascencia, Inc. All Rights Reserved. 
                        </span>
                    </div>


                </div>
            </div>
        </footer>
