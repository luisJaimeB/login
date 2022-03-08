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
                                    <div class="card-title"><strong>@lang('products.titles.products')</strong></div>
                                    <div class="card-category">@lang('products.titles.stock')</div>
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
                                            <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">@lang('products.productsCreate')</a>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary text-center">
                                                <th>ID</th>
                                                <th>@lang('products.fields.name.label')</th>
                                                <th>@lang('products.fields.description.label')</th>
                                                <th>@lang('products.fields.price.label')</th>
                                                <th>@lang('products.fields.categories.th')</th>
                                                <th>@lang('products.fields.quantity.label')</th>
                                                <th>@lang('products.fields.image')</th>
                                                <th class="text-right">@lang('common.actions')</th>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{ $product->id}}</td>
                                                        <td>{{ $product->name}}</td>
                                                        <td style="width:300px;">{{ $product->description}}</td>
                                                        <td><strong>&#36; </strong>{{ $product->price}}</td>
                                                        <td>{{ $product->category->name}}</td>
                                                        <td>{{ $product->quantity}}</td>
                                                        <td><img class="rounded mx-auto" src="{{ $product->image->path_url }}" alt="Card image cap" width="304"></td>
                                                        <td class="td-actions text-right">
                                                            {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal" @click="detail">
                                                                <i class="material-icons">person</i>
                                                            </button> --}}
                                                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info">
                                                                <i class="material-icons">person</i>
                                                            </a>
                                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                                                                <i class="material-icons">edit</i>
                                                            </a>
                                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('@lang('users.messages.comfirmDeluser')')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" type="submit" rel="tooltip">
                                                                    <i class="material-icons">close</i>{{--  --}}
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- @foreach ($products->chunk(3) as $chunk)
                                        <div class="row justify-content-center">
                                            @foreach ($chunk as $product)
                                                <div class="card mr-5" style="width: 25rem;">
                                                    <img class="card-img-top" src="{{ $product->image->path_url }}" alt="Card image cap" width="350">
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
                                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('@lang('products.messages.comfirmDelProduct')')">
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
                                    @endforeach --}}
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