@extends('back.partials.layout')
@section('title','Social Links')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Social Links</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ site('name') }}</a></li>
                                    <li class="breadcrumb-item active">Social Links</li>
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

                                <h4 class="header-title">Social Links</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-title-desc">
                                            Available Links
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        @can('add social links')
                                        <button class="btn btn-success waves-effect waves-light float-right" data-toggle="modal" data-target="#addAirline"><i class="mdi mdi-plus"></i> Add new</button>
                                        @endcan
                                    </div>
                                </div>



                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>URL</th>

                                        <th class="datatable-nosort">Actions</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @forelse($socialLinks as $socialLink)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $socialLink->name }}</td>
                                            <td><a href="{{ $socialLink->url }}" target="_blank">{{ $socialLink->url }}</a> </td>
                                            <td>
                                                @can('update social links')
                                                    <a href="{{ route('social.links.edit',$socialLink->slug) }}" class="btn btn-sm btn-primary">
                                                        Update
                                                    </a>
                                                @endcan
                                                @can('delete social links')
                                                        <a href="{{ route('social.links.delete',$socialLink->slug) }}"
                                                           class="btn btn-sm btn-danger">Delete</a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-danger">No records found</td>
                                        </tr>
                                    @endforelse


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

@can('add social links')
        <div class="modal fade" tabindex="-1" role="dialog" id="addAirline" aria-labelledby="addAirlineModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Add Social Link</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('social.links.store') }}" method="post" class="custom-validation"
                              enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" data-parsley-minlength="5" value="{{ old('name') }}"
                                       data-parsley-required name="name" class="form-control">
                                @error('name')
                                <div style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="url">Url</label>
                                <input type="text"  required data-parsley-required value="{{ old('url') }}"
                                        id="url"
                                       name="url" class="form-control">
                                @error('url')
                                <div style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-success waves-effect waves-light" value="Add">
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

@endcan

    </div>
@endsection
@section('script')
    <script src="{{ asset('back/js/init/form-validation.init.js') }}"></script>

@endsection
