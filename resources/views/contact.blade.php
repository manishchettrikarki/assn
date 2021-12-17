@extends('layouts.app')
@section('title','Contact Us')
@section('content')
  <!--== Contact Page Content Start ==-->
  <section id="page-content-wrap">
    <div class="contact-page-wrap section-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="contact-content-inner">
              <div class="row">
                <div class="col-lg-6">
                  <!-- Map Area Start -->
                  <div class="map-area-wrap">
                    <div style="max-width:100%;overflow:hidden;color:red;width:500px;height:720px;">
                      <div id="googlemaps-display" style="height:100%; width:100%;max-width:100%;">
                        <iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/search?q=nepal+medical+association+&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe></div><a class="embeddedmap-code" href="https://www.embed-map.com" id="authorizemaps-data">https://www.embed-map.com</a><style>#googlemaps-display img{max-width:none!important;background:none!important;font-size: inherit;font-weight:inherit;}</style></div>

                  </div>
                  <!-- Map Area End -->
                </div>

                <div class="col-lg-6 m-auto">
                  <div class="contact-form-wrap">
                    @if(session()->has('warning'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('warning') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                      @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>{{ session('success') }}</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      @endif

                    <h3>We would love to hear from you</h3>
                    <form action="{{ route('contact.send') }}" method="post" id="cbx-contact-form">
                      @csrf
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required id="name" class="form-control">
                            @error('name')
                            <span class="error">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>

                        <div class="col">
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required id="email" class="form-control">
                            @error('email')
                            <span class="error">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" id="address" class="form-control">
                            @error('address')
                            <span class="error">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" id="phone" class="form-control">
                            @error('phone')
                            <span class="error">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" rows="10" cols="80" class="form-control">{{ old('message') }}</textarea>
                        @error('message')
                        <span class="error">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="callme" name="callme" value="on">
                        <label class="custom-control-label" for="callme">Call me back</label>
                      </div>

                      <div class="form-group ">
                        <div class="col-md-6">
                          <div class="g-recaptcha"
                               data-sitekey="{{env('GOOGLE_RECAPTCHA_PUBLIC')}}">
                          </div>
                        </div>
                      </div>

                      <button class="btn btn-reg">Send</button>
                      <div id="cbx-formalert"></div>
                    </form>
                  </div>

                    <div class="row">
                      <div class="col-12 col-md-4 col-lg-4">
                        <h4>{{ site('name') }}</h4>
                        <p>{{ site('description') }}</p>
                      </div>

                      <div class="col-12 col-md-4 col-lg-4">
                        <h4>{{ site('contact') }}</h4>
                        <p>{{ site('hunting_line') }}</p>
                      </div>

                      <div class="col-12 col-md-4 col-lg-4">
                        <h4>{{ site('address') }}</h4>

                      </div>

                    </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<script src='https://www.google.com/recaptcha/api.js'></script>
  <!--== Contact Page Content End ==-->

@endsection
