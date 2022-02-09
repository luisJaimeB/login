@extends('layouts.main', ['activePage' => 'permissions', 'titlePage' => 'Detalles del permiso'])
@section('content')
    <div class="content">
        <div class="content-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="card-title">Permisos</div>
                            <p class="card-category">Detalles del permiso {{ $permission->name }}</p>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-user">
                                        <div class="card-body">
                                            @if (session('success'))
                                                <div class="alert alert-success" role="success">
                                                    {{ session('success') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>    
                                            @endif
                                            <p class="card-text">
                                                <div class="author">
                                                    <a href="#" class="d-flex">
                                                        {{-- <img src="{{ asset('/img/faces/defaultAvatar.jpg')}}" alt="image" class="avatar"> --}}
                                                        <h5 class="title mx-3">{{ $permission->name }}</h5>
                                                    </a>
                                                    <p class="description">
                                                         {{ $permission->guard_name }} <br>
                                                         {{ $permission->created_at }} <br>
                                                    </p>
                                                </div>
                                            </p>
                                            <div class="card-description">
                                                 Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit voluptate earum cupiditate officia quisquam vero non laboriosam expedita voluptatem accusantium incidunt impedit beatae maiores quam neque, doloribus nesciunt? Accusamus, aliquid. 
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="button-container">
                                                <a href="{{ route('permissions.index') }}" class="btn btn-sm btn-success mr-3"> Volver </a>
                                                {{-- <button class="btn btn-sm btn-primary">Editar</button> --}}
                                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-primary mr-3">Editar</a>
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
    </div>
@endsection