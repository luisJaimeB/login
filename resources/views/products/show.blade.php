@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="card-title">@lang('products.titles.products')</div>
                            <p class="card-category">@lang('products.titles.detailProd')<strong> {{ $product->name }}</strong></p>
                        </div>

                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-10">
                                    {{-- CardNueva --}}
                                    <div class="card mb-3">
                                        <div class="row g-0">
                                          <div class="col-md-6">
                                            @empty($product->image)
                                                <img class="card-img-top" src="{{ asset('img/default.jpg') }}" alt="Card image cap">
                                                @else
                                                    <img class="card-img-top" src="{{ $product->image->path_url }}" alt="Card image cap">
                                            @endempty
                                          </div>
                                          <div class="col-md-6">
                                            <div class="card-body">
                                              <h5 class="card-title"><strong>{{ $product->name }}</strong></h5>
                                              <p class="card-text">{{ $product->description }}</p>
                                              <p class="card-text">
                                                <small class="text-muted">
                                                    <h4><span class="badge rounded-pill bg-secondary text-white">{{ $product->category->name }}</span></h4>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">$</span>
                                                        <span>{{ $product->price }}</span>
                                                    </div>
                                                </small>
                                              </p>
                                            </div>
                                            <div class="card-footer d-flex justify-content-center">
                                                <div class="button-container">
                                                    <form id="add-cart-{{ $product->id }}" action="{{ route('cart.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                                        @if ($product->quantity > 0)
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="number" class="form-control" name="quantity" value="1" min="1" max="{{ $product->quantity }}">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <p class="text-muted">
                                                                    ( {{ $product->quantity }} @lang('products.messages.maxProductBuy'))
                                                                </p>
                                                            </div>
                                                        </div>
                                                        
                                                        @else
                                                            <span class="badge badge-danger">@lang('products.titles.Outstock')</span>
                                                        @endif
                                                    </form>
                                                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-success mr-3">@lang('common.return')</a>
                                                    @if ($product->quantity > 0)
                                                        <button type="button" type="submit" form="add-cart-{{ $product->id }}" class="btn btn-sm btn-primary">@lang('common.addtocart')</button>
                                                    @endif
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
        </div>
    </div>
@endsection