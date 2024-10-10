@extends('layouts/contentNavbarLayout')

@section('title', __('Email'))

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
    <span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ __('Email') }}
</h4>

<!-- Map and Accordion -->
<div class="row">

  {{-- Group List --}}
  <div class="col-md-4">
      <div class="list-group">
          <button class="list-group-item list-group-item-action">{{ __('Inbox') }}</button>
          <button class="list-group-item list-group-item-action">{{ __('Spam') }}</button>
          <button class="list-group-item list-group-item-action">{{ __('Archived') }}</button>
          <button class="list-group-item list-group-item-action">{{ __('New') }}</button>
          <button class="list-group-item list-group-item-action">{{ __('Trashed') }}</button>
      </div>
  </div>


    <div class="col-md-8">


        <div class="card">
        <!-- Card Header: Check All, Delete All, Mark All as Read -->
        <div class="card-header d-flex align-items-center">

            <input type="checkbox" id="check-all" class="form-check-input me-2">
            <button id="deleteSelected" class="btn btn-icon btn-outline-danger me-2">
                <i class="mdi mdi-trash-can-outline"></i>
            </button>
            <button id="markAllRead" class="btn btn-icon btn-outline-secondary">
                <i class="mdi mdi-email-open-outline"></i>
            </button>
        </div>

        <!-- Card Body: List of Letters -->
        <div class="card-body">
            <ul class="list-group" id="emailList">
                <!-- Email Item 1 -->
                <li class="list-group-item d-flex justify-content-between email-item" data-id="1">

                    <div class="d-flex align-items-center">
                        <input type="checkbox" class="form-check-input check-item me-2"><img src="avatar1.jpg" alt="Avatar" class="rounded-circle me-2" width="40" height="40">
                        <div>
                            <strong class="text-success">John Doe</strong>
                            <span class="text-muted"></span>
                            <div class="text-muted">Important meeting update</div>

                        </div>
                    </div>
                <div class="text-muted d-flex align-items-center">2024-10-01</div></li>

                <!-- Email Item 2 -->
                <li class="list-group-item d-flex justify-content-between email-item" data-id="1">

                    <div class="d-flex align-items-center">
                        <input type="checkbox" class="form-check-input check-item me-2"><img src="avatar1.jpg" alt="Avatar" class="rounded-circle me-2" width="40" height="40">
                        <div>
                            <strong class="text-success">John Doe</strong>
                            <span class="text-muted"></span>
                            <div class="text-muted">Important meeting update</div>

                        </div>
                    </div>
                <div class="text-muted d-flex align-items-center">2024-10-01</div></li>

                <!-- Add more email items as needed -->
            </ul>
        </div>
    </div>
  </div>
</div>


</div>
<script>

$(document).ready(function() {
  // Check/uncheck all checkboxes
  $('#check-all').on('click', function() {
      $('.check-item').prop('checked', this.checked);
  });

  // Delete selected emails
  $('#deleteSelected').on('click', function() {
      $('.check-item:checked').each(function() {
          $(this).closest('.email-item').remove(); // Remove email item
      });
  });

  // Mark all as read (You can add more functionality here)
  $('#markAllRead').on('click', function() {
      $('.check-item').each(function() {
          // Example action: just change class for demonstration
          $(this).closest('.email-item').find('strong').removeClass('text-danger').addClass('text-success');
      });
  });
});

// Function to toggle email content
function toggleEmail(element) {
  const emailContent = $(element).find('.email-content');
  emailContent.toggle(); // Show/hide the email content
}
</script>
@endsection
