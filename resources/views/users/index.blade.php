@extends('layouts.main', ['activePage' => 'users', 'titlePage' => 'Usuarios'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <div class="card-title">@lang('users.titles.users')</div>
                                    <div class="card-category">@lang('users.titles.usersInSys')</div>
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
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            @can('users.create')
                                            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">@lang('users.usersCreate')</a>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>ID</th>
                                                <th>@lang('users.fields.name.th')</th>
                                                <th>@lang('users.fields.email.th')</th>
                                                <th>@lang('users.fields.username.th')</th>
                                                <th>@lang('roles.th.role')</th>
                                                <th>@lang('users.fields.status.status')</th>
                                                <th class="text-right">@lang('common.actions')</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->id}}</td>
                                                        <td>{{ $user->name}}</td>
                                                        <td>{{ $user->email}}</td>
                                                        <td>{{ $user->username}}</td>
                                                        <td>
                                                            @forelse ($user->roles as $role)
                                                                <span class="badge badge-info">{{ $role->name }}</span>
                                                            @empty
                                                            <span class="badge badge-danger">Sin rol</span>
                                                            @endforelse
                                                        </td>
                                                        @if ($user->status == 1)
                                                            <td>
                                                                <a href="{{ route('users.change.status', $user->id) }}" class="badge badge-info">
                                                                    <span>@lang('users.fields.status.active')</span>    
                                                                </a>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <a href="{{ route('users.change.status', $user->id) }}" class="badge badge-danger">
                                                                    <span>@lang('users.fields.status.Inactive')</span>
                                                                </a>  
                                                            </td>
                                                        @endif
                                                        <td class="td-actions text-right">
                                                            @can('users.show')
                                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">
                                                                <i class="material-icons">person</i>
                                                            </a>
                                                            @endcan
                                                            @can('users.edit')
                                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                                                                <i class="material-icons">edit</i>
                                                            </a>
                                                            @endcan
                                                            @can('users.destroy')
                                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('@lang('users.messages.comfirmDeluser')')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" type="submit" rel="tooltip">
                                                                    <i class="material-icons">close</i>
                                                                </button>
                                                            </form>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer mr-auto">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection