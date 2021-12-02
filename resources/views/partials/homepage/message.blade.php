@if($message)
<!--== About Area Start ==-->
<style>
    #about-area .about-area-wrapper:before {
        background-image: url({{ $message->image }});
        background-size: cover;
        content: "";
        position: absolute;
        width: 39%;
        height: 85%;
        top: 50%;
        transform: translateY(-50%);
        left: 0;
        z-index: 2
    }
</style>
<section id="about-area" class="section-padding">
    <div class="about-area-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 ml-auto">
                    <div class="about-content-wrap">
                        <div class="section-title text-center text-lg-left">
                            <h2>President's Word</h2>
                        </div>

                        <div class="about-thumb">
                            <img src="{{ $message->image }}" alt="" class="img-fluid">
                        </div>

                        <p>
                            {{ $message->message }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== About Area End ==-->
@endif
