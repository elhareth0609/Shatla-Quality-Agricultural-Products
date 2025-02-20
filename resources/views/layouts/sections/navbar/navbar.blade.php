@php
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');

@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{url('/')}}" class="app-brand-link gap-2">
          {{-- <span class="app-brand-logo demo">
            @include('_partials.macros',["height"=>20])
          </span>
          <span class="app-brand-text demo menu-text fw-semibold ms-1">{{config('variables.templateName')}}</span> --}}
          <span class="app-brand-logo demo">
            {{--  @include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])  --}}
            <img src="{{ asset('assets/home/icons/photo_2024-05-27_04-47-57-removebg-preview.png') }}" width="110" height="50"/>
          </span>
          {{-- <span class="app-brand-text demo text-heading fw-semibold">شتلة</span> --}}

        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
          <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="mdi mdi-menu mdi-24px"></i>
        </a>
      </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item d-flex align-items-center">
            <i class="mdi mdi-magnify mdi-24px lh-0"></i>
            <input type="text" class="form-control border-0 shadow-none bg-body" placeholder="{{ __('Search ...') }}" aria-label="Search...">
          </div>
        </div>
        <!-- /Search -->


        <ul class="navbar-nav flex-row align-items-center ms-auto">

          <!-- Mode -->
          <div class="btn-group">
            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow mx-2" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-theme-light-dark"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end {{ app()->isLocale('ar')? 'text-end' : '' }}" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
              <li>
                <a class="dropdown-item {{ Auth::user()->theme == 'light' ? 'active' : '' }}" href="#" data-theme="light">
                    <i class="mdi mdi-brightness-7"></i> {{ __('Light') }}
                </a>
            </li>
            <li>
                <a class="dropdown-item {{ Auth::user()->theme == 'dark' ? 'active' : '' }}" href="#" data-theme="dark">
                    <i class="mdi mdi-brightness-2"></i> {{ __('Dark') }}
                </a>
            </li>
            </ul>
          </div>
          <!--/ Mode -->

          <!-- Language -->
          <div class="btn-group">
            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow ms-2 me-4" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-translate"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end {{ app()->isLocale('ar')? 'text-end' : '' }}">
              @foreach (config('language') as $locale => $language)
                <li><a class="dropdown-item {{ app()->getLocale() == $locale ? 'active' : '' }}" href="{{ route("change.language",$locale ) }}">{{ __($language) }}</a></li>
              @endforeach
            </ul>
          </div>
          <!--/ Language -->


          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ Auth::user()->profile->photoUrl() }}" alt class="w-px-40 h-auto rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end mt-3 py-2 {{ app()->isLocale('ar') ? 'text-end' : '' }}" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
              <li>
                <a class="dropdown-item pb-2 mb-1" href="javascript:void(0);">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 {{ app()->isLocale('ar') ? 'ms-2 ps-1' : 'me-2 pe-1' }}">
                      <div class="avatar avatar-online">
                        <img src="{{ Auth::user()->profile->photoUrl() }}" alt class="w-px-40 h-auto rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">{{ Auth::user()->profile->fullname }}</h6>
                      <small class="text-muted">{{ Auth::user()->profile->plan->name }}</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider my-1"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('user.change.profile') }}">
                  <i class='mdi mdi-swap-horizontal-circle-outline {{ app()->isLocale('ar') ? 'ms-1' : 'me-1' }} mdi-20px'></i>
                  <span class="align-middle">{{__('Change Account')}}</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('settings.account') }}">
                  <i class='mdi mdi-cog-outline {{ app()->isLocale('ar') ? 'ms-1' : 'me-1' }} mdi-20px'></i>
                  <span class="align-middle">{{__('Settings')}}</span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider my-1"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('logout.action')}}">
                  <i class='mdi mdi-power {{ app()->isLocale('ar') ? 'ms-1' : 'me-1' }} mdi-20px'></i>
                  <span class="align-middle">{{ __('Log Out') }}</span>
                </a>
              </li>
            </ul>
          </li>
          <!--/ User -->

        </ul>
      </div>

      @if(!isset($navbarDetached))
    </div>
    @endif
  </nav>
  <!-- / Navbar -->
