@extends('layouts.app')
@section('title','Latest Events')
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$type}}</li>
        </ol>
    </nav>
    <!-- Heading -->
    <div class="container">
        <div class="heading-about">
            <div class="text-center">
                <h2>{{$type}} Events</h2>
                <div class="small-line">

                </div>
            </div>
        </div>
    </div>

    <!-- Tabular format of meeting -->
    <div class="tabsection">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="container py-5">
                    <!-- DEMO 1 -->
                    <div class="py-5">
                        <div class="row">
                            <!-- DEMO 1 Item-->
                            @foreach($events as $event)
                            <div class="col-lg-6 mb-3 mb-lg-0">
                                <a href="{{route('events.view',$event->slug)}}">
                                    <div class="hover hover-1 text-white rounded"><img src="{{$event->cover_image}}" alt="">
                                        <div class="hover-overlay"></div>
                                        <div class="hover-1-content px-5 py-4">
                                            <h3 class="hover-1-title text-uppercase font-weight-bold mb-0"> {{$event->title}}</h3>
                                            <p class="hover-1-description font-weight-light mb-0">Start Date: {{$event->start_date->format('Y-M-D')}}</p>
                                            <p class="hover-1-description font-weight-light mb-0">End Date: {{$event->end_date->format('Y-M-D')}}</p>
                                            <p class="hover-1-description font-weight-light mb-0">Location: {{$event->location}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection






























{{--  <!--== Gallery Page Content Start ==-->--}}
{{--  <section id="page-content-wrap">--}}
{{--    <div class="event-page-content-wrap section-padding">--}}
{{--      <div class="container">--}}
{{--        <div class="row">--}}
{{--          <div class="col-lg-12">--}}
{{--            <div class="event-filter-area">--}}
{{--              <h3 class="text-bold text-center">Latest Events</h3>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}

{{--        <div class="row">--}}
{{--          <div class="col-lg-12">--}}
{{--            <div class="all-event-list">--}}

{{--              @foreach($events as $event)--}}
{{--              <!-- Single Event Start -->--}}
{{--              <div class="single-upcoming-event">--}}
{{--                <div class="row">--}}
{{--                  <div class="col-lg-5">--}}
{{--                    <div class="up-event-thumb">--}}
{{--                      <img src="{{ $event->cover_image }}" class="img-fluid" alt="{{ $event->title }}">--}}
{{--                      @if($event->start_date->isToday())--}}
{{--                      <h4 class="up-event-date">It’s Today</h4>--}}
{{--                      @elseif($event->start_date->isBefore(now()))--}}
{{--                        <h4 class="up-event-date">It was on {{ $event->start_date->format('d F Y') }}</h4>--}}
{{--                      @else--}}
{{--                        <h4 class="up-event-date">It's {{ $event->start_date->format('d F Y') }}</h4>--}}
{{--                      @endif--}}

{{--                    </div>--}}
{{--                  </div>--}}

{{--                  <div class="col-lg-7">--}}
{{--                    <div class="display-table">--}}
{{--                      <div class="display-table-cell">--}}
{{--                        <div class="up-event-text">--}}
{{--                          <div class="event-countdown">--}}
{{--                            <div class="event-countdown-counter" data-date="{{ $event->start_date->format('Y/m/d') }}"></div>--}}
{{--                            <p>Remaining</p>--}}
{{--                          </div>--}}
{{--                          <h3><a href="{{ route('events.view',$event->slug) }}">{{ $event->title }}</a></h3>--}}
{{--                          <p>{{ $event->abstract_description }}</p>--}}
{{--                          <a href="{{ route('events.view',$event->slug) }}" class="btn btn-brand btn-brand-dark">join with us</a>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <!-- Single Event End -->--}}
{{--                @endforeach--}}


{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}

{{--        <!-- Pagination Start -->--}}
{{--        <div class="row">--}}
{{--          <div class="col-lg-12">--}}
{{--            <div class="pagination-wrap text-center">--}}
{{--              <nav>--}}
{{--                <ul class="pagination">--}}
{{--                  {{ $events->links() }}--}}
{{--                  <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a>--}}
{{--                  </li>--}}
{{--                  <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--                  <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                  <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                  <li class="page-item"><a class="page-link" href="#">...</a></li>--}}
{{--                  <li class="page-item"><a class="page-link" href="#">50</a></li>--}}
{{--                  <li class="page-item"><a class="page-link" href="#"><i--}}
{{--                        class="fa fa-angle-right"></i></a></li>--}}
{{--                </ul>--}}
{{--              </nav>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <!-- Pagination End -->--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </section>--}}
{{--  <!--== Gallery Page Content End ==-->--}}

