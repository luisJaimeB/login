@extends('layouts.main', ['activePage' => 'product-management', 'titlePage' => 'Detalles de Factura'])
@section('content')
    <div class="content">
        <div class="content-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="card-title">@lang('products.titles.products')</div>
                            <p class="card-category">@lang('products.titles.detailProd')<strong> {{ $invoice->number }}</strong></p>
                        </div>

                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-4">
                                    <div class="card text-center card-user">
                                        <div class="card-header">
                                          <h2><strong>@lang('invoices.' . $invoice->invoice_status)</strong></h2>
                                        </div>
                                        <div class="card-body">
                                          <h5 class="card-title">{{ $invoice->number }}</h5>
                                          <div class="card-text">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>@lang('products.fields.name.label')</th>
                                                        <th>@lang('products.fields.quantity.label')</th>
                                                        <th>@lang('products.fields.price.label')</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($invoice->products as $product)
                                                        <tr>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->pivot->quantity }}</td>
                                                            <td>{{ $product->pivot->price }}</td>
                                                            <td>{{ $product->pivot->subtotal }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <p><strong>{{ $invoice->total }}</strong></p>  
                                          </div>
                                          <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                        <div class="card-footer text-muted">
                                          {{ $invoice->created_at }}
                                        </div>
                                      </div>
                                    {{-- <div class="card card-user">
                                        <div class="card-body">
                                            @if (session('success'))
                                                <div class="alert alert-success" role="success">
                                                    {{ session('success') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>    
                                            @endif
                                            <p><h3><span class="badge badge-secondary">{{ $invoice->invoice_status }}</span></h3></p>
                                            {{-- <p class="card-text">
                                                <div class="author">
                                                    <a href="#" class="">
                                                        <h5 class="title mx-3">{{ $product->number }}</h5>
                                                        <img class="card-img-top" src="{{ $product->image->path_url }}" alt="Card image cap">
                                                    </a> 
                                                    <p class="description">
                                                        <h3>{{ $invoice->number }}</h3><br>
                                                        <div class="row">     
                                                            
                                                        </div> 
                                                        <label for="description">@lang('products.fields.description.label')</label><br>
                                                        <p>{{ $invoice->total }}</p><br>          
                                                    </p>
                                                </div>
                                            </p>                                         
                                        </div>
                                        <div class="card-footer d-flex justify-content-center">
                                            <div class="button-container">
                                                <a href="{{ route('products.index') }}" class="btn btn-sm btn-success mr-3">@lang('common.return')</a>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection