@extends('layouts/blankLayout')

@section('title', __('Register'))

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection


@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Register Card -->
      <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
              {{--  @include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])  --}}
              <img src="{{ asset('assets/home/icons/photo_2024-05-27_04-47-57-removebg-preview.png') }}" width="110" height="50"/>
            </span>
            {{-- <span class="app-brand-text demo text-heading fw-semibold">شتلة</span> --}}
          </a>
        </div>
        <!-- /Logo -->
        <div class="card-body mt-2 {{ app()->getLocale() == 'ar' ? 'text-end' : '' }}">
          <h4 class="mb-2">{{ __('Adventure starts here') }} 🚀</h4>
          <p class="mb-4">{{ __('Make your app management easy and fun!') }}</p>

          <form id="formAuthentication" class="mb-3" action="{{ route('register.action') }}" method="POST">
            @csrf
            <div class="form-floating form-floating-outline mb-3">
              <input type="text" class="form-control" id="username" name="fullname" placeholder="{{ __('Enter Your Full Name') }}" autofocus>
              <label for="fullname">{{ __('Full Name') }}</label>
            </div>
            <div class="form-floating form-floating-outline mb-3">
              <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Enter Your Email') }}">
              <label for="email">{{ __('Email') }}</label>
            </div>
            <div class="form-floating form-floating-outline mb-3">
              <input type="phone" class="form-control" id="phone" name="phone" placeholder="{{ __('Enter Your Phone') }}">
              <label for="phone">{{ __('Phone') }}</label>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  <label for="password">{{ __('Password') }}</label>
                </div>
                <span class="input-group-text cursor-pointer"><i class="mdi mdi-lock-outline"></i></span>
              </div>
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                <label class="form-check-label" for="terms-conditions">
                  {{ __('I agree to') }}
                  <a href="javascript:void(0);">{{ __('privacy policy & terms') }}</a>
                </label>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-100">
              {{ __('Sign up') }}
            </button>
          </form>

          <p class="text-center">
            <span>{{ __('Already have an account?') }}</span>
            <a href="{{url('auth/login-basic')}}">
              <span>{{ __('Sign in instead') }}</span>
            </a>
          </p>
        </div>
      </div>
      <!-- Register Card -->
      <img src="{{asset('assets/img/illustrations/tree-3.png')}}" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block">
      <img src="{{asset('assets/img/illustrations/auth-basic-mask-light.png')}}" class="authentication-image d-none d-lg-block" alt="triangle-bg">
      <img src="{{asset('assets/img/illustrations/tree.png')}}" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block">
    </div>
  </div>
</div>
@endsection
