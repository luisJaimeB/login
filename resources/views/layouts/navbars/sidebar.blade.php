<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{ route('welcome') }}" class="simple-text logo-normal">
      MERCATODO
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('img/laravel.svg') }}"></i>
          <p>{{ __('Managment') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            @can('admin.products.index')
            <li class="nav-item{{ $activePage == 'product-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.products.index') }}">
                <span class="sidebar-mini"> PM </span>
                <span class="sidebar-normal"> {{ __('Product Management') }} </span>
              </a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
      @can('users.index')
      <li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
          <i class="material-icons">people</i>
            <p>{{ __('Usuarios') }}</p>
        </a>
      </li>
      @endcan
      <li class="nav-item{{ $activePage == 'products' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('welcome') }}">
          <i class="material-icons">storefront</i>
            <p>@lang('products.titles.products')</p>
        </a>
      </li>
      @can('permissions.index')
      <li class="nav-item{{ $activePage == 'permissions' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('permissions.index') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Permissions') }}</p>
        </a>
      </li>
      @endcan
      @can('roles.index')
      <li class="nav-item{{ $activePage == 'roles' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('roles.index') }}">
          <i class="material-icons">location_ons</i>
            <p>@lang('roles.titles.roles')</p>
        </a>
      </li>
      @endcan
      @can('admin.categories.index')
      <li class="nav-item{{ $activePage == 'categories' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
          <i class="material-icons">category</i>
          <p>@lang('products.fields.categories.label')</p>
        </a>
      </li>
      @endcan
      <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
        <a class="nav-link" href="#">
          <i class="material-icons">language</i>
          <p></p>
        </a>
      </li>
      </li>
    </ul>
  </div>
</div>
