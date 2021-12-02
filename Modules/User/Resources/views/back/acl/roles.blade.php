@extends('back.partials.layout')
@section('title','Roles')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Roles & Permissions</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">ACL</a></li>
                                    <li class="breadcrumb-item active">Roles</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                @can('add roles')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">Create Role</h4>
                                <p class="card-title-desc">Select <code>access</code> to be given.</p>
                                <form action="{{ route('user.add.roles') }}" method="post" class="custom-validation" novalidate>
                                    @csrf
                                    <div class="form-group @error('roleName') has-error @enderror col-md-4">
                                        <h5 class="font-size-14">Name</h5>
                                        <input class="form-control @error('roleName') has-error @enderror" data-parsley-length="[3,10]" type="text" required name="roleName" value="{{ old('roleName') }}" id="roleName">
                                        @error('roleName')
                                          <p style="color:red;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5 class="font-size-14">Access</h5>
                                        <div class="row">
                                                 <div class="col-12">
                                                     <div class="custom-control custom-checkbox">
                                                         <input type="checkbox"  class="custom-control-input" id="permission" required  data-parsley-multiple="permission"
                                                                data-parsley-mincheck="2">
                                                         <label class="custom-control-label text-weight-bold text-danger" for="permission">Check all</label>
                                                     </div>
                                                 </div>
                                                @forelse($permissions as $permission)
                                                    <div class="col-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" value="{{ $permission->name }}" class="custom-control-input" id="permission{{ $loop->iteration }}" required name="permissions[]" data-parsley-multiple="permission"
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
                @endcan

                @can('view roles')
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Available roles</h4>
                                <p class="card-title-desc"> <code>Deleting role will revoke all users access associated with it.</code></p>

                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Role</th>
                                            <th>Granted Access</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($roles as $role)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <ul class="list-inline mb-0">
                                                    @foreach($role->permissions as $p)
                                                        <li class="list-inline-item">{{ $p->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <div class="button-items">
                                                    <a href="{{ route('user.edit.roles',$role->name) }}" type="button" class="btn btn-primary waves-effect waves-light">Update</a>
                                                    <a href="#" type="button" data-url="{{ route('user.delete.roles',$role->name) }}" data-name="{{ $role->name }}" data-type="Role" class="btn btn-danger waves-effect waves-light delete">Delete</a>
                                                </div>

                                            </td>
                                        </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endcan

                @can('assign user roles')
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">Assign Role to User</h4>
                                <p class="card-title-desc">Select <code>roles</code> to be given.</p>
                                <form action="{{ route('user.assign.role') }}" method="post" class="custom-validation" novalidate>
                                    @csrf
                                    <div class="form-group @error('user') has-error @enderror col-md-4">
                                        <h5 class="font-size-14">User</h5>
                                        <input class="form-control user-typeahead @error('user') has-error @enderror"  type="text" required name="user" value="{{ old('user') }}" id="user">
                                        @error('user')
                                        <p style="color:red;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5 class="font-size-14">Roles</h5>
                                        <div class="row">

                                            @forelse($roles as $r)
                                                <div class="col-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" value="{{ $role->name }}" class="custom-control-input" id="role{{ $loop->iteration }}" required name="roles[]" data-parsley-multiple="roles"
                                                               data-parsley-mincheck="1">
                                                        <label class="custom-control-label" for="role{{ $loop->iteration }}">{{ $role->name }}</label>
                                                    </div>
                                                    @error('roles.'.($loop->iteration-1))
                                                    <p style="color:red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            @empty
                                                <h5>No roles found.</h5>
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
                @endcan

                @can('revoke user roles')
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">Detach Role from User</h4>
                                <p class="card-title-desc">Select <code>roles</code> to be given.</p>
                                <form action="{{ route('user.detach.role') }}" method="post" class="custom-validation" novalidate>
                                    @csrf
                                    <div class="form-group @error('user') has-error @enderror col-md-4">
                                        <h5 class="font-size-14">User</h5>
                                        <input class="form-control user-typeahead @error('user') has-error @enderror" data-parsley-length="[3,10]" type="text" required name="user" value="{{ old('user') }}" id="user">
                                        @error('user')
                                        <p style="color:red;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5 class="font-size-14">Roles</h5>
                                        <div class="row">

                                            @forelse($roles as $r)
                                                <div class="col-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" value="{{ $role->name }}" class="custom-control-input" id="permission{{ $loop->iteration }}" required name="roles[]" data-parsley-multiple="roles"
                                                               data-parsley-mincheck="1">
                                                        <label class="custom-control-label" for="permission{{ $loop->iteration }}">{{ $role->name }}</label>
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
                @endcan

                @can('add permission')
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">Create Permission</h4>
                                <form action="{{ route('user.add.permission') }}" method="post"
                                      class="custom-validation" novalidate>
                                    @csrf
                                    <div class="form-group @error('permissionName') has-error @enderror col-md-4">
                                        <label class="font-size-14">Name</label>
                                        <input class="form-control @error('permissionName') has-error @enderror"
                                                type="text" required name="permissionName"
                                               value="{{ old('permissionName') }}" id="permissionName">
                                        @error('permissionName')
                                        <p style="color:red;">{{ $message }}</p>
                                        @enderror
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
                @endcan


            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->



    </div>
@endsection
@section('script')
    <script src="{{ asset('back/js/init/form-validation.init.js') }}"></script>
    <script>
        $('#permission').on('change',function(){
            if($(this).is(':checked')){
                $('input[name="permissions[]"]').each(function(){
                    $(this).attr('checked','checked');
                })
            } else {
                $('input[name="permissions[]"]').each(function(){
                    $(this).attr('checked',false);
                });
            }
        })
    </script>
@endsection
