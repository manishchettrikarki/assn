@extends('back.partials.layout')
@section('title','Update Regional Coordinator')
@section('content')
  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18 pull-left">

                Regional Coordinator
              </h4>


              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">{{ site('name') }}</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Regional Coordinator</a></li>
                  <li class="breadcrumb-item active">Update</li>
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
                <div class="row">
                  <div class="col-6">
                    <h4 class="header-title pull-left">Regional Coordinator</h4>
                  </div>
                  @can('view members')
                    <div class="col-6">
                      <a href="{{ route('coordinators.index') }}" class="btn btn-sm btn-success float-right">Back</a>
                    </div>
                  @endcan
                </div>


                <div class="row">
                  <div class="col-6">
                    <p class="card-title-desc">
                    </p>
                  </div>
                </div>

                <div class="mb-5 mt-5">
                  <form action="{{ route('coordinators.update',encrypt($member->id)) }}" method="post">
                    @csrf
                    <div class="row">

                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text"
                                 value="{{ ((bool)old('name'))?old('name'):$member->name }}"
                                 id="name" name="name" class="form-control">
                          @error('name')
                          <code>{{ $message }}</code>
                          @enderror
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-group">
                          <label for="location">Location</label>
                          <input type="text"
                                 value="{{ ((bool)old('location'))?old('location'):$member->location }}"
                                 id="location" name="location" class="form-control">
                          @error('location')
                          <code>{{ $message }}</code>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email"  value="{{ ((bool)old('email'))?old('email'):$member->email }}"
                                 id="email" name="email" class="form-control">
                          @error('email')
                          <code>{{ $message }}</code>
                          @enderror
                        </div>
                      </div>


                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-group">
                          <label for="image">Image</label>
                          <div class="input-group">

                            <input type="text" id="image_label" value="{{ $member->image }}" class="form-control" name="image"
                                   aria-label="Image" aria-describedby="button-image">
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
                            </div>
                          </div>
                          @error('image')
                          <code>{{ $message }}</code>
                          @enderror
                          @isset($coordinator->image)
                          <img src="{{ $member->image }}" width="100" height="100" alt="{{ $member->name }}">
                          @endisset
                        </div>

                      </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12">
                      <div class="form-group">
                        <label for=""></label>
                        <input type="submit" value="Submit" class="btn btn-danger">
                      </div>
                    </div>


                  </form>
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
      document.addEventListener("DOMContentLoaded", function() {

          document.getElementById('button-image').addEventListener('click', (event) => {
              event.preventDefault();

              window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
          });
      });

      // set file link
      function fmSetLink($url) {
          document.getElementById('image_label').value = $url;
      }
  </script>
@endsection

