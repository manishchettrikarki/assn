{{--<div class="preheader-area">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-8 col-sm-7 col-7">--}}
{{--                <div class="preheader-left">--}}
{{--                    <a href="mailto:info@construc.com"><strong><i class="fas fa-map-marker-alt"></i></strong>--}}
{{--                        {{ site('address') }}</a>--}}
{{--                    <a href="mailto:info@construc.com"><strong><i class="fas fa-phone-volume"></i></strong> {{ site('contact') }}</a>--}}
{{--                    <a href="mailto:info@construc.com"><strong><i class="fas fa-envelope"></i></strong> {{ site('primary_email') }}</a>--}}

{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-lg-4 col-sm-5 col-5 text-right">--}}
{{--                <div class="preheader-right">--}}
{{--                    @auth--}}
{{--                    <a title="Logout" class="btn-auth btn-auth-rev" href="#"--}}
{{--                       onclick="event.preventDefault();document.getElementById('logout-form').submit()">Logout</a>--}}
{{--                        <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none">--}}
{{--                            @csrf--}}
{{--                        </form>--}}
{{--                    @endauth--}}
{{--                    @can('view dashboard')--}}
{{--                        <a title="Dashboard" class="btn-auth btn-auth" href="{{ route('dashboard') }}">Dashboard</a>--}}
{{--                        @endcan--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<section class="topnav">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12 location d-none d-sm-none d-md-block">
                    <span class="text-white">
                        <i class="fas fa-map-marker-alt"></i>
                       {{site ('address')}}
                    </span>
            </div>
            <div class="col-md-2 col-12 location d-none d-sm-none d-md-block">
                    <span class="text-white">
                        <i class="fas fa-phone-alt"></i>
                        {{site('contact')}}
                    </span>
            </div>
            <div class="col-md-3 col-12 location d-none d-sm-none d-md-block">
                    <span class="text-white">
                        <i class="fas fa-envelope"></i>
                       {{site ('primary_email')}}
                    </span>
            </div>
            <div class="col-md-4 col-12">
                    <span class="text-white">
                        <a href="{{route('becomeMember')}}"><button type="button" class="btn">Become Our Member</button></a>
                    </span>
            </div>
        </div>
    </div>
</section>
