<div class="card-body">
    <div class="form-group form-show-validation row @error('name') has-error @enderror">
        <label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Tên
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="{{ old('name', isset($category->name) ? $category->name : null) }}">
            @error('name')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
</div>

<div class="card-action">
    <div class="form-group row">
        <label class="col-lg-3"></label>
        <div class="col-lg-6">
            <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
                <span class="btn-label">
                    <i class="fas fa-arrow-left"></i>
                </span>Hủy
            </a>
            <button class="btn btn-primary" type="submit">
                <span class="btn-label">
                    <i class="fas fa-check"></i>
                </span>Xác nhận
            </button>
        </div>
    </div>
</div>
