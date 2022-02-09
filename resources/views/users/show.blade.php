@extends('layouts.main', ['activePage' => 'users', 'titlePage' => 'Detalles de Usuario'])
@section('content')
    <div class="content">
        <div class="content-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="card-title">Usuarios</div>
                            <p class="card-category">Detalles del usuario {{ $user->name }}</p>
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
                                                        <img src="{{ asset('/img/faces/defaultAvatar.jpg')}}" alt="image" class="avatar">
                                                        <h5 class="title mx-3">{{ $user->name }}</h5>
                                                    </a>
                                                    <p class="description">
                                                         {{ $user->username }}  <br>
                                                         {{ $user->email }} <br>
                                                         {{ $user->created_at }} <br>
                                                         <br>
                                                         @forelse ($user->roles as $role)
                                                             <span class="badge rounded-pill bg-dark text-white">{{ $role->name }}</span>
                                                         @empty
                                                             <span class="badge badge-danger bg-danger">No Roles</span>
                                                         @endforelse
                                                    </p>
                                                </div>
                                            </p>
                                            <div class="card-description">
                                                 Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit voluptate earum cupiditate officia quisquam vero non laboriosam expedita voluptatem accusantium incidunt impedit beatae maiores quam neque, doloribus nesciunt? Accusamus, aliquid. 
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="button-container">
                                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-success mr-3"> Volver </a>
                                                <button class="btn btn-sm btn-primary">Editar</button>
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