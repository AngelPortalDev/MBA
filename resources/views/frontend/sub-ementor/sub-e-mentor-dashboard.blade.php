@extends('frontend.master')
@section('content')
    <style>
        .sidenav.navbar .navbar-nav .e-men-1 > .nav-link {
        background-color: var(--gk-gray-200);
    }
    </style>

    <main>
        <section class="pt-5 pb-5">
            <div class="container">
                
                <!-- Top Menubar -->
                @include('frontend.sub-ementor.layout.sub-e-mentor-common')

                <!-- Content -->
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Card -->
                            <div class="card mb-4 e-mentor-card">
                                <div class="p-4">
                                    <span class="fs-6 text-uppercase fw-semibold">Total Amounts</span>
                                    <h2 class="mt-4 fw-bold mb-1 d-flex align-items-center h1 lh-1 total_amounts">€{{$data['totalAmounts']}}</h2>
                                    <span class="d-flex justify-content-between align-items-center">
                                        {{-- <span>Earning this month</span> --}}
                                        <span class="badge bg-success ms-2 total_amounts"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Card -->
                            <div class="card mb-4 e-mentor-card">
                                <div class="p-4">
                                    <span class="fs-6 text-uppercase fw-semibold">Approved Amounts</span>
                                    <h2 class="mt-4 fw-bold mb-1 d-flex align-items-center h1 lh-1 approved_amounts">€{{ $data['approvedAmounts'] }}</h2>
                                    <span class="d-flex justify-content-between align-items-center">
                                        {{-- <span>New this month</span> --}}
                                        <span class="badge bg-info ms-2 approved_amounts"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Card -->
                            <div class="card mb-4 e-mentor-card">
                                <div class="p-4">
                                    <span class="fs-6 text-uppercase fw-semibold">Pending Amounts</span>
                                    <h2 class="mt-4 fw-bold mb-1 d-flex align-items-center h1 lh-1  pending_amounts">€{{ $data['pendingAmounts'] }}</h2>
                                    <span class="d-flex justify-content-between align-items-center">
                                        {{-- <span>New this month</span> --}}
                                        <span class="badge bg-warning ms-2 pending_amounts"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="card mb-4">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="h4 mb-0">Best Selling Courses</h3>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table mb-0 table-hover table-centered text-nowrap">
                                <!-- Table Head -->
                                <thead class="table-light">
                                    <tr>
                                        <th>Courses</th>
                                        <th>Sales</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <!-- Table Body -->
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                </div>
                
            </div>
        </section>
    </main>
<script>
</script>
@endsection