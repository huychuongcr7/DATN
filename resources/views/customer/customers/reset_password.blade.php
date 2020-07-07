@extends('layouts.frontend.client')
@section('title', 'Đổi mật khẩu')

@section('content')

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(/frontend/images/grocery.png);" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-5 mx-auto mt-lg-5 text-center">
                    <h1>Đổi mật khẩu</h1>
                </div>
            </div>
        </div>
        <a href="#info" class="smoothscroll arrow-down"><span class="icon-arrow_downward"></span></a>
    </div>

    <div class="site-section" id="info">
        <div class="container">
            @include('flash::message')

            <div class="row">

                <div class="col-md-3 sidebar">
                    <div class="sidebar-box">
                        <div class="categories">
                            <h3>Tài khoản</h3>
                            <li><a href="{{ route('customers.index') }}">Thông tin</a></li>
                            <li><a href="{{ route('customers.get_bill') }}">Đơn hàng</a></li>
                            <li><a href="{{ route('customers.get_reset', $customer->id) }}">Đổi mật khẩu</a></li>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 blog-content">
                    <div class="comment-form-wrap">
                        <h3 class="mb-5">Đổi mật khẩu</h3>
                        <form method="POST" action="{{ route('customers.put_reset', $customer->id) }}" enctype="multipart/form-data" class="p-5 bg-light">
                            <input type="hidden" value="{{ $customer->id }}" name="id">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="password" @error('password') class="text-danger" @enderror>Mật khẩu hiện tại</label>
                                <input type="password" class="form-control @error('password')ui-state-error @enderror" id="password" name="password">
                                @error('password')
                                <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_new" @error('password_new') class="text-danger" @enderror>Mật khẩu mới</label>
                                <input type="password" class="form-control @error('password_new')ui-state-error @enderror" id="password_new" name="password_new">
                                @error('password_new')
                                <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" @error('password_confirmation') class="text-danger" @enderror>Mật khẩu xác nhận</label>
                                <input type="password" class="form-control @error('password_confirmation')ui-state-error @enderror" id="password_confirmation" name="password_confirmation">
                                @error('password_confirmation')
                                <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group" style="margin-top: 50px">
                                <input type="submit" value="Xác nhận" class="btn btn-primary">
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
