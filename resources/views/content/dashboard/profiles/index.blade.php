@extends('layouts/blankLayout')

@section('title', 'Change Profile')

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
              <img src="{{ asset('assets/home/icons/favicon.png') }}" width="30" height="30"/>
            </span>
            <span class="app-brand-text demo text-heading fw-semibold">شتلة</span>
          </a>
        </div>
        <!-- /Logo -->

        <div class="card-body mt-2">
          <div class="d-flex align-items-center border border-2 rounded p-1 my-1" dir="rtl">
            <div class="avatar avatar-lg ms-3">
              <img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar" class="rounded-circle">
            </div>
            <div>
              <h6 class="mb-0 text-truncate">خلفاوي الحارث</h6>
              <small class="text-truncate">0795909128</small>
            </div>
          </div>

            <div class="my-3">
              <a href="{{ route('plans.index') }}" class="btn btn-primary d-grid w-100" >{{ __('New Account') }}</a>
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
