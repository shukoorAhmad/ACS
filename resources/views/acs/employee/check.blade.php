@extends('layouts.master')

@section('header-menu')
    @include('layouts.menu.acs-sys-menu')
@endsection
@section('header')
    {{ trans('words.Check_', ['name' => trans('words.Employees')]) }}
@endsection
@section('button')
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-12 col-md-6">
                    <label for="">{{ trans('words.Search') }} <span class="text-primary fa fa-info ml-19">&nbsp;({{ trans('words.If Not Using Device Hit Enter Button') }})</span></label>
                    <input type="text" class="form-control" id="employee_id" placeholder="{{ trans('words.Write Employee Special ID') }}" autofocus>
                </div>
            </div>
        </div>
        <div class="card-footer" id="show_data"></div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#employee_id').keyup(function(e) {
            if (e.keyCode == 13) {
                startPageLoader();
                event.preventDefault();
                var emp_id = $('#employee_id').val();
                $.get("{{ route('employee-check') }}/" + emp_id, function(res) {
                    $('#show_data').html(res);
                });
                stopPageLoader();
            }
        });
    </script>
@endsection
