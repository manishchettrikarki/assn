<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ site('logo') }}" alt="" height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{ site('logo') }}" alt="" height="20">
                                </span>
                </a>

                <a href="{{ route('dashboard') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ site('logo') }}" alt="" height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{ site('logo') }}" alt="" height="20">
                                </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-backburger"></i>
            </button>

            <!-- App Search-->
        </div>

        <div class="d-flex">





            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>



            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="badge badge-danger badge-pill">{{ Auth::user()->unreadnotifications()->count() }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                     aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <span class="badge badge-pill badge-primary">Mark all as read</span>
                            </div>
                            <div class="col-auto">
                                <span class="badge badge-pill badge-danger">Delete all</span>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        @forelse(Auth::user()->unreadnotifications()->get() as $notification)
                        <a href="{{ $notification->data['url'] }}" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="mdi mdi-package-variant-closed"></i>
                                                </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">{{ $notification->data['title'] }}</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">{{ $notification->data['content'] }}</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i>{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                            <a href="#" class="text-reset notification-item">
                                <div class="media">
                                    <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-danger rounded-circle font-size-16">
                                                    <i class="mdi mdi-close"></i>
                                                </span>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1">No new notifications</h6>
                                        <div class="font-size-12 text-muted">

                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforelse

                    </div>
                    <div class="p-2 border-top">
                        <a class="btn-link btn btn-block text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-down-circle mr-1"></i> Load More..
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset('back/images/avatar.jpg') }}"
                         alt="Header Avatar">
                    <span class="d-none d-sm-inline-block ml-1">{{ auth()->user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('change.password') }}"><i class="mdi mdi-lock font-size-16 align-middle mr-1"></i> Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" onclick="document.getElementById('logout-form').submit()"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Logout</a>
                    <form action="{{ route('logout') }}" id="logout-form" method="post" style="display: none">@csrf</form>
                </div>
            </div>

        </div>
    </div>
</header>
