@extends('layouts.main', ['activePage' => 'product-management', 'titlePage' => 'Reportes'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <div class="card-title"><strong>@lang('common.reports')</strong></div>
                                    <div class="card-category">@lang('products.titles.prod_loaded')</div>
                                </div>
                                <div class="card-body bg-light">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="success">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>    
                                    @endif
                                        <query-filter-invoices-reports></query-filter-invoices-reports>
                                    {{-- <div class="card mb-3">
                                        <div class="row d-flex justify-content-center">
                                          <div class="col-8">
                                            <div class="card-body d-flex justify-content-center">
                                              <h5 class="card-title"></h5>
                                              <p class="card-text">
                                                <date-picker-input></date-picker-input>
                                              </p>
                                            </div>
                                            <div class="card-footer d-flex justify-content-center">
                                                <div class="text-right">
                                                    <a href="{{ route('admin.export.products') }}" class="btn btn-sm btn-info">  <i class="fas fa-file-pdf fa-lg"></i>  </a>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div> --}}
                                    
                                    <div class="card-footer mr-auto pagination justify-content-center">
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