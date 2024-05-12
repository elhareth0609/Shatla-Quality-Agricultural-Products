@extends('layouts.homeLayout')

@section('title', '')

@section('content')
<div class="container" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <div class="product-main">



    <div class="row h-px-250 rounded expert-background">
      <div class="h-px-100 rounded" style="transform: translateY(173px);">
        <div class="d-flex" style="justify-content: space-between;">
          <div class="d-flex">
            <img src="{{ $expert->photoUrl() }}" alt="{{ $expert->fullname }}" class="w-px-120 h-px-120 rounded border border-5 bg-white" id="uploadedAvatar" style="border-color: aliceblue;">
            <div class="d-block me-3">
              <h3 class="text-white">{{ $expert->fullname }}</h3>
              <h5 class="text-white">{{ $expert->plan->name }}</h5>
            </div>
          </div>
          <div class="my-h-fit-content">
            <button type="button" class="btn btn-icon btn-primary">
              <span class="tf-icons mdi mdi-plus-outline m-2"></span>
            </button>
            <a href="tel:{{ $expert->phone }}" class="btn btn-icon btn-primary">
              <span class="tf-icons mdi mdi mdi-phone-plus-outline m-2"></span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="row h-px-100 mt-4"></div>
    <div class="row mt-4">
      @foreach($expert->user->blogs as $blog)
        <x-blog :blog="$blog" />
      @endforeach
    </div>

  </div>
</div>
<style>
  .expert-background {
    background-image: url(http://127.0.0.1:8000/assets/img/illustrations/hjhjh.png);
    background-position-y: center;
  }
</style>
@endsection
