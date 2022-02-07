@extends('layouts.main', ['activePage' => 'products', 'titlePage' => 'Nuevo producto'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.products.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">Producto</h4>
                                <p class="card-category">Ingresar datos</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="name" placeholder="Ingresa el nombre del producto" value="{{ old('name') }}" autofocus>
                                        @if ($errors->has('name'))
                                            <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="description" class="col-sm-2 col-form-label">Descripción del producto</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="description" placeholder="Ingresa la descripción del producto" value="{{ old('description') }}">
                                        @if ($errors->has('description'))
                                            <span class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="price" class="col-sm-2 col-form-label">Precio</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" name="price" placeholder="Ingresa el precio" value="{{ old('price') }}">
                                        @if ($errors->has('price'))
                                            <span class="error text-danger" for="input-price">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="categories" class="col-sm-2 col-form-label">Categorías</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="category_id" aria-label="Default select example">
                                            <option value="">Escoge la categoría </option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                {{-- <p>{{ $category->name }}</p> --}}
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category'))
                                            <span class="error text-danger" for="input-category">{{ $errors->first('category') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="image" class="col-sm-2 col-form-label">Imagen</label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                        @if ($errors->has('description'))
                                            <span class="error text-danger" for="input-image">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-success mr-3"> Volver </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection