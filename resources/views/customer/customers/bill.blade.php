@extends('layouts.frontend.client')
@section('inline_css')
    <style>
        .swal-footer {
            text-align: center;
        }
    </style>
@endsection

@section('title', 'Đơn hàng')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(/frontend/images/slider-1.jpg);"
         data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-5 mx-auto mt-lg-5 text-center">
                    <h1>ĐƠN HÀNG</h1>
                </div>
            </div>
        </div>

        <a href="#bills-section" class="smoothscroll arrow-down"><span class="icon-arrow_downward"></span></a>
    </div>

    <div class="site-section" id="bills-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 sidebar">
                    <div class="sidebar-box">
                        <div class="categories">
                            <h3>Tài khoản</h3>
                            <li><a href="{{ route('customers.index') }}">Thông tin</a></li>
                            <li><a href="{{ route('customers.get_bill') }}">Đơn hàng</a></li>
                            <li><a href="{{ route('customers.get_reset', Auth::id()) }}">Đổi mật khẩu</a></li>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 blog-content">
                    <div class="comment-form-wrap">
                        <h3 class="mb-5">Đơn hàng</h3>
                        @php($check = $bills->first())
                        @if(isset($check))
                        @foreach($bills as $key => $bill)
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col"><label class="text-black">STT</label></th>
                                    <th scope="col"><label class="text-black">Tên sản phẩm</label></th>
                                    <th scope="col"><label class="text-black">Hình ảnh</label></th>
                                    <th scope="col"><label class="text-black">Đơn giá</label></th>
                                    <th scope="col"><label class="text-black">Số lượng</label></th>
                                    <th scope="col"><label class="text-black">Số tiền</label></th>
                                </tr>
                                </thead>
                                @foreach($allProducts[$key] as $allProduct)
                                    <tbody>
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <a class="text-center my-3" href="{{ route('products.show', $allProduct['id']) }}">{{ $allProduct['name'] }}</a>
                                        </td>
                                        <td>
                                            @if(isset($allProduct['image_url']))
                                                <img src="{{ asset($allProduct['image_url']) }}"
                                                     class="img-upload-preview" width="100" height="100" alt="preview">
                                            @endif
                                        </td>
                                        <td>{{ App\Helper\Helper::formatMoney($allProduct['sale_price']) }} VNĐ</td>
                                        <td>{{ $allProduct['quantity'] }}</td>
                                        <td>{{ App\Helper\Helper::formatMoney($allProduct['sale_price']*$allProduct['quantity']) }} VNĐ</td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                                <h5 class="text-black">Tổng tiền: <span class="text-danger">{{ App\Helper\Helper::formatMoney($bill->total_money) }} VNĐ</span></h5>
                                <label class="text-black" style="font-size: 1.1rem"> Thời gian mua: {{ $bill->time_of_sale }}</label>
                                <br>
                                <label class="text-black" style="font-size: 1.1rem"> Trạng thái: <span class="text-danger">{{ \App\Models\Bill::$statuses[$bill->status] }}</span></label>
                                @if ($bill->status == 1)
                                    <br>
                                    <input type="hidden" value="{{ $bill->id }}" id="post_id">
                                    <button class="btn btn-danger" id="alert_demo">Hủy đơn</button>
                                @endif
                                <br>
                            <hr>
                        @endforeach
                        <div class="row mt-4">
                            <div class="col-md-9">
                                <div>{{ $bills->appends(request()->input())->links() }}</div>
                            </div>
                        </div>
                        @else
                            <div class="text-center">
                                <h3 class="text-black">Bạn chưa có đơn hàng nào</h3>
                                <a class="btn btn-primary" href ="{{ route('welcome') }}"> Mua ngay</a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $('#alert_demo').click(function(e) {
            swal({
                title: 'Hủy đơn hàng',
                text: "Bạn có chắc muốn hủy đơn hàng?",
                type: 'warning',
                buttons:{
                    confirm: {
                        text : 'Có',
                        className : 'btn btn-primary'
                    },
                    cancel: {
                        text : 'Không',
                        visible: true,
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    var bill_id = $(this).parent().parent().find('#post_id').val();
                    $.ajax({
                        url: '/customer/customers/bills',
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        data: { "bill_id" : bill_id },
                        success: function(result) {
                            console.log(result);
                        }
                    });
                    swal({
                        title: 'Đã hủy!',
                        text: 'Đơn hàng của bạn đã được hủy',
                        type: 'success',
                        buttons : {
                            confirm: {
                                className : 'btn btn-primary'
                            }
                        }
                    });
                    location.reload();
                } else {
                    swal.close();
                }
            });
        });
    </script>
@endsection
