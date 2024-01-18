@extends('user.common.app')
@section('content')




   <div class="hero-wrap" style="background-image: url('user/images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          	<div class="text">
	            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>Blog</span></p>
	            <h1 class="mb-4 bread">Blog</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
        <div class="row d-flex">
            @foreach($blogs as $blog)
          <div class="col-md-3 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="{{ route('blog_single') }}" class="block-20" style="background-image: url({{ asset('images/' . $blog->image) }});">
              </a>
              <div class="text mt-3 d-block">
                <h3 class="heading mt-3"><a href="{{ route('blog_single') }}">{{ $blog->description }}</a></h3>
                <div class="meta mb-3">
                  <div><a href="{{ route('blog_single') }}">Dec 6, 2018</a></div>
                  <div><a href="{{ route('blog_single') }}">Admin</a></div>
                  <div><a href="{{ route('blog_single') }}" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
              </div>
            </div>
          </div>
            @endforeach
        </div>
      </div>
    </section>

@endsection
