<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset(env('APP_LOGO') )}}" class="logo-icon" style="width:80%"
                alt="logo icon">
        </div>
        <div>
            {{-- <h4 class="logo-text">{{ env('APP_ABBREVIATION') }}</h4> --}}
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li> <a href="{{ route('user.logout') }}" onclick="return confirm('Are You Sure?')"><i class="bx bx-logout"></i>Logout</a> </li>                
    </ul>
    <!--end navigation-->
</div>
