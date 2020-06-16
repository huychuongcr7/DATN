@extends('layouts.backend.admin')

@section('title', 'Thống kê sản phẩm')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
                'text' => 'Thống kê sản phẩm',
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
                        <div class="card-header">
                            <h4 class="card-title"><b>@yield('title')</b></h4>
                        </div>
                        <div class="card-body">
                            <div style="padding-bottom: 30px">
                                <div id="chart-container">
                                    <canvas id="barChart"></canvas>
                                </div>
                                <div class="text-center" style="padding-top: 20px">
                                    <h3><b>Top 10 sản phẩm bán chạy trong tháng</b></h3>
                                </div>
                            </div>
                            <hr>
                            <div style="padding-bottom: 30px">
                                <div id="chart-container">
                                    <canvas id="barChartInventory"></canvas>
                                </div>
                                <div class="text-center" style="padding-top: 20px">
                                    <h3><b>Top 10 sản phẩm tồn kho nhiều nhất</b></h3>
                                </div>
                            </div>
                            <hr>
                            <div style="padding-bottom: 30px">
                                <div class="chart-container">
                                    <canvas id="categoryChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                                <div class="text-center" style="padding-top: 20px">
                                    <h3><b>Số lượng sản phẩm theo danh mục</b></h3>
                                </div>
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
        var nameProducts = <?php echo ($productNames)?>;
        var sumProducts = <?php echo $productSums?>;
        var countCategories = <?php echo $countCategories?>;
        var productNameInventories = <?php echo ($productNameInventories)?>;
        var productInventories = <?php echo ($productInventories)?>;

        var barChart = document.getElementById('barChart').getContext('2d');
        var barChartInventory = document.getElementById('barChartInventory').getContext('2d');
        var categoryChart = document.getElementById('categoryChart').getContext('2d');

        var myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
                labels: nameProducts,
                datasets: [{
                    label: "Số lượng",
                    backgroundColor: 'rgb(23, 125, 255)',
                    borderColor: 'rgb(23, 125, 255)',
                    data: sumProducts,
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

        var myBarChartInventory = new Chart(barChartInventory, {
            type: 'bar',
            data: {
                labels: productNameInventories,
                datasets: [{
                    label: "Tồn kho",
                    backgroundColor: 'rgb(23, 125, 255)',
                    borderColor: 'rgb(23, 125, 255)',
                    data: productInventories,
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


        var myCategoryChart = new Chart(categoryChart, {
            type: 'pie',
            data: {
                datasets: [{
                    data: countCategories,
                    backgroundColor: ["#1d74f3", "#7ba45d", "#f4afcb", "#a3a4cd", "#c6545d", "#3f5b9d"],
                    borderWidth: 0
                }],
                labels: <?php echo $categories?>
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        fontColor: 'rgb(154, 154, 154)',
                        fontSize: 11,
                        usePointStyle: true,
                        padding: 20
                    }
                },
                pieceLabel: {
                    render: 'percentage',
                    fontColor: 'white',
                    fontSize: 14,
                },
                tooltips: false,
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20
                    }
                }
            }
        })

    </script>

@endsection
