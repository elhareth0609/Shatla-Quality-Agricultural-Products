@extends('layouts.homeLayout')

@section('title', '')

@section('content')
<div class="container" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <div class="product-main">



    <div class="row h-px-250 rounded seller-background">
      <div class="h-px-100 rounded" style="transform: translateY(173px);">
        <div class="d-flex" style="justify-content: space-between;">
          <div class="d-flex">
            <img src="{{ $seller->photoUrl() }}" alt="{{ $seller->fullname }}" class="w-px-120 h-px-120 rounded border border-5 bg-white" id="uploadedAvatar" style="border-color: aliceblue;">
            <div class="d-block me-3">
              <h3 class="text-white">{{ $seller->fullname }}</h3>
              <h5 class="text-white">{{ $seller->plan->name }}</h5>
            </div>
          </div>
          <div class="my-h-fit-content">
            <button type="button" class="btn btn-icon btn-primary">
              <span class="tf-icons mdi mdi-plus-outline m-2"></span>
            </button>
            <a href="tel:{{ $seller->phone }}" class="btn btn-icon btn-primary">
              <span class="tf-icons mdi mdi mdi-phone-plus-outline m-2"></span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="row h-px-100 mt-4"></div>
    <div class="row mt-4">
      @foreach($seller->user->products as $product)
        <x-product :product="$product" />
      @endforeach
    </div>

  </div>
</div>
<style>
  .seller-background {
    background-image: url(http://127.0.0.1:8000/assets/img/illustrations/hjhjh.png);
    background-position-y: center;
  }
</style>
@endsection
