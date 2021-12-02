@extends('layouts.app')
@section('title','Home')
@section('content')
    @include('partials.homepage.slider')
{{--    @include('partials.homepage.upcoming-event')--}}
{{--    @include('partials.homepage.message')--}}
{{--   POPUP STARTS--}}
    <div class="bts-popup" role="alert">
        <div class="bts-popup-container">
            <img src="http://localhost:8000/uploads/events/flyer-3.jpg" alt="" width="50%" />
            <p>HIMALAYAN SPINE SYMPOSIUM - Annual Conference</p>
            <div class="bts-popup-button">
                <a href="http://localhost:8000/uploads/events/flyer-3.jpg" target="_blank">View Notice</a>
            </div>
            <a href="#0" class="bts-popup-close img-replace">Close</a>
        </div>
    </div>
{{--    POPUP ENDS--}}
<!-- member login, find member part starts -->
<div class="container-fluid member">
    <div class="row">
        <div class="col-md-10 col-11 mx-auto">
            <div class="row">
                <div class="col-md-4 col-12 text-white find-member">
                    <div class="row">
                        <div class="col-2 px-5">
                                <span class="float-end">
                                    <i class="fas fa-search mr-5"></i>
                                </span>
                        </div>
                        <div class="col-8 memberheading">
                            <span>Find A Member</span>
                            <div>
                                <button type="button" class="btn blue">Click Here</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 text-white forum">
                    <div class="row">
                        <div class="col-2 px-5">

                                    <i class="fas fa-address-card"></i>

                        </div>
                        <div class="col-8 memberheading">
                            <span class="text-center">Annual Forum</span>
                            <div>
                                <button type="button" class="btn orange text-centre">Click Here</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 text-white find-member">
                    <div class="row">
                        <div class="col-2 px-5">
                                <span class="float-end">
                                    <i class="fas fa-user"></i>
                                </span>
                        </div>
                        <div class="col-8 memberheading">
                            <span>Member Login</span>
                            <div>
                                <button type="button" class="btn blue">Click Here</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- member login, find member part ends -->
<!-- history section starts -->
<div class="container-fluid history">
    <div class="row">
        <div class="col-md-10 col-11 mx-auto">
            <div class="row float-start">
                <div class="col-md-8 px-0">
                    <h3>History of ASSN</h3>
                    <div class="underline"></div>
                    <p>
                        The need to bring all surgeons who are practicing spine surgery
                        in Nepal to a common forum, led us to form the Association of
                        Spine Surgeons of Nepal (ASSN). After much discussions and
                        consultations with all flag bearers of Nepal Orthopaedic
                        Association, the official inauguration of ASSN was done on July
                        13, 2012. All the dignitaries felt that super specialty in all
                        fields of orthopaedic surgery was the need of the hour and
                        congratulated ASSN for being the first to head in this
                        direction.
                    </p>
                    <p>
                        Prof. LL Shah and Prof AR Bajracharya, our two national patrons
                        were pioneers in spine surgery in Nepal and their talks on
                        struggle and establishment were great inspiration for all our
                        junior colleagues.
                    </p>
                    <div>
                        <a class="btn orange mt-4" href="{{route('view.page','about-organization')}}">Know More</a>
                    </div>
                </div>
                <div class="col-md-4 historylogo">
                    <img src="images/history-logo.png" class="img-fluid" alt="ASSN"/>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- history section ends -->
<!-- news & event section starts -->
<section class="banner-sec">
    <div class="container">
        <div class="row ">
            <div class="col-12 mx-auto">
                <div class="row float-start">

                    <div class="newscontainer {{$upcomingEvent?'col-md-6':'col-md-12'}} col-12 p-0">
                        <div class="newssection">
                            <h3 class="d-inline">Latest News</h3>
                            <div class="underline"></div>
                            <div class="card">
                                @foreach($latestEvent as $event)
                                <div class="row px-3">
                                    <div class="col-1 p-0">
                                        <div class="card-body head">
                                            <h3>{{$event->start_date->format('M')}}</h3>
                                            <h2>{{$event->start_date->format('d')}}</h2>
                                        </div>
                                    </div>
                                    <div class="col-9 p-0">
                                        <div class="card-body">
                                            {{$event->title}}
                                        </div>
                                    </div>
                                    <div class="col-1 p-0 cardbtn">
                                        <a href="{{route('events.view',$event->slug)}}" class="btn orange">View</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>


                            <a href="{{route('events')}}" class="btn float-end orange sectionbtn">View All</a>
                        </div>

                        <img src="/images/newsbg.png" class="img-fluid news-latest" alt="">
                        <div class="news-latest"></div>
                    </div>
                    @if($upcomingEvent)
                    <div class="eventcontainer col-md-6 col-12 p-0">
                        <div class="eventsection">
                            <h3 class="d-inline">Upcoming Events</h3>
                            <div class="underline"></div>

                            <div class="card">
                                <div class="row px-3">
                                    <div class="col-1 p-0">
                                        <div class="card-body head">
                                            <h3>{{$upcomingEvent->start_date->format('M')}}</h3>
                                            <h2>{{$upcomingEvent->start_date->format('d')}}</h2>
                                        </div>
                                    </div>
                                    <div class="col-9 p-0">
                                        <div class="card-body">
                                            {{$upcomingEvent->title}}
                                        </div>
                                    </div>
                                    <div class="col-1 p-0 cardbtn">
                                        <a class="btn orange" href="{{route('events.view',$upcomingEvent->slug)}}" target="_blank">View</a>
                                    </div>
                                </div>
                            </div>


                            <a href="{{route('events')}}" class="btn float-end orange sectionbtn">View All</a>
                        </div>
                        <img src="images/eventbg.png" class="img-fluid" alt="">
                        <div class="eventbg"></div>
                    </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- news & event section ends -->
<!-- president message section starts-->
@foreach($messages as $message)
<div class="container-fluid message">
    <div class="row">
        <div class="col-md-10 col-11 mx-auto">
            <div class="row float-start">
                @if($loop->iteration % 2 != 0)
                    <div class="col-md-4">
                        <img src="{{ $message->image }}" class="img-fluid" alt="ASSN"/>
                    </div>
                    <div class="col-md-8 p-2">
                        <h3>Message From {{$message->post}}</h3>
                        <div class="underline"></div>
                        <p>
                            {{ $message->message }}
                        </p>
                        <div>
                            <a href="president-message.php">
                                <button type="button" class="btn orange mt-4">Read More</button>
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="col-md-8 p-2">
                        <h3>Message From {{$message->post}}</h3>
                        <div class="underline"></div>
                        <p>
                            {{ $message->message }}
                        </p>
                        <div>
                            <a href="{{route('member.message',$message->post)}}">
                                <button type="button" class="btn orange mt-4">Read More</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ $message->image }}" class="img-fluid" alt="ASSN"/>
                    </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

