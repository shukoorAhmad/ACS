<li class="menu-item {{ Route::currentRouteName() == 'acs-sys' ? 'menu-item-active' : '' }}">
    <a href="{{ Route::currentRouteName() != 'acs-sys' ? route('acs-sys', session()->get('system_id')) : 'javascript:void(0)' }}" class="menu-link">
        <span class="menu-text">{{ trans('words.Dashboard') }}</span>
    </a>
</li>
@can('employee-list')
    <li class="menu-item {{ Route::currentRouteName() == 'employees' ? 'menu-item-active' : '' }} ">
        <a href="{{ Route::currentRouteName() != 'employees' ? route('employees') : 'javascript:void(0)' }}" class="menu-link">
            <span class="menu-text">{{ trans('words.Employees') }}</span>
        </a>
    </li>
@endcan

@can('employee-check')
    <li class="menu-item {{ Route::currentRouteName() == 'employee-checks' ? 'menu-item-active' : '' }} ">
        <a href="{{ Route::currentRouteName() != 'employee-checks' ? route('employee-checks') : 'javascript:void(0)' }}" class="menu-link">
            <span class="menu-text">{{ trans('words.Check_', ['name' => trans('words.Employees')]) }}</span>
        </a>
    </li>
@endcan
