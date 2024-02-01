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
        @foreach($contacts->take(1) as $contact)
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-12 mb-4">
            <h2 class="h3">Contact Information</h2>
          </div>
          <div class="w-100"></div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Address:</span>{{ $contact->address }}</p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Phone:</span> <a href="tel://+919188165352" target="_blank">{{ $contact->mobile_1 }}</a></p>
	            <p><span>Phone:</span> <a href="tel://+919562658093" target="_blank">{{ $contact->mobile_2 }}</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Email:</span> <a href="mailto:unseenstay@gmail.com" target="_blank">{{ $contact->email }}</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Website</span> <a href="http://unseenstay.in" target="_blank">{{ $contact->website }}</a></p>
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
              <br>
                  <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>

          </div>

            <div class="col-md-6 d-flex">
                <div id="ma" class="bg-white">
                    <p>{{ $contact -> description }}</p>
                </div>

            </div>




        </div>
      </div>
        @endforeach
    </section>


  @endsection
