@extends('user.common.app')
@section('content')

    <div class="hero-wrap" style="background-image: url('/user/images/bg_1.jpg');">
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
    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate order-md-last">
                    <h2 class="mb-3">{{$blog->heading}}</h2>
                    <p>{{$blog->description}}</p>
                    <p>
                        <img src="{{ asset('images/' . $blog->image) }}" alt="Web design example" class="img-fluid" style="width: 600px; height: 500px;">

                    </p>

                    <div class="pt-5 mt-5">
                        <!-- Comment section or other content -->
                        <div class="comment-form-wrap pt-5">
                            <!-- Include your comment form here -->
                        </div>
                    </div>

                </div> <!-- .col-md-8 -->

                <div class="col-lg-4 sidebar ftco-animate">
                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Categories</h3>
                            <li><a href="{{ route('unseen.properties') }}">Resort <span></span></a></li>
                            <li><a href="{{ route('unseen.properties') }}">Homestay <span></span></a></li>
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3>Recent Blog</h3>

                            <div class="sidebar-box ftco-animate">
                                @foreach($blogs->take(5) as $blog)
                                    <!-- Consider using a loop for dynamic recent blog posts -->
                                    <div class="block-21 mb-4 d-flex">
                                        <a class="blog-img mr-4" style="background-image: url({{ asset('images/' . $blog->image) }});"></a>
                                        <div class="text">
                                            <h3 class="heading"><a href="{{ route('blog_single',['id' => $blog->id]) }}">{{ $blog->heading }}</a></h3>
                                            <div class="meta">
                                                <div><a><span class="icon-calendar"></span>{{ $blog->created_at->format('M d, Y') }}</a></div>
                                                <div><a><span class="icon-person"></span> Admin</a></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        <!-- Repeat similar blocks for other recent blog posts -->
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
