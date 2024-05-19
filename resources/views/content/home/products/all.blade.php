@extends('layouts.homeLayout')

@section('title', __('Publications'))

@section('content')

<div class="blog" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <div class="container">
    {{-- <div class="row"> --}}
      <div class="row w-100 m-0 p-0">
        <h2 class="title mx-3">{{ __('Products') }}</h2>
        <div class="product-grid row m-0 mb-3" style="gap: 0!important">
        @foreach ($products as $product)
            <x-product :product="$product" />
          @endforeach
        </div>
    </div>
  </div>
</div>

@endsection
