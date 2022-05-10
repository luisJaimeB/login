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
                                        <query-filter-products-reports></query-filter-products-reports>                                    
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