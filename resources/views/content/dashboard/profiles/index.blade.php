@extends('layouts/blankLayout')

@section('title', __('Change Profile'))

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Login -->
      <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
              <img src="{{ asset('assets/home/icons/photo_2024-05-27_04-47-57-removebg-preview.png') }}" width="110" height="50"/>
            </span>
            {{-- <span class="app-brand-text demo text-heading fw-semibold">شتلة</span> --}}
          </a>
        </div>
        <!-- /Logo -->
        <div class="card-body mt-2">
          @foreach (Auth::user()->profiles as $profile)
          <div class="d-flex align-items-center border border-2 rounded p-1 my-1 justify-content-between profile-item" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}" data-profile-id="{{ $profile->id }}">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-lg {{ app()->isLocale('ar') ? 'ms-3' : 'me-3' }}">
                  <img src="{{ $profile->photoUrl() }}" alt="Avatar" class="rounded-circle">
                </div>
                <div>
                  <h6 class="mb-0 text-truncate">{{ $profile->fullname }}</h6>
                  <small class="text-truncate">{{ $profile->plan->name }}</small>
                </div>
              </div>
              @if ($profile->active === '1')
                <span class="mdi mdi-check-all text-primary ms-3"></span>
              @endif
            </div>
          @endforeach

            <div class="my-3">
              <a href="{{ route('plans.index') }}" class="btn btn-outline-primary border-dashed d-grid w-100 py-3" >{{ __('New Profile') }}</a>
            </div>
        </div>
      </div>

      <!-- /Login -->
      <img src="{{asset('assets/img/illustrations/tree-3.png')}}" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block">
      <img src="{{asset('assets/img/illustrations/auth-basic-mask-light.png')}}" class="authentication-image d-none d-lg-block" alt="triangle-bg">
      <img src="{{asset('assets/img/illustrations/tree.png')}}" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block">
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
      $('.profile-item').click(function() {
          var profileId = $(this).data('profile-id');

          $.ajax({
              url: "{{ route('user.change.profile.action') }}",
              type: "POST",
              data: {
                  profile_id: profileId,
                  _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                  window.location.href = "{{ route('dashboard') }}";
              },
              error: function(xhr) {
                  // Handle error response
                  console.log(xhr.responseText);
              }
          });
      });
  });
  </script>
<style>
  .profile-item {
      cursor: pointer; /* Add pointer cursor */
      transition: background-color 0.3s; /* Add transition for hover effect */
  }

  .profile-item:hover {
      background-color: #f0f0f0; /* Change background color on hover */
  }
</style>

@endsection
