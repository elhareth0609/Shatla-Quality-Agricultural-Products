@extends('layouts.homeLayout')

@section('title', '')

@section('content')
<div class="container" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <div class="product-main">

  <h2 class="title">
        {{ $subcategory->getName() }}
  </h2>

  <div class="product-grid">
    @foreach ($subcategory->products as $product)
      <x-product :product="$product" />
    @endforeach
  </div>

</div>
</div>
@endsection
