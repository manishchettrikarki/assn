@extends('back.partials.layout')
@section('title','Site Settings')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Site Settings</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                    <li class="breadcrumb-item active">Site Settings</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Site Settings</h4>

                                @if((bool)$setting->updated_by)
                                    <code>Last updated by: </code>{{ $setting->lastUpdatedBy->name }} at
                                    {{ $setting->updated_at->toDateTimeString() }}
                                @endif
                                <div class="mb-5 mt-5">
                                    <form action="{{ route('site.settings.update') }}" method="post">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text"
                                                           value="{{ ((bool)old('name'))?old('url'):$setting->name }}"
                                                           id="name" name="name" class="form-control">
                                                    @error('name')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <input type="text"
                                                           value="{{ ((bool)old('description'))?old('merchant'):$setting->description }}"
                                                           id="description" name="description" class="form-control">
                                                    @error('description')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="primaryEmail">Primary Email</label>
                                                    <input type="text"
                                                           value="{{ ((bool)old('primaryEmail'))?old('primaryEmail'):$setting->primary_email }}"
                                                           id="primaryEmail" name="primaryEmail" class="form-control">
                                                    @error('primaryEmail')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="secondaryEmail">Secondary Email</label>
                                                    <input type="text"
                                                           value="{{ ((bool)old('secondaryEmail'))?old('secondaryEmail'):$setting->secondary_email }}"
                                                           id="secondaryEmail" name="secondaryEmail"
                                                           class="form-control">
                                                    @error('secondaryEmail')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="huntingLine">Hunting Line</label>
                                                    <input type="text"
                                                           value="{{ ((bool)old('huntingLine'))?old('huntingLine'):$setting->hunting_line }}"
                                                           id="huntingLine" name="huntingLine"
                                                           class="form-control">
                                                    @error('huntingLine')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="contact">Contact</label>
                                                    <input type="text"
                                                           value="{{ ((bool)old('contact'))?old('contact'):$setting->contact }}"
                                                           id="contact" name="contact"
                                                           class="form-control">
                                                    @error('contact')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input type="text" id="address" name="address"
                                                           value="{{ ((bool)old('address'))?old('address'):$setting->address }}"
                                                           class="form-control">
                                                    @error('address')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="logo">Logo</label>
                                                    <div class="input-group">

                                                        <input type="text" id="image_label" value="{{ $setting->logo }}" class="form-control" name="logo"
                                                               aria-label="Image" aria-describedby="button-image">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
                                                        </div>
                                                    </div>
                                                    @error('logo')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                                @isset($setting->logo)
                                                    <img src="{{ $setting->logo }}"  alt="">
                                                @endisset
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for=""></label>
                                                <input type="submit" value="Update" class="btn btn-danger">
                                            </div>
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
