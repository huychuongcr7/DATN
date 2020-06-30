@extends('layouts.backend.admin')

@section('title', 'Thông tin Đơn hàng')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý Đơn hàng',
            'url' => route('admin.bills.index')
            ],
            [
                'text' => 'Thông tin Đơn hàng',
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
                            <div class="card-title"><b>@yield('title')</b></div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                <tr>
                                    <th width="20%">ID</th>
                                    <td>{{ $bill->id }}</td>
                                </tr>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <td>{{ $bill->bill_code }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>{{ App\Models\Bill::$statuses[$bill->status] }}</td>
                                </tr>
                                <tr>
                                    <th>Khách hàng</th>
                                    <td>{{ $bill->customer->name }}</td>
                                </tr>
                                <tr>
                                    <th>Phân công cho</th>
                                    <td>@if (isset($bill->user_id)){{ $bill->user->name }} @endif</td>
                                </tr>
                                <tr>
                                    <th>Tổng tiền hàng</th>
                                    <td>{{ App\Helper\Helper::formatMoney($bill->total_money) }} VNĐ</td>
                                </tr>
                                <tr>
                                    <th>Khách đã trả</th>
                                    <td>{{ App\Helper\Helper::formatMoney($bill->paid_by_customer) }} VNĐ</td>
                                </tr>
                                <tr>
                                    <th>Thời gian hoàn thành</th>
                                    <td>{{ $bill->time_of_sale ? $bill->time_of_sale->format('Y-m-d H:i') : null }}</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ nhận hàng</th>
                                    <td>{{ $bill->address_receive }}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td>{{ $bill->phone_receive }}</td>
                                </tr>
                                <tr>
                                    <th>Ghi chú</th>
                                    <td>{!! $bill->note !!}</td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $bill->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $bill->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <hr>
                            <br>
                            <h3><b>Chi tiết đơn hàng</b></h3>
                            <div class="table-responsive" style="padding-left: 75px; padding-right: 75px">
                                <table id="basic-datatables" class="display table table-striped table-hover dataTable no-footer">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Số tiền</th>
                                    </tr>
                                    </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <a class="text-center my-3" href="{{ route('admin.products.show', $product['id']) }}">{{ $product['name'] }}</a>
                                            </td>
                                            <td>
                                                @if(isset($product['image_url']))
                                                    <img src="{{ asset($product['image_url']) }}"
                                                         class="img-upload-preview" width="100" height="100" alt="preview">
                                                @endif
                                            </td>
                                            <td>{{ App\Helper\Helper::formatMoney($product['sale_price']) }} VNĐ</td>
                                            <td>{{ $product['quantity'] }}</td>
                                            <td>{{ App\Helper\Helper::formatMoney($product['sale_price']*$product['quantity']) }} VNĐ</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card-action">
                            <div class="form-group row">
                                <label class="col-lg-3"></label>
                                <div class="col-lg-6">
                                    <a class="btn btn-default" href="{{ route('admin.bills.index') }}">
                                        <span class="btn-label">
                                            <i class="fa fa-arrow-left"></i>
                                        </span>Quay lại
                                    </a>
                                    <a class="btn btn-primary" href="{{ route('admin.bills.edit', $bill->id) }}" @if ($bill->status >= \App\Models\Bill::STATUS_COMPLETE) style="display: none" @endif>
                                        <span class="btn-label">
                                            <i class="fas fa-edit"></i>
                                        </span>Cập nhật
                                    </a>
                                        @if($bill->status == 1)
                                            <button type="button" data-toggle="modal" data-target="{{ '#confirmModal' }}" class="btn btn-success">
                                                <span><i class="fa fa-check"></i></span>Xác nhận
                                            </button>
                                        @elseif($bill->status == 2)
                                            <button type="button" data-toggle="modal" data-target="{{ '#assignedModal' }}" class="btn btn-success">
                                                <span><i class="fas fa-user-tag"></i></span>Phân công
                                            </button>
                                        @elseif($bill->status == \App\Models\Bill::STATUS_DELIVERED)
                                            <button type="button" data-toggle="modal" data-target="{{ '#completeModal' }}" class="btn btn-success">
                                                <span><i class="fa fa-check"></i></span>Hoàn thành
                                            </button>
                                        @endif
                                    <button type="button" data-toggle="modal" data-target="{{ '#cancelModal' }}" class="btn btn-danger" @if ($bill->status == \App\Models\Bill::STATUS_COMPLETE || $bill->status == \App\Models\Bill::STATUS_CANCEL) style="display: none" @endif>
                                        <span><i class="fa fa-times"></i></span>Hủy bỏ
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Modal confirm -->
                        <div class="modal fade" id="{{ 'confirmModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xác nhận đơn hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc muốn xác nhận đơn hàng không?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <form class="form-group" method="POST" action="{{ route('admin.bills.confirm', $bill->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-success" type="submit">Xác nhận</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal assigned -->
                        <div class="modal fade" id="{{ 'assignedModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Phân công đơn hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex flex-wrap overflow-auto">
                                            @foreach($users as $user)
                                                <div class="col-3 p-2 position-relative">
                                                    <input type="hidden" id="user_id" value="{{ $user->id }}">
                                                    <div class="img-thumbnail shipper">
                                                        <div class="photo-box w-100 position-relative">
                                                            <img src="{{ $user->avatar ? $user->avatar : 'http://placehold.it/100x100' }}" class="img-upload-preview" width="100" height="100" alt="preview"/>
                                                        </div>
                                                        <div class="col text-left">
                                                            <a class="text-center my-3" id="name">{{ $user->name }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button class="btn btn-success" type="submit" id="submit">Xác nhận</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal export -->
{{--                        <div class="modal fade" id="{{ 'exportModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                            <div class="modal-dialog" role="document">--}}
{{--                                <div class="modal-content">--}}
{{--                                    <div class="modal-header">--}}
{{--                                        <h5 class="modal-title" id="exampleModalLabel">Xuất hàng</h5>--}}
{{--                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                            <span aria-hidden="true">&times;</span>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-body">--}}
{{--                                        Bạn có chắc muốn xuất hàng không?--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-footer">--}}
{{--                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>--}}
{{--                                        <form class="form-group" method="POST" action="{{ route('admin.bills.export', $bill->id) }}">--}}
{{--                                            @csrf--}}
{{--                                            @method('PUT')--}}
{{--                                            <button class="btn btn-success" type="submit">Xác nhận</button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <!-- Modal complete -->
                        <div class="modal fade" id="{{ 'completeModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hoàn thành đơn hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc muốn hoàn thành đơn hàng không?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <form class="form-group" method="POST" action="{{ route('admin.bills.complete', $bill->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-success" type="submit">Xác nhận</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal cancel -->
                        <div class="modal fade" id="{{ 'cancelModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hủy đơn hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc muốn hủy đơn hàng không?
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-group" method="POST" action="{{ route('admin.bills.cancel', $bill->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <label>Lý do:</label>
                                            <input type="text" name="reason" class="form-control">
                                            <br>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            <button class="btn btn-success" type="submit">Xác nhận</button>
                                        </form>
                                    </div>
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
    <script type="text/javascript">
        $(document).ready(function () {
            var bill_id = <?php echo $bill->id ?>;
            $('.shipper').click(function () {
                var user_id = $(this).parent().find('#user_id').val();
                $(this).addClass('border-success bg-success');
                $('#name').addClass('text-white');

                $('#submit').click(function () {
                    $.ajax({
                        type:'POST',
                        url:'/admin/bills/assigned',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        data: { "bill_id" : bill_id, "user_id" : user_id },
                        success: function(data){
                        }
                    });
                    swal({
                        title: 'Đã phân công!',
                        text: 'Đơn hàng của bạn đã được phân công',
                        icon: 'success',
                        buttons : {
                            confirm: {
                                className : 'btn btn-primary'
                            }
                        }
                    });
                    setTimeout(function () {
                        location.reload(true);
                    }, 2000);
                });
            })
        })
    </script>
@endsection
