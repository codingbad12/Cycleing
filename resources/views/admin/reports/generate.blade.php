@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Generate Custom Report</h1>
        <a href="{{ route('admin.reports.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Reports
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Report Parameters</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.reports.generate') }}" method="GET">
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate }}">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate }}">
                    </div>
                    <div class="form-group col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-block">Generate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Report Summary -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($revenue, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Late Fee Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($lateFees, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Bookings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bookings->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Completed Rentals</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bookingsByStatus['completed'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Status Chart -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bookings by Status</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="bookingStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Breakdown</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Bookings ({{ $startDate }} to {{ $endDate }})</h6>
            <a href="#" class="btn btn-sm btn-success" onclick="exportTableToCSV('bookings_report.csv')">
                <i class="fas fa-file-csv fa-sm"></i> Export to CSV
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="bookingsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Ship</th>
                            <th>Dates</th>
                            <th>Status</th>
                            <th>Total Price</th>
                            <th>Late Fee</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->ship->name }}</td>
                            <td>
                                {{ date('M d, Y', strtotime($booking->start_date)) }} - 
                                {{ date('M d, Y', strtotime($booking->end_date)) }}
                            </td>
                            <td>
                                @if($booking->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($booking->status == 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif($booking->status == 'completed')
                                    <span class="badge badge-primary">Completed</span>
                                @elseif($booking->status == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @elseif($booking->status == 'return_requested')
                                    <span class="badge badge-info">Return Requested</span>
                                @endif
                            </td>
                            <td>${{ number_format($booking->total_price, 2) }}</td>
                            <td>${{ number_format($booking->late_fee ?? 0, 2) }}</td>
                            <td>{{ $booking->created_at->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Booking Status Chart
    var ctx = document.getElementById("bookingStatusChart");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Pending", "Approved", "Completed", "Rejected"],
            datasets: [{
                label: "Bookings",
                backgroundColor: ["#f6c23e", "#1cc88a", "#4e73df", "#e74a3b"],
                data: [
                    {{ $bookingsByStatus['pending'] }}, 
                    {{ $bookingsByStatus['approved'] }}, 
                    {{ $bookingsByStatus['completed'] }}, 
                    {{ $bookingsByStatus['rejected'] }}
                ],
            }],
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Revenue Chart
    var ctx2 = document.getElementById("revenueChart");
    var myPieChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ["Rental Revenue", "Late Fees"],
            datasets: [{
                data: [{{ $revenue - $lateFees }}, {{ $lateFees }}],
                backgroundColor: ['#4e73df', '#e74a3b'],
                hoverBackgroundColor: ['#2e59d9', '#be2617'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue/total) * 100)+0.5);
                        return "$" + currentValue + " (" + percentage + "%)";
                    }
                }
            }
        }
    });

    // Export to CSV function
    function exportTableToCSV(filename) {
        var csv = [];
        var rows = document.querySelectorAll("#bookingsTable tr");
        
        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");
            
            for (var j = 0; j < cols.length; j++) {
                // Replace HTML content with text content
                var text = cols[j].innerText.replace(/"/g, '""');
                row.push('"' + text + '"');
            }
            
            csv.push(row.join(","));
        }

        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    }

    function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;

        // Create CSV file
        csvFile = new Blob([csv], {type: "text/csv"});

        // Create download link
        downloadLink = document.createElement("a");
        downloadLink.download = filename;
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";

        // Add link to DOM and trigger download
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }
</script>
@endsection