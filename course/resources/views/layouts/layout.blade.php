<!doctype html>
<html lang="{{ app()->getLocale() }}" class="full-height">

  <head>

    @include('layouts.head')

    @yield('head')

  </head>

  <body>

    @if (Route::has('login'))
      @if(true)
        @include('layouts.sidenav')
      @endauth
    @endif

    @include('layouts.nav')

    @section('body')
      @show

    @include('layouts.footer')
    @yield('footer')

  </body>
</html>
