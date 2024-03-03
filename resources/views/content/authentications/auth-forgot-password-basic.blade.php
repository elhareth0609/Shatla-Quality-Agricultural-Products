@extends('layouts/blankLayout')

@section('title', 'Forgot Password Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Forgot Password -->
      <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
              {{--  @include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])  --}}
              <img src="{{ asset('assets/home/icons/favicon.png') }}" width="30" height="30"/>
            </span>
            <span class="app-brand-text demo text-heading fw-semibold">شتلة</span>
          </a>
        </div>
        <!-- /Logo -->
        <div class="card-body mt-2">
          <h4 class="mb-2">{{ __('Forgot Password?') }} 🔒</h4>
          <p class="mb-4">{{ __('Enter your email and we\'ll send you instructions to reset your password') }}</p>
          <form id="formAuthentication" class="mb-3" action="{{url('/')}}" method="GET">
            <div class="form-floating form-floating-outline mb-3">
              <input type="text" class="form-control" id="email" name="email" placeholder="{{ __('Enter your email') }}" autofocus>
              <label>{{ __('Email') }}</label>
            </div>
            <button class="btn btn-primary d-grid w-100">{{ __('Send Reset Link') }}</button>
          </form>
          <div class="text-center">
            <a href="{{url('auth/login-basic')}}" class="d-flex align-items-center justify-content-center">
              <i class="mdi mdi-chevron-left scaleX-n1-rtl mdi-24px"></i>
              {{ __('Back to login') }}
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
      <img src="{{asset('assets/img/illustrations/tree-3.png')}}" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block">
      <img src="{{asset('assets/img/illustrations/auth-basic-mask-light.png')}}" class="authentication-image d-none d-lg-block" alt="triangle-bg">
      <img src="{{asset('assets/img/illustrations/tree.png')}}" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block">
    </div>
  </div>
</div>
@endsection
