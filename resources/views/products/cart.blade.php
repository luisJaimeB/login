@extends('layouts.app', ['activePage' => 'products', 'titlePage' => 'check de Productos'])

@section('content')
    <div class="content">
        <div class="content-fluid">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12 py-5">
                        <cart :content='@json(Cart::content())'></cart>
                    </div>
                </div>
            </div>
        </div>
    </div>  
@endsection