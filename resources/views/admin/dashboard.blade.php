@extends('layouts.backend.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('home')
            ],

            [
                'text' => 'Dashboard',
            ],
        ]
    ])
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart-container">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('inline_scripts')
    <script>
        var year = ['2014', '2015', '2016', '2017', '2018', '2019', '2020'];
        var data_user = ['2', '6', '15', '23', '10', '7', '17'];

        var barChart = document.getElementById('barChart').getContext('2d');

        var myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
                labels: year,
                datasets: [{
                    label: "Sales",
                    backgroundColor: 'rgb(23, 125, 255)',
                    borderColor: 'rgb(23, 125, 255)',
                    data: data_user,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
            }
        });
    </script>

@endsection
