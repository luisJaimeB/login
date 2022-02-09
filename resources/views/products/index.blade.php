@extends('layouts.main', ['activePage' => 'products', 'titlePage' => 'Productos'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <div class="card-title"><strong>Productos</strong></div>
                                    <div class="card-category">Productos en Stock</div>
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
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            @can('products.create')
                                            <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">Crear Producto</a>
                                            @endcan
                                        </div>
                                    </div>
                                    @foreach ($products->chunk(3) as $chunk)
                                        <div class="row justify-content-center">
                                            @foreach ($chunk as $product)
                                                <div class="card mr-5" style="width: 25rem;">
                                                    <img class="card-img-top" src="{{ route('images.show', ['image' => $product->image->path]) }}" alt="Card image cap">
                                                    <div class="card-body">
                                                        <p class="card-text">{{$product->name}}</p>
                                                        <p class="card-text">{{$product->description}}</p>
                                                        <p class="card-text"><strong>$ {{$product->price}}</strong></p>
                                                        <p><span class="badge badge-info">{{ $product->category->name }}</span></p>
                                                        <div class="row">
                                                            <div class="col-6 jutify-content-right">
                                                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">
                                                                    <i class="far fa-eye"></i>
                                                                </a>
                                                                <a href="#" class="btn btn-success">
                                                                    <i class="fas fa-cart-plus"></i>
                                                                </a>
                                                            </div>
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