<div class="card-body">
    <div class="form-group form-show-validation row @error('supplier_code') has-error @enderror">
        <label for="supplier_code" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Mã nhà cung cấp
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="supplier_code" name="supplier_code" placeholder="Nhập mã nhà cung cấp" value="{{ old('supplier_code', isset($supplier->supplier_code) ? $supplier->supplier_code : null) }}">
            @error('supplier_code')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('name') has-error @enderror">
        <label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Tên nhà cung cấp
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên nhà cung cấp" value="{{ old('name', isset($supplier->name) ? $supplier->name : null) }}">
            @error('name')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('email') has-error @enderror">
        <label for="email" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Email</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" value="{{ old('email', isset($supplier->email) ? $supplier->email : null) }}">
            @error('email')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('address') has-error @enderror">
        <label for="address" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Địa chỉ</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" value="{{ old('address', isset($supplier->address) ? $supplier->address : null) }}">
            @error('address')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('phone') has-error @enderror">
        <label for="phone" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Điện thoại</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="number" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" value="{{ old('phone', isset($supplier->phone) ? $supplier->phone : null) }}">
            @error('phone')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('company') has-error @enderror">
        <label for="company" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Công ty</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="company" name="company" placeholder="Nhập công ty" value="{{ old('company', isset($supplier->company) ? $supplier->company : null) }}">
            @error('company')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('tax_code') has-error @enderror">
        <label for="tax_code" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Mã số thuế</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="number" class="form-control" id="tax_code" name="tax_code" placeholder="Nhập mã số thuế" value="{{ old('tax_code', isset($supplier->tax_code) ? $supplier->tax_code : null) }}">
            @error('tax_code')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('note') has-error @enderror">
        <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Note</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="hidden" name="note" value="" id="note">
            <div id="summernote">{!! old('note', isset($supplier) ? html_entity_decode($supplier->note) : null) !!}</div>
            @error('note')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
</div>

<div class="card-action">
    <div class="form-group row">
        <label class="col-lg-3"></label>
        <div class="col-lg-6">
            <a class="btn btn-default" href="{{ route('admin.suppliers.index') }}">
                <span class="btn-label">
                    <i class="fas fa-times"></i>
                </span>Hủy
            </a>
            <button class="btn btn-success" type="submit">
                <span class="btn-label">
                    <i class="fas fa-check"></i>
                </span>Xác nhận
            </button>
        </div>
    </div>
</div>

@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#summernote').summernote({
                callbacks: {
                    onInit: function () {
                        $('#note').val($('#summernote').summernote('code'));
                    },
                    onChange: function (contents) {
                        $('#note').val(contents.replace('&lt;script&gt;', '').replace('&lt;/script&gt;', ''));
                    },
                },
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                tabsize: 2,
                height: 300
            });
        });
    </script>
@endsection
