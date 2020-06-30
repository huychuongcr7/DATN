<div class="sidebar" data-background-color="dark">
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset(\App\Models\User::findOrFail(Auth::id())->avatar) }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }}
                            <span class="user-level">{{ \App\Models\User::$roles[Auth::user()->role] }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('admin.users.show', Auth::id()) }}">
                                    <span class="link-collapse">Thông tin</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.edit', Auth::id()) }}">
                                    <span class="link-collapse">Cập nhật thông tin</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                @can('admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}">
                            <i class="fas fa-cube"></i>
                            <p>Quản lý hàng hóa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#sidebarLayouts">
                            <i class="fas fa-exchange-alt"></i>
                            <p>Quản lý kho</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="sidebarLayouts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.bills.index') }}">
                                        <span class="sub-item">Đơn hàng</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.import_orders.index') }}">
                                        <span class="sub-item">Nhập hàng</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.check_inventories.index') }}">
                                        <span class="sub-item">Kiểm kho</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#forms">
                            <i class="fas fa-male"></i>
                            <p>Đối tác</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="forms">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.customers.index') }}">
                                        <span class="sub-item">Khách hàng</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.suppliers.index') }}">
                                        <span class="sub-item">Nhà cung cấp</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fas fa-user"></i>
                            <p>Quản lý tài khoản</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.posts.index') }}">
                            <i class="fas fa-file-alt"></i>
                            <p>Quản lý bài đăng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.contacts.index') }}">
                            <i class="fas fa-phone-square"></i>
                            <p>Quản lý liên hệ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#charts">
                            <i class="far fa-chart-bar"></i>
                            <p>Thống kê</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.charts.product') }}">
                                        <span class="sub-item">Sản phẩm</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.charts.customer') }}">
                                        <span class="sub-item">Khách hàng</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.charts.supplier') }}">
                                        <span class="sub-item">Nhà cung cấp</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan
                @can('shipper')
                    <li class="nav-item">
                        <a href="{{ route('shipper.bills.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <p>Đơn hàng được giao</p>
                        </a>
                    </li>
                @endcan
                @can('stocker')
                    <li class="nav-item">
                        <a href="{{ route('stocker.products.index') }}">
                            <i class="fas fa-cube"></i>
                            <span class="sub-item">Sản phẩm</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('stocker.bills.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="sub-item">Đơn hàng</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('stocker.import_orders.index') }}">
                            <i class="fas fa-file-import"></i>
                            <span class="sub-item">Nhập hàng</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('stocker.check_inventories.index') }}">
                            <i class="fas fa-calendar-check"></i>
                            <span class="sub-item">Kiểm kho</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
