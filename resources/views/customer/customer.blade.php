<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
Login success {{ Auth::user()->name }}
<a class="dropdown-item" href="{{ route('customer.logout') }}"
   onclick="event.preventDefault();
   document.getElementById('logout-form').submit();">
    {{ __('Đăng xuất') }}
</a>
<div class="dropdown-divider"></div>
<form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
</body>
</html>
