@extends('layouts.app')
@section('content')
<!-- Header-->
<header class="bg-withe">
    <div class="container px-lg-5 my-5">
        <div class="text-center text-white">
            <img src="{{ asset('img/banner.png') }}" alt="" width="100%">
            {{-- <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">No lo encontrarás por un precio mejor</p> --}}
        </div>
    </div>
</header>
<div class="container px-4 px-lg-5 mt-5">
    @foreach ($products->chunk(4) as $chunk)
        <div class="row">
            @foreach ($chunk as $product)
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="card mb-4">
                    <img class="card-img-top" src="{{ $product->image->path_url }}" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">{{$product->name}}</p>
                        <p class="card-text">{{ $product->preview_description }}</p>
                        <p class="card-text"><strong>$ {{$product->price}}</strong></p>
                        <p><span class="badge badge-info">{{ $product->category->name }}</span></p>
                        <p>
                            @if ($product->quantity > 0)
                                <span class="badge badge-success">@lang('products.titles.Instock')</span>
                            @else
                                <span class="badge badge-danger">@lang('products.titles.Outstock')</span>
                            @endif
                        </p>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-info mx-2">
                            <i class="far fa-eye"></i> @lang('common.see')
                        </a>
                        @if ($product->quantity > 0)
                            <add-product-button :product-id='{{ $product->id }}'></add-product-button>
                        @endif
                    </div>
                </div> 
            </div>
            @endforeach
        </div>
    @endforeach
    <div class="card-footer mr-auto pagination justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection
{{-- <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Mercatodo</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Mercatodo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            @lang('common.cart')
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                    @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">No lo encontrarás por un precio mejor</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                @foreach ($products->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $product)
                        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="card mb-4">
                                <img class="card-img-top" src="{{ $product->image->path_url }}" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">{{$product->name}}</p>
                                    <p class="card-text">{{ $product->preview_description }}</p>
                                    <p class="card-text"><strong>$ {{$product->price}}</strong></p>
                                    <p><span class="badge badge-info">{{ $product->category->name }}</span></p>
                                    <p>
                                        @if ($product->quantity > 0)
                                            <span class="badge badge-success">@lang('products.titles.Instock')</span>
                                        @else
                                            <span class="badge badge-danger">@lang('products.titles.Outstock')</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info mx-2">
                                        <i class="far fa-eye"></i> @lang('common.see')
                                    </a>
                                    @if ($product->quantity > 0)
                                        <form id="add-cart-{{ $product->id }}" action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                        </form>
                                        <button type="submit" class="btn btn-sm btn-primary" form="add-cart-{{ $product->id }}">
                                            <em class="fas fa-cart-plus"></em> @lang('common.addtocart')
                                        </button>
                                    @endif
                                </div>
                            </div> 
                        </div>
                        @endforeach
                    </div>
                @endforeach
                <div class="card-footer mr-auto pagination justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
 --}}