@extends('layouts.master')

@section('header-menu')
    @include('layouts.menu.user_management-menu')
@endsection
@section('header')
    {{ trans('words.Dashboard') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-4 mb-1">
            <div class="card h-100 bg-hover-gray-300">
                <div class="card-body p-9 text-dark">
                    <div class="d-flex justify-content-around">
                        <div class="fs-2hx font-weight-bolder font-size-h1 ">{{ App\Models\User::count('id') }}</div>
                        <div class="fs-2hx font-weight-bolder font-size-h1 ">{{ trans('words.Total_', ['name' => trans('words.Users')]) }}</div>
                        <div>
                            <img src="{{ asset('icons/group.png') }}" alt="" style="max-width: 40px !important;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mb-1">
            <div class="card h-100 bg-hover-gray-300">
                <div class="card-body p-9 text-dark">
                    <div class="d-flex justify-content-around">
                        <div class="fs-2hx font-weight-bolder font-size-h1 ">{{ Spatie\Permission\Models\Role::count('id') }}</div>
                        <div class="fs-2hx font-weight-bolder font-size-h1 ">{{ trans('words.Total_', ['name' => trans('words.Roles')]) }}</div>
                        <div>
                            <img src="{{ asset('icons/role.png') }}" alt="" style="max-width: 40px !important;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mb-1">
            <div class="card h-100 bg-hover-gray-300 text-dark">
                <div class="card-body p-9">
                    <div class="d-flex justify-content-around">
                        <div class="fs-2hx font-weight-bolder font-size-h1 ">{{ $permission = Spatie\Permission\Models\Permission::count('id') }}</div>
                        <div class="fs-2hx font-weight-bolder font-size-h1 ">{{ trans('words.Total_', ['name' => trans('words.Permissions')]) }}</div>
                        <div>
                            <img src="{{ asset('icons/permissions.png') }}" alt="" style="max-width: 40px !important;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
