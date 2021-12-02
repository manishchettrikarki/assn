@extends('layouts.app')
@section('title','ASON Gallery')
@section('content')

  <!--== Single Album Page Content Start ==-->
  <section id="page-content-wrap">
    <div class="single-gallery-wrap section-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!-- Gallery Menu Start -->

            <!-- Gallery Menu End -->

            <!-- Gallery Item content Start -->
            <div class="row gallery-gird">

              @foreach($album->images as $image)
              <!-- Single Gallery Start -->
              <div class="col-lg-3  col-sm-6 recent event">
                <div class="single-gallery-item " style="background-image: url({{ asset('uploads/gallery/'.$album->album_code.'/'.$image->image) }})">
                  <div class="gallery-hvr-wrap">
                    <div class="gallery-hvr-text">
                      <h4>{{ $album->name }}</h4>
                      <p class="gallery-event-date">{{ $album->created_at->toFormattedDateString() }}</p>
                    </div>
                    <a href="{{ asset('uploads/gallery/'.$album->album_code.'/'.$image->image) }}" class="btn-zoom image-popup">
                      <img src="{{ asset('uploads/gallery/'.$album->album_code.'/'.$image->image) }}" alt="a">
                    </a>
                  </div>
                </div>
              </div>
              @endforeach
              <!-- Single Gallery End -->




            </div>
            <!-- Gallery Item content End -->
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 text-center">
            <a href="#" class="btn btn-brand btn-loadmore">Load More Photo</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--== Single Album Page Content End ==-->

@endsection
