@extends('layouts/blankLayout')

@section('title', __('Login'))

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
              {{--  @include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])  --}}
              <img src="{{ asset('assets/home/icons/photo_2024-05-27_04-47-57-removebg-preview.png') }}" width="110" height="50"/>
            </span>
            {{-- <span class="app-brand-text demo text-heading fw-semibold">شتلة</span> --}}
          </a>
        </div>
        <!-- /Logo -->

        <div class="card-body mt-2 {{ app()->getLocale() == 'ar' ? 'text-end' : '' }}">
          <h4 class="mb-2">{{ __('Welcome to') }} شتلة! 🎉</h4>
          <p class="mb-4">{{ __('Please sign-in to your account and start the adventure') }}</p>

          <form id="formAuthentication" class="mb-3" action="{{ route('login.action') }}" method="POST">
            @csrf
            <div class="form-floating form-floating-outline mb-3">
              <input type="text" class="form-control" id="email" name="email" placeholder="{{ __('Enter Your Email') }}" autofocus>
              <label for="email">{{ __('Email') }}</label>
            </div>
            <div class="mb-3">
              <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                    <label for="password">{{ __('Password') }}</label>
                  </div>
                  <span class="input-group-text cursor-pointer"><i class="mdi mdi-lock-outline"></i></span>
                </div>
              </div>
            </div>
            <div class="mb-3 d-flex justify-content-between">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                <label class="form-check-label" for="remember-me">
                  {{ __('Remember Me') }}
                </label>
              </div>
              <a href="{{url('auth/forgot-password-basic')}}" class="float-end mb-1">
                <span>{{ __('Forgot Password?') }}</span>
              </a>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">{{ __('Sign in') }}</button>
            </div>
          </form>

          <p class="text-center">
            <span>{{ __('New on our platform?') }}</span>
            <a href="{{url('auth/register-basic')}}">
              <span>{{ __('Create an account') }}</span>
            </a>
          </p>

          <div class="divider">
            <div class="divider-text">{{ __('Or') }}</div>
          </div>
          <div class="row justify-content-center">
            <a class="my-w-fit-content" href="{{ route('auth.google.redirect') }}">
              <button type="button" class="btn btn-outline-primary">
                <span class="tf-icons mdi mdi-google"></span>
              </button>
            </a>
            <a class="my-w-fit-content" href="{{ route('auth.facebook.redirect') }}">
              <button type="button" class="btn btn-outline-primary">
                <span class="tf-icons mdi mdi-facebook"></span>
              </button>
            </a>
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
@endsection
