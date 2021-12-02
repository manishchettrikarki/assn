<div class="header-bottom-area" id="fixheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <nav class="main-menu navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{ route('welcome') }}">
                        <img src="{{ site('logo') }}" alt="{{ site('name') }}" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#menucontent" aria-controls="menucontent" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="menucontent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item {{ (\Route::currentRouteName() === 'welcome')?'active':'' }}"><a class="nav-link" href="{{ route('welcome') }}">Home</a></li>
                            <li class="nav-item dropdown" ><a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">About</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"href="{{route('view.page','about-organization')}}">About Organization</a>
{{--                                    <a class="dropdown-item"href="{{route('view.page','about-organization')}}">About Organization</a>--}}
                                    <a class="dropdown-item"href="{{route('view.page','founding-office-bearers')}}">Founding Office Bearers</a>

                                    <div class="dropdown-divider"></div>

                                    @foreach($messages as $message)
                                    <a class="dropdown-item"href="{{route('member.message', $message->slug)}}">{{$message->post}}'s Message</a>
                                    @endforeach
                                    <a class="dropdown-item"href="{{ route('executive.body') }}">ASSN Executive Bodies</a>
                                    <a class="dropdown-item"href="{{ route('past.president') }}">ASSN Past Presidents</a>
                                    <a class="dropdown-item"href="{{ route('past.general.secretary') }}">ASSN Past General Secretaries</a>
                                    <a class="dropdown-item"href="{{ route('scientific.committees') }}">Scientific Committee</a>
                                    <a class="dropdown-item"href="{{ route('provincial.representative') }}">Provincial Representative</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" ><a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Events</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"href="{{ route('events',['type'=>'Latest']) }}">Latest Events</a>
                                    <a class="dropdown-item"href="{{ route('events',['type'=>'Upcoming']) }}">Up-coming Events</a>
                                </div>
                            </li>

{{--                            <li class="nav-item {{ (\Route::currentRouteName() === 'executives')?'active':'' }}"><a class="nav-link" href="{{ route('executives') }}">Executive Committee</a></li>--}}
{{--                            <li class="nav-item {{ (\Route::currentRouteName() === 'members')?'active':'' }}"><a class="nav-link" href="{{ route('members') }}">Member Directory</a></li>--}}
{{--                            <li class="nav-item {{ (\Route::currentRouteName() === 'events' || \Route::currentRouteName() === 'events.view')?'active':'' }}"><a class="nav-link" href="{{ route('events') }}">Event</a></li>--}}
{{--                            <li class="nav-item {{ (\Route::currentRouteName() === 'gallery' || \Route::currentRouteName() === 'gallery.view' )?'active':'' }}"><a class="nav-link" href="{{ route('gallery') }}">Gallery</a></li>--}}
{{--                            @foreach($pages as $page)--}}
{{--                                <li class="nav-item {{ (\Route::currentRouteName() === 'view.page' && \Route::current()->parameter('slug') === $page->slug)?'active':'' }}"><a class="nav-link" href="{{ route('view.page',$page->slug) }}">{{ $page->menu_name }}</a></li>--}}
{{--                            @endforeach--}}
                            <li class="nav-item"><a class="nav-link" href="{{ route('view.page', 'news-media') }}">News & Media</a></li>
                            <li class="nav-item"><a class="nav-link" href="http://localhost:8000/uploads/downloads/ASSN-Guidelines-to-apply-as-a-Reference-Center-for-Fellowship-programme.pdf">ASSN Fellowship</a></li>
                            <li class="nav-item"><a class="nav-link" href="http://localhost:8000/uploads/downloads/ASSN-ACADEMIC-CALENDAR.pdf">Academic Calendar</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Spine Trauma Registry- Nepal(STR-NP)</a></li>
                            <li class="nav-item {{ (\Route::currentRouteName() === 'contact')?'active':'' }}"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
