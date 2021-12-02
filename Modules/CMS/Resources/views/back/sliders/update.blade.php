@extends('back.partials.layout')
@section('title','Update Slider Images')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Update Slider</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                    <li class="breadcrumb-item active">Update Slider</li>
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
                                <h4 class="header-title">Update Slider</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-title-desc">

                                        </p>
                                    </div>

                                </div>

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Update Slider</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('cms.sliders.update',encrypt($slider->id)) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="heading">Heading</label>
                                                <input type="text" value="{{ (!is_null(old('heading')))?old('heading'):$slider->heading }}" name="heading"
                                                       class="form-control" id="heading">
                                                @error('heading')
                                                <code>{{ $message }}</code>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="subHeading">Sub-heading</label>
                                                <input type="text" value="{{ (!is_null(old('subHeading')))?old('subHeading'):$slider->sub_heading }}" name="subHeading"
                                                       id="subHeading" class="form-control">
                                                @error('subHeading')
                                                <code>{{ $message }}</code>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="text">Text</label>
                                                <textarea name="text" id="text" class="form-control">
                                                    {{ (!is_null(old('text')))?old('text'):$slider->text }}
                                                </textarea>
                                                @error('text')
                                                <code>{{ $message }}</code>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="hasButton">Add Button</label>
                                                <input type="checkbox" {{ (!is_null(old('hasButton')))?'checked':'' }}
                                                class="js-switch" name="hasButton" id="hasButton">
                                            </div>

                                            <div id="button-form" style="display: none;">
                                                <div class="form-group">
                                                    <label for="btnLink">Button Link</label>
                                                    <input type="text" name="btnLink" id="btnLink"
                                                           value="{{ (!is_null(old('btnLink')))?old('btnLink'):$slider->link }}"
                                                           class="form-control">
                                                    @error('btnLink')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="btnText">Button Text</label>
                                                    <input type="text" name="btnText" id="btnText"
                                                           value="{{ (!is_null(old('btnText')))?old('btnText'):$slider->name }}" class="form-control">
                                                    @error('btnText')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="image-label">Banner</label>
                                                <div class="input-group">

                                                    <input type="text" id="image_label"
                                                           value="{{ (!is_null(old('banner')))?old('banner'):$slider->banner }}"
                                                           class="form-control" name="banner"
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
                    </div>
                </div>

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
