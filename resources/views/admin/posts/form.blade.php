<div class="card-body">
    <div class="form-group form-show-validation row @error('post_code') has-error @enderror">
        <label for="post_code" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Mã bài đăng
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="post_code" name="post_code" placeholder="Nhập mã bài đăng" value="{{ old('post_code', isset($post->post_code) ? $post->post_code : null) }}">
            @error('post_code')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('title') has-error @enderror">
        <label for="title" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Tiêu đề bài đăng
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề" value="{{ old('title', isset($post->title) ? $post->title : null) }}">
            @error('title')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('img_url') has-error @enderror">
        <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Hình ảnh</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <div class="input-file input-file-image">
                <img class="img-upload-preview" width="150" height="150" src="{{ isset($post->img_url) ? asset('storage'.$post->img_url) : 'http://placehold.it/150x150' }}" alt="preview">
                <input type="file" class="form-control form-control-file" id="img_url" name="img_url" accept="image/*">
                @error('img_url')
                <label class="error">{{ $message }}</label>
                @enderror
                <label for="img_url" class="label-input-file btn btn-primary btn-round">
                    <span class="btn-label">
                        <i class="fa fa-file-image"></i>
                    </span>Hình ảnh
                </label>
            </div>
        </div>
    </div>
    <div class="form-group form-show-validation row @error('category_id') has-error @enderror">
        <label for="category_id" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Danh mục bài đăng
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <div class="select2-input">
                @php
                    $selectCategory = old('category_id') ?? $post->category_id ?? null;
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
    <div class="form-group form-show-validation row @error('description') has-error @enderror">
        <label for="description" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Mô tả</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="description" name="description" placeholder="Nhập mô tả" value="{{ old('description', isset($post->description) ? $post->description : null) }}">
            @error('description')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('content') has-error @enderror">
        <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Nội dung
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="hidden" name="content" value="" id="content">
            <div id="summernote">{!! old('content', isset($post) ? html_entity_decode($post->content) : null) !!}</div>
            @error('content')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
</div>

<div class="card-action">
    <div class="form-group row">
        <label class="col-lg-3"></label>
        <div class="col-lg-6">
            <a class="btn btn-default" href="{{ route('admin.posts.index') }}">
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
