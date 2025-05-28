@extends('frontend.master')
@section('content')
<style> 
@media print {
    @page {
        size: portrait;
        margin: 0;
    }

    body {
        -webkit-print-color-adjust: exact; /* Ensure colors are printed accurately */
        transform: scale(0.9); /* Scale down the content to fit within the page */
        transform-origin: top left; /* Set the origin for the scaling transformation */
    }

    .header, .footer, .no-print,.navbar,.receipt,#zsiq_float{
        display: none !important;
    }

    .print-card {
        width: 100%; /* Ensure the card takes up the full width */
        margin: 0;
    }
    .tableReceipt{
        background: #2b3990;
        color: #fff;
    }
    
}
.tableReceipt{
        background: #2b3990;
        color: #fff;
}
.tableReceipt th{
    color: #fff;
}
.tableRow{
    border-bottom: 1px solid #000;
}

.text-wrap-title{
  word-wrap: break-word;
  white-space: normal;
  width: 350px; 
}
.btn-scroll-top{
    display: none !important;
}
</style>
                
                <section class="py-4 py-lg-6 bg-primary receipt">
                    <div class="container ">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div>
                                    <h1 class="text-white mb-1 display-4 color-green">Receipt </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section>

                <!-- Container fluid -->
               <!-- Container fluid -->
               <section class="container p-4 checkout-page ">

                <!-- row -->
                <div class="row d-flex justify-content-center">
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
                                            <h4 class="mb-0">Receipt - {{$date}}</h4>
                                            <small class="text-dark">ORDER ID: #{{$invoiceNumber}}</small>
                                        </div>
                                        <div>
                                            <a href="#" class="print-link no-print"><i class="fe fe-printer fs-3"></i></a>
                                        </div>
                                    </div>
                                    <!-- Row -->
                                    <div class="row">
                                        <div class="col-md-8 col-12">
                                            <span class="text-dark">Invoice From</span>
                                            <h5 class="mb-3">Ascencia Malta / E-Ascencia</h5>
                                            <p class="text-dark">23, Vincenzo Dimech Street
                                                <br >
                                                Floriana, Valletta
                                                <br >
                                                Malta
                                            </p>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <span class="text-dark">Invoice To</span>
                                            <h5 class="mb-3 text-dark">{{ $invoiceTo['name'] }}</h5>
                                            <p class="address text-dark">{{ $invoiceTo['address'] }}</p>
                                        </div>
                                    </div>
                                    <!-- Row -->
                                    <div class="row mb-5">
                                        <div class="col-8">
                                            <span class="text-dark">Payment Type</span>
                                            <h5 class="mb-0 text-dark">{{ $paymentType }}</h5>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-dark">Date:</span>
                                            <h5 class="mb-0 text-dark">{{$invoiceDate}}</h5>
                                        </div>
                                    </div>
                                    <!-- Table -->
                                    <div class="table-responsive mb-8">
                                        <table class="table mb-0 text-nowrap table-borderless ">
                                            <thead class="tableReceipt">
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Ordered Date</th>
                                                    <th>Cost Details</th>
                                                    {{-- <th>Quantity</th> --}}
                                                    {{-- <th>Price</th> --}}
                                                    <th  style="text-align:right;">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <tr class="text-dark border-bottom">
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
                                                </tr> --}}
                                                {{-- @php dd($items); @endphp --}}
                                                {{-- @foreach($items as $item) --}}
                                                    <tr class="text-dark tableRow "  >
                                                        <td class="text-dark text-wrap-title">{{ $items[0]['name'] }}</td>
                                                        <td class="text-dark">{{ $items[0]['orderDate'] }}</td>
                                                        <td class="text-dark"></td>
                                                        {{-- <td>{{ $items[0]['price'] }}</td> --}}
                                                        <td class="text-dark" style="text-align:right;">{{ $items[0]['amount'] }}</td>
                                                    </tr>
                                                    {{-- @endforeach --}}
                                            </tbody>
                                            
                                            <tfoot>
                                                @if($subtotal > 0)
                                                <tr class="text-dark">
                                                    <td colspan="2"></td>
                                                    <td colspan="1" class="pb-0 text-dark">Original Price</td>
                                                    <td class="pb-0 text-dark" style="text-align:right;">{{ number_format($subtotal, 2, '.', ','); }}</td>
                                                </tr>
                                                <tr class="text-dark">
                                                    <td colspan="2"></td>
                                                    <td colspan="1" class="pb-0 text-dark">Scholarship</td>
                                                     @php 
                                                        // $totalAmountCourse = $items[0]['amount'] ; 
                                                        // $scholarship =  $subtotal - $totalAmountCourse; 
                                                        @endphp
                                                    <td class="pb-0 text-dark" style="text-align:right;">{{ number_format($scholarship, 2, '.', ',') }}</td>
                                                </tr>
                                                @endif
                                                <tr class="text-dark">
                                                    <td colspan="2"></td>
                                                    <td colspan="1" class="pb-0 text-dark">Discount {{isset($items[0]['couponCode']) && !empty($items[0]['couponCode']) ? '('. $items[0]['couponCode'] . '% )' : '' }}</td>
                                                    <td class="pb-0 text-dark" style="text-align:right;">{{ number_format($discount, 2, '.', ',')}}</td>
                                                </tr>
                                                <tr class="text-dark">
                                                    <td colspan="2"></td>
                                                    <td colspan="1" class="py-1 fw-bold text-dark" style="border-top:1px solid #000;">Grand Total</td>
                                                    <td class="py-1 fw-bold text-dark" style="text-align:right; border-top:1px solid #000;">€{{round($grandTotal)}}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- Short note -->
                                    <p class="pt-2 mb-0 text-dark" style="border-top:1px solid #000">Notes: Invoice was created on a computer and is valid without the signature and seal.</p>
                                </div>
                            </div>
                    </div>
                    
                </div>
            </section>
        </main>
        {{-- 
        @if (Route::current()->getName() != 'receipt')
        <script>
            window.$zoho = window.$zoho || {};
            $zoho.salesiq = $zoho.salesiq || {
                ready: function() {}
            }
        </script>
        <script id="zsiqscript"
            src="https://salesiq.zohopublic.com/widget?wc=siq4605044396440f1b620acf7e7aff45cb7c1758c52af8a5fac9b184144a95f114"
            defer></script>
        @endif --}}

@endsection