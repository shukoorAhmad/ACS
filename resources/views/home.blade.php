@extends('layouts.master')

@section('content')
    <style>
        .content {
            padding: unset !important;
        }
    </style>
    <div class="row">
        @foreach ($systems as $item)
            @if (hasAccessToSystem($item->id))
                <div class="col-sm-12 col-md-4 col-lg-3 mb-1">
                    <div class="card h-100 bg-hover-gray-300">
                        <a href="{{ route($item->route, $item->id) }}" class="text-dark">
                            <div class="card-body p-9">
                                <div class="d-flex justify-content-around">
                                    <div class="fs-2hx font-weight-bolder font-size-h1 ">{{ $item->name }}</div>
                                    <div>
                                        <img src="{{ asset($item->icon) }}" alt="" style="max-width: 50px !important;">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
