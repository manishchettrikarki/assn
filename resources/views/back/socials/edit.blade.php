@extends('back.partials.layout')
@section('title','Update Social Links')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Update Social Links</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ site('name') }}</a></li>
                                    <li class="breadcrumb-item active">Update Social Links</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->



                        <div class="modal-content">

                            <div class="modal-body">
                                <form action="{{ route('social.links.update',$socialLink->slug) }}" method="post" class="custom-validation"
                                      enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" data-parsley-minlength="5"
                                               value="{{ ((bool)old('name'))?old('name'):$socialLink->name }}"
                                               data-parsley-required name="name" class="form-control">
                                        @error('name')
                                        <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="url">Url</label>
                                        <input type="text"  required data-parsley-required value="{{ ((bool)old('url'))?old('url'):$socialLink->url }}"
                                               id="url"  name="url" class="form-control">
                                        @error('url')
                                        <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success waves-effect waves-light" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->






            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->





    </div>
@endsection
@section('script')
    <script src="{{ asset('back/js/init/form-validation.init.js') }}"></script>

@endsection
