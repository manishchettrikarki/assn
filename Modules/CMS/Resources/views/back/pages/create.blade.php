@extends('back.partials.layout')
@section('title','Create Page')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Create Page</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">CMS</a></li>
                                    <li class="breadcrumb-item active">Create Page</li>
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
                                <h4 class="header-title">Create Page</h4>
                                <div class="row">

                                </div>

                                <form action="{{ route('cms.pages.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" value="{{ old('title') }}" name="title"
                                                       id="title" class="form-control">
                                                @error('title')
                                                <code>{{ $message }}</code>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="metaTitle" class="form-label">Meta Title</label>
                                                <input type="text" class="form-control" value="{{ old('metaTitle') }}"
                                                       id="metaTitle" name="metaTitle">
                                                @error('metaTitle')
                                                <code>{{ $message }}</code>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="metaDescription" class="form-label">Meta Description</label>
                                                <input type="text" class="form-control" value="{{ old('metaDescription') }}"
                                                       id="metaDescription" name="metaDescription">
                                                @error('metaDescription')
                                                <code>{{ $message }}</code>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="tags" class="form-label">Tags</label>
                                                <input type="text" class="form-control" value="{{ old('tags') }}"
                                                       id="tags" name="tags">
                                                @error('tags')
                                                <code>{{ $message }}</code>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <textarea name="description" id="description" cols="30" rows="10">
                                                 {{ old('description') }}
                                        </textarea>
                                        @error('description') {{ $message }} @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="menu">Create Menu</label>
                                                <input type="checkbox"
                                                id="menu" name="menu"
                                                       class="js-switch form-control">
                                                @error('menu')
                                                <code>{{ $message }}</code>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="publish">Publish</label>
                                                <input type="checkbox"
                                                id="publish" name="publish"
                                                       class="js-switch form-control">
                                                @error('publish')
                                                <code>{{ $message }}</code>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <code>Menu won't be created unless published</code>
                                        </div>


                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12" id="menuForm" style="display: none">
                                        <div class="form-group">
                                            <label for="menuName" class="form-label">Menu Name</label>
                                            <input type="text" class="form-control" value="{{ old('menuName') }}"
                                                   id="menuName" name="menuName">
                                            @error('menuName')
                                            <code>{{ $message }}</code>
                                            @enderror
                                        </div>
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
            0 < $("#description").length &&
            tinymce.init({
                selector: "textarea#description",
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

        var menu = document.querySelector('#menu');
        var menuSwitch = new Switchery(menu);

        var publish = document.querySelector('#publish');
        var publishSwitch = new Switchery(publish);



      $('span#menu').on('click',function(){
          if(menu.checked){
            $('#menuForm').show();
          } else {
              $('#menuForm').hide();
          }
      });


    </script>
@endsection
