@extends('back.partials.layout')
@section('title', 'Create Newsletter' )
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Newsletter</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Newsletter</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Send</a></li>
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
                                <h4 class="header-title">Send Newsletter</h4>

                                <form action="{{ route('newsletter.send') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        @if($templates->count() > 0)
                                        <label for="template">Select Template</label>
                                        <select name="template" id="template" class="form-control">
                                            <option value="" selected hidden>...</option>
                                            @foreach($templates as $template)
                                                <option value="{{ $template->slug }}">{{ $template->name }}</option>
                                            @endforeach
                                        </select>
                                        @else
                                            No templates found. You can create <a href="{{ route('newsletter.templates') }}">here</a>
                                            @endif
                                        @error('template')
                                        <code>{{ $message }}</code>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control"
                                               value="{{ old('subject') }}"
                                               id="subject" name="subject">
                                        @error('subject')
                                        <code>{{ $message }}</code>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient" class="form-label">Recipient</label>
                                        <select name="recipient" id="recipient" class="form-control">
                                            <option value="me">Me</option>
                                            <option value="all">Everyone</option>
                                            <option value="subscribers">Subscribers</option>
                                            <option value="verified-users">Verified Users</option>
                                            <option value="all-users">All Users</option>
                                        </select>
                                        @error('recipient')
                                        <code>{{ $message }}</code>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <textarea name="letter" id="letter"
                                                  cols="30" rows="10">{{ old('letter') }}</textarea>
                                        @error('letter')
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




            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            0 < $("#letter").length &&
            tinymce.init({
                selector: "textarea#letter",
                height: 500,
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
                // relative_urls: false,
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
                image_caption: true,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                noneditable_noneditable_class: "mceNonEditable",
                toolbar_mode: 'sliding',
                contextmenu: "link image imagetools table",
            });

            $('#template').on('change',function(){
                let template = $(this).val();
                $.ajax({
                    method: 'get',
                    url: '{{ route('newsletter.template.get') }}',
                    data: {template:template},
                    beforeSend:function(){
                        tinymce.get('letter').setContent('');
                    },
                    success: function(response){
                      tinymce.get('letter').execCommand('mceInsertContent',false,response.content);
                      $('#subject').val(response.subject);
                    },
                    error: function(response){
                        $('#letter').html(response.message);
                    }
                })
            })
        });


    </script>
@endsection
