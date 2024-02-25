@extends('layouts.app')
@section('content')
@include('dashboard.header')
<div class="card mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-middle d-flex align-items-center">
                <i class="fa-solid fa-filter  me-2"></i> Filter
            </div>
            <div class="col-md-6 d-flex justify-content-end">
            </div>
        </div>
    </div>
    <div class="card-body">
        <form name="" method="post" action="{{ url('dashbaord') }}">
            @csrf
            <div class="row mb-2">
                <div class="col">
                    <label>Module</label>
                    <select class="form-select" name="module">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="col">
                    <label>Requester</label>
                    <select class="form-select" name="requester">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="col">
                    <label>Group</label>
                    <select class="form-select" name="group">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="col">
                    <label>Date</label>
                    <select class="form-select" name="group">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="col">
                    <label></label>
                    <button class="btn btn-primary w-100"><i class="fa-solid fa-filter  me-2"></i> Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4>YTD #</h4>
                <span class="h2">{{ $completed_ytd }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5>YTD %</h5>
                <span class="h2">{{ number_format($score_ytd,2) }} %</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5>MTD #</h5>
                <span class="h2">{{ $completed_mtd }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5>MTD %</h5>
                <span class="h2">{{ number_format( $score_mtd ,2) }} %</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="text-center">Months vs Score</h5>
               
                <div style="width: 99%; margin: 10px auto;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="text-center">Completed by Teams</h5>
                <div id="pieChartByTeam" class="pie" align="center">loading chart...</div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
var date = "{{ $date ? $date : date('Y-m') }}";
var service = "{{ $service_name ? $service_name : null }}";
var group = "{{ $group_name ? $group_name : null }}";
var parent = "SSD";

document.addEventListener('DOMContentLoaded', function () {
    var url = "/dashboard/ssd/chart/bars/completedvsscore/bymonth";
    var params = {
        year: new Date().getFullYear(), // Or set a specific year
        status: 3, // Example status
        // Include other parameters as needed: service, group, analyst
    };

    // Construct URL with query parameters
    var queryParams = new URLSearchParams(params).toString();
    var fullUrl = url + '?' + queryParams;

    // Fetch data using Fetch API
    fetch(fullUrl)
        .then(response => response.json())
        .then(data => {
            // Array of month names for conversion
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            
            // Convert numeric month to month name
            var labels = data.map(item => monthNames[item.month - 1]); // Adjust month indexing
            
            var completedData = data.map(item => item.completed);
            var scoreData = data.map(item => item.score);

            var ctx = document.getElementById('barChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Completed',
                        data: completedData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Score',
                        data: scoreData,
                        type: 'line',
                        borderColor: 'rgb(54, 162, 235)',
                        fill: false,
                        tension: 0.1, // Smooth the line
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});

</script>


@endsection
