@extends('back.partials.layout')
@section('title','Dashboard')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    @foreach($modulesName as $moduleName)
                        @if(view()->exists($moduleName.'::back.dashboard.card-widget'))
                        @include($moduleName.'::back.dashboard.card-widget')
                        @endif
                    @endforeach

                </div>
                <!-- end row -->







            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
@endsection
@section('script')
    <script>


    </script>
@endsection
