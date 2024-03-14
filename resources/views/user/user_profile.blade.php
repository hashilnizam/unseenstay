@extends('user.common.app')

@section('content')
    <section class="home-slider owl-carousel position-relative">
        <div class="slider-item" style="background-image:url(user/images/bg_1.jpg);">
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-12 ftco-animate text-center">
                        <div class="text mb-5 pb-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item" style="background-image:url(user/images/bg_2.jpg);">
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-12 ftco-animate text-center">
                        <div class="text mb-5 pb-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="overlay-container">
        <div class="container py-5 mt-5">
            <i class="fas fa-fw fa-user"></i>
            <span style="color: white; font-size: 15px; font-weight: bold">My Profile</span>
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                 alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{ Auth::user()->username }}</h5>
                            <p class="text-muted mb-1">{{ Auth:: user()->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth:: user()->username }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth:: user()->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Mobile</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth:: user()->mobile }}</p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .position-relative {
            position: relative;
        }

        .overlay-container {
            position: absolute;
            top: 10%;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2; /* Ensure the overlay is above the background image */
        }

        .container {
            position: relative; /* Ensure relative positioning for child elements */
            z-index: 3; /* Ensure the content is above the overlay */
        }
    </style>
@endsection
