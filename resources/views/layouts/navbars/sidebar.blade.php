<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">

  <div class="logo text-center">
    <a href="#">
      <img src="{{asset('images/logo.png')}}" width="50%;"/>
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

      <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('profile.edit') }}">
          <span class="sidebar-mini"> UP </span>
          <span class="sidebar-normal">{{ __('User profile') }} </span>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
          <span class="sidebar-mini"> UM </span>
          <span class="sidebar-normal"> {{ __('User Management') }} </span>
        </a>
      </li>


    </ul>
  </div>
</div>