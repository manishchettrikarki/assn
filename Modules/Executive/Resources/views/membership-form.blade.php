@extends('layouts.app')
@section('title','Become Member')
@section('content')
    <!-- CONTAINER -->
    <div class="container-fluid d-flex align-items-center min-vh-100">
        <div class="row g-0 justify-content-center">
            <!-- TITLE -->
            <div class="col-lg-3 offset-lg-1 mx-0 px-0">
                <div id="title-container">
                    <img class="covid-image" src="{{ site('logo') }}">
                    <h2>{{ site('name') }}</h2>
                    <h3>Become A Member</h3>
                    <p>Please fill in the details required in the form and complete all the steps to become our member.</p>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Launch demo modal
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- FORMS -->
            <div class="col-lg-9 mx-0 px-0">
                <div class="progress">
                    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                         role="progressbar" style="width: 0%"></div>
                </div>
                <div id="qbox-container">
                    <form class="needs-validation" id="member-form" method="post" name="form-wrapper" novalidate="" enctype="multipart/form-data">
                        @csrf

                        <div id="smartwizard">

                            <ul class="nav">
                                <li>
                                    <a href="#membership-criteria" class="nav-link">Membership Criteria</a>
                                </li>

                                <li>
                                    <a href="#personal-information" class="nav-link">Personal Information</a>
                                </li>

                                <li>
                                    <a href="#residential-address-information" class="nav-link">
                                        Residential Address</a>
                                </li>

                                <li>
                                    <a href="#professional-address-information" class="nav-link">
                                        Professional Address</a>
                                </li>

                                <li>
                                    <a href="#professional-qualification" class="nav-link">
                                        Professional Qualification/s
                                    </a>
                                </li>

                                <li>
                                    <a href="#confirm-details" class="nav-link">
                                        Confirm
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content">
                                <div id="membership-criteria" class="tab-pane" role="tabpanel">
                                    <h4>After PG in Ortho or Neurosurgery duly registered in NMC</h4>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question mb-1">
                                            <input class="form-check-input question__input" id="option_1" name="q_1" required type="radio" value="option_1">
                                            <label class="form-check-label question__label" for="option_1">Has participated in at least one ASSN conference
                                                Plus
                                                Has participated in at least one course organized by ASSN or endorsed by ASSN
                                            </label>
                                        </div>
                                        <div class="q-box__question mb-1">
                                            <input  class="form-check-input question__input" id="option_2" name="q_1" required type="radio" value="option_2">
                                            <label class="form-check-label question__label" for="option_2">Has done fellowship of at least 3 months duration recognized by ASSN</label>
                                        </div>
                                        <div class="q-box__question mb-1">
                                            <input  class="form-check-input question__input" id="option_3" name="q_1" required type="radio" value="option_3">
                                            <label class="form-check-label question__label" for="option_3">Has done fellowship recommended by ASSN</label>
                                        </div>
                                        <div class="q-box__question mb-1">
                                            <input  class="form-check-input question__input" id="option_4" name="q_1" required type="radio" value="option_4">
                                            <label class="form-check-label question__label" for="option_4">Has participated in at least one ASSN conference or Has participated in at least One course organized by ASSN or endorsed by ASSN or Has presented paper in ASSN conference
                                                Plus
                                                Has done International course recognized by ASSN like AO Spine Principle course
                                            </label>
                                        </div>
                                    </div>
                                    @error('q_1')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div id="personal-information" class="tab-pane" role="tabpanel">

                                    <div class="mt-1">
                                        <label  for="full_name">Full Name: </label>
                                        <input class="form-control @error('full_name') is-invalid @enderror" id="full_name"
                                               required name="full_name" type="text" value="{{ old('full_name') }}">
                                        @error('full_name')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="mobile">Mobile</label>
                                        <input class="form-control  @error('mobile') is-invalid @enderror" id="mobile"
                                               required name="mobile" type="text" value="{{ old('mobile') }}">
                                        @error('mobile')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="email">Email:</label>
                                        <input class="form-control  @error('email') is-invalid @enderror" id="email"
                                               required name="email" type="email" value="{{ old('email') }}">
                                        @error('email')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="dob">Date of Birth:</label>
                                        <input class="form-control  @error('dob') is-invalid @enderror" id="dob" name="dob"
                                               required type="text" value="{{ old('dob') }}">
                                        @error('dob')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="citizenship">Citizenship:</label>
                                        <input class="form-control  @error('citizenship') is-invalid @enderror" id="citizenship"
                                               required name="citizenship" type="text" value="{{ old('citizenship') }}">
                                        @error('citizenship')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row mt-2">

                                        <div class="col-lg-8">
                                            <div id="input-container">
                                                <input {{ old('gender') === 'male' ?'checked':'' }} class="form-check-input" name="gender"  required id="male" type="radio" value="male">
                                                <label  class="form-check-label radio-lb" for="male">Male</label>
                                                <input {{ old('gender') === 'female' ?'checked':'' }} class="form-check-input" name="gender" id="female" type="radio" value="female">
                                                <label class="form-check-label radio-lb" for="female">Female</label>
                                                <input {{ old('gender') === 'undefined' ?'checked':'' }} class="form-check-input" name="gender" id="undefined" type="radio" value="undefined">
                                                <label class="form-check-label radio-lb" for="undefined">Rather not say</label>
                                            </div>
                                            @error('gender')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div id="residential-address-information" class="tab-pane" role="tabpanel">

                                    <div class="mt-1">
                                        <label class="form-label" for="per_address">Permanent Address:</label>
                                        <input class="form-control @error('per_address') is-invalid @enderror" id="per_address"
                                               required name="per_address" type="text" value="{{ old('per_address') }}">
                                        @error('per_address')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="res_phone">Tel No.</label>
                                        <input class="form-control @error('res_phone') is-invalid @enderror" id="res_phone"
                                               name="res_phone" type="text" value="{{ old('res_phone') }}">
                                        @error('res_phone')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="temp_address">Present (if other than permanent address):</label>
                                        <input class="form-control @error('temp_address') is-invalid @enderror" id="temp_address"
                                               name="temp_address" type="text" value="{{ old('temp_address') }}">
                                        @error('temp_address')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label" for="temp_phone">Tel No:</label>
                                        <input class="form-control @error('temp_phone') is-invalid @enderror" id="temp_phone"
                                               name="temp_phone" type="text" value="{{ old('temp_phone') }}">
                                        @error('temp_phone')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="po_box">P.O. Box No:</label>
                                        <input class="form-control @error('po_box') is-invalid @enderror" id="po_box"
                                               name="po_box" type="text" value="{{ old('po_box') }}">
                                        @error('po_box')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div id="professional-address-information" class="tab-pane" role="tabpanel">

                                    <div class="mt-1">
                                        <label class="form-label" for="pro_address">Hospital/ Office</label>
                                        <input class="form-control @error('pro_address') is-invalid @enderror" id="pro_address"
                                               required name="pro_address" type="text" value="{{ old('pro_address') }}">
                                        @error('pro_address')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="designation">Designation</label>
                                        <input class="form-control @error('designation') is-invalid @enderror" id="designation"
                                               name="designation" required type="text" value="{{ old('designation') }}">
                                        @error('designation')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="pro_contact">Hospital/Office Tel No::</label>
                                        <input class="form-control @error('pro_contact') is-invalid @enderror" id="pro_contact"
                                               name="pro_contact" type="text" value="{{ old('pro_contact') }}">
                                        @error('pro_contact')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="pro_po_box">Hospital/Office P.O. Box No:</label>
                                        <input class="form-control @error('pro_po_box') is-invalid @enderror" id="pro_po_box"
                                               name="pro_po_box" type="text" value="{{ old('pro_po_box') }}">
                                        @error('pro_po_box')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="clinic">Clinic:</label>
                                        <input class="form-control @error('clinic') is-invalid @enderror" id="clinic"
                                               name="clinic" type="text" value="{{ old('clinic') }}">
                                        @error('clinic')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="pro_phone">Clinic Tel No:</label>
                                        <input class="form-control @error('pro_phone') is-invalid @enderror" id="pro_phone"
                                               name="pro_phone" type="text" value="{{ old('pro_phone') }}">
                                        @error('pro_phone')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="clinic_po_box">Clinic P.O. Box No:</label>
                                        <input class="form-control @error('clinic_po_box') is-invalid @enderror" id="clinic_po_box"
                                               name="clinic_po_box" type="text" value="{{ old('clinic_po_box') }}">
                                        @error('clinic_po_box')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="nmc">Nepal Medical Council Regn No.:</label>
                                        <input class="form-control @error('nmc') is-invalid @enderror" required
                                               value="{{ old('nmc') }}" id="nmc" name="nmc" type="text">
                                        @error('nmc')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="other_reg">Other Regn. No./s:</label>
                                        <input class="form-control @error('other_reg') is-invalid @enderror" id="other_reg"
                                               value="{{ old('other_reg') }}" name="other_reg" type="text">
                                        @error('other_reg')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div id="professional-qualification" class="tab-pane" role="tabpanel">

                                    <div class="mt-1">
                                        <label class="form-label" for="speciality">Speciality</label>
                                        <input class="form-control @error('speciality') is-invalid @enderror" id="speciality"
                                               name="speciality" type="text" value="{{ old('speciality') }}">
                                        @error('speciality')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">University-1</label>
                                        <input class="form-control @error('uni1_degree') is-invalid @enderror" id="uni1_degree"
                                               name="uni1_degree" placeholder="Degree/Diploma/Fellowship/Post Graduate/etc"
                                               type="text" value="{{ old('uni1_degree') }}">
                                        <input class="form-control @error('uni1_name') is-invalid @enderror" id="uni1_name"
                                               name="uni1_name" placeholder="University/Institution" type="text" value="{{ old('uni1_name') }}">
                                        <input class="form-control @error('uni1_year') is-invalid @enderror" id="uni1_year"
                                               name="uni1_year" placeholder="Year" type="text" value="{{ old('uni1_year') }}">
                                        @error('uni1_degree')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                        @error('uni1_name')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                        @error('uni1_year')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">University-2</label>
                                        <input class="form-control @error('uni2_degree') is-invalid @enderror" id="uni2_degree"
                                               name="uni2_degree" placeholder="Degree/Diploma/Fellowship/Post Graduate/etc"
                                               value="{{ old('uni2_degree') }}" type="text">
                                        <input class="form-control @error('uni2_name') is-invalid @enderror" id="uni2_name"
                                               name="uni2_name" placeholder="University/Institution" value="{{ old('uni2_name') }}" type="text">
                                        <input class="form-control @error('uni2_year') is-invalid @enderror" id="uni2_year"
                                               name="uni2_year" placeholder="Year" type="text" value="{{ old('uni2_year') }}">
                                        @error('uni2_degree')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                        @error('uni2_name')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                        @error('uni2_year')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">University-3</label>
                                        <input class="form-control @error('uni3_degree') is-invalid @enderror" id="uni3_degree"
                                               name="uni3_degree" placeholder="Degree/Diploma/Fellowship/Post Graduate/etc"
                                               value="{{ old('uni3_degree') }}" type="text">
                                        <input class="form-control @error('uni3_name') is-invalid @enderror" id="uni3_name"
                                               name="uni3_name" placeholder="University/Institution" type="text" value="{{ old('uni3_name') }}">
                                        <input class="form-control @error('uni3_year') is-invalid @enderror" id="uni3_year"
                                               name="uni3_year" placeholder="Year" type="text" value="{{ old('uni3_year') }}">
                                        @error('uni3_degree')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                        @error('uni3_name')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                        @error('uni3_year')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mt-2">

                                        <div class="form-group">
                                            <label for="pp_image">Upload Your Image:</label>
                                            <input type="file" class="form-control-file" required  name="pp_image"
                                                   id="pp_image">
                                            @error('pp_image')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="mt-2">

                                        <div class="form-group">
                                            <label for="signature">Upload Your Signature:</label>
                                            <input type="file" class="form-control-file" name="signature" id="signature">
                                            @error('signature')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="sponsor">Sponsored By Dr.</label>
                                        <input class="form-control @error('sponsor') is-invalid @enderror" id="sponsor"
                                               name="sponsor" type="text" value="{{ old('sponsor') }}">
                                        @error('sponsor')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <br>

                                    <div class="q-box__question">
                                        <input class="form-check-input question__input q-checkbox" id="toa" name="toa" type="checkbox" required>
                                        <label class="form-check-label question__label" for="toa">I hereby declare that the above statements are true and shall abide by the rules & regulations of the constitution of the
                                            ASSN. I will inform ASSN in case of any change in above details.
                                        </label>
                                        @error('toa')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div id="confirm-details" class="tab-pane" role="tabpanel">

                                    Please be sure to confirm all the details provided are accurate and not are subjected to change during further processing before submitting.

                                </div>

                            </div>
                        </div>







                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
