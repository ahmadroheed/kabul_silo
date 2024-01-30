@extends('backend.layout.layout')

@section('page_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">view</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <div class="row">
        <!-- Add a new section for statistics -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box bg-info">
                                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Users</span>
                                    <span class="info-box-number">{{ $totalUsers }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-info">
                                <span class="info-box-icon"><i class="fas fa-newspaper"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total News</span>
                                    <span class="info-box-number">{{ $totalNews }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="fas fa-sliders-h"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Sliders</span>
                                    <span class="info-box-number">{{ $totalSliders }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-images"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Gallery</span>
                                    <span class="info-box-number">{{ $totalGallery }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of new statistics section -->
                <!-- Chart Section -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistics Chart</h5>
                            <canvas id="statisticsChart" style="height: 200px;"></canvas>
                        </div>
                    </div>
                </div>
                <!-- End of Chart Section -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                // Fetch counts from the server (you may use AJAX to get data from the server)
                var totalNews = {{ $totalNews }};
                var totalSliders = {{ $totalSliders }};
                var totalGallery = {{ $totalGallery }};
                var totalUsers = {{ $totalUsers }};
    
                // Create a bar chart
                var ctx = document.getElementById('statisticsChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['News', 'Sliders', 'Gallery','Users'],
                        datasets: [{
                            label: 'Total Items',
                            data: [totalNews, totalSliders, totalGallery, totalUsers],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)', // News
                                'rgba(54, 162, 235, 0.6)', // Sliders
                                'rgba(255, 206, 86, 0.6)', // Gallery
                                'rgba(255, 0, 0, 0.6)', // Users
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 255, 255, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>    
@endsection
