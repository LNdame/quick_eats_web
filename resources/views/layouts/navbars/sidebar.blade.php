<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <?php $user=\Illuminate\Support\Facades\Auth::user();
  $role=$user->roles[0];
  ?>
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
      @if($role->name=='admin')
      <li class="nav-item{{ $activePage == 'promotions-management' ? ' active' : '' }}">
        <a class="nav-link" href="#">
          <i class="material-icons">book</i>
          <span class="sidebar-normal"> {{ __('Promotions') }} </span>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'reports-management' ? ' active' : '' }}">
        <a class="nav-link" href="#">
          <i class="material-icons">account_balance</i>
          <span class="sidebar-normal"> {{ __('Reports') }} </span>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'restraurants-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{url('restaurants')}}">
          <i class="material-icons">kitchen</i>
          <span class="sidebar-normal"> {{ __('Restaurants') }} </span>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'vendor-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{url('vendors')}}">
          <i class="material-icons">store</i>
          <span class="sidebar-normal"> {{ __('Vendors') }} </span>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
          <i class="material-icons">supervisor_account</i>
          <span class="sidebar-normal"> {{ __('Users') }} </span>
        </a>
      </li>
      @endif
      @if($role->name=='vendor')
        <li class="nav-item{{ $activePage == 'promotions-management' ? ' active' : '' }}">
          <a class="nav-link" href="#">
            <i class="material-icons">book</i>
            <span class="sidebar-normal"> {{ __('Promotions') }} </span>
          </a>
        </li>
        <li class="nav-item {{ ($activePage == 'menu-management' || $activePage == 'menu-items') ? ' active' : '' }}">
          <a class="nav-link" data-toggle="collapse" href="#menu-manager" aria-expanded="false">
            <i class="material-icons">speaker_notes</i> <p>{{ __('Menu Management') }}
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse" id="menu-manager">
            <ul class="nav">
              <li class="nav-item{{ $activePage == 'menu-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{route('menus.index')}}">
                  <i class="material-icons">assignment</i>
                  <span class="sidebar-normal"> {{ __('Menus') }} </span>
                </a>
              </li>
              <li class="nav-item{{ $activePage == 'menu-items' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('menu-items.index') }}">
                  <i class="material-icons">assessment</i>
                  <p>{{ __('Menu Items') }}</p>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item{{ $activePage == 'restraurants-management' ? ' active' : '' }}">
          <a class="nav-link" href="#">
            <i class="material-icons">kitchen</i>
            <span class="sidebar-normal"> {{ __('Restaurants') }} </span>
          </a>
        </li>
       <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('profile.edit') }}">
          <i class="material-icons">account_circle</i>
          <span class="sidebar-normal">{{ __('User profile') }} </span>
        </a>
      </li>
        @endif
    </ul>
  </div>
</div>