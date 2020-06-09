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
            @php($notifications = \App\Models\Notification::where('status', \App\Models\Notification::STATUS_UNREAD)->orderByDESC('created_at')->get())
            @php($count = $notifications->count())
            <li class="nav-item dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    @if($count)
                        <span class="notification">{{ $count }}</span>
                    @endif
                </a>
                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                    <li>
                        <div class="dropdown-title">Bạn có {{ $count }} thông báo mới</div>
                    </li>
                    <li>
                        <div class="notif-scroll scrollbar-outer">
                            <div class="notif-center">
                                @foreach($notifications as $notification)
                                    <a href="{{ route('admin.notifications.show', $notification->id) }}">
                                        <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
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
                        <a class="see-all" href="{{ route('admin.notifications.index') }}">Xem tất cả thông báo<i class="fa fa-angle-right"></i> </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="{{ asset('backend/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <li>
                        <div class="user-box">
                            <div class="avatar-lg"><img src="{{ asset('backend/img/profile.jpg') }}" alt="image profile" class="avatar-img rounded"></div>
                            <div class="u-text">
                                <h4>{{ Auth::user()->name }}</h4>
                                <p class="text-muted">{{ Auth::user()->email }}</p><a href="#" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Thông tin</a>
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
