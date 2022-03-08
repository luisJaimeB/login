@extends('layouts.main', ['activePage' => 'products', 'titlePage' => 'check de Productos'])
@section('content')
<div class="content">
    <div class="content-fluid">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="card-title"><strong>@lang('products.titles.basicDetails')</strong></div>
                        </div>
                        <div class="card-body">
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label class="form-label" for="">First Name</label>
                                    <input type="text" class="form-control" placeholder="Enter First Name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Last Name">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label" for="">Email</label>
                                    <input type="text" class="form-control" placeholder="Enter Email">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label" for="">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone Number">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label" for="">Address 1</label>
                                    <input type="text" class="form-control" placeholder="Enter Address 1">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label" for="">Address 2</label>
                                    <input type="text" class="form-control" placeholder="Enter Address 2">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label" for="">City</label>
                                    <input type="text" class="form-control" placeholder="Enter City">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label" for="">State</label>
                                    <input type="text" class="form-control" placeholder="Enter State">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label" for="">Country</label>
                                    <input type="text" class="form-control" placeholder="Enter Country">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label" for="">Pin Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Pin Code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
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
                                            <td>{{ $item->quantity }}</td>
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
                            <hr>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary float-end">@lang('products.titles.placeOrder')</button>
                            </div>                            
                            <!-- Set up a container element for the button -->
                            <div id="paypal-button-container"></div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection
@section('scripts')

@endsection