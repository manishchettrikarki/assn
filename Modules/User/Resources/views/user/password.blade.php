@extends('user::layout')
@section('title','Update password')
@section('content')
    <div class="account-pages my-5 pt-5">
        <div class="container">

            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-2">
                                <h5 class="mb-5 text-center">Update Password</h5>
                                <form class="form-horizontal" method="post" action="{{ route('update.password') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                You will be logged out after your password update!
                                            </div>

                                            <div class="form-group mt-4">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password"
                                                       placeholder="Enter current password" name="password">
                                                @error('password')
                                                <code>{{ $message }}</code>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-4">
                                                <label for="newPassword">New Password</label>
                                                <input type="password" class="form-control" id="newPassword"
                                                       placeholder="Enter new password" name="newpassword">
                                                @error('newpassword')
                                                <code>{{ $message }}</code>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-4">
                                                <label for="confirmPassword">Confirm Password</label>
                                                <input type="password" class="form-control" id="confirmPassword"
                                                       placeholder="Confirm new password" name="newpassword_confirmation">
                                                @error('newpassword')
                                                <code>{{ $message }}</code>
                                                @enderror
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Update</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
