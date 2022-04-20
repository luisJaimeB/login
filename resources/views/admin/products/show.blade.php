@extends('layouts.main', ['activePage' => 'product-management', 'titlePage' => 'Detalles de Producto'])
@section('content')
    <div class="content">
        <div class="content-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="card-title">@lang('products.titles.products')</div>
                            <p class="card-category">@lang('products.titles.detailProd')<strong>{{ $product->name }}</strong></p>
                        </div>

                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-4">
                                    <div class="card card-user">
                                        <div class="card-body">
                                            @if (session('success'))
                                                <div class="alert alert-success" role="success">
                                                    {{ session('success') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>    
                                            @endif
                                            <p class="card-text">
                                                <div class="author">
                                                    <a href="#" class="">
                                                        <h5 class="title mx-3">{{ $product->name }}</h5>
                                                        @empty($product->image)
                                                            <img class="card-img-top" src="{{ asset('img/default.jpg') }}" alt="Card image cap">
                                                            @else
                                                            <img class="card-img-top" src="{{ $product->image->path_url }}" alt="Card image cap">
                                                        @endempty
                                                    </a>
                                                    <p class="description">
                                                        <h3>{{ $product->name }}</h3><br>
                                                        <div class="row">     
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead class="text-primary text-center">
                                                                        <th>@lang('products.fields.categories.th')</th>
                                                                        <th>@lang('products.fields.quantity.label')</th>
                                                                        <th>@lang('products.fields.publicationDate')</th>
                                                                    </thead>
                                                                    <tbody class="text-primary text-center">
                                                                            <tr>
                                                                                <td><h3><span class="badge rounded-pill bg-success text-white">{{ $product->category->name }}</span></h3></td>
                                                                                <td>
                                                                                    <h3>
                                                                                        @if ($product->quantity > 0)
                                                                                            <span class="badge badge-primary">{{ $product->quantity }}</span>
                                                                                        @else
                                                                                            <span class="badge badge-danger">{{ $product->quantity }}</span>
                                                                                        @endif
                                                                                    </h3>
                                                                                </td>
                                                                                <td><h3><span class="badge rounded-pill bg-info text-white">{{ $product->created_at->format('Y/m/d') }}</span></h3></td>
                                                                            </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div> 
                                                        <label for="description">@lang('products.fields.description.label')</label><br>
                                                        <p>{{ $product->description }}</p><br>          
                                                    </p>
                                                </div>
                                            </p>                                          
                                        </div>
                                        <div class="card-footer d-flex justify-content-center">
                                            <div class="button-container">
                                                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-success mr-3">@lang('common.return')</a>
                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary mr-3">@lang('common.edit')</a>
                                            </div>
                                        </div>
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