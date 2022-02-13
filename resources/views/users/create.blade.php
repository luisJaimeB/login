@extends('layouts.main', ['activePage' => 'users', 'titlePage' => 'Nuevo usuario'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('users.store') }}" method="post" class="form-horizontal">
                        @csrf
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">@lang('users.titles.users')</h4>
                                <p class="card-category">@lang('users.titles.enterData')</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label for="name" class="col-sm-2 col-form-label">@lang('users.fields.name.label')</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="name" placeholder="@lang('users.fields.name.placeholder')" value="{{ old('name') }}" autofocus>
                                        @if ($errors->has('name'))
                                            <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="username" class="col-sm-2 col-form-label">@lang('users.fields.username.label')</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="username" placeholder="@lang('users.fields.username.placeholder')" value="{{ old('username') }}">
                                        @if ($errors->has('username'))
                                            <span class="error text-danger" for="input-username">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="email" class="col-sm-2 col-form-label">@lang('users.fields.email.label')</label>
                                    <div class="col-sm-7">
                                        <input type="email" class="form-control" name="email" placeholder="@lang('users.fields.email.placeholder')" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="password" class="col-sm-2 col-form-label">@lang('users.fields.password.label')</label>
                                    <div class="col-sm-7">
                                        <input type="password" class="form-control" name="password" placeholder="@lang('users.fields.password.placeholder')">
                                        @if ($errors->has('password'))
                                            <span class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="roles" class="col-sm-2 col-form-label">@lang('roles.titles.roles')</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <div class="tab-content">
                                                <div class="tab-pane active">
                                                    <table class="table">
                                                        <tbody>
                                                            @foreach ($roles as $id => $role)
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input class="form-check-input" type="checkbox" name="roles[]"
                                                                                value="{{ $id }}"
                                                                            >
                                                                            <span class="form-check-sign">
                                                                                <span class="check"></span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{ $role }}
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">@lang('common.save')</button>
                                <a href="{{ route('users.index') }}" class="btn btn-success mr-3">@lang('common.return')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection