<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('user.dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
{{--                 load sidebar menus for user from all modules
              // Modules\\{moduleName}\\Resources\\views\\user\\partials\\sidebar-widget --}}
                @foreach($modulesName as $sidebarWidget)
                    @if(view()->exists($sidebarWidget.'::user.partials.sidebar-widget'))
                        @include($sidebarWidget.'::user.partials.sidebar-widget')
                    @endif
                @endforeach


                <li>
                    <a href="" class="waves-effect">
                        <i class="mdi mdi-view-activity"></i>
                        <span>Activity Log</span>
                    </a>
                </li>


            </ul>


        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
