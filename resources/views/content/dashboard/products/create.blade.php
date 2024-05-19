@extends('layouts/contentNavbarLayout')

@section('title', __('Create New Product'))

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}"><span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ __('Create New Product') }}
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
    <form id="contentForm" method="POST" action="{{ route('product.create') }}" enctype="multipart/form-data">
      <div class="card-body">
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
            @csrf
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="{{asset('assets/img/photos/products/default.png')}}" alt="user-avatar" class="d-block rounded" id="uploadedAvatar" style="width: 170px!important;height: 180px!important"/>
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
                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Name') }}" />
                <label for="address">{{ __('Name') }}</label>
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
            <label for="defaultInput" class="form-label d-flex {{ app()->getLocale() == 'ar' ? 'justify-content-end' : '' }}">{{ __('Description') }}</label>
            <div class="col-md-12 mb-3">
                <textarea name="description" id="description">
                </textarea>
            </div>
            <label for="defaultInput" class="form-label d-flex {{ app()->getLocale() == 'ar' ? 'justify-content-end' : '' }}">{{ __('Content') }}</label>
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
                  <option value="active" selected>{{ __('Active') }}</option>
                  <option value="inactive" >{{ __("In Active") }}</option>
                </select>
                <label for="status">{{ __('Status') }}</label>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" id="price" name="price" placeholder="{{ __('Price') }}" min="0" step="0.01" required />
                <label for="price">{{ __('Price') }}</label>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" id="last_price" name="last_price" placeholder="{{ __('Last Price') }}" min="0" step="0.01" />
                <label for="last_price">{{ __('Last Price') }}</label>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" id="amount_price" name="amount_price" placeholder="{{ __('Amount Price') }}" min="0" step="0.01" />
                <label for="amount_price">{{ __('Amount Price') }}</label>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" id="percentage" name="percentage" placeholder="{{ __('Percentage') }}" min="0" max="100" step="0.01" />
                <label for="percentage">{{ __('Percentage') }}</label>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="{{ __('Quantity') }}" min="0" step="1" />
                <label for="quantity">{{ __('Quantity') }}</label>
              </div>
            </div>

          </div>
          </div>
          <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
            <label for="defaultInput" class="form-label d-flex {{ app()->getLocale() == 'ar' ? 'justify-content-end' : '' }}">{{ __('Images For Product') }}</label>
            <div id="dropzone1" class="dropzone"></div>
            <label for="defaultInput" class="form-label d-flex {{ app()->getLocale() == 'ar' ? 'justify-content-end' : '' }}">{{ __('Images For Content') }}</label>
            <div id="dropzone2" class="dropzone"></div>
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
    var productId = null;
    var lang = "{{ app()->getLocale() }}";

    var tags = document.querySelector('textarea[name=tags]'),
    tagstagify = new Tagify(tags, {
        enforceWhitelist : false,
    })

    Dropzone.autoDiscover = false;

    // Initialize first Dropzone
    var dropzone1 = new Dropzone("#dropzone1", {
        url: "{{ route('product.upload') }}",
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
            product_id: productId,
            typeof: '0'
        },
        init: function() {
            this.on("complete", function(file) {
                // Optionally handle completion of individual files
            });
        }
    });

    dropzone1.on("success", function(file, response) {
        console.log('File uploaded successfully:', file.name);
    });

    dropzone1.on("error", function(file, errorMessage) {
        console.error('Error uploading file:', errorMessage);
    });

    // Initialize second Dropzone
    var dropzone2 = new Dropzone("#dropzone2", {
        url: "{{ route('product.upload') }}",
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
            product_id: productId,
            typeof: '0'
        },
        init: function() {
            this.on("complete", function(file) {
                // Optionally handle completion of individual files
            });
        }
    });

    dropzone2.on("success", function(file, response) {
        console.log('File uploaded successfully:', file.name);
    });

    dropzone2.on("error", function(file, errorMessage) {
        console.error('Error uploading file:', errorMessage);
    });

    // Function to process file uploads for both Dropzones
    function uploadFiles() {
        var dropzone1Instance = Dropzone.forElement("#dropzone1");
        var dropzone2Instance = Dropzone.forElement("#dropzone2");

        // Attach additional form data before sending files
        dropzone1Instance.on("sending", function(file, xhr, formData) {
            formData.append("product_id", productId);
            formData.append("typeof", '0');
        });

        dropzone2Instance.on("sending", function(file, xhr, formData) {
            formData.append("product_id", productId);
            formData.append("typeof", '1');
        });

        // Process file queues
        dropzone1Instance.processQueue();
        dropzone2Instance.processQueue();
    }

    // Ensure both Dropzones complete before redirecting (if needed)
    dropzone1.on("queuecomplete", function() {
        if (dropzone2.getQueuedFiles().length === 0 && dropzone2.getUploadingFiles().length === 0) {
            // window.location.href = "{{ route('products') }}";
        }
    });

    dropzone2.on("queuecomplete", function() {
        if (dropzone1.getQueuedFiles().length === 0 && dropzone1.getUploadingFiles().length === 0) {
            // window.location.href = "{{ route('products') }}";
        }
    });


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

  tinymce.init({
    selector: 'textarea[name="description"]',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker markdown',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat | Save',
    setup: function (editor) {
      editor.ui.registry.addButton('save', {
        text: 'Save',
        onAction: function () {
          $('textarea[name="description"]').val(editor.getContent());
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
                      productId = response.id;
                      uploadFiles(productId);
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
