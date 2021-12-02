@extends('back.partials.layout')
@section('title','Provincial Representative')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18 pull-left">Provincial Representative</h4>


                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ site('name') }}</a></li>
                                    <li class="breadcrumb-item active">Provincial Representative</li>
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
                                        <h4 class="header-title pull-left">Provincial Representative</h4>
                                    </div>
                                    @can('add provincial representative')
                                        <div class="col-6 d-flex justify-content-end">
                                            <a href="{{ route('provincial.representative.create') }}" class="btn btn-sm btn-success float-right">Add new</a>
                                        </div>
                                    @endcan
                                </div>


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
                                        <th>Image</th>
                                        <th>Designation</th>
                                        <th class="datatable-nosort">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($provincials as $provincial)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $provincial->name }}</td>
                                        <td>{{ $provincial->email }}</td>
                                        <td>
                                            <img src="{{ $provincial->image }}" alt="" width="80" class="img  img-thumbnail">
                                        </td>
                                        <td>{{ $provincial->designation }}</td>
                                        <td>
                                            <a class="btn btn-primary my-3" href="{{route('provincial.representative.edit',$provincial->id)}}">Update</a>
                                            <a class="btn btn-danger my-3" href="{{route('provincial.representative.delete',$provincial->id)}}">Delete</a>
                                        </td>
                                    </tr>
                                        @endforeach

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
