@extends('layouts.homeLayout')

@section('title', __('Publications'))

@section('content')

<div class="blog" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <div class="container">
    <div class="row">
      <div class="product-main">
        <h2 class="title">{{ __('Products') }}</h2>
        <div class="product-grid">
          @foreach ($products as $product)
            <x-product :product="$product" />
          @endforeach
        </div>
    </div>
  </div>
</div>

@endsection
