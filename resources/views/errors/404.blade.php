@extends('layouts/blankLayout')

@section('title', 'Error - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-misc.css')}}">
@endsection


@section('content')
<!-- Error -->
<div class="misc-wrapper">
  <h1 class="mb-2 mx-2" style="font-size: 6rem;">404</h1>
  <h4 class="mb-2">{{__('Page Not Found ⚠️')}}</h4>
  <p class="mb-4 mx-2">{{__('we couldn\'t find the page you are looking for')}}</p>
  <div class="d-flex justify-content-center mt-5">
    <img src="{{asset('assets/img/illustrations/tree.png')}}" alt="misc-tree" class="img-fluid misc-object d-none d-lg-inline-block" width="80">
    <img src="{{asset('assets/img/illustrations/misc-mask-light.png')}}" alt="misc-error" class="scaleX-n1-rtl misc-bg d-none d-lg-inline-block">
    <div class="d-flex flex-column align-items-center">
      <img src="{{asset('assets/img/illustrations/Water drop-amico.png')}}" alt="misc-error" class="misc-model img-fluid z-1" width="780">
      <div>
        <a href="{{ url('/') }}" class="btn btn-primary text-center my-4">{{__('Back to home')}}</a>
      </div>
    </div>
  </div>
</div>
<!-- /Error -->
@endsection
