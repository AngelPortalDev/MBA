<!-- Header import -->
@extends('admin.layouts.main')
@section('content')

               <!-- Container fluid -->
               <section class="container p-4 checkout-page">

                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                            <!-- Card -->
                            <div class="card border-0" id="invoice">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-6">
                                        <div>
                                            <!-- Img -->
                                            <img src="{{ asset('frontend/images/brand/logo/logo.svg')}}"
                                            alt="E-Ascencia" class="mb-4 "  width="134px;">
                                            <h4 class="mb-0">Receipt - May 28, 2024</h4>
                                            <small>ORDER ID: #1001</small>
                                        </div>
                                        <div>
                                            <a href="#" class="print-link no-print"><i class="fe fe-printer fs-3"></i></a>
                                        </div>
                                    </div>
                                    <!-- Row -->
                                    <div class="row">
                                        <div class="col-md-8 col-12">
                                            <span>Invoice From</span>
                                            <h5 class="mb-3">E-Ascencia</h5>
                                            <p>
                                                23, Vincenzo Dimech Street
                                                <br >
                                                Floriana, Valletta
                                                <br >
                                                Malta
                                            </p>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <span >Invoice To</span>
                                            <h5 class="mb-3">Haresh Gurav</h5>
                                            <p>
                                                775 Rolling Green Rd
                                                <br >
                                                undefined Orange, Oklahoma
                                                <br >
                                                45785 United States
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Row -->
                                    <div class="row mb-5">
                                        <div class="col-8">
                                            <span >Payment Type</span>
                                            <h5 class="mb-0">UPI</h5>
                                        </div>
                                        <div class="col-4">
                                            <span >Date</span>
                                            <h5 class="mb-0">28 May 2024</h5>
                                        </div>
                                    </div>
                                    <!-- Table -->
                                    <div class="table-responsive mb-8">
                                        <table class="table mb-0 text-nowrap table-borderless">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Ordered</th>
                                                    <th>Promo Code</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="text-dark border-bottom">
                                                    <td>Masters of Arts in Human Resource Management</td>
                                                    <td>28 May 2024</td>
                                                    <td>GKDIS15%</td>
                                                    <td>1</td>
                                                    <td>€15,000</td>
                                                    <td>€15,000</td>
                                                </tr>
                                                <tr class="text-dark border-bottom">
                                                    <td>Award in Recruitment and Employee Selection</td>
                                                    <td>28 May 2024</td>
                                                    <td>-</td>
                                                    <td>1</td>
                                                    <td>€1500</td>
                                                    <td>€1500</td>
                                                </tr>
                                            </tbody>
                                            
                                            <tfoot>
                                                <tr class="text-dark">
                                                    <td colspan="4"></td>
                                                    <td colspan="1" class="pb-0">Subtotal</td>
                                                    <td class="pb-0">€16,500</td>
                                                </tr>

                                                <tr class="text-dark">
                                                    <td colspan="4"></td>
                                                    <td colspan="1" class="pt-0">Discount</td>
                                                    <td class="pt-0">€0.00</td>
                                                </tr>
                                                <tr class="text-dark">
                                                    <td colspan="4"></td>
                                                    <td colspan="1" class="border-top py-1 fw-bold">Grand Total</td>
                                                    <td class="border-top py-1 fw-bold">€16,500</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- Short note -->
                                    <p class="border-top pt-2 mb-0">Notes: Invoice was created on a computer and is valid without the signature and seal.</p>
                                </div>
                            </div>
                    </div>
                    
                </div>
            </section>
</main>


@endsection
