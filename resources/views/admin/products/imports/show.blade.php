@extends('layouts.main', ['activePage' => 'product-management', 'titlePage' => 'Detalles de Producto'])
@section('content')
    <div class="content">
        <div class="content-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="row justify-content-center">
                                <div class="col-md-2">
                                    <div class="card-title">@lang('imports.fields.file_name.th')</div>
                                </div>
                                <div class="col-md-4">
                                    <p class="card-category">{{ $import->file_name }}</p>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-2">
                                    <div class="card-title">@lang('imports.fields.import_type.th')</div>
                                </div>
                                <div class="col-md-4">
                                    <p class="card-category">{{ $import->import_type }}</p>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-2">
                                    <div class="card-title">@lang('imports.fields.import_status.th')</div>
                                </div>
                                <div class="col-md-4">
                                    <h4>
                                        <span class="badge bg-light text-dark">{{ $import->import_status }}</span>
                                    </h4>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-2">
                                    <div class="card-title">@lang('imports.fields.date.th')</div>
                                </div>
                                <div class="col-md-4">
                                    <p class="card-category">{{ $import->created_at }}</strong></p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-8">
                                    <div class="card card-user">
                                        <div class="card-body">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">@lang('common.row')</th>
                                                        <th scope="col">@lang('common.attribute')</th>
                                                        <th scope="col">@lang('common.errors')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @forelse ($import->errors as $key => $errors)
                                                        <tr>
                                                            <th scope="row">{{ explode('.', $key)[0] + 1 }}</th>
                                                            <th>{{ explode('.', $key)[1] }}</th>
                                                            <td>{{ implode(', ', $errors) }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6">@lang('imports.messages.empty')</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                              </table>
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