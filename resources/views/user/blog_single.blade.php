@extends('user.common.app')
@section('content')

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            @foreach($blogs as $blog)
            <div class="row">
                <div class="col-lg-8 ftco-animate order-md-last">
                    <h2 class="mb-3">{{$blog->heading}}</h2>
                    <p>{{$blog->description}}</p>
                    <p>
                        <img src="{{ asset('images/' . $blog->image) }}" alt="Web design example" class="img-fluid">

                    </p>

                    <div class="pt-5 mt-5">
                        <!-- Comment section or other content -->
                        <div class="comment-form-wrap pt-5">
                            <!-- Include your comment form here -->
                        </div>
                    </div>
                    @endforeach
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
                        <!-- Consider using a loop for dynamic recent blog posts -->
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                            </div>
                        </div>
                        <!-- Repeat similar blocks for other recent blog posts -->
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3>Paragraph</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
