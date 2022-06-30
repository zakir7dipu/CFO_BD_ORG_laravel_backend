<div class="header">

    <!-- Logo -->
    <div class="header-left">
        <a href="{{'/'}}" class="logo">
            <img src="{{ asset(setting('settings.general_settings.app_logo')) }}" alt="Logo">
        </a>
        <a href="{{'/'}}" class="logo logo-small">
            <img src="{{ asset(setting('settings.general_settings.app_favicon')) }}" alt="Logo" width="30" height="30">
        </a>
    </div>
    <!-- /Logo -->

    <a href="javascript:void(0);" id="toggle_btn">
        <i class="fas fa-align-left"></i>
    </a>

    <!-- Mobile Menu Toggle -->
    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>
    <!-- /Mobile Menu Toggle -->

    <!-- Header Right Menu -->
    <ul class="nav user-menu">
        <!-- User Menu -->
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img"><img class="rounded-circle" src="{{ auth()->user()->profile_photo_url }}" width="31" alt="Ryan Taylor"></span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="User Image" class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>{{ auth()->user()->nane }}</h6>
                    </div>
                </div>
                <a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logOutForm').submit();">Logout
                    <form action="{{ route('logout') }}" method="post" id="logOutForm">
                        @csrf
                    </form>
                </a>
            </div>
        </li>
        <!-- /User Menu -->

    </ul>
    <!-- /Header Right Menu -->

</div>
