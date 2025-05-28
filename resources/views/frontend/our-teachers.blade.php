@extends('frontend.master')
@section('content')
        <section class="py-8">
            <div class="container my-lg-4">
                <div class="row justify-content-center">
                    <!-- caption -->
                    <div class="col-lg-8 col-md-12 col-12">
                        <div class="mb-8 text-center">
                            <span class=" mb-3 d-block text-uppercase fw-semibold ls-xl">World-class Teachers</span>
                            <h2 class="mb-2 display-4 fw-bold color-blue">Classes Taught by Industry Experts</h2>
                            <p class="lead mb-0">E-Ascencia teachers are icons, experts, and industry rock stars excited to share their experience, wisdom, and trusted tools with you.</p>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    @php $TeacherData = getData('lecturers_master', ['lactrure_name','designation','image'],['category_id' => '1','is_deleted'=>'No'],'','created_at','asc');
                    @endphp
                    @foreach($TeacherData as $data)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                @if (isset($data->image) && !empty($data->image && Storage::disk('local')->exists($data->image)))
                                    <img src="{{Storage::url($data->image)}}" alt="img" class="card-img-top" >
                                @else
                                    <img src="{{Storage::url('teacherDocs/teacher-profile-photo.jpg')}}" alt="img" class="card-img-top">
                                    
                                @endif
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">{{isset($data->lactrure_name) ? $data->lactrure_name : ''}}</a></h3>
                                <p class="mb-1">{{isset($data->designation) ? $data->designation : ''}}</p>

                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/claire-photo.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Claire-Suzanne Borg</a></h3>
                                <p class="mb-1">Academic Director</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/italo-esposito-photo.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Italo Esposito</a></h3>
                                <p class="mb-1">Lecturer</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Matthew-photo.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Matthew John Chetcuti</a></h3>
                                <p class="mb-1">Lecturer</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/peter-photo.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Peter Medawar</a></h3>
                                <p class="mb-1">Lecturer</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Samantha-Lesseure-photo.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Samantha Leseurre</a></h3>
                                <p class="mb-1">Lecturer</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Daniel-Cassar-photo.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Daniel Cassar</a></h3>
                                <p class="mb-1">Lecturer</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Alison-Abela-photo.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Alison Abela</a></h3>
                                <p class="mb-1">Lecturer</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/andre-photo.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Andre Stivala</a></h3>
                                <p class="mb-1">Lecturer</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Susan-Nolan-photo.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Susan Nolan</a></h3>
                                <p class="mb-1">Lecturer</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/josianne-camilleri-photo.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Josianne Camilleri</a></h3>
                                <p class="mb-1">Lecturer</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/kim-spiteri.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Kim Spiteri  </a></h3>
                                <p class="mb-1">Lecturer</p>

                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>


        <!-- Inspiring Voices: Guest Speakers -->

        <section class="py-3">
            <div class="container my-lg-4">
                <div class="row justify-content-center">
                    <!-- caption -->
                    <div class="col-lg-8 col-md-12 col-12">
                        <div class="mb-8 text-center">
                            <h2 class="mb-2 display-4 fw-bold color-blue">Inspiring Voices: Guest Speakers</h2>
                            <p class="lead mb-0">Elevate Your Learning Experience with Expert Insights and Inspirational Talks</p>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row justify-content-center">
                    @php $TeacherData = getData('lecturers_master', ['lactrure_name','designation','image'],['category_id' => '2','is_deleted'=>'No'],'','created_at','asc');
                    @endphp

                    @foreach($TeacherData as $data)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                @if (isset($data->image) && !empty($data->image && Storage::disk('local')->exists($data->image)))
                                    <img src="{{Storage::url($data->image)}}" alt="img" class="card-img-top">
                                @else
                                    <img src="{{Storage::url('teacherDocs/teacher-profile-photo.jpg')}}" alt="img" class="card-img-top">  
                                @endif
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">{{isset($data->lactrure_name) ? $data->lactrure_name : ''}}</a></h3>
                                <p class="mb-1">{{isset($data->designation) ? htmlspecialchars_decode($data->designation) : ''}}</p>

                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Amy-Talbot-photo.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Amy Talbot</a></h3>
                                <p class="mb-1">Owner, Talbot & Bons</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Mariella-Baldacchino-photo.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Mariella Baldacchino</a></h3>
                                <p class="mb-1">Founder, Empleo</p>

                            </div>
                        </div>
                    </div> --}}


                    {{-- <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Darine-Aboulezz-Soft-Skills-Trainer.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Darine Aboulezz</a></h3>
                                <p class="mb-1">Soft Skills Trainer</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Alan-Mercieca-Bons-Business-Owner.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Alan Mercieca Bons</a></h3>
                                <p class="mb-1">Business Owner</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Karen-Gili-Expert-Training-and-Development.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Karen Gili</a></h3>
                                <p class="mb-1">HR Professional</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Manya-Russo-Project-Manager.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Manya Russo </a></h3>
                                <p class="mb-1">Project Manager, NGO</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Keith-Micallef-UHM-Voice-of-the-Workers.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Keith Micallef </a></h3>
                                <p class="mb-1 teacherDesignation">PA to the CEO, UHM Voice of the Worker</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Muriel-Grech-photo.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Muriel Grech</a></h3>
                                <p class="mb-1">Owner, MG Projects</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Margaret-Buhagiar-General-Manager.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Margaret Buhagiar</a></h3>
                                <p class="mb-1">General Manager, Salesian Press</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Simon-Agius-Muscat-Senior-Software-Engineer.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Simon Agius Muscat</a></h3>
                                <p class="mb-1">Senior Software Engineer</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Mathea-Cassar.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Mathea Cassar</a></h3>
                                <p class="mb-1">Digital Marketer</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Ben-Vincenti.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Ben Vincenti</a></h3>
                                <p class="mb-1">Co-Founder & Director, Tableo</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Gaetano-Caruana.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Gaetano Caruana</a></h3>
                                <p class="mb-1">Founder, EarlyParrot</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Joseph-Taliana.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Joseph Taliana</a></h3>
                                <p class="mb-1">Entrepreneur and Business Owner</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Nick-Xuereb.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Nick Xuereb</a></h3>
                                <p class="mb-1">Deputy President, The Malta Chamber</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Trevor-De-Giorgio.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Trevor De Giorgio</a></h3>
                                <p class="mb-1">Legal and Regulatory Consultant</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Andrew-Portelli.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Andrew Portelli</a></h3>
                                <p class="mb-1">Operations Manager, BUSINESSLABS</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Daniela-Mallia.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Daniela Mallia</a></h3>
                                <p class="mb-1">Accountant </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Gordon-Theobald.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a   class="text-inherit color-blue" onclick="return false">Gordon Theobald</a></h3>
                                <p class="mb-1">Founder, BUSINESSLABS</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Kari-Pisani.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a  class="text-inherit color-blue" onclick="return false">Kari Pisani</a></h3>
                                <p class="mb-1">Consultant, Financial Services</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Lawrence-Azzopardi.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a  class="text-inherit color-blue" onclick="return false">Lawrence Azzopardi</a></h3>
                                <p class="mb-1">Head Accreditation, Licensing, Validation and Quality Assurance, MFHEA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Henry-Zammit.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a  class="text-inherit color-blue" onclick="return false">Henry Zammit</a></h3>
                                <p class="mb-1">CEO & Co-founder, Elite</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <!-- card -->
                        <div class="card mb-4 card-hover">
                            <!-- img -->
                            <div>
                                <img src="{{ asset('frontend/images/team/Melissa-Manthos.jpg')}}" alt="img" class="card-img-top">
                            </div>
                            <!-- card body -->
                            <div class="card-body">
                                <h3 class="mb-0 fw-semibold"><a  class="text-inherit color-blue" onclick="return false">Melissa Manthos</a></h3>
                                <p class="mb-1">General Manager, Switch</p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>





@endsection
