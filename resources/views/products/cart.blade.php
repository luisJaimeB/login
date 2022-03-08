@extends('layouts.main', ['activePage' => 'products', 'titlePage' => 'check de Productos'])
@section('content')
<div class="content">
    <div class="content-fluid">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="card-title"><strong>@lang('products.titles.orderDetails')</strong></div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::content() as $item)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ $item->name }}</td>
                                            {{-- <td><img class="rounded mx-auto" src="{{ $item->image->path_url }}" alt="Card image cap" width="304"></td> --}}
                                            <td><input type="number" class="form-control col-sm-2" name="quantity" value="{{ $item->quantity }}"></td>
                                            <td>${{ $item->price }}</td>
                                            <td>{{ $item->quantity * $item->price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="row">Total</th>
                                        <td colspan="4">{{ Cart::subtotal() }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-footer justify-content-center">
                            
                            <div class="btn-group">
                                <button type="submit" form="buy" class="btn btn-primary mx-3">
                                    <em class="fas fa-money-bill"></em> @lang('products.titles.placeOrder')
                                </button>
                                <form id="empty-cart" action="{{ route('cart.destroy') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="submit" form="empty-cart" class="btn btn-danger">
                                    <em class="fas fa-trash"></em> @lang('common.emptyCart')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection