<section class="topnav">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12 location d-none d-sm-none d-md-block">
                    <span class="text-white">
                        <i class="fas fa-map-marker-alt"></i>
                       {{site ('address')}}
                    </span>
            </div>
            <div class="col-md-2 col-12 location d-none d-sm-none d-md-block">
                    <span class="text-white">
                        <i class="fas fa-phone-alt"></i>
                        {{site('contact')}}
                    </span>
            </div>
            <div class="col-md-3 col-12 location d-none d-sm-none d-md-block">
                    <span class="text-white">
                        <i class="fas fa-envelope"></i>
                       {{site ('primary_email')}}
                    </span>
            </div>
            <div class="col-md-4 col-12">
                    <span class="text-white">
                        <a href="{{route('membership.form')}}"><button type="button" class="btn">Become Our Member</button></a>
                    </span>
            </div>
        </div>
    </div>
</section>
