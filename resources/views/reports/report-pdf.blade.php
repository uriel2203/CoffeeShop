<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #2c221a;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #8c5319;
            padding-bottom: 15px;
        }
        .shop-name {
            font-size: 28px;
            font-weight: bold;
            color: #8c5319;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }
        .report-title {
            font-size: 18px;
            color: #5c4a3b;
            margin: 5px 0;
        }
        .date-range {
            font-size: 14px;
            color: #8a7663;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th {
            background-color: #fcfaf8;
            color: #2a241f;
            font-size: 12px;
            font-weight: bold;
            text-align: left;
            padding: 12px 10px;
            border-bottom: 2px solid #ebd9c8;
        }
        td {
            padding: 10px;
            font-size: 12px;
            border-bottom: 1px solid #ebd9c8;
            vertical-align: top;
        }
        .order-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }
        .total-row {
            font-weight: bold;
            background-color: #fcfaf8;
        }
        .summary-section {
            float: right;
            width: 300px;
        }
        .summary-table td {
            border: none;
            padding: 5px 10px;
        }
        .summary-label {
            text-align: right;
            color: #5c4a3b;
        }
        .summary-value {
            text-align: right;
            font-weight: bold;
            color: #2a241f;
            width: 100px;
        }
        .grand-total {
            font-size: 16px;
            color: #8c5319;
            border-top: 2px solid #8c5319 !important;
            padding-top: 10px !important;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #a08f80;
            padding: 20px 0;
            border-top: 1px solid #ebd9c8;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="shop-name">Caféra</h1>
        <div class="report-title">Sales Transactions Report</div>
        <div class="date-range">Period: {{ $dateRange }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 15%">Order ID</th>
                <th style="width: 40%">Orders</th>
                <th style="width: 15%">Payment</th>
                <th style="width: 15%">Date</th>
                <th style="width: 15%; text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td><strong>{{ $order->order_number }}</strong></td>
                <td>
                    @foreach($order->items as $item)
                        <div class="order-item">
                            <span>{{ $item->quantity }}x {{ $item->product_name }}</span>
                            <span style="color: #8a7663;">(&#8369;{{ number_format($item->price * $item->quantity, 2) }})</span>
                        </div>
                        @if($item->product)
                        <div style="font-size: 10px; color: #8c5319; font-style: italic; margin-bottom: 5px;">
                            Recipe: 
                            @foreach($item->product->ingredients as $ing)
                                {{ $ing->name }} ({{ number_format($ing->pivot->amount * $item->quantity, 1) }}{{ $ing->unit }}){{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </div>
                        @endif
                    @endforeach
                </td>
                <td style="text-transform: capitalize;">{{ $order->payment_method }}</td>
                <td>{{ $order->created_at->format('M d, Y') }}<br><small>{{ $order->created_at->format('h:i a') }}</small></td>
                <td style="text-align: right;"><strong>&#8369;{{ number_format($order->total, 2) }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="clearfix">
        <div class="summary-section">
            <table class="summary-table">
                <tr>
                    <td class="summary-label">Subtotal:</td>
                    <td class="summary-value">&#8369;{{ number_format($subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td class="summary-label">Total Discounts:</td>
                    <td class="summary-value">-&#8369;{{ number_format($discountTotal, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td class="summary-label grand-total">Grand Total:</td>
                    <td class="summary-value grand-total">&#8369;{{ number_format($grandTotal, 2) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="footer">
        Generated on {{ $generatedAt }} by {{ $generatedBy }}<br>
        &copy; {{ date('Y') }} Caféra Coffee Shop. All rights reserved.
    </div>
</body>
</html>
