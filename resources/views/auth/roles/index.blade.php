@extends('layouts.master')
@section('header-menu')
    @include('layouts.menu.user_management-menu')
@endsection
@section('header')
    {{ trans('words.Roles') }}
@endsection
@section('button')
    @can('role-create')
        <button type="button" class="btn btn-light-primary font-weight-bolder" data-toggle="modal" data-target="#add_modal">{{ trans('words.New Role') }}</button>
    @endcan
@endsection
@section('content')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />

    <style>
        fieldset {
            border: 1px solid #ddd !important;
            min-width: 0;
            width: 100%;
            padding: 10px;
            position: relative;
            border-radius: 6px;
            background-color: #f3f3f3;
            margin-top: 10px;
            padding-left: 10px !important;
        }

        legend {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 0px;
            width: 55%;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 5px 5px 10px;
            color: white;
            background-color: #3B3F51;
            opacity: 0.8;
        }
    </style>
    @can('role-create')
        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>{{ trans('words.Add New Role') }}</h5>
                    </div>
                    <form id="store_form" method="POST" action="{{ route('role-store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="system_id">{{ trans('words.Systems') }}</label>
                                    <select class="form-control select2" name="system_id" id="system_id" required>
                                        <option value="">-- {{ trans('words.Select_', ['name' => trans('words.Systems')]) }} --</option>
                                        @foreach ($systems as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>{{ trans('words.Name') }}</label>
                                    <input type="text" class="form-control" name="name" required>
                                    <div class="invalid-feedback name_error"></div>
                                </div>
                                <div class="form-group col-12" id="main-form-permissions">
                                </div>
                                <div class="invalid-feedback permissions_error"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ trans('words.Save') }}</button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">{{ trans('words.Close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    @can('role-list')
        <div class="card card-custom">
            <div class="card-body">
                <table class="table table-bordered table-hover table-checkable data-table" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                        <tr>
                            <th class="font-weight-bolder text-center">{{ trans('words.ID') }}</th>
                            <th class="font-weight-bolder">{{ trans('words.Role Name') }}</th>
                            <th class="font-weight-bolder">{{ trans('words.System') }}</th>
                            <th class="font-weight-bolder" style="width:50%;">{{ trans('words.Permissions') }}</th>
                            <th class="font-weight-bolder text-center">{{ trans('words.Actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    @endcan
    @can('role-edit')
        <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>{{ trans('words.Edit Role') }}</h5>
                    </div>
                    <form method="POST" id="edit_form" action="{{ route('role-update') }}">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" id="edit_record_id" name="id" value="">
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="edit_system_id">{{ trans('words.Systems') }}</label>
                                    <select class="form-control select2" name="system_id" id="edit_system_id" required>
                                        <option value="">--{{ trans('words.Select_', ['name' => trans('words.Systems')]) }}--</option>
                                        @foreach ($systems as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback system_id_error"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="edit_name">{{ trans('words.Name') }}</label>
                                    <input type="text" class="form-control" name="name" id="edit_name" required>
                                    <div class="invalid-feedback name_error"></div>
                                </div>
                                <div class="col-12" id="edit-form-permissions">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ trans('words.Save') }}</button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">{{ trans('words.Close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    @if (session()->has('success'))
        <script>
            success("{{ session()->get('success') }}")
        </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function() {
            $('#kt_datatable').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                "bInfo": false,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "aaSorting": [
                    [0, "desc"]
                ],
                "info": true,
                "language": {
                    "sProcessing": "{{ trans('words.Please Wait') }}...<span class='spinner spinner-primary ml-10'></span>",
                    "sSearch": "{{ trans('words.Search') }}",
                    "paginate": {
                        "previous": "{{ trans('words.Previous') }}",
                        "next": "{{ trans('words.Next') }}"
                    },
                    "sEmptyTable": "{{ trans('words.Data Not Available') }}"
                },
                ajax: "{{ route('roles') }}",
                columns: [{
                        "data": 'id',
                        'className': 'font-weight-bolder text-center'
                    },
                    {
                        "data": 'name'
                    },
                    {
                        "data": 'system_name'
                    },
                    {
                        "data": 'role_permissions',
                        sortable: false
                    },
                    {
                        "data": 'action',
                        sortable: false
                    }
                ]
            });

            // submit form validation
            $('#store_form').validate({
                rules: {
                    system_id: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                },
                messages: {
                    system_id: {
                        required: "{{ trans('words.Required_', ['name' => trans('words.System')]) }}",
                    },
                    name: {
                        required: "{{ trans('words.Required_', ['name' => trans('words.Name')]) }}",
                    },
                },
                errorPlacement: function(error, element) {
                    element.addClass('is-invalid');
                    $(element).parent().addClass('is-invalid');
                    if (element.hasClass('select2') && element.next('.select2-container').length) {
                        error.insertAfter(element.next('.select2-container'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form, event) {
                    if ($('#store_form').valid()) {
                        event.preventDefault();
                        var store_form_submited = false;
                        if (!store_form_submited) {
                            var url = $('#store_form').attr('action');
                            $.ajax({
                                url: url,
                                type: 'post',
                                data: $('#store_form').serialize(),
                                dataType: 'html',
                                beforeSend: function() {
                                    store_form_submited = true;
                                    $('body').css('padding-right', 'unset');
                                    startModalLoader();
                                    console.log('before send');
                                },
                                success: function(data) {
                                    if (data == true) {
                                        console.log(data);
                                        console.log('success send');
                                        $("input[name=name]").val('');
                                        $("select[name=section]").val('').trigger('change');
                                        $('.data-table').DataTable().ajax.reload();
                                        success("{{ trans('words.Successfully Stored') }}");
                                        $('#add_modal').modal('hide');
                                    } else {
                                        var response = JSON.parse(data);
                                        $.each(response, function(prefix, val) {
                                            $('div.' + prefix + '_error').text(val[0]);
                                            $("input[name=" + prefix + "]").addClass('is-invalid');
                                            if (prefix == 'permissions')
                                                $('.permissions_error').css('display', 'block');
                                        });
                                    }
                                    stopModalLoader();
                                    $('body').css('padding-right', '17px');
                                    store_form_submited = false;
                                },
                                error: function() {
                                    console.log('eror');
                                    error_function("{{ trans('words.Please Try Again') }}");
                                    stopModalLoader();
                                    $('body').css('padding-right', '17px');
                                    store_form_submited = false;
                                }
                            });
                        }
                    }
                }
            });

            // update form validation
            $('#edit_form').validate({
                rules: {
                    system_id: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                },
                messages: {
                    system_id: {
                        required: "{{ trans('words.Required_', ['name' => trans('words.System')]) }}",
                    },
                    name: {
                        required: "{{ trans('words.Required_', ['name' => trans('words.Name')]) }}",
                    },
                },
                errorPlacement: function(error, element) {
                    element.addClass('is-invalid');
                    $(element).parent().addClass('is-invalid');
                    if (element.hasClass('select2') && element.next('.select2-container').length) {
                        error.insertAfter(element.next('.select2-container'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form, event) {
                    if ($('#store_form').valid()) {
                        var edit_form_submited = false;
                        if (!edit_form_submited) {
                            var url = $('#edit_form').attr('action');
                            $.ajax({
                                url: url,
                                type: 'post',
                                data: $('#edit_form').serialize(),
                                dataType: 'html',
                                beforeSend: function() {
                                    edit_form_submited = true;
                                    startModalLoader();
                                },
                                success: function(data) {
                                    if (data == true) {
                                        $('.data-table').DataTable().ajax.reload();
                                        $('#edit_modal').modal('hide');
                                        success("{{ trans('words.Successfully Edited') }}");
                                    } else if (data == 'duplicate_year') {
                                        $('div.name_error').text("{{ trans('words.Duplicate Entry') }}");
                                        $("input[id=edit_year]").addClass('is-invalid');
                                    } else {
                                        var response = JSON.parse(data);
                                        $.each(response, function(prefix, val) {
                                            $('div.' + prefix + '_error').text(val[0]);
                                            $("input[id=edit_" + prefix + "]").addClass('is-invalid');
                                        });
                                    }
                                    stopModalLoader();
                                    edit_form_submited = false;
                                },
                                error: function() {
                                    error_function("{{ trans('words.Please Try Again') }}");
                                    stopModalLoader();
                                    edit_form_submited = false;
                                }
                            });
                        }
                    }
                }
            });

            $(document).on('change', 'input', function(event) {
                $(this).removeClass('is-invalid');
            });

            $(document).on('click', '.edit_btn', function(event) {
                var id = $(this).attr('record_id');
                var system_id = $(this).attr('system_id');
                $('#edit_record_id').val(id);
                $('#edit_name').val($(this).attr('role_name'));
                $('#edit_system_id').val($(this).attr('system_id')).trigger('change');
                var action = $(this).attr('action');
                $.ajax({
                    url: action,
                    type: 'get',
                    data: {
                        'system': system_id,
                        'id': id
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $('body').css('padding-right', 'unset');
                        startPageLoader();
                    },
                    success: function(data) {
                        $('#edit-form-permissions').html(data);
                        stopPageLoader();
                        $('body').css('padding-right', '17px');
                    },
                    error: function() {
                        error_function("{{ trans('words.Please Try Again') }}");
                        stopPageLoader();
                        $('body').css('padding-right', '17px');
                    }
                });

                $('#edit_modal').modal('show');
            });

            $(document).on('change', '#system_id', function() {
                var value = $(this).val();
                if (value == '') {
                    $('#main-form-permissions').html('');
                    return false;
                }

                $.ajax({
                    url: "{{ route('permission-details', 'store') }}",
                    type: 'get',
                    data: {
                        'system': value
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $('body').css('padding-right', 'unset');
                        startModalLoader();
                    },
                    success: function(data) {
                        $('#main-form-permissions').html(data);
                        stopModalLoader();
                        $('body').css('padding-right', '17px');
                    },
                    error: function() {
                        error_function("{{ trans('words.Please Try Again') }}");
                        stopModalLoader();
                        $('body').css('padding-right', '17px');
                    }
                });
            });
        });
    </script>
@endsection
