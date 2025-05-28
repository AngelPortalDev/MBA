<!-- Header import -->
@extends('admin.layouts.main')
@section('content')


    <!-- Container fluid -->
    <section class="container-fluid p-4">
        <div class="row justify-content-between ">
            <!-- Page Header -->
            <div class="col-lg-4 col-12">
                <div class=" pb-3 mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Payments
                            <span class="fs-5 counts"></span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Payments</a></li>
                                <!-- <li class="breadcrumb-item active" aria-current="page">All Admin</li> -->
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">


                    </div>
                </div>
            </div>

            <form id="exportForm" action="{{ route('export') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="category" value="all">
                <input type="hidden" name="where" value="">
                <input type="hidden" name="export" value="paymentData">
            </form>
            
            <!-- <form class="d-flex align-items-center col-12 col-lg-3"> -->
                <div class="col-lg-8 col-12 text-end pt-2 mb-0 mb-sm-3">
                    <div class="d-sm-flex justify-content-sm-end">
                          <!-- Button With Icon -->
                 
                        {{-- <button type="button" class="btn btn-outline-primary ">
                            Delete <i class="fe fe-trash ms-1"></i>
                        </button> --}}
                        {{-- <button type="button" class="btn btn-outline-primary ">
                            Import <i class="fe fe-download ms-1"></i>
                        </button> --}}
                        
                       <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">
                            <a href="#" id="exportButton" data-route="{{route('payment-export')}}" class="btn btn-outline-primary">
                                Export <i class="fe fe-upload ms-1"></i>
                            </a>
                       </div>
                         {{-- <button type="button" class="btn btn-outline-primary" href="{{ route('payment-export') }}">
                            Export <i class="fe fe-upload ms-1"></i>
                        </button> --}}
                       <div class="d-grid d-sm-block ms-2 d-md-0 mt-2 mt-md-0">

                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentLinkModal" id="payment-link-modal">
                            Payment Link 
                        </button> --}}
                       </div>
                    </div>
                </div>


        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 mt-3 mt-lg-0 mt-0">
                <!-- Card -->
                <div class="card rounded-3">
                    <!-- Card Header -->
                    <div class="p-4 row">
                        <div class="card-header p-0 col-12 col-md-7 col-lg-7">
                            <ul class="nav nav-lb-tab border-bottom-0" id="tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active section-payment-tab"  data-cat="all" data-bs-toggle="pill" href="#all-payments" role="tab" aria-controls="all-payments" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-payment-tab"  data-cat="Paid" data-bs-toggle="pill" href="#success" role="tab" aria-controls="success" aria-selected="false" tabindex="-1">Success</a>
                                </li>
                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link section-payment-tab"  data-cat="Hold" data-bs-toggle="pill" href="#hold" role="tab" aria-controls="hold" aria-selected="false" tabindex="-1">Hold</a>
                                </li> --}}
                                

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link section-payment-tab" data-cat="Failed" data-bs-toggle="pill" href="#failed" role="tab" aria-controls="failed" aria-selected="false" tabindex="-1">Failed</a>
                                </li>
                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link section-payment-tab" data-cat="Refund" data-bs-toggle="pill" href="#refund" role="tab" aria-controls="refund" aria-selected="false" tabindex="-1">Refund</a>
                                </li> --}}
                            </ul>
                        </div>

                    
                        <!-- Form -->

                       
                        <div class="d-flex align-items-center col-12 col-md-5 col-lg-5 justify-content-end border-bottom">
                            <div class="row justify-content-end">
                                <form class="d-flex align-items-center col-lg-8 mt-3 mt-md-0 mb-3 mb-md-0 w-100">
                                    <span class="position-absolute ps-3 search-icon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <input type="search" class="form-control ps-6 SearchPayment" id="searchInput" placeholder="Search Here">
                                </form>

                            
                                <!-- input -->
                                {{-- <div class="col-auto">
                                    <!-- form select -->
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected="">Filter</option>
                                        <option value="Newest">Newest</option>
                                        <option value="Price: High-Low">Success</option>
                                        <option value="Price: Low-High">Pending</option>
                                        <option value="Price: Low-High">Delected</option>
                                        <option value="Price: Low-High">Award</option>
                                        <option value="Price: Low-High">Certificate</option>
                                        <option value="Price: Low-High">Diploma</option>
                                        <option value="Price: Low-High">Masters</option>
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                    </div>



                    <div>
                        <div class="tab-content" id="tabContent">
                            <!-- Tab -->

                            <!-- All Students Tab  -->
                            <div class="tab-pane fade active show" role="tabpanel" aria-labelledby="all-payments-tab">
                                <div class="table-responsive">

                                    <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox paymentList w-100" width="100%">
                                        <!-- Table Head -->
                                        <thead class="table-light">
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                                        <label class="form-check-label" for="checkAll"></label>
                                                    </div>
                                                </th>
                                                <th>Sr No.</th>
                                                <th>Order ID</th>
                                                <th>Student Name</th>
                                                <th>Course Name</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Table body -->
                                             {{-- <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="orderOne">
                                                        <label class="form-check-label" for="orderOne"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    <a href="payment-details" class="fw-semibold">#GK00017</a>
                                                </td>
                                                <td>Harold Gonzalez</td>
                                                <td><span class="badge text-success bg-light-success">Success</span></td>
                                                <td>Award in Recruitment and Employee Selection</td>
                                                <td>
                                                    €500
                                                </td>
                                                <td>24 July, 2025</td>

                                                <td>
                                                    <span class="dropdown dropstart">
                                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                            <span class="dropdown-header">Settings</span>
    
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-mail dropdown-item-icon"></i>
                                                                Mail
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                                Print
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Delete
                                                            </a>

                                                        </span>
                                                    </span>
                                                </td> --}}
                                           {{-- </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="orderOne">
                                                        <label class="form-check-label" for="orderOne"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    2
                                                </td>
                                                <td>
                                                    <a href="payment-details" class="fw-semibold">#FD$#$34</a>
                                                </td>
                                                <td>Mac Demon</td>
                                                <td><span class="badge text-warning bg-light-warning">Pending</span></td>
                                                <td>Award in Recruitment and Employee Selection</td>
                                                <td>
                                                    €500
                                                </td>
                                                <td>24 July, 2025</td>

                                                <td>
                                                    <span class="dropdown dropstart">
                                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                            <span class="dropdown-header">Settings</span>
    
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-mail dropdown-item-icon"></i>
                                                                Mail
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                                Print
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Delete
                                                            </a>

                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="orderOne">
                                                        <label class="form-check-label" for="orderOne"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    3
                                                </td>
                                                <td>
                                                    <a href="payment-details" class="fw-semibold">#BG00054</a>
                                                </td>
                                                <td>James KH</td>
                                                <td><span class="badge text-danger bg-light-danger">Failed</span></td>
                                                <td>Award in Recruitment and Employee Selection</td>
                                                <td>
                                                    €500
                                                </td>
                                                <td>24 July, 2025</td>

                                                <td>
                                                    <span class="dropdown dropstart">
                                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                            <span class="dropdown-header">Settings</span>
    
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-mail dropdown-item-icon"></i>
                                                                Mail
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                                Print
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Delete
                                                            </a>

                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="orderOne">
                                                        <label class="form-check-label" for="orderOne"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    4
                                                </td>
                                                <td>
                                                    <a href="payment-details" class="fw-semibold">#GK00017</a>
                                                </td>
                                                <td>Harold Gonzalez</td>
                                                <td><span class="badge text-success bg-light-success">Success</span></td>
                                                <td>Award in Recruitment and Employee Selection</td>
                                                <td>
                                                    €500
                                                </td>
                                                <td>24 July, 2025</td>

                                                <td>
                                                    <span class="dropdown dropstart">
                                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                            <span class="dropdown-header">Settings</span>
    
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-mail dropdown-item-icon"></i>
                                                                Mail
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                                Print
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Delete
                                                            </a>

                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="orderOne">
                                                        <label class="form-check-label" for="orderOne"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    5
                                                </td>
                                                <td>
                                                    <a href="payment-details" class="fw-semibold">#FD$#$34</a>
                                                </td>
                                                <td>Mac Demon</td>
                                                <td><span class="badge text-warning bg-light-warning">Pending</span></td>
                                                <td>Award in Recruitment and Employee Selection</td>
                                                <td>
                                                    €500
                                                </td>
                                                <td>24 July, 2025</td>

                                                <td>
                                                    <span class="dropdown dropstart">
                                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                            <span class="dropdown-header">Settings</span>
    
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-mail dropdown-item-icon"></i>
                                                                Mail
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                                Print
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Delete
                                                            </a>

                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="orderOne">
                                                        <label class="form-check-label" for="orderOne"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    6
                                                </td>
                                                <td>
                                                    <a href="payment-details" class="fw-semibold">#BG00054</a>
                                                </td>
                                                <td>James KH</td>
                                                <td><span class="badge text-danger bg-light-danger">Failed</span></td>
                                                <td>Award in Recruitment and Employee Selection</td>
                                                <td>
                                                    €500
                                                </td>
                                                <td>24 July, 2025</td>

                                                <td>
                                                    <span class="dropdown dropstart">
                                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                            <span class="dropdown-header">Settings</span>
    
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-mail dropdown-item-icon"></i>
                                                                Mail
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                                Print
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Delete
                                                            </a>

                                                        </span>
                                                    </span>
                                                </td>
                                            </tr> --}}

                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <!-- Success Payments Tab  -->
                            {{-- <div class="tab-pane fade" id="success" role="tabpanel" aria-labelledby="success-tab"  width="100%"> --}}
                            {{-- <div class="table-responsive">
                                    <!-- Table -->

                                    <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox paymentList">
                                        <!-- Table Head -->
                                        <thead class="table-light">
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                                        <label class="form-check-label" for="checkAll"></label>
                                                    </div>
                                                </th>
                                                <th>Sr No.</th>
                                                <th>Order ID</th>
                                                <th>Student Name</th>
                                                <th>Payment</th>
                                                <th>Course Name</th>
                                                <th>Total</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Table body -->
                                            {{-- <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="orderOne">
                                                        <label class="form-check-label" for="orderOne"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    <a href="payment-details" class="fw-semibold">#GK00017</a>
                                                </td>
                                                <td>Harold Gonzalez</td>
                                                <td><span class="badge text-success bg-light-success">Success</span></td>
                                                <td>Award in Recruitment and Employee Selection</td>
                                                <td>
                                                    €500
                                                </td>
                                                <td>24 July, 2025</td>

                                                <td>
                                                    <span class="dropdown dropstart">
                                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                            <span class="dropdown-header">Settings</span>
    
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-mail dropdown-item-icon"></i>
                                                                Mail
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                                Print
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Delete
                                                            </a>

                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="orderOne">
                                                        <label class="form-check-label" for="orderOne"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    2
                                                </td>
                                                <td>
                                                    <a href="payment-details" class="fw-semibold">#FD$#$34</a>
                                                </td>
                                                <td>Mac Demon</td>
                                                <td><span class="badge text-success bg-light-success">Success</span></td>
                                                <td>Award in Recruitment and Employee Selection</td>
                                                <td>
                                                    €500
                                                </td>
                                                <td>24 July, 2025</td>

                                                <td>
                                                    <span class="dropdown dropstart">
                                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                            <span class="dropdown-header">Settings</span>
    
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-mail dropdown-item-icon"></i>
                                                                Mail
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                                Print
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Delete
                                                            </a>

                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="orderOne">
                                                        <label class="form-check-label" for="orderOne"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    3
                                                </td>
                                                <td>
                                                    <a href="payment-details" class="fw-semibold">#BG00054</a>
                                                </td>
                                                <td>James KH</td>
                                                <td><span class="badge text-success bg-light-success">Success</span></td>
                                                <td>Award in Recruitment and Employee Selection</td>
                                                <td>
                                                    €500
                                                </td>
                                                <td>24 July, 2025</td>

                                                <td>
                                                    <span class="dropdown dropstart">
                                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                            <span class="dropdown-header">Settings</span>
    
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-mail dropdown-item-icon"></i>
                                                                Mail
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                                Print
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Delete
                                                            </a>

                                                        </span>
                                                    </span>
                                                </td>
                                            </tr> --}}

                                        {{-- </tbody>
                                    </table>
                                </div>
                            </div> --}} 

                            <!-- Pending Payments Tab  -->
                            {{-- <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                            <div class="table-responsive">
                                    <!-- Table -->

                                    <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox paymentList">
                                        <!-- Table Head -->
                                        <thead class="table-light">
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                                        <label class="form-check-label" for="checkAll"></label>
                                                    </div>
                                                </th>
                                                <th>Sr No.</th>
                                                <th>Order ID</th>
                                                <th>Student Name</th>
                                                <th>Payment</th>
                                                <th>Course Name</th>
                                                <th>Total</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="orderOne">
                                                        <label class="form-check-label" for="orderOne"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    <a href="payment-details" class="fw-semibold">#GK00017</a>
                                                </td>
                                                <td>Harold Gonzalez</td>
                                                <td><span class="badge text-warning bg-light-warning">Pending</span></td>
                                                <td>Award in Recruitment and Employee Selection</td>
                                                <td>
                                                    €500
                                                </td>
                                                <td>24 July, 2025</td>

                                                <td>
                                                    <span class="dropdown dropstart">
                                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                            <span class="dropdown-header">Settings</span>
    
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-mail dropdown-item-icon"></i>
                                                                Mail
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                                Print
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Delete
                                                            </a>

                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="orderOne">
                                                        <label class="form-check-label" for="orderOne"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    2
                                                </td>
                                                <td>
                                                    <a href="payment-details" class="fw-semibold">#FD$#$34</a>
                                                </td>
                                                <td>Mac Demon</td>
                                                <td><span class="badge text-warning bg-light-warning">Pending</span></td>
                                                <td>Award in Recruitment and Employee Selection</td>
                                                <td>
                                                    €500
                                                </td>
                                                <td>24 July, 2025</td>

                                                <td>
                                                    <span class="dropdown dropstart">
                                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                            <span class="dropdown-header">Settings</span>
    
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-mail dropdown-item-icon"></i>
                                                                Mail
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                                Print
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Delete
                                                            </a>

                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="orderOne">
                                                        <label class="form-check-label" for="orderOne"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    3
                                                </td>
                                                <td>
                                                    <a href="payment-details" class="fw-semibold">#BG00054</a>
                                                </td>
                                                <td>James KH</td>
                                                <td><span class="badge text-warning bg-light-warning">Pending</span></td>
                                                <td>Award in Recruitment and Employee Selection</td>
                                                <td>
                                                    €500
                                                </td>
                                                <td>24 July, 2025</td>

                                                <td>
                                                    <span class="dropdown dropstart">
                                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                        <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                            <span class="dropdown-header">Settings</span>
    
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-mail dropdown-item-icon"></i>
                                                                Mail
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                                Print
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                                Delete
                                                            </a>

                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}

                            <!-- Failed Payments Tab  -->
                            {{-- <div class="tab-pane fade" id="failed" role="tabpanel" aria-labelledby="failed-tab">
                            <div class="table-responsive">
                                    <!-- Table -->
                                    <!-- <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox table-centered table-hover"> -->

                                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox paymentList">
                                            <!-- Table Head -->
                                            <thead class="table-light">
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Sr No.</th>
                                                    <th>Order ID</th>
                                                    <th>Student Name</th>
                                                    <th>Payment</th>
                                                    <th>Course Name</th>
                                                    <th>Total</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Table body -->
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="orderOne">
                                                            <label class="form-check-label" for="orderOne"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>
                                                        <a href="payment-details" class="fw-semibold">#GK00017</a>
                                                    </td>
                                                    <td>Harold Gonzalez</td>
                                                    <td><span class="badge text-danger bg-light-danger">Failed</span></td>
                                                    <td>Award in Recruitment and Employee Selection</td>
                                                    <td>
                                                        €500
                                                    </td>
                                                    <td>24 July, 2025</td>
    
                                                    <td>
                                                        <span class="dropdown dropstart">
                                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                <i class="fe fe-more-vertical"></i>
                                                            </a>
                                                            <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                                <span class="dropdown-header">Settings</span>
        
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-mail dropdown-item-icon"></i>
                                                                    Mail
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                                                    Print
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                                    Delete
                                                                </a>
    
                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="orderOne">
                                                            <label class="form-check-label" for="orderOne"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        2
                                                    </td>
                                                    <td>
                                                        <a href="payment-details" class="fw-semibold">#FD$#$34</a>
                                                    </td>
                                                    <td>Mac Demon</td>
                                                    <td><span class="badge text-danger bg-light-danger">Failed</span></td>
                                                    <td>Award in Recruitment and Employee Selection</td>
                                                    <td>
                                                        €500
                                                    </td>
                                                    <td>24 July, 2025</td>
    
                                                    <td>
                                                        <span class="dropdown dropstart">
                                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                <i class="fe fe-more-vertical"></i>
                                                            </a>
                                                            <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                                <span class="dropdown-header">Settings</span>
        
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-mail dropdown-item-icon"></i>
                                                                    Mail
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                                                    Print
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                                    Delete
                                                                </a>
    
                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="orderOne">
                                                            <label class="form-check-label" for="orderOne"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        3
                                                    </td>
                                                    <td>
                                                        <a href="payment-details" class="fw-semibold">#BG00054</a>
                                                    </td>
                                                    <td>James KH</td>
                                                    <td><span class="badge text-danger bg-light-danger">Failed</span></td>
                                                    <td>Award in Recruitment and Employee Selection</td>
                                                    <td>
                                                        €500
                                                    </td>
                                                    <td>24 July, 2025</td>
    
                                                    <td>
                                                        <span class="dropdown dropstart">
                                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                                <i class="fe fe-more-vertical"></i>
                                                            </a>
                                                            <span class="dropdown-menu" aria-labelledby="orderDropdownOne">
                                                                <span class="dropdown-header">Settings</span>
        
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-mail dropdown-item-icon"></i>
                                                                    Mail
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                                                    Print
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                                    Delete
                                                                </a>
    
                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>
    
                                            </tbody>
                                        </table>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <!-- Card Footer -->
                    {{-- <div class="card-footer">
                        <nav>
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link mx-1 rounded" href="#" tabindex="-1" aria-disabled="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z">
                                        </path></svg>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                        </path></svg>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true" id="paymentLinkModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="taskModalLabel">Payment Link</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="FormData">
                        <form class="row needs-validation paymentForm" novalidate>
                            <div class="mb-2 col-12">
                                <label for="FirstName" class="form-label">Student Name <span class="text-danger">*</span></label>
                                <select class="form-select user_id" name="user_id" aria-label="Default select example" id="user_id">
                                    <option value="">Select Student</option>
                                    @foreach (getDropDownlist('users',['id','name','last_name','email'],['role'=>'user','is_active'=>'Active']) as $users)
                                    <option value="{{base64_encode($users->id)}}">{{$users->name.' '.$users->last_name.' '.$users->email}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="user_name_error">Please select student name.</div>
                            </div>
                            <div class="mb-2 col-12">
                                <label for="LastName" class="form-label">Course Name <span class="text-danger">*</span></label>
                                <select class="form-select course_id" name="course_id" aria-label="Default select example" id="course_id">
                                <option value="">Select Course</option>
                                @php 
                                $data = DB::table('course_master')
                                    ->select('id', 'course_title')
                                    ->where('category_id', 1)
                                    ->whereIn('status', [1, 3])
                                    ->orderBy('id', 'DESC')
                                    ->get();
                                @endphp
                                @foreach ($data as $courses)
                                    <option value="{{base64_encode($courses->id)}}">{{$courses->course_title}}</option>
                                @endforeach
                                </select>
                                <div class="invalid-feedback" id="course_name_error">Please select course.</div>
                            </div>
                            <div class="mb-2 col-12 row">
                                <label class="form-label" for="amount">Amount<span class="text-danger">*</span></label>
                                {{-- <div class="row">  --}}
                                <input type="text" class="form-control currenecy"  id="currenecy" name="currenecy" value="€" style="width:11%;margin-left:12px;" disabled />
                                <input type="number" class="form-control amount" placeholder="Enter Amount" id="amount" name="amount" required style="width:86%;"/>
                                <div class="invalid-feedback" id="payment_amount_error">Please enter your amount.</div>
                                {{-- </div> --}}
                            </div>
                           

                            <div class="col-12 d-flex justify-content-end pt-2">
                                <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="generatePaymentLink">Generate Link</button>
                            </div>
                        </form>
                        </div>
                        <div class="SumbitUrl d-none">
                            <label class="form-label" for="amount">Payment URL Link</label>
                            <textarea class="form-control pay_url" id="pay_url" rows="8" cols="9"></textarea>
                            <br>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary LinkOk">Ok</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="{{ asset('admin/js/export.js')}}"></script>
<script>
    $(document).ready(function () {
        paymentList("all");
        handleSearchInput('searchInput', paymentList);
     
    });
    $('#paymentLinkModal').on('shown.bs.modal', function () {
    // Any code you want to run when modal opens
        $(".modal-body .SumbitUrl").addClass("d-none");
        $(".modal-body .FormData").removeClass("d-none")
        $("#amount").val('');
        $("#course_id").val('');
        $("#user_id").val('');

        console.log("Modal is open");
    });
    $(".section-payment-tab").on("click", function (event) {
            paymentList($(this).data("cat"));
    });
    $('#checkAll').click(function (e) {
        $('.paymentList tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });
    $('.SearchPayment').on('keyup', function() {
        var table = $('.paymentList').DataTable();
        var searchTerm = $(this).val();
        table.search(searchTerm).draw();
    });
    function paymentList(cat) {
        $("#processingLoader").fadeIn();
        var baseUrl = window.location.origin + "/";
        $.ajax({
            url: baseUrl + "admin/payments-get-data/" + cat,
            method: "GET",
            success: function (data) {
                $("#processingLoader").fadeOut();
                $(".paymentList").DataTable().destroy();
                $(".counts").html("(" + data.length + ")");
                $(".paymentList").DataTable({
                    data: data, // Pass
                    columns: [
                        {
                            data: "id",
                            render: function (data, type, full, meta) {
                                var PaymentId = btoa(full.id);
                                var isChecked = full.checked ? "checked" : "";
                                return (
                                    '<form class="actionData"><input type="checkbox" class="form-check-input checkbox sub_chk " name="userId[]" value="' +
                                    PaymentId +
                                    '" ' +
                                    isChecked +
                                    "></form>"
                                );
                            },
                            width:'0%'
                        },
                        {
                            data: null,
                            render: function (data, type, full, row) {
                                i = row.row + 1;
                                return i;
                            },
                            width:'10%'
                        },
                        {
                            data: null,
                            render: function (row) {
                            var idEncoded = btoa(row.id); // Base64 encode the ID
                            var actionEncoded = btoa('invoice'); // Base64 encode the action

                            var downloadUrl = baseUrl + 'admin/download-invoice/' + idEncoded + '/' + actionEncoded;
                            if(row.refund_data == '' && row.status != '1'){
                                var link = '<a href="' + downloadUrl + '">#' + row.uni_order_id + '</a>';
                            }else{
                                var link =   row.uni_order_id;
                            }

                            return link;
                                // var name = row.name;
                                // var img = row.photo ? baseUrl + 'storage/' + row.photo : baseUrl + '/storage/studentDocs/no_image_student.png';
                                
                                // return '#' + row.uni_order_id;
                            },
                            width:'20%'
                        },
                        {
                            data: null,
                            render: function (data) {
                                var name = 'NA';
                                if(data.user_data){
                                    name = data.user_data.name+' '+data.user_data.last_name;
                                }
                                return  name;
                            },
                            width:'20%'
                        },
                        {
                            data: null,
                            render: function (row) {
                                var courseTitle = '';

                                if (row.order_data && row.order_data.length > 0) {
                                    courseTitle = row.order_data[0]['course_title'];
                                }

                                // Wrap the course title in a <p> tag
                                return '<p class="text-wrap-title">' + courseTitle + '</p>';
                            },
                            width: '20%'
                        },
                        {
                            data: null,
                            render: function (row) {
                                var total_amount = '';
                                if (row.order_data && row.order_data.length > 0) {
                                    total_amount = row.order_data[0].course_price;
                                    if(row.order_data[0].promo_code_discount){
                                        total_amount = row.order_data[0].course_price - row.order_data[0].promo_code_discount;
                                    }
                                }
                                return Math.round(total_amount);
                            },
                            width:'10%'
                        },
                        {
                            data: null,
                            render: function (row) {
                                const today = new Date();
                                const year = today.getFullYear();
                                const month = String(today.getMonth() + 1).padStart(2, '0');
                                const day = String(today.getDate()).padStart(2, '0');

                                var current_date = year+'-'+month+'-'+day;
                                // let addedDays = 0;

                                // while (addedDays < 7) {
                                //     currentDate.setDate(currentDate.getDate() + 1);
                                //     // Skip weekends
                                //     if (currentDate.getDay() !== 6 && currentDate.getDay() !== 0) {
                                //         addedDays++;
                                //     }
                                // }


                                if (row.status == '0') {
                                    // if(row.hold_date <= current_date){
                                        return '<span class="badge text-success bg-light-success">Success</span>';
                                    // }else{
                                    //     return '<span class="badge text-warning bg-light-warning">Hold</span>';
                                    // }
                                }
                                if (row.status == '1') {
                                    return '<span class="badge text-danger bg-light-danger">Failed</span>';
                                }
                                if (row.status == '2') {
                                    return '<span class="badge text-white bg-warning">Refunded</span>';
                                }
                               
                            },
                            width:'10%'
                        },
                        {
                            data: null,
                            render: function (row) {
                              return row.created_at;
                            },
                            width:'5%'
                        },
                        // {
                        //     data: null,
                        //     render: function (row) {
                        //         message = 'Refund';
                        //         payment_id = row.id;
                        //         payment_refund_id = '';
                        //         var html= '';
                                
                        //         if(row.refund_data == ''){
                        //             if(row.status != '1'){
                                        
                        //                 var html = '<div class="hstack gap-3"><a class="dropdown-item refund btn btn-primary" href="#" data-payment_id="'+btoa(payment_id)+'" data-payment_refund_id="'+btoa(payment_refund_id)+'" >Refund</a>';
                        //             }
                        //         }else{
                        //             var html = '<a></a>';
                        //         }
                        //     // html += '<span class="dropdown dropstart"><a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false"><i class="fe fe-more-vertical"></i></a><span class="dropdown-menu" aria-labelledby="orderDropdownOne"><span class="dropdown-header">Settings</span> <a class="dropdown-item" href="#"><i class="fe fe-mail dropdown-item-icon"></i>Mail</a><a class="dropdown-item" href="#"> <i class="fe fe-edit dropdown-item-icon"></i>Print</a><a class="dropdown-item" href="#"><i class="fe fe-trash dropdown-item-icon"></i>Delete</a></span></span>';
                        //         return html;
                        //     }, 
                        //     width:'5%'

                        // },
                        // Add more columns as needed
                    ],
                });
            },
            error: function (xhr, status, error) {
                $("#processingLoader").fadeOut();
                console.error(error);
            },
        });
    }

    $('#course_id').change(function() {
        // Get the selected value

        var selectedCourseId = $(this).val();
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var baseUrl = window.location.origin + "/";
        $.ajax({
            url: baseUrl + "admin/get-course-price/" + selectedCourseId,
            method: "GET",
            success: function (data) {
                $("#amount").val(data[0].course_final_price);
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    });

    $(".LinkOk").on('click',function(){
        window.location.reload();
    });


    $('#exportButton').click(function(e) {        
        e.preventDefault(); // Prevent the default anchor tag behavior
        var exportUrl = this.getAttribute('data-route');
        window.location.href = exportUrl; // This will trigger the Laravel route for export
    });

    </script>

@endsection
