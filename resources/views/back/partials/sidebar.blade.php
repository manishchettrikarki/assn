<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>






                @foreach($modulesName as $sidebarWidget)
                    @if(view()->exists($sidebarWidget.'::back.partials.sidebar-widget'))
                        @include($sidebarWidget.'::back.partials.sidebar-widget')
                    @endif

                @endforeach
                @can('view activity log')
                <li>
                    <a href="{{ route('activity.log') }}" class="waves-effect">
                        <i class="mdi mdi-radioactive"></i>
                        <span>Activity Log</span>
                    </a>
                </li>
                    @endcan
                @can('view site settings')
                    <li>
                        <a href="{{ route('site.settings') }}" class="waves-effect">
                            <i class="mdi mdi-cogs"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                @endcan
                @can('view social links')
                    <li>
                        <a href="{{ route('social.links') }}" class="waves-effect">
                            <i class="fas fa-users-cog"></i>
                            <span>Social Links</span>
                        </a>
                    </li>
                @endcan
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
