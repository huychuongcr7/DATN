<div class="card-body">
    <div class="form-group form-show-validation row @error('product_code') has-error @enderror">
        <label for="product_code" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Mã sản phẩm
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Nhập mã sản phẩm" value="{{ old('product_code', isset($product->product_code) ? $product->product_code : null) }}">
            @error('product_code')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('name') has-error @enderror">
        <label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Tên sản phẩm
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm" value="{{ old('name', isset($product->name) ? $product->name : null) }}">
            @error('name')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('image_url') has-error @enderror">
        <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Hình ảnh</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <div class="input-file input-file-image">
                <img class="img-upload-preview" width="150" height="150" src="{{ isset($product->image_url) ? asset($product->image_url) : 'http://placehold.it/150x150' }}" alt="preview">
                <input type="file" class="form-control form-control-file" id="image_url" name="image_url" accept="image/*">
                @error('image_url')
                <label class="error">{{ $message }}</label>
                @enderror
                <label for="image_url" class="label-input-file btn btn-primary btn-round">
                    <span class="btn-label">
                        <i class="fa fa-file-image"></i>
                    </span>Hình ảnh
                </label>
            </div>
        </div>
    </div>
    <div class="form-group form-show-validation row @error('category_id') has-error @enderror">
        <label for="category_id" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Danh mục sản phẩm
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <div class="select2-input">
                @php
                    $selectCategory = old('category_id') ?? $product->category_id ?? null;
                @endphp
                <select id="category_id" name="category_id" class="form-control">
                    <option value="">Vui lòng chọn</option>
                    @foreach($categories as $key => $category)
                        <option value="{{ $key }}"
                                @if ($key == $selectCategory)
                                selected="selected"
                            @endif
                        >{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('trademark_id') has-error @enderror">
        <label for="trademark_id" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Thương hiệu</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <div class="select2-input">
                @php
                    $selectTrademark = old('trademark_id') ?? $product->trademark_id ?? null;
                @endphp
                <select id="trademark_id" name="trademark_id" class="form-control">
                    <option value="">Vui lòng chọn</option>
                    @foreach($trademarks as $key => $trademark)
                        <option value="{{ $key }}"
                                @if ($key == $selectTrademark)
                                selected="selected"
                            @endif
                        >{{ $trademark }}</option>
                    @endforeach
                </select>
            </div>
            @error('trademark_id')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('sale_price') has-error @enderror">
        <label for="sale_price" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Giá bán
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="number" class="form-control" id="sale_price" name="sale_price" placeholder="Nhập giá bán" value="{{ old('sale_price', isset($product->sale_price) ? $product->sale_price : null) }}">
            @error('sale_price')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('entry_price') has-error @enderror">
        <label for="entry_price" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Giá gốc
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="number" class="form-control" id="entry_price" name="entry_price" placeholder="Nhập giá gốc" value="{{ old('entry_price', isset($product->entry_price) ? $product->entry_price : null) }}">
            @error('entry_price')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('inventory') has-error @enderror">
        <label for="inventory" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Tồn kho
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="number" class="form-control" id="inventory" name="inventory" placeholder="Nhập tồn kho" value="{{ old('inventory', isset($product->inventory) ? $product->inventory : null) }}">
            @error('inventory')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('location') has-error @enderror">
        <label for="location" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Địa điểm đặt hàng</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="location" name="location" placeholder="Nhập địa điểm" value="{{ old('location', isset($product->location) ? $product->location : null) }}">
            @error('location')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('inventory_level_min') has-error @enderror">
        <label for="inventory_level_min" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Định mức tồn bé nhất
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="number" class="form-control" id="inventory_level_min" name="inventory_level_min" placeholder="Nhập định mức tồn" value="{{ old('inventory_level_min', isset($product->inventory_level_min) ? $product->inventory_level_min : 0) }}">
            @error('inventory_level_min')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('inventory_level_max') has-error @enderror">
        <label for="inventory_level_max" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Định mức tồn lớn nhất
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="number" class="form-control" id="inventory_level_max" name="inventory_level_max" placeholder="Nhập định mức tồn" value="{{ old('inventory_level_max', isset($product->inventory_level_max) ? $product->inventory_level_max : 10) }}">
            @error('inventory_level_max')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('description') has-error @enderror">
        <label for="description" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Mô tả</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <textarea class="form-control" id="description" name="description" placeholder="Nhập mô tả">{{ old('description', isset($product->description) ? $product->description : null) }}</textarea>
            @error('description')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('note') has-error @enderror">
        <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Note</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="hidden" name="note" value="" id="note">
            <div id="summernote">{!! old('note', isset($product) ? html_entity_decode($product->note) : null) !!}</div>
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
            <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                <span class="btn-label">
                    <i class="fas fa-times"></i>
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
