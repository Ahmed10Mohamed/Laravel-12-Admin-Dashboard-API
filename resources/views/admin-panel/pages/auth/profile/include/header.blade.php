<ul class="nav nav-pills flex-column flex-md-row mb-4">
    <li class="nav-item">
        <a class="nav-link @if($page == 'profile') active @endif" @if($page == 'profile') href="javascript:void(0);" @else href="{{ route('Profile') }}" @endif
        ><i class="ti-xs ti tabler-users me-1"></i> الحساب</a
        >
    </li>
    <li class="nav-item">
        <a class="nav-link @if($page == 'password') active @endif" @if($page == 'password') href="javascript:void(0);" @else href="{{ route('Profile.Password') }}" @endif
        ><i class="ti-xs ti tabler-lock me-1"></i> كلمة المرور</a
        >
    </li>

</ul>
