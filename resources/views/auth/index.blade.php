@extends('layouts.master')
@section('header-menu')
    @include('layouts.menu.user_management-menu')
@endsection
@section('header')
    {{ trans('words.Users') }}
@endsection
@section('button')
    @can('user-create')
        <button type="button" class="btn btn-light-primary font-weight-bolder" data-toggle="modal" data-target="#add_modal">{{ trans('words.New User') }}</button>
    @endcan
@endsection
@section('content')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    @can('user-create')
        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>{{ trans('words.Add New User') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form id="store_form" method="POST" action="{{ route('users-store') }}" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="name" class="col-form-label">{{ trans('words.Name And Last Name') }}</label>
                                    <input id="name" type="text" class="form-control" name="name" autofocus>
                                    <div class="invalid-feedback name_error"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="username" class="col-form-label">{{ trans('words.Username') }}</label>
                                    <input id="username" type="text" class="form-control" name="username">
                                    <div class="invalid-feedback username_error"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="email" class="col-form-label">{{ trans('words.Email') }}</label>
                                    <input id="email" type="email" class="form-control" name="email">
                                    <div class="invalid-feedback email_error"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="password" class="col-form-label">{{ trans('words.Password') }}</label>
                                    <input id="password" type="password" class="form-control" name="password">
                                    <div class="invalid-feedback password_error"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="password_confirmation" class="col-form-label">{{ trans('words.Confirm Password') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                                    <div class="invalid-feedback password_confirmation_error"></div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="system_id">{{ trans('words.Systems') }}</label>
                                    <select class="form-control select2" name="system_id[]" multiple id="system_id">
                                        @foreach ($systems as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-12" id="section_result" style="display: none">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ trans('words.Save') }}</button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">{{ trans('words.Close') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('user-list')
        <div class="card card-custom">
            <div class="card-body">
                <table class="table table-bordered table-hover table-checkable data-table" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                        <tr>
                            <th class="font-weight-bolder text-center">{{ trans('words.ID') }}</th>
                            <th class="font-weight-bolder">{{ trans('words.Name And Last Name') }}</th>
                            <th class="font-weight-bolder">{{ trans('words.Username') }}</th>
                            <th class="font-weight-bolder">{{ trans('words.Email') }}</th>
                            <th class="font-weight-bolder">{{ trans('words.Systems') }}</th>
                            <th class="font-weight-bolder">{{ trans('words.Roles') }}</th>
                            <th class="font-weight-bolder text-center">{{ trans('words.Actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    @endcan
    @can('user-edit')
        <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>{{ trans('words.Edit User') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form id="edit_form" method="POST" action="{{ route('users-update') }}">
                            @csrf
                            <input type="hidden" id="edit_record_id" name="id">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="name" class="col-form-label">{{ trans('words.Name And Last Name') }}</label>
                                    <input id="edit_name" type="text" class="form-control" required name="name" autofocus>
                                    <div class="invalid-feedback name_error"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="edit_username" class="col-form-label">{{ trans('words.Username') }}</label>
                                    <input id="edit_username" type="text" class="form-control" required name="username">
                                    <div class="invalid-feedback username_error"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="email" class="col-form-label">{{ trans('words.Email') }}</label>
                                    <input id="edit_email" type="email" class="form-control" required name="email">
                                    <div class="invalid-feedback email_error"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="password" class="col-form-label">{{ trans('words.Password') }}</label>
                                    <input id="edit_password" type="password" class="form-control" name="password">
                                    <div class="invalid-feedback password_error"></div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="password-confirm" class="col-form-label">{{ trans('words.Confirm Password') }}</label>
                                    <input id="edit_password-confirm" type="password" class="form-control" name="password_confirmation">
                                    <div class="invalid-feedback password_confirmation_error"></div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="system_id">{{ trans('words.Systems') }}</label>
                                    <select class="form-control select2" name="system_id[]" multiple id="edit_system_id" required>
                                        @foreach ($systems as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-12" id="edit_section_result" style="display: none">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ trans('words.Save') }}</button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">{{ trans('words.Close') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan

@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script>
        reset_form = () => {
            $('input[name!=_token]').val('');
            $('input').removeClass('is-invalid');
            $("#system_id").val('').trigger('change');
        }
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
                ajax: "{{ route('users') }}",
                columns: [{
                        "data": 'id',
                        'className': 'text-center font-weight-bolder'
                    },
                    {
                        "data": 'name'
                    },
                    {
                        "data": 'username'
                    },
                    {
                        "data": 'email'
                    },
                    {
                        "data": 'systems'
                    },
                    {
                        "data": 'roles'
                    },
                    {
                        "data": 'action'
                    }
                ]
            });

            // form validation
            $('#store_form').validate({
                rules: {
                    name: "required",
                    username: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    },
                    'system_id[]': "required"
                },
                messages: {
                    name: {
                        required: "{{ trans('words.Required_', ['name' => trans('words.Name')]) }}",
                    },
                    username: {
                        required: "{{ trans('words.Required_', ['name' => trans('words.Username')]) }}",
                    },
                    email: {
                        required: "{{ trans('words.Required_', ['name' => trans('words.Email')]) }}",
                        email: "{{ trans('words.Email Format') }}"
                    },
                    password: {
                        required: "{{ trans('words.Required_', ['name' => trans('words.Password')]) }}",
                        minlength: "{{ trans('words.Password Minimum Characters') }}"
                    },
                    password_confirmation: {
                        required: "{{ trans('words.Required_', ['name' => trans('words.Password Confirmation')]) }}",
                        minlength: "{{ trans('words.Password Confirmation Minimum Characters') }}",
                        equalTo: "{{ trans('words.Password Confirmation Does Not Match') }}"
                    },
                    'system_id[]': {
                        required: "{{ trans('words.Required_', ['name' => trans('words.System')]) }}",
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
                        var store_form_submited = false;
                        if (!store_form_submited) {
                            var url = $('#store_form').attr('action');
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: $('#store_form').serialize(),
                                dataType: 'html',
                                beforeSend: function() {
                                    store_form_submited = true;
                                    startModalLoader();
                                },
                                success: function(data) {
                                    if (data == true) {
                                        $('.data-table').DataTable().ajax.reload();
                                        reset_form();
                                        $('#section_result').hide();
                                        $('#add_modal').modal('hide');
                                        success("{{ trans('words.Successfully Stored') }}");
                                    } else {
                                        var response = JSON.parse(data);
                                        $.each(response, function(prefix, val) {
                                            $('div.' + prefix + '_error').text(val[0]);
                                            $("input[name=" + prefix + "]").addClass('is-invalid');
                                            $("select[id=edit_" + prefix + "]").addClass('is-invalid');
                                        });
                                    }
                                    stopModalLoader();
                                    store_form_submited = false;
                                },
                                error: function() {
                                    error_function("{{ trans('words.Please Try Again') }}");
                                    stopModalLoader();
                                    store_form_submited = false;
                                }
                            });
                        }
                    }
                }
            });

            // form validation
            $('#edit_form').validate({
                rules: {
                    name: "required",
                    username: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    'system_id[]': "required"
                },
                messages: {
                    name: {
                        required: "{{ trans('words.Required_', ['name' => trans('words.Name')]) }}",
                    },
                    username: {
                        required: "{{ trans('words.Required_', ['name' => trans('words.Username')]) }}",
                    },
                    email: {
                        required: "{{ trans('words.Required_', ['name' => trans('words.Email')]) }}",
                        email: "{{ trans('words.Email Format') }}"
                    },
                    'system_id[]': {
                        required: "{{ trans('words.Required_', ['name' => trans('words.System')]) }}",
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
                    if ($('#edit_form').valid()) {
                        var edit_form_submited = false;
                        if (!edit_form_submited) {
                            var url = $('#edit_form').attr('action');
                            $.ajax({
                                url: url,
                                type: 'post',
                                data: $('#edit_form').serialize(),
                                beforeSend: function() {
                                    edit_form_submited = true;
                                    startModalLoader();
                                },
                                success: function(data) {
                                    if (data == true) {
                                        $('.data-table').DataTable().ajax.reload();
                                        $('#edit_modal').modal('hide');
                                        reset_form();
                                        success("{{ trans('words.Successfully Edited') }}");
                                    } else if (data == 'duplicate_entry') {
                                        $('div.email_error').text("{{ trans('words.Duplicate Entry') }}");
                                        $("input[id=edit_email]").addClass('is-invalid');
                                    } else {
                                        var response = JSON.parse(data);
                                        $.each(response, function(prefix, val) {
                                            $('div.' + prefix + '_error').text(val[0]);
                                            $("input[id=edit_" + prefix + "]").addClass('is-invalid');
                                            $("select[id=edit_" + prefix + "]").addClass('is-invalid');
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
                $('#edit_record_id').val(id);
                $('input').removeClass('is-invalid');
                $('#edit_name').val($(this).attr('name'));
                $('#edit_email').val($(this).attr('email'));
                $('#edit_username').val($(this).attr('username'));

                var action = $(this).attr('action');
                $.ajax({
                    url: action,
                    type: 'get',
                    data: {
                        'id': id
                    },
                    beforeSend: function() {
                        $('body').css('padding-right', 'unset');
                        startModalLoader();
                    },
                    success: function(data) {
                        $('#edit_system_id').html(data);
                        $('#edit_system_id').select2({
                            width: '100%'
                        }).change();
                        stopModalLoader();
                        $('body').css('padding-right', '17px');
                        $('#edit_modal').modal('show');
                    },
                    error: function() {
                        error_function("{{ trans('words.Please Try Again') }}");
                        stopModalLoader();
                        $('body').css('padding-right', '17px');
                    }
                });
            });

            $(document).on('change', '#system_id', function() {
                var value = $(this).val();
                if (value == '') {
                    $('#main-form-permissions').html('');
                    return false;
                }
                $.ajax({
                    url: "{{ route('role-details', 'details') }}",
                    type: 'get',
                    data: {
                        'system_id': value
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $('body').css('padding-right', 'unset');
                        startModalLoader();
                    },
                    success: function(data) {
                        $('#section_result').html(data);
                        $('#section_result').show();
                        $('#roles').select2({
                            width: '100%'
                        });
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

            $(document).on('change', '#edit_system_id', function() {
                var value = $(this).val();

                $.ajax({
                    url: "{{ route('role-details', 'edit') }}",
                    type: 'get',
                    data: {
                        'id': $('#edit_record_id').val(),
                        'system_id': value
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $('body').css('padding-right', 'unset');
                        startModalLoader();
                    },
                    success: function(data) {
                        $('#edit_section_result').html(data);
                        $('#edit_section_result').show();
                        $('#edit_roles').select2({
                            width: '100%'
                        });
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

        $(document).on('click', '.destroy_btn', function() {
            Swal.fire({
                title: "{{ trans('words.Are You Sure To Delete') }}",
                text: "",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "{{ trans('words.No') }}",
                confirmButtonText: "{{ trans('words.Yes') }}",
            }).then((result) => {
                if (result.value == true) {
                    $.get("{{ route('user-delete') }}/" + $(this).attr('record_id'), function(data) {
                        if (data) {
                            success("{{ trans('words.Successfully Deleted') }}");
                            $('.data-table').DataTable().ajax.reload();
                        }
                    }).fail(function(error) {
                        error_function("trans('words.Please Try Again')");
                    });
                }
            });
        });
    </script>
@endsection
