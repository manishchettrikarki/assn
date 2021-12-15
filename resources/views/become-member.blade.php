@extends('layouts.app')
@section('title','Become Member')
@section('content')
    <!-- CONTAINER -->
    <div class="container d-flex align-items-center min-vh-100">
        <div class="row g-0 justify-content-center">
            <!-- TITLE -->
            <div class="col-lg-4 offset-lg-1 mx-0 px-0">
                <div id="title-container">
                    <img class="covid-image" src="http://localhost:8000/uploads/logo/logo.png">
                    <h2>ASSN</h2>
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
                                    Hello world
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
            <div class="col-lg-7 mx-0 px-0">
                <div class="progress">
                    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                         role="progressbar" style="width: 0%"></div>
                </div>
                <div id="qbox-container">
                    <form class="needs-validation" id="member-form" method="post" name="form-wrapper" novalidate="" >
                        @csrf
                        <div id="steps-container">
                            <div class="step">
                                <h3>Membership criteria ASSN</h3>
                                <h4>After PG in Ortho or Neurosurgery duly registered in NMC</h4>
                                <div class="form-check ps-0 q-box">
                                    <div class="q-box__question mb-1">
                                        <input class="form-check-input question__input" id="option_1" name="q_1" type="radio" value="Yes">
                                        <label class="form-check-label question__label" for="option_1">Has participated in at least one ASSN conference
                                            Plus
                                            Has participated in at least one course organized by ASSN or endorsed by ASSN
                                        </label>
                                    </div>
                                    <div class="q-box__question mb-1">
                                        <input  class="form-check-input question__input" id="option_2" name="q_1" type="radio" value="No">
                                        <label class="form-check-label question__label" for="option_2">Has done fellowship of at least 3 months duration recognized by ASSN</label>
                                    </div>
                                    <div class="q-box__question mb-1">
                                        <input  class="form-check-input question__input" id="option_3" name="q_1" type="radio" value="No">
                                        <label class="form-check-label question__label" for="option_3">Has done fellowship recommended by ASSN</label>
                                    </div>
                                    <div class="q-box__question mb-1">
                                        <input  class="form-check-input question__input" id="option_4" name="q_1" type="radio" value="No">
                                        <label class="form-check-label question__label" for="option_4">Has participated in at least one ASSN conference or Has participated in at least One course organized by ASSN or endorsed by ASSN or Has presented paper in ASSN conference
                                            Plus
                                            Has done International course recognized by ASSN like AO Spine Principle course
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="step">
                                <h4>Provide us with your personal information:</h4>
                                <div class="mt-1">
                                    <label class="form-label">Complete Name: Dr.</label>
                                    <input class="form-control" id="full_name" name="full_name" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Date of Birth:</label>
                                    <input class="form-control" id="email" name="email" type="email">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Citizenship:</label>
                                    <input class="form-control" id="phone" name="phone" type="text">
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-2 col-md-2 col-3">
                                        <label class="form-label">Age:</label>
                                        <div class="input-container">
                                            <input class="form-control" id="age" name="age" type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="input-container">
                                            <input class="form-check-input" name="gender" type="radio" value="male">
                                            <label class="form-check-label radio-lb">Male</label>
                                            <input class="form-check-input" name="gender" type="radio" value="female">
                                            <label class="form-check-label radio-lb">Female</label>
                                            <input checked class="form-check-input" name="gender" type="radio" value="undefined">
                                            <label class="form-check-label radio-lb">Rather not say</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step">
                                <h4>Provide us with your Residential Address Information:</h4>
                                <div class="mt-1">
                                    <label class="form-label">Permanent Address:</label>
                                    <input class="form-control" id="full_name" name="full_name" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Tel No.</label>
                                    <input class="form-control" id="phone" name="phone" type="phone">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Present (if other than permanent address):</label>
                                    <input class="form-control" id="phone" name="phone" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Mobile</label>
                                    <input class="form-control" id="phone" name="phone" type="phone">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Email:</label>
                                    <input class="form-control" id="phone" name="phone" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Tel No:</label>
                                    <input class="form-control" id="phone" name="phone" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">P.O. Box No:</label>
                                    <input class="form-control" id="phone" name="phone" type="text">
                                </div>

                            </div>
                            <div class="step">
                                <h4>Provide us with your Professional Address Information:</h4>
                                <div class="mt-1">
                                    <label class="form-label">Hospital/ Office</label>
                                    <input class="form-control" id="full_name" name="full_name" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Designation</label>
                                    <input class="form-control" id="phone" name="phone" type="phone">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Tel No::</label>
                                    <input class="form-control" id="phone" name="phone" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">P.O. Box No:</label>
                                    <input class="form-control" id="phone" name="phone" type="phone">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Clinic:</label>
                                    <input class="form-control" id="phone" name="phone" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Tel No:</label>
                                    <input class="form-control" id="phone" name="phone" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">P.O. Box No:</label>
                                    <input class="form-control" id="phone" name="phone" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Nepal Medical Council Regn No.:</label>
                                    <input class="form-control" id="phone" name="phone" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Other Regn. No./s:</label>
                                    <input class="form-control" id="phone" name="phone" type="text">
                                </div>
                            </div>
                            <div class="step">
                                <h4>Provide us with your Professional Qualification/s</h4>
                                <div class="mt-1">
                                    <label class="form-label">Speciality</label>
                                    <input class="form-control" id="full_name" name="full_name" type="text">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">University-1</label>
                                    <input class="form-control" id="phone" name="phone" placeholder="Degree/Diploma/Fellowship/Post Graduate/etc" type="phone">
                                    <input class="form-control" id="phone" name="phone" placeholder="University/Institution" type="phone">
                                    <input class="form-control" id="phone" name="phone" placeholder="Year" type="phone">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">University-2</label>
                                    <input class="form-control" id="phone" name="phone" placeholder="Degree/Diploma/Fellowship/Post Graduate/etc" type="phone">
                                    <input class="form-control" id="phone" name="phone" placeholder="University/Institution" type="phone">
                                    <input class="form-control" id="phone" name="phone" placeholder="Year" type="phone">
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">University-3</label>
                                    <input class="form-control" id="phone" name="phone" placeholder="Degree/Diploma/Fellowship/Post Graduate/etc" type="phone">
                                    <input class="form-control" id="phone" name="phone" placeholder="University/Institution" type="phone">
                                    <input class="form-control" id="phone" name="phone" placeholder="Year" type="phone">
                                </div>
                                <div class="mt-2">
                                    <form>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Upload Your Image:</label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-2">
                                    <form>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Upload Your Signature:</label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Sponsored By Dr.</label>
                                    <input class="form-control" id="phone" name="phone" type="text">
                                </div>
                                <br>

                                    <div class="q-box__question">
                                        <input class="form-check-input question__input q-checkbox" id="q_4_uk" name="q_4" type="checkbox" value="uk">
                                        <label class="form-check-label question__label" for="q_4_uk">I hereby declare that the above statements are true and shall abide by the rules & regulations of the constitution of the
                                            ASSN. I will inform ASSN in case of any change in above details.
                                        </label>
                                    </div>


                            </div>

                            <div class="step">
                                <h4>Are you sure about all the information you have provided to us? if not then you can go to previous steps and correct them before you go and submit the form</h4>

                            </div>
                            <div class="step">
                                <div class="mt-1">
                                    <div class="closing-text">
                                        <h4>That's about it! Thank You!</h4>
                                        <p>We will assess your information and will let you know soon about your membership with us.</p>
                                        <p>Click on the submit button to continue.</p>
                                    </div>
                                </div>
                            </div>
                            <div id="success">
                                <div class="mt-5">
                                    <h4>Success! We'll get back to you ASAP!</h4>
                                    <p>Meanwhile, clean your hands often, use soap and water, or an alcohol-based hand rub, maintain a safe distance from anyone who is coughing or sneezing and always wear a mask when physical distancing is not possible.</p>
                                    <a class="back-link" href="">Go back from the beginning ➜</a>
                                </div>
                            </div>
                        </div>
                        <div id="q-box__buttons">
                            <button id="prev-btn" type="button">Previous</button>
                            <button id="next-btn" type="button">Next</button>
                            <button id="submit-btn" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
