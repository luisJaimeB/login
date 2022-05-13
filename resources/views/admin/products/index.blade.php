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
                                    <div class="card-category">@lang('products.titles.prod_loaded')</div>
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
                                        <div class="col-md-7">
                                            <a href="{{ route('admin.imports.index') }}" class="btn btn-sm btn-success">@lang('common.imports')</a>
                                        </div>
                                        <div class="col-md-5">
                                            <a href="{{ route('admin.report.products.create') }}" class="btn btn-sm btn-info">@lang('common.reports') <i class="fas fa-file-pdf"></i></a>
                                            <a href="{{ route('admin.export.products') }}" class="btn btn-sm btn-warning">@lang('common.export') <i class="fas fa-file-export"></i></a>
                                            <a href="{{ route('admin.import.products.create') }}" class="btn btn-sm btn-success">@lang('common.import') <i class="fas fa-file-import"></i></a>
                                            @can('admin.products.create')
                                            <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">@lang('products.productsCreate') <i class="fas fa-plus"></i></a>
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
                                                <th>@lang('common.status')</th>
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
                                                        @empty($product->image)
                                                            <td class="w-25"><img class="rounded mx-auto w-50" src="{{ asset('img/default.jpg') }}" alt="Card image cap" width="304"></td>    
                                                            @else
                                                                <td class="w-25"><img class="rounded mx-auto w-50" src="{{ $product->image->path_url }}" alt="Card image cap" width="304"></td>        
                                                        @endempty
                                                        
                                                            @if ($product->status == 1)
                                                                <td>
                                                                    <a href="{{ route('admin.products.change.status', $product->id) }}" class="badge badge-info">
                                                                        <span>@lang('users.fields.status.active')</span>    
                                                                    </a>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <a href="{{ route('admin.products.change.status', $product->id) }}" class="badge badge-danger">
                                                                        <span>@lang('users.fields.status.Inactive')</span>
                                                                    </a>  
                                                                </td>
                                                            @endif
                                                        <td class="td-actions text-right">
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
                                                                    <i class="material-icons">close</i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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