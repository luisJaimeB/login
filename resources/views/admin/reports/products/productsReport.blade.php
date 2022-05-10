@extends('layouts.print')
@section('content')
    <div class="content">
        <div class="content-fluid">
            <br>
            <div class="row mt-2">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col">
                                <div class="panel panel-info">
                                    <!-- Default panel contents -->
                                    <div class="panel-heading">
                                        <h3 class="fw-bold text-center">@lang('products.titles.prod_loaded')</h3>
                                    </div>
                                    <div class="panel-body">
                                        <!-- Table -->
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="text-center">
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">@lang('products.fields.name.label')</th>
                                                    <th class="text-center">@lang('products.fields.description.label')</th>
                                                    <th class="text-center">@lang('products.fields.price.label')</th>
                                                    <th class="text-center">@lang('products.fields.categories.th')</th>
                                                    <th class="text-center">@lang('products.fields.quantity.label')</th>
                                                    <th class="text-center">@lang('common.status')</th>
                                                </thead>
                                                <tbody class="text-center">
                                                    @foreach ($products as $product)
                                                        <tr>
                                                            <td>{{ $product->id}}</td>
                                                            <td>{{ $product->name}}</td>
                                                            <td style="width:300px;">{{ Str::limit($product->description, 35, '...') }}</td>
                                                            <td><strong>&#36; </strong>{{ $product->price}}</td>
                                                            <td>{{ $product->category->name}}</td>
                                                            <td>{{ $product->quantity}}</td>
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
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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