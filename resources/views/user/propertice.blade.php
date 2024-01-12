 @extends('user.common.app')

 @section('content')

 <div class="hero-wrap" style="background-image: url('user/images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          	<div class="text">
	            <h1 class="mb-4 bread">Propertice</h1>
                <p class="breadcrumbs mb-8">
                    <span class="mr-5"><a href="index.html" style="font-size: 18px;">Resort</a></span>
                    <span class="mr-2"><a href="index.html" style="font-size: 18px;">Home Stay</a></span>
                </p>

            </div>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
	        <div class="col-lg-12">
		    		<div class="row">
                        <div class="col-sm col-md-6 col-lg-4 ftco-animate">
                            @foreach($properties as $property)
                                <div class="room">
                                    <a href="rooms-single.html" class="img d-flex justify-content-center align-items-center" style="background-image: url({{ asset('images/' . $property->image) }});">
                                        <div class="icon d-flex justify-content-center align-items-center">
                                            <span class="icon-search2"></span>
                                        </div>
                                    </a>
                                    <div class="text p-3 text-center">
                                        <h3 class="mb-3"><a href="rooms-single.html">{{ $property->name }}</a></h3>
                                        <p><span class="price mr-2">₹{{ $property->price }}</span> <span class="per">per night</span></p>
                                        <ul class="list">
                                            <li><span>Max:</span> {{ $property->max_persons }} Persons</li>
                                            <li><span>Size:</span> {{ $property->size }} m2</li>
                                            <li><span>View:</span> {{ $property->view }}</li>
                                            <li><span>Bed:</span> {{ $property->beds }}</li>
                                        </ul>
                                        <hr>
                                        <p class="pt-1"><a href="room-single.html" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-sm col-md-6 col-lg-4 ftco-animate">
		    				<div class="room">
		    					<a href="rooms-single.html" class="img d-flex justify-content-center align-items-center" style="background-image: url(user/images/room-2.jpg);">
		    						<div class="icon d-flex justify-content-center align-items-center">
		    							<span class="icon-search2"></span>
		    						</div>
		    					</a>
		    					<div class="text p-3 text-center">
		    						<h3 class="mb-3"><a href="rooms-single.html">Family Room</a></h3>
		    						<p><span class="price mr-2">$20.00</span> <span class="per">per night</span></p>
		    						<ul class="list">
		    							<li><span>Max:</span> 3 Persons</li>
		    							<li><span>Size:</span> 45 m2</li>
		    							<li><span>View:</span> Sea View</li>
		    							<li><span>Bed:</span> 1</li>
		    						</ul>
		    						<hr>
		    						<p class="pt-1"><a href="room-single.html" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
		    					</div>
		    				</div>
		    			</div>
		    			<div class="col-sm col-md-6 col-lg-4 ftco-animate">
		    				<div class="room">
		    					<a href="rooms-single.html" class="img d-flex justify-content-center align-items-center" style="background-image: url(user/images/room-3.jpg);">
		    						<div class="icon d-flex justify-content-center align-items-center">
		    							<span class="icon-search2"></span>
		    						</div>
		    					</a>
		    					<div class="text p-3 text-center">
		    						<h3 class="mb-3"><a href="rooms-single.html">Deluxe Room</a></h3>
		    						<p><span class="price mr-2">$150.00</span> <span class="per">per night</span></p>
		    						<ul class="list">
		    							<li><span>Max:</span> 5 Persons</li>
		    							<li><span>Size:</span> 45 m2</li>
		    							<li><span>View:</span> Sea View</li>
		    							<li><span>Bed:</span> 2</li>
		    						</ul>
		    						<hr>
		    						<p class="pt-1"><a href="room-single.html" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
		    					</div>
		    				</div>
		    			</div>
		    			<div class="col-sm col-md-6 col-lg-4 ftco-animate">
		    				<div class="room">
		    					<a href="rooms-single.html" class="img d-flex justify-content-center align-items-center" style="background-image: url(user/images/room-4.jpg);">
		    						<div class="icon d-flex justify-content-center align-items-center">
		    							<span class="icon-search2"></span>
		    						</div>
		    					</a>
		    					<div class="text p-3 text-center">
		    						<h3 class="mb-3"><a href="rooms-single.html">Classic Room</a></h3>
		    						<p><span class="price mr-2">$130.00</span> <span class="per">per night</span></p>
		    						<ul class="list">
		    							<li><span>Max:</span> 5 Persons</li>
		    							<li><span>Size:</span> 45 m2</li>
		    							<li><span>View:</span> Sea View</li>
		    							<li><span>Bed:</span> 2</li>
		    						</ul>
		    						<hr>
		    						<p class="pt-1"><a href="room-single.html" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
		    					</div>
		    				</div>
		    			</div>
		    			<div class="col-sm col-md-6 col-lg-4 ftco-animate">
		    				<div class="room">
		    					<a href="rooms-single.html" class="img d-flex justify-content-center align-items-center" style="background-image: url(user/images/room-5.jpg);">
		    						<div class="icon d-flex justify-content-center align-items-center">
		    							<span class="icon-search2"></span>
		    						</div>
		    					</a>
		    					<div class="text p-3 text-center">
		    						<h3 class="mb-3"><a href="rooms-single.html">Superior Room</a></h3>
		    						<p><span class="price mr-2">$300.00</span> <span class="per">per night</span></p>
		    						<ul class="list">
		    							<li><span>Max:</span> 6 Persons</li>
		    							<li><span>Size:</span> 45 m2</li>
		    							<li><span>View:</span> Sea View</li>
		    							<li><span>Bed:</span> 3</li>
		    						</ul>
		    						<hr>
		    						<p class="pt-1"><a href="room-single.html" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
		    					</div>
		    				</div>
		    			</div>
		    			<div class="col-sm col-md-6 col-lg-4 ftco-animate">
		    				<div class="room">
		    					<a href="rooms-single.html" class="img d-flex justify-content-center align-items-center" style="background-image: url(user/images/room-6.jpg);">
		    						<div class="icon d-flex justify-content-center align-items-center">
		    							<span class="icon-search2"></span>
		    						</div>
		    					</a>
		    					<div class="text p-3 text-center">
		    						<h3 class="mb-3"><a href="rooms-single.html">Luxury Room</a></h3>
		    						<p><span class="price mr-2">$500.00</span> <span class="per">per night</span></p>
		    						<ul class="list">
		    							<li><span>Max:</span> 5 Persons</li>
		    							<li><span>Size:</span> 45 m2</li>
		    							<li><span>View:</span> Sea View</li>
		    							<li><span>Bed:</span> 2</li>
		    						</ul>
		    						<hr>
		    						<p class="pt-1"><a href="room-single.html" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
		    					</div>
		    				</div>
		    			</div>

		    		</div>
		    	</div>
		    </div>
    	</div>
    </section>


    <section class="instagram pt-5">
      <div class="container-fluid">
        <div class="row no-gutters justify-content-center pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2><span>Instagram</span></h2>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-sm-12 col-md ftco-animate">
            <a href="user/images/insta-1.png" class="insta-img image-popup" style="background-image: url(user/images/insta-1.png);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="user/images/insta-2.png" class="insta-img image-popup" style="background-image: url(user/images/insta-2.png);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="user/images/insta-3.png" class="insta-img image-popup" style="background-image: url(user/images/insta-3.png);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="user/images/insta-4.png" class="insta-img image-popup" style="background-image: url(user/images/insta-4.png);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="user/images/insta-5.png" class="insta-img image-popup" style="background-image: url(user/images/insta-5.png);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

@endsection
