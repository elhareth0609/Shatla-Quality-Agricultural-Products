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

      <div class="header-alert-news ">
        <p class="m-0">
          <b>Free Shipping</b>
          This Week Order Over - $55
        </p>
      </div>

      <div class="header-top-actions">

        {{-- <div class="col-lg-3 col-sm-6 col-12"> --}}
          {{-- <div class="demo-inline-spacing"> --}}
            <div class="btn-group">
              <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-translate"></i></button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="javascript:void(0);">{{__('English')}}</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">{{__('Arabic')}}</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">{{__('Francais')}}</a></li>
              </ul>
            </div>
          {{-- </div> --}}
        {{-- </div> --}}

        {{-- <div class="col-lg-3 col-sm-6 col-12 mx-1"> --}}
          {{-- <div class="demo-inline-spacing"> --}}
            <div class="btn-group">
              <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-currency-usd"></i></button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="javascript:void(0);">USD &dollar;</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">EUR &euro;</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">DZD</a></li>
              </ul>
            </div>
          {{-- </div> --}}
        {{-- </div> --}}

      </div>

    </div>

  </div>

  <div class="header-main" >

    <div class="container">

      <a href="{{ route('home') }}" class="header-logo display-5 font-weight-bold text-dark">
        {{-- <img src="{{ asset('assets/home/images/logo/logo.svg') }}" alt="Shatla logo" width="120" height="36"> --}}
        شتلة
      </a>

      <div class="header-search-container">

        <input type="search" name="search" class="search-field" placeholder="{{__('Enter your product name')}}">

        <button class="search-btn">
          <ion-icon name="search-outline"></ion-icon>
        </button>

      </div>

      <div class="header-user-actions">

        @guest
        <a href="{{ route('login') }}" class="btn action-btn">
          <ion-icon name="person-outline"></ion-icon>
        </a>
        @endguest

        @auth
        <a href="{{ route('dashboard') }}" class="btn action-btn">
          <ion-icon name="person-outline"></ion-icon>
        </a>
        @endauth

        @auth
        <button class="action-btn">
          <ion-icon name="heart-outline"></ion-icon>
          <span class="count">0</span>
        </button>
        @endauth


        @auth
        <button class="action-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartButton" aria-controls="offcanvasStart">
          <ion-icon name="bag-handle-outline"></ion-icon>
          <span class="count">0</span>
        </button>

        <div class="offcanvas offcanvas-{{ app()->isLocale('ar') ? 'end' : 'start' }}" tabindex="-1" id="cartButton" aria-labelledby="offcanvasEndLabel">
          <div class="offcanvas-header">
            <h5 id="offcanvasEndLabel" class="offcanvas-title">Offcanvas End</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body my-auto mx-0 flex-grow-0">
            <p class="text-center">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
            <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
            <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
          </div>
        </div>

        @endauth

      </div>

    </div>

  </div>

  <nav class="desktop-navigation-menu">

    <div class="container">

      <ul class="desktop-menu-category-list">

        <li class="menu-category">
          <a href="{{ route('home') }}" class="menu-title">{{__('Home')}}</a>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Categories</a>

          <div class="dropdown-panel">

            <ul class="dropdown-panel-list">

              <li class="menu-title">
                <a href="#">{{__('Medicines')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">{{__('Seedlings')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">{{__('seeds')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">{{__('Ornamental Trees')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">{{__('Ornamental Plants')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">{{__('Fruits')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">
                  <img src="http://127.0.0.1:8000/assets/home/images/electronics-banner-1.jpg" alt="headphone collection" width="250"
                    height="119">
                </a>
              </li>

            </ul>

            <ul class="dropdown-panel-list">

              <li class="menu-title">
                <a href="#">{{__('Greenhouses')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">{{__('Greenhouses')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">{{__('Pivot Irrigation Machines')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">{{__('Vertical Irrigation Machines')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">{{__('Agricultural Lands')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">{{__('Agricultural Pipes')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">
                  <img src="http://127.0.0.1:8000/assets/home/images/mens-banner.jpg" alt="men's fashion" width="250" height="119">
                </a>
              </li>

            </ul>

            <ul class="dropdown-panel-list">

              <li class="menu-title">
                <a href="#">{{__('Fertilizers')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">{{__('Fertilizers')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">{{__('Medicines')}}</a>
              </li>

              <li class="panel-list-item">
                <a href="#">{{__('Food Supplements')}}</a>
              </li>

              {{-- <li class="panel-list-item">
                <a href="#">Cosmetics</a>
              </li>

              <li class="panel-list-item">
                <a href="#">Bags</a>
              </li> --}}

              <li class="panel-list-item">
                <a href="#">
                  <img src="http://127.0.0.1:8000/assets/home/images/womens-banner.jpg" alt="women's fashion" width="250" height="119">
                </a>
              </li>

            </ul>

            <ul class="dropdown-panel-list">

              <li class="menu-title">
                <a href="#">Electronics</a>
              </li>

              <li class="panel-list-item">
                <a href="#">Smart Watch</a>
              </li>

              <li class="panel-list-item">
                <a href="#">Smart TV</a>
              </li>

              <li class="panel-list-item">
                <a href="#">Keyboard</a>
              </li>

              <li class="panel-list-item">
                <a href="#">Mouse</a>
              </li>

              <li class="panel-list-item">
                <a href="#">Microphone</a>
              </li>

              <li class="panel-list-item">
                <a href="#">
                  <img src="http://127.0.0.1:8000/assets/home/images/electronics-banner-2.jpg" alt="mouse collection" width="250" height="119">
                </a>
              </li>

            </ul>

          </div>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Men's</a>

          <ul class="dropdown-list">

            <li class="dropdown-item">
              <a href="#">Shirt</a>
            </li>

            <li class="dropdown-item">
              <a href="#">Shorts & Jeans</a>
            </li>

            <li class="dropdown-item">
              <a href="#">Safety Shoes</a>
            </li>

            <li class="dropdown-item">
              <a href="#">Wallet</a>
            </li>

          </ul>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Women's</a>

          <ul class="dropdown-list">

            <li class="dropdown-item">
              <a href="#">Dress & Frock</a>
            </li>

            <li class="dropdown-item">
              <a href="#">Earrings</a>
            </li>

            <li class="dropdown-item">
              <a href="#">Necklace</a>
            </li>

            <li class="dropdown-item">
              <a href="#">Makeup Kit</a>
            </li>

          </ul>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Jewelry</a>

          <ul class="dropdown-list">

            <li class="dropdown-item">
              <a href="#">Earrings</a>
            </li>

            <li class="dropdown-item">
              <a href="#">Couple Rings</a>
            </li>

            <li class="dropdown-item">
              <a href="#">Necklace</a>
            </li>

            <li class="dropdown-item">
              <a href="#">Bracelets</a>
            </li>

          </ul>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Perfume</a>

          <ul class="dropdown-list">

            <li class="dropdown-item">
              <a href="#">Clothes Perfume</a>
            </li>

            <li class="dropdown-item">
              <a href="#">Deodorant</a>
            </li>

            <li class="dropdown-item">
              <a href="#">Flower Fragrance</a>
            </li>

            <li class="dropdown-item">
              <a href="#">Air Freshener</a>
            </li>

          </ul>
        </li>

        <li class="menu-category">
          <a href="{{ route('blog.index')}}" class="menu-title">{{__('Blogs')}}</a>
        </li>

        <li class="menu-category">
          <a href="{{ route('diseases') }}">{{ __('Diseases Predict')}}</a>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Hot Offers</a>
        </li>
      </ul>

    </div>

  </nav>

  <div class="mobile-bottom-navigation">

    <button class="action-btn" data-mobile-menu-open-btn>
      <ion-icon name="menu-outline"></ion-icon>
    </button>

    <button class="action-btn">
      <ion-icon name="bag-handle-outline"></ion-icon>

      <span class="count">0</span>
    </button>

    <button class="action-btn">
      <ion-icon name="home-outline"></ion-icon>
    </button>

    <button class="action-btn">
      <ion-icon name="heart-outline"></ion-icon>

      <span class="count">0</span>
    </button>

    <button class="action-btn" data-mobile-menu-open-btn>
      <ion-icon name="grid-outline"></ion-icon>
    </button>

  </div>

  <nav class="mobile-navigation-menu has-scrollbar" data-mobile-menu>

    <div class="menu-top">
      <h2 class="menu-title">Menu</h2>

      <button class="menu-close-btn" data-mobile-menu-close-btn>
        <ion-icon name="close-outline"></ion-icon>
      </button>
    </div>

    <ul class="mobile-menu-category-list">

      <li class="menu-category">
        <a href="{ route('home') }}" class="menu-title">Home</a>
      </li>

      <li class="menu-category">

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

      </li>

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

      </li>

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

      </li>

      <li class="menu-category">

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

      </li>

      <li class="menu-category">
        <a href="#" class="menu-title">Blog</a>
      </li>

      <li class="menu-category">
        <a href="#" class="menu-title">Hot Offers</a>
      </li>

    </ul>

    <div class="menu-bottom">

      <ul class="menu-category-list">

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Language</p>

            <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">English</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Espa&ntilde;ol</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Fren&ccedil;h</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">
          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Currency</p>
            <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
          </button>

          <ul class="submenu-category-list" data-accordion>
            <li class="submenu-category">
              <a href="#" class="submenu-title">USD &dollar;</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">EUR &euro;</a>
            </li>
          </ul>
        </li>

      </ul>

      <ul class="menu-social-container">

        <li>
          <a href="#" class="social-link">
            <ion-icon name="logo-facebook"></ion-icon>
          </a>
        </li>

        <li>
          <a href="#" class="social-link">
            <ion-icon name="logo-twitter"></ion-icon>
          </a>
        </li>

        <li>
          <a href="#" class="social-link">
            <ion-icon name="logo-instagram"></ion-icon>
          </a>
        </li>

      </ul>

    </div>

  </nav>

</header>
