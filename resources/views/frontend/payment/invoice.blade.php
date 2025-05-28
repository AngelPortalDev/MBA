<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 90%;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            page-break-inside: avoid; 
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #2b3990;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
        }
        .header h1 {
            font-size: 24px;
            color: #333;
        }
        .invoice-details {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }
        .invoice-details h4 {
            margin: 0;
            font-size: 20px;
            color: #2b3990;
        }
        .invoice-details small {
            color: #666;
        }

        .info-block {
            flex: 1;
            min-width: 300px;
            padding: 10px;
        }
        .info-block h5 {
            margin-top: 0;
            font-size: 16px;
            color: #2b3990;
        }
        .info-block p {
            margin: 5px 0;
            color: #333;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-top: 1.5rem;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .table th {
            background-color: #f8f8f8;
            color: #333;
        }
        .table td {
            color: #555;
        }
        .table tfoot tr {
            font-weight: bold;
        }
        .table tfoot td {
            text-align: right;
        }
        .notes {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $title }}" alt="Logo">
            <h1>Invoice</h1>
        </div>

        <div class="invoice-details">
            <div>
                <h4>Receipt - {{ $date }}</h4>
                <small>ORDER ID: {{ $invoiceNumber }}</small>
            </div>
        </div>

        <div class="main">
            <div style="float: left; width: 50%;"> 
                <div class="info-block">
                    <h5>Invoice From</h5>
                    <p>{{ $invoiceFrom['name'] }}</p>
                    <p class="address">23, Vincenzo Dimech Street,<br>Floriana, Valletta, Malta</p>
                </div>
            </div>
            <div style="float: right; width: 50%;">
                    <div class="info-block">
                        <h5>Invoice To</h5>
                        <p>{{ $invoiceTo['name'] }}</p>
                        <p class="address d-block">{{ $invoiceTo['address'] }}</p>
                    </div>
            </div>
            <div style="clear: both;"></div>
        </div>
       
        <div class="main">
            <div>
                <div class="info-block"  style="float: left; width: 70%">
                    <span>Payment Type:</span>
                    <strong>{{ $paymentType }}</strong>
                </div>
            </div>
            <div style="float: right; width: 30%">
                <div class="info-block">
                    <span>Date:</span>
                    <strong>{{ $invoiceDate }}</strong>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Ordered Date</th>
                    <th>Cost Details</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['orderDate'] }}</td>
                    <td>{{ $item['couponCode'] }}</td>
                    <td style="text-align:right;">{{ $item['amount'] }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                @if($subtotal > 0)
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align:left;">Original Price</td>
                    <td>€{{ number_format($subtotal, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align:left;">Scholarship</td>
                    <td>€{{ number_format($scholarship, 2, '.', ',') }}</td>
                </tr>
                @endif
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align:left;">Discount {{isset($items[0]['couponCode']) && !empty($items[0]['couponCode']) ? '('. $items[0]['couponCode'] . '% )' : '' }}</td>
                    <td>€{{ number_format($discount, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align:left;">Grand Total</td>
                    <td>€{{ round($grandTotal) }}</td>
                </tr>
            </tfoot>
        </table>

        <p class="notes">Notes: Invoice was created on a computer and is valid without the signature and seal.</p>
    </div>
</body>
</html>
