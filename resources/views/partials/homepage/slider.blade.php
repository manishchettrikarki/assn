<!--== Slider Area Start ==-->
{{--<section id="slider-area">--}}
{{--    <div class="slider-active-wrap owl-carousel text-center text-md-left">--}}

{{--    @foreach($banners as $banner)--}}
{{--        <!-- Single Slide Item Start -->--}}
{{--            <div class="single-slide-wrap " style="background-image: url({{ $banner->banner }});">--}}
{{--                <div class="container">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-9">--}}
{{--                            <div class="slider-content">--}}
{{--                                @isset($banner->heading)--}}
{{--                                    <h2>{{ $banner->heading }}</h2>--}}
{{--                                @endisset--}}
{{--                                @isset($banner->sub_heading)--}}
{{--                                    <h3><span>{{ $banner->sub_heading }}</span></h3>--}}
{{--                                @endisset--}}
{{--                                <p>{{ $banner->text }}</p>--}}
{{--                                <div class="slider-btn">--}}
{{--                                    @isset($banner->name)--}}
{{--                                        <a href="{{ $banner->link }}" class="btn btn-brand smooth-scroll">{{ $banner->name }}</a>--}}
{{--                                    @endisset--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Single Slide Item End -->--}}
{{--        @endforeach--}}

{{--    </div>--}}

{{--    <!-- Social Icons Area Start -->--}}
{{--    <div class="social-networks-icon">--}}
{{--        <ul>--}}
{{--            @if((bool)site('facebook'))--}}
{{--                <li><a href="{{ site('facebook') }}"><i class="fab fa-facebook"></i> <span>Facebook</span></a></li>--}}
{{--            @endif--}}
{{--            @if((bool)site('twitter'))--}}
{{--                <li><a href="{{ site('twitter') }}"><i class="fab fa-twitter"></i> <span>Twitter</span></a></li>--}}
{{--            @endif--}}
{{--            @if((bool)site('pinterest'))--}}
{{--                <li><a href="{{ site('pinterest') }}"><i class="fab fa-pinterest"></i> <span>Pinterest</span></a></li>--}}
{{--            @endif--}}
{{--            @if((bool)site('youtube'))--}}
{{--                <li><a href="{{ site('youtube') }}"><i class="fab fa-youtube"></i> <span>Youtube</span></a></li>--}}
{{--            @endif--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--    <!-- Social Icons Area End -->--}}
{{--</section>--}}
<!--== Slider Area End ==-->
<div class="slider">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" style="height: 100%;">
        <div class="carousel-inner">
            @foreach($banners as $banner)
                <div class="carousel-item active">
                    <img src="{{$banner->banner}}" class="d-block w-100 img-fluid" alt="Slider1"/>
                </div>
            @endforeach
        </div>
    </div>
    <div class="slider-container d-none d-md-block">
        <h3>Association of Spine Surgeons of Nepal</h3>
        <p>
            The need to bring all surgeons who are practicing spine surgery in Nepal to a common forum, led us to form
            the Association of Spine Surgeons of Nepal (ASSN). After much discussions and consultations with all flag
            bearers of Nepal Orthopaedic Association, the official inauguration of ASSN was done on July 13, 2012.
        </p>
        <!--<button type="button" class="btn">Read More</button>-->
    </div>
</div>
<!-- slider ends -->
