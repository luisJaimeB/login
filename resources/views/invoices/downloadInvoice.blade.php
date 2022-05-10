@extends('layouts.print')
@section('content')
    <div class="content">
        <div class="content-fluid">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">@lang('invoices.titles.invoices')</div>
                        <div class="panel-body">
                            {{-- @foreach ($invoices->chunk(2) as $chunk)
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    @foreach ($chunk as $invoice)
                                        <div class="panel panel-info">
                                            <!-- Default panel contents -->
                                            <div class="panel-heading">
                                                <h3 class="fw-bold text-center">@lang('invoices.titles.nInvoice')</h3>
                                                <strong><p class="card-text text-center">{{ $invoice->reference }}</p></strong>
                                            </div>
                                            <div class="panel-body">
                                                <!-- Table -->
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
                                                                <td class="text-center">{{ $product->pivot->quantity }}</td>
                                                                <td>{{ $product->pivot->price }}</td>
                                                                <td>{{ $product->pivot->subtotal }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="panel-footer">
                                                <br>
                                                    <div class="row table-active">
                                                        <div class="col-md-6">
                                                            <h4 class="fw-bold text-center">@lang('common.total')</h4>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong><p class="fw-bold">{{ $invoice->total }}</p></strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h4 class="fw-bold text-center">@lang('common.date')</h4>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="fw-bold">{{ $invoice->created_at }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row table-active">
                                                        <div class="col-md-6">
                                                            <h4 class="fw-bold text-center">@lang('common.status')</h4>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4><span class="label label-success">{{ $invoice->invoice_status }}</span></h4>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach --}}    
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
