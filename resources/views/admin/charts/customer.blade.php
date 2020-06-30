@extends('layouts.backend.admin')

@section('title', 'Thống kê Khách hàng')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
                'text' => 'Thống kê Khách hàng',
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
                                    <canvas id="barChartCustomer"></canvas>
                                </div>
                                <div class="text-center" style="padding-top: 20px">
                                    <h3><b>Top 10 khách hàng mua nhiều nhất trong tháng</b></h3>
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
        var names= <?php echo ($names)?>;
        var sums = <?php echo $sums?>;

        var barChartCustomer = document.getElementById('barChartCustomer').getContext('2d');

        var myBarChartCustomer = new Chart(barChartCustomer, {
            type: 'bar',
            data: {
                labels: names,
                datasets: [{
                    label: "Mua hàng",
                    backgroundColor: 'rgb(23, 125, 255)',
                    borderColor: 'rgb(23, 125, 255)',
                    data: sums,
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

    </script>

@endsection
