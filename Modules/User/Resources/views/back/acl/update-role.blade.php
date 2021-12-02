@extends('back.partials.layout')
@section('title','Update Role '.$role->name)
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">{{ $role->name }} Role Update</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">ACL</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $role->name }} Role</a></li>
                                    <li class="breadcrumb-item active">Update</li>
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

                                <h4 class="header-title">Update Role</h4>
                                <p class="card-title-desc">Select <code>access</code> to be given.</p>
                                <form action="{{ route('user.update.roles',$role->id) }}" method="post" class="custom-validation" novalidate>
                                    @csrf
                                    <div class="form-group @error('roleName') has-error @enderror col-md-4">
                                        <h5 class="font-size-14">Name</h5>
                                        <input class="form-control @error('roleName') has-error @enderror" data-parsley-length="[3,10]" type="text" required name="roleName" value="{{ $role->name }}" id="roleName">
                                        @error('roleName')
                                        <p style="color:red;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5 class="font-size-14">Access</h5>
                                        <div class="row">

                                            @forelse($permissions as $permission)
                                                <div class="col-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" value="{{ $permission->name }}" {{ ($role->hasPermissionTo($permission))?'checked':'' }} class="custom-control-input" id="permission{{ $loop->iteration }}" required name="permissions[]" data-parsley-multiple="permission"
                                                               data-parsley-mincheck="2">
                                                        <label class="custom-control-label" for="permission{{ $loop->iteration }}">{{ $permission->name }}</label>
                                                    </div>
                                                </div>
                                            @empty
                                                <h5>No permissions found.</h5>
                                            @endforelse

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Submit" class="btn btn-success">
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>






            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->



    </div>
@endsection
@section('script')
    <script src="{{ asset('back/js/init/form-validation.init.js') }}"></script>
    <script>

    </script>
@endsection
