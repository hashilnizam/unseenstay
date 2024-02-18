@extends('user.common.app')

@section('content')
<body>
    <section class="home-slider owl-carousel">
        @foreach($banners as $banner)

        <div class="slider-item" style="background-image:url({{ asset('images/'. $banner->image) }});">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-12 ftco-animate text-center">
          	<div class="text mb-5 pb-3">
	            <h1 class="mb-3">{{ $banner->heading }}</h1>
	            <h2>{{ $banner->sub_heading }}</h2>
            </div>
          </div>
        </div>
        </div>
      </div>
        @endforeach
    </section>

    <section class="ftco-section ftc-no-pb ftc-no-pt">
			<div class="container">
				<div class="row">
					<div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(user/images/jk.jpg);">

					</div>
					<div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
	          <div class="heading-section heading-section-wo-line pt-md-5 pl-md-5 mb-5">
	          	<div class="ml-md-0">

		            <h2 class="mb-4">Welcome To Our Stays</h2>
	            </div>
	          </div>
	          <div class="pb-md-5">
							<p>Welcome to Unseenstay, where luxury meets seclusion, and every moment is a hidden gem waiting to be discovered. Nestled in the heart of nature, our resort is a haven of tranquility, promising an escape from the ordinary. As you step into the embrace of Unseenstay, you'll find a harmonious blend of opulence and the untouched beauty of the surroundings. Our accommodations are designed to provide a retreat for the soul, allowing you to unwind in style and comfort. Whether you're seeking a romantic getaway, a family adventure, or a solo retreat, Unseenstay is your sanctuary. Immerse yourself in the unseen wonders that await, where each stay is a unique and unforgettable experience, leaving you refreshed, rejuvenated, and longing to return to the hidden paradise we proudly call home. </p>
                  <ul class="ftco-social d-flex">
                      <li class="ftco-animate"><a href="https://www.facebook.com/p/THE-UNSEEN-100083043322137/" target="_blank"><span class="icon-facebook"></span></a></li>
                      <li class="ftco-animate"><a href="mailto:unseenstay@gmail.com?subject=Hi%20How%20Here" target="_blank"><span class="fas fa-envelope"></span></a></li>
                      <li class="ftco-animate"><a href="https://www.instagram.com/unseenstay/" target="_blank"><span class="icon-instagram"></span></a></li>
                      <li><a href="https://wa.me/+919188165352?text=Hello!%20I%20have%20a%20question%20and%20could%20use%20your%20assistance.%20Can%20you%20please%20help?" target="_blank"><span class="fa-brands fa-whatsapp"></span></a></li>

                  </ul>

              </div>
					</div>
				</div>
			</div>
		</section>

    <section class="ftco-section">
      <div class="container">
        <div class="row d-flex">
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services py-4 d-block text-center">
              <div class="d-flex justify-content-center">
              	<div class="icon d-flex align-items-center justify-content-center">
              		<span class="fa-solid fa-people-roof"></span>
              	</div>
              </div>
              <div class="media-body p-2 mt-2">
                <h3 class="heading mb-3">Packages</h3>
                <p>Discover a variety of tailored packages to meet your needs.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services py-4 d-block text-center">
              <div class="d-flex justify-content-center">
              	<div class="icon d-flex align-items-center justify-content-center">
              		<span class="fa-regular fa-heart"></span>
              	</div>
              </div>
              <div class="media-body p-2 mt-2">
                <h3 class="heading mb-3">Honeymoon</h3>
                <p>Experience unforgettable romance with our specially crafted honeymoon packages.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex align-sel Searchf-stretch ftco-animate">
            <div class="media block-6 services py-4 d-block text-center">
              <div class="d-flex justify-content-center">
              	<div class="icon d-flex align-items-center justify-content-center">
              		<span class="fa-solid fa-taxi"></span>
              	</div>
              </div>
              <div class="media-body p-2 mt-2">
                <h3 class="heading mb-3">Transfer Services</h3>
                <p>Effortless transportation solutions to elevate your journey.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services py-4 d-block text-center">
              <div class="d-flex justify-content-center">
              	<div class="icon d-flex align-items-center justify-content-center">
              		<span class="fa-solid fa-earth-asia"></span>
              	</div>
              </div>
              <div class="media-body p-2 mt-2">
                <h3 class="heading mb-3">Site Seeing</h3>
                <p>Explore captivating destinations with our guided sightseeing experiences.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Our Properties</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @foreach($properties->take(6) as $property)
                            <div class="col-sm col-md-6 col-lg-4 ftco-animate">
                                <div class="room">
                                    <a href="{{ route('rooms_single', ['id' => $property->id]) }}" class="img d-flex justify-content-center align-items-center" style="background-image: url({{ asset('images/' . $property->image1) }});">
                                        <div class="icon d-flex justify-content-center align-items-center">
                                            <span class="icon-search2"></span>
                                        </div>
                                    </a>
                                    <div class="text p-3 text-center">
                                        <h3 class="mb-3"><a href="{{ route('rooms_single', ['id' => $property->id]) }}">{{ $property->name }}</a></h3>
                                        <ul class="list">
                                            <li><span><i class="fa-solid fa-house"></i></span> {{ $property->property_types->property_type }}</li>
                                            <li><span><i class="fas fa-map-marker-alt"></i></span> {{ $property->location }}</li>
                                        </ul>
                                        <hr>
                                        <p class="pt-1">
                                            <a href="{{ route('rooms_single', ['id' => $property->id]) }}" class="btn-custom">
                                                View Details <span class="icon-long-arrow-right"></span>
                                            </a>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(user/images/bg_1.jpg);">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10">
		    		<div class="row">
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="8800">0</strong>
		                <span>Happy Guests</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="88">0</strong>
		                <span>Rooms</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="10">0</strong>
		                <span>Staffs</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="100">0</strong>
		                <span>Destination</span>
		              </div>
		            </div>
		          </div>
		        </div>
	        </div>
        </div>
    	</div>
    </section>


    <section class="ftco-section testimony-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 ftco-animate">
                    <div class="row ftco-animate">
                        <div class="col-md-12">
                            <div class="carousel-testimony owl-carousel ftco-owl">
                                @foreach($reviews as $review)
                                    <div class="item">
                                        <div class="testimony-wrap py-4 pb-5">
                                            <div class="user-img mb-4" style="background-image: url('images/<?php echo $review->image; ?>');">
                                        <span class="quote d-flex align-items-center justify-content-center">
                                            <i class="icon-quote-left"></i>
                                        </span>
                                            </div>
                                            <div class="text text-center">
                                                <p class="mb-4">{{ $review->description }}</p>
                                                <p class="name">{{ $review->name }}</p>
                                                <span class="position">Guests</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2>Recent Blog</h2>
          </div>
        </div>
        <div class="row d-flex">
            @foreach($blogs->take(8) as $blog)
                <div class="col-md-3 d-flex ftco-animate">
                    <div class="blog-entry align-self-stretch">
                        <a href="{{ route('blog_single',['id' => $blog->id]) }}" class="block-20">
                            <img src="{{ asset('images/' . $blog->image) }}" class="img-fluid" alt="{{ $blog->heading }}" style="width: 300px; height: 300px;">
                        </a>
                        <div class="text mt-3 d-block">
                            <h3 class="heading mt-3"><a href="{{ route('blog_single',['id' => $blog->id]) }}">{{ $blog->heading }}</a></h3>
                            <div class="meta mb-3">
                                <div><a href="{{ route('blog_single',['id' => $blog->id]) }}">{{ $blog->created_at->format('M d, Y') }}</a></div>
                                <div>&nbsp;|&nbsp;</div>
                                <div><a href="{{ route('blog_single',['id' => $blog->id]) }}">Admin</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
      </div>
    </section>

    <section class="instagram">
        <div class="container-fluid">
            <div class="row no-gutters justify-content-center pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2><span>Instagram</span></h2>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-sm-12 col-md ftco-animate" style="overflow: hidden;">
                    <div class="instagram-slider">
                        @foreach($instagrams as $instagram)
                            <a href="{{ asset('images/' . $instagram->image) }}" class="insta-img image-popup" style="background-image: url({{ asset('images/' . $instagram->image) }});">
                                <div class="icon d-flex justify-content-center">
                                    <span class="icon-instagram align-self-center"></span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Define the styles for the slider */
        .instagram-slider {
            display: flex;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .insta-img {
            flex: 0 0 auto;
            margin-right: 15px; /* Adjust the spacing between images */
            width: 300px; /* Set the width of each image */
            height: 200px; /* Set the height of each image */
        }

        /* Define the media query for desktop screens */
        @media screen and (min-width: 1024px) {
            .instagram {
                display: none; /* Hide the Instagram section on desktop screens */
            }
        }
    </style>










    <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>




 @endsection
