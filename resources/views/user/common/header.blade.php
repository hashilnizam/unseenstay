<!-- Ensure you have included Bootstrap and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function(){
        // Add JavaScript code here
        $('.navbar-toggler').click(function(event){
            event.stopPropagation(); // Prevent automatic opening
            $('#ftco-nav').toggleClass('show');
        });
    });
</script>



<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">

        <a href="/"> <img style="text-size: 5px" src="{{ asset('user/images/icon.png') }}" alt="Icon" class="icon"
                          width="50px"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span>
        </button>


        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <?php
                $current_url = $_SERVER['REQUEST_URI'];
                ?>
                <li class="nav-item <?php if ($current_url == "/") echo 'active'; ?>">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item <?php if ($current_url == "/properties") echo 'active'; ?>">
                    <a class="nav-link" href="{{ route('unseen.properties') }}">Properties</a>
                </li>
                <li class="nav-item <?php if ($current_url == "/about") echo 'active'; ?>">
                    <a class="nav-link" href="{{ route('unseen.about') }}">About</a>
                </li>
                <li class="nav-item <?php if ($current_url == "/blog") echo 'active'; ?>">
                    <a class="nav-link" href="{{ route('unseen.blog') }}">Blog</a>
                </li>
                <li class="nav-item <?php if ($current_url == "/contact") echo 'active'; ?>">
                    <a class="nav-link" href="{{ route('unseen.contact') }}">Contact</a>
                </li>
            </ul>
        </div>

    </div>
</nav>



