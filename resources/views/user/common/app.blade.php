<!DOCTYPE html>
<html lang="en">
  <head>


      <link rel="icon" href="{{ asset('/user/images/icon.png') }}" type="image/png">
      <title>Unseenstay</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta property="og:title" content="Unseenstay" />
      <meta name="author" content="Hashil Nisam">
      <meta property="og:description" content="Discover UnseenStay: Book resorts, homestays, and tour packages for your next adventure. Explore unique accommodations and plan your perfect getaway with us." />
      <meta property="og:image" content="https://www.unseenstay.in/user/images/meta-tag.jpg" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="https://www.unseenstay.in" />
      <meta property="og:site_name" content="Unseenstay" />
      <meta property="og:locale" content="en_US" />
      <meta property="article:publisher" content="https://www.unseenstay.in" />
      <meta property="og:article:tag" content="Travel" />
      <meta property="og:article:section" content="Travel" />
      <meta property="og:article:published_time" content="2024-02-18T15:00:00+05:30" />
      <meta property="og:article:modified_time" content="2024-02-18T18:00:00+05:30" />
      <meta property="og:article:expiration_time" content="2025-02-18T00:00:00+05:30" />



      <link href="{{ asset('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700') }}" rel="stylesheet">
      <link href="{{ asset('https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i') }}" rel="stylesheet">

      <link rel="stylesheet" href="{{ asset('/user/css/open-iconic-bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/user/css/animate.css') }}">

      <link rel="stylesheet" href="{{ asset('/user/css/owl.carousel.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/user/css/owl.theme.default.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/user/css/magnific-popup.css') }}">

      <link rel="stylesheet" href="{{ asset('/user/css/aos.css') }}">

      <link rel="stylesheet" href="{{ asset('/user/css/ionicons.min.css') }}">

      <link rel="stylesheet" href="{{ asset('/user/css/bootstrap-datepicker.css') }}">
      <link rel="stylesheet" href="{{ asset('/user/css/jquery.timepicker.css') }}">

      <link rel="stylesheet" href="{{ asset('/user/css/flaticon.css') }}">
      <link rel="stylesheet" href="{{ asset('/user/css/icomoon.css') }}">
      <link rel="stylesheet" href="{{ asset('/user/css/style.css') }}">

{{--      <link rel="stylesheet" href="{{ asset('/user/booking/css/bootstrap.min.css') }}">--}}
      <link rel="stylesheet" href="{{ asset('/user/booking/css/style.css') }}">
      <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
      <link href="http://fonts.googleapis.com/css?family=Playfair+Display:900" rel="stylesheet" type="text/css" />
      <link href="http://fonts.googleapis.com/css?family=Alice:400,700" rel="stylesheet" type="text/css" />
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Futura:wght@400;700&display=swap" rel="stylesheet">

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

      <script>
          $(document).ready(function(){
              $('.home-slider.owl-carousel').owlCarousel({
                  items: 1,
                  loop: true,
                  nav: true,
                  dots: true,
                  touchDrag: true,
                  responsive:{
                      0:{
                          items:1
                      },
                      600:{
                          items:1
                      },
                      1000:{
                          items:1
                      }
                  }
              });
          });
      </script>

  </head>

  <body>
  @include('user.common.header')
  @yield('content')
  @include('user.common.footer')
  </body>
  </html>

