<footer dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">

  <div class="footer-category">

    <div class="container">

      <h2 class="footer-category-title">Brand directory</h2>

      <div class="footer-category-box">

        <h3 class="category-box-title m-0">Fashion :</h3>

        <a href="#" class="footer-category-link">T-shirt</a>
        <a href="#" class="footer-category-link">Shirts</a>
        <a href="#" class="footer-category-link">shorts & jeans</a>
        <a href="#" class="footer-category-link">jacket</a>
        <a href="#" class="footer-category-link">dress & frock</a>
        <a href="#" class="footer-category-link">innerwear</a>
        <a href="#" class="footer-category-link">hosiery</a>

      </div>

      <div class="footer-category-box">
        <h3 class="category-box-title m-0">footwear :</h3>

        <a href="#" class="footer-category-link">sport</a>
        <a href="#" class="footer-category-link">formal</a>
        <a href="#" class="footer-category-link">Boots</a>
        <a href="#" class="footer-category-link">casual</a>
        <a href="#" class="footer-category-link">cowboy shoes</a>
        <a href="#" class="footer-category-link">safety shoes</a>
        <a href="#" class="footer-category-link">Party wear shoes</a>
        <a href="#" class="footer-category-link">Branded</a>
        <a href="#" class="footer-category-link">Firstcopy</a>
        <a href="#" class="footer-category-link">Long shoes</a>
      </div>

      <div class="footer-category-box">
        <h3 class="category-box-title m-0">jewellery :</h3>

        <a href="#" class="footer-category-link">Necklace</a>
        <a href="#" class="footer-category-link">Earrings</a>
        <a href="#" class="footer-category-link">Couple rings</a>
        <a href="#" class="footer-category-link">Pendants</a>
        <a href="#" class="footer-category-link">Crystal</a>
        <a href="#" class="footer-category-link">Bangles</a>
        <a href="#" class="footer-category-link">bracelets</a>
        <a href="#" class="footer-category-link">nosepin</a>
        <a href="#" class="footer-category-link">chain</a>
        <a href="#" class="footer-category-link">Earrings</a>
        <a href="#" class="footer-category-link">Couple rings</a>
      </div>

      <div class="footer-category-box">
        <h3 class="category-box-title m-0">cosmetics :</h3>

        <a href="#" class="footer-category-link">Shampoo</a>
        <a href="#" class="footer-category-link">Bodywash</a>
        <a href="#" class="footer-category-link">Facewash</a>
        <a href="#" class="footer-category-link">makeup kit</a>
        <a href="#" class="footer-category-link">liner</a>
        <a href="#" class="footer-category-link">lipstick</a>
        <a href="#" class="footer-category-link">prefume</a>
        <a href="#" class="footer-category-link">Body soap</a>
        <a href="#" class="footer-category-link">scrub</a>
        <a href="#" class="footer-category-link">hair gel</a>
        <a href="#" class="footer-category-link">hair colors</a>
        <a href="#" class="footer-category-link">hair dye</a>
        <a href="#" class="footer-category-link">sunscreen</a>
        <a href="#" class="footer-category-link">skin loson</a>
        <a href="#" class="footer-category-link">liner</a>
        <a href="#" class="footer-category-link">lipstick</a>
      </div>

    </div>

  </div>

  <div class="footer-nav">

    <div class="container">

      <ul class="footer-nav-list">

        <li class="footer-nav-item">
          <h2 class="nav-title w-fit">{{ __('Popular Categories') }}</h2>
        </li>

        <li class="footer-nav-item">
          <a href="#" class="footer-nav-link">Fashion</a>
        </li>

      </ul>

      <ul class="footer-nav-list">

        <li class="footer-nav-item">
          <h2 class="nav-title">{{__('Products')}}</h2>
        </li>

        <li class="footer-nav-item">
          <a href="https://storyset.com" target="_blanck" class="footer-nav-link">{{ __('Storyset') }}</a> illustrations
        </li>

        <li class="footer-nav-item">
          <a href="#" class="footer-nav-link">{{__('New Products')}}</a>
        </li>

        <li class="footer-nav-item">
          <a href="#" class="footer-nav-link">{{__('Best Sales')}}</a>
        </li>

        <li class="footer-nav-item">
          <a href="#" class="footer-nav-link">{{__('Contact Us')}}</a>
        </li>

        <li class="footer-nav-item">
          <a href="#" class="footer-nav-link">{{__('Sitemap')}}</a>
        </li>

      </ul>

      <ul class="footer-nav-list">

        <li class="footer-nav-item">
          <h2 class="nav-title">{{__('Our Company')}}</h2>
        </li>

        <li class="footer-nav-item">
          <a href="{{ route('delivery') }}" class="footer-nav-link">{{__('Delivery')}}</a>
        </li>

        <li class="footer-nav-item">
          <a href="{{ route('privacy_and_policy') }}" class="footer-nav-link">{{__('Privacy & Policy')}}</a>
        </li>

        <li class="footer-nav-item">
          <a href="{{ route('terms_of_use') }}" class="footer-nav-link">{{__('Terms Of Use')}}</a>
        </li>

        <li class="footer-nav-item">
          <a href="{{ route('about_us') }}" class="footer-nav-link">{{__('About Us')}}</a>
        </li>

        <li class="footer-nav-item">
          <a href="{{ route('secure_payment') }}" class="footer-nav-link">{{__('Secure Payment')}}</a>
        </li>

      </ul>

      <ul class="footer-nav-list">

        <li class="footer-nav-item">
          <h2 class="nav-title">{{__('Services')}}</h2>
        </li>

        <li class="footer-nav-item">
          <a href="#" class="footer-nav-link">{{ __('Prices Drop') }}</a>
        </li>

        <li class="footer-nav-item">
          <a href="#" class="footer-nav-link">{{ __('New Products') }}</a>
        </li>

        <li class="footer-nav-item">
          <a href="#" class="footer-nav-link">{{ __('Best Sales') }}</a>
        </li>

        <li class="footer-nav-item">
          <a href="{{ route('contact') }}" class="footer-nav-link">{{ __('Contact Us') }}</a>
        </li>

        <li class="footer-nav-item">
          <a href="#" class="footer-nav-link">{{ __('Sitemap') }}</a>
        </li>

      </ul>

      <ul class="footer-nav-list">

        <li class="footer-nav-item">
          <h2 class="nav-title">{{__('Contact')}}</h2>
        </li>

        <li class="footer-nav-item flex">
          <div class="icon-box">
            <ion-icon name="location-outline"></ion-icon>
          </div>

          <address class="content">
            419 State 414 Rte
            Beaver Dams, New York(NY), 14812, USA
          </address>
        </li>

        <li class="footer-nav-item flex">
          <div class="icon-box">
            <ion-icon name="call-outline"></ion-icon>
          </div>

          <a href="tel:+607936-8058" class="footer-nav-link">(607) 936-8058</a>
        </li>

        <li class="footer-nav-item flex">
          <div class="icon-box">
            <ion-icon name="mail-outline"></ion-icon>
          </div>

          <a href="mailto:example@gmail.com" class="footer-nav-link">example@gmail.com</a>
        </li>

      </ul>

      <ul class="footer-nav-list">

        <li class="footer-nav-item">
          <h2 class="nav-title">{{__('Follow Us')}}</h2>
        </li>

        <li>
          <ul class="social-link">

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">
                <ion-icon name="logo-linkedin"></ion-icon>
              </a>
            </li>

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
            </li>

          </ul>
        </li>

      </ul>

    </div>

  </div>

  <div class="footer-bottom">

    <div class="container">

      <img src="{{ asset('assets/home/images/payment.png') }}" alt="payment method" class="payment-img">

      <p class="copyright">
        {{__('Copyright')}} &copy; <a href="{{ route('home') }}">شتلة</a> {{__('all rights reserved.')}}
      </p>
    </div>

  </div>

</footer>
