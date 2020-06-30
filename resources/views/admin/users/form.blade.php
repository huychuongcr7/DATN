<div class="card-body">
    <div class="form-group form-show-validation row @error('name') has-error @enderror">
        <label for="name" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Tên
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="{{ old('name', isset($user->name) ? $user->name : null) }}">
            @error('name')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('email') has-error @enderror">
        <label for="email" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Email
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" value="{{ old('email', isset($user->email) ? $user->email : null) }}">
            @error('email')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('password') has-error @enderror">
        <label for="password" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Mật khẩu
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
            @error('password')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('password_confirmation') has-error @enderror">
        <label for="password_confirmation" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Xác nhận mật khẩu
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu">
            @error('password_confirmation')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('address') has-error @enderror">
        <label for="address" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Địa chỉ</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" value="{{ old('address', isset($user->address) ? $user->address : null) }}">
            @error('address')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('phone') has-error @enderror">
        <label for="phone" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Điện thoại</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" value="{{ old('phone', isset($user->phone) ? $user->phone : null) }}">
            @error('phone')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('avatar') has-error @enderror">
        <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Avatar</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <div class="input-file input-file-image">
                <img class="img-upload-preview" width="150" height="150" src="{{ isset($user->avatar) ? asset($user->avatar) : 'http://placehold.it/150x150' }}" alt="preview">
                <input type="file" class="form-control form-control-file" id="avatar" name="avatar" accept="image/*">
                @error('avatar')
                <label class="error">{{ $message }}</label>
                @enderror
                <label for="avatar" class="label-input-file btn btn-primary btn-round">
                    <span class="btn-label">
                        <i class="fa fa-file-image"></i>
                    </span>Avatar
                </label>
            </div>
        </div>
    </div>
    <div class="form-group form-show-validation row @error('role') has-error @enderror">
        <label for="role" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Vai trò
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <div class="select2-input">
                @php
                    $selectRole = old('role') ?? $user->role ?? null;
                @endphp
                <select id="role" name="role" class="form-control">
                    <option value="">Vui lòng chọn</option>
                    @foreach($userRoles as $key => $userRole)
                        <option value="{{ $key }}"
                                @if ($key == $selectRole)
                                selected="selected"
                            @endif
                        >{{ $userRole }}</option>
                    @endforeach
                </select>
            </div>
            @error('role')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('gender') has-error @enderror">
        <label for="gender" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Giới tính
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <div class="select2-input">
                @php
                    $selectGender = old('gender') ??  $user->gender ?? null;
                @endphp
                <select id="gender" name="gender" class="form-control">
                    <option value="">Vui lòng chọn</option>
                    @foreach($genders as $key => $gender)
                        <option value="{{ $key }}"
                        @if ($key == $selectGender)
                            selected="selected"
                         @endif
                        >{{ $gender }}</option>
                    @endforeach
                </select>
            </div>
            @error('gender')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
</div>

<div class="card-action">
    <div class="form-group row">
        <label class="col-lg-3"></label>
        <div class="col-lg-6">
            <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
