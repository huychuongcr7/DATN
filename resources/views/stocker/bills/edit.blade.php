@extends('layouts.backend.admin')

@section('title', 'Cập nhật Đơn hàng')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
            'text' => 'Quản lý Đơn hàng',
            'url' => route('stocker.bills.index')
            ],
            [
                'text' => 'Cập nhật Đơn hàng',
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
                        <form method="POST" action="{{ route('stocker.bills.update', $bill->id) }}" enctype="multipart/form-data">
                            <input type="hidden" value="{{ $bill->id }}" name="id">
                            @csrf
                            @method('PUT')
                            @include('stocker.bills.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
