@extends('frontend.master')
@section('content')

<style>
    .sidenav.navbar .navbar-nav .sp-5>.nav-link {
    color: #2b3990 !important;
    background-color:rgb(235 233 255);
    }
</style>
<main>
    <section class="pt-5 pb-5">
        <div class="container">
          @include('frontend.student.layout.student-common')

            <!-- User info -->
         
                <div class="col-lg-9 col-md-8 col-12">
                  <!-- Card -->
                  <div class="card mb-4">
                    <!-- Card header -->
                    <div class="card-header border-bottom-0">
                      <h3 class="mb-0">Invoices</h3>
                      <p class="mb-0">You can find all of your course invoices.</p>
                    </div>
                    <!-- Table -->
                    <div class="table-invoice table-responsive">
                      <table class="table mb-0 text-nowrap table-centered table-hover">
                        <thead class="table-light">
                          <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>View</th>
                          </tr>
                        </thead>
                        <tbody>
                          {{-- <tr>
                            <td><a href="#" onclick="return false;">#1008</a></td>
                            <td>17 April 2024, 10:45pm</td>
                            <td>€1500</td>
                            <td><span class="badge bg-danger">Hold</span></td>
                            <td>
                              <a href="assets/images/pdf/invoiceFile.pdf" class="fe fe-download" download=""></a>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="#" onclick="return false;">#1007</a></td>
                            <td>17 April 2024, 10:45pm</td>
                            <td>€1500</td>
                            <td>
                              <span class="badge bg-success">Complete</span>
                            </td>
                            <td>
                              <a href="assets/images/pdf/invoiceFile.pdf" class="fe fe-download" download=""></a>
                            </td>
                          </tr> --}}
                          @if(count($InvoiceData) > 0 )
                          @foreach($InvoiceData as $key => $value)

                          <tr>
                            <td>
                              @if($value->status == '0')
                              <a href="{{route('receipt',['id' => base64_encode($value->id), 'action' => base64_encode('receipt')])}}" target="_blank">#{{$value->uni_order_id}}</a>
                              @else
                              {{$value->uni_order_id}}
                              @endif
                            
                            </td>
                            <td>{{$value->created_at}}</td>
                            <td>  @php $orderData =  getData('orders',['course_price','promo_code_discount'],['payment_id' => $value->id]);

                              $subtotal = isset($orderData[0]->course_price) ? $orderData[0]->course_price : 0;
                              if($orderData[0]->promo_code_discount){
                                $subtotal = $subtotal - $orderData[0]->promo_code_discount;
                              }
                             
                            @endphp €{{round($subtotal)}}</td>
                            <td>@if($value->status == '1') <span class="badge bg-danger">Unpaid</span>@else <span class="badge bg-success">Complete</span> @endif</td>
                            @if($value->status == '0')
                            <td>
                              {{-- <a href="{{route('downloadinvoice',['id' => base64_encode($value->id), 'action' => base64_encode('invoice')])}}" class="fe fe-download" ></a> --}}
                              @if($value->status == '0')
                              <a href="{{route('downloadinvoice',['id' => base64_encode($value->id), 'action' => base64_encode('invoice')])}}" class="fe fe-download" ></a>
                              @else
                              -
                              @endif

                            </td>
                            @else
                            <td>-</td>
                            @endif
                          </tr>
                          @endforeach 
                          @else
                          <tr>
                            <td colspan="5" style="text-align:center">No Record Found</td>
                          </tr>
                          @endif
                          {{-- <tr>
                            <td><a href="invoice-details.html">#1006</a></td>
                            <td>17 Feb 2024, 10:45pm</td>
                            <td>€1500</td>
                            <td>
                              <span class="badge bg-success">Complete</span>
                            </td>
                            <td>
                              <a href="assets/images/pdf/invoiceFile.pdf" class="fe fe-download" download=""></a>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="invoice-details.html">#1005</a></td>
                            <td>17 January 2024, 10:45pm</td>
                            <td>€1500</td>
                            <td>
                              <span class="badge bg-success">Complete</span>
                            </td>
                            <td>
                              <a href="assets/images/pdf/invoiceFile.pdf" class="fe fe-download" download=""></a>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="invoice-details.html">#1004</a></td>
                            <td>17 Dec 2019, 10:45pm</td>
                            <td>€1500</td>
                            <td>
                              <span class="badge bg-success">Complete</span>
                            </td>
                            <td>
                              <a href="assets/images/pdf/invoiceFile.pdf" class="fe fe-download" download=""></a>
                            </td>
                          </tr> --}}
 
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
        </div>
    </section>
</main>
@endsection