<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset(env('APP_LOGO')) }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{ env('APP_ABBREVIATION') }}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-group'></i>
                </div>
                <div class="menu-title">Staff</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.pins.index') }}"><i class="bx bx-right-arrow-alt"></i>
                        View Pins
                    </a>
                </li>
                <li> 
                    <a href="{{ route('admin.staffs.index') }}">
                        <i class="bx bx-right-arrow-alt"></i>View Registrations
                    </a>
                </li>
            </ul>
        </li>
        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-envelope'></i>
                </div>
                <div class="menu-title">Mails</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.mail.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Mail</a>
                </li>
                <li> <a href="{{ route('admin.mail.index') }}"><i class="bx bx-right-arrow-alt"></i>View Mails</a>
                </li>
            </ul>
        </li> --}}
        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-file'></i>
                </div>
                <div class="menu-title">Working Files</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.files.create') }}"><i class="bx bx-right-arrow-alt"></i>Upload Working
                        File
                    </a>
                </li>
                <li> <a href="{{ route('admin.files.index') }}"><i class="bx bx-right-arrow-alt"></i>View Working
                        Files</a>
                </li>
            </ul>
        </li> --}}
        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Sender Categories</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.category.list') }}"><i class="bx bx-right-arrow-alt"></i>View
                        Categories</a> </li>
                <li> <a href="{{ route('admin.category.create') }}"><i class="bx bx-right-arrow-alt"></i>Create
                        Category</a> </li>
            </ul>
        </li> --}}
        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-box'></i>
                </div>
                <div class="menu-title">Manage Destinations</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.destinations.list') }}"><i class="bx bx-right-arrow-alt"></i>View
                        Destinations</a> </li>
                <li> <a href="{{ route('admin.destinations.create') }}"><i class="bx bx-right-arrow-alt"></i>Create
                        Destinations</a> </li>
            </ul> --}}
        {{-- </li> --}}
        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-slider-alt'></i>
                </div>
                <div class="menu-title">Operations</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.excel.upload') }}"><i class="bx bx-upload"></i>Upload from Excel</a>
                </li>
            </ul>
        </li> --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Manage Users</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.users.all') }}"><i class="bx bx-zoom-in"></i>View Users</a> </li>
                <li> <a href="{{ route('admin.users.create') }}"><i class="bx bx-user-plus"></i>Create Users</a> </li>
            </ul>
        </li>
        <li> <a href="{{ route('admin.logout') }}" onclick="return confirm('Are You Sure?')"><i
                    class="bx bx-logout"></i>Logout</a> </li>
    </ul>
    <!--end navigation-->
</div>
