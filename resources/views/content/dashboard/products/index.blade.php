@extends('layouts/contentNavbarLayout')

@section('title', __('Create New Product'))

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}"><span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ $product->title }}
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
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-comments" aria-controls="navs-justified-comments" aria-selected="false"><i class="tf-icons mdi mdi-comment-outline me-1"></i><span class="d-none d-sm-block">{{ __('Comments') }}</span></button>
          </li>
        </ul>
      </div>
    </div>
    <form id="contentForm" method="POST" action="{{ route('product.update') }}" enctype="multipart/form-data">
      <div class="card-body">
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
            @csrf
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="{{ $product->photoUrl() }}" alt="user-avatar" class="d-block rounded" id="uploadedAvatar" style="width: 340px!important;height: 180px!important"/>
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
            <input type="hidden" name="id" value="{{ $product->id }}" />
            <div class="row d-flex">

              <div class="col-md-6 mb-3">
                <div class="form-floating form-floating-outline">
                  <input type="text" class="form-control" id="address" name="title" placeholder="{{ __('Title') }}" value="{{ $product->title }}" />
                  <label for="address">{{ __('Title') }}</label>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <div class="form-floating form-floating-outline">
                  <select id="subcategory" name="subcategory" class="form-select">
                    @foreach ($subcategorys as $subcategory)
                      @if ($subcategory->id === $product->subcategory->id)
                        <option value="{{ $subcategory->id }}" selected>{{ $subcategory->getName() }}</option>
                      @else
                        <option value="{{ $subcategory->id }}">{{ $subcategory->getName() }}</option>
                      @endif
                    @endforeach
                  </select>
                  <label for="subcategory">{{ __('SubCategory') }}</label>
                </div>
              </div>

              <div class="col-md-12 mb-3">
                  <textarea name="content" id="content">{{ $product->content }}</textarea>
              </div>

              <div class="col-md-6 mb-3">
                <div class="input-group">
                  <span class="input-group-text">{{ __('Tags') }}</span>
                  <textarea class="form-control" id="tags" name="tags" aria-label="With textarea">{{ is_array($product->tags) ? implode(', ', $product->tags) : htmlspecialchars($product->tags) }}</textarea>
                </textarea>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <div class="form-floating form-floating-outline">
                  <select id="status" name="status" class="form-select">
                  @if ($product->status == 'published')
                    <option value="published" selected>{{ __("Published") }}</option>
                    <option value="draft">{{ __('Draft') }}</option>
                  @elseif ($product->status == 'draft')
                    <option value="draft" selected>{{ __('Draft') }}</option>
                    <option value="published">{{ __("Published") }}</option>
                  @endif
                  </select>
                  <label for="status">{{ __('Status') }}</label>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
            <div id="dropzone" class="dropzone"></div>
            <div class="photos-container">
              @foreach ($product->photos as $photo)
                <div class="image-container text-center my-w-fit-content mb-2 mx-auto position-relative">
                    <div class="image-overlay rounded h-100 w-100 d-flex justify-content-center align-items-center position-absolute top-0 start-0 opacity-0 transition-opacity">
                        <button type="button" class="btn btn-icon btn-primary m-2 overlay-content trash-button" data-photo-id="{{ $photo->id }}"><span class="tf-icons mdi mdi-trash-can-outline"></span></button>
                        <button type="button" class="btn btn-icon btn-primary m-2 overlay-content copy-button" data-photo-url="{{ $photo->photoUrl() }}"><span class="tf-icons mdi mdi-content-copy"></span></button>
                    </div>
                    <img src="{{ $photo->photoUrl() }}" alt="{{ $photo->id }}" class="rounded product-photo" />
                </div>
              @endforeach
            </div>
          </div>
          <div class="tab-pane fade" id="navs-justified-comments" role="tabpanel">


          </div>
          <button type="submit" class="btn btn-primary float-end" >{{ __('Submit') }}</button>
        </div>
      </div>
    </form>
  </div>
</div>



<style>
.dropzone {
  background-color: #f7f7f7;
  border: 4px dashed #ccc;
  border-radius: 1em;
  margin-bottom: 3rem;
}

.image-overlay {
    background-color: rgba(0, 0, 0, 0.5);
    transition: opacity 0.3s ease;
}

.image-container:hover .image-overlay {
    opacity: 1!important;
}

.product-photo {
width: 720px;
}

</style>

<script type="text/javascript">
    var productId = {{ $product->id }};
    var lang = "{{ app()->getLocale() }}";


    var tags = document.querySelector('textarea[name=tags]'),
    tagstagify = new Tagify(tags, {
        enforceWhitelist : false,
    })

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#dropzone", {
        url: "{{ route('product.upload') }}",
        autoProcessQueue: true,
        acceptedFiles: 'image/*',
        maxFilesize: 150,
        addRemoveLinks: true,
        parallelUploads: 15,
        dictDefaultMessage: __("Drag and drop files here or click to upload",lang),
        sending: function(file, xhr, formData) {
            formData.append('product_id', productId);
            formData.append('_token', csrfToken);
        }

    });

    myDropzone.on("success", function(file, response) {

    });

    myDropzone.on("error", function(file, errorMessage) {
        console.error('Error uploading file:', errorMessage);
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

  $('#contentForm').submit(function(event) {
    event.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function(response) {
            Swal.fire({
                icon: response.icon,
                title: response.state,
                text: response.message,
                confirmButtonText: __("Ok",lang)
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

  var clipboard = new ClipboardJS('.copy-button', {
      text: function(trigger) {
          return trigger.getAttribute('data-photo-url');
      }
  });

  clipboard.on('success', function(e) {
    var successMessage = __("Successfully copied the URL!",lang);
    var copyLabel = __("Copy",lang);
    var justNowLabel = __("Just Now",lang);

    var successToast = `
        <div class="bs-toast toast toast-placement-ex m-2 fade bottom-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
            <div class="toast-header">
                <i class="mdi mdi-content-copy text-success me-2"></i>
                <div class="me-auto fw-medium">${copyLabel}</div>
                <small class="text-muted">${justNowLabel}</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ${successMessage}
            </div>
        </div>
    `;

      document.body.insertAdjacentHTML('beforeend', successToast);
  });

  clipboard.on('error', function(e) {
      var errorMessage = e;
      var copyLabel = __("Error",lang);
      var justNowLabel = __("Just Now",lang);

      var errorToast = `
          <div class="bs-toast toast toast-placement-ex m-2 fade bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
              <div class="toast-header">
                  <i class="mdi mdi-alert-outline text-danger me-2"></i>
                  <div class="me-auto fw-medium">${copyLabel}</div>
                  <small class="text-muted">${justNowLabel}</small>
                  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
                  ${errorMessage}
              </div>
          </div>
      `;

      document.body.insertAdjacentHTML('beforeend', errorToast);
  });


  $(document).on('click', '.trash-button', function(event) {
    var id = $(this).data('photo-id');
    var photoContainer = $(this).closest('.image-container');

    Swal.fire({
            title: __("Do you really want to delete this Photo?",lang),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: __("Submit",lang),
            cancelButtonText: __("Cancel",lang),
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/product/unupload/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                      photoContainer.remove();

                        Swal.fire({
                            icon: response.icon,
                            title: response.state,
                            text: response.message,
                            confirmButtonText: __("Ok",lang),
                        });
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        const response = JSON.parse(xhr.responseText);
                        Swal.fire({
                            icon: response.icon,
                            title: response.state,
                            text: response.message,
                            confirmButtonText: __("Ok",lang),
                        });
                    }
                });
            }
        });
  });

  });

</script>

@endsection
