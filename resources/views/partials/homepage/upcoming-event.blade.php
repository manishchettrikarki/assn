@if($upcomingEvent)
<!--== Upcoming Event Area Start ==-->
<section id="upcoming-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="upcoming-event-wrap">
                    <div class="up-event-titile">
                        <h3>Upcoming event</h3>
                    </div>
                    <div class="upcoming-event-content owl-carousel">
                        <!-- No 1 Event -->
                        <div class="single-upcoming-event">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="up-event-thumb">
                                        <img src="{{ $upcomingEvent->cover_image }}" class="img-fluid" alt="{{ $upcomingEvent->title }}">
                                        @if($upcomingEvent->start_date->isToday())
                                            <h4 class="up-event-date">It’s Today</h4>
                                        @elseif($upcomingEvent->start_date->isBefore(now()))
                                            <h4 class="up-event-date">It was on {{ $upcomingEvent->start_date->format('d F Y') }}</h4>
                                        @else
                                            <h4 class="up-event-date">It's {{ $upcomingEvent->start_date->format('d F Y') }}</h4>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-7">
                                    <div class="display-table">
                                        <div class="display-table-cell">
                                            <div class="up-event-text">
                                                <div class="event-countdown">
                                                    <div class="event-countdown-counter" data-date="{{ $upcomingEvent->start_date->format('Y/m/d') }}"></div>
                                                    <p>Remaining</p>
                                                </div>
                                                <h3><a href="{{ route('events.view',$upcomingEvent->slug) }}">{{ $upcomingEvent->title }}</a></h3>
                                                <p>
                                                    {{ $upcomingEvent->abstract_description }}
                                                </p>
                                                <a href="{{ route('events.view',$upcomingEvent->slug) }}" class="btn btn-brand btn-brand-dark">join with us</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- partial -->



                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== Upcoming Event Area End ==-->
@endif
