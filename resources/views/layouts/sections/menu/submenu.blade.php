<ul class="menu-sub">
  @if (isset($menu))
    @foreach ($menu as $submenu)
      @php
        $requiredPermission = isset($submenu->required) ? $submenu->required : null;

        $activeClass = null;
        $active = 'active open';
        $currentRouteName = Route::currentRouteName();

        if ($currentRouteName === $submenu->slug) {
            $activeClass = 'active';
        } elseif (isset($submenu->submenu)) {
          if (is_array($submenu->slug)) {
            foreach($submenu->slug as $slug){
              if (str_starts_with($currentRouteName, $slug)) {
                  $activeClass = $active;
              }
            }
          } else {
            if (str_starts_with($currentRouteName, $submenu->slug)) {
              $activeClass = $active;
            }
          }
        }
      @endphp

      @if (Auth::user()->isCan($requiredPermission) || $requiredPermission == null)
        <li class="menu-item {{$activeClass}}">
          <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}" class="{{ isset($submenu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($submenu->target) and !empty($submenu->target)) target="_blank" @endif>
            @if (isset($submenu->icon))
              <i class="{{ $submenu->icon }}"></i>
            @endif
            <div>{{ isset($submenu->name) ? __($submenu->name) : '' }}</div>
            @isset($submenu->badge)
              <div class="badge bg-{{ $submenu->badge[0] }} rounded-pill ms-auto">{{ $submenu->badge[1] }}</div>
            @endisset
          </a>

          @if (isset($submenu->submenu))
            @include('layouts.sections.menu.submenu', ['menu' => $submenu->submenu])
          @endif
        </li>
      @endif
    @endforeach
  @endif
</ul>
