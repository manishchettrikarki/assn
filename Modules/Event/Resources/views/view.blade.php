@extends('layouts.app')
@section('title',$event->title)
@section('content')
  <!--== Gallery Page Content Start ==-->
  <section id="page-content-wrap">
    <div class="single-event-page-content section-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="single-event-details">
              <div class="event-thumbnails">
                <div class="event-thumbnail-carousel owl-carousel">
                  <div class="event-thumb-item" style="background-image: url({{ $event->cover_image }})">
                    <div class="event-meta">
                      <h3>{{ $event->title }}</h3>
                      <a class="event-address" href="#"><i class="fa fa-map-marker"></i> {{ $event->location }}</a>

                    </div>
                  </div>

                  <div class="event-thumb-item" style="background-image: url({{ $event->cover_image }})">
                    <div class="event-meta">
                      <h3>{{ $event->title }}</h3>
                      <a class="event-address" href="#"><i class="fa fa-map-marker"></i> {{ $event->location }}</a>

                    </div>
                  </div>

                  <div class="event-thumb-item" style="background-image: url({{ $event->cover_image }})">
                    <div class="event-meta">
                      <h3>{{ $event->title }}</h3>
                      <a class="event-address" href="#"><i class="fa fa-map-marker"></i> {{ $event->location }}</a>

                    </div>
                  </div>
                </div>
                <div class="event-countdown">
                  <div class="event-countdown-counter" data-date="{{ $event->start_date->format('Y/m/d') }}"></div>
                  <p>Remaining</p>
                </div>
              </div>
              <h2>Details all Thing About This Event</h2>
                {!! $event->description !!}

              @isset($event->schedule)
              <div class="event-schedul">
                <h3>Event Schedule</h3>
                <div class="row">
                  <div class="col-lg-10 m-auto">
                    {!! $event->schedule !!}
                  </div>
                </div>
              </div>
                @endisset


            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--== Gallery Page Content End ==-->
@endsection
