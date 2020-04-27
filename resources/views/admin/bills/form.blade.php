<div class="card-body">
    <div id="app">
        <bill-form
            all-products="{{ json_encode($products) }}"
            bill-detail="{{ json_encode(!empty(old('bill_products')) ? old('bill_products') : (isset($billProducts) ? $billProducts : null)) }}"
            sv-errors="{{ json_encode($errors->messages()) }}"
            href="{{ route('admin.products.show', ['id' => '%id%']) }}"
        ></bill-form>
    </div>
    <script src="/js/app.js"></script>
    <div class="form-group form-show-validation row @error('bill_code') has-error @enderror">
        <label for="bill_code" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Mã hóa đơn
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="text" class="form-control" id="bill_code" name="bill_code" placeholder="Nhập mã đơn" value="{{ old('bill_code', isset($bill->bill_code) ? $bill->bill_code : null) }}">
            @error('bill_code')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('customer_id') has-error @enderror">
        <label for="customer_id" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Khách hàng
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <div class="select2-input">
                @php
                $selectCustomer = old('customer_id') ?? $bill->customer_id ?? null;
                @endphp
                <select id="customer_id" name="customer_id" class="form-control">
                    <option value="">Vui lòng chọn</option>
                    @foreach($customers as $key => $customer)
                    <option value="{{ $key }}"
                            @if ($key == $selectCustomer)
                            selected="selected"
                            @endif
                    >{{ $customer }}</option>
                    @endforeach
                </select>
            </div>
            @error('customer_id')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('paid_by_customer') has-error @enderror">
        <label for="paid_by_customer" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Khách đã thanh toán
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <input type="number" class="form-control" id="paid_by_customer" name="paid_by_customer" placeholder="Nhập số tiền" value="{{ old('paid_by_customer', isset($bill->paid_by_customer) ? $bill->paid_by_customer : 0) }}">
            @error('paid_by_customer')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-show-validation row @error('time_of_sale') has-error @enderror">
        <label for="time_of_sale" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Thời gian bán
            <span class="required-label">*</span>
        </label>
        <div class="col-lg-6 col-md-9 col-sm-8">
            <div class="input-group">
                <input type="text" class="form-control" id="time_of_sale" name="time_of_sale" value="{{ old('time_of_sale', isset($bill->time_of_sale) ? $bill->time_of_sale : now()->format('Y-m-d H:i')) }}">
                @error('time_of_sale')
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
            <div id="summernote">{!! old('note', isset($bill) ? html_entity_decode($bill->note) : null) !!}</div>
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
            <a class="btn btn-default" href="{{ route('admin.bills.index') }}">
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
