@extends('layouts.app')
@section('title','ASON Galleries')
@section('content')
    <!--== Gallery Page Content Start ==-->
    <section id="page-content-wrap">
        <div class="gallery-page-wrap section-padding">
            <!-- Gallery Menu Start -->

            <!-- Gallery Menu End -->

            <!--= Gallery Page Content Wrap Start =-->
            <div class="container">
                <h3 class="text-bold text-center">ASON Galleries</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="full-album-content">
                            @foreach($albums as $album)
                            <!-- Single Album Start -->
                            <div class="single-album-wraper">
                                <div class="album-heading">
                                    <h2><a href="{{ route('gallery.view',$album->album_code) }}">{{ $album->name }}</a></h2>
                                    <p>{{ $album->description }}</p>
                                    <a href="{{ route('gallery.view',$album->album_code) }}" class="btn btn-brand">View Album</a>
                                </div>


                              <div class="album-gallery-item">
                                    <div class="row gallery-gird">
                                    @foreach($album->images->take(4) as $image)
                                        <!-- Single Gallery Start -->
                                        <div class="col-lg-3  col-sm-6 pic ">
                                            <div class="single-gallery-item " style="background-image: url({{ asset('uploads/gallery/'.$album->album_code.'/'.$image->image) }})">
                                                <div class="gallery-hvr-wrap">
                                                    <div class="gallery-hvr-text">
                                                        <h4>{{ $album->name }}</h4>
                                                        <p class="gallery-event-date">{{ $album->created_at->toFormattedDateString() }}</p>
                                                    </div>
                                                    <a href="{{ asset('uploads/gallery/'.$album->album_code.'/'.$image->image) }}" class="btn-zoom image-popup">
                                                        <img src="{{ asset('uploads/gallery/'.$album->album_code.'/'.$image->image) }}" alt="{{ site('name') }}">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Gallery End -->
                                        @endforeach

                                    </div>
                                </div>



                            </div>
                            <!-- Single Album End -->
                            @endforeach

                        </div>
                        <div class="pagination-wrap text-center">
                            <nav>
                                <ul class="pagination">
                                    {{ $albums->links() }}
{{--                                    <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>--}}
{{--                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">...</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">50</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>--}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!--= Gallery Page Content Wrap End =-->
        </div>
    </section>
    <!--== Gallery Page Content End ==-->
@endsection
