@extends('layouts/contentNavbarLayout')

@section('title', __('Create New Blog'))

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}"><span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ __('Create New Blog') }}
</h4>

<div class="row">
  <div class="card mb-4 pb-4">
    <div class="card-header p-0">
      <div class="nav-align-top">
        <ul class="nav nav-tabs nav-fill" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true"><i class="tf-icons mdi mdi-file-outline me-1"></i><span class="d-none d-sm-block">{{ __('Content') }}</span></button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false"><i class="tf-icons mdi mdi-image-multiple-outline me-1"></i><span class="d-none d-sm-block">{{ __('Photos') }}</span></button>
          </li>
        </ul>
      </div>
    </div>
    <form id="contentForm" method="POST" action="{{ route('blog.create') }}" enctype="multipart/form-data">
      <div class="card-body">
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
            @csrf
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="{{asset('assets/img/illustrations/In-sync-rafiki.png')}}" alt="user-avatar" class="d-block rounded" id="uploadedAvatar" style="max-width: 340px!important;height: 180px!important"/>
                <div class="button-wrapper">
                  <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                    <span class="d-none d-sm-block">{{ __('Upload Photo') }}</span>
                    <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                    <input type="file" id="upload" class="account-file-input" name="first_image" hidden accept="image/png,image/jpeg,image/jpg" />
                  </label>
                  <button type="button" class="btn btn-outline-danger account-image-reset mb-3">
                    <i class="mdi mdi-reload d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">{{ __('Reset') }}</span>
                  </button>
                  <div class="text-muted small">{{ __('Allowed JPG, GIF or PNG. Max size of 800K') }}</div>
                </div>
              </div>
            </div>

            <div class="row d-flex">
            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="address" name="title" placeholder="{{ __('Title') }}" />
                <label for="address">{{ __('Title') }}</label>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <select id="subcategory" name="subcategory" class="form-select">
                  @foreach ($subcategorys as $subcategory)
                  <option value="{{ $subcategory->id }}">
                    {{ $subcategory->getName() }}
                  </option>
                  @endforeach
                </select>
                <label for="subcategory">{{ __('SubCategory') }}</label>
              </div>
            </div>
            <div class="col-md-12 mb-3">
                <textarea name="content" id="content">
                </textarea>
            </div>
            <div class="col-md-6 mb-3">
              <div class="input-group">
                <span class="input-group-text">{{ __('Tags') }}</span>
                <textarea class="form-control" id="tags" name="tags" aria-label="With textarea"></textarea>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <select id="status" name="status" class="form-select">
                  <option value="draft" selected>{{ __('Draft') }}</option>
                  <option value="published" >{{ __("Published") }}</option>
                </select>
                <label for="status">{{ __('Status') }}</label>
              </div>
            </div>
          </div>
          </div>
          <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
            <div id="dropzone" class="dropzone"></div>
          </div>
          <button type="submit" class="btn btn-primary float-end" >{{ __('Submit') }}</button>
        </div>
      </div>
    </form>
  </div>
</div>



<style>
.dropzone {
  width: 100%;
  height: 100%;
  background-color: #f7f7f7;
  border: 4px dashed #ccc;
  border-radius: 1em;
  margin-bottom: 3rem;
}

</style>

<script type="text/javascript">
    var blogId = null;
    var lang = "{{ app()->getLocale() }}";

    var tags = document.querySelector('textarea[name=tags]'),
    tagstagify = new Tagify(tags, {
        enforceWhitelist : false,
    })

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#dropzone", {
        url: "{{ route('blog.upload') }}",
        autoProcessQueue: false,
        acceptedFiles: 'image/*',
        maxFilesize: 150,
        addRemoveLinks: true,
        parallelUploads: 15,
        dictDefaultMessage: __("Drag and drop files here or click to upload",lang),
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        params: {
            blog_id: blogId
        },
        init: function() {
        this.on("complete", function(file) {
            // Redirect to the blogs URL after all files have been uploaded
            window.location.href = "{{ route('blogs') }}";
        });
    }

    });

    myDropzone.on("success", function(file, response) {
        console.log('File uploaded successfully:', file.name);
    });

    myDropzone.on("error", function(file, errorMessage) {
        console.error('Error uploading file:', errorMessage);
    });

    function uploadFiles(blogId) {
        var myDropzone = Dropzone.forElement("#dropzone");

        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("blog_id", blogId);
        });

        myDropzone.processQueue();
    }




$(document).ready(function() {

  tinymce.init({
    selector: 'textarea[name="content"]',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker markdown',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat | Save',
    setup: function (editor) {
      editor.ui.registry.addButton('save', {
        text: 'Save',
        onAction: function () {
          $('textarea[name="content"]').val(editor.getContent());
          $('#contentForm').submit();
        }
      });
    }
  });

  $('#contentForm').submit(function(event) {
    event.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: formData,
        dataType: "json",
        contentType: false, // Don't set content type (let browser handle it)
        processData: false, // Don't process data (let browser handle it)
        success: function(response) {
            Swal.fire({
                icon: response.icon,
                title: response.state,
                text: response.message,
                confirmButtonText: __("Ok",lang)
              }).then((result) => {
                  if (result.isConfirmed) {
                      blogId = response.id;
                      uploadFiles(blogId);
                  }
              });
        },
        error: function(xhr, textStatus, errorThrown) {
            const response = JSON.parse(xhr.responseText);
            Swal.fire({
                icon: response.icon,
                title: response.state,
                text: response.message,
                confirmButtonText: __("Ok",lang)
            });
        }
    });
  });

  });

</script>

@endsection
