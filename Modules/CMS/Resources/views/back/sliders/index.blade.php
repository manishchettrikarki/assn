@extends('back.partials.layout')
@section('title','Slider Images')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Sliders</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                    <li class="breadcrumb-item active">Sliders</li>
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
                                <h4 class="header-title">Sliders</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-title-desc">

                                        </p>
                                    </div>
                                    @can('create sliders')
                                        <div class="col-6 d-flex justify-content-end">
                                            <a href="#" data-toggle="modal" data-target="#create-modal" class="btn btn-success waves-effect waves-light float-right"><i class="mdi mdi-plus"></i> Add new</a>
                                        </div>
                                    @endcan
                                </div>

                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap mt-3" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Heading</th>
                                        <th>Sub-Heading</th>
                                        <th>Banner</th>
                                        <th>Button</th>
                                        <th>Created By</th>
                                        <th>Last Updated By</th>
                                        <th class="datatable-nosort">Actions</th>
                                    </tr>
                                    </thead>


                                    <tbody>

                                    @forelse($sliders as $slider)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $slider->heading }}</td>
                                            <td>{{ $slider->sub_heading }}</td>
                                            <td>
                                                <img src="{{ $slider->banner }}" width="150" height="100" class="img img-responsive" alt="">
                                            </td>
                                            <td>
                                                @if(!is_null($slider->link) && !is_null($slider->name))
                                                    <a href="{{ $slider->link }}" class="btn">{{ $slider->name }}</a>
                                                @else
                                                    Not Available
                                                @endif
                                            </td>
                                            <td>{{ (isset($slider->created_by))?$slider->createdBy->name:'Unavailable' }}</td>
                                            <td>{{ (isset($slider->updated_by))?$slider->lastUpdatedBy->name:'Unavailable' }}</td>
                                            <td>
                                                @can('update sliders')
                                                    <a href="{{ route('cms.sliders.edit',encrypt($slider->id)) }}"
                                                       class="btn btn-sm btn-primary">Update</a>
                                                @endcan
                                                @can('delete sliders')
                                                    <a href="{{ route('cms.sliders.delete',encrypt($slider->id)) }}"
                                                       class="btn btn-sm btn-danger">Delete</a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-danger" colspan="8">No records found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('cms.sliders.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <input type="text" value="{{ old('heading') }}" name="heading"
                                   class="form-control" id="heading">
                            @error('heading')
                                <code>{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="subHeading">Sub-heading</label>
                            <input type="text" value="{{ old('subHeading') }}" name="subHeading"
                                   id="subHeading" class="form-control">
                            @error('subHeading')
                            <code>{{ $message }}</code>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="text">Text</label>
                            <textarea name="text" id="text" class="form-control">{{ old('text') }}</textarea>
                            @error('text')
                            <code>{{ $message }}</code>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="hasButton">Add Button</label>
                            <input type="checkbox" class="js-switch" name="hasButton" id="hasButton">
                        </div>

                        <div id="button-form" style="display: none;">
                            <div class="form-group">
                                <label for="btnLink">Button Link</label>
                                <input type="text" name="btnLink" id="btnLink"
                                       value="{{ old('btnLink') }}" class="form-control">
                                @error('btnLink')
                                <code>{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="btnText">Button Text</label>
                                <input type="text" name="btnText" id="btnText"
                                       value="{{ old('btnText') }}" class="form-control">
                                @error('btnText')
                                <code>{{ $message }}</code>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image-label">Banner</label>
                            <div class="input-group">

                                <input type="text" id="image_label" class="form-control" name="banner"
                                       aria-label="Image" aria-describedby="button-image">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var elem = document.querySelector('#hasButton');
        var init = new Switchery(elem);

        $('span#hasButton').on('click',function(){
           if(elem.checked){
               $('#button-form').show();
           }  else {
               $('#button-form').hide();
           }
        });

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
