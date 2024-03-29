@extends('layouts.frontend.client')
@section('title', 'Thanh toán')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(/frontend/images/grocery.png);" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-5 mx-auto mt-lg-5 text-center">
                    <h1>Thanh toán</h1>
                </div>
            </div>
        </div>

        <a href="#properties-section" class="smoothscroll arrow-down"><span class="icon-arrow_downward"></span></a>
    </div>

    <div class="site-section" id="properties-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h2 class="section-title mb-3">thanh toán</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <form method="post" action="{{ route('customers.store_bill') }}">
                @csrf
                <h5 class="text-black">Thông tin khách hàng</h5>
                <div>
                    <label class="text-black" style="font-size: 1.1rem">Họ tên: {{ $customer->name }}</label>
                    <label class="text-black" style="font-size: 1.1rem; padding-left: 150px">Email: {{ $customer->email }}</label>
                    <label class="text-black" style="font-size: 1.1rem; padding-left: 150px">Số điện thoại: {{ $customer->phone }}</label>
                </div>
                @if (isset($customer->address))
                    <label class="text-black" style="font-size: 1.2rem;">Địa chỉ nhận hàng: </label>
                    <div>
                        <input class="select-address" type="radio" name="select_address" value="0" @if (old('select_address') == 0) checked="checked" @endif>
                        <label class="text-black" style="font-size: 1.1rem; padding-left: 15px">Mặc định: <span class="text-danger">{{ $customer->address }}</span></label>
                    </div>
                    <div>
                        <input class="select-address" id="setting-address" type="radio" name="select_address" value="1" @if (old('select_address') == 1) checked="checked" @endif>
                        <label class="text-black" style="font-size: 1.1rem; padding-left: 15px">Tùy chọn</label>
                    </div>
                    <div class="col-md-9 form-group address-other" style="padding-left: 0">
                        <label class="text-black" style="font-size: 1.1rem">Địa chỉ:</label>
                        <input type="text" name="address_other" class="form-control @error('address_other')ui-state-error @enderror">
                        @error('address_other')
                        <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <br>
                @else
                    <p class="text-danger" style="font-size: 1.1rem;">Bạn chưa có địa chỉ nhận hàng. Vui lòng nhập địa chỉ nhận hàng hoặc cập nhật địa chỉ cá nhân!</p>
                    <div class="col-md-9 form-group" style="padding-left: 0">
                        <label class="text-black" style="font-size: 1.1rem">Địa chỉ:</label>
                        <input type="text" name="address" class="form-control @error('address')ui-state-error @enderror" value="{{ old('address') }}">
                        @error('address')
                        <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <br>
                @endif
                <div class="col-md-9 form-group" style="padding-left: 0; padding-bottom: 30px">
                    <label class="text-black" style="font-size: 1.1rem">Ghi chú:</label>
                    <textarea name="note" class="form-control"></textarea>
                </div>
                <h5 class="text-black">Thông tin sản phẩm</h5>
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
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $product['name'] }}</td>
                            <td>
                                @if(isset($product['image_url']))
                                    <img src="{{ asset($product['image_url']) }}" class="img-upload-preview" width="100" height="100" alt="preview">
                                @endif
                            </td>
                            <td>{{ App\Helper\Helper::formatMoney($product['sale_price']) }} VNĐ</td>
                            <td>{{ $product['quantity'] }}</td>
                            <td>{{ App\Helper\Helper::formatMoney($product['sale_price']*$product['quantity']) }} VNĐ</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <input type="hidden" value="{{ $totalMoney }}" name="total_money">
                <h4 class="text-black text-right">Tổng tiền: <span class="text-danger">{{ App\Helper\Helper::formatMoney($totalMoney) }} VNĐ</span></h4>
                <h5 class="text-black">Phương thức thanh toán: </h5>
                <div>
                    <input class="select-pay" type="radio" name="payment_method" id="pay-transfer" value="1" @if (old('select_pay') == 1) checked="checked" @endif><label class="text-black" style="font-size: 1.1rem; padding-left: 15px; padding-right: 20px">Chuyển khoản</label>
                    <input class="select-pay" type="radio" name="payment_method" value="2" @if (old('select_pay') == 2) checked="checked" @endif><label class="text-black" style="font-size: 1.1rem; padding-left: 15px">Thanh toán khi nhận hàng</label>
                </div>
                <div>
                    <label class="text-black" id="account" style="font-size: 1.2rem; margin-bottom: 25px">Số tài khoản: <span class="text-danger">123456789</span></label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Đặt hàng</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('inline_scripts')
    <script type="text/javascript">
        selectAddress();
        $(".select-address").change(function () {
            selectAddress();
        });
        function selectAddress() {
            if ($("#setting-address").is(':checked')) {
                $(".address-other").show()
            } else {
                $(".address-other").hide()
            }
        }

        selectPay();
        $(".select-pay").change(function () {
            selectPay();
        });
        function selectPay() {
            if ($("#pay-transfer").is(':checked')) {
                $("#account").show()
            } else {
                $("#account").hide()
            }
        }
    </script>
@endsection
