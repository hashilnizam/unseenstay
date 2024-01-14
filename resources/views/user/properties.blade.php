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
                     @foreach($properties as $property)
                         <div class="col-sm col-md-6 col-lg-4 ftco-animate">
                             <div class="room">
                                 <a href="{{ route('rooms_single', ['id' => $property->id]) }}" class="img d-flex justify-content-center align-items-center" style="background-image: url({{ asset('images/' . $property->image) }});">
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
