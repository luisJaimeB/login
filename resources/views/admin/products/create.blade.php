@extends('layouts.main', ['activePage' => 'products', 'titlePage' => 'Nuevo producto'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.products.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">@lang('products.titles.products')</h4>
                                <p class="card-category">@lang('products.titles.enterData')</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label for="name" class="col-sm-2 col-form-label">@lang('products.fields.name.label')</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="name" placeholder="@lang('products.fields.name.placeholder')" value="{{ old('name') }}" autofocus>
                                        @if ($errors->has('name'))
                                            <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="description" class="col-sm-2 col-form-label">@lang('products.fields.description.label')</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="description" placeholder="@lang('products.fields.description.placeholder')" value="{{ old('description') }}">
                                        @if ($errors->has('description'))
                                            <span class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="price" class="col-sm-2 col-form-label">@lang('products.fields.price.label')</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" name="price" placeholder="@lang('products.fields.price.placeholder')" value="{{ old('price') }}">
                                        @if ($errors->has('price'))
                                            <span class="error text-danger" for="input-price">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="categories" class="col-sm-2 col-form-label">@lang('products.fields.categories.label')</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="category_id" aria-label="Default select example">
                                            <option value="">@lang('products.fields.categories.option')</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category'))
                                            <span class="error text-danger" for="input-category">{{ $errors->first('category') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="image" class="col-sm-2 col-form-label">@lang('products.fields.image')</label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                        @if ($errors->has('description'))
                                            <span class="error text-danger" for="input-image">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">@lang('common.save')</button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-success mr-3">@lang('common.return')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection