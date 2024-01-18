 <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">

        <a href="/"> <img style="text-size: 10px" src="{{ asset('user/images/icon.png') }}" alt="Icon" class="icon" width="80px"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">

            <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="{{ route('unseen.properties') }}" class="nav-link">Properties</a></li>
            <li class="nav-item"><a href="{{ route('unseen.about') }}" class="nav-link">About</a></li>
            <li class="nav-item"><a href="{{ route('unseen.blog') }}" class="nav-link">Blog</a></li>
            <li class="nav-item"><a href="{{ route('unseen.contact') }}" class="nav-link">Contact</a></li>
              @if(Auth::check())
                  <li class="nav-item dropdown">
                      <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          @if(Auth::check())
                              {{ Auth::user()->username }}
                          @endif
                      </a>
                      <div class="dropdown-menu" aria-labelledby="userDropdown">
                          <a class="dropdown-item" href="{{ route('my_profile') }}">
                              <i class="fas fa-user"></i>  My Profile
                          </a>
                          <a class="dropdown-item" href="{{ route('bookings') }}">
                              <i class="fas fa-shopping-cart"></i>  My Bookings
                          </a>
                          <div class="dropdown-divider"></div>
                          @if(Auth::check())
                              <a class="dropdown-item" href="{{ route('user_logout') }}">
                                  <i class="fas fa-sign-out-alt"></i>  Logout
                              </a>
                          @endif
                      </div>

                  </li>
              @else
                  <li class="nav-item"><a href="{{ route('index_login') }}" class="nav-link">Login</a></li>
              @endif




          </ul>
        </div>
      </div>
    </nav>



