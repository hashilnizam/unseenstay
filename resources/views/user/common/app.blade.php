<!DOCTYPE html>
<html lang="en">
  <head>
   <link rel="icon" href="{{ asset('user/images/icon.png') }}" type="image/png">
    <title>Unseenstay</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{asset ('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700') }}" rel="stylesheet">
    <link href="{{asset ('https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('user/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/animate.css') }}">

    <link rel="stylesheet" href="{{asset ('user/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{asset ('user/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{asset ('user/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{asset ('user/css/aos.css') }}">

    <link rel="stylesheet" href="{{asset ('user/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{asset ('user/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{asset ('user/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{asset ('user/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{asset ('user/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{asset ('user/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  </head>

  <body>
  @include('user.common.header')
  @yield('content')
  @include('user.common.footer')
  </body>
  </html>

