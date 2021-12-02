@extends('back.partials.layout')
@section('title','Create Event')
@section('content')
  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Create Event</h4>

              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a
                      href="javascript: void(0);">{{ site('name') }}</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Event</a></li>
                  <li class="breadcrumb-item active">Create</li>
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
                <h4 class="header-title">Create Event</h4>
                <div class="row">

                </div>

                <form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
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
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" value="{{ old('location') }}"
                               id="location" name="location">
                        @error('location')
                        <code>{{ $message }}</code>
                        @enderror
                      </div>
                    </div>
                  </div>



                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="text" class="form-control datepicker" value="{{ old('startDate') }}"
                               id="startDate" name="startDate">
                        @error('startDate')
                        <code>{{ $message }}</code>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="text" class="form-control datepicker" value="{{ old('endDate') }}"
                               id="endDate" name="endDate">
                        @error('endDate')
                        <code>{{ $message }}</code>
                        @enderror
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="image_label">Image</label>
                            <div class="input-group">

                                <input type="text" id="image_label" value="{{ old('coverImage') }}" class="form-control" name="coverImage"
                                       aria-label="Image" aria-describedby="button-image">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
                                </div>
                            </div>
                            @error('image')
                            <code>{{ $message }}</code>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="startTime" class="form-label">Start Time</label>
                        <input type="text" class="form-control" value="{{ old('startTime') }}"
                               id="startTime" name="startTime">
                        @error('startTime')
                        <code>{{ $message }}</code>
                        @enderror
                      </div>
                    </div>
                  </div>




                  <div class="form-group">
                    <label for="description">Description</label>
                                        <textarea name="description" class="tinymce" id="description" cols="30" rows="10">
                                                 {{ old('description') }}
                                        </textarea>
                    @error('description') {{ $message }} @enderror
                  </div>

                    <div class="form-group">
                        <label for="schedule">Schedule</label>
                        <textarea name="schedule" class="tinymce" id="schedule" cols="30" rows="10">
                                                 {{ old('schedule') }}
                                        </textarea>
                        @error('schedule') {{ $message }} @enderror
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
          0 < $(".tinymce").length &&
          tinymce.init({
              selector: "textarea.tinymce",
              height: 100,
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

      document.addEventListener("DOMContentLoaded", function() {

          document.getElementById('button-image').addEventListener('click', (event) => {
              event.preventDefault();

              window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
          });
      });

      // set file link
      function fmSetLink($url) {
          document.getElementById('image_label').value = $url;
      }






  </script>
@endsection
