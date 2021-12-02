@extends('back.partials.layout')
@section('title',$user->name)
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">
                                Users
                            </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                    <li class="breadcrumb-item active">{{ $user->name }}</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="col-12">
                    <div class="row">
                        @foreach($modulesName as $cardWidget)
                            @if(view()->exists($cardWidget.'::back.user.card'))
                                @include($cardWidget.'::back.user.card')
                            @endif
                        @endforeach

                            <div class="col-sm-6 col-xl-3">
                                <div class="card border-danger">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14"></h5>
                                            </div>

                                        </div>

                                        @if(!$user->trashed())
                                            @if($user->is_active)
                                                @can('suspend users')
                                                <a href="{{ route('user.suspend',encrypt($user->id)) }}" class="btn btn-outline-danger">Suspend</a>
                                                @endcan
                                            @else
                                                @can('unsuspend users')
                                                <a href="{{ route('user.unsuspend',encrypt($user->id)) }}" class="btn btn-outline-success">Activate</a>
                                                @endcan
                                            @endif
                                            @can('delete users')
                                            <a href="{{ route('users.delete',encrypt($user->id)) }}" class="btn btn-danger">Delete</a>
                                            @endcan
                                        @else
                                            @can('restore users')
                                            <a href="{{ route('users.restore',encrypt($user->id)) }}" class="btn btn-success">Restore</a>
                                            @endcan
                                        @endif

                                    </div>
                                </div>
                            </div>


                    </div>
                </div>





                <div class="col-12 mt-5">
                    <div class="row">
                        @foreach($modulesName as $graphWidget)
                            @if(view()->exists($graphWidget.'::back.user.graph'))
                                @include($graphWidget.'::back.user.graph')
                            @endif
                        @endforeach
                    </div>
                </div>




            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
@endsection
@section('script')

@endsection
