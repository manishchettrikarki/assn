@extends('back.partials.layout')
@section('title','Deleted Users')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">
                                Deleted Users
                            </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                    <li class="breadcrumb-item active">Deleted Users</li>
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

                                <h4 class="header-title">Deleted Users</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-title-desc">

                                        </p>
                                    </div>

                                </div>



                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Deleted By</th>
                                        <th>Deleted At</th>
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
    <script src="{{ asset('back/js/init/form-validation.init.js') }}"></script>
    <script>
        var t = $("#datatable-buttons").DataTable({
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('users.deleted.data') }}',
            columns: [

                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'deleted_by'},
                {data: 'deleted_at'},
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
            buttons: [
                'copy','print','csv','pdf'
            ]
        });
        t.on('order.dt search.dt', function () {
            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        //
        // function createManageBtn() {
        //     return '<button  type="button"  class="btn btn-success btn-xs delete">Manage</button>';
        // }
        // function myFunc() {
        //     console.log("Button was clicked!!!");
        // }
    </script>
@endsection
