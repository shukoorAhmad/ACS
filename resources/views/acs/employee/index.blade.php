@extends('layouts.master')

@section('header-menu')
    @include('layouts.menu.acs-sys-menu')
@endsection
@section('header')
    {{ trans('words.Employees') }}
@endsection
@can('employee-create')
    @section('button')
        <button type="button" class="btn btn-light-primary font-weight-bolder btn-sm show_modal">
            {{ trans('words.New_', ['name' => trans('words.Employee')]) }} <span class="fa fa-plus"></span>
        </button>
    @endsection
@endcan
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('croppie/croppie.css') }}">

@section('content')
    @can('employee-list')
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-checkable data-table" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>{{ trans('words.No') }}</th>
                                <th class="font-weight-bolder">{{ trans('words.Employee') }}</th>
                                <th class="font-weight-bolder">{{ trans('words.Name') }}</th>
                                <th class="font-weight-bolder">{{ trans('words.ID') }}</th>
                                <th class="font-weight-bolder">{{ trans('words.Image') }}</th>
                                <th class="font-weight-bolder">{{ trans('words.Created By') }}</th>
                                <th class="font-weight-bolder">{{ trans('words.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endcan
    @canAny(['employee-create', 'employee-edit'])
        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header p-3">
                        <h5 id="modal_title"></h5>
                    </div>
                    <form id="store_form" method="POST" autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" value="0" name="employee_id" id="record_id">
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="required" for="name">{{ trans('words.Name') }}</label>
                                    <input class="form-control" name="name" id="name">
                                    <div class="invalid-feedback name_error"></div>
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="required" for="father_name">{{ trans('words.Father Name') }}</label>
                                    <input class="form-control" name="father_name" id="father_name">
                                    <div class="invalid-feedback father_name_error"></div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label>{{ trans('words.Image') }}</label>
                                    <label>
                                        <img src="" id="frontimage" class="image img-thumbnail" style="width:70%; cursor: pointer;" onclick="$('#recimage').click();">
                                        <input type="file" id="upload_image" name="img" id="img" hidden accept="image/*">
                                    </label>
                                    <div class="invalid-feedback img_error"></div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer p-3 d-flex justify-content-between">
                            <button type="submit" class="btn btn-outline-primary btn-sm"><span class="fa fa-save"></span></button>
                            <button class="btn btn-outline-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close"><span class="fa fa-times"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="UploadimageModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" id="body_para">
                        <div id="image_demo"></div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-success crop_image"><span class="fa fa-check"></span></button>
                        <button type="button" class="btn btn-outline-info Rotate" id="right-click" data-deg="90"> <span class="fa fa-redo"></span> </button>
                        <button type="button" class="btn btn-outline-primary Rotate" id="left-click" data-deg="-90"><span class="fa fa-undo"></span> </button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><span class="fa fa-times"></span></button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/jquery-validator/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('croppie/croppie.min.js') }}"></script>
    <script>
        $(document).on('click', '.delete_btn', function() {
            var emp_id = $(this).attr('data-id');
            Swal.fire({
                title: "{{ trans('words.Are You Sure To Delete') }}",
                text: "",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "{{ trans('words.NO') }}",
                confirmButtonText: "{{ trans('words.Yes') }}"
            }).then((result) => {
                if (result.value == true) {
                    $.get("{{ route('employee-destroy') }}/" + emp_id, function(res) {
                        if (res == true) {
                            $('#kt_datatable').DataTable().ajax.reload();
                            success("{{ trans('words.Successfully Deleted') }}");
                        } else
                            error_function("{{ trans('words.Please Try Again') }}");
                    });
                }
            });
        });


        $(document).on('keyup', 'input', function(event) {
            $(this).removeClass('is-invalid');
        });

        $(document).on('change', 'input', function(event) {
            $(this).removeClass('is-invalid');
        });

        $(document).on('click', '.show_modal', function() {
            $("#modal_title").html("{{ trans('words.New_', ['name' => trans('words.Employee')]) }}");
            $("input[name!='_token']").val('');
            $('input[name=employee_id').val("0");
            $('#frontimage').attr('src', "{{ asset('assets/blank.png') }}");
            $('#upload_image').attr('required', true);
            $('#add_modal').modal('show');
        });

        $(document).on('click', '.edit_btn', function() {
            $('#record_id').val($(this).attr('data-id'));
            $("input[name=name]").val($(this).attr('name'));
            $("input[name=father_name]").val($(this).attr('father_name'));
            $("#modal_title").html("{{ trans('words.Edit_', ['name' => trans('words.Employee')]) }}");
            $('#frontimage').attr('src', $(this).attr('image'));
            $('#add_modal').modal('show');
        });

        var converted_image = null;

        // to get image from image cropper and remove from base64 to image back
        function base64ToInputFile(base64Image, callback) {
            // Extract the image type from the Base64 data
            var imageType = base64Image.substring("data:image/".length, base64Image.indexOf(";base64"));
            // Convert Base64 to Blob
            var byteCharacters = atob(base64Image.split(',')[1]);
            var byteArrays = [];
            for (var i = 0; i < byteCharacters.length; i++) {
                byteArrays.push(byteCharacters.charCodeAt(i));
            }
            var blob = new Blob([new Uint8Array(byteArrays)], {
                type: "image/" + imageType
            });
            // Create a FileReader to read the Blob as an input file
            var reader = new FileReader();
            reader.onloadend = function() {
                var inputFile = new File([new Uint8Array(this.result)], "image." + imageType, {
                    type: "image/" + imageType
                });
                callback(inputFile);
            };
            reader.readAsArrayBuffer(blob);
        }

        $(document).ready(function() {
            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width: 300,
                    height: 350,
                    type: 'square',
                },
                boundary: {
                    width: 400,
                    height: 400
                },
                resizeControls: {
                    width: true,
                    height: true
                },
                showZoomer: true,
                enableOrientation: true,
                enforceBoundary: true,
                enableKeyMovement: true,
            });
            $('#upload_image').on('change', function() {
                $('.cr-slider').attr('aria-valuenow', 0.0992);
                var reader = new FileReader();
                reader.onload = function(event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result,
                    }).then(function() {
                        $image_crop.croppie('setZoom', 0.0992);
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#UploadimageModal').modal({
                    backdrop: 'static',
                    keboard: 'false',
                });

                setTimeout(() => {
                    $('#right-click').click();
                    $('#left-click').click();
                }, 250);
            });

            $('.crop_image').click(function(event) {
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response) {
                    $('#frontimage').attr('src', response);
                    $('#UploadimageModal').modal('hide');
                    var base64Image = response;
                    base64ToInputFile(base64Image, function(inputFile) {
                        converted_image = inputFile;
                    });
                })
            });

            $(".Rotate").click(function() {
                $image_crop.croppie('rotate', parseInt($(this).data('deg')));
            });
        });

        // this is server side datatable
        $('#kt_datatable').DataTable({
            "bInfo": false,
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "aaSorting": [
                [0, "desc"]
            ],
            "info": true,
            "language": {
                "sSearch": "{{ trans('words.Search') }}",
                "paginate": {
                    "previous": "{{ trans('words.Previous') }}",
                    "next": "{{ trans('words.Next') }}"
                },
                "sEmptyTable": "{{ trans('words.Data Not Available') }}"
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('employees') }}",
            columns: [{
                    "data": 'id',
                    'className': 'text-center font-weight-bolder'
                },
                {
                    "data": 'name',
                },
                {
                    "data": 'father_name',
                },
                {
                    "data": 'special_id',
                },
                {
                    "data": 'image',
                    'className': 'text-center'
                },
                {
                    "data": 'created_by_details',
                },
                {
                    "data": 'action',
                    'className': 'text-center'
                },
            ]
        });

        // form validation and submit
        $('#store_form').validate({
            rules: {
                name: "required",
                father_name: "required",
            },
            messages: {
                name: {
                    required: "{{ trans('words.Required_', ['name' => trans('words.Name')]) }}",
                },
                father_name: {
                    required: "{{ trans('words.Required_', ['name' => trans('words.Father Name')]) }}",
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
            submitHandler: function(form) {
                if ($('#store_form').valid()) {
                    // to submit form
                    var store_form_submited = false;
                    event.preventDefault();
                    if (!store_form_submited) {
                        data = new FormData($("#store_form")[0]);
                        data.append('employee_image', converted_image);
                        $.ajax({
                            url: "{{ route('employee-store') }}",
                            type: 'post',
                            data: data,
                            dataType: 'html',
                            cache: false,
                            processData: false,
                            contentType: false,
                            enctype: 'multipart/form-data',
                            beforeSend: function() {
                                store_form_submited = true;
                                startPageLoader();
                            },
                            success: function(data) {
                                if (data) {
                                    success($('input[name=employee_id]').val() == 0 ? "{{ trans('words.Successfully Stored') }}" : "{{ trans('words.Successfully Edited') }}");
                                    $('#add_modal').modal('hide');
                                    $('#kt_datatable').DataTable().ajax.reload();
                                    $("input[name!='_token']").val('');
                                    $('input[name=employee_id').val("0");
                                    $('#frontimage').attr('src', "{{ asset('assets/blank.png') }}");
                                } else {
                                    var response = JSON.parse(data);
                                    $.each(response, function(prefix, val) {
                                        $('div.' + prefix + '_error').text(val[0]);
                                        $("input[name=" + prefix + "]").addClass('is-invalid');
                                    });
                                }

                                stopPageLoader();
                                store_form_submited = false;
                            },
                            error: function() {
                                error_function("{{ trans('words.Please Try Again') }}");
                                stopPageLoader();
                                store_form_submited = false;
                            }
                        });
                    }
                }
            }
        });
    </script>
@endsection
