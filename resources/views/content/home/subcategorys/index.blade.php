@extends('layouts.homeLayout')

@section('title', '')

@section('content')
<div class="container" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <div class="product-main">

    <h2 class="title">
      {{ $subcategory->getName() }}
    </h2>

    <div class="row w-100 m-0 p-0">
      <div class="product-grid row m-0 mb-3" style="gap: 0!important">
        @foreach($subcategory->products as $product)
          <x-product :product="$product" />
        @endforeach
      </div>
    </div>

  </div>
</div>
@endsection
