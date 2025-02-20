<header dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">

  <div class="header-top">

    <div class="container">

      <ul class="header-social-container m-0">

        <li>
          <a href="#" class="social-link btn btn-primary text-primary btn-icon">
            <ion-icon name="logo-facebook"></ion-icon>
          </a>
        </li>

        <li>
          <a href="#" class="social-link btn btn-primary text-primary btn-icon">
            <ion-icon name="logo-twitter"></ion-icon>
          </a>
        </li>

        <li>
          <a href="#" class="social-link btn btn-primary text-primary btn-icon">
            <ion-icon name="logo-instagram"></ion-icon>
          </a>
        </li>

      </ul>

      {{-- <div class="header-alert-news ">
        <p class="m-0">
          <b>Free Shipping</b>
          This Week Order Over - $55
        </p>
      </div> --}}

      <div class="header-top-actions">
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-translate"></i></button>
          <ul class="dropdown-menu dropdown-menu-end">
            @foreach (config('language') as $locale => $language)
              <li><a class="dropdown-item {{ app()->getLocale() == $locale ? 'active' : '' }}" href="{{ route("change.language",$locale ) }}">{{ $language }}</a></li>
            @endforeach
          </ul>
        </div>
        {{-- <div class="btn-group">
          <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-currency-usd"></i></button>
          <ul class="dropdown-menu dropdown-menu-end">
            @foreach(config('currency.currencies') as $currencyCode => $symbol)
              <li>
                  <a class="dropdown-item {{ session('currency', config('currency.default_currency')) === $currencyCode ? 'active' : '' }}" href="{{ route('change.currency', $currencyCode) }}">
                    {{ $currencyCode }} {{ $symbol }}
                  </a>
              </li>
            @endforeach
          </ul>
        </div> --}}
      </div>

    </div>

  </div>

  <div class="header-main" >

    <div class="container">


      <a href="{{url('/')}}" class="app-brand-link gap-2 my-w-fit-content mx-auto my-2">
        <span class="app-brand-logo demo">
          {{--  @include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])  --}}
          <img src="{{ asset('assets/home/icons/photo_2024-05-27_04-47-57-removebg-preview.png') }}" width="110" height="50"/>
        </span>
        {{-- <span class="app-brand-text demo text-heading fw-semibold">شتلة</span> --}}
      </a>

      <div class="header-search-container">
{{--
        <input type="search" name="search" class="search-field" placeholder="{{__('Enter your product name')}}">

        <button class="search-btn">
          <ion-icon name="search-outline"></ion-icon>
        </button> --}}
        <div class="input-group input-group-merge" dir="{{ app()->isLocale('ar') ? 'ltr' : '' }}">
          @if (!app()->isLocale('ar'))
          <span class="input-group-text" id="basic-addon-search31"><i class="mdi mdi-magnify"></i></span>
          @endif

          <input type="text" class="form-control" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}" placeholder="{{ __('Search ...') }}" aria-label="Search..." aria-describedby="basic-addon-search31" />

          @if (app()->isLocale('ar'))
              <span class="input-group-text" id="basic-addon-search31"><i class="mdi mdi-magnify"></i></span>
          @endif

        </div>

      </div>

      <div class="header-user-actions">

        @guest
        <a href="{{ route('login') }}" class="btn action-btn">
          <ion-icon name="log-in-outline" class="rotate-180"></ion-icon>
        </a>
        @endguest

        @auth
        <a href="{{ route('dashboard') }}" class="btn action-btn">
          <ion-icon name="settings-outline"></ion-icon>
        </a>

        <button class="action-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#FaveButton" aria-controls="offcanvasStart">
          <ion-icon name="heart-outline"></ion-icon>
          <span class="count favoriteCount">{{ Auth::user()->favorites->count() }}</span>
        </button>

        <button class="action-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#CartButton" aria-controls="offcanvasStart">
          <ion-icon name="bag-handle-outline"></ion-icon>
          <span class="count cartCount">{{ Auth::user()->cart->products()->count() }}</span>
        </button>


                {{-- Cart Model --}}
                <div class="offcanvas offcanvas-{{ app()->isLocale('ar') ? 'end' : 'start' }}" tabindex="-1" id="CartButton" aria-labelledby="offcanvasEndLabel">
                  <div class="offcanvas-header">
                    <h5 id="offcanvasEndLabel" class="offcanvas-title">{{ __('Cart Items') }}</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body mx-0 flex-grow-0">
                    <div class="cart-items mb-3">

                      @auth
                      @foreach (Auth::user()->cart->products as $product)

                      <div class="carts-item mb-2" data-product-id="{{ $product->product->id }}">
                        <div class="card-body" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
                          <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ $product->product->firstPhoto() }}" alt="user-avatar" class="d-block w-px-120 h-px-120 rounded" />
                            <div class="button-wrapper">
                              <div class="btn-group" role="group" aria-label="Second group" dir="ltr">
                                <button type="button" class="btn btn-icon btn-primary btn-plus-cart">
                                  <span class="tf-icons mdi mdi-plus"></span>
                                </button>
                                <input type="text" class="form-control text-center p-0 rounded-0 my-w-5 input-price-cart" data-max="{{ $product->product->quantity }}" value="{{ $product->quantity }}" name="quantity" data-product-id="{{ $product->product->id }}">
                                <button type="button" class="btn btn-icon btn-primary btn-minus-cart">
                                  <span class="tf-icons mdi mdi-minus"></span>
                                </button>
                              </div>
                              <button type="button" class="btn btn-icon btn-outline-danger btn-remove-cart">
                                <span class="tf-icons mdi mdi-trash-can-outline"></span>
                              </button>
                              <div class="text-muted small mt-3">{{ \Illuminate\Support\Str::limit($product->product->name, 90) }}</div>
                              <div class="text-muted small mt-3 d-flex justify-content-between">
                                <p>{{ $product->product->price }}</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      @endforeach
                      @endauth
                    </div>
                    <a type="button" href="{{ route('cart') }}" class="btn btn-primary mb-2 d-grid w-100">{{ __('Go To Cart') }}</a>
                  </div>
                </div>

        {{-- Faveorite Model --}}
        <div class="offcanvas offcanvas-{{ app()->isLocale('ar') ? 'end' : 'start' }}" tabindex="-1" id="FaveButton" aria-labelledby="offcanvasEndLabel">
          <div class="offcanvas-header">
            <h5 id="offcanvasEndLabel" class="offcanvas-title">{{ __('Favorite Items') }}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body mx-0 flex-grow-0">
            <div class="favorite-items mb-3">
              @auth
              @foreach (Auth::user()->favorites as $favorite)
              <div class="favorites-item mb-2" data-product-id="{{ $favorite->product->id }}">
                <div class="card-body" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
                  <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{{ $favorite->product->firstPhoto() }}" alt="user-avatar" class="d-block my-w-110 my-h-110 rounded" />
                    <div class="button-wrapper">
                      <a href="{{ route('product.view',$favorite->product->id) }}" class="btn btn-outline-info">
                        <i class="mdi mdi-reload d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">{{ __('Visit') }}</span>
                      </a>
                      <button type="button" class="btn btn-icon btn-outline-danger btn-remove-favorite">
                        <span class="tf-icons mdi mdi-trash-can-outline"></span>
                      </button>
                      <div class="text-muted small mt-3">{{ \Illuminate\Support\Str::limit($favorite->product->name, 90) }}</div>
                      <div class="text-muted small mt-3 d-flex">
                        <p>{!! \Illuminate\Support\Str::limit($favorite->product->description, 100) !!}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
              @endauth
            </div>
            {{-- <button type="button" class="btn btn-primary mb-2 d-grid w-100">{{ __('Go To Cart') }}</button> --}}
          </div>
        </div>


        @endauth

      </div>

    </div>

  </div>

  <nav class="desktop-navigation-menu">

    <div class="container">

      <ul class="desktop-menu-category-list w-100">

        <li class="menu-category">
          <a href="{{ route('home') }}" class="menu-title">{{__('Home')}}</a>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">{{ __('Categorys') }}</a>

          <div class="dropdown-panel">
            @foreach ($categorys as $category)
              <ul class="dropdown-panel-list">
                  <li class="menu-title">
                    <a href="#">
                          {{ $category->getName() }}
                    </a>
                  </li>
                  @foreach ($category->subCategorys as $subcategory)
                    @if ($subcategory->type == 'products')
                    <li class="panel-list-item">
                      <a href="{{ route('subcategory.view',$subcategory->id) }}">
                        {{ $subcategory->getName() }}
                      </a>
                    </li>
                    @endif
                  @endforeach
              </ul>
            @endforeach
          </div>
        </li>

        <li class="menu-category">
          <a href="{{ route('blog.index')}}" class="menu-title">{{ __('Blogs') }}</a>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">{{ __('Pages') }}</a>

          <ul class="dropdown-list">
            <li class="dropdown-item">
              <a href="{{ route('article.index') }}">{{ __('Articles') }}</a>
            </li>
            <li class="dropdown-item">
              <a href="{{ route('product.index') }}">{{ __('Products') }}</a>
            </li>
            <li class="dropdown-item">
              <a href="{{ route('pages.experts') }}">{{ __('Agricultural Experts') }}</a>
            </li>

            <li class="dropdown-item">
              <a href="{{ route('publication.index') }}">{{ __('Agricultural Services') }}</a>
            </li>

            <li class="dropdown-item">
              <a href="{{ route('pages.consultation') }}">{{ __('What do I plant?') }}</a>
            </li>

          </ul>
        </li>



        <li class="menu-category">
          <a href="{{ route('diseases') }}" class="menu-title">{{ __('Diseases Predict')}}</a>
        </li>

        {{-- <li class="menu-category">
          <a href="#" class="menu-title">Hot Offers</a>
        </li> --}}
      </ul>

    </div>

  </nav>

  <div class="mobile-bottom-navigation">

    <button class="action-btn" data-mobile-menu-open-btn>
      <ion-icon name="menu-outline"></ion-icon>
    </button>

    @auth
    <button class="action-btn" data-mobile-menu-open-btn>
      <ion-icon name="bag-handle-outline"></ion-icon>
      <span class="count cartCount">{{ Auth::user()->cart->products()->count() }}</span>
    </button>
    @endauth

    <a class="action-btn" href="{{ route('home') }}">
      <ion-icon name="home-outline"></ion-icon>
    </a>

  @auth
  <button class="action-btn" data-mobile-menu-open-btn>
    <ion-icon name="heart-outline"></ion-icon>
    <span class="count favoriteCount">{{ Auth::user()->favorites->count() }}</span>
  </button>
  @endauth

    <button class="action-btn" data-mobile-menu-open-btn>
      <ion-icon name="grid-outline"></ion-icon>
    </button>

  </div>


  {{-- Menu Model For Android --}}
  <nav class="mobile-navigation-menu has-scrollbar bg-white" data-mobile-menu>

    <div class="menu-top">
      <h2 class="menu-title">{{ __('Pages') }}</h2>

      <button class="menu-close-btn" data-mobile-menu-close-btn>
        <ion-icon name="close-outline"></ion-icon>
      </button>
    </div>

    <ul class="mobile-menu-category-list">

      <li class="menu-category">
        <a href="{{ route('home') }}" class="menu-title">{{ __('Home') }}</a>
      </li>

      @auth
        <li class="menu-category">
          <a href="{{ route('dashboard') }}" class="menu-title">{{ __('Account') }}</a>
        </li>
      @endauth

      @guest
        <li class="menu-category">
          <a href="{{ route('login') }}" class="menu-title">{{ __('Login') }}</a>
        </li>
      @endguest

      {{-- <li class="menu-category">

        <button class="accordion-menu" data-accordion-btn>
          <p class="menu-title">Men's</p>

          <div>
            <ion-icon name="add-outline" class="add-icon"></ion-icon>
            <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
          </div>
        </button>

        <ul class="submenu-category-list" data-accordion>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Shirt</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Shorts & Jeans</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Safety Shoes</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Wallet</a>
          </li>

        </ul>

      </li> --}}
{{--
      <li class="menu-category">

        <button class="accordion-menu" data-accordion-btn>
          <p class="menu-title">Women's</p>

          <div>
            <ion-icon name="add-outline" class="add-icon"></ion-icon>
            <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
          </div>
        </button>

        <ul class="submenu-category-list" data-accordion>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Dress & Frock</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Earrings</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Necklace</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Makeup Kit</a>
          </li>

        </ul>

      </li> --}}
{{--
      <li class="menu-category">

        <button class="accordion-menu" data-accordion-btn>
          <p class="menu-title">Jewelry</p>

          <div>
            <ion-icon name="add-outline" class="add-icon"></ion-icon>
            <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
          </div>
        </button>

        <ul class="submenu-category-list" data-accordion>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Earrings</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Couple Rings</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Necklace</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Bracelets</a>
          </li>

        </ul>

      </li> --}}

      {{-- <li class="menu-category">

        <button class="accordion-menu" data-accordion-btn>
          <p class="menu-title">Perfume</p>

          <div>
            <ion-icon name="add-outline" class="add-icon"></ion-icon>
            <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
          </div>
        </button>

        <ul class="submenu-category-list" data-accordion>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Clothes Perfume</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Deodorant</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Flower Fragrance</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Air Freshener</a>
          </li>

        </ul>

      </li> --}}

      <li class="menu-category">
        <a href="{{ route('blog.index') }}" class="menu-title">{{ __('Blogs') }}</a>
      </li>

      {{-- <li class="menu-category">
        <a href="#" class="menu-title">Hot Offers</a>
      </li> --}}

    </ul>

    <div class="menu-bottom">

      <ul class="menu-category-list">

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">{{ __('Language') }}</p>

            <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
          </button>

          <ul class="submenu-category-list" data-accordion>
            @foreach (config('language') as $locale => $language)
            <li class="submenu-category">
              <a href="{{ route("change.language",$locale ) }}" class="submenu-title {{ app()->getLocale() == $locale ? 'active' : '' }}">{{ $language }}</a>
            </li>
            @endforeach

          </ul>

        </li>

        {{-- <li class="menu-category"> --}}
          {{-- <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">{{ __('Currency') }}</p>
            <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
          </button> --}}

          {{-- <ul class="submenu-category-list" data-accordion>
            @foreach(config('currency.currencies') as $currencyCode => $symbol)
              <li class="submenu-category">
                  <a class="submenu-title {{ session('currency', config('currency.default_currency')) === $currencyCode ? 'active' : '' }}" href="{{ route('change.currency', $currencyCode) }}">
                    {{ $currencyCode }} {{ $symbol }}
                  </a>
              </li>
            @endforeach
          </ul> --}}
        {{-- </li> --}}

      </ul>

      <ul class="menu-social-container">



        <li>
          <a href="#" class="social-link btn btn-primary text-primary btn-icon">
            <ion-icon name="logo-facebook"></ion-icon>
          </a>
        </li>

        <li>
          <a href="#" class="social-link btn btn-primary text-primary btn-icon">
            <ion-icon name="logo-twitter"></ion-icon>
          </a>
        </li>

        <li>
          <a href="#" class="social-link btn btn-primary text-primary btn-icon">
            <ion-icon name="logo-instagram"></ion-icon>
          </a>
        </li>

      </ul>

    </div>

  </nav>


  {{-- Cart Model For Android --}}
  <nav class="mobile-navigation-menu has-scrollbar bg-white" data-mobile-menu>
    <div class="menu-top">
      <h2 class="menu-title">{{ __('Cart Items') }}</h2>

      <button class="menu-close-btn" data-mobile-menu-close-btn>
        <ion-icon name="close-outline"></ion-icon>
      </button>
    </div>

    <div class="cart-items mb-3">

        @auth
        @foreach (Auth::user()->cart->products as $product)

        <div class="carts-item mb-2" data-product-id="{{ $product->product->id }}">
          <div class="card-body" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
              <img src="{{ $product->product->firstPhoto() }}" alt="user-avatar" class="d-block w-px-120 h-px-120 rounded" />
              <div class="button-wrapper">
                <div class="btn-group" role="group" aria-label="Second group" dir="ltr">
                  <button type="button" class="btn btn-icon btn-primary btn-plus-cart">
                    <span class="tf-icons mdi mdi-plus"></span>
                  </button>
                  <input type="text" class="form-control text-center p-0 rounded-0 my-w-5 input-price-cart" data-max="{{ $product->product->quantity }}" value="{{ $product->quantity }}" name="quantity" data-product-id="{{ $product->product->id }}">
                  <button type="button" class="btn btn-icon btn-primary btn-minus-cart ">
                    <span class="tf-icons mdi mdi-minus"></span>
                  </button>
                </div>
                <button type="button" class="btn btn-icon btn-outline-danger btn-remove-cart">
                  <span class="tf-icons mdi mdi-trash-can-outline"></span>
                </button>
                <div class="text-muted small mt-3">{{ \Illuminate\Support\Str::limit($product->product->name, 90) }}</div>
                <div class="text-muted small mt-3 d-flex justify-content-between">
                  <p>{{ $product->product->price }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        @endforeach
        @endauth

    </div>
    <a type="button" href="{{ route('cart') }}" class="btn btn-primary mb-2 d-grid w-100">{{ __('Go To Cart') }}</a>

  </nav>




  {{-- Favorite Model For Android --}}
  <nav class="mobile-navigation-menu has-scrollbar bg-white" data-mobile-menu>
        <div class="menu-top">
          <h2 class="menu-title">{{ __('Favorite Items') }}</h2>
          <button class="menu-close-btn" data-mobile-menu-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>
        </div>

        <div class="favorite-items mb-3">
          @auth
          @foreach (Auth::user()->favorites as $favorite)
          <div class="favorites-item mb-2" data-product-id="{{ $favorite->product->id }}">
            <div class="card-body" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="{{$favorite->product->firstPhoto()}}" alt="user-avatar" class="d-block my-w-110 my-h-110 rounded" />
                <div class="button-wrapper">
                  <a href="{{ route('product.view',$favorite->product->id) }}" class="btn btn-outline-info">
                    <i class="mdi mdi-reload d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">{{ __('visit') }}</span>
                  </a>
                  <button type="button" class="btn btn-icon btn-outline-danger btn-remove-favorite">
                    <span class="tf-icons mdi mdi-trash-can-outline"></span>
                  </button>
                  <div class="text-muted small mt-3">{{ \Illuminate\Support\Str::limit($favorite->product->name, 90) }}</div>
                  <div class="text-muted small mt-3 d-flex">
                    <p>{!! \Illuminate\Support\Str::limit($favorite->product->description, 100) !!}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @endauth

        </div>
  </nav>
</header>
