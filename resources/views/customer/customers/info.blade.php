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
            <div class="form-group row">
                <label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right text-black">Tên</label>
                <div class="col-lg-6 col-md-9 col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right text-black">Email</label>
                <div class="col-lg-6 col-md-9 col-sm-8">
                    <input type="text" class="form-control" id="email" name="email" value="{{ $customer->email }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="date_of_birth" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right text-black">Ngày sinh</label>
                <div class="col-lg-6 col-md-9 col-sm-8">
                    <input type="text" data-provide="datepicker" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $customer->date_of_birth }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right text-black">Địa chỉ</label>
                <div class="col-lg-6 col-md-9 col-sm-8">
                    <input type="text" class="form-control" id="address" name="address" value="{{ $customer->address }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right text-black">Điện thoại</label>
                <div class="col-lg-6 col-md-9 col-sm-8">
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right text-black">Avatar</label>
                <div class="col-lg-6 col-md-9 col-sm-8">
                    <div class="input-file input-file-image">
                        <img id="preview" class="img-upload-preview" width="150" height="150" src="{{ isset($customer->avatar) ? asset('storage'.$customer->avatar) : 'http://placehold.it/150x150' }}" alt="preview">
                        <input type="file" class="form-control form-control-file" id="avatar" name="avatar" accept="image/*" style="display: none">
                        <label for="avatar" class="label-input-file btn btn-primary btn-round">
                            <span class="btn-label">
                                <i class="icon-image"></i>
                            </span>Chọn ảnh
                        </label>
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
