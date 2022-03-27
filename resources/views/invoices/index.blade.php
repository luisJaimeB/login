@extends('layouts.main', ['activePage' => 'invoices', 'titlePage' => 'Facturas'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <div class="card-title"><h3><strong>@lang('invoices.titles.invoices')</strong></h3></div>
                                    <div class="card-category"><h4>@lang('invoices.titles.purchasehistory')</h4></div>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="success">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>    
                                    @endif
                                    @foreach ($invoices->chunk(4) as $chunk)
                                        <div class="row justify-content-center">
                                            @foreach ($chunk as $invoice)
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                                                <div class="card mr-2">
                                                    <div class="card-body">
                                                        <div>
                                                            <h3 class="fw-bold text-center">@lang('invoices.titles.nInvoice')</h3>
                                                            <strong><p class="card-text text-center">{{ $invoice->reference }}</p></strong>
                                                        </div>
                                                        <br>
                                                        <div class="row table-active">
                                                            <div class="col-md-6">
                                                                <h4 class="fw-bold text-center">@lang('common.total')</h4>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong><p class="card-text fw-bold">{{ $invoice->total }}</p></strong>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h4 class="fw-bold text-center">@lang('common.date')</h4>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="card-text fw-bold">{{ $invoice->created_at }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row table-active">
                                                            <div class="col-md-6">
                                                                <h4 class="fw-bold text-center">@lang('common.status')</h4>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h4><span class="badge badge-warning">{{ $invoice->invoice_status }}</span></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer d-flex justify-content-end">
                                                            <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-sm btn-info mx-2">
                                                                <i class="far fa-eye"></i> Ver
                                                            </a>
                                                            {{-- 
                                                            @if ($product->quantity > 0)
                                                            <form id="add-cart-{{ $product->id }}" action="{{ route('cart.store') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                            </form>
                                                            <button type="submit" class="btn btn-sm btn-primary" form="add-cart-{{ $product->id }}">
                                                                <em class="fas fa-cart-plus"></em> Comprar
                                                            </button>
                                                            @endif --}}
                                                    </div>
                                                </div> 
                                            </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    <div class="card-footer mr-auto pagination justify-content-center">
                                        {{ $invoices->links() }}
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