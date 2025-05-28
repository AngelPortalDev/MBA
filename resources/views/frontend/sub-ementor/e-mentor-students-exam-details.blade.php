@extends('frontend.master')
@section('content')

    <style>
        .custom-note {
            font-style: italic;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .custom-header {
            border-bottom: 2px solid #754FFE;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .finalSubmission {
            background: #fffefe;
        }
    </style>

    @php
        $stData = null;
        $total_mark_obtain = 0;
        if (
            isset($ementorStudentData['studentData'][0]['exam_student']) &&
            is_array($ementorStudentData['studentData'][0]['exam_student']) &&
            count($ementorStudentData['studentData'][0]['exam_student']) > 0
        ) {
            $stData = $ementorStudentData['studentData'][0]['exam_student'][0];
            $courseData = $ementorStudentData['studentData'][0]['exam_course'][0];
            $awardCourses = $ementorStudentData['studentData'];
            $courseRelatedData = $ementorStudentData['courseData'];
            $courseTitle = $ementorStudentData['courseTitle'];
            $courseCategory = $ementorStudentData['courseCategory'];
        } else {
            $url = url()->current();
            $parameters = request()->route()->parameters();
            $userId = $parameters['id'];
            $stData = \App\Models\User::where('id', base64_decode($userId))
                // ->with('StudentProfile')
                ->with([
                    'StudentProfile' => function ($q) {
                        $q->leftJoin(
                            'country_master',
                            'country_master.id',
                            '=',
                            'student_profile_master.country_id',
                        )->select('student_profile_master.*', 'country_master.country_name');
                    },
                ])
                ->with('StudentDocs')
                ->first();

            $stData = json_decode(json_encode($stData), true);
            $courseRelatedData = isset($ementorStudentData['courseData']) ? $ementorStudentData['courseData'] : null;
            $courseData = null;
        }
        $totalPercentage = 0;
    @endphp
    <div
        style="background-image:url({{ isset($stData['profile_background']) ? '/' . 'storage/' . $stData['profile_background'] : Storage::url('studentDocs/student-cover-photo-bg.jpg') }});  no-repeat; background-position: center; background-size: cover;height: 10rem !important;">
    </div>
    <section class="bg-white">
        <div class="container">
            <div class="row align-items-center">
                @if (session()->has('exam'))
                    <script>
                        swal({
                            title: "Exam not found",
                            text: '',
                            icon: 'error',
                        });
                    </script>
                @endif
                {{-- @php
                    $stData =   $ementorStudentData[0]['exam_student'][0];
                    $courseData =   $ementorStudentData[0]['exam_course'][0];
                    @endphp --}}


                <div class="col-12">
                    <div class="d-md-flex align-items-center">
                        <!-- img -->
                        <div class="position-relative mt-n4 ">
                            {{-- <img src="{{ Storage::exists($stData['photo']) ? Storage::url($stData['photo']) : Storage::url("studentDocs/no_image_student.png") }}" alt="logo" class="rounded-3 border student-profile-e-mentor"> --}}

                            <img src="{{ $stData && isset($stData['photo']) && Storage::exists($stData['photo']) ? Storage::url($stData['photo']) : Storage::url('studentDocs/student-profile-photo.png') }}"
                                alt="logo" class="rounded-3 border student-profile-e-mentor">
                        </div>

                        <div class="w-100 ms-md-3 mt-4">
                            <div class="d-flex justify-content-between">
                                <div>


                                    <!-- heading -->
                                    <h2 class="mb-0 color-blue">
                                        {{ $stData['name'] && $stData['last_name'] ? $stData['name'] . ' ' . $stData['last_name'] : '' }}
                                    </h2>

                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fe fe-mail fs-4"></i>
                                        <a href="mailto:{{ $stData['email'] }}" class="ms-2">
                                            {{ $stData['email'] ? $stData['email'] : '' }}
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <!-- button -->
                                    <a href="javascript:history.back()" class="btn btn-outline-primary">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-6 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 mb-4 mb-lg-0">
                    <!-- Card -->
                    <div class="card rounded-3">
                        <!-- Card header -->
                        <div class="card-header border-bottom-0 p-0">
                            <div>
                                <!-- Nav -->
                                <ul class="nav nav-lb-tab" id="tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link " id="profile-tab" data-bs-toggle="pill" href="#profile"
                                            role="tab" aria-controls="profile" aria-selected="false"
                                            tabindex="-1">Profile</a>
                                    </li>
                                    {{-- <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="verification-tab" data-bs-toggle="pill" href="#verification"
                                            role="tab" aria-controls="verification" aria-selected="false"
                                            tabindex="-1">
                                            Verification
                                        </a>
                                    </li> --}}
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="courses-tab" data-bs-toggle="pill" href="#courses"
                                            role="tab" aria-controls="courses" aria-selected="false" tabindex="-1">
                                            Courses
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="exam-tab" data-bs-toggle="pill" href="#exam"
                                            role="tab" aria-controls="exam" aria-selected="false"
                                            tabindex="-1">Exam</a>
                                    </li>


                                </ul>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="tab-content" id="tabContent">
                                {{-- Student profile  --}}
                                <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <!-- Card -->
                                    <div class="mb-4 pb-4 border-bottom">
                                        <h4 class="color-blue">Basic Information</h4>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Student:</span>
                                            {{ isset($stData['student_profile']['occupation']) && !empty($stData['student_profile']['occupation']) ? $stData['student_profile']['occupation'] : 'N/D' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Mobile No. :</span>
                                            {{ isset($stData['phone']) ? $stData['mob_code'] . ' ' . $stData['phone'] : 'N/D' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Date of Birth:</span>
                                            {{ isset($stData['student_profile']['dob']) ? $stData['student_profile']['dob'] : 'N/D' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Gender:</span>
                                            {{ isset($stData['student_profile']['gender']) ? $stData['student_profile']['gender'] : 'N/D' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Country:</span>
                                            {{ isset($stData['student_profile']['country_name']) ? $stData['student_profile']['country_name'] : 'N/D' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">City:</span>
                                            {{ isset($stData['student_profile']['city_id']) && !empty($stData['student_profile']['city_id']) ? $stData['student_profile']['city_id'] : 'N/D' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Nationality:</span>
                                            {{ isset($stData['student_profile']['nationality']) && !empty($stData['student_profile']['nationality']) ? $stData['student_profile']['nationality'] : 'N/D' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Postal Code:</span>
                                            {{ isset($stData['student_profile']['zip']) && !empty($stData['student_profile']['zip']) ? $stData['student_profile']['zip'] : 'N/D' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Address:</span>
                                            {{ isset($stData['student_profile']['address']) && !empty($stData['student_profile']['address']) ? $stData['student_profile']['address'] : 'N/D' }}
                                        </div>
                                    </p>
                                    <div class="mb-4 pb-4 border-bottom">
                                        <h4 class="color-blue">Resume </h4>

                                        @if (isset($stData['student_docs']['resume_file']) && Storage::exists($stData['student_docs']['resume_file']))
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Status:</span>
                                                <span class="text-success fw-bold">Uploaded</span>
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Download:</span>
                                                <a href="{{ Storage::disk('local')->url($stData['student_docs']['resume_file']) }}"
                                                    download="Resume"> My-Resume.pdf <i
                                                        class="fe fe-download fs-5"></i></a>
                                            </p>
                                        @else
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Status:</span>
                                                <span class="text-secondary fw-bold">Not Uploaded</span>
                                            </p>
                                        @endif



                                    </div>
                                    {{-- @if (isset($stData['student_profile']['linkedIn']) && $stData['student_profile']['linkedIn']) --}}
                                        <div class="mb-2 ">
                                            {{-- <h4 class="color-blue">Social Profile</h4> --}}
                                            {{-- Whatsapp --}}
                                            @if (isset($stData['student_profile']['whatsapp']) && $stData['student_profile']['whatsapp'])
                                                <a href="{{ isset($stData['student_profile']['whatsapp']) && !empty($stData['student_profile']['whatsapp']) ? 'https://wa.me/' . ltrim($stData['student_profile']['whatsapp_country_code']).ltrim($stData['student_profile']['whatsapp'], '+') : '#' }}" class="me-4" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#25de66" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                        <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                                      </svg>
                                                </a>
                                            @endif
                                            <!--Facebook-->
                                            @if (isset($stData['student_profile']['facebook']) && $stData['student_profile']['facebook'])
                                                <a href="{{ isset($stData['student_profile']['facebook']) ? (strpos($stData['student_profile']['facebook'], 'http') === 0 ? $stData['student_profile']['facebook'] : 'http://' . $stData['student_profile']['facebook']) : '#' }}"
                                                    class=" me-4" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                        fill="#316ff6" class="bi bi-facebook" viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                                    </svg>
                                                </a>
                                            @endif
                                            @if (isset($stData['student_profile']['instagram']) && $stData['student_profile']['instagram'])
                                                <a href="{{ isset($stData['student_profile']['instagram']) ? (strpos($stData['student_profile']['instagram'], 'http') === 0 ? $stData['student_profile']['instagram'] : 'http://' . $stData['student_profile']['instagram']) : '#' }}"
                                                    class=" me-4" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                        fill="#dd2a7b" class="bi bi-instagram" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                                    </svg>
                                                </a>
                                            @endif
                                            <!--LinkedIn-->
                                                {{-- <a href="{{ isset($stData['student_profile']['linkedIn']) ? (strpos($stData['student_profile']['linkedIn'], 'http') === 0 ? $stData['student_profile']['linkedIn'] : 'http://' . $stData['student_profile']['linkedIn']) : '#' }}"
                                                    class=" me-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                                    </svg>
                                                </a>
                                            <!--Twitter-->
                                            {{-- @if (isset($stData['student_profile']['twitter']) && $stData['student_profile']['twitter'])
                                                <a href="{{ isset($stData['student_profile']['twitter']) ? (strpos($stData['student_profile']['twitter'], 'http') === 0 ? $stData['student_profile']['twitter'] : 'http://' . $stData['student_profile']['twitter']) : '#' }}"
                                                    class=" me-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                                    </svg>
                                                </a>
                                            @endif --}}

                                            <!--GitHub-->


                                        </div>
                                    {{-- @endif --}}
                                </div>

                                <!-- Document Verification -->
                                <div class="tab-pane fade" id="verification" role="tabpanel"
                                    aria-labelledby="verification-tab">
                                    <!-- verification -->

                                    <div class="mb-4 pb-4 border-bottom">
                                        <h4 class="color-blue">Identity Proof</h4>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Status:</span>
                                            <span
                                                class="text-success fw-bold">{{ isset($stData['student_docs']['identity_is_approved']) && $stData['student_docs']['identity_is_approved'] === 'Approved' ? 'Verified' : 'Unverified' }}</span>
                                        </p>

                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Document Type:</span>
                                            {{ isset($stData['student_docs']['identity_doc_type']) ? $stData['student_docs']['identity_doc_type'] : '' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Name as per Document:</span>
                                            {{ isset($stData['student_docs']['name_on_identity_card']) ? $stData['student_docs']['name_on_identity_card'] : '' }}
                                        </p>
                                        {{-- <p class="mb-1">
                                                <span class="text-dark fw-bold">DOB as per Document:</span>
                                                {{isset($stData['student_docs']['identity_doc_country']) ? $stData['student_docs']['identity_doc_country'] : ""}}
                                            </p> --}}
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Document ID Number:</span>
                                            {{ isset($stData['student_docs']['identity_doc_number']) ? $stData['student_docs']['identity_doc_number'] : '' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Document Expiry:</span>
                                            {{ isset($stData['student_docs']['identity_doc_expiry']) ? $stData['student_docs']['identity_doc_expiry'] : '' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Document Issuing Authority:</span>
                                            {{ isset($stData['student_docs']['identity_doc_authority']) ? $stData['student_docs']['identity_doc_authority'] : '' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Document Issuing Country:</span>
                                            {{ isset($stData['student_docs']['identity_doc_country']) ? $stData['student_docs']['identity_doc_country'] : '' }}
                                        </p>
                                        @if (isset($stData['student_docs']['identity_doc_file']) &&
                                                Storage::exists($stData['student_docs']['identity_doc_file']))
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Download:</span>
                                                <a href="{{ Storage::disk('local')->url($stData['student_docs']['identity_doc_file']) }}"
                                                    download="ID Card on E-Ascencia"> Identity-Proof.pdf <i
                                                        class="fe fe-download fs-5"></i></a>
                                            </p>
                                        @endif

                                    </div>

                                    <div class="mb-4 pb-4 border-bottom">
                                        <h4 class="color-blue">Education Details</h4>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Status:</span>
                                            <span
                                                class="text-success fw-bold">{{ isset($stData['student_docs']['edu_is_approved']) && $stData['student_docs']['edu_is_approved'] === 'Approved' ? 'Verified' : 'Unverified' }}</span>
                                        </p>

                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Name of Institution or University:</span>
                                            {{ isset($stData['student_docs']['university_name_on_edu_doc']) ? $stData['student_docs']['university_name_on_edu_doc'] : '' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Specialization:</span>
                                            {{ isset($stData['student_docs']['edu_specialization']) ? $stData['student_docs']['edu_specialization'] : '' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Name of Course of Degree:</span>
                                            {{ isset($stData['student_docs']['degree_course_name']) ? html_entity_decode($stData['student_docs']['degree_course_name']) : '' }}
                                        </p>
                                        {{-- <p class="mb-1">
                                                <span class="text-dark fw-bold">Document ID Number:</span>
                                              {{isset($stData['student_docs']['degree_course_name']) && $stData['student_docs']['degree_course_name'] : ""}}
                                            </p> --}}
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Name as per Document:</span>
                                            {{ isset($stData['student_docs']['name_on_education_doc']) ? $stData['student_docs']['name_on_education_doc'] : '' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Year of Passing:</span>
                                            {{ isset($stData['student_docs']['passing_year']) ? $stData['student_docs']['passing_year'] : '' }}
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Remark:</span>
                                            {{ isset($stData['student_docs']['remark_on_edu_doc']) ? $stData['student_docs']['remark_on_edu_doc'] : '' }}
                                        </p>
                                        @if (isset($stData['student_docs']['edu_doc_file']) && Storage::exists($stData['student_docs']['edu_doc_file']))
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Download:</span>
                                                <a href="{{ Storage::disk('local')->url($stData['student_docs']['edu_doc_file']) }}"
                                                    download="Education-Docs on E-Ascencia"> Education-Docs.pdf <i
                                                        class="fe fe-download fs-5"></i></a>
                                            </p>
                                        @endif
                                    </div>

                                    <div class="mb-4 pb-4 border-bottom">
                                        <h4 class="color-blue">Resume </h4>

                                        @if (isset($stData['student_docs']['resume_file']) && Storage::exists($stData['student_docs']['resume_file']))
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Status:</span>
                                                <span class="text-success fw-bold">Uploaded</span>
                                            </p>
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Download:</span>
                                                <a href="{{ Storage::disk('local')->url($stData['student_docs']['resume_file']) }}"
                                                    download="Resume"> My-Resume.pdf <i
                                                        class="fe fe-download fs-5"></i></a>
                                            </p>
                                        @else
                                            <p class="mb-1">
                                                <span class="text-dark fw-bold">Status:</span>
                                                <span class="text-secondary fw-bold">Not Uploaded</span>
                                            </p>
                                        @endif



                                    </div>

                                    <div class="mb-2">
                                        <h4 class="color-blue">English Language Proficiency Test</h4>
                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Status:</span>
                                            @if (isset($stData['student_docs']['english_score']) && $stData['student_docs']['english_score'] < 10)
                                                <span class="text-danger fw-bold">Fail
                                                    {{-- / {{isset($stData['student_docs']['english_level_view']) ? $stData['student_docs']['english_level_view'] : ""}} --}}
                                                </span>
                                            @else
                                                <span class="text-success fw-bold">Pass
                                                    {{-- / {{isset($stData['student_docs']['english_level_view']) ? $stData['student_docs']['english_level_view'] : ""}} --}}
                                                </span>
                                            @endif

                                        </p>
                                        {{-- <p class="mb-1">
                                                <span class="text-dark fw-bold">Result:</span> --}}
                                        {{-- <span class="text-success fw-bold"> {{isset( $ementorStudentData['final_remark']) ? $ementorStudentData['final_remark'] : ""}}</span> --}}
                                        {{-- </p> --}}

                                        <p class="mb-1">
                                            <span class="text-dark fw-bold">Total Marks Obtained:</span>
                                            <span
                                                class="fw-bold">{{ isset($stData['student_docs']['english_score']) ? $stData['student_docs']['english_score'] : '' }}
                                            </span>
                                        </p>
                                        {{-- <p class="mb-1">
                                                <span class="text-dark fw-bold">Percentage:</span> --}}
                                        {{-- {{isset($$ementorStudentData[0]['final_score_obtain']) ? $$ementorStudentData[0]['final_score_obtain'] : ""}}% --}}
                                        {{-- </p> --}}

                                    </div>
                                </div>



                                <!-- Courses  -->
                                <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                                    <!-- Description -->
                                    <div class="mb-4 border-bottom">
                                        <h4 class="color-blue">
                                            Enrolled Courses
                                        </h4>

                                        @if (isset($courseRelatedData['purchasedCourse']) && count($courseRelatedData['purchasedCourse']) > 0)
                                            @foreach ($courseRelatedData['purchasedCourse'] as $purchaseCourseData)
                                                <div class="d-flex align-items-center mb-3">
                                                    <div>
                                                        <a href="{{ url('e-mentor-course-details/'.base64_encode($purchaseCourseData->course_id)) }}">
                                                            <img src="{{ Storage::url($purchaseCourseData->course_thumbnail_file) }}"
                                                                alt="course" class="rounded img-4by3-lg">
                                                        </a>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h4 class="mb-1 h5">
                                                            <a href="{{ url('e-mentor-course-details/'.base64_encode($purchaseCourseData->course_id)) }}"
                                                                class="text-inherit color-blue">{{ $purchaseCourseData->course_title }}</a>
                                                        </h4>
                                                        <div class="mt-2">
                                                            <div class="progress" style="height: 4px">
                                                                <div class="progress-bar bg-blue" role="progressbar" style="width: {{isset($purchaseCourseData->course_progress) ? $purchaseCourseData->course_progress : 0}}%" aria-valuenow="{{isset($purchaseCourseData->course_progress) ? $purchaseCourseData->course_progress : 0}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <small>{{isset($purchaseCourseData->course_progress) ? $purchaseCourseData->course_progress : 0}} % Completed</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div>
                                                <p>No Record Found.</p>
                                            </div>
                                        @endif


                                    </div>

                                    {{-- <div class="mb-4 border-bottom">
                                            <h4 class="color-blue">
                                                Wishlist
                                            </h4>
                                            
                                            @if (isset($courseRelatedData['wishlistCourse']) && count($courseRelatedData['wishlistCourse']) > 0)
                                                @foreach ($courseRelatedData['wishlistCourse'] as $wishlistCourse)
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div>
                                                            <a href="{{base64_decode($wishlistCourse->id)}}">
                                                                <img src="{{ Storage::url($wishlistCourse->course_thumbnail_file) }}" alt="course" class="rounded img-4by3-lg">
                                                            </a>
                                                        </div>
                                                        <div class="ms-3">
                                                            <h4 class="mb-1 h5">
                                                                <a href="{{base64_decode($wishlistCourse->id)}}" class="text-inherit color-blue">{{$wishlistCourse->course_title}}</a>
                                                            </h4>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div>
                                                    <p>No Record Found.</p>
                                                </div>
                                            @endif

                                            
                                        </div> --}}


                                    <div class="mb-4 ">
                                        <h4 class="color-blue">
                                            Expired Courses
                                        </h4>
                                        @if (isset($courseRelatedData['expiredCourse']) && count($courseRelatedData['expiredCourse']) > 0)
                                            @foreach ($courseRelatedData['expiredCourse'] as $expiredCourse)
                                                @php $exm_remark = ''; @endphp
                                                @if($expiredCourse->exam_remark == 0)
                                                    @php $exm_remark = "Failed"; @endphp
                                                @elseif($expiredCourse->exam_remark == 1)
                                                    @php $exm_remark = "Passed";@endphp
                                                @endif
                                                <div class="d-flex  mb-3">
                                                    <div>
                                                        <a href="#">
                                                            <img src="{{ Storage::url($expiredCourse->course_thumbnail_file) }}"
                                                                alt="course" class="rounded img-4by3-lg">
                                                        </a>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h4 class="mb-1 h5">
                                                            <a href="#"
                                                                class="text-inherit color-blue">{{ $expiredCourse->course_title }}</a>
                                                        </h4>
                                                        @if(isset($exm_remark))
                                                            <h5 class="badge mt-2" style="background: #dae138; color: #2b3990"> 
                                                            {{isset($exm_remark) ? $exm_remark : ''}}</h5>
                                                        @endif

                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div>
                                                <p>No Record Found.</p>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                                <!-- Exams  -->
                                <div class="tab-pane fade active show" id="exam" role="tabpanel"
                                    aria-labelledby="exam-tab">
                                    @if ($courseData != null)
                                        @php
                                            $studentCourseMaster = DB::table('student_course_master')
                                                ->where([
                                                    'user_id' => $ementorStudentData['studentData'][0]['user_id'],
                                                    'course_id' => $ementorStudentData['studentData'][0]['course_id'],
                                                ])
                                                ->latest()
                                                ->first();
                                            $examRemarkMaster = DB::table('exam_remark_master')
                                                ->where([
                                                    'user_id' => $ementorStudentData['studentData'][0]['user_id'],
                                                    'course_id' => $ementorStudentData['studentData'][0]['course_id'],
                                                ])
                                                ->latest()
                                                ->first();
                                        @endphp
                                        @if (isset($studentCourseMaster) &&
                                                !empty($studentCourseMaster) &&
                                                $studentCourseMaster->exam_attempt_remain == '1' &&
                                                $examRemarkMaster->is_active != '1')
                                            @if (isset($studentCourseMaster) && !empty($studentCourseMaster) && $studentCourseMaster->exam_attempt_remain == '1')
                                                @if ($studentCourseMaster->exam_remark == 0)
                                                    <h4>First Attempt Result : <span
                                                            class="text-danger">Failed</span>
                                                    </h4>
                                                @elseif($studentCourseMaster->exam_remark == 1)
                                                    <h4>Final Result : <span
                                                            class="text-success">{{ $studentCourseMaster->exam_perc }}%
                                                            (Pass)</span></h4>
                                                @endif
                                            @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster) && $studentCourseMaster->exam_attempt_remain == '0')
                                                @if ($studentCourseMaster->exam_remark == 0)
                                                    <h4>Final Result : <span
                                                            class="text-danger">Failed</span>
                                                    </h4>
                                                @elseif($studentCourseMaster->exam_remark == 1)
                                                    <h4>Final Result : <span
                                                            class="text-success">{{ $studentCourseMaster->exam_perc }}%
                                                            (Pass)</span></h4>
                                                @endif
                                            @else
                                                <h4>The student has not attempted the exam yet.</h4>
                                            @endif
                                        @else
                                            <div class="card border mb-4">
                                                <!-- card body  -->
                                                <div class="card-body p-4">
                                                    <div class="mb-4">
                                                        <h3 class="fw-bold color-blue">
                                                            {{ isset($courseTitle) ? $courseTitle : '' }}
                                                            {{-- <span class="badge bg-success ms-2">Pass</span>  --}}
                                                        </h3>
                                                        <p>View student performance in each course module</p>
                                                    </div>
                                                    @php
                                                        $examData = [
                                                            'stData' => $ementorStudentData['studentData'][0]['exam_student'][0],
                                                            'courseData' => $ementorStudentData['studentData'][0]['exam_course'][0],
                                                            'awardCourses' => $ementorStudentData['studentData'],
                                                            'courseRelatedData' => $ementorStudentData['courseData'],
                                                            'courseTitle' => $ementorStudentData['courseTitle'],
                                                            'courseCategory' => $ementorStudentData['courseCategory'],
                                                            'ementorStudentData' => $ementorStudentData,
                                                        ];
                                                    @endphp
                                                    
                                                    @if($courseCategory != '1')
                                                        @include('frontend.teacher.masterCourseExam', $examData)
                                                    @else
                                                        @include('frontend.teacher.awardCourseExam', $examData)
                                                    @endif
                                                </div>
                                                <!-- card footer  -->

                                                @php
                                                    $course = DB::table('student_course_master')
                                                        ->join('course_master', 'student_course_master.course_id', '=', 'course_master.id')
                                                        ->where('student_course_master.id', $ementorStudentData['studentData'][0]['student_course_master_id'])
                                                        ->select('course_master.category_id', 'student_course_master.course_id')
                                                        ->first();

                                                    
                                                    if ($course && $course->category_id != 1) {
                                                        $awardCourseIds = DB::table('master_course_management')
                                                            ->where('award_id', $course->course_id)
                                                            ->pluck('course_id');
                                                            
                                                        $courseExamCount = DB::table('exam_management_master')
                                                            ->whereIn('course_id', $awardCourseIds)
                                                            ->whereNull('deleted_at')
                                                            ->count();

                                                        $completedExamCount = DB::table('exam_remark_master')
                                                            ->where([
                                                                'student_course_master_id' => $ementorStudentData['studentData'][0]['student_course_master_id'],
                                                                'user_id' => $ementorStudentData['studentData'][0]['user_id'],
                                                                'is_cheking_completed' => '2',
                                                                'is_active' => '1',
                                                            ])
                                                            ->latest()
                                                            ->count();

                                                    }else{

                                                        $courseExamCount = DB::table('exam_management_master')
                                                            ->where([
                                                                'course_id' =>
                                                                    $ementorStudentData['studentData'][0]['course_id'],
                                                                'deleted_at' => null,
                                                                // 'is_deleted' => 'No',
                                                            ])
                                                            ->count();

                                                        $completedExamCount = DB::table('exam_remark_master')
                                                            ->where([
                                                                'course_id' =>
                                                                    $ementorStudentData['studentData'][0]['course_id'],
                                                                'user_id' =>
                                                                    $ementorStudentData['studentData'][0]['user_id'],
                                                                'is_cheking_completed' => '2',
                                                                'is_active' => '1',
                                                            ])
                                                            ->latest()
                                                            ->count();
                                                    }
        
                                                    $eportfolioCount = DB::table('exam_eportfolio')->where([
                                                        'exam_eportfolio.user_id' =>  $ementorStudentData['studentData'][0]['user_id'],
                                                        'exam_eportfolio.course_id' => $ementorStudentData['studentData'][0]['course_id'],
                                                    ])->where('remark', '!=', null)->count();

                                                @endphp
                                                @if ($courseExamCount == $completedExamCount && $eportfolioCount > 0)
                                                    <div class="card-footer">
                                                        {{-- <span class="fw-bold color-blue">Total Marks Obtained:</span> <span class="text-success fw-bold"> {{ $totalPercentage }}%</span> --}}
                                                        {{-- @if ($courseExamCount == $completedExamCount && $eportfolioCount > 0) --}}
                                                            <div class="mt-5 finalSubmission">
                                                                <div class="border p-4 rounded-3 shadow-sm">
                                                                    <h4 class="custom-header mobileviewtext">Student Result
                                                                        Final Submission and Certificate Generation</h4>
                                                                    <p class="custom-note text-danger mobileViewButton">
                                                                        Note: If you select "Pass" and submit it, the student
                                                                        will pass and receive a certificate. This action cannot
                                                                        be reversed.
                                                                    </p>
                                                                    <form id="ementorExamForm">
                                                                        @csrf
                                                                        <div class="form-check mb-2">
                                                                            <input class="form-check-input" name="remark"
                                                                                type="radio" name="flexRadioDefault"
                                                                                id="flexRadioDefault1" value="1">
                                                                            <label class="form-check-label text-dark"
                                                                                for="flexRadioDefault1">
                                                                                Pass
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" name="remark"
                                                                                type="radio" name="flexRadioDefault"
                                                                                id="flexRadioDefault2" value="0">
                                                                            <label class="form-check-label text-dark"
                                                                                for="flexRadioDefault2">
                                                                                Fail
                                                                            </label>
                                                                        </div>
                                                                        <input class="" type="hidden" name="user_id"
                                                                            value="{{ base64_encode($ementorStudentData['studentData'][0]['user_id']) }}">
                                                                        <input class="" type="hidden" name="course_id"
                                                                            value="{{ base64_encode($ementorStudentData['studentData'][0]['course_id']) }}">
                                                                        <input class="" type="hidden" name="student_course_master_id" value="{{ base64_encode($ementorStudentData['studentData'][0]['student_course_master_id']) }}">
                                                                            
                                                                        <div id="error-message" class="text-danger mt-2" style="display:none;"></div>
                                                                        <button type="submit" id="ementorExamCheck"
                                                                            class="btn btn-primary mt-3">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                    </div>
                                                @endif


                                            </div>
                                        @endif
                                    @else
                                        @php
                                            $urlSegments = request()->segments();
                                            $user_id = $urlSegments[count($urlSegments) - 3];
                                            $course_id = $urlSegments[count($urlSegments) - 2];
                                            $student_course_master_id = $urlSegments[count($urlSegments) - 1];
                                            $studentCourseMaster = DB::table('student_course_master')
                                                ->where([
                                                    'user_id' => base64_decode($user_id),
                                                    'id' => base64_decode($student_course_master_id),
                                                ])
                                                ->latest()
                                                ->first();
                                        @endphp
                                        @if (isset($studentCourseMaster) && !empty($studentCourseMaster) && $studentCourseMaster->exam_attempt_remain == '1')
                                            @if ($studentCourseMaster->exam_remark == 0)
                                                <h4>First Attempt Result : <span
                                                        class="text-danger">
                                                        Failed</span></h4>
                                            @elseif($studentCourseMaster->exam_remark == 1)
                                                <h4>Final Result : <span
                                                        class="text-success">{{ $studentCourseMaster->exam_perc }}%
                                                        (Pass)</span></h4>
                                            @endif
                                        @elseif(isset($studentCourseMaster) && !empty($studentCourseMaster) && $studentCourseMaster->exam_attempt_remain == '0')
                                            @if ($studentCourseMaster->exam_remark == 0)
                                                <h4>Final Result : <span
                                                        class="text-danger">
                                                        Failed</span></h4>
                                            @elseif($studentCourseMaster->exam_remark == 1)
                                                <h4>Final Result : <span
                                                        class="text-success">{{ $studentCourseMaster->exam_perc }}%
                                                        (Pass)</span></h4>
                                            @endif
                                        @else
                                            <h4>The student has not attempted the exam yet.</h4>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </main>

    <script>
        $("#ementorExamCheck").on("click", function(event) {
            event.preventDefault();
            
            if ($('input[name="remark"]:checked').length === 0) {
                $('#error-message').text('Please select either Pass or Fail.').show();
            } else {
                $('#error-message').hide();

                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                var baseUrl = window.location.origin;
                var form = $("#ementorExamForm").serialize();
                // $(".save_loader").removeClass("d-none").addClass("d-block");
                $("#processingLoader").fadeIn();
                $.ajax({
                    url: baseUrl + "/ementor/exam-submit",
                    type: "POST",
                    data: form,
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function(response) {
                        // $(".save_loader").addClass("d-none").removeClass("d-block");
                        $("#processingLoader").fadeOut();
                        if (response.code === 200 || response.code === 201) {
                            $(".errors").remove();

                            // swal({
                            //     title: response.title,
                            //     text: response.message,
                            //     icon: response.icon,
                            // }).then(function() {
                            //     window.location.reload();
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
                        if (response.code === 202) {
                            var data = Object.keys(response.data);
                            var values = Object.values(response.data);

                            data.forEach(function(key) {
                                var value = response.data[key];
                                $(".errors").remove();
                                $("form")
                                    .find("[name='" + key + "']")
                                    .after(
                                        "<div class='invalid-feedback errors d-block'><i>" +
                                        value +
                                        "</i></div>"
                                    );
                            });
                        }
                    },
                });
                
            }
        });
    </script>

@endsection
