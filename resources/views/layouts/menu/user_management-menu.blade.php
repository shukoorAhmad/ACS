<li class="menu-item {{ Route::currentRouteName() == 'user-management-sys' ? 'menu-item-active' : '' }}">
    <a href="{{ route('user-management-sys', session()->get('system_id')) }}" class="menu-link">
        <span class="menu-text">{{ trans('words.Dashboard') }}</span>
    </a>
</li>
@can('users-menu')
    <li class="menu-item {{ Route::currentRouteName() == 'users' ? 'menu-item-active' : '' }} ">
        <a href="{{ route('users') }}" class="menu-link">
            <span class="menu-text">{{ trans('words.Users') }}</span>
        </a>
    </li>
@endcan
@can('roles-menu')
    <li class="menu-item {{ Route::currentRouteName() == 'roles' ? 'menu-item-active' : '' }} ">
        <a href="{{ route('roles') }}" class="menu-link">
            <span class="menu-text">{{ trans('words.Roles') }}</span>
        </a>
    </li>
@endcan
