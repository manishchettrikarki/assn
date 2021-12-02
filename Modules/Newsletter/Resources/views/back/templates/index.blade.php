@extends('back.partials.layout')
@section('title','Email Templates')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Email Templates</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Newsletter</a></li>
                                    <li class="breadcrumb-item active">Templates</li>
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
                                <h4 class="header-title">Create Template</h4>
                                <div class="row">

                                </div>

                                <form action="{{ route('newsletter.templates.create') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" value="{{ old('name') }}" name="name"
                                               id="name" class="form-control">
                                        @error('name')
                                        <code>{{ $message }}</code>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control" value="{{ old('subject') }}"
                                               id="subject" name="subject">
                                        @error('subject')
                                        <code>{{ $message }}</code>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <textarea name="template" id="template"
                                                  cols="30" rows="10">{{ old('template') }}</textarea>
                                        @error('template')
                                        <code>{{ $message }}</code>
                                        @enderror
                                    </div>


                                    <div class="form-group mt-3">
                                        <input type="submit" value="Submit" class="btn btn-lg btn-success">
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Email Templates</h4>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Created by</th>
                                        <th>Last updated by</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($templates as $template)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $template->name }}</td>
                                                <td>{{ $template->subject }}</td>
                                                <td>{{ (!is_null($template->created_by))?$template->createdBy->name:'-' }}</td>
                                                <td>{!! (!is_null($template->updated_by))?
                                                $template->lastUpdatedBy->name.' at <br> '.
                                                $template->updated_at->toDateTimeString():'-' !!}</td>
                                                <td>
                                                    @can('update email template')
                                                        <a href="{{ route('newsletter.templates.show',$template->slug) }}"
                                                           class="btn btn-sm btn-secondary" target="_blank">View</a>
                                                        <a href="{{ route('newsletter.templates.edit',$template->slug) }}"
                                                           class="btn btn-sm btn-primary">Update</a>
                                                    @endcan
                                                    @can('delete email templates')
                                                            <a href="{{ route('newsletter.templates.delete',$template->slug) }}"
                                                               class="btn btn-sm btn-danger">Delete</a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td class="text-danger text-center" colspan="6">No records found</td>
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
@section('script')
    <script>
        $(document).ready(function () {
            0 < $("#template").length &&
            tinymce.init({
                selector: "textarea#template",
                height: 300,
                plugins: [
                    'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks ' +
                    'visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking ' +
                    'anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap ' +
                    'quickbars emoticons',
                ],
                toolbar:'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | ' +
                    'alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | ' +
                    'forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | ' +
                    'insertfile image media template link anchor codesample | ltr rtl',
                toolbar_sticky: true,
                convert_urls: false,
                remove_script_host: false,
                file_picker_callback (callback, value, meta) {
                    let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                    let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight

                    tinymce.activeEditor.windowManager.openUrl({
                        url : '/file-manager/tinymce5',
                        title : 'Library',
                        width : x * 0.8,
                        height : y * 0.8,
                        onMessage: (api, message) => {
                            callback(message.content, { text: message.text })
                        }
                    })
                },
                style_formats: [
                    { title: "Bold text", inline: "b" },
                    { title: "Red text", inline: "span", styles: { color: "#ff0000" } },
                    { title: "Red header", block: "h1", styles: { color: "#ff0000" } },
                    { title: "Example 1", inline: "span", classes: "example1" },
                    { title: "Example 2", inline: "span", classes: "example2" },
                    { title: "Table styles" },
                    { title: "Table row 1", selector: "tr", classes: "tablerow1" },
                ],
                templates: [
                    { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
                ],
                template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                height: 600,
                image_caption: true,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                noneditable_noneditable_class: "mceNonEditable",
                toolbar_mode: 'sliding',
                contextmenu: "link image imagetools table",
            });
        });
    </script>
@endsection
