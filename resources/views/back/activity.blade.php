@extends('back.partials.layout')
@section('title','Activity Log')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Activity Log</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                    <li class="breadcrumb-item active">Activity Log</li>
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

                                <h4 class="header-title">Activity Log</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-title-desc">

                                        </p>
                                    </div>
                                    <div class="col-6">

                                    </div>
                                </div>



                                <table id="datatable-buttons"
                                       class="table table-responsive table-striped table-bordered dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="datatable-nosort">#</th>
                                        <th>Type</th>
                                        <th>Activist</th>
                                        <th>Activity</th>
                                        <th>Date</th>
                                        <th class="datatable-nosort">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
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
        var t = $("#datatable-buttons").DataTable({
            scrollCollapse: true,
            autoWidth: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('activity.log.data') }}',
            columns: [

                {data: 'id'},
                {data: 'entity_type'},
                {data: 'user_id'},
                {data: 'activity'},
                {data: 'created_at'},
                {data: 'actions'},

            ],
            columnDefs: [
                {
                    targets: "datatable-nosort",
                    orderable: false,
                },

            ],
            buttons: [
                'copy','print','csv','pdf'
            ]
        });
        t.on('order.dt search.dt', function () {
            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();


    </script>
@endsection
