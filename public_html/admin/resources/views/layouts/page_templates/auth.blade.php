<div class="wrapper ">
@if (request()->route()->getName() != 'dselect')
  @include('layouts.navbars.sidebar')
@endif
  <div class="main-panel">
    @include('layouts.navbars.navs.auth')
    @yield('content')
@if (request()->route()->getName() != 'dselect')
    @include('layouts.footers.auth')
@endif
  </div>
</div>