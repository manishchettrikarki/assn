<!--== Slider Area Start ==-->
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
    </div>
</div>
<!-- slider ends -->
