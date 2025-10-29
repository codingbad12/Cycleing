@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Invoice #INV-{{ $booking->id }}</h1>
        <div>
            <a href="{{ route('admin.reports.printInvoice', $booking->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" target="_blank">
                <i class="fas fa-print fa-sm text-white-50"></i> Print Invoice
            </a>
            <a href="{{ route('admin.reports.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm ml-2">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Reports
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h6 class="mb-3">From:</h6>
                    <div>
                        <strong>Sea Voyage Rentals</strong>
                    </div>
                    <div>123 Ocean Drive</div>
                    <div>Marina Bay, CA 94103</div>
                    <div>Email: info@seavoyage.com</div>
                    <div>Phone: +1 (123) 456-7890</div>
                </div>

                <div class="col-sm-6">
                    <h6 class="mb-3">To:</h6>
                    <div>
                        <strong>{{ $booking->user->name }}</strong>
                    </div>
                    <div>Email: {{ $booking->user->email }}</div>
                    <div>Phone: {{ $booking->user->phone ?? 'N/A' }}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <h6 class="mb-3">Invoice Details:</h6>
                    <div><strong>Invoice Number:</strong> INV-{{ $booking->id }}</div>
                    <div><strong>Invoice Date:</strong> {{ date('F d, Y') }}</div>
                    <div><strong>Payment Status:</strong> <span class="badge badge-success">Paid</span></div>
                </div>
                <div class="col-sm-6">
                    <h6 class="mb-3">Booking Details:</h6>
                    <div><strong>Booking ID:</strong> {{ $booking->id }}</div>
                    <div><strong>Booking Date:</strong> {{ date('F d, Y', strtotime($booking->created_at)) }}</div>
                    <div><strong>Status:</strong> Completed</div>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-bordered">
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
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total:</strong></td>
                            <td><strong>${{ number_format($booking->total_price + ($booking->late_fee ?? 0), 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Notes</h6>
                        </div>
                        <div class="card-body">
                            <p>Thank you for choosing Sea Voyage Rentals. We hope you enjoyed your experience and look forward to serving you again in the future.</p>
                            <p>All payments are non-refundable. Please refer to our terms and conditions for more information.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Payment Information</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Payment Method:</strong> Credit Card</p>
                            <p><strong>Transaction ID:</strong> TXN-{{ $booking->id }}-{{ substr(md5($booking->id), 0, 8) }}</p>
                            <p><strong>Payment Date:</strong> {{ date('F d, Y', strtotime($booking->updated_at)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection