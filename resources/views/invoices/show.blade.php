@extends('layouts.main', ['activePage' => 'invoices', 'titlePage' => 'Detalles de Factura'])
@section('content')
    <div class="content">
        <div class="content-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="card-title">@lang('products.titles.products')</div>
                            <p class="card-category">@lang('products.titles.detailProd')<strong> {{ $invoice->reference }}</strong></p>
                        </div>
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-4">
                                    <div class="card text-center card-user">
                                        <div class="card-header bg-info">
                                            <h2><strong>@lang('invoices.' . $invoice->invoice_status)</strong></h2>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title table-active">@lang('invoices.titles.nInvoice')<strong>{{ $invoice->reference }}</strong></h5>
                                            <div class="card-text">
                                                {{-- first table, purchase data --}}
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>@lang('products.fields.name.label')</th>
                                                            <th>@lang('products.fields.quantity.label')</th>
                                                            <th>@lang('products.fields.price.label')</th>
                                                            <th>@lang('common.subtotal')</th>
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
                                                    <tfoot>
                                                        <tr class="table-active">
                                                            <td colspan="3">@lang('common.total')</td>
                                                            <td><strong>{{ $invoice->total }}</strong></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                {{-- second table, payment data --}}
                                                <h3 class="table-light">Datos del pago</h3>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr class="table-active">
                                                            <th>@lang('invoices.titles.issuerName')</th>
                                                            <th>@lang('invoices.titles.PayMethod')</th>
                                                            <th>@lang('invoices.titles.PaymentDate')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $invoice->issuer_name }}</td>
                                                            <td>{{ $invoice->payment_method_name }}</td>
                                                            <td>{{ $invoice->date }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3  mr-3">
                                                    <a href="{{ route('invoices.index') }}" class="btn btn-success">@lang('common.return')</a>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        @if ($invoice->isPending())
                                                            <a href="{{ route('payments.verify', ['reference' => $invoice->reference]) }}" class="btn btn-warning ml-5 mr-3">@lang('common.verify')</a>
                                                        @endif
                                                        @if ($invoice->couldPay())
                                                            <a href="{{ route('payments.retry', ['reference' => $invoice->reference]) }}" class="btn btn-primary">@lang('common.pay')</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-muted text-center">
                                            <p><strong>{{ $invoice->created_at }}</strong></p>
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