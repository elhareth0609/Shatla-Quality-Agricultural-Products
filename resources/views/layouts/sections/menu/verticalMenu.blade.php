<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- ! Hide app brand if navbar-full -->
  <div class="app-brand demo">
    <a href="{{url('/')}}" class="app-brand-link">
      {{-- <span class="app-brand-logo demo me-1">
        @include('_partials.macros',["height"=>20])
      </span>
      <span class="app-brand-text demo menu-text fw-semibold ms-2">{{config('variables.templateName')}}</span> --}}
      <span class="app-brand-logo demo">
        {{--  @include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])  --}}
        <img src="{{ asset('assets/home/icons/favicon.png') }}" width="30" height="30"/>
      </span>
      <span class="app-brand-text demo text-heading fw-semibold">شتلة</span>

    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>
  @inject('permissionService', 'App\Services\PermissionService')
  @inject('Permission', 'App\Models\Permission')
  @php
    $userPlanId = Auth::user()->profile->plan_id;
  @endphp

  <ul class="menu-inner py-1">
    @foreach ($menuData[0]->menu as $menu)
    @php
        // Get the required permission ID for this menu item
        $requiredPermissionId = isset($menu->required) ? $menu->required : null;

        $permissionId = $Permission->where('name', $requiredPermissionId)->value('id');
        $hasPermission = $permissionId ? $permissionService->checkPermission($userPlanId, $permissionId) : true;
    @endphp

      {{-- adding active and open class if child is active --}}

      {{-- menu headers --}}
      @if (isset($menu->menuHeader))
        <li class="menu-header fw-medium mt-4">
          <span class="menu-header-text">{{ __($menu->menuHeader) }}</span>
        </li>

      @else

        {{-- active menu method --}}
        @php
          $activeClass = null;
          $currentRouteName =  Route::currentRouteName();

          if ($currentRouteName === $menu->slug) {
              $activeClass = 'active';
          } elseif (isset($menu->submenu)) {
            if (gettype($menu->slug) === 'array') {
              foreach($menu->slug as $slug){
                if (str_contains($currentRouteName,$slug) and strpos($currentRouteName,$slug) === 0) {
                  $activeClass = 'active open';
                }
              }
            } else {
              if (str_contains($currentRouteName,$menu->slug) and strpos($currentRouteName,$menu->slug) === 0) {
                $activeClass = 'active open';
              }
            }
          }
        @endphp

        @if ($hasPermission)
        <li class="menu-item {{$activeClass}}">
          <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}" class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
            @isset($menu->icon)
            <i class="{{ $menu->icon }}"></i>
            @endisset
            <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
            @isset($menu->badge)
            <div class="badge bg-{{ $menu->badge[0] }} rounded-pill ms-auto">{{ $menu->badge[1] }}</div>

            @endisset
          </a>

          {{-- submenu --}}
          @isset($menu->submenu)
            @include('layouts.sections.menu.submenu',['menu' => $menu->submenu])
          @endisset
        </li>
        @endif
      @endif
    @endforeach
  </ul>

</aside>
