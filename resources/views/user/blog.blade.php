@extends('user.common.app')
@section('content')

    <div class="hero-wrap" style="background-image: url('user/images/bg_1.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
                <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                    <div class="text">
                        <p class="breadcrumbs mb-2"><span class="mr-2"><a
                                    href="{{ route('unseen.index') }}">Home</a></span> <span>Blog</span></p>
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
                            <a href="{{ route('blog_single',['id' => $blog->id]) }}" class="block-20">
                                <img src="{{ asset('images/' . $blog->image) }}" class="img-fluid"
                                     alt="{{ $blog->heading }}" style="width: 300px; height: 300px;">
                            </a>
                            <div class="text mt-3 d-block">
                                <h3 class="heading mt-3"><a
                                        href="{{ route('blog_single',['id' => $blog->id]) }}">{{ $blog->heading }}</a>
                                </h3>
                                <div class="meta mb-3">
                                    <div>
                                        <a href="{{ route('blog_single',['id' => $blog->id]) }}">{{ $blog->created_at->format('M d, Y') }}</a>
                                    </div>
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

@endsection
