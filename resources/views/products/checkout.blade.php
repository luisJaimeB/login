@extends('layouts.app')

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
                                @if (session('error'))
                                        <div class="alert alert-danger" role="success">
                                            {{ session('error') }}
                                            {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button> --}}
                                        </div>    
                                    @endif
                                <hr>
                                <div class="row checkout-form">
                                    <form action="{{ route('payments.store') }}" id="data-form" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="">@lang('users.fields.firstName.label')</label>
                                                <input type="text" class="form-control" value="{{ old('name', Auth::user()->name) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="">@lang('users.fields.lastName.label')</label>
                                                <input type="text" class="form-control" value="{{ old('name', Auth::user()->last_name) }}" placeholder="@lang('users.fields.lastName.placeholder')" name="last_name">
                                                @if ($errors->has('last_name'))
                                                @endif
                                            </div>    
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mt-3">
                                                <label class="form-label" for="">DocType</label>
                                                <select class="form-control" name="type_document_id">
                                                    <option value="" selected disabled>Select</option>
                                                    @foreach ($documentTypes as $documentType)
                                                        <option value="{{ $documentType->id }}">{{ $documentType->type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label class="form-label" for="">Número de doc</label>
                                                <input type="text" class="form-control" value="{{ old('name', Auth::user()->identification_number) }}" placeholder="Número de documento" name="identification_number">
                                                @if ($errors->has('identification_number'))
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mt-3">
                                                <label class="form-label" for="">@lang('users.fields.email.label')</label>
                                                <input type="text" class="form-control" value="{{ old('email', Auth::user()->email) }}">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label class="form-label" for="">@lang('users.fields.phoneNumber.label')</label>
                                                <input type="text" class="form-control" name="mobile_number" value="{{ old('name', Auth::user()->mobile_number) }}" placeholder="@lang('users.fields.phoneNumber.placeholder')">
                                                @if ($errors->has('mobile_number'))
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mt-3">
                                                <label class="form-label" for="">@lang('users.fields.address.label')</label>
                                                <input type="text" class="form-control" name="address" value="{{ old('email', Auth::user()->address) }}" placeholder="@lang('users.fields.address.placeholder')">
                                                @if ($errors->has('address'))
                                                @endif
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label class="form-label" for="">@lang('users.fields.postalCode.label')</label>
                                                <input type="text" class="form-control" name="postal_code" value="{{ old('email', Auth::user()->postal_code) }}" placeholder="@lang('users.fields.postalCode.placeholder')">
                                                @if ($errors->has('postal_code'))
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer justify-content-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn float-end" form="data-form" style="background-color: rgb(226, 126, 11)">PlaceToPay</button>
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
                                            <th scope="col">@lang('products.titles.products')</th>
                                            <th scope="col">@lang('products.fields.quantity.label')</th>
                                            <th scope="col">@lang('products.fields.price.label')</th>
                                            <th scope="col">@lang('common.subtotal')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::content() as $item)
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>${{ $item->price }}</td>
                                                <td>{{ $item->qty * $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="row">@lang('common.total')</th>
                                            <td colspan="4">{{ Cart::subtotal() }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
