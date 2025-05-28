
<!-- Header import -->
@extends('admin.layouts.main') @section('content')
@section('maintitle') Admin @endsection

@section('css')
<style>
 .dataTables_filter {
    display: none !important;
}
</style>
@endsection
    <!-- Container fluid -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stripe Payment</title>
    </head>
    <body>
        {{-- @php
        $stripe_key = 'sk_test_51PLN3sSGNhXt9gOlbbU8mkhnDVaat5oqB29uwv4lqTiIZLdMoAcxzoDBnE2pPB0tZzJ0O847DbMsVC1goypDKswK00TRwo1es9';
        @endphp
        <div class="container" style="margin-top:10%;margin-bottom:10%">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="">
                        <p>Your Total Amount is 6000 AED</p>
                    </div>
                    <div class="card">
                        <form action="{{route('checkout.credit-card')}}"  method="post" id="payment-form">
                            @csrf                    
                            <div class="form-group">
                                <div class="card-header">
                                    <label for="card-element">
                                        Enter your credit card information
                                    </label>
                                </div>
                                <div class="card-body">
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                    <input type="hidden" name="plan" value="" />
                                </div>
                            </div>
                            <div class="card-footer">
                              <button
                              id="card-button"
                              class="btn btn-dark"
                              type="submit"
                              data-secret="{{ $intent }}"
                              > Pay </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div> --}}
      <main>
        <div class="row">
            <aside class="col-sm-6 offset-3">
                <article class="card">
                    <div class="card-body p-5">
                        <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
                                <i class="fa fa-credit-card"></i> Credit Card</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="nav-tab-card">
                                @foreach (['danger', 'success'] as $status)
                                    @if(Session::has($status))
                                        <p class="alert alert-{{$status}}">{{ Session::get($status) }}</p>
                                    @endif
                                @endforeach
                                <form role="form" method="POST" id="paymentForm" action="{{ url('/payment')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Full name (on the card)</label>
                                        <input type="text" class="form-control" name="fullName" placeholder="Full Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="cardNumber">Card number</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="cardNumber" placeholder="Card Number">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-muted">
                                                <i class="fab fa-cc-visa fa-lg pr-1"></i>
                                                <i class="fab fa-cc-amex fa-lg pr-1"></i>
                                                <i class="fab fa-cc-mastercard fa-lg"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label><span class="hidden-xs">Expiration</span> </label>
                                                <div class="input-group">
                                                    <select class="form-control" name="month">
                                                        <option value="">MM</option>
                                                        @foreach(range(1, 12) as $month)
                                                            <option value="{{$month}}">{{$month}}</option>
                                                        @endforeach
                                                    </select>
                                                    <select class="form-control" name="year">
                                                        <option value="">YYYY</option>
                                                        @foreach(range(date('Y'), date('Y') + 10) as $year)
                                                            <option value="{{$year}}">{{$year}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label data-toggle="tooltip" title=""
                                                    data-original-title="3 digits code on back side of the card">CVV <i
                                                    class="fa fa-question-circle"></i></label>
                                                <input type="number" class="form-control" placeholder="CVV" name="cvv">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="subscribe btn btn-primary btn-block" type="submit"> Confirm </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </aside>
        </div>
    </main>
    </body>
    </html>
</div>


@endsection
