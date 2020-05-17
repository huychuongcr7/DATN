@extends('layouts.frontend.client')
@section('title', 'Thông tin tài khoản')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(/frontend/images/hero_1.jpg);" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-5 mx-auto mt-lg-5 text-center">
                    <h1>THÔNG TIN TÀI KHOẢN</h1>
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
                        <h3 class="mb-5">Thông tin tài khoản</h3>
                        <form method="POST" action="{{ route('customers.update', $customer->id) }}" enctype="multipart/form-data" class="p-5 bg-light">
                            <input type="hidden" value="{{ $customer->id }}" name="id">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" @error('name') class="text-danger" @enderror>Tên</label>
                                <input type="text" class="form-control @error('name')ui-state-error @enderror" id="name" name="name" value="{{ old('name', isset($customer->name) ? $customer->name : null) }}">
                                @error('name')
                                <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" @error('email') class="text-danger" @enderror>Email</label>
                                <input type="text" class="form-control @error('email')ui-state-error @enderror" id="email" name="email" value="{{ old('email', isset($customer->email) ? $customer->email : null) }}">
                                @error('email')
                                <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth" @error('date_of_birth') class="text-danger" @enderror>Ngày sinh</label>
                                <input type="text" data-provide="datepicker" class="form-control @error('date_of_birth')ui-state-error @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', isset($customer->date_of_birth) ? $customer->date_of_birth : null) }}">
                                @error('date_of_birth')
                                <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address" @error('address') class="text-danger" @enderror>Địa chỉ</label>
                                <input type="text" class="form-control @error('address')ui-state-error @enderror" id="address" name="address" value="{{ old('address', isset($customer->address) ? $customer->address : null) }}">
                                @error('address')
                                <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone" @error('phone') class="text-danger" @enderror>Điện thoại</label>
                                <input type="text" class="form-control @error('phone')ui-state-error @enderror" id="phone" name="phone" value="{{ old('phone', isset($customer->phone) ? $customer->phone : null) }}">
                                @error('phone')
                                <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="avatar" @error('avatar') class="text-danger" @enderror>Avatar</label>
                                <div class="input-file input-file-image">
                                    <img id="preview" class="img-upload-preview" width="150" height="150" src="{{ isset($customer->avatar) ? asset('storage'.$customer->avatar) : 'http://placehold.it/150x150' }}" alt="preview">
                                    <input type="file" class="form-control form-control-file" id="avatar" name="avatar" accept="image/*" style="display: none">
                                    @error('avatar')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                    <label for="avatar" class="label-input-file btn btn-danger">
                                        <span class="btn-label">
                                            <i class="icon-image"></i>
                                        </span>Chọn ảnh
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 50px">
                                <input type="submit" value="Lưu" class="btn btn-primary">
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#date_of_birth').datepicker({
                format: 'yyyy-mm-dd',
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#avatar").change(function() {
                readURL(this);
            });
        });
    </script>
@endsection
