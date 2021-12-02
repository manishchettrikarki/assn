@extends('back.partials.layout')
@section('title','Pages')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Pages</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                    <li class="breadcrumb-item active">Pages</li>
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
                                <h4 class="header-title">Pages</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-title-desc">

                                        </p>
                                    </div>
                                    @can('create pages')
                                    <div class="col-6 d-flex justify-content-end">
                                        <a href="{{ route('cms.pages.create') }}" class="btn btn-success waves-effect waves-light float-right"><i class="mdi mdi-plus"></i> Add new</a>
                                    </div>
                                        @endcan
                                </div>

                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap mt-3" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Created By</th>
                                        <th>Last Updated By</th>
                                        <th>Menu</th>
                                        <th class="datatable-nosort">Status</th>
                                        <th class="datatable-nosort">Actions</th>
                                    </tr>
                                    </thead>


                                    <tbody>

                                    @forelse($pages as $page)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $page->title }}</td>
                                            <td>{{ (isset($page->created_by))?$page->createdBy->name:'Unavailable' }}</td>
                                            <td>{{ (isset($page->updated_by))?$page->lastUpdatedBy->name:'Unavailable' }}</td>
                                            <td>{{ ($page->nav)?'Created':'Not Created' }}</td>
                                            <td>{{ ($page->publish)?'Published':'Drafted' }}</td>
                                            <td class="d-flex justify-content-around">
                                               @can('update pages')
                                                    <a href="{{ route('cms.pages.edit',$page->slug) }}"
                                                       class="btn btn-sm btn-primary">Update</a>
                                                @endcan
                                                   @can('delete pages')
                                                       <a href="{{ route('cms.pages.delete',$page->slug) }}"
                                                          class="btn btn-sm btn-danger">Delete</a>
                                                   @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-danger" colspan="7">No records found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
