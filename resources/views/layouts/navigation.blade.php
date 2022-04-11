<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    <li class="nav-group {{ Route::is('roles') || Route::is('users') ? 'show' : '' }}"
        aria-expanded="{{ Route::is('roles') || Route::is('users') ? 'true' : 'false' }}">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-settings') }}"></use>
            </svg>
            {{ __('Settings') }}
        </a>

        <ul class="nav-group-items" style="height: {{ Route::is(['roles.index', 'users.index']) ? 'auto;' : '0px;' }}">
            <li class="nav-item">
                <a class="nav-link" target="_top" href="{{ route('roles.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                    </svg>
                    {{ __('Roles') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                    </svg>
                    {{ __('Users') }}
                </a>
            </li>
        </ul>
    </li>
</ul>
