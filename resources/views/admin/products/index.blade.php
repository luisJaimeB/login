@extends('layouts.main', ['activePage' => 'product-management', 'titlePage' => 'Productos'])
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
                                <div class="card-body bg-light">
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
                                            @can('admin.products.create')
                                            <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">Crear Producto</a>
                                            @endcan
                                        </div>
                                    </div>
                                    @foreach ($products->chunk(3) as $chunk)
                                        <div class="row justify-content-center">
                                            @foreach ($chunk as $product)
                                                <div class="card mr-5" style="width: 25rem;">
                                                    <img class="card-img-top" src="{{ route('images.show', ['image' => $product->image->path]) }}" alt="Card image cap" width="350">
                                                    <div class="card-body">
                                                        <p class="card-text">{{$product->name}}</p>
                                                        <p class="card-text">{{$product->description}}</p>
                                                        <p class="card-text"><strong>$ {{$product->price}}</strong></p>
                                                        <p><span class="badge badge-info">{{ $product->category->name }}</span></p>
                                                        <div class="row">
                                                            <div class="col-9 jutify-content-right">
                                                                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info">
                                                                    <i class="material-icons">person</i>
                                                                </a>
                                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                                                                    <i class="material-icons">edit</i>
                                                                </a>
                                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Estás seguro? se eliminará el producto')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-danger" type="submit" rel="tooltip">
                                                                        <i class="material-icons">close</i>
                                                                    </button>
                                                                </form>
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