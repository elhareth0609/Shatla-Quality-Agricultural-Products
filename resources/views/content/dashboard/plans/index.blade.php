@extends('layouts/contentNavbarLayout')

@section('title', __('Edit Plan'))

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">{{ __('Settings') }} /</span> {{ __('Account') }}
</h4>


@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-4 gap-2 gap-lg-0">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="mdi mdi-account-outline mdi-20px me-1"></i>{{ __('Account') }}</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('plan.permissions',$plan->id)}}"><i class="mdi mdi-security mdi-20px me-1"></i>{{ __('Permissions') }}</a></li>
      {{-- <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i class="mdi mdi-link mdi-20px me-1"></i>{{ __('Connections') }}</a></li> --}}
    </ul>
    <form class="card mb-4" id="updateForm" method="POST" action="{{ route('plan.update') }}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="pid" value="{{ $plan->id }}" />
      <h4 class="card-header">{{ __('Profile Details') }}</h4>
      <!-- Account -->
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="{{ $plan->photoUrl() }}" alt="{{ $plan->photoUrl() }}" class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
              <span class="d-none d-sm-block">{{ __('Change Avatar') }}</span>
              <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
              <input type="file" id="upload" class="account-file-input" name="image" hidden accept="image/png, image/jpeg, image/jpg" />
            </label>

            <div class="text-muted small">{{ __('You Can Choose Any Avatar You Want') }}</div>
          </div>
        </div>
      </div>
      <div class="card-body pt-2 mt-1">
          <div class="row mt-2 gy-4">
            <div class="col-md-6">
              <div class="form-floating form-floating-outline">
                <input class="form-control" type="text" id="name" name="name" value="{{ $plan->name }}" autofocus />
                <label for="name">{{ __('Name') }}</label>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-floating form-floating-outline">
                <select id="status" name="status" class="form-select">
                @if ($plan->status == 1)
                  <option value="1" selected>{{ __("Active") }}</option>
                  <option value="0">{{ __('In Active') }}</option>
                @elseif ($plan->status == 0)
                  <option value="0" selected>{{ __('In Active') }}</option>
                  <option value="1">{{ __("Active") }}</option>
                @endif
                </select>
                <label for="status">{{ __('Status') }}</label>
              </div>
            </div>

            <label for="defaultInput" class="form-label d-flex {{ app()->getLocale() == 'ar' ? 'justify-content-end' : '' }}">{{ __('Description') }}</label>
            <div class="col-md-12 mb-3">
                <textarea name="text" id="text">{{ $plan->text }}</textarea>
            </div>

              <div class="col-md-6 mb-3">
                <div class="form-floating form-floating-outline">
                  <input type="number" class="form-control" id="price" name="price" placeholder="{{ __('Price') }}" value="{{ $plan->price }}" min="0" step="0.01" required />
                  <label for="price">{{ __('Price') }}</label>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-floating form-floating-outline">
                  <input type="number" class="form-control" id="last_price" name="last_price" placeholder="{{ __('Last Price') }}" value="{{ $plan->last_price }}"  min="0" step="0.01" />
                  <label for="last_price">{{ __('Last Price') }}</label>
                </div>
              </div>


          </div>
          <div class="mt-4">
            <button type="submit" class="btn btn-primary me-2">{{ __('Save Changes') }}</button>
          </div>
      </div>
      <!-- /Account -->
    </form>
    {{-- <div class="card">
      <h5 class="card-header fw-normal">{{ __('Change Password') }}</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h6 class="alert-heading mb-1">{{ __('Are you sure you want to change your password?') }}</h6>
          </div>
        </div>
        <form id="passwordForm" method="POST" action="{{ route('password.change') }}">
          @csrf
          <div class="col-md-6 mb-3">
            <div class="form-floating form-floating-outline">
              <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="###########" />
              <label for="newPassword">{{ __('New Password') }}</label>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="form-floating form-floating-outline">
              <input class="form-control" type="password" id="confirmPassword" name="confirmPassword" placeholder="###########" />
              <label for="confirmPassword">{{ __('Confirm Password') }}</label>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="form-floating form-floating-outline">
              <input class="form-control" type="password" id="currentPassword" name="currentPassword" placeholder="###########" />
              <label for="currentPassword">{{ __('Current Password') }}</label>
            </div>
          </div>
          <button type="submit" class="btn btn-danger">{{ __('Change Password') }}</button>
        </form>

      </div>
    </div> --}}
  </div>
</div>

<script>
  var lang = "{{ app()->getLocale() }}";
  $(document).ready(function() {

    tinymce.init({
      selector: 'textarea[name="text"]',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker markdown',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat | Save',
      setup: function (editor) {
        editor.ui.registry.addButton('save', {
          text: 'Save',
          onAction: function () {
            $('textarea[name="text"]').val(editor.getContent());
            $('#contentForm').submit();
          }
        });
      }
    });


    $('#updateForm').submit(function(event) {

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
    $('#passwordForm').submit(function(event) {
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
  });
</script>
@endsection
