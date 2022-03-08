@extends('layouts.main', ['activePage' => 'products', 'titlePage' => 'Productos'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            {{-- <product-index :products='@json($products)'></product-index> --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <div class="card-title"><strong>@lang('products.titles.products')</strong></div>
                                    <div class="card-category">@lang('products.titles.stock')</div>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="success">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>    
                                    @endif
                                    @foreach ($products->chunk(3) as $chunk)
                                        <div class="row justify-content-center">
                                            @foreach ($chunk as $product)
                                                <div class="card mr-5" style="width: 25rem;">
                                                    <img class="card-img-top" src="{{ $product->image->path_url }}" alt="Card image cap">
                                                    <div class="card-body">
                                                        <p class="card-text">{{$product->name}}</p>
                                                        <p class="card-text">{{$product->description}}</p>
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
                                                        <div class="col-6 d-flex justify-content-end">
                                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info mx-2">
                                                                <i class="far fa-eye"></i> Ver
                                                            </a>
                                                            @if ($product->quantity > 0)
                                                            <form id="add-cart-{{ $product->id }}" action="{{ route('cart.store') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="name" value="{{ $product->name }}">
                                                            </form>
                                                            <button type="submit" class="btn btn-primary" form="add-cart-{{ $product->id }}">
                                                                <em class="fas fa-cart-plus"></em> Comprar
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection