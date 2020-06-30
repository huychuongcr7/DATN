<div class="card-body">
    <div id="app">
        <bill-form
            all-products="{{ json_encode($products) }}"
            bill-detail="{{ json_encode(!empty(old('bill_products')) ? old('bill_products') : (isset($billProducts) ? $billProducts : null)) }}"
            sv-errors="{{ json_encode($errors->messages()) }}"
            href="{{ route('stocker.products.show', ['id' => '%id%']) }}"
        ></bill-form>
    </div>
    <script src="/js/app.js"></script>
</div>

<div class="card-action">
    <div class="form-group row">
        <label class="col-lg-3"></label>
        <div class="col-lg-6">
            <a class="btn btn-default" href="{{ route('stocker.bills.index') }}">
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
