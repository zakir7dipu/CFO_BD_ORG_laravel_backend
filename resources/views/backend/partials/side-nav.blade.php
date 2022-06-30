<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-book"></i> <span> Settings</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('settings.general') }}">General Settings</a></li>
                        <li><a href="{{ route('settings.home-page') }}">Home Page Settings</a></li>
                        <li><a href="{{ route('settings.about-page') }}">About Page Settings</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('message.index') }}"><i class="fas fa-text-height"></i> <span>Messages</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
