@extends('layouts.app')
@section('title','Apply for membership')
@section('content')
    <section id="page-content-wrap">
        <div class="register-page-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="register-page-inner">
                            <h3 class="text-bold text-center">Registration Form</h3>
                            <div class="col-lg-12 m-auto align-items-center">
                                @if(session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ session('success') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @else
                                    <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                                        <strong>

                                            All fields marked <sup class="text-danger">*</sup> are required. <br>
                                            All documents listed below are required.<br>
                                            For payment details
                                            <a tabindex="0" class="text-info"
                                               role="button" data-toggle="popover"
                                               data-trigger="focus"
                                               data-html="true"
                                               data-content="<div class='px-2'><h4>Siddartha Bank</h4>
                                           <h6>AC Name: Arthoscopy Society of Nepal</h6>
                                           <h6>AC Number: 01815323745</h6></div>">Click here</a>

                                        </strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="register-form-content">
                                    <form action="{{ route('membership.submit') }}" method="post" enctype="multipart/form-data">
                                        <div class="row">

                                        @csrf
                                        <!-- Signin Area Content Start -->
                                            <div class="col-lg-6 col-md-6 ml-auto">

                                                <div class="register-form-wrap">

                                                    <div class="register-form">

                                                        <div class="row">
                                                            <div class="col-6 col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="title">Title <span class="text-danger font-weight-bold"><sup>*</sup></span> </label>
                                                                    <select  class="form-control" id="title" name="title">
                                                                        <option value="" selected hidden>...</option>
                                                                        <option {{ (old('title') == 'Mr.')?'selected':'' }} value="Mr.">Mr.</option>
                                                                        <option {{ (old('title') == 'Mrs.')?'selected':'' }} value="Mrs.">Mrs.</option>
                                                                        <option {{ (old('title') == 'Miss.')?'selected':'' }} value="Miss.">Miss.</option>
                                                                    </select>
                                                                    @error('title')
                                                                    <span class="error">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-6 col-sm-8">
                                                                <div class="form-group">
                                                                    <label for="name">Full Name <span class="text-danger"><sup>*</sup></span></label>
                                                                    <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name">
                                                                    @error('name')
                                                                    <span class="error">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="country">Country <span class="text-danger"><sup>*</sup></span></label>
                                                                    <input type="text" class="form-control" value="{{ old('country') }}" id="country" name="country">
                                                                    @error('country')
                                                                    <span class="error">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="state">State <span class="text-danger"><sup>*</sup></span></label>
                                                                    <input type="text" class="form-control" value="{{ old('state') }}" id="state" name="state" />
                                                                    @error('state')
                                                                    <span class="error">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="city">City <span class="text-danger"><sup>*</sup></span></label>
                                                                    <input type="text" class="form-control" value="{{ old('city') }}" id="city" name="city" />
                                                                    @error('city')
                                                                    <span class="error">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="pinCode">PIN Code</label>
                                                                    <input type="text" class="form-control" value="{{ old('pinCode') }}" id="pinCode" name="pinCode" />
                                                                    @error('pinCode')
                                                                    <span class="error">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="mobile">Mobile Number <span class="text-danger"><sup>*</sup></span></label>
                                                                    <input type="text" class="form-control" value="{{ old('mobile') }}" id="mobile" name="mobile" />
                                                                    @error('mobile')
                                                                    <span class="error">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="email">Email Address <span class="text-danger"><sup>*</sup></span></label>
                                                                    <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" />
                                                                    @error('email')
                                                                    <span class="error">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="landline">Landline Number </label>
                                                                    <input type="text" class="form-control" value="{{ old('landline') }}" id="landline" name="landline" />
                                                                    @error('landline')
                                                                    <span class="error">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="clinic">Landline Clinic</label>
                                                                    <input type="text" class="form-control" value="{{ old('clinic') }}" id="clinic" name="clinic" />
                                                                    @error('clinic')
                                                                    <span class="error">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 col-sm-6">
                                                                <div class=" form-group">
                                                                    <label class="g-name d-block">Gender <span class="text-danger"><sup>*</sup></span></label>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input checked type="radio" id="gender_male" name="gender" value="male" class="custom-control-input" />
                                                                        <label class="custom-control-label" for="gender_male">Male</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="gender_female" name="gender" value="female" class="custom-control-input">
                                                                        <label class="custom-control-label" for="gender_female">Female</label>
                                                                    </div>
                                                                    @error('gender')
                                                                    <span class="error">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="dob">Date of Birth <span class="text-danger"><sup>*</sup></span></label>
                                                                    <input type="text" class="form-control" value="{{ old('dob') }}" id="dob" name="dob" />
                                                                    @error('dob')
                                                                    <span class="error">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- Signin Area Content End -->

                                            <!-- Regsiter Form Area Start -->
                                            <div class="col-lg-6 col-md-6 ml-auto" style="border-left: 3px solid #4e51ca">
                                                <div class="register-form-wrap">

                                                    <div class="register-form">

                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <div class="form-group file-input">
                                                                    <input type="file" name="photo" id="customfile" class="d-none" />
                                                                    <label class="custom-file" for="customfile"><i class="fa fa-upload"></i>Upload Your Photo</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-12">
                                                                <img src="" height="100"  alt="">
                                                                @error('photo')
                                                                <span class="error">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <div class="form-group file-input">
                                                                    <input type="file" name="mbbs" id="mbbs" class="d-none" />
                                                                    <label class="custom-file" for="mbbs"><i class="fa fa-upload"></i>Upload MBBS Certificate</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-12">
                                                                <img src="" height="100"  alt="">
                                                                @error('mbbs') <span class="error">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <div class="form-group file-input">
                                                                    <input type="file" name="ortho" id="ortho" class="d-none" />
                                                                    <label class="custom-file" for="ortho"><i class="fa fa-upload"></i>Upload Your MS Certificate</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-12">
                                                                <img src="" height="100"  alt="">
                                                                @error('ortho')
                                                                <span class="error">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <div class="form-group file-input">
                                                                    <input type="file" name="other" id="other" class="d-none" />
                                                                    <label class="custom-file" for="other"><i class="fa fa-upload"></i>Upload receipt of payment</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-12">
                                                                <img src="" height="100"  alt="">
                                                                @error('other') <span class="error">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4 col-lg-4 col-sm-12" >
                                                                <div class="form-group">
                                                                    <div class="g-recaptcha"
                                                                         data-sitekey="{{env('GOOGLE_RECAPTCHA_PUBLIC')}}">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-12">
                                                                @error('g-recaptcha-response') <span class="error">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>




                                                        <div class="form-group">
                                                            <input type="submit" value="Submit" class="btn btn-lg btn-block btn-primary">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Regsiter Form Area End -->

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

