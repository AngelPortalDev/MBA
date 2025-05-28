<!-- Header import -->
@extends('admin.layouts.main')
@section('content')


<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Payment Details</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="payment">Payment</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Payment Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-7 col-12">
            <!-- card -->
            <div class="card mb-4">
                <!-- card header -->
                <div class="card-header border-bottom-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <!-- heading -->
                            <h4 class="mb-1">Order ID: #GK00017</h4>
                            <span>
                                Order Date: October 03,2024 at 6:31 pm
                                <span class="badge bg-success-soft ms-2">Paid</span>
                            </span>
                        </div>
                        <div>
                            <!-- button -->
                            <a href="receipt" class="btn btn-primary btn-sm" target="_blank">Invoice</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Table -->
                    <table class="table mb-0 text-nowrap">
                        <!-- Table Head -->
                        <thead class="table-light">
                            <tr>
                                <th>Products</th>
                                <th>Items</th>
                                <th class="text-end">Amounts</th>
                            </tr>
                        </thead>
                        <!-- tbody -->
                        <tbody>
                            <tr>
                                <td>
                                    <a  class="text-inherit">
                                        <div class="d-lg-flex">
                                            <div>
                                                <img src="{{ asset('frontend/images/course/masters-human-resource-management.png')}}" alt="" class="img-4by3-md rounded">
                                            </div>
                                            <div class="ms-lg-3 mt-2 mt-lg-0">
                                                <h5 class="mb-0">Masters of Arts in Human Resource Management</h5>
                                                <span class="fs-6">
                                                    ECTS: <span class="text-dark fw-medium">90 &nbsp;</span>
                                                </span>
                                                
                                                <span class="fs-6">
                                                    Modules: <span class="text-dark fw-medium">9 &nbsp;</span>
                                                </span>
                                                <span class="fs-6">
                                                    Lectures: <span class="text-dark fw-medium">123 </span>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                                <td>1</td>
                                <td class="text-end">€5000 </td>
                            </tr>
                            <tr>
                                <td>
                                    <a  class="text-inherit">
                                        <div class="d-lg-flex">
                                            <div>
                                                <img src="{{ asset('frontend/images/course/award-recruitment-and-employee-selection.png')}}" alt="" class="img-4by3-md rounded">
                                            </div>
                                            <div class="ms-lg-3 mt-2 mt-lg-0">
                                                <h5 class="mb-0">Award in Recruitment and Employee Selection</h5>
                                                <span class="fs-6">
                                                    ECTS: <span class="text-dark fw-medium">6 &nbsp;</span>
                                                </span>
                                                
                                                <span class="fs-6">
                                                    Modules: <span class="text-dark fw-medium">1 &nbsp;</span>
                                                </span>
                                                <span class="fs-6">
                                                    Lectures: <span class="text-dark fw-medium">23 </span>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                                <td>1</td>
                                <td class="text-end">€500 </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0 pb-0"></td>
                                <td colspan="1" class="fw-medium text-dark border-bottom-0 pb-0">
                                    <!-- text -->
                                    Sub Total :
                                </td>
                                <td class="fw-medium text-dark border-bottom-0 pb-0 text-end">
                                    <!-- text -->
                                    €5500
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0 pb-0"></td>
                                <td colspan="1" class="fw-medium text-dark border-bottom pb-2">
                                    <!-- text -->
                                    Discount (GKDIS15%) :
                                </td>
                                <td class="fw-medium text-dark border-bottom pb-2 text-end">
                                    <!-- text -->
                                    -€50
                                </td>
                            </tr>


                            <tr>
                                <td></td>
                                <td colspan="1" class="fw-semibold text-dark">
                                    <!-- text -->
                                    Paid by Student
                                </td>
                                <td class="fw-semibold text-dark text-end">
                                    <!-- text -->
                                    €5450
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- card -->
            <div class="card">
            <!-- card body -->
            <div class="card-body">
                <div class="mb-3">
                    <h4 class="mb-0">Payment Details</h4>
                </div>
                <!-- text -->
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span>Transactions Id:</span>
                    <span class="text-dark">#GK444TO10000</span>
                </div>
                <!-- text -->
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span>Payment Method:</span>
                    <span class="text-dark">Credit Card</span>
                </div>
                <!-- text -->
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span>Card Holder Name:</span>
                    <span class="text-dark">Harold Gonzalez</span>
                </div>
                <!-- text -->
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span>Card Number:</span>
                    <span class="text-dark">xxxx xxxx xxxx 6779</span>
                </div>
                <!-- text -->
                <div class="d-flex align-items-center justify-content-between">
                    <span>Total Amount:</span>
                    <span class="text-dark fw-bold">€5450</span>
                </div>
            </div>
        </div>
        </div>


        <div class="col-xl-4 col-lg-5 col-12">
            <!-- card -->
            <div class="card mb-4 mt-4 mt-lg-0">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Student</h4>
                        <a href="#">View Profile</a>
                    </div>
                    <div class="d-flex align-items-center">
                        <!-- img -->
                        <img src="{{ asset('frontend/images/avatar/avatar-12.jpg')}}" class="avatar-lg rounded-circle" alt="">
                        <div class="ms-3">
                            <!-- title -->
                            <h4 class="mb-0">Harold Gonzalez</h4>
                            <div>
                                <span>Student since April 5,2023</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card body -->
                <div class="card-body border-top">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <!-- text -->
                        <h4 class="mb-0">Contact</h4>
                    </div>
                    <div>
                        <!-- text -->
                        <div class="d-flex align-items-center mb-2">
                            <i class="fe fe-mail fs-4"></i>
                            <a href="#" class="ms-2">haroldonzalez@gmail.com</a>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fe fe-phone fs-4"></i>
                            <span class="ms-2">+(000) 123465 987</span>
                        </div>
                    </div>
                </div>
                <!-- card body -->
                <div class="card-body border-top">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Shipping Address</h4>
                    </div>
                    <div>
                        <!-- address -->
                        <p class="mb-0">
                            3812 Orchard Street, Bloomington,
                            <br>
                            Minnesota 55431, United States

                        </p>
                    </div>
                </div>
                <!-- card body -->
                <div class="card-body border-top">
                    <div class="mb-3">
                        <!-- heading -->
                        <h4 class="mb-0">Billing Address</h4>
                    </div>
                    <div>
                        <!-- address -->
                        <p class="mb-0">
                            3812 Orchard Street, Bloomington,
                            <br>
                            Minnesota 55431, United States

                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
</main>


@endsection
