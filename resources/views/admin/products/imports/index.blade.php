@extends('layouts.main', ['activePage' => 'product-management', 'titlePage' => 'Importes'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <div class="card-title"><strong>@lang('products.titles.products')</strong></div>
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
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary text-center">
                                                <th scope="col">#</th>
                                                <th scope="col">@lang('imports.fields.file_name.th')</th>
                                                <th scope="col">@lang('imports.fields.import_type.th')</th>
                                                <th scope="col">@lang('imports.fields.import_status.th')</th>
                                                <th scope="col">@lang('imports.fields.date.th')</th>
                                                <th class="text-right">@lang('common.actions')</th>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach ($imports as $import)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $import->file_name }}</td>
                                                        <td>{{ $import->import_type }}</td>
                                                        <td>{{ $import->import_status }}</td>
                                                        <td>{{ $import->created_at }}</td>
                                                        <td class="td-actions text-right">
                                                            <a href="{{ route('admin.imports.show', $import->id) }}" class="btn btn-info">
                                                                <i class="material-icons">remove_red_eye</i>
                                                            </a>
                                                            <form action="{{ route('admin.imports.destroy', $import->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('@lang('users.messages.comfirmDeluser')')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" type="submit" rel="tooltip">
                                                                    <i class="material-icons">close</i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer mr-auto pagination justify-content-center">
                                        {{ $imports->links() }}
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