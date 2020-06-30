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
                                    <canvas id="barChartRevenue"></canvas>
                                </div>
                                <div class="text-center" style="padding-top: 20px">
                                    <h3><b>Top 10 sản phẩm doanh thu cao nhất trong tháng</b></h3>
                                </div>
                            </div>
                            <hr>
                            <div style="padding-bottom: 30px">
                                <div id="chart-container">
                                    <canvas id="barChart"></canvas>
                                </div>
                                <div class="text-center" style="padding-top: 20px">
                                    <h3><b>Top 10 sản phẩm bán chạy theo số lượng trong tháng</b></h3>
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
        var productNameQuantities = <?php echo ($productNameQuantities)?>;
        var productSumQuantities = <?php echo $productSumQuantities?>;
        var productNameRevenues = <?php echo ($productNameRevenues)?>;
        var productSumRevenues = <?php echo $productSumRevenues?>;
        var productNameInventories = <?php echo ($productNameInventories)?>;
        var productInventories = <?php echo ($productInventories)?>;

        var barChartRevenue = document.getElementById('barChartRevenue').getContext('2d');
        var barChart = document.getElementById('barChart').getContext('2d');
        var barChartInventory = document.getElementById('barChartInventory').getContext('2d');

        var myBarChartRevenue = new Chart(barChartRevenue, {
            type: 'bar',
            data: {
                labels: productNameRevenues,
                datasets: [{
                    label: "Doanh thu",
                    backgroundColor: 'rgb(23, 125, 255)',
                    borderColor: 'rgb(23, 125, 255)',
                    data: productSumRevenues,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Số tiền'

                        }
                    }]
                },
                tooltips:{
                    callbacks: {
                        label: (item) => `${item.yLabel} VNĐ`,
                    },

                }
            }
        });

        var myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
                labels: productNameQuantities,
                datasets: [{
                    label: "Số lượng",
                    backgroundColor: 'rgb(23, 125, 255)',
                    borderColor: 'rgb(23, 125, 255)',
                    data: productSumQuantities,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Số lượng'

                        }
                    }]
                },
                tooltips:{
                    callbacks: {
                        label: (item) => `${item.yLabel} Sản phẩm`,
                    },

                }
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
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Số lượng'

                        }
                    }]
                },
                tooltips:{
                    callbacks: {
                        label: (item) => `${item.yLabel} Sản phẩm`,
                    },

                }
            }
        });

    </script>

@endsection
