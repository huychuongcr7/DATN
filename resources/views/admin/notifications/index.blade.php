@extends('layouts.backend.admin')

@section('title', 'Danh sách thông báo')

@section('content')

    <div class="content content-full">
        <div class="page-navs bg-white">
            <div class="nav-scroller">
                <div class="nav nav-tabs nav-line nav-color-primary">
                    <a class="nav-link active show" data-toggle="tab" href="#tab1">All
                        <span class="count ml-1">{{ $notifications->count() }}</span>
                    </a>
                    <a class="nav-link" data-toggle="tab" href="#tab2">Starred</a>
                    <a class="nav-link" data-toggle="tab" href="#tab3">Trash</a>
                </div>
            </div>
            <div class="page-with-aside mail-wrapper bg-white">
                <div class="page-content mail-content" style="width: 1232px">
                    <div class="inbox-body">
                        @foreach($notifications as $notification)
                        <div class="email-list">
                            <input type="hidden" id="notify_id" value="{{ $notification->id }}">
                            <div class="email-list-item @if ($notification->status == \App\Models\Notification::STATUS_UNREAD) unread @endif show-notify">
                                <i class="fas fa-bell"></i>
                                <div class="email-list-detail">
                                    <span class="date float-right"><i class="fa fa-paperclip paperclip"></i> {{ $notification->created_at->diffForHumans(now()) }}</span><span class="from">{{ $notification->title }}</span>
                                    <p class="msg">{{ $notification->content }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.show-notify').click(function () {
                var notify_id = $(this).parent().find('#notify_id').val();
                window.location.replace("/admin/notifications/" + (notify_id));
            });
        })
    </script>
@endsection
