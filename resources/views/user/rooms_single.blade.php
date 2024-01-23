@extends('user.common.app')

@section('content')

    <body>
    <div class="hero-wrap" style="background-image: url('{{ asset('images/bg_1.jpg') }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
                <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                    <div class="text">
                        <p class="breadcrumbs mb-2" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="rooms.html">Room</a></span> <span>Room Single</span></p>
                        <h1 class="mb-4 bread">Room Single</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12 ftco-animate">
                            <h2 class="mb-4">{{ $properties['name'] }}</h2>
                            <div class="single-slider owl-carousel">
                                <div class="item">
                                    <div class="room-img" style="background-image: url('{{ asset('images/' . $properties->image) }}');"></div>
                                </div>
                                <div class="item">
                                    <div class="room-img" style="background-image: url('{{ asset('images/' . $properties->logo) }}');"></div>
                                </div>
                                <div class="item">
                                    <div class="room-img" style="background-image: url('{{ asset('images/' . $properties->image) }}');"></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 room-single mt-4 mb-5 ftco-animate">
                            <p>{{ $properties->description }}</p>
                            <div class="d-md-flex mt-5 mb-5">
                                <ul class="list">
                                    <li><span><i class="fa-solid fa-house"></i></span> {{ $properties->property_types->property_type }}</li>
                                    <li><span><i class="fas fa-map-marker-alt"></i></span> {{ $properties->location }}</li>
                                </ul>
                                <ul class="list ml-md-5">
                                    <li><span><i class="fas fa-envelope"></i></span> {{ $properties->email }}</li>
                                    <li><span><i class="fas fa-mobile"></i></span> {{ $properties->mobile }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 room-single ftco-animate mb-5 mt-5">
                            <h4 class="mb-4">Available Room</h4>
                            <div class="row">
                                @foreach($properties->rooms as $room)
                                <div class="col-sm col-md-6 ftco-animate">
                                    <div class="room">
                                        <a href="{{ route('rooms_book_now', ['id' => $room->id, 'user_id' => Auth::id()]) }}" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url('{{ asset('images/' . $room->image) }}');">
                                            <div class="icon d-flex justify-content-center align-items-center">
                                                <span class="icon-search2"></span>
                                            </div>
                                        </a>
                                        <div class="text p-3 text-center">
                                            <h3 class="mb-3"><a href="rooms.html">{{ $room->description }}</a></h3>
                                            <p><span class="price mr-2">₹ {{ $room->price }}</span> <span class="per">per night</span></p>
                                            <ul class="list">
                                                <li><span>Max:</span> {{ $room->person }} Persons</li>
                                                <li><span>View:</span> {{ $room->view }} </li>
                                            </ul>
                                            <hr>

                                                <a href="{{ route('rooms_book_now', ['id' => $room->id, 'user_id' => Auth::id()]) }}" style="display: inline-block;
                                        padding: 15px 30px;
                                        font-size: 18px;
                                        text-decoration: none;
                                        background-color: #3498db;
                                        color: #fff;
                                        border-radius: 5px;
                                        transition: background-color 0.3s ease;"
                                                   onmouseover="this.style.backgroundColor='#2980b9'"
                                                   onmouseout="this.style.backgroundColor='#3498db'">
                                                    Book Now
                                                </a>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div> <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar ftco-animate">

                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Categories</h3>
                            <li><a href="#">Resort <span>(12)</span></a></li>
                            <li><a href="#">Homestay <span>(22)</span></a></li>
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3>Recent Blog</h3>
                        <div class="sidebar-box ftco-animate">
                            @foreach($blogs as $blog)
                                <!-- Consider using a loop for dynamic recent blog posts -->
                                <div class="block-21 mb-4 d-flex">
                                    <a class="blog-img mr-4" style="background-image: url({{ asset('images/' . $blog->image) }});"></a>
                                    <div class="text">
                                        <h3 class="heading"><a href="{{ route('blog_single',['id' => $blog->id]) }}">{{ $blog->heading }}</a></h3>
                                        <div class="meta">
                                            <div><a><span class="icon-calendar"></span>{{ $blog->created_at->format('M d, Y') }}</a></div>
                                            <div><a><span class="icon-person"></span> Admin</a></div>
                                            <div><><span class="icon-chat"></span> 19</a></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section> <!-- .section -->

    <section class="instagram pt-5">
        <div class="container-fluid">
            <div class="row no-gutters justify-content-center pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2><span>Instagram</span></h2>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-sm-12 col-md ftco-animate">
                    <a href="{{ asset('images/insta-1.jpg') }}" class="insta-img image-popup" style="background-image: url('{{ asset('images/insta-1.jpg') }}');">
                        <div class="icon d-flex justify-content-center">
                            <span class="icon-instagram align-self-center"></span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md ftco-animate">
                    <a href="{{ asset('images/insta-2.jpg') }}" class="insta-img image-popup" style="background-image: url('{{ asset('images/insta-2.jpg') }}');">
                        <div class="icon d-flex justify-content-center">
                            <span class="icon-instagram align-self-center"></span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md ftco-animate">
                    <a href="{{ asset('images/insta-3.jpg') }}" class="insta-img image-popup" style="background-image: url('{{ asset('images/insta-3.jpg') }}');">
                        <div class="icon d-flex justify-content-center">
                            <span class="icon-instagram align-self-center"></span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md ftco-animate">
                    <a href="{{ asset('images/insta-4.jpg') }}" class="insta-img image-popup" style="background-image: url('{{ asset('images/insta-4.jpg') }}');">
                        <div class="icon d-flex justify-content-center">
                            <span class="icon-instagram align-self-center"></span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md ftco-animate">
                    <a href="{{ asset('images/insta-5.jpg') }}" class="insta-img image-popup" style="background-image: url('{{ asset('images/insta-5.jpg') }}');">
                        <div class="icon d-flex justify-content-center">
                            <span class="icon-instagram align-self-center"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    </body>

@endsection
