 @extends('user.common.app')
 @section('content')

     <div>
         @if(session('success'))
             <div class="alert alert-success">
                 {{ session('success') }}
             </div>
         @endif
         @if(session('error'))
             <div class="alert alert-danger">
                 {{ session('error') }}
             </div>
         @endif
     </div>

 <div class="hero-wrap" style="background-image: url('user/images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          	<div class="text">
	            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="{{ route('unseen.index') }}">Home</a></span> <span>Contact</span></p>
	            <h1 class="mb-4 bread">Contact Us</h1>
            </div>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-section contact-section bg-light">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-12 mb-4">
            <h2 class="h3">Contact Information</h2>
          </div>
          <div class="w-100"></div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Address:</span> Wayanad, Kerala, India</p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Phone:</span> <a href="tel://+919188165352" target="_blank">+91 9188165352</a></p>
	            <p><span>Phone:</span> <a href="tel://+919562658093" target="_blank">+91 9562658093</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Email:</span> <a href="mailto:unseenstay@gmail.com" target="_blank">unseenstay@gmail.com</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Website</span> <a href="#">www.unseenstay.in</a></p>
	          </div>
          </div>
        </div>
        <div class="row block-9">
          <div class="col-md-6 order-md-last d-flex">
              <form class="user" method="post" action="{{ route('user_messages') }}">
                  @csrf
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name" name="name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email" name="email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject" name="subject">
              </div>
                  <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>

          </div>

            <div class="col-md-6 d-flex">
                <div id="ma" class="bg-white">
                    <p>Welcome to UnseenStay, your gateway to unforgettable travel experiences across India! As a premier travel company, we take pride in offering a diverse range of resort and homestay options that showcase the rich cultural tapestry and natural beauty of every corner of the country. Our commitment extends beyond accommodation – we also provide reliable cab services for seamless travel and thoughtfully curated tour packages that promise an immersive exploration of India's wonders. At UnseenStay, we prioritize your comfort and satisfaction, ensuring every aspect of your journey is meticulously planned and executed. We value your feedback, as it fuels our continuous effort to enhance our services and create lasting memories for every traveler. Your adventure begins with UnseenStay – discover the unseen, experience the extraordinary!</p>
                </div>

            </div>




        </div>
      </div>
    </section>


  @endsection
