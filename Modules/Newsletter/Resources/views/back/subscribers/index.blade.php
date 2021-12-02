@extends('back.partials.layout')
@section('title','Subscribers')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Subscribers</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Newsletter</a></li>
                                    <li class="breadcrumb-item active">Subscribers</li>
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

                                <h4 class="header-title">Subscribers</h4>
                                <div class="row">

                                </div>



                                <table id="datatable-buttons"
                                       class="table table-responsive table-striped table-bordered dt-responsive "
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="datatable-nosort">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Email verified</th>
                                        <th>Subscribed Date</th>
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
            autoWidth: false,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('newsletter.subscribers.data') }}',
            columns: [

                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'email_verified'},
                {data: 'created_at'},
                {data: 'actions'},
            ],
            columnDefs: [
                {
                    targets: "datatable-nosort",
                    orderable: false,
                },
                // {
                // render: createManageBtn, data: null, targets: [6]
                // }
            ],
            lengthMenu: [
                [ 10, 25, 50, 100, -1 ],
                [ '10 rows', '25 rows', '50 rows', '100 rows', 'All' ]
            ],
            dom: 'Blfrtip',
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
