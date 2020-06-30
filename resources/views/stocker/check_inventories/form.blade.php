<div class="card-body">
    <div id="app">
        <check-inventory-form
            all-products="{{ json_encode($products) }}"
            check-inventory-detail="{{ json_encode(!empty(old('check_inventory_products')) ? old('check_inventory_products') : (isset($checkInventoryProducts) ? $checkInventoryProducts : null)) }}"
            sv-errors="{{ json_encode($errors->messages()) }}"
            href="{{ route('stocker.products.show', ['id' => '%id%']) }}"
        ></check-inventory-form>
    </div>
    <script src="/js/app.js"></script>
    <div class="form-group form-show-validation row @error('check_inventory_code') has-error @enderror">
        <label for="check_inventory_code" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Mã kiểm kho
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="check_inventory_code" name="check_inventory_code" placeholder="Nhập mã đơn" value="{{ old('check_inventory_code', isset($checkInventory->check_inventory_code) ? $checkInventory->check_inventory_code : null) }}">
            @error('check_inventory_code')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('time_check') has-error @enderror">
        <label for="time_check" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Thời gian kiểm tra
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <div class="input-group">
                <input type="text" class="form-control" id="time_check" name="time_check" value="{{ old('time_check', isset($checkInventory->time_check) ? $checkInventory->time_check : now()->format('Y-m-d H:i')) }}">
                @error('time_check')
                <label class="error">{{ $message }}</label>
                @enderror
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group form-show-validation row @error('note') has-error @enderror">
        <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Ghi chú</label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="hidden" name="note" value="" id="note">
            <div id="summernote">{!! old('note', isset($checkInventory) ? html_entity_decode($checkInventory->note) : null) !!}</div>
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
            <a class="btn btn-default" href="{{ route('stocker.check_inventories.index') }}">
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
