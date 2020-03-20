<div class="sidebar" data-background-color="dark">
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('backend/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }}
                            <span class="user-level">Quản trị viên</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">Thông tin</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Cập nhật thông tin</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Cài đặt</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-cube"></i>
                        <p>Quản lý hàng hóa</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Danh mục</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Thiết lập giá</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Kiểm kho</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-exchange-alt"></i>
                        <p>Giao dịch</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Hóa đơn</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Nhập hàng</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Trả hàng</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Xuất hủy</span>
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
                                <a href="#">
                                    <span class="sub-item">Nhà cung cấp</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-user"></i>
                        <p>Nhân viên</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Nhân viên</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Chấm công</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Bảng tính lương</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Thiết lập hoa hồng</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-hand-holding-usd"></i>
                        <p>Sổ quỹ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Báo cáo</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Cuối ngày</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Bán hàng</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Đặt hàng</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Hàng hóa</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Khách hàng</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Nhà cung cấp</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Nhân viên</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Tài chình</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
