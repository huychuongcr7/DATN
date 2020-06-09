@extends('layouts.backend.admin')

@section('title', 'Chi tiết thông báo')

@section('content')

    <div class="content content-full">
        <div class="page-inner page-inner-fill">
            <div class="page-with-aside mail-wrapper bg-white">
                <div class="page-content mail-content" style="width: 1232px; padding-left: 50px">
                    <div class="email-head">
                        <h3>
                            <i class="fas fa-bell"></i>
                            {{ $notification->title }}
                        </h3>
                    </div>
                    <div class="email-body">
                        <p>{{ $notification->content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
