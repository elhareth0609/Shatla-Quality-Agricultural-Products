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
      <div class="showcase bg-white">

        <div class="showcase-banner">
          @foreach ($product->photos as $photo)
              @if ($photo->type === '1')
                  <img src="{{ $photo->photoUrl() }}" alt="" width="300" class="product-img default">
              @else
                  <img src="{{ $photo->photoUrl() }}" alt="" width="300" class="product-img hover">
              @endif
          @endforeach

          @if ($product->percentage)
            <p class="showcase-badge">
              {{ $product->percentage }}
            %</p>
          @endif

          <div class="showcase-actions">

            <button class="btn-action">
              <ion-icon name="heart-outline"></ion-icon>
            </button>

            <button class="btn-action">
              <ion-icon name="eye-outline"></ion-icon>
            </button>

            <button class="btn-action">
              <ion-icon name="repeat-outline"></ion-icon>
            </button>

            <button class="btn-action">
              <ion-icon name="bag-add-outline"></ion-icon>
            </button>

          </div>

        </div>

        <div class="showcase-content">

          <a href="{{ route('subcategory.view',$subcategory->id) }}" class="showcase-category">{{ $product->subcategory->getName() }}</a>

          <a href="{{ route('product.view',$product->id) }}">
            <h3 class="showcase-title">{{ $product->name }}</h3>
          </a>

          <div class="showcase-rating">
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star-outline"></ion-icon>
            <ion-icon name="star-outline"></ion-icon>
          </div>

          <div class="price-box">
            <p class="price  mb-0">{{ $product->price }}</p>
            @if ($product->last_price)
            <del>{{ $product->last_price }}</del>
            @endif
          </div>

        </div>

      </div>
    @endforeach

  </div>

</div>
</div>
@endsection
