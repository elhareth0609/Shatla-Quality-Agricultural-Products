@extends('layouts/homeLayout')

@section('title', __('Agriculture Website'))

@section('content')


<main dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">

  <!--
    - BANNER
  -->

  <div class="banner">

    <div class="container">

      <div class="slider-container has-scrollbar">

        <div class="slider-item">

          <img src="{{ asset('assets/img/illustrations/potted plants-amico.png') }}" height="100%" alt="women's latest fashion sale">

          <div class="banner-content">

            <p class="banner-subtitle">Trending item</p>

            <h2 class="banner-title">Women's latest fashion sale</h2>

            <p class="banner-text">
              starting at &dollar; <b>20</b>.00
            </p>

            <a href="#" class="banner-btn">Shop now</a>

          </div>

        </div>

        <div class="slider-item">

          <img src="{{ asset('assets/img/illustrations/coffee bean-amico.png') }}" height="100%" alt="modern sunglasses">

          <div class="banner-content">

            <p class="banner-subtitle">Trending accessories</p>

            <h2 class="banner-title">Modern sunglasses</h2>

            <p class="banner-text">
              starting at &dollar; <b>15</b>.00
            </p>

            <a href="#" class="banner-btn">Shop now</a>

          </div>

        </div>

        <div class="slider-item">

          <img src="{{ asset('assets/img/illustrations/Mango tree-amico.png') }}" height="100%" alt="new fashion summer sale">

          <div class="banner-content">

            <p class="banner-subtitle">Sale Offer</p>

            <h2 class="banner-title">New fashion summer sale</h2>

            <p class="banner-text">
              starting at &dollar; <b>29</b>.99
            </p>

            <a href="#" class="banner-btn">Shop now</a>

          </div>

        </div>

      </div>

    </div>

  </div>

  <!--
    - CATEGORY
  -->

  <div class="category">

    <div class="container">

      <div class="category-item-container has-scrollbar">
        @foreach ($subcategorys as $subcategory)
        <div class="category-item bg-white">

          <div class="category-img-box w-50 p-0">
            <img src="{{ $subcategory->photoUrl() }}" alt="{{ $subcategory->getName() }}" width="100%">
          </div>

          <div class="category-content-box">

            <div class="category-content-flex">
              <h3 class="category-item-title">{{ $subcategory->getName() }}</h3>

              <p class="category-item-amount">({{ $subcategory->products->count() }})</p>
            </div>

            <a href="{{ route('subcategory.view',$subcategory->id) }}" class="category-btn">{{ __('Show All') }}</a>

          </div>

        </div>
        @endforeach

      </div>

    </div>

  </div>

  <!--
    - PRODUCT
  -->

  <div class="product-container">

    <div class="container">


      <!--
        - SIDEBAR
      -->

      {{-- <div class="sidebar  has-scrollbar" data-mobile-menu>

        <div class="sidebar-category bg-white">

          <div class="sidebar-top">
            <h2 class="sidebar-title">{{ __('Categorys') }}</h2>

            <button class="sidebar-close-btn" data-mobile-menu-close-btn>
              <ion-icon name="close-outline"></ion-icon>
            </button>
          </div>

              @foreach ($categorys as $category)
              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <p class="menu-title">
                          {{ $category->getName() }}
                    </p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                  <ul class="sidebar-submenu-category-list" data-accordion>
                    @foreach ($category->subCategorys as $subcategory)
                      <li class="sidebar-submenu-category">
                        <a href="{{ route('subcategory.view',$subcategory->id) }}" class="sidebar-submenu-title">
                          <p class="product-name">{{ $subcategory->getName() }}</p>
                          <data value="300" class="stock" title="Available Stock">300</data>
                        </a>
                      </li>
                    @endforeach
                  </ul>
            @endforeach
          </li>


          </ul>

        </div>

        <div class="product-showcase bg-white p-2 border rounded-1">

          <h3 class="showcase-heading">best sellers</h3>

          <div class="showcase-wrapper">

            <div class="showcase-container">

              <div class="showcase bg-white rounded p-1">

                <a href="#" class="showcase-img-box">
                  <img src="{{ asset('assets/home/images/products/1.jpg') }}" alt="baby fabric shoes" width="75" height="75"
                    class="showcase-img">
                </a>

                <div class="showcase-content">

                  <a href="#">
                    <h4 class="showcase-title">baby fabric shoes</h4>
                  </a>

                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>

                  <div class="price-box">
                    <del>$5.00</del>
                    <p class="price m-0">$4.00</p>
                  </div>

                </div>

              </div>

              <div class="showcase bg-white rounded p-1">

                <a href="#" class="showcase-img-box">
                  <img src="{{ asset('assets/home/images/products/2.jpg') }}" alt="men's hoodies t-shirt" class="showcase-img"
                    width="75" height="75">
                </a>

                <div class="showcase-content">

                  <a href="#">
                    <h4 class="showcase-title">men's hoodies t-shirt</h4>
                  </a>
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-half-outline"></ion-icon>
                  </div>

                  <div class="price-box">
                    <del>$17.00</del>
                    <p class="price m-0">$7.00</p>
                  </div>

                </div>

              </div>

              <div class="showcase bg-white rounded p-1">

                <a href="#" class="showcase-img-box">
                  <img src="{{ asset('assets/home/images/products/3.jpg') }}" alt="girls t-shirt" class="showcase-img" width="75"
                    height="75">
                </a>

                <div class="showcase-content">

                  <a href="#">
                    <h4 class="showcase-title">girls t-shirt</h4>
                  </a>
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-half-outline"></ion-icon>
                  </div>

                  <div class="price-box">
                    <del>$5.00</del>
                    <p class="price m-0">$3.00</p>
                  </div>

                </div>

              </div>

              <div class="showcase bg-white rounded p-1">

                <a href="#" class="showcase-img-box">
                  <img src="{{ asset('assets/home/images/products/4.jpg') }}" alt="woolen hat for men" class="showcase-img" width="75"
                    height="75">
                </a>

                <div class="showcase-content">

                  <a href="#">
                    <h4 class="showcase-title">woolen hat for men</h4>
                  </a>
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>

                  <div class="price-box">
                    <del>$15.00</del>
                    <p class="price m-0">$12.00</p>
                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div> --}}



      <div class="product-box">

        <!--
          - PRODUCT MINIMAL
        -->

        <div class="product-minimal">

          {{-- <div class="product-showcase">

            <h2 class="title">New Arrivals</h2>

            <div class="showcase-wrapper has-scrollbar">

              <div class="showcase-container">

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/clothes-1.jpg') }}" alt="relaxed short full sleeve t-shirt" width="70" class="showcase-img">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Relaxed Short full Sleeve T-Shirt</h4>
                    </a>

                    <a href="#" class="showcase-category">Clothes</a>

                    <div class="price-box">
                      <p class="price  mb-0">$45.00</p>
                      <del>$12.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/clothes-2.jpg') }}" alt="girls pink embro design top" class="showcase-img" width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Girls pnk Embro design Top</h4>
                    </a>

                    <a href="#" class="showcase-category">Clothes</a>

                    <div class="price-box">
                      <p class="price  mb-0">$61.00</p>
                      <del>$9.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/clothes-3.jpg') }}" alt="black floral wrap midi skirt" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Black Floral Wrap Midi Skirt</h4>
                    </a>

                    <a href="#" class="showcase-category">Clothes</a>

                    <div class="price-box">
                      <p class="price  mb-0">$76.00</p>
                      <del>$25.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/shirt-1.jpg') }}" alt="pure garment dyed cotton shirt" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Pure Garment Dyed Cotton Shirt</h4>
                    </a>

                    <a href="#" class="showcase-category">Mens Fashion</a>

                    <div class="price-box">
                      <p class="price  mb-0">$68.00</p>
                      <del>$31.00</del>
                    </div>

                  </div>

                </div>

              </div>

              <div class="showcase-container">

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/jacket-5.jpg') }}" alt="men yarn fleece full-zip jacket" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">MEN Yarn Fleece Full-Zip Jacket</h4>
                    </a>

                    <a href="#" class="showcase-category">Winter wear</a>

                    <div class="price-box">
                      <p class="price  mb-0">$61.00</p>
                      <del>$11.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/jacket-1.jpg') }}" alt="mens winter leathers jackets" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Mens Winter Leathers Jackets</h4>
                    </a>

                    <a href="#" class="showcase-category">Winter wear</a>

                    <div class="price-box">
                      <p class="price  mb-0">$32.00</p>
                      <del>$20.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/jacket-3.jpg') }}" alt="mens winter leathers jackets" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Mens Winter Leathers Jackets</h4>
                    </a>

                    <a href="#" class="showcase-category">Jackets</a>

                    <div class="price-box">
                      <p class="price  mb-0">$50.00</p>
                      <del>$25.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/shorts-1.jpg') }}" alt="better basics french terry sweatshorts" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Better Basics French Terry Sweatshorts</h4>
                    </a>

                    <a href="#" class="showcase-category">Shorts</a>

                    <div class="price-box">
                      <p class="price  mb-0">$20.00</p>
                      <del>$10.00</del>
                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div> --}}

          {{-- <div class="product-showcase">

            <h2 class="title">Trending</h2>

            <div class="showcase-wrapper  has-scrollbar">

              <div class="showcase-container">

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/sports-1.jpg') }}" alt="running & trekking shoes - white" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Running & Trekking Shoes - White</h4>
                    </a>

                    <a href="#" class="showcase-category">Sports</a>

                    <div class="price-box">
                      <p class="price  mb-0">$49.00</p>
                      <del>$15.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/sports-2.jpg') }}" alt="trekking & running shoes - black" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Trekking & Running Shoes - black</h4>
                    </a>

                    <a href="#" class="showcase-category">Sports</a>

                    <div class="price-box">
                      <p class="price  mb-0">$78.00</p>
                      <del>$36.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/party-wear-1.jpg') }}" alt="womens party wear shoes" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Womens Party Wear Shoes</h4>
                    </a>

                    <a href="#" class="showcase-category">Party wear</a>

                    <div class="price-box">
                      <p class="price  mb-0">$94.00</p>
                      <del>$42.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/sports-3.jpg') }}" alt="sports claw women's shoes" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Sports Claw Women's Shoes</h4>
                    </a>

                    <a href="#" class="showcase-category">Sports</a>

                    <div class="price-box">
                      <p class="price  mb-0">$54.00</p>
                      <del>$65.00</del>
                    </div>

                  </div>

                </div>

              </div>

              <div class="showcase-container">

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/sports-6.jpg') }}" alt="air tekking shoes - white" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Air Trekking Shoes - white</h4>
                    </a>

                    <a href="#" class="showcase-category">Sports</a>

                    <div class="price-box">
                      <p class="price  mb-0">$52.00</p>
                      <del>$55.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/shoe-3.jpg') }}" alt="Boot With Suede Detail" class="showcase-img" width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Boot With Suede Detail</h4>
                    </a>

                    <a href="#" class="showcase-category">boots</a>

                    <div class="price-box">
                      <p class="price  mb-0">$20.00</p>
                      <del>$30.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/shoe-1.jpg') }}" alt="men's leather formal wear shoes" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Men's Leather Formal Wear shoes</h4>
                    </a>

                    <a href="#" class="showcase-category">formal</a>

                    <div class="price-box">
                      <p class="price  mb-0">$56.00</p>
                      <del>$78.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/shoe-2.jpg') }}" alt="casual men's brown shoes" class="showcase-img" width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Casual Men's Brown shoes</h4>
                    </a>

                    <a href="#" class="showcase-category">Casual</a>

                    <div class="price-box">
                      <p class="price  mb-0">$50.00</p>
                      <del>$55.00</del>
                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div> --}}
{{--
          <div class="product-showcase">

            <h2 class="title">Top Rated</h2>

            <div class="showcase-wrapper  has-scrollbar">

              <div class="showcase-container">

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/watch-3.jpg') }}" alt="pocket watch leather pouch" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Pocket Watch Leather Pouch</h4>
                    </a>

                    <a href="#" class="showcase-category">Watches</a>

                    <div class="price-box">
                      <p class="price  mb-0">$50.00</p>
                      <del>$34.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/jewellery-3.jpg') }}" alt="silver deer heart necklace" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Silver Deer Heart Necklace</h4>
                    </a>

                    <a href="#" class="showcase-category">Jewellery</a>

                    <div class="price-box">
                      <p class="price  mb-0">$84.00</p>
                      <del>$30.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/perfume.jpg') }}" alt="titan 100 ml womens perfume" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Titan 100 Ml Womens Perfume</h4>
                    </a>

                    <a href="#" class="showcase-category">Perfume</a>

                    <div class="price-box">
                      <p class="price  mb-0">$42.00</p>
                      <del>$10.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/belt.jpg') }}" alt="men's leather reversible belt" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Men's Leather Reversible Belt</h4>
                    </a>

                    <a href="#" class="showcase-category">Belt</a>

                    <div class="price-box">
                      <p class="price  mb-0">$24.00</p>
                      <del>$10.00</del>
                    </div>

                  </div>

                </div>

              </div>

              <div class="showcase-container">

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/jewellery-2.jpg') }}" alt="platinum zircon classic ring" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">platinum Zircon Classic Ring</h4>
                    </a>

                    <a href="#" class="showcase-category">jewellery</a>

                    <div class="price-box">
                      <p class="price  mb-0">$62.00</p>
                      <del>$65.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/watch-1.jpg') }}" alt="smart watche vital plus" class="showcase-img" width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Smart watche Vital Plus</h4>
                    </a>

                    <a href="#" class="showcase-category">Watches</a>

                    <div class="price-box">
                      <p class="price  mb-0">$56.00</p>
                      <del>$78.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/shampoo.jpg') }}" alt="shampoo conditioner packs" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">shampoo conditioner packs</h4>
                    </a>

                    <a href="#" class="showcase-category">cosmetics</a>

                    <div class="price-box">
                      <p class="price  mb-0">$20.00</p>
                      <del>$30.00</del>
                    </div>

                  </div>

                </div>

                <div class="showcase bg-white">

                  <a href="#" class="showcase-img-box">
                    <img src="{{ asset('assets/home/images/products/jewellery-1.jpg') }}" alt="rose gold peacock earrings" class="showcase-img"
                      width="70">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Rose Gold Peacock Earrings</h4>
                    </a>

                    <a href="#" class="showcase-category">jewellery</a>

                    <div class="price-box">
                      <p class="price  mb-0">$20.00</p>
                      <del>$30.00</del>
                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div> --}}

        </div>



        <!--
          - PRODUCT FEATURED
        -->

        <div class="product-featured">

          <h2 class="title">{{ __('Deal of the day') }}</h2>

          <div class="showcase-wrapper has-scrollbar">

            <div class="showcase-container">

              <div class="showcase bg-white p-1 rounded">

                <div class="showcase-banner">
                  <img src="{{ asset('assets/img/illustrations/Water drop-pana.png') }}" alt="shampoo, conditioner & facewash packs" class="showcase-img">
                </div>

                <div class="showcase-content">

                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>

                  <a href="#">
                    <h3 class="showcase-title">shampoo, conditioner & facewash packs</h3>
                  </a>

                  <p class="showcase-desc">
                    Lorem ipsum dolor sit amet consectetur Lorem ipsum
                    dolor dolor sit amet consectetur Lorem ipsum dolor
                  </p>

                  <div class="price-box">
                    <p class="price  mb-0">$150.00</p>

                    <del>$200.00</del>
                  </div>

                  <button class="add-cart-btn">add to cart</button>

                  <div class="showcase-status">
                    <div class="wrapper">
                      <p>
                        already sold: <b>20</b>
                      </p>

                      <p>
                        available: <b>40</b>
                      </p>
                    </div>

                    <div class="showcase-status-bar"></div>
                  </div>

                  <div class="countdown-box">

                    <p class="countdown-desc">
                      Hurry Up! Offer ends in:
                    </p>

                    <div class="countdown">

                      <div class="countdown-content my-h-fit-content">

                        <p class="display-number m-0">360</p>

                        <p class="display-text m-0">Days</p>

                      </div>

                      <div class="countdown-content my-h-fit-content">
                        <p class="display-number m-0">24</p>
                        <p class="display-text m-0">Hours</p>
                      </div>

                      <div class="countdown-content my-h-fit-content">
                        <p class="display-number m-0">59</p>
                        <p class="display-text m-0">Min</p>
                      </div>

                      <div class="countdown-content my-h-fit-content">
                        <p class="display-number m-0">00</p>
                        <p class="display-text m-0">Sec</p>
                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

            <div class="showcase-container">

              <div class="showcase bg-white p-1 rounded">

                <div class="showcase-banner">
                  <img src="{{ asset('assets/img/illustrations/Water drop-pana.png') }}" alt="Rose Gold diamonds Earring" class="showcase-img">
                </div>

                <div class="showcase-content">

                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>

                  <h3 class="showcase-title">
                    <a href="#" class="showcase-title">Rose Gold diamonds Earring</a>
                  </h3>

                  <p class="showcase-desc">
                    Lorem ipsum dolor sit amet consectetur Lorem ipsum
                    dolor dolor sit amet consectetur Lorem ipsum dolor
                  </p>

                  <div class="price-box">
                    <p class="price  mb-0">$1990.00</p>
                    <del>$2000.00</del>
                  </div>

                  <button class="add-cart-btn">add to cart</button>

                  <div class="showcase-status">
                    <div class="wrapper">
                      <p> already sold: <b>15</b> </p>

                      <p> available: <b>40</b> </p>
                    </div>

                    <div class="showcase-status-bar"></div>
                  </div>

                  <div class="countdown-box">

                    <p class="countdown-desc">Hurry Up! Offer ends in:</p>

                    <div class="countdown">
                      <div class="countdown-content my-h-fit-content">
                        <p class="display-number m-0">360</p>
                        <p class="display-text m-0">Days</p>
                      </div>

                      <div class="countdown-content my-h-fit-content">
                        <p class="display-number m-0">24</p>
                        <p class="display-text m-0">Hours</p>
                      </div>

                      <div class="countdown-content my-h-fit-content">
                        <p class="display-number m-0">59</p>
                        <p class="display-text m-0">Min</p>
                      </div>

                      <div class="countdown-content my-h-fit-content">
                        <p class="display-number m-0">00</p>
                        <p class="display-text m-0">Sec</p>
                      </div>
                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>



        <!--
          - PRODUCT GRID
        -->

        <div class="product-main">

          <h2 class="title">{{ __('Products') }}</h2>

          <div class="product-grid">
            @foreach ($products as $product)
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

                <a href="#" class="showcase-category">{{ $product->subcategory->getName() }}</a>

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

    </div>

  </div>





  <!--
    - TESTIMONIALS, CTA & SERVICE
  -->

  <div>

    {{-- <div class="container">

      <div class="testimonials-box">

        <!--
          - TESTIMONIALS
        -->

        <div class="testimonial">

          <h2 class="title">testimonial</h2>

          <div class="testimonial-card bg-white">

            <img src="{{ asset('assets/home/images/testimonial-1.jpg') }}" alt="alan doe" class="testimonial-banner" width="80" height="80">

            <p class="testimonial-name">Alan Doe</p>

            <p class="testimonial-title">CEO & Founder Invision</p>

            <img src="{{ asset('assets/home/images/icons/quotes.svg') }}" alt="quotation" class="quotation-img" width="26">

            <p class="testimonial-desc">
              Lorem ipsum dolor sit amet consectetur Lorem ipsum
              dolor dolor sit amet.
            </p>

          </div>

        </div>



        <!--
          - CTA
        -->

        <div class="cta-container">

          <img src="{{ asset('assets/home/images/cta-banner.jpg') }}" alt="summer collection" class="cta-banner">

          <a href="#" class="cta-content">

            <p class="discount">25% Discount</p>

            <h2 class="cta-title">Summer collection</h2>

            <p class="cta-text">Starting @ $10</p>

            <button class="cta-btn">Shop now</button>

          </a>

        </div>



        <!--
          - SERVICE
        -->

        <div class="service">

          <h2 class="title">Our Services</h2>

          <div class="service-container bg-white">

            <a href="#" class="service-item">

              <div class="service-icon">
                <ion-icon name="boat-outline"></ion-icon>
              </div>

              <div class="service-content">

                <h3 class="service-title">Worldwide Delivery</h3>
                <p class="service-desc">For Order Over $100</p>

              </div>

            </a>

            <a href="#" class="service-item">

              <div class="service-icon">
                <ion-icon name="rocket-outline"></ion-icon>
              </div>

              <div class="service-content">

                <h3 class="service-title">Next Day delivery</h3>
                <p class="service-desc">UK Orders Only</p>

              </div>

            </a>

            <a href="#" class="service-item">

              <div class="service-icon">
                <ion-icon name="call-outline"></ion-icon>
              </div>

              <div class="service-content">

                <h3 class="service-title">Best Online Support</h3>
                <p class="service-desc">Hours: 8AM - 11PM</p>

              </div>

            </a>

            <a href="#" class="service-item">

              <div class="service-icon">
                <ion-icon name="arrow-undo-outline"></ion-icon>
              </div>

              <div class="service-content">

                <h3 class="service-title">Return Policy</h3>
                <p class="service-desc">Easy & Free Return</p>

              </div>

            </a>

            <a href="#" class="service-item">

              <div class="service-icon">
                <ion-icon name="ticket-outline"></ion-icon>
              </div>

              <div class="service-content">

                <h3 class="service-title">30% money back</h3>
                <p class="service-desc">For Order Over $100</p>

              </div>

            </a>

          </div>

        </div>

      </div>

    </div> --}}

  </div>





  <!--
    - BLOG
  -->

  <div class="blog">

    <div class="container">
      <h2 class="title">{{ __('Blogs') }}</h2>

      <div class="row">

        @foreach($blogs as $blog)

        <div class="blog-card col-3">

          <a href="{{ route('blog.ones',$blog->id) }}">
            <img src="{{ $blog->photoUrl() }}" alt="{{ $blog->title }}" width="300" class="blog-banner">
          </a>

          <div class="blog-content">

            <a href="{{ route('subcategory.view',$blog->subcategory->id) }}" class="blog-category">{{ $blog->subcategory->getName() }}</a>

            <a href="{{ route('blog.ones',$blog->id) }}">
              <h3 class="blog-title">{{ $blog->title }}</h3>
            </a>

            <p class="blog-meta">
              {{ __('By') }} <cite>{{ $blog->user->expert->fullname }}</cite> / <time datetime="{{ $blog->created_at }}">{{ $blog->created_at->format('M d, Y') }}</time>
            </p>

          </div>

        </div>

        @endforeach

      </div>

    </div>

  </div>



  <div class="blog">

    <div class="container">
      <h2 class="title">{{ __('Agricultural Services') }}</h2>

      <div class="row">

        @foreach($publications as $publication)

        <div class="blog-card col-3">

          <a href="{{ route('publication.ones',$blog->id) }}">
            <img src="{{ $publication->photoUrl() }}" alt="{{ $publication->title }}" width="300" class="blog-banner">
          </a>

          <div class="blog-content">

            <a href="{{ route('publication.ones',$blog->id) }}">
              <h3 class="blog-title">{{ $publication->title }}</h3>
            </a>

            <p class="blog-meta">
              {{ __('By') }} <cite>{{ $publication->user->worker->fullname }}</cite> / <time datetime="{{ $publication->created_at }}">{{ $publication->created_at->format('M d, Y') }}</time>
            </p>

          </div>

        </div>

        @endforeach

      </div>

    </div>

  </div>
</main>


@endsection
