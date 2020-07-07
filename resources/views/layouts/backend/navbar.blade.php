<nav class="navbar navbar-header navbar-expand-lg">

    <div class="container-fluid">
        <div class="collapse" id="search-nav">
            <form class="navbar-left navbar-form nav-search mr-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-search pr-1">
                            <i class="fa fa-search search-icon"></i>
                        </button>
                    </div>
                    <input type="text" placeholder="Tìm kiếm ..." class="form-control">
                </div>
            </form>
        </div>
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            @php($notifications = \App\Models\Notification::where('status', \App\Models\Notification::STATUS_UNREAD)->where('user_id', Auth::id())->orderByDESC('created_at')->get())
            @php($count = $notifications->count())
            <li class="nav-item dropdown hidden-caret dropdown-notifications">
                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                        <span class="notification" id="notification">{{ $count ?? 0 }}</span>
                </a>
                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                    <li>
                        <div class="dropdown-title">Bạn có <span id="count">{{ $count ?? 0 }}</span> thông báo mới</div>
                    </li>
                    <li class="pusher">
                        <div class="notif-scroll scrollbar-outer">
                            <div class="notif-center">
                                @foreach($notifications as $notification)
                                    <a @if (Auth::id() == 1) href="{{ route('admin.notifications.show', $notification->id) }}"
                                       @elseif (Auth::id() == 2) href="{{ route('shipper.notifications.show', $notification->id) }}"
                                       @elseif (Auth::id() == 3) href="{{ route('stocker.notifications.show', $notification->id) }}" @endif>
                                        <div class="notif-icon notif-primary">
                                            <i class="fa @if($notification->type == \App\Models\Notification::TYPE_CREATE_ORDER) fa-cart-plus
                                                         @elseif($notification->type == \App\Models\Notification::TYPE_CANCEL_ORDER) fa-times-circle
                                                         @elseif($notification->type == \App\Models\Notification::TYPE_SMALLER_INVENTORY) fa-less-than
                                                         @else fa-greater-than @endif"></i>
                                        </div>
                                        <div class="notif-content">
                                            <span class="block">
                                                {{ $notification->title }}
                                            </span>
                                            <span class="time">{{ $notification->created_at->diffForHumans(now()) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="see-all" @if (Auth::id() == 1) href="{{ route('admin.notifications.index') }}"
                           @elseif (Auth::id() == 2) href="{{ route('shipper.notifications.index') }}"
                           @elseif (Auth::id() == 3) href="{{ route('stocker.notifications.index') }}" @endif>
                            Xem tất cả thông báo<i class="fa fa-angle-right"></i> </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="{{ asset(\App\Models\User::findOrFail(Auth::id())->avatar) }}" alt="..." class="avatar-img rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <li>
                        <div class="user-box">
                            <div class="avatar-lg"><img src="{{ asset(\App\Models\User::findOrFail(Auth::id())->avatar) }}" alt="image profile" class="avatar-img rounded"></div>
                            <div class="u-text">
                                <h4>{{ Auth::user()->name }}</h4>
                                <p class="text-muted">{{ Auth::user()->email }}</p><a href="{{ route('admin.users.show', Auth::id()) }}" class="btn btn-rounded btn-danger btn-sm">Xem thông tin</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Đăng xuất') }}
                        </a>                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
