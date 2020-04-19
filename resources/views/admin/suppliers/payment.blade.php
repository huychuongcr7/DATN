@extends('layouts.backend.admin')

@section('title', 'Thanh toán Nhà cung cấp')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý Nhà cung cấp',
            'url' => route('admin.suppliers.index')
            ],
            [
                'text' => 'Thanh toán Nhà cung cấp',
            ],
        ]
    ])
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><b>@yield('title')</b></div>
                        </div>
                        <form id="validation" method="post"
                              action="{{ route('admin.suppliers.put_payment', $supplier->id) }}"
                              enctype="multipart/form-data">
                            <input type="hidden" value="{{ $supplier->id }}" name="id">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div id="app">
                                    <payment-component
                                        all-import-orders="{{ json_encode($importOrders) }}"
                                        suppliers="{{ json_encode($supplier) }}"
                                        sv-errors="{{ json_encode($errors->messages()) }}"
                                        old-total-payment="{{ json_encode(old('total_payment')) }}"
                                    ></payment-component>
                                </div>
                                <script src="/js/app.js"></script>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
