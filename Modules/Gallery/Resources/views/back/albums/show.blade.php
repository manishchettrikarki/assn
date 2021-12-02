@extends('back.partials.layout')
@section('title',$album->name)
@section('content')
  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18 pull-left">

                {{ $album->name }}
              </h4>


              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">{{ site('name') }}</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Gallery</a></li>
                  <li class="breadcrumb-item active">{{ $album->name }}</li>
                </ol>
              </div>

            </div>
          </div>
        </div>
        <!-- end page title -->


        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">


                <p class="card-title-desc">Add images to album
                </p>

                <div>
                  <form action="{{ route('album.images',encrypt($album->id)) }}" class="dropzone" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="fallback">
                      <input name="images" type="file" multiple="multiple">
                    </div>
                    <div class="dz-message needsclick">
                      <div class="mb-3">
                        <i class="display-4 text-muted mdi mdi-cloud-upload-outline"></i>
                      </div>

                      <h4>Drop files here to upload</h4>
                    </div>
                  </form>
                </div>

                <div class="text-center mt-4">
                  <button type="button" class="btn btn-primary waves-effect waves-light">Send Files</button>
                </div>
              </div>
            </div>
          </div> <!-- end col -->
        </div> <!-- end row -->

        <div class="row mt-5" >
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h4 class="header-title pull-left">{{ $album->name }}</h4>
                  </div>

                </div>
                <p class="card-title-desc">
                  {{ $album->description }}
                </p>

                <div class="mb-5 mt-5">
                  @if($album->images->count() > 0)
                  <div class="popup-gallery">
                    @foreach($album->images as $image)
                    <a class="float-left" href="{{ asset('uploads/gallery/'.$album->album_code.'/'.$image->image) }}" title="{{ $album->name }}">
                      <div class="img-fluid">
                        <img src="{{ asset('uploads/gallery/'.$album->album_code.'/'.$image->image) }}" alt="" width="120">
                      </div>
                    </a>
                    @endforeach

                  </div>
                    @else
                    No Images found
                  @endif
                </div>
              </div>
            </div>
          </div> <!-- end col -->
        </div> <!-- end row -->

      </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

  </div>
@endsection
@section('script')
  <script>


      $(".dropzone").dropzone({

          addRemoveLinks: true,
          renameFile:function(file){
              var dt = new Date();
              var time = dt.getTime();
              var date = dt.getDate();
              return date+time+file.name;
          },
          acceptedFiles:".jpg,.jpeg,.png",
          success: function(response){

          },
          error : function(file,response){

          },
          removedfile: function(file) {
              var name = file.upload.filename;
              // console.log(name);
              $.ajax({

                  type: 'GET',
                  url: '{{ route('album.images.delete',encrypt($album->id)) }}',
                  data: {filename: name},
                  success: function (data){
                      $('#message').html(data);
                  },
                  error: function(e) {
                      console.log(e);
                  }});
              var _ref;
              return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
          }
      });

      (function (e) {
          "use strict";
          e(".image-popup-vertical-fit").magnificPopup({ type: "image", closeOnContentClick: !0, mainClass: "mfp-img-mobile", image: { verticalFit: !0 } }),
              e(".image-popup-no-margins").magnificPopup({
                  type: "image",
                  closeOnContentClick: !0,
                  closeBtnInside: !1,
                  fixedContentPos: !0,
                  mainClass: "mfp-no-margins mfp-with-zoom",
                  image: { verticalFit: !0 },
                  zoom: { enabled: !0, duration: 300 },
              }),
              e(".popup-gallery").magnificPopup({
                  delegate: "a",
                  type: "image",
                  tLoading: "Loading image #%curr%...",
                  mainClass: "mfp-img-mobile",
                  gallery: { enabled: !0, navigateByImgClick: !0, preload: [0, 1] },
                  image: { tError: '<a href="%url%">The image #%curr%</a> could not be loaded.' },
              }),
              e(".zoom-gallery").magnificPopup({
                  delegate: "a",
                  type: "image",
                  closeOnContentClick: !1,
                  closeBtnInside: !1,
                  mainClass: "mfp-with-zoom mfp-img-mobile",
                  image: {
                      verticalFit: !0,
                      titleSrc: function (e) {
                          return e.el.attr("title") + ' &middot; <a href="' + e.el.attr("data-source") + '" target="_blank">image source</a>';
                      },
                  },
                  gallery: { enabled: !0 },
                  zoom: {
                      enabled: !0,
                      duration: 300,
                      opener: function (e) {
                          return e.find("img");
                      },
                  },
              }),
              e(".popup-form").magnificPopup({
                  type: "inline",
                  preloader: !1,
                  focus: "#name",
                  callbacks: {
                      beforeOpen: function () {
                          e(window).width() < 700 ? (this.st.focus = !1) : (this.st.focus = "#name");
                      },
                  },
              });
      }.apply(this, [jQuery]));



  </script>
@endsection
