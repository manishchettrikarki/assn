@extends('back.partials.layout')
@section('title','Add executive Member')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18 pull-left">

                                Executive Members
                            </h4>


                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ site('name') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Executives</a></li>
                                    <li class="breadcrumb-item active">Add Members</li>
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
                                        <h4 class="header-title pull-left">Executive Members</h4>
                                    </div>
                                    @can('add executive members')
                                        <div class="col-6">
                                            <a href="{{ route('executives.index') }}" class="btn btn-sm btn-success float-right">Back</a>
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
                                    <form action="{{ route('executive.members.store') }}" method="post">
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
                                                    <label for="email">Email</label>
                                                    <input type="email"  value="{{ old('email') }}"
                                                           id="email" name="email" class="form-control">
                                                    @error('email')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="memberType">Member Type</label>
                                                    <select name="memberType" id="memberType"
                                                            class="form-control">
                                                        <option value="" selected hidden></option>
                                                        <option value="executive">Executive</option>
                                                        <option value="scientific">Scientific</option>
                                                    </select>
                                                    @error('memberType')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 col-sm-12" id="exec-desig" style="display:none;">
                                                <div class="form-group">
                                                    <label for="executive-designation">Designation</label>
                                                  <select id="executive-designation" name="designation" class="form-control">
                                                    <option value="President">President</option>
                                                    <option value="Vice-President">Vice-President</option>
                                                    <option value="Imm. Past President">Imm. Past President</option>
                                                    <option value="General Secretary">General Secretary</option>
                                                    <option value="Treasurer">Treasurer</option>
                                                      <option value="Joint Secretary">Joint Secretary</option>
                                                    <option value="Member">Member</option>

                                                  </select>
                                                    @error('designation')
                                                    <code>{{ $message }}</code>
                                                    @enderror
                                                </div>
                                            </div>

                                          <div class="col-md-6 col-lg-6 col-sm-12" id="sci-desig" style="display: none">
                                            <div class="form-group">
                                              <label for="scientific-designation">Designation</label>
                                              <select id="scientific-designation" name="designation" class="form-control">
                                                <option value="Chairman">Chairman</option>
                                                <option value="Member">Member</option>
                                              </select>
                                              @error('designation')
                                              <code>{{ $message }}</code>
                                              @enderror
                                            </div>
                                          </div>


                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <div class="input-group">

                                                        <input type="text" id="image_label" value="{{ old('image') }}" class="form-control" name="image"
                                                               aria-label="Image" aria-describedby="button-image">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
                                                        </div>
                                                    </div>
                                                    @error('image')
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

        $('#memberType').on('change',function(){
            var type = $(this).val();
            if(type === 'executive'){
                $('#scientific-designation').attr('name','');
                $('#executive-designation').attr('name','designation');
                $('#exec-desig').show();
                $('#sci-desig').hide();
            } else if(type === 'scientific'){
                $('#executive-designation').attr('name','');
                $('#scientific-designation').attr('name','designation');
                $('#exec-desig').hide();
                $('#sci-desig').show();
            } else {
                alert("Invalid member type.");
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

