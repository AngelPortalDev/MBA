@extends('frontend.master')
@section('content')
     
<style>
    .card:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease-in-out;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .card-img-top {
        /* height: 180px;
        object-fit: contain;
        margin-top: 10px;
        border-bottom: 0.5px solid lightgray; */
        height: 180px;
        object-fit: contain;
        margin-top: 10px;
        border-bottom: 0.5px solid lightgray;
        transition: transform 0.3s ease-in-out;
    }
    .card-body{
        padding: 20px;
        height: 120px;
    }
    .card-title{
        color: #2b3990;
        text-align: left;
        font-size: 18px;
        line-height: 24px;
    }
    .locationtitle{
        text-align: left;
    }
    .card {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border-radius: 8px; 
    }
        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: #2b3990; 
            transform: scaleY(0);
            transform-origin: top;
            transition: transform 0.2s ease-in-out;
            border-top-left-radius: 8px; 
            border-top-right-radius: 8px;
        }

        .card:hover  {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card:hover::before {
            transform: scaleY(1);
        }

</style>

        <!-- Our Partners -->

        <section class="py-3">
            <div class="container my-lg-4">
                <div class="row justify-content-center">
                    <!-- caption -->
                    <div class="col-lg-8 col-md-12 col-12">
                        <div class="mb-8 text-center">
                            <h2 class="mb-2 display-4 fw-bold color-blue">Our Partner Colleges
                            </h2>
                            <p class="lead mb-0">Explore our network of esteemed partner colleges, dedicated to providing top-tier education, expert insights, and transformative learning experiences.</p>
                        </div>
                    </div>
                </div>

                @php
                    $institutes = DB::table('institute_profile_master')
                        ->join('users', 'institute_profile_master.institute_id', '=', 'users.id')
                        ->where('institute_profile_master.is_approved', 1)
                        ->where('users.is_active', 'Active')
                        ->where('users.is_deleted', 'No')
                        ->select('institute_profile_master.*', 'users.name', 'users.last_name', 'users.photo')
                        ->get();
                @endphp
            
                <!-- row -->
                <div class="row justify-content-center">
                    {{-- @foreach($institutes as $institute)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <!-- card -->
                            <div class="card mb-4 card-hover">
                                <!-- img -->
                                <div>
                                        <img src="{{ Storage::url($institute->logo) }}" alt="img" class="card-img-top" style="border-bottom: 1px solid lightgray">
                                </div>
                                <!-- card body -->
                                <div class="card-body">
                                    <h3 class="mb-0 fw-semibold">{{ $institute->name }}</h3>
                                    <p class="mb-1">{{ $institute->billing_country }}</p>

                                </div>
                            </div>
                        </div>
                    @endforeach --}}
                  
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                            <!-- Card Template -->

                            @if(count($institutes) > 0)
                                @foreach($institutes as $institute)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                        <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
                                            @if (!empty($institute->photo))
                                                <img src="{{ Storage::url($institute->photo) }}" class="card-img-top" alt="{{ $institute->name }}">
                                            @elseif(!empty($institute->logo))
                                                <img src="{{ Storage::url($institute->logo) }}" class="card-img-top" alt="{{ $institute->name }}">
                                            @else
                                                <img src="{{asset('frontend/images/colleges/Institute.jpg')}}" class="card-img-top" alt="{{ $institute->name }}">
                                            @endif
                                            <div class="card-body text-center">
                                                <h5 class="card-title fw-semibold mb-1">{{ $institute->name }}</h5>
                                                <p class="text-muted mb-0 locationtitle"> <i class="bi bi-geo-alt-fill"></i> {{ $institute->billing_country }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                    <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
                                        <img src="{{ asset('frontend/images/colleges/Ecole.jpg') }}" class="card-img-top" alt="Ecole Conte">
                                        <div class="card-body text-center">
                                            <h5 class="card-title fw-semibold mb-1"> Ecole Conte</h5>
                                            <p class="text-muted mb-0 locationtitle"> <i class="bi bi-geo-alt-fill"></i> France</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                    <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
                                        <img src="{{ asset('frontend/images/colleges/digital.jpg') }}" class="card-img-top" alt="Business Project College">
                                        <div class="card-body text-center">
                                            <h5 class="card-title fw-semibold mb-1">Digital College</h5>
                                            <p class="text-muted mb-0 locationtitle"> <i class="bi bi-geo-alt-fill"></i> France</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                   
                    </div>
                </div>
            </div>
        </section>





@endsection
