@extends('layouts.main', ['activePage' => 'product-management', 'titlePage' => 'Importar productos'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.import.products.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">@lang('products.titles.products')</h4>
                                <p class="card-category">@lang('products.titles.prod_import')</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if (isset($errors) && $errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>    
                                    @endif
                                    <label for="import_file" class="col-sm-2 col-form-label">@lang('common.file')</label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control" name="import_file" autofocus>
                                            <span class="error text-danger" for="impot_file">{{ $errors->first('import_file') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">@lang('common.import')</button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-success mr-3">@lang('common.return')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection