<div class="card-body">
    <div id="app">
        <import-order-form
            all-products="{{ json_encode($products) }}"
            import-order-detail="{{ json_encode(!empty(old('import_order_products')) ? old('import_order_products') : (isset($importOrderProducts) ? $importOrderProducts : null)) }}"
            sv-errors="{{ json_encode($errors->messages()) }}"
        ></import-order-form>
    </div>
    <script src="/js/app.js"></script>
    <div class="form-group form-show-validation row @error('import_order_code') has-error @enderror">
        <label for="import_order_code" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Mã đơn nhập hàng
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="import_order_code" name="import_order_code" placeholder="Nhập mã đơn" value="{{ old('import_order_code', isset($importOrder->import_order_code) ? $importOrder->import_order_code : null) }}">
            @error('import_order_code')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('supplier_id') has-error @enderror">
        <label for="supplier_id" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Nhà cung cấp
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <div class="select2-input">
                @php
                    $selectSupplier = old('supplier_id') ?? $importOrder->supplier_id ?? null;
                @endphp
                <select id="supplier_id" name="supplier_id" class="form-control">
                    <option value="">Vui lòng chọn</option>
                    @foreach($suppliers as $key => $supplier)
                        <option value="{{ $key }}"
                                @if ($key == $selectSupplier)
                                selected="selected"
                            @endif
                        >{{ $supplier }}</option>
                    @endforeach
                </select>
            </div>
            @error('supplier_id')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('paid_to_supplier') has-error @enderror">
        <label for="paid_to_supplier" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Đã trả NCC
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="number" class="form-control" id="paid_to_supplier" name="paid_to_supplier" placeholder="Nhập số tiền" value="{{ old('paid_to_supplier', isset($importOrder->paid_to_supplier) ? $importOrder->paid_to_supplier : 0) }}">
            @error('paid_to_supplier')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('time_of_import') has-error @enderror">
        <label for="time_of_import" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Thời gian nhập
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <div class="input-group">
                <input type="text" class="form-control" id="time_of_import" name="time_of_import" value="{{ old('time_of_import', isset($importOrder->time_of_import) ? $importOrder->time_of_import : now()->format('Y-m-d H:i')) }}">
                @error('time_of_import')
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
            <div id="summernote">{!! old('note', isset($importOrder) ? html_entity_decode($importOrder->note) : null) !!}</div>
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
            <a class="btn btn-default" href="{{ route('stocker.import_orders.index') }}">
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
