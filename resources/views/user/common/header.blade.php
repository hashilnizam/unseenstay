 <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">

        <a href="/"> <img style="text-size: 10px" src="{{ asset('user/images/icon.png') }}" alt="Icon" class="icon" width="80px"> </a>  
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="{{ route('unseen.rooms') }}" class="nav-link">Rooms</a></li>
            <li class="nav-item"><a href="{{ route('unseen.resorts') }}" class="nav-link">Resorts</a></li>
            <li class="nav-item"><a href="{{ route('unseen.about') }}" class="nav-link">About</a></li>
            <li class="nav-item"><a href="{{ route('unseen.blog') }}" class="nav-link">Blog</a></li>
            <li class="nav-item"><a href="{{ route('unseen.contact') }}" class="nav-link">Contact</a></li>
            <li class="nav-item"><a href="{{ route('unseen.login') }}" class="nav-link">Login</a></li>
          </ul>
        </div>
      </div>
    </nav>
