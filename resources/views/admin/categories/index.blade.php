@extends('layouts.main', ['activePage' => 'categories', 'titlePage' => 'Categorías'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Categorías</h4>
            <p class="card-category">Lista de categorías registradas en la base de datos</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-facebook">Añadir nueva categoría</a>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table ">
                <thead class="text-primary">
                  <th> ID </th>
                  <th> Nombre </th>
                  <th> Fecha de creación </th>
                  <th class="text-right"> Acciones </th>
                </thead>
                <tbody>
                  @forelse ($categories as $category)
                  <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td class="text-primary">{{ $category->created_at->toFormattedDateString() }}</td>
                    <td class="td-actions text-right">
                    
                      <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-success">
                        <i class="material-icons">edit</i> 
                      </a>
                      <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post"
                        onsubmit="return confirm('areYouSure')" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" rel="tooltip" class="btn btn-danger">
                          <i class="material-icons">close</i>
                        </button>
                      </form>
                    {{-- @can('roles.edit')
                      <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-success"> <i
                          class="material-icons">edit</i> </a>
                    @endcan
                    @can('roles.destroy')
                      <form action="{{ route('roles.destroy', $role->id) }}" method="post"
                        onsubmit="return confirm('areYouSure')" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" rel="tooltip" class="btn btn-danger">
                          <i class="material-icons">close</i>
                        </button>
                      </form>
                    @endcan --}}
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="2">Sin registros.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
              {{-- {{ $users->links() }} --}}
            </div>
          </div>
          <!--Footer-->
          <div class="card-footer mr-auto">
            {{ $categories->links() }}
          </div>
          <!--End footer-->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
