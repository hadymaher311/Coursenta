
<div class="pusher dimmed">
<!--Main Navigation-->
  <header>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top scrolling-navbar">
  <div class="container">
    <a class="navbar-brand" href="#"><strong>Coursenta</strong></a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Profile</a>
        </li>
      </ul>
    </div>

    @if (Route::has('login'))
      <div class="links">
          @if(true)
            <i class="fa fa-bars open-side" aria-hidden="true"></i>
          @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
          @endauth
      </div>
    @endif

  </div>
</nav>
