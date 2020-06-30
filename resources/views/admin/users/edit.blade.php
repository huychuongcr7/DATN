@extends('layouts.backend.admin')

@section('title', 'Cập nhật Tài khoản')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý Tài khoản',
            'url' => route('admin.users.index')
            ],
            [
                'text' => 'Cập nhật Tài khoản',
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
                        <form id="validation" method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
                            <input type="hidden" value="{{ $user->id }}" name="id">
                            @csrf
                            @method('PUT')
                            @include('admin.users.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
