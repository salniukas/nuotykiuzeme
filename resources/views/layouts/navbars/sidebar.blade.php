
<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      {{ __('Nuotykių Žemė') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">Pagrindinis</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Anketos') }}
            <b class="caret"></b>
          </p>
        </a>
        @if(Auth::user()->isAdmin || Auth::user()->isSupport || Auth::user()->isAleradas)
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'Anketos' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('Anketos') }}">
                <span class="sidebar-mini"> A </span>
                <span class="sidebar-normal">{{ __('Anketos') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Atmestos Anketos' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('Atmestos-Anketos') }}">
                <span class="sidebar-mini"> AA </span>
                <span class="sidebar-normal"> {{ __('Atmestos Anketos') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Patvirtintos Anketos' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('patvirtintos-anketos') }}">
                <span class="sidebar-mini"> PA </span>
                <span class="sidebar-normal">{{ __('Patvirtintos Anketos') }} </span>
              </a>
            </li>
          </ul>
        </div>
        @endif
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Žaidėjų Sąrašas') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Atranka' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('Atranka') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Pildyti Anketą') }}</p>
        </a>
      </li>
       <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('icons') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Paslaugos') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'juodasis' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('juodasis') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Juodasis Sąrašas') }}</p>
        </a>
      </li>
      {{-- <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('map') }}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('Maps') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li> --}}
    </ul>
  </div>
</div>