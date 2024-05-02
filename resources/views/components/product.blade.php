
<div class="showcase bg-white" data-item-id="{{ $product->id }}">
  <div class="showcase-banner">
    <div id="carouselExample" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner rounded">
        @foreach ($product->photos as $photo)
            @if ($photo->type === '1')
              <div class="carousel-item active" style="height: 300px">
                <img class="d-block w-100 h-100" src="{{ $photo->photoUrl() }}" alt="First slide" />
              </div>
            @else
              <div class="carousel-item"  style="height: 300px">
                <img class="d-block w-100 h-100" src="{{ $photo->photoUrl() }}" alt="First slide" />
              </div>
            @endif
        @endforeach
      </div>
    </div>

    @if ($product->percentage)
      <p class="showcase-badge">
        {{ $product->percentage }}
      %</p>
    @endif

    <div class="showcase-actions">
      <button type="button" class="btn-action btn btn-icon favorite-btn" data-item-id="{{ $product->id }}">
        @if (Auth::user() && Auth::user()->myfavorite($product->id))
        <i class="mdi mdi-heart mdi-hover"></i>
        @else
        <i class="mdi mdi-heart-outline mdi-hover"></i>
        @endif
      </button>
      <button class="btn-action btn btn-icon repeat-btn" data-item-id="{{ $product->id }}" role="button" data-bs-slide="next">
        <i class="mdi mdi-repeat mdi-hover"></i>
      </button>
      <button type="button" class="btn-action btn btn-icon cart-btn" data-item-id="{{ $product->id }}">
        @if (Auth::check() && Auth::user()->cart->myCart($product->id))
        <i class="mdi mdi-cart mdi-hover"></i>
        @else
        <i class="mdi mdi-cart-outline mdi-hover"></i>
        @endif
      </button>
    </div>
  </div>

  <div class="showcase-content">
    <a href="{{ route('subcategory.view',$product->subcategory->id) }}" class="showcase-category">{{ $product->subcategory->getName() }}</a>
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
      <p class="price mb-0">{{ $product->price }}</p>
      @if ($product->last_price)
        <del>{{ $product->last_price }}</del>
      @endif
    </div>
  </div>
</div>
