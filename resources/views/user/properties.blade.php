@extends('user.common.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="hero-wrap" style="background-image: url('user/images/bg_1.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
                <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                    <div class="text">
                        <div class="text">
                            <p class="breadcrumbs mb-2"><span class="mr-2"><a
                                        href="{{ route('unseen.index') }}">Home</a></span> <span>Properties</span></p>
                            <h1 class="mb-4 bread">Properties</h1>
                        </div>
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
                                    <a href="{{ route('rooms_single', ['id' => $property->id]) }}"
                                       class="img d-flex justify-content-center align-items-center"
                                       style="background-image: url({{ asset('images/' . $property->image1) }});">
                                        <div class="icon d-flex justify-content-center align-items-center">
                                            <span class="icon-search2"></span>
                                        </div>
                                    </a>
                                    <div class="text p-3 text-center">
                                        <h3 class="mb-3"><a
                                                href="{{ route('rooms_single', ['id' => $property->id]) }}">{{ $property->name }}</a>
                                        </h3>
                                        <ul class="list">
                                            <li><span><i
                                                        class="fa-solid fa-house"></i></span> {{ $property->property_types->property_type }}
                                            </li>
                                            <li><span><i
                                                        class="fas fa-map-marker-alt"></i></span> {{ $property->location }}
                                            </li>
                                        </ul>
                                        <hr>
                                        <p class="pt-1">
                                            <a href="{{ route('rooms_single', ['id' => $property->id]) }}"
                                               class="btn-custom">
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

@endsection

