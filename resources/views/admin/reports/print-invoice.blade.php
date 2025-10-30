<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #INV-{{ $booking->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-header h1 {
            margin: 0;
            color: #2c3e50;
        }
        .invoice-header p {
            margin: 5px 0;
        }
        .row {
            display: flex;
            margin-bottom: 20px;
        }
        .col {
            flex: 1;
            padding: 0 15px;
        }
        .invoice-details {
            margin-bottom: 30px;
        }
        .invoice-details h3 {
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        table th {
            background-color: #f8f9fa;
        }
        .total-row td {
            font-weight: bold;
            border-top: 2px solid #333;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        @media print {
            body {
                padding: 0;
                margin: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>Sea Voyage Rentals</h1>
        <p>123 Ocean Drive, Marina Bay, CA 94103</p>
        <p>info@seavoyage.com | +1 (123) 456-7890</p>
    </div>

    <div class="row">
        <div class="col">
            <div class="invoice-details">
                <h3>Invoice To:</h3>
                <p><strong>{{ $booking->user->name }}</strong></p>
                <p>Email: {{ $booking->user->email }}</p>
                <p>Phone: {{ $booking->user->phone ?? 'N/A' }}</p>
            </div>
        </div>
        <div class="col">
            <div class="invoice-details">
                <h3>Invoice Details:</h3>
                <p><strong>Invoice Number:</strong> INV-{{ $booking->id }}</p>
                <p><strong>Date:</strong> {{ date('F d, Y') }}</p>
                <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
                <p><strong>Status:</strong> Completed</p>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Rental Period</th>
                <th>Days</th>
                <th>Rate</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>{{ $booking->ship->name }}</strong><br>
                    Type: {{ $booking->ship->type }}<br>
                    Capacity: {{ $booking->ship->capacity }} persons
                </td>
                <td>
                    {{ date('M d, Y', strtotime($booking->start_date)) }} - 
                    {{ date('M d, Y', strtotime($booking->end_date)) }}
                </td>
                <td>
                    @php
                        $start = new DateTime($booking->start_date);
                        $end = new DateTime($booking->end_date);
                        $days = $start->diff($end)->days;
                    @endphp
                    {{ $days }}
                </td>
                <td>${{ number_format($booking->ship->price_per_day, 2) }}/day</td>
                <td>${{ number_format($booking->total_price, 2) }}</td>
            </tr>
            @if($booking->late_fee > 0)
            <tr>
                <td colspan="4" class="text-right"><strong>Late Return Fee:</strong></td>
                <td>${{ number_format($booking->late_fee, 2) }}</td>
            </tr>
            @endif
            <tr class="total-row">
                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                <td><strong>${{ number_format($booking->total_price + ($booking->late_fee ?? 0), 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="invoice-details">
        <h3>Payment Information</h3>
        <p><strong>Payment Method:</strong> Credit Card</p>
        <p><strong>Transaction ID:</strong> TXN-{{ $booking->id }}-{{ substr(md5($booking->id), 0, 8) }}</p>
        <p><strong>Payment Date:</strong> {{ date('F d, Y', strtotime($booking->updated_at)) }}</p>
    </div>

    <div class="invoice-details">
        <h3>Notes</h3>
        <p>Thank you for choosing Sea Voyage Rentals. We hope you enjoyed your experience and look forward to serving you again in the future.</p>
        <p>All payments are non-refundable. Please refer to our terms and conditions for more information.</p>
    </div>

    <div class="footer">
        <p>This is a computer-generated invoice and does not require a signature.</p>
    </div>

    <div class="no-print" style="margin-top: 30px; text-align: center;">
        <button onclick="window.print();" style="padding: 10px 20px; background: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Print Invoice
        </button>
        <button onclick="window.close();" style="padding: 10px 20px; background: #7f8c8d; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px;">
            Close
        </button>
    </div>
</body>
</html>