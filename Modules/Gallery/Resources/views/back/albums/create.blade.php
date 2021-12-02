@extends('back.partials.layout')
@section('title','Add Gallery Album')
@section('content')
  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18 pull-left">

                Gallery Album
              </h4>


              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">{{ site('name') }}</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Gallery Album</a></li>
                  <li class="breadcrumb-item active">Add new</li>
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
                    <h4 class="header-title pull-left">Gallery Album</h4>
                  </div>
                  @can('view members')
                    <div class="col-6">
                      <a href="{{ route('albums.index') }}" class="btn btn-sm btn-success float-right">Back</a>
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
                  <form action="{{ route('albums.store') }}" method="post">
                    @csrf
                    <div class="row">

                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text"
                                 value="{{ old('name') }}"
                                 id="name" name="name" class="form-control">
                          @error('name')
                          <code>{{ $message }}</code>
                          @enderror
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                          @error('description')
                          <code>{{ $message }}</code>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-group">
                          <label for="tags">Tags</label>
                          <input type="text"  value="{{ old('tags') }}"
                                 id="tags" name="tags" class="form-control">
                          @error('tags')
                          <code>{{ $message }}</code>
                          @enderror
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

  </script>
@endsection

